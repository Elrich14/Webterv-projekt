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
                        <li><a class="active" href="ruhak.html">Ruhák</a></li>
                        <li><a href="meret.html">Méret táblázat</a></li> <!-- Itt lehet táblázat meg stb. leírások -->
                        <li><a href="kapcsolat.html">Kapcsolat</a></li>
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
        <a href="./profil/signup.html">Regisztráció</a>
        <?php } ?>
        -->
        </header>
    </div>

    <div class="ruhak">

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/pulcsi_1.jpg" alt="Emojis pulóver">
            <h2>Emojis pulóver</h2>
            <p>12000Ft</p>
            <form method="post">
                <input type="hidden" name="termek" value="Emojis pulóver;12000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Emojis pulóver_12000">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/Kabat1.jpg" alt="Q&W kabát">
            <h2>Q&W kabát</h2>
            <p>20000Ft</p>
            <form method="post">
                <input type="hidden" name="termek" value="Q'&'W;20000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Q'&'W_20000">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/polo_1.jpg" alt="KCALB 8 póló">
            <h2>KCALB 8 póló</h2>
            <p>5000Ft</p>
            <form method="post">
                <input type="hidden" name="termek" value="KCALB 8 póló;5000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="KCALB 8 póló_5000">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/polo_2.jpg" alt="Dark line póló">
            <h2>Dark line póló</h2>
            <p>5300Ft</p>
            <form method="post">
                <input type="hidden" name="termek" value="Dark line póló;5300">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Dark line póló_5300">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/polo_3.jpg" alt="Breaking Bad póló">
            <h2>Breaking Bad póló</h2>
            <p>7000Ft</p>
            <form method="post">
                <input type="hidden" name="termek" value="Breaking Bad póló;7000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Breaking Bad póló_7000">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/nadrag_1.jpg" alt="Z&B nadrág">
            <h2>Z&B nadrág</h2>
            <p>10500Ft</p>s
            <form method="post">
                <input type="hidden" name="termek" value="Z&B nadrág;10500">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Z&B nadrág_10500">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/nadrag_2.jpg" alt="Laza utcai nadrág több színben">
            <h2>Laza utcai nadrág több színben</h2>
            <p>15000Ft</p>
            <form method="post">
                <input type="hidden" name="termek" value="Laza utcai nadrág több színben;15000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Laza utcai nadrág több színben_15000">
            </form>
        </div>

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