<?php

namespace App\http\Helpers;

use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;

class ApiResponse {
    public static function success($message,$code,$data){
        return [
            "status" => "success",
            "message" => $message,
            "data" => $data,
            "code" => $code,
        ];
    }

    public static function fail($message,$code,$errors){
        return [
            'status' => "fail",
            "message" => $message,
            "errors" => $errors,
            "code" => $code,
        ];
    }

    public static function validatorFail($validator){
        return self::fail("Validation error",401,$validator->errors()->all());
    }
}
