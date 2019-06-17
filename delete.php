<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_GET['id'])) {
    $id = $_GET['id'];
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
    }
    $counter++;
}

fclose($file);

header('location: index.php');

?>