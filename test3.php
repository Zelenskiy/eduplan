<?php

require 'include/config_orm.php';

$rrr = R::getRow('select * from `worktime_settings` where `field` = "timetable" limit 1');
$timatable_id = $rrr['value'];
echo $timatable_id.'<br/>';

$days = R::getAll("select * from `timetable_day` where `timetable_id`=$timatable_id");
foreach ($days as $day){
	echo $day['name'].'<br/>';
}

R::close();
