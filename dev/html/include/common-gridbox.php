<?php
function generateGridImage($id){
	global $grids;

	$content = "";
	if (array_key_exists($id, $grids)){
		if ($grids[$id]["link"] != "") $content .=  '<a href="'.$grids[$id]["link"].'" '.($grids[$id]["type"]==2?'target="_blank"':"").'>';
		$content .=  '<img class="img100" src="'.$grids[$id]["thumb"].'" alt="" />';
		$content .= "</a>";
	}

	return $content;
}
?>
<div class="onlyPD">
	<!-- gridBox__row -->
	<div class="gridBox__row">
	<div class="gridBox__item np dCoGrid-2-5 tCoGrid-2-5">
		<div class="gridBox__item np dCoGrid-1-2 tCoGrid-1-2">
			<div class="gridBox__inner gridBox__padding_1-1">
				<div class="gridBox__abs">
					<?=generateGridImage(1)?>
				</div>
			</div>
		</div><div class="gridBox__item np dCoGrid-1-2 tCoGrid-1-2">
			<div class="gridBox__inner gridBox__padding_1-1">
				<div class="gridBox__abs">
					<?=generateGridImage(2)?>
				</div>
			</div>
		</div><div class="gridBox__item np dCoGrid-1-1 tCoGrid-1-1">
			<div class="gridBox__inner gridBox__padding_2-1">
				<div class="gridBox__abs">
					<?=generateGridImage(3)?>
				</div>
			</div>
		</div>
	</div><div class="gridBox__item np dCoGrid-1-5 tCoGrid-1-5">
		<div class="gridBox__inner gridBox__padding_1-2">
			<div class="gridBox__abs gridContent_bg_red onlyPD">
				<?php echo file_get_contents("../images/index/index-message-1.svg"); ?>
			</div>
			<div class="gridBox__abs gridContent_bg_red onlyM">
				<?php echo file_get_contents("../images/index/index-message-1.svg"); ?>
			</div>
		</div>
	</div><div class="gridBox__item np dCoGrid-2-5 tCoGrid-2-5">
		<div class="gridBox__inner gridBox__padding_1-1">
			<div class="gridBox__abs">
				<?=generateGridImage(4)?>
			</div>
		</div>
	</div>
</div>

	<!-- gridBox__row -->
	<div class="gridBox__row">
	<div class="gridBox__item np dCoGrid-3-5 tCoGrid-3-5">
		<div class="gridBox__inner gridBox__padding_3-2">
			<div class="gridBox__abs">
				<?=generateGridImage(5)?>
			</div>
		</div>
	</div><div class="gridBox__item np dCoGrid-2-5 tCoGrid-2-5">
		<div class="gridBox__item np dCoGrid-1-2 tCoGrid-1-2">

			<div class="gridBox__item np dCoGrid-1-1 tCoGrid-1-1">
				<div class="gridBox__inner gridBox__padding_1-1">
					<div class="gridBox__abs">
						<?=generateGridImage(6)?>
					</div>
				</div>
			</div>

			<div class="gridBox__item np dCoGrid-1-1 tCoGrid-1-1">
				<div class="gridBox__inner gridBox__padding_1-1">
					<div class="gridBox__abs gridContent_bg_golden onlyPD">
						<?php echo file_get_contents("../images/index/index-message-2.svg"); ?>
					</div>
					<div class="gridBox__abs gridContent_bg_golden onlyM">
						<?php echo file_get_contents("../images/index/index-message-2-m.svg"); ?>
					</div>
				</div>
			</div>

		</div><div class="gridBox__item np dCoGrid-1-2 tCoGrid-1-2">
			<div class="gridBox__inner gridBox__padding_1-2">
				<div class="gridBox__abs">
				 	<?=generateGridImage(7)?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="onlyM">
	<div class="gridBox__row">
		<div class="gridBox__item np mCoGrid-1-2">

			<div class="gridBox__inner gridBox__padding_1-1">
				<div class="gridBox__abs gridContent_bg_red onlyPD">
					<?php echo file_get_contents("../images/index/index-message-1.svg"); ?>
				</div>
				<div class="gridBox__abs gridContent_bg_red onlyM">
					<?php echo file_get_contents("../images/index/index-message-1-m.svg"); ?>
				</div>
			</div>

		</div><div class="gridBox__item np mCoGrid-1-2">

			<div class="gridBox__inner gridBox__padding_1-1">
				<div class="gridBox__abs">
					<?=generateGridImage(8)?>
				</div>
			</div>

		</div>
	</div>
	<div class="gridBox__row">
		<div class="gridBox__item np mCoGrid-1-2">

			<div class="gridBox__inner gridBox__padding_1-1">
				<div class="gridBox__abs">
					<?=generateGridImage(9)?>
				</div>
			</div>

		</div><div class="gridBox__item np mCoGrid-1-2">

			<div class="gridBox__inner gridBox__padding_1-1">
				<div class="gridBox__abs gridContent_bg_golden onlyPD">
					<?php echo file_get_contents("../images/index/index-message-2.svg"); ?>
				</div>
				<div class="gridBox__abs gridContent_bg_golden onlyM">
					<?php echo file_get_contents("../images/index/index-message-2-m.svg"); ?>
				</div>
			</div>

		</div>
	</div>
</div>
