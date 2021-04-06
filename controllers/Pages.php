<?php

namespace app\controllers;


use app\router\Router;
use app\models\Database;
use app\controllers\User;


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

        $user = User::isAuth($router->database);

        $params['user'] = $user;

        // echo '<pre>';
        // echo var_dump($params);
        // echo '</pre>';

        $router->renderView('pages/index', 'layouts/default', $params);
    }
    public static function stories(Router $router)
    {

        session_start();
        $params = [
            "title" => "Stories | StoryApp",
            "count" => $router->database->howManyRowsIn("stories"),
            // "stories" => $router->database->fetchAllStories(0, 50),
            "page" => isset($_GET["page"])
                ? (is_numeric($_GET["page"])
                    ? intval($_GET["page"])
                    : 1)
                : 1,
            "search" => $_GET["search"] ?? "",
            "max" => 10
        ];


        $maxlength = $params['max'];

        $params['stories'] = $router->database->fetchAllStories(
            ($params['page'] - 1) * $maxlength,
            $maxlength,
            $params['search']
        );

        $params["count"] = $router->database->countQuery($params['search']);

        $params['page'] = (ceil($params['count'] / $maxlength) >= $params['page']
            ? $params['page']
            : 1);

        $user = User::isAuth($router->database);
        $params['user'] = $user;

        $router->renderView('pages/stories', 'layouts/default', $params);
    }
    public static function writers(Router $router)
    {
        $params = [
            "title" => "Writes | StoryApp"
        ];
        session_start();

        $user = User::isAuth($router->database);

        $params['user'] = $user;
        $router->renderView('pages/writers', 'layouts/default', $params);
    }
    public static function about(Router $router)
    {
        $params = [
            "title" => "About | StoryApp"
        ];
        session_start();

        $user = User::isAuth($router->database);

        $params['user'] = $user;
        $router->renderView('pages/about', 'layouts/default', $params);
    }
    public static function contact(Router $router)
    {
        $params = [
            "title" => "Contact | StoryApp"
        ];
        session_start();

        $user = User::isAuth($router->database);

        $params['user'] = $user;
        $router->renderView('pages/contact', 'layouts/default', $params);
    }
}
