<h2 class="sub-header"><?php echo $page_title; ?>
<button type="button" class="btn btn-primary navbar-right" onclick="window.open('<?php echo site_url('module/gallery/listing/') ?>','_self');"><?=lang("button_back")?></button>
</h2>

<div class="table-responsive">
  <div class="tabMainWrapper">
    <p class="error"><?=$error?></p>
    <p class="alert-black"><?=$notification?></p>

    <div class="innerBox-lightGrey">
			<div class="displayContent">
        <form id="myform" name="myform" enctype="multipart/form-data">
        <div class="formRowWrapper">
					<div class="rowTitle"><?=lang("page_uploadcsv")?> </div>
					<div class="rowMessage margin-right-120">
						<input id="csv" name="csv" type="file" value="">
            <br/>
            <button type="button" class="btn btn-primary" onclick="window.open('<?php echo site_url('module/gallery/downloadImportSample/') ?>','_self');"><?=lang("button_sample")?></button>
					</div>
				</div>
        </form>
      </div>

      <div class="displayContent">
        <form id="myform" name="myform" enctype="multipart/form-data">
        <div class="formRowWrapper importdata">

        </div>
        <div class="formRowWrapper importerror text-warning">
        </div>
        <div class="formRowWrapper importsuccess">
            <button type="button" class="btn btn-primary import_save"><?=lang("button_save")?></button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
var csvdata = null;
$(document).ready(function(){
  $(".importerror").hide();
  $(".importsuccess").hide();

  $("#csv").on("change", function(){
    var formdata = new FormData();
    formdata.append("csv", $('input[type=file]')[0].files[0]);

    if (formdata) {
      showLoading();
      $.ajax({
        url: "<?php echo site_url('module/gallery/importExcel') ?>",
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (res) {
          if (res.status == 1){
            console.log(res);
            csvdata = res;
            var html_data = "";

            html_data += "<table border='1'>" + "\n";
            html_data += "<tr>" + "\n";
            html_data += "<td><?=lang("datatable_row")?></td>" + "\n";
            $.each(res.title, function( i, v ){
              html_data += "<td>" + v + "</td>" + "\n";
            });
            html_data += "</tr>" + "\n";

            $.each(res.data, function( i, v ){
              html_data += "<tr>" + "\n";
              html_data += "<td>" + (i+1) + "</td>" + "\n";
              $.each(v, function( child_i, child_v ){
                html_data += "<td>" + child_v + "</td>" + "\n";
              });
              html_data += "</tr>" + "\n";
            });

            html_data += "</table>" + "\n";

            if (res.check_error == ""){
              $(".importsuccess").show();
              $(".importerror").hide();
            }else{
              $(".importerror").html(res.check_error);
              $(".importsuccess").hide();
              $(".importerror").show();
            }

            $(".formRowWrapper.importdata").html(html_data);
          }else{
            alert(res.msg);

            $(".importerror").html("");
            $(".importsuccess").hide();
            $(".importerror").hide();
            $(".formRowWrapper.importdata").html("");
          }
          $("#csv").val("");
          hideLoading();
        }
      });
    }
  });

  $(".import_save").bind("click", function(){
    if(confirm("<?=lang("button_import_msg")?>")){
  		showLoading();
  		$.ajax({
  			url: '<?php echo site_url('module/gallery/importSave') ?>',
  			type: 'POST',
        dataType: "json",
  			data: {"data": csvdata },
  			success: function(data) {
  				if (data.status == "1"){
  					alert("<?=lang("import_success")?>");
  					location.reload();
  				}else{
  					alert(data.msg);
  				}
  				hideLoading();
  			}
  		});
    }
  });
});

$(".sidebar-gallery a").addClass("selected");
var _parent = $(".sidebar-gallery").parents('.wSubMenu');
if (_parent.length > 0 ) _parent.find('.nav-submenu').slideToggle(function(){
    _parent.find('.withSubMenu').addClass('selected');
});
</script>
