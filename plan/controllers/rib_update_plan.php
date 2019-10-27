<?php
//include('../include/config.php');
require_once('../../include/config.php');

$data = $_POST;
$content = $_POST['content'];
$s_id = $_GET['s_id'];
$field = $_GET['cc'];

//echo '$s_id='.$s_id.'<br/>';
//echo '$field='.$field.'<br/>';
//echo '$content='.$content.'<br/>';

$id = (int)$s_id;
//echo "id=".(string)$id.'<br/>';
$num_field = (int)$field;
echo "num_field=".(string)$num_field.'<br/>';
if ($num_field == 4) {
    $content = $_POST['content'];
    $sql = 'update `plan_plan` set `content` = "' . $content . '" where id = ' . (string)$id . ' ';
    $result = mysqli_query($connection, $sql);
//    echo $sql.'<br/>';
} elseif ($num_field == 5) {
    $content = $_POST['termin'];
    $sql = 'update `plan_plan` set `termin` = "' . $content . '" where id = ' . (string)$id . ' ';
    $result = mysqli_query($connection, $sql);

} elseif ($num_field == 6) {
    $content = $_POST['generalization'];
    $sql = 'update `plan_plan` set `generalization` = "' . $content . '" where id = ' . (string)$id . ' ';
    $result = mysqli_query($connection, $sql);
} elseif ($num_field == 7) {
    $content = $_POST['responsible'];
    $sql = 'update `plan_plan` set `responsible` = "' . $content . '" where id = ' . (string)$id . ' ';
    $result = mysqli_query($connection, $sql);
} elseif ($num_field == 8) {
    $content = $_POST['note'];
    $sql = 'update `plan_plan` set `note` = "' . $content . '" where id = ' . (string)$id . ' ';
    $result = mysqli_query($connection, $sql);
} elseif ($num_field == 9) {
//   міняємо порядок сортування
    $content = $_POST['sort'];
    $content = (float) str_replace(',','.', $content);
    $sql = 'update `plan_plan` set `sort` = ' . $content . ' where id = ' . (string)$id . ' ';
    $result = mysqli_query($connection, $sql);
} elseif ($num_field == 10 ) {
//    додаємо все
//    $content = $_POST['note'];
//    $sql = 'update `plan_plan` set `note` = "' . $content . '" where id = ' . (string)$id . ' ';
//    $result = mysqli_query($connection, $sql);
}



