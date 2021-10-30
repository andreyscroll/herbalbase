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

        // 404 handle
        if ($productData == false){
            $body = $this->twig->render('404.twig');
            $response->getBody()->write($body);
            return $response->withStatus(404);
        }

        $productData['categories'] = $product->getProductCategories($slug);

        $firstCategory = $productData['categories'][0];
        $productData['relatedProducts'] = $product->getProductsByCategory($firstCategory['slug'], 4);

        // dd($productData);

        $body = $this->twig->render('product.twig', compact('productData'));
        $response->getBody()->write($body);
        return $response;
    }
}