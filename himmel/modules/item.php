<?PHP
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['view_item'])
  {

	retrage_item();
?>
<h4>DETALII ITEM </h4>
<?php
if(isset($_GET['id']))
	{
		$id = replace($_GET['id']);
		 include('inc/daten.inc.php');
		if($id !=NULL && is_numeric($id))
		{
			$ques = mysql_query("Select * from player.item where id='$id'");
			if(mysql_num_rows($ques) ==0)
			{
				echo error("Itemul nu exista");	
			}
			else
			{
				echo '<table width="100%" border="0" >';
    			while($item2 = mysql_fetch_object($ques))
	  			{
					$item3 = mysql_fetch_object(mysql_query("Select * from player.player where id='".$item2->owner_id."'"));
					echo "<tr>
			<td valign=\"top\" class=\"iR_stats_level\">".$item2->id."<br />
			 <a href=\"index.php?page=item&id=".$item2->id."&retrage=".$item2->id."\"><font color=\"white\"><B>RETRAGE</b></font></a></td>
			<td valign=\"top\" class=\"iR_stats_reset\"><b>".nume_item($item2->vnum)." Owner : ".$item3->name."</b></td>
			<td valign=\"top\" class=\"iR_stats_reset\">";
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
			echo "</td>
			<td valign=\"top\" class=\"iR_stats_reset\">";
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
			echo "</td>
			
		   
		  </tr>";
		
		 } echo "</table>
		</table>";
			}
		}
	}
	?>
<br>
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>