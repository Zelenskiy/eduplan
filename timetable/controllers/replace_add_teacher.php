<?php
require_once('../../include/config.php');
$timetable_id = '1';

// Додавання нового відсутнього вчителя




function date_for_sql($arg_1)
{
    $day = substr($arg_1,0,2);
    $month = substr($arg_1,3,2);
    $year = substr($arg_1,6,4);
    $retval = $year . '-' . $month . '-' . $day ;
    return $retval;
}
function date_from_sql($arg_1)
{
    $day = substr($arg_1,8,2);
    $month = substr($arg_1,5,2);
    $year = substr($arg_1,0,4);
    $retval = $day . '.' . $month;
    return $retval;
}

$date_st = date_for_sql($_POST['date_st']);
$date_fin = date_for_sql($_POST['date_fin']);
$reason = $_POST['reason'];
$kl_ker = $_POST['kl_ker'];
$poch_kl = $_POST['poch_kl'];
$teach_id = $_POST['teach_id'];
$kl_ker = 0;
$poch_kl = 0;

if ($_POST['kl_ker']  == on) $kl_ker = 1; else $kl_ker = 0;
if ($_POST['poch_kl'] == on) $poch_kl = 1; else $poch_kl = 0;


$time = date("Y-m-d h:i:s");

$sql = "INSERT INTO `" . $config['worktime_missing'] . "` (`date_st`, `date_fin`, `reason`, `kl_ker`, `poch_kl`, `teach_id`,`published`,  `timetable_id_id`)
        VALUES ('$date_st', '$date_fin','$reason' , $kl_ker, $poch_kl, $teach_id, '" . strval($time) . "', $timetable_id);";

$result = mysqli_query($connection, $sql);

$newURL = '../replace.php';
header('Location: '.$newURL);

?>