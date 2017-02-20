<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Cms_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('setting_model');

        $this->load->model('log_model');
        $this->log_model->setModule($this->setting_model->getModuleName());
    }

    public function index()
    {

        //** Logging *********************************************************************************************************
        $this->log_model->addLog(1, "Setting Edit");
        //********************************************************************************************************************

        $this->content['notification'] = $this->session->flashdata('notification');
        $this->content['error'] = $this->session->flashdata('error');

        $this->content['page_title'] = lang("pagetitle_setting");

        $fields = array("name", "value", "input_type", "mandatory");
        $where = array();
        $result = $this->setting_model->get($fields, $where);

        $this->content['edit_section'] = "";
        foreach($result as $data){
            $this->content['edit_section'] .= $this->buildInputHTML($data['mandatory'], $data['name'], $data['input_type'], 1, $data['name'], $data['value'], null, "200");
        }

        $this->page_content['content'] = $this->load->view("general/setting", $this->content, true);
        return $this->load->view($this->template, $this->page_content);
    }

    function updateRecordAjax()
    {
        //** Logging *********************************************************************************************************
        $this->log_model->addLog(2, "Update");
        //********************************************************************************************************************

        $result_arr = array();

        $formdata = $this->input->post("formdata");

        $fields = array("id", "name", "value", "input_type");
        $where = array();
        $result = $this->setting_model->get($fields, $where);

        foreach($result as $data){
            $params = array();
            $params["value"] = $formdata[$data['name']];
            $result = $this->setting_model->set($params, $data['id']);


            if (!$result) {
                $result_arr['status'] = "0";
                $result_arr['msg'] = $this->setting_model->getModuleDisplayName() . ": System Error (101)";
                return parent::output_json($result_arr);
            }
        }

        $result_arr['status'] = "1";
        $this->session->set_flashdata('notification', 'Update Success at - '. date("Y-m-d H:i:s"));
        return parent::output_json($result_arr);
    }
}
