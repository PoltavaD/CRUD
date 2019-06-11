<?php
$id = $_GET['id'];

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