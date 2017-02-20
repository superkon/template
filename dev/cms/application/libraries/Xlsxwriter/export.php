<?php
include '../config.php';
include 'table.php';

require_once '../XLSXWriter/xlsxwriter.class.php';

$writer = new XLSXWriter();
$writer->setAuthor('William Yip');

$data1 = array();

$fields_array = array();
foreach ($table_field as $field ){
	if ($field["export"] =="1"){
		$fields_array[] = $field["name"];
	}
}
//header link
$data1[] = $fields_array;

//get event list
$sql = "select ".implode(",", $fields_array)." from ".$table_name." order by ".$table_sort;
$rs = $db->query($sql) or die($db->error);

$counter = 2;
while($row = $rs->fetch_array()){

	$i = 1;
	$data_row = array();
	foreach ($table_field as $field ){
		if ($field["export"] =="1"){
	
			$data_row[] = $row[$field["name"]];
		}
	}
	$data1[] = $data_row;
}
$writer->writeSheet($data1,'Member');

$filename = $table_name . ".xlsx";

// Redirect output to a client’s web browser (Excel5)
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
echo $writer->writeToString();
