<!DOCTYPE html>

<html lang="hu">

<head>
    <title>Dizájnerek</title>
    <meta charset="UTF-8">
    <link rel="icon" href="./media/image/sloth_logo_white.png" type="image/icon">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="Title">
        <img id="Title" src="./media/image/Title.webp" alt="Birkl & Zentai saját márka.">
        <header id="navbar">
            <div>
                <a href="index.html"><img class="logo" src="./media/image/logo_without_bg.webp" alt="logo"></a>
                <nav>
                    <ul class="nav_links">
                        <li><a href="designer.html">Dizájnerek</a></li>
                        <li><a href="ruhak.html">Ruhák</a></li>
                        <li><a href="meret.html">Méret táblázat</a></li> <!-- Itt lehet táblázat meg stb. leírások -->
                        <li><a href="kapcsolat.html">Kapcsolat</a></li>
                    </ul>
                </nav>
            </div>
            <div class="profil">
                <a href="profil/login.html"><img class="login" src="./media/image/user.webp" alt="belépés"></a>
                <!-- ikon jobb oldalon -->
                <a href="kosar.html"><img class="kosar active" src="./media/image/shopping-cart.webp" alt="kosár"></a>
                <!-- ikon jobb oldalon -->
            </div>
            <!--
        <?php if (isset($_SESSION["user"])) { ?>
        <a href="./profil/profil.html">Profilom</a>
        <a href="./profil/logout.html">Kijelentkezés</a>
        <?php } else { ?>
        <a href="./profil/login.html">Bejelentkezés</a>
        <a href="./profil/signup.html">Regisztráció</a>
        <?php } ?>
        -->
        </header>
    </div>

    <div id="content">

    </div>

    <script>
        let navbar = document.getElementById("navbar");
        let navPos = navbar.offsetTop;

        window.addEventListener("scroll", e => {
            let scrollPos = window.scrollY;
            if (scrollPos > navPos) {
                navbar.classList.add('sticky');
            } else {
                navbar.classList.remove('sticky');
            }
        });
    </script>


<?php require_once("./php/footer.php")?>