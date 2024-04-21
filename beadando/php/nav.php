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

    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
    }
?>

<header id="navbar">
    <a href="<?php echo $folder;?>/index.php"><img <?php if ($page === 'index.php') echo 'class="logo active"'; else echo 'class="logo"' ?> src="<?php echo $folder;?>/media/image/logo_without_bg.webp" alt="logo"></a>
    <div>
        <nav>
            <ul class="nav_links">
                <li> <a <?php if ($page === 'designer.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/designer.php">Dizájnerek</a></li>
                <li> <a <?php if ($page === 'ruhak.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/ruhak.php">Ruhák</a></li>
                <li> <a <?php if ($page === 'meret.php') echo 'class="active"'; ?> href="<?php echo $folder;?>/meret.php">Méret táblázat</a></li>
                <li> <a <?php if ($page === 'kapcsolat.php') echo 'class="active"'; ?>href="<?php echo $folder;?>/kapcsolat.php">Kapcsolat</a></li>
                <?php if($_SESSION["user"]["username"] == "ADMIN") { ?>
                    <li> <a <?php if ($page === 'admin.php') echo 'class="active admin-nav"'; ?>href="<?php echo $folder;?>/admin.php">Admin</a></li>
                <?php }?>
            </ul>
        </nav>
    </div>

    <div class="profil-nav">
        <a <?php if ($page === 'kosar.php') echo 'class="activeround"'; ?> href="<?php echo $folder;?>/kosar.php"><img class="kosar" src="<?php echo $folder;?>/media/image/shopping-cart.webp" alt="kosár"></a>
        <a <?php if ($page === 'login.php' || $page === "profil.php") echo 'class="activeround"'; ?> href="<?php echo $folder;?>/login.php"><img class="loginimg" src="<?php echo $folder;?>/media/image/user.webp" alt="belépés"></a>
        <?php if (isset($_SESSION["user"])) { ?>
            <a href="<?php echo $folder?>/index.php?logout=true"><img class="logout" src="<?php echo $folder;?>/media/image/exit.webp" alt="kilépés"></a>
        <?php }?>
    </div>

</header>