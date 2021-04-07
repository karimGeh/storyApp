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

    public function matches($keys, $values)
    {
        $matchedParams = [];

        if (count($keys) != count($values)) {
            return [];
        }

        foreach ($values as $key => $value) {
            // echo "<pre>";
            // echo $keys[$key];
            // echo var_dump(is_numeric(strpos($keys[$key], ':')));
            // echo "</pre>";
            if ($keys[$key] != $value && !is_numeric(strpos($keys[$key], ':'))) {
                return [];
            }
            if ($keys[$key] != $value && is_numeric(strpos($keys[$key], ':'))) {
                $serverKey = str_replace(array(":"), "", $keys[$key]);
                $matchedParams[$serverKey] = $value;
            }
        }

        return $matchedParams;
    }

    public function params($url)
    {

        // header('Content-type: application/json');
        $keys = explode("/", $url);
        $values = explode("/", $_SERVER['PATH_INFO'] ?? "");

        $matchedParams = $this->matches($keys, $values);
        // exit;

        if (!empty($matchedParams)) {

            $_SERVER['PATH_INFO'] = $url;
            $_SERVER['matchedParams'] = $matchedParams;
            $_SERVER['keys'] = $keys;
            $_SERVER['values'] = $values;
        }


        // echo json_encode($_SERVER);
        // exit;
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
        } else {
            call_user_func($fn, $this);
            # code...
        }
    }
    public function renderView($view, $layout, $params = [])
    {
        ob_start();
        include __DIR__ . "/../views/$view.php";
        $params["content"] = ob_get_clean();
        include __DIR__ . "/../views/$layout.php";
    }
}
