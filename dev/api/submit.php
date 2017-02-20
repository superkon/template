<?php
include_once "../include/config.php";

$result_arr = array();
$result_arr['status'] = 1;

//check parameter
$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$remark = $_REQUEST['remark'];
$gender = $_REQUEST['gender'];

if ($name == "" || $phone == "" || $email == ""  || $gender == "" ){
	$result_arr['status'] = 0;
	$result_arr['msg'] = "Parameter Error";
	returnResult(1, $result_arr);
}

//insert intop DB
$param = array();
$param["name"] = "'".$db->escape_string($name) . "'";
$param["phone"] = "'".$db->escape_string($phone) . "'";
$param["email"] = "'".$db->escape_string($email) . "'";
$param["message"] = "'".$db->escape_string($remark) . "'";
$param["gender"] = "'".$db->escape_string($gender) . "'";

$param["rank"] = "0";
$param["status"] = "1";
$param["ip"] = "'".$_SERVER['REMOTE_ADDR']. "'";
$param["createby"] = "0";
$param["createdate"] = "now()";
$param["updateby"] = "0";
$param["updatedate"] = "now()";
$param["useragent"] = "'".$_SERVER["HTTP_USER_AGENT"]. "'";
$param["ip"] = "'".$_SERVER['REMOTE_ADDR']. "'";

$sql = createInsertSQL("vso_contactus", $param );
$result = $db->query($sql) or die($db->error);

if ($result){
	$result_arr["id"] = $db->insert_id;
}else{
	$result_arr['status'] = 0;
	$result_arr['msg'] = "System Error(104)";
	returnResult(1, $result_arr);
}

$result_arr['status'] = 1;
returnResult(1, $result_arr);
?>
