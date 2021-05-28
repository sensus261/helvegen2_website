  <table border="0" cellspacing="4" cellpadding="0" width="100%" align="center" > 

<?php

$getID = replace($_GET['id']);
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
			$getPage = replace($_GET['page']);
			$data .= '<span  class="'. $class .'"><a href="?page='.$getPage.'&id='.$i.'" onclick="load()">'. $i .'</a></span> ';
		}
		return $data;
	}
	
if ((!isset($getID)) || (!is_numeric($getID)) || ($getID < 1)) { $pagenum = 1; }
	else { $pagenum = $getID; 
	
	}
	$page_rows = 15;
	if (($pagenum > $last) && ($last > 0)) { $pagenum = $last; }
	$max = $pagenum * $page_rows;
	$min = $max - $page_rows;

	
	$result = mysql_query("SELECT * FROM player.player limit 0,100");
	

	$rows = mysql_num_rows($result);
	$last = ceil($rows/$page_rows);
$i = 0;
/////////////////////

$result2 = mysql_query("Select * from player.player WHERE name NOT LIKE '[%]%' ORDER BY level DESC limit ".($page_rows * ($pagenum - 1)).", ".$page_rows.""); 

//////////////////////////////////////////
if($getID == 1 || $getID == NULL)
{
	$nr=0;
}
else
{
	$nr = ($getID-1)*15+$nr;	
}
while($acs = mysql_fetch_object($result2))
{
	$nr++;
	$pid = $acs->id; 
					$query2 = mysql_query("SELECT * FROM player.player_index WHERE pid1='$pid' or pid2='$pid' or pid3='$pid' or pid4='$pid'") or die('ERROR');
				$row2 = mysql_fetch_array($query2);
				$empire = $row2['empire'];
	?>
 <tr>
                        <td width="60" rowspan="3" align="center" class="collect"><img src="images/clase/<?=$acs->job?>.png" width="27" height="50" /></td>
                      
                        </tr>
                        <tr>
                        <td width="232" align="left" class="iR_stats"><?=$nr?>.<?=$acs->name?></td>
                        <td width="148" class="collect" align="center">Level
                            <?=$acs->level?></td>
                        <td width="170" align="center" class="iR_stats">Exp :
                            <?=$acs->exp?></td>
                        <td width="312" align="center" class="iR_stats_level">Empire :
                        <?=nume_regat($empire)?>
                        </td>
                        </tr>
                        <tr>
                        <td align="left" class="iR_status"><?=clasa_c($acs->job);?></td>
                        <td align="left" class="iR_status">
                        </td>
                        <td align="center" class="iR_status">Yang :
                          <?=$acs->gold?></td>
                        <td align="center" class="collect"><?=$acs->playtime?> Minutes played</td>
                        </tr>
                        <tr>
                        <td colspan="6" style="background-image:url(img/inner_line.jpg); background-repeat:repeat-x;">&nbsp;</td>
                        </tr>

    <?php
} 
echo "</table>";
echo "<div align='center'>";
	echo generatePages($last, $pagenum, "pagination");
	echo "</font></div>";
?>