<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Master Class - used for all pages
 */
class MY_Controller extends CI_Controller
{
    public function __construct() {

        parent::__construct();

		//init database
		$this->load->database();
    $this->load->helper('language');
    $this->lang->load('layout', $this->config->item('language'));

		//get config
		$this->load->model('setting_model');
		$settings = $this->setting_model->get();
        $this->settings = new stdClass();
        foreach ($settings as $setting)
        {
            $this->settings->{$setting['name']} = (@unserialize($setting['value']) !== FALSE) ? unserialize($setting['value']) : $setting['value'];
        }

		//template
		if ($this->session->userdata('login') != ""){
			$this->template = "template/template_inside";
		}else{
			$this->template = "template/template";
		}

		//load default page content
		$this->page_content = array();
		$this->page_content['js_files'] = array(
			base_url("assets/js/jquery.js"),
      base_url("assets/js/jquery-ui.min.js"),
			base_url("assets/js/bootstrap.min.js"),
      base_url("assets/js/bootstrap-datepicker.min.js"),
			base_url("assets/js/jquery.magnific-popup.min.js"),

			base_url("assets/js/vsoloop.js"),
			base_url("assets/js/jquery.dataTables.min.js"),
      base_url("assets/js/dataTables.rowReorder.min.js"),
			base_url("assets/plugin/ckeditor/ckeditor.js")
		);
		$this->page_content['css_files'] = array(
			"https://fonts.googleapis.com/css?family=Montserrat:400,700|Oswald:400,700|Poppins:400,700|Varela+Round",
			base_url("assets/css/bootstrap.min.css"),
      base_url("assets/css/jquery-ui.min.css"),
      base_url("assets/css/jquery-ui.structure.min.css"),
      base_url("assets/css/jquery-ui.theme.min.css"),
      base_url("assets/css/signin.css"),
			base_url("assets/css/dashboard.css"),
			base_url("assets/css/bootstrap-datepicker.min.css"),
			base_url("assets/css/jquery.dataTables.min.css"),
      base_url("assets/css/rowReorder.dataTables.min.css"),
      base_url("assets/css/magnific-popup.css"),
      base_url("assets/css/vsoloop.css"),
      base_url("assets/css/vsoloop_form.css")
		);

    }

	function output_json($obj){
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(
				json_encode(
					$obj
				)
			);

	}

	/*
	|--------------------------------------------------------------------------
	| Build Dynamic HTML function
	|--------------------------------------------------------------------------
	|
	| Use for generating the html field in the edit page
	| Input type: "text", "password", "textarea", "editor", "datepicker", "dropdown", "file", "image","checkbox"
	|
	|
	*/
	function buildInputHTML($mandatory, $field_display, $input_type, $editable, $fieldname, $value, $options, $maxlength){
		$require = ($mandatory == 1) ? ' <span class="alert-red">*</span>' : "";
		$maxlength = ($maxlength > 0) ? ' maxlength="'.$maxlength.'"' : "";

		$html_str = "";
		switch ($input_type){
			case "text":
				if ($editable == "1") {
					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
									<input type="text" name="'.$fieldname.'" id="'.$fieldname.'" value="'.htmlspecialchars($value, ENT_QUOTES, 'UTF-8').'"'.$maxlength.' />
							</div>
							<div class="clear"></div>
						</div>
					';
				}else{
					$html_str .= '
						<div class="formRowWrapper textItem">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
									'.($value==""?"-":$value).'
							</div>
							<div class="clear"></div>
						</div>
					';
				}
			break;

			case "integer":
				$value = ($value == "") ? "0" : $value;
				if ($editable == "1") {
					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
									<input type="text" name="'.$fieldname.'" id="'.$fieldname.'" value="'.htmlspecialchars($value, ENT_QUOTES, 'UTF-8').'"'.$maxlength.' />
							</div>
							<div class="clear"></div>
						</div>
					';
				}else{
					$html_str .= '
						<div class="formRowWrapper textItem">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
									'.($value==""?"-":$value).'
							</div>
							<div class="clear"></div>
						</div>
					';
				}
			break;

			case "password":
				if ($editable == "1") {
					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
									<input type="password" name="'.$fieldname.'" id="'.$fieldname.'" value=""'.$maxlength.' />
							</div>
							<div class="clear"></div>
						</div>
					';
				}else{
					$html_str .= '
						<div class="formRowWrapper textItem">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
									**********
							</div>
							<div class="clear"></div>
						</div>
					';
				}
			break;

			case "textarea":
				$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
									<textarea name="'.$fieldname.'" id="'.$fieldname.'"'.$maxlength. (($editable == "1") ? "" : " disabled").'>'.$value.'</textarea>
							</div>
							<div class="clear"></div>
						</div>
					';
			break;

			case "editor":
				$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
									<textarea name="'.$fieldname.'" id="'.$fieldname.'"'.$maxlength. (($editable == "1") ? "" : " disabled").'>'.$value.'</textarea>
							</div>
							<div class="clear"></div>
						</div>
						<script>
							CKEDITOR.replace( "'.$fieldname.'" );
						</script>
					';
			break;

			case "datepicker":
				if ($editable == "1") {
					$default_date = ($value == "") ? date("Y-m-d") : $value;

					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
								<div class="input-group date">
									<input type="text" id="'.$fieldname.'" name="'.$fieldname.'" value="'.htmlspecialchars($default_date, ENT_QUOTES, 'UTF-8').'"/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<script type="text/javascript">
							$(function () {
								$("#'.$fieldname.'").datepicker({
									format: "yyyy-mm-dd",
									todayHighlight: true
								});
							});
						</script>
					';
				}else{
					$html_str .= '
						<div class="formRowWrapper textItem">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
									'.($value==""?"-":$value).'
							</div>
							<div class="clear"></div>
						</div>
					';
				}
			break;

			case "dropdown":
				if ($editable == "1") {

					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
								<select name="'.$fieldname.'" id="'.$fieldname.'">
									<option value="">'.lang("field_choose").'</option>
					';
								if (count($options) > 0){
									foreach ($options as $key => $val){
										$selected = ($key == $value) ? "selected" : "";
					$html_str .= '
										<option value="'.$key.'" '.$selected.'>'.$val.'</option>
					';
									}
								}
					$html_str .= '
								</select>
							</div>
							<div class="clear"></div>
						</div>
					';
				}else{
					$html_str .= '
						<div class="formRowWrapper textItem">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage">
								'.(isset($options[$value])? $options[$value] :"-").'
							</div>
							<div class="clear"></div>
						</div>
					';
				}
			break;

			case "file":
				if ($editable == "1") {
					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage margin-right-120">
								<input id="'.$fieldname.'" name="'.$fieldname.'" type="text" value="'.$value.'" '.$maxlength.'>
							</div>
							<div class="btnAbsWrapper">
								<button id="'.$fieldname.'-popup" data-input="'.$fieldname.'" class="btnAbs-right browse_file" type="button" name="button">'.lang("field_broswe").'</button>
					';
					if ($value != ""){
					//	$html_str .= '
					//			<button id="'.$fieldname.'-popup" data-input="'.$value.'" class="btnAbs-right download_file last" type="button" name="button">'.lang("field_broswe").'</button>
					//	';
					}

					$html_str .= '
							</div>
							<div class="clear"></div>
						</div>
					';
				}else{
					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="btnAbsWrapper">
					';
					if ($value != ""){
						$html_str .= '
								<button id="'.$fieldname.'-popup" data-input="'.$value.'" class="btnAbs-right download_file last" type="button" name="button">'.lang("field_download").'</button>
						';
					}

					$html_str .= '
							</div>
							<div class="clear"></div>
						</div>
					';
				}
			break;

			case "image":
				if ($editable == "1") {
					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage margin-right-120">
								<input id="'.$fieldname.'" name="'.$fieldname.'" type="text" value="'.$value.'" '.$maxlength.'>
							</div>
							<div class="btnAbsWrapper">
								<button id="'.$fieldname.'-popup" data-input="'.$fieldname.'" class="btnAbs-right browse_image last" type="button" name="button">'.lang("field_broswe").'</button>
							</div>
							<div class="rowUploadPhoto" data-id="'.$fieldname.'">
					';
					if ($value != ""){
						$html_str .= '
								<img src="'.$value.'" alt="" />
						';
					}
					$html_str .= '
							</div>
							<div class="clear"></div>
						</div>
					';
					if ($value != ""){
						$html_str .= '
						<script>
							detectUploadPhoto("'.$fieldname.'");
						</script>
						';
					}
				}else{
					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowUploadPhoto" data-id="'.$fieldname.'">
					';
					if ($value != ""){
						$html_str .= '
								<img src="'.$value.'" alt="" />
						';
					}
					$html_str .= '
							</div>
							<div class="clear"></div>
						</div>
					';
					if ($value != ""){
						$html_str .= '
						<script>
							detectUploadPhoto("'.$fieldname.'");
						</script>
						';
					}
				}
			break;

      case "gallery":
				if ($editable == "1") {
					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowMessage margin-right-120">
								<input id="'.$fieldname.'" name="'.$fieldname.'" type="text" value="'.$value.'" disabled>
							</div>
							<div class="btnAbsWrapper">
								<button id="'.$fieldname.'-popup" data-input="'.$fieldname.'" class="btnAbs-right browse_gallery last" type="button" name="button">'.lang("field_broswe").'</button>
							</div>
              <div id="sortable_'.$fieldname.'" class="sortable rowUploadPhoto" data-id="'.$fieldname.'">
					';
					if ($value != ""){
            $imagelist = explode(",", $value);

            foreach($imagelist as $image){
  						$html_str .= '
                  <div class="sortableItem ui-state-default" data-item="1">
                    <img src="'.$image.'" alt="" class="vertical"/>
                    <a href="javascript:void(0)" class="closeThis" data-id="'.$fieldname.'"></a>
                  </div>
  						';
            }
					}
					$html_str .= '
							</div>
							<div class="clear"></div>
						</div>
            <script type="text/javascript">
            $( "#sortable_'.$fieldname.'" ).sortable({
              revert: true,
              stop: function( event, ui ) {updateGallery("'.$fieldname.'");}
            });
            $(document).ready(function(){
              bindGalleryClose();
            });
            </script>
					';
				}else{
					$html_str .= '
						<div class="formRowWrapper">
							<div class="rowTitle">'.$field_display.$require.'</div>
							<div class="rowUploadPhoto" data-id="'.$fieldname.'">
					';
					if ($value != ""){
            $imagelist = explode(",", $value);

            foreach($imagelist as $image){
  						$html_str .= '
                  <img src="'.$image.'" alt="" class="vertical" style="float:left">
  						';
            }
					}
					$html_str .= '
							</div>
							<div class="clear"></div>
						</div>
					';
				}
			break;

			case "checkbox":
				$checked = ($value == "1") ? " checked" : "";

				$html_str .= '
					<div class="formRowWrapper">
						<div class="rowTitle">'.$field_display.$require.'</div>
						<div class="rowMessage">
							<input type="checkbox" id="'.$fieldname.'" name="'.$fieldname.'" value="1"'.(($editable == "1") ? "" : " disabled ").$checked.'>
						</div>
						<div class="clear"></div>
					</div>
				';

			break;

			default:
				$html_str .= '';
			break;


		}
		return $html_str. "\n";
	}

	/*
	|--------------------------------------------------------------------------
	| Build Language Copy Buttuon
	|--------------------------------------------------------------------------
	|
	| For Edit Use
	|
	*/
	function buildCopyLangRow($curLang, $lang_arr, $block_no){
		$return_str = '
			<hr>
			<div class="btnWrapper tabLeft-100">
		';
		foreach ($lang_arr as $lang){
			if ($lang['name'] != $curLang){
				$return_str .= '
					<button type="button" name="button" onclick="copyLang(\''.$curLang.'\', \''.$lang['name'].'\', '.$block_no.')">'. lang("button_copyto")  .$lang['displayname'].'</button>
				';
			}
		}

		$return_str .= '
			</div>
		';

		return $return_str;
	}

	/*
	|--------------------------------------------------------------------------
	| Build function Buttuon
	|--------------------------------------------------------------------------
	|
	| For Table Listing Use
	|
	*/
	function buildButton($name, $js_function, $cssClass){
		return '<button type="button" class="btn btn-xs '.$cssClass.'" onclick="'.$js_function.'">'.$name.'</button>';
	}

	/*
	|--------------------------------------------------------------------------
	| Build function Buttuon
	|--------------------------------------------------------------------------
	|
	| For Table Listing Use
	|
	*/
	function checkPermission($available_role = array()){
		if ($this->session->userdata('logged_in')){
			if (in_array($this->session->userdata('role'), $available_role)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}
