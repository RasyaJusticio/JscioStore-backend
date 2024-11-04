<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Returns a standardized JSON success response.
     *
     * This function generates a JSON response with a "success" status, a message, 
     * optional data, and an HTTP status code.
     *
     * @param string $message A message describing the success.
     * @param mixed|null $data Optional data to include in the response. Default is null.
     * @param int $status The HTTP status code for the response. Default is 200.
     * @return \Illuminate\Http\JsonResponse JSON response with a success status, message, and optional data.
     */
    public function success($message = "Success", $data = null, $status = 200)
    {
        $response = collect()
            ->put('status', 'success')
            ->put('message', $message);

        if ($data) {
            $response->put('data', $data);
        }

        return response()->json($response->toArray(), $status);
    }

    /**
     * Returns a standardized JSON failure response.
     *
     * This function generates a JSON response with a "fail" status, a message,
     * optional data, and an HTTP status code.
     *
     * @param string $message A message describing the failure.
     * @param mixed|null $data Optional data to include in the response. Default is null.
     * @param int $status The HTTP status code for the response. Default is 422.
     * @return \Illuminate\Http\JsonResponse JSON response with a fail status, message, and optional data.
     */
    public function fail($message, $data = null, $status = 422)
    {
        $response = collect()
            ->put('status', 'fail')
            ->put('message', $message);

        if ($data) {
            $response->put('data', $data);
        }

        return response()->json($response->toArray(), $status);
    }

    /**
     * Returns a standardized JSON error response.
     *
     * This function generates a JSON response with an "error" status, a message,
     * optional data, an error code, and an HTTP status code.
     *
     * @param string $message A message describing the error.
     * @param mixed|null $data Optional data to include in the response. Default is null.
     * @param int|null $code An optional custom error code. Default is null.
     * @param int $status The HTTP status code for the response. Default is 500.
     * @return \Illuminate\Http\JsonResponse JSON response with an error status, message, optional data, and error code.
     */
    public function error($message, $data = null, $code = null, $status = 500)
    {
        $response = collect()
            ->put('status', 'error')
            ->put('message', $message);

        if ($data) {
            $response->put('data', $data);
        }
        if ($code) {
            $response->put('code', $code);
        }

        return response()->json($response->toArray(), $status);
    }
}
