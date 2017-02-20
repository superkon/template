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

		<div class="wrapper monthlyTopic bottomAd">

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

						<div class="contentWrapper__main monthlyTopic__wrapper">
							<div class="monthlyTopic__topic">

								<div class="monthlyTopic__topic__banner onlyPD" style="background-image:url('<?=$topic['image']?>')"></div>

								<div class="monthlyTopic__topic__content">
									<div class="monthlyTopic__topic__messageWrapper">
										<div class="monthlyTopic__topic__inner">

											<div class="monthlyTopic__topic__rightPicker proto__topicPicker">

												<div class="monthlyTopic__topic__rightPicker__top">
													<a class="btn__prev" href="javascript:void(0);"><span class="stroke"></span></a>
													<h3><span class="year"></span> 年</h3>
													<a class="btn__next" href="javascript:void(0);"><span class="stroke"></span></a>
												</div>

												<div class="monthlyTopic__topic__rightPicker__month">
												<?php for ($i=1; $i<=12; $i++){ ?><div class="monthIco__item">
														<a class="btn__monthIco" data-month="<?=$i?>" href="javascript:void(0);"><?=showContent(array("news", "month", $i))?></a>
													</div><?php } ?>
												</div>

												<!-- <h2 class="monthlyTopic__topic__rightPicker__pickerTitle">龍鳳鐲專題</h2> -->

											</div>

											<div class="monthlyTopic__topic__leftContent">

												<div class="monthlyTopic__titleWrapper">
													<div class="monthlyTopic__mHolder">
														<span class="monthlyTopic__monthIco">
															<span class="ghost">
															</span><span class="vaMiddle text">
																<span class="month"><?=$topic['month']?></span>
																<span class="month_c"><?=showContent(array("news", "month", $topic['month']))?></span>
															</span>
														</span><span class="onlyM monthlyTopic__mobileImg">
															<img class="img100" src="<?=$topic['image_m']?>" alt=""/>
														</span>
													</div>

													<div class="monthlyTopic__mainTitle">
														<span class="ghost onlyPD">
														</span><h2 class="title">
															<?=$topic['title']?>
														</h2>
													</div>
												</div>

												<div class="monthlyTopic__messageWrapper">
													<?=$topic['content']?>
												</div>

												<div class="shareWrapper"></div>

											</div>

										</div>
									</div>
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

			gSpecialTopic = null;

			var gCurrentArticle_year = <?=$topic['year']?>;
			var gCurrentArticle_month = <?=$topic['month']?>;

			var gTopicArray = <?=json_encode($items)?>;

			var gCurrentDate = "<?php echo (isset($_REQUEST['id']))?$_REQUEST['id']:"null";?>";

			function init_fn(pEvent)
			{
				common_fn();

				gSpecialTopic = new topicPicker();
				gSpecialTopic.init($('.proto__topicPicker'),{
					'objArray' : gTopicArray,
					'currentYear' : gCurrentArticle_year,
					'currentMonth' : gCurrentArticle_month
				});
			}

			topicPicker.prototype.target = null;
			topicPicker.prototype.settings = null;
			topicPicker.prototype.gArray = null;

			topicPicker.prototype.gMonthStoreArray = null;

			topicPicker.prototype.gCurrentYear = null;
			topicPicker.prototype.gCurrentMonth = null;

			topicPicker.prototype.gEase = "Power3.easeInOut";

			function topicPicker(){}

			topicPicker.prototype.init = function(pTarget, config)
			{
			  var _self = this;

			  _self.target = pTarget;
			  _self.settings = {};

			  $.extend(_self.settings, config);

				_self.gArray = _self.settings.objArray;

				_self.gCurrentYear = _self.settings.currentYear;
				_self.gCurrentMonth = _self.settings.currentMonth;

				//console.log(_self.gArray, _self.gCurrentYear, _self.gCurrentMonth);

				_self.gMonthStoreArray = [];

				$.each(_self.gArray.items, function(_i, _el){
					_self.gMonthStoreArray.push(_i);
				});

				//console.log(_self.gMonthStoreArray.indexOf("2017"));

				_self.checkArrow();
				_self.changeMonth();
				_self.bindArrow();

				$('.btn__monthIco, _self.target').on('click', function()
				{
					var _month = $(this).data('month');
					location.href = "monthly-topic.php?year="+_self.gCurrentYear+"&month="+_month;
				});

			};

			topicPicker.prototype.checkArrow = function()
			{
			  var _self = this;

				$('.btn__prev', _self.target).hide();
				$('.btn__next', _self.target).hide();

				if(_self.gCurrentYear < _self.gArray.info.endYear)
				{
					$('.btn__next', _self.target).show();
				}

				if(_self.gCurrentYear > _self.gArray.info.startYear)
				{
					$('.btn__prev', _self.target).show();
				}
			}

			topicPicker.prototype.bindArrow = function()
			{
			  var _self = this;

				$('.btn__next', _self.target).off('click').on('click',function(){
					var _curentIndex = _self.gMonthStoreArray.indexOf(_self.gCurrentYear.toString());
					_curentIndex++;

					_self.gCurrentYear = _self.gMonthStoreArray[_curentIndex];

					bindEvent();
				});

				$('.btn__prev', _self.target).off('click').on('click',function(){
					var _curentIndex = _self.gMonthStoreArray.indexOf(_self.gCurrentYear.toString());
					_curentIndex--;

					_self.gCurrentYear = _self.gMonthStoreArray[_curentIndex];

					bindEvent();
				});

				function bindEvent()
				{
					_self.changeMonth();
					_self.checkArrow();
				}
			}

			topicPicker.prototype.changeMonth = function()
			{
			  var _self = this;

				//reset
				$.each($('.btn__monthIco', _self.target), function(_i, _el){
					$(_el).removeClass('selected');
					$(_el).parents('.monthIco__item').hide();
				});


				if(_self.gCurrentYear == _self.settings.currentYear)
				{
					$('.btn__monthIco[data-month="'+_self.settings.currentMonth+'"]', _self.target).addClass('selected');
				}

				//$('.monthlyTopic__topic__rightPicker__pickerTitle', _self.target).html('');
				$('.monthlyTopic__topic__rightPicker__top', _self.target).find('h3').find('.year').html('');

				//set Month
				if(_self.gArray.items[_self.gCurrentYear] == null)
				{
					$('.monthlyTopic__topic__rightPicker__month', _self.target).hide();
				}else
				{
					$('.monthlyTopic__topic__rightPicker__month', _self.target).show();

					$.each(_self.gArray.items[_self.gCurrentYear], function(_i, _el){
						$('.btn__monthIco[data-month='+_i+']', _self.target).parents('.monthIco__item').show();
					});
				}

				//set Month
				$('.monthlyTopic__topic__rightPicker__top', _self.target).find('h3').find('.year').html(_self.gCurrentYear);

				if( _self.gCurrentYear === gCurrentArticle_year)
				{
					$('.btn__monthIco[data-month="'+_self.gCurrentMonth+'"]', _self.target).addClass('selected');
					//$('.monthlyTopic__topic__rightPicker__pickerTitle', _self.target).html(_self.gArray.items[0][_self.gCurrentYear][_self.gCurrentMonth].title);
				}
			}

			</script>

	</body>
</html>
