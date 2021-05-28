<?php

if(!isset($_SESSION['user']) && !isset($_SESSION['pass'])) 

{

?><div id="msg"><?php

if(isset($_POST['register']))

{

			$usern = replace($_POST['utilizator']);

			$pass = replace($_POST['parola']);

			$email = replace($_POST['email']);

			//$referal = $_POST['ref'];

			$idcard = replace($_POST['idcard']);

			$ques=$_POST["question"];

			$answ=$_POST["answer"];

			$ques2=$_POST["question2"];

			$answ2=$_POST["answer2"];

			$birthyear=$_POST["BirthYear"];

			$birthmonth=$_POST["BirthMonth"];

			$birthday=$_POST["BirthDay"];

			$addr=$_POST["Addr"];

			$postcode=$_POST["PostCode"];

			$mobile=$_POST["Mobile"];

			$telephone=$_POST["Telephone"];

			$ip = getenv("REMOTE_ADDR");

			$referal = replace($_POST['referal']);

			$create_time = date("Y-m-d H:i:s");

			if (md5($_POST['norobot']) == $_SESSION['randomnr2'])	

			{ 

				if((strlen($usern) >= 5) && (strlen($pass) >= 5)&&(strlen($email) >= 12)&&(strlen($idcard)==7))

				{

					$usr = mysql_query("Select * from account.account where login='$usern'");

					$ema = mysql_query("Select * from account.account where email='$email'");

					if((mysql_num_rows($usr)==1)|| (mysql_num_rows($ema)==1))

					{

						echo error("Account or e-mail used.Try others or click <a href='index.php?page=recuperare-pw'>aici</a> to reset your password.");

					}

					else

					{	

						if($_POST['read'] == "checked")

						{

							$rand = rand(99999,9999999999);

							$cod_activ = md5($rand);

							//$cod_activ= "1";

							mysql_query("Insert into account.account (Login,Password,Real_name,Social_id,Email,status,create_time,gold_expire,silver_expire,safebox_expire,autoloot_expire,fish_mind_expire,marriage_fast_expire,money_drop_rate_expire,coins,web_aktiviert)  

							values('$usern',password('$pass'),'$name','$idcard','$email','OK','$create_time','2022-12-31 12:00:00','2022-12-31 12:00:00','2022-12-31 12:00:00','2022-12-31 12:00:00','2022-12-31 12:00:00','2022-12-31 12:00:00','2022-12-31 12:00:00','0','$cod_activ')") or die(mysql_error());

						echo succes('Account succesfully created.You can login now!');

						$to      = $email;

						$subject = 'Activare cont!';

						$message = "

						

		Salut ".$usern. "\r\n" ."

		Pentru a activa contul tau acceseaza linkul de mai jos ". "\r\n" ."

		http://helvegen2.com/index.php?page=activare-cont&cont=".$usern."&cod=".$cod_activ."

						";

						$headers = 'Acest mesaj a fost generat automat.Va rugam nu raspundeti.';

						//new mail($to, $subject, $message, $headers);

							if($referal!=NULL)

							{

								$cx = mysql_query("Select * from account.account where login='$referal'");

								

								if(mysql_num_rows($cx)==0)

								{

									echo error("Referalul nu exista");	

								}

								else

								{

									mysql_query("Insert into web.referals (owner,referal,colected) values ('$referal','$usern','0')") or die(mysql_error());

								}

							}

						}

						else { echo error('Trebuie sa citesti regulamentul si sa fii de acord cu el.');}

						}}		

				else

				{

						echo error('Minim 5 caractere.');

				}

			}

			else

			{

				echo error('SPAM!Introduceti corect codul din imagine');	

			}

}

?></div>

<link href="../img/style.css" rel="stylesheet" type="text/css" />




<table width="100%" align="center" class="content" style="margin-top:10px;">
<td valign="top">
<fieldset class="is_cats">
<legend class="top"><h4>REGISTER</h4></legend>



  Please complete ale fields correctly.





<form name="sign_up_frm" method="post" action="" id="registerForm">

<table border="0" cellspacing="10" cellpadding="0" width="100%" style="margin-top: 10px;" align="center">

<tr>

<td colspan="3" align="left" class="table_head">General Informations :</td>

</tr>

<tr>

<td align="left" style="padding-left: 24px;" width="173">Username</td>

<td width="470" align="left" class="iRg_inf"><input name="utilizator" type="text" class="iRg_input" id="username1" onblur="return check_username();" maxlength="14" required="required"/><div id="info"></div></td>

<td width="293" align="left" ><span class="iRg_inf">

<div id="c_uss">6-14 characters,letters/numbers</div></span></td>

</tr>

<tr>

<td align="left" style="padding-left: 24px;" width="173">Password</td>

<td width="470" align="left" class="iRg_inf"><input name="parola" type="password" id="parola" maxlength="14" required="required"  class="iRg_input"/>  <div id="info"></div></td>

<td width="293" align="left" ><span class="iRg_inf">

<div id="c_uss">6-14 characters,letters/numbers</div></span></td>

</tr>

<tr>

<td align="left" style="padding-left: 24px;">Deletation Code</td>

<td align="left"><span class="iRg_inf">

  <input name="idcard" type="text" class="iRg_input" id="username2" onblur="return check_username();" maxlength="7" required="required"/>

</span></td>

<td align="left"><span class="iRg_inf">

<div id="c_uss">7 numbers</div></span></td>

</tr>



</tr>

<tr>

<td colspan="3" align="left" class="table_head">E-mail :</td>

</tr>

<tr>

<td align="left"  style="padding-left: 24px;">E-mail Address</td>

<td align="left" class="iRg_inf"><input name="email" type="text" id="email1" maxlength="25" required="required" onblur="return check_email();" class="iRg_input"/></td>

<td align="left"><span class="iRg_inf">

<div id="c_mss">ex: somebody@gmail.com</div></span></td>

</tr><?php if(isset($_GET['referal']) && $_GET['referal']!=NULL)

	{

		$ref = replace($_GET['referal']);

		?>

<tr>

<td colspan="3" align="left" class="table_head">Invitat :</td>

</tr>

<tr>

<td align="left" style="padding-left: 24px;" width="173">Nume referal</td>

<td align="left" class="iRg_inf"><input name="referal" type="text" id="referal" disabled="disabled" value="<?=$ref?>" class="iRg_input"/></td>

<td align="left" ><span class="iRg_inf">

<div id="c_uss">numele celui care te-a invitat</div></span></td>

</tr>

<?php } ?>



<tr>

<td colspan="3" align="left" class="table_head">Anti-spam :</td>

</tr>

<tr>

<td align="left">Captcha: </td>

<td>

  <input type="text"  name="norobot" maxlength="4" title="" value=""  required="required" id="norobot" class="iRg_input"/></td>

  <td><img src="top/spam.php" alt="captcha"/></td>

</tr>

  <tr>

    <td colspan="3" align="center">

   I read the terms and condtions * <input type="checkbox" name="read"  value="checked" style="margin-top:-20px; margin-left:48px;"  /></a>

    

    </td>

  </tr>

    <tr>

    <td colspan="3" align="center"><input type="submit" id="register" name="register" value="Register" class="buton" /></td>

  </tr>
</table>
</fieldset>
</table></form>

<?php } else {echo error("Esti deja logat.");}?>