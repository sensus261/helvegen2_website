<?php
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=  $drepturi['log_comenzi_admin']){
	?><form action="" method="POST"><table width="66%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%">Nume admin : </td>
    <td width="24%" ><input type="text" name="numeadmin" id="barx" class="iRg_input" /></td>
    <td width="51%"><input type="submit" name="cauta" class="buton" value="Cauta" /></td>
  </tr>
</table>
</form>

<table width="100%" border="0"  cellpadding="1" cellspacing="1"><?php

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

	function showPage($i, $page, $class, $selected = 'pagination_selected')
	{
		if ($page==$i)
		{
			$data .= '<span class="'. $selected .'">'. $i .'</span> ';
		}
		else
		{
			global $name;
			$pagina = replace($_GET['page']);
				$data .= '<span  class="'. $class .'"><a href="?page='.$pagina.'&id='.$i.'" onclick="load()">'. $i .'</a></span> ';
		}
		return $data;
	}
	
if ((!isset($_GET['id'])) || (!is_numeric($_GET['id'])) || ($_GET['id'] < 1)) { $pagenum = 1; }
	else { $pagenum = $_GET['id']; 
	
	}
	$page_rows = 55;
	if (($pagenum > $last) && ($last > 0)) { $pagenum = $last; }
	$max = $pagenum * $page_rows;
	$min = $max - $page_rows;

	$result = mysql_query("SELECT * FROM log.command_log");


	$rows = mysql_num_rows($result);
	$last = ceil($rows/$page_rows);
$i = 0;

	if(isset($_POST['cauta']))
	{
		$numeadmin = replace($_POST['numeadmin']);
		if($numeadmin !=NULL)
		{
				$result2 = mysql_query("Select * from log.command_log where username='$numeadmin'  ORDER BY date DESC limit ".($page_rows * ($pagenum - 1)).", ".$page_rows." ") or die(mysql_error());	
		}
		else { 
				$result2 = mysql_query("Select * from log.command_log   ORDER BY date DESC limit ".($page_rows * ($pagenum - 1)).", ".$page_rows." ") or die(mysql_error());
		}
	}
	else { 
	$result2 = mysql_query("Select * from log.command_log  ORDER BY date DESC limit ".($page_rows * ($pagenum - 1)).", ".$page_rows." ") or die(mysql_error());
	}

while($acs = mysql_fetch_object($result2))
{

	?>

<tr class="top">
    <td width="35%" class="iR_stats_level">[<?=$acs->date?>] <?=$acs->username?> :</td>
    <td width="65%" class="iR_stats_reset">/<?=$acs->command?></td>
    
  </tr>

    <?php
} 
echo "</table>";
echo "<br><div align='center'><font color='white'>";
	echo generatePages($last, $pagenum, "pagination");
	echo "</font></div>"; } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>
 
