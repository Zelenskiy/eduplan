<?php
require_once('../../include/config.php');

$uploaddir = '../tmp/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

//echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
//    echo "Файл корректен и был успешно загружен.\n";
} else {
//    echo "Возможная атака с помощью файловой загрузки!\n";
}

//echo 'Некоторая отладочная информация:';
//print_r($_FILES);

//print "</pre>";

//print_r($_FILES['userfile']);
//echo $uploadfile;
$fp = fopen($uploadfile, 'rt'); // Текстовый режим
//
//
$text = file_get_contents($uploadfile);

$xmlstr = mb_convert_encoding($text, 'utf-8', 'cp1251');


//echo $xmlstr;

$xml = new SimpleXMLElement($xmlstr);
?>
    <pre>
<?php

$timetable_id = 1;


$sql = 'DELETE FROM '.$config['timetable_day'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
foreach ($xml->days[0] as $element) {
    echo $element['name'] . "<br>";
    $day = $element['day'];
    $name = $element['name'];
    $short = $element['short'];
    $sql = 'INSERT INTO  '.$config['timetable_day'].'  (`day`, `name`, `short`, `timetable_id`) 
            VALUES ("' . $day . '", "' . $name . '", "' . $short . '", ' . $timetable_id . ');';
    $result = mysqli_query($connection, $sql);
}

$sql = 'DELETE FROM '.$config['timetable_period'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
foreach ($xml->periods[0] as $element) {
    $period = $element['period'];
    $starttime = $element['starttime'];
    $endtime = $element['endtime'];
    $sql = 'INSERT INTO '.$config['timetable_period'].' (`period`, `starttime`, `endtime`, `timetable_id`) 
            VALUES ("' . $period . '", "' . $starttime . '", "' . $endtime . '", ' . $timetable_id . ');';
    $result = mysqli_query($connection, $sql);
}

$sql = 'DELETE FROM '.$config['timetable_teacher'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$c = 0;
foreach ($xml->teachers[0] as $element) {
    $name = $element['name'];
    $short = $element['short'];
    $gender = $element['gender'];
    $color = $element['color'];
    $c++;
    $sort = $c;
    $sql = 'INSERT INTO '.$config['timetable_teacher'].' (`name`, `short`, `gender`,  `color`,  `sort`, `timetable_id`) 
            VALUES ("' . $name . '", "' . $short . '", "' . $gender . '", "' . $color . '", ' . $sort . ', ' . $timetable_id . ');';
    $result = mysqli_query($connection, $sql);
}
$teach_id = [];
$sql = 'SELECT * FROM '.$config['timetable_teacher'].' ORDER BY `id`';
$result = mysqli_query($connection, $sql);
$num = 0;
while ($r1 = mysqli_fetch_assoc($result)){
    $id = $r1['id'];
    $teach_id[++$num] = $id;

}
//print_r($teach_id);

$sql = 'DELETE FROM '.$config['timetable_class'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$c = 0;
foreach ($xml->classes[0] as $element) {
    $name = $element['name'];
    $short = $element['short'];
    $c++;
    $sort = $c;
    $sql = 'INSERT INTO '.$config['timetable_class'].' (`name`, `short`,  `sort`, `timetable_id`) 
            VALUES ("' . $name . '", "' . $short . '",  ' . $sort . ', ' . $timetable_id . ');';
    $result = mysqli_query($connection, $sql);
}
$class_id = [];
$sql = 'SELECT * FROM '.$config['timetable_class'].' ORDER BY `id`';
$result = mysqli_query($connection, $sql);
$num = 0;
while ($r1 = mysqli_fetch_assoc($result)){
    $id = $r1['id'];
    $class_id[++$num] = $id;
}
//print_r($class_id);

$sql = 'DELETE FROM '.$config['timetable_subject'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$c = 0;
foreach ($xml->subjects[0] as $element) {
    $name = $element['name'];
    $short = $element['short'];
    $c++;
    $sort = $c;
    $sql = 'INSERT INTO '.$config['timetable_subject'].' (`name`, `short`,  `sort`, `timetable_id`) 
            VALUES ("' . $name . '", "' . $short . '",  ' . $sort . ', ' . $timetable_id . ');';
    $result = mysqli_query($connection, $sql);
}
$subjects_id = [];
$sql = 'SELECT * FROM '.$config['timetable_subject'].' ORDER BY `id`';
$result = mysqli_query($connection, $sql);
$num = 0;
while ($r1 = mysqli_fetch_assoc($result)){
    $id = $r1['id'];
    $subjects_id[++$num] = $id;
}
print_r($subjects_id);

$sql = 'DELETE FROM '.$config['timetable_classroom'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$c = 0;
foreach ($xml->classrooms[0] as $element) {
    $name = $element['name'];
    $short = $element['short'];
    $c++;
    $sort = $c;
    $sql = 'INSERT INTO '.$config['timetable_classroom'].' (`name`, `short`,  `sort`, `timetable_id`) 
            VALUES ("' . $name . '", "' . $short . '",  ' . $sort . ', ' . $timetable_id . ');';
    $result = mysqli_query($connection, $sql);
}
$classrooms_id = [];
$sql = 'SELECT * FROM '.$config['timetable_classroom'].' ORDER BY `id`';
$result = mysqli_query($connection, $sql);
$num = 0;
while ($r1 = mysqli_fetch_assoc($result)){
    $id = $r1['id'];
    $classrooms_id[++$num] = $id;
}
print_r($classrooms_id);

$sql = 'DELETE FROM '.$config['timetable_group'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$c = 0;
foreach ($xml->groups[0] as $element) {
    $name = $element['name'];
    $entireclass = $element['entireclass'];
    $divisiontag = $element['divisiontag'];
    $studentcount = $element['studentcount'];
    $c++;
    $sort = $c;
    $sql = 'INSERT INTO '.$config['timetable_group'].' (`name`, `entireclass`,  `divisiontag`,  `studentcount`,  `sort`, `timetable_id`) 
            VALUES ("' . $name . '", "' . $entireclass . '",  "' . $divisiontag . '",  "' . $studentcount . '",  ' . $sort . ', ' . $timetable_id . ');';
    $result = mysqli_query($connection, $sql);
}
$groups_id = [];
$sql = 'SELECT * FROM '.$config['timetable_group'].' ORDER BY `id`';
$result = mysqli_query($connection, $sql);
$num = 0;
while ($r1 = mysqli_fetch_assoc($result)){
    $id = $r1['id'];
    $groups_id[++$num] = $id;
}
print_r($groups_id);

$sql = 'DELETE FROM '.$config['timetable_lesson'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$sql = 'DELETE FROM '.$config['timetable_lesson_classes'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$c = 0;
foreach ($xml->lessons[0] as $element) {
    $periodspercard = $element['periodspercard'];
    $periodsperweek = $element['periodsperweek'];
    $weeks = $element['weeks'];
    $studentids = $element['studentids'];
    $sort = ++$c;
    $arr = explode (',',$studentids );
    foreach ($arr as $value){
        $value = trim($value);

    }

    //
    $classids = $element['classids'];
    $sql = 'INSERT INTO '.$config['timetable_lesson'].' (`periodspercard`, `periodsperweek`,  `weeks`,  `studentids`,  `sort`, `timetable_id`) 
            VALUES ("' . $periodspercard . '", "' . periodsperweek . '",  "' . $weeks . '",  "' . $studentids . '",  ' . $sort . ', ' . $timetable_id . ');';
    $result = mysqli_query($connection, $sql);
}
$lessons_id = [];
$sql = 'SELECT * FROM '.$config['timetable_lesson'].' ORDER BY `id`';
$result = mysqli_query($connection, $sql);
$num = 0;
while ($r1 = mysqli_fetch_assoc($result)){
    $id = $r1['id'];
    $lessons_id[++$num] = $id;
}
print_r($groups_id);

$ttt = "CREATE TABLE `timetable_lesson` (
  `id` int(11) NOT NULL,
  `periodspercard` varchar(10) NOT NULL,
  `periodsperweek` varchar(10) NOT NULL,
  `weeks` varchar(10) NOT NULL,
  `sort` double DEFAULT NULL,
  `studentids` varchar(10) DEFAULT NULL,
  `timetable_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

?>
</pre>
<?php
//


$newURL = '../../';


//header('Location: '.$newURL);

