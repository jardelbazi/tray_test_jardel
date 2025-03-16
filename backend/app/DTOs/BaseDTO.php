<?php

namespace App\DTOs;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

abstract class BaseDTO implements Arrayable
{
    public function toArray(): array
    {
        return collect(get_object_vars($this))
            ->mapWithKeys(fn($value, $key) => [Str::snake($key) => $value])
            ->toArray();
    }
}
