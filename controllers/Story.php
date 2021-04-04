<?php

namespace app\controllers;

use app\router\Router;
use app\models\Database;


class Story
{
    public static function create(Router $router)
    {


        // INSERT INTO `stories` (`id`, `title`, `subtitle`, `author`, `story`, `likes`, `dislikes`, `createdAt`)
        //  VALUES (NULL, 'reda 7mar', 'soufiane 7mar', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing 
        //  elit. Vel suscipit facere vero fuga minus officiis, consequuntur voluptate optio delectus sapiente 
        //  reiciendis illo assumenda. Ipsam libero eligendi velit ipsum, labore eius? Tempore, fugiat corrupti! 
        //  Officia ducimus, sint vitae totam et magni.', '0', '0', current_timestamp());
        session_start();


        if (empty($_SESSION["user"])) {
            header('Location: /');
            exit;
        }

        $params = [
            "title" => "Create New Story | StoryApp",
        ];

        $router->renderView('pages/createStory', 'layouts/default', $params);
    }

    public static function delete(Router $router)
    {
        header('Content-type: application/json');

        session_start();
        if (empty($_SESSION["user"])) {
            echo json_encode([
                "redirect" => "/",
            ]);
            exit;
        }

        $id = $_POST['id'];
        $user = $router->database->getUserByEmail($_SESSION["user"]['email']);


        if (empty($user)) {
            echo json_encode([
                "redirect" => "/",
            ]);
            exit;
        }

        // $params = [
        //     "user" => $user,
        //     "session" => $_SESSION["user"],
        //     "post" => $_POST,
        //     "id" => $id,
        // ];

        // echo json_encode($params);
        // exit;

        $user = $user["0"];
        if ($user["hashedpassword"] !== $_SESSION["user"]["hashedpassword"]) {
            echo json_encode([
                "redirect" => "/",
            ]);
            exit;
        }

        $router->database->deleteStoryById($id);

        $newStories = json_decode($user["stories"]);
        $newStories = array_diff($newStories, array($id));

        // foreach ($newStories as $key => $story) {
        //     if ($story === $id) {
        //         unset($newStories[$key]);
        //         break;
        //     }
        // }

        $router->database->updateUsersStories($user['id'], json_encode($newStories));

        echo json_encode([
            "success" => true,
        ]);
        exit;
    }
}
