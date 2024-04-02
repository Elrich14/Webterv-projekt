<?php

function loadUsers($filenev) {
    $users = [];

    $file = fopen($filenev, "r");

    while (($line = fgets($file)) !== false) {
        $users[] = unserialize($line);
    }

    fclose($file);

    return $users;
}

function saveUser($filenev, $user) {
    $file = fopen($filenev, "a");

    fwrite($file, serialize($user) . "\n");

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