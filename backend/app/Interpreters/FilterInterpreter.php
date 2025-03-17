<?php

namespace App\Interpreters;

use App\DTOs\FilterDTO;
use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FilterInterpreter
 *
 * Classe abstrata que interpreta e aplica filtros a partir de um DTO de filtro.
 * Responsável por converter os dados do DTO em instâncias de filtros e aplicar esses filtros
 * a uma consulta Eloquent.
 *
 * @package App\Interpreters
 */
abstract class FilterInterpreter
{
    /**
     * Mapeamento dos filtros disponíveis.
     *
     * Este mapa relaciona o nome do filtro com a respectiva classe de filtro.
     *
     * @var array
     */
    protected array $filterMap = [];

    /**
     * Interpreta os dados do DTO de filtro e cria as instâncias dos filtros correspondentes.
     *
     * Para cada propriedade do DTO que estiver presente, uma instância da classe de filtro associada
     * será criada e adicionada ao array de filtros.
     *
     * @param FilterDTO $filterDTO Dados do filtro a serem interpretados.
     * @return array Array de instâncias de filtros.
     */
    public function interpret(FilterDTO $filterDTO): array
    {
        $filters = [];

        foreach ($this->filterMap as $property => $filterClass) {
            if ($filterDTO->$property) {
                $filters[] = new $filterClass($filterDTO->$property);
            }
        }

        return $filters;
    }

    /**
     * Aplica os filtros a uma consulta Eloquent.
     *
     * Itera sobre os filtros fornecidos e os aplica na consulta, desde que a classe de filtro implemente
     * a interface FilterInterface.
     *
     * @param Builder $query Consulta Eloquent a ser modificada.
     * @param array $filters Array de filtros a serem aplicados.
     * @return Builder Consulta Eloquent modificada com os filtros aplicados.
     */
    public function applyFilters(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filter) {
            if ($filter instanceof FilterInterface) {
                $query = $filter->apply($query);
            }
        }

        return $query;
    }
}
