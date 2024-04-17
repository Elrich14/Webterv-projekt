<?php

function loadUsers($file) {
    $file = file_get_contents($file);
    $users = json_decode($file, true);
    return $users;
}

function saveUser($file, $data) {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); // hash the password before saving
    $file = fopen($file, "a");
    fwrite($file, json_encode($data). "\n");
    fclose($file);
}



function deleteUser($filenev, $kit) {
    $accounts = loadUsers("users.txt");
    $file = fopen($filenev, "w");
    fclose($file);

    foreach ($accounts as $account) {
        if (!($kit === $account["signup_email"])) {
            saveUser("users.txt", $account);
        }
    }
}

function changePassword($who, $newpsw) {
    $accounts = loadUsers("users.txt");

    $newpsw_successful = false;

    foreach ($accounts as $account) {
        if ($who === $account["signup_email"]) {
            $data = [
                "username" => $account["username"],
                "signup_email" => $account["signup_email"],
                "password" => $newpsw,
                "date_of_birth" => $account["date_of_birth"],
                "sex" => $account["sex"]
            ];
            $kit = $account["signup_email"];
            $newpsw_successful = true;
            break;
        }
    }
    if ($newpsw_successful) {
        deleteUser("users.txt", $kit);
        saveUser("users.txt", $data);
    }
}



?>