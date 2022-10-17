<?php 

namespace App\http\Helpers;

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
}