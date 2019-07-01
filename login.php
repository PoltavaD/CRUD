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

$sql = 'select * from users where login="'.$login.'"';

$result = mysqli_query(
    $conn,
    $sql
);

$row = mysqli_fetch_assoc($result);

if(!$result->num_rows) {
    mysqli_close($conn);
    ?><div><a href="index.php">Зарегестрируйтесь!</a></div><br><?
} elseif ($row['pass'] = $pass) {
    $_SESSION['auth'] = 'ok';
    $_SESSION['id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    mysqli_close($conn);
    header('location: crud.php');
    exit();
//    ?><!--<div><a href="crud.php">CRUD</a></div><br>--><?//
}
?>





