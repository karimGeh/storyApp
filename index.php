<?php

use app\controllers\Pages;
use app\controllers\User;
use app\controllers\Story;
use app\models\Database;
use app\router\Router;

require_once __DIR__ . '/vendor/autoload.php';

$db = new Database();
$router = new Router($db);


// ! gets
$router->get('/', [Pages::class, 'index']);
$router->get('/stories', [Pages::class, 'stories']);
$router->get('/writers', [Pages::class, 'writers']);
$router->get('/about', [Pages::class, 'about']);
$router->get('/contact', [Pages::class, 'contact']);

$router->get('/profile', [User::class, 'profile']);

$router->get('/create', [Story::class, 'create']);
// $router->get('/create/', [Story::class, 'create']);
$router->get('/edit/:storyId', [Story::class, 'edit']);

// ! posts
$router->post('/user/login', [User::class, 'login']);
$router->post('/user/register', [User::class, 'register']);
$router->post('/user/logout', [User::class, 'logout']);
$router->post('/user/updatePhoto', [User::class, 'updatePhoto']);

$router->post('/story/delete', [Story::class, 'delete']);
$router->post('/story/create', [Story::class, 'createStory']);
$router->post('/story/edit', [Story::class, 'editStory']);

// ! params
$router->params('/edit/:storyId', 'storsyId', [Story::class, 'id']);

$router->resolve();
