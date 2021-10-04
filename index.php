<?php

use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', 'Controllers\HomeController');
$app->get('/rating/{slug}', 'Controllers\CategoryController');
$app->get('/{slug}', 'Controllers\ProductController');

$app->run();