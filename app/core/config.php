<?php


$path = $_SERVER['PHP_SELF'];
$path = str_replace("/index.php","",$path);

define('ROOT', $path);

$path2 = $path;
$path2 = str_replace("/public","",$path2);

define('MAINPATH', $path2);

$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

$path = $protocol . $_SERVER['HTTP_HOST'] . $path;

define('PUBLICPATH', $path);

$path .= "/css";

define ('CUSTOMCSS',  $path) ;

$path = $path . "/styles.css";

define('CSSPATH', $path);

$appPath = $protocol . $_SERVER['HTTP_HOST'];

$path = $_SERVER['PHP_SELF'];
$path = str_replace("/public/index.php","",$path);

$appPath = $appPath . $path . "/app";

define('APPPATH', $appPath);

$rootDir = getcwd();
$resourcePath = rtrim($rootDir, 'public');

$photosPath = $resourcePath;

define('MAINPATHLOC', $resourcePath);

$photosPath .= "app/resources/itemsPhotos";

$resourcePath .= "app/resources";

define('PHOTOSPATH', $photosPath);

define('RESOURCEPATH', $resourcePath);