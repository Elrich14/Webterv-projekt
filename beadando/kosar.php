<?php
    require_once("./php/head.php");
    require("assets/functions/kosar_functions.php");
    
    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        $message = "Előbb jelentkezz be a fiókodba, hogy láthasd a kosarad.";
        header("Location: login.php");
        exit;
    }

    $ruhak = loadCart();
    if(!empty($ruhak)) {
        $total = sumCartPrice();
?>

    <div class='cart'>
        <table class='cart_table'>
        <tr>
            <th>Termék neve</th>
            <th>Ár</th>
            <th>Mennyiség</th>
            <th>Módosítás</th>
            <th>Törlés</th>
        </tr>
        <?php
        foreach ($ruhak["cart"] as $ruha) {
            $nev = $ruha["ruhanev"];
            $ar = $ruha["ar"];
            $db = $ruha["db"];
        ?>
        <tr>
            <td><?php echo $nev ?></td>
            <td><?php echo $ar ?> FT</td>
            <form method='post' action="assets/controller/cart_controller.php">
                <td><input type='number' name='db' min='0' value="<?php echo $db ?>"/></td>
                <input type='hidden' name='nev' value="<?php echo $nev ?>"/>
                <input type='hidden' name='ar' value="<?php echo $ar ?>"/>
                <td><input type='submit' name="change" value='Módosítása'/></td>
                <td><input type='submit'name="delete" value='Törlés'/></td>
            </form>
        </tr>
        <?php } ?>

        </table>
        <p class='osszeg'>Összesen: <?php echo $total ?> Ft</p>
    </div>
<?php } else { ?>
    <div class='cart'>
        <h2>Még nem raktál semmit semmit a kosaradba. Előbb helyezz el termékeket a kosaradba, hogy lásd a végösszeget.</h2>
    </div>
<?php } ?>
    
<?php require_once("./php/footer.php")?>