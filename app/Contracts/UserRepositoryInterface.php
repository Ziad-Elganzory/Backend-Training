<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): ?User;
    public function update(array $data, int $id): int;
    public function delete(int $id):bool;
    public function find(int $id): ?User;
    public function paginatedUsers(int $pages): LengthAwarePaginator;
}