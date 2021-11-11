<?php

namespace App\Traits;

trait ResponseAPI
{
    public function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        if (!$message) return response()->json(['message' => 'Message is required'], 500);

        if ($isSuccess) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $statusCode);
        } else {
            return response()->json([
                'success' => false,
                'message' => $message,
            ], $statusCode);
        }
    }

    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }
}