<?php

namespace App\controllers;

use App\class\Mailer;
use App\models\TransportModel;

class TransportController extends Controller {

    private $model;
    private $requestMethod;

    public function __construct($requestMethod) {
        $this->model = new TransportModel();
        $this->requestMethod = $requestMethod;
    }

    public function handleRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $transports = $this->model->findAll();
                $response = $this->buildResponse(200, $transports);
                echo '<pre>';
                print_r(json_decode($response));
                echo '</pre>';
                break;
            case 'POST':
                $cargoController = new CargoController($this->requestMethod);
                $cargos = $cargoController->validateInput();
                $data = $this->validateInput();
                if ($cargos === false || $data === false) {
                    $response = $this->buildResponse(409, [
                        'message' => 'przesłane dane są niepoprawne'
                    ]);
                } else {
                    $_POST['transport_id'] = $this->model->insert($data);
                    $cargoController->handleRequest();
                    $cargoContent = '';
                    foreach ($cargos as $cargo) {
                        $cargoContent .= sprintf("
                        <tr>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                        </tr>
                    ", $cargo['name'], $cargo['weight'], $cargo['type']);
                    }
                    $body = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../../templates/emailTemplate.html');
                    $body = str_replace(['SOURCE', 'DESTINATION', 'TYPE', 'DATE', 'CARGO_CONTENT'], [$data['source'], $data['destination'], $data['type'], $data['date'], $cargoContent], $body);
                    $mailer = new Mailer(
                        'tepirek@gmail.com',
                        'Arkadiusz Tepper',
                        'Transport No. ' . $_POST['transport_id'],
                        $body,
                        $data['files']
                    );
                    $mailer->send();
                }
                break;
            case 'PUT':
                break;
            case 'DELETE':
                break;
            case 'OPTIONS':
                header('Content-type:application/json;charset=utf-8');
                http_response_code(200);
                echo json_encode([]);
                break;
        }
    }

    private function validateInput() {
        $source = (isset($_POST['source'])) ? $this->secureInput($_POST['source']) : '';
        $destination = (isset($_POST['destination'])) ? $this->secureInput($_POST['destination']) : '';
        $type = (isset($_POST['type'])) ? $this->secureInput($_POST['type']) : '';
        $date = (isset($_POST['date'])) ? $this->secureInput($_POST['date']) : '';

        $validSource = !empty($source);
        $validDestination = !empty($destination);
        $validType = in_array($type, ['Airbus A380', 'Boeing 747']);
        $validDate = $this->validDate($date);
        $validFiles = $this->validFileExtensions();

        if (
            $validSource &&
            $validDestination &&
            $validType &&
            $validDate &&
            $validFiles
        ) {
            $files = $this->uploadFiles();
            return array(
                'source' => $source,
                'destination' => $destination,
                'type' => $type,
                'date' => $date,
                'files' => $files
            );
        } else return false;
    }

    private function uploadFiles() {
        if (!isset($_FILES['files'])) return [];
        $f = $_FILES['files'];
        $files = [];
        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
            $file = array(
                'name' => $f['name'][$i],
                'type' => $f['type'][$i],
                'tmp_name' => $f['tmp_name'][$i],
                'error' => $f['error'][$i],
                'size' => $f['size'][$i]
            );
            $pathinfo = pathinfo($file['name']);
            $hash = uniqid(md5($file['name']));
            $path = $_SERVER['DOCUMENT_ROOT'] . '/../../uploads/' . $hash . '_' . $pathinfo['basename'];
            move_uploaded_file($file['tmp_name'], $path);
            $files[] = $path;
        }
        return $files;
    }

    private function validFileExtensions(): bool {
        if (!isset($_FILES['files'])) return true;
        $valid = [
            'application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'image/png',
            'image/jpeg'
        ];
        foreach ($_FILES['files']['type'] as $type) {
            if (!in_array($type, $valid)) return false;
        }
        return true;
    }

    private function validDate($date): bool {
        $currentDate = time();
        if (($date = strtotime($date)) === false) return false;
        if ($currentDate > $date) return false;
        return true;
    }
}