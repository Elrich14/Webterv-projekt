<?php 
    require_once("./php/head.php");
    include("assets/functions/admin_functions.php");

    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        $message = "Előbb jelentkezz be a fiókodba, hogy láthasd a kosarad.";
        header("Location: login.php");
        exit;
    } elseif($_SESSION["user"]["username"] != "ADMIN"){
        $message = "Előbb jelentkezz be a fiókodba, hogy láthasd a kosarad.";
        header("Location: profil.php");
        exit;
    }

    $ruhak = loadBoughtProducts();
    $totalSUM = 0;
    if(!empty($ruhak)) {
?>

    <div class='admin-page'>
        <div class="sold-products">
            <h2>Összes eladott ruha</h2>
            <table class='sold-table'>
                <tr>
                    <th>Termék neve</th>
                    <th>Eladott mennyiség</th>
                    <th>Ár</th>
                    <th>Összesen</th>
                </tr>
                <?php
                foreach ($ruhak["eladott_ruhak"] as $ruha) {
                    global $totalSum;
                    $nev = $ruha["ruhanev"];
                    $ar = $ruha["ar"];
                    $db = $ruha["db"];
                    $sum = $ar*$db;
                    $totalSum += $sum;
                ?>
                <tr>
                    <td><?php echo $nev ?></td>
                    <td><?php echo $db ?> FT</td>
                    <td><?php echo $ar ?> FT</td>
                    <td><?php echo $sum ?> FT</td>
                </tr>
                <?php } ?>
            </table>
            <div class="sold-sum">
                <strong>Összesített érték: <?php echo $totalSum ?> Ft</strong>
            </div>
        </div>
    </div>
<?php } else { ?>   
    <div class='admin-page'>
        <h2>Sajnos Még nem vásároltak semmit.</h2>
    </div>
<?php } ?>
    
<?php require_once("./php/footer.php")?>