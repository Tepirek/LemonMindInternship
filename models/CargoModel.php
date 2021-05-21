<?php

namespace App\models;

use PDOException;

class CargoModel extends Database {

    public function __construct() {
        parent::connect();
    }

    public function findAll() {
        $query = "SELECT * FROM cargos";
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            exit(1);
        }
    }

    public function insert($data) {
        $query = "INSERT INTO cargos VALUES (
            :id,
            :name,
            :weight,
            :type,
            :transport_id,
            :created_at
        )";
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute(array(
                'id' => NULL,
                'name' => $data['name'],
                'weight' => $data['weight'],
                'type' => $data['type'],
                'transport_id' => $data['transport_id'],
                'created_at' => date('Y-m-d H:i:s', time())
            ));
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            exit(1);
        }
    }
}