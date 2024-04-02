<?php
require_once("./php/head.php");
session_start();
include "Common.php";

if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
    header("Location: profil.php");
    exit;
}
?>
    <!--egyeztetni kell a régivel   -->
    
    <div class="login">
        <form action="login.php" method="POST">
            <fieldset>
                <legend>Jelentkezz be</legend>

                <label for="username">Felhasználónév:</label> <br>
                <input type="text" id="username" name="username" placeholder="Pl.: felhasznalo123"> <br>

                <label for="signup_email">Email cím:</label> <br>
                <input type="email" id="signup_email" name="signup_email" placeholder="asd@gmail.com"> <br>

                <label for="passw">Jelszó:</label> <br>
                <input type="password" id="passw" name="password" minlength="6" placeholder="Min. 6 karakter"> <br>

                <input type="reset" id="login_reset" value="Adatok törlése">
                <input type="submit" name="login_submit" id="login_submit" value="Belépés">
                <br><br>
                <?php
                $accounts = loadUsers("users.txt");

                if(isset($_POST["login_submit"])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];


                    $err = "<p class='signup'> Hibás felhasználónév vagy jelszó!</p>";

                    $user_data = array();
                    $successful_login = false;

                    foreach ($accounts as $account) {
                        if ($username == $account["username"] && $password == $account["password"]) {
                            $user_data["username"] = $account["username"];
                            $user_data["signup_email"] = $account["signup_email"];
                            $user_data["password"] = $account["password"];
                            $user_data["password_check"] = $account["password_check"];
                            $user_data["date_of_birth"] = $account["date_of_birth"];
                            $successful_login = true;
                            break;
                        }
                    }

                    if ($successful_login) {
                        $_SESSION["user"] = $user_data;
                        $_SESSION['logged_in'] = true;
                        header("Location: profil.php");
                        exit;
                    } else {
                        echo $err;
                    }
                }
                ?>
                Még nincs profilod?
                <a href="signup.php">Regisztrálj ITT!</a>
            </fieldset>
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