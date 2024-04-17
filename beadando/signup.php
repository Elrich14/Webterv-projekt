<?php
require_once("./php/head.php");
session_start();
include "Common.php";

if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
    header("Location: profil.php");
    exit;
}

$errors = [];
$accounts = loadUsers("users.txt");

if (isset($_POST["signup_submit"])) {
    $username = $_POST["username"];
    $signup_email = $_POST["signup_email"];
    $password = $_POST["password"];
    $password_check = $_POST["password_check"];
    $date_of_birth = $_POST["date_of_birth"];
    $sex = isset($_POST["sex"]) ? $_POST["sex"] : "";


    if (!isset($_POST["username"]) || trim($_POST["username"]) === "")
        $errors[] = "<p class='reg'>A felhasználónév megadása kötelező!</p> ";

    if (!isset($_POST["signup_email"]) || trim($_POST["signup_email"]) === "")
        $errors[] = "<p class='reg'>Az e-mail cím megadása kötelező!</p> ";

    if (!isset($_POST["password"]) || trim($_POST["password"]) === "")
        $errors[] = "<p class='reg'>A jelszó megadása kötelező!</p> ";

    if (!isset($_POST["password_check"]) || trim($_POST["password_check"]) === "")
        $errors[] = "<p class='reg'>A jelszó másodszori megadása kötelező!</p> ";

    if (!isset($_POST["date_of_birth"]) || trim($_POST["date_of_birth"]) === "")
        $errors[] = "<p class='reg'>A születési dátum megadása kötelező!</p> ";

        
    if (!isset($_POST["sex"]) || trim($_POST["sex"]) === "")
        $errors[] = "<p class='reg'>A nem megadása kötelező!</p> ";

    if (!filter_var($signup_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "<p class='reg'>Rossz e-mail formátum!</p>";
    }
    if (!is_null($accounts)) {
        foreach ($accounts as $account) {
            if ($account["username"] === $username) {
                $errors[] = "<p class='reg'>Ez a felhasználónév már foglalt!</p>";
            }
        }
    
        foreach ($accounts as $account) {
            if ($account["signup_email"] === $signup_email) {
                $errors[] = "<p class='reg'>Ezzel az e-mail címmel már regisztráltak!</p> ";
            }
        }
    }

    if (strlen($password) < 6) {
        $errors[] = "<p class='reg'>A jelszó legalább 6 karakter kell legyen!</p> ";
    }

    if (!preg_match('/[A-Za-z]/', $password) ||!preg_match('/[0-9]/', $password)) {
        $errors[] = "<p class='reg'>A jelszónak tartalmaznia kell betűt és számot is!</p> ";
    }

    if ($password!== $password_check) {
        $errors[] = "<p class='reg'>A jelszavak nem egyeznek!</p> ";
    }

    if (count($errors) === 0) {
        $data = [
            "username" => $username,
            "signup_email" => $signup_email,
            "password" => $password,
            "date_of_birth" => $date_of_birth,
            "sex" => $sex
        ];

        saveUser("users.txt", $data);
        echo "<p class='reg'>Sikeres regisztráció!</p> ";
    } else {
        foreach ($errors as $error) {
            echo $error;
        }
    }
}
?>

<div id="content">

    <div class="signup">
        <form action="signup.php" method="POST">
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