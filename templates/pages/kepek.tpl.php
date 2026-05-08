<h2>Képgaléria</h2>

<?php
$uzenet = "";

// Feltöltési mappa
$feltoltesi_mappa = "./images/galeria/";

// 📤 KÉPFELTÖLTÉS
if (isset($_POST['feltoltes']) && isset($_SESSION['login'])) {

    if (isset($_FILES['kep']) && $_FILES['kep']['error'] == 0) {

        $eredetiNev = basename($_FILES['kep']['name']);
        $ujNev = time() . "_" . $eredetiNev;
        $cel = $feltoltesi_mappa . $ujNev;

        $kiterjesztes = strtolower(pathinfo($cel, PATHINFO_EXTENSION));
        $engedelyezett = array("jpg", "jpeg", "png", "gif");

        if (in_array($kiterjesztes, $engedelyezett)) {

            if (move_uploaded_file($_FILES['kep']['tmp_name'], $cel)) {
                $uzenet = "<p style='color:green; font-weight:bold;'>✔ Sikeres képfeltöltés!</p>";
            } else {
                $uzenet = "<p style='color:red; font-weight:bold;'>❌ Feltöltési hiba!</p>";
            }

        } else {
            $uzenet = "<p style='color:red; font-weight:bold;'>❌ Csak JPG, PNG vagy GIF fájl tölthető fel!</p>";
        }

    } else {
        $uzenet = "<p style='color:red; font-weight:bold;'>❌ Nem választottál képet!</p>";
    }
}

// Üzenet kiírás
echo $uzenet;

// 🔐 FELTÖLTÉS CSAK BEJELENTKEZVE
if (isset($_SESSION['login'])) {
?>

<h3>Új kép feltöltése</h3>

<form method="post" enctype="multipart/form-data" class="crud-form">
    <label>Kép kiválasztása:</label>
    <input type="file" name="kep" required>

    <div class="crud-actions">
        <input class="btn btn-add" type="submit" name="feltoltes" value="Feltöltés">
    </div>
</form>

<?php
} else {
    echo "<p><strong>Képfeltöltéshez be kell jelentkezni.</strong></p>";
}

echo "<hr>";

// 🖼 GALÉRIA
echo "<div class='galeria'>";

$kepek = glob($feltoltesi_mappa . "*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE);

if ($kepek) {
    foreach ($kepek as $kep) {
        echo "<div class='galeria-kep'>";
        echo "<img src='" . $kep . "' alt='kép'>";
        echo "</div>";
    }
} else {
    echo "<p>Még nincs feltöltött kép.</p>";
}

echo "</div>";
?>