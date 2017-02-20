$(document).ready(function(){

});

function warningMsg(title, msg){
	popupAlert({
		isClose:false,
		title:title,
		msg: msg,
		mainClass: 'mfp-slide-bottom',
		popAlertBtn:
		[
			{
				"text" : "Close",
				"cb": function()
				{
					$.magnificPopup.close();
				}
			}
		]
	});
}

function loadServer(url, data, callback){
	$.ajax({
		cache : false,
		url : url,
		dataType : 'json',
		type : 'post',
		async : true,
		data : data,
		success : function( result ){
			callback(result);
		}
	});
}

function showLoading(){
	$(".loading").show();
}

function hideLoading(){
	$(".loading").hide();
}

/*** Detail page ***/
/******************************
Copy lang button function
******************************/

function copyLang(from_lang, to_lang, no){

	if (confirm(js_lang[from_lang] + " > " + js_lang[to_lang] + "?")){
		if (lang_fields[no] != undefined){
			for (i=0; i<lang_fields[no].length;i++){
				field_name = lang_fields[no][i];

				from_field_name = field_name + "_" + from_lang;
				to_field_name = field_name + "_" + to_lang;

				from_field_obj = $("#"+from_field_name);
				to_field_obj = $("#"+to_field_name);

				if (from_field_obj.length > 0 && to_field_obj.length > 0){
					if (from_field_obj.is('select')){
						to_field_obj.val(from_field_obj.val());
					}else if (from_field_obj.is('textarea')){

						if (CKEDITOR.instances[from_field_name] != undefined){
							CKEDITOR.instances[to_field_name].setData(CKEDITOR.instances[from_field_name].getData());
						}else{
							to_field_obj.val(from_field_obj.val());
						}
					}else if (from_field_obj.is('input')){
						if (from_field_obj.attr("type") == "checkbox"){
							to_field_obj.prop('checked', from_field_obj.prop('checked'));
						}else{
							to_field_obj.val(from_field_obj.val());
						}
					}
				}
			}
		}
		warningMsg(js_lang["action"], js_lang["copy_success"]);
	}
}


/*** Detail page ***/
/******************************
Resize Image
******************************/
function detectUploadPhoto(pID)
{
		var _id = pID;
		var _this = $('.rowUploadPhoto[data-id="'+_id+'"]');
		var _img = _this.find('img');

		var _imgWidth = _img.outerWidth(true);
		var _imgHeight = _img.outerHeight(true);

		if(_imgWidth > _imgHeight){
			_img.removeClass('landscript').removeClass('vertical').addClass('landscript');
		}else
		{
			_img.removeClass('landscript').removeClass('vertical').addClass('vertical');
		}
}

/*** popup ***/
/******************************
POPUP
******************************/
function closePop(pTargetArray)
{
	if(typeof pTargetArray == "undefined")
	{
		pTargetArray = new Array();
		pTargetArray.push($('.popClose'));
	}

	var _targetArray = pTargetArray;

	for(_i=0; _i<_targetArray.length; _i++)
	{
		_targetArray[_i].off().on('click',function(){
			$.magnificPopup.close();
		});
	}
}

function popup(pTarget, config)
{
	var _settings =
	{
		items:{
			src: pTarget,
			type: 'inline'
		},
		showCloseBtn: false,
		closeOnBgClick: true,
		mainClass: 'mfp-zoom-in',
		fixedContentPos : true,
		fixedBgPos : true,
		removalDelay: 600,
		closeMarkup : '<button title="%title%" class="mfp-close"></button>'
	};

	$.extend(_settings, config);
	$.magnificPopup.open(_settings);
}

function popupAlert(setting, config)
{
	var _preSet =
	{
		target : $('.alertPop'),
		targetTitle : $('.alertPop .popAlertTitle h2'),
		targetText : $('.alertPop .popAlertMessage p'),
		targetBtn : $('.alertPop .popAlertBtnWrapper'),
		title: "Title",
		msg : "Text in here.",
		isClose: false,
		popAlertBtn:
		[
			{
				"text" : "textA",
				"cb": function()
				{
					alert("action for btnA");
				}
			},
			{
				"text" : "textB",
				"cb": function()
				{
					alert("action for btnA");
				}
			}
		]
	}

	//console.log(_preSet.popAlertBtn[1].callback);

	//_preSet.popAlertBtn_a.callback();

	$.extend(_preSet, setting);

	var _settings =
	{
		mainClass: 'mfp-slide-bottom',
		closeOnBgClick: _preSet.isClose,
		callbacks:
		{
			open: function(){
				_preSet.targetTitle.html(_preSet.title);
				_preSet.targetText.html(_preSet.msg);

				for(_i=0; _i<_preSet.popAlertBtn.length; _i++)
				{
					if(_i == _preSet.popAlertBtn.length-1)
					{
						_preSet.targetBtn.append('<button data-id="popBtn_'+_i+'" class="last" type="button" name="button">'+_preSet.popAlertBtn[_i].text+'</button>');
					}else
					{
						_preSet.targetBtn.append('<button data-id="popBtn_'+_i+'" type="button" name="button">'+_preSet.popAlertBtn[_i].text+'</button>');
					}
				}

				$('button[data-id="popBtn_0"]').on('click', function(){
					_preSet.popAlertBtn[0].cb();
				});

				$('button[data-id="popBtn_1"]').on('click', function(){
					_preSet.popAlertBtn[1].cb();
				});

			},
			close: function(){
				_preSet.targetTitle.html('');
				_preSet.targetText.html('');
				_preSet.targetBtn.html('');
			}
		}
	};

	$.extend(_settings, config);
	popup(_preSet.target, _settings);
}
