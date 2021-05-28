<table border="0" align="center" cellpadding="0" cellspacing="0" width="90%" >
   <tr>
    <td colspan="3" height="5"></td>
    </tr>
  <tr class="top">
    <td>#</td>
    <td>NAME</td>
    <td align="center">LEVEL</td>
  </tr><?php 
 	$query = "SELECT * FROM player.player  WHERE name NOT LIKE '[GM]%' AND name NOT LIKE '[GA]%' AND name NOT LIKE '[GF]%' AND name NOT LIKE '[BA]%'  AND name NOT LIKE '[VIP]%' AND name NOT LIKE '[TGM]%' AND name NOT LIKE '[SGM]%' AND name NOT LIKE '[K1LL3R]' AND name NOT LIKE '[SGA]%' AND name NOT LIKE '[HITACU]' ORDER BY level desc, exp desc, name asc limit 0,10";
      $i = "0" ;
	  
	  
 $doQuery = mysql_query($query) or die(mysql_error());
while($getPlayers = mysql_fetch_object($doQuery))
   {
   $i = $i + 1 ;
  
   $cache_content .= '
 	<tr class="top">
    <td width="23">'.$i.'</td>
    <td width="141">'.$getPlayers->name.'</td>
    <td width="53" align="center">'.$getPlayers->level.'</td>
  	</tr>
	';

}

if ( !file_exists('inc/player_cache.txt'))
 {
$q1_cache = fopen('inc/player_cache.txt', 'w');
fwrite($q1_cache, $cache_content);
fclose($q1_cache);
 }
 else
 {
	 if (filemtime('inc/player_cache.txt') < (time() - 900))
	 {
		unlink('inc/player_cache.txt');
		$q1_cache = fopen('inc/player_cache.txt', 'w');
		fwrite($q1_cache, $cache_content);
		fclose($q1_cache);
	 }
	 else
	 {
		 $q1_cache = fopen('inc/player_cache.txt', 'r');
		 $cache_content = fread($q1_cache, filesize('inc/player_cache.txt') + 1);
		 fclose($q1_cache);
		 echo $cache_content;
	 }
 }
	


				?>  <tr>
    <td colspan="3" height="5"></td>
    </tr></table>
	