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
									<?=showContent(array("mainmenu", "service"))?>
								</p><div class="logoBar__menuWrapper"><?php
								foreach ($services as $service){ if (isset($service['title'])){
								?><div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu" data-index="<?=$service['id']?>">
											<span class="topStroke"></span>
											<span class="text"><?=$service['title']?></span>
										</a>
									</div>
								<?php }} ?>
								</div>
							</div>
						</div>


						<div class="contentWrapper__main gridBox proto__serviceSlider">

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

			var gServiceSlider = null;

			var gLogoSVG = '<?php echo str_replace("\r\n", "", file_get_contents("../images/common/logo.svg")); ?>';

			var gSliderContent = <?=json_encode($services); ?>;


			function init_fn(pEvent)
			{
				common_fn();

				gServiceSlider = new serviceSlider();
				gServiceSlider.init($('.proto__serviceSlider'), gSliderContent,{
					'responsive_m' : 2,
					'responsive_t' : 4,
					'responsive_d' : 4
				});
			}

			function serviceSlider(){};

			serviceSlider.prototype.target = null;
			serviceSlider.prototype.settings = null;
			serviceSlider.prototype.gArray = null;
			serviceSlider.prototype.gEase = "Power3.easeInOut";
			serviceSlider.prototype.gEase2 = "Power3.easeInOut";


			serviceSlider.prototype.gCurrentIndex = null;
			serviceSlider.prototype.gCurrentRowIndex = null;

			serviceSlider.prototype.init = function(pTarget, pArray, config)
			{
				var _self = this;

				_self.target = pTarget;

				_self.gArray = [];
				_self.gArray = pArray;

				_self.settings = {
					'responsive_m' : 2,
					'responsive_t' : 4,
					'responsive_d' : 4
		    };

		    $.extend(_self.settings, config);

				_self.buildThumb();
			};

			serviceSlider.prototype.buildThumb = function()
			{
				var _self = this;
				var _htmlThumb = null;

				_htmlThumb = '';

				for(var _i=0; _i<_self.gArray.length; _i++)
				{
					_htmlThumb += thumbHTML(_i);
				}

				_self.target.append(_htmlThumb);

				_self.bindSlider();

				$(window).on('responsive', function(){
					_self.destroySlider();
					_self.destroyMobileSlider();
				});

				function thumbHTML(pIndex)
				{
					var _html = null;

					_html = '';

					var _rowNum = Math.floor(pIndex/4);

					_html += '<div class="gridBox__item np dCoGrid-1-'+_self.settings.responsive_d+' tCoGrid-1-'+_self.settings.responsive_t+' mCoGrid-1-'+_self.settings.responsive_m+'" data-index="'+_i+'">';
					_html += '	<div class="gridBox__inner gridBox__padding_1-1">';

					if(_self.gArray[_i].type == "slider")
					{
						_html += '		<a href="javascript:void(0);" class="gridBox__abs sliderItem" data-index="'+_i+'">';
						_html += '			<img class="img100" src="'+_self.gArray[_i].img+'" alt=""/>';
						_html += '			<span class="slider__abs">';
						_html += '				<span class="ghost"></span><span class="slider__text">'+_self.gArray[_i].title+'</span>';
						_html += '			</span>';
						_html += '		</a>';

						_html += '		<span class="m__extra__block">';
						_html += '			<span class="ghost">';
						_html += '			</span><span class="vaMiddle">';
						_html += '				<h3 class="ani">'+_self.gArray[_i].title+'</h3>';
						_html += '				<span class="btnWrapper ani">';
						_html += '					<a href="'+_self.gArray[_i].btn_link+'" class="btn__s1">';
						_html += '						<span class="ghost">';
						_html += '						</span><span class="text">'+_self.gArray[_i].btn+'</span>';
						_html += '					</a>';
						_html += '				</span>';
						_html += '			</span>';
						_html += '		</span>';

					}else if(_self.gArray[_i].type == "logo")
					{
						_html += '		<div class="gridBox__abs sliderItem logoItem" data-index="'+_i+'">';
						_html += '			<span class="ghost"></span><div class="inner__logo">'+gLogoSVG+'</div>';
						_html += '		</div>';
					}

					_html += '	</div>';
					_html += '</div>';

					return _html;
				}
			}

			serviceSlider.prototype.destroyMobileSlider = function()
			{
				var _self = this;

				var _sliderItem = $('.sliderItem', _self.target);
				var _sliderItemParent = $('.sliderItem', _self.target).parents('.gridBox__item');
				var _extraBlock = _sliderItemParent.find('.m__extra__block');
				var _aniItem = _extraBlock.find('.ani');

				_sliderItem.removeClass('selected');
				_sliderItemParent.css({'z-index' : ''});

				TweenMax.set(_extraBlock, {'width':0});
				TweenMax.set(_aniItem, {'opacity':0, 'y':50});

				_self.gCurrentIndex = null;

			}

			serviceSlider.prototype.destroySlider = function()
			{
				var _self = this;
				var _sliderParent = $('.gridBox__row--expandSlider', _self.target);

				$('.sliderItem', _self.target).removeClass('selected');

				/*reset slider Item*/

				$('.sliderItem', _self.target).css({
					'z-index' : ''
				});

				_sliderParent.remove();

				_self.gCurrentIndex = null;
				_self.gCurrentRowIndex = null;
			}

			serviceSlider.prototype.bindSlider = function()
			{
				var _self = this;

				$('.logoBar__menuItem__btnMenu').on('click',function()
				{
					var _index = $(this).data('index');

					if(layout != "mobile")
					{
						buildSliderFn(_index);
					}else
					{
						buildSliderMobileFn(_index);
					}

				});

				$('.sliderItem', _self.target).on('click',function()
				{
					var _index = $(this).data('index');

					if(!$(this).hasClass('logoItem'))
					{
						if(layout != "mobile")
						{
							buildSliderFn(_index);
						}else
						{
							buildSliderMobileFn(_index);
						}
					}
				});

				function buildSliderMobileFn(pIndex)
				{
					var _aniTimeUnit = gTimeUnit;

					var _thisItem = $('.sliderItem[data-index="'+pIndex+'"]', _self.target);
					var _thisItemParent = _thisItem.parents('.gridBox__item');
					var _extraBlock = _thisItemParent.find('.m__extra__block');
					var _aniItem = _extraBlock.find('.ani');

					if(_self.gCurrentIndex != pIndex)
					{
						/*** reset ***/
						_self.destroyMobileSlider();

						/*** animation ***/
						_thisItem.addClass('selected');
						_thisItemParent.css({'z-index' : 1});

						TweenMax.set(_extraBlock, {'width':0});
						TweenMax.set(_aniItem, {'opacity':0, 'y':50});

						TweenMax.staggerTo(_extraBlock, _aniTimeUnit*2, {'width':100+'%', ease: _self.gEase, onComplete: function(){
							TweenMax.staggerTo(_aniItem, _aniTimeUnit*2, {'opacity':1, 'y':0}, _aniTimeUnit);
						}});

						scrollToSection(pIndex);

						_self.gCurrentIndex = pIndex;

					}else
					{
						TweenMax.staggerTo(_aniItem, _aniTimeUnit, {'opacity':0, onComplete: function()
						{
							TweenMax.staggerTo(_extraBlock, _aniTimeUnit, {'width':0+'%', ease: _self.gEase, onComplete: function(){
								_thisItem.removeClass('selected');
								_thisItemParent.css({'z-index' : ''});
								_self.gCurrentIndex = null;
							}});
						}});
					}
				}

				function buildSliderFn(pIndex)
				{
					var _aniTimeUnit = gTimeUnit;
					var _appendIndex = calculateRowNum(pIndex);

					$('.sliderItem', _self.target).removeClass('selected');
					$('.sliderItem[data-index="'+pIndex+'"]', _self.target).addClass('selected');

					//case - 1 New row
					if((_self.gCurrentIndex == null) && (_self.gCurrentRowIndex == null))
					{
						var _htmlSlider = null;
						_htmlSlider = '';
						_htmlSlider += sliderHTML(pIndex);

						$('.gridBox__row--expandSlider', _self.target).remove();
						$(_htmlSlider).insertAfter( $(".gridBox__item[data-index='"+_appendIndex+"']", _self.target) );

						scrollToSection(pIndex);

						var _sliderParent = $('.gridBox__row--expandSlider', _self.target);
						var _sliderInner = _sliderParent.find('.gridBox__row--expandSlider__inner');
						var _sliderInnerHeight = _sliderInner.outerHeight(true);

						TweenMax.set(_sliderParent, {height:0});

						TweenMax.staggerTo(_sliderParent, _aniTimeUnit*2, {'height':_sliderInnerHeight, ease: _self.gEase, onComplete: function(){
							setTimeout(function(){
								_sliderParent.css({'height' : 'auto'});
							},500);
							_self.gCurrentIndex = pIndex;
							_self.gCurrentRowIndex = _appendIndex;
						}});

						animateText();
					}

					//case - 2 Close row
					if(_self.gCurrentIndex == pIndex)
					{
						var _sliderParent = $('.gridBox__row--expandSlider', _self.target);
						var _sliderInner = _sliderParent.find('.gridBox__row--expandSlider__inner');
						var _sliderInnerHeight = _sliderInner.outerHeight(true);

						TweenMax.staggerTo(_sliderParent, _aniTimeUnit*2, {'height':0, ease: _self.gEase, onComplete: function(){
							_self.gCurrentIndex = null;
							_self.gCurrentRowIndex = null;

							$('.sliderItem[data-index="'+pIndex+'"]', _self.target).removeClass('selected');
						}});
					}

					//case - 3 Close row
					if((_self.gCurrentIndex != pIndex) && (_self.gCurrentRowIndex == _appendIndex))
					{
						var _sliderParent = $('.gridBox__row--expandSlider', _self.target);
						var _sliderInner = _sliderParent.find('.gridBox__row--expandSlider__inner');
						var _sliderInnerHeight = _sliderInner.outerHeight(true);

						var _sliderBg = $('.gridBox__row--expandSlider__bg', _self.target);

						_sliderBg.find('.inner').fadeOut(function(){
							var _this = $(this);
							_this.css('background-image', 'url("'+_self.gArray[pIndex].slider_bg+'")');
							_sliderBg.find('.inner').fadeIn();
						});

						var _htmlSliderInner = null;
						_htmlSliderInner = '';
						_htmlSliderInner += sliderInnerHTML(pIndex, true);

						$(_htmlSliderInner).insertAfter($(".gridBox__row--expandSlider__content", _self.target));

						scrollToSection(pIndex);

						var _appendBox = $('.gridBox__row--expandSlider__content', _self.target).eq(0);
						var _newAppendBox = $('.gridBox__row--expandSlider__content.append', _self.target);

						var _newAppendBoxHeight = _newAppendBox.outerHeight(true);
						var _paddingTopHeight = $(".gridBox__row--expandSlider__inner").css("padding-top").replace("px", "");
						var _paddingBottomHeight = $(".gridBox__row--expandSlider__inner").css("padding-bottom").replace("px", "");

						var _newHeight = _newAppendBoxHeight+parseFloat(_paddingTopHeight)+parseFloat(_paddingBottomHeight);

						_newAppendBox.css({
							'position' : 'absolute','top' : 0,'opacity' : 0
						});

						TweenMax.set(_sliderParent, {height:_sliderInnerHeight});
						TweenMax.staggerTo(_sliderParent, _aniTimeUnit*2, {height:_newHeight, ease: _self.gEase, onComplete: function(){
							setTimeout(function(){
								_sliderParent.css({'height' : 'auto'});
							},500);
						}});

						_appendBox.fadeOut(500,function()
						{
							_appendBox.remove();

							_appendBox = $('.gridBox__row--expandSlider__content', _self.target);
							var _appendBoxAni = $('.gridBox__row--expandSlider__content', _self.target).find('.ani');

							$.each(_appendBoxAni,function(_i, _el){
								TweenMax.set(_appendBoxAni, {y:20*(_i+1), opacity:0});
							});

							_newAppendBox.css({
								'position' : 'relative','top' : '','opacity' : 1
							});

							_newAppendBox.removeClass('append');

							TweenMax.staggerTo(_appendBoxAni, _aniTimeUnit*2, {y:0, opacity:1, ease: Power1.easeOut}, _aniTimeUnit);

							_self.gCurrentIndex = pIndex;
							_self.gCurrentRowIndex = _appendIndex;
						});
					}

					//case4 - Different row
					if((_self.gCurrentIndex != null) && (_self.gCurrentRowIndex != null))
					{
						if((_self.gCurrentIndex != pIndex) && (_self.gCurrentRowIndex != _appendIndex))
						{
							var _sliderParent = $('.gridBox__row--expandSlider', _self.target);
							var _sliderInner = _sliderParent.find('.gridBox__row--expandSlider__inner');
							var _sliderInnerHeight = _sliderInner.outerHeight(true);

							TweenMax.staggerTo(_sliderParent, _aniTimeUnit*2, {height:0, ease: _self.gEase, onComplete: function(){

								scrollToSection(pIndex);

								var _htmlSlider = null;
								_htmlSlider = '';
								_htmlSlider += sliderHTML(pIndex);

								$('.gridBox__row--expandSlider', _self.target).remove();
								$(_htmlSlider).insertAfter( $(".gridBox__item[data-index='"+_appendIndex+"']", _self.target) );

								var _sliderParent = $('.gridBox__row--expandSlider', _self.target);
								var _sliderInner = _sliderParent.find('.gridBox__row--expandSlider__inner');
								var _sliderInnerHeight = _sliderInner.outerHeight(true);

								TweenMax.set(_sliderParent, {height:0});

								TweenMax.staggerTo(_sliderParent, _aniTimeUnit*2, {'height':_sliderInnerHeight, ease: _self.gEase, onComplete: function(){
									setTimeout(function(){
										_sliderParent.css({'height' : 'auto'});
									},500);
									_self.gCurrentIndex = pIndex;
									_self.gCurrentRowIndex = _appendIndex;
								}});

								animateText();

							}});

							_self.gCurrentIndex = pIndex;
							_self.gCurrentRowIndex = _appendIndex;
						}
					}

				}

				function scrollToSection(pIndex)
				{
					var _scrollTopVal = $('.gridBox__item[data-index="'+pIndex+'"]', _self.target).offset().top - $('.logoBar_page_common').outerHeight(true);

					$("html, body").animate({
			        scrollTop: _scrollTopVal
			    }, 400);
				}

				function animateText()
				{
					var _aniTimeUnit = gTimeUnit;

					var _appendBox = $('.gridBox__row--expandSlider__content', _self.target);
					var _appendBoxAni = $('.gridBox__row--expandSlider__content', _self.target).find('.ani');

					$.each(_appendBoxAni,function(_i, _el){
						TweenMax.set(_appendBoxAni, {y:20*(_i+1), opacity:0});
					});

					TweenMax.staggerTo(_appendBoxAni, _aniTimeUnit*2, {delay:_aniTimeUnit*2, y:0, opacity:1, ease: Power1.easeOut}, _aniTimeUnit);
				}

				function calculateRowNum(pIndex)
				{
					if(layout == "desktop")
					{
						var _appendIndex = (Math.floor(pIndex/_self.settings.responsive_d)*_self.settings.responsive_d)+(_self.settings.responsive_d-1);
						_appendIndex = Math.min(_appendIndex, _self.gArray.length-1);
					}

					if(layout == "tablet")
					{
						var _appendIndex = (Math.floor(pIndex/_self.settings.responsive_t)*_self.settings.responsive_t)+(_self.settings.responsive_t-1);
						_appendIndex = Math.min(_appendIndex, _self.gArray.length-1);
					}

					if(layout == "mobile")
					{
						var _appendIndex = (Math.floor(pIndex/_self.settings.responsive_m)*_self.settings.responsive_m)+(_self.settings.responsive_m-1);
						_appendIndex = Math.min(_appendIndex, _self.gArray.length-1);
					}

					return _appendIndex;
				}

				function sliderInnerHTML(pIndex, isAppend)
				{
					var _innerHtml = null;

					_innerHtml = '';

					if(isAppend)
					{
						_innerHtml += '		<div class="gridBox__row--expandSlider__content append">';
					}else
					{
						_innerHtml += '		<div class="gridBox__row--expandSlider__content">';
					}

					_innerHtml += '			<h2 class="ani">'+_self.gArray[pIndex].title+'</h2>';
					_innerHtml += '			<p class="ani">'+_self.gArray[pIndex].message+'</p>';
					_innerHtml += '			<div class="btnWrapper ani">';
					_innerHtml += '				<a href="'+_self.gArray[pIndex].btn_link+'" class="btn__s1">';
					_innerHtml += '					<span class="ghost">';
					_innerHtml += '					</span><span class="text">'+_self.gArray[pIndex].btn+'</span>';
					_innerHtml += '				</a>';
					_innerHtml += '			</div>';
					_innerHtml += '		</div>';

					return _innerHtml;
				}

				function sliderHTML(pIndex)
				{
					var _html = null;

					_html = '';

					_html += '<div class="gridBox__row gridBox__row--expandSlider">';

					_html += '	<div class="gridBox__row--expandSlider__bg">';
					_html += '		<div class="inner" style="background-image:url('+_self.gArray[pIndex].slider_bg+')"></div>';
					_html += '	</div>';

					_html += '	<div class="gridBox__row--expandSlider__inner">';

					_html += sliderInnerHTML(pIndex, false);

					_html += '	</div>';

					_html += '</div>';

					return _html;
				}

			}

			</script>

	</body>
</html>
