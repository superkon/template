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

		<div class="wrapper ceremony">

      <?php include"include/loading.php" ?>

			<div class="mainContentWrapper">
				<div class="innerContent">
					<!--- Header -->
					<?php include"include/header.php" ?>

					<!--- Content -->
					<div class="contentWrapper">

						<div class="menuColor__item commonBanner" data-menucolor="white">
							<div class="commonBanner__content" style="background-image:url('../images/banner/pageBanner.jpg') "></div>
						</div>

						<div class="menuColor__item logoBar__checker" data-menucolor="golden"></div>

						<div class="logoBar logoBar_page_common">
							<div class="logoBar__content">
								<span class="ghost">
								</span><div class="logoBar__logo">
										<?php echo file_get_contents("../images/common/logo.svg"); ?>
								</div><p class="logoBar__heading">
									傳統禮節
								</p><div class="logoBar__menuWrapper">
									<div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu" data-index="0">
											<span class="topStroke"></span>
											<span class="text">婚禮前</span>
										</a>
									</div><div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu" data-index="1">
											<span class="topStroke"></span>
											<span class="text">正婚禮</span>
										</a>
									</div><div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu" data-index="2">
											<span class="topStroke"></span>
											<span class="text">婚禮後</span>
										</a>
									</div><div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu" data-index="2">
											<span class="topStroke"></span>
											<span class="text">中國傳統婚嫁用品</span>
										</a>
									</div>
								</div>
							</div>
						</div>


						<div class="contentWrapper__main ceremony__wrapper">

							<div class="ceremony__headerBar">
								<div class="ceremony__headerBar__inner">
									<div class="ceremony__headerBar__title np dCoGrid-1-3 tCoGrid-1-3">
										<h2>三書六禮</h2>
									</div><div class="ceremony__headerBar__message np dCoGrid-2-3 tCoGrid-2-3">
										<p>
											「三書」、「六禮」是中國傳統婚嫁習俗禮儀。<br/>
											「三書」分別為聘書、禮書以及迎親書，為「六禮」中需要用到的文書。<br/>
											「六禮」是整個結婚的過程：納采、問名、納吉、納徵、請期及親迎，涵蓋了由求婚至完婚的禮儀。
										</p>
									</div>
								</div>
							</div>

							<div class="ceremony__slider__wrapper">
								<div class="ceremony__slider__tab__Wrapper">
									<a href="javascript:void(0);" class="btn__tabIcon selected">
										<span class="ghost"></span><span class="btn__tabIcon__text">傳統</span>
									</a><a href="javascript:void(0);" class="btn__tabIcon">
										<span class="ghost"></span><span class="btn__tabIcon__text">現代</span>
									</a>
								</div>
								<div class="ceremony__slider__content__Wrapper proto__ceremonySlider">
									<!-- proto slider -->
								</div>
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

			var gCeremonyContent =
			[
				{
					'section_id' : 0,
					'section_name' : '婚禮前',
					'section_color' : 'pink',
					'section_bg' : '../images/common/traditional.png',
					'section_leadin' : '<p>中國傳統婚嫁為每個家庭十分重要的大喜事，禮節「三書六禮」一絲不苟，具系統有條理。其流程可按時序分為三段流程：</p>',
					'items' :
					[
						{
							'id' : 0,
							'item_name' : "說媒提親",
							'item_name_remark' : "即「六禮」中的納采",
							'item_content':
							[
								{
									'name':'男家聘請媒人一同到女家，男方家長為其子向女方家長提親迎娶其千金，在父母之命及媒妁之言下明媒正娶。',
									'children' :
									[
										{
											'name' : "男家聘請媒人一同到"
										},
										{
											'name' : "男家聘請媒人一同到"
										},
										{
											'name' : "男家聘請媒人一同到"
										}
									]
								},
								{
									'name':'男家聘請媒人一同到女家，男方家長為其子向女方家長提親迎娶其千金，在父母之命及媒妁之言下明媒正娶。'
								},
								{
									'name':'男家聘請媒人一同到女家，男方家長為其子向女方家長提親迎娶其千金，在父母之命及媒妁之言下明媒正娶。'
								},
								{
									'name':'男家聘請媒人一同到女家，男方家長為其子向女方家長提親迎娶其千金，在父母之命及媒妁之言下明媒正娶。',
									'children' :
									[
										{
											'name' : "aaa"
										},
										{
											'name' : "aaa"
										},
										{
											'name' : "aaa"
										}
									]
								}
							]
						},
						{
							'id' : 1,
							'item_name' : "夾時辰八字問卜",
							'item_name_remark' : "即「六禮」中的問名",
							'item_content':
							[
								{
									'name':'說媒提親後，即交換男女雙方的出生時辰八字問卜，查看八字會否相沖，吉兆相合者男家與女家會「換庚譜」（即家譜）以示定親。'
								}
							]
						},
						{
							'id' : 2,
							'item_name' : "過文定",
							'item_name_remark' : "即「六禮」中的納吉",
							'item_content':
							[
								{
									'name':'定親後男家會擇一吉日，與媒人帶同三牲酒禮到女家送呈訂親之書（即「三書」中的聘書），過文定亦為過大禮之前奏。'
								}
							]
						},
						{
							'id' : 3,
							'item_name' : "過大禮",
							'item_name_remark' : "即「六禮」中的納徵",
							'item_content':
							[
								{
									'name':'為整個婚前禮最隆重的儀式，一般會在正婚吉日前一個月擇選吉日進行。男家會帶同聘禮如禮金、禮餅、禮物及祭品等，送呈過禮之書（即「三書」中的禮書）。禮品當中很多都是之後儀式需要用的，所有禮品及禮金均須為雙數以取好事成雙之意。以往過大禮當日未過門的新娘需離家避見男家的人，以免日後容易吵架，現在已改在房間迴避，禮品入門時不撞面已足夠。'
								}
							]
						},
						{
							'id' : 4,
							'item_name' : "女家回禮",
							'item_name_remark' : "即「六禮」中的納徵",
							'item_content':
							[
								{
									'name':'在過大禮的當天，除了男家會為女家送上聘禮外，女家亦會準備回禮禮物，一般是男家過大禮的禮物一半或若干，連同女家茶禮作為回禮。'
								}
							]
						}
					]
				},
				{
					'section_id' : 1,
					'section_name' : '正婚禮',
					'section_color' : 'golden',
					'section_bg' : 'https://dummyimage.com/1920x500/FC0/fff',
					'items' :
					[
						{
							'id' : 0,
							'item_name' : "說媒提親",
							'item_name_remark' : "即「六禮」中的納采",
							'item_content':
							[
								{
									'name':'男家聘請媒人一同到女家，男方家長為其子向女方家長提親迎娶其千金，在父母之命及媒妁之言下明媒正娶。'
								}
							]
						},
						{
							'id' : 1,
							'item_name' : "夾時辰八字問卜",
							'item_name_remark' : "即「六禮」中的問名",
							'item_content':
							[
								{
									'name':'說媒提親後，即交換男女雙方的出生時辰八字問卜，查看八字會否相沖，吉兆相合者男家與女家會「換庚譜」（即家譜）以示定親。'
								}
							]
						},
						{
							'id' : 2,
							'item_name' : "過文定",
							'item_name_remark' : "即「六禮」中的納吉",
							'item_content':
							[
								{
									'name':'定親後男家會擇一吉日，與媒人帶同三牲酒禮到女家送呈訂親之書（即「三書」中的聘書），過文定亦為過大禮之前奏。'
								}
							]
						},
						{
							'id' : 3,
							'item_name' : "過大禮",
							'item_name_remark' : "即「六禮」中的納徵",
							'item_content':
							[
								{
									'name':'為整個婚前禮最隆重的儀式，一般會在正婚吉日前一個月擇選吉日進行。男家會帶同聘禮如禮金、禮餅、禮物及祭品等，送呈過禮之書（即「三書」中的禮書）。禮品當中很多都是之後儀式需要用的，所有禮品及禮金均須為雙數以取好事成雙之意。以往過大禮當日未過門的新娘需離家避見男家的人，以免日後容易吵架，現在已改在房間迴避，禮品入門時不撞面已足夠。'
								}
							]
						},
						{
							'id' : 4,
							'item_name' : "女家回禮",
							'item_name_remark' : "即「六禮」中的納徵",
							'item_content':
							[
								{
									'name':'在過大禮的當天，除了男家會為女家送上聘禮外，女家亦會準備回禮禮物，一般是男家過大禮的禮物一半或若干，連同女家茶禮作為回禮。'
								}
							]
						}
					]
				},
				{
					'section_id' : 3,
					'section_name' : '婚禮後',
					'section_color' : 'pink',
					'section_bg' : 'https://dummyimage.com/1920x500/000/fff',
					'items' :
					[
						{
							'id' : 0,
							'item_name' : "說媒提親",
							'item_name_remark' : "即「六禮」中的納采",
							'item_content':
							[
								{
									'name':'男家聘請媒人一同到女家，男方家長為其子向女方家長提親迎娶其千金，在父母之命及媒妁之言下明媒正娶。'
								}
							]
						},
						{
							'id' : 1,
							'item_name' : "夾時辰八字問卜",
							'item_name_remark' : "即「六禮」中的問名",
							'item_content':
							[
								{
									'name':'說媒提親後，即交換男女雙方的出生時辰八字問卜，查看八字會否相沖，吉兆相合者男家與女家會「換庚譜」（即家譜）以示定親。'
								}
							]
						},
						{
							'id' : 2,
							'item_name' : "過文定",
							'item_name_remark' : "即「六禮」中的納吉",
							'item_content':
							[
								{
									'name':'定親後男家會擇一吉日，與媒人帶同三牲酒禮到女家送呈訂親之書（即「三書」中的聘書），過文定亦為過大禮之前奏。'
								}
							]
						},
						{
							'id' : 3,
							'item_name' : "過大禮",
							'item_name_remark' : "即「六禮」中的納徵",
							'item_content':
							[
								{
									'name':'為整個婚前禮最隆重的儀式，一般會在正婚吉日前一個月擇選吉日進行。男家會帶同聘禮如禮金、禮餅、禮物及祭品等，送呈過禮之書（即「三書」中的禮書）。禮品當中很多都是之後儀式需要用的，所有禮品及禮金均須為雙數以取好事成雙之意。以往過大禮當日未過門的新娘需離家避見男家的人，以免日後容易吵架，現在已改在房間迴避，禮品入門時不撞面已足夠。'
								}
							]
						},
						{
							'id' : 4,
							'item_name' : "女家回禮",
							'item_name_remark' : "即「六禮」中的納徵",
							'item_content':
							[
								{
									'name':'在過大禮的當天，除了男家會為女家送上聘禮外，女家亦會準備回禮禮物，一般是男家過大禮的禮物一半或若干，連同女家茶禮作為回禮。'
								}
							]
						}
					]
				},
				{
					'section_id' : 4,
					'section_name' : '中國傳統婚嫁用品',
					'section_color' : 'golden',
					'section_bg' : '../images/common/traditional.png',
					'items' :
					[
						{
							'id' : 0,
							'item_name' : "過文定",
							'item_name_remark' : "三牲酒禮",
							'item_content':
							[
								{
									'name':'雞：兩對，兩雌兩雄（如父母不全則一對已足夠）'
								},
								{
									'name':'豬肉：三至五斤起雙飛片，取其音「喜雙飛」'
								},
								{
									'name':'大魚或鯪魚：意有「腥」（聲）氣，亦有「有頭有尾，年年有餘」之寓意'
								},
								{
									'name':'酒：四支，代表愛情濃郁'
								}
							]
						},
						{
							'id' : 1,
							'item_name' : "夾時辰八字問卜",
							'item_name_remark' : "即「六禮」中的問名",
							'item_content':
							[
								{
									'name':'說媒提親後，即交換男女雙方的出生時辰八字問卜，查看八字會否相沖，吉兆相合者男家與女家會「換庚譜」（即家譜）以示定親。'
								}
							]
						},
						{
							'id' : 2,
							'item_name' : "過文定",
							'item_name_remark' : "即「六禮」中的納吉",
							'item_content':
							[
								{
									'name':'定親後男家會擇一吉日，與媒人帶同三牲酒禮到女家送呈訂親之書（即「三書」中的聘書），過文定亦為過大禮之前奏。'
								}
							]
						},
						{
							'id' : 3,
							'item_name' : "過大禮",
							'item_name_remark' : "即「六禮」中的納徵",
							'item_content':
							[
								{
									'name':'為整個婚前禮最隆重的儀式，一般會在正婚吉日前一個月擇選吉日進行。男家會帶同聘禮如禮金、禮餅、禮物及祭品等，送呈過禮之書（即「三書」中的禮書）。禮品當中很多都是之後儀式需要用的，所有禮品及禮金均須為雙數以取好事成雙之意。以往過大禮當日未過門的新娘需離家避見男家的人，以免日後容易吵架，現在已改在房間迴避，禮品入門時不撞面已足夠。'
								}
							]
						},
						{
							'id' : 4,
							'item_name' : "女家回禮",
							'item_name_remark' : "即「六禮」中的納徵",
							'item_content':
							[
								{
									'name':'在過大禮的當天，除了男家會為女家送上聘禮外，女家亦會準備回禮禮物，一般是男家過大禮的禮物一半或若干，連同女家茶禮作為回禮。'
								}
							]
						}
					]
				}

			];

			var gCeremonySlider = null;

			function init_fn(pEvent)
			{
				common_fn();

				gCeremonySlider = new ceremonySlider();
				gCeremonySlider.init($('.proto__ceremonySlider'), gCeremonyContent,{});
			}

			</script>

	</body>
</html>
