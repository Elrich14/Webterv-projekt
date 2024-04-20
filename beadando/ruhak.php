<?php 
    require_once("./php/head.php");
    require("assets/functions/ruha_functions.php");

    $ruhak = loadRuhak();
?>

    <div class="ruhak">
        <?php
        foreach ($ruhak["ruhak"] as $ruha) {
            $nev = $ruha["ruhanev"];
            $ar = $ruha["ar"];
            $img = $ruha["img"];
        ?>
        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/<?php echo $img ?>" alt=<?php echo $nev ?>>
            <h2><?php echo $nev ?></h2>
            <p><?php echo $ar ?> Ft</p>
            <form method="post" action="assets/controller/ruha_controller.php">
                <input type="hidden" name="nev" value="<?php echo $nev ?>">
                <input type="hidden" name="ar" value="<?php echo $ar ?>">
                <input type="image" name="add_cart" src="./media/image/shopping-cart.webp" alt="<?php echo $nev.' '.$ar.' '.$img ?>">
            </form>
        </div>
        <?php   
        }
        ?>

    </div>

<?php require_once("./php/footer.php")?>