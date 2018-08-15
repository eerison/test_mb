<?php

namespace App\Service;


class HttpResponse
{
    public static function json($body, $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode($body);
    }
}