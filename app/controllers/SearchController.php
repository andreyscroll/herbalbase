<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Models\Category;
use Models\Product;

use Helpers\Validator;

class SearchController extends Controller
{
    public function __invoke(Request $request, Response $response)
    {
        $query = $request->getParsedBody()['search'];

        $searchData = [];
        $errors = [];

        if(Validator::validateSearchQuery($query)) {
            $searchData['products'] = (new Product)->search($searchKey);
            $searchData['categories'] = (new Category)->search($searchKey);
            $errors['status'] = false;
        } else {
            $errors['status'] = true;
            $errors['message'] = 'Ошибка! Запрос не может быть пустым или содержать меньше 3 символов.';
        }

        $body = $this->twig->render('search.twig', compact('searchKey', 'searchData', 'errors'));
        $response->getBody()->write($body);
        return $response;
    }
}