<h4>DOWNLOAD : </h4>
<table width="100%" border="0">
  <?php 
  	$d = mysql_query("Select * from web.dev_descarcari order by data");
	while($dw = mysql_fetch_object($d))
	{
		
  ?>
  <tr class="top">
    <td width="26%" class="iR_stats_reset">[<?=$dw->tip?>] <?=$dw->nume?></td>
    <td width="33%" class="iR_stats_reset"><?=$dw->data?></td>
    <td width="23%" class="iR_stats_reset"><?=$dw->marime?> MB</td>
    <td width="18%" class="collect"><a target="_blank" href="http://<?=$dw->link?>"><font color="white">DOWNLOAD</font></a></td>
  </tr>
  <?php } ?>

</table>

<table width="421" border="0"  class="mini_top">
<h4>  MINIMUM SYSTEM REQUIREMENTS</h4>
<tbody>
<tr>
<td width="158" >OS</td>
<td width="288" >- Win XP, Win 2000, Win Vista, Win 7</td>
</tr>
<tr>
<td >CPU</td>
<td width="288" >- Pentium 3 1GHz</td>
</tr>
<tr>
<td >RAM</td>
<td width="288" >- 512M</td>
</tr>
<tr>
<td >Hard Drive</td>
<td width="288" >- 2 GB</td>
</tr>
<tr>
<td >Grapich Card</td>
<td width="288" >- Grapich with minimum 32MB RAM</td>
</tr>
<tr>
<td >Soundcart</td>
<td width="288" >- Support DirectX 9.0</td>
</tr>
<tr>
<td >Mouse</td>
<td width="288" >- Mouse compatible with the Operating System</td>
</tbody>
</table>
