<?php
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['ban_ip'])
  {
	 if(isset($_GET['ip']) && $_GET['ip']!=NULL)
	 {
	ban_ip();
}
} ?>