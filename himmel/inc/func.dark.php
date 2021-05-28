<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Metin2 WebCore by Mariuk3 @ Darkdev.eu Free Version 0.1 //// /////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
include('inc/daten.inc.php');

include ("inc/mail_class.php");
//////////////////////////////////// FREE VERSION //////////////////////////////////////////////////
function error($text)
{
	echo "<div class=\"msg_error\" align=\"left\" id=\"msg\">".$text."</div></div>";
}
function succes($text)
{
	echo "<div class=\"msg_succes\" align=\"left\" id=\"msg\">".$text."</div></div>";	
}

//////////////////////////////////// FREE VERSION //////////////////////////////////////////////////
function login()
{
	if(isset($_POST['submit']))
	{
		$username = replace($_POST['username']);
		$password = replace($_POST['password']);
		$sql = "SELECT count(*) FROM account.account where (login='$username' AND password=PASSWORD('".$password."'))";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		$acc = mysql_fetch_object(mysql_query("SELECT id,web_admin FROM account.account where (login='$username' AND password=PASSWORD('".$password."'))"));
		if($row[0] > 0)
		{
			$_SESSION['user'] = $username;
			$_SESSION['pass'] = $password;
			$_SESSION['userid']= $acc->id;
			$_SESSION['admin'] = $acc->web_admin;
			echo "<div class=\"msg_succes\" align=\"center\" style=\"width:150px;\">Login succesfully.</div>";
			echo '<meta http-equiv="refresh" content="1;url=index.php">';
		}
		else {
			echo "<div align='center'><font color='red'>Login failed.</font></div>";
			echo '<meta http-equiv="refresh" content="1;url=index.php">';

		}
	}
}
//////////////////////////////////// FREE VERSION //////////////////////////////////////////////////
function loadcontent()
{
	if(isset($_GET['page']))
	{
		$page = replace($_GET['page']);

			include("modules/".$page.".php");
	
		if(!file_exists("modules/".$page.".php"))
		{
			$error=1;
			echo error("The module doesn't exist.Contact an administrator!");

		}
	}
	else
	{
		if($page == NULL)
		{
			$page = 'home';
			include("modules/".$page.".php");
		}
	}
}
//////////////////////////////////// FREE VERSION //////////////////////////////////////////////////
function acc($usern,$opt)
{		
		$co = mysql_query("Select * from account.account where login='".$usern."'");
		$c = mysql_fetch_object($co);
		echo $c->$opt;

}
function count_ch($usern)
{
	$cc = mysql_query("Select * from account.account where login='".$usern."'");
	$cs = mysql_fetch_object($cc);
	$my = mysql_query("Select * from player.player where account_id='".$cs->account_id."'") or die(mysql_error());
	$crs = mysql_num_rows($my);
	echo $crs;
}
function clasa_c($clasa)
{
	if($clasa == "0" or $clasa == "4")
		{
            echo "Warrior";
		}
		
		elseif($clasa == "1" or $clasa == "5")
		{
            echo "Ninja";
       }

		elseif($clasa == "2" or $clasa == "6")
		{
             echo "Sura";
       }
		
		elseif($clasa == "3" or $clasa == "7")
		{
       		echo "Mage";
       	}	
}
function nume_regat($empire)
{
	if($empire == '1')
	{
		echo  "<font color='red'>Shinsoo</font>";
	}
	if($empire == '2')
	{
		echo "<font color='yellow'>Chunjo</font>";
	}
	if($empire == '3')
	{
		echo "<font color='#00ffff'>Jinno</font>";
	}	
}

function recuperare_pw()
{

		if(isset($_POST['recuperare']))
		{
			$username = replace($_POST['username']);
			$email = replace($_POST['email']);
			if($username !=NULL && $email!=NULL)
			{
				if (md5($_POST['norobot']) == $_SESSION['randomnr2']) 
				{
				include("configurare.php");
				$ch = mysql_query("Select * from account.account where login='$username' and email='$email'");
					if(mysql_num_rows($ch) == 1)
					{		$rec = md5(rand(99999,9999999));
							mysql_query("Update account.account set passlost_token='$rec' where login='$username'");
							$to      = $email;
							$subject = 'EMAIL CONFIRMATION!';
							$message = "
							
			Hello ".$username. "\r\n" ."
			You asked for you password reset but before this you need to confirm your email.Click on the link below : ". "\r\n" ."
			http://helvegen2.com/mmo/index.php?page=reset-pw&cont=".$username."&cod=".$rec."
							";
							$headers = 'This message was automatically generated.Please do not ANSWER.';
		
							new mail($to, $subject, $message, $headers);
							echo succes("A confirmation email has been sent.Follow the received instructions.");
					} else { echo error("Account or email does not match.");} 
				} else { echo error("SPAM!INSERT THE CORRECT CODE FROM THE IMAGE."); }
			}
		}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function schimbare_pw()
{
	
	if(isset($_POST['passwordchangerequest']))
	{
		$log = $_SESSION['user'];
		include("configurare.php");
		$tr = mysql_fetch_object(mysql_query("Select * from account.account where login='$log'"));
		$cod = md5(rand(999,999999));
		mysql_query("Update account.account set passchange_token='$cod' where login='$log'");
		echo succes("An email has been sent to this address: ".$tr->email."");	
		$email = $tr->email;
		$to      = $email;
		$subject = 'Password Reset Confirmation!';
		$message = "To confirm that you are agree with the password changing,follow the next link ". "\r\n" ."http://helvegen2.com/mmo/index.php?page=change-pw&cod=".$cod."";
		new mail($to, $subject, $message);
	}
}
function schimbare_pw_confirmata()
{
	
	if(isset($_POST['SubmitLostPasswordCodeForm']))
	{
		$cont = $_SESSION['user'];
		$newpw = replace($_POST['newPassword']);
		if($newpw !=NULL)
		{
			mysql_query("Update account.account set password=PASSWORD('$newpw') where login='$cont'");
			mysql_query("Update account.account set passchange_token='1' where login='$cont'");
			$data = date("h:i:s d/m/Y");
			mysql_query("Insert into web.dev_player_log (account,data,actiune) values ('$cont','$data','Parola a fost schimbata in $newpw.')");
			echo succes("Your password has been succesfully changed.");
		} else { echo error("INSERT THE NEW PASSWORD!"); }
	} else { }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function parola_depozit()
{
	
	if(isset($_POST['sendStoragePassword']))
	{
		$log = $_SESSION['user'];
		$s = mysql_fetch_object(mysql_query("Select id,email from account.account where login='$log'")) or die(mysql_error());
		$id = $s->id;
		$email = $s->email;
		$com = mysql_query("Select * from player.safebox where account_id='$id'");
		$dep = mysql_fetch_array($com);
		if($dep['password']==NULL)
		{
			$password = "000000";
		}
		else
		{
			$password = $dep['password'];
		}
		$to      = $email;
		$subject = 'DEPOSIT PASSWORD!';
		$message = "You've asked for your deposit password.The password is : ".$password."";
		new mail($to, $subject, $message);
		$data = date("h:i:s d/m/Y");
			mysql_query("Insert into web.dev_player_log (account,data,actiune) values ('$cont','$data','Reset deposit password.')");
		echo succes("The password has been sent to this address: ".$email.".");
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function cod_securitate()
{
	
	if(isset($_POST['sendSocialcodeDisplayLink']))
	{
	include("configurare.php");
		echo succes("You will receive the deletation code via e-mail.");
		$log = $_SESSION['user'];
		$xx = mysql_fetch_object(mysql_query("Select * from account.account where login='$log'")) or die(mysql_error());
		$cod = $xx->social_id;
		$email = $xx->email;
		$to      = $email;
		$subject = 'DELETATION CODE!';
		$message = "Hello ".$log."!". "\r\n" ."
		To delete a character from your account,you need to insert a deletation code.". "\r\n" ."
		Your Deletation Code is : ".$cod."". "\r\n" ."

		Memorate or note it somewhere!". "\r\n" ."


		King Regards". "\r\n" ."
		".$titlu.".";
		new mail($to, $subject, $message);
		$data = date("h:i:s d/m/Y");
			mysql_query("Insert into web.dev_player_log (account,data,actiune) values ('$cont','$data','Security code reset.')");
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function sterge_cont()
{
	if(isset($_POST['accountdeletion_submit']))
	{
			echo succes("You will receive an email in few moments.Follow the instructions with atention.");
			$log = $_SESSION['user'];
			$aa = mysql_fetch_object(mysql_query("Select * from account.account where login='$log'")) or die(mysql_error());
			$email = $aa->email;
			$cod = md5(rand(999,99999));
			$bb = mysql_query("Update account.account set stergere_account='$cod' where login='$log'");
			$to      = $email;
			include("configurare.php");
			$subject = 'DELETE ACCOUNT CONFIRMATION!';
			$message = "Hello ".$log."!". "\r\n" ."
			You have made a request to delete your account.Please confirm that clicking the link below.". "\r\n" ."
			http://helvegen2.com/mmo/index.php?page=delete-account&cont=".$log."&cod=".$cod."". "\r\n" ."
			You can cancel the deleting of the account in maximum 7 days from your user panel!". "\r\n" ."


			King Regards". "\r\n" ."
			".$titlu."";
			new mail($to, $subject, $message);
			
	}
}
function stergere_cont_final()
{
	if($_GET['cont']!=NULL && $_GET['cod']!=NULL)
	{
		$cod = replace($_GET['cod']);
		$log = $_SESSION['user'];
		$query = mysql_query("Select * from account.account where stergere_account='$cod' and login='$log'");
		if(mysql_num_rows($query)==1)
		{	
			$nextWeek = time() + (7 * 24 * 60 * 60);
			$delete = date("d/m/Y", $nextWeek);
			mysql_query("Update account.account set status='BLOCK', stergere_account='$delete' where login='$log'");
			echo succes("Contul tau va fi sters in 7 zile.");
			echo '<meta http-equiv="refresh" content="0;url=index.php?page=stergere-cont">';
		}
		else
		{
			echo error("ERROR");
			echo '<meta http-equiv="refresh" content="0;url=index.php?page=stergere-cont">';
		}
	}
}
function stergere_cont_cancel()
{
	if(isset($_POST['accountdeletion_cancel']))
	{
		$log = $_SESSION['user'];
		mysql_query("Update account.account set status='OK', stergere_account='' where login='$log'");
		echo succes("Ati anulat cu succes stergerea contului.");
		echo '<meta http-equiv="refresh" content="1;url=index.php?page=panou-user">';
	}
}
function debug()
{
if(isset($_GET['page']) && isset($_GET['debug']))
{
	$char = replace($_GET['debug']);
	$const = mysql_fetch_object(mysql_query("Select * from player.player where id='$char'"));
	$chek = mysql_fetch_object(mysql_query("Select * from account.account where id='".$const->account_id."'"));
	$aid = $chek->id;
	if(isset($_GET['debug'])) {
		
		  $sqlCmd = "SELECT * FROM player.player WHERE id='".$char."' AND account_id ='".$aid."'";
		  $sqlQry = mysql_query($sqlCmd);
		  if(mysql_num_rows($sqlQry)>0) 
		  {
			$resetPos = array();
 			$resetPos[1]['map_index']=1; // Rosu
  			$resetPos[1]['x']=468779;
  			$resetPos[1]['y']=962107;
  			$resetPos[2]['map_index']=21; // Galben
  			$resetPos[2]['x']=55700;
  			$resetPos[2]['y']=157900;
  			$resetPos[3]['map_index']=41; // Blue
  			$resetPos[3]['x']=969066;
  			$resetPos[3]['y']=278290;

			$getChar = mysql_fetch_object($sqlQry);
			$pid = $getChar->id;
			$query2 = mysql_query("SELECT * FROM player.player_index WHERE pid1='$pid' or pid2='$pid' or pid3='$pid' or pid4='$pid'") or die('ERROR');
$row2 = mysql_fetch_array($query2);
$empire = $row2['empire'];
			$lp = strtotime($getChar->timeStamp);
			$difSpielzeit = time()-$lp;
			$toGoTime = (5*60)-($difSpielzeit);
			$toGoMin = floor(($toGoTime)/60);
			$toGoSek = ($toGoTime)%60;	
			
			  $sqlUpdate = "UPDATE player.player SET map_index='".$resetPos['$empire']['map_index']."', x='".$resetPos[$empire]['x']."', y='".$resetPos[$empire]['y']."', 	exit_x='".$resetPos[$empire]['x']."', exit_y='".$resetPos[$empire]['y']."', exit_map_index='".$resetPos[$empire]['map_index']."', horse_riding='0' WHERE id='".$char."' LIMIT 1";
			  $updatePos = mysql_query($sqlUpdate) or die(mysql_error());
				  if($updatePos)
				   {
					echo succes("Your character was succesfully unbugged");
					}
					 else 
					 { 
						echo error("Error.Please try again or contact an administrator.");
					 }
			  
	
			
		  }
		  else {
			echo'<p class="meldung">'._debug_error1_.'</p>';
		  }
		
	}
	echo'<p><a href="javascript:history.back()">&laquo; Inapoi</a></p>';
}
		

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function admin_debug()
{
if(isset($_GET['page']) && isset($_GET['debug']))
{
	$char = replace($_GET['debug']);
	$const = mysql_fetch_object(mysql_query("Select * from player.player where id='$char'"));
	$chek = mysql_fetch_object(mysql_query("Select * from account.account where id='".$const->account_id."'"));
	$aid = $chek->id;
	if(isset($_GET['debug'])) {
		
		  $sqlCmd = "SELECT * FROM player.player WHERE id='".$char."' AND account_id ='".$aid."'";
		  $sqlQry = mysql_query($sqlCmd);
		  if(mysql_num_rows($sqlQry)>0) 
		  {
			$resetPos = array();
 			$resetPos[1]['map_index']=1; // Rosu
  			$resetPos[1]['x']=468779;
  			$resetPos[1]['y']=962107;
  			$resetPos[2]['map_index']=21; // Galben
  			$resetPos[2]['x']=55700;
  			$resetPos[2]['y']=157900;
  			$resetPos[3]['map_index']=41; // Blue
  			$resetPos[3]['x']=969066;
  			$resetPos[3]['y']=278290;

			$getChar = mysql_fetch_object($sqlQry);
			$pid = $getChar->id;
			$query2 = mysql_query("SELECT * FROM player.player_index WHERE pid1='$pid' or pid2='$pid' or pid3='$pid' or pid4='$pid'") or die('ERROR');
$row2 = mysql_fetch_array($query2);
$empire = $row2['empire'];
			$lp = strtotime($getChar->timeStamp);
			$difSpielzeit = time()-$lp;
			$toGoTime = (5*60)-($difSpielzeit);
			$toGoMin = floor(($toGoTime)/60);
			$toGoSek = ($toGoTime)%60;	
			
			  $sqlUpdate = "UPDATE player.player SET map_index='".$resetPos['$empire']['map_index']."', x='".$resetPos[$empire]['x']."', y='".$resetPos[$empire]['y']."', 	exit_x='".$resetPos[$empire]['x']."', exit_y='".$resetPos[$empire]['y']."', exit_map_index='".$resetPos[$empire]['map_index']."', horse_riding='0' WHERE id='".$char."' LIMIT 1"  or die(mysql_error());
			  $updatePos = mysql_query($sqlUpdate) or die(mysql_error());
				  if($updatePos)
				   {
					echo succes("Caracterul a fost debugat cu succes");
					}
					 else 
					 { 
						echo error("O eroare a aparut in procesul de debugare.Incercati din nou.");
					 }
			  
	
			
		  }
		  else {
			echo'<p class="meldung">'._debug_error1_.'</p>';
		  }
		
	}
	
}
}
function nume_item($vnum)
{
	
	$q = mysql_query("Select * from player.item_proto where vnum='$vnum'");	
	$m = mysql_fetch_object($q);
	echo "<b>".$m->locale_name."</b>";
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function adauga_acces()
{
	if(isset($_POST['adauga']))
	{
		$utilizator = replace($_POST['utilizator']);
		$nivel = $_POST['nivel'];
		$mys = mysql_query("Select * from account.account where login='$utilizator'");
		if(mysql_num_rows($mys)>0)
		{
			if($utilizator!=NULL)
			{
				mysql_query("Update account.account set web_admin='$nivel' where login='$utilizator'");	
				echo succes("Nivel $nivel adaugat utilizatorului $utilizator");
				
			}
		}
		else {
			echo error("Utilizatorul nu exista");	
		}
	}

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function cauta_cont()
{
	if(isset($_POST['cauta']))
	{
		$cont = r_text($_POST['cont']);
		if($cont !=NULL)
		{
			$ques = mysql_query("Select * from account.account where login like '%$cont%'");
			if(mysql_num_rows($ques) ==0)
			{
				echo "Contul nu exista";	
			}
			else
			{
				echo '<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1">';
				echo '<tr class="top"><td class="iR_stats_level">Userid</td><td class="iR_stats_level">Cont</td><td class="iR_stats_level">Email</td><td class="iR_stats_level">Data inregistrari</td><td class="iR_stats_level">Status</td><td>&nbsp;</td></tr>';
				while($cont = mysql_fetch_object($ques))
				{
					echo '<tr class="top"><td class="iR_stats_reset">'.$cont->id.'</td><td class="iR_stats_reset">'.$cont->login.'</td><td class="iR_stats_reset">'.$cont->email.'</td><td class="iR_stats_reset">'.$cont->create_time.'</td><td class="iR_stats_reset">'.$cont->status.'</td><td class="collect" align="center"><a href="index.php?page=edit_cont&cont='.$cont->id.'"><font color="white">Vizualizare</font></a></td></tr>';
				}
				echo '</table>';
			}
		}
	}
}
function cauta_caracter()
{
	if(isset($_POST['cauta']))
	{
		$char = r_text($_POST['caracter']);
		if($char!=NULL)
		{
			$qu = mysql_query("Select * from player.player where name like '%$char%'");	
			if(mysql_num_rows($qu) == 0)
			{
				echo error("Caracterul nu exista");	
			}
			else
			{	
				
				echo '<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1">';
				echo '<tr class="top"><td class="iR_stats_level">Owner</td><td class="iR_stats_level">Nume</td><td class="iR_stats_level">Level</td><td class="iR_stats_level">Ip</td><td>&nbsp;</td></tr>';
				while($ch = mysql_fetch_object($qu))
				{
					
					$acs = mysql_fetch_object(mysql_query("Select * from account.account where id='$ch->account_id'"));
					echo '<tr class="top"><td class="iR_stats_reset"><a href="index.php?page=edit_cont&cont='.$ch->account_id.'"><font color="white">['.$ch->account_id.']'.$acs->login.'</font></a></td><td class="iR_stats_reset">'.$ch->name.'</td><td class="iR_stats_reset">'.$ch->level.'</td><td class="iR_stats_reset"><a href="index.php?page=cauta_ip&ip='.$ch->ip.'"><font color="white">'.$ch->ip.'</font></a></td><td class="collect" align="center"><a href="index.php?page=a_caracter&id='.$ch->id.'"><font color="white">Vizualizare</font></a></td></tr>';
				}
				echo '</table>';
			}
		}
	}
}
function ban_char()
{
	if(isset($_POST['baneaza']))
	{
		
		$cont = replace($_GET['cont']);
		$motiv = replace($_POST['motiv']);
		$perioada = $_POST['perioada'];
		$query2 = mysql_query("Select * from account.account where id='$cont'");
		$nrs = mysql_fetch_object($query2);
		if($motiv !=NULL && mysql_num_rows($query2)==1)
		{
			if($perioada =="saptamana")
			{
				$per = time() + (7 * 24 * 60 * 60);	
			}
			elseif($perioada=="luna")
			{
				$per = time() + (30 * 24 * 60 * 60);	
			}
			elseif($perioada=="zi")
			{
				$per = time() + (24 * 60 * 60);	
			}
			elseif($perioada=="3zi")
			{
				$per = time() + (3 * 24 * 60 * 60);	
			}
			$ban = date("d/m/Y", $per);
			$data = date("H:i:s d-M-y ");
			if($perioada != "permanent")
			{
				mysql_query("Update account.account set unban_date='$ban',motiv_ban='$motiv',status='BLOCK' where id='$cont'");
				echo succes("Contul a fost banat.La data ".$ban." contul va fi debanat automat");
				/* Ban LOG */
				mysql_query("Insert into web.dev_ban_log (admin,player,motiv,durata,data) values('".$_SESSION['user']."','$nrs->login','$motiv','$per','$data')") or die(mysql_error());
				
			}
			else
			{
				mysql_query("Update account.account set unban_date='PERMANENT',motiv_ban='$motiv',status='BLOCK' where id='$cont'");
				echo succes("Contul a fost banat PERMANENT.Acest ban va putea fi scos doar de un GM");	
				/* Ban LOG */
				mysql_query("Insert into web.dev_ban_log (admin,player,motiv,durata,data) values('".$_SESSION['user']."','$nrs->login','$motiv','PERMANENT','$data')") or die(mysql_error());
				
			}
		}
		else
		{
			echo error("Trebuie sa aveti un motiv pentru acest ban!");
		}
	}	
}
function debanare_cont()
{
	if(isset($_GET['debanare']))
	{
		$cont = replace($_GET['debanare']);
		$query2 = mysql_query("Select * from  account.account where id='$cont' and status='BLOCK'");
		$ct = mysql_fetch_object($query2);
		$data = date("H:i:s d-M-y ");
		if(mysql_num_rows($query2)==0)
		{
			echo error("Contul nu exista sau nu are ban!");	
		}
		else
		{
			mysql_query("Update account.account set motiv_ban='Debanare',status='OK',unban_date='' where id='$cont'");
			echo succes("Contul a fost debanat");
			mysql_query("Insert into web.dev_ban_log (admin,player,motiv,durata,data) values('".$_SESSION['user']."','$ct->login','Ban scos','UNBANNED','$data')"); // LOG UNBAN
			echo '<meta http-equiv="refresh" content="2;url=index.php?page=edit_cont&cont='.$cont.'">';
		}
	}
}
function plus_monezi()
{
	if(isset($_POST['adauga']))
	{
		if(isset($_GET['cont']))
		{
			$cont = replace($_GET['cont']);
			$cantitate = replace($_POST['cantitate']);
			$query2 = mysql_query("Select * from account.account where id='$cont'");
			$old = mysql_fetch_object($query2);
			if(mysql_num_rows($query2)==0)
			{
				echo error("Contul nu exista!");	
			}
			else
			{
				$ocoins = $old->coins;
				$coins = $cantitate + $ocoins;
				$data = date("H:i:s d-M-y ");
				mysql_query("Update account.account set coins='$coins' where id='$cont'");
				echo succes("".$cantitate." monezi au fost adaugate.Acum are in total ".$coins." monezi dragon");
				mysql_query("Insert into web.dev_log_monezi (data,admin,actiune) values ('$data','".$_SESSION['user']."','A adaugat ".$cantitate." monezi userului ".$old->login."')") or die(mysql_error()); // LOG
				echo '<meta http-equiv="refresh" content="1;url=index.php?page=edit_cont&cont='.$cont.'">';
			}
		}
	}
}
function editare_caracter()
{
	if(isset($_POST['salveaza']))
	{	
		$id = replace($_GET['id']);
		$qw = mysql_query("Select * from player.player where id='$id'");
		if(mysql_num_rows($qw)==0)
		{
			echo error("Caracterul nu exista");	
		}
		else
		{	
			$old = mysql_fetch_object($qw);
			$nume = r_text($_POST['nume']);
			$level = replace($_POST['level']);
			$clasa = $_POST['job'];
			$rang = $_POST['rang'];
			$yang = replace($_POST['yang']);
			$st = replace($_POST['st']);
			$dx = replace($_POST['dx']);
			$iq = replace($_POST['iq']);
			$ht = replace($_POST['ht']);
			$data = date("h:i:s d/m/Y");
			if($nume !=NULL && $level!=NULL && $yang!=NULL && $st!=NULL && $dx!=NULL && $iq!=NULL && $ht!=NULL)
			{
				if($nume == $old->name && $rang =="")
				{
					mysql_query("Update player.player set level='$level',job='$clasa',gold='$yang',st='$st',dx='$dx',iq='$iq',ht='$ht' where id='$id'");	
					echo succes("Caracterul a fost editat cu succes!");
					mysql_query("Insert into web.dev_player_edit (data,admin,player,initial,final) values ('$data','".$_SESSION['user']."','".$old->name."','Nume : ".$old->name.", Level: ".$old->level.", St: ".$old->st.", Dx: ".$old->st.", Iq: ".$old->iq.", Ht: ".$old->ht."','Nume : $nume, Level: $level,, St: $st, Dx: $st, Iq: $iq, Ht: $ht')"); // LOG
					//echo '<meta http-equiv="refresh" content="1;url=index.php?page=edit_caracter&id='.$id.'">';
				}
				else
				{
					if($rang !="")
					{
						$nnm = mysql_query("Select * from player.player where name='$rang$nume'");
						if(mysql_num_rows($nnm) == 0)
						{
							mysql_query("Update player.player set name='$rang$nume',level='$level',job='$clasa',gold='$yang',st='$st',dx='$dx',iq='$iq',ht='$ht' where id='$id'");	
							echo succes("Caracterul a fost editat cu succes!Noul nume $rang$nume");
							mysql_query("Insert into web.dev_player_edit (data,admin,player,initial,final) values ('$data','".$_SESSION['user']."','".$old->name."','Nume : ".$old->name.", Level: ".$old->level.", St: ".$old->st.", Dx: ".$old->st.", Iq: ".$old->iq.", Ht: ".$old->ht."','Nume : $rang$nume, Level: $level, St: $st, Dx: $st, Iq: $iq, Ht: $ht')"); // LOG
							//echo '<meta http-equiv="refresh" content="1;url=index.php?page=edit_caracter&id='.$id.'">';
						}
						else
						{
							echo error("Numele ales exista deja in baza de date");	
						}
					}
					else
					{
						$nnm = mysql_query("Select * from player.player where name='$rang$nume'");
						if(mysql_num_rows($nnm) == 0)
						{
							mysql_query("Update player.player set name='$nume',level='$level',job='$clasa',gold='$yang',st='$st',dx='$dx',iq='$iq',ht='$ht' where id='$id'");	
							echo succes("Caracterul a fost editat cu succes!Noul nume $rang$nume");
							mysql_query("Insert into web.dev_player_edit (data,admin,player,initial,final) values ('$data','".$_SESSION['user']."','".$old->name."','Nume : ".$old->name.", Level: ".$old->level.", St: ".$old->st.", Dx: ".$old->st.", Iq: ".$old->iq.", Ht: ".$old->ht."','Nume : $rang$nume, Level: $level,  St: $st, Dx: $st, Iq: $iq, Ht: $ht')"); // LOG
							//echo '<meta http-equiv="refresh" content="1;url=index.php?page=edit_caracter&id='.$id.'">';
						}
						else
						{
							echo error("Numele ales exista deja in baza de date");	
						}
					}
				}
			}
			else
			{
				echo error("Nu lasati spatii goale");	
			}
		}
			
	}
}	

function cauta_ip()
{
	
	if(isset($_POST['cauta']))
	{
		$ip = replace($_POST['ip']);
		if($ip!=NULL)
		{
			$qu = mysql_query("Select * from player.player where ip like '%$ip%'") or die(mysql_error());	
			if(mysql_num_rows($qu) == 0)
			{
				echo error("Ip-ul nu exista");	
			}
			else
			{	
				
				echo '<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1">';
				echo '<tr class="top"><td class="iR_stats_level">Ip</td><td class="iR_stats_level">Cont :: Caracter</td><td>&nbsp;</td></tr>';
				while($ch = mysql_fetch_object($qu))
				{
					$account = mysql_fetch_object(mysql_query("Select * from account.account where id='$ch->account_id'"));
					echo '<tr class="top">
					<td class="iR_stats_reset">'.$ch->ip.'</td>
					<td class="iR_stats_reset"><a href="index.php?page=edit_cont&cont='.$ch->account_id.'"><font color="white">'.$account->login.'</font></a> :: <a href="index.php?page=a_caracter&id='.$ch->id.'"><font color="white">'.$ch->name.'</font></a></td>
					<td class="collect"><a href="index.php?page=ban_ip&ip='.$ch->ip.'"><font color="white">Baneaza IP</font></a></td>
					</tr>';
				}
				echo '</table>';
			}
		}
	}
	if(isset($_GET['ip']))
	{
		$ip = replace($_GET['ip']);
		if($ip!=NULL)
		{
			$qu = mysql_query("Select * from player.player where ip like '%$ip%'") or die(mysql_error());	
			if(mysql_num_rows($qu) == 0)
			{
				echo error("Ip-ul nu exista");	
			}
			else
			{	
				
				echo '<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1">';
				echo '<tr class="top"><td class="iR_stats_level">Ip</td><td class="iR_stats_level">Cont :: Caracter</td><td>&nbsp;</td></tr>';
				while($ch = mysql_fetch_object($qu))
				{
					$account = mysql_fetch_object(mysql_query("Select * from account.account where id='$ch->account_id'"));
					echo '<tr class="top">
					<td class="iR_stats_reset">'.$ch->ip.'</td>
					<td class="iR_stats_reset"><a href="index.php?page=edit_cont&cont='.$ch->account_id.'"><font color="white">'.$account->login.'</font></a> :: <a href="index.php?page=a_caracter&id='.$ch->id.'"><font color="white">'.$ch->name.'</font></a></td>
					<td class="collect"><a href="index.php?page=ban_ip&ip='.$ch->ip.'"><font color="white">Baneaza IP</font></a></td>
					</tr>';
				}
				echo '</table>';
			}
		}
	}
}
function ban_ip()
{
	$ip = replace($_GET['ip']);
	$qu = mysql_query("Select * from player.player where ip='$ip'") or die(mysql_error());	
	if(mysql_num_rows($qu) == 0)
			{
				echo error("Ip-ul nu exista");	
			}
			else
			{
				$ban = "PERMANENT";
				$motiv = "BANIP";
				$data = date("H:i:s d-M-y ");
				while($inf = mysql_fetch_object($qu))
				{
					mysql_query("Update account.account set unban_date='$ban',motiv_ban='$motiv',status='BLOCK' where id='".$inf->account_id."'");
					/* Ban LOG */
				mysql_query("Insert into web.dev_ban_log (admin,player,motiv,durata,data) values('".$_SESSION['user']."','$inf->login','$motiv','$ban','$data')");
				$nr++;
				}
				echo succes("Conturile cu ip $ip au fost banate cu succes.Perioada ban : PERMANENT");
				mysql_query("Insert into web.web_log_banip (admin,actiune) values ('".$_SESSION['user']."','Conturile cu ip $ip au fost banate cu succes.Perioada ban : PERMANENT')"); // LOG
				echo '<meta http-equiv="refresh" content="2;url=index.php?page=cauta_ip">';
			}
}
function cauta_vnum()
{
	
	include('inc/daten.inc.php');
	if(isset($_POST['cauta']))
	{
		$vnum = replace($_POST['vnum']);
		$window = $_POST['locatie'];
		if($vnum!=NULL)
		{
			$sqlCmd=mysql_query("SELECT item.*,player.name,player.account_id,account.login 
        FROM player.item
        INNER JOIN player.player 
        ON player.id=item.owner_id 
        INNER JOIN account.account 
        ON account.id=player.account_id 
        WHERE item.vnum='".$vnum."' 
        AND window='".$window."'") or die(mysql_error());
       		 $sqlCmd2=mysql_query("SELECT item.*,account.id AS account_id,account.login
        FROM player.item
        INNER JOIN account.account 
        ON account.id=item.owner_id 
        WHERE item.vnum='".$vnum."' 
        AND window='".$window."'") or die(mysql_error());
			 $iss = mysql_num_rows($sqlCmd);
			 echo succes("$iss iteme gasite.");
			 echo '<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1">';
				echo '<tr><td class="iR_stats_level">Owner</td><td class="iR_stats_level">id</td><td class="iR_stats_level">bonusuri</td></tr>';
				while($ch = mysql_fetch_object($sqlCmd))
				{
					
					echo '<tr>
					<td class="iR_stats_level">
					<a href="index.php?page=edit_cont&cont='.$ch->account_id.'">
					<font color="white">'.$ch->login.' :: '.$ch->name.'</font></a></td>
					<td class="iR_stats_level">'.$ch->id.'</td>
					<td class="iR_stats_level">';
					for($i=0;$i<7;$i++) {
            if($i==0) { $akBoni = $ch->attrtype0; $akWert = $ch->attrvalue0; }
            if($i==1) { $akBoni = $ch->attrtype1; $akWert = $ch->attrvalue1; }
            if($i==2) { $akBoni = $ch->attrtype2; $akWert = $ch->attrvalue2; }
            if($i==3) { $akBoni = $ch->attrtype3; $akWert = $ch->attrvalue3; }
            if($i==4) { $akBoni = $ch->attrtype4; $akWert = $ch->attrvalue4; }
            if($i==5) { $akBoni = $ch->attrtype5; $akWert = $ch->attrvalue5; }
            if($i==6) { $akBoni = $ch->attrtype6; $akWert = $ch->attrvalue6; }
            echo'#'.($i+1).'&nbsp;';
            if(isset($itemBoni[$akBoni])) {
              echo $itemBoni[$akBoni];
            }
            else {
              echo $akBoni;
            }
            echo':&nbsp;'.$akWert;
            echo "<br/>";
          
          }
					
					echo '</td></tr>';
				}
				echo '</table>';
			
		}
	}	
}
function cauta_item_id()
{
	if(isset($_POST['cauta']))
	{
		$id = replace($_POST['id']);
		 include('daten.inc.php');
		if($id !=NULL && is_numeric($id))
		{
			$ques = mysql_query("Select * from player.item where id='$id'");
			if(mysql_num_rows($ques) ==0)
			{
				echo error("Itemul nu exista");	
			}
			else
			{
				echo '<table width="100%" border="0" >';
    			while($item2 = mysql_fetch_object($ques))
	  			{
					echo "<tr>
			<td valign=\"top\" class=\"iR_stats_level\">".$item2->id."<br />
			 <a href=\"index.php?page=retrage_item&retrage=".$item2->id."\"><font color=\"white\"><h5>RETRAGE</h5></font></a></td>
			<td valign=\"top\" class=\"iR_stats_reset\">".nume_item($item2->vnum)."</td>
			<td valign=\"top\" class=\"iR_stats_reset\">".$item2->count."</td>
			<td valign=\"top\" class=\"iR_stats_reset\">";
			for($i=0;$i<6;$i++) {
					if($i==0) { $akSocket = $item2->socket0; }
					if($i==1) { $akSocket = $item2->socket1; }
					if($i==2) { $akSocket = $item2->socket2; }
					if($i==3) { $akSocket = $item2->socket3; }
					if($i==4) { $akSocket = $item2->socket4; }
					if($i==5) { $akSocket = $item2->socket5; }
					echo'#'.($i+1).'&nbsp;';
					if(isset($itemSteine[$akSocket])) {
					  echo $itemSteine[$akSocket];
					}
					else {
					  echo $akSocket;
					}
					echo "<br>";
				  
				  }
			echo "</td>
			<td valign=\"top\" class=\"iR_stats_reset\">";
			 for($i=0;$i<7;$i++) {
					if($i==0) { $akBoni = $item2->attrtype0; $akWert = $item2->attrvalue0; }
					if($i==1) { $akBoni = $item2->attrtype1; $akWert = $item2->attrvalue1; }
					if($i==2) { $akBoni = $item2->attrtype2; $akWert = $item2->attrvalue2; }
					if($i==3) { $akBoni = $item2->attrtype3; $akWert = $item2->attrvalue3; }
					if($i==4) { $akBoni = $item2->attrtype4; $akWert = $item2->attrvalue4; }
					if($i==5) { $akBoni = $item2->attrtype5; $akWert = $item2->attrvalue5; }
					if($i==6) { $akBoni = $item2->attrtype6; $akWert = $item2->attrvalue6; }
					echo'#'.($i+1).'&nbsp;';
					if(isset($itemBoni[$akBoni])) {
					  echo $itemBoni[$akBoni];
					}
					else {
					  echo $akBoni;
					}
					echo':&nbsp;'.$akWert;
					echo "<br/>";
				  
				  }
			echo "</td>
			
		   
		  </tr>";
		
		 } echo "</table>
		";
			}
		}
	}
}
////////////////////////////////////////////////////////////////
//////////////////////////////////////De chemat pe prima pagina
////////////////////////////////////////////////////////////////
function auto_unban()
{
	
	$data = date("d/m/Y");
	$query = mysql_query("Select * from account.account where unban_date='$data'");
	while($cont = mysql_fetch_object($query))
	{
		mysql_query("Update account.account set unban_date='',motiv_ban='',status='OK' where id='$cont->id'") or die(mysql_error());
	}
	
	
}
function sterge_cont_automat()
{
	
	$data = date("d/m/Y");
	$query = mysql_query("Select * from account.account where stergere_account='$data'");
	while($cont = mysql_fetch_object($query))
	{
		mysql_query("Delete from account.account where id='$cont->id'");
	}
}
////////////////////////////////////////////////////////////////
//////////////////////////////////////De chemat pe prima pagina
////////////////////////////////////////////////////////////////
function adauga_admini()
{
	
	if(isset($_POST['submit']))
	{
		$cont = replace($_POST['cont']);
		$char = replace($_POST['caracter']);
		$acces = $_POST['mAuthority'];
		if($cont !=NULL && $char !=NULL)
		{
			mysql_query("Insert into common.gmlist (mAccount,mName,mAuthority) values ('$cont','$char','$acces')");
			echo succes("Caracterul $char apartinant contului $cont este acum $acces");
		}
	}
}
function check_donate()
{
	if(isset($_GET['cod']) && is_numeric($_GET['cod']) && $_GET['set_status']=="Valid")
	{
		$cod = replace($_GET['cod']);
		$admin = $_SESSION['user'];
		$query = mysql_query("Select * from web.donate where cod='$cod' and status='In curs de verificare'");
		if(mysql_num_rows($query)==1)
		{
			$fetch = mysql_fetch_object($query);
			$query2 = mysql_query("Select * from account.account where login='$fetch->cont'");
			$fetch2 = mysql_fetch_object($query2);
			$rasplata = $fetch->valoarea*4;
			$paid = $rasplata + $fetch2->coins;
			mysql_query("Update account.account set coins='$paid' where login='".$fetch->cont."'");
			mysql_query("Update web.donate set status='Valid',admin='$admin' where cod='$cod'");
			echo succes("Codul $cod a fost acum validat.Contul ".$fetch2->login." a fost acreditat cu ".$rasplata." MD.Acum are in total $paid.");
		}
		else
		{
			error("Codul deja validat.");	
		}
	}
	
	if(isset($_GET['cod']) && is_numeric($_GET['cod']) && $_GET['set_status']=="Invalid")
	{
		$cod = replace($_GET['cod']);
		$admin = $_SESSION['user'];
		$query = mysql_query("Select * from web.donate where cod='$cod' and status='In curs de verificare'");
		if(mysql_num_rows($query)==1)
		{
			
			mysql_query("Update web.donate set status='Invalid',admin='$admin' where cod='$cod'");
			echo succes("Codul $cod , apartinand contului ".$fetch2->login." a fost invalidat.");
		}
		else
		{
			error("Codul deja validat.");	
		}
	}
}
function retrage_item()
{
	if(isset($_GET['retrage']))
		{
			$ii = replace($_GET['retrage']);
			$m2pos = mysql_query("Select * from player.item where owner_id='".$_SESSION['userid']."' and window='MALL' order by pos desc limit 0,1");
			$positione = mysql_fetch_object($m2pos);
			$posact = $positione->pos;
			$error=0;
			$data = date("h:i:s d/M/Y");
			if($posact < 48 )
			{
				$posact=$posact+1;
				if($posact=='0')
					{
						$posact++;
					}
			}
			else
			{
				$error=1;
					 echo alert("Imi pare rau dar depozitul dumneavoastra este plin.");
			}
			if($error!=1)
			{
				mysql_query("UPDATE player.item SET owner_id='".$_SESSION['userid']."', window='MALL', pos='$posact' WHERE id='".$ii."'");
				echo succes("Itemul cu id ".$ii." a fost retras cu succes.");
				mysql_query("Insert into web.dev_log_retrage (data,admin,actiune) values ('$data','".$_SESSION['user']."','Itemul cu id ".$ii." a fost retras cu succes.')"); // LOG
			}
			
			
		}	
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function a_parola()
{
	if(isset($_POST['schimba']))
	{
		if(isset($_GET['cont']) && is_numeric($_GET['cont']))
		{
			$cont = replace($_GET['cont']);
			if($cont!=NULL)
			{
				$check = mysql_query("Select * from account.account where id='$cont'");
				$ft = mysql_fetch_object($check);
				if(mysql_num_rows($check)==1)
				{
					$parola = replace($_POST['parola']);
					if($parola!=NULL)
					{
						mysql_query("Update account.account set password=password('$parola') where id='$cont'");
						echo succes("Noua parola a contului $ft->login este $parola.");
					}
				}
			}
			else
			{
				echo error("Alege un cont!");	
			}
		}
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function romana($var){
$new_var=str_replace("ã","a",$var);
$new_var=str_replace("â","a",$new_var);
$new_var=str_replace("Î","I",$new_var);
$new_var=str_replace("î","i",$new_var);
$new_var=str_replace("s","s",$new_var);
$new_var=str_replace("t","t",$new_var);
$new_var=str_replace("A","A",$new_var);
$new_var=str_replace("Â","I",$new_var);
$new_var=str_replace("S","S",$new_var);
$new_var=str_replace("T","T",$new_var);
$new_var=str_replace("þ","t",$new_var);
$new_var=str_replace("º","s",$new_var);
$new_var=str_replace("2147483647","-15",$new_var);
return $new_var;

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function img_item($item){	
		if (strlen($item) == 1){
		$immagine_item = "images/item/0000".$item.".png";
		}
		if(strlen($item) == 2){
		$immagine_item = "images/item/000".substr($item, 0, 1)."0.png";
		}
		if(strlen($item) == 3){
		$immagine_item = "images/item/00".substr($item, 0, 2)."0.png";
		}
		if(strlen($item) == 4){   
		$immagine_item = "images/item/0".substr($item, 0, 3)."0.png";
		}
		if(strlen($item) == 5){
		$immagine_item = "images/item/".substr($item, 0, 4)."0.png";
		}
		if(strlen($item) == 6){
		$immagine_item = "images/item/".substr($item, 0, 5)."0.png";
		}
		if(strlen($item) == 0){
		$immagine_item = "images/item/error.png";
		}
		echo "<div align='center'><img src='$immagine_item' border='0px' alt='' align='center'  style='max-height:90px;'></div>";
}

function resetare_parola()
{
	if(isset($_POST['reseteaza']))
	{
		$cont = replace($_GET['cont']);
		$password = substr(hash('sha512',rand()),0,7);
		$check = mysql_query("Select * from account.account where id='$cont'");
		if(mysql_num_rows($check)==0)
		{
			echo error("Contul nu exista.");
		}
		else
		{
			$query= mysql_query("Select * from account.account where id='$cont'");
			$conts = mysql_fetch_object($query);
			mysql_query("Update account.account set password=PASSWORD('$password') where id='$cont'");
			echo succes("".$conts->login." :: Noua parola $password a fost trimisa la email ".$conts->email.".");
			$to      = $conts->email;
			$subject = 'Noua parola!';
			$message = "Salut ".$conts->login."!". "\r\n" ."
			Ati solicitat o noua parola.". "\r\n" ."
			Parola este : ".$password."". "\r\n" ."
			
			Toate cele bune". "\r\n" ."
			Metin2RoA.";
			new mail($to, $subject, $message);
			mysql_query("Insert into web.web_a_reseteaza_parola (admin,actiune) values ('".$_SESSION['user']."','A resetat parola.Noua parola : $password a fost trimisa userului prin mail.')"); // LOG
		}
	}
}	
function adauga_news()
{
	if(isset($_POST['adauga']))
	{
		$titlu = replace($_POST['titlu']);	
		$tip = $_POST['tip'];
		$continut = $_POST['elm1'];
		$data = date("h:i:s d/M/Y");
		if($titlu && $continut)
		{
			mysql_query("Insert into web.dev_news (data,tip,continut,titlu) values ('$data','$tip','$continut','$titlu')");
			echo succes("Stire adaugata cu succes!");	
		}
		else
		{
			echo error("Spatii libere");	
		}
	}
}
////////////////////////////////////////////////////////////////////////////////
function adauga_descarcari()
{
	if(isset($_POST['adauga']))
	{
		$nume = replace($_POST['nume']);	
		$tip = $_POST['tip'];
		$link = replace($_POST['link']);
		$marime = replace($_POST['marime']);
		$data = date("d/M/Y");
		if($nume && $link && $marime)
		{
			mysql_query("Insert into web.dev_descarcari (data,tip,nume,link,marime) values ('$data','$tip','$nume','$link','$marime')") or die(mysql_error());
			echo succes("Link descarcare adaugat cu succes!");	
		}
		else
		{
			echo error("Spatii libere");	
		}
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Metin2 WebCore by Mariuk3 @ Darkdev.eu Free Version 0.1 //// /////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>