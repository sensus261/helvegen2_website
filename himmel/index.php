<?php

session_start();

ob_start();

include_once("inc/configurare.php");

include("inc/func.dark.php");

include("inc/security.php");

error_reporting(0);

auto_unban();

sterge_cont_automat();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Helvegen2</title>

<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700' rel='stylesheet' type='text/css'>

<link href='images/style.css' rel='stylesheet' type='text/css'>

<style type="text/css">

<!--

body {

	background-image: url(images/bg.png);

	background-repeat: no-repeat;

	background-color: #141415;

	margin-left: 0px;

	margin-top: 0px;

	margin-right: 0px;

	margin-bottom: 0px;

	background-position:top center;

}

body,td,th {

	font-size: 12px;

	color: #999999;

}

a:visited {

	color: #946767;

	text-decoration: none;

}

a:link {

	color: #946767;

	text-decoration: none;

}

a:hover {

	color: #FFF;

	text-decoration: none;

}

a:active {

	text-decoration: none;

}

-->

</style>

<SCRIPT TYPE="text/javascript">

<!--

//Disable right click script

var message="Sorry, right-click has been disabled";

///////////////////////////////////

function clickIE() {if (document.all) {(message);return false;}}

function clickNS(e) {if

(document.layers||(document.getElementById&&!document.all)) {

if (e.which==2||e.which==3) {(message);return false;}}}

if (document.layers)

{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}

else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}

document.oncontextmenu=new Function("return false")

// -->

</SCRIPT>

</head>

<body>



<table width="1024" height="1858" border="0" cellpadding="0" cellspacing="0" align="center">

	<tr>

		<td colspan="3" valign="middle" background="images/topmenu.png" width="1024" height="50" alt="" align="center">

        <!-- topbar -->

    Gameplay : <font color="#8cff2f">PVM</font> &nbsp;&nbsp;&nbsp; Online Channels: <font color="#8cff2f">1</font> &nbsp;&nbsp;&nbsp; Server : <img src="http://i.imgur.com/e4Mdoup.gif"> &nbsp;&nbsp;&nbsp; Online :  <font color="#8cff2f"></font> <?php

    $exe = mysql_query("SELECT COUNT(*) as count FROM player.player WHERE DATE_SUB(NOW(), INTERVAL 25 MINUTE) < last_play;");

    $player_onlin = mysql_fetch_object($exe)->count;

	$player_online = $player_onlin + 1;

    if ($player_onlin < '3')

    echo "<span style=\"color:#008B8B\" title=\"Serverul poate fi offline\">$player_onlin</span>";

    else

    echo "<span style=\"color: #8cff2f\">$player_online</span>";



        ?> &nbsp;&nbsp;&nbsp;</span>Online(24h):<span style="color: #FFFFF"></span><?php

    $exe = mysql_query("SELECT COUNT(*) as count FROM player.player WHERE DATE_SUB(NOW(), INTERVAL 24 HOUR) < last_play;");

    $player_onlin = mysql_fetch_object($exe)->count;

	$player_online = $player_onlin + 1;

    if ($player_onlin < '3')

    echo "<span style=\"color:#008B8B\" title=\"Serverul poate fi offline\">$player_onlin</span>";

    else

    echo "<span style=\"color:#8cff2f\">$player_online</span>";



        ?>



 <!-- topbar end -->

        </td>

	</tr>

	<tr>

		<td colspan="3"><img src="images/top.png" width="1024" height="397" alt=""></td>

	</tr>

	<tr valign="top">

		<td background="images/left.png" width="244" height="1227" alt="" >

        <!-- lefttable -->

        <table width="240" border="0" cellspacing="0" cellpadding="0" style="padding-top:45px; padding-left:4px;">

          <tr valign="top">

            <td height="300">

            <!-- login start-->

        <div id="ack"></div> <?php if(!isset($_SESSION['user']) && !isset($_SESSION['pass'])){

			login();

									?>

		<form id="myForm" action="index.php?s=home" method="POST">

				<table border="0" align="center" cellpadding="1" cellspacing="0" style="padding-left:5px; padding-top:35px; ">

				  <tr>

					<td width="158"><input name="username" type="text" class="login_field" id="username" OnClick="this.value=''" value="Username"></td>

				  </tr>

				  <tr>

					<td><input name="password" type="password" class="login_field" id="password" OnClick="this.value=''" value="password"></td>

					</tr>

                     <tr>

                  <td width="61"  align="right"><button name="submit" type="submit" class="login_btn" id="submit"></button></td>

                  </tr>

				  <tr>

					<td  class="login_text"><a href="index.php?page=register" class="login_text">Register</a> - <a href="index.php?s=reset-pw" class="login_text">Reset Password</a></td>

					</tr>

					</tr>

  			</table>

  </form><?php } else{ ?> <table width="200" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

             <td width="196" height="10"></td>

          </tr><?php if($_SESSION['admin'] > 0){?>

          <tr>

            <td class="main_menu"><a HREF="index.php?page=admin-panel">&raquo; Administration</a></td>

		  </tr>                                           <?php } ?>

          <tr>

            <td class="main_menu"><a HREF="index.php?page=user-panel">&raquo; User Panel</a></td>

          </tr>

           <tr>

            <td class="main_menu"><a HREF="index.php?page=characters">&raquo; Characters</a></td>

         </tr>

		<tr>

            <td class="main_menu"><a HREF="index.php?page=donate">&raquo; Donate</a></td>

         </tr>

          <tr>

            <td class="main_menu"><a HREF="index.php?page=change-email">&raquo; Change Email</a></td>

          </tr>

		    <tr>

            <td class="main_menu"><a HREF="index.php?page=change-pw">&raquo; Change Password</a></td>

          </tr>

		    <tr>

            <td class="main_menu"><a HREF="index.php?page=bank-password">&raquo; Ask for Deposit Password</a></td>

          </tr>

		    <tr>

            <td class="main_menu"> <a HREF="index.php?page=deletation-code">&raquo; Deletation Code</a></td>

          </tr>

		      <tr>

            <td class="main_menu"><a HREF="index.php?page=delete-account">&raquo; Delete Account</a></td>

          </tr>

		    <tr>

            <td class="main_menu"><a HREF="index.php?page=votereward">&raquo; Vote 4 Us</a></td>

          </tr>

		    <tr>

            <td class="main_menu"><a HREF="index.php?page=logout">&raquo; Logout</a></td>

          </tr>

		  

        </table>   <Br> 



<?php } ?>



		</td>

      </tr> <!-- login end -->

            </td>

          </tr>

          <tr>

            <td height="200" style="padding-top:25px; padding-left:17px;" align="center"> 

            <table border="0" align="center" cellpadding="0" cellspacing="0" width="80%" >

   <tr>

    <td colspan="3" height="5"></td>

    </tr>

  	<?php include('inc/jucatori.php');?>



	        </td>

          </tr>

        </table>



        <!--lefttable end-->

        </td>

		<td background="images/content.png" width="534" height="1227" alt="">

        <!-- content -->

        <table width="500" border="0" cellspacing="0" cellpadding="0" style="padding-left:25px; padding-top:25px;">

          <tr>

            <td>

         <table width="100%" align="center" class="content">

		 	<tr>

				<td valign="top"><?php loadcontent();?>

          </td>

			</tr>

		 </table>



  </td>

          </tr>

        </table>

        <!-- content end -->

        </td>

		<td background="images/right.png" width="246" height="1227" alt="">

        <!-- righttable -->

        <table width="240" border="0" cellspacing="0" cellpadding="0" style="padding-top:45px; padding-left:4px;">

          <tr>

            <td valign="top" height="300">

            <!-- rightmenu -->

            <table width="200" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td width="196" height="10"></td>

          </tr>

          <tr>

             <td class="main_menu"><a href="index.php?page=home" >HOME</a></td>

          </tr>

          <tr>

            <td class="main_menu"><a href="index.php?page=register">REGISTER</a></td>

          </tr>

          <tr>

            <td class="main_menu"><a href="index.php?page=top_players">PLAYERS RANKING </a></td>

          </tr>

          <tr>

            <td class="main_menu"> <a href="index.php?page=top_guilds">GUILDS RANKING</a></td>

          </tr>

          <tr>

            <td class="main_menu"><a href="index.php?page=download">DOWNLOAD</a></td>

          </tr>

		  

		    <tr>

            <td class="main_menu"><a href="http://helvegen2.com/board">BOARD</a></td>

          </tr>

		  

		    <tr>

            <td class="main_menu"><a href="http://helvegen2.com/ishop">ITEMSHOP</a></td>

          </tr>



		    <tr>

            <td class="main_menu"><a href="index.php?page=donations">DONATIONS</a></td>

          </tr>

        </table> 

<br><br>

      <center><a href="index.php?page=donate"><img src="images/buydg.png" height="100" border="0"></a></center>

            <!-- rightmenu end-->

           

            </td>

          </tr>

          <tr>

            <td height="200" style="padding-top:25px; padding-right:17px;" align="center">

            <table border="0" align="center" cellpadding="0" cellspacing="0" width="80%" >

   <tr>

    <td colspan="3" height="5"></td>

    </tr>

	<?php include('inc/bresle.php');?>



	            </td>

          </tr>

        </table>



        <!-- righttable end -->

        </td>

	</tr>

	<tr>

		<td colspan="3" background="images/footer.png" width="1024" height="184" alt="">
		</br>
		</br>
		</br>
		</br>

		<p class="copyright">Copyright @ 2021 Helvegen2. All rights reserved </a> </p>
        </td>

	</tr>

</table>

</body>

</html>

