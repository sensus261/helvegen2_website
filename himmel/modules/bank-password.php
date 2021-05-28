<?php
if(isset($_SESSION['user']) && isset($_SESSION['pass'])){

?>
<h4>ASK FOR DEPOSIT PASSWORD :</h4>
For security reasons,the password will be sent via email pressing the button below.
<?php parola_depozit();?>
<div align="right"><form method="POST" action="" name="sendStoragePassword">
<input type="submit" name="sendStoragePassword" class="buton" value="SEND ME THE PASSWORD"/>
</form></div>

<?php } else {echo "Acces restrictionat!";} ?>