<?php

namespace App\Services;

use App\Models\Revision_quot;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RevisionService
{
    protected Model $model;

    public function __construct(Revision_quot $revision_quot_quot)
    {
        $this->model = $revision_quot_quot;
    }

    public function model(): Revision_quot
    {
        return $this->model;
    }

    // Read
    public function all(): Collection
    {
        $revision_quot_quot = $this->model->all();
        return $revision_quot_quot;
    }

    // paginate
    public function paginate(int $page): LengthAwarePaginator
    {
        return $this->model->paginate($page);
    }

    // filter / Search
    public function filtering(array $filter = []): Builder
    {
        $search  = $filter['search'];
        $filterScope = $filter['scope'] ?? [];

        $revision_quot_quot = $this->model
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nama_produk', 'LIKE', "%{$search}%");
                });
            })
            ->when(!empty($filterScope), function ($q) use ($filterScope) {
                $q->whereIn('category_id', $filterScope);
            });

        return $revision_quot_quot;
    }

    // Create
    public function create($data)
    {
        return Revision_quot::create([
            'order_id' => $data['order_id'],
            'revision_number' => $data['revision_number'],
            'revision_description' => $data['revision_description'] ?? null,
        ]);
    }

    // Show by ID
    public function show(int $id): Revision_quot
    {
        return $this->model->findOrFail($id);
    }

    // Update
    public function update(array $data, Revision_quot $revision_quot_quot): Revision_quot
    {
        DB::beginTransaction();
        try {
            $revision_quot_quot->fill($data);
            $revision_quot_quot->save();

            DB::commit();
            return $revision_quot_quot;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    // Delete
    public function destroy(Revision_quot $revision_quot_quot): bool
    {
        try {
            return $revision_quot_quot->delete();
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

}