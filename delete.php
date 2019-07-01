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

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

if(!isset($_GET['id']) || $_GET['id'] == '') {
    header('location: crud.php');
    exit();
} else {
    $id = $_GET['id'];
}

$sql = 'select * from tasks where id='.$id;

$result = mysqli_query(
    $conn,
    $sql
);

$row = mysqli_fetch_assoc($result);

if ($user_id == $row['user_id']) {
    $sql = "delete from tasks where id=$id";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location: crud.php');
    exit();
} else {
    mysqli_close($conn);
    header('location: crud.php');
    exit();
}

?>