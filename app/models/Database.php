<?php

namespace Models;

class Database
{
    static private $pdo;

    static public function getConnection()
    {
        if(self::$pdo instanceof \PDO)
        {
            return self::$pdo;
        }

        self::$pdo = new \PDO('mysql:dbname=api_iherb;host=localhost;charset=utf8', 'root', 'root');
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        return self::$pdo;
    }
}

/*
class Database
{
    private $conn = null;

    public function __construct()
    {
        $this->conn = new \PDO('mysql:dbname=api_iherb;host=localhost;charset=utf8', 'root', 'root');
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
*/