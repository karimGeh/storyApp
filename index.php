<?php

use app\controllers\User;
use app\models\Database;
use app\router\Router;

require_once __DIR__ . '/vendor/autoload.php';

$db = new Database();
$router = new Router($db);

$router->get('/', [User::class, 'index']);
$router->get('/stories', [User::class, 'stories']);
$router->get('/about', [User::class, 'about']);
$router->get('/contact', [User::class, 'contact']);

$router->resolve();
