<div>
			<div class="page-hd" style="background-image: url(<?php print $site_url; ?>images/user.png)">
				<div class="bd-c">
					<h2 class="pre-social"><?php print $lang['register']; ?></h2>
				</div>
			</div>
		<div class="padding-container">
		<?php if($jsondataFunctions['active-registrations']==1) { ?>
            <form role="form" method="post" action="">
				<?php
					include 'include/functions/register.php';
				?>
				<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<input class="form-control" name="username" id="username" pattern=".{5,16}" maxlength="16" pattern="[A-Za-z0-9]" placeholder="<?php print $lang['user-name']; ?>..." required="" type="text" autocomplete="off">
							<p class="text-danger" id="checkname"></p>
							<p class="text-danger" id="checkname2"></p>
							<br>
						</div>
						<div class="col-md-8 col-md-offset-2">

							<input class="form-control" name="password" id="password" pattern=".{5,16}" maxlength="16" placeholder="<?php print $lang['password']; ?>" required="" type="password">
							<p class="text-danger" id="checkpassword2"></p>
							<br>
						</div>
						<div class="col-md-8 col-md-offset-2">
							<input class="form-control" name="rpassword" id="rpassword" pattern=".{5,16}" maxlength="16" placeholder="<?php print $lang['password']; ?>" required="" type="password">
							<p class="text-danger" id="checkpassword"></p>
							<br>

						</div>
						<div class="col-md-8 col-md-offset-2">
							<input class="form-control" name="email" id="email" pattern=".{7,64}" maxlength="64" placeholder="<?php print $lang['email-address']; ?>" required="" type="email">
							<p class="text-danger" id="checkemail"></p>
							<br>

						</div>
						<div class="col-md-9 col-md-offset-2">
							<center><div class="g-recaptcha" data-theme="dark" data-sitekey="<?php print $site_key; ?>"></div></center>
							<br>
						</div>
						<div class="col-md-9 col-md-offset-2">
							<center><button type="submit" class="btn btn-danger btn-lg btn-block" tabindex="7"><?php print $lang['register']; ?></button></center>
						</div>
				</div>
            </form>
		<?php } else { ?>
			<div class="alert alert-info" role="alert">
				<strong>Info!</strong> <?php print $lang['disabled-registrations']; ?>
			</div>
		<?php } ?>
        </div>
</div>