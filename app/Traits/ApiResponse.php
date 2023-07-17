<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * This function returns a JSON response with a specified status code and content type header.
     *
     * @param  mixed  $data The data that will be returned in the response body.
     * @param  int  $statusCode The statusCode parameter.
     * @return JsonResponse A JsonResponse object
     */
    public function successResponse(mixed $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $statusCode)->header('Content-Type', 'application/json');
    }

    /**
     * This function returns a JSON response with the provided data and HTTP status code.
     *
     * @param  mixed  $data The data parameter is the information that will be returned in the response body. I
     * @param  int  $statusCode The  HTTP status code to be returned in the response.
     * @return JsonResponse A JsonResponse object
     */
    public function dataResponse(mixed $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data], $statusCode)->header('Content-Type', 'application/json');
    }

    /**
     * This function returns a JSON response with a message and status code.
     *
     * @param  mixed  $message The message parameter
     * @param  int  $statusCode The statusCode parameter
     * @return JsonResponse A JSON response object
     */
    public function messageResponse(mixed $message, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['message' => $message], $statusCode)->header('Content-Type', 'application/json');
    }

    /**
     * This function returns a JSON response with an error message and status code.
     *
     * @param  string  $errorMessage The error message
     * @param  int  $statusCode The HTTP status code
     * @return JsonResponse A JSON response object
     */
    public function errorResponse(string $errorMessage, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json(['error' => $errorMessage], $statusCode);
    }

    /**
     * This function returns a JSON response with an error message and status code.
     *
     * @param  mixed  $errorMessage The error message
     * @param  int  $statusCode The HTTP status code
     * @return JsonResponse A JsonResponse object
     */
    public function errorMessage(mixed $errorMessage, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json($errorMessage, $statusCode)->header('Content-Type', 'application/json');
    }
}
