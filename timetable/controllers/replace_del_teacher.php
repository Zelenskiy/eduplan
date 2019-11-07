<?php
//Вилучення користувача з таблиці відсутніх
require_once('../../include/config.php');
//
//echo $_POST['id'] . "<br>";
//print_r($_POST);

$sql = "DELETE FROM `" . $config['worktime_missing'] . "` WHERE `id` = ". $_POST['id'] ." ;";
echo $sql . "<br>";
$result = mysqli_query($connection, $sql);

//$newURL = "../../replace.php";
//header('Location: '.$newURL);
//

