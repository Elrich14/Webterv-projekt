<?php
    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $page = end($parts);
    $fileURL = "json/cart.json";
    $boughtFileURL = "json/soldProducts.json";


    if($page === "ruha_controller.php" || $page == "cart_controller.php"){
        $fileURL = "../../json/cart.json";
        $boughtFileURL = "../../json/soldProducts.json";

    }

    function loadCart() {
        global $fileURL;
        if (!file_exists($fileURL))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($fileURL);

        return json_decode($json, true);
    }
    
    function loadBoughtProducts() {
        global $boughtFileURL;
        if (!file_exists($boughtFileURL))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($boughtFileURL);

        return json_decode($json, true);
    }

    function saveCart($data) {
        global $fileURL;
        $kosar = loadCart();
        $kosar["cart"][] = $data;

        $json_data = json_encode($kosar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($fileURL, $json_data);
    }

    function saveBoughtProduct($data) {
        global $boughtFileURL;
        $kosar = loadBoughtProducts();
        $kosar["eladott_ruhak"][] = $data;

        $json_data = json_encode($kosar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($boughtFileURL, $json_data);
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

    function deleteProduct($deleteProductName) {
        global $boughtFileURL;
        $products = loadCart();
        $resetProduct = fopen($boughtFileURL, "w");
        fclose($resetProduct);

        foreach ($products["cart"] as $product) {
            if (!($deleteProductName === $product["ruhanev"])) {
                saveCart($product);
            }
        }
    }

    function changeCart($data) {
        global $fileURL;
        $ruhak = loadCart();
        $resetCart = fopen($fileURL, "w");
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
        global $fileURL;
        global $boughtFileURL;
        $ruhak = loadCart();
        $resetCart = fopen($fileURL, "w");
        fclose($resetCart);

        $soldProducts = loadBoughtProducts();
        $resetSoldProducts = fopen($boughtFileURL, "w");
        fclose($resetSoldProducts);
        
        if(is_null($soldProducts)) {
            foreach($ruhak as $ruha) {
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
    }
?>