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
<div>
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

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

$sql = 'select * from tasks where user_id='.$user_id;

$result = mysqli_query(
    $conn,
    $sql
);

if (isset($_SESSION['auth']) && $_SESSION['auth'] == 'ok' ) {
?>
    <div><a href="logout.php">Logout</a></div>
    <br><br>
    <div>
        <form>
            task: <input name="task" placeholder="Обязательное поле"><br>
            comments: <input name="comments"><br>
            deadline: <input name="deadline" type="date"><br>
            <button type="submit">Create</button>
        </form>
    </div>
<?
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

if (isset($_GET['task']) && $_GET['task'] != '') {
    $task = $_GET['task'];
    $sql = "INSERT INTO `tasks`(`task`, `comments`, `deadline`, `user_id`) VALUES ('" . $task . "','" . $comments ."','" . $deadline . "', $user_id)";
    mysqli_query($conn, $sql);
} else {
    echo "Введите задачу" . '<br><br><br>';
}

$sql = 'select * from tasks where user_id='.$user_id;

$result = mysqli_query(
    $conn,
    $sql
);

while ($task = mysqli_fetch_array($result)) {
    echo ($task['task']) . ' ' . ($task['comments']) . ' ' . ($task['deadline']) . ' ' . "<a href='delete.php?id={$task['id']}'>del</a>" . ' ' . "<a href='modify.php?id={$task['id']}'>modify</a>" . '<br>';
    echo '<br>';
}

mysqli_close($conn);

?>
</div>
</body>
</html>