<?php
    function loadUsers() {
        if (!file_exists("json/users.json"))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents("json/users.json");

        return json_decode($json, true);
    }

    function saveUser($data) {
        $users = loadUsers();
        $users["users"][] = $data;

        $json_data = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents("json/users.json", $json_data);
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
        $accounts = loadUsers();
        $users = fopen("json/users.json", "w");
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