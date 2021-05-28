
<?PHP

include("inc/drepturi.php");

if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['vizualizare_iteme'])
  {
		include('inc/daten.inc.php');
		$id = replace($_GET['id']);
	  	$query= mysql_query("Select * from player.player where id='$id'");
		$char = mysql_fetch_object($query);
		$cid= $char->account_id;
		$numea = mysql_fetch_object(mysql_query("Select * from account.account where id='$cid'"));
		$nume_cont = $numea->login;
		$q1 = mysql_query("Select * from player.item where owner_id='$id' and window='EQUIPMENT'");
		$q2 = mysql_query("Select * from player.item where owner_id='$id' and window='INVENTORY'");
		$q3 = mysql_query("Select * from player.item where owner_id='$cid' and window='SAFEBOX'");
		$q4 = mysql_query("Select * from player.item where owner_id='$cid' and window='MALL' order by pos");
		retrage_item();
	  ?>
      <h4>Iteme echipate :: <?=$char->name?></h4>
      <table width="100%" border="0"  >
        <?php
	  while($item = mysql_fetch_object($q1))
	  {
?>

  <tr>
    <td valign="top" class="iR_stats_level" ><?=$item->id?><br /><?=img_item($item->vnum);?>
    <a href="index.php?page=vizualizare_iteme&id=<?=$id?>&retrage=<?=$item->id?>"><font color="white"><h5>RETRAGE</h5></font></a></td>
    <td valign="top" class="iR_stats_reset" ><?=nume_item($item->vnum)?></td>
    <td valign="top" class="iR_stats_reset" ><?=$item->count?></td>
    <td valign="top" class="iR_stats_reset" ><?php
	for($i=0;$i<6;$i++) {
            if($i==0) { $akSocket = $item->socket0; }
            if($i==1) { $akSocket = $item->socket1; }
            if($i==2) { $akSocket = $item->socket2; }
            if($i==3) { $akSocket = $item->socket3; }
            if($i==4) { $akSocket = $item->socket4; }
            if($i==5) { $akSocket = $item->socket5; }
            echo'#'.($i+1).'&nbsp;';
            if(isset($itemSteine[$akSocket])) {
              echo $itemSteine[$akSocket];
            }
            else {
              echo $akSocket;
            }
            echo "<br>";
          
          }
	?></td>
    <td valign="top" class="iR_stats_reset" ><?php 
	 for($i=0;$i<7;$i++) {
            if($i==0) { $akBoni = $item->attrtype0; $akWert = $item->attrvalue0; }
            if($i==1) { $akBoni = $item->attrtype1; $akWert = $item->attrvalue1; }
            if($i==2) { $akBoni = $item->attrtype2; $akWert = $item->attrvalue2; }
            if($i==3) { $akBoni = $item->attrtype3; $akWert = $item->attrvalue3; }
            if($i==4) { $akBoni = $item->attrtype4; $akWert = $item->attrvalue4; }
            if($i==5) { $akBoni = $item->attrtype5; $akWert = $item->attrvalue5; }
            if($i==6) { $akBoni = $item->attrtype6; $akWert = $item->attrvalue6; }
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
	?></td>
    
   
  </tr>

<?php } ?></table>
 <h4>Iteme inventar :: <?=$char->name?></h4>
      <table width="100%" border="0" >
  
      <?php
	  while($item2 = mysql_fetch_object($q2))
	  {
?>

  <tr>
    <td valign="top" class="iR_stats_level" ><?=$item2->id?><br /><?=img_item($item2->vnum);?>
     <a href="index.php?page=vizualizare_iteme&id=<?=$id?>&retrage=<?=$item2->id?>"><font color="white"><h5>RETRAGE</h5></font></a></td>
    <td valign="top" class="iR_stats_reset" ><?=nume_item($item2->vnum)?></td>
    <td valign="top" class="iR_stats_reset" ><?=$item2->count?></td>
    <td valign="top" class="iR_stats_reset" ><?php
	for($i=0;$i<6;$i++) {
            if($i==0) { $akSocket = $item2->socket0; }
            if($i==1) { $akSocket = $item2->socket1; }
            if($i==2) { $akSocket = $item2->socket2; }
            if($i==3) { $akSocket = $item2->socket3; }
            if($i==4) { $akSocket = $item2->socket4; }
            if($i==5) { $akSocket = $item2->socket5; }
            echo'#'.($i+1).'&nbsp;';
            if(isset($itemSteine[$akSocket])) {
              echo $itemSteine[$akSocket];
            }
            else {
              echo $akSocket;
            }
            echo "<br>";
          
          }
	?></td>
    <td valign="top" class="iR_stats_reset" ><?php 
	 for($i=0;$i<7;$i++) {
            if($i==0) { $akBoni = $item2->attrtype0; $akWert = $item2->attrvalue0; }
            if($i==1) { $akBoni = $item2->attrtype1; $akWert = $item2->attrvalue1; }
            if($i==2) { $akBoni = $item2->attrtype2; $akWert = $item2->attrvalue2; }
            if($i==3) { $akBoni = $item2->attrtype3; $akWert = $item2->attrvalue3; }
            if($i==4) { $akBoni = $item2->attrtype4; $akWert = $item2->attrvalue4; }
            if($i==5) { $akBoni = $item2->attrtype5; $akWert = $item2->attrvalue5; }
            if($i==6) { $akBoni = $item2->attrtype6; $akWert = $item2->attrvalue6; }
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
	?></td>
    
   
  </tr>

<?php } ?></table>
 <h4>Iteme depozit :: <?=$nume_cont?></h4>
      <table width="100%" border="0" >
  
      <?php
	  while($item3 = mysql_fetch_object($q3))
	  {
?>

  <tr>
    <td valign="top" class="iR_stats_level" ><?=$item3->id?><br /><?=img_item($item3->vnum);?>
     <a href="index.php?page=vizualizare_iteme&id=<?=$id?>&retrage=<?=$item3->id?>"><font color="white"><h5>RETRAGE</h5></font></a></td>
    <td valign="top" class="iR_stats_reset" ><?=nume_item($item3->vnum)?></td>
    <td valign="top" class="iR_stats_reset" ><?=$item3->count?></td>
    <td valign="top" class="iR_stats_reset" ><?php
	for($i=0;$i<6;$i++) {
            if($i==0) { $akSocket = $item3->socket0; }
            if($i==1) { $akSocket = $item3->socket1; }
            if($i==2) { $akSocket = $item3->socket2; }
            if($i==3) { $akSocket = $item3->socket3; }
            if($i==4) { $akSocket = $item3->socket4; }
            if($i==5) { $akSocket = $item3->socket5; }
            echo'#'.($i+1).'&nbsp;';
            if(isset($itemSteine[$akSocket])) {
              echo $itemSteine[$akSocket];
            }
            else {
              echo $akSocket;
            }
            echo "<br>";
          
          }
	?></td>
    <td valign="top" class="iR_stats_reset" ><?php 
	 for($i=0;$i<7;$i++) {
            if($i==0) { $akBoni = $item3->attrtype0; $akWert = $item3->attrvalue0; }
            if($i==1) { $akBoni = $item3->attrtype1; $akWert = $item3->attrvalue1; }
            if($i==2) { $akBoni = $item3->attrtype2; $akWert = $item3->attrvalue2; }
            if($i==3) { $akBoni = $item3->attrtype3; $akWert = $item3->attrvalue3; }
            if($i==4) { $akBoni = $item3->attrtype4; $akWert = $item3->attrvalue4; }
            if($i==5) { $akBoni = $item3->attrtype5; $akWert = $item3->attrvalue5; }
            if($i==6) { $akBoni = $item3->attrtype6; $akWert = $item3->attrvalue6; }
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
	?></td>
    
   
  </tr>

<?php } ?></table>
 <h4>Iteme depozit itemshop :: <?=$nume_cont?></h4>
      <table width="100%" border="0" >
  
      <?php
	  while($item4 = mysql_fetch_object($q4))
	  {
?>

  <tr>
  	<td valign="top" class="iR_stats_level"><?=$item4->pos?></td>
    <td valign="top" class="iR_stats_level"><?=$item4->id?><br /><?=img_item($item4->vnum);?></td>
    <td valign="top" class="iR_stats_reset" ><?=nume_item($item4->vnum)?></td>
    <td valign="top" class="iR_stats_reset" ><?=$item4->count?></td>
    <td valign="top" class="iR_stats_reset" ><?php
	for($i=0;$i<6;$i++) {
            if($i==0) { $akSocket = $item4->socket0; }
            if($i==1) { $akSocket = $item4->socket1; }
            if($i==2) { $akSocket = $item4->socket2; }
            if($i==3) { $akSocket = $item4->socket3; }
            if($i==4) { $akSocket = $item4->socket4; }
            if($i==5) { $akSocket = $item4->socket5; }
            echo'#'.($i+1).'&nbsp;';
            if(isset($itemSteine[$akSocket])) {
              echo $itemSteine[$akSocket];
            }
            else {
              echo $akSocket;
            }
            echo "<br>";
          
          }
	?></td>
    <td valign="top" class="iR_stats_reset" ><?php 
	 for($i=0;$i<7;$i++) {
            if($i==0) { $akBoni = $item4->attrtype0; $akWert = $item4->attrvalue0; }
            if($i==1) { $akBoni = $item4->attrtype1; $akWert = $item4->attrvalue1; }
            if($i==2) { $akBoni = $item4->attrtype2; $akWert = $item4->attrvalue2; }
            if($i==3) { $akBoni = $item4->attrtype3; $akWert = $item4->attrvalue3; }
            if($i==4) { $akBoni = $item4->attrtype4; $akWert = $item4->attrvalue4; }
            if($i==5) { $akBoni = $item4->attrtype5; $akWert = $item4->attrvalue5; }
            if($i==6) { $akBoni = $item4->attrtype6; $akWert = $item4->attrvalue6; }
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
	?></td>
    
   
  </tr>

<?php } ?></table>
<br>
   <?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>