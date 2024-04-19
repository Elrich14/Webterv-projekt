<?php
    require_once("./php/head.php");

    if (isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
        header("Location: profil.php");
        exit;
    }

?>

<div id="content">

    <div class="signup">
        <form action="signup_controller.php" method="POST">
            <fieldset>
                <legend>Regisztráció</legend>
                <label for="username">Felhasználónév:</label> <br>
                <input type="text" id="username" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"> <br>
                <label for="signup_email">E-mail:</label> <br>
                <input type="text" id="signup_email" name="signup_email" value="<?php if (isset($_POST['signup_email'])) echo $_POST['signup_email']; ?>"> <br>
                <label for="password">Jelszó:</label> <br>
                <input type="password" id="password" name="password"> <br>
                <label for="password_check">Jelszó újra:</label> <br>
                <input type="password" id="password_check" name="password_check"> <br>
                <label for="date_of_birth">Születési dátum:</label> <br>
                <input type="date" id="date_of_birth" name="date_of_birth"> <br>
                Nem:<br>
                    <label for="F">Férfi:</label>
                    <input type="radio" id="F" name="sex" value="F" <?php if (isset($_POST['sex']) && $_POST['sex'] === 'F') echo 'checked'; ?>>
                    <label for="N">Nő:</label>
                    <input type="radio" id="N" name="sex" value="N" <?php if (isset($_POST['sex']) && $_POST['sex'] === 'N') echo 'checked'; ?>>
                    <label for="E">Egyéb:</label>
                    <input type="radio" id="E" name="sex" value="E" <?php if (isset($_POST['sex']) && $_POST['sex'] === 'E') echo 'checked'; ?>>

                    <input type="reset" name="signup_reset" id="signup_reset" value="Alaphelyzet">
                <input type="submit" name="signup_submit" value="Regisztráció">
            </fieldset>
        </form>
    </div>
</div>

<?php require_once("./php/footer.php")?>