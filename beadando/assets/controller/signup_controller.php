<?php
session_start();
include "../functions/user_functions.php";

$errors = [];
$accounts = loadUsers();

if (isset($_POST["signup_submit"])) {
    if (!isset($_POST["username"]) || trim($_POST["username"]) === "")
        $_SESSION["messages"][] = [
            "message" => "A felhasználónév megadása kötelező!",
            "type" => "danger"
        ];

    if (!isset($_POST["signup_email"]) || trim($_POST["signup_email"]) === "")
        $_SESSION["messages"][] = [
            "message" => "Az e-mail cím megadása kötelező!",
            "type" => "danger"
        ];

    if (!isset($_POST["password"]) || trim($_POST["password"]) === "")
        $_SESSION["messages"][] = [
            "message" => "A jelszó megadása kötelező!",
            "type" => "danger"
        ];

    if (!isset($_POST["password_check"]) || trim($_POST["password_check"]) === "")
        $_SESSION["messages"][] = [
            "message" => "A jelszó másodszori megadása kötelező!",
            "type" => "danger"
        ];

    if (!isset($_POST["date_of_birth"]) || trim($_POST["date_of_birth"]) === "")
        $_SESSION["messages"][] = [
            "message" => "A születési dátum megadása kötelező!",
            "type" => "danger"
        ];
        
    if (!isset($_POST["sex"]) || trim($_POST["sex"]) === "")
        $_SESSION["messages"][] = [
            "message" => "A nem megadása kötelező!",
            "type" => "danger"
        ];

    if (!filter_var($_POST["signup_email"], FILTER_VALIDATE_EMAIL)) {
        $_SESSION["messages"][] = [
            "message" => "Rossz e-mail formátum!",
            "type" => "danger"
        ];
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
                $_SESSION["messages"][] = [
                    "message" => "Ez a felhasználónév már foglalt!",
                    "type" => "danger"
                ];
            }
        }
            
        foreach ($accounts["users"] as $account) {
            if ($account["signup_email"] === $signup_email) {
                $_SESSION["messages"][] = [
                    "message" => "Ezzel az e-mail címmel már regisztráltak!",
                    "type" => "danger"
                ];
            }
        }
    }

    if (strlen($password) < 6) {
        $_SESSION["messages"][] = [
            "message" => "A jelszó legalább 6 karakter kell legyen!",
            "type" => "danger"
        ];
    }

    if (!preg_match('/[A-Za-z]/', $password) ||!preg_match('/[0-9]/', $password)) {
        $_SESSION["messages"][] = [
            "message" => "A jelszónak tartalmaznia kell betűt és számot is!",
            "type" => "danger"
        ];
    }

    if ($password!== $password_check) {
        $_SESSION["messages"][] = [
            "message" => "A jelszavak nem egyeznek!",
            "type" => "danger"
        ];
    }

    if (count($_SESSION["messages"]) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            "username" => $username,
            "signup_email" => $signup_email,
            "password" => $password,
            "date_of_birth" => $date_of_birth,
            "sex" => $sex
        ];

        saveUser($data);
        createFolderandJson($username);
        
        $_SESSION["messages"][] = [
            "message" => "Sikeres regisztráció!",
            "type" => "success"
        ];
        header("Location: ../../login.php");
    } else {
        header("Location: ../../signup.php");
    }
}
?>
