<?php 
function link_vot2()
{
	if(isset($_POST['adauga']))
	{
		$nume = replace($_POST['nume']);
		$valoare = replace($_POST['valoare']);
		$link = replace($_POST['link']);
		if($link && $valoare && $nume)
		{
			mysql_query("Insert into web.vote (nume,valoare,link) values ('$nume','$valoare','$link')") or die(mysql_error());
			echo succes("Link adaugat cu succes");	
		}
		else
		{
			echo error("Completeaza toate campurile");	
		}
	}
}
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['linkuri_vot'])
{
	link_vot2();?>
<h4>ADAUGA LINK VOT </h4>
<form action="" method="POST">
<table width="90%" border="0">
  <tr>
    <td width="20%">Nume :</td>
    <td width="80%"><input type="text" name="nume" id="nume"  class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Valoare :</td>
    <td><input type="text" name="valoare" id="valoare" class="iRg_input" maxlength="4"/></td>
  </tr>
    <tr>
    <td>Link :</td>
    <td><input type="text" name="link" id="link" class="iRg_input"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="adauga" id="adauga" value="Adauga" class="buton"/></td>
  </tr>
</table>
</form>
<h4>LINKURI VOT DISPONIBILE </h4>
  <table cellpadding="1" cellspacing="1" width="90%"><?php
  $vt = mysql_query("Select * from web.vote");
  if(isset($_GET['sterge']))
  {
	$str = replace($_GET['sterge']);
	mysql_query("Delete from web.vote where id='$str'");
	echo succes("Link sters");
  }
  while($vote = mysql_fetch_object($vt))
  {
	  $count++;
  ?>

	<tr class="top">
    	<td width="5%" class="iR_stats_reset"><?=$count?># </td>
    	<td width="82%" class="iR_stats_reset"><strong><?=$vote->nume?> 
    	</strong> valoreaz&atilde; <strong><?=$vote->valoare?></strong> monezi</td><td width="13%" class="collect"><a href="index.php?page=a_linkuri_vot&sterge=<?=$vote->id?>"><font color="white">Sterge</font></a></td>
    </tr>

	
		


  <?php } ?>
</table>
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>