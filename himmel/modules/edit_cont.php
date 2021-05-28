<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['edit_cont'])
{?>
<h4>DETALII CONT </h4>
<?php 
$ui = replace($_GET['cont']);
$chk = mysql_query("Select * from account.account where id='$ui'") or die(mysql_error());
if(mysql_num_rows($chk) !=NULL)
{
	$chkk = mysql_fetch_object($chk);
	$username = $chkk->login;
	$sql = mysql_query("Select * from account.account where login='$username'") or die(mysql_error());
	$acc=mysql_fetch_object($sql);
	$charss = mysql_query("Select * from player.player where account_id='".$acc->id."'") or die(mysql_error());
	$chars = mysql_num_rows($charss);

?>
<ul >
<li>Nume de utilizator: <?=$username?></li>
<li>Email :<span id="yourEmail"> <?=$chkk->email;?></span></li>
<li>Inregistrat la  :<span id="yourEmail"> <?=$chkk->create_time;?></span></li>
<li>Monezi dragon  :<span id="yourEmail"> <?=$chkk->coins;?></span> [<a href="index.php?page=add_monezi&cont=<?=$ui?>">+</a>]</li>
<li>Grad pe site  :<span id="yourEmail"> <?=$chkk->web_admin;?></span></li>
<li>Status cont  :<span id="yourEmail"> <?=$chkk->status;?></span></li>
<li>Ip  :<span id="yourEmail"> <?=$chkk->web_ip;?></span></li>

</ul>

<h4>Optiuni :</h4><table width="100%" border="0">
 <?php if($chkk->status=="BLOCK")
{ debanare_cont();?> <tr class="top">
    <td><a href="index.php?page=edit_cont&cont=<?=$ui?>&debanare=<?=$ui?>" class="btn">&raquo; Debanare</a></td>
    <td><em class="edit_cont">Scoate banul contului</em></td>
  </tr>
  <?php } ?>
  <tr  class="top">
    <td><a href="index.php?page=a_caractere&cont=<?=$ui?>" class="btn">&raquo; Caractere[<?=$chars?>]</a></td>
    <td><em class="edit_cont">Vezi caractere</em></td>
  </tr>
  <tr  class="top">
    <td><a href="index.php?page=a_parola&cont=<?=$ui?>" class="btn">&raquo; Parola</a></td>
    <td><em class="edit_cont">Pune o parola noua</em></td>
  </tr>
  <tr  class="top">
    <td><a href="index.php?page=a_resetare_parola&cont=<?=$ui?>" class="btn">&raquo; Resetare parola</a></td>
    <td><em class="edit_cont">Pune o noua parola</em></td>
  </tr>
  <tr  class="top">
    <td><a href="index.php?page=ban_cont&cont=<?=$ui?>" class="btn">&raquo; Ban</a></td>
    <td><em class="edit_cont">Baneaza contul</em></td>
  </tr>
  <tr  class="top">
    <td><a href="index.php?page=add_monezi&cont=<?=$ui?>" class="btn">&raquo; Monezi</a></td>
    <td><em class="edit_cont">Adauga monezi acestui cont</em></td>
  </tr>
  <tr  class="top">
    <td><a href="index.php?page=create_item&acc=<?=$ui?>" class="btn">&raquo; Creaza item</a> </td>
    <td><em class="edit_cont">Creaza un item pentru acest cont</em></td>
  </tr>
</table>
<h4>Ban log :</h4>
<table width="100%" border="0">
  <tr  class="top">
  <td width="18%" class="iR_stats_level">Data </td>
    <td width="18%" class="iR_stats_level">Nume </td>
    <td width="12%" class="iR_stats_level">Admin</td>
    <td width="34%" class="iR_stats_level">Motiv</td>
    <td width="18%" class="iR_stats_level">Perioada</td>
  </tr>
 <?php 
 $result2 = mysql_query("SELECT * FROM web.dev_ban_log where player='$username'");
 while($ban = mysql_fetch_object($result2))
  {
	  if($ban->durata != "UNBANNED")
	  {
		 $clasa = "msg_error";    
	  }
	  else
	  {
		  $clasa = "msg_succes";  
	  }
	  if($ban->durata == "PERMANENT" || $ban->durata=="UNBANNED")
	  {
		$durata = $ban->durata;  
	  }
	  else
	  {
		$durata = date('d/m/Y', $ban->durata);;  
	  }
  ?>
  <tr  class="top">
  <td class="iR_stats_reset"><?=$ban->data?></td>
    <td class="iR_stats_reset"><?=$ban->player?></td>
    <td class="iR_stats_reset"><?=$ban->admin?></td>
    <td class="iR_stats_reset"><?=$ban->motiv?></td>
    <td class="<?=$clasa?>"><?=$durata?></td>
  </tr>
    <?php
} 
?>
</table>
<?php }
else { echo error("Id account gresit.Introdu un cont existent."); }?>
<br>
<br />
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>