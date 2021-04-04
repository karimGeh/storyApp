<?php
include_once __DIR__ . "/../common/storyCard.php";

?>
<div class="featured-story-container">
    <h4 class="title">Most popular</h4>
    <div class="stories">

        <?php
        if (isset($params["stories"])) {
            foreach ($params["stories"] as $story) {
                storyCard($story);
            }
        }
        ?>
    </div>
</div>