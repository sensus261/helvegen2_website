<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['cauta_ip'])
{
?>

<h4>Cautare ip</h4>
<?php
if(isset($_GET['ip']) && $_GET['ip']!=NULL)
{
	$ip = replace($_GET['ip']);	
}
?>
<form action="" method="POST">
<table width="301" border="0" >
  <tr>
    <td width="75" bgcolor=""><h5>Cont :</h5></td>
    <td width="82"><input type="text" name="ip" id="barx" class="iRg_input" value="<?=$ip?>"/></td>
    <td width="130"><input type="submit" name="cauta" class="buton" value="CAUTA !" /></td>
  </tr>
</table>
</form><br />
<?php cauta_ip();?>
<br />
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>