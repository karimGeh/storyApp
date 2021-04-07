<?php
// stories page";

// r<pre>";
// echo var_dump($params);
// echo "</pre>";

include_once __DIR__ . "/../components/common/storyCard.php";
$story = $params['story'];
$author = $params['author'];
$author["NStories"] = count(json_decode($author["stories"]))

?>

<style>
    .singleStoryContainer {
        width: 100%;
        min-height: 400px;
        padding: 5rem 1rem;

        display: flex;
        align-items: center;
        justify-content: flex-start;

        flex-direction: column;


    }

    .singleStoryContainer>.story {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        width: 100%;
        max-width: 1300px;
        /* border: 2px solid red; */

    }

    .singleStoryContainer>.story>* {
        margin: 1rem;
    }

    .singleStoryContainer>.story>.main-story {
        flex: 1;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        padding: 2rem;

        /* border: 2px solid red; */
        border: 3px solid var(--color-four);
        border-radius: 10px;


    }

    .singleStoryContainer>.story>.main-story>* {
        text-align: center;
    }

    .singleStoryContainer>.story>.main-story>h1 {
        font-size: 3rem;
        text-transform: uppercase;
        color: var(--color-five);
    }

    .singleStoryContainer>.story>.main-story>h3 {
        /* font-size: 2rem; */
        padding: 2rem 0;
        text-transform: uppercase;
        color: var(--color-five);


    }

    .singleStoryContainer>.story>.main-story>p {
        padding: 2rem 0 0 0;
        text-align: justify;
    }

    .singleStoryContainer>.story>.about-author {
        width: 300px;
        /* border: 3px solid var(--color-four); */

        background: var(--color-one);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        flex-direction: column;
        min-height: 400px;

        padding: 1rem;
        -webkit-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        -moz-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);

    }

    .singleStoryContainer>.story>.about-author .controllers {

        width: 100%;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;

        -webkit-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        -moz-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);

    }

    .singleStoryContainer>.story>.about-author .controllers button {
        flex-basis: 100%;
        height: 100%;
        cursor: pointer;
        border: 0;
        outline: 0;
        background: var(--color-three);
        color: var(--color-one);
        font-size: larger;

    }

    .singleStoryContainer>.story>.about-author .controllers button:hover {
        color: var(--color-six);
        background: var(--color-seven);
    }


    .singleStoryContainer>.story>.about-author .controllers button:first-of-type {
        border-radius: 10px 0 0 10px;
        border-right: 2px solid var(--color-seven);
    }

    .singleStoryContainer>.story>.about-author .controllers button:last-of-type {
        border-radius: 0 10px 10px 0;
        border-left: 2px solid var(--color-seven);
    }

    .singleStoryContainer>.story>.about-author a {
        text-decoration: none;
        background: var(--color-five);
        color: var(--color-three);
        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;


        /* width: 80%; */
        font-size: 1rem;
        padding: 0.5rem 1rem;

        -webkit-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        -moz-box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        box-shadow: 0px 0px 25px 2px rgba(0, 0, 0, 0.45);
        /* color: var(--color-five); */
    }

    .singleStoryContainer>.story>.about-author a:hover {
        transform: scale(1.05);
    }

    .singleStoryContainer>.story>.about-author>.author {
        display: flex;
        align-items: center;
        flex-direction: column;
        text-transform: uppercase;
        color: var(--color-three);
    }

    .singleStoryContainer>.story>.about-author>.author>img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 10px solid var(--color-three);

        -webkit-box-shadow: 0px 0px 25px 7px rgba(0, 0, 0, 0.45);
        -moz-box-shadow: 0px 0px 25px 7px rgba(0, 0, 0, 0.45);
        box-shadow: 0px 0px 25px 7px rgba(0, 0, 0, 0.45);
    }

    .singleStoryContainer>.story>.about-author>.author .info {
        padding: 1rem 0;
        flex: 1;
        padding-left: 1rem;
    }

    .singleStoryContainer>.story>.about-author>.author .info h2 {
        font-size: larger;
        text-transform: uppercase;
        color: var(--color-three);
        /* opacity: 0; */
    }

    .singleStoryContainer>.story>.about-author>.author .info h5 {
        font-size: 1rem;
        color: var(--color-five);
        /* opacity: 0; */
    }

    .singleStoryContainer>.suggestions {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        flex-direction: column;
        width: 100%;
        max-width: 1300px;
        padding: 2rem;
        margin: 1rem 0;
    }

    .singleStoryContainer>.suggestions>.stories-suggested {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        width: 100%;
        max-width: 1300px;
        /* border: 2px solid red; */
        padding: 2rem;
        margin: 1rem 0;
    }

    .stories-suggested>* {
        margin: 0 1rem;

    }
</style>
<div class="singleStoryContainer">
    <div class="story">
        <div class="main-story">
            <h1 class="title">
                <?php echo $story['title']; ?>
            </h1>
            <h3 class="subtitle">
                <?php echo $story['subtitle']; ?>
            </h3>
            <p class="story-content">
                <?php echo $story['story']; ?>
            </p>
        </div>

        <div class="about-author">
            <!-- <pre>
            <?php
            echo var_dump($params['author']);
            ?>
            </pre> -->
            <div class="author">
                <img src="<?php echo $author['image']; ?>" alt="">
                <div class="info">
                    <h2>
                        <?php
                        echo strlen($author['username']) <= 12
                            ? $author['username']
                            : substr($author['username'], 0, 10) . "..";
                        ?>
                    </h2>
                    <h5>
                        <?php echo $author['NStories']; ?>
                        <?php echo $author['NStories'] > 1 ? " stories" : " story"; ?>
                    </h5>
                </div>


            </div>

            <div class="controllers">
                <button>
                    <i class="far fa-thumbs-up"></i>
                    <span>
                        <?php echo $story['likes']; ?>
                    </span>
                </button>

                <button>
                    <i class="far fa-thumbs-down"></i>
                    <span>
                        <?php echo $story['dislikes']; ?>
                    </span>
                </button>

                <button>
                    <i class="far fa-heart"></i>
                </button>

            </div>
            <a href="/user/<?php echo $author['id']; ?>">VISITE PROFILE</a>
        </div>
    </div>
    <div class="suggestions">
        <h4>Other stories :</h4>
        <div class="stories-suggested">
            <?php
            if (isset($params["suggestions"])) {
                foreach ($params["suggestions"] as $story) {
                    storyCard($story);
                }
            }
            ?>
        </div>
    </div>
</div>