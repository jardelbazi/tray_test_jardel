<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class GoogleClientException
 *
 * Exceção personalizada para erros relacionados à comunicação com o cliente da API do Google.
 * Essa classe estende `Exception` e registra automaticamente um log sempre que um erro ocorre,
 * facilitando a depuração e rastreamento de problemas na integração com os serviços do Google.
 *
 * @package App\Exceptions
 */
class GoogleClientException extends Exception
{
    /**
     * Construtor da exceção GoogleClientException.
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

        Log::error('GoogleClientException: ' . $message, [
            'code' => $code,
            'exception' => $previous
        ]);
    }
}
