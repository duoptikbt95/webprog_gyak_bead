<?php

$dbh = new PDO(
    "mysql:host=localhost;dbname=ngek9n",
    "ngek9n",
    "Ngek9n!",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);

$dbh->query("SET NAMES utf8");

?>   


