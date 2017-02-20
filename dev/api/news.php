<?php
include_once "../include/config.php";

$result_arr = array();
$result_arr['status'] = 1;
$result_arr['basicInfo'] = array();
$result_arr['basicInfo']['isLastPage'] = true;
$result_arr['items'] = array();

$page = (isset($_REQUEST['page']))?$_REQUEST['page']:0;
$item_per_item = (isset($_REQUEST['item_per_item']))?$_REQUEST['item_per_item']:3;
$lang = (isset($_REQUEST['lang']))?$_REQUEST['lang']:"en";

include "../include/lang/". $lang . ".php";

$sql = sprintf("select * from vso_news where status = 1 order by news_date asc limit %s, %s", $db->escape_string(($page)*$item_per_item), $db->escape_string($item_per_item));
$result = $db->query($sql) or die($db->error);

while($row = $result->fetch_array()){
  $result_arr['items'][] = array(
    "id" => $row['id'],
    "date" => $row['news_date'],
    "img" => $row['thumb_'.$lang],
    "title" => $row['title_'.$lang],
    "message" => $row['description_'.$lang],
    "btn_link" => "news-article.php?id=".$row['id'],
    "btn_text" => $langText["services"]['more']
  );
}


$result_arr['status'] = 1;
returnResult(1, $result_arr);
?>
