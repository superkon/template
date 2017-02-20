<?php
include_once "../include/config.php";
include_once "../include/loaddata.php";

//include_once "../include/func.php";
//include_once "../include/lang/tc.php";

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-hk">
	<head>
		<?php include "include/meta.php";?>

		<link rel="stylesheet" href="../css/vendor.min.css">
		<link rel="stylesheet" href="../css/app.min.css">

	</head>

	<body class="preload" ontouchstart="">

		<div class="wrapper news bottomAd">

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
									<?=showContent(array("mainmenu", "news"))?>
								</p><div class="logoBar__menuWrapper">
									<div class="logoBar__menuItem">
										<a href="news.php" class="logoBar__menuItem__btnMenu btn__menu__scroll">
											<span class="topStroke"></span>
											<span class="text"><?=showContent(array("submenu", "news", 0))?></span>
										</a>
									</div><div class="logoBar__menuItem">
										<a href="monthly-topic.php" class="logoBar__menuItem__btnMenu btn__menu__scroll">
											<span class="topStroke"></span>
											<span class="text"><?=showContent(array("submenu", "news", 1))?></span>
										</a>
									</div><div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu btn__menu__scroll" data-index="ad">
											<span class="topStroke"></span>
											<span class="text"><?=showContent(array("submenu", "news", 2))?></span>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="contentWrapper__main news__wrapper proto__news">
							<div class="news__topicsWrapper">
								<div class="itemAjaxWrapper"></div>
								<div class="loadMoreWrapper">
									<a href="javascript:void(0);" class="loadMore"></a>
								</div>
							</div>
						</div>

						<div class="promotionAd__wrapper__stroke"></div>
						<div class="promotionAd__wrapper">
							<div class="promotionAd__inner">
								<img class="img100 onlyPD" src="https://dummyimage.com/1680x150/000/fff" alt="" />
								<img class="img100 onlyM" src="https://dummyimage.com/320x150/000/fff" alt="" />
							</div>
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
			var lang = "<?=$lang?>";
			var gLoadIndexData = null;

			function init_fn(pEvent)
			{
				common_fn();
				gLoadIndexData = new ajaxLoaderFn($('.proto__news'), 0);
			}


			</script>

	</body>
</html>
