<?php

namespace App\Interpreters\User;

use App\Filters\User\CPFUserFilter;
use App\Filters\User\NameUserFilter;
use App\Interpreters\FilterInterpreter;

/**
 * Class UserFilterInterpreter
 *
 * Interpreta os filtros específicos para o usuário, mapeando os campos de filtro
 * para suas respectivas classes de filtro.
 *
 * Extende a classe `FilterInterpreter`, que é responsável pela lógica de interpretação
 * dos filtros e sua aplicação no contexto do usuário.
 *
 * @package App\Interpreters\User
 */
class UserFilterInterpreter extends FilterInterpreter
{
    /**
     * Mapeamento dos filtros disponíveis para o usuário.
     *
     * Este mapa relaciona o nome do filtro com a respectiva classe de filtro.
     *
     * @var array
     */
    protected array $filterMap = [
        'name' => NameUserFilter::class,
        'cpf' => CPFUserFilter::class,
    ];
}
