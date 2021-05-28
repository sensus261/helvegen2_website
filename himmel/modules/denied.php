
<?PHP
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['create_item'])
{
include 'inc/daten.inc.php';
?>


<h4>CREAZA ITEM</h4>

<?PHP
 
    if(isset($_POST['submit']) && $_POST['submit']=="Create") {
    
      if(is_numeric($_POST['aid'])) {
        $sqlCmd = "SELECT COUNT(*) AS checkIn FROM account.account WHERE id='".$_POST['aid']."' LIMIT 1";
        $cmd = mysql_query($sqlCmd) or die(mysql_error());
		$getCount = mysql_fetch_object($cmd) ;
        if($getCount->checkIn==1) {
          
          if(!empty($_POST['window']) && is_numeric($_POST['position']) && !empty($_POST['itemtyp']) && is_numeric($_POST['stufe']) && is_numeric($_POST['stapelmenge'])) {
            if(!empty($_POST['vnum']) && is_numeric($_POST['vnum'])) {
              $avnum=$_POST['vnum'];
            }
            else {
              if($_POST['itemtyp']>=11971 && $_POST['itemtyp']<=11974) {
                $_POST['stufe']=0;
              }
              $avnum=$_POST['itemtyp']+$_POST['stufe'];
            }
			$luamid=mysql_query("select * from player.item where id=(SELECT MAX(id) FROM player.item)");
			$idul = mysql_fetch_array($luamid);
			$var_id=$idul['id']+1;
			  $ids = $_SESSION['user'];
  $tsd = mysql_fetch_row(mysql_query("SELECT id,login from account.account where login='$ids'")) or die(mysql_error());
            $sqlCmd="INSERT INTO player.item
            (owner_id,window,pos,count,vnum,socket0,socket1,socket2,attrtype0,attrvalue0,attrtype1,attrvalue1,attrtype2,attrvalue2,attrtype3,attrvalue3,attrtype4,attrvalue4,attrtype5,attrvalue5,attrtype6,attrvalue6)
              VALUES
              ('".$_POST['aid']."','".$_POST['window']."','".$_POST['position']."','".$_POST['stapelmenge']."','".$avnum."','".$_POST['socket0']."','".$_POST['socket1']."','".$_POST['socket2']."','".$_POST['boni0']."','".$_POST['boniv0']."','".$_POST['boni1']."','".$_POST['boniv1']."','".$_POST['boni2']."','".$_POST['boniv2']."','".$_POST['boni3']."','".$_POST['boniv3']."','".$_POST['boni4']."','".$_POST['boniv4']."','".$_POST['boni5']."','".$_POST['boniv5']."','".$_POST['boni6']."','".$_POST['boniv6']."')";
            $sqlQry = mysql_query($sqlCmd) or die(mysql_error());
			
		
			$ora = date("H:i");
			$data = date("d.M.Y");
			$sqlCmdLog="INSERT INTO  web.ic_log
            (autor,autorid,id,owner_id,window,pos,count,vnum,socket0,socket1,socket2,attrtype0,attrvalue0,attrtype1,attrvalue1,attrtype2,attrvalue2,attrtype3,attrvalue3,attrtype4,attrvalue4,attrtype5,attrvalue5,attrtype6,attrvalue6,ora,data)
              VALUES
              ('$tsd[1]','$tsd[0]','$var_id','".$_POST['aid']."','".$_POST['window']."','".$_POST['position']."','".$_POST['stapelmenge']."','".$avnum."','".$_POST['socket0']."','".$_POST['socket1']."','".$_POST['socket2']."','".$_POST['boni0']."','".$_POST['boniv0']."','".$_POST['boni1']."','".$_POST['boniv1']."','".$_POST['boni2']."','".$_POST['boniv2']."','".$_POST['boni3']."','".$_POST['boniv3']."','".$_POST['boni4']."','".$_POST['boniv4']."','".$_POST['boni5']."','".$_POST['boniv5']."','".$_POST['boni6']."','".$_POST['boniv6']."','$ora','$data')"; // check !
            $sqlQryLog = mysql_query($sqlCmdLog) or die('test');
			
            if($sqlQry) {
              echo succes("Itemul cu id ".$var_id." a fost creat cu succes!");
			  
            }
          }
          else { echo error("Itemul nu a putut fi creat pentru ca datele dvs sunt incorecte."); }          
        }
        else { echo error("AccountID-ul este gresit"); }
      }
      else { echo error("Introduceti un accountID valid."); }
    
    }
  
  
  
?>
<form action="" method="POST">
  <table>
    <tr>
      <th class="topLine">AccountID:</th>
      <td class="tdunkel"><input type="text" name="aid" size="11" value="<?PHP echo $_GET['acc']; ?>" maxlength="11" class="iRg_input"/></td>
    </tr>
    <tr>
      <th class="topLine">Loc:</th>
      <td class="thell">
        <select name="window" class="iRg_input">
          <option value="SAFEBOX">Depozit</option>
          <option value="MALL">Depozit ItemShop</option>
          <!-- <option value="INVENTORY">Inventar</option> -->
        </select>
      </td>
    </tr>
    <tr>
      <th class="topLine">Pozitie (Max. 44)</th>
      <td class="tdunkel"><input name="position" type="text" size="20" value="0" maxlength="20"  class="iRg_input"/></td>
    </tr>
    <tr>
      <th class="topLine">Item:</th>
      <td class="thell">
           <input type="text" name="itemtyp" size="11" value="" maxlength="11"  class="iRg_input"/>
        <select name="stufe" class="iRg_input">
          <?PHP 
            for($i=0;$i<10;$i++) {
            
              echo "<option value=\"$i\">+$i</option>";
            
            }
          ?>
        </select>
       
      </td>
    </tr>
    <tr>
      <th class="topLine">Numar de iteme:</th>
      <td class="tdunkel"><input type="text" name="stapelmenge" size="20" maxlength="20" value="1"  class="iRg_input"/></td>
    </tr>
    <tr>
      <th class="topLine">Stone #1:</th>
      <td class="thell">
        <select name="socket0"  class="iRg_input">
          <?PHP
            foreach($itemSteine AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <th class="topLine">Stone #2:</th>
      <td class="tdunkel">
        <select name="socket1"  class="iRg_input">
          <?PHP
            foreach($itemSteine AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <th class="topLine">Stone #3:</th>
      <td class="thell">
        <select name="socket2"  class="iRg_input">
          <?PHP
            foreach($itemSteine AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <th class="topLine">Bonus #1:</th>
      <td class="tdunkel">
        <select name="boni0"  class="iRg_input">
          <?PHP
            foreach($itemBoni AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
        <input type="text" name="boniv0" size="6" maxlength="6"  class="iRg_input"/>
      </td>
    </tr>
    <tr>
      <th class="topLine">Bonus #2:</th>
      <td class="thell">
        <select name="boni1"  class="iRg_input">
          <?PHP
            foreach($itemBoni AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
        <input type="text" name="boniv1" size="6" maxlength="6"  class="iRg_input"/>
      </td>
    </tr>
    <tr>
      <th class="topLine">Bonus #3:</th>
      <td class="tdunkel">
        <select name="boni2" class="iRg_input">
          <?PHP
            foreach($itemBoni AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
        <input type="text" name="boniv2" size="6" maxlength="6"  class="iRg_input"/>
      </td>
    </tr>
    <tr>
      <th class="topLine">Bonus #4:</th>
      <td class="thell">
        <select name="boni3"  class="iRg_input">
          <?PHP
            foreach($itemBoni AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
        <input type="text" name="boniv3" size="6" maxlength="6"  class="iRg_input"/>
      </td>
    </tr>
    <tr>
      <th class="topLine">Bonus #5:</th>
      <td class="tdunkel">
        <select name="boni4" class="iRg_input">
          <?PHP
            foreach($itemBoni AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
        <input type="text" name="boniv4" size="6" maxlength="6"  class="iRg_input"/>

      </td>
    </tr>
    <tr>
      <th class="topLine">Bonus #6:</th>
      <td class="thell">
        <select name="boni5"  class="iRg_input">
          <?PHP
            foreach($itemBoni AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
        <input type="text" name="boniv5" size="6" maxlength="6"  class="iRg_input"/>
      </td>
    </tr>
    <tr>
      <th class="topLine">Bonus #7:</th>
      <td class="tdunkel">
        <select name="boni6"  class="iRg_input">
          <?PHP
            foreach($itemBoni AS $aKey => $aValue) {
              echo'<option value="'.$aKey.'">'.$aValue.'</option>';
            }
          ?>
        </select>
        <input type="text" name="boniv6" size="6" maxlength="6"  class="iRg_input"/>
      </td>
    </tr>
    <tr>
      <th class="topLine" colspan="2" style="text-align:center;">
      <br /><input type="submit" value="Create" name="submit" class="buton"/> &bull; <input type="reset" value="Reset" class="buton"/></th>
    </tr>
  </table>
</form>
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>