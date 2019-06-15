<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = $_GET['id']; //если тут добавить isset, то все ломается

$lines = file('crud.txt');

$file = fopen('crud.txt', 'w');
$counter = 0;
foreach ($lines as $line) {
    if ($counter != $id) {
        fputs($file, $line);
    }
    $counter++;
}

fclose($file);

header('location: index.php');

?>