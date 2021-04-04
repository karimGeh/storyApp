<?php
$user = $params["user"] ?? []
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
</style>
<div class="profile_container">
    <div class="sidebar">
        <?php include_once __DIR__ . "/../components/profile/userCard.php"; ?>
        <div class="profileoptions">
            <a href="/create" id="">Create new story</a>
            <button id="">Own stories</button>
            <button id="">Favorites</button>
            <button id="logout">Logout</button>
        </div>
    </div>
    <?php include_once __DIR__ . "/../components/profile/main_profile.php"; ?>
</div>

<script src="/public/user_profile.js"></script>
<!-- echo var_dump($user); -->