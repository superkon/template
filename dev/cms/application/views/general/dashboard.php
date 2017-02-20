<div class="pageDashboard">
	<h2 class="sub-header"><?=lang("pagetitle_dashboard")?></h2>
</div>

<script>

$(".sidebar-dashboard a").addClass("selected");
var _parent = $(".sidebar-dashboard").parents('.wSubMenu');
if (_parent.length > 0 ) _parent.find('.nav-submenu').slideToggle(function(){
    _parent.find('.withSubMenu').addClass('selected');
});
</script>
