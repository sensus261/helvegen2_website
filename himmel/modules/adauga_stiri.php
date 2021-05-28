<!-- TinyMCE -->

<script type="text/javascript" src="plugins/tiny_mce/tiny_mce.js"></script>



<script type="text/javascript">

	tinyMCE.init({

		mode : "textareas",

		theme : "advanced",

		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

				theme_advanced_buttons1 : "code,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,image,|,undo,redo,visualblocks",

		theme_advanced_buttons2 : "styleselect,formatselect,fontselect,fontsizeselect,|,preview",

		


		theme_advanced_toolbar_location : "top",

		theme_advanced_toolbar_align : "left",

		theme_advanced_statusbar_location : "bottom",

		theme_advanced_resizing : true,



		// Example content CSS (should be your site CSS)

		content_css : "images/style_tiny.css",



		// Drop lists for link/image/media/template dialogs

		template_external_list_url : "lists/template_list.js",

		external_link_list_url : "lists/link_list.js",

		external_image_list_url : "lists/image_list.js",

		media_external_list_url : "lists/media_list.js",



		// Style formats

		style_formats : [

			{title : 'Bold text', inline : 'b'},

			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},

			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},

			{title : 'Example 1', inline : 'span', classes : 'example1'},

			{title : 'Example 2', inline : 'span', classes : 'example2'},

			{title : 'Table styles'},

			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}

		],



		// Replace values for the template plugin

		template_replace_values : {

			username : "Some User",

			staffid : "991234"

		}

	});

</script>



<!-- /TinyMCE --><?php 
include("inc/drepturi.php");
if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['admin'] >=$drepturi['adauga_stiri'])
{
	adauga_news();
	if(isset($_GET['sterge'])&&is_numeric($_GET['sterge']))
	{
		$id = replace($_GET['sterge']);
		mysql_query("Delete from web.dev_news where id='$id'");	
		echo succes("Sters!");
	}
?>
<h4>ADAUGA STIRI</h4>
<form action="" method="POST">
<table width="100%" border="0">
  <tr>
    <td width="17%">Titlu :</td>
    <td width="83%"><input name="titlu" type="text"  class="iRg_input"/>&nbsp;</td>
  </tr>
    <tr>
    <td>Categorie : </td>
    <td><select name="tip" id="barx">
      <option value="UPDATE">Update</option>
	  <option value="FIXURI">Fixuri</option>
      <option value="ANUNT">Anunt</option>
    </select></td>
  </tr>
  <tr>
    <td>Content :</td>
    <td><textarea id="elm1" name="elm1" rows="15" cols="20" style="width:350px" ></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="adauga" id="adauga" value="ADAUGA STIRE" class="buton" /></td>
  </tr>
</table>
</form>

<h4>LISTA STIRI </h4>
<table width="100%" border="0">
  <tr class="top">
    <td width="22%" class="iR_stats_level">Data</td>
    <td width="38%" class="iR_stats_level">Titlu</td>
    <td width="18%" class="iR_stats_level">Categorie</td>
    <td width="22%">&nbsp;</td>
  </tr>
  <?php $nn = mysql_query("Select * from web.dev_news");
  while($n = mysql_fetch_object($nn))
  {
  ?>
  <tr class="top">
    <td class="iR_stats_reset"><?=$n->data?></td>
     <td class="iR_stats_reset"><?=$n->titlu?></td>
     <td class="iR_stats_reset"><?=$n->tip?></td>
     <td class="collect"><a href="index.php?page=adauga_stiri&sterge=<?=$n->id?>"><font color="white">STERGE</font></a></td>
  </tr>
  <?php } ?>
</table><br>
<?php } else { echo error("Zona restrictionata.Drepturi de acces insuficiente.");}?><a href="index.php?page=panou-admin">&laquo; Inapoi la panou administrare</a>