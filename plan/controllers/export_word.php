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

require '../../vendor/autoload.php';
require_once('../../include/config.php');

$phpWord = new \PhpOffice\PhpWord\PhpWord();
//
////http://docs.mirocow.com/doku.php?id=php:docx_doc

function m2t($millimeters){
    return floor($millimeters*56.7); //1 твип равен 1/567 сантиметра
}//m2t

function draw_table($connection, $section, $sql){
    $cellwidth = array(700, 10000, 1000, 1000, 800, 1000);
    $tableStyle = array('valign' => 'top',
//    'bgColor' => '00cc00',

        'borderTopColor' => '000000',
        'borderBottomColor' => '000000',
        'borderLeftTopColor' => '000000',
        'borderRightColor' => '000000',
        'borderTopSize' => 1,
        'borderBottomSize' => 1,
        'borderLeftTopSize' => 1,
        'borderRightSize' => 1
    );
    $fontStyleH= array(
        'italic' => false,
        'bold' => true,
        'size' => 10
    );
    $table_cell_style = array('valign' => 'top',
//    'bgColor' => '00cc00',

        'borderTopColor' => '000000',
        'borderBottomColor' => '000000',
        'borderLeftTopColor' => '000000',
        'borderRightColor' => '000000',
        'borderTopSize' => 1,
        'borderBottomSize' => 1,
        'borderLeftTopSize' => 1,
        'borderRightSize' => 1
    );
    $table_header_style = array('valign' => 'top',
        'bgColor' => 'E6E6E6',

        'borderTopColor' => '000000',
        'borderBottomColor' => '000000',
        'borderLeftTopColor' => '000000',
        'borderRightColor' => '000000',
        'borderTopSize' => 1,
        'borderBottomSize' => 1,
        'borderLeftTopSize' => 1,
        'borderRightSize' => 1
    );
    $result3 = mysqli_query($connection, $sql);
//    echo $sql.'<br/>';
    $row_count = mysqli_num_rows($result3);
    if ($row_count>0){
        $table = $section->addTable([$tableStyle]);
        $table->addRow();
        $h = array('№','Зміст роботи','Строки виконання','Форма узагальнення','Відповідальні','При- мітка');
        for ($c = 0; $c < 6; $c++) {
            $table->addCell($cellwidth[$c], $table_header_style)->addText($h[$c],$fontStyleH);
        }
        $i = 0;
        while ($r3 = mysqli_fetch_assoc($result3)) {
            $i++;
            $table->addRow();
            $table->addCell($cellwidth[0], $table_cell_style)->addText((String)$i);
            $table->addCell($cellwidth[1], $table_cell_style)->addText($r3['content']);
            $table->addCell($cellwidth[2], $table_cell_style)->addText($r3['termin']);
            $table->addCell($cellwidth[3], $table_cell_style)->addText($r3['generalization']);
            $table->addCell($cellwidth[4], $table_cell_style)->addText($r3['responsible']);
            $table->addCell($cellwidth[5], $table_cell_style)->addText($r3['note']);
        }
    }
}

if ($_GET['responsible']==''){
    $text_h = "";
} else {
    $text_h = $_GET['responsible'];
}


//
$phpWord->setDefaultFontName('Times New Roman');
$phpWord->setDefaultFontSize(12);
$properties = $phpWord->getDocInfo();
$properties->setCreator('My name');
$properties->setCompany('My factory');
$properties->setTitle('My title');
$properties->setDescription('My description');
$properties->setCategory('My category');
$properties->setLastModifiedBy('My name');
$properties->setCreated(mktime(0, 0, 0, 8, 12, 2019));
$properties->setModified(mktime(0, 0, 0, 8, 14, 2019));
$properties->setSubject('My subject');
$properties->setKeywords('my, key, word');


$section = $phpWord->addSection();
$sectionStyle = $section->getSettings();
$sectionStyle->setPortrait(); //или setPortrait()
$sectionStyle->setMarginLeft(m2t(15));
$sectionStyle->setMarginRight(m2t(15));
$sectionStyle->setMarginTop(m2t(15));
$sectionStyle->setMarginBottom(m2t(15));




$fontStyle1= array(
    'name' => 'Calibri',
    'italic' => false,
    'bold' => true,
    'size' => 18
);
$fontStyle2= array(
    'name' => 'Calibri',
    'italic' => true,
    'bold' => true,
    'size' => 16
);
$fontStyle3= array(
    'name' => 'Calibri',
    'italic' => true,
    'bold' => true,
    'size' => 14
);

$titleLevel1 = 1;
$titleLevel2 = 2;
$titleLevel3 = 3;
$phpWord->addTitleStyle($titleLevel1, $fontStyle1, []);
$phpWord->addTitleStyle($titleLevel2, $fontStyle2, []);
$phpWord->addTitleStyle($titleLevel3, $fontStyle3, []);

$plantable = $config['plantable'];



$sql = "select * from `plan_rubric` where `riven` = 1 and `plantable_id` = $plantable  order by `n_r` ";
$result = mysqli_query($connection, $sql);

while ($r1 = mysqli_fetch_assoc($result)) {
    $id = $r1['id'];

    $phpWord->addTitleStyle($titleLevel1, $fontStyle1, []);
    $text = $r1['n_r'] . ' ' . $r1['name'];

    $section->addTitle( $text, $titleLevel1);
    if ($text_h==''){
        $sql = "select * from `plan_plan` where `r_id`=$id order by `direction_id` , `sort`";
    } else {
        $sql = "select * from `plan_plan` where `r_id`=$id and `responsible` like '%$text_h%' order by `direction_id` , `sort`";
    }
//    echo $sql.'<br/>';

    draw_table($connection, $section, $sql);

    $sql2 = "select * from `plan_rubric` where `riven` = 2 and `id_owner_id` = $id and `plantable_id` = $plantable   order by `n_r` ";
    $result2 = mysqli_query($connection, $sql2);
    while ($r2 = mysqli_fetch_assoc($result2)) {
        $id2 = $r2['id'];
        $phpWord->addTitleStyle($titleLevel2, $fontStyle2, []);
        $text = $r1['n_r'] . '.' . ' ' . $r2['n_r'] . '.' . ' ' . $r2['name'];
        $section->addTitle( $text, $titleLevel2);

//        $sql = "select * from `plan_plan` where `r_id`=$id2 order by `direction_id` , `sort`";
        if ($text_h==''){
            $sql = "select * from `plan_plan` where `r_id`=$id2 order by `direction_id` , `sort`";
        } else {
            $sql = "select * from `plan_plan` where `r_id`=$id2 and `responsible` like '%$text_h%' order by `direction_id` , `sort`";
        }


        draw_table($connection, $section, $sql);


        $sql3 = "select * from `plan_rubric` where `riven` = 3 and `id_owner_id` = $id2 and `plantable_id` = $plantable   order by `n_r` ";
        $result3 = mysqli_query($connection, $sql3);
        while ($r3 = mysqli_fetch_assoc($result3)) {
            $id3 = $r3['id'];
            $text = $r1['n_r'] . '.' . ' ' .$r2['n_r'] . '.' . ' ' . $r3['n_r'] . '.' . ' ' . $r3['name'];
            $section->addTitle( $text, $titleLevel3);
//            $sql = "select * from `plan_plan` where `r_id`=$id3 order by `direction_id` , `sort`";
            if ($text_h==''){
                $sql = "select * from `plan_plan` where `r_id`=$id3 order by `direction_id` , `sort`";
            } else {
                $sql = "select * from `plan_plan` where `r_id`=$id3 and `responsible` like '%$text_h%' order by `direction_id` , `sort`";
            }
            draw_table($connection, $section, $sql);
        }
    }
}

$filename = "../../report/doc.docx";
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save($filename);

file_force_download($filename);
?>

