<?php

namespace Models;

class HerbCategory extends Model
{
    public function getCategories()
    {
        $stmt = $this->conn->query("SELECT * FROM herb_categories");
        return $stmt->fetchAll();
    }

    public function getCategory($slug)
    {
        $stmt = $this->conn->prepare("SELECT * FROM herb_categories WHERE `slug` = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    public function getCategoriesByHerb($slug)
    {
        $stmt = $this->conn->prepare("SELECT `herb_categories`.*
                                    FROM `herb_categories` INNER JOIN `herb_herb_category`
                                    ON `herb_categories`.`id` = `herb_herb_category`.`herb_category_id`
                                    WHERE `herb_herb_category`.`herb_id` = (SELECT id FROM herbs WHERE `slug` = :slug LIMIT 1)");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetchAll();
    }
}