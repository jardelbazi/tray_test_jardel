<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function create(User $user): User;

    public function getByGoogleId(string $gooleId): ?User;

    public function update(User $user, array $data): User;

    public function getAll(): Collection;
}
