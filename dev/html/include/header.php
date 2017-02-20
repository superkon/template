<div class="header">

  <!-- header__menu -->
  <div class="header__menu">
    <div class="header__menu__inner">
      <div class="header__column--logo np dCoGrid-1-5 tCoGrid-1-5 mCoGrid-1-1">
        <a href="index.php" class="header__logo">
          <?php echo file_get_contents("../images/common/logo.svg"); ?>
        </a>
      </div><div class="header__column np dCoGrid-1-5 tCoGrid-1-5 mCoGrid-1-1">
      </div><div class="header__column np dCoGrid-1-5 tCoGrid-1-5 mCoGrid-1-3">
        <a href="about.php" class="menu__item"><?=showContent(array("mainmenu", "aboutus"))?></a>
        <a href="traditional-ceremony.php" class="menu__item"><?=showContent(array("mainmenu", "traditional"))?></a>
        <a href="services.php" class="menu__item"><?=showContent(array("mainmenu", "service"))?></a>
      </div><div class="header__column np dCoGrid-1-5 tCoGrid-1-5 mCoGrid-1-3">
        <a href="calendar.php" class="menu__item"><?=showContent(array("mainmenu", "calendar"))?></a>
        <a href="gallery.php" class="menu__item"><?=showContent(array("mainmenu", "gallery"))?></a>
        <a href="tips.php" class="menu__item"><?=showContent(array("mainmenu", "tips"))?></a>
      </div><div class="header__column np dCoGrid-1-5 tCoGrid-1-5 mCoGrid-1-3">
        <a href="news.php" class="menu__item"><?=showContent(array("mainmenu", "news"))?></a>
        <a href="contact-us.php" class="menu__item"><?=showContent(array("mainmenu", "contactus"))?></a>
        <a href="tnc.php" class="menu__item"><?=showContent(array("mainmenu", "tnc"))?></a>
      </div>
    </div>
  </div>

  <a href="javascript:void(0);" class="header__btn_menu btn_menu">
    <span class="btn_menu__stroke_1"></span>
    <span class="btn_menu__stroke_2"></span>
    <span class="btn_menu__stroke_3"></span>
  </a>

  <div class="header__langShift">


    <div class="header__langShift__showHideWrapper">
      <?php
        foreach(array("en", "sc", "tc") as $menu_lang){
          if ($menu_lang != $lang){
      ?>
      <a href="javascript:void(0);" class="btn_lang btn_lang_select" data-langfrom="<?=$lang?>" data-langto="<?=$menu_lang?>">
        <span class="text_vm"><?=showContent(array("languagebar", "lang_".$menu_lang))?></span>
      </a>
      <?php
          }
        }
      ?>

    </div>

    <a href="javascript:void(0);" class="btn_lang btn_lang_display selected">
      <span class="text_vm"><?=showContent(array("languagebar", "lang_".$lang))?></span>
    </a>

  </div>

</div>
