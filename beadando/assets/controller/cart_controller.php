<?php
    include ("../functions/kosar_functions.php");
    $errors = [];
    $cart = loadCart();

    if (isset($_POST["buy"])) {
        buyProducts();
        header("Location: ../../profil.php");
        exit;
    } 
    
    if (isset($_POST["change"])) {
        $data = [
            "ruhanev"=> $_POST["nev"],
            "ar"=> $_POST["ar"],
            "db"=> $_POST["db"]
        ];
        changeCart($data);
        
    } elseif(isset($_POST["delete"])){
        deleteCart($_POST["nev"]);
    }
    
    header("Location: ../../kosar.php");

?>