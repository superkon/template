<h2 class="sub-header"><?php echo $page_title; ?></h2>

<div class="table-responsive">
	<form id="myform" name="myform" action="edit.php">
	<input id="id" name="id" type="hidden" value="<?=$id?>">

	<div class="tabMainWrapper">
		<p class="error"><?=$error?></p>
		<p class="alert-black"><?=$notification?></p>

		<div class="tabControlWrapper">
<?php foreach($edit_section as $section_name => $blocks){ ?>
			<a href="javascript:void(0);" class="btnTab"><?=$section_name?></a>
<?php } ?>
			<div class="clear"></div>
		</div>

		<div class="tabDisplayWrapper">
<?php foreach($edit_section as $section_name => $blocks){ ?>
			<div class="tabDisplayItem">
<?php foreach($blocks as $rows){ ?>
				<div class="innerBox-lightGrey">
					<div class="displayContent">
<?php foreach($rows as $content){ ?>
<?php echo $content; ?>
<?php } ?>
					</div>
				</div>
<?php } ?>
			</div>
<?php } ?>

			<div class="btnWrapper aCenter wMarginTop">
				<?php if ($show_save_button){ ?>
					<button type="button" name="button" onclick="submitForm(0)"><?=lang("button_save")?></button>
				<?php }?>
				<?php if ($show_request_button){ ?>
				  <button type="button" name="button" onclick="submitForm(2)"><?=lang("button_request")?></button>
				<?php }?>
				<?php if ($show_approve_button){ ?>
				  <button type="button" name="button" onclick="submitForm(3)"><?=lang("button_approve")?></button>
				<?php }?>
				<?php if ($show_reject_button){ ?>
				  <button type="button" name="button" onclick="submitForm(4)"><?=lang("button_reject")?></button>
				<?php }?>
				<?php if ($show_cancelrequest_button){ ?>
				  <button type="button" name="button" onclick="submitForm(5)"><?=lang("button_cancel_approve")?></button>
				<?php }?>
				<?php if ($show_delete_button){ ?>
				  <button type="button" name="button" onclick="submitForm(6)"><?=lang("button_accept_delete")?></button>
				<?php }?>
				<?php if ($show_remove_button){ ?>
				  <button type="button" name="button" onclick="submitForm(7)"><?=lang("button_remove")?></button>
				<?php }?>
				<?php if ($show_cancelremove_button){ ?>
				  <button type="button" name="button" onclick="submitForm(8)"><?=lang("button_cancel_remove")?></button>
				<?php }?>
				<button class="last" type="button" name="button" onclick="window.open('<?php echo site_url('module/role/listing') ?>','_self');"><?=lang("button_back")?></button>
			</div>
		</div>

<script type="text/javascript">
	//form submission control -------------------------------------------------------------
	function submitForm(submit_type) {
		var formdata = {};
		formdata['submit_type'] = submit_type;
		$("input, textarea, select").each(function(){
			if ($(this).attr("name") != null){
				var type = $(this).attr('type');
				if (type && type === 'checkbox') {
					formdata[$(this).attr("name")] = $(this).prop('checked') ? "1" : "0";
				} else {
					formdata[$(this).attr("name")] = $(this).val();
				}
			}
		});

		$.each(CKEDITOR.instances, function(key, value){
			formdata[key] = CKEDITOR.instances[key].getData();
		});

		showLoading();
		$.ajax({
			url: '<?php echo site_url('module/role/updateRecordAjax') ?>',
			type: 'POST',
			data: {"formdata": formdata },
			success: function(data) {
				hideLoading();
				if (data.status == "1"){
					if (data.redirect == "1"){
						location.href = "<?php echo site_url('module/role/') ?>";
					}else{
						location.href = "<?php echo site_url('module/role/edit/') ?>" + data.id;
					}
				}else{
					warningMsg("Error!!", data.msg)
				}
			}
		});
	}


	//Ckedior and filemanager control -------------------------------------------------------
	CKEDITOR.config.filebrowserImageBrowseUrl = '<?php echo base_url('assets/plugin/filemanager/index.html');?>';

	$(".sidebar-role a").addClass("selected");
	var _parent = $(".sidebar-role").parents('.wSubMenu');
	if (_parent.length > 0 ) _parent.find('.nav-submenu').slideToggle(function(){
	    _parent.find('.withSubMenu').addClass('selected');
	});

	//File manager
	var file_input_id = "";
	var popuptype = "";
	var fileSelectCB = function( path ) {
		$("#"+file_input_id).val(path);
		if (popuptype == "image"){
			$('.rowUploadPhoto[data-id="'+file_input_id+'"]').html("<img src='"+path+"'>");
			detectUploadPhoto(file_input_id);
		}
	}

	$(document).ready(function(){
		$(".browse_image").bind("click", function(){
			file_input_id = $(this).attr("data-input");
			popuptype = "image";
			window.open("<?php echo base_url('assets/plugin/filemanager/index.html');?>?field_name=" +file_input_id, "popupFileSeclect", "width=720,height=600");
		});

		$(".browse_file").bind("click", function(){
			file_input_id = $(this).attr("data-input");
			popuptype = "file";
			window.open("<?php echo base_url('assets/plugin/filemanager/index.html');?>?field_name=" +file_input_id, "popupFileSeclect", "width=720,height=600");
		});
		$(".download_file").bind("click", function(){
			file_link = $(this).attr("data-input");
			window.open(file_link, "_blank");
		});
	});

	//tab control --------------------------------------------------
	var currentTab = 0;

	$('.btnTab').eq(currentTab).addClass('selected');
	$('.tabDisplayItem').eq(currentTab).show();

	$('.btnTab').on('click', function()
	{
		var _index = $(this).index();
		$('.tabDisplayItem').hide().eq(_index).show();
		$(this).addClass('selected').siblings('.btnTab').removeClass('selected');
	});
	//---------------------------------------------------------------

	//Copy Language--------------------------------------------------
	var lang_fields = <?=$language_fields?>;

</script>
