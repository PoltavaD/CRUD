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

if (isset($_GET['pass']) && isset($_GET['pass2'])){
    $pass = $_GET['pass'];
    $pass2 = $_GET['pass2'];
}

if ($pass != $pass2) {
    mysqli_close($conn);
    echo '<a href="index.php">Пароли не совпадают!</a>';
    exit();
}

if (isset($_GET['login']) && isset($_GET['pass'])) {
    $login = $_GET['login'];
    $pass = $_GET['pass'];
}

$pass = password_hash($pass, PASSWORD_DEFAULT);

$sql = 'select * from users where login="'.$login.'"';

$result = mysqli_query(
    $conn,
    $sql
);

$sql_ins = "insert into users (`login`,`pass`) values ('" . $login . "','" . $pass . "')";

if($result->num_rows) {
    echo '<a href="index.php">Такой пользователь уже есть</a>';
    exit();
} else {
        mysqli_query($conn, $sql_ins);
        $_SESSION['auth'] = 'ok';
        $_SESSION['id'] = mysqli_insert_id($conn);
        mysqli_close($conn);
        header('location: crud.php');
        exit();
}
?>
