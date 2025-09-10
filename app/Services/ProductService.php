<?php

namespace App\Services;

use App\Models\Product;
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
}
