<?php

namespace app\controllers;

use app\router\Router;
use app\models\Database;


class User
{

    public static function isAuth(Database $db)
    {
        if (empty($_SESSION["user"])) {
            return null;
        }

        $user = $db->getUserByEmail($_SESSION["user"]['email']);

        if (empty($user)) {
            return null;
        }

        $user = $user["0"];
        if ($user["hashedpassword"] !== $_SESSION["user"]["hashedpassword"]) {
            return null;
        }
        return $user;
    }

    public static function login(Router $router)
    {
        header('Content-type: application/json');
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
                $params["errors"]["global"] = "Account with this email does not exist";
            } else {
                $users = $users['0'];
                if ($users["hashedpassword"] == $_POST['password']) {
                    session_start();
                    $_SESSION["user"] = $users;
                    $params['redirect'] = "/profile";
                } else {
                    $params["errors"]["global"] = "Email and password do not match";
                }
            }
        }
        echo json_encode($params);
        exit;
    }
    public static function register(Router $router)
    {

        // echo '<pre>';
        // echo var_dump($_POST);
        // echo '</pre>';
        $params = [
            "source" => "register",
            "errors" => [],
        ];
        header('Content-type: application/json');

        if (!isset($_POST['username']))
            $params["errors"]["username"] = "username not valid";

        if (!isset($_POST['email']))
            $params["errors"]["email"] = "email not valid";

        if (!isset($_POST['password']))
            $params["errors"]["password"] = "password not valid";

        if (!isset($_POST['confirmPassword']))
            $params["errors"]["confirmPassword"] = "confirm password not valid";

        if (!preg_match("/^[a-zA-Z0-9' ]{6,}$/", $_POST['username'])) {
            $params["errors"]["username"] = "your username must be alphanumeric and contain more than 5 chars";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $params["errors"]["email"] = "Invalid email format";
        }

        if (!isset($_POST['password']))
            $params["errors"]["password"] = "password not valid";


        if (empty($params["errors"])) {
            if (!$_POST['email'])
                $params["errors"]["email"] = "you should enter an email";

            if (!$_POST['password'])
                $params["errors"]["password"] = "you should enter a password";

            if (!$_POST['username'])
                $params["errors"]["username"] = "you should enter a username";

            if (!$_POST['confirmPassword'])
                $params["errors"]["confirmPassword"] = "you should confirme your password";
        }
        if (empty($params["errors"])) {
            if (strlen($_POST['password']) < 6)
                $params["errors"]["password"] = "password must be 6 chars or more";
            if ($_POST['confirmPassword'] !== $_POST['password'])
                $params["errors"]["confirmPassword"] = "passwords does not match";
        }

        $user = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'confirmPassword' => $_POST['confirmPassword'],
        ];

        $users = $router->database->getUserByEmail($user['email']);
        if (!empty($users)) {
            $params["errors"]["global"] = "email already exist";
        }

        if (empty($params["errors"])) {
            $router->database->registerUser($user);
            $user = $router->database->getUserByEmail($user['email'])["0"];

            session_start();
            $_SESSION["user"] = $user;
            $params['redirect'] = "/profile";
        }
        echo json_encode($params);
        exit;
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

    public static function updatePhoto(Router $router)
    {
        header('Content-type: application/json');
        session_start();

        $params = [
            "redirect" => false,
        ];

        $user = self::isAuth($router->database);

        if (empty($user)) {
            $params['redirect'] = true;
            echo json_encode($params);
            exit;
        }

        $photo = $_FILES['photo'] ?? null;
        if (!$photo) {
            echo json_encode($params);
            exit;
        }
        $name = "imageUser" . $user['id'] . substr($photo['name'], strpos($photo['name'], '.'));
        $photo['name'] = $name;
        move_uploaded_file(
            $photo['tmp_name'],
            __DIR__ . '/../public/usersImages/' . $photo['name']
        );

        $newPath = '/public/usersImages/' . $photo['name'];

        $router->database->updateUsersPhoto($user, $newPath);

        $params['redirect'] = true;
        echo json_encode($params);
        exit;
    }

    public static function profile(Router $router)
    {

        session_start();
        // session_destroy();
        // var_dump($_SESSION);
        $user = self::isAuth($router->database);

        if (empty($user)) {
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
    public static function visitUser(Router $router)
    {

        session_start();
        // session_destroy();
        // var_dump($_SESSION);
        $user = self::isAuth($router->database);
        $params = [
            "title" => "Profile | StoryApp",
            "user" => $user,
        ];
        $params['userId'] = $_SERVER['matchedParams']['userId'];
        $params['userPage'] = $router->database->load($params['userId'])["0"];
        if (empty($params['userPage'])) {
            header("Location: /stories");
            exit;
        }
        $params['title'] = $params['userPage']['username'] . " | StoryApp";



        // exit;
        $router->renderView('pages/userPage', 'layouts/default', $params);
    }
}
