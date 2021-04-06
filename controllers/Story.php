<?php

namespace app\controllers;

use app\router\Router;
use app\models\Database;


class Story
{
    public static function create(Router $router)
    {
        session_start();

        $params = [
            "title" => "Create New Story | StoryApp",
        ];

        $user = User::isAuth($router->database);

        $params['user'] = $user;

        if (empty($user)) {
            header('Location: /');
            exit;
        }


        $router->renderView('pages/createStory', 'layouts/default', $params);
    }
    public static function createStory(Router $router)
    {

        header('Content-type: application/json');

        session_start();
        $user = User::isAuth($router->database);

        if (empty($user)) {
            echo json_encode([
                'redirect' => '/',
            ]);
            exit;
        }

        $story = [
            'title' => $_POST['title'],
            'subtitle' => $_POST['subtitle'],
            'story' => $_POST['story'],
            'author' => $user['id'],
        ];

        if (!$story['title']) {
            echo json_encode([
                'error' => 'Title necessary',
            ]);
            exit;
        }

        if (strlen($story['story']) < 250) {
            echo json_encode([
                'error' => 'The story must be 250 characters or more',
            ]);
            exit;
        }

        $router->database->createStory($story);
        $stories = $router->database->getUserStories($user['id']);
        foreach ($stories as $key => $local_story) {
            $stories[$key] = intval($local_story['id']);
        }
        $router->database->updateUsersStories($user['id'], json_encode($stories));

        $params = [
            "story" =>   $stories,
            "redirect" =>   "/profile",
        ];

        echo json_encode($params);
        exit;
    }

    public static function edit(Router $router)
    {
        // header('Content-type: application/json');
        session_start();
        $user = User::isAuth($router->database);

        if (empty($user)) {
            header('Location: /');
            exit;
        }

        $matchedParams = $_SERVER['matchedParams'];

        if (!is_numeric($matchedParams['storyId'])) {
            header('Location: /');
            exit;
        }

        $story = $router->database->getStoryById($matchedParams['storyId']);

        if (empty($story)) {
            header('Location: /');
            exit;
        }

        $story = $story["0"];

        $params = [
            "title" => "Update Story | StoryApp",
            "story" => $story,
        ];
        $params['user'] = $user;
        $router->renderView('pages/editStory', 'layouts/default', $params);
    }

    public static function editStory(Router $router)
    {
        header('Content-type: application/json');
        session_start();
        $user = User::isAuth($router->database);

        if (empty($user)) {
            echo json_encode([
                'redirect' => '/',
            ]);
            exit;
        }

        $story = [
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'subtitle' => $_POST['subtitle'],
            'story' => $_POST['story'],
        ];



        if (!$story['id']) {
            echo json_encode([
                'redirect' => '/',
            ]);
            exit;
        }

        if (!is_numeric($story['id'])) {
            echo json_encode([
                'redirect' => '/',
            ]);
            exit;
        }
        $story['id'] = intval($story['id']);

        if (!$story['title']) {
            echo json_encode([
                'error' => 'Title necessary',
            ]);
            exit;
        }

        if (strlen($story['story']) < 250) {
            echo json_encode([
                'error' => 'The story must be 250 characters or more',
            ]);
            exit;
        }

        $router->database->updateStory($story);

        $params = [
            "succes" =>   "story updated successfuly",
        ];

        echo json_encode($params);
        exit;
    }

    public static function delete(Router $router)
    {
        header('Content-type: application/json');
        session_start();
        $id = $_POST['id'];

        if (empty($_SESSION["user"])) {
            echo json_encode([
                "redirect" => "/",
            ]);
            exit;
        }

        $user = User::isAuth($router->database);

        if (empty($user)) {
            echo json_encode([
                "redirect" => "/",
            ]);
            exit;
        }

        $router->database->deleteStoryById($id);

        $newStories = json_decode($user["stories"]);
        $newStories = array_diff($newStories, array($id));

        $router->database->updateUsersStories($user['id'], json_encode($newStories));

        echo json_encode([
            "success" => true,
        ]);
        exit;
    }
}
