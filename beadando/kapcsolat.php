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
                        <li><a class="active" href="kapcsolat.html">Kapcsolat</a></li>
                    </ul>
                </nav>
            </div>
            <div class="profil">
                <a href="profil/login.html"><img class="login" src="./media/image/user.webp" alt="belépés"></a>
                <!-- ikon jobb oldalon -->
                <a href="kosar.html"><img class="kosar" src="./media/image/shopping-cart.webp" alt="kosár"></a>
                <!-- ikon jobb oldalon -->
            </div>
            <!--
        <?php if (isset($_SESSION["user"])) { ?>
        <a href="./profil/profil.html">Profilom</a>
        <a href="./profil/logout.html">Kijelentkezés</a>
        <?php } else { ?>
        <a href="./profil/login.html">Bejelentkezés</a>
        <a href="./profil/login.html">Regisztráció</a>
        <?php } ?>
        -->
        </header>
    </div>

    <!-- Szöveg -->
    <div class="contact_us_text">
        <div>
            <h1 class="contact_title">Kapcsolati Elérhetőségeink</h1>
            <p>Cégünk számos platformon jelen van, így több lehetőség is nyílik vásárlóinknak az üzenetküldésre.<br>
                Bátran forduljon hozzánk kérdésével, cégünk legkésőbb 24 órán belül válaszol minden e-mailben érkezett
                levélre.<br>
                Tájékoztatjuk kedves vásárlóink, hogy elsősorban a telefonon, illetve e-mailben érkezett kérdéseket
                részesítjük előnyben,<br>
                így amennyiben ön Facebookon vagy más elérhetőségen keresztül üzen nekünk, lehetséges hogy hosszabb
                időbe telik válaszolnunk.<br></p>
            <p>Írjon üzenetet akár <strong>most</strong> oldalunkon! &#8594;</p>
        </div>

        <div>
            <h2>Egyéb Elérhetőségeink:</h2>
            <ul id="other_contact">
                <li><a href="https://mail.google.com/mail/u/0/#inbox">E-mail</a></li>
                <li><a href="https://www.facebook.com">Facebook</a></li>
                <li><a href="https://www.instagram.com"> Instagram</a></li>
                <li><a href="https://www.linkedin.com">Linkedin</a></li>
                <li><a href="https://www.whatsapp.com">Whatsapp</a></li>
                <li><a href="https://wordpress.com">Wordpress</a></li>
            </ul>
        </div>
    </div>
    <!-- Szöveg vége -->

    <!-- Űrlap -->
    <div class="blank">
        <form method="POST">
            <fieldset>
                <legend>Írj üzenetet nekünk</legend>
                <label for="full-name">Teljes név:</label> <br>
                <input type="text" id="full-name" name="full-name" placeholder="Winch Eszter"> <br>
                <label for="email">E-mail cím:</label> <br>
                <input type="email" id="email" name="email" placeholder="valami@gmail.com"> <br>
                <label for="message">Üzenet (max. 200 karakter):</label> <br>
                <textarea id="message" name="message" maxlength="200"></textarea> <br>
                <input type="reset" id="signup_reset">
                <input type="submit" id="signup_submit">
            </fieldset>
        </form>
    </div>
    <!-- Űrlap vége -->

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