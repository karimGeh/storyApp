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
        // $this->pdo = new PDO('mysql:host=sql210.epizy.com;port=3306;dbname=epiz_28329676_storyApp', 'epiz_28329676', ' 	
        // jzi5faZDXtcyU5T');
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
        $statement = $this->pdo->prepare('SELECT * FROM stories ORDER BY likes DESC LIMIT 3;');
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
    public static function getRandomStories($id)
    {
        $statement = self::$db->pdo->prepare("SELECT * FROM stories WHERE id <> :id ORDER BY RAND() LIMIT 3; ");
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

    public static function createStory($story)
    {
        $statement = self::$db->pdo->prepare("INSERT INTO stories (title,subtitle,author,story) VALUES (:title,:subtitle,:author,:story)");
        $statement->bindValue(":title", $story['title']);
        $statement->bindValue(":subtitle", $story['subtitle']);
        $statement->bindValue(":author", $story['author']);
        $statement->bindValue(":story", $story['story']);
        $statement->execute();
    }

    public static function updateStory($story)
    {
        $statement = self::$db->pdo->prepare("UPDATE stories SET title = :title,
                                                    subtitle = :subtitle,
                                                    story = :story WHERE id = :id; ");
        $statement->bindValue(":id", $story['id']);
        $statement->bindValue(":title", $story['title']);
        $statement->bindValue(":subtitle", $story['subtitle']);
        $statement->bindValue(":story", $story['story']);
        $statement->execute();
    }
    public static function updateUsersPhoto($user, $newPath)
    {
        $statement = self::$db->pdo->prepare("UPDATE users SET image = :image WHERE id = :id; ");
        $statement->bindValue(":id", $user['id']);
        $statement->bindValue(":image", $newPath);
        $statement->execute();
    }

    public static function getUserStories($author)
    {
        $statement = self::$db->pdo->prepare("SELECT id FROM stories WHERE author = :author; ");
        $statement->bindValue(":author", $author);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function registerUser($user)
    {
        $statement = self::$db->pdo->prepare(
            "INSERT INTO users (username,email,hashedpassword,image) VALUES (:username,:email,:hashedpassword,:image)"
        );
        $statement->bindValue(":username", $user['username']);
        $statement->bindValue(":email", $user['email']);
        $statement->bindValue(":hashedpassword", $user['password']);
        $statement->bindValue(":image", '/public/images/avatar-default.png');
        $statement->execute();
    }

    public static function fetchAllStories($from, $to, $search = '')
    {
        if ($search) {
            $statement = self::$db->pdo->prepare(
                "SELECT * FROM stories WHERE title like :keyword OR subtitle like :keyword OR story like :keyword LIMIT $to OFFSET $from;"
            );
            $statement->bindValue(":keyword", "%$search%");
        } else {
            $statement = self::$db->pdo->prepare(
                "SELECT * FROM stories ORDER BY id LIMIT $to OFFSET $from;"
            );
        }
        // $statement->bindValue(":size", $to);
        // $statement->bindValue(":begining", $from);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function countQuery($search = '')
    {
        if ($search) {
            $statement = self::$db->pdo->query(
                "SELECT COUNT(*) FROM stories WHERE title like '%$search%' OR subtitle like '%$search%' OR story like '%$search%' ;"
            );
            // $statement->bindValue(":keyword", "%$search%");
        } else {
            $statement = self::$db->pdo->query(
                "SELECT COUNT(*)  FROM stories ;"
            );
        }
        // $statement->bindValue(":size", $to);
        // $statement->bindValue(":begining", $from);
        // $statement->execute();

        return $statement->fetchColumn();
    }

    public static function howManyRowsIn($table)
    {
        $statement = self::$db->pdo->query(
            "SELECT COUNT(*) FROM stories;"
        );
        // $statement->bindValue(":table", $table);
        // $statement->execute();

        return $statement->fetchColumn(); #(PDO::FETCH_ASSOC);
    }
}
