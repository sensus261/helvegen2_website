<?php
if(isset($_SESSION['user']) && isset($_SESSION['pass'])){

?>
<h4>ASK FOR DELETATION CODE  :</h4>
The deletation code is very important which implies some security reasons.<br />
To get the deletation code,press the button below and you will receive it via email.
<?php cod_securitate(); ?>
<div align="right"><form action="" name="sendSocialcodeDisplayLink" method="POST">
<input type="submit" name="sendSocialcodeDisplayLink" class="buton" value="SEND ME THE CODE"/>
</form></div>

<?php } else {echo "Acces restrictionat";}?> 