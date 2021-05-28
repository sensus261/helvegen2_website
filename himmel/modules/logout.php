<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
	session_start();
    unset($_SESSION['user']);
	unset($_SESSION['pass']);
	session_destroy();
	echo "Logout succesfully...";
	echo '<meta http-equiv="refresh" content="1;url=index.php">'
?>