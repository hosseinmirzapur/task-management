<?php

namespace App\Helpers;


use Illuminate\Http\JsonResponse;

if (!function_exists('successResponse')) {
    /**
     * @param $data
     * @param $message
     * @param int $status
     * @return JsonResponse
     */
    function successResponse($data = null, $message = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ]);
    }
}
