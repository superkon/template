<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Template
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=<?php echo $this->settings->site_version; ?>">
	<link rel="icon" type="image/x-icon" href="/favicon.ico?v=<?php echo $this->settings->site_version; ?>">
    <title><?php echo $page_title; ?> - <?php echo $this->settings->site_name; ?></title>

    <?php // CSS files ?>
    <?php if (isset($css_files) && is_array($css_files)) : ?>
        <?php foreach ($css_files as $css) : ?>
            <?php if ( ! is_null($css)) : ?>
                <link rel="stylesheet" href="<?php echo $css; ?>?v=<?php echo $this->settings->site_version; ?>"><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
	
	<?php // Javascript files ?>
    <?php if (isset($js_files) && is_array($js_files)) : ?>
        <?php foreach ($js_files as $js) : ?>
            <?php if ( ! is_null($js)) : ?>
                <?php echo "\n"; ?><script type="text/javascript" src="<?php echo $js; ?>?v=<?php echo $this->settings->site_version; ?>"></script><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
        <?php foreach ($js_files_i18n as $js) : ?>
            <?php if ( ! is_null($js)) : ?>
                <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</head>
<body>
<?php echo $header; ?>

<div class="container-fluid wrapper">
  <div class="row">
	<?php echo $sidebar; ?>
	<div class="pageMain font-montserrat main">
		<?php echo $content; ?>
	
		<!-- popup -->
		<div class="popupWrapper alertPop mfp-with-anim mfp-hide">
			<div class="popAlertWrapper">
				<div class="popAlertTitle">
					<h2></h2>
				</div>
				<div class="popAlertMessage">
						<p></p>
				</div>
				<div class="popAlertBtnWrapper"></div>
			</div>
		</div>
		
	</div>
  </div>
</div>

<?php echo $footer; ?>
</body>
</html>