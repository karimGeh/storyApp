<?php

namespace app\router;

use app\models\Database;
// use app\conrollers\User;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public ?Database $database = null;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $url = $_SERVER['PATH_INFO'] ?? '/';
        // echo $url;
        // echo '<pre>';
        // echo var_dump($_SERVER);
        // echo '</pre>';
        if ($method === 'get') {
            $fn = $this->getRoutes[$url] ?? null;
        } else {
            $fn = $this->postRoutes[$url] ?? null;
        }
        if (!$fn) {
            echo '<h1>404 Page not found</h1>';
            exit;
        }
        // $fn["0"]->index($this);
        call_user_func($fn, $this);
    }
    public function renderView($view, $layout, $params = [])
    {
        // $params = $params;
        ob_start();
        include __DIR__ . "/../views/$view.php";
        $params["content"] = ob_get_clean();
        include __DIR__ . "/../views/$layout.php";
    }
}
