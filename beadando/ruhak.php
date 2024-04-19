<?php require_once("./php/head.php"); ?>

<?php
if (isset($_POST['termek'])) {
    $termek = $_POST['termek'];
    $kosar = fopen("cart.txt", "r+");
    $van = false;
    while (($sor = fgets($kosar)) !== false) {
        if (strpos($sor, $termek) === 0) {
            $darab = intval(substr($sor, strrpos($sor, ";") + 1));
            fseek($kosar, -strlen($sor), SEEK_CUR);
            fwrite($kosar, $termek . ";" . ($darab + 1) . "\n");
            $van = true;
            break;
        }
    }
    if (!$van) {
        fwrite($kosar, $termek . ";1\n");
    }
    fclose($kosar);
}
?>

    <div class="ruhak">

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/pulcsi_1.jpg" alt="Emojis pulóver">
            <h2>Emojis pulóver</h2>
            <p>12000Ft</p>
            <form method="post" action="">
                <input type="hidden" name="termek" value="Emojis pulóver;12000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Emojis pulóver_12000">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/Kabat1.jpg" alt="Q&amp;W kabát">
            <h2>Q&amp;W kabát</h2>
            <p>20000Ft</p>
            <form method="post" action="">
                <input type="hidden" name="termek" value="Q&amp;W;20000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Q&amp;W_20000">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/polo_1.jpg" alt="KCALB 8 póló">
            <h2>KCALB 8 póló</h2>
            <p>5000Ft</p>
            <form method="post" action="">
                <input type="hidden" name="termek" value="KCALB 8 póló;5000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="KCALB 8 póló_5000">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/polo_2.jpg" alt="Dark line póló">
            <h2>Dark line póló</h2>
            <p>5300Ft</p>
            <form method="post" action="">
                <input type="hidden" name="termek" value="Dark line póló;5300">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Dark line póló_5300">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/polo_3.jpg" alt="Breaking Bad póló">
            <h2>Breaking Bad póló</h2>
            <p>7000Ft</p>
            <form method="post" action="">
                <input type="hidden" name="termek" value="Breaking Bad póló;7000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Breaking Bad póló_7000">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/nadrag_1.jpg" alt="Z&amp;B nadrág">
            <h2>Z&amp;B nadrág</h2>
            <p>10500Ft</p>s
            <form method="post" action="">
                <input type="hidden" name="termek" value="Z&amp;B nadrág;10500">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Z&B nadrág_10500">
            </form>
        </div>

        <div class="picture-box">
            <img class="gallery" src="media/ruha_img/nadrag_2.jpg" alt="Laza utcai nadrág több színben">
            <h2>Laza utcai nadrág több színben</h2>
            <p>15000Ft</p>
            <form method="post" action="">
                <input type="hidden" name="termek" value="Laza utcai nadrág több színben;15000">
                <input type="image" src="./media/image/shopping-cart.webp" alt="Laza utcai nadrág több színben_15000">
            </form>
        </div>
    </div>

<?php require_once("./php/footer.php")?>