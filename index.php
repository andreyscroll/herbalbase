<?php

use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', 'Controllers\HomeController');
$app->get('/category/{slug}', 'Controllers\CategoryController');
$app->get('/brand/{slug}', 'Controllers\BrandController');
$app->get('/{slug}', 'Controllers\ProductController');

$app->run();