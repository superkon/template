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

		<div class="wrapper tips">

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
									<?=showContent(array("mainmenu", "tips"))?>
								</p><div class="logoBar__menuWrapper">
									<?php foreach ($tips as $item){ ?><div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu btn__menu__scroll" data-index="<?=($item['id']-1)?>" data-goto="<?=$item['id']?>">
											<span class="topStroke"></span>
											<span class="text"><?=$item['title']?></span>
										</a>
									</div><? } ?>
								</div>
							</div>
						</div>


						<div class="contentWrapper__main tips__wrapper proto__tipsSVG">

<?php foreach ($tips as $item){ ?>
							<!-- tips_item 1 -->
							<div class="tips__items tips__items--<?=$item['id']?>" data-color="<?=$item['cssclass']?>">
								<div class="tips__items__inner">
									<div class="tips__items__svg np dCoGrid-1-2 tCoGrid-1-2 mCoGrid-1-1">
										<?php echo file_get_contents("../images/tips/tips_svg_".$item['id'].".svg"); ?>
									</div>
									<div class="tips__items__messageWrapper np dCoGrid-1-2 tCoGrid-1-2 mCoGrid-1-1">
										<div class="tips__items__message">

											<div class="tips__items__title">
												<h2><?=$item['title']?></h2>
											</div><div class="tips__items__innerMessage">
												<p><?=$item['description']?></p>
											</div>

										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
<?php } ?>
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

			var gTipsSVG = null;

			function init_fn(pEvent)
			{
				common_fn();

				gTipsSVG = new tipsSVG();
				gTipsSVG.init($('.proto__tipsSVG'),{});

				$('.btn__menu__scroll').on('click', function(){

					var _goto = $(this).data('goto');
					var _scrollNum = $('.tips__items--'+_goto).offset().top - $('.logoBar').outerHeight(true);

					$("html, body").animate({
			        scrollTop: _scrollNum
			    });
				});
				
				gTipsSVG.onScrollTips();

			}

			tipsSVG.prototype.target = null;
			tipsSVG.prototype.settings = null;
			tipsSVG.prototype.gArray = null;
			tipsSVG.prototype.svgArray = null;
			tipsSVG.prototype.svgInit = false;

			tipsSVG.prototype.gEase = "Power3.easeInOut";

			function tipsSVG(){}

			tipsSVG.prototype.init = function(pTarget, config)
			{
			  var _self = this;

			  _self.target = pTarget;

			  _self.settings = {

			  };

			  $.extend(_self.settings, config);

			  _self.calculateSlider();
				_self.setSVG();
			};

			tipsSVG.prototype.setSVG = function()
			{
			  var _self = this;

				_self.svgArray = [];

				for(var _i=0; _i<$('.tips__items', _self.target).length; _i++)
				{
					var _index = _i+1;
					var _tempArray = [];

					var path = document.querySelectorAll('.path_'+_index);

					for (var _j = 0; _j < path.length; _j++)
					{
						var _obj = {};

						_obj.object = path[_j];
						_obj.length = path[_j].getTotalLength();

						_tempArray.push(_obj);
			    }

					_self.svgArray.push(_tempArray);

					for(_k=0; _k<_tempArray.length; _k++)
					{
						$(_tempArray[_k].object).css({
							'stroke-dasharray': _tempArray[_k].length,
				  		'stroke-dashoffset' : _tempArray[_k].length
						});
					}
				}

				console.log(_self.svgArray);
			}

			tipsSVG.prototype.calculateSlider = function()
			{
			  var _self = this;

				_self.svgArray = [];

				$(window).on('scroll.tips', function(){_self.onScrollTips()});
			}
			
			tipsSVG.prototype.onScrollTips = function()
			{
				var _self = this;
				
				var _scrollVal = $(window).scrollTop();
				var _windowHeight = $(window).height();
				var _pageHeight = $('.wrapper').outerHeight(true);

				var _percentageScale = percentageConvertor(_windowHeight, _pageHeight, _scrollVal);

				var _commonBannerHeight = $('.commonBanner').outerHeight(true);

				var _tempValStart = 0;
				var _tempValEnd = 0;
				var _checker = 0;

				do
				{
					_tempValStart = _tempValEnd;

					if(_checker === 0)
					{
						_tempValEnd = _tempValStart + _commonBannerHeight;
					}else
					{
						var _num = $('.tips__items', _self.target).eq(_checker-1).outerHeight(true);
						_tempValEnd = _tempValStart + _num;
					}
					_checker++;

					if(_checker >= 5) break;

				}while(_scrollVal > _tempValEnd);
				
				var _percentageVal = null;
				var _importPercentage = null;

				if (!_self.svgInit)
				{
					_self.svgInit = true;
					for (var _i = 1; _i < _checker; _i++)
					{
						svgAnimation(_i, 100);
					}
				}

				_percentageVal = ((_scrollVal-_tempValStart)/(_tempValEnd-_tempValStart))*100;
				_percentageVal = Math.min(100, (_percentageVal * 1.6));
				_importPercentage = pageSliderCalculator(_checker, _percentageVal);

				svgAnimation(_checker, _importPercentage);

				function svgAnimation(pChecker, pPercentage)
				{
					var _index = pChecker-1;
					var _newValue = pPercentage/100;

					for(var _i=0; _i<_self.svgArray[_index].length; _i++)
					{
						$(_self.svgArray[_index][_i].object).css({
							'stroke-dashoffset' : _self.svgArray[_index][_i].length - (_newValue*_self.svgArray[_index][_i].length)
						});
					}
				}

				function pageSliderCalculator(_checker, _percentageVal)
				{
					var _index = _checker-1;
					var _percentageVal = _percentageVal;

					if(_percentageVal < 5) _percentageVal = 0;
					if(_percentageVal > 90) _percentageVal = 100;

					return _percentageVal;
				}

				function percentageConvertor(_windowHeight, _pageHeight, _scrollVal)
				{
					return (_scrollVal/(_pageHeight-_windowHeight))*100;
				}
			}

			</script>

	</body>
</html>
