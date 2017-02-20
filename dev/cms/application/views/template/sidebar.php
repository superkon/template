<div class="pageSidebar font-montserrat sidebar">
	<img class="vsoLogo" src="<?php echo base_url('assets/images/common/imgVsoloop-green.png') ?>" alt="Vsoloop Limited" />
	<ul class="nav nav-sidebar">
	<?php
	foreach ($menu_item as $item) {
		if (isset($item["submenu"])){
	?>
	<li class="sidebar-sub wSubMenu">
		<a href="javascript:void(0);" class="withSubMenu">
			<span><?=$item["name"]?></span>
		</a>
		<ul class="nav-submenu">
			<?php foreach ($item["submenu"] as $subitem){
				if (in_array($this->session->userdata('role'), $subitem[3])){
			?>
			<li class="sidebar-<?=$subitem['0']?>"><a href="<?=$subitem['2']?>"><span><?=$subitem['1']?></span></a></li>
			<?php }} ?>
		</ul>
	</li>
	<?php
		}else	if (in_array($this->session->userdata('role'), $item[3])){
	?>
		<li class="sidebar-<?=$item['0']?>"><a href="<?=$item['2']?>"><span><?=$item['1']?></span></a></li>
	<?php
		}
	}
	?>

	<!-- kon start
	<li class="sidebar-11 wSubMenu">
		<a href="javascript:void(0);" class="withSubMenu">
			<span>primary</span>
		</a>
		<ul class="nav-submenu">
			<li class="subSidebar-1">
				<a href="javascript:void(0);">
					<span>secondary</span>
				</a>
			</li>
			<li class="subSidebar-2">
				<a href="javascript:void(0);">
					<span>secondary</span>
				</a>
			</li>
		</ul>
	</li>

	<li class="sidebar-11 wSubMenu">
		<a href="javascript:void(0);" class="withSubMenu">
			<span>primary</span>
		</a>
		<ul class="nav-submenu">
			<li class="subSidebar-1">
				<a href="javascript:void(0);">
					<span>secondary</span>
				</a>
			</li>
			<li class="subSidebar-2">
				<a href="javascript:void(0);">
					<span>secondary</span>
				</a>
			</li>
		</ul>
	</li>
-->
	<script type="text/javascript">

		$('.withSubMenu').on('click', function(){
			var _parent = $(this).parent('.wSubMenu');
			$(this).toggleClass('active');
			_parent.find('.nav-submenu').slideToggle();
		});
		 $(document).ready(function(){
				 $('.wSubMenu').each(function(){
	 				 if ($(this).find('.nav-submenu li').length == 0){
						 $(this).hide();
					 }
				 });
		 });

	</script>

	<!-- kon end -->

	</ul>
</div>
