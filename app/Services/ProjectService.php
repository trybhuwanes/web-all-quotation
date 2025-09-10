<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    protected Model $model;

    public function __construct(Project $project)
    {
        $this->model = $project;
    }

    public function model(): Project
    {
        return $this->model;
    }

    // Read
    public function all(): Collection
    {
        $project = $this->model->all();
        return $project;
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

        $project = $this->model
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('company_name', 'LIKE', "%{$search}%");
                });
            });
        // ->when(!empty($filterScope), function ($q) use ($filterScope) {
        //     $q->whereIn('category_id', $filterScope);
        // });

        return $project;
    }

    // Create
    // public function create($data): void
    // {
    //     DB::beginTransaction();
    //     try {
    //         $produk = $this->model->create($data);

    //         //Upload Gallery
    //         if (array_key_exists('files', $data)) {
    //             $this->addToGallery($data['files'], $produk);
    //         }
    //         DB::commit();
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         throw new \ErrorException($th->getMessage());
    //     }
    // }

    public function create($data): Project
    {
        DB::beginTransaction();
        try {
            $project = $this->model->create($data);

            if (array_key_exists('files', $data)) {
                $this->addToGallery($data['files'], $project);
            }

            DB::commit();
            return $project;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    // Show by ID
    public function show(int $id): Project
    {
        return $this->model->findOrFail($id);
    }

    // Update
    public function update(array $data, Project $project): Project
    {
        DB::beginTransaction();
        try {
            $project->fill($data);
            $project->save();

            // Hapus file lama kalau ada deleted_files[]
            if (!empty($data['deleted_files'])) {
                foreach ($data['deleted_files'] as $mediaId) {
                    $media = $project->media()->where('id', $mediaId)->first();
                    if ($media) {
                        $media->delete();
                    }
                }
            }
            // Upload gallery baru
            if (array_key_exists('files', $data)) {
                foreach ($data['files'] as $file) {
                    $project->addMedia($file)->toMediaCollection('project-gallery', 'public');
                }
            }

            DB::commit();
            return $project;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    // Delete
    // public function destroy(Project $project): bool
    // {
    //     try {
    //         return $project->delete();
    //     } catch (\Throwable $th) {
    //         throw new \ErrorException($th->getMessage());
    //     }
    // }
    public function destroy(Project $project): bool
    {
        DB::beginTransaction();
        try {
            $project->clearMediaCollection('project-gallery');
            $project->delete();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
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

    public function removeThumb(Project $project): HasMedia
    {
        return $project->clearMediaCollection(
            $this->getLogoCollectionKey()
        );
    }

    public function uploadThumb(UploadedFile $logo, Project $project): Media
    {
        $this->removeThumb($project);

        $media = $project->addMedia($logo)->toMediaCollection($this->getLogoCollectionKey(), 'public');
        $project->thumbnail = $media->getUrl();
        $project->save();

        return $media;
    }

    private function getLogoCollectionKey(): string
    {
        return 'product-thumbnail';
    }

    // GALERY
    public function removeGallery(Project $project): HasMedia
    {
        return $project->clearMediaCollection(
            $this->getGalleryCollectionKey()
        );
    }


    public function addToGallery(array $images, Project $project): void
    {
        DB::beginTransaction();
        try {

            $this->removeGallery($project);
            foreach ($images as $image) {
                $project->addMedia($image)->toMediaCollection($this->getGalleryCollectionKey(), 'public');
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    private function getGalleryCollectionKey(): string
    {
        return 'project-gallery';
    }
}
