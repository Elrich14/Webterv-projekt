<?php
    require_once("./php/head.php");
    
    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        header("Location: login.php");
        exit;
    }
?>
<?php
    if (isset($_SESSION['logged_in'])) {

        if (isset($_POST['termek']) && isset($_POST['mennyiseg'])) {
            $termek = $_POST['termek'];
            $mennyiseg = $_POST['mennyiseg'];
            $kosar_tomb = file("cart.txt", FILE_IGNORE_NEW_LINES);
            $uj_tartalom = "";
            if ($mennyiseg == 0) {
                foreach ($kosar_tomb as $sor) {
                    if (strpos($sor, $termek) !== 0) {
                        $uj_tartalom .= $sor . "\n";
                    }
                }
                file_put_contents("cart.txt", $uj_tartalom);
            } else {
                foreach ($kosar_tomb as $sor) {
                    if (strpos($sor, $termek) !== 0) {
                        $uj_tartalom .= $sor . "\n";
                    } else {
                        $uj_tartalom .= $termek . ";" . $mennyiseg . "\n";
                    }
                }
                file_put_contents("cart.txt", $uj_tartalom);
            }
        }

        echo "<div class='cart'>";
        $kosar_tartalom = file("cart.txt", FILE_IGNORE_NEW_LINES);
        $total = 0;

        echo "<table class='cart_table'>";
        echo "<tr><th>Termék név</th><th>Ár</th><th>Mennyiség / Módosítás</th></tr>";

        foreach ($kosar_tartalom as $termek) {
            $adatok = explode(";", $termek);
            $nev = $adatok[0];
            $ar = $adatok[1];
            $mennyiseg = $adatok[2];
            $total += $ar * $mennyiseg;

            echo "<tr><td>" . $nev . "</td><td>" . $ar . " FT</td>";
            echo "<td><form method='post'>";
            echo "<input type='hidden' name='termek' value='" . $nev . ";" . $ar . "'/>";
            echo "<input type='number' name='mennyiseg' min='0' value='" . $mennyiseg . "'/>";
            echo "<input type='submit' value='Módosítása'/>";
            echo "</form></td></tr>";
        }

        echo "</table>";
        echo "<p class='osszeg'>Összesen:" . $total . " Ft </p>";
        echo "</div>";


    } else {
        echo "<div class='cart_not_logged_in'>";
        echo    "<h1>Nem vagy bejelentkezve.</h1>";
        echo    "<h2>Kattints az alábbi linkre a bejelentkezéshez, hogy megtudd mik várnak rád a kosaradban.</h2>";
        echo    "<form action='login.php' method='get'>";
        echo        "<input type='submit' name='cart_login_page' value='Bejelentkezés'>";
        echo    "</form>";
        echo "</div>";
    }
?>

<?php require_once("./php/footer.php")?>