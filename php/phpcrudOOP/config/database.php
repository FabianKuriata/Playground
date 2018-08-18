<?php
class Database {

    // crenentials
    private $host = "localhost";
    private $db_name = "php_crud_oop";
    private $username = "root";
    private $password = "";
    public $conn;

    // wykonaj polaczenie
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    
}