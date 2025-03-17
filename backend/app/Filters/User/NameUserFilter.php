<?php

namespace App\Filters\User;

use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Filtro de usuários pelo nome.
 *
 * Esta classe aplica um filtro para buscar usuários cujo nome contenha um termo específico.
 *
 * @package App\Filters\User
 */
class NameUserFilter implements FilterInterface
{
    /**
     * @param string|null $name O nome ou parte do nome do usuário para filtrar a consulta.
     */
    public function __construct(
        public ?string $name,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function apply(Builder $query): Builder
    {
        if ($this->name) {
            return $query->where('name', 'like', '%' . $this->name . '%');
        }

        return $query;
    }
}
