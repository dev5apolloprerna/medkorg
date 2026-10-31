<?php
	include "connection/conn.php";
	// require "noentry.php";
	// include "noentry.php";
	
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	if ($_SESSION["UserAdminCode"] == "")
	{
		$redirect="index.php";
		header("Location: $redirect");
	}
	
	
?>
<html>
<head>
<title>Samaj</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
-->
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td class="h1"><span class="h1">Reason for Dis-approval </span></td>
              </tr>
              <tr valign="top">
                <td width="85%"><form name="frm" method="Post" action="approval_list.php">
                  <input type="hidden" name="txtMode" value="<?php echo $_GET['Mode']; ?>"/>
				  <input type="hidden" name="txtCode" value="<?php echo $_GET['code']; ?>"/>
				  
                  <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr valign="top">
                      <td width="0%">&nbsp;</td>
                      <td width="14%"><div align="right" class="text">Reason</div></td>
                      <td width="2%"><div align="center">:</div></td>
                      <td width="84%">
					  	<textarea name="reason" cols="40" rows="6"></textarea>
					  </td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>
					  	<input type="submit" value="Submit">
					  </td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </form></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>