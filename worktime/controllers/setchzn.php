<?php
require_once('../../include/config.php');

$id = $_GET['id_'];
$cz = $_GET['cz'];
$sql = "update `worktime_workday` set `weekchzn` = $cz where id = $id ;";
echo $sql.'<br/>';
$result = mysqli_query($connection, $sql);


