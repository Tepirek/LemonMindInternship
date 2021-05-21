CREATE DATABASE IF NOT EXISTS lemonmind;
USE lemonmind;
CREATE TABLE IF NOT EXISTS transports (
    transport_id INT AUTO_INCREMENT PRIMARY KEY,
    transport_from TEXT NOT NULL,
    transport_to TEXT NOT NULL,
    transport_type TEXT NOT NULL CHECK (transport_type IN ('Airbus A380', 'Boeing 747')),
    transport_date TIMESTAMP,
    transport_files JSON,
    creted_at TIMESTAMP
);
CREATE TABLE IF NOT EXISTS cargos (
    cargo_id INT AUTO_INCREMENT PRIMARY KEY,
    cargo_name TEXT NOT NULL,
    cargo_weight FLOAT CHECK (cargo_weight > 0),
    cargo_type TEXT NOT NULL CHECK(cargo_type IN ('normal', 'dangerous')),
    cargo_transport_id INT NOT NULL,
    creted_at TIMESTAMP
);