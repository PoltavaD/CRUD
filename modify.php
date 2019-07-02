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

if(!isset($_GET['id'])) {
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

if(isset($row['user_id']) && $row['user_id'] == $user_id) {
    $task = $row['task'];
    $comments = $row['comments'];
    $deadline = $row['deadline'];
    mysqli_close($conn);
} else {
    mysqli_close($conn);
    header('location: logout.php');
    exit();
}

?>

<form>
    <input name= "id" type="hidden" value="<?=$id?>">
    task: <input name="task" value="<?=$task?>"><br>
    comments: <input name="comments" value="<?=$comments?>"><br>
    deadline: <input name="deadline" type="date" value="<?=$deadline?>"><br>
    <button type="submit" formaction="saveTasks.php">modify</button>
</form>