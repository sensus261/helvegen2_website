<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['accese_site'])
{
	adauga_acces();
	include 'inc/configurare.php';
?>
<h4>ASIGURA ACCESE PE SITE UNUI JUCATOR </h4>
<form action="" method="POST">
<table width="294" border="0">
  <tr>
    <td width="95">Nume :</td>
    <td width="189"><input type="text" name="utilizator"  class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Nivel acces :</td>
    <td><select name="nivel" id="barx">
    <?php for($i=1;$i<10;$i++) { echo '
    <option value="'.$i.'">Nivel '.$i.'</option>';}?>
    </select>
      <input type="submit" name="adauga" id="adauga" value="ADAUGA" class="buton" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<br />
<h4>LISTA JUCATORI CU ACCES </h4>
<table width="100%" border="0">
<tr class="top">
    <td width="3%" class="iR_stats_level">#</td>
    <td width="14%" class="iR_stats_level">Utilizator</td>
    <td width="31%" class="iR_stats_level">Email</td>
    <td width="26%" align="center" class="iR_stats_level">Nivel</td>
    <td width="26%">&nbsp;</td>
  </tr>
 <?php
 	if(isset($_GET['sterge_acces']))
	{
		$utilizator = replace($_GET['sterge_acces']);
		$mss = mysql_query("Select * from ".$account_db.".account where login='$utilizator' and web_admin > '0'");
		if(mysql_num_rows($mss) > 0 )
		{
			mysql_query("Update ".$account_db.".account set web_admin='' where login='$utilizator'");
			echo succes("Accesul lui $utilizator a fost sters!");
		}
		else
		{
			echo error("Utilizatorul nu exista sau nu are acces la website!");
		}
	}
  $acs = mysql_query("Select * from ".$account_db.".account where web_admin > '0'");
  while($acc = mysql_fetch_object($acs))
  {
	  $crt++;
  ?>
 
  <tr class="top">
    <td class="iR_stats_reset"><?=$crt?></td>
    <td class="iR_stats_reset"><?=$acc->login?></td>
    <td class="iR_stats_reset"><?=$acc->email?></td>
    <td class="iR_stats_reset" align="center"><?=$acc->web_admin?></td>
    <td class="collect" align="center"><a href="index.php?page=u_acces&sterge_acces=<?=$acc->login?>"><font color="white">&raquo; Sterge &laquo;</font></a></td>
  </tr>
  
  <?php } ?>
</table><br />

<div class="shadow" >
  <a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>
</div>

<?php
} else { echo "Nu ai acces"; }?>