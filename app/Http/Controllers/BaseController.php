<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as IlluminateController;
class BaseController extends IlluminateController
{
    use AuthorizesRequests;
    function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    function sendErrorResponse($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'error' => $error,
        ];
        if(!empty($errorMessages)){
            $response['errorMessages'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
