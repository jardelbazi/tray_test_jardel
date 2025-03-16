<?php

namespace App\Filters\User;

use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class NameUserFilter implements FilterInterface
{
    public function __construct(
        public ?string $name,
    ) {}

    public function apply(Builder $query): Builder
    {
        if ($this->name) {
            return $query->where('name', 'like', '%' . $this->name . '%');
        }

        return $query;
    }
}
