<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD</title>
</head>
<body>
<?
require_once "users.php";

if(!isset($_COOKIE['auth']) or $_COOKIE['auth'] != 'ok') { ?>
    <div>
        <form action="login.php">
            <input name="login"><br>
            <input name="pass"><br>
            <button type="submit">Login</button>
        </form>
    </div>
<? } elseif (isset($_COOKIE['auth']) && $_COOKIE['auth'] == 'ok' ) { ?>
        <div><a href="logout.php">Logout</a></div><br>
<?
    if (isset($_COOKIE['login'])) {
        $crudFor = $_COOKIE['login'] . '_crud.txt';
        $file = fopen($crudFor, "a");
        fclose($file);
        ?>
            <div>
                <form>
                    new task: <input name="task">
                    <button type="submit">Create</button>
                </form>
            </div>
            <div>
        <?
    } ?>
<?} ?>

<?
    if(!isset($_COOKIE['login'])) {
        exit("Введите логин и пароль");
}

    if (isset ($_GET['task'])) {
        $file = fopen($crudFor, "a");
        fputs($file, $_GET['task'] . PHP_EOL);
        fclose($file);
}

$lines = file($crudFor);

foreach ($lines as $line_num => $line) {
    echo "Задача <b>{$line_num}</b> : " . $line . "<a href='delete.php?id=$line_num'>del</a>" . " " . "<a href='modify.php?id=$line_num'>modify</a>" . "<br />\n";
}
?>

</div>
</body>
</html>