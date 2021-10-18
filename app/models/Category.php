<?php

namespace Models;

class Category extends Model
{
    public function getCategories()
    {
        $stmt = $this->conn->query("SELECT name, slug FROM categories LIMIT 10");
        return $stmt->fetchAll();
    }

    public function getCategory($slug)
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE `slug` = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }
}