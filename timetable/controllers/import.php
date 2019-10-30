<?php
require_once('../../include/config.php');

$uploaddir = '../tmp/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);


if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
//    echo "Файл корректен и был успешно загружен.\n";
} else {
//    echo "Возможная атака с помощью файловой загрузки!\n";
}




$fp = fopen($uploadfile, 'rt'); // Текстовый режим
//
//
$text = file_get_contents($uploadfile);

$xmlstr = mb_convert_encoding($text, 'utf-8', 'cp1251');


$xml = new SimpleXMLElement($xmlstr);


$timetable_id = 1;


$sql = 'DELETE FROM '.$config['timetable_day'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
foreach ($xml->days[0] as $element) {
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




// -------------------------



$sql = 'DELETE FROM '.$config['timetable_lesson'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$sql = 'DELETE FROM '.$config['timetable_lesson_classes'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$sql = 'DELETE FROM '.$config['timetable_lesson_teachers'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$sql = 'DELETE FROM '.$config['timetable_lesson_subjects'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$sql = 'DELETE FROM '.$config['timetable_lesson_classrooms'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$sql = 'DELETE FROM '.$config['timetable_lesson_groups'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$sql = 'DELETE FROM '.$config['timetable_teacher_cards'].' WHERE True; ';
$result = mysqli_query($connection, $sql);
$sql = 'DELETE FROM '.$config['timetable_card_classrooms'].' WHERE True; ';
$result = mysqli_query($connection, $sql);






$c = 0;
foreach ($xml->lessons[0] as $element) {
    $ident  = substr($element['id'], 1);
    $periodspercard = $element['periodspercard'];
    $periodsperweek = $element['periodsperweek'];
    $weeks = $element['weeks'];
    $studentids = $element['studentids'];
    $sort = ++$c;

    // ----------------
    $classids = $element['classids'];
    $arr = explode (',',$classids );
    foreach ($arr as $value){
        $val = intval (substr(trim($value),1));
        $classidvalue = $class_id[$val];
        $sql1 = 'INSERT INTO '.$config['timetable_lesson_classes'].' ( `lesson_id`, `class_id`) 
            VALUES (' . '-'  . $ident . ', '. strval($classidvalue) .  ');';
        $result = mysqli_query($connection, $sql1);
    }

    // ----------------
    $teacherids = $element['teacherids'];
    $arr = explode (',',$teacherids);
    $teachs = [];
    foreach ($arr as $value){
        $val = intval (substr(trim($value),1));
        $teacheriddvalue = $teach_id[$val];
        $sql1 = 'INSERT INTO '.$config['timetable_lesson_teachers'].' ( `lesson_id`, `teacher_id`) 
            VALUES (' . '-'  . $ident . ', '. strval($teacheriddvalue) .  ');';
        $result = mysqli_query($connection, $sql1);

    }

    // ----------------
    $subjectids = $element['subjectid'];
    $arr = explode (',',$subjectids);
    foreach ($arr as $value){
        $val = intval (substr(trim($value),1));
        $subjectidvalue = $subjects_id[$val];
        $sql1 = 'INSERT INTO '.$config['timetable_lesson_subjects'].' ( `lesson_id`, `subject_id`) 
            VALUES (' . '-'  . $ident . ', '. strval($subjectidvalue) .  ');';
        $result = mysqli_query($connection, $sql1);
    }

    // ----------------
    $classroomids = $element['classroomids'];
    $arr = explode (',',$classroomids);
    foreach ($arr as $value){
        $val = intval (substr(trim($value),1));
        $classroomidvalue = $classrooms_id[$val];
        $sql1 = 'INSERT INTO '.$config['timetable_lesson_classrooms'].' ( `lesson_id`, `classroom_id`) 
            VALUES (' . '-'  . $ident . ', '. strval($classroomidvalue) .  ');';
        $result = mysqli_query($connection, $sql1);
    }

    // ----------------
    $groupids = $element['groupids'];
    $arr = explode (',',$groupids);
    foreach ($arr as $value){
        $val = intval (substr(trim($value),1));
        $groupidvalue = $groups_id[$val];
        $sql1 = 'INSERT INTO '.$config['timetable_lesson_groups'].' ( `lesson_id`, `group_id`) 
            VALUES (' . '-'  . $ident . ', '. strval($groupidvalue) .  ');';
        $result = mysqli_query($connection, $sql1);
    }

    // --------------------------



    // -----------------
    $classids = $element['classids'];
    $sql = 'INSERT INTO '.$config['timetable_lesson'].' (`periodspercard`, `periodsperweek`,  `weeks`,  `studentids`,  `sort`, `timetable_id`) 
            VALUES ("' . $periodspercard . '", "' . $periodsperweek . '",  "' . $weeks . '",  "' . $studentids . '",  ' . $sort . ', ' . $timetable_id . ');';
    $result = mysqli_query($connection, $sql);
}
$lessons_id = [];


// -------------------
$sql = "SELECT * FROM " . $config['timetable_lesson'] . " ORDER BY `id`";
$result = mysqli_query($connection, $sql);
$num = 0;
while ($r1 = mysqli_fetch_assoc($result)){
    $id = $r1['id'];
    $lessons_id[++$num] = $id;
    $sql1 = 'UPDATE `' . $config['timetable_lesson_classes'] . '` SET `lesson_id` = ' . $id. ' 
             WHERE `lesson_id` = ' . '-' . strval($num) . ' ;';
    $result1 = mysqli_query($connection, $sql1);
    $sql1 = 'UPDATE `' . $config['timetable_lesson_teachers'] . '` SET `lesson_id` = ' . $id. ' 
             WHERE `lesson_id` = ' . '-' . strval($num) . ' ;';
    $result1 = mysqli_query($connection, $sql1);
    $sql1 = 'UPDATE `' . $config['timetable_lesson_subjects'] . '` SET `lesson_id` = ' . $id. ' 
             WHERE `lesson_id` = ' . '-' . strval($num) . ' ;';
    $result1 = mysqli_query($connection, $sql1);
    $sql1 = 'UPDATE `' . $config['timetable_lesson_classrooms'] . '` SET `lesson_id` = ' . $id. ' 
             WHERE `lesson_id` = ' . '-' . strval($num) . ' ;';
    $result1 = mysqli_query($connection, $sql1);
    $sql1 = 'UPDATE `' . $config['timetable_lesson_groups'] . '` SET `lesson_id` = ' . $id. ' 
             WHERE `lesson_id` = ' . '-' . strval($num) . ' ;';
    $result1 = mysqli_query($connection, $sql1);
}


// --------------------

// -------------------------
$sql = 'DELETE FROM `'.$config['timetable_card'].'` WHERE True; ';
$result = mysqli_query($connection, $sql);

$c = 0;

foreach ($xml->cards[0] as $element) {
    $c++;
    $lessonid = substr($element['lessonid'],1);
    $classroomids = $element['classroomids'];
    $day = $element['day'];
    $period = $element['period'];

    $sql = 'SELECT * FROM `'.$config['timetable_day'].'` WHERE  `day` = ' . $day . ' and  `timetable_id` = '. $timetable_id . ' ';
    $result = mysqli_query($connection, $sql);
    while ($r1 = mysqli_fetch_assoc($result)){
        $day_id = $r1['id'];
    }
    $sql = 'SELECT * FROM `'.$config['timetable_period'].'` WHERE  `period` = ' . $period . ' and  `timetable_id` = '. $timetable_id . ' ';
    $result = mysqli_query($connection, $sql);
    while ($r1 = mysqli_fetch_assoc($result)){
        $period_id = $r1['id'];
    }
    $lesson_id = $lessons_id[intval($lessonid)];

    $sql = 'INSERT INTO `'.$config['timetable_card'].'` (`day_id`, `lesson_id`,  `period_id`,  `timetable_id`) 
            VALUES (' . strval($day_id) . ', ' .strval( $lesson_id) . ',  ' . strval($period_id) . ',  ' . strval($timetable_id) . ');';
    $result = mysqli_query($connection, $sql);

}

// Формування таблиці timetable_teacher_cards
$sql = 'SELECT * FROM `'.$config['timetable_card'].'` WHERE  `timetable_id` = '. $timetable_id . ' ';
$result = mysqli_query($connection, $sql);
while ($r1 = mysqli_fetch_assoc($result)){
    $card_id = $r1['id'];
    $lesson_id = $r1['lesson_id'];
    $sql1 = "SELECT * FROM `" . $config['timetable_lesson_teachers'] . "`  WHERE  `lesson_id` = " . $lesson_id . " ; ";
    $result1 = mysqli_query($connection, $sql1);
    while ($r2 = mysqli_fetch_assoc($result1)){
        $teacher_id = $r2['teacher_id'];
        $sql2 = 'INSERT INTO `'.$config['timetable_teacher_cards'].'` (`teacher_id`, `card_id`)
                 VALUES (' . strval($teacher_id) . ', ' .strval( $card_id) . ');';
        $result2 = mysqli_query($connection, $sql2);
    }

}
//TODO формувати таблицю `timetable_card_classrooms`


// ----------------------


$newURL = '../../';


header('Location: '.$newURL);

?>



