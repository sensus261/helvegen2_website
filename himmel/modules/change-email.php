<?php
if(isset($_SESSION['user']) && isset($_SESSION['pass'])){

?><div id="msg">
<?php

if($_GET['new_email'] && $_GET['new_email']!=NULL)
{
	$log = $_SESSION['user'];
	$new_email = replace($_GET['new_email']);
	$cod = replace($_GET['cod']);
	if($new_email !=NULL && $cod!=NULL)
	{
		$chk = mysql_query("Select * from account.account where new_email_change='$new_email' and new_email_change2='$cod'");	
		// Verific daca emailul si codul sunt bune
		if(mysql_num_rows($chk)==1)
		{
			$old = mysql_fetch_object($chk);
			mysql_query("Update account.account set email='$new_email',new_email_change2='1' where login='$log'");
			echo succes("The email has been changed.Your new address is: ".$new_email.""); 
		}
		else
		{
			echo error("Incorrect Link.");	
		}
	}
}
else {
if($_GET['email']!=NULL && $_GET['cod'] !=NULL)
{
	
$log = $_SESSION['user'];
	$cod = replace($_GET['cod']);
	$email = replace($_GET['email']);
	if($cod != NULL && $email != NULL)
	{
		$cods = mysql_query("Select * from account.account where email='$email' AND emailchange_token='$cod'");
		if(mysql_num_rows($cods) == 0)
		{
			echo error("Incorrect Link.");	
		}
		else
		{
			$ch = mysql_fetch_object($cods);
			$cod = md5(rand(999,999999));
			mysql_query("Update account.account set emailchange_token='1',new_email_change2='$cod' where login='$log'") or die(mysql_error());
			$email = $ch->new_email_change;
			$to      = $email;
			$subject = 'Email Change Confirmation!';
			$message = "o confirm the changing of email acces the next below ". "\r\n" ."http://agony3.com/index.php?page=change-email&new_email=".$email."&cod=".$cod."";
			new mail($to, $subject, $message);
			echo succes("A email has been sent to the new address.");	
		}
	}
}
else {


	$oldemail = replace($_POST['oldEmail']);
	$newemail = replace($_POST['newEmail']);
	$log = $_SESSION['user'];
	if($oldemail !=NULL && $newemail !=NULL)
	{
		if($oldemail!=$newemail)
		{
			$ch1 = mysql_query("Select * from account.account where login='$log' and email='$oldemail'");
			$ch2 = mysql_query("Select * from account.account where email='$newemail'");
			if(mysql_num_rows($ch2) == 0) // Verific daca emailul nou nu exista deja
			{
				if(mysql_num_rows($ch1) == 1) // Emailul vechi este al meu
				{
					$cod = md5(rand(999,999999));
					mysql_query("Update account.account set emailchange_token='$cod',new_email_change='$newemail' where login='$log'"); // Generez cod si inserez codul si adresa noua in db
					$email = $oldemail;
					$to      = $email;
					$subject = 'Email Change Confirmation!';
					$message = "To confirm the changing of email acces the next below  ". "\r\n" ."http://agony3.com/index.php?page=change-email&email=".$oldemail."&cod=".$cod."
							";
							
		
							new mail($to, $subject, $message);
							echo succes("A mail for confirmation has been sent to the old email.Confirm to continue.");// Trimit codul pe emailul vechi.
				}
				else
				{
					echo error("The old email does not fit with the email from our database."); 	
				}
			}
			else
			{
				echo error("The new email already exists in our database.Please choose another one");
			}
		}
		else { echo error("The email are same."); } 
	} } }
	  ?></div>
<h4>Change Email :</h4>

<form name="emailChangeForm" id="emailChangeForm" method="POST" action="">
  <table width="100%" border="0">
    <tr>
    <td width="25%">Old Email : </td>
    <td width="75%"><input type="text" id="oldEmail" name="oldEmail" title="" value="" maxlength="64" class="iRg_input"/></td>
  </tr>
  <tr>
    <td>New Email : </td>
    <td><input type="text" id="newEmail" name="newEmail" title="" value="" maxlength="64" class="iRg_input"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input id="submitBtn" type="submit" name="SubmitEmailChange" value="CHANGE" class="buton"/></td>
  </tr>
</table></form>


<?php } else {echo "Trebuie sa fii logat pentru a efectua aceasta operatiune/You have to be logged in to finish this action!";}?>  