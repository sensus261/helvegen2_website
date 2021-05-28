<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['descarcari'])
{
	adauga_descarcari();
	if(isset($_GET['sterge'])&&is_numeric($_GET['sterge']))
	{
		$id = replace($_GET['sterge']);
		mysql_query("Delete from web.dev_descarcari where id='$id'");	
		echo succes("Linkul de download a fost sters!");
	}
?>
<h4>ADAUGA LINK DESCARCARE :</h4>
<form action="" method="POST"><table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td>Nume :</td>
    <td><input name="nume" type="text"  class="iRg_input" id="nume" maxlength="40"/></td>
  </tr>
  <tr>
    <td width="21%">Tip :</td>
    <td width="79%"><select name="tip" id="barx">
      <option value="DIRECT">DIRECT</option>
      <option value="TORRENT">TORRENT</option>
      <option value="MIRROR">MIRROR</option>
    </select></td>
  </tr>
  <tr>
    <td>Link :</td>
    <td><input type="text" name="link" id="link"  class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Marime :</td>
    <td>
          <input name="marime" type="text"  class="iRg_input" id="marime" maxlength="5"/> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Fara http://</td>
  </tr>
  <tr>
   <Td></Td><td><input type="submit" name="adauga" id="adauga" value="ADAUGA LINK" class="buton" /></td>
  </tr>
</table>
</form>
<h4>LISTA :</h4>
<table width="100%" border="0">
 
  <?php $dd = mysql_query("Select * from web.dev_descarcari");
  while($d = mysql_fetch_object($dd))
  {
  ?>
  <tr class="top">
    <td class="iR_stats_reset">[<?=$d->tip?>] <?=$d->nume?></td>
     <td class="iR_stats_reset"><?=$d->data?></td>
     <td class="iR_stats_reset"><?=$d->marime?> MB</td>
     <td class="collect"><a href="index.php?page=a_descarcari&sterge=<?=$d->id?>"><font color="white">STERGE</font></a></td>
  </tr>
  <?php } ?>
</table>
<p>&nbsp;</p>
<div class="shadow" >
  <a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>
</div>
<?php } ?>
