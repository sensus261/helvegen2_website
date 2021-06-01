<?php
	require_once "include/dotenv/dot_env.php";

	use Helvegen2ShopDotEnv\DotEnvShop;

	(new DotEnvShop(__DIR__ . '/../.env'))->load();

	$host = getenv('HOST');
	$user  = getenv('USER');
	$password =  getenv('PASSWORD');
	
	//Site URL - with / at the end, example: http://example.com/ishop/
	$site_url = getenv('SITE_URL');
	
	//General settings
	$server_name = getenv('SERVER_NAME');
	$minim_web_admin_level = 9;
	
	//PayPal email - only Business Account
	$paypal_email = getenv('PAYPAL_EMAIL');
	
	//No edit
	$license = getenv('LICENSE');
?>