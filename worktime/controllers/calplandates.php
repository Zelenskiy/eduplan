<?php

function file_force_download($file)
{
    if (file_exists($file)) {
        // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
        // если этого не сделать файл будет читаться в память полностью!
        if (ob_get_level()) {
            ob_end_clean();
        }
        // заставляем браузер показать окно сохранения файла
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        // читаем файл и отправляем его пользователю

        if ($fd = fopen($file, 'rb')) {
            while (!feof($fd)) {
                print fread($fd, 1024);
            }
            fclose($fd);
        }
        exit;
    }
}


require_once('../../include/config.php');
$worktimetable = (int)$config['worktimetable'];


$sql = "select * from `worktime_workday` where  `worktimetable_id` = $worktimetable  order by `wday`   ;";
$result = mysqli_query($connection, $sql);
$tex = '';
$tex0 = '';
$nd = array('Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Нд');
while ($r1 = mysqli_fetch_assoc($result)) {
    $wday = $r1['wday'];
    $weekchzn = $r1['weekchzn'];
    $dayweek = $r1['dayweek'];
    $is_flag = $_POST['d' . strval($weekchzn) . '_' . strval($dayweek)];
    $is_short = $_POST['short'];
    if ($is_flag) {
        $count0 = (int)$_POST['t' . strval($weekchzn) . '_' . strval($dayweek)];
        for ($i = 1; $i <= $count0; $i++) {

            if (!$is_short) {
                $tex .= substr($wday, 8, 2) . '.' . substr($wday, 5, 2) . '.' . substr($wday, 2, 2);
                $tex0 .= substr($wday, 8, 2) . '.' . substr($wday, 5, 2) . '.' . substr($wday, 2, 2);

            } else {
                $tex .= substr($wday, 8, 2) . '.' . substr($wday, 5, 2);
                $tex0 .= substr($wday, 8, 2) . '.' . substr($wday, 5, 2);
            }
            $is_name = $_POST['nameDay'];
            if ($is_name) {
                $tex .= ' ' . $nd[$dayweek - 1];
                $tex0 .= ' ' . $nd[$dayweek - 1];
            }

            $tex .= '<br/>';
            $tex0 .= "\r\n";
        }

    }


}
$filename = "../../report/calplan.txt";
$fd = fopen($filename, 'w') or die("не удалось создать файл");
fwrite($fd, $tex0);
fclose($fd);

file_force_download($filename);


?>
