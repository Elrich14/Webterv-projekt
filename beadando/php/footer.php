<?php
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$page = end($parts);
?>
<?php
$file_path = __FILE__;
$directory = dirname($file_path);
if ($directory === './') {
    $folder = "..";
} else {
    $folder = ".";
}
?>

<footer>
    <div class="footertext">
        <div class="col-1">
            <h2>Rólunk &amp; Információk</h2> <!-- App hamarosan, Size guide -->
            <a <?php if ($page === 'rolunk.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/egyeb/rolunk.php">Rólunk</a>
            <a <?php if ($page === 'szallitas.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/egyeb/szallitas.php">Szállítás</a>
            <a <?php if ($page === 'diakkedvezmeny.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/egyeb/diakkedvezmeny.php">Diákkedvezmény</a>
            <a <?php if ($page === 'promokod.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/egyeb/promokod.php">Promo kódok</a>
            <a <?php if ($page === 'visszakuldes.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/egyeb/visszakuldes.php">Csomag visszaküldés</a>
            <a <?php if ($page === 'csomagell.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/egyeb/csomagell.php">Rendelés ellenőrzése</a>
            <a <?php if ($page === 'ajandekkartya.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/egyeb/ajandekkartya.php">Ajándékkártya</a>
        </div>

        <div class="col-2">
            <h2>Feliratkozás</h2> <!-- jobb oldalon textarea plusz gomb -->
            <form>
                <input type="email" placeholder="valami@gmail.com" required>
                <br>
                <button type="submit">FELIRATKOZÁS</button>
            </form>
        </div>

        <div class="col-3">
            <h2>Hívj minket!</h2> <!-- jobb oldalon telefonszám -->
            <p>6724, Kossuth Lajos sgrt. 74 <br>Szeged, Magyarország </p>
            <p>06/20-111-1111</p>
            <div class="social-icons">
                <a href="https://facebook.com/"><img src="<?php echo $folder;?>/media/image/facebook.webp" alt="facebook_icon"></a>
                <a href="https://instagram.com/"><img src="<?php echo $folder;?>/media/image/instagram.webp" alt="instagram_icon"></a>
                <a href="https://linkedin.com/"><img src="<?php echo $folder;?>/media/image/linkedin.webp" alt="linkedin_icon"></a>
                <a href="https://whatsapp.com/"><img src="<?php echo $folder;?>/media/image/whatsapp.webp" alt="whatsapp_icon"></a>
                <a href="https://wordpress.com/"><img src="<?php echo $folder;?>/media/image/wordpress.webp" alt="wordpress_icon"></a>
            </div>
        </div>

    </div>

    <div id="footerline"> <!-- also sor -->
        <p class="copyright"><a href="<?php echo $folder;?>/egyeb/terms.php"><span class="terms">Terms &amp; Conditions</span></a><a href="<?php echo $folder;?>/egyeb/policy.php"><span class="policy">Privacy Policy</span></a>COPYRIGHT © 2023 Birkl&amp;Zentai</p>
    </div>

</footer>
</body>
</html>