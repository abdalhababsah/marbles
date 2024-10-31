<?php

use Illuminate\Support\Arr;

if (!function_exists('apiResponse')) {
    function apiResponse($data = null, $message = null, $code = 200, $status = 0): object
    {
        $array = [
            'status' => $status === 0 && in_array($code, [200, 201, 202, 203, 422, 401, 404], true),
            'message' => $message,
            'data' => $data,
        ];
        return response($array, $code);
    }
}

if (!function_exists('getOtpFromSms')) {
    function getOtpFromSms($message): string|null
    {
        $otp = null;
        if ($message) {
            $decodedString = urldecode($message);


            if (preg_match('/\d+/', $decodedString, $matches)) {
                $otp = Arr::first($matches);
            }
        }
        return $otp;
    }
}
