<?php

namespace App\Interpreters\User;

use App\Filters\User\CPFUserFilter;
use App\Filters\User\NameUserFilter;
use App\Interpreters\FilterInterpreter;

class UserFilterInterpreter extends FilterInterpreter
{
    protected array $filterMap = [
        'name' => NameUserFilter::class,
        'cpf' => CPFUserFilter::class,
    ];
}
