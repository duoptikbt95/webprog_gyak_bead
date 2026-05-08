<?php
$belepes_uzenet = "";

if (isset($_POST['belepes'])) {
    try {
        /*$dbh = new PDO(
            "mysql:host=localhost;dbname=gyakorlat7",
            "root",
            "",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        $dbh->query("SET NAMES utf8");*/
        include("./includes/db.inc.php");

        $sql = "SELECT id, csaladi_nev, uto_nev, bejelentkezes
                FROM felhasznalok
                WHERE bejelentkezes = :bejelentkezes
                AND jelszo = sha1(:jelszo)";

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':bejelentkezes' => $_POST['felhasznalo'],
            ':jelszo' => $_POST['jelszo']
        ));

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $_SESSION['userid'] = $row['id'];
            $_SESSION['csn'] = $row['csaladi_nev'];
            $_SESSION['un'] = $row['uto_nev'];
            $_SESSION['login'] = $row['bejelentkezes'];

            header("Location: .");
            exit;
        } else {
            $belepes_uzenet = "<p style='color:red; font-weight:bold;'>Hibás felhasználónév vagy jelszó!</p>";
        }

    } catch (PDOException $e) {
        $belepes_uzenet = "<p style='color:red; font-weight:bold;'>Adatbázis hiba: " . $e->getMessage() . "</p>";
    }
}
?>