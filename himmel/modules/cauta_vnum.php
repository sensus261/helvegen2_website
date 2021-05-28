<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['cauta_vnum'])
{
	
?>

<h4>Cautare item dupa vnum</h4>
<form action="" method="POST">
<table width="100%" border="0" >
  <tr>
    <td width="124" bgcolor="">Intruduceti VNUM :</td>
    <td width="144"><input type="text" name="vnum"  class="iRg_input" id="barx"/></td>
    <td width="135"><select name="locatie" class="iRg_input">
    	<option value="EQUIPMENT">Echipament</option>
        <option value="INVENTORY">Inventar</option>
        <option value="SAFEBOX">Depozit</option>
        <option value="MALL">Depozit itemshop</option>
    </select></td>
    <td width="57"><input type="submit" name="cauta" class="buton" value="Cauta !" /></td>
  </tr>
</table>
</form><br /><?php cauta_vnum();?><br />
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>