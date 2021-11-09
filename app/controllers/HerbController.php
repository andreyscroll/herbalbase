<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Models\HerbCategory;
use Models\Herb;

class HerbController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $herbs = (new Herb)->getHerbs();
        $categories = (new HerbCategory)->getCategories();

        $body = $this->twig->render('herbs/index.twig', compact('herbs', 'categories'));
        $response->getBody()->write($body);
        return $response;
    }

    public function showHerb(Request $request, Response $response, $args)
    {
        $slug = $args['slug'];

        $herb = (new Herb)->getHerb($slug);
        $herbCategories = (new HerbCategory)->getCategoriesByHerb($slug);

        $body = $this->twig->render('herbs/item.twig', compact('herb', 'herbCategories'));
        $response->getBody()->write($body);
        return $response;
    }

    public function showCategory(Request $request, Response $response, $args)
    {
        $slug = $args['slug'];
        $herbCategory = new HerbCategory();

        $category = $herbCategory->getCategory($slug);
        $herbsByCategory = (new Herb)->getHerbsByCategory($slug);
        $categories = $herbCategory->getCategories();

        $body = $this->twig->render('herbs/category.twig', compact('category', 'herbsByCategory', 'categories'));
        $response->getBody()->write($body);
        return $response;
    }
}