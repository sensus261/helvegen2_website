<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['donatii'] )
{
check_donate();
$cuantum = mysql_query("Select SUM(valoarea) from web.donate where status='Valid'");
$total = mysql_fetch_array($cuantum);
  if($total['SUM(valoarea)']==NULL)
  {
	echo error("Nici o donatie valida.");
  }
  else
  {
	echo succes("".$total['SUM(valoarea)']." &euro; donati in total.Pentru lista completa a codurilor   apasati <a href='index.php?page=a_coduri'>aici</a>.");  
  }
  

	?>


<style type="text/css">
.donate_red{
border: 1px solid rgba(236, 120, 120, 0.13);
font: 11px Tahoma, "Times New Roman", Times, serif;
color: rgb(255, 255, 255);
background:#F30;
text-shadow: rgba(0, 0, 0, 0.31) 0px 1px;

}
.donate_green{
border: 1px solid rgba(236, 120, 120, 0.13);
font: 11px Tahoma, "Times New Roman", Times, serif;
color: rgb(255, 255, 255);
background:#0C0;
text-shadow: rgba(0, 0, 0, 0.31) 0px 1px;

}
</style>
<h4>LISTA DONATII CARTELE REINCARCABILE IN ASTEPTARE </h4>
<table width="100%" border="0">
  <tr class="top" >
    <td width="21%" class="iR_stats_level">Data</td>
    <td width="13%" class="iR_stats_level">Donator</td>
    <td width="24%" class="iR_stats_level">Cod</td>
    <td width="22%" class="iR_stats_level">Retea</td>
    <td width="10%" class="iR_stats_level">Valoare</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <?php
  $css = mysql_query("Select * from web.donate where status='In curs de verificare'");
  while($dn = mysql_fetch_object($css))
  {
	  $cont = mysql_fetch_object(mysql_query("Select * from account.account where login='$dn->cont'"));
	  $cid = $cont->id;
	  $str = chunk_split($dn->cod, 4, ' ');
  ?>
  <tr class="top">
    <td height="21" class="iR_stats_reset"><?=$dn->data?></td>
    <td class="iR_stats_reset"><a href="index.php?page=edit_cont&cont=<?=$cid?>"><font color="white"><?=$dn->cont?></font></a></td>
    <td class="iR_stats_reset"><?=$str?></td>
    <td class="iR_stats_reset"><?=$dn->retea?></td>
    <td class="iR_stats_reset"><?=$dn->valoarea?> &euro;</td>
    <td width="5%" class="donate_green" align="center">
    <a href="index.php?page=a_donatii&cod=<?=$dn->cod?>&set_status=Valid"><font color="white">VALID</font></a>
    </td>
    <td width="5%" class="donate_red" align="center">
     <a href="index.php?page=a_donatii&cod=<?=$dn->cod?>&set_status=Invalid"><font color="white">INVALID</font></a>
    </td>
  </tr>
  <?php } ?>
</table>
<Br>
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>