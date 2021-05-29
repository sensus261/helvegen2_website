
						<div class="heading-main">
							<strong><?php print $lang['news']; ?></strong>
							<?php if($offline) { ?>
							<div class="switch">
								<a href="#" class="option active"><span style="color: #d84b4b;"><?php print $lang['server-offline']; ?></span></a>
							</div>
							<?php } ?>
						</div>
		<?php
			if(!$offline && $database->is_loggedin())
				if($web_admin>=$jsondataPrivileges['news'])
				{
					print '<div class="padding-container">';
					include 'include/functions/add-news.php';
					print '</div>';
				}
		?>
				<?php
				if (version_compare($php_version = phpversion(), '5.6.0', '<')) {
				?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<span>Metin2CMS works with a PHP version >= 5.6.0. At this time, the server is running version <?php print $php_version; ?>.</span>
				</div>
				<?php
				}
					$query = "SELECT * FROM news ORDER BY id DESC";
					$records_per_page=intval(getJsonSettings("news"));
					$newquery = $paginate->paging($query,$records_per_page);
					$paginate->dataview($newquery, $lang['sure?'], $web_admin, $jsondataPrivileges['news'], $site_url, $lang['read-more'], $lang['time']);
					$paginate->paginglink($query,$records_per_page,$lang['first-page'],$lang['last-page'],$site_url);		
				?>
