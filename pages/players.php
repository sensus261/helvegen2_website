
						<div class="heading-main">
							<strong><?php print $lang['ranking'].' - '.$lang['players']; ?></strong>
							<div class="switch">
								<a href="#" class="option active"><span><img src="<?php print $site_url; ?>images/players.png" alt="<?php print $lang['players']; ?>" title="<?php print $lang['players']; ?>"> <?php print $lang['players']; ?></span></a>
								<a href="<?php print $site_url; ?>ranking/guilds" class="option"><span><img src="<?php print $site_url; ?>images/guilds.png" alt="<?php print $lang['guilds']; ?>" title="<?php print $lang['guilds']; ?>"> <?php print $lang['guilds']; ?></span></a>
							</div>
						</div>
<div>
	<div class="padding-container">
		<div class="jumbotron jumbotron-fluid" style="padding: 1rem 2rem;">
			<form action="" method="POST">
				<div class="row">
					<div class="col-lg-7">
						<input type="text" name="search" class="form-control" placeholder="<?php print $lang['name']; ?>" value="<?php if(isset($search)) print $search; ?>">
					</div>
					<div class="col-lg-5">
						<button type="submit" style="margin-left: 10px;" class="btn btn-primary"><i class="fa fa-search fa-1" aria-hidden="true"></i> <?php print $lang['search']; ?></button>
					</div>
				</div>
			</form>
		</div>

		<table class="table table-striped table-hover">
			<thead class="thead-inverse">
				<tr>
					<th>#</th>
					<th><?php print $lang['name']; ?></th>
					<th><?php print $lang['empire']; ?></th>
					<th class="level-table"><?php print $lang['level']; ?></th>
					<th class="exp-table">EXP</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$records_per_page=10;
				
				if(isset($search))
				{
					$query = "SELECT id, name, account_id, level, exp FROM player WHERE name NOT LIKE '[%]%' AND name LIKE :search ORDER BY level DESC, exp DESC, playtime DESC, name ASC";
					$newquery = $paginate->paging($query,$records_per_page);
					$paginate->dataview($newquery, $search);
				} else {
					$query = "SELECT id, name, account_id, level, exp FROM player WHERE name NOT LIKE '[%]%' ORDER BY level DESC, exp DESC, playtime DESC, name ASC";
					$newquery = $paginate->paging($query,$records_per_page);
					$paginate->dataview($newquery);
				}
			?>
			</tbody>
		</table>
		<?php
			if(isset($search))
				$paginate->paginglink($query,$records_per_page,$lang['first-page'],$lang['last-page'],$site_url,$search);
			else
				$paginate->paginglink($query,$records_per_page,$lang['first-page'],$lang['last-page'],$site_url);
		?>
	</div>
</div>