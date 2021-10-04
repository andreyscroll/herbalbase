<?php

namespace Models;

class Database
{
    private $conn = null;

    public function __construct()
    {
        $this->conn = new \PDO('mysql:dbname=api_iherb;host=localhost', 'root', 'root');
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}