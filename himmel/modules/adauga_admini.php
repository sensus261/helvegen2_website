<?php
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['adauga_admini'])
{
	adauga_admini();
	if(isset($_GET['sterge']) && $_GET['sterge']!=NULL)
	{
		$id = replace($_GET['sterge']);
		mysql_query("Delete from common.gmlist where mID='$id'");
	}
?>
<h4>ADAUGA ADMINI IN JOC </h4>
<form action="" method="POST"><table width="80%" border="0">
  <tr>
    <td width="31%">Nume cont : </td>
    <td width="69%"><input type="text" name="cont" id="barx"  class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Nume caracter : </td>
    <td><input type="text" name="caracter" id="barx"  class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Nivel acces : </td>
    <td>
    	<select name="mAuthority" id="barx">
        	<option value="IMPLEMENTOR">IMPLEMENTOR</option>
            <option value="HIGH_WIZARD">HIGH_WIZARD</option>
            <option value="GOD">GOD</option>
            <option value="LOW_WIZARD">LOW_WIZARD</option>
           
        </select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="ADAUGA" class="buton" /></td>
  </tr>
</table>
</form>
<h4>ADMINI IN JOC</h4>
<table width="100%" border="0" align="center">
  <tr class="top">
    <td class="iR_stats_level">Cont</td>
    <td class="iR_stats_level">Caracter</td>
    <td class="iR_stats_level">Acces</td>
    <td >&nbsp;</td>
  </tr>
  <?php 
	$query= mysql_query("Select * from common.gmlist");
	while($admin = mysql_fetch_object($query))
	{
  ?>
  <tr class="top">
    <td class="iR_stats_reset"><?=$admin->mAccount?></td>
    <td class="iR_stats_reset"><?=$admin->mName?></td>
    <td class="iR_stats_reset"><?=$admin->mAuthority?></td>
    <td class="collect"><a href="index.php?page=adauga_admini&sterge=<?=$admin->mID?>"><font color="white">Sterge</font></a></td>
  </tr>
  <?php } ?>
</table>
<br>

<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>
