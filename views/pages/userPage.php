<?php

use app\models\Database;

$userPage = $params["userPage"] ?? [];
$userPage["NStories"] = count(json_decode($userPage["stories"]));
include_once __DIR__ . "/../components/common/storyCard.php";

?>
<style>
    .profile_container {
        flex: 1;
        display: flex;
        padding: 4rem;
        min-height: 100vh;
    }

    .sidebar {
        flex: 1;
        max-width: 300px;
        /* border: 2px solid red; */
    }

    .sidebar .profileoptions {
        width: 100%;

        background: var(--color-three);
        border: 3px solid var(--color-one);
        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;

        margin: 2rem 0;
        padding: 2rem;
    }

    .sidebar .profileoptions button,
    .sidebar .profileoptions a {
        cursor: pointer;
        width: 100%;
        padding: 0.7rem 1rem;

        border: 0;
        border-radius: 10px;

        background: var(--color-five);
        color: var(--color-three);
        font-size: 1.3rem;
        text-align: center;

        text-decoration: none;

        margin: 0.5rem 0;
    }

    .sidebar .profileoptions button:hover,
    .sidebar .profileoptions a:hover {
        transform: scale(0.9);
    }

    .card_container {
        width: 100%;

        background: var(--color-three);
        border: 3px solid var(--color-one);
        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        min-height: 400px;
        padding: 2rem;

    }



    .card_container .imgcontainer img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
    }

    .card_container .info {
        padding: 2rem 0 0 0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .card_container .info h2 {
        color: var(--color-five);
        text-transform: uppercase;
    }

    .card_container .info p {
        padding: 1rem 0 0 0;
        text-align: justify;
    }

    .main {
        border: 2px solid red;
        flex: 1;

        width: 100%;

        /* background: var(--color-three); */
        border: 3px solid var(--color-one);
        border-radius: 10px;

        display: flex;
        flex-wrap: wrap;

        margin-left: 2rem;
        padding: 2rem;

    }

    .main>* {

        margin: 1rem;
    }
</style>
<div class="profile_container">
    <div class="sidebar">
        <div class="card_container">
            <div class="imgcontainer">
                <img src="<?php echo $userPage['image']; ?>" alt="user profile">
            </div>

            <div class="info">

                <h2><?php echo $userPage['username']; ?></h2>
                <h5>
                    <?php echo $userPage['NStories']; ?>
                    <?php echo $userPage['NStories'] > 1 ? " stories" : " story"; ?>
                </h5>

                <p>
                    <?php echo $userPage['bio']; ?>
                </p>
            </div>
        </div>
    </div>

    <div class="main">

        <?php
        if (isset($userPage["stories"])) {
            foreach (json_decode($userPage["stories"]) as $id) {
                $story = Database::getStoryById($id)["0"];
                if (!empty($story)) {
                    storyCard($story);
                }
            }
        }
        ?>
    </div>


</div>