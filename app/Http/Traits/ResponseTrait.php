<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function errors(int $code = 422, string $message = "Invalid fields", mixed $errors = null): JsonResponse
    {
        $response = [
            "message" => $message,
        ];
        if ($errors) $response["errors"] = $errors;

        return response()->json(data: $response, status: $code);
    }

    public function success(int $code = 200, $message = "Success", mixed $data = null): JsonResponse
    {
        $response = [
            "message" => $message,
        ];

        if ($data) $response["data"] = $data;

        return response()->json(data: $response, status: $code);
    }
}
