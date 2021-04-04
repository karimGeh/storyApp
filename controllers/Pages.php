<?php

namespace app\controllers;

use app\router\Router;
use app\models\Database;


class Pages
{
    public static function index(Router $router)
    {
        $keyword = "";
        $stories = $router->database->loadFeaturedStories($keyword);
        $params = [
            "stories" => $stories,
            "title" => "Home | StoryApp"
        ];
        session_start();
        if (isset($_SESSION["params"])) {
            $params = array_merge($params, $_SESSION["params"]);
        }

        // echo '<pre>';
        // echo var_dump($params);
        // echo '</pre>';

        $router->renderView('pages/index', 'layouts/default', $params);
    }
    public static function stories(Router $router)
    {
        $params = [
            "title" => "Stories | StoryApp"
        ];
        $router->renderView('pages/stories', 'layouts/default', $params);
    }
    public static function writers(Router $router)
    {
        $params = [
            "title" => "Writes | StoryApp"
        ];
        $router->renderView('pages/writers', 'layouts/default', $params);
    }
    public static function about(Router $router)
    {
        $params = [
            "title" => "About | StoryApp"
        ];
        $router->renderView('pages/about', 'layouts/default', $params);
    }
    public static function contact(Router $router)
    {
        $params = [
            "title" => "Contact | StoryApp"
        ];
        $router->renderView('pages/contact', 'layouts/default', $params);
    }
}
