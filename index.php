<html>

<head>
    <meta charset="utf-8">
    <title>CRUD</title>
</head>
<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<div>
    <form>
        new task: <input name="task">
        <button type="submit">Create</button>
    </form>
</div>
<div>

<?php
$file = fopen('crud.txt', "a");
fclose($file);
?>

<?php

    if (isset ($_GET['task'])) {
        $file = fopen('crud.txt', "a");
        fputs($file, $_GET['task'] . PHP_EOL);
        fclose($file);
}

$lines = file('crud.txt');

foreach ($lines as $line_num => $line) {
    echo "Задача <b>{$line_num}</b> : " . $line . "<a href='delete.php?id=$line_num'>del</a>" . " " . "<a href='modify.php?id=$line_num'>modify</a>" . "<br />\n";
}
?>

<?
    echo '<pre>';
    print_r($lines);
    echo '</pre>';
?>

</div>
</body>
</html>