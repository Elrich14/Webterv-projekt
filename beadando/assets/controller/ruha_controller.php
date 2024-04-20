<?php
    include ("../functions/kosar_functions.php");
    $errors = [];
    $cart = loadCart();
    $db=isRuhaInCart($_POST["nev"]);

    if (isset($_POST["nev"]) && $_POST["ar"]) {
        $data = [
            "ruhanev"=> $_POST["nev"],
            "ar"=> $_POST["ar"],
            "db"=> ($db!=0) ? $db+1 : 1,
        ];

        if($db==0){
            saveCart($data);
        }else{
            changeCart($data);
        }
        header("Location: ../../ruhak.php");
    }

?>