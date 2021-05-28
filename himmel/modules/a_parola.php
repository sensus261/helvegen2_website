<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['a_parola'])
{
	a_parola();
	$Cont = replace($_GET['cont']);
	$getCont = mysql_query("Select * from account.account where id='$Cont'");
	if(mysql_num_rows($getCont)!=NULL){
	?>
<h4>SCHIMBA PAROLA :</h4>
<form action="" method="POST">
<table width="50%" border="0">
  <tr>
    <td>Introdu noua parola :</td>
    <td><input type="password" name="parola" id="parola"  class="iRg_input"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="schimba" id="schimba" value="Schimba"  class="buton"/></td>
  </tr>
</table>
</form><br>

<?php } else { echo error("Contul nu exista.Alege un alt cont."); }
}
 else { error("Zona restrictionata");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>