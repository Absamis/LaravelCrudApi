<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function jsonData($status, $message, $data = [], $errors = [], $httpCode = 200)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data,
            "errors" => $errors
        ], $httpCode);
    }
}
