<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['edit_cont'])
{
	$ui = replace($_GET['cont']);
	resetare_parola();
	?>
<h4>RESETARE PAROLA</h4>
Poti reseta parola contului si aceasta va fi trimisa prin email utilizatorului.<Br />
Apasa butonu de mai jos pentru a reseta parola.
<form action="" method="POST">
<input name="reseteaza" type="submit" value="Reseteaza si trimite"  class="buton"/>
</form><br>
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>