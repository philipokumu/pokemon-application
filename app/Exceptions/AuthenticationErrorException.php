<?php

namespace App\Exceptions;

use Exception;

class AuthenticationErrorException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'errors'=> [
                'code' => 401,
                'title' => 'Authentication error',
                'detail' => 'Unauthenticated',
            ]
        ], 401);
    }
}
