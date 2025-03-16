<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
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
