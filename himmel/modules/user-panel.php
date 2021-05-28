<?php
if(isset($_SESSION['user']) && isset($_SESSION['pass']))
{
    auto_unban();
	$username = $_SESSION['user'];
	$sql = mysql_query("Select * from account.account where login='".$_SESSION['user']."'") or die(mysql_error());
	$accc=mysql_fetch_object($sql);
	$charss = mysql_query("Select * from player.player where account_id='".$accc->id."'") or die(mysql_error());
	$chars = mysql_num_rows($charss);
?>
<script type='text/javascript'>
function myFunction()
{
var jmsg = "<? echo "Your account is banned up to : ".$acc->unban_date." Reason: ".$acc->motiv_ban.".After this date,the account will be unblocked automatically."; ?>";
	if(jmsg){
		alert(jmsg);
	}
	window.onload=myFunction;
}
</script>


<h4>USER INFORMATIONS</h4>

<table width="100%" border="0" class="iR_class">
  <tr>
    <td width="34%" height="21"><li>
      Username : 
        <?=acc($username,login)?>
      
    </li></td>
    
  </tr>
  <tr>
    <td><li>
      Email : <span id="yourEmail"> <?=acc($username,email);?>
      </span>
    </li></td>
  </tr>
  <tr>
    <td><li>
      Account Status : <span id="yourEmail"> <?=acc($username,status);?>
        </span>
        <?php if($acc->status=="BLOCK")
{ 
echo '<a href="#" onclick="myFunction()"> Informatii ban</a>';
}
?>
      
    </li></td>
  </tr>
  <tr>
    <td><li>
      Dragon Coins : 
          <strong>
          <?=acc($username,coins);?>  
            </strong><a id="payment_middle" href="index.php?page=doneaza" class="iR_stats_reset"><font color=white>Buy</font></a>
    </li></td>
  </tr>
  <tr>
    <td><li>
      Chips Coins : 
        <strong><?=acc($username,jcoins);?> </strong>
      
    </li>
</td>
  </tr>
  <tr>
    <td><li>
     Registered Date : 
        <?=acc($username,create_time);?> 
      
    </li>
</td>
  </tr>
</table>
<?php } else { echo "This zone is restricted.Please login to have the full acces.";} ?>
