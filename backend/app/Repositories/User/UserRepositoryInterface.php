<?php

namespace App\Repositories\User;

use App\DTOs\User\UserFilterDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function create(User $user): User;

    public function getByGoogleId(string $gooleId): ?User;

    public function update(User $user, array $data): User;

    public function getAll(?UserFilterDTO $userFilterDTO = null, int $perPage = 50): LengthAwarePaginator;
}
