<?php
require 'vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();

function m2t($millimeters){
    return floor($millimeters*56.7); //1 твип равен 1/567 сантиметра
}//m2t


$phpWord->setDefaultFontName('Times New Roman');
$phpWord->setDefaultFontSize(14);
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
$text = "Заголовок 1";

$section->addTitle( $text, $titleLevel1);

$text2 = "Заголовок 2";

$section->addTitle( $text2, $titleLevel2);


//$sectionStyle = array();
//$text = "Привіт світ";
//
//$section = $phpWord -> addSection($sectionStyle);
//
//$section->addText(htmlspecialchars($text),
//    array(),
//    array()
//    );
//
$tableStyle = array(
    'borderColor' => '006699',
    'bgColor' => '444444',
    'borderSize'  => 6,
    'cellMargin'  => 50
);
//$cellStyle = array(
//    'borderColor' => '006699',
//    'borderSize'  => 6,
//    'cellMargin'  => 50
//);
//$firstRowStyle = array('bgColor' => '66BBFF');
//$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
//$table = $section->addTable('myTable');
//
//
//$section = $phpWord->addSection();
//$table = $section->addTable([$tableStyle]);
//$table->addRow(300, array());
//$cell = $table->addCell(200, array());
//$cell2 = $table->addCell(200, array());
//$cell->addText("Йобаний екібастуз");
//$cell2->addText("Йобаний екібастуз2");

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
    'bgColor' => '00cc00',

    'borderTopColor' => '000000',
    'borderBottomColor' => '000000',
    'borderLeftTopColor' => '000000',
    'borderRightColor' => '000000',
    'borderTopSize' => 1,
    'borderBottomSize' => 1,
    'borderLeftTopSize' => 1,
    'borderRightSize' => 1
    );

//$section = $phpWord->addSection();
$table = $section->addTable([$tableStyle]);
$table->addRow();
$r = 1;
for ($c = 1; $c <= 5; $c++) {
    $table->addCell(1750, $table_header_style)->addText("Row {$r}, Cell {$c}");
}
for ($r = 2; $r <= 8; $r++) {
    $table->addRow();
    for ($c = 1; $c <= 5; $c++) {
        $table->addCell(1750, $table_cell_style)->addText("Row {$r}, Cell {$c}");
    }
}

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('doc.docx');
