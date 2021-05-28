
<?php

function GeneratePassword() {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;

    }

    return $pass;

}
	$cont = replace($_GET['cont']);
	$rec = replace($_GET['cod']);
	if(isset($_GET) && $_GET['cont']!=NULL & strlen($rec) == 32)
	{
		$ch1 = mysql_query("Select * from account.account where login='$cont' AND passlost_token='$rec'") or die(mysql_error());
		if(mysql_num_rows($ch1) == 1)
		{
			$acr = mysql_fetch_object($ch1);
			$email =$acr->email;
			$new_pass = GeneratePassword();
			mysql_query("Update account.account set password=PASSWORD('$new_pass') where login='$cont'") or die(mysql_error());
			mysql_query("Update account.account set passlost_token='1' where login='$cont'") or die(mysql_error());
			$to      = $email;
			$subject = 'Your new password!';
			$message = "Hello ".$cont. "\r\n" ."
			Your new password is: ".$new_pass."\r\n" ."";
			new mail($to, $subject, $message);
			echo succes("An email with your new password has been sent to this email: $email.");
		}
		
	}
?>
<?php recuperare_pw()?>
<h4>FORGOTTEN PASSWORD :</h4>
<form action="" method="POST" >

<table width="54%" border="0">
  <tr>
    <td width="73%">USERNAME:</td>
    <td width="27%"><input type="text" id="username" name="username"  value="" maxlength="16" class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Email: </td>
    <td><input type="text" id="email" name="email" value="" maxlength="64"  class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Captcha:</td>
    <td><img src="inc/spam.php" alt="SPAM"/>
    <input type="text" id="norobot" name="norobot" maxlength="4"  value=""  class="iRg_input"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input id="submitBtn" type="submit" name="recuperare" value="SEND ME THE PASSWORD" class="buton"/></td>
  </tr>
</table>
</form>