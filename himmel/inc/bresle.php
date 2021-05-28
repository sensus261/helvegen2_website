<table border="0" align="center" cellpadding="0" cellspacing="0" width="90%" >
   <tr>
    <td colspan="3" height="5"></td>
    </tr>
  <tr class="top">
    <td>#</td>
    <td>NAME</td>
    <td align="center">POINTS</td>
  </tr>
<?php 
$db	= "player";		
mysql_select_db($db) OR
die();
$query2 = "SELECT * FROM guild WHERE guild.name NOT LIKE 'STAFF' ORDER BY level desc, exp desc, exp desc, win desc, name asc limit 0,10";
$i = "0" ;
$doQuery2 = mysql_query($query2);
while($b = mysql_fetch_object($doQuery2))
{
	$i = $i + 1 ;
	$leader = $b->master;
	$cache_content2 .= '
	<tr class="top">
    <td width="23">'.$i.'</td>
    <td width="141">'.$b->name.'</td>
    <td width="53" align="center">'.$b->ladder_point.'</td>
  	</tr>
	';
}
if (!file_exists('inc/bresle_cache.txt'))
{
	$b2_cache = fopen('inc/bresle_cache.txt', 'w');
	fwrite($b2_cache, $cache_content2);
	fclose($b2_cache);
}
else
{
	if (filemtime('inc/bresle_cache.txt') < (time() - 18000))
	{
		unlink('inc/bresle_cache.txt');
		$b2_cache = fopen('inc/bresle_cache.txt', 'w');
		fwrite($b2_cache, $cache_content2);
		fclose($b2_cache);
	
	}
	else
	{
		$b2_cache = fopen('inc/bresle_cache.txt', 'r');
		$cache_content2 = fread($b2_cache, filesize('inc/bresle_cache.txt') + 1);
		fclose($b2_cache);
		echo $cache_content2;	
	}
}
	


?>
<tr>
    <td colspan="3" height="5"></td>
    </tr></table>
	