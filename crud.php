<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_name('crud');
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD</title>
</head>
<body>
<?
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'crud'
);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
};

$sql = 'select * from users';

$result = mysqli_query(
        $conn,
        $sql
);

$user = mysqli_fetch_assoc($result);

echo '<pre>';
print_r($user['id']);
echo '</pre>';


if(!isset($_SESSION['auth']) or $_SESSION['auth'] != 'ok') { ?>
    <div>
        <form action="login.php">
            <input name="login"><br>
            <input name="pass"><br>
            <button type="submit">Login</button>
        </form>
    </div>
<? } elseif (isset($_SESSION['auth']) && $_SESSION['auth'] == 'ok' ) { ?>
        <div><a href="logout.php">Logout</a></div><br>
<?
    if (isset($_SESSION['login'])) {
        $crudFor = $_SESSION['login'] . '_crud.txt';
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
//    if(!isset($_SESSION['login'])) {
//        exit("Введите логин и пароль");
//}
//
//    if (isset ($_GET['task'])) {
//        $file = fopen($crudFor, "a");
//        fputs($file, $_GET['task'] . PHP_EOL);
//        fclose($file);
//}
//
//$lines = file($crudFor);
//
//foreach ($lines as $line_num => $line) {
//    echo "Задача <b>{$line_num}</b> : " . $line . "<a href='delete.php?id=$line_num'>del</a>" . " " . "<a href='modify.php?id=$line_num'>modify</a>" . "<br />\n";
//}
?>

</div>
</body>
</html>