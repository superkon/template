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
									<?=showContent(array("mainmenu", "contactus"))?>
								</p><!--<div class="logoBar__menuWrapper">
									<div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu">
											<span class="topStroke"></span>
											<span class="text"><?=showContent(array("contactus", "menu", 0))?></span>
										</a>
									</div><div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu">
											<span class="topStroke"></span>
											<span class="text"><?=showContent(array("contactus", "menu", 1))?></span>
										</a>
									</div><div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu">
											<span class="topStroke"></span>
											<span class="text"><?=showContent(array("contactus", "menu", 2))?></span>
										</a>
									</div><div class="logoBar__menuItem">
										<a href="javascript:void(0);" class="logoBar__menuItem__btnMenu">
											<span class="topStroke"></span>
											<span class="text"><?=showContent(array("contactus", "menu", 3))?></span>
										</a>
									</div>
								</div>-->
							</div>
						</div>

						<div class="contentWrapper__main gridBox gridBox--contact">
							<div class="gridBox__wrapper">
								<!-- gridBox__row -->
								<div class="gridBox__row">
									<div class="gridBox__item np dCoGrid-3-5 tCoGrid-3-5 mCoGrid-1-1">
										<div class="gridBox__inner">

												<div class="mapWrapper" id="map"></div>

										</div>
									</div><div class="gridBox__item np dCoGrid-2-5 tCoGrid-2-5 mCoGrid-1-1">
										<div class="gridBox__inner">


												<div class="contact__information__wrapper">
													<span class="ghost onlyPD">
													</span><div class="vaMiddle m__wrapper--100">
														<div class="contact__items__title">
																<h2><?=$page_info['name']?></h2>
														</div><div class="contact__items__innerMessage">
															<p><?=$page_info['address']?></p>
															<p><?=$page_info['opening_hours']?></p>
															<div class="contact__information__list">
															<div class="contact__information__listItem">
																<span class="contact__information__icon">
																	<span class="ghost"></span><span class="text">T</span>
																</span>
																<a href="tel:+852 <?=$page_info['phone']?>" class="contact__information__text">
																	<?=$page_info['phone']?>
																</a>
															</div>
															<div class="contact__information__listItem">
																<span class="contact__information__icon">
																	<span class="ghost"></span><span class="text">E</span>
																</span>
																<a href="mainto:<?=$page_info['email']?>" class="contact__information__text">
																	<?=$page_info['email']?>
																</a>
															</div>
														</div>
														</div>
													</div>
												</div>

												<form id="contactusform">
												<div class="contact__form__wrapper">
													<div class="contact__items__title">
														<h2><?=showContent(array("contactus", "heading"))?></h2>
													</div><div class="contact__items__innerMessage">

														<p><?=showContent(array("contactus", "subheading"))?></p>
														<div class="formRow noLabel formRow__name">
															<label class="inputLabel" for="name"><?=showContent(array("contactus", "form", "name"))?></label>
															<div class="formContent">
																<input id="name" type="text" maxlength="100" placeholder="<?=showContent(array("contactus", "form", "name"))?>"/>
															</div>
															<div class="salutationWrapper">
																<a href="javascript:void(0);" class="btn_salutation selected male">
																	<span class="ghost"></span><span class="vaMiddle text"><?=showContent(array("contactus", "form", "male"))?></span>
																</a><a href="javascript:void(0);" class="btn_salutation female">
																	<span class="ghost"></span><span class="vaMiddle text"><?=showContent(array("contactus", "form", "female"))?></span>
																</a>
															</div>
														</div>

														<div class="formRow noLabel">
															<label class="inputLabel" for="name"><?=showContent(array("contactus", "form", "phone"))?></label>
															<div class="formContent">
																<input id="phone" type="text" maxlength="8" placeholder="<?=showContent(array("contactus", "form", "phone"))?>"/>
															</div>
														</div>

														<div class="formRow noLabel">
															<label class="inputLabel" for="name"><?=showContent(array("contactus", "form", "email"))?></label>
															<div class="formContent">
																<input id="email" type="text" maxlength="100" placeholder="<?=showContent(array("contactus", "form", "email"))?>"/>
															</div>
														</div>

														<div class="formRow noLabel">
															<label class="inputLabel" for="name"><?=showContent(array("contactus", "form", "remark"))?></label>
															<div class="formContent">
																<textarea id="remark" type="text" maxlength="100" placeholder="<?=showContent(array("contactus", "form", "remark"))?>"/></textarea>
															</div>
														</div>

														<div class="btnWrapper">
															<a href="javascript:void(0)" class="btn__send">
																<span class="text"><?=showContent(array("contactus", "form", "send"))?></span>
															</a>
														</div>
													</div>

												</div>
											</form>

										</div>
									</div>
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
			var js_lang = <?php echo json_encode($langText["js"]); ?>;

			$(document).ready(init_fn);

			var styleArray =
			[
				{elementType: 'geometry', stylers: [{color: '#bbb2a0'}]},
        {elementType: 'labels.text.stroke', stylers: [{color: ''}]},
        {elementType: 'labels.text.fill', stylers: [{color: '#2f3948'}]},
        {
          featureType: 'administrative.locality',
          elementType: 'labels.text.fill',
          stylers: [{color: '#d59563'}]
        },
        {
          featureType: 'poi',
          elementType: 'labels.text.fill',
          stylers: [{color: '#d59563'}]
        },
        {
          featureType: 'poi.park',
          elementType: 'geometry',
          stylers: [{color: '#6b6a58'}]
        },
        {
          featureType: 'poi.park',
          elementType: 'labels.text.fill',
          stylers: [{color: '#6b6a58'}]
        },
        {
          featureType: 'road',
          elementType: 'geometry',
          stylers: [{color: '#d9ccbb'}]
        },
        {
          featureType: 'road',
          elementType: 'geometry.stroke',
          stylers: [{color: '#d9ccbb'}]
        },
        {
          featureType: 'road',
          elementType: 'labels.text.fill',
          stylers: [{color: '#2f3948'}]
        },
        {
          featureType: 'road.highway',
          elementType: 'geometry',
          stylers: [{color: '#dacdba'}]
        },
        {
          featureType: 'road.highway',
          elementType: 'geometry.stroke',
          stylers: [{color: '#dacdba'}]
        },
        {
          featureType: 'road.highway',
          elementType: 'labels.text.fill',
          stylers: [{color: '#6b6a58'}]
        },
        {
          featureType: 'transit',
          elementType: 'geometry',
          stylers: [{color: '#6b6a58'}]
        },
        {
          featureType: 'transit.station',
          elementType: 'labels.text.fill',
          stylers: [{color: '#d59563'}]
        }
			];

			var myLatlng = {lat: <?php echo $page_info["latitude"]; ?>, lng: <?php echo $page_info["longitude"]; ?>};

			function init_fn(pEvent)
			{
				common_fn();

				$(".btn_salutation").on('click', function(){

					$(this).addClass('selected').siblings('.btn_salutation').removeClass('selected');

		    });
			}

			function initMap()
			{
				var map = new google.maps.Map(document.getElementById('map'), {
					center: myLatlng,
					zoom: 18,
					styles: styleArray
				});

				var beachMarker = new google.maps.Marker({
				  position: myLatlng,
				  map: map,
				  icon: "../images/common/pin.png"
				});

				//beachMarker.setAnimation(google.maps.Animation.BOUNCE);
			}


		</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaHso3UqQz9ZfunGpUW9qCrEtKRj8UmrE&callback=initMap" async defer></script>

	</body>
</html>
