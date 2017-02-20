<?php
include_once "../include/config.php";

$result_arr = array();
$result_arr['status'] = 1;
$result_arr['data'] = array();

$month = (isset($_REQUEST['month']))?$_REQUEST['month']:date("n");
$year = (isset($_REQUEST['year']))?$_REQUEST['year']:date("Y");
$lang = (isset($_REQUEST['lang']))?$_REQUEST['lang']:"en";

$sql = sprintf("select * from vso_lunisolardates where year(ldate) = '%s' and month(ldate) = '%s' and status = 1 order by ldate asc", $db->escape_string($year), $db->escape_string($month));
$result = $db->query($sql) or die($db->error);

while($row = $result->fetch_array()){
  $result_arr['data'][$row['ldate']] = array();
  $result_arr['data'][$row['ldate']]["good_title"] = $row['pros_title_'.$lang];
  $result_arr['data'][$row['ldate']]["good_message"] = nl2br($row['pros_desc_'.$lang]);
  $result_arr['data'][$row['ldate']]["bad_title"] = $row['cons_title_'.$lang];
  $result_arr['data'][$row['ldate']]["bad_message"] = nl2br($row['cons_desc_'.$lang]);
}

$result_arr['status'] = 1;
returnResult(1, $result_arr);
?>
