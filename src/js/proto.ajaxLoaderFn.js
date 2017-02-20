/********** ajaxLoaderFn **********/
ajaxLoaderFn.prototype.target = null;
ajaxLoaderFn.prototype.currentPage = 0;
ajaxLoaderFn.prototype.dataArray = null;

ajaxLoaderFn.prototype.appendArea = null;
ajaxLoaderFn.prototype.loadMoreWrapper = null;

ajaxLoaderFn.prototype.shareItem = null;

function ajaxLoaderFn(pTarget , pPage, config)
{
	var _self = this;

	_self.target = pTarget;

	_self.settings =
	{
		type : []
	};

	$.extend(_self.settings, config);

	// var _length = $.map(gEvent[0], function(n, i) { return i; }).length;
	//
	// if(_self.settings.type.length == _length)
	// {
	// 	_self.settings.type = [];
	// }

	// //console.log(_self.settings.type);
	//
	_self.currentPage = pPage;

	_self.appendArea = $('.itemAjaxWrapper', _self.target);
	_self.loadMoreWrapper = $('.loadMoreWrapper', _self.target);

	_self.dataArray = [];
	 //console.log("init", _self.dataArray);

	 //console.log(_self.type, _self.currentPage, _self.appendArea, _self.loadMoreWrapper)

	_self.init(pTarget);
}

ajaxLoaderFn.prototype.init = function(pTarget)
{
	var _self = this;

	_self.loadAjax();

	_self.loadMoreWrapper.find('.loadMore').off('click').on('click', function()
	{
		_self.currentPage++;
		_self.loadAjax();
	});

};

ajaxLoaderFn.prototype.destroy = function()
{
	var _self = this;

	_self.loadMoreWrapper.off('click');

	_self.appendArea.html('');
	_self.loadMoreWrapper.show();

	tempCounter = 0;
	counter = 0;

	_self.appendArea = null;
	_self.loadMoreWrapper = null;

	_self.dataArray = null;


	_self.currentPage = null;
	_self.target = null;
};

var tempCounter = 0;
var counter = 0;
var page = 0;

ajaxLoaderFn.prototype.loadAjax = function()
{
	var _self = this;

	$.ajax({
		url: '../api/news.php',
		data: {page: page, item_per_item: 3, lang:lang},
		type: 'GET',
		async: true,
		dataType: 'json',
		success: function(data)
		{

			if(data.basicInfo.isLastPage)
			{
				_self.loadMoreWrapper.hide();
			}

			page++;

			var _html = null;
			_html = "";

			$.each(data.items, function(_i, _el)
			{
				_self.dataArray.push(_el);
				_html += _self.buildLoadedContent(counter);
				counter++;
			});

			_self.appendArea.append(_html);

			for(var _i=tempCounter; _i<counter; _i++)
			{
				var _item = $('.news__item[data-index="'+_i+'"]', _self.target);
				TweenMax.set($('.news__item[data-index="'+_i+'"]', _self.target),{opacity: 0, y : "10%"});
			}

			var _delayCounter = 0;

			for(var _j=tempCounter; _j<counter; _j++)
			{
				var _tempItem = $('.news__item[data-index="'+_j+'"]', _self.target);
				var _delay = _delayCounter*0.1;

				TweenMax.staggerTo( _tempItem, 0.5,
				{
					y: "0%",
					opacity:1,
					delay: _delay,
					onComplete : function()
					{

					}
				});

				_delayCounter++;
			}

			var _scrollNum = $('.news__item[data-index="'+tempCounter+'"]', _self.target).offset().top - $('.logoBar').outerHeight(true) - 50;

			$("html, body").animate({scrollTop: _scrollNum}, 600);

			tempCounter = counter;




		}
	});
};

ajaxLoaderFn.prototype.buildLoadedContent = function(pIndex)
{
	var _self = this;
	var _html = null;

	_html = '';

	_html +='<div class="news__item" data-index="'+pIndex+'">';
	_html +='	<a href="javascript:void(0);" class="news__item__imgWrapper"><img class="img100" src="'+_self.dataArray[pIndex].img+'"/><span class="dim"></span></a>';
	_html +='	<div class="news__item__textWrapper">';
	_html +='		<h2>'+_self.dataArray[pIndex].title+'</h2>';
	_html +='		<div class="news__item__message">';
	_html +='			<p>'+_self.dataArray[pIndex].date+'</p>';
	_html +='			<p>'+_self.dataArray[pIndex].message+'</p>';
	_html +='		</div>';

	_html += '	<div class="btnWrapper">';
	_html += '		<a href="'+_self.dataArray[pIndex].btn_link+'" class="btn__s1 grey">';
	_html += '			<span class="ghost">';
	_html += '			</span><span class="text">'+_self.dataArray[pIndex].btn_text+'</span>';
	_html += '		</a>';
	_html += '	</div>';

	_html +='	</div>';
	_html +='	<div class="news__shareWrapper">';
	_html +='		<a class="news__share__ico" href="javascript:void(0);"></a>';
	_html +='	</div>';
	_html +='</div>';


	return _html;
};
