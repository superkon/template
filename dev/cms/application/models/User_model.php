<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {

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
	
	function checkLogin($login, $password){
		$this->db->where(array("login" => $login, "password" => md5($password)));
		//$this->db->from($this->_table);
	
		//if ($this->db->count_all_results() > 0 ){
			$query = $this->db->get($this->_table);
			if ($result = $query->result() ){
				//get one record
				$this->session->set_userdata('login',$result[0]->id);
				$this->session->set_userdata('login_name',$result[0]->name);
				$this->session->set_userdata('role',$result[0]->user_role);
				return true;
			}else{
				return false;
			}
		//}else{
		//	return false;
		//}
	}

}
?>