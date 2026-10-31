<?php
ob_start();
//session_start();
	include "connection/conn.php";
	require "noentry.php";
	//  include "noentry.php";	
  session_start();
	
?>
<html>
<head>
<title>Samaj</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
//-->
</script>
<style type="text/css">
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
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
              <tr>
                <td width="25%" rowspan="2" background="images/grey_bg.gif" valign="top"><?php require 'menu.php'; ?></td>
                <td valign="top">&nbsp;</td>
                </tr>
              <tr valign="top">
                <td>
                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr valign="top">
                        <td><form name="frm" method="post" action="index.php">
                          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr valign="top">
                              <td width="2%">&nbsp;</td>
                              <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr valign="top">
                                    <td height="12" colspan="4" class="text"></td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td width="46%">
										<div align="center"><span class="style5">Welcome</span> 
										<span class="style6">
											<?php  
											if($_SESSION['UserAdminFullName'] == "" && $_SESSION["UserAdminCode"]==1)
												$name = "Admin";
											else
												$name = $_SESSION['UserAdminFullName'];
												
											if($name=="")
												$name = "User";
												
												echo $name;			
											?>
										</span></div></td>
                                    <td width="38%">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td width="1%">&nbsp;</td>
                                    <td width="15%">&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td height="20">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr valign="top">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
                        </form></td>
                      </tr>
                    </table>                </td>
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