<?php
$config = array(
    'title' => 'АРМ школа',
    'db' => array(
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'name' => 'eduplan'
		//'server' => 'eduplan.ho.ua',
        //'username' => 'eduplan',
        //'password' => '21122012Ab',
        //'name' => 'eduplan'
    ),
    // Імена таблиць в базі даних
    'timetable_day'  =>  'timetable_day',
    'timetable_period' =>  'timetable_period',
    'timetable_teacher'  =>  'timetable_teacher',
    'timetable_class'  =>  'timetable_class',
    'timetable_subject'  =>  'timetable_subject',
    'timetable_classroom'  =>  'timetable_classroom',
    'timetable_group'  =>  'timetable_group',
    'timetable_lesson'  =>  'timetable_lesson',
    'timetable_lesson_classes'  =>  'timetable_lesson_classes',
    'timetable_lesson_teachers'  =>  'timetable_lesson_teachers',
    'timetable_lesson_subjects'  =>  'timetable_lesson_subjects',
    'timetable_lesson_classrooms'  =>  'timetable_lesson_classrooms',
    'timetable_lesson_groups'  =>  'timetable_lesson_groups',
    'timetable_card'  =>  'timetable_card',
    'timetable_teacher_cards'  =>  'timetable_teacher_cards',
    'timetable_card_classrooms'  =>  'timetable_card_classrooms',
    'timetable_reasons'  =>  'timetable_reasons',

);





require_once ('db.php');

$arr = array('plantable','timetable','academic_year','worktimetable','startacyear','endacyear');

foreach ($arr as $val){
    $sql = 'select `value` from `worktime_settings` where `field` = "'.$val.'"  ;';
//    echo $sql.'<br/>';
    $res = mysqli_query($connection, $sql);

    $r =mysqli_fetch_assoc($res);
    $config[$val] = (String)$r['value'];
}

//$res = mysqli_query($connection, 'select `value` from `worktime_settings` where `field` = "plantable"  ;');
//$r =mysqli_fetch_assoc($res);
//$config['plantable'] = (String)$r['value'];
//$res = mysqli_query($connection, 'select `value` from `worktime_settings` where `field` = "timetable"  ;');
//$r =mysqli_fetch_assoc($res);
//$config['timetable'] = (String)$r['value'];