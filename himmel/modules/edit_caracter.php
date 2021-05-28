<?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['edit_caracter'])
{
	if(isset($_GET['id']) && $_GET['id']!=NULL)
	{
		$id = replace($_GET['id']);
		$querys = mysql_query("Select * from player.player where id='$id'");
		if(mysql_num_rows($querys)==0)
		{
			echo error("Caracterul nu exista");
		}
		else
		{
			$ch = mysql_fetch_object($querys);
			editare_caracter();
		}
		?>
<h4>EDITARE CARACTER</h4>
<form action="" method="POST">
<table width="400" border="0" >
 <tr>
    <td width="137">Rang :</td>
    <td width="253">
    	<select name="rang" id="barx">
        	<option value="">Niciunul</option>
            <option value="[GM]">[GM]</option>
            <option value="[GA]">[GA]</option>
            <option value="[MR]">[MR]</option>
            <option value="[VIP]">[VIP]</option>
            <option value="[MISS]">[MISS]</option>
        </select>
    </td>
  </tr>
  <tr>
    <td width="137">Nume :</td>
    <td width="253"><input name="nume" type="text"  value="<?=$ch->name?>" class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Level :</td>
    <td><input name="level" type="text" id="level" value="<?=$ch->level?>" class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Clasa :</td>
    <td>
    <select name="job" id="barx">
    	<option value="0" <?php if($ch->job=="0") { echo "selected"; } ?>> Razboinic M </option>
        <option value="1" <?php if($ch->job=="1") { echo "selected"; } ?>> Ninja F </option>
        <option value="2" <?php if($ch->job=="2") { echo "selected"; } ?>> Sura M </option>
        <option value="3" <?php if($ch->job=="3") { echo "selected"; } ?>> Saman F </option>
        <option value="4" <?php if($ch->job=="4") { echo "selected"; } ?>> Razboinic F </option>
        <option value="5" <?php if($ch->job=="5") { echo "selected"; } ?>> Ninja M </option>
        <option value="6" <?php if($ch->job=="6") { echo "selected"; } ?>> Sura F </option>
        <option value="7" <?php if($ch->job=="7") { echo "selected"; } ?>> Shaman M </option>
    </select>
    </td>
  </tr>
  <tr>
    <td>Yang :</td>
    <td><input name="yang" type="text" id="yang" value="<?=$ch->gold?>" class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Putere : </td>
    <td><input name="st" type="text" id="st" value="<?=$ch->st?>" class="iRg_input"/></td>
  </tr>
  <tr>
    <td>Dexteritate :</td>
    <td><input name="dx" type="text" id="dx" value="<?=$ch->dx?>" class="iRg_input"/></td>
  </tr>
   <tr>
    <td>Inteligenta :</td>
    <td><input name="iq" type="text" id="iq" value="<?=$ch->iq?>" class="iRg_input"/></td>
  </tr>
   <tr>
    <td>Vitalitate :</td>
    <td><input name="ht" type="text" id="ht" value="<?=$ch->ht?>" class="iRg_input"/></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="salveaza" id="salveaza" value="Salveaza" class="buton" /></td>
  </tr>
</table>
</form>
<br />
<?php }}  else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>