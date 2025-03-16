<?php

namespace App\Adapters\User;

use App\DTOs\User\UserFilterDTO;
use Illuminate\Http\Request;

class UserFilterAdapter implements UserFilterAdapterInterface
{
    public function fromRequest(Request $request): UserFilterDTO
    {
        return new UserFilterDTO(
            name: $request->name,
            cpf: $request->cpf
        );
    }
}
