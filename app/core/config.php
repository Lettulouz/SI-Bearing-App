<?php


$path = $_SERVER['PHP_SELF'];
$path = str_replace("/index.php","",$path);

define('ROOT', $path);

$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

$path = $protocol . $_SERVER['HTTP_HOST'] . $path . "/css";

define ('CUSTOMCSS',  $path) ;

$path = $path . "/styles.css";

define('CSSPATH', $path);

$appPath = $protocol . $_SERVER['HTTP_HOST'];

$path = $_SERVER['PHP_SELF'];
$path = str_replace("/public/index.php","",$path);

$appPath = $appPath . $path . "/app";

define('APPPATH', $appPath);