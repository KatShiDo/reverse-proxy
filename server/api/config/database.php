<?php

class Database
{
    private $host = 'db';
    private $db_name = 'appDB';
    private $username = 'user';
    private $password = 'password';
    public $conn;

    public function getConnection()
    {
        return new mysqli($this->host, $this->username, $this->password, $this->db_name);

        /*$this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;*/
    }
}