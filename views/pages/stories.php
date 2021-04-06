<?php
// stories page";

// r<pre>";
// echo var_dump($params);
// echo "</pre>";

include_once __DIR__ . "/../components/common/storyCard.php";

?>
<style>
    #page {
        display: none;
    }

    .input {
        width: 100%;

        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 1rem;
        margin: 5rem 0 0 0;



    }

    .input .container {
        position: relative;
        width: 100%;
        max-width: 800px;

    }

    .input .container input {
        width: 100%;
        padding: 0 1rem;
        height: 3rem;
        outline: 0;
        border-radius: 1.5rem;

        border: 2px solid var(--color-one);

    }

    .input .container input:focus {
        border: 3px solid var(--color-five);

    }

    .input .container button {
        position: absolute;
        cursor: pointer;
        width: 5rem;
        height: calc(3rem - 10px);
        border: 0;
        outline: 0;
        border-radius: calc(calc(3rem - 10px)*0.5);
        color: var(--color-three);
        background: var(--color-five);
        top: 0;
        right: 0;
        margin: 5px;
    }

    .input .container button:hover {
        transform: scale(0.95);
    }

    .input .page-controllers {
        margin: 2rem 0 0;
        font-size: 2rem;
        color: var(--color-five);

    }

    .input .page-controllers button {
        cursor: pointer;
        font-size: 1.6rem;
        color: var(--color-five);
        background: transparent;
        border: 0;
        padding: 0 1rem;
        outline: 0;

    }

    .input .page-controllers button:hover {
        transform: scale(0.8);
    }

    .sories_container {

        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        margin: 4rem 0;
    }

    .sories_container .wrapper {
        width: 100%;
        max-width: 1000px;

        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;


    }

    .sories_container .wrapper>* {
        margin: 1rem;
    }
</style>
<form class="input" id="search-form">
    <input type="text" name="page" id="page" class="page">

    <div class="container">
        <input type="text" name="search" id="search" value="<?php echo $params["search"] ?>">
        <button type="submit">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <div class="page-controllers">
        <button type="reset" id="previousPage">
            <i class="fas fa-chevron-left"></i>
        </button>
        <?php echo $params["page"] ?> / <?php echo ceil($params['count'] / $params['max']) ?>
        <button type="reset" id="nextPage">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</form>

<div class="sories_container">

    <div class="wrapper">

        <?php
        if (isset($params["stories"])) {
            foreach ($params["stories"] as $story) {
                storyCard($story);
            }
        }
        ?>
    </div>

</div>

<script src="/public/stories.js" currentPage="<?php echo $params["page"] ?>" maxPage="<?php echo ceil($params['count'] / $params["max"]); ?>"></script>