<?php
if(session_id() == '') session_start();
date_default_timezone_set("Asia/Hong_Kong");

include_once dirname(__FILE__) . "/config.custom.php";


//Default header config-------------------------------------------------------------
//set basic header
header('Cache-control: private'); // IE 6 FIX
// always modified
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
// HTTP/1.1
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
// HTTP/1.0
header('Pragma: no-cache');

$http_protocal = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')?"https://" : "http://";

//SMTP ---------------------------------------------------------------------------
define('SMTP_HOST', '127.0.0.1');
define('SMTP_PORT', 587);
define('SMTP_AUTH', true);
define('SMTP_USERNAME', "");
define('SMTP_PASSWORD', "");
define('SMTP_SENDERNAME', "");
define('SMTP_SENDEREMAIL', "");
define('SMTP_SUBJECT', "Email Subject");

//common function ---------------------------------------------------------------
include_once dirname(__FILE__) . "/db.php";
include_once dirname(__FILE__) . "/func.php";

//language Files ----------------------------------------------------------------
if (isset($_REQUEST['lang'])){
  $lang = $_REQUEST['lang'];
}else{
  $lang = DEFAULT_LANGUAGE;
}

include_once dirname(__FILE__) . "/lang/".$lang.".php";
