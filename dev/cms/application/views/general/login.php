<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container pageLogin">
	<?php if ($this->error_msg != ""){ ?>
	
	<div class="alert alert-danger" role="alert">
		<strong><?php echo $this->error_msg; ?></strong>
	</div>
	
	<?php } ?>

	<?php echo form_open('login'); ?>
		<h3 class="font-montserrat form-signin-heading">
			<span class="title"><?php echo $this->settings->site_name; ?></span>
		</h3>
		<label for="login" class="sr-only"><?=lang('login')?></label>
		<input type="text" name="login" id="login" class="form-control" placeholder="Login" maxlength="100" required autofocus>
		<label for="password" class="sr-only"><?=lang('password')?></label>
		<input type="password" name="password" id="password" class="form-control" placeholder="Password" maxlength="100" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="submit"><?=lang("sign_in")?></button>
		<input name="action" type="hidden" id="action" value="login" />
	</form>
	<div class="bottom">
		<span>powered by</span>
		<img src="<?php echo base_url('assets/images/common/imgVsoloop-grey.png') ?>" alt="Vsoloop Limited" />
	</div>
</div> 
