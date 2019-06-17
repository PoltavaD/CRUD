<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "users.php";

if (isset($_GET['login']) && isset($_GET['pass'])) {
    $login = $_GET['login'];
    $pass = $_GET['pass'];
}

foreach ($users as $key => $user) {
    if ($user['login'] == $login && $user['pass'] == $pass) {
        setcookie('userId', $key);
        setcookie('login', $login);
        setcookie('auth', 'ok');
    }
}

header('location: index.php');

