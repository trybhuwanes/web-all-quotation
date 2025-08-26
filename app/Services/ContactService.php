<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ContactService
{
    protected Model $model;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    public function model(): Contact
    {
        return $this->model;
    }

    // Read
    public function all(): Collection
    {
        $contact = $this->model->all();
        return $contact;
    }

    // paginate
    public function paginate(int $page): LengthAwarePaginator
    {
        return $this->model->paginate($page);
    }

    // select two/2
    public function select2(): Builder
    {
        $contact = $this->model()
            ->select([
                'id',
                DB::raw('nama_kategori as text'),
            ])
            ->limit(10);

        return $contact;
    }

    // filter / Search
    public function filtering(array $filter = []): Builder
    {
        $search    = $filter['search'];
        $contact = $this->model
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nama_kategori', 'LIKE', "%{$search}%");
                });
            });

        return $contact;
    }

    // Create
    public function create($data): void
    {
        DB::beginTransaction();
        try {
            $this->model->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    // Show
    public function show(int $id): Contact
    {
        return $this->model->findOrFail($id);
    }

    // Update
    public function update(array $data, Contact $contact): bool
    {
        try {
            return $contact->update($data);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    // Delete
    public function destroy(Contact $contact): bool
    {
        try {
            return $contact->delete();
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

}