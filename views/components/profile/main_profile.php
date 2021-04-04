<style>
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

    .story_user_card_containre {
        cursor: pointer;
        width: 300px;
        height: 400px;

        margin: 1rem;
        padding: 1rem;

        background: var(--color-one);
        border-radius: 20px;
        overflow: hidden;

        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: column;
        transition: 0.3s all ease-in-out;
    }

    .story_user_card_containre:hover {
        transform: scale(1.1) !important;
        -webkit-box-shadow: 0px 0px 25px 7px rgba(0, 0, 0, 0.45);
        -moz-box-shadow: 0px 0px 25px 7px rgba(0, 0, 0, 0.45);
        box-shadow: 0px 0px 25px 7px rgba(0, 0, 0, 0.45);
    }

    .story_user_card_containre .author {
        width: 100%;
        height: 20%;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 1rem;
        /* margin-bottom: 1rem; */

        /* border: 2px solid red; */
        border-radius: 10px;
        background: var(--color-three);
        -webkit-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        -moz-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
    }

    .story_user_card_containre .author img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
    }

    .story_user_card_containre .author .info {
        flex: 1;
        padding-left: 1rem;
    }

    .story_user_card_containre .author .info h5 {
        font-size: larger;
        text-transform: uppercase;
        color: var(--color-one);
        /* opacity: 0; */
    }

    .story_user_card_containre .author .info h6 {
        font-size: 1rem;
        color: var(--color-five);
        /* opacity: 0; */
    }

    .story_user_card_containre .story {
        margin: 1rem 0;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 1rem 0rem;
    }

    .story_user_card_containre .story h4 {
        text-transform: uppercase;
        /* margin: 0 0 2rem 0; */
        font-size: 2rem;
        font-weight: lighter;
        color: var(--color-three);
    }

    .story_user_card_containre .story h6 {
        /* margin: 0 0 2rem 0; */
        font-size: 1rem;
        font-weight: lighter;
        color: var(--color-two);
    }

    .story_user_card_containre .story .story-content {
        padding: 2rem 1rem 0;
        flex: 1;
        text-align: justify;
        opacity: 0.8;
        /* color: var(--color-five); */
    }

    .story_user_card_containre .story .story-content a {
        opacity: 1;
        color: var(--color-three);
        font-size: large;
        font-weight: bold;
        /* color: var(--color-five); */
    }

    .story_user_card_containre .controllers {
        width: 100%;
        height: 10%;
        /* border: 2px solid red; */
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        -webkit-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        -moz-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
    }

    .story_user_card_containre .controllers>* {
        flex-basis: 100%;
        height: 100%;
        cursor: pointer;
        border: 0;
        outline: 0;
        background: var(--color-three);
        color: var(--color-one);
        /* margin-top: 1rem; */

        /* border-radius: 20px 0 0 0; */
    }

    .story_user_card_containre .controllers>*:hover {
        /* border-radius: 20px 0 0 0; */
        color: var(--color-six);
        background: var(--color-seven);
    }

    .story_user_card_containre .controllers a {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: larger;
        text-decoration: none;
        min-height: 3rem;
    }

    .story_user_card_containre .controllers a:nth-of-type(1) {
        border-radius: 10px 0 0 10px;
        border-right: 2px solid var(--color-seven);
    }

    .story_user_card_containre .controllers a:nth-of-type(3) {
        border-radius: 0 10px 10px 0;
        border-left: 2px solid var(--color-seven);
    }
</style>

<div class="main">
    <?php

    use app\models\Database;

    foreach (json_decode($user['stories']) as $id) {
        $story = Database::getStoryById($id);
        if (!empty($story["0"])) {
            $story = $story["0"];
            include __DIR__ . "/storyUserCard.php";
        }
    }

    ?>

</div>