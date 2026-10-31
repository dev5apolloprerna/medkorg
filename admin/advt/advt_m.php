<?php require_once 'advt_field.php'; ?>

<html>
<head>
<title>Pathway</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
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
                <td height="39" valign="middle" background="images/heading_bg.gif" class="page_heading">Advertisement Master</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top" style="padding-left:10px"><table width="70%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#e3eaef" style="border-collapse:collapse;">
                  
                  <tr>
                    <td width="20%" height="27" valign="top">
					  <form name="frm" action="advt_add.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="advt_id" value="<?php echo $detail['advt_id'];?>" >
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="25" align="right" valign="middle" class="text"><b>Advertisement Title </b></td>
                            <td align="center" valign="middle" class="text"><b>:</b></td>
                            <td valign="middle">
                              <input name="advt_title" type="text" class="txtrequired txtbox" id="Advertisement Title" value="<?php echo $detail['advt_title'];?>" size="50">
							</td>
                          </tr>
                          <tr>
                            <td height="25" align="right" valign="middle" class="text"><b>Image</b></td>
                            <td align="center" valign="middle" class="text"><b>:</b></td>
                            <td valign="middle"><input name="advt_img" type="file" class="txtrequired txtbox" id="Image"></td>
                          </tr>
                          <tr>
                            <td height="25" align="right" valign="middle" class="text"><b>Height</b></td>
                            <td align="center" valign="middle" class="text"><b>:</b></td>
                            <td width="71%" valign="middle"><label>
                              <input name="advt_height" type="text" class="txtrequired txtbox" id="Height" value="<?php echo $detail['advt_height'];?>">
                            </label></td>
                          </tr>
                          <tr>
                            <td height="25" align="right" valign="middle" class="text"><b>Link</b></td>
                            <td align="center" valign="middle" class="text"><b>:</b></td>
                            <td valign="middle"><label>
                              <input name="advt_link" type="text" class="txtrequired txtbox" id="Link" value="<?php echo $detail['advt_link'];?>" size="50">
                            </label></td>
                          </tr>
                          <tr>
                            <td height="25" align="right" valign="middle" class="text"><b>Page </b></td>
                            <td align="center" valign="middle" class="text"><b>:</b></td>
                            <td valign="middle"><label>
                              <input name="advt_pgnum" type="text" class="txtrequired txtbox" id="Link" value="<?php echo $detail['advt_pgnum'];?>">
                            </label></td>
                          </tr>
                          <tr>
                            <td valign="top" class="text">&nbsp;</td>
                            <td align="center" valign="top" class="text">&nbsp;</td>
                            <td height="35" valign="bottom"><table width="45%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td valign="top">
                                    <input type="image"  src="images/btn_submit.gif" name="btnsubmit" width="71" height="27" onClick="return checkFormElements(this.form)">
                                  </td>
                                  <td valign="top"><img src="images/btn_cancel.gif" width="71" height="27" onClick="javascript:window.location='list_advt.php'"></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table>
					    </form></td>
                    </tr>
                  
                </table></td>
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