<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['panou_admin'])
{
	$username = $_SESSION['user'];
$sql = mysql_query("Select * from account.account where login='".$_SESSION['user']."'");
	$acc=mysql_fetch_object($sql);

	$charss = mysql_query("Select * from player.player where account_id='".$acc->id."'");
	$chars = mysql_num_rows($charss);
?>


<h4>ADMIN INFORMATIONS </h4>
<ul>USERNAME: <?=acc($username,login)?><br>
&raquo; Email : <?=acc($username,email)?><br>
&raquo; Grade :<span id="yourEmail"> <?=acc($username,web_admin);?></span><br>
</ul>

<br>


<table width="100%" border="0">
  <tr>
    <td width="25%"><h4>PLAYERS</h4>
&raquo; <a class="btn" href="index.php?page=u_acces" >Website Access</a>
<br>
&raquo; <a class="btn" href="index.php?page=adauga_admini">Game Access</a>
<br>
&raquo; <a class="btn" href="index.php?page=cauta_cont">Search Account</a><br>

&raquo; <a class="btn" href="index.php?page=cauta_caracter" >Search Character</a>
<br>
&raquo; <a class="btn" href="index.php?page=cauta_ip" >Search IP</a>
<br>
&raquo; <a class="btn" href="index.php?page=cauta_vnum" >Search and item (vnum)</a><br> 
&raquo; 
  <a class="btn" href="index.php?page=retrage_item" >Retrait Item</a>
  <br></td>
    <td width="25%" valign="top">
    <h4>Website Settings </h4>
&raquo; 
  <a class="btn" href="index.php?page=adauga_stiri">News / HOME</a>
<br>
&raquo; 
  <a class="btn" href="index.php?page=a_descarcari">Downloads</a>
  <br>
  &raquo; 
  <a class="btn" href="index.php?page=a_linkuri_vot">Vote links</a>
<br>
<br>
    </td>
    <td width="25%" valign="top">
    <h4>Logs</h4>
&raquo; <a class="btn" href="index.php?page=admin_comms" >Command Log</a><br>
&raquo; <a class="btn" href="index.php?page=ir_log" >Retraited Items</a><br>
&raquo; <a class="btn" href="index.php?page=ec_log" >Edit character</a><br>
&raquo; <a class="btn" href="index.php?page=log_monezi" >Coins Log</a><br>
&raquo; <a class="btn" href="index.php?page=ban_log" >Ban Log</a><br>


    </td>
	
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php } else { echo error("Restricted Area.You dont have enough rights to use this module or function.");}?><a href="index.php?page=panou-admin">&laquo; Back to Admin Panel</a>