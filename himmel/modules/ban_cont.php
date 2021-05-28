<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=  $drepturi['ban_cont'])
{
$ui = replace($_GET['cont']);
$qq = mysql_query("Select * from account.account where id='$ui'");
				if(mysql_num_rows($qq)!=NULL){ ?>

<h4>BANEAZA CONT </h4>

<?php ban_char();?>
<form action="" method="POST">
<table width="469" border="0">
  <tr>
    <td width="139">Motiv :</td>
    <td colspan="2"><input name="motiv" type="text" id="motiv" maxlength="100" class="iRg_input" /></td>
    </tr>
  <tr>
    <td width="139">Selecteaza perioada :</h5></td>
    <td width="107">
    	<select name="perioada" id="barx">
        	<option value="permanent">Permanent</option>
            <option value="zi">O zi</option>
			<option value="3zi">3 zile</option>
            <option value="saptamana">O saptamana</option>
            <option value="luna">O luna</option>
        </select>
    </td>
    <td width="209"><input type="submit" name="baneaza" id="baneaza" value="Baneaza"  class="buton"/></td>
  </tr>
</table>
</form>
<br>
<?php } else { echo error("Contul nu exista.Alege un altul."); }  } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>