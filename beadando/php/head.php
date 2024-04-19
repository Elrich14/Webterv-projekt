<?php


    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $page = end($parts);

    switch ($page) {
        case "designer.php":
            $title = "Dizájnerek";
            break;
        case "ruhak.php":
            $title = "Ruhák";
            break;
        case "meret.php":
            $title = "Mérettáblázat";
            break;
        case "kapcsolat.php":
            $title = "Kapcsolat";
            break;
        case "login.php":
            $title = "Bejelentkezés";
            break;
        case "kosar.php":
            $title = "Kosár";
            break;
        case "profil.php":
            $title = "Profil";
            break;
        case "signup.php":
            $title = "Regisztráció";
            break;
        default:
            $title = "Birkl&amp;Zentai WebShop";
            break;
    }
?>
<?php
$file_path = __FILE__;
$directory = dirname($file_path);
if ($directory === './') {
    $folder = "..";
} else {
    $folder = ".";
}
?>

<!DOCTYPE html>

<html lang="hu">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo $folder;?>/media/image/sloth_logo_white.png" type="image/png">
    <link rel="stylesheet" href="<?php echo $folder;?>/css/style.css">
    <link rel="stylesheet" href="<?php echo $folder;?>/css/header.css">
    <link rel="stylesheet" href="<?php echo $folder;?>/css/footer.css">
    <link rel="stylesheet" href="<?php echo $folder;?>/css/responsive.css">
    <link rel="stylesheet" href="<?php echo $folder;?>/css/print.css">
    <link rel="stylesheet" href="<?php echo $folder;?>/css/cart.css">
</head>

<body>
    <script>
        $('.toggle').click(function () {
            "use strict";
            $('nav ul').slideToggle();
        });



        $(window).resize(function () {
            "use strict";
            if ($(window).width() > 780) {
                $('nav ul').removeAttr('style');
            }
        });

    </script>
    <div class="Title">
        <img id="Title" src="<?php echo $folder;?>/media/image/Title.webp" alt="Birkl &amp; Zentai saját márka.">
        <?php require_once("$folder/php/nav.php")?>
    </div>