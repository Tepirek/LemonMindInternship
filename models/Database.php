<?php

namespace App\models;

use PDO;
use PDOException;

class Database {

    protected $connection = NULL;

    public function connect() {
        if ($this->connection != NULL) return $this->connection;
        try {
            $this->connection = new PDO($_ENV['DSN'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

    protected function close() {
        if ($this->connection === NULL) return;
        $this->connection = NULL;
    }
}