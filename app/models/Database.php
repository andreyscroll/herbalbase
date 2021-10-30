<?php

namespace Models;

use PDO;

class Database
{
    private static $pdo;

    static public function getConnection()
    {
        if(self::$pdo instanceof PDO)
        {
            return self::$pdo;
        }

        self::$pdo = new PDO('mysql:dbname=api_iherb;host=localhost;charset=utf8', 'root', 'root');
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return self::$pdo;
    }
}
