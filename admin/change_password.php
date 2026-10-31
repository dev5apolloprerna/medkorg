<?php
	
	
	
	include "connection/conn.php";
  include "password_hash.php";
	// require "noentry.php";
	  // include "noentry.php";	
    session_start();
    $txtDCode = $_SESSION["UserAdminCode"];
    $txtUserEmail = $_SESSION["UserAdminEmail"];

if (isset($_POST["txtMode"])=="")
{
	$varMode = isset($_GET['Mode']);
}
else
{
	$varMode = $_POST['txtMode'];
}
//---------------QueryString-------------------

	$sql_string = "SELECT * FROM user_m WHERE user_code=". $txtDCode;
		
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		if (mysqli_num_rows($check_res)>0)
		{
			while ($rec = mysqli_fetch_array($check_res))
			{
				$vartxtusername = $rec['user_login'];
				$vartxtpassword = $rec['user_password'];
			}	
		}
//--------------MODE E-----------------------
	if (isset($_POST["txtMode"])=="EA")
	{
		if ($vartxtpassword <> isset($_POST['txtoldpassword']) ? $_POST['txtoldpassword'] :"")
		{
			echo("OldPassword does not match");
			exit;
		}
		else
		{
			$vartxtpassword= $txtnewpassword = $_REQUEST['txtnewpassword'];
      $hash_result = create_hash($_REQUEST['txtnewpassword']);
      $hash_params = explode(":", $hash_result);
      $salt = $hash_params[HASH_SALT_INDEX];
      $plaintxt_password= $txtnewpassword;
      $hash = $hash_params[HASH_PBKDF2_INDEX];
      $sql_string = "UPDATE user_m SET user_password = '" . $hash."',salt= '".$salt."' ,plaintxt_password= '".$plaintxt_password."'";
		 	$sql_string = $sql_string ." where user_code =". $txtDCode;
     
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			
			$redirect="index.php";
			header("Location: $redirect");
		}
	}
?>
<html>
<head>
<title>Samaj</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function doSubmit()
{
	if (frm.txtoldpassword.value == "")
	{
		alert("Please enter OldPassword");
		frm.txtoldpassword.focus();
	}
	else if (frm.txtnewpassword.value == "")
	{
		alert("Please enter Password");
		frm.txtnewpassword.focus();
	}
	else if(frm.txtnewpassword.value != frm.txtconpassword.value)
	{
		alert("ConfirmPassword does not match with Password");
		frm.txtconpassword.focus();
	}
	else
	{
		frm.txtMode.value = "EA";
		frm.submit();
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr>
       <td valign="top" bgcolor="#FFFFFF" > <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
        Administration Panel<br>
        <br>
            </font></span></p>
        </blockquote> </td>
      </tr>
      <tr>
        <td height="8" valign="top"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td width="25%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php'; ?></td>
                <td>&nbsp;</td>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="text_bold_head">
                      <div align="left">
                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="25%" class="text_bold_head">Change Password</td>
                            <td><div align="right"> </div></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><div align="left"></div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><form name="frm" method="Post" action="change_password.php">
                      <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                      <input type="hidden" name="txtUCode" value="<?php echo $varUCode; ?>">
                      <table width="100%" border="0" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0"  cellspacing="0">
                        <tr valign="middle">
                          <td width="37%" height="25" valign="top" class="text"><div align="right">User Login&nbsp;</div></td>
                          <td width="1%" height="25" valign="top" class="text">&nbsp;</td>
                          <td width="62%" height="25" valign="top" class="text"><b><?php echo($vartxtusername); ?></b></td>
                        </tr>
                        <tr valign="middle">
                          <td height="25" valign="top" class="text"><div align="right">Old Password<font color="#FF0000">*</font></div></td>
                          <td height="25" valign="top" class="text">&nbsp;</td>
                          <td height="25" valign="top" class="text">
                            <input name="txtoldpassword" type="password" class="txtbox" size="15">
                          </td>
                        </tr>
                        <tr valign="middle">
                          <td height="25" valign="top" class="text"><div align="right">New Password<font color="#FF0000">*</font></div></td>
                          <td height="25" valign="top" class="text">&nbsp;</td>
                          <td height="25" valign="top" class="text">
                            <input name="txtnewpassword" type="password" class="txtbox" size="15">
                          </td>
                        </tr>
                        <tr valign="middle">
                          <td height="25" valign="top" class="text"><div align="right"> Confirm Password<font color="#FF0000">*</font></div></td>
                          <td height="25" valign="top" class="text">&nbsp;</td>
                          <td height="25" valign="top" class="text">
                            <input name="txtconpassword" type="Password" class="txtbox" size="15">
                          </td>
                        </tr>
                        <tr valign="middle">
                          <td height="22" valign="top" class="text"><div align="right"></div></td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top"><a href="javascript:doSubmit();"><img src="images/b-submit.gif" width="100" height="33" border="0"></a></td>
                        </tr>
                        <tr valign="middle">
                          <td height="22" valign="top" class="text">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr valign="middle">
                          <td height="22" valign="top" class="text">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr valign="middle">
                          <td height="22" valign="top" class="text">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr valign="middle">
                          <td height="22" valign="top" class="text">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr valign="middle">
                          <td height="22" valign="top" class="text">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr valign="middle">
                          <td height="22" valign="top" class="text">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr valign="middle">
                          <td height="22" valign="top" class="text">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr valign="middle">
                          <td height="22" valign="top" class="text">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                      </table>
                    </form></td>
                  </tr>
                </table></td>
              </tr>
              <tr valign="top">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
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