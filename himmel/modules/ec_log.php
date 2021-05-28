<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['ec_log'])
{
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
			$page = replace($_GET['page']);
			$data .= '<span  class="'. $class .'"><a href="?page='.$page.'&id='.$i.'" onclick="load()">'. $i .'</a></span> ';
		}
		return $data;
	}
	
if ((!isset($_GET['id'])) || (!is_numeric($_GET['id'])) || ($_GET['id'] < 1)) { $pagenum = 1; }
	else { $pagenum = $_GET['id']; 
	
	}
	$page_rows = 20;
	if (($pagenum > $last) && ($last > 0)) { $pagenum = $last; }
	$max = $pagenum * $page_rows;
	$min = $max - $page_rows;

	
	$result = mysql_query("SELECT * FROM web.dev_player_edit");
	

	$rows = mysql_num_rows($result);
	$last = ceil($rows/$page_rows);
$i = 0;
/////////////////////

$result2 = mysql_query("select * from web.dev_player_edit ORDER BY data desc limit ".($page_rows * ($pagenum - 1)).", ".$page_rows.""); 

//////////////////////////////////////////
if($_GET['id'] == 1 || $_GET['id'] == NULL)
{
	$nr=0;
}
else
{
	$nr = ($_GET['id']-1)*20+$nr;	
}?>

<h4>LOG EDIT CARACTERE</h4>
<table width="100%" border="0">
  <tr class="top">
    <td width="24%" class="iR_Stats_level">Data</td>
    <td width="17%" class="iR_Stats_level">Admin</td>
    <td width="17%" class="iR_Stats_level">Player</td>
    <td class="iR_Stats_level">Initial</td>
     <td class="iR_Stats_level">Edit</td>
  </tr>
  <?php
 
  while($log = mysql_fetch_object($result2))
  {
  ?>
   <tr>
    <td width="24%" class="iR_Stats_reset"><?=$log->data?></td>
    <td width="17%" class="iR_Stats_reset"><?=$log->admin?></td>
        <td width="17%" class="iR_Stats_reset"><?=$log->player?></td>
    <td class="iR_Stats_reset"><?=$log->initial?></td>
     <td class="iR_Stats_reset"><?=$log->final?></td>
  </tr>
  <?php } ?>
</table>

<?php
echo "<br>";
echo "<div align='center'>";
	echo generatePages($last, $pagenum, "pagination");
	echo "</font></div>";
?>

 <br><?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>