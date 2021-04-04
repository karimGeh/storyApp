<?php

namespace app\models;;

// use app\models\user;
use PDO;

class Database
{
    /**
     * Class constructor.
     */
    public $userPdo = null;
    public $storyPdo = null;
    public static ?Database $db = null;

    public function __construct()
    {
        // initialize connection to database
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=storyApp', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        self::$db = $this;
    }

    public function getUserByEmail($email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1; ");
        $statement->bindValue(":email", "$email");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function load($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1; ");
        $statement->bindValue(":id", "$id");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function loadFeaturedStories($keyword)
    {
        $statement = $this->pdo->prepare('SELECT * FROM stories ORDER BY createdAt DESC LIMIT 3;');
        // $statement->bindValue(":keyword", "%$keyword%");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getStoryById($id)
    {
        $statement = self::$db->pdo->prepare("SELECT * FROM stories WHERE id = :id LIMIT 1; ");
        $statement->bindValue(":id", "$id");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteStoryById($id,)
    {
        $statement = self::$db->pdo->prepare("DELETE FROM stories WHERE id = :id ; ");
        $statement->bindValue(":id", "$id");
        $statement->execute();
    }

    public static function updateUsersStories($id, $stories)
    {
        $statement = self::$db->pdo->prepare("UPDATE users SET stories = :stories WHERE id = :id; ");
        $statement->bindValue(":stories", "$stories");
        $statement->bindValue(":id", "$id");
        $statement->execute();
    }
}
