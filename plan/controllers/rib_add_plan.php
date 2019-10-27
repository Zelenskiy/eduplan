<?php

//include('../include/config.php');
require_once('../../include/config.php');


$content = $_POST['content'];
$termin = $_POST['termin'];
$generalization = $_POST['generalization'];
$responsible = $_POST['responsible'];
$note = $_POST['note'];
$sort = $_POST['sort'];
$r_id = $_POST['rtable'];
$plantable = $_POST['plantable'];
echo $plantable.'<br/>';

$sort = str_replace(',','.',$sort);

$sql = 'INSERT INTO `plan_plan` (`content`, `termin`, `generalization`, `responsible`, `note`, `sort`, `show_`,  `done`, `direction_id`, `plantable_id`, `purpose_id`, `r_id`) VALUES ("'.$content.'", "'.$termin.'", "'.$generalization.'", "'.$responsible.'" , "'.$note.'" , '.$sort.', 1,  0, 1,  '.$plantable.', null, '.$r_id.');';

echo $sql.'<br/>';

$result = mysqli_query($connection, $sql);

echo  $result.'<br/>';