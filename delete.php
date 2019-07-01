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

if(isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $sql = "delete from tasks where id=$task_id";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location: crud.php');
    exit();
}

?>