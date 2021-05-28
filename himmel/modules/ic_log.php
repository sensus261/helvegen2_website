<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['baneaza_ip'])
{
	retrage_item();
	include 'inc/configurare.php';
function generatePages($max, $page, $class)
	{
		if ($max>=10)
		{
			if (($page>4) && ($page<$max-3))
			{
				for ($i = 1; $i <= 3; $i++)
				{
					$data .= showPage($i,$page,$class);
				}
				$data .= '<span class="'. $class .'">...</span> ';
				for ($i = $page-1; $i <= $page+1; $i++)
				{
					$data .= showPage($i,$page,$class);
				}
				$data .= '<span class="'. $class .'">...</span> ';
				for ($i = $max-2; $i <= $max; $i++)
				{
					$data .= showPage($i,$page,$class);
				}
			}
			else
			{
				for ($i = 1; $i <= 5; $i++)
				{
					$data .= showPage($i,$page,$class);
				}
				$data .= '<span class="'. $class .'">...</span> ';
				for ($i = $max-5+1; $i <= $max; $i++)
				{
					$data .= showPage($i,$page,$class);
				}
			}
		}
		else
		{
		$max = (10 >= $max) ? $max : 10;
		for ($i = 1; $i <= $max; $i++)
		{
				$data .= showPage($i,$page,$class);
		}
		}
		return $data;
	}
		
	/**
	 * Page Style Generator .
	 * 
	 * @param int $i
	 * @param int $page
	 * @param string $class
	 * @param string $selected
	 */
	function showPage($i, $page, $class, $selected = 'pagination_selected')
	{
		if ($page==$i)
		{
			$data .= '<span class="'. $selected .'">'. $i .'</span> ';
		}
		else
		{
			global $name;
			if($_GET['clasa'] != null)
				$data .= '<span  class="'. $class .'"><a href="?page='.$_GET['page'].'&cat='.$_GET['clasa'].'&id='.$i.'" onclick="load()">'. $i .'</a></span> ';
			else
				$data .= '<span  class="'. $class .'"><a href="?page='.$_GET['page'].'&id='.$i.'" onclick="load()">'. $i .'</a></span> ';
		}
		return $data;
	}
	
if ((!isset($_GET['id'])) || (!is_numeric($_GET['id'])) || ($_GET['id'] < 1)) { $pagenum = 1; }
	else { $pagenum = $_GET['id']; 
	
	}
	$page_rows = 50;
	if (($pagenum > $last) && ($last > 0)) { $pagenum = $last; }
	$max = $pagenum * $page_rows;
	$min = $max - $page_rows;

	
	$result = mysql_query("SELECT * FROM web.ic_log");
	

	$rows = mysql_num_rows($result);
	$last = ceil($rows/$page_rows);
$i = 0;
/////////////////////

$result2 = mysql_query("select * from web.ic_log ORDER BY data desc,ora desc limit ".($page_rows * ($pagenum - 1)).", ".$page_rows.""); 

//////////////////////////////////////////
if($_GET['id'] == 1 || $_GET['id'] == NULL)
{
	$nr=0;
}
else
{
	$nr = ($_GET['id']-1)*50+$nr;	
}?>
   <h4> LOG ITEME CREATE </h4>
    <table width="100%" border="0">
  <tr class="top">
    <td class="iR_stats_level">#</td>
    <td class="iR_stats_level">Item id</td>
    <td class="iR_stats_level">Autor</td>
    <td class="iR_stats_level">Detinator</td>
    <td class="iR_stats_level">Data</td>
    <td >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<?php
while($r = mysql_fetch_object($result2))
{
	$nr++;
	$query3 = mysql_fetch_object(mysql_query("Select * from player.item where id='".$r->id."'")); // itemid
	$owner_id = $query3->owner_id;
	$getCont = mysql_fetch_object(mysql_query("Select * from account.account where id='$owner_id'"));
	$getChar = mysql_fetch_object(mysql_query("Select * from player.player where id='$owner_id'"));
	$checkCont = mysql_num_rows(mysql_query("Select * from account.account where id='$owner_id'"));
	$checkChar = mysql_num_rows(mysql_query("Select * from player.player where id='$owner_id'"));
	if($checkCont !=NULL || $checkChar !=NULL)
	{
		$detinator = "<font color='white'>$getCont->login $getChar->name</font>";
	}
	else
	{
		$detinator = "<font color='red'>STERS</font>";
	}
?>
  <tr class="top">
    <td class="iR_stats_reset"><?=$nr?></td>
    <td class="iR_stats_reset"><?=$r->id?></td>
    <td class="iR_stats_reset"><?=$r->autor?></td>
     <td class="iR_stats_reset"><?=$detinator?></td>
    <td class="iR_stats_reset"> <?=$r->ora?> <?=$r->data?></td>
    <td class="iR_stats_level">
    <a href="index.php?page=item&id=<?=$r->id?>"><font color="white">Detalii</font></a> </td>
    <td class="iR_stats_level">
     <a href="index.php?page=ic_log&retrage=<?=$r->id?>"><font color="white">Retrage</font></a>
    </td>
  </tr>
    <?php
} 
echo "</table><br>";
echo "<div align='center'>";
	echo generatePages($last, $pagenum, "pagination");
	echo "</font></div>";
?>

    
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>