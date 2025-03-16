<?php

namespace App\Adapters\User;

use App\DTOs\User\UserFilterDTO;
use Illuminate\Http\Request;

interface UserFilterAdapterInterface
{
    public function fromRequest(Request $request): UserFilterDTO;
}
