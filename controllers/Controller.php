<?php

namespace App\controllers;

class Controller {

    protected function secureInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function buildResponse($code, $body) {
        $header = '';
        switch ($code) {
            case '200':
                $header = 'HTTP/1.1 200 OK';
                break;
            case '201':
                $header = 'HTTP/1.1 201 Created';
                break;
            case '404':
                $header = 'HTTP/1.1 404 Not Found';
                break;
            case '409':
                $header = 'HTTP/1.1 409 Conflict';
                break;
        }
        header($header);
        $response = json_encode($body);
        return $response;
    }
}