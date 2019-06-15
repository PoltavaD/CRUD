<?php
$id = $_GET['id']; //если тут добавить isset, то все ломается
$newLine = $_GET['task']; //если тут добавить isset, то все ломается

$lines = file('crud.txt');

$file = fopen('crud.txt', 'w');
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

