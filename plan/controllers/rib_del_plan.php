<?php
require_once('../../include/config.php');

$id = $_GET['id'];
$sql = 'delete from `plan_plan` where `id`='.(String)$id.' ;';
echo $sql.'<br/>';

$result = mysqli_query($connection, $sql);