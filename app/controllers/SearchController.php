<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Models\Category;
use Models\Product;

use Helpers\Validator;
use Helpers\Str;

class SearchController extends Controller
{
    public function __invoke(Request $request, Response $response)
    {
        $query = Str::clearInput($request->getParsedBody()['search']);

        $searchData = [];
        $errors = [];

        if(Validator::validateSearchQuery($query)) {
            $searchData['products'] = (new Product)->search($query);
            $searchData['categories'] = (new Category)->search($query);
            $errors['status'] = false;
        } else {
            $errors['status'] = true;
            $errors['message'] = 'Некорректный запрос';
        }

        $body = $this->twig->render('search.twig', compact('query', 'searchData', 'errors'));
        $response->getBody()->write($body);
        return $response;
    }
}