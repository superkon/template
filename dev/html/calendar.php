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

		<div class="wrapper calendar">

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
									<?=showContent(array("mainmenu", "calendar"))?>
								</p>
							</div>
						</div>

						<div class="contentWrapper__main calendar__wrapper proto__sk_calendar">

							<!-- month display -->
							<div class="calendar__display__month"></div>

							<div class="calendar__outerWrapper">
								<div class="calendar__main np dCoGrid-3-4 tCoGrid-2-3 mCoGrid-1-1">
									<div class="calendar__main__inner">
										<div class="calendar__display">
											<!-- calendar display -->
											<div class="calendar__display__calendar--noBorder ">
												<div class="calendar__display__weekWrapper"></div>
												<div class="calendar__display__dateWrapper"></div>
											</div>
										</div>
									</div>
								</div><div class="calendar__main__content np dCoGrid-1-4 tCoGrid-1-3 mCoGrid-1-1">
									<div class="lunar__header__wrapper">
										<div class="lunar__header__date">
											<span class="lunar__header__svg">
												<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c4.svg")); ?>
											</span>
										</div><div class="lunar__header__details">
											<span class="ghost">
											</span><h3 class="vaMiddle"></h3>
										</div>
									</div>
									<div class="lunar__prosCons__wrapper">

										<div class="lunar__prosCons--pros">
											<div class="lunar__prosCons__icons--pros">
												<span class="lunar__prosCons__svg">
													<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/icon_tick.svg")); ?>
												</span>
											</div>
											<div class="lunar__prosCons__message">
												<h3>嫁娶 簽約 訂盟</h3>
												<p>己不破券二比並亡<br/>已不遠行財物伏藏<br/>己不破券二比並亡</p>
											</div>
										</div>

										<div class="lunar__prosCons--cons">
											<div class="lunar__prosCons__icons--pros">
												<span class="lunar__prosCons__svg">
													<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/icon_cross.svg")); ?>
												</span>
											</div>
											<div class="lunar__prosCons__message">
												<h3>破土 安葬</h3>
												<p>己不破券二比並亡<br/>已不遠行財物伏藏<br/>己不破券二比並亡</p>
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>

					<!-- Footer -->
					<?php include"include/footer.php" ?>

					<div id="content"></div>

				</div>
			</div>
		</div>

		<?php include"include/popup.php" ?>

		<script src="../js/vendor.min.js"></script>
		<script src="../js/app.min.js"></script>

		<script type="text/javascript">
			var js_lang = <?php echo json_encode($langText["js"]); ?>;

			$(document).ready(init_fn);

			var gDateSVGArray =
			[{
				1: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c1.svg")); ?>',
			  2: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c2.svg")); ?>',
			  3: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c3.svg")); ?>',
			  4: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c4.svg")); ?>',
			  5: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c5.svg")); ?>',
			  6: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c6.svg")); ?>',
			  7: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c7.svg")); ?>',
			  8: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c8.svg")); ?>',
			  9: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c9.svg")); ?>',
			  10: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c10.svg")); ?>',
			  11: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c11.svg")); ?>',
			  12: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c12.svg")); ?>',
			  13: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c13.svg")); ?>',
			  14: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c14.svg")); ?>',
			  15: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c15.svg")); ?>',
			  16: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c16.svg")); ?>',
			  17: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c17.svg")); ?>',
			  18: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c18.svg")); ?>',
			  19: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c19.svg")); ?>',
			  20: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c20.svg")); ?>',
			  21: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c21.svg")); ?>',
			  22: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c22.svg")); ?>',
			  23: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c23.svg")); ?>',
			  24: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c24.svg")); ?>',
			  25: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c25.svg")); ?>',
			  26: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c26.svg")); ?>',
			  27: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c27.svg")); ?>',
			  28: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c28.svg")); ?>',
			  29: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c29.svg")); ?>',
			  30: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c30.svg")); ?>',
			  31: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/digi-c31.svg")); ?>'
			}];

			var gLunarDateSVGArray =
			[{
			  1: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c1.svg")); ?>',
			  2: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c2.svg")); ?>',
			  3: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c3.svg")); ?>',
			  4: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c4.svg")); ?>',
			  5: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c5.svg")); ?>',
			  6: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c6.svg")); ?>',
			  7: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c7.svg")); ?>',
			  8: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c8.svg")); ?>',
			  9: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c9.svg")); ?>',
			  10: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c10.svg")); ?>',
			  11: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c11.svg")); ?>',
			  12: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c12.svg")); ?>',
			  13: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c13.svg")); ?>',
			  14: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c14.svg")); ?>',
			  15: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c15.svg")); ?>',
			  16: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c16.svg")); ?>',
			  17: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c17.svg")); ?>',
			  18: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c18.svg")); ?>',
			  19: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c19.svg")); ?>',
			  20: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c20.svg")); ?>',
			  21: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c21.svg")); ?>',
			  22: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c22.svg")); ?>',
			  23: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c23.svg")); ?>',
			  24: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c24.svg")); ?>',
			  25: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c25.svg")); ?>',
			  26: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c26.svg")); ?>',
			  27: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c27.svg")); ?>',
			  28: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c28.svg")); ?>',
			  29: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c29.svg")); ?>',
			  30: '<?php echo str_replace(array("\n","\r"), "", file_get_contents("../images/calendar/lunar-digi-c30.svg")); ?>'
			}];

			gCalendar = null;

			function init_fn(pEvent)
			{
				common_fn();

				gCalendar = new sk_calendar();
				gCalendar.init($('.proto__sk_calendar'),{});
			}

			/*** wrapper ***/
			sk_calendar.prototype.target = null;
			sk_calendar.prototype.settings = null;
			sk_calendar.prototype.calendar__display__month = null;
			sk_calendar.prototype.calendar__display__weekWrapper = null;
			sk_calendar.prototype.calendar__display__dateWrapper = null;
			sk_calendar.prototype.lunar__header__date = null;
			sk_calendar.prototype.lunar__header__details = null;
			sk_calendar.prototype.prosMessage = null;
			sk_calendar.prototype.consMessage = null;

			/*** var ***/
			sk_calendar.prototype.maxNumOfRow = 6;
			sk_calendar.prototype.maxNumOfWeek = 7;

			sk_calendar.prototype.currentDate = null;
			sk_calendar.prototype.startDate = null;
			sk_calendar.prototype.endDate = null;
			sk_calendar.prototype.numberOfDate = null;

			sk_calendar.prototype.thisMonth = null;

			/*** array ***/
			sk_calendar.prototype.ajaxArray = null;

			/*** ease ***/
			sk_calendar.prototype.gEase = "Power3.easeInOut";

			/*** default Array ***/
			sk_calendar.prototype.solarWeek = ['日', '一', '二', '三', '四', '五', '六'];
			sk_calendar.prototype.lunarMonth = ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二'];
			sk_calendar.prototype.solarMonth = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
			sk_calendar.prototype.lunarDate = ['初一', '初二', '初三', '初四', '初五', '初六', '初七', '初八', '初九', '初十','十一', '十二', '十三', '十四', '十五', '十六', '十七', '十八', '十九', '二十','廿一', '廿二', '廿三', '廿四', '廿五', '廿六', '廿七', '廿八', '廿九', '三十'];

			var converter = new LunarSolarConverter();
			var solar = new Solar();

			function sk_calendar(){}

			sk_calendar.prototype.init = function(pTarget, config)
			{
			  var _self = this;

			  _self.target = pTarget;

				_self.calendar__display__month = $('.calendar__display__month', _self.target);
				_self.calendar__display__weekWrapper = $('[class*="calendar__display__weekWrapper"]', _self.target);
				_self.calendar__display__dateWrapper = $('.calendar__display__dateWrapper', _self.target);

			  _self.settings = {
					'weekFormat' : ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'],
					'weekFormatDisplay' : ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
					'currentDate' : 'today'
			  };

			  $.extend(_self.settings, config);

				_self.getInitDate();
				_self.loadAjax(_self.currentDate);

				_self.calculateNumberOfDate(_self.currentDate);
				_self.buildCalenderFrame();
			};

			var initLoadDate = false;

			sk_calendar.prototype.loadAjax = function(pDate)
			{
				var _self = this;

				var _date = pDate;

				var _month = _date._d.getMonth() + 1;
				var _year = _date._d.getFullYear();

				$.ajax({
					url: '../api/calendar.php',
					data: {"month" : _month, "year" : _year, 'lang' : "<?=$lang?>"},
					type: 'GET',
					async: true,
					dataType: 'json',
					success: function(data)
					{
						if (data.status == 1){
							//if(_self.ajaxArray != null)
							//{
								_self.ajaxArray = [];
							//}
							_self.ajaxArray.push(data.data);

							if(!initLoadDate)
							{
									_self.initCurrentDate();
									initLoadDate = true;
							}
						}
					}
				});
			}

			sk_calendar.prototype.getInitDate = function()
			{
				var _self = this;

				/*** get today ***/
				if(_self.settings.currentDate == "today"){
					//_self.currentDate = moment('2017-03-03');
					_self.currentDate = moment();
				}
				//console.log(_self.currentDate, _self.currentDate._d.getDay());
			}

			sk_calendar.prototype.initCurrentDate = function()
			{
			  var _self = this;

				$('.c__column[data-date="'+_self.currentDate.format('YYYY-MM-DD')+'"]', _self.target).addClass('selected');

				_self.changeMonth(_self.currentDate);
				_self.changeRightContent(_self.currentDate);
			}

			sk_calendar.prototype.changeMonth = function(pDate)
			{
			  var _self = this;
				var _date = pDate;
				var _solarMonth = _self.lunarMonth[_date._d.getMonth()]+'月';
				var _solarMonthEn = _self.solarMonth[_date._d.getMonth()];
				var _solarYear = _date._d.getFullYear();

				_self.calendar__display__month = $('.calendar__display__month', _self.target);

				_self.calendar__display__month.find('h2 span.c_month').html(_solarMonth);
				_self.calendar__display__month.find('h2 span.e_month').html(_solarMonthEn+', '+_solarYear);
			}

			sk_calendar.prototype.changeRightContent = function(pDate)
			{
			  var _self = this;

				var _date = pDate;
				var _dateFormat = _date.format('YYYY-MM-DD');

				var _solarDate = _date._d.getDate();
				var _solarMonth = _date._d.getMonth()+1;
				var _solarWeek = _self.solarWeek[_date._d.getDay()];

				var _lunar = lunarConverter(_date);
				var _lunarDate = _self.lunarDate[_lunar.lunarDay-1];
				var _lunarMonth = _self.lunarMonth[_lunar.lunarMonth-1]+'月';

				_self.lunar__header__date = $('.lunar__header__date', _self.target);
				_self.lunar__header__details = $('.lunar__header__details', _self.target);
				_self.prosMessage = $('.lunar__prosCons--pros .lunar__prosCons__message', _self.target);
				_self.consMessage = $('.lunar__prosCons--cons .lunar__prosCons__message', _self.target);

				/****** change Date ******/
				_self.lunar__header__date.find('.lunar__header__svg').html(gDateSVGArray[0][_solarDate]);
				_self.lunar__header__details.find('h3').html(_solarMonth+'月'+_solarDate+'日 星期'+_solarWeek+'<br/>農曆'+_lunarMonth+_lunarDate);

				if(typeof _self.ajaxArray[0][_dateFormat] !== "undefined")
				{
					/****** change Message ******/
					_self.prosMessage.find('h3').html(_self.ajaxArray[0][_dateFormat]['good_title']);
					_self.prosMessage.find('p').html(_self.ajaxArray[0][_dateFormat]['good_message']);
					_self.consMessage.find('h3').html(_self.ajaxArray[0][_dateFormat]['bad_title']);
					_self.consMessage.find('p').html(_self.ajaxArray[0][_dateFormat]['bad_message']);
				}else
				{
					_self.prosMessage.find('h3').html(js_lang.calendar_no_data);
					_self.prosMessage.find('p').html('');
					_self.consMessage.find('h3').html(js_lang.calendar_no_data);
					_self.consMessage.find('p').html('');
				}
			}

			sk_calendar.prototype.calculateNumberOfDate = function(pDate)
			{
				var _self = this;

				var _date = pDate;

				_self.startDate = _date.clone().startOf('month');
				_self.endDate = _date.clone().add(1,'M').startOf('month').subtract(1,'d');
				_self.numberOfDate = _date.daysInMonth();
			}

			sk_calendar.prototype.buildCalenderDate = function()
			{
			  var _self = this;

				/*** reset ***/
				$('.text--date--inner', _self.target).html('');
				$('.text--lunar', _self.target).html('');
				$('.c__column', _self.target).attr('data-date', 'null');
				$('.c__column', _self.target).removeClass('selected');

				for(var _k=0; _k<_self.numberOfDate; _k++)
				{
					var _tempDate = _self.startDate.clone().add(_k,'d');
					var _row = Math.ceil((_tempDate._d.getDate()+_self.startDate._d.getDay())/7)-1;
					var _column = _tempDate._d.getDay();

					/*** find Column ***/
					var _itemWrapper = $('.calendar__row[data-rowindex='+_row+']', _self.target).find('.c__column[data-week='+_self.settings.weekFormat[_column]+']');
					var _tempLunarDate = lunarConverter(_tempDate);

					_itemWrapper.attr('data-date', _tempDate.format('YYYY-MM-DD'));

					/*** add Date ***/
					_itemWrapper.find('.text--date--inner').html(gDateSVGArray[0][_tempDate._d.getDate()]);
					_itemWrapper.find('.text--lunar').html(gLunarDateSVGArray[0][_tempLunarDate.lunarDay]);
				}

				_self.bindCalendarDate();
			}

			sk_calendar.prototype.bindCalendarDate = function()
			{
			  var _self = this;

				$('.text--date', _self.target).off('click').on('click', function(){

					var _parent = $(this).parents('.c__column');
					var _currentDate = _parent.attr("data-date");

					console.log($(this), _parent.html(), _currentDate);

					if (_currentDate !== null)
					{
						var _date = moment(_currentDate);
						_self.changeRightContent(_date);

						$('.c__column', _self.target).removeClass('selected');
						_parent.addClass('selected');

						_self.currentDate = _date;
					}

				});

			}

			sk_calendar.prototype.buildCalenderFrame = function()
			{
			  var _self = this;

				_self.calendar__display__month.append(buildMonthHTML());
				_self.calendar__display__weekWrapper.append(buildWeekHTML());

				/*** build the row ***/
				_self.calendar__display__dateWrapper.append(buildRowHTML());

				for(var _j=0; _j<_self.maxNumOfRow; _j++){
					$('.calendar__row[data-rowindex="'+_j+'"]', _self.target).append(buildItemHTML());
				}

				/*** build the item ***/
				_self.buildCalenderDate();

				function buildItemHTML()
				{
					var _html = null;
					_html = '';

					for(var _i=0; _i<_self.maxNumOfWeek; _i++)
					{
						_html += '<div class="c__column" data-week="'+_self.settings.weekFormat[_i]+'" data-date="null">';
						_html += '  <span class="c__column__inner">';
						_html += '    <a href="javascript:void(0);" class="text--date">';
						_html += '      <span class="text--date--inner"></span>';
						_html += '    </a>';
						_html += '    <span class="text--lunar"></span>';
						_html += '  </span>';
						_html += '</div>';
					}

					return _html;
				}

				function buildRowHTML()
				{
					var _html = null;
					_html = '';

					for(var _i=0; _i<_self.maxNumOfRow; _i++)
					{
						_html += '<div class="calendar__row" data-rowindex="'+_i+'">';
						_html += '</div>';
					}

					return _html;
				}

				function buildWeekHTML()
				{
					var _html = null;
					_html = '';
					for(var _i=0; _i<_self.maxNumOfWeek; _i++)
					{
						_html += '<div class="c__column" data-week="'+_self.settings.weekFormat[_i]+'">';
						_html += '	<span class="c__column__inner">'+_self.settings.weekFormatDisplay[_i]+'</span>';
						_html += '</div>';
					}
					return _html;
				}

				function buildMonthHTML()
				{
					var _html = null;
					_html = '';

					_html += '	<a href="javascript:void(0);" class="btn__month--prev"><span class="stroke"></span>';
					_html += '	</a><a href="javascript:void(0);" class="btn__month--next"><span class="stroke"></span>';
					_html += '	</a><h2><span class="c_month"></span> <span class="e_month"></span></h2>';

					return _html;
				}

				_self.bindMonthArrow();
			};

			sk_calendar.prototype.bindMonthArrow = function()
			{
				var _self = this;

				_self.month_prev = $('.btn__month--prev', _self.target);
				_self.month_next = $('.btn__month--next', _self.target);

				_self.month_prev.off('click').on('click',function()
				{
					if(_self.thisMonth == null)
					{
						_self.thisMonth = _self.currentDate.clone();
					}
					_self.thisMonth = _self.thisMonth.subtract(1,'M').startOf('month');

					updateEvent(_self.thisMonth);
				});

				_self.month_next.off('click').on('click',function()
				{
					if(_self.thisMonth == null)
					{
						_self.thisMonth = _self.currentDate.clone();
					}
					_self.thisMonth = _self.thisMonth.add(1,'M').startOf('month');

					updateEvent(_self.thisMonth);
				});

				function updateEvent(pThisMonth)
				{
					_self.loadAjax(pThisMonth);
					_self.changeMonth(pThisMonth);
					//_self.calculateNumberOfDate(pThisMonth);
					_self.calculateNumberOfDate(pThisMonth);
					_self.buildCalenderDate();

					checkCurrentDate();
				}

				function checkCurrentDate()
				{
					$('.c__column[data-date="'+_self.currentDate.format('YYYY-MM-DD')+'"]', _self.target).addClass('selected');
				}
			}

			function lunarConverter(pDate)
			{
				solar.solarYear = pDate._d.getFullYear();
				solar.solarMonth = pDate._d.getMonth()+1;
				solar.solarDay = pDate._d.getDate();
				return converter.SolarToLunar(solar);
			}

			sk_calendar.prototype.destroy = function()
			{
				var _self = this;
			}

			</script>
	</body>
</html>
