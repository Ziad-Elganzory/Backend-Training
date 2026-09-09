<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Override;

class UserRepository implements UserRepositoryInterface
{
    #[Override]
    public function all(): Collection
    {
        return User::all();
    }
    #[Override]
    public function create(array $data): ?User
    {
        return User::create($data);
    }
    #[Override]
    public function update(array $data, int $id): int
    {
        $user = User::findOrFail($id);
        return $user->update($data);
    }
    #[Override]
    public function delete(int $id): bool
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
    #[Override]
    public function find(int $id): ?User
    {
        return User::find($id);
    }
    #[Override]
    public function paginatedUsers(int $pages): LengthAwarePaginator
    {
        return User::paginate($pages);
    }
}