<?php
    session_start();
    include "functions.php";

    $errors = [];
    $accounts = loadUsers();

    if (isset($_POST["signup_submit"])) {
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

        if (!filter_var($_POST["signup_email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "<p class='reg'>Rossz e-mail formátum!</p>";
        }

        $username = $_POST["username"];
        $signup_email = $_POST["signup_email"];
        $password = $_POST["password"];
        $password_check = $_POST["password_check"];
        $date_of_birth = $_POST["date_of_birth"];
        $sex = isset($_POST["sex"]) ? $_POST["sex"] : "";

        if(!empty($accounts)) {
            foreach ($accounts["users"] as $account) {
                if ($account["username"] === $username) {
                    $errors[] = "<p class='reg'>Ez a felhasználónév már foglalt!</p>";
                }
            }
                
            foreach ($accounts["users"] as $account) {
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
            $password = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                "username" => $username,
                "signup_email" => $signup_email,
                "password" => $password,
                "date_of_birth" => $date_of_birth,
                "sex" => $sex
            ];

            saveUser($data);
            header("Location: ../login.php");
        } else {
            foreach ($errors as $error) {
                echo $error;
            }
        }
    }
?>