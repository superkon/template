<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {


	public function __construct($table_config = null)
	{
		parent::__construct();

		$this->_table_config = $table_config;
		$this->_fields_listing = array();
		$this->_fields_edit = array();
		$this->_fields_export = array();
		$this->_fields_options = array();
		$this->_fields_search = array();
		$this->_fields_inputtype = array();

		$this->_fields_for_approval = array('approval', 'approval_remark', 'approvedate', 'approveby');
		$this->_fields_for_common = array('ip', 'createdate', 'createby', 'updatedate', 'updateby');


		if ($this->_table_config != null){
			if ($this->_table_config['have_approval'] == "0"){
				//remove all approve field
				$temp = array();
				foreach ($this->_table_config['field'] as $field) {
					if (!in_array($field["field_name"], $this->_fields_for_approval)){
						$temp[] = $field;
					}
				}
				$this->_table_config['field']= $temp;
			}


			//handle multi lang *************************************************************************************************
			if (isset($this->_table_config['language'])){
				$this->_field_lang = $this->_table_config['language'];
			}else{
				$this->_field_lang = array(array("name" => "en", "displayname" => "English"));
			}

			$re_fields = array();

			foreach ($this->_table_config['field'] as $field) {
				if (isset($field['multi_lang']) && $field['multi_lang'] == 1){
					$temp = $field;
					foreach ($this->_field_lang as $lang){
						$field['field_name'] = $temp['field_name'] . "_" . $lang['name'];
						$field['field_display'] = $temp['field_display'] . " (" . $lang['displayname'] . ") ";
						$field['lang'] = $lang['name'];
						$field['lang_displayname'] = $lang['displayname'];
						$field['parent'] = $temp['field_name'];
						$re_fields[] = $field;
					}
				}else{
					$re_fields[] = $field;
				}
			}

			$this->_table_config['field'] = $re_fields;
			//*******************************************************************************************************************

			foreach ($this->_table_config['field'] as $field) {
				$this->_fields_inputtype[$field["field_name"]] = $field['input_type'];

				if ($field['show_in_listing'] == 1){
					$this->_fields_listing[$field["field_name"]] = $field["field_display"];
				}

				if ($field['show_in_export'] == 1){
					$this->_fields_export[$field["field_name"]] = $field["field_display"];
				}

				if ($field['show_in_edit'] == 1){
					$this->_fields_edit[$field["field_name"]] = $field;
				}

				if ($field['can_search'] == 1){
					$this->_fields_search[$field["field_name"]] = $field;
				}

				if (isset($field['options']) && count($field['options']) >0 ){
					$this->_fields_options[$field["field_name"]] = $field["options"];
				}
			}
		}

    }

	 /**
     * Table configuration funtion
     */
	function getModuleName(){
		return $this->_table_config['module_name'];
	}

	function getModuleDisplayName(){
		return $this->_table_config['module_display'];
	}

	function showButton(){
		$button = array();
		$button['show_edit_button']= $this->_table_config['show_edit_button'];
		$button['show_export_button']= $this->_table_config['show_export_button'];
		$button['show_rank_button']= $this->_table_config['show_rank_button'];
		$button['show_copy_button']= $this->_table_config['show_copy_button'];
		$button['show_rank_button']= $this->_table_config['show_rank_button'];
		return $button;
	}

	function getTableSorting(){
		return $this->_table_config['listing_sort'];
	}

	function getFieldsListing(){
		return $this->_fields_listing;
	}

	function getFieldsExport(){
		return $this->_fields_export;
	}

	function getFieldsEdit(){
		return $this->_fields_edit;
	}

	function getFieldsSearch(){
		return $this->_fields_search;
	}

	function haveApproval(){
		return $this->_table_config['have_approval'];
	}

	function getLang(){
		return $this->_field_lang ;
	}

	function getApprovalFields(){
		return $this->_fields_for_approval ;
	}

	function getCommonFields(){
		return $this->_fields_for_common ;
	}

	function getOptionValues($result, $mask_array = array()){
		foreach($result as $record_key => $record){
			foreach($record as $colname=>$colvalue){
				if (array_key_exists($colname, $mask_array)){
					$options = $mask_array[$colname];

					foreach($options as $option){
						if ($option['id'] == $colvalue){
							$result[$record_key][$colname] = $option['name'];
						}
					}
				}else if (array_key_exists($colname, $this->_fields_options)){
					$options = $this->_fields_options[$colname];

					foreach($options as $option){
						if ($option['value'] == $colvalue){
							$result[$record_key][$colname] = $option['displayname'];
						}
					}
				}
			}
		}
		return $result;
	}

	function getInputTypeHTML($result, $width = 0){
		foreach($result as $record_key => $record){
			foreach($record as $colname=>$colvalue){
				if ($this->_fields_inputtype[$colname] == "image"){
					$result[$record_key][$colname] = "<img src='".$colvalue."' ".(($width > 0 )? "style='width:".$width."px'" :"")."/>";
				}

				if ($this->_fields_inputtype[$colname] == "gallery"){
					$imagelist = explode(",", $colvalue);
					if ($imagelist[0] != ""){
						$result[$record_key][$colname] = "<img src='".$imagelist[0]."' ".(($width > 0 )? "style='width:".$width."px'" :"")."/>";
					}
				}

				if ($this->_fields_inputtype[$colname] == "file"){
					$result[$record_key][$colname] = "<a href='".$colvalue."' target='_blank'/>Link </a>";
				}

				if ($this->_fields_inputtype[$colname] == "checkbox"){
					if ($colvalue == "1"){
						$result[$record_key][$colname] = "Y";
					}else{
						$result[$record_key][$colname] = "N";
					}
				}
			}
		}
		return $result;
	}

	 /**
     * Retrieve all record
     *
     * @return array|null
     */
    function get($fields = null, $where = null, $orderby = null, $offset = 0, $limit = null)
    {
		if ($fields != null){
			$this->db->select($fields);
		}

		if ($where != null){
			$this->db->where($where);
		}

		if ($orderby != null){
			$this->db->order_by($orderby);
		}

		if ($limit != null){
			$this->db->limit($limit, $offset);
		}

        $query = $this->db->get($this->_table);

		$results = $query->result_array();


        return $results;
    }


	function getTotal($where = null){
		if ($where != null){
			$this->db->where($where);
		}
		$this->db->from($this->_table);

        return $this->db->count_all_results();
	}


    /**
     * Save changes to the settings
     *
     * @param  array $data
     * @param  int $user_id
     * @return boolean
     */
    function set($data = array(), $id = null)
    {
		if ($id == null){
			return $this->db->insert($this->_table, $data);
		}else{
			$this->db->where('id', $id);
			return $this->db->update($this->_table, $data);
		}
    }

   /**
     * get last update record for last create record
     *
     */
	 function getInsertId(){
		 return $this->db->insert_id();
	 }

	/**
	* Copy record from normal table to live table
	**/
	function sync2Live($id){
		$table_name = strtolower($this->_table_config['module_name']);
		$table_name = $this->db->dbprefix($table_name);
		$table_name_approval = $table_name . "_live";

		$this->db->where('id', $id);
		$this->db->delete($table_name_approval);

		$sql = "insert into ". $table_name_approval. " ( select * from ".$table_name." where id = '".$id."' ) ";
		$query = $this->db->query($sql);

	}

	/**
	* Sync rank to live
	**/
	function syncRank2Live(){
		$table_name = strtolower($this->_table_config['module_name']);
		$table_name = $this->db->dbprefix($table_name);
		$table_name_approval = $table_name . "_live";

		$this->db->select("id, rank");
		$query = $this->db->get($table_name);
		$results = $query->result_array();
		foreach ($results as $result){
			$data = array("rank" => $result['rank']);
			$this->db->where('id', $result['id']);
			$this->db->update($table_name_approval, $data);
		}
	}


	 /**
     * create, update table attribute base on table config
     *
     */
	 function updateTableConfig(){
		$this->load->dbforge();

		$table_name = strtolower($this->_table_config['module_name']);

		$this->createTable($table_name);

		//Approval table *****************************************************************************************************************
		if ($this->haveApproval()){
			$table_name_approval = $table_name . "_live";

			$this->createTable($table_name_approval);
		}
	}

	function createTable($table_name){
		$table_exist = true;
		if ($this->db->table_exists($this->db->dbprefix($table_name)) )
		{
		  // table exists
		  echo $table_name . " Table Exist <br/>";
		}
		else
		{
		  // table does not exist
		   echo $table_name . " Table Not Exist <br/> ";

		   $attributes = array('ENGINE' => 'InnoDB');
		   $table_exist = false;
		}

		$fields = array();

		foreach ($this->_table_config['field'] as $field) {
			$fields = $this->field_property($fields, $field, $field['field_name'] , $table_exist, $table_name);
		}

		if ($table_exist){
			$this->dbforge->add_column($table_name, $fields);
		}else{
			$this->dbforge->add_field($fields);
			$this->dbforge->create_table($table_name, TRUE, $attributes);
			echo $table_name . " Table...created<br/>";
		}

	}

	function field_property($fields, $field, $field_name, $table_exist, $table_name_approval){

		if (!$table_exist || !$this->db->field_exists($field_name, $table_name_approval) ){
			$fields[$field_name] = array();
			if ($field_name == "id"){
				$fields[$field_name]['type'] = 'INT';
				$fields[$field_name]['auto_increment'] = TRUE;
				$fields[$field_name]['unsigned'] = TRUE;
				$fields[$field_name]['primary'] = TRUE;
				$fields[$field_name]['constraint'] = 11;
				$this->dbforge->add_key($field_name, TRUE);
			}else if ($field_name == "rank"){
				$fields[$field_name]['type'] = 'INT';
				$fields[$field_name]['constraint'] = 11;
			}else if ($field_name == "status" || $field_name == "approval" || $field_name == "createby" || $field_name == "updateby" || $field_name == "approveby"){
				$fields[$field_name]['type'] = 'INT';
				$fields[$field_name]['null'] = TRUE;
				$fields[$field_name]['default'] = 1;
				$fields[$field_name]['constraint'] = 11;
			}else if ($field_name == "createdate" || $field_name == "updatedate" || $field_name == "approvedate" ){
				$fields[$field_name]['type'] = 'DATETIME';
				$fields[$field_name]['null'] = TRUE;
			}else{
				switch($field['input_type']){
					case "textarea":
					case "gallery":
					case "editor":
						$fields[$field_name]['type'] = 'TEXT';
						$fields[$field_name]['null'] = TRUE;
						break;

					case "datepicker":
						$fields[$field_name]['type'] = 'DATE';
						$fields[$field_name]['null'] = TRUE;
						break;

					case "checkbox":
						$fields[$field_name]['type'] = 'INT';
						$fields[$field_name]['null'] = TRUE;
						$fields[$field_name]['constraint'] = 11;
						break;

					case "text":
					case "password":
					case "dropdown":
					case "file":
					case "image":
					default:
						$fields[$field_name]['type'] = 'VARCHAR';
						$fields[$field_name]['null'] = TRUE;
						$fields[$field_name]['constraint'] = $field['maxlength'];
						break;

				}

			}

			echo $field_name . " not exist (LIVE) <br/>";
		}else{
			echo $field_name . "  exist (LIVE) <br/>";
		}
		return $fields;
	}

	function getVersionList($id){
		$this->db->where(array('table_name'=>strtolower($this->_table_config['module_name']), "record_id"=> $id));
		$query = $this->db->get($this->db->dbprefix("version"));
		$results = $query->result_array();
		return $results;
	}

	function getVersionId($id, $version_id){
		$this->db->where(array('table_name'=>strtolower($this->_table_config['module_name']), "record_id"=> $id, "version"=>$version_id));
		$query = $this->db->get($this->db->dbprefix("version"));
		$results = $query->result_array();
		return $results;
	}

	function addVersion($id, $action){
		$this->db->where('id', $id);
		$query = $this->db->get($this->_table);
		$results = $query->result_array();

		$verionlist = $this->getVersionList($id);

		$params = array();
		$params['table_name'] = strtolower($this->_table_config['module_name']);
		$params['data'] = json_encode($results);
		$params['action'] = $action;
		$params['record_id'] = $id;
		$params['version'] = count($verionlist) + 1;
		$params['createdate'] = date('Y-m-d H:i:s');
		$params['createby'] = $this->session->userdata('login');

		$this->db->insert($this->db->dbprefix("version"), $params);
	}

	function validateFields($formdata, &$params){
		$fields = $this->_fields_edit;

		$msg = "";
		foreach ($fields as $field_name => $field_obj) {
			if ($field_obj['can_edit'] == '1') {
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
						//handle password do not enter compulsory in edit
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

				if ($field_obj['input_type'] == 'datepicker') {
					if (strlen($formdata[$field_obj['field_name']]) > 0) {
						if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$formdata[$field_obj['field_name']])){
				        $msg .= lang('please_enter').$field_obj['field_display']."(".lang("format_date").")<br/>";
				    }
					}
				}else if ($field_obj['input_type'] == 'dropdown') {
					if (count($this->_fields_options[$field_obj["field_name"]]) > 0 ){
						$pass = false;
						$values_arr = array();
						foreach ($this->_fields_options[$field_obj["field_name"]] as  $opt_value){
							$values_arr[] = $opt_value['value'] . " - " . $opt_value['displayname'];
							if ($opt_value['value'] == $formdata[$field_obj['field_name']]){
								$pass = true;
							}
						}

						if (!$pass){
							$msg .= lang('please_enter').$field_obj['field_display']."(";
							$msg .= implode(", ", $values_arr);
							$msg .= ")<br/>";
						}
					}
				}
			}
		}

		return $msg;
	}
}
