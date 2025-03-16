<?php

namespace App\Filters\User;

use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class CPFUserFilter implements FilterInterface
{
    public function __construct(
        public ?string $cpf,
    ) {}

    public function apply(Builder $query): Builder
    {
        if ($this->cpf) {
            return $query->where('cpf', $this->cpf);
        }

        return $query;
    }
}
