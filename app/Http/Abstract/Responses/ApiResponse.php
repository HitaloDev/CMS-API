<?php

namespace App\Http\Abstract\Responses;

trait ApiResponse
{

    protected function successResponse(array $data = [], string $message = 'Success', int $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
    
    protected function errorResponse(string $message = 'An error occurred', array $errors = [], int $statusCode = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    protected function validationErrorResponse(array $errors, string $message = 'Validation failed', int $statusCode = 422): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'fail',
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}
