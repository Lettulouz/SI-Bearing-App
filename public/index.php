<?php

require_once dirname(__FILE__,2) . '/app/init.php';
//header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire');
session_start();
$app = new App;

?>