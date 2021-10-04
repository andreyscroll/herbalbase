<?php

namespace Models;

class Product extends Model
{
    public function getBestsellers()
    {
        $stmt = $this->conn->query("SELECT * FROM products WHERE `rating` = 5 LIMIT 20");
        return $stmt->fetchAll();
    }

    public function getProduct()
    {
        
    }
}