<?php

$filename = basename($_SERVER["SCRIPT_FILENAME"], '.php');

switch($filename){
  case "index":
    $page_id = 1;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
    }

    //get banner
    $sql = "select * from vso_homebanner where status = 1 order by rank desc";
    $result = $db->query($sql) or die($db->error);

    $banners = array();
    while ($row = $result->fetch_array()){
      $banners[] = array(
        "thumb" => $row['thumb'],
        "type" => $row['type_'.$lang],
        "link" => $row['link_'.$lang]
      );
    }

    //get grid
    $sql = "select * from vso_homegrid where status = 1";
    $result = $db->query($sql) or die($db->error);

    $grids = array();
    while ($row = $result->fetch_array()){
      $grids[$row['id']] = array(
        "thumb" => $row['thumb'],
        "type" => $row['type_'.$lang],
        "link" => $row['link_'.$lang]
      );
    }
    break;

  case "about":
    $page_id = 2;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
      $page_info['cover_banner'] = $row['image_'.$lang];

      $page_info['content1'] = $row['content1_'.$lang];
      $page_info['content2'] = $row['content2_'.$lang];
      $page_info['content3'] = $row['content3_'.$lang];
    }
    break;

  case "traditional-ceremony":
    $page_id = 3;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
      $page_info['cover_banner'] = $row['image_'.$lang];

      $page_info['heading'] = $row['text1_'.$lang];
      $page_info['description'] = $row['content1_'.$lang];
    }
    break;

  case "services":
    $page_id = 4;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
      $page_info['cover_banner'] = $row['image_'.$lang];
    }

    //get services list
    $sql = "select * from vso_services where status <=2 order by rank asc";
    $result = $db->query($sql) or die($db->error);

    $services = array();
    while ($row = $result->fetch_array()){
      $services[] = array(
        "id" => ($row['id']-1),
        "type" => "slider",
        "status" => $row['status'],
        "title" => $row['title_'.$lang],
        "message" => nl2br($row['description_'.$lang]),
        "img" => $row['thumb'],
        "slider_bg" =>$row['background_image'],
        "status" => $row['status'],
        "btn" => showContent(array("services", "more")),
        "btn_link" => ($row['link_'.$lang]=="") ? "javascript:void(0);" : $row['link_'.$lang]
      );
    }
    $services[] = array(
      "id" => 0,
      "type" => "logo",
      "status" => 1,
      'img' => ''
    );


    break;

  case "calendar":
    $page_id = 5;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
      $page_info['cover_banner'] = $row['image_'.$lang];
    }
    break;

  case "gallery":
    $page_id = 10;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
      $page_info['cover_banner'] = $row['image_'.$lang];
    }

    //get gallery list
    $sql = "select * from vso_gallery where status = 1 order by rank asc";
    $result = $db->query($sql) or die($db->error);

    $galleries = array();
    while ($row = $result->fetch_array()){
      $galleries[] = array(
        "id" => ($row['id']-1),
        "thumb" => $row["thumb"],
        "image" => $row["image"]
      );
    }

    break;

  case "tips":
    $page_id = 6;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
      $page_info['cover_banner'] = $row['image_'.$lang];
    }

    $cssclass = array(1=>"golden", 2=>"lightpink", 3=>"red", 4=>"white", 5=>"golden");

    $sql = "select * from vso_tips where status = 1 order by id";
    $result = $db->query($sql) or die($db->error);
    $tips = array();
    while ($row = $result->fetch_array()){
      $temp = array();
      $temp['id'] = $row['id'];
      $temp['title'] = $row['title_'.$lang];
      $temp['description'] = nl2br($row['description_'.$lang]);
      $temp['cssclass'] = $cssclass[$row['id']];
      $tips[] = $temp;
    }
    break;

  case "monthly-topic":
  case "news":
  case "news-article":
    $page_id = 7;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
      $page_info['cover_banner'] = $row['image_'.$lang];
    }

    if ($filename == "monthly-topic"){

      $sql = "select * from vso_monthlytopic where status = 1 order by year, month";
      $result = $db->query($sql) or die($db->error);

      $topic = array();
      $items = array();
      $items["info"] = array();
      $items["items"] = array();

      $counter = 1;
      while ($row = $result->fetch_array()){
        if ($counter == "1"){
          $items["info"]["startYear"] = $row['year'];
        }
        $items["info"]["endYear"] = $row['year'];

        if (!isset($items["items"][$row['year']])){
          $items["items"][$row['year']] = array();
        }
        $items["items"][$row['year']][$row['month']] = array("title"=>$row['title_'.$lang]);

        $topic['year'] = $row['year'];
        $topic['month'] = $row['month'];
        $topic['title'] = $row['title_'.$lang];
        $topic['content'] = $row['content_'.$lang];
        $topic['image'] = $row['image_'.$lang];
        $topic['image_m'] = $row['image_m_'.$lang];

        $counter++;
      }

      $month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : "";
      $year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : "";

      if ($month != "" && $year != ""){
        $sql = sprintf("select * from vso_monthlytopic where status = 1 and year = '%s' and month = '%s'", $db->escape_string($year), $db->escape_string($month));
        $result = $db->query($sql) or die($db->error);
        if ($row = $result->fetch_array()){
          $topic['year'] = $row['year'];
          $topic['month'] = $row['month'];
          $topic['title'] = $row['title_'.$lang];
          $topic['content'] = $row['content_'.$lang];
          $topic['image'] = $row['image_'.$lang];
          $topic['image_m'] = $row['image_m_'.$lang];
        }
      }
    }else if ($filename == "news-article"){
      $sql = sprintf("select * from vso_news where status = 1 and id = '%s'", $db->escape_string($id));
      $result = $db->query($sql) or die($db->error);

      $topic = array();
      if ($row = $result->fetch_array()){
        $topic['title'] = $row['title_'.$lang];
        $topic['content'] = $row['content_'.$lang];
        $topic['image'] = $row['image_'.$lang];
      }
    }
    break;

  case "contact-us":
    $page_id = 8;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
      $page_info['cover_banner'] = $row['image_'.$lang];

      $page_info['name'] = $row['text1_'.$lang];
      $page_info['address'] = $row['text2_'.$lang];
      $page_info['opening_hours'] = $row['text3_'.$lang];
      $page_info['phone'] = $row['text4_'.$lang];
      $page_info['email'] = $row['text5_'.$lang];
      $page_info['latitude'] = $row['text6_'.$lang];
      $page_info['longitude'] = $row['text7_'.$lang];
    }
    break;

  case "tnc":
    $page_id = 9;
    //get page Info
    $sql = sprintf("select * from vso_page where id = '%s'", $db->escape_string($page_id));
    $result = $db->query($sql) or die($db->error);
    $page_info = array();
    if ($row = $result->fetch_array()){
      $page_info['title'] = $row['title_'.$lang];
      $page_info['meta_keyword'] = $row['meta_keyword_'.$lang];
      $page_info['meta_desc'] = $row['meta_desc_'.$lang];
      $page_info['cover_banner'] = $row['image_'.$lang];

      $page_info['content'] = $row['editor1_'.$lang];
    }
    break;
}

//get footer item
//get services list
$sql = "select * from vso_services where status = 1 order by rank asc";
$result = $db->query($sql) or die($db->error);

$footer_services = array();
while ($row = $result->fetch_array()){
  $footer_services[] = array(
    "id" => $row['id'],
    "title" => $row['title_'.$lang]
  );
}

$sql = "select * from vso_tips where status = 1 order by id";
$result = $db->query($sql) or die($db->error);
$footer_tips = array();
while ($row = $result->fetch_array()){
  $temp = array();
  $temp['id'] = $row['id'];
  $temp['title'] = $row['title_'.$lang];
  $footer_tips[] = $temp;
}

//get GA code
$sql = "select * from vso_setting where name = 'ga_tracking'";
$result = $db->query($sql) or die($db->error);
$row = $result->fetch_array();
$ga_code = $row['value'];

?>
