<?php
// Session törlés
$_SESSION = array();

// Ha van session cookie, azt is töröljük
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Session megszüntetése
session_destroy();

// Visszairányítás főoldalra
header("Location: .");
exit;
?>