<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Models\Brand;
use Models\Product;

class BrandController extends Controller
{
    public function __invoke(Request $request, Response $response, array $args)
    {
        $slug = $args['slug'];

        $brand = (new Brand)->getBrand($slug);
        $products = (new Product)->getProductsByBrand($slug);

        // var_dump($brandWithProducts);

        // $productCategories = $product->getCategories($slug);

        $body = $this->twig->render('brand.twig', compact('brand', 'products'));
        $response->getBody()->write($body);
        return $response;
    }
}