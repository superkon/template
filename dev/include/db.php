<?php
//create DB
function dbconnect(){
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$conn->query("SET NAMES utf8");
	
	return $conn;
}

$db = dbconnect();
?>
