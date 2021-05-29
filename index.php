<?php
	@ob_start();
	include 'include/functions/header.php'; 
?>
<!DOCTYPE html>
<html lang="<?php print $language_code; ?>">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php print $site_title.' - '.$title; if($offline) print ' - '.$lang['server-offline']; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<link rel="stylesheet" type="text/css" href="<?php print $site_url; ?>css/style.min.css">
		<link rel="stylesheet" type="text/css" href="<?php print $site_url; ?>css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php print $site_url; ?>css/bootstrap-table.css">
		
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap" rel="stylesheet">
		<link href="<?php print $site_url; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		<link rel="shortcut icon" href="<?php print $site_url; ?>images/favicon.ico">
	
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	<body>
		<?php
			if($item_shop!="")
				$shop_url = $item_shop;
			else if(is_dir('shop')) 
				$shop_url = $site_url.'shop'; 
			else $shop_url = ''; 
		?>
		<header class="pixarts-header">
			<a href="<?php print $site_url; ?>" class="fake-logo"></a>
			<a href="<?php print $site_url; ?>" class="fake-pixarts"></a>
			<video class="pixarts-header-video" muted muted="muted" loop autoplay autoplay="autoplay">
				<source src="<?php print $site_url; ?>video/header.webm" type="video/webm"></source>
			</video>
			<div class="pixarts-container">
				<div class="pixarts-nav">
					<ul class="l-menu">
						<li class="active"><a href="<?php print $site_url; ?>news"><?php print $lang['news']; ?></a></li>
						<?php if(!$database->is_loggedin()) { ?>
						<li><a href="<?php print $site_url; ?>users/register"><?php print $lang['register']; ?></a></li>
						<?php } else { ?>
						<li><a href="<?php print $site_url; ?>user/administration"><?php print $lang['account-data']; ?></a></li>
						<?php } ?>
						<li><a href="<?php print $site_url; ?>download"><?php print $lang['download']; ?></a></li>
					</ul>
					<a href="<?php print $site_url; ?>" class="logo-head"><img src="<?php print $site_url; ?>img/main/logo-head.svg" alt="<?php print $site_title; ?>.ro - Enter The East"></a>
					<ul class="r-menu">
						<li><a href="<?php print $site_url; ?>ranking/players"><?php print $lang['ranking']; ?></a></li>
						<li><a href="<?php print $shop_url; ?>" target="_blank">Shop</a></li>
						<li><a href="<?php print $social_links['discord']; ?>" target="_blank">Discord</a></li>
					</ul>
				</div>
			</div>
			<div class="header-dod">
				<a href="<?php print $site_url; ?>download" class="download"></a>
				<?php if(!$offline) { ?>
				<div class="stat-box">
					<strong class="odometer" id="onlineStat"><?php print getStatistics('accounts-created'); ?></strong>
					<span class="info-stat"><?php print $lang['players-online']; ?></span>
				</div>
				<div class="stat-box">
					<strong class="odometer" id="online24Stat"><?php print getStatistics('players-online-last-24h'); ?></strong>
					<span class="info-stat"><?php print $lang['players-online-last-24h']; ?></span>
				</div>
				<div class="stat-box">
					<strong class="odometer" id="accStat"><?php print getStatistics('accounts-created'); ?></strong>
					<span class="info-stat"><?php print $lang['accounts-created']; ?></span>
				</div>
				<?php } ?>
			</div>
		</header>
		<section class="pixarts-body">
			<div class="pixarts-container main">
				<div class="left-col">
					<div class="box-sm-v1">
						<div class="heading animv2">
							<h2><?php print $lang['user-panel']; ?></h2>
							<?php if(!$database->is_loggedin()) { ?>
							<div>
								<span>or</span>
								<a class="p-w-l" href="<?php print $site_url; ?>users/register"><?php print $lang['register']; ?></a>
							</div>
							<?php } ?>
						</div>
						<div class="inner login-box">
							<?php if($offline || !$database->is_loggedin()) { ?>
							<form action="<?php print $site_url; ?>users/login" method="POST">
								<label class="username">
								<input type="text" name="username" pattern=".{5,64}" maxlength="64" placeholder="<?php print $lang['user-name']; ?>" autocomplete="off" <?php if($offline) print 'disabled'; else print 'required'; ?>>
								</label>
								<label class="password">
								<input type="password" name="password" pattern=".{5,16}" maxlength="16" placeholder="<?php print $lang['password']; ?>" <?php if($offline) print 'disabled'; else print 'required'; ?>>
								</label>
								<label class="checkbox">
									<div class="g-recaptcha" data-theme="dark" data-sitekey="<?php print $site_key; ?>" style="border: solid 1px #2f2725;transform: scale(0.46);-webkit-transform: scale(0.46);transform-origin: 0 0;-webkit-transform-origin: 0 0;margin: 10px 0px -18px 0px;border-radius: 4px;"></div>
								</label>
								<button type="submit"><b><?php print $lang['login']; ?></b></button>
							</form>
							<div class="login-add">
								<div class="lane">
									<a href="<?php print $site_url; ?>users/lost" class="c-golden"><?php print $lang['forget-password']; ?></a>
								</div>
								<div class="lane">
									<span>No account yet? <a href="<?php print $site_url; ?>users/register" class="c-white">Create an account!</a></span>
								</div>
							</div>
							<?php } else { ?>
							<ul class="ranking">
								<?php if($web_admin) { ?>
								<li class="user-menu"><a href="<?php print $site_url; ?>admin"><?php print $lang['administration']; ?><?php if($web_admin>=9 && checkUpdate(officialVersion())) print ' <span class="tag tag-info tag-pill float-xs-right">'.$lang['update-available'].'</span>'; ?></a></li>
								<?php 
									if($web_admin>=$jsondataPrivileges['donate']) {
										$count_donations = count(get_donations());
										if($count_donations)
										{
								?>	
								<li class="user-menu"><a href="<?php print $site_url; ?>admin/donatelist"><?php print $lang['donatelist']; ?> <span class="tag tag-info tag-pill float-xs-right"><?php print $count_donations.' '.$lang['new-donations']; ?> </span></a></li>
								<?php
										}
									}
								}
								?>
								<li class="user-menu"><a href="<?php print $site_url; ?>user/administration"><?php print $lang['account-data']; ?></a></li>
								<li class="user-menu"><a href="<?php print $site_url; ?>user/characters"><?php print $lang['chars-list']; ?></a></li>
								<li class="user-menu"><a href="<?php print $site_url; ?>user/redeem"><?php print $lang['redeem-codes']; ?></a></li>
								<?php if($jsondataFunctions['active-referrals']) { ?>
								<li class="user-menu"><a href="<?php print $site_url; ?>user/referrals"><?php print $lang['referrals']; ?></a></li>
								<?php } if($item_shop!="") { ?>
								<li class="user-menu"><a target='_blank' href="<?php print $item_shop; ?>"><?php print $lang['item-shop']; ?></a></li>
								<?php }
									$vote4coins = file_get_contents('include/db/vote4coins.json');
									$vote4coins = json_decode($vote4coins, true);
									
									if(count($vote4coins))
										print '<li class="user-menu"><a href="'.$site_url.'user/vote4coins">Vote4Coins</a></li>';
									
									$donate = file_get_contents('include/db/donate.json');
									$donate = json_decode($donate, true);
									
									if(count($donate))
										print '<li class="user-menu"><a href="'.$site_url.'user/donate">'.$lang['donate'].'</a></li>';
								?>
								<li class="user-menu"><a class="logout" href="<?php print $site_url; ?>users/logout"><?php print $lang['logout']; ?></a></li>
							</ul>
							<?php } ?>
						</div>
					</div>
					<div class="box-sm-v1">
						<div class="heading animv1">
							<h2><?php print $lang['ranking'].' - '.$lang['players']; ?></h2>
							<div>
								<a class="p-w-l">Top 10</a>
							</div>
						</div>
						<div class="inner rank">
							<div class="pix-tab p-thead">
								<div class="order">#</div>
								<div class="username"><?php print $lang['name']; ?></div>
								<div class="kingdom"><?php print $lang['empire']; ?></div>
								<div class="level">Lv.</div>
							</div>
							<div class="pix-tab p-tbody">
								<?php
									if(!$offline) {
									$top = array();
									$top = top10players();
									$i=1;
									foreach($top as $player)
									{
										$empire=get_player_empire($player['account_id'])
								?>
								<a class="lane">
									<div class="order"><?php print $i++; ?>.</div>
									<div class="username"><?php print $player['name']; ?></div>
									<div class="kingdom <?php print emire_color($empire); ?>"><?php print emire_name($empire); ?></div>
									<div class="level"><?php print $player['level']; ?></div>
								</a>
								<?php $i++; }
									}
								?>
							</div>
						</div>
						<a href="<?php print $site_url; ?>ranking/players" class="inner rank-add">
						<span>Top 100 &raquo;</span>
						</a>
					</div>
				</div>
				<div class="center-col">
					<?php if($page=='news' || $page=='') { ?>
					<div class="banner-main">
						<a href="<?php print $social_links['discord']; ?>" target="_blank" class="inside">
						<img src="<?php print $site_url; ?>img/theme/banner-center-main-placeholder.png" alt="">
						</a>
					</div>
					<?php } ?>
					<div class="newsfeed">
						<?php include 'pages/'.$page.'.php'; ?>
					</div>
				</div>
				<div class="right-col">
					<div class="box-sm-v1">
						<div class="heading animv2">
							<h2>SERVER STATISTICS</h2>
							<div>
								<span>of</span>
								<a class="p-w-l">Helvegen2</a>
							</div>
						</div>
						<?php if(!$offline) { ?>
						<div class="inner stats-box">
							<div class="lane-stat l-s-1">
								<div class="text">
									<strong class="odometer" id="onlineStat2"><?php print getStatistics('players-online'); ?></strong>
									<span><?php print $lang['players-online']; ?></span>
								</div>
							</div>
							<div class="lane-stat l-s-2">
								<div class="text">
									<strong class="odometer" id="charStat"><?php print getStatistics('created-characters'); ?></strong>
									<span><?php print $lang['created-characters']; ?></span>
								</div>
							</div>
							<div class="lane-stat l-s-3">
								<div class="text">
									<strong class="odometer" id="guildStat"><?php print getStatistics('guilds-created'); ?></strong>
									<span><?php print $lang['guilds-created']; ?></span>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="box-sm-v1">
						<div class="heading animv1">
							<h2><?php print $lang['ranking'].' - '.$lang['guilds']; ?></h2>
							<div>
								<a class="p-w-l">Top 10</a>
							</div>
						</div>
						<div class="inner rank">
							<div class="pix-tab p-thead">
								<div class="order">#</div>
								<div class="username"><?php print $lang['name']; ?></div>
								<div class="kingdom"><?php print $lang['empire']; ?></div>
								<div class="level"><?php print $lang['points']; ?></div>
							</div>
							<div class="pix-tab p-tbody">
								<?php
									if(!$offline) {
									$top = array();
									$top = top10guilds();
									$i=1;
									foreach($top as $guild)
									{
										$empire=get_guild_empire($guild['master']);
								?>
								<a class="lane">
									<div class="order"><?php print $i++; ?>.</div>
									<div class="username"><?php print $guild['name']; ?></div>
									<div class="kingdom <?php print emire_color($empire); ?>"><?php print emire_name($empire); ?></div>
									<div class="level"><?php print $guild['ladder_point']; ?></div>
								</a>
								<?php $i++; }
									}
								?>
							</div>
						</div>
						<a href="<?php print $site_url; ?>ranking/guilds" class="inner rank-add">
						<span>Top 100 &raquo;</span>
						</a>
					</div>
				</div>
			</div>
			<div class="pixarts-footer">
				<div class="pixarts-container">
					<div class="foot-menu">
						<a href="<?php print $site_url; ?>"><img src="<?php print $site_url; ?>img/main/logo-foot.svg" alt=""></a>
                    <ul>
                        <li class="active"><a href="<?php print $site_url; ?>news"><?php print $lang['news']; ?></a></li>
                        <li><a href="<?php print $site_url; ?>download"><?php print $lang['download']; ?></a></li>
                        <li><a href="<?php print $social_links['discord']; ?>" target="_blank">Discord</a></li>
						<li><a href="<?php print $site_url; ?>ranking/players"><?php print $lang['ranking']; ?></a></li>
						<li><a href="<?php print $shop_url; ?>" target="_blank">Shop</a></li>
                    </ul>
					</div>
					<div class="foot-foot">
						<a class="go-top scrollTotop" href="#top"></a>
						<div class="ownertag">
							<p> All rights reserved <b>&copy; <?php
										$copyright_year = date('Y');
										if($copyright_year > 2020)
											print '2020 - '.$copyright_year;
										else print $copyright_year;
								?></b> <a href="<?php print $site_url; ?>"><?php print $site_title; ?></a>. Powered by <a href="https://metin2cms.cf/">Metin2CMS</a>.</p>
						</div>
						<div class="author">
							<span>Design &amp; implementation</span>
							<div class="tiptip">Game development studio</div>
							<a href="https://pixarts.net/"><img src="<?php print $site_url; ?>img/theme/pixarts-logo.png" alt="Pixarts.net - Game Development"></a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript" src="<?php print $site_url; ?>js/jquery-2.2.4.min.js"></script>
		<?php include 'include/functions/footer.php'; ?>
		<script src="<?php print $site_url; ?>js/tether.min.js"></script>
		<script src="<?php print $site_url; ?>js/bootstrap.min.js"></script>
		<script>
			var site_url = "<?php print $site_url; ?>";
		</script>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" type="86b91906db19f0b25c5b4b68-text/javascript"></script>
		<script src="<?php print $site_url; ?>js/main.js" type="86b91906db19f0b25c5b4b68-text/javascript"></script>
		<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="86b91906db19f0b25c5b4b68-|49" defer=""></script>
	</body>
</html>