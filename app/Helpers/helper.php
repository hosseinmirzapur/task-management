<?php

use App\Exceptions\CustomException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

if (!function_exists('saveFile')) {
    /**
     * @param $file
     * @param string $path
     * @return string
     */
    function saveFile($file, string $path): string
    {
        $filename = time() . '_' . Str::random(5) . '_' . $file->getClientOriginalExtension();
        Storage::putFileAs($path, $file, $filename);
        return $path . '/' . $filename;
    }
}
