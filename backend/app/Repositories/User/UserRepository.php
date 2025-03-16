<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function create(User $user): User
    {
        $user->save();
        return $user->fresh();
    }

    public function getByGoogleId(string $gooleId): ?User
    {
        return User::where('google_id', $gooleId)->first();
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function getAll(): Collection
    {
        return User::all();
    }
}
