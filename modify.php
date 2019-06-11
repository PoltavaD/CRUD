<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
$id = $_GET['id'];

$file = fopen('crud.txt', 'r');

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



