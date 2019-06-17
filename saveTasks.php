<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_GET['task'])) {
    $newLine = $_GET['task'];
}

if (isset($_COOKIE['login'])) {
    $crudFor = $_COOKIE['login'] . '_crud.txt';
}

$lines = file($crudFor);

$file = fopen($crudFor, 'w');
$counter = 0;
foreach ($lines as $line) {
    if ($counter != $id) {
        fputs($file, $line);
    } else {
        fputs($file, $newLine . PHP_EOL);
    }
    $counter++;

}

fclose($file);

header('location: index.php');

?>

