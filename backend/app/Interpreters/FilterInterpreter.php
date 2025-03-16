<?php

namespace App\Interpreters;

use App\DTOs\FilterDTO;
use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

abstract class FilterInterpreter
{
    protected array $filterMap = [];

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
