<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends MY_Model {

    /**
     * @vars
     */
    private $_db;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
		$table = strtolower(str_replace("_model", "", __CLASS__));		
		$this->_table = $this->db->dbprefix($table);
    }

}
?>