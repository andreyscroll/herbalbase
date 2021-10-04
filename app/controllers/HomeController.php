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

        $body = $this->twig->render('index.twig', ['products' => $products]);

        $response->getBody()->write($body);
        return $response;
    }
}