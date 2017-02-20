<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Master Class - used for all pages
 */
class Cms_Controller extends MY_Controller
{

    public function __construct() {
    parent::__construct();

		$this->load->model('role_model');

		$fields = array("id", "name", "view", "export", "edit", "approve", "delete");
		$where = array("id ="=> $this->session->userdata('role'));
		$userrole_result = $this->role_model->get($fields, $where);
		if (count($userrole_result) > 0 ){
			$this->g_permission = $userrole_result[0];
		}else{
			redirect('login','refresh');
		}
		/*
		$g_permission = array(
			"view" => 1,
			"export" => 1,
			"edit" => 1,
			"approve" => 1,
			"delete" => 1
		);

		$this->g_permission = $g_permission;
		*/
		//template

		if ($this->session->userdata('login') != ""){
			//menu
			$menu_item = array(); //module, display name, link, user_roles
			//$menu_item[] = array("dashboard", "儀表板", site_url('dashboard/'), array(1, 2, 3, 4));

			$menu_item[] = array("name"=>"基本設定", "submenu" => array(
				array("user", "用户管理", site_url('module/user/listing'), array(1, 2)),
				array("role", "角色管理", site_url('module/role/listing'), array(1)),
				array("log", "日誌管理", site_url('module/log/listing'), array(1, 2, 3)),
        array("setting", "設定管理", site_url('setting/'), array(1))
			));

			//testing
			//$menu_item[] = array("form", "Form Management", site_url('module/form/listing'), array(1, 2, 3, 4));
      $menu_item[] = array("name"=>"主頁", "submenu" => array(
        array("homepage_meta", "詳細信息", site_url('module/page/edit/1'), array(1, 2, 3, 4)),
        array("homebanner", "橫額", site_url('module/homebanner/listing'), array(1, 2, 3, 4)),
        array("homegrid", "縮圖", site_url('module/homegrid/listing'), array(1, 2, 3, 4))
      ));

      $menu_item[] = array("name"=>"關於我們", "submenu" => array(
        array("aboutus_meta", "詳細信息", site_url('module/page/edit/2'), array(1, 2, 3, 4))
      ));

      $menu_item[] = array("name"=>"傳統禮節", "submenu" => array(
        array("ceremony_meta", "詳細信息", site_url('module/page/edit/3'), array(1, 2, 3, 4))
      ));

      $menu_item[] = array("name"=>"喜裕為您", "submenu" => array(
        array("service_meta", "詳細信息", site_url('module/page/edit/4'), array(1, 2, 3, 4)),
        array("services", "喜裕為您-服務", site_url('module/services/listing'), array(1, 2, 3, 4))
      ));

      $menu_item[] = array("name"=>"良時吉日", "submenu" => array(
        array("calendar_meta", "詳細信息", site_url('module/page/edit/5'), array(1, 2, 3, 4)),
        array("lunisolardates", "良時吉日日子", site_url('module/lunisolardates/listing'), array(1, 2, 3, 4))
      ));

      $menu_item[] = array("name"=>"婚享囍悅", "submenu" => array(
        array("gallery_meta", "詳細信息", site_url('module/page/edit/10'), array(1, 2, 3, 4)),
        array("gallery", "婚享囍悅相簿", site_url('module/gallery/listing'), array(1, 2, 3, 4))
      ));

      $menu_item[] = array("name"=>"嫁囍貼士", "submenu" => array(
        array("tips_meta", "詳細信息", site_url('module/page/edit/6'), array(1, 2, 3, 4)),
        array("tips", "嫁囍貼士列表", site_url('module/tips/listing'), array(1, 2, 3, 4))
      ));

      $menu_item[] = array("name"=>"消息及推廣", "submenu" => array(
        array("news_meta", "詳細信息", site_url('module/page/edit/7'), array(1, 2, 3, 4)),
        array("news", " 最新資訊", site_url('module/news/listing'), array(1, 2, 3, 4)),
        array("monthlytopic", " 每月專題", site_url('module/monthlytopic/listing'), array(1, 2, 3, 4))
      ));

      $menu_item[] = array("name"=>"聯絡我們", "submenu" => array(
        array("contactus_meta", "詳細信息", site_url('module/page/edit/8'), array(1, 2, 3, 4)),
        array("contactus", "聯絡我們表格", site_url('module/contactus/listing'), array(1, 2, 3, 4))
      ));

      $menu_item[] = array("name"=>"條款及細則", "submenu" => array(
        array("tnc_meta", "詳細信息", site_url('module/page/edit/9'), array(1, 2, 3, 4))
      ));


			$this->template = "template/template_inside";

			$this->page_content['header'] = $this->load->view('template/header', array("menu_item" => $menu_item), true);
			$this->page_content['footer'] = $this->load->view('template/footer', array(), true);
			$this->page_content['sidebar'] = $this->load->view('template/sidebar', array("menu_item" => $menu_item), true);
		}else{
			redirect('login','refresh');
		}

    }
}
