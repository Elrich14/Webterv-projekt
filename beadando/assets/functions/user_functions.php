<?php

    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $page = end($parts);
    $fileURL = "json/users.json";

    if($page === "profil_controller.php" || $page === "login_controller.php" || $page === "signup_controller.php"){
        $fileURL = "../../json/users.json";
    }

    function loadUsers() {
        global $fileURL;
        if (!file_exists($fileURL))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($fileURL);

        return json_decode($json, true);
    }

    function saveUser($data) {
        global $fileURL;
        $users = loadUsers();
        $users["users"][] = $data;

        $json_data = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($fileURL, $json_data);
    }

    function changePassword($username, $newpsw) {
        $accounts = loadUsers();

        if (!is_null($accounts)) {
            foreach($accounts["users"] as $account) {
                if ($username === $account["username"]) {
                    $data = [
                        "username" => $account["username"],
                        "signup_email" => $account["signup_email"],
                        "password" => $newpsw,
                        "date_of_birth" => $account["date_of_birth"],
                        "sex" => $account["sex"]
                    ];
                    deleteUser($account["username"]);
                    saveUser($data);
                    break;
                }
            }  
        }
    }

    function deleteUser($deleteUser) {
        global $fileURL;
        $accounts = loadUsers();
        $users = fopen($fileURL, "w");
        fclose($users);

        foreach ($accounts["users"] as $account) {
            if (!($deleteUser === $account["username"])) {
                saveUser($account);
            }
        }
        
        session_destroy();
        header("Location: ../../index.php");
    }

    function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
    }
?>