<?php

namespace App\models;

use App\models\Database;
use PDOException;

class TransportModel extends Database {

    public function __construct() {
        parent::connect();
    }

    public function findAll() {
        $query = "SELECT * FROM transports";
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
        $query = "INSERT INTO transports VALUES (
            :id,
            :source,
            :destination,
            :type,
            :date,
            :files,
            :created_at
        )";
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute(array(
                'id' => NULL,
                'source' => $data['source'],
                'destination' => $data['destination'],
                'type' => $data['type'],
                'date' => date('Y-m-d H:i:s', strtotime($data['date'])),
                'files' => json_encode($data['files']),
                'created_at' => date('Y-m-d H:i:s', time())
            ));
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            exit(1);
        }
    }
}