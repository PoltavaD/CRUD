<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


setcookie('userId', '');
setcookie('login', '');
setcookie('auth', '');


header('location: index.php');