<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Models\Category;
use Models\Product;

class CategoryController extends Controller
{
    public function __invoke(Request $request, Response $response, array $args)
    {
        $slug = $args['slug'];

        $category = (new Category)->getCategory($slug);

        // 404 handle
        if ($category == false){
            $body = $this->twig->render('404.twig');
            $response->getBody()->write($body);
            return $response->withStatus(404);
        }

        $products = (new Product)->getProductsByCategory($slug);

        $body = $this->twig->render('category.twig', compact('category', 'products'));

        $response->getBody()->write($body);
        return $response;
    }
}