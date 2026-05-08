<h2>Szélerőművek CRUD</h2>

<?php
try {
    //$dbh = new PDO("mysql:host=localhost;dbname=gyakorlat7", "root", "");
    //$dbh->query("SET NAMES utf8");
    include("./includes/db.inc.php");

    $hiba = "";

    // TÖRLÉS
    if (isset($_GET['torol'])) {
        $id = (int)$_GET['torol'];

        $delete = $dbh->prepare("DELETE FROM torony WHERE id = :id");
        $delete->execute(array(':id' => $id));

        header("Location: ?tornyok");
        exit;
    }

    // ÚJ TORONY HOZZÁADÁSA
    if (isset($_POST['uj_torony'])) {
        $darab = (int)$_POST['darab'];
        $teljesitmeny = (int)$_POST['teljesitmeny'];
        $kezdev = (int)$_POST['kezdev'];
        $helyszinid = (int)$_POST['helyszinid'];

        if ($darab < 0 || $teljesitmeny < 0 || $kezdev < 1900 || $kezdev > 2100) {
            $hiba = "Hibás adat! A darab és teljesítmény nem lehet negatív, az év 1900 és 2100 között legyen.";
        } else {
            $insert = $dbh->prepare("
                INSERT INTO torony (darab, teljesitmeny, kezdev, helyszinid)
                VALUES (:darab, :teljesitmeny, :kezdev, :helyszinid)
            ");

            $insert->execute(array(
                ':darab' => $darab,
                ':teljesitmeny' => $teljesitmeny,
                ':kezdev' => $kezdev,
                ':helyszinid' => $helyszinid
            ));

            header("Location: ?tornyok");
            exit;
        }
    }

    // SZERKESZTÉS MENTÉSE
    if (isset($_POST['modosit_torony'])) {
        $id = (int)$_POST['id'];
        $darab = (int)$_POST['darab'];
        $teljesitmeny = (int)$_POST['teljesitmeny'];
        $kezdev = (int)$_POST['kezdev'];
        $helyszinid = (int)$_POST['helyszinid'];

        if ($darab < 0 || $teljesitmeny < 0 || $kezdev < 1900 || $kezdev > 2100) {
            $hiba = "Hibás adat! A darab és teljesítmény nem lehet negatív, az év 1900 és 2100 között legyen.";
        } else {
            $update = $dbh->prepare("
                UPDATE torony 
                SET darab = :darab,
                    teljesitmeny = :teljesitmeny,
                    kezdev = :kezdev,
                    helyszinid = :helyszinid
                WHERE id = :id
            ");

            $update->execute(array(
                ':id' => $id,
                ':darab' => $darab,
                ':teljesitmeny' => $teljesitmeny,
                ':kezdev' => $kezdev,
                ':helyszinid' => $helyszinid
            ));

            header("Location: ?tornyok");
            exit;
        }
    }

    // HA SZERKESZTÉSRE KATTINTOTTUNK
    $szerkesztendo = null;

    if (isset($_GET['szerkeszt'])) {
        $id = (int)$_GET['szerkeszt'];

        $stmt = $dbh->prepare("SELECT * FROM torony WHERE id = :id");
        $stmt->execute(array(':id' => $id));
        $szerkesztendo = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // HELYSZÍNEK LEKÉRÉSE
    $helyszinek = $dbh->query("SELECT id, nev FROM helyszin ORDER BY nev")->fetchAll(PDO::FETCH_ASSOC);

    if ($hiba != "") {
        echo "<p style='color:red; font-weight:bold;'>" . $hiba . "</p>";
    }

    // FORM
    if ($szerkesztendo) {
        echo "<h3>Szélerőmű szerkesztése</h3>";
        echo "<form class='crud-form' method='post' action='?tornyok'>";
        echo "<input type='hidden' name='id' value='" . $szerkesztendo['id'] . "'>";

        echo "<label>Darab:</label>";
        echo "<input type='number' name='darab' value='" . $szerkesztendo['darab'] . "' min='1' required>";

        echo "<label>Teljesítmény (kW):</label>";
        echo "<input type='number' name='teljesitmeny' value='" . $szerkesztendo['teljesitmeny'] . "' min='0' required>";

        echo "<label>Üzembe helyezés éve:</label>";
        echo "<input type='number' name='kezdev' value='" . $szerkesztendo['kezdev'] . "' min='1900' max='2100' required>";

        echo "<label>Település:</label>";
        echo "<select name='helyszinid'>";

        foreach ($helyszinek as $h) {
            $selected = ($h['id'] == $szerkesztendo['helyszinid']) ? "selected" : "";
            echo "<option value='" . $h['id'] . "' $selected>" . $h['nev'] . "</option>";
        }

        echo "</select>";

        echo "<div class='crud-actions'>";
        echo "<input class='btn btn-edit' type='submit' name='modosit_torony' value='Módosítás mentése'> ";
        echo "<a class='btn btn-delete' href='?tornyok'>Mégsem</a>";
        echo "</div>";

        echo "</form>";
    } else {
        echo "<h3>Új szélerőmű felvétele</h3>";
        echo "<form class='crud-form' method='post' action='?tornyok'>";

        echo "<label>Darab:</label>";
        echo "<input type='number' name='darab' min='1' required>";

        echo "<label>Teljesítmény (kW):</label>";
        echo "<input type='number' name='teljesitmeny' min='0' required>";

        echo "<label>Üzembe helyezés éve:</label>";
        echo "<input type='number' name='kezdev' min='1900' max='2100' required>";

        echo "<label>Település:</label>";
        echo "<select name='helyszinid'>";

        foreach ($helyszinek as $h) {
            echo "<option value='" . $h['id'] . "'>" . $h['nev'] . "</option>";
        }

        echo "</select>";

        echo "<div class='crud-actions'>";
        echo "<input class='btn btn-add' type='submit' name='uj_torony' value='Hozzáadás'>";
        echo "</div>";

        echo "</form>";
    }

    echo "<hr>";

    // LISTÁZÁS
    $sql = "SELECT 
                torony.id,
                torony.darab,
                torony.teljesitmeny,
                torony.kezdev,
                helyszin.nev AS telepules,
                megye.nev AS megye,
                megye.regio AS regio
            FROM torony
            INNER JOIN helyszin ON torony.helyszinid = helyszin.id
            INNER JOIN megye ON helyszin.megyeid = megye.id
            ORDER BY torony.id";

    $stmt = $dbh->query($sql);

    echo "<table class='crud-table'>";
    echo "<tr>
            <th>ID</th>
            <th>Darab</th>
            <th>Teljesítmény (kW)</th>
            <th>Üzembe helyezés éve</th>
            <th>Település</th>
            <th>Megye</th>
            <th>Régió</th>
            <th>Művelet</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['darab'] . "</td>";
        echo "<td>" . $row['teljesitmeny'] . "</td>";
        echo "<td>" . $row['kezdev'] . "</td>";
        echo "<td>" . $row['telepules'] . "</td>";
        echo "<td>" . $row['megye'] . "</td>";
        echo "<td>" . $row['regio'] . "</td>";
        echo "<td>
                <a class='btn btn-edit' href='?tornyok&szerkeszt=" . $row['id'] . "'>Szerkesztés</a>
                <a class='btn btn-delete' href='?tornyok&torol=" . $row['id'] . "' onclick=\"return confirm('Biztosan törlöd?');\">Törlés</a>
              </td>";
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "Adatbázis hiba: " . $e->getMessage();
}
?>