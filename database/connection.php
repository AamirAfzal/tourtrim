<?php

class Database {
    private static $instance = null;
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "webapp";

    private function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
    }
    private function __clone() {
        return false;
    }
    private function __wakeup() {
        return false;
    }
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getConnection() {
        return $this->conn;
    }
    public function closeConnection(){
        $this->conn->close();
    }
}

?>