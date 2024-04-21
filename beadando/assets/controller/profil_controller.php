<?php
    session_start();
    include "../functions/user_functions.php";

    $accounts = loadUsers();
    $errors = [];

    if (isset($_POST["delete"])) {
        deleteUser($_SESSION["user"]["username"]);
        header("Location: ../../index.php");
    }

    if (isset($_POST["logout"])) {
        logout();
    }

    if (isset($_POST["pswchange"])) {
        $oldpassword = $_POST["old"];
        $newpassword = $_POST["new"];
        $newpassword_check = $_POST["password_check"];
        $currentuser = $_SESSION["user"]["username"];

        $old_successful = false;

        foreach ($accounts["users"] as $account) {
            if ($currentuser === $account["username"] && password_verify($oldpassword, $account["password"])) {
                $old_successful = true;
                break;
            }
        }

        if (!$old_successful) {
            $errors[] = "<p>Hibás régi jelszó!</p>";
        } else {
            if (strlen($newpassword) < 6) {
                $errors[] = "<p>A jelszónak legalább 6 karakternek kell lennie!</p>";
            }
    
            if (!preg_match('/[A-Za-z]/',$newpassword) || !preg_match('/[0-9]/',$newpassword)) {
                $errors[] = "<p>A jelszónak tartalmaznia kell betűt, és számot is!</p>";
            }

            if ($newpassword!== $newpassword_check) {
                $errors[] = "<p class='reg'>A jelszavak nem egyeznek!</p> ";
            }
        }

        if (count($errors) === 0) {
            echo "<p>Sikeres jelszóváltoztatás!</p>";
            $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
            changePassword($currentuser, $newpassword);
            logout();
            exit;
        } else {
            foreach ($errors as $error) {
                echo $error;
            }
        }

    }
?>