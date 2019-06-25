<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_name('crud');
session_start();

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


if (isset($_GET['login']) && isset($_GET['pass'])) {
    $login = $_GET['login'];
    $pass = $_GET['pass'];
}

if ($login == '' or $pass == ''){
    header('location: index.php');
    exit('Поля не могут быть пустыми!');
}

$sql = 'select * from users';

$result = mysqli_query(
    $conn,
    $sql
);

while ($user = mysqli_fetch_array($result)) {
    if ($login == $user['login'] && $pass == $user['pass']) {
        $_SESSION['auth'] = 'ok';
        $_SESSION['id'] = $user['id'];
        mysqli_close($conn);
        header('location: crud.php');
        exit();
    } elseif ($login != $user['login'] or $pass != $user['pass']) {
//        mysqli_close($conn);
//        ?><!--<div><a href="index.php">Неверный логин или пароль</a></div><br>--><?//
//        exit();
    };

};

?>