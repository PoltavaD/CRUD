<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_name('crud');
session_start();
?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>CRUD</title>
</head>
<body>
<?
echo '<pre>';
print_r($_SESSION);
echo '</pre>';


if(!isset($_SESSION['auth']) or $_SESSION['auth'] != 'ok') { ?>
    <div class="signin">
        <form action="login.php">
            <input name="login"><br>
            <input name="pass"><br>
            <button type="submit">Sing in</button>
        </form>
    </div>
    <div class="signup">
        <form action="singup.php">
            <input name="login"><br>
            <input name="pass"><br>
            <input name="pass2"><br>
            <button type="submit">Sing up</button>
        </form>
    </div>
<? } elseif (isset($_SESSION['auth']) && $_SESSION['auth'] == 'ok' ) { ?>
    <div><a href="crud.php">CRUD</a></div><br>
    <div><a href="logout.php">Logout</a></div><br>
<? }

?>


