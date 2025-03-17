<?php

namespace App\DTOs;

/**
 * Class FilterDTO
 *
 * Representa uma classe abstrata base para filtros. Esta classe serve como ponto de partida
 * para a criação de filtros específicos em outras classes DTO. Ela define a estrutura para os filtros
 * que serão usados em consultas ou buscas, permitindo que subclasses implementem suas lógicas específicas.
 *
 * Como é abstrata, não pode ser instanciada diretamente e deve ser estendida por outras classes
 * que definem filtros concretos.
 *
 * @package App\DTOs
 */

abstract class FilterDTO {}
