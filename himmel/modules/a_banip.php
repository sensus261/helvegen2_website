<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['baneaza_ip'])
{

	if(isset($_POST['arde']))
	{
		$ip = $_POST['ipa'];
		$motiv = $_POST['motiv'];
		$data = date("d.M.Y");
		$fp = fopen('banlist.ini', 'a');
		fwrite($fp, "
<tr>
	<td width=\"20%\" class=\"iR_stats_reset\">".$ip."</td><td width=\"50%\" class=\"iR_stats_reset\">".$motiv."</td><td width=\"30%\" class=\"iR_stats_reset\">".$data."</td></tr>
</tr>");
		fclose($fp);
		
		echo succes("Banat cu succes");
	}
?>
<h4>BANEAZA IP ACCES WEBSITE </h4>
<form action="" method="POST">
<table width="256" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="82">IP :</td>
    <td width="174"><input name="ipa" type="text" class="iRg_input"></td>
  </tr>
  <tr>
    <td>Motiv :</td>
    <td> <input name="motiv" type="text" class="iRg_input"></td>
  </tr>
  <tr>
   <td>&nbsp;</td>
    <td><input type="submit" name="arde" value="BANEAZA ACCES WEBSITE" class="buton" ></td>
  </tr>
</table>
</form>

<h4>LISTA IP-URI BANATE </h4>
<table width="100%">
<tr class="top">
<td width="20%" class="iR_stats_level">IP</td><td width="50%" class="iR_stats_level">Motiv</td><td width="30%" class="iR_stats_level">Data</td></tr>
<tr class="top">
<?php
// get contents of a file into a string
$filename = "banlist.ini";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
echo $contents;
fclose($handle);
?>


</table>
<br>
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>