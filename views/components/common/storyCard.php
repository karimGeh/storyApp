<?php

use app\models\Database;

function storyCard($story)
{
    $author = Database::$db->load($story["author"])[0];
    $author["NStories"] = count(json_decode($author["stories"]));
?>

    <div class="card-container" id="test">
        <div class="author">
            <img src="<?php echo $author['image']; ?>" alt="">
            <div class="info">
                <h5>
                    <?php
                    echo strlen($author['username']) <= 12
                        ? $author['username']
                        : substr($author['username'], 0, 10) . "..";
                    ?>
                </h5>
                <h6>
                    <?php echo $author['NStories']; ?>
                    <?php echo $author['NStories'] > 1 ? " stories" : " story"; ?>
                </h6>
            </div>
        </div>
        <div class="story">
            <h4 class="title">
                <?php
                echo strlen($story['title']) <= 11
                    ? $story['title']
                    : substr($story['title'], 0, 9) . "..";

                ?>

            </h4>
            <h6 class="subtitle">
                <?php echo $story['subtitle']; ?>
            </h6>
            <p class="story-content">
                <?php echo strlen($story['story']) > 200 ? substr($story['story'], 0, 200) : $story['story']; ?>
                <a href="/story/<?php echo $story["id"] ?>"> ... read more</a>
            </p>
        </div>
        <div class="controllers">
            <button>
                <i class="far fa-thumbs-up"></i>
                <!-- <i class="fas fa-thumbs-up"></i> -->
                <span>
                    <?php echo $story['likes']; ?>
                </span>
            </button>

            <button>
                <i class="far fa-thumbs-down"></i>
                <!-- <i class="fas fa-thumbs-down"></i> -->
                <span>
                    <?php echo $story['dislikes']; ?>
                </span>
            </button>

            <button>
                <i class="far fa-heart"></i>
                <!-- <i class="fas fa-heart"></i> -->
            </button>

        </div>
    </div>
<?php } ?>