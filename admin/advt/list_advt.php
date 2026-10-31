<?php require_once 'advt_field.php'; 

?>
<html>
<head>
<title>Pathway</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="javascript" src="js/jvalid.js"></script>
<script language="javascript" src="js/userjvalid.js"></script>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (admin panel.psd) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="109" valign="bottom" background="images/logo_bg.gif" style="padding-left:24px;"><img src="images/logo.gif" width="134" height="103" alt=""></td>
  </tr>
  <tr>
    <td height="5" valign="top">    </td>
  </tr>
  <tr>
    <td height="42" valign="middle" background="images/link_bg.gif"><?php include 'menu.php';?></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #ebebeb">
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="0%" valign="top"><img src="images/spacer.gif" width="2" height="10"></td>
            <td width="100%" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="2" valign="top"></td>
              </tr>
              <tr>
                <td height="39" valign="middle" background="images/heading_bg.gif" class="page_heading">Advertisement List </td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top"><table width="225"  border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr valign="top">
                    <td width="35" valign="middle"><img src="images/icon_add_extra.gif" width="29" height="26"></td>
                    <td width="50" valign="middle"><div align="left"><a href="advt_m.php?Mode=A" class="edit">Add</a></div></td>
                    <td width="21" align="center" valign="middle"><img src="images/icon_delete.gif" width="16" height="14"></td>
                    <td width="60" valign="middle"><div align="left"><a href="javascript:doAction('MD','Delete')" class="delete">Delete</a></div></td>
                    <td width="26" valign="middle"><img src="images/icon_back.gif" width="21" height="26"></td>
                    <td width="50" valign="middle" class="text"><div align="left"><a href="javascript:history.back();" class="text">Back</a></div></td>
                    <td width="6%" valign="middle" class="text">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              
					<tr>
                <td valign="top">
				  <form name="frm" method="post" >
                    <input type="hidden" name="txtMode" id="txtMode" value="">
                    <input type="hidden" name="txtCode" id="txtCode" value="">
					<input type="hidden" name="txtDCode" id="txtDCode" value="">
                    <table width="98%" border="1" align="center" cellpadding="2" cellspacing="2" bordercolor="#e3eaef" style="border-collapse:collapse;">
                      <tr bgcolor="#F6F6F6">
                        <td width="4%" height="25" valign="bottom" bgcolor="#F1F7FB" class="list_heading"><div align="center">
                            <input type="checkbox" name="chkall" onClick="checkAll(this)">
                        </div></td>
                        <td width="32%" height="25" valign="bottom" bgcolor="#F1F7FB" class="list_heading" style="padding-left:08px;">Advertisement Name</td>
                        <td width="23%" valign="bottom" bgcolor="#F1F7FB" class="list_heading" style="padding-left:08px;">Image</td>
                        <td width="15%" valign="bottom" bgcolor="#F1F7FB" class="list_heading" style="padding-left:08px;">Height </td>
                        <td width="10%" valign="bottom" bgcolor="#F1F7FB" class="list_heading" style="padding-left:08px;">Link</td>
                        <td width="16%" valign="top" bgcolor="#F1F7FB">&nbsp;</td>
                      </tr>
                      <?php
				   if($numdetail>0) {
							foreach($detail_info as $rec)
							{
						?>
                      <tr>
                        <td width="4%" height="27" valign="bottom"   class="list_heading"><div align="center">
                            <input type="checkbox" name="chk[]" value="<?php echo($rec['advt_id']); ?>">
                        </div></td>
                        <td height="27" valign="bottom" class="list_text" style="padding-left:08px;"><?php echo($rec['advt_title']); ?></td>
                        <td valign="bottom" class="list_text" style="padding-left:08px;"><img src="<?php echo($imgdir.$rec['advt_img']); ?>" width="75" height="75"></td>
                        <td valign="bottom" class="list_text" style="padding-left:08px;"><?php echo($rec['advt_title']); ?></td>
                        <td valign="bottom" class="list_text" style="padding-left:08px;"><?php echo ($rec['advt_link']); ?></td>
                        <td valign="top"><table width="55%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="36%" valign="top"><a href="advt_m.php?Code=<?php echo($rec['advt_id']); ?>&Mode=E"><img border="0" src="images/edit.jpg" width="21" height="18" title="Edit"></a></td>
                              <td width="22%" align="center" valign="top" class="sub_heading">|</td>
                              <td width="42%" align="center" valign="middle"><a href="javascript:doDelete(<?php echo($rec['advt_id']); ?>);"><img border="0" src="images/icon_delete.gif" width="16" height="14"></a></td>
         					  <td width="22%" align="center" valign="top" class="sub_heading">|</td>
                      		</tr>
                        </table></td>
                      </tr>
                      <?php
				} }
				?>
                    </table>
				    </form></td>
              </tr>
					
				
              <tr>
                <td valign="top" align="right"> <?php if($maxpage>1) { ?>
						<div class="next">
						<?php if($pageNum!=1) { ?>
						<a href="list_advt.php?<?php if($search_value!="") echo 'search_field='.$search_field.'&search_value='.$search_value.'&'?>pageid=<?php echo ($pageNum-1)?>">
						<?php } ?>
						<font color="#000000"><b>&lt;&lt;</b></font> Prev...<?php if($pageNum!=1) { ?></a><?php } ?> 
						<?php for($i=1;$i<=$maxpage;$i++) { ?>
						<a href="list_advt.php?<?php if($search_value!="") echo 'search_field='.$search_field.'&search_value='.$search_value.'&'?>pageid=<?php echo $i?>"><?php echo $i;?></a> |
						<?php } ?> 
						<?php if($pageNum!=$maxpage) { ?>
						<a href="list_advt.php?<?php if($search_value!="") echo 'search_field='.$search_field.'&search_value='.$search_value.'&'?>pageid=<?php echo ($pageNum+1)?>"><?php }?>
						....Next <font color="#000000"><b>&gt;&gt;</b></font>
						<?php if($pageNum!=$maxpage) { ?></a><?php } ?></div>
						<?php } ?>&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td height="25" align="left" valign="middle" bgcolor="#F6F6F6" class="text">&nbsp;</td>
              </tr>
              <tr>
                <td height="2" valign="top"></td>
              </tr>
            </table></td>
            <td width="0%" align="right" valign="top"><img src="images/spacer.gif" width="2" height="10"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="10" valign="top">    </td>
  </tr>
  <tr>
    <td height="53" align="center" valign="middle" background="images/footer_bg.gif"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="43%" height="20" valign="middle" class="footer">All Rights Reserved. Pathway</td>
        <td width="57%" valign="middle" class="footer"><div align="right">Developed By : <a href="http://synergysoftwares.biz/" target="_blank" class="footerlink">Synergy Software Solutions</a></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>