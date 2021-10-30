<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Models\Category;
use Models\Product;

class HomeController extends Controller
{
    public function __invoke(Request $request, Response $response)
    {
        $categories = (new Category)->getCategoriesByArray(['syvorotki', 'resveratrol', 'khlorella']);
        $product = new Product;

        // Подгружаем для каждой категории соответствующие товары
        array_walk($categories, function(&$category) use ($product) {
            $category['products'] = $product->getProductsByCategory($category['slug'], 4);
        });

        $body = $this->twig->render('index.twig', compact('categories'));

        $response->getBody()->write($body);
        return $response;
    }
}