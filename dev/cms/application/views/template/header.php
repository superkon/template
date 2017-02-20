<script type="text/javascript">
var js_lang = <?php echo lang("js_lang"); ?>
</script>

<style>
	.loading
	{
		height:100%;
		width:100%;
		position:fixed;
		left:0;
		top:0;
		z-index:1001 !important;
		background-color:black;
		display: none;
		opacity: 0.4;
		filter: alpha(opacity=40); /* For IE8 and earlier */
	}
</style>

<div class="loading"></div>
<nav class="pageHeader font-montserrat navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo site_url('dashboard') ?>"><?php echo $this->settings->site_name; ?> </a>
			<img class="vsoLogo" src="<?php echo base_url('assets/images/common/imgVsoloop-green.png') ?>" alt="Vsoloop Limited" />
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a class="user" href="<?php echo site_url('module/user/profile') ?>"><span><?=lang("hello")?>! <?=$this->session->userdata('login_name');?></span></a></li>
				<li><a class="logout" href="<?php echo site_url('logout') ?>"><span><?=lang("logout")?></span></a></li>
				<li class="hideD"><a href="<?php echo site_url('dashboard') ?>"><?php echo $this->settings->site_name; ?> </a></li>
				<?php
				foreach ($menu_item as $item) {
					if (isset($item["submenu"])){
					?>
					<li class="hideD sidebar-sub wSubMenu">
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
					<li class="hideD sidebar-<?=$item['0']?>"><a href="<?=$item['2']?>"><span><?=$item['1']?></span></a></li>
				<?php
					}
				}
				?>

				<!-- kon start
					<li class="hideD sidebar-11 wSubMenu">
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

				<!-- kon end -->

				<li class="hideD"><span class="copyright">©Vsoloop 2016 all rights reserved.</span></li>
			</ul>
		</div>
	</div>
</nav>
