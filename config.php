<?php
	require_once "include/dotenv/dot_env.php";

	use Helvegen2DotEnv\DotEnv;

	(new DotEnv(__DIR__ . '/.env'))->load();

	$site_url = getenv('SITE_URL');
	
	//Game database
	$host = getenv('HOST');
	$user = getenv('USER');
	$password = getenv('PASSWORD');

	//Mail settings
	$SMTPAuth = true;
	$SMTPSecure = "ssl";
	$EmailHost = getenv('SMTP_HOST');
	$emailPort = 465;
	
	$email_username = getenv('SMTP_EMAIL');
	$email_password = getenv('SMTP_PASSWORD');
	
	$paypal_email = getenv('PAYPAL_EMAIL');
	
	$safebox_size = 1;
	
	$site_key = getenv('CAPTCHA_SITE_KEY');
	$secret_key = getenv('CAPTCHA_SECRET_KEY');