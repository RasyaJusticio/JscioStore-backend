<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // Follows jsend spec for success responses
    public function success($data, $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], $status);
    }

    // Follows jsend spec for failed responses
    public function fail($data, $status = 422)
    {
        return response()->json([
            'status' => 'fail',
            'data' => $data,
        ], $status);
    }

    // Follows jsend spec for error responses
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
