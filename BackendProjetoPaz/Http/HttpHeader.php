<?php
namespace App\Backend\Http;

class HttpHeader {
    public static function setDefaultHeaders() {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
        header("Access-Control-Allow-Origin: $origin");
        header("Access-Control-Allow-Credentials: true");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    public static function sendNotAllowedMethod() {
        http_response_code(405);
        echo json_encode(["error" => "Método não permitido."]);
        exit;
    }
}

