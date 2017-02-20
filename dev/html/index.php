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

		<div class="wrapper index">

      <?php include"include/loading.php" ?>

			<div class="mainContentWrapper">
				<div class="innerContent">
					<!--- Header -->
					<?php include"include/header.php" ?>

					<!--- Content -->
					<div class="contentWrapper">

						<div class="menuColor__item indexBanner" data-menucolor="white">

							<div class="indexBanner__innerWrapper">
							<?php foreach ($banners as $banner ){?>
								<div class="indexBanner__item">
									<div class="indexBanner__innerItem" data-type="<?=$banner['type']?>" date-link="<?=$banner['link']?>" style="background-image:url('<?=$banner['thumb']?>')"></div>
								</div>
							<?php } ?>
							</div>

						</div>

						<div class="menuColor__item logoBar__checker" data-menucolor="golden"></div>

						<div class="logoBar logoBar_page_index">
							<div class="logoBar__content">
								<span class="ghost">
								</span><div class="logoBar__logo">
										<?php echo file_get_contents("../images/common/logo.svg"); ?>
								</div>
							</div>
						</div>

						<div class="contentWrapper__main gridBox">
								<?php include"include/common-gridbox.php" ?>
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

			var gEase = "Power3.easeInOut";
			var gTimeUnit = 0.25;

			function init_fn(pEvent)
			{
				common_fn();

				$('.indexBanner__innerWrapper').slick({
					autoplay: true,
					dots: true,
  				infinite: true,
					speed: 600,
					fade: true,
					cssEase: 'cubic-bezier(0.86, 0, 0.07, 1)',
					customPaging : function(slider, i) {
							return '<span class="slickDot"></span>';
					}
				});
			}
			
			</script>

	</body>
</html>
