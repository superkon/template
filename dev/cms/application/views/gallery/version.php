<div class="pageFormListing">
<h2 class="sub-header"><?php echo $page_title; ?>

<button type="button" class="btn btn-primary navbar-right" onclick="window.open('<?php echo site_url('module/gallery/edit/'.$id) ?>','_self');"><?=lang("button_back")?></button>


<?php if ($error){ ?>
Error: <?php echo $error; ?>
<?php } ?>
<?php if ($notification){ ?>
Error: <?php echo $notification; ?>
<?php } ?>
  </h2>

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
		"order": [[ 0, "desc" ]],
    "processing": true,
    "serverSide": true,
    "language": <?=lang("datatable")?>,
    "ajax": {
		"url": "<?php echo site_url('module/gallery/getRecordVersionAjax/'.$id) ?>",
            "type": "POST"
		},

    "paging":   false,
    "ordering": false,
		"searching": false,
    "info": false,
    "columns": <?php
		$data = array();
		foreach ($fields as $key => $field){
			$data[] = array("data"=>$key);
		}
		echo json_encode($data);
		?>
    });

  var orderdata = [];
  var neworderdata = [];

	<?php
  for ($i=5; $i<count($fields)-1 ; $i++){
    echo "hideshowColumn(".$i.");". "\n";
  }
	//echo "datatable.column(".(count($fields) -1).").visible( false );". "\n"; // remove last coloumn
	?>
} );


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

$(".sidebar-gallery a").addClass("selected");
var _parent = $(".sidebar-gallery").parents('.wSubMenu');
if (_parent.length > 0 ) _parent.find('.nav-submenu').slideToggle(function(){
    _parent.find('.withSubMenu').addClass('selected');
});
</script>
