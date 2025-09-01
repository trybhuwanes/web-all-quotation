<?php

namespace App\Services;

use App\Models\Centrals\Domain;
use App\Models\User;
use App\Traits\RowLimitTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserService
{
    protected Model $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function model(): User
    {
        return $this->model;
    }

    public function all(): Collection
    {
        $users = $this->model->all();

        return $users;
    }

    public function select2($filter): Builder
    {
        $data = $this->model()
                       ->select([
                           'id',
                           DB::raw('name as text'),
                       ])
                       ->when(count($filter), function ($q) use ($filter){
                            $q->where($filter);
                       })
                       ->limit(10);

        return $data;
    }

    public function select2pic($filter): Builder
    {
        $data = $this->model()
                    ->select([
                        'id',
                        DB::raw('name as text'),
                    ])
                    ->when(count($filter), function ($q) use ($filter) {
                            $q->where($filter);
                    })
                    ->where('role', 'pic')
                    ->limit(10);

        return $data;
    }

    public function filtering(array $filter = []): Builder
    {
        $search     = $filter['search'];
        $users = $this->model->where('role', '!=', 'admin')
                      ->when($search, function ($q) use ($search) {
                         $q->where(function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%")
                                ->orWhere('company', 'LIKE', "%{$search}%")
                                    ->orWhere('email', 'LIKE', "%{$search}%");
                         });
                      });

        return $users;
    }

    public function paginate(int $page): LengthAwarePaginator
    {
        $users = $this->model->paginate($page);

        return $users;
    }

    public function create(array $data): User
    {
        DB::beginTransaction();
        try {
            $data['is_active'] = $data['is_active'] == 'true' ? true : false;
            $locations = $data['locations'];
            unset($data['locations']);
            $data['password']   = bcrypt($data['password']);
            $user = $this->model->create($data);

            //Assign Roles
            $roles = $data['roles'] ?? [];
            $this->assignRoles($roles, $user);

            //Upload user photo
            if (array_key_exists('avatar', $data)) {
                $this->uploadAvatar($data['logo'], $user);
            }

            DB::commit();

            return $user;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \ErrorException($e->getMessage());
        }
    }

    public function assignRoles(array $roles, User $user): User
    {
        $user->syncRoles($roles);

        return $user;
    }

    public function getAssignedRoleNames(Model $user): Collection
    {
        return $user->getRoleNames();
    }

    public function show(int $id): User
    {
        return $this->model->find($id);
    }

    public function findMany(array $id): Collection
    {
        return $this->model->find($id);
    }

    public function update(array $data, User $user): User
    {
        // dd($data);
        DB::beginTransaction();
        try {
            // check if has file avatar
            // if (array_key_exists('avatar', $data)) {
            //     // upload avatar
            //     $this->uploadAvatar($data['avatar'], $user);
            // }

            // $data['is_active'] = $data['is_active'] == 'true' ? true : false;
            // // update user
            // $userData = collect($data)->only(['name', 'email', 'is_active'])->toArray();
            $userData = collect($data)->only(['name', 'email', 'job_title','company', 'field_company', 'detail_company', 'location_company', 'status',  ])->toArray();
            $user->update($userData);


            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    public function removeAvatar(User $user): HasMedia
    {
        return $user->clearMediaCollection(
            $this->getAvatarCollectionKey()
        );
    }

    public function uploadAvatar(UploadedFile $avatar, User $user): Media
    {
        $this->removeAvatar($user);

        return $user->addMedia($avatar)->toMediaCollection(
            $this->getAvatarCollectionKey()
        );
    }

    private function getAvatarCollectionKey(): string
    {
        return 'user-avatar';
    }

    public function destroy(User $user): bool
    {
        try {
            $user = $user->delete();

            return $user;
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    public function destroyMultiple(array $id): bool
    {
        try {
            $users = $this->findMany($id);
            foreach ($users as $user) {
                $user->delete();
            }

            return true;
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    public function updateLocationActive(array $data, User $user): bool
    {
        DB::beginTransaction();
        try {
            $user->update(['location_id' => $data['location_id']]);

            $user->locations()->where('location_id', $data['location_id'])->update(['status' => 'Aktif']);

            $user->locations()->whereNotIn('location_id', [$data['location_id']])->update(['status' => 'Tidak Aktif']);

            DB::commit();

            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }


}
