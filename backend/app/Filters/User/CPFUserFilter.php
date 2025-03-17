<?php

namespace App\Filters\User;

use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Filtro de usuários pelo CPF.
 *
 * Esta classe aplica um filtro para buscar usuários pelo CPF na query.
 *
 * @package App\Filters\User
 */
class CPFUserFilter implements FilterInterface
{
    /**
     * @param string|null $cpf O CPF do usuário para filtrar a consulta.
     */
    public function __construct(
        public ?string $cpf,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function apply(Builder $query): Builder
    {
        if ($this->cpf) {
            return $query->where('cpf', $this->cpf);
        }

        return $query;
    }
}
