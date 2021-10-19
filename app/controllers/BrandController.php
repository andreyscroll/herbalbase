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

        // 404 handle
        if ($brand == false){
            $body = $this->twig->render('404.twig');
            $response->getBody()->write($body);
            return $response->withStatus(404);
        }

        $products = (new Product)->getProductsByBrand($slug);

        $body = $this->twig->render('brand.twig', compact('brand', 'products'));
        $response->getBody()->write($body);
        return $response;
    }
}