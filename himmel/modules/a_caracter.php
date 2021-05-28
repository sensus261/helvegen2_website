<?php
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >= $drepturi['vizualizare_caracter']){
if(isset($_GET['id'])) {
?>	<?php
				admin_debug();
				$pid = replace($_GET['id']);
				$char= mysql_fetch_object(mysql_query("Select * from player.player where id='$pid'"));
				$query2 = mysql_query("SELECT * FROM player.player_index WHERE pid1='$pid' or pid2='$pid' or pid3='$pid' or pid4='$pid'") or die('ERROR');
				$row2 = mysql_fetch_array($query2);
				$empire = $row2['empire'];
				$acs = mysql_fetch_object(mysql_query("Select * from account.account where id='$char->account_id'"));
				?><div class="top">
                Acest caracter apartine contului : <?php echo " <a href='index.php?page=edit_cont&cont=".$acs->id."'><font color='white'>".$acs->login."</font> </a>";?> </div>
  <table border="0" cellspacing="4" cellpadding="0" width="100%">			<!-- character list -->

		
                        <tr>
                        <td width="60" rowspan="3" align="center"  ><img src="images/clase/<?=$char->job?>.png" width="27" height="50" /></td>
                        <td width="244" align="left" class="iR_name" > <?php echo "".$char->name." - <i><a href='index.php?page=cauta_ip&ip=".$char->ip."'>".$char->ip."</a></i>";?></td>
                       
                        <td width="176" align="left" class="iR_stats" >Putere : <?=$char->st?></td>
                        <td width="183" align="left" class="iR_stats" >Inteligenta : <?=$char->iq?></td>
                        <td width="225" align="left" class="iR_stats" >
                       
                            <?php clasa_c($char->job)?>
                         </td>
                </tr>
                        <tr>
                        <td align="left" class="iR_class">Level
                            <?=$char->level?></td>
                        <td align="left" class="iR_stats">Agilitate : <?=$char->dx?></td>
                        <td align="left" class="iR_stats">Vitalitate : <?=$char->ht?></td>
                        <td align="left" class="iR_stats">Regat : <?=nume_regat($empire)?></td>
                        </tr>
                          <tr>
                        <td align="left" class="iR_class"><?=$char->playtime?> minute online</td>
                        <td align="left" class="iR_stats">Exp : <?=$char->exp?></td>
                        <td align="left" class="iR_stats">Yang : <?=$char->gold?></td>
                        <td align="left" class="collect"><a HREF="index.php?page=a_caracter&id=<?=$pid?>&debug=<?=$char->id?>" >
                        <font color="white">Debugare caracter</font></a></td>
                        </tr>
                        <tr>
                        	<td colspan="3">&nbsp;</td>
                            <td class="collect"><a href="index.php?page=vizualizare_iteme&id=<?=$char->id?>">
                        <font color="white">Vizualizare iteme</font></a></td>
                            <td class="collect"><a HREF="index.php?page=edit_caracter&id=<?=$char->id?>" >
                        <font color="white">Editare caracter</font></a></td>
                        </tr>
                        <tr>
                        <td colspan="6" style="background-image:url(img/inner_line.jpg); background-repeat:repeat-x;">&nbsp;</td>
                        </tr>        
</table>
  
  
<?php } } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>