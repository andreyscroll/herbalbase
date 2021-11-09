<?php

namespace Models;

class Herb extends Model
{
    public function getHerbs()
    {
        $stmt = $this->conn->query("SELECT * FROM herbs LIMIT 32");
        return $stmt->fetchAll();
    }

    public function getHerb($slug)
    {
        $stmt = $this->conn->prepare("SELECT * FROM herbs WHERE `slug` = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    public function getHerbsByCategory($slug)
    {
        $stmt = $this->conn->prepare("SELECT `herbs`.*
                                        FROM `herbs` INNER JOIN `herb_herb_category`
                                        ON `herbs`.`id` = `herb_herb_category`.`herb_id`
                                        WHERE `herb_herb_category`.`herb_category_id` = (SELECT id FROM herb_categories WHERE `slug` = :slug LIMIT 1)");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetchAll();
    }
}