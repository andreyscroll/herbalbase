<?php

namespace Models;

class Brand extends Model
{
    public function getBrand($slug)
    {
        $stmt = $this->conn->prepare("SELECT * FROM brands WHERE `slug` = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }
}