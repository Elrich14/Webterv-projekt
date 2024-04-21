<?php
    require_once("./php/head.php");
    include_once("assets/functions/kosar_functions.php");

    $ruhak = loadCart();
    $hasItems = !empty($ruhak);
    if($hasItems) {
        $total = sumCartPrice();
?>

<div class='cart'>
    <h2 class="cart-heading">Kosár</h2>
    <form method='post' action="assets/controller/cart_controller.php">
        <div class="cart-table-container">
            <table class='cart_table'>
                <tr>
                    <th>Termék neve</th>
                    <th>Ár</th>
                    <th>Mennyiség</th>
                    <th>Módosítás</th>
                    <th>Törlés</th>
                </tr>
                <?php foreach ($ruhak["cart"] as $ruha) { ?>
                <tr>
                    <td><?php echo $ruha["ruhanev"] ?></td>
                    <td><?php echo $ruha["ar"] ?> FT</td>
                    <td>
                        <input type='number' name='db' min='0' value="<?php echo $ruha["db"] ?>">
                        <input type='hidden' name='nev' value="<?php echo $ruha["ruhanev"] ?>">
                        <input type='hidden' name='ar' value="<?php echo $ruha["ar"] ?>">
                    </td>
                    <td><input type='submit' name="change" class="change_cart" value='Módosítása'></td>
                    <td><input type='submit' name="delete" class="del_cart" value='Törlés'></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="summary">
            <p class='osszeg'>Összesen: <?php echo $total ?> Ft</p>
            <?php if(isset($_SESSION["user"])) { ?>
                <input type="submit" name="buy" id="buy-button" value="Vásárlás">
            <?php } else { ?>
                <input type="submit" name="buy" id="buy-button" value="Előbb jelentkezz be">
            <?php } ?>
        </div>
    </form>
</div>

<?php } else { ?>
    <div class='cart'>
        <h2 class="cart-heading">Kosár</h2>
        <h2>Még nem raktál semmit a kosaradba. Előbb helyezz el termékeket a kosaradba, hogy lásd a végösszeget.</h2>
    </div>
<?php } ?>

<?php require_once("./php/footer.php")?>
