<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class UserServiceException
 *
 * Exceção personalizada para erros relacionados ao serviço de usuários.
 * Essa classe estende `Exception` e registra automaticamente um log sempre que um erro ocorre,
 * facilitando a depuração e rastreamento de problemas no serviço de usuários.
 *
 * @package App\Exceptions
 */
class UserServiceException extends Exception
{
    /**
     * Construtor da exceção UserServiceException.
     *
     * @param string $message Mensagem de erro descritiva.
     * @param int $code Código do erro (padrão: 0).
     * @param Exception|null $previous Exceção anterior para encadeamento (opcional).
     */
    public function __construct(
        string $message,
        int $code = 0,
        Exception $previous = null
    ) {
        parent::__construct(
            message: $message,
            code: $code,
            previous: $previous
        );

        Log::error('UserServiceException: ' . $message, [
            'code' => $code,
            'exception' => $previous
        ]);
    }
}
