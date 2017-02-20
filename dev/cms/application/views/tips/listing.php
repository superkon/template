<div class="pageFormListing">
<h2 class="sub-header"><?php echo $page_title; ?>
<?php if ($permission['delete']){ ?>
  <button type="button" class="btn btn-primary navbar-right" onclick="window.open('<?php echo site_url('module/tips/edit/') ?>','_self');"><?=lang("button_add")?></button>
<?php } ?>
<?php if ($permission['rank']){ ?>
  <button type="button" class="btn btn-primary navbar-right" onclick="window.open('<?php echo site_url('module/tips/rank/') ?>','_self');"><?=lang("button_rank")?></button>
<?php } ?>
<?php if ($permission['export']){ ?>
  <button type="button" class="btn btn-primary navbar-right" onclick="window.open('<?php echo site_url('module/tips/export') ?>','_blank');"><?=lang("button_export")?></button>
<?php } ?>
<?php if ($error){ ?>
Error: <?php echo $error; ?>
<?php } ?>
<?php if ($notification){ ?>
Error: <?php echo $notification; ?>
<?php } ?>
  </h2>
   <div class="filterControls table-responsive">
		<?php
		$i = 0;
		foreach ($fields as $idx => $field){
			if ($i != (count($fields) -1) && $i != 0)
				echo "<a class='active' href='javascript:hideshowColumn(".$i.")'>".$field."</a>"."\n";
			$i++;
		}
		?>
  </div>
  <div class="listingContent table-responsive">
	<table id="record_table" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
			<?php foreach ($fields as $field){
				echo "<th>".$field."</th>"."\n";
			}?>
			</tr>
		</thead>
	</table>
  </div>
</div>

<script>
var datatable = null;
$(document).ready(function() {
    datatable = $('#record_table').DataTable( {
		"order": [[ 0, "asc" ]],
        "processing": true,
        "serverSide": true,
		"language": <?=lang("datatable")?>,
        "ajax": {
			"url": "<?php echo site_url('module/tips/getRecordAjax') ?>",
            "type": "POST"
		},
		"columnDefs": [
			{ "orderable": false, "targets": <?=(count($fields) -1)?> }  //disable order in last column
		],
        "columns": <?php
		$data = array();
		foreach ($fields as $key => $field){
			$data[] = array("data"=>$key);
		}
		echo json_encode($data);
		?>
    });

	<?php
  for ($i=5; $i<count($fields)-1 ; $i++){
    echo "hideshowColumn(".$i.");". "\n";
  }
	//echo "datatable.column(".(count($fields) -1).").visible( false );". "\n"; // remove last coloumn
	?>
} );

function deleteRecord(id){
	if(confirm("<?=lang("button_delete_msg")?>")){
		showLoading();
		$.ajax({
			url: '<?php echo site_url('module/tips/deleteRecordAjax') ?>',
			type: 'POST',
			data: {"id": id },
			success: function(data) {
        if (data == ""){
          alert("Session Timeout!!");
          location.href = "<?php echo site_url('login') ?>";
				}else if (data.status == "1"){
					alert("<?=lang("delete_success")?>");
					location.reload();
				}else{
					alert(data.errmsg);
				}
				hideLoading();
			}
		});
		return true;
	}else{
		return false;
	}
}

function hideshowColumn(idx){
	var column = datatable.column( idx );
	column.visible( ! column.visible() );

	if ($(".filterControls").find("a").eq(idx-1).hasClass("active"))
	{
		$(".filterControls").find("a").eq(idx-1).removeClass("active");
	}
	else
	{
		$(".filterControls").find("a").eq(idx-1).removeClass("active").addClass("active");
	}
}

$(".sidebar-tips a").addClass("selected");
var _parent = $(".sidebar-tips").parents('.wSubMenu');
if (_parent.length > 0 ) _parent.find('.nav-submenu').slideToggle(function(){
    _parent.find('.withSubMenu').addClass('selected');
});
</script>
