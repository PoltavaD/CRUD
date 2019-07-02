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

if (isset($_GET['task']) && ($_GET['task']) != '') {
    $task = $_GET['task'];
} else {
    mysqli_close($conn);
    header('location: crud.php');
    exit();
}

if (!isset($_GET['comments']) || $_GET['comments'] == '') {
    $comments = 'comments';
} elseif (isset($_GET['comments']) && $_GET['comments'] != '') {
    $comments = $_GET['comments'];
}

if(isset($_GET['deadline']) && $_GET['deadline'] != '') {
    $deadline = $_GET['deadline'];
} else {
    $deadline = date('Y-m-d', time() + 2592000);
}

$sql = 'select * from tasks where id='.$id;

$result = mysqli_query(
    $conn,
    $sql
);

$row = mysqli_fetch_assoc($result);

$sql_ins = "UPDATE `tasks` set `id`=$id, `task`='" . $task . "', `comments`='" . $comments . "', `deadline`='" . $deadline . "' , `user_id`=$user_id where `id`=$id";

if(isset($row['user_id']) && $row['user_id'] == $user_id) {
    mysqli_query($conn, $sql_ins);
    mysqli_close($conn);
    header('location: crud.php');
    exit();
} else {
    mysqli_close($conn);
    header('location: logout.php');
    exit();
}
?>

