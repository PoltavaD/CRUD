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

$sql = 'select * from users';

$result = mysqli_query(
    $conn,
    $sql
);

if (isset($_GET['pass']) && isset($_GET['pass2'])){
    $pass = $_GET['pass'];
    $pass2 = $_GET['pass2'];
}

if ($pass != $pass2) {
    mysqli_close($conn);
    echo '<a href="index.php">Пароли не совпадают!</a>';
}

if (isset($_GET['login']) && isset($_GET['pass'])) {
    $login = $_GET['login'];
    $pass = $_GET['pass'];
}

$sqlIns = "insert into users (`login`,`pass`)
       values ('" . $login . "','" . $pass . "')";


while ($user = mysqli_fetch_assoc($result)){
    if ($login == $user['login']) {
        echo '<a href="index.php">Такой пользователь уже есть</a>';
    } else {
        mysqli_query($conn, $sqlIns);
        $_SESSION['auth'] = 'ok';
        $_SESSION['id'] = mysqli_insert_id($conn);
        mysqli_close($conn);
        header('location: crud.php');
        exit();
    }
}

?>
