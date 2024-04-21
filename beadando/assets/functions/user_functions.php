<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once "kosar_functions.php";
    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $page = end($parts);
    $usersURL = "json/users.json";

    if($page === "profil_controller.php" || $page === "login_controller.php" || $page === "signup_controller.php"){
        $usersURL = "../../json/users.json";
    }

    function loadUsers() {
        global $usersURL;
        if (!file_exists($usersURL))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($usersURL);

        return json_decode($json, true);
    }

    function loadData($url) {
        if (!file_exists($url))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($url);

        return json_decode($json, true);
    }

    function saveUser($data) {
        global $usersURL;

        //felhasználó adatainak mentése a users.json fájlba
        $users = loadUsers();
        $users["users"][] = $data;

        $json_data = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($usersURL, $json_data);
    }

    function createFolderandJson($name){
        $userFolder = "../../json/userdata/" . $name . "/";
        $usercartJsonFileURL = "../../json/userdata/" . $name . "/cart.json";
        $userboughtJsonFileURL = "../../json/userdata/" . $name . "/bought.json";
        
        //mappa létrehozás
        if (!is_dir($userFolder)) {
            mkdir($userFolder, 0777, true);
        }

        //JSON file létrehozása felhasználónak, kosár és vásárolt
        $usercartJson["cart"] = array();
        $userboughtJson["eladott_ruhak"] = array();
        $usercartJson_data = json_encode($usercartJson, JSON_PRETTY_PRINT);
        $userboughtJson_data = json_encode($userboughtJson, JSON_PRETTY_PRINT);

        if(!file_put_contents($usercartJsonFileURL, $usercartJson_data)){
            echo "Nem sikerült a cart.<br>";
        }
        if(!file_put_contents($userboughtJsonFileURL, $userboughtJson_data)){
            echo "Nem sikerült a bought.<br>";
        }
    }

    function changePassword($username, $newpsw) {
        global $usersURL;
        $accounts = loadUsers();
        $users = fopen($usersURL, "w");
        fclose($users);

        if (!is_null($accounts)) {
            foreach($accounts["users"] as &$account) {
                if ($username === $account["username"]) {
                    $account["password"] = $newpsw;
                    break;
                }
            }  
        }

        foreach($accounts["users"] as $user){
            saveUser($user);
        }
    }

    function deleteUser($deleteUser) {
        global $usersURL;
        $accounts = loadUsers();
        $users = fopen($usersURL, "w");
        fclose($users);

        foreach ($accounts["users"] as $account) {
            if (!($deleteUser === $account["username"])) {
                saveUser($account);
            }
        }

        //felhasználó mappa törlése
        if(!deleteFolder("../../json/userdata/" . $deleteUser . "/")){
            echo "nem sikerült a mappa törlése";
        }

        session_destroy();
    }

    function deleteFolder($folderPath) {
        if (is_dir($folderPath)) {
            $files = array_diff(scandir($folderPath), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$folderPath/$file")) ? deleteFolder("$folderPath/$file") : unlink("$folderPath/$file");
            }
            return rmdir($folderPath);
        }
        return false;
    }

    function logout(){
        //kijelentkezés
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
    }

    function checkCart(){
        $userCartURL = "../../json/userdata/" . $_SESSION["user"]["username"] . "/cart.json";
        $tmpCartURL = "../../json/TmpCart.json";
        $tmpCart = loadData($tmpCartURL);
        
        //Ha üres a tmpcart
        if(!empty($tmpCart)){
            $oldCart = fopen($userCartURL, "w");
            fclose($oldCart);
            foreach($tmpCart["cart"] as $cart){
                saveCart($cart);
            }
        }
    }
    
?>