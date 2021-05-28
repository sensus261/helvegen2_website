<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" >
   <tr>
    <td colspan="5" height="5"></td>
    </tr>
	<tr class="top">
	<td>#</td>
	<td>NAME</td>
	<td>POINTS</td>
	<td>EXPERIENCE</td>
	<td>LEVEL</td>
</tr>
<?php

$getID = replace($_GET['id']);
$db	= "player";		
mysql_select_db($db) OR
die();
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
	$page_rows = 25;
	if (($pagenum > $last) && ($last > 0)) { $pagenum = $last; }
	$max = $pagenum * $page_rows;
	$min = $max - $page_rows;

	
	$result = mysql_query("SELECT * FROM guild WHERE guild.name NOT LIKE 'STAFF' ORDER BY level desc, exp desc, exp desc, win desc, name asc limit 0,100");
	

	$rows = mysql_num_rows($result);
	$last = ceil($rows/$page_rows);
$i = 0;
/////////////////////

$result2 = mysql_query("SELECT * FROM guild WHERE guild.name NOT LIKE 'STAFF' ORDER BY level desc, exp desc, exp desc, win desc, name asc limit ".($page_rows * ($pagenum - 1)).", ".$page_rows.""); 

//////////////////////////////////////////
if($getID == 1 || $getID == NULL)
{
	$nr=0;
}
else
{
	$nr = ($getID-1)*25+$nr;	
}
while($sGuild = mysql_fetch_object($result2))
{
	$nr++;
	?>
<tr class="top">
	<td><?=$nr?></td>
	<td><?=$sGuild->name?></td>
	<td><?=$sGuild->ladder_point?></td>
	<td><?=$sGuild->exp?></td>
	<td><?=$sGuild->level?></td>
</tr>

    <?php
} 
echo "</table><Br>";
echo "<div align='center'>";
	echo generatePages($last, $pagenum, "pagination");
	echo "</font></div>";
?>