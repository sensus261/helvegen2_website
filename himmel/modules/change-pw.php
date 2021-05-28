<?php
if(isset($_SESSION['user']) && isset($_SESSION['pass'])){

?><?php if(isset($_GET['cod']) && $_GET['cod']!=NULL)
{ 	
	include ('inc/configurare.php');
	$cod = replace($_GET['cod']);
	$log = $_SESSION['user'];
	$vrf = mysql_query("Select * from ".$account_db.".account where passchange_token='$cod' and login='$log'");
	if(mysql_num_rows($vrf)==0)
	{
		echo error("Incorrect or expired link");
	}
	else { 
	schimbare_pw_confirmata();
	?>
       
 <h4>  Change Password :</h4>

   
       New Password : 
        <form action="" method="POST">
        <input type="password" id="newPassword" name="newPassword" value="" maxlength="16" class="iRg_input"/>
        <input id="submitBtn" type="submit" name="SubmitLostPasswordCodeForm" value="CHANGE" class="iR_stats"/>
        </form>
    
    <?php }	
} 
else 
{?>
<h4>CHANGE PASSWORD  :</h4>
<?php schimbare_pw();?>
For Security reasons , we must to send you the password via email.<Br />
To confirm the changing,click on the link received via email.<br>
<div align="right"><form action="" name="passwordchangerequestForm" method="POST">
<input type="submit" name="passwordchangerequest"  class="buton" value="SEND EMAIL CONFIRMATION"/>
</form></div>
<?php } ?>

<?php } else { echo "You have to be logged in to finish this action!";}?>