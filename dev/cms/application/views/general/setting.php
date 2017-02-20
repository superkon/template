<h2 class="sub-header"><?php echo $page_title; ?></h2>

<div class="table-responsive">
	<form id="myform" name="myform" action="edit.php">

	<div class="tabMainWrapper">
		<p class="error"><?=$error?></p>
		<p class="alert-black"><?=$notification?></p>

		<div class="tabControlWrapper">
			<a href="javascript:void(0);" class="btnTab"><?php echo $page_title; ?></a>
			<div class="clear"></div>
		</div>

		<div class="tabDisplayWrapper">
			<div class="tabDisplayItem">
				<div class="innerBox-lightGrey">
					<div class="displayContent">
<?php echo $edit_section; ?>
					</div>
				</div>
			</div>

			<div class="btnWrapper aCenter wMarginTop">
					<button type="button" name="button" onclick="submitForm(0)"><?=lang("button_save")?></button>
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
			url: '<?php echo site_url('setting/updateRecordAjax') ?>',
			type: 'POST',
			data: {"formdata": formdata },
			success: function(data) {
				hideLoading();
				if (data.status == "1"){
					location.href = "<?php echo site_url('setting/') ?>";
				}else{
					warningMsg("Error!!", data.msg)
				}
			}
		});
	}

	$(".sidebar-setting a").addClass("selected");
	var _parent = $(".sidebar-setting").parents('.wSubMenu');
	if (_parent.length > 0 ) _parent.find('.nav-submenu').slideToggle(function(){
	    _parent.find('.withSubMenu').addClass('selected');
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

</script>
