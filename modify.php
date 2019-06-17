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

$file = fopen($crudFor, 'r');

$line = '';
for ($i=0; $i<=$id; $i++){
    $line = fgets($file);
}
fclose($file);


echo '<pre>';
print_r($line);
echo '</pre>';

?>

<form>
    <input name= "id" type="hidden" value="<?=$id?>">
    <input name="task" value="<?=$line?>">
    <button type="submit" formaction="saveTasks.php">modify</button>

</form>



