<?php
	if($web_admin>=9)
		include 'include/functions/check-version.php';
	fix_account_columns();

	if($web_admin>=$jsondataPrivileges['edit-info'] || $web_admin>=$jsondataPrivileges['download']) { ?>
<div class="list-group">
	<li class="list-group-item active">
		<i class="fa fa-cogs fa-1" aria-hidden="true"></i> <?php print $lang['general-settings']; ?>
	</li>
	<?php if($web_admin>=$jsondataPrivileges['edit-info']) { ?>
	<a href="<?php print $site_url; ?>admin/links" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-cog fa-1" aria-hidden="true"></i> <?php print $lang['edit-info']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['edit-links-info']; ?></p>
	</a>
	<?php } if($web_admin>=$jsondataPrivileges['download']) { ?>
	<a href="<?php print $site_url; ?>admin/download" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-download fa-1" aria-hidden="true"></i> <?php print $lang['download']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['download-links']; ?></p>
	</a>
	<?php } ?>
</div>
<?php } if($web_admin>=$jsondataPrivileges['functions-on-off'] || $web_admin>=$jsondataPrivileges['Vote4Coins'] || $web_admin>=$jsondataPrivileges['referrals'] || $web_admin>=$jsondataPrivileges['redeem-codes']) { ?>
</br>
<div class="list-group">
	<li class="list-group-item active">
		<i class="fa fa-magic fa-1" aria-hidden="true"></i> <?php print $lang['functions']; ?>
	</li>
	<?php if($web_admin>=$jsondataPrivileges['functions-on-off']) { ?>
	<a href="<?php print $site_url; ?>admin/functions" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-check-square-o fa-1" aria-hidden="true"></i> <?php print $lang['functions-on-off']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['functions-on-off-info']; ?></p>
	</a>
	<?php } if($web_admin>=9) { ?>
	<a href="<?php print $site_url; ?>admin/privileges" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-users fa-1" aria-hidden="true"></i> <?php print $lang['privileges']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['privileges-info']; ?></p>
	</a>
	<?php } if($web_admin>=$jsondataPrivileges['Vote4Coins']) { ?>
	<a href="<?php print $site_url; ?>admin/vote4coins" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-thumbs-o-up fa-1" aria-hidden="true"></i> Vote4Coins</h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['vote-info']; ?></p>
	</a>
	<?php } if($web_admin>=$jsondataPrivileges['referrals']) { ?>
	<a href="<?php print $site_url; ?>admin/referrals" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-user-plus fa-1" aria-hidden="true"></i> <?php print $lang['referrals']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['referrals-info']; ?></p>
	</a>
	<?php } if($web_admin>=$jsondataPrivileges['redeem-codes']) { ?>
	<a href="<?php print $site_url; ?>admin/redeem" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-barcode fa-1" aria-hidden="true"></i> <?php print $lang['redeem-codes']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['redeem-code-info']; ?></p>
	</a>
	<?php } ?>
</div>
<?php } if($web_admin>=$jsondataPrivileges['donate']) { ?>
</br>
<div class="list-group">
	<li class="list-group-item active">
		<i class="fa fa-money fa-1" aria-hidden="true"></i> <?php print $lang['donate']; ?>
	</li>
	<a href="<?php print $site_url; ?>admin/donate" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-credit-card  fa-1" aria-hidden="true"></i> <?php print $lang['donate']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['donate-info']; ?></p>
	</a>
	<a href="<?php print $site_url; ?>admin/donatelist" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-check fa-1" aria-hidden="true"></i> <?php print $lang['donatelist']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['donatelist-info' ]; ?></p>
	</a>
</div>
<?php } if($web_admin>=$jsondataPrivileges['player-management'] || $web_admin>=$jsondataPrivileges['Log'] || $web_admin>=$jsondataPrivileges['create-items'] || $web_admin>=$jsondataPrivileges['add-coins']) { ?>
</br>
<div class="list-group">
	<li class="list-group-item active">
		<i class="fa fa-cogs fa-1" aria-hidden="true"></i> <?php print $lang['game-management']; ?>
	</li>
	<?php if($web_admin>=$jsondataPrivileges['player-management']) { ?>
	<a href="<?php print $site_url; ?>admin/players" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> <?php print $lang['player-management']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['player-management-info']; ?></p>
	</a>
	<?php } if($web_admin>=$jsondataPrivileges['Log']) { ?>
	<a href="<?php print $site_url; ?>admin/log" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-binoculars fa-1" aria-hidden="true"></i> Log</h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['log-info']; ?></p>
	</a>
	<?php } if($web_admin>=$jsondataPrivileges['create-items']) { ?>
	<a href="<?php print $site_url; ?>admin/createitems" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-fire fa-1" aria-hidden="true"></i> <?php print $lang['create-items']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['create-items-info']; ?></p>
	</a>
	<?php } if($web_admin>=$jsondataPrivileges['add-coins']) { ?>
	<a href="<?php print $site_url; ?>admin/coins" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-dollar fa-1" aria-hidden="true"></i> <?php print $lang['add-coins']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['add-coins-info']; ?></p>
	</a>
	<?php } if($web_admin>=$jsondataPrivileges['reward-players'] && check_table_in_player("item_award")) { ?>
	<a href="<?php print $site_url; ?>admin/reward" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-gift fa-1" aria-hidden="true"></i> <?php print $lang['reward-players']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['reward-players-info']; ?></p>
	</a>
	<?php } ?>
</div>
<?php } if($web_admin>=$jsondataPrivileges['cms-management']) { ?>
</br>
<div class="list-group">
	<li class="list-group-item active">
		<i class="fa fa-cogs fa-1" aria-hidden="true"></i> <?php print $lang['cms-management']; ?>
	</li>
	<a href="<?php print $site_url; ?>admin/language" class="list-group-item list-group-item-action">
		<h3 class="list-group-item-heading"><i class="fa fa-language fa-1" aria-hidden="true"></i> <?php print $lang['site-translate']; ?></h3>
		<p class="list-group-item-text" style="color: #0ce3ac;"><?php print $lang['site-translate-info']; ?></p>
	</a>
</div>
<?php } ?>