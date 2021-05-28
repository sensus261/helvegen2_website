<?php 	include('inc/daten.inc.php'); ?>
<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['cauta_vnum'])
{
	
?><form action="" method="POST">
<table width="60%" border="0">
  <tr>
    <td width="50%">Vnum :</td>
    <td width="50%"><input type="text" name="vnum"  style="width:25px;" id="barx"/></td>
  </tr>
  <tr>
    <td><select name="boni5"  id="barx">
          <?PHP
            foreach($itemBoni AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
    </select></td>
    <td><span class="thell">
      <input type="text" name="boniv5" size="6" maxlength="6"  style="width:25px;" id="barx"/>
    </span></td>
  </tr>
  <tr>
    <td><select name="boni6"  id="barx">
          <?PHP
            foreach($itemBoni AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
    </select></td>
    <td><span class="tdunkel">
      <input type="text" name="boniv6" size="6" maxlength="6"  style="width:25px;" id="barx"/>
    </span></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="cauta" id="cauta" value="Cauta" class="button btn-login btn-center-input-space" /></td>
  </tr>
  </table>
</form>


<?php
if(isset($_GET['retrage']) && $_GET['retrage']!=NULL)
{
	$itid= replace($_GET['retrage']);
	mysql_query("Update ".$player_db.".item set owner_id='96694',window='MALL' where id='$itid'");
	echo "Item retras";
}
	include ('inc/configurare.php');

	if(isset($_POST['cauta']))
	{
		$vnum = replace($_POST['vnum']);
		$bony5 = $_POST['boni5'];
		$bony6 = $_POST['boni6'];
		$bonyv5 = replace($_POST['boniv5']);
		$bonyv6 = replace($_POST['boniv6']);
		if($vnum!=NULL)
		{
				$sqlCmd=mysql_query("SELECT * from ".$player_db.".item
        WHERE vnum='".$vnum."'AND attrtype5='".$bony5."' AND attrtype6='".$bony6."' AND attrvalue5='".$bonyv5."' AND attrvalue6='".$bonyv6."'
        AND (window='EQUIPMENT' or window='MALL' or window='INVENTORY' or window='SAFEBOX')") or die(mysql_error());
       		
		echo '
		<p id="demo"></p>
		<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1">';
				echo '<tr><td bgcolor="#000000">Owner</td><td bgcolor="#000000">id</td><td bgcolor="#000000">bonusuri</td><td bgcolor="#000000"></td></tr>';
				while($ch = mysql_fetch_object($sqlCmd))
				{
					$qsr = mysql_fetch_object(mysql_query("Select * from ".$player_db.".player where id='".$ch->owner_id."'"));
					echo '<tr><td bgcolor="#000000"><a href="index.php?page=vizualizare_iteme&id='.$ch->owner_id.'">'.$qsr->name.'</a></td><td bgcolor="#000000">'.$ch->id.'</td>
					<td bgcolor="#000000">';
					for($i=0;$i<7;$i++) {
            if($i==0) { $akBoni = $ch->attrtype0; $akWert = $ch->attrvalue0; }
            if($i==1) { $akBoni = $ch->attrtype1; $akWert = $ch->attrvalue1; }
            if($i==2) { $akBoni = $ch->attrtype2; $akWert = $ch->attrvalue2; }
            if($i==3) { $akBoni = $ch->attrtype3; $akWert = $ch->attrvalue3; }
            if($i==4) { $akBoni = $ch->attrtype4; $akWert = $ch->attrvalue4; }
            if($i==5) { $akBoni = $ch->attrtype5; $akWert = $ch->attrvalue5; }
            if($i==6) { $akBoni = $ch->attrtype6; $akWert = $ch->attrvalue6; }
            echo'#'.($i+1).'&nbsp;';
            if(isset($itemBoni[$akBoni])) {
              echo $itemBoni[$akBoni];
            }
            else {
              echo $akBoni;
            }
            echo':&nbsp;'.$akWert;
            echo "<br/>";
          
          }
					
					echo '</td><td bgcolor="#000000"><a href="index.php?page=cauta_item&retrage='.$ch->id.'" onclick=\'return confirm("Sigur retragi itemul??");\'>[R]</a></td></tr>';
				}
				echo '</table>';
			
		}
	}	

?><?php }?>