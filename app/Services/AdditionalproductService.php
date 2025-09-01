<?php

namespace App\Services;

use App\Models\Additional_product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Log;

class AdditionalproductService
{
    protected Model $model;

    public function __construct(Additional_product $additionalproduct)
    {
        $this->model = $additionalproduct;
    }

    public function model(): Additional_product
    {
        return $this->model;
    }

    // Read
    public function all(): Collection
    {
        $additionalproduct = $this->model->all();
        return $additionalproduct;
    }

    // paginate
    public function paginate(int $page): LengthAwarePaginator
    {
        return $this->model->paginate($page);
    }

    // select two/2
    public function select2(): Builder
    {
        $additionalproduct = $this->model()
            ->select([
                'id',
                DB::raw('nama_produk_tambahan as text'),
            ])
            ->limit(10);

        return $additionalproduct;
    }

    // filter / Search
    public function filtering(array $filter = []): Builder
    {
        $search  = $filter['search'];

        $additionalproduct = $this->model
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nama_produk_tambahan', 'LIKE', "%{$search}%");
                });
            });
        // dd($additionalproduct);
            
        return $additionalproduct;
    }

    // Create
    public function create($data): void
    {
        DB::beginTransaction();
        try {
            $additionalproduct = $this->model->create($data);

            if (array_key_exists('thumbnail_produk_tambahan', $data)) {
                $this->uploadThumb($data['thumbnail_produk_tambahan'],  $additionalproduct);
            }

            //Upload Gallery
            // if (array_key_exists('files', $data)) {
            //     $this->addToGallery($data['files'], $additionalproduct);
            // }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    // Show
    public function show(int $id): Additional_product
    {
        return $this->model->findOrFail($id);
    }

    // Update
    public function update(array $data, Additional_product  $additionalproduct): Additional_product
    {
        DB::beginTransaction();
        try {
             $additionalproduct->fill($data);
             $additionalproduct->save();

            if (array_key_exists('thumbnail_produk_tambahan', $data)) {
                $this->uploadThumb($data['thumbnail_produk_tambahan'],  $additionalproduct);
            }

            //Upload Gallery
            // if (array_key_exists('files', $data)) {
            //     $this->addToGallery($data['files'], $additionalproduct);
            // }

            DB::commit();
            return  $additionalproduct;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    // Delete
    public function destroy(Additional_product $additionalproduct): bool
    {
        try {
            return $additionalproduct->delete();
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

    public function removeThumb(Additional_product $additionalproduct): HasMedia
    {
        return $additionalproduct->clearMediaCollection(
            $this->getLogoCollectionKey()
        );
    }

    public function uploadThumb(UploadedFile $logo, Additional_product $additionalproduct): Media
    {
        $this->removeThumb($additionalproduct);

        $media = $additionalproduct->addMedia($logo)->toMediaCollection($this->getLogoCollectionKey(), 'public');
        $additionalproduct->thumbnail_produk_tambahan = $media->getUrl();
        $additionalproduct->save();

        return $media;
    }

    private function getLogoCollectionKey(): string
    {
        return 'additional-product-thumbnail';
    }

    // GALERY
    public function removeGallery(Additional_product $additionalproduct): HasMedia
    {
        return $additionalproduct->clearMediaCollection(
            $this->getGalleryCollectionKey()
        );
    }


    public function addToGallery(array $images, Additional_product $additionalproduct): void
    {
        DB::beginTransaction();
        try {

            $this->removeGallery($additionalproduct);
            foreach ($images as $image) {
                $additionalproduct->addMedia($image)->toMediaCollection($this->getGalleryCollectionKey(), 'public');
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    private function getGalleryCollectionKey(): string
    {
        return 'additional-product-gallery';
    }
}