<?PHP
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['retrage_item'])
  {
retrage_item();
     
?>
<h4>RETRAGE ITEM</h4>
<form action="" method="POST">
<table width="70%" border="0">
  <tr>
    <td width="29%">Intrudu id : </td>
    <td width="43%"><input type="text" name="id" id="id" class="iRg_input" /></td>
    <td width="28%"><input type="submit" class="buton" value="Cauta" name="cauta"/></td>
  </tr>
</table>
</form><br>
<?php
	  cauta_item_id();?>
	  
<br>
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>