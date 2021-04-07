<?php

$user["NStories"] = count(json_decode($user["stories"]));

?>
<style>
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


    .card_container .imgcontainer {
        position: relative;
    }

    .card_container .imgcontainer button {
        cursor: pointer;
        position: absolute;
        width: 2rem;
        height: 2rem;
        border: 0;
        outline: 0;

        border-radius: 50%;
        font-size: 1.3rem;
        background: rgba(255, 255, 255, 0.3);
        color: var(--color-five);

        right: 0.5rem;
        bottom: 0.5rem;
    }

    .card_container .imgcontainer button:hover {
        background: rgba(255, 255, 255, 0.8);
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
</style>

<div class="card_container">

    <form id="updatePhoto">
        <input type="file" id="photo" name="photo" style="display:none" />
    </form>

    <div class="imgcontainer">
        <img src="<?php echo $user['image']; ?>" alt="user profile">
        <button id="change-photo">
            <i class="fas fa-camera"></i>
        </button>
    </div>

    <div class="info">

        <h2><?php echo $user['username']; ?></h2>
        <h5>
            <?php echo $user['NStories']; ?>
            <?php echo $user['NStories'] > 1 ? " stories" : " story"; ?>
        </h5>

        <p>
            <?php echo $user['bio']; ?>
        </p>
    </div>
</div>