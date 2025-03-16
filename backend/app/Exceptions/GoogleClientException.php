<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class GoogleClientException extends Exception
{
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
