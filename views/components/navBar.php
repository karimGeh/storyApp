<?php
$user = $params['user'] ?? [
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
    "about" => ($url == "/about" ? "active" : ""),
    "contact" => ($url == "/contact" ? "active" : ""),
];
?>

<nav class="navbar">
    <div class="logo"><a href="/">StoryApp</a></div>
    <div class="links">
        <a href="/" class="<?php echo $classes['home'] ?>">Home</a>
        <a href="/stories" class="<?php echo $classes['stories'] ?>">Stories</a>
        <a href="/about" class="<?php echo $classes['about'] ?>">About</a>
        <a href="/contact" class="<?php echo $classes['contact'] ?>">Contact</a>
    </div>
    <div class="user">
        <?php if (isset($params['user'])) {
            echo $user['username'];
        } else { ?>
            <a href="/login">login</a> /
            <a href="/register">register</a>

        <?php } ?>
    </div>
</nav>