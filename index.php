<?php

use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

function dd($arr)
{
	echo "<pre>";
	var_dump($arr);
    echo "</pre>";
    exit();
}

$app = AppFactory::create();

$app->get('/', 'Controllers\HomeController');
$app->get('/category/{slug}', 'Controllers\CategoryController');
$app->get('/brand/{slug}', 'Controllers\BrandController');
$app->post('/search', 'Controllers\SearchController');
$app->get('/{slug}', 'Controllers\ProductController');

$app->run();