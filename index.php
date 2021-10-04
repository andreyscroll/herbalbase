<?php

use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

// $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/resources/views');
// $twig = new \Twig\Environment($loader, ['cache' => false]);

$app = AppFactory::create();

$app->get('/', 'Controllers\HomeController');
$app->get('/rating/{slug}', 'Controllers\CategoryController');
$app->get('/{slug}', 'Controllers\ProductController');

$app->run();