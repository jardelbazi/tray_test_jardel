<?php

namespace App\Repositories\User;

use App\DTOs\User\UserFilterDTO;
use App\Interpreters\User\UserFilterInterpreter;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private UserFilterInterpreter $filterInterpreter,
    ) {}

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

    public function getAll(?UserFilterDTO $userFilterDTO = null): Collection
    {
        $query = User::query();

        if ($userFilterDTO) {
            $filters = $this->filterInterpreter->interpret($userFilterDTO);
            $query = $this->filterInterpreter->applyFilters($query, $filters);
        }

        return $query->get();
    }
}
