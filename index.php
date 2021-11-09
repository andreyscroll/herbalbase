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

$app->get('/', Controllers\HomeController::class);
$app->get('/category/{slug}', Controllers\CategoryController::class);
$app->get('/brand/{slug}', Controllers\BrandController::class);

$app->get('/herbs', Controllers\HerbController::class . ':index');
$app->get('/herbs/category/{slug}', Controllers\HerbController::class . ':showCategory');
$app->get('/herbs/{slug}', Controllers\HerbController::class . ':showHerb');

$app->post('/search', Controllers\SearchController::class);
$app->get('/{slug}', Controllers\ProductController::class);

$app->run();