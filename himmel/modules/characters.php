<?php
if(isset($_SESSION['user']) && isset($_SESSION['pass'])){

?>
		  <table border="0" cellspacing="4" cellpadding="0" width="100%">			<!-- character list -->
		<h4> &raquo; MY CHARACTERS </h4>
				
                 
				<?php
				debug();
				$co = mysql_query("Select * from account.account where login='".$_SESSION['user']."'");
				$c = mysql_fetch_object($co);
				$id = $c->id;
				$qq = mysql_query("Select * from player.player where account_id='$id'") or die(mysql_error());
				
				while($char = mysql_fetch_object($qq))
				{
					$pid = $char->id; 
					$query2 = mysql_query("SELECT * FROM player.player_index WHERE pid1='$pid' or pid2='$pid' or pid3='$pid' or pid4='$pid'") or die('ERROR');
				$row2 = mysql_fetch_array($query2);
				$empire = $row2['empire'];
				?>
		
                        <tr>
                        <td width="60" rowspan="3" align="center"  ><img src="images/clase/<?=$char->job?>.png" width="27" height="50" /></td>
                        <td width="244" align="left" class="iR_name" ><?=$char->name?></td>
                       
                        <td width="176" align="left" class="iR_stats" >STR : <?=$char->st?></td>
                        <td width="183" align="left" class="iR_stats" >INT : <?=$char->iq?></td>
                        <td width="225" align="left" class="iR_stats" >
                       
                            <?php clasa_c($char->job)?>
                         </td>
                </tr>
                        <tr>
                        <td align="left" class="iR_class">Level
                            <?=$char->level?></td>
                        <td align="left" class="iR_stats">DEX : <?=$char->dx?></td>
                        <td align="left" class="iR_stats">VIT : <?=$char->ht?></td>
                        <td align="left" class="iR_stats">Empire : <?=nume_regat($empire)?></td>
                        </tr>
                          <tr>
                        <td align="left" class="iR_class"><?=$char->playtime?> Minutes played</td>
                        <td align="left" class="iR_stats">Exp : <?=$char->exp?></td>
                        <td align="left" class="iR_stats">Yang : <?=$char->gold?></td>
                        <td align="left" class="collect"><a HREF="index.php?page=caractere&debug=<?=$char->id?>" >
                        <font color="white">Character Debug</font></a></td>
                        </tr>
                        <tr>
                       
                       
                        </tr>
                        <tr>
                        <td colspan="6" style="border-top:1px dotted #946767;" height="4"></td>
                        </tr>

              
		<?php } ?></table>
    <?php } ?>
