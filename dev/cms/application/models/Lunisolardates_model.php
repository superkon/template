<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lunisolardates_model extends MY_Model {

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

    function validateFields($formdata, &$params){
      $msg = parent::validateFields($formdata, $params);

      //custom checking
      if (!isset($formdata['id']) || $formdata['id'] == ""){
        if ($formdata['ldate'] != ""){
          $fields = array('id');
          $where = array('status <' => 10, 'ldate' =>$formdata['ldate'] );
          $record_result = $this->get($fields, $where);
          if (count($record_result) > 0 ){
            $msg .= "日子已使用<br/>";
          }
        }
      }

      return $msg;
    }
}
?>
