<?php
    session_start();
    include "functions.php";

    $successful_login = false;
    $err = "";
    $accounts = loadUsers();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        if (!empty($username) && !empty($password)) {
            if (!is_null($accounts)) {
                foreach ($accounts["users"] as $account) {
                    if ($username === $account["username"] && password_verify($password, $account["password"])) {
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
            $err = "<p class='signup'>Mindkét mező kitöltése kötelező!</p>";
            header("Location: ../login.php");
        }
    }

    if ($successful_login) {
        $_SESSION["user"] = $user_data;
        $_SESSION['logged_in'] = true;
        header("Location: ../profil.php");
        exit;
    } else {
        echo $err;
        header("Location: ../login.php");
    }
?>