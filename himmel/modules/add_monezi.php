<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['adauga_monezi'])
{
$ui = replace($_GET['cont']);
$qq = mysql_query("Select * from account.account where id='$ui'");
				if(mysql_num_rows($qq)!=NULL){ ?>

<h4>ADAUGA MONEZI </h4>
<?php plus_monezi();?>
<form action="" method="POST">
<table width="301" border="0" >
  <tr>
    <td width="77" bgcolor="">Cantitate :</td>
    <td width="150"><input type="text" name="cantitate" id="cantitate" class="iRg_input"/></td>
    <td width="60"><input type="submit" name="adauga" id="adauga" value="Adauga" class="buton" /></td>
  </tr>
</table>
</form><br>
<?php } else { echo error("Contul nu exista.Alege un altul."); } } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>