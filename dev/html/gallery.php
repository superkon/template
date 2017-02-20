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

		<div class="wrapper gallery">

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

						<div class="logoBar logoBar_page_common">
							<div class="logoBar__content">
								<span class="ghost">
								</span><div class="logoBar__logo">
										<?php echo file_get_contents("../images/common/logo.svg"); ?>
								</div><p class="logoBar__heading">
									<?=showContent(array("mainmenu", "gallery"))?>
								</p><div class="logoBar__menuWrapper"></div>
							</div>
						</div>

						<div class="contentWrapper__main gridBox">
							<?php
								$i =0;
								foreach ($galleries as $gallery){
							?><div class="gridBox__item np dCoGrid-1-4 tCoGrid-1-4 mCoGrid-1-2">
								<div class="gridBox__inner gridBox__padding_1-1">
									<a href="javascript:void(0);" class="gridBox__abs" data-index="<?=$i?>">
										<img class="img100" src="<?=$gallery['thumb']?>" alt=""/>
										<span class="dim"></span>
									</a>
								</div>
							</div><?php
								$i++;
							}
							?>

						</div>

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

				$('.gridBox__abs').on('click', function()
				{
					var _index = $(this).data('index');

					console.log(_index);

					$('.btn__popClose').on('click', function(){
						$.magnificPopup.close();
					});

					popup($('.popupSection__gallery'),{

						callbacks: {
						  beforeOpen: function()
							{
								$('.slick__display__wrapper').css('visibility', 'hidden');
								$('.slick__thumb__wrapper').css('visibility', 'hidden');

								$('.slick__display__wrapper').css('opacity', 0);
								$('.slick__thumb__wrapper').css('opacity', 0);
							},
							open: function()
							{
								$('.slick__display__wrapper, .slick__thumb__wrapper').on('init', function()
								{
									setTimeout(function(){
										$(window).trigger('resize');
									},500);

									setTimeout(function(){
										$('.slick__display__wrapper').css('visibility', 'visible');
										$('.slick__thumb__wrapper').css('visibility', 'visible');

										$('.slick__display__wrapper, .slick__thumb__wrapper').animate({
											'opacity' : 1
										});


										$('.btn__popClose').addClass('active');

									},700);
								});

								$('.slick__display__wrapper').slick({
									slidesToShow: 1,
									slidesToScroll: 1,
									initialSlide: _index,
									fade: true,
									arrows: false,
									adaptiveHeight: true,
									asNavFor: '.slick__thumb__wrapper'
								});

								$('.slick__thumb__wrapper').slick({
									slidesToShow: 7,
									slidesToScroll: 1,
									initialSlide: _index,
									centerMode: true,
									focusOnSelect: true,
									asNavFor: '.slick__display__wrapper',
									prevArrow: '<a href="javascript:void(0);" class="arrow__wrapper--left"><span class="stroke"></span></a>',
									nextArrow: '<a href="javascript:void(0);" class="arrow__wrapper--right"><span class="stroke"></span></a>',
									responsive: [
										{
										  breakpoint: 760,
										  settings: {
										    slidesToShow: 3
										  }
										},
										{
										  breakpoint: 1280,
										  settings: {
										    slidesToShow: 5
										  }
										}
									]

								});
						  },
							afterClose: function()
							{
								$('.slick__display__wrapper').slick('unslick');
								$('.slick__thumb__wrapper').slick('unslick');
								$('.btn__popClose').removeClass('active');
							}
						}

					});

				});

			}

			</script>

	</body>
</html>
