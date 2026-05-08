<h2>Bejelentkezés</h2>

<?php
if (isset($belepes_uzenet)) {
    echo $belepes_uzenet;
}
?>

<form action="?belep" method="post" class="crud-form">
    <label>Felhasználónév:</label>
    <input type="text" name="felhasznalo" required>

    <label>Jelszó:</label>
    <input type="password" name="jelszo" required>

    <div class="crud-actions">
        <input class="btn btn-add" type="submit" name="belepes" value="Belépés">
    </div>
</form>

<p>
    Még nincs fiókod?
    <a href="?regisztral">Regisztráció</a>
</p>