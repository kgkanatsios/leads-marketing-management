<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ValidationErrorException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'errors' => [
                'code' => 422,
                'title' => 'Validation Error',
                'detail' => 'Your request is malformed or missing fields.',
                'meta' => json_decode($this->getMessage()),
            ]
        ], 422);
    }
}
