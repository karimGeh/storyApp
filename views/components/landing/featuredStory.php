<?php
include_once __DIR__ . "/../common/storyCard.php";

?>
<div class="featured-story-container">
    <h4 class="title">Most popular</h4>
    <div class="stories">

        <?php
        if (isset($params["stories"])) {
            foreach ($params["stories"] as $key => $story) {
                storyCard($params["stories"][($key + 2) % count($params["stories"])]);
            }
        }
        ?>
    </div>
</div>