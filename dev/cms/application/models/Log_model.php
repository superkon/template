<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends MY_Model {

    /**
     * @vars
     */
    private $_db;


    /**
     * Constructor
     */
    function __construct()
    {
        // define primary table
		$table = strtolower(str_replace("_model", "", __CLASS__));
		$this->_table = $this->db->dbprefix($table);

		$this->_table_config = json_decode(file_get_contents(dirname(__FILE__) . "/".(__CLASS__).".config"), true);

		parent::__construct($this->_table_config);
    }

	function setModule($module){
		$this->module = $module;
	}

	function addLog($log_type = "1", $action, $record_id = "", $remark = null, $module = null){
		$module = ($module == null) ? $this->module :$module;

		$params = array();
		$params["status"] = "1";
		$params["createdate"] = date('Y-m-d H:i:s');
		$params["createby"] = ($this->session->userdata('login') != "") ?  $this->session->userdata('login') : 0;
		$params["ip"] = $_SERVER['REMOTE_ADDR'];
		$params["module"] = $module;
		$params["log_type"] = $log_type;
		$params["useraction"] = $action;
		$params["record_id"] = $record_id;

		$params["display_msg"] = "";
		if (($this->session->userdata('login') != "")){
			$params["display_msg"] = $this->session->userdata('login_name') . " : ";
		}

		$params["display_msg"] .=  $module . " " . $action ;

		if ($record_id != ""){
			$params["display_msg"] .= " with Record ID: " . $record_id ;
		}
		$params["remark"] = $remark;

		parent::set($params);

	}
}
?>
