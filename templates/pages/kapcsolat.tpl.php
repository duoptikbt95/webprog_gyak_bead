<h2>Kapcsolat</h2>

<script>
function kapcsolatEllenorzes() {
    let nev = document.forms["kapcsolatForm"]["nev"].value.trim();
    let email = document.forms["kapcsolatForm"]["email"].value.trim();
    let uzenet = document.forms["kapcsolatForm"]["uzenet"].value.trim();

    if (nev === "") {
        alert("A név megadása kötelező!");
        return false;
    }

    if (email === "") {
        alert("Az e-mail cím megadása kötelező!");
        return false;
    }

    if (!email.includes("@") || !email.includes(".")) {
        alert("Hibás e-mail cím!");
        return false;
    }

    if (uzenet === "") {
        alert("Az üzenet megadása kötelező!");
        return false;
    }

    if (uzenet.length < 5) {
        alert("Az üzenet legalább 5 karakter hosszú legyen!");
        return false;
    }

    return true;
}
</script>

<?php
$uzenet = "";

try {
    //$dbh = new PDO("mysql:host=localhost;dbname=gyakorlat7", "root", "");
    //$dbh->query("SET NAMES utf8");
    include("./includes/db.inc.php");

    if (isset($_POST['kuldes'])) {
        $nev = trim($_POST['nev']);
        $email = trim($_POST['email']);
        $szoveg = trim($_POST['uzenet']);

        if ($nev == "" || $email == "" || $szoveg == "") {
            $uzenet = "<p style='color:red; font-weight:bold;'>Minden mező kitöltése kötelező!</p>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $uzenet = "<p style='color:red; font-weight:bold;'>Hibás e-mail cím!</p>";
        } elseif (strlen($szoveg) < 5) {
            $uzenet = "<p style='color:red; font-weight:bold;'>Az üzenet legalább 5 karakter hosszú legyen!</p>";
        } else {
            $felhasznalo_id = null;

            if (isset($_SESSION['userid'])) {
                $felhasznalo_id = $_SESSION['userid'];
            }

            $insert = $dbh->prepare("
                INSERT INTO uzenetek (nev, email, uzenet, felhasznalo_id)
                VALUES (:nev, :email, :uzenet, :felhasznalo_id)
            ");

            $insert->execute(array(
                ':nev' => $nev,
                ':email' => $email,
                ':uzenet' => $szoveg,
                ':felhasznalo_id' => $felhasznalo_id
            ));

            $uzenet = "<p style='color:green; font-weight:bold;'>Az üzenet sikeresen elküldve!</p>";
        }
    }

} catch (PDOException $e) {
    $uzenet = "<p style='color:red; font-weight:bold;'>Adatbázis hiba: " . $e->getMessage() . "</p>";
}
?>

<?= $uzenet ?>

<form name="kapcsolatForm" method="post" action="?kapcsolat" class="crud-form" onsubmit="return kapcsolatEllenorzes();">
    <label>Név:</label>
    <input type="text" name="nev">

    <label>E-mail:</label>
    <input type="text" name="email">

    <label>Üzenet:</label>
    <textarea name="uzenet"></textarea>

    <div class="crud-actions">
        <input class="btn btn-add" type="submit" name="kuldes" value="Üzenet küldése">
    </div>
</form>
