<?php

require_once dirname(__FILE__,2) . '/app/init.php';
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);
session_start();
$app = new App;

?>