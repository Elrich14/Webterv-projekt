<?php
    require_once("./php/head.php");

    if (isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
        header("Location: profil.php");
        exit;
    }
?>

<div class="login">
    <form action="controller/login_controller.php" method="POST">
        <fieldset>
            <legend>Jelentkezz be</legend>

            <label for="username">Felhasználónév:</label> <br>
            <input type="text" id="username" name="username" placeholder="Pl.: felhasznalo123"> <br>

            <label for="passw">Jelszó:</label> <br>
            <input type="password" id="passw" name="password" minlength="6" placeholder="Min. 6 karakter"> <br>

            <input type="submit" name="login_submit" id="login_submit" value="Belépés">
            <br><br>
            <p>Még nincs profilod? <a href="signup.php">Regisztrálj ITT!</a></p>
        </fieldset>
    </form>
</div>

<?php require_once("./php/footer.php")?>