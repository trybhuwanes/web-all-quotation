<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Product_specification_fas;
use App\Models\Product_specification_fmp;
use App\Models\Product_specification_bf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Log;

class ProductService
{
    protected Model $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function model(): Product
    {
        return $this->model;
    }

    // Read
    public function all(): Collection
    {
        $product = $this->model->all();
        return $product;
    }

    // paginate
    public function paginate(int $page): LengthAwarePaginator
    {
        return $this->model->paginate($page);
    }

    // select two/2
    public function select2(): Builder
    {
        $product = $this->model()
            ->select([
                'id',
                DB::raw('nama_produk as text'),
            ])
            ->limit(10);

        return $product;
    }

    // filter / Search
    public function filtering(array $filter = []): Builder
    {
        $search  = $filter['search'];
        $filterScope = $filter['scope'] ?? []; // Ambil scope (category_id) jika ada, jika tidak, array kosong

        $product = $this->model
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nama_produk', 'LIKE', "%{$search}%");
                });
            })
            ->when(!empty($filterScope), function ($q) use ($filterScope) {
                $q->whereIn('category_id', $filterScope);
            });

        return $product;
    }

    // Create
    public function create($data): void
    {
        DB::beginTransaction();
        try {
            $produk = $this->model->create($data);

            //Upload Thumbnail
            if (array_key_exists('thumbnail', $data)) {
                $this->uploadThumb($data['thumbnail'], $produk);
            }

            //Upload Gallery
            if (array_key_exists('files', $data)) {
                $this->addToGallery($data['files'], $produk);
            }

            // Simpan spesifikasi (kalau ada)
            if (isset($data['specification_type'])) {
                $this->createSpecification($produk->id, $data);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    // Show by ID
    public function show(int $id): Product
    {
        return $this->model->findOrFail($id);
    }

    // Show By SLUG
    public function findBySlug(string $slug): ?Product
    {
        // dd($uuid);
        return $this->model->where('slug', $slug)
            ->with([
                'categoryProducts',
                'additionalProducts',
                'specificationFas',
                'specificationFmp',
                'projects.media'
            ])->first();
    }

    // Show By UUID
    public function findByUuid(string $uuid): ?Product
    {
        // dd($uuid);
        return $this->model->where('uuid', $uuid)
            ->with([
                'categoryProducts',
                'additionalProducts',
                'specificationFas',
                'specificationFmp'
            ])->first();
    }

    // Update
    public function update(array $data, Product $product): Product
    {
        DB::beginTransaction();
        try {
            $product->fill($data);
            $product->save();

            if (array_key_exists('thumbnail', $data)) {
                $this->uploadThumb($data['thumbnail'], $product);
            }

            //Upload Gallery
            if (array_key_exists('files', $data)) {
                $this->addToGallery($data['files'], $product);
            }

            DB::commit();
            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    // Delete
    public function destroy(Product $product): bool
    {
        try {
            return $product->delete();
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    // Multi Delete
    public function destroyMultiple(array $id): bool
    {
        try {
            return $this->model->destroy($id);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    public function removeThumb(Product $product): HasMedia
    {
        return $product->clearMediaCollection(
            $this->getLogoCollectionKey()
        );
    }

    public function uploadThumb(UploadedFile $logo, Product $product): Media
    {
        $this->removeThumb($product);

        $media = $product->addMedia($logo)->toMediaCollection($this->getLogoCollectionKey(), 'public');
        $product->thumbnail = $media->getUrl();
        $product->save();

        return $media;
    }

    private function getLogoCollectionKey(): string
    {
        return 'product-thumbnail';
    }

    // GALERY
    public function removeGallery(Product $product): HasMedia
    {
        return $product->clearMediaCollection(
            $this->getGalleryCollectionKey()
        );
    }


    public function addToGallery(array $images, Product $product): void
    {
        DB::beginTransaction();
        try {

            $this->removeGallery($product);
            foreach ($images as $image) {
                $product->addMedia($image)->toMediaCollection($this->getGalleryCollectionKey(), 'public');
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    private function getGalleryCollectionKey(): string
    {
        return 'product-gallery';
    }

    protected function createSpecification(int $productId, array $data): void
    {
        switch ($data['specification_type']) {
            case 'fas':
                $this->createFasSpecs($productId, $data['fas'] ?? []);
                break;
            case 'fmp':
                $this->createFmpSpecs($productId, $data['fmp'] ?? []);
                break;
            case 'bf':
                $this->createBfSpecs($productId, $data['bf'] ?? []);
                break;
        }
    }

    protected function createFasSpecs(int $productId, array $fasSpecs): void
    {
        foreach ($fasSpecs['type_name'] ?? [] as $index => $typeName) {
            Product_specification_fas::create([
                'product_id'   => $productId,
                'type_name'    => $typeName,
                'power_hp'     => $fasSpecs['power_hp'][$index] ?? null,
                'power_kw'     => $fasSpecs['power_kw'][$index] ?? null,
                'aerator_sotr' => $fasSpecs['aerator_sotr'][$index] ?? null,
                'aerator_md'   => $fasSpecs['aerator_md'][$index] ?? null,
                'aerator_mz'   => $fasSpecs['aerator_mz'][$index] ?? null,
                'aerator_d'    => $fasSpecs['aerator_d'][$index] ?? null,
                'aerator_pr'   => $fasSpecs['aerator_pr'][$index] ?? null,
                'net_weight'   => $fasSpecs['net_weight'][$index] ?? null,
                'harga'        => $fasSpecs['harga'][$index] ?? 0,
            ]);
        }
    }

    protected function createFmpSpecs(int $productId, array $fmpSpecs): void
    {
        foreach ($fmpSpecs['type_name'] ?? [] as $index => $typeName) {
            Product_specification_fmp::create([
                'product_id'       => $productId,
                'type_name'        => $typeName,
                'harga'            => $fmpSpecs['harga'][$index] ?? 0,
                'dry_solids_min'   => $fmpSpecs['dry_solids_min'][$index] ?? null,
                'dry_solids_max'   => $fmpSpecs['dry_solids_max'][$index] ?? null,
                'dimension_l'      => $fmpSpecs['dimension_l'][$index] ?? null,
                'dimension_w'      => $fmpSpecs['dimension_w'][$index] ?? null,
                'dimension_h'      => $fmpSpecs['dimension_h'][$index] ?? null,
                'net_weight'       => $fmpSpecs['net_weight'][$index] ?? null,
                'power_kw'         => $fmpSpecs['power_kw'][$index],
                'opex_chemical_min' => $fmpSpecs['opex_chemical_min'][$index],
                'opex_chemical_max' => $fmpSpecs['opex_chemical_max'][$index],
                'opex_electrical_min' => $fmpSpecs['opex_electrical_min'][$index],
                'opex_electrical_max' => $fmpSpecs['opex_electrical_max'][$index],
                'quot_pd_flush_water' => $fmpSpecs['quot_pd_flush_water'][$index] ?? null,
                'quot_sc_specification_length' => $fmpSpecs['quot_sc_specification_length'][$index] ?? null,
                'quot_sc_quantity' => $fmpSpecs['quot_sc_quantity'][$index] ?? null,
                'quot_sc_motorpower' => $fmpSpecs['quot_sc_motorpower'][$index] ?? null,
                'quot_fmt_dimension' => $fmpSpecs['quot_fmt_dimension'][$index] ?? null,
                'quot_fmt_volume' => $fmpSpecs['quot_fmt_volume'][$index] ?? null,
                'quot_fmt_motorpower' => $fmpSpecs['quot_fmt_motorpower'][$index] ?? null,
                'quot_equipment_weight' => $fmpSpecs['quot_equipment_weight'][$index] ?? null,
                'quot_operating_weight' => $fmpSpecs['quot_operating_weight'][$index] ?? null,
                'quot_work_time' => $fmpSpecs['quot_work_time'][$index] ?? null,
            ]);
        }
    }

    protected function createBfSpecs(int $productId, array $bfSpecs): void
    {
        foreach ($bfSpecs['type_name'] ?? [] as $index => $typeName) {
            Product_specification_bf::create([
                'product_id'      => $productId,
                'type_name'       => $typeName,
                'capacity'        => $bfSpecs['capacity'][$index] ?? null,
                'dimension_l'     => $bfSpecs['dimension_l'][$index] ?? null,
                'dimension_w'     => $bfSpecs['dimension_w'][$index] ?? null,
                'dimension_h'     => $bfSpecs['dimension_h'][$index] ?? null,
                'harga'           => $bfSpecs['harga'][$index] ?? 0,
            ]);
        }
    }
}
