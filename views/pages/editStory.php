<?php

$story = $params['story'] ?? [];
?>

<style>
    .form_create_story {
        width: 100%;
        display: flex;
        align-items: center;
        /* justify-content: center; */
        flex-direction: column;

        padding: 2rem;
        flex: 1;

    }

    .form_create_story>div {
        min-height: 2rem;
        width: 100%;
        max-width: 1000px;
        display: flex;
        align-items: flex-start;

        margin: 1rem 0;


    }

    .form_create_story>h2 {

        padding: 2rem 0;
        text-transform: uppercase;
        color: var(--color-five);


    }

    .form_create_story>div>label {
        color: var(--color-five);
        min-width: 100px;
    }

    .form_create_story>div>textarea,
    .form_create_story>div>input {
        outline: 0;
        flex: 1;
        /* min-width: 100%; */
        height: 100%;
        border: 2px solid var(--color-four);
        border-radius: 10px;
        /* margin: 0 1rem; */
        padding: 1rem 1rem;
    }

    .form_create_story>div>*:not(label):focus {
        border: 3px solid var(--color-five);
    }

    .form_create_story>div>textarea {
        min-height: 500px;



    }

    .submition {
        margin: 0;
        width: 100%;
    }

    .submition .btn-submit-create-story {
        cursor: pointer;
        min-width: 200px;
        flex: 0;
        margin-left: auto;

        background: var(--color-five);
        color: var(--color-three);

        text-transform: uppercase;
        /* font-weight: bolder; */
        font-size: 1.1rem;


        transition: 0.3s all ease-in-out;
        border: 0;

    }

    .submition .btn-submit-create-story:hover {
        transform: scale(0.9);
    }
</style>

<form class="form_create_story" id="form_create_story">
    <h2>Create new story</h2>
    <div class="creat_title">
        <label for="title">Title :</label>
        <input type="text" name="title" id="title" value="<?php echo $story['title'] ?? "" ?>">
    </div>
    <div class="creat_subtitle">
        <label for="subtitle">Subtitle :</label>
        <input type="text" name="subtitle" id="subtitle" value="<?php echo $story['subtitle'] ?? "" ?>">
    </div>
    <div class="creat_main_story">
        <label for="story">Story :</label>
        <!-- <input type="text" name="story" id="story"> -->
        <textarea name="story" id="story"><?php echo $story['story'] ?? "" ?></textarea>
    </div>

    <div class="submition">

        <input type="submit" value="update" class="btn-submit-create-story">
    </div>
</form>
<script src="/public/updateStory.js" storyId="<?php echo $story['id'] ?? "" ?>"></script>