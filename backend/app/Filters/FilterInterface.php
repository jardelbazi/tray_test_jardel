<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface para filtros aplicáveis a consultas Eloquent.
 *
 * Todas as classes que implementam esta interface devem definir o método `apply`
 * para modificar uma `Builder` query com critérios específicos.
 *
 * @package App\Filters
 */
interface FilterInterface
{
    /**
     * Aplica o filtro à consulta Eloquent.
     *
     * @param Builder $query A consulta que será filtrada.
     * @return Builder A consulta modificada com os critérios do filtro aplicados.
     */
    public function apply(Builder $query): Builder;
}
