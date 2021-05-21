<?php

namespace App\controllers;

use App\models\CargoModel;

class CargoController extends Controller {

    private $model;
    private $requestMethod;

    public function __construct($requestMethod) {
        $this->model = new CargoModel();
        $this->requestMethod = $requestMethod;
    }

    public function handleRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $cargos = $this->model->findAll();
                echo '<pre>';
                print_r($cargos);
                echo '</pre>';
                break;
            case 'POST':
                $cargos = json_decode($_POST['cargos'], true);
                foreach ($cargos as $cargo) {
                    $data = array(
                        'name' => $cargo['name'],
                        'weight' => $cargo['weight'],
                        'type' => $cargo['type'],
                        'transport_id' => $_POST['transport_id']
                    );
                    $this->model->insert($data);
                }
                break;
        }
    }

    public function validateInput() {
        if (empty(json_decode($_POST['cargos']))) return true;
        $cargos = json_decode($_POST['cargos'], true);
        foreach ($cargos as $cargo) {
            $name = isset($cargo['name']) ? $this->secureInput($cargo['name']) : '';
            $weight = isset($cargo['weight']) ? $this->secureInput($cargo['weight']) : '';
            $type = isset($cargo['type']) ? $this->secureInput($cargo['type']) : '';
            $airplaneType = (isset($_POST['type'])) ? $this->secureInput($_POST['type']) : '';
            $validName = !empty($name);
            $validWeight = ($airplaneType === 'Airbus A380' && $weight > 35000) ? false : (($airplaneType === 'Boeing 747' && $weight > 38000) ? false : true);
            $validType = in_array($type, ['normal', 'dangerous']);

            if ($validName && $validWeight && $validType) return true;
            return false;
        }
    }
}