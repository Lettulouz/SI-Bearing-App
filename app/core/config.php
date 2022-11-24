<?php


$path = $_SERVER['PHP_SELF'];
$path = str_replace("/index.php","",$path);

define('ROOT', $path);

$path = $_SERVER['HTTP_HOST'] . $path . "/css/styles.css";

define('CSSPATH', $path);