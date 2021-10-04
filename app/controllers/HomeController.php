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
        $products = (new Product())->getBestsellers();

        var_dump($products);
        exit();

        //     $response->getBody()->write("Hello world!");
        //     return $response;
    }
}