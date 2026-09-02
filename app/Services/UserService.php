<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ){}

    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function update(array $data, int $id): int
    {
        return $this->userRepository->update($data,$id);
    }
    public function delete(int $id): int
    {
        return $this->userRepository->delete($id);
    }
    public function all(): Collection
    {
        return $this->userRepository->all();
    }
    public function find(int $id): ?User
    {
        return $this->userRepository->find($id);
    }
}