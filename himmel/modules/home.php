
<?php $nm = mysql_query("Select * from web.dev_news order by id desc");
  while($nw = mysql_fetch_object($nm))
  {
  ?>
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td class="top">[<?=$nw->tip?>] <?=$nw->titlu?></td>
  </tr>
  <tr>
    <td><?=unentities($nw->continut)?><br />  <span class="mini_top"><i>Posted at <?=$nw->data?></i></span></td>
  </tr>
   <tr>
                        <td style="border-top:1px dotted #946767;;">&nbsp;</td>
                        </tr>
</table>


  <?php } ?>


