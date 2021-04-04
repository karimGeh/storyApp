<?php

namespace app\controllers;

use app\router\Router;
use app\models\Database;


class User
{
    public static function login(Router $router)
    {

        // echo '<pre>';
        header('Content-type: application/json');
        // echo json_encode($_POST);
        // // echo '</pre>';
        // exit;
        $params = [
            "source" => "login",
            "errors" => [],
        ];
        if (!isset($_POST['email']))
            $params["errors"]["email"] = "email not valid";

        if (!isset($_POST['password']))
            $params["errors"]["password"] = "password not valid";


        if (empty($params["errors"])) {
            if (!$_POST['email'])
                $params["errors"]["email"] = "you should enter an email";

            if (!$_POST['password'])
                $params["errors"]["password"] = "you should enter a password";
        }


        if (empty($params["errors"])) {
            $users = $router->database->getUserByEmail($_POST['email']);
            if (!isset($users["0"])) {
                $params["errors"]["email"] = "Account with this email does not exist";
            } else {
                $users = $users['0'];
                if ($users["hashedpassword"] == $_POST['password']) {
                    session_start();
                    $_SESSION["user"] = $users;
                    $params['redirect'] = "/";
                } else {
                    $params["errors"]["email"] = "Email and password do not match";
                }
            }
        }
        echo json_encode($params);
        exit;
    }
    public static function register(Router $router)
    {

        echo '<pre>';
        echo var_dump($_POST);
        echo '</pre>';

        exit;
        $router->renderView('pages/index', 'layouts/default', []);
    }

    public static function logout(Router $router)
    {
        header('Content-type: application/json');
        session_start();
        session_destroy();
        $params = [
            "logedout" => true,
        ];
        echo json_encode($params);
        exit;
    }

    public static function profile(Router $router)
    {

        session_start();
        // session_destroy();
        // var_dump($_SESSION);

        if (empty($_SESSION["user"])) {
            header('Location: /');
            exit;
        }

        $user = $router->database->getUserByEmail($_SESSION["user"]['email']);

        if (empty($user)) {
            header('Location: /');
            exit;
        }

        $user = $user["0"];
        if ($user["hashedpassword"] !== $_SESSION["user"]["hashedpassword"]) {
            header('Location: /');
            exit;
        }

        $params = [
            "title" => "Profile | StoryApp",
            "user" => $user,
        ];


        // exit;
        $router->renderView('pages/profile', 'layouts/default', $params);
    }
}
