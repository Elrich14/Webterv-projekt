<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once "admin_functions.php";
    
    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $page = end($parts);

    $cartURL = (!isset($_SESSION["user"])) ? "json/tmpCart.json" : "json/userdata/" . $_SESSION["user"]["username"] . "/cart.json"; 
    $boughtURL = (!isset($_SESSION["user"])) ? NULL : "json/userdata/" . $_SESSION["user"]["username"] . "/bought.json";
    $allSellsURL = "json/soldProducts.json";

    if ($page === "ruha_controller.php" || $page == "cart_controller.php" || $page == "login_controller.php") {
        $cartURL = "../../" . ((!isset($_SESSION["user"])) ? ("json/tmpCart.json") : ("json/userdata/" . $_SESSION["user"]["username"] . "/cart.json")); 
        $boughtURL = "../../" . ((!isset($_SESSION["user"])) ? NULL : "json/userdata/" . $_SESSION["user"]["username"] . "/bought.json");
        $allSellsURL = "../../json/soldProducts.json";
    }

    function loadCart() {
        global $cartURL;
        if (!file_exists($cartURL))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($cartURL);

        return json_decode($json, true);
    }

    function loadBought() {
        global $boughtURL;
        if (!file_exists($boughtURL))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($boughtURL);

        return json_decode($json, true);
    }

    function saveCart($data) {
        global $cartURL;
        if (isset($_SESSION["user"])) {
            $cartURL = "../../json/userdata/" . $_SESSION["user"]["username"] . "/cart.json"; 
        }

        $kosar = loadCart();
        $kosar["cart"][] = $data;

        $json_data = json_encode($kosar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
        file_put_contents($cartURL, $json_data);
    }

    function saveBought($data) {
        global $boughtURL;
        if (isset($_SESSION["user"])) {
            $boughtURL = "../../json/userdata/" . $_SESSION["user"]["username"] . "/bought.json";
        }

        $date = date("Y-M-d, G:i");
        $kosar = loadBought();

        $kosar["eladott_ruhak"][$date][] = $data;

        $json_data = json_encode($kosar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
        file_put_contents($boughtURL, $json_data);
    }

    function sumCartPrice(){
        global $cartURL;
        $kosar = loadCart();
        $sum = 0;
        foreach($kosar["cart"] as $ruha){
            $sum += $ruha["ar"] * $ruha["db"];
        }
        return $sum;
    }

    function isRuhaInCart($nev){
        $kosar = loadCart();
        $is=0;
        if(!empty($kosar)){
            foreach($kosar["cart"] as $ruha){
                if($ruha["ruhanev"] === $nev){
                    $is=$ruha["db"];
                }
            }
        }
        return $is;
    }

    function deleteCart($deleteCartName) {
        global $cartURL;
        $ruhak = loadCart();
        $cart = fopen($cartURL, "w");
        fclose($cart);

        foreach ($ruhak["cart"] as $ruha) {
            if (!($deleteCartName === $ruha["ruhanev"])) {
                saveCart($ruha);
            }
        }
    }

    function changeCart($data) {
        global $cartURL;
        $ruhak = loadCart();
        $resetCart = fopen($cartURL, "w");
        fclose($resetCart);

        if(!is_null($ruhak)) {
            foreach ($ruhak["cart"] as &$ruha) {
                if ($ruha["ruhanev"] === $data["ruhanev"])  {
                    $ruha["db"] = $data["db"];
                }
            }
        }
        
        foreach($ruhak["cart"] as $ujruha){
            if($ujruha["db"] > 0){
                saveCart($ujruha);
            }
        }
    }

    function buyProducts(){
        global $cartURL;
        global $allSellsURL;

        $ruhak = loadCart();
        $resetCart = fopen($cartURL, "w");
        fclose($resetCart);

        $soldProducts = loadBoughtProducts();
        $resetSoldProducts = fopen($allSellsURL, "w");
        fclose($resetSoldProducts);
        
        if(is_null($soldProducts)) {
            foreach($ruhak["cart"] as $ruha) {
                saveBoughtProduct($ruha);
            }
        } else {
            foreach ($ruhak["cart"] as $ruha) {
                $bennevan=false;
                //ha benne van módosítani
                foreach($soldProducts["eladott_ruhak"] as &$soldProduct){
                    if ($soldProduct["ruhanev"] === $ruha["ruhanev"]) {
                        $soldProduct["db"] += $ruha["db"];
                        $bennevan = true;
                        break;
                    }
                }
                //ha nincs benne, hozzáadni
                if (!$bennevan) {
                    $soldProducts["eladott_ruhak"][] = $ruha;
                }
            }
            //majd az egészet bemásolni.
            foreach($soldProducts["eladott_ruhak"] as $sold){
                saveBoughtProduct($sold);
            }
        }

        //uj dátum, ezért nem kell fölöslegesen másolgatni
        foreach($ruhak["cart"] as $cloth){
            saveBought($cloth);
        }
    }
?>