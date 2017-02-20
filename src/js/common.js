var gEase = "Power3.easeInOut";
var gTimeUnit = 0.25;

var mResponsive = null;
var mMenuControler = null;

var gGradientBG_timer = null;

/********** hideLoading **********/
$(window).on('load',function(){

});

function common_fn()
{
	$("body").removeClass("preload");

	gradientLoading();

	initLoading();

	setTimeout(function(){

		if(gGradientBG_timer !== null)
		{
			clearTimeout(gGradientBG_timer);
		}
		hideLoading(hideLoadingCallback);
	},1000);

	/********** setting **********/
	//detectBroswer();
	preventCss3Transition();

	/********** responsive **********/
	mResponsive = new responsive({
		layoutSize : [0, 760, 1200],
		layoutType: ["mobile", "tablet", "desktop"]
	});

	$(document).on('responsive',function(){
		preventCss3Transition();
	});

	/********** menuControler **********/
	menuControl();
	menuColorFn();
	langControl();

	/********** popup **********/
	closePop();

	$('.tnc').on('click',function(){
		popup($('.popupWrapper.tncPop'),{
			mainClass: 'mfp-slide-bottom'
		});
	});

	/********** btn__menu__scroll adv. **********/

	$('.btn__menu__scroll').on('click', function()
	{
		if($(this).data('index') == "ad")
		{
			var _scrollNum = $('.promotionAd__wrapper__stroke').offset().top - $('.logoBar').outerHeight(true);
			$("html, body").animate({
					scrollTop: _scrollNum
			});
		}
	});

}

function gradientLoading()
{
	var colors = new Array(
  [174,10,59],
  [251,213,213],
	[174,10,59],
  [253,87,87],
	[174,10,59],
  [253,87,87]);

	var step = 0;
	var colorIndices = [0,1,2,3];

	//transition speed
	var gradientSpeed = 0.002;

	function updateGradient()
	{

	  if ( $===undefined ) return;

		var c0_0 = colors[colorIndices[0]];
		var c0_1 = colors[colorIndices[1]];
		var c1_0 = colors[colorIndices[2]];
		var c1_1 = colors[colorIndices[3]];

		var istep = 1 - step;
		var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
		var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
		var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
		var color1 = "rgb("+r1+","+g1+","+b1+")";

		var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
		var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
		var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
		var color2 = "rgb("+r2+","+g2+","+b2+")";

		 $('#gradient').css({
		   background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
		    background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});

		  step += gradientSpeed;
		  if ( step >= 1 )
		  {
		    step %= 1;
		    colorIndices[0] = colorIndices[1];
		    colorIndices[2] = colorIndices[3];

		    //pick two new target color indices
		    //do not pick the same as the current one
		    colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
		    colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;

		  }
	}

	gGradientBG_timer = setInterval(updateGradient,1);
}

function hideLoadingCallback()
{
	//popupAlert({msg: "error message"});
}

function shuffle(array)
{
  var currentIndex = array.length, temporaryValue, randomIndex;

  while (0 !== currentIndex)
  {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }
  return array;
}

var menuColorArray = [];

var gScrollTop = $(window).scrollTop();
var gWindowHeight = $(window).height();
var gScrollTop = $('').height();

function langControl()
{
	var _showHideWrapper = $('.header__langShift__showHideWrapper');
	var _item = _showHideWrapper.find('.btn_lang');
	var _aniTimeUnit = gTimeUnit;

	_showHideWrapper.hide();
	TweenMax.set(_item, {'y':-5, 'opacity': 0});

	bindLangControl();

	function bindLangControl()
	{
		$('.btn_lang_display').on('click', function()
		{
			$(this).off('click');
			if (!_showHideWrapper.is(":visible"))
			{
				_showHideWrapper.show();
				TweenMax.staggerTo(_item, _aniTimeUnit*0.5, {'y':0, 'opacity': 1, ease: Power0.easeNone});
				bindLangControl();
			}else
			{
				TweenMax.staggerTo(_item, _aniTimeUnit*0.5, {'y':-5, 'opacity': 0, ease: Power0.easeNone});
				setTimeout(function(){
				 	_showHideWrapper.hide();
					bindLangControl();
				}, 500);
			}
		});
	}

}

var _pageHeight = window.innerHeight;
var _contentHeight = $('.contentWrapper').outerHeight(true);
var _heightIndex = _contentHeight-_pageHeight;

function menuControl()
{
	//var _pageHeight = null;
	$('.header__btn_menu').on('click', function()
	{
		$('body').toggleClass('menuOpen');

		var _headerMenu = $('.header__menu');
		var _headerMenuInner = $('.header__menu__inner');

		var _isMenuOpen = $('body').hasClass('menuOpen');
		var _headerMenuInner_h = _headerMenuInner.outerHeight(true);
		var _aniTimeUnit = gTimeUnit;

		if(_isMenuOpen)
		{
			TweenMax.set(_headerMenu, {'height' : 0});
			TweenMax.staggerTo(_headerMenu, 2*_aniTimeUnit, {'height' : _headerMenuInner_h, ease: gEase});
		}else
		{
			TweenMax.staggerTo(_headerMenu, 2*_aniTimeUnit, {'height' : 0, ease: gEase});
		}
	});

	$(window).on('resize', function(){
		_pageHeight = window.innerHeight;
		_contentHeight = $('.contentWrapper').outerHeight(true);
	});

	$(window).on('scroll', function()
	{
		var _scrollTop = $(window).scrollTop();
		var _logoBarTop = null;

		var _logoBarHeight = $('.logoBar').height();

		_logoBarTop = $('.logoBar__checker').offset().top;

		if($('.logoBar__checker').length > 0)
		{
			if(_scrollTop > _logoBarTop)
			{
				$('body').addClass('fixedMenu');

				//$('.contentWrapper__main').css("transform","translate3d(0px, "+_logoBarHeight+"px, 0px)");

				$('.contentWrapper__main').css({
					'padding-top' : $('.logoBar').height()
				});

			}else
			{
				$('body').removeClass('fixedMenu');

				//$('.contentWrapper__main').css("transform","translate3d(0px, 0px, 0px)");

				$('.contentWrapper__main').css({
					'padding-top' : ''
				});
			}
		}

		bottomAd(_scrollTop);
		aboutMenu(_scrollTop);


	});
}

function aboutMenu(_scrollTop)
{
	//bottom Ad Banner

	if($('.wrapper').hasClass('about'))
	{
		_menuWrapperHeight = $('.about__message__wrapper--1').offset().top -60;

		console.log(_scrollTop, _menuWrapperHeight);

		if(_scrollTop > _menuWrapperHeight)
		{
			$('.aboutBanner__menuWrapper').addClass('fixed');
		}else
		{
			$('.aboutBanner__menuWrapper').removeClass('fixed');
		}
	}
}


function bottomAd(_scrollTop)
{
	//bottom Ad Banner

	if($('.wrapper').hasClass('bottomAd'))
	{
		_pageHeight = window.innerHeight;
		_contentHeight = $('.contentWrapper').outerHeight(true);
		_heightIndex = _contentHeight-_pageHeight;

		if(_scrollTop > _heightIndex)
		{
			$('.wrapper').addClass('fixedAdBanner');
		}else
		{
			$('.wrapper').removeClass('fixedAdBanner');
		}
	}
}

function menuColorFn()
{
	menuColorSetting();

	$(window).on('responsive', function(){
		menuColorSetting();
	});

	$('.header').addClass(menuColorArray[0].color);

	$(window).on('scroll', function()
	{
		var _scrollTop = $(window).scrollTop();

		if((_scrollTop > menuColorArray[0].top) && (_scrollTop < menuColorArray[1].top))
		{
			$('.header').removeClass('white').removeClass('red').removeClass('golden');
			$('.header').addClass(menuColorArray[0].color);
		}

		if(_scrollTop > menuColorArray[1].top)
		{
			$('.header').removeClass('white').removeClass('red').removeClass('golden');
			$('.header').addClass(menuColorArray[1].color);
		}

	});

	function menuColorSetting()
	{
		menuColorArray = [];

		$.each($('.menuColor__item'), function(_i, _el)
		{
			var _this = $(_el);
			var _currentColor = _this.data('menucolor');

			var _obj = {};

			_obj.target = _this;
			_obj.color = _currentColor;
			_obj.top = _this.offset().top;

			menuColorArray.push(_obj);
		});
	}
}
