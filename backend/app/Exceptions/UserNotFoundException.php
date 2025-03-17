<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class UserNotFoundException
 *
 * Exceção personalizada para representar a ausência de um usuário no sistema.
 * Essa classe estende `NotFoundHttpException`, retornando um erro HTTP 404,
 * e registra automaticamente um log sempre que a exceção for lançada.
 *
 * @package App\Exceptions
 */
class UserNotFoundException extends NotFoundHttpException
{
    /**
     * Construtor da exceção UserNotFoundException.
     *
     * @param string $message Mensagem de erro descritiva.
     * @param int $code Código do erro HTTP (padrão: 404).
     * @param Exception|null $previous Exceção anterior para encadeamento (opcional).
     */
    public function __construct(
        string $message,
        int $code = 404,
        Exception $previous = null
    ) {
        parent::__construct(
            message: $message,
            code: $code,
            previous: $previous
        );

        Log::error('UserNotFoundException: ' . $message, [
            'code' => $code,
            'exception' => $previous
        ]);
    }
}
