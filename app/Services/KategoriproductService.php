<?php

namespace App\Services;

use App\Models\Category_product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Log;

class KategoriproductService
{
    protected Model $model;

    public function __construct(Category_product $categoryproduct)
    {
        $this->model = $categoryproduct;
    }

    public function model(): Category_product
    {
        return $this->model;
    }

    // Read
    public function all(): Collection
    {
        $categoryproduct = $this->model->all();
        return $categoryproduct;
    }

    // paginate
    public function paginate(int $page): LengthAwarePaginator
    {
        return $this->model->paginate($page);
    }

    // select two/2
    public function select2(): Builder
    {
        $categoryproduct = $this->model()
            ->select([
                'id',
                DB::raw('nama_kategori as text'),
            ])
            ->limit(10);

        return $categoryproduct;
    }

    // filter / Search
    public function filtering(array $filter = []): Builder
    {
        $search    = $filter['search'];
        $categoryproduct = $this->model
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nama_kategori', 'LIKE', "%{$search}%");
                });
            });

        return $categoryproduct;
    }

    // Create
    public function create($data): void
    {
        DB::beginTransaction();
        try {
            $category = $this->model->create($data);

            //Upload Logo
            if (array_key_exists('logo', $data)) {
                $this->uploadLogo($data['logo'], $category);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    // Show
    public function show(int $id): Category_product
    {
        return $this->model->findOrFail($id);
    }

    // Update
    public function update(array $data, Category_product $categoryproduct): Category_product
    {
        DB::beginTransaction();
        try {
            // Update kategori
            $categoryproduct->fill($data);
            $categoryproduct->save();

            if (array_key_exists('logo', $data)) {
                $this->uploadLogo($data['logo'], $categoryproduct);
            }

            DB::commit();
            return $categoryproduct;
        } catch (\Throwable $th) {
            DB::rollBack();  // Rollback jika ada kesalahan
            throw new \ErrorException($th->getMessage());
        }
    }

    // Delete
    public function destroy(Category_product $categoryproduct): bool
    {
        try {
            return $categoryproduct->delete();
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

    public function removeLogo(Category_product $categoryProduct): HasMedia
    {
        return $categoryProduct->clearMediaCollection(
            $this->getLogoCollectionKey()
        );
    }

    public function uploadLogo(UploadedFile $logo, Category_product $categoryProduct): Media
    {
        // Hapus logo lama
        $this->removeLogo($categoryProduct);

        // Upload logo baru
        $media = $categoryProduct->addMedia($logo)
                                ->toMediaCollection($this->getLogoCollectionKey(), 'public');

        // Simpan URL ke kolom 'logo'
        $categoryProduct->logo = $media->getUrl();
        $categoryProduct->save();

        return $media;
    }

    private function getLogoCollectionKey(): string
    {
        return 'category-product-logo';
    }
}