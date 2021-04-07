<div class="story_user_card_container">
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
            <?php echo strlen($story['story']) > 200 ? substr($story['story'], 0, 150) : $story['story']; ?>
            <a href="/story/<?php echo $story["id"] ?>"> ... read more</a>
        </p>
    </div>
    <div class="controllers">
        <a href="/story/<?php echo $story["id"] ?>" id="user_profile_search">
            <i class="fas fa-search"></i>
        </a>

        <a href="/edit/<?php echo $story["id"] ?>" id="user_profile_search">
            <i class="fas fa-pen"></i>
        </a>

        <a id="user_profile_search" data-storyId="<?php echo $story["id"] ?>" onclick="deleteStory(<?php echo $story['id'] ?>)">
            <i class="fas fa-trash-alt"></i>
        </a>

    </div>
</div>
<!-- <pre> -->

<!-- <?php echo var_dump($story) ?> -->
<!-- </pre> -->