<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends MY_Model {

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
}
?>