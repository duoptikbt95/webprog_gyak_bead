<h2>Regisztráció</h2>

<?php if (isset($uzenet)) { echo $uzenet; } ?>

<form method="post" action="?regisztral" class="crud-form">
    <label>Családi név:</label>
    <input type="text" name="csaladi_nev" required>

    <label>Utónév:</label>
    <input type="text" name="uto_nev" required>

    <label>Login név:</label>
    <input type="text" name="bejelentkezes" required>

    <label>Jelszó:</label>
    <input type="password" name="jelszo" required>

    <label>Jelszó újra:</label>
    <input type="password" name="jelszo2" required>

    <div class="crud-actions">
        <input class="btn btn-add" type="submit" name="regisztral" value="Regisztráció">
    </div>
</form>