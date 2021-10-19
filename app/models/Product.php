<?php

namespace Models;

class Product extends Model
{
    public function getBestsellers()
    {
        $stmt = $this->conn->query("SELECT * FROM products WHERE `rating` = 5 LIMIT 20");
        return $stmt->fetchAll();
    }

    public function getProductWithBrand($slug)
    {
        $stmt = $this->conn->prepare("SELECT `products`.*, 
                                            `brands`.`name` as brand_name,
                                            `brands`.`slug` as brand_slug,
                                            `brands`.`name_rus` as brand_name_rus
                                        FROM `products` INNER JOIN `brands`
                                        ON `products`.`brand_id` = `brands`.`id`
                                        WHERE `products`.`slug` = :slug");

        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    /**
     * Get all categories by product
     * 
     */
    public function getProductCategories($slug)
    {
        $stmt = $this->conn->prepare("SELECT `categories`.*, 
                                            `product_category`.`product_id`,
                                            `product_category`.`category_id`
                                        FROM `categories` INNER JOIN `product_category`
                                        ON `categories`.`id` = `product_category`.`category_id`
                                        WHERE `product_category`.`product_id` = (SELECT id FROM products WHERE `slug` = :slug LIMIT 1)");

        $stmt->execute([':slug' => $slug]);
        return $stmt->fetchAll();
    }

    /**
     * Get products by brand
     *
     */
    public function getProductsByBrand($slug)
    {
        $stmt = $this->conn->prepare("SELECT `products`.*
                                        FROM `brands` INNER JOIN `products` ON `brands`.`id` = `products`.`brand_id`
                                        WHERE `brands`.`slug` = :slug
                                        ORDER BY `products`.`rating` DESC, `products`.`reviews_count` DESC");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetchAll();
    }

    /**
     * Get products by category
     * 
     */
    public function getProductsByCategory($slug)
    {
        $stmt = $this->conn->prepare("SELECT `products`.*, 
                                            `product_category`.`product_id`,
                                            `product_category`.`category_id`
                                        FROM `products` INNER JOIN `product_category`
                                        ON `products`.`id` = `product_category`.`product_id`
                                        WHERE `product_category`.`category_id` = (SELECT id FROM categories WHERE `slug` = :slug LIMIT 1)
                                        ORDER BY `products`.`rating` DESC, `products`.`reviews_count` DESC");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetchAll();
    }
}