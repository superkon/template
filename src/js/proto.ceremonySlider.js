ceremonySlider.prototype.target = null;
ceremonySlider.prototype.settings = null;
ceremonySlider.prototype.gArray = null;
ceremonySlider.prototype.gEase = "Power3.easeInOut";

ceremonySlider.prototype.gCurrentIndex = null;
ceremonySlider.prototype.gCurrentInnerIndex = null;

function ceremonySlider(){}

ceremonySlider.prototype.init = function(pTarget, pArray, config)
{
  var _self = this;

  _self.target = pTarget;

  _self.gArray = [];
  _self.gArray = pArray;

  _self.settings = {

  };

  $.extend(_self.settings, config);

  _self.buildCeremonySlider();
  _self.bindCeremonySlider();
  _self.bindCeremonyInnerSlider();

};

ceremonySlider.prototype.buildCeremonySlider = function()
{
  var _self = this;

  for(var _i=0; _i<_self.gArray.length; _i++)
  {
    var _html = null;

    _html = '';
    _html +='<div class="ceremony__slider__section ceremony__slider__section--'+_i+'" data-color="'+_self.gArray[_i].section_color+'">';

    /****** header ******/
    _html +='<a href="javascript:void(0);" class="ceremony__slider__displayItem__wrapper" data-index="'+_i+'">';
    _html +='<span class="ceremony__slider__displayItem__inner">';

    if(typeof _self.gArray[_i].section_leadin !== "undefined")
    {
      _html +='	<span class="ceremony__slider__leadin">'+_self.gArray[_i].section_leadin+'</span>';
    }

    _html +='	<span class="ceremony__slider__title__wrapper">';
    _html +='		<span class="ceremony__slider__title"><span class="text">'+_self.gArray[_i].section_name+'</span><span class="ceremony__slider__dot dotAnimate"></span></span>';
    _html +='		<span class="ceremony__slider__stroke stroke--header"></span>';
    _html +='	</span>';
    _html +='	</span>';
    _html +='</a>';

    /****** content ******/

    _html +='<div class="ceremony__slider__showHideItem__wrapper" style="background-image:url('+_self.gArray[_i].section_bg+')">';
    _html +='<div class="ceremony__slider__showHideItem__inner">';

    _html +='	<div class="ceremony__slider__showHideItem__content">';
    _html +='		<div class="ceremony__slider__stroke"></div>';

    for(var _j=0; _j<_self.gArray[_i].items.length; _j++)
    {
      _html +='		<div class="ceremony__slider__sliderItem" data-parentindex="'+_i+'" data-index="'+_j+'">';

      _html +='			<a href="javascript:void(0);" class="ceremony__slider__sliderItem__title">';
      _html +='				<span class="ghost"></span><span class="vaMiddle text">'+_self.gArray[_i].items[_j].item_name+'<span></span>';
      _html +='					<span>（'+_self.gArray[_i].items[_j].item_name_remark+'）</span>';
      _html +='				</span>';
      _html +='			</a>';

      _html +='			<div class="ceremony__slider__sliderItem__message">';
      _html +='				<div class="ceremony__slider__sliderIco"><span class="ceremony__slider__sliderIco__arrow"></span></div>';
      _html +='				<div class="ceremony__slider__sliderList">';

      _html +='				<div class="ceremony__slider__sliderList__inner">';
      for(var _k=0; _k<_self.gArray[_i].items[_j].item_content.length; _k++)
      {
        _html +='<ul>';
        _html +='						<li data-type="tri">'+_self.gArray[_i].items[_j].item_content[_k].name;

        if(typeof _self.gArray[_i].items[_j].item_content[_k].children !== "undefined")
        {
          _html +='<ul>';
          for(var _l=0; _l<_self.gArray[_i].items[_j].item_content[_k].children.length; _l++)
          {
            _html +='						<li data-type="dot">'+_self.gArray[_i].items[_j].item_content[_k].children[_l].name;
            _html +='						</li>';
          }

          _html +='					<div class="clear"></div>';
          _html +='</ul>';
        }

        _html +='						</li>';

        _html +='					<div class="clear"></div>';
        _html +='</ul>';
      }
      _html +='				</div>';
      _html +='				</div>';
      _html +='			</div>';
      _html +='		</div>';
    }

    _html +='	</div>';
    _html +='</div>';
    _html +='</div>';



    _html +='</div>';

    _self.target.append(_html);
  }
};

ceremonySlider.prototype.bindCeremonySlider = function()
{
  var _self = this;

  var _btnHeader = $('.ceremony__slider__displayItem__wrapper', _self.target);

  _btnHeader.off('click').on('click', function(){

    var _this = $(this);

    var _expandOuter = _this.siblings('.ceremony__slider__showHideItem__wrapper');
    var _innerHeight = _expandOuter.find('.ceremony__slider__showHideItem__inner').outerHeight(true);
    var _aniTimeUnit = gTimeUnit;

    var _index = _this.data('index');

    _this.addClass('selected');

    //case 1 - new open
    if(_self.gCurrentIndex === null)
    {
      //slideDown
      TweenMax.set(_expandOuter, {height:0});
      TweenMax.staggerTo(_expandOuter, _aniTimeUnit*2, {'height':_innerHeight, ease: _self.gEase, onComplete: function(){
        setTimeout(function(){
          _expandOuter.css({'height' : 'auto'});
        },500);

        _self.gCurrentIndex = _index;
      }});

      scrollToSection(_index);

    }else if(_self.gCurrentIndex == _index)
    {
      //case 2 - close

      TweenMax.staggerTo(_expandOuter, _aniTimeUnit*2, {'height':0, ease: _self.gEase, onComplete: function(){
        _self.gCurrentIndex = null;
        _this.removeClass('selected');
        gCeremonySlider.destroyCeremonyInnerSlider(); //close small tag

      }});
    }else if((_self.gCurrentIndex !== null) && (_self.gCurrentIndex !== _index))
    {
      //case 3 - open with different tag

      var _previousHeader = $('.ceremony__slider__section--'+_self.gCurrentIndex).find('.ceremony__slider__displayItem__wrapper');
      var _previousExpandOuter = $('.ceremony__slider__section--'+_self.gCurrentIndex).find('.ceremony__slider__showHideItem__wrapper');

      _previousHeader.removeClass('selected');
      gCeremonySlider.destroyCeremonyInnerSlider(); //close small tag

      TweenMax.staggerTo(_previousExpandOuter, _aniTimeUnit*2, {'height':0, ease: _self.gEase, onComplete: function(){

        //slideDown
        TweenMax.set(_expandOuter, {height:0});

        TweenMax.staggerTo(_expandOuter, _aniTimeUnit*2, {'height':_innerHeight, ease: _self.gEase, onComplete: function(){
          setTimeout(function(){
            _expandOuter.css({'height' : 'auto'});
          },500);

          _self.gCurrentIndex = _index;

          scrollToSection(_index);
        }});

      }});

    }
  });

  $('.logoBar__menuItem__btnMenu').off('click').on('click', function(){

    var _index = $(this).data('index');

    $('.ceremony__slider__displayItem__wrapper[data-index="'+_index+'"]', _self.target).trigger('click');
  });

  function scrollToSection(pIndex)
  {
    var _scrollTopVal = $('.ceremony__slider__section--'+pIndex, _self.target).find('.ceremony__slider__title').offset().top - 200;

    $("html, body").animate({
        scrollTop: _scrollTopVal
    }, 400);
  }
};

ceremonySlider.prototype.destroyCeremonyInnerSlider = function()
{
  var _self = this;

  if(_self.gCurrentInnerIndex !== null)
  {
    var _parent = $('.ceremony__slider__sliderItem[data-index="'+_self.gCurrentInnerIndex+'"]', _self.target);
    var _siblings = _parent.find('.ceremony__slider__sliderItem__message').find('.ceremony__slider__sliderList');

    TweenMax.set(_siblings, {height:0});

    _parent.removeClass('selected');

    _self.gCurrentInnerIndex = null;
  }
};

ceremonySlider.prototype.bindCeremonyInnerSlider = function()
{
  var _self = this;
  var _aniTimeUnit = gTimeUnit;

  $('.ceremony__slider__sliderItem__title', _self.target).on('click', function()
  {
    var _this = $(this);
    var _parent = _this.parent('.ceremony__slider__sliderItem');
    var _siblings = _this.siblings('.ceremony__slider__sliderItem__message').find('.ceremony__slider__sliderList');
    var _innerHeight = _siblings.find('.ceremony__slider__sliderList__inner').outerHeight(true);

    var _index = _parent.data('index');

    _parent.addClass('selected');

    //case 1 - new open
    if(_self.gCurrentInnerIndex === null)
    {
      TweenMax.set(_siblings, {height:0});
      TweenMax.staggerTo(_siblings, _aniTimeUnit*2, {'height':_innerHeight, ease: _self.gEase, onComplete: function(){
        setTimeout(function(){
          _siblings.css({'height' : 'auto'});
        },500);
        _self.gCurrentInnerIndex = _index;
      }});

      scrollToSection();

    }else if(_self.gCurrentInnerIndex === _index)
    {
      TweenMax.staggerTo(_siblings, _aniTimeUnit*2, {'height':0, ease: _self.gEase, onComplete: function(){
        _parent.removeClass('selected');
        _self.gCurrentInnerIndex = null;
      }});

    }else if((_self.gCurrentInnerIndex !== null) && (_self.gCurrentInnerIndex !== _index))
    {
        //slideUp
        var _previousSlider = $('.ceremony__slider__section--'+_self.gCurrentIndex).find('.ceremony__slider__sliderItem[data-index="'+_self.gCurrentInnerIndex+'"]');
        var _previousExpandOuter = _previousSlider.find('.ceremony__slider__sliderList');

        _previousSlider.removeClass('selected');

        TweenMax.staggerTo(_previousExpandOuter, _aniTimeUnit*2, {'height':0, ease: _self.gEase, onComplete: function()
        {
          TweenMax.set(_siblings, {height:0});
          TweenMax.staggerTo(_siblings, _aniTimeUnit*2, {'height':_innerHeight, ease: _self.gEase, onComplete: function()
          {
            setTimeout(function(){
              _siblings.css({'height' : 'auto'});
            },500);

            _self.gCurrentInnerIndex = _index;
          }});

          scrollToSection();

        }});
    }
  });

  function scrollToSection()
  {
    var _scrollTopVal = $('.ceremony__slider__sliderItem.selected').offset().top - $('.logoBar').outerHeight(true)-50;

    $("html, body").animate({
        scrollTop: _scrollTopVal
    }, 400);
  }
};
