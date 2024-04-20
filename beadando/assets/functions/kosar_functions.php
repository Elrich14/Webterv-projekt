<?php
    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $page = end($parts);
    $fileURL = "json/cart.json";

    if($page === "ruha_controller.php" || $page == "cart_controller.php"){
        $fileURL = "../../json/cart.json";
    }

    function loadCart() {
        global $fileURL;
        if (!file_exists($fileURL))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($fileURL);

        return json_decode($json, true);
    }

    function saveCart($data) {
        global $fileURL;
        $kosar = loadCart();
        $kosar["cart"][] = $data;

        $json_data = json_encode($kosar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($fileURL, $json_data);
    }

    function sumCartPrice(){
        global $fileURL;
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
        global $fileURL;
        $ruhak = loadCart();
        $cart = fopen($fileURL, "w");
        fclose($cart);

        foreach ($ruhak["cart"] as $ruha) {
            if (!($deleteCartName === $ruha["ruhanev"])) {
                saveCart($ruha);
            }
        }
    }

    function changeCart($data) {
        $ruhak = loadCart();

        if (!is_null($ruhak)) {
            foreach($ruhak["cart"] as $ruha) {
                if ($data["ruhanev"] === $ruha["ruhanev"]) {
                    deleteCart($ruha["ruhanev"]);
                    saveCart($data);
                    break;
                }
            }  
        }
    }
?>