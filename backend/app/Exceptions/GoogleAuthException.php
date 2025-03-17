<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class GoogleAuthException
 *
 * Exceção personalizada para erros relacionados à autenticação do Google.
 * Esta classe estende `Exception` e adiciona um log automático sempre que
 * uma exceção for lançada, facilitando a rastreabilidade dos erros de autenticação.
 *
 * @package App\Exceptions
 */
class GoogleAuthException extends Exception
{
    /**
     * Construtor da exceção GoogleAuthException.
     *
     * @param string $message Mensagem de erro descritiva.
     * @param int $code Código do erro (opcional, padrão: 0).
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

        Log::error('GoogleAuthException: ' . $message, [
            'code' => $code,
            'exception' => $previous
        ]);
    }
}
