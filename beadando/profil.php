<?php
    require_once("./php/head.php");
    include_once("assets/controller/user_functions.php"); 
    
    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        header("Location: login.php");
        exit;
    }
?>

    <div class="profil">      
        <h2>A felhasználó adatai:</h2>
        <ul>
            <li><b>Felhasználónév: </b> <?php echo $_SESSION["user"]["username"]?></li>
            <li><b>E-mail: </b><?php echo $_SESSION["user"]["signup_email"]?></li>
            <li><b>Birthdate: </b><?php echo $_SESSION["user"]["date_of_birth"]?></li>
            </ul>

        <form action="assets/controller/profil_controller.php" method="POST" id="password_change" enctype="multipart/form-data">
            <fieldset>
                <legend>Jelszóváltás:</legend><br>
                
                <label for="oldpsw">Régi jelszó:</label> <br>
                <input type="password" placeholder="Régi jelszó" name="old" id="oldpsw" required><br>
                
                <label for="newpsw">Új jelszó:<br>(Min. 6 karakter, tartalmaznia kell számot és betűt is!)</label><br>
                <input type="password" placeholder="Új jelszó" name="new" id="newpsw" required><br>

                <label for="password_check">Jelszó újra:</label> <br>
                <input type="password" placeholder="Régi jelszó újra" name="password_check"  id="password_check" minlength="6" required><br>
                
                <input type="submit" name="pswchange" id="pswchange" value="Új jelsző létrehozása">
            </fieldset>
        </form>

        <div class="top">
            <form action="assets/controller/profil_controller.php" method="POST" id="logout">
                <input type="submit" name="logout" id="logout" value="Kijelentkezés">
            </form>

            <form action="assets/controller/profil_controller.php" method="POST" id="del">
                <label for="delete"><b>Fiók törlése:</b></label><br>
                <input type="submit" name="delete" id="delete" value="Fiok törlése">
            </form>
        </div>
    </div>

<?php require_once("./php/footer.php")?>