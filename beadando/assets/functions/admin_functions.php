<?php
    require_once "kosar_functions.php";
    $boughtFileURL = "json/soldProducts.json";

    function loadBoughtProducts() {
        global $boughtFileURL;
        if (!file_exists($boughtFileURL))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents($boughtFileURL);

        return json_decode($json, true);
    }

    function saveBoughtProduct($data) {
        global $boughtFileURL;
        $kosar = loadBoughtProducts();
        $kosar["eladott_ruhak"][] = $data;

        $json_data = json_encode($kosar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($boughtFileURL, $json_data);
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
?>