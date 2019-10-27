<?php
//require_once "include/config.php";
$connection = mysqli_connect(
    $config['db']['server'],
    $config['db']['username'],
    $config['db']['password'],
    $config['db']['name']
);
if ($connection == false){
    echo "Не вдалося підключитися до бази даних!<br/>";
    echo mysqli_connect_error();
    exit();
} else{
//    echo "Підключилися до бази даних!<br/>";
    mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
    mysqli_query($connection, "SET CHARACTER SET 'utf8'");

}