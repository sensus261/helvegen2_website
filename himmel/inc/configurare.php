<?php

	$titlu="Helvegen2"; 			// Titlu website 

	$server = "195.178.102.115"; 					// Ip-ul de la server 

	$user= "root"; 							// User-ul de conectare la database

	$pass = "M\$L261970!@"; 						// Parola de conectare la database

    mysql_connect($server, $user, $pass) or die(mysql_error());

	mysql_select_db('account');

	mysql_set_charset('utf8');





 ?>