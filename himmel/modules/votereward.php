<?php
if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
function vote2()
{

	$id = replace($_GET['voteid']);
	$ip = getenv('REMOTE_ADDR'); // ip
	$owneri = mysql_query("Select id,coins from account.account where login='".$_SESSION['user']."'");
	$owner = mysql_fetch_object($owneri);
	$ownerid = $owner->id; // owner id
	$coinsa = $owner->coins; // monezi actuale
	$time = time(); // time actual
	$hours = time()+(12*60*60); // 12 ore
	$sql1 = mysql_query("Select * from web.votes where accountid='$ownerid' and voteid='$id' ");
	$sql11 = mysql_fetch_object($sql1);
	$siteid = $sql11->voteid; // id vote/site
	$data = $sql11->data; // data pt next vote
	$justip = mysql_query("Select ip from web.votes where ip='$ip'") or die(mysql_error());
	$vi = mysql_query("Select * from web.vote where id='$id'") or die(mysql_error());
	$viv = mysql_query("Select valoare from web.vote where id='$id'") or die(mysql_error());
	$coin = mysql_fetch_object($viv);
	$value = $coin->valoare;
	$rasplata = $coinsa+$value;
	if(mysql_num_rows($vi)==0)
	{
		echo error("You already voted in the last 12 hours");		
	} 
	else 
	{
		if(mysql_num_rows($sql1)>=1)
		{ // daca exista in db
		
			if($data <= $time)
			{
				mysql_query("Delete from web.votes where voteid='$id' and accountid='$ownerid'");
				mysql_query("Insert into web.votes (data,voteid,accountid,ip) values ('$hours','$id','$ownerid','$ip')");
				mysql_query("Update account.account set coins='$rasplata' where id='$ownerid'") or die(mysql_error());	
				$oradata = date("H:i:s d/m/Y");
				$ip = getenv("REMOTE_ADDR");
				//mysql_query("Insert into web.player_log (account,data,actiune) values ('".$_SESSION['user']."','$oradata','Voteaza voteid $id de pe ip $ip.')");	
				$link = $vl->link;
				echo succes("To receive the Coins..insert the code and press the VOTE button.");
				echo '<meta http-equiv="refresh" content="1;url=http://'.$link.'">';	
			}
			else
			{
				echo error("You already voted in the last 12 hours");	
			}
		} else {
				mysql_query("Insert into web.votes (data,voteid,accountid,ip) values ('$hours','$id','$ownerid','$ip')");				
				$oradata = date("H:i:s d/m/Y");
				$ip = getenv("REMOTE_ADDR");
				//mysql_query("Insert into web.player_log (account,data,actiune) values ('".$_SESSION['user']."','$oradata','Voteaza voteid $id de pe ip $ip.')");	
				mysql_query("Update account.account set coins='$rasplata' where id='$ownerid'") or die(mysql_error());	
				$vl = mysql_fetch_object($vi);
				$link = $vl->link;
				echo succes("To receive the Coins..insert the code and press the VOTE button.");
				echo '<meta http-equiv="refresh" content="1;url=http://'.$link.'">';
		}
	
			
	} 
 
}
if(isset($_GET['voteid']))
{
	vote2();
}
else 
{ 

?>

<fieldset class="is_cats"><legend class="top">Helvegen2 - Voteaza - Sectiune in lucru</legend>
  <table cellpadding="1" cellspacing="1" width="100%"><?php
  $vt = mysql_query("Select * from web.vote");
  while($vote = mysql_fetch_object($vt))
  {
	  $count++;
  ?>

	<tr class="top" style="color:#333333;">
    	<td width="5%" class="iR_stats_reset"><?=$count?># </td><td width="82%" class="iR_stats_reset"><strong><?=$vote->nume?></strong> - <strong><?=$vote->valoare?></strong> Dragon Coins</td><td width="13%" class="collect"><a href="index.php?page=votereward&voteid=<?=$vote->id?>" target="_blank"><font color="white">VOTE</font></a></td>
     </tr>
  <?php } ?>
</table>
<?php } } else { echo error("Restricted Area.Please login!");}?>