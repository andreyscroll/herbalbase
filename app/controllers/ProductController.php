<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Models\Category;
use Models\Product;

class ProductController extends Controller
{
    public function __invoke(Request $request, Response $response, array $args)
    {
        $slug = $args['slug'];

        $product = new Product();
        $productData = $product->getProductWithBrand($slug);
        $productCategories = $product->getProductCategories($slug);

        $body = $this->twig->render('product.twig', ['product' => $productData, 'productCategories' => $productCategories]);

        $response->getBody()->write($body);
        return $response;
    }
}