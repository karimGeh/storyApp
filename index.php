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
$router->get('/user/:userId', [User::class, 'visitUser']);

$router->get('/create', [Story::class, 'create']);
$router->get('/edit/:storyId', [Story::class, 'edit']);
$router->get('/story/:storyId', [Story::class, 'readStory']);
// $router->get('/create/', [Story::class, 'create']);


// ! posts
$router->post('/api/user/login', [User::class, 'login']);
$router->post('/api/user/register', [User::class, 'register']);
$router->post('/api/user/logout', [User::class, 'logout']);
$router->post('/api/user/updatePhoto', [User::class, 'updatePhoto']);

$router->post('/api/story/delete', [Story::class, 'delete']);
$router->post('/api/story/create', [Story::class, 'createStory']);
$router->post('/api/story/edit', [Story::class, 'editStory']);


// ! params
$router->params('/story/:storyId');
$router->params('/edit/:storyId');
$router->params('/user/:userId');

$router->resolve();
