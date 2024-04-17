<?php
require_once("./php/head.php");
include "Common.php";

session_start();
if (isset($_SESSION["user"]) && empty($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

?>

    <!-- Még szerkeszteni kell -->

    <div class="profil">
        <a href="logout.php"><button type="submit" name="logout" id="logout">Kijelentkezés</button></a>

        <h2>A felhasználó adatai:</h2>
        <?php
        $accounts = loadUsers("users.txt");

        echo "<ul>";
        echo "<li><b>Felhasználónév: </b>" . $_SESSION["user"]["username"] . "</li>";
        echo "<li><b>E-mail: </b>" . $_SESSION["user"]["signup_email"] . "</li>";
        echo "<li><b>Jelszó: </b>" . $_SESSION["user"]["password"] . "</li>";
        echo "</ul>";

        ?>

        <form action="profil.php" method="POST" enctype="multipart/form-data" >
            <h3>Jelszóváltás:</h3><br><br><br>
            <label for="oldpsw">Add meg a régi jelszavad!</label> <br>
            <input type="password" placeholder="Régi jelszó" name="old" id="oldpsw" required><br>

            <label for="newpsw">Add meg az új jelszavad!<br>(Min. 6 karakter, tartalmaznia kell  számot és betűt is)</label><br>
            <input type="password" placeholder="Új jelszó" name="new" id="newpsw" required>

            <br>
            <input type="submit" name="pswchange" id="pswchange" value="Új jelsző létrehozása">

            <?php

            $accounts = loadUsers("users.txt");
            $errors = [];

            if (isset($_POST["delete"])) {
                deleteUser("users.txt", $_SESSION["user"]["signup_email"]);
                session_destroy();
                header("Location: login.php");
                exit;
            }

            if (isset($_POST["pswchange"])) {
                $oldpassword = $_POST["old"];
                $newpassword = $_POST["new"];
                $current_email = $_SESSION["user"]["signup_email"];

                $old_successful = false;

                foreach ($accounts as $account) {
                    if ($current_email === $account["signup_email"] && $oldpassword === $account["password"]) {
                        $old_successful = true;
                        break;
                    }
                }

                if (!$old_successful) {
                    $errors[] = "<p>Hibás régi jelszó!</p>";
                }

                if (strlen($newpassword) < 6) {
                    $errors[] = "<p>A jelszónak legalább 6 karakternek kell lennie!</p>";
                }

                if (!preg_match('/[A-Za-z]/',$newpassword) || !preg_match('/[0-9]/',$newpassword)) {
                    $errors[] = "<p>A jelszónak tartalmaznia kell betűt, és számot is!</p>";
                }

                if (count($errors) === 0) {
                    echo "<p>Sikeres jelszóváltoztatás!</p>";
                    changePassword($current_email, $newpassword);
                } else {
                    foreach ($errors as $error) {
                        echo $error;
                    }
                }

            }

            ?>
        </form>

        <form method="POST" id="del">
            <label for="delete"><b>Fiók törlése:</b></label><br>
            <input type="submit" name="delete" id="delete" value="Fiok törlés"></input>
        </form>

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