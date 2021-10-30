<?php

namespace Models;

class Category extends Model
{
    public function getAll()
    {
        $stmt = $this->conn->query("SELECT name, slug FROM categories LIMIT 50");
        return $stmt->fetchAll();
    }

    public function getCategory(string $slug)
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE `slug` = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    public function getCategoriesByArray(array $list)
    {
        $categories = implode("', '", $list);
		$stmt = $this->conn->query("SELECT * FROM categories WHERE `slug` IN ('{$categories}') ORDER BY `slug` DESC");
        return $stmt->fetchAll();
    }

    /**
     * 
     *  Search categories
     */
    public function search($key)
    {
        $stmt = $this->conn->prepare("SELECT name, slug FROM categories WHERE `name` LIKE :key LIMIT 10");
        $key = "%{$key}%";
        $stmt->execute([':key' => $key]);
        return $stmt->fetchAll();
    }
}