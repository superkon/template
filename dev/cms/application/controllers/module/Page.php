<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends Cms_Controller
{

  private $page_info = array(
    "1" => array(
      "title" => "主頁",
      "menu_class" => "homepage_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容")
      )
    ),
    "2" => array(
      "title" => "關於我們",
      "menu_class" => "aboutus_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容"),
    		array("fieldname" => "content1_en", "displayname" => "簡介"),
    		array("fieldname" => "content1_tc", "displayname" => "簡介"),
    		array("fieldname" => "content1_sc", "displayname" => "簡介"),
    		array("fieldname" => "content2_en", "displayname" => "宗旨"),
    		array("fieldname" => "content2_tc", "displayname" => "宗旨"),
    		array("fieldname" => "content2_sc", "displayname" => "宗旨"),
    		array("fieldname" => "content3_en", "displayname" => "展望"),
    		array("fieldname" => "content3_tc", "displayname" => "展望"),
    		array("fieldname" => "content3_sc", "displayname" => "展望"),
    		array("fieldname" => "image_en", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_tc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_sc", "displayname" => "置頂橫額(1920X275)")
      )
    ),
    "3" => array(
      "title" => "傳統禮節",
      "menu_class" => "ceremony_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容"),
    		array("fieldname" => "text1_en", "displayname" => "置頂標題"),
    		array("fieldname" => "text1_tc", "displayname" => "置頂標題"),
    		array("fieldname" => "text1_sc", "displayname" => "置頂標題"),
    		array("fieldname" => "content1_en", "displayname" => "置頂內容"),
    		array("fieldname" => "content1_tc", "displayname" => "置頂內容"),
    		array("fieldname" => "content1_sc", "displayname" => "置頂內容"),
    		array("fieldname" => "image_en", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_tc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_sc", "displayname" => "置頂橫額(1920X275)")
      )
    ),
    "4" => array(
      "title" => "服務",
      "menu_class" => "service_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容"),
    		array("fieldname" => "image_en", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_tc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_sc", "displayname" => "置頂橫額(1920X275)")
      )
    ),
    "5" => array(
      "title" => "良時吉日",
      "menu_class" => "calendar_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容"),
    		array("fieldname" => "image_en", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_tc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_sc", "displayname" => "置頂橫額(1920X275)")
      )
    ),
    "6" => array(
      "title" => "嫁囍貼士",
      "menu_class" => "tips_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容"),
    		array("fieldname" => "image_en", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_tc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_sc", "displayname" => "置頂橫額(1920X275)")
      )
    ),
    "7" => array(
      "title" => "消息及推廣",
      "menu_class" => "news_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容"),
    		array("fieldname" => "image_en", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_tc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_sc", "displayname" => "置頂橫額(1920X275)")
      )
    ),
    "8" => array(
      "title" => "聯絡我們",
      "menu_class" => "contactus_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容"),
    		array("fieldname" => "image_en", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_tc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_sc", "displayname" => "置頂橫額(1920X275)"),
        array("fieldname" => "text1_en", "displayname" => "名稱"),
        array("fieldname" => "text1_tc", "displayname" => "名稱"),
        array("fieldname" => "text1_sc", "displayname" => "名稱"),
    		array("fieldname" => "text2_en", "displayname" => "地址"),
    		array("fieldname" => "text2_tc", "displayname" => "地址"),
    		array("fieldname" => "text2_sc", "displayname" => "地址"),
    		array("fieldname" => "text3_en", "displayname" => "開放時間"),
    		array("fieldname" => "text3_tc", "displayname" => "開放時間"),
    		array("fieldname" => "text3_sc", "displayname" => "開放時間"),
    		array("fieldname" => "text4_en", "displayname" => "電話"),
    		array("fieldname" => "text4_tc", "displayname" => "電話"),
    		array("fieldname" => "text4_sc", "displayname" => "電話"),
    		array("fieldname" => "text5_en", "displayname" => "電郵地址"),
    		array("fieldname" => "text5_tc", "displayname" => "電郵地址"),
    		array("fieldname" => "text5_sc", "displayname" => "電郵地址"),
    		array("fieldname" => "text6_en", "displayname" => "緯度"),
    		array("fieldname" => "text6_tc", "displayname" => "緯度"),
    		array("fieldname" => "text6_sc", "displayname" => "緯度"),
    		array("fieldname" => "text7_en", "displayname" => "經度"),
    		array("fieldname" => "text7_tc", "displayname" => "經度"),
    		array("fieldname" => "text7_sc", "displayname" => "經度")
      )
    ),
    "9" => array(
      "title" => "條款及細則",
      "menu_class" => "tnc_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容"),
    		array("fieldname" => "image_en", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_tc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_sc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "editor1_en", "displayname" => "內容"),
    		array("fieldname" => "editor1_tc", "displayname" => "內容"),
    		array("fieldname" => "editor1_sc", "displayname" => "內容"),
      )
    ),
    "10" => array(
      "title" => "婚享囍悅",
      "menu_class" => "gallery_meta",
      "show_fields" => array(
        array("fieldname" => "title_en", "displayname" => "標題"),
    		array("fieldname" => "title_tc", "displayname" => "標題"),
    		array("fieldname" => "title_sc", "displayname" => "標題"),
        array("fieldname" => "meta_keyword_en", "displayname" => "關鍵字"),
        array("fieldname" => "meta_keyword_tc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_keyword_sc", "displayname" => "關鍵字"),
    		array("fieldname" => "meta_desc_en", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_tc", "displayname" => "SEO內容"),
    		array("fieldname" => "meta_desc_sc", "displayname" => "SEO內容"),
    		array("fieldname" => "image_en", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_tc", "displayname" => "置頂橫額(1920X275)"),
    		array("fieldname" => "image_sc", "displayname" => "置頂橫額(1920X275)"),
      )
    )
  );

  private function getDisplayName($id, $fieldname){
    $fields = $this->page_info[$id]['show_fields'];
    foreach ($fields as $field){
      if ($field['fieldname'] == $fieldname){
        return $field['displayname'];
      }
    }

    return "";
  }

  public function __construct()
  {
    parent::__construct();
    $this->load->model('page_model');
    $this->load->model('user_model');


    $this->load->model('log_model');
    $this->log_model->setModule($this->page_model->getModuleName());

    //**handle permission *************************************************************************************************
    $permission = $this->page_model->showButton();
    $permission['copy'] = ($permission['show_copy_button'] == 1 && $this->g_permission['edit']) ? 1 : 0;
    $permission['export'] = ($permission['show_export_button'] == 1 && $this->g_permission['export']) ? 1 : 0;
    $permission['edit'] = ($permission['show_edit_button'] == 1 && $this->g_permission['edit']) ? 1 : 0;
    $permission['delete'] = ($permission['show_edit_button'] == 1 && $this->g_permission['delete']) ? 1 : 0;
    $permission['remove'] = ($permission['show_edit_button'] == 1 && (!$this->g_permission['delete'])) ? 1 : 0;
    $this->permission = $permission;
    //*********************************************************************************************************************
  }

  public function index()
  {
    redirect('module/page/listing', 'refresh');
  }

  public function listing()
  {

    //** Logging *********************************************************************************************************
    $this->log_model->addLog(1, 'Listing');
    //********************************************************************************************************************

    //***Loading content for the Listing page*****************************************************************************
    $this->content['notification'] = $this->session->flashdata('notification');
    $this->content['error'] = $this->session->flashdata('error');

    $this->content['fields'] = $this->page_model->getFieldsListing();
    $this->content['page_title'] = $this->page_model->getModuleDisplayName().' - '.lang('page_listing');

    $this->content['permission'] = $this->permission;
    $this->content['fields']['action'] = '';
    //********************************************************************************************************************

    $this->page_content['content'] = $this->load->view('page/listing', $this->content, true);

    return $this->load->view($this->template, $this->page_content);
  }

  public function getRecordAjax()
  {
    $start = $this->input->post_get('start');
    $length = $this->input->post_get('length');
    $search = $this->input->post_get('search');
    $order = $this->input->post_get('order');

    $options = array();
    //**Get Mapping Table*************************************************
    //user list
    $fields = array('id', 'name');
    $where = array('status <' => 10);
    $user_result = $this->user_model->get($fields, $where);

    $options['createby'] = $user_result;
    $options['updateby'] = $user_result;
    //*********************************************************************

    $result_arr = array();

    //**Generating Query*************************************************
    $fields = array_keys($this->page_model->getFieldsListing());

    $where = 'status < 10';

    $like = array();
    if (trim($search['value'] != '')) {
      $search_fields = array_keys($this->page_model->getFieldsSearch());
      foreach ($search_fields as $search_field) {
        $like[] = $search_field." LIKE '%".$this->db->escape_like_str($search['value'])."%' ESCAPE '!'";
      }

      if (count($like) > 0) {
        $where .= ' AND ('.implode(' OR ', $like).')';
      }
    }

    $orderby = $this->page_model->getTableSorting();
    if (array_key_exists($order[0]['column'], $fields)) {
      $orderby = $fields[$order[0]['column']].' '.$order[0]['dir'];
    }

    $result = $this->page_model->get($fields, $where, $orderby, $start, $length);

    $resultTotal = $this->page_model->getTotal();
    $result_arr['recordsTotal'] = $resultTotal;

    $resultTotal = $this->page_model->getTotal($where);
    $result_arr['recordsFiltered'] = $resultTotal;
    //*********************************************************************

    //**Replace the Option value ******************************************
    $result_arr['data'] = $this->page_model->getOptionValues($result, $options);
    //*********************************************************************

    //**Replace the Image to html code ******************************************
    $result_arr['data'] = $this->page_model->getInputTypeHTML($result_arr['data'], 100);
    //*********************************************************************

    //**action button ******************************************
    foreach ($result_arr['data'] as $idx => $val) {
      $result_arr['data'][$idx]['action'] = '';
      if ($this->permission['copy']) {
        $result_arr['data'][$idx]['action'] .= parent::buildButton(lang("button_copy"), 'window.open(\''.site_url('module/page/copy/'.$val['id']).'\',\'_self\');', 'btn-success');
      }

      if ($this->permission['edit']) {
        $result_arr['data'][$idx]['action'] .= parent::buildButton(lang("button_edit"), 'window.open(\''.site_url('module/page/edit/'.$val['id']).'\',\'_self\');', 'btn-success');
      }

      if ($this->permission['delete']) {
        $result_arr['data'][$idx]['action'] .= parent::buildButton(lang("button_delete"), 'deleteRecord('.$val['id'].')', 'btn-fail');
      }
    }
    //*********************************************************************

    return parent::output_json($result_arr);
  }

  public function copy($id = null)
  {
    if ($id != null) {
      //** Logging *********************************************************************************************************
      $this->log_model->addLog(1, 'Copy', $id);
      //********************************************************************************************************************

      $this->session->set_flashdata('id', $id);
      redirect('module/page/edit');
    } else {
      $this->session->set_flashdata('error', 'Invalid Access');
      redirect('module/page/listing');
    }
  }

  public function edit($id = null)
  {

    $this->content['notification'] = $this->session->flashdata('notification');
    $this->content['error'] = $this->session->flashdata('error');

    //**************** Get Option *************************************************
    $option_list = array();
    //get user list
    $fields = array('id', 'name');
    $where = array('status <' => 10);
    $user_result = $this->user_model->get($fields, $where);
    $option_list['createby'] = array();
    $option_list['updateby'] = array();
    foreach ($user_result as $value) {
      $option_list['createby'][$value['id']] = $value['name'];
      $option_list['updateby'][$value['id']] = $value['name'];
      $option_list['approveby'][$value['id']] = $value['name'];
    }

    //****************************************************************************

    //**detect add/edit action and load the record data**************************************************************
    if ($id) {
      //** Logging *********************************************************************************************************
      $this->log_model->addLog(1, 'Edit', $id);
      //********************************************************************************************************************

      $this->content['page_title'] = $this->page_info[$id]['title'];
      $this->content['page_menuclass'] = $this->page_info[$id]['menu_class'];

      $this->content['id'] = $id;

      $fields = null;
      $where = array('id' => $id, 'status <' => 10);
      $result = $this->page_model->get($fields, $where);

      if (count($result) == 1) {
        $user_record = $result[0];
      } else {
        $this->session->set_flashdata('error', 'Invalid Access');
        redirect('module/page/listing');
      }
    } else {
      //** Logging *********************************************************************************************************
      $this->log_model->addLog(1, 'Edit(Add)');
      //********************************************************************************************************************

      $this->content['page_title'] = $this->page_model->getModuleDisplayName().' - '.lang('page_add');
      $this->content['page_menuclass'] = "";
      $this->content['id'] = '';

      //***Load copy record data******************************************************
      $copy_id = $this->session->flashdata('id');
      if ($copy_id) {
        $fields = null;
        $where = array('id' => $copy_id, 'status <' => 10);
        $result = $this->page_model->get($fields, $where);

        if (count($result) == 1) {
          $user_record = $result[0];
        }
      }
    }
    //****************************************************************************

    //**generate form element************************************************************
    $section_fields = $this->page_model->getFieldsEdit();

    $edit_form_content = array();

    //ordering
    $edit_form_content[lang('tab_generic')] = array();
    $edit_form_content[lang('tab_info')] = array();
    $edit_form_content[lang('tab_approval')] = array();
    foreach($this->page_model->getLang() as $lang){
      $edit_form_content[$lang['displayname']] = array();
    }

    //fields for langauge copy
    $fields_for_copy = array();

    foreach($section_fields as $field_name => $field_obj){
      //when can_edit == false, this field cant show in add page
      if ($id == '' && $field_obj['can_edit'] == '0') {
        continue;
      }

      if ($this->user_model->haveApproval()) {
        if ((isset($user_record)) && (($user_record['approval'] == 2 && (!$this->g_permission['approve'])) || $user_record['approval'] == 4)) {
          $can_edit = false;
        } else {
          $can_edit = $field_obj['can_edit'];
        }
      }else{
        $can_edit = $field_obj['can_edit'];
      }

      //get default / user record value
      $value = (isset($user_record)) ? $user_record[$field_obj['field_name']] : '';

      //get dropdown list
      if (isset($option_list[$field_obj['field_name']])) {
        $options = $option_list[$field_obj['field_name']];
      } else {
        $options = array();
        if (isset($field_obj['options'])) {
          foreach ($field_obj['options'] as $val) {
            $options[$val['value']] = $val['displayname'];
          }
        }
      }

      //*handle approve remark******************************************************************************************
      if ($field_obj['field_name'] == 'approval_remark') {
        if (($user_record['approval'] == 2 || $user_record['approval'] == 4) && ($this->g_permission['approve'])) {
          $can_edit = true;
        } else {
          $can_edit = false;
        }
      }

      //*******************************************************************************************

      //build html
      if ($can_edit && $id){
        $display_name = $this->getDisplayName($id, $field_obj['field_name']);
        if ($display_name != ""){
          $content = $this->buildInputHTML($field_obj['mandatory'], $display_name, $field_obj['input_type'], $can_edit, $field_obj['field_name'], $value, $options, $field_obj['maxlength']);
        }else{
          $content = "";
        }
      }else{
        $content = $this->buildInputHTML($field_obj['mandatory'], $field_obj['field_display'], $field_obj['input_type'], $can_edit, $field_obj['field_name'], $value, $options, $field_obj['maxlength']);
      }

      // check tab location*****************************************
      if ($content != ""){
        if (in_array($field_obj['field_name'], $this->page_model->getApprovalFields())){
          $edit_form_content[lang('tab_approval')][0][] = $content;
        }else if (in_array($field_obj['field_name'], $this->page_model->getCommonFields())){
          $edit_form_content[lang('tab_info')][0][] = $content;
        }else{
          if (count($this->page_model->getLang()) > 0){
            if (isset($field_obj['lang'])){
              if ($field_obj['input_type'] == "image" || $field_obj['input_type'] == "file"){
                $edit_form_content[$field_obj['lang_displayname']][1][] = $content;
                $fields_for_copy[1][] = $field_obj['parent'];
              }else{
                $edit_form_content[$field_obj['lang_displayname']][0][] = $content;
                $fields_for_copy[0][] = $field_obj['parent'];
              }

            }else{
              $edit_form_content[lang('tab_generic')][0][] = $content;
            }
          }else{
            $edit_form_content[lang('tab_generic')][0][] = $content;
          }
        }
      }

    }

    //add copy lang button
    foreach($this->page_model->getLang() as $lang){
      foreach ($fields_for_copy as $key => $fields){
        $edit_form_content[$lang['displayname']][$key][] = $this->buildCopyLangRow($lang['name'], $this->page_model->getLang(), $key);
        $fields_for_copy[$key] = array_values(array_unique($fields));
      }
    }

    foreach($edit_form_content as $section_name => $section){
      if (count($section) == 0 ){
        unset($edit_form_content[$section_name]);
      }
    }

    $this->content['language_fields'] = json_encode($fields_for_copy);
    $this->content['edit_section'] = $edit_form_content;
    //****************************************************************************

    //**button control**************************************************************************
    $this->content['show_save_button'] = false;
    $this->content['show_request_button'] = false;
    $this->content['show_approve_button'] = false;
    $this->content['show_reject_button'] = false;
    $this->content['show_cancelrequest_button'] = false;
    $this->content['show_delete_button'] = false;
    $this->content['show_remove_button'] = false;
    $this->content['show_cancelremove_button'] = false;

    if ($this->page_model->haveApproval()) {
      if ($id && $user_record['approval'] == 2) {
        if ($this->g_permission['approve']) {
          $this->content['show_approve_button'] = true;
          $this->content['show_reject_button'] = true;
        } else {
          $this->content['show_cancelrequest_button'] = true;
        }
      } elseif ($id && $user_record['approval'] == 3) {
        $this->content['show_save_button'] = true;
        if ($this->g_permission['approve']) {
          $this->content['show_approve_button'] = true;
        } else {
          $this->content['show_request_button'] = true;
          $this->content['show_remove_button'] = true;
        }
      } elseif ($id && $user_record['approval'] == 4) {
        if ($this->g_permission['approve']) {
          $this->content['show_delete_button'] = true;
          $this->content['show_cancelremove_button'] = true;
        } else {
          $this->content['show_cancelremove_button'] = true;
        }
      } else {
        $this->content['show_save_button'] = true;
        if ($this->g_permission['approve']) {
          $this->content['show_approve_button'] = true;
        } else {
          $this->content['show_request_button'] = true;
          $this->content['show_remove_button'] = true;
        }
      }
    } else {
      //no approval flow
      $this->content['show_save_button'] = true;
    }
    //****************************************************************************

    $this->page_content['content'] = $this->load->view('page/detail', $this->content, true);

    return $this->load->view($this->template, $this->page_content);
  }

  public function updateRecordAjax()
  {
    $result_arr = array();

    $formdata = $this->input->post('formdata');

    if (($formdata['submit_type'] == 0) || ($formdata['submit_type'] == 3) || ($formdata['submit_type'] == 4)) {
      //Save Record ***********************************************************************************************
      //**********************************************************************************************************

      $fields = $this->page_model->getFieldsEdit();
      $formdata['status'] = 1;
      $msg = '';

      $params = array();

      //checking mandatory field ******************************************************************
      //$msg = $this->page_model->validateFields($formdata, $params);

      foreach ($fields as $field_name => $field_obj) {
        if ($field_obj['can_edit'] == '1') {
          if ($formdata['id']){
            $display_name = $this->getDisplayName($formdata['id'], $field_obj['field_name']);
          }

          if (!$formdata['id'] || ($formdata['id'] && $display_name != "")){
            if ($field_obj['input_type'] == 'integer') {
              if (strlen($formdata[$field_obj['field_name']]) == 0) {
                  $msg .= lang('please_enter').$field_obj['field_display']."(".lang("format_integer").")<br/>";
              }else if (!is_numeric($formdata[$field_obj['field_name']])){
                  $msg .= lang('please_enter').$field_obj['field_display']."(".lang("format_integer").")<br/>";
              }else{
                $params[$field_obj['field_name']] = $formdata[$field_obj['field_name']];
              }
            }else if ($field_obj['mandatory'] == '1') {
              if ($field_obj['input_type'] == 'password') {
                if (strlen($formdata[$field_obj['field_name']]) == 0) {
                  if ($formdata['id'] == '') {
                    //add
                    $msg .= lang('please_enter').$field_obj['field_display']."<br/>";
                  }
                } else {
                  $params[$field_obj['field_name']] = md5($formdata[$field_obj['field_name']]);
                }
              } elseif (strlen($formdata[$field_obj['field_name']]) == 0) {
                $msg .= lang('please_enter').$field_obj['field_display']."<br/>";
              } else {
                $params[$field_obj['field_name']] = $formdata[$field_obj['field_name']];
              }
            } else {
              //add field
              if ($field_obj['input_type'] == 'password') {
                $params[$field_obj['field_name']] = md5($formdata[$field_obj['field_name']]);
              } else {
                $params[$field_obj['field_name']] = $formdata[$field_obj['field_name']];
              }
            }
          }
        }
      }

      //********************************************************************************************

      //********************************************************************************************

      if ($msg != '') {
        $result_arr['status'] = '0';
        $result_arr['msg'] = $msg;

        return parent::output_json($result_arr);
      }

      $params['updatedate'] = date('Y-m-d H:i:s');
      $params['updateby'] = $this->session->userdata('login');

      if ($formdata['id'] == '') {
        $params['rank'] = '0';
        $params['createdate'] = date('Y-m-d H:i:s');
        $params['createby'] = $this->session->userdata('login');
        $params['ip'] = $_SERVER['REMOTE_ADDR'];

        $result = $this->page_model->set($params);
        $id = $this->page_model->getInsertId();

        $result_arr['id'] = $id;

        if ($result) {
          //update rank
          $params = array();
          $params['rank'] = $id;
          $result = $this->page_model->set($params, $id);
        } else {
          $result_arr['status'] = '0';
          $result_arr['msg'] = $this->page_model->getModuleDisplayName().': System Error (101)';

          //** Logging *********************************************************************************************************
          $this->log_model->addLog(4, 'Create Error', '', $result_arr['msg']);
          //********************************************************************************************************************

          return parent::output_json($result_arr);
        }

        //** Logging *********************************************************************************************************
        $this->log_model->addLog(2, 'Create', $id);
        //********************************************************************************************************************
      } else {
        $result = $this->page_model->set($params, $formdata['id']);

        $result_arr['id'] = $formdata['id'];

        //** Logging *********************************************************************************************************
        $this->log_model->addLog(2, 'Update', $formdata['id']);
        //********************************************************************************************************************
      }

      if (!$result) {
        $result_arr['status'] = '0';
        $result_arr['msg'] = $this->page_model->getModuleDisplayName().': System Error (102)';

        //** Logging *********************************************************************************************************
        $this->log_model->addLog(4, 'Update Error', '', $result_arr['msg']);
        //********************************************************************************************************************

        return parent::output_json($result_arr);
      }
      //End Save Record ***********************************************************************************************
      //**********************************************************************************************************
    } else {
      $result_arr['id'] = $formdata['id'];
    }

    //Handle Approval ***********************************************************************************************
    //**********************************************************************************************************
    $result_arr['redirect'] = 0;
    if ($this->page_model->haveApproval()) {
      $params = array();
      switch ($formdata['submit_type']) {
        case 0: //request for approval
        $params['approval'] = '1';
        $log_action = 'Save Draft';
        break;
        case 2: //request for approval
        $params['approval'] = '2';
        $log_action = 'Request For Approval';
        break;
        case 3: //approve
        $params['approval'] = '3';
        $params['approvedate'] = date('Y-m-d H:i:s');
        $params['approveby'] = $this->session->userdata('login');
        $params['approval_remark'] = $formdata['approval_remark'];
        $log_action = 'Approve';
        break;
        case 4: //reject
        $params['approval'] = '1';
        $params['approval_remark'] = $formdata['approval_remark'];
        $log_action = 'Reject';
        break;
        case 5: //cancel approval
        $params['approval'] = '1';
        $log_action = 'Cancel Approval';
        break;
        case 6: //delete
        $params['approval'] = '3';
        $params['status'] = '10';
        $result_arr['redirect'] = 1;
        $log_action = 'Delete';
        break;
        case 7: //remove
        $params['approval'] = '4';
        $log_action = 'Remove';
        break;
        case 8: //cancel remove
        $params['approval'] = '1';
        $log_action = 'Cancel Remove';
        break;
        default:
        $params['approval'] = '1';
        $log_action = 'No acttion';
        break;
      }
      $result = $this->page_model->set($params, $result_arr['id']);

      if (!$result) {
        $result_arr['status'] = '0';
        $result_arr['msg'] = $this->page_model->getModuleDisplayName().': System Error (103) - Submit Type: '.$formdata['submit_type'];

        //** Logging *********************************************************************************************************
        $this->log_model->addLog(4, 'Approval Error', $result_arr['id'], $result_arr['msg']);
        //********************************************************************************************************************

        return parent::output_json($result_arr);
      } else {
        //** Logging *********************************************************************************************************
        $this->log_model->addLog(2, $log_action, $result_arr['id']);
        //********************************************************************************************************************
      }

      //Sync to LIVE Table ***********************************************************************************************
      if ($formdata['submit_type'] == 3 || $formdata['submit_type'] == 6) {
        $this->page_model->sync2Live($result_arr['id']);

        //** Logging *********************************************************************************************************
        $this->log_model->addLog(1, 'Synced Live', $result_arr['id']);
        //********************************************************************************************************************
      }

      //******************************************************************************************************************
    }

    //End Handle Approval ***********************************************************************************************
    //**********************************************************************************************************

    $result_arr['status'] = '1';
    $this->session->set_flashdata('notification',lang("update_success"). date("Y-m-d H:i:s"));
    return parent::output_json($result_arr);
  }

  public function deleteRecordAjax()
  {
    $result_arr = array();

    $id = $this->input->post('id');

    $msg = '';

    $params = array();

    $params['status'] = '10';
    $params['updatedate'] = date('Y-m-d H:i:s');
    $params['updateby'] = $this->session->userdata('login');

    $result = $this->page_model->set($params, $id);

    if ($result) {
      //** Logging *********************************************************************************************************
      $this->log_model->addLog(2, 'Delete', $id);
      //********************************************************************************************************************

      if ($this->page_model->haveApproval()) {
        $this->page_model->sync2Live($id);
      }

      $result_arr['status'] = '1';

      return parent::output_json($result_arr);
    } else {
      $result_arr['status'] = '0';
      $result_arr['msg'] = $this->page_model->getModuleDisplayName().': System Error (103)';

      //** Logging *********************************************************************************************************
      $this->log_model->addLog(4, 'Delete Error', $id, $result_arr['msg']);
      //********************************************************************************************************************

      return parent::output_json($result_arr);
    }
  }

  public function export()
  {
    $options = array();

    //** Logging *********************************************************************************************************
    $this->log_model->addLog(1, 'Export');
    //********************************************************************************************************************

    //*******Load Mapping Table`***********************************************
    //get user list
    $fields = array('id', 'name');
    $where = array('status <' => 10);
    $user_result = $this->user_model->get($fields, $where);

    $options['createby'] = $user_result;
    $options['updateby'] = $user_result;
    $options['approveby'] = $user_result;

    //*************************************************************************

    //add title row
    $titles = array_values($this->page_model->getFieldsExport());
    $data1[] = $titles;

    $fields = array_keys($this->page_model->getFieldsExport());

    $where = array('status <' => 10);
    $orderby = $this->page_model->getTableSorting();

    $result = $this->page_model->get($fields, $where, $orderby);

    $result_arr = $this->page_model->getOptionValues($result, $options);

    foreach ($result_arr as $idx => $val) {
      $temp = array();
      foreach ($fields as $key) {
        $temp[] = $val[$key];
      }
      $data1[] = $temp;
    }

    $this->load->library('xlsxwriter');

    $writer = new XLSXWriter();
    $writer->setAuthor('VSOLOOP LIMITED');

    $writer->writeSheet($data1, $this->page_model->getModuleName());

    $filename = $this->page_model->getModuleName().'-'.date('YmdHis').'.xlsx';

    // Redirect output to a client’s web browser (Excel5)
    header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    echo $writer->writeToString();
  }

  public function updateTableConfig()
  {
    $this->page_model->updateTableConfig();
  }
}
