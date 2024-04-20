<?php
    include ("../functions/kosar_functions.php");
    $errors = [];
    $cart = loadCart();


    deleteCart($_POST["nev"]);
    
    if (isset($_POST["change"])) {
        deleteCart($_POST["nev"]);
        if($_POST["db"]>0){
            $data = [
                "ruhanev"=> $_POST["nev"],
                "ar"=> $_POST["ar"],
                "db"=> $_POST["db"]
            ];
            saveCart($data);
        }
    }
    
    header("Location: ../../kosar.php");
?>