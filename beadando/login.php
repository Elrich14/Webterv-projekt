<?php
require_once("./php/head.php");
session_start();
include "Common.php";

if (isset($_SESSION["user"]) &&!empty($_SESSION["user"])) {
    header("Location: profil.php");
    exit;
}

$successful_login = false;
$err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!empty($username) && !empty($password)) {
        $accounts = loadUsers("users.txt");

        if (!is_null($accounts)) {
            foreach ($accounts as $account) {
                if ($username == $account["username"] && password_verify($password, $account["password"])) {
                    
                        // a jelszavak egyeznek
                        $user_data["username"] = $account["username"];
                        $user_data["signup_email"] = $account["signup_email"];
                        $user_data["password"] = $account["password"];
                        $user_data["password_check"] = $account["password_check"];
                        $user_data["date_of_birth"] = $account["date_of_birth"];
                        $successful_login = true;
                        break;
                                            
                }else{
                    // a jelszavak nem egyeznek
                    $err = "<p class='signup'> Hibás felhasználónév vagy jelszó!</p>";
                }
            }
        }
    } else {
        echo "Mindkét mező kitöltése kötelező.";
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
?>

<div class="login">
    <form action="login.php" method="POST">
        <fieldset>
            <legend>Jelentkezz be</legend>

            <label for="username">Felhasználónév:</label> <br>
            <input type="text" id="username" name="username" placeholder="Pl.: felhasznalo123"> <br>

            <label for="passw">Jelszó:</label> <br>
            <input type="password" id="passw" name="password" minlength="6" placeholder="Min. 6 karakter"> <br>

            <input type="reset" id="login_reset" value="Adatok törlése">
            <input type="submit" name="login_submit" id="login_submit" value="Belépés">
            <br><br>
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