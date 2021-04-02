<?php

namespace app\controllers;

use app\router\Router;
use app\models\Database;


class User
{
    public static function index(Router $router)
    {
        $keyword = "";
        $stories = $router->database->loadFeaturedStories($keyword);
        $router->renderView('pages/index', 'layouts/default', [
            "stories" => $stories,
        ]);
    }
    public static function stories(Router $router)
    {
        $keyword = "";
        $stories = $router->database->loadFeaturedStories($keyword);
        $router->renderView('pages/stories', 'layouts/default', [
            "stories" => $stories,
        ]);
    }
    public static function about(Router $router)
    {
        $keyword = "";
        $stories = $router->database->loadFeaturedStories($keyword);
        $router->renderView('pages/about', 'layouts/default', [
            "stories" => $stories,
        ]);
    }
    public static function contact(Router $router)
    {
        $keyword = "";
        $stories = $router->database->loadFeaturedStories($keyword);
        $router->renderView('pages/contact', 'layouts/default', [
            "stories" => $stories,
        ]);
    }
}
