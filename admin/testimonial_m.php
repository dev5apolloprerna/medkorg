<?php require_once 'testimonial_field.php'; ?>
<html>
<head>
<title>Samaj</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function doSubmit()
{
	if(frm.selclient.selectedIndex == 0)
	{
		alert("Please select Client");
		frm.currency.focus();
	}
	
	else if(frm.selpage.selectedIndex == 0)
	{
		alert("Please select Page");
		frm.selpage.focus();
	}
	else if(frm.selsection.selectedIndex == 0)
	{
		alert("Please select Section");
		frm.selsection.focus();
	}
	
	else if(frm.txtadvtlink.value == "")
	{
		alert("Please enter Advertisement Link");
		frm.txtadvtlink.focus();
	}
	
	else
	{
		if(frm.txtMode.value == "E")
		{
			frm.txtMode.value = "EA";
			frm.submit();
		}
		else
		{
			frm.txtMode.value = "A";
			frm.submit();
		}
	}
}
//-->
</script>

<style type="text/css"><link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #666666;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style5 {color: #063968; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
.style2 {color: #FFFFFF;
	font-weight: bold;
	font-size: 13px;
}
-->
</style></style>


</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"> 
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff"><tr>
       <td valign="top" bgcolor="#FFFFFF" > <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
        Administration Panel<br>
        <br>
            </font></span></p>
        </blockquote> </td>
      </tr>
      
        
 
  <tr> 
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
        <tr> 
          <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0"> 
              <tr> 
                <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
                    <tr valign="top"> 
                      <td width="25%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td> 
                      <td>&nbsp;</td> 
                      <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" valign="top">
                            <form name="frm_testimonial" method="post" action="testimonial_add.php" enctype="multipart/form-data">
                              <input type="hidden" name="testimonial_id" id="testimonial_id2" value="<?php echo isset($testimonial['testimonial_id']) ? $testimonial['testimonial_id'] : ""; ?>">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="5" colspan="2" class="text style2"></td>
                                </tr>
                                <tr>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="19%" class="text_bold_head">Testimonial Master </td>
                                  <td width="81%"><div align="right"> </div></td>
                                </tr>
                                <tr>
                                  <td height="12"></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="middle">                       
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="5"></td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="middle" class="text"> Testimonial Name </td>
                                        <td align="center" valign="middle"><strong>:</strong></td>
                                        <td align="left" valign="middle"><input type="text" name="testimonial_name" id="testimonial_name" size="30" class="text" value="<?php echo isset($testimonial['testimonial_name']) ?$testimonial['testimonial_name'] :"" ?>"/></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="5"></td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="middle" class="text">Testimonial Description </td>
                                        <td align="center" valign="middle"><strong>:</strong></td>
                                        <td align="left" valign="middle"><textarea name="testimonial_desc" id="testimonial_desc" cols="30" rows="5"><?php echo isset($testimonial['testimonial_desc']) ? $testimonial['testimonial_desc'] : ""  ?></textarea></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="5"></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="15"></td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="middle" class="text"> Thumb Photo </td>
                                        <td align="center" valign="middle"><strong>:</strong></td>
                                        <td align="left" valign="middle"><input type="file" name="thumb_image" id="thumb_image" size="30" class="text"  ></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="15"></td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top"><input type="submit" name="btnadd" id="btnadd" value="Submit" style="cursor:pointer;" onClick="return checkToursField()" />
                                            <input type="button" name="btnadd2" id="btnadd2" value="Cancel" style="cursor:pointer;" onClick="window.location='list_testimonial.php'" /></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                          </form></td>
                        </tr>
                      </table></td> 
                    </tr> 
                    <tr valign="top"> 
                      <td>&nbsp;</td> 
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="25%" class="text_bold_head">&nbsp;</td>
                          <td><div align="right"> </div></td>
                        </tr>
                      </table></td> 
                    </tr> 
                    <tr valign="top"> 
                      <td width="1%">&nbsp;</td> 
                      <td width="74%">&nbsp;</td> 
                    </tr> 
                  </table></td> 
              </tr> 
            </table></td> 
        </tr> 
      </table></td> 
  </tr> 
  <tr>
    <td valign="top" bgcolor="#000000">&nbsp;</td>
  </tr> 
</table> 
<!-- End ImageReady Slices --> 
</body>
</html>
