<?php
$user = $_SESSION['user'] ?? [
    'username' => '',
];
if (strpos($_SERVER["REQUEST_URI"], "?")) {
    $url = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], "?"));
} else {

    $url = $_SERVER["REQUEST_URI"];
}

$classes = [
    "home" => ($url == "/" ? "active" : ""),
    "stories" => ($url == "/stories" ? "active" : ""),
    "writers" => ($url == "/writers" ? "active" : ""),
    "about" => ($url == "/about" ? "active" : ""),
    "contact" => ($url == "/contact" ? "active" : ""),
];
?>
<style>
    .hidden {
        display: none !important;
    }

    .profileImage {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        margin-right: 1rem;
    }

    .popout {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 100;


        display: flex;
        align-items: center;
        justify-content: center;
    }


    .popout-container {
        width: 90%;

        max-width: 400px;
        /* min-height: 400px; */
        max-height: 600px;
        background: var(--color-seven);

        border-radius: 10px;
        overflow: hidden;

        padding: 5px;

        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }


    .popoutnavigation {
        width: 100%;
        height: 70px;
        display: flex;
        /* padding-bottom: 15px; */
    }

    .popoutnavigation button {
        flex-basis: 100%;
        height: 100%;
        outline: 0;
        border: 0;
        background: var(--color-seven);
        font-size: 1.2rem;
        text-transform: uppercase;
        border-radius: 10px;

    }

    .popoutnavigation .active {
        font-weight: bolder;
        color: var(--color-five);
        background: var(--color-three);
    }

    .forms-container {
        background: var(--color-three);
        flex: 1;
        width: 100%;
        height: 100%;
        border-radius: 10px;
        margin-top: 5px;

        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 1rem;
    }

    .forms-container .logo {
        color: var(--color-five);
        font-size: 2rem;
        font-weight: bolder;
        padding: 1rem 0;
    }

    .forms-container form {
        flex: 1;

        width: 100%;
        display: flex;
        align-items: center;
        /* justify-content: space-evenly; */
        flex-direction: column;

    }

    .forms-container form>p {

        color: var(--color-five);
        font-size: 1rem;
        font-weight: bolder;

    }

    .forms-container form input {
        width: 100%;
        font-size: 1rem;
        padding: 0.7rem 1rem;
        border-radius: 10px;
        outline: none;

        margin: 5px;
    }

    .forms-container form label {
        width: 100%;
        font-size: 0.9rem;
        text-align: left;
        color: var(--color-six);
        padding: 0 1rem;
    }

    .forms-container form label:first-of-type {

        margin-top: 2rem;
    }

    .forms-container form input:nth-last-of-type(2) {

        margin-bottom: 2rem;
    }

    .forms-container form input[type=submit] {
        cursor: pointer;
        margin-top: auto;
        border: 0;
        color: var(--color-three);
        background: var(--color-five);
        padding: 1rem;
        font-size: 1.5rem;
        transition: 0.3 all ease-in-out;
    }

    .forms-container form input[type=submit]:hover {
        transform: scale(0.95);
        background: var(--color-one);
    }

    .forms-container form input:not([type=submit]) {
        border: 1px solid var(--color-one);
        color: var(--color-one);
    }

    .forms-container form input:not([type=submit]):focus {
        border: 2px solid var(--color-five);
        color: var(--color-five);
    }

    .btn-profile:hover {
        background-color: var(--color-eight);
        /* opacity: 0.2; */

    }
</style>

<nav class="navbar">
    <div id="auth-popout" class="popout hidden">
        <div class="popout-container" id="popout-container">
            <div class="popoutnavigation">
                <button id="login--popout" class="navlinks--popout active">login</button>
                <button id="register--popout" class="navlinks--popout">register</button>
            </div>
            <div class="forms-container">
                <div class="logo">StoryApp</div>
                <form action="/user/login" method="post" class="login--form " id="login-form">
                    <p>Login to your account </p>
                    <label id="emailError"></label>
                    <input type="Email" name='email' placeholder="Email">
                    <label id="passwordError"></label>
                    <input type="Password" name='password' placeholder="Password">
                    <input type="submit" value="LOGIN">
                </form>
                <form action="/user/register" class="register--form hidden" id="register-form">
                    <p>Register a new account</p>
                    <input type="text" name="username" placeholder="Username">
                    <input type="email" name='email' placeholder="Email">
                    <input type="password" name='password' placeholder="Password">
                    <input type="password" name='confirmPassword' placeholder="Confirm Password">
                    <input type="submit" value="SIGNUP">
                </form>
            </div>
        </div>
    </div>
    <div class="logo"><a href="/">StoryApp</a></div>
    <div class="links">
        <a href="/" class="<?php echo $classes['home'] ?>">Home</a>
        <a href="/stories" class="<?php echo $classes['stories'] ?>">Stories</a>
        <a href="/writers" class="<?php echo $classes['writers'] ?>">Writers</a>
        <a href="/about" class="<?php echo $classes['about'] ?>">About</a>
        <a href="/contact" class="<?php echo $classes['contact'] ?>">Contact</a>
    </div>
    <div class="user">
        <?php if ($user['username']) {
        ?>
            <a href="/profile" class="btn-profile">
                <img src="<?php echo $user['image'] ?>" alt="" class="profileImage">
                <?php
                echo strlen($user['username']) > 11 ? substr($user['username'], 0, 10) . ".." : $user['username'];
                ?></a>

        <?php
        } else { ?>
            <a id='login'>login</a> /
            <a id='register'>register</a>

        <?php } ?>
    </div>
</nav>