<h2>Üzenetek</h2>

<?php
try {
    //$dbh = new PDO("mysql:host=localhost;dbname=gyakorlat7", "root", "");
    //$dbh->query("SET NAMES utf8");
    include("./includes/db.inc.php");

    if (isset($_GET['torol_uzenet'])) {
        $id = (int)$_GET['torol_uzenet'];

        $delete = $dbh->prepare("DELETE FROM uzenetek WHERE id = :id");
        $delete->execute(array(':id' => $id));

        header("Location: ?uzenetek");
        exit;
    }

    $sql = "SELECT 
                id,
                CASE 
                    WHEN felhasznalo_id IS NULL THEN 'Vendég'
                    ELSE nev
                END AS kuldo,
                email,
                uzenet,
                kuldes_ideje
            FROM uzenetek
            ORDER BY kuldes_ideje DESC";

    $stmt = $dbh->query($sql);

    echo "<table class='crud-table'>";
    echo "<tr>
            <th>ID</th>
            <th>Küldő</th>
            <th>E-mail</th>
            <th>Üzenet</th>
            <th>Küldés ideje</th>
            <th>Művelet</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['kuldo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . nl2br(htmlspecialchars($row['uzenet'])) . "</td>";
        echo "<td>" . $row['kuldes_ideje'] . "</td>";
        echo "<td>
                <a class='btn btn-delete' href='?uzenetek&torol_uzenet=" . $row['id'] . "' onclick=\"return confirm('Biztosan törlöd az üzenetet?');\">Törlés</a>
              </td>";
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "Adatbázis hiba: " . $e->getMessage();
}
?>