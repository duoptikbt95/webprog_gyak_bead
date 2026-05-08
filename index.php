<?php
include('./includes/config.inc.php');

$oldal = '';

if (!empty($_SERVER['QUERY_STRING'])) {
    $oldal = trim(explode('&', $_SERVER['QUERY_STRING'])[0]);
}

if ($oldal == '') {
    $keres = $oldalak['/'];
} else {
    if (isset($oldalak[$oldal]) && file_exists("./templates/pages/" . $oldalak[$oldal]['fajl'] . ".tpl.php")) {
        $keres = $oldalak[$oldal];
    } else {
        $keres = $hiba_oldal;
        header("HTTP/1.0 404 Not Found");
    }
}

include('./templates/index.tpl.php');
?>