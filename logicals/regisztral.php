<?php

$uzenet = "";

if (isset($_POST['regisztral'])) {
    $csaladi_nev = trim($_POST['csaladi_nev']);
    $uto_nev = trim($_POST['uto_nev']);
    $bejelentkezes = trim($_POST['bejelentkezes']);
    $jelszo = trim($_POST['jelszo']);
    $jelszo2 = trim($_POST['jelszo2']);

    if ($csaladi_nev == "" || $uto_nev == "" || $bejelentkezes == "" || $jelszo == "" || $jelszo2 == "") {
        $uzenet = "<p style='color:red; font-weight:bold;'>Minden mező kitöltése kötelező!</p>";
    } elseif ($jelszo != $jelszo2) {
        $uzenet = "<p style='color:red; font-weight:bold;'>A két jelszó nem egyezik!</p>";
    } else {
        try {
            //$dbh = new PDO("mysql:host=localhost;dbname=gyakorlat7", "root", "");
            //$dbh->query("SET NAMES utf8");
            include("./includes/db.inc.php");

            $ellenorzes = $dbh->prepare("SELECT id FROM felhasznalok WHERE bejelentkezes = :bejelentkezes");
            $ellenorzes->execute(array(':bejelentkezes' => $bejelentkezes));

            if ($ellenorzes->rowCount() > 0) {
                $uzenet = "<p style='color:red; font-weight:bold;'>Ez a login név már foglalt!</p>";
            } else {
                $insert = $dbh->prepare("
                    INSERT INTO felhasznalok (csaladi_nev, uto_nev, bejelentkezes, jelszo)
                    VALUES (:csaladi_nev, :uto_nev, :bejelentkezes, sha1(:jelszo))
                ");

                $insert->execute(array(
                    ':csaladi_nev' => $csaladi_nev,
                    ':uto_nev' => $uto_nev,
                    ':bejelentkezes' => $bejelentkezes,
                    ':jelszo' => $jelszo
                ));

                $uzenet = "<p style='color:green; font-weight:bold;'>Sikeres regisztráció! Most már be tudsz jelentkezni.</p>";
            }
        } catch (PDOException $e) {
            $uzenet = "<p style='color:red; font-weight:bold;'>Adatbázis hiba: " . $e->getMessage() . "</p>";
        }
    }
}
?>