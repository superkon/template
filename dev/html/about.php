<?php
include_once "../include/config.php";
include_once "../include/loaddata.php";
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-hk">
	<head>
		<?php include "include/meta.php";?>

		<link rel="stylesheet" href="../css/vendor.min.css">
		<link rel="stylesheet" href="../css/app.min.css">

	</head>

	<body class="preload" ontouchstart="">

		<div class="wrapper about">

      <?php include"include/loading.php" ?>

			<div class="mainContentWrapper">
				<div class="innerContent">
					<!--- Header -->
					<?php include"include/header.php" ?>

					<!--- Content -->
					<div class="contentWrapper">

						<div class="menuColor__item commonBanner" data-menucolor="white">
							<div class="commonBanner__content" style="background-image:url('<?=$page_info['cover_banner']?>') "></div>
						</div>

						<div class="menuColor__item logoBar__checker" data-menucolor="golden"></div>

						<div class="contentWrapper__main gridBox--about">

							<div class="gridBox__row about__row__logo">
								<div class="gridBox__item about__row__logobar np dCoGrid-2-5 tCoGrid-1-5 mCoGrid-1-1">
										<span class="ghost">
										</span><div class="logoBar__logo">
												<?php echo file_get_contents("../images/common/logo.svg"); ?>
										</div>
								</div>
							</div>

							<div class="gridBox__row about__row__content">
								<div class="gridBox__item np dCoGrid-1-5 tCoGrid-1-10">
								</div><div class="gridBox__item np dCoGrid-3-5 tCoGrid-6-10">
									<div class="about__message__wrapper--1">
										<div class="about__title np dCoGrid-1-3 tCoGrid-1-3">
											<div class="about__title__stroke"></div>
											<h2 class="about__title__title"><?=showContent(array("submenu", "aboutus", 0))?></h2>
										</div><div class="about__message np dCoGrid-2-3 tCoGrid-2-3">
											<?=$page_info['content1']?>
										</div>
									</div>

									<div class="about__message__wrapper--2">
										<div class="about__title np dCoGrid-1-3 tCoGrid-1-3">
											<div class="about__title__stroke"></div>
											<h2 class="about__title__title"><?=showContent(array("submenu", "aboutus", 1))?></h2>
										</div><div class="about__message np dCoGrid-2-3 tCoGrid-2-3">
											<?=$page_info['content2']?>
										</div>
									</div>

									<div class="about__message__wrapper--3">
										<div class="about__title np dCoGrid-1-3 tCoGrid-1-3">
											<div class="about__title__stroke"></div>
											<h2 class="about__title__title"><?=showContent(array("submenu", "aboutus", 2))?></h2>
										</div><div class="about__message np dCoGrid-2-3 tCoGrid-2-3">
											<?=$page_info['content3']?>
										</div>
									</div>

								</div>
							</div>

						</div>

						<!-- <div class="gridBox__item "> -->
							<div class="aboutBanner__menuWrapper np dCoGrid-1-5 tCoGrid-1-5 onlyPD">
								<div class="aboutBanner__menuWrapper__btnMenu">
									<a href="javascript:void(0);" class="text" data-index="0"><?=showContent(array("submenu", "aboutus", 0))?></a>
								</div><div class="aboutBanner__menuWrapper__btnMenu">
									<a href="javascript:void(0);" class="text" data-index="1"><?=showContent(array("submenu", "aboutus", 1))?></a>
								</div><div class="aboutBanner__menuWrapper__btnMenu">
									<a href="javascript:void(0);" class="text" data-index="2"><?=showContent(array("submenu", "aboutus", 2))?></a>
								</div>
							</div>
						<!-- </div> -->



					</div>

					<!-- Footer -->
					<?php include"include/footer.php" ?>
				</div>
			</div>
		</div>

		<?php include"include/popup.php" ?>

		<script src="../js/vendor.min.js"></script>
		<script src="../js/app.min.js"></script>

		<script type="text/javascript">
			$(document).ready(init_fn);

			function init_fn(pEvent)
			{
				common_fn();

				$('.aboutBanner__menuWrapper__btnMenu .text').on('click', function()
				{
					var _index = $(this).data('index');
					var _scrollTopVal = $('[class*="about__message__wrapper"]').eq(_index).offset().top - 20;
					//console.log(_scrollTopVal);

					//$('.aboutBanner__menuWrapper__btnMenu .text').removeClass('selected');
					//$(this).addClass('selected');

					$("html, body").animate({
							scrollTop: _scrollTopVal
					}, 400);

				});



			}

		</script>

	</body>
</html>
