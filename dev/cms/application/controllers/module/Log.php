<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends Cms_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');
        $this->load->model('user_model');
    }

    public function index()
    {
        redirect("module/log/listing", "refresh");
    }

    function listing()
    {

        //***Loading content for the Listing page*****************************************************************************
        $this->content['notification'] = $this->session->flashdata('notification');
        $this->content['error'] = $this->session->flashdata('error');

        $this->content['fields'] = $this->log_model->getFieldsListing();
        $this->content['page_title'] = $this->log_model->getModuleDisplayName() . " - " . lang("page_listing");
        $this->content['button'] = $this->log_model->showButton();
        $this->content['fields']['action'] = "";
        //********************************************************************************************************************

        $this->page_content['content'] = $this->load->view("log/listing", $this->content, true);
        return $this->load->view($this->template, $this->page_content);
    }

    function getRecordAjax()
    {
        $start = $this->input->get("start");
        $length = $this->input->get("length");
        $search = $this->input->get("search");
        $order = $this->input->get("order");

        $options = array();
        //**Get Mapping Table*************************************************
        //user list
        $fields = array("id", "name");
        $where = array("status <"=> 10);
        $user_result = $this->user_model->get($fields, $where);

        $options['createby'] = $user_result;
        $options['updateby'] = $user_result;
        //*********************************************************************


        $result_arr = array();


        //**Generating Query*************************************************
        $fields = array_keys($this->log_model->getFieldsListing());

        $where = "status < 10";

        $like = array();
        if (trim($search['value'] != "")) {
            $search_fields = array_keys($this->log_model->getFieldsSearch());
            foreach($search_fields as $search_field){
                $like[] = $search_field . " LIKE '%" . $this->db->escape_like_str($search['value']) . "%' ESCAPE '!'";
            }

            if (count($like) > 0 ) {
                $where .= " AND (" .join(' OR ', $like) . ")";
            }
        }

        $orderby = $this->log_model->getTableSorting();
        if (array_key_exists($order[0]["column"], $fields)) {
            $orderby = $fields[$order[0]["column"]]. " " . $order[0]["dir"];
        }

        $result = $this->log_model->get($fields, $where, $orderby, $start, $length);

        $resultTotal = $this->log_model->getTotal();
        $result_arr['recordsTotal'] = $resultTotal;

        $resultTotal = $this->log_model->getTotal($where);
        $result_arr['recordsFiltered'] = $resultTotal;
        //*********************************************************************


        //**Replace the Option value ******************************************
        $result_arr['data'] = $this->log_model->getOptionValues($result, $options);
        //*********************************************************************


        //**action button ******************************************
        foreach ($result_arr['data'] as $idx =>$val){
            $result_arr['data'][$idx]['action'] = "";
            if ($this->log_model->showButton()['show_copy_button'] == "1") {
                $result_arr['data'][$idx]['action'] .= parent::buildButton(lang("button_copy"), 'window.open(\''.site_url('module/log/copy/'.$val['id']).'\',\'_self\');', 'btn-success');
            }

            if ($this->log_model->showButton()['show_edit_button'] == "1") {
                $result_arr['data'][$idx]['action'] .= parent::buildButton(lang("button_edit"), 'window.open(\''.site_url('module/log/edit/'.$val['id']).'\',\'_self\');', 'btn-success');
                $result_arr['data'][$idx]['action'] .= parent::buildButton(lang("button_delete"), 'deleteRecord('.$val['id'].')', 'btn-fail');
            }
        }
        //*********************************************************************

        return parent::output_json($result_arr);
    }

    function copy($id=null)
    {
        if ($id != null) {
            $this->session->set_flashdata('id', $id);
            redirect("module/log/edit");
        }else{
            $this->session->set_flashdata('error', "Invalid Access");
            redirect("module/log/listing");
        }
    }

    function edit($id=null)
    {

        //**************** Get Option *************************************************
        $option_list = array();
        //get user list
        $fields = array("id", "name");
        $where = array("status <"=> 10);
        $user_result = $this->user_model->get($fields, $where);
        $option_list['createby'] = array();
        $option_list['updateby'] = array();
        foreach($user_result as $value){
            $option_list['createby'][$value['id']] = $value['name'];
            $option_list['updateby'][$value['id']] = $value['name'];
            $option_list['approveby'][$value['id']] = $value['name'];
        }

        //get role list
        $fields = array("id", "name");
        $where = array("status <"=> 10);
        $role_result = $this->role_model->get($fields, $where);
        $option_list['user_role'] = array();
        foreach($role_result as $value){
            $option_list['user_role'][$value['id']] = $value['name'];
        }
        //****************************************************************************


        //**detect add/edit action and load the record data**************************************************************
        if ($id) {
            $this->content['page_title'] = $this->log_model->getModuleDisplayName() . " - " . lang("page_edit");


            $this->content['id'] = $id;

            $fields = null;
            $where = array("id"=> $id, "status <"=> 10);
            $result = $this->log_model->get($fields, $where);

            if (count($result) == 1) {
                $user_record = $result[0];
            }else{
                $this->session->set_flashdata('error', "Invalid Access");
                redirect("module/log/listing");
            }

        }else{
            $this->content['page_title'] = $this->log_model->getModuleDisplayName() . " - ". lang("page_add");
            $this->content['id'] = "";

            //***Load copy record data******************************************************
            $copy_id = $this->session->flashdata('id');
            if ($copy_id) {
                $fields = null;
                $where = array("id"=> $copy_id, "status <"=> 10);
                $result = $this->log_model->get($fields, $where);

                if (count($result) == 1) {
                    $user_record = $result[0];
                }
            }
        }
        //****************************************************************************


        //**generate form element************************************************************
        $fields = $this->log_model->getFieldsEdit();

        $this->content['edit_section'] = "";
        foreach($fields as $field_name => $field_obj){
            //when can_edit == false, this field cant show in add page
            if ($id == "" && $field_obj['can_edit'] == "0") { continue;
            }

            //get default / user record value
            $value = (isset($user_record)) ? $user_record[$field_obj['field_name']] : "";

            //get dropdown list
            if (isset($option_list[$field_obj['field_name']])) {
                $options = $option_list[$field_obj['field_name']];
            }else{
                $options = array();
                foreach ($field_obj["options"] as $val){
                    $options[$val['value']] = $val['displayname'];
                }
            }

            //build html
            $this->content['edit_section'] .= $this->buildInputHTML($field_obj['mandatory'], $field_obj['field_display'], $field_obj['input_type'], $field_obj['can_edit'], $field_obj['field_name'], $value, $options, $field_obj['maxlength']);

        }
        //****************************************************************************


        //**button control**************************************************************************
        if ($this->log_model->haveApproval()) {
            $this->content['show_submit_button'] = true;
            $this->content['show_request_button'] = true;
            $this->content['show_approve_button'] = true;
            $this->content['show_cancel_button'] = true;
        }else{
            $this->content['show_submit_button'] = true;
            $this->content['show_request_button'] = false;
            $this->content['show_approve_button'] = false;
            $this->content['show_cancel_button'] = false;
        }
        //****************************************************************************

        $this->page_content['content'] = $this->load->view("log/detail", $this->content, true);
        return $this->load->view($this->template, $this->page_content);
    }

    function updateRecordAjax()
    {
        $result_arr = array();

        $formdata = $this->input->post("formdata");

        $fields = $this->log_model->getFieldsEdit();

        $msg = "";

        $params = array();

        //checking mandatory field ******************************************************************
        foreach($fields as $field_name => $field_obj){
            if ($field_obj['can_edit'] == "1") {
                if ($field_obj['mandatory'] == "1") {
                    if (strlen($formdata[$field_obj['field_name']]) == 0) {
                        $msg .= "Please enter ".$field_obj['field_display']."\n";
                    }else{
                        //add field
                        if ($field_obj['input_type'] == "password") {
                            $params[$field_obj['field_name']] = md5($formdata[$field_obj['field_name']]);
                        }else{
                            $params[$field_obj['field_name']] = $formdata[$field_obj['field_name']];
                        }
                    }
                }else{
                    //add field
                    if ($field_obj['input_type'] == "password") {
                        $params[$field_obj['field_name']] = md5($formdata[$field_obj['field_name']]);
                    }else{
                        $params[$field_obj['field_name']] = $formdata[$field_obj['field_name']];
                    }
                }
            }
        }
        //********************************************************************************************


        //********************************************************************************************

        if ($msg != "") {
            $result_arr['status'] = "0";
            $result_arr['msg'] = $msg;
            return parent::output_json($result_arr);
        }

        //handle approval **********************************************************************************
        if ($this->log_model->haveApproval()) {
            if ($formdata['approval'] == "1") {
                $params["approval"] = "1";
            }else if ($formdata['approval'] == "2") {
                $params["approval"] = "2";
            }else if ($formdata['approval'] == "3") {
                $params["approval"] = "3";
                $params["approvedate"] = date('Y-m-d H:i:s');
                $params["approveby"] = $this->session->userdata('login');
                $params["approval_remark"] = $formdata["approval_remark"];
            }else if ($formdata['id'] == "") {
                $params["approval"] = "1";
            }
        }
        //*************************************************************************************************

        $params["updatedate"] = date('Y-m-d H:i:s');
        $params["updateby"] = $this->session->userdata('login');
        $params["ip"] = $_SERVER['REMOTE_ADDR'];

        if ($formdata["id"] == "") {
            $params["rank"] = "0";
            $params["createdate"] = date('Y-m-d H:i:s');
            $params["createby"] = $this->session->userdata('login');


            $result = $this->log_model->set($params);
            $id = $this->log_model->getInsertId();

            $result_arr['id'] = $id;

            if ($result) {
                //update rank
                $params = array();
                $params["rank"] = $id;
                $result = $this->log_model->set($params, $id);
            }else{
                $result_arr['status'] = "0";
                $result_arr['msg'] = $this->log_model->getModuleDisplayName() . ": System Error (102)";
                return parent::output_json($result_arr);
            }
        }else{
            $result = $this->log_model->set($params, $formdata["id"]);

            $result_arr['id'] = $formdata["id"];
        }

        if ($result) {
            $result_arr['status'] = "1";
            return parent::output_json($result_arr);
        }else{
            $result_arr['status'] = "0";
            $result_arr['msg'] = $this->log_model->getModuleDisplayName() . ": System Error (102)";
            return parent::output_json($result_arr);
        }


    }

    function deleteRecordAjax()
    {

        $result_arr = array();

        $id = $this->input->post("id");

        $msg = "";

        $params = array();

        $params["status"] = "10";
        $params["updatedate"] = date('Y-m-d H:i:s');
        $params["updateby"] = $this->session->userdata('login');


        $result = $this->log_model->set($params, $id);

        if ($result) {
            $result_arr['status'] = "1";
            return parent::output_json($result_arr);
        }else{
            $result_arr['status'] = "0";
            $result_arr['msg'] = $this->log_model->getModuleDisplayName() . ": System Error (102)";
            return parent::output_json($result_arr);
        }

    }

    function export()
    {
        $options = array();

        //*******Load Mapping Table`***********************************************
        //get user list
        $fields = array("id", "name");
        $where = array("status <"=> 10);
        $user_result = $this->user_model->get($fields, $where);

        $options['createby'] = $user_result;
        $options['updateby'] = $user_result;
        $options['approveby'] = $user_result;


        //*************************************************************************

        //add title row
        $titles = array_values($this->log_model->getFieldsExport());
        $data1[] = $titles;


        $fields = array_keys($this->log_model->getFieldsExport());

        $where = array("status <"=> 10);
        $orderby = $this->log_model->getTableSorting();

        $result = $this->log_model->get($fields, $where, $orderby);

        $result_arr = $this->log_model->getOptionValues($result, $options);

        foreach ($result_arr as $idx =>$val){
            $temp = array();
            foreach ($fields as $key){
                $temp[] = $val[$key];
            }
            $data1[] = $temp;
        }

        $this->load->library('xlsxwriter');

        $writer = new XLSXWriter();
        $writer->setAuthor("VSOLOOP LIMITED");

        $writer->writeSheet($data1, $this->log_model->getModuleName());

        $filename = $this->log_model->getModuleName() ."-".date("YmdHis") . ".xlsx";

        // Redirect output to a client’s web browser (Excel5)
        header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        echo $writer->writeToString();
    }

    function updateTableConfig()
    {
        $this->log_model->updateTableConfig();
    }
}
