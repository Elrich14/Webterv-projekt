<?php
    function loadUsers($file):array {
        if (!file_exists($file))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($file);

        return json_decode($json, true);
    }

    function saveUser($file, $data) {
        $users = loadUsers($file);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); // hash the password before saving
        $users["users"][] = $data;

        $json_data = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($file, $json_data);
    }

    function deleteUser($file, $deleteUser) {
        $accounts = loadUsers("users.txt");
        $users = fopen($file, "w");
        fclose($users);

        foreach ($accounts["users"] as $account) {
            if (!($deleteUser === $account["username"])) {
                saveUser("users.txt", $account);
            }
        }
    }

    function changePassword($username, $newpsw) {
        $accounts = loadUsers("users.txt");

        $newpsw_successful = false;
        $kit=NULL;
        $data=NULL;

        foreach ($accounts["users"] as $account) {
            if ($username == $account["username"]) {
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

        echo $newpsw_successful;

        if ($newpsw_successful) {
            deleteUser("users.txt", $kit);
            saveUser("users.txt", $data);
        }
    }
?>

<?php 
    changePassword("norbi", "asdasdwdqsadwedsaw");
?>