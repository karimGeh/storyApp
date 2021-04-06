<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/jpg" href="https://cdn.dribbble.com/users/201599/screenshots/1545461/book.jpg" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link href="/public/style.css" rel="stylesheet" />
    <title><?php echo $params["title"] ?? "" ?></title>
</head>

<body>
    <?php
    include_once __DIR__ . "/../components/common/navBar.php";

    echo $params["content"] ?? "";

    include_once __DIR__ . "/../components/common/footer.php";

    ?>


    <script src="/public/auth.js"></script>
    <script src="/public/main.js"></script>


</body>

</html>