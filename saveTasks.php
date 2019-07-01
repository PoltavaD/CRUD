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

if(isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_GET['task'])) {
    $task = $_GET['task'];
}

if (isset($_GET['comments'])) {
    $comments = $_GET['comments'];
}

if (isset($_GET['deadline'])) {
    $deadline = $_GET['deadline'];
}

$sql = 'select * from tasks where id='.$id;

$result = mysqli_query(
    $conn,
    $sql
);

$row = mysqli_fetch_assoc($result);

$sql_ins = "UPDATE `tasks` set `id`=$id, `task`='" . $task . "', `comments`='" . $comments . "', `deadline`='" . $deadline . "' , `user_id`=$user_id where `id`=$id";

if($user_id == $row['user_id']) {
//echo $sql_ins;
    mysqli_query($conn, $sql_ins);
    mysqli_close($conn);
    header('location: crud.php');
    exit();
}
?>

