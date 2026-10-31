<?php
ob_start();
include "password_hash.php";
include "connection/conn.php";
//require "noentry.php"; 

session_start();

if ($_POST) {
  $strlogin = "select * from user_m where  user_login='" . trim($_POST['txtLogin']) . '\'';

  $result = mysqli_query($cn, $strlogin);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $chars = "0123456789";
    $otp = "";
    for ($i = 0; $i < 4; $i++) {
      $otp .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    $curDatetime = date("Y-m-d h:i:s", strtotime("+30 minutes"));
    $sql_string = "UPDATE  user_m  SET ";
    $sql_string  =   $sql_string . "otp='" . $otp . "',";
    $sql_string  =   $sql_string . "otpexpireon='" . $curDatetime . "'";
    $sql_string  = $sql_string . " where user_code  =" . $row['user_code'];
    mysqli_query($cn, $sql_string);
    $token = $row['user_code'] . '_' . md5($row['user_code']);    
    $mobileno = $row['user_login'];
    $msgText = $otp . " is the OTP to login to medkorg.in. It's valid for 10 minutes. Please do not share your username and password to others. Team MEDK.";
    $url = "https://web.shreesms.net/API/SendSMS.aspx?APIkey=hUqDEJgs8INPj8WQaJT8WKwNYk&SenderID=MEDKIN&SMSType=2&Mobile=" . $mobileno . "&MsgText=" . urlencode($msgText) . "&EntityID=1301167187763538760&TemplateID=1307167421233200101";
    $ret = file_get_contents($url);
    $redirect = "check_otp.php?token=" . $token . "&msg=otp send on your number or email";

    //$_SESSION['AdminId'] = $row['id'];     
    //$_SESSION['AdminName'] = $row['username'];
    //   $_SESSION["UserAdminEmail"] = $row['user_email'];
    //   $_SESSION["UserAdminUName"] = $row['user_login'];
    //   $_SESSION["UserAdminCode"] = $row['user_code'];
    //   $_SESSION["UserAdminFullName"] = $row['full_name'];
    //   $_SESSION["UserAdminPermissionsID"] = $row['mnu_permissions'];

    // $per_id = explode(",",$row['mnu_permissions']);
    // $mnu_per="";
    // $mnu_per1="";
    // foreach($per_id as $v)
    // {
    // 	$mnu_per .= substr($v,2,strlen($v)) . ",";
    // }
    // $mnu_per = substr($mnu_per,0,strlen($mnu_per)-1);
    // unset($_SESSION["UserAdminPermissions"]);
    // $_SESSION["UserAdminPermissions"] = $mnu_per;

    // if($row['user_login']=="admin")
    // {

    // 	// Get all menu ids and assign to permissions in casr of admin login //
    // 	$sql_string = "SELECT adm_mnu_id FROM admin_menu WHERE status=1";
    // 	$check_res1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
    // 	while($adm_perm = mysqli_fetch_array($check_res1))
    // 	{
    // 		$mnu_per .= "A_".$adm_perm['adm_mnu_id'] . ",";
    // 		$mnu_per .= "E_".$adm_perm['adm_mnu_id'] . ",";
    // 		$mnu_per .= "D_".$adm_perm['adm_mnu_id'] . ",";

    // 		$mnu_per1 .= $adm_perm['adm_mnu_id'] . ",";
    // 	}		

    // 	$mnu_per = substr($mnu_per,0,strlen($mnu_per)-1);
    // 	unset($_SESSION["UserAdminPermissionsID"]);
    // 	$_SESSION["UserAdminPermissionsID"] = $mnu_per;

    // 	$mnu_per1 = substr($mnu_per1,0,strlen($mnu_per1)-1);
    // 	unset($_SESSION["UserAdminPermissions"]);
    // 	$_SESSION["UserAdminPermissions"] = $mnu_per1;
    // }

    // $redirect="home.php";
    header("Location: $redirect");
  }
} else {
  //echo ("Password or LoginName does not match");
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
	if(frm.txtLogin.value == "")
	{
		alert("Please enter Login ID");
		frm.txtLogin.focus();
	}	
	else
		frm.submit();
}
//-->
  </script>
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

    .style5 {
      color: #063968;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bolder;
    }

    .style6 {
      color: #B90200;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bolder;
    }

    .style2 {
      color: #FFFFFF;
      font-weight: bold;
      font-size: 13px;
    }
    -->
  </style>
  </style>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
    <tr>
      <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" bgcolor="#FFFFFF">
              <blockquote>
                <p><span class="style6">
                    <font size="+2" class="style6"><br>
                      Administration Panel<br>
                    </font>
                  </span></p>
              </blockquote>
            </td>
          </tr>
          <tr>
            <td height="8" valign="top" bgcolor="#000000"></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
              <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr valign="top">
                        <td>&nbsp;</td>
                      </tr>
                      <tr valign="top">
                        <td>&nbsp;</td>
                      </tr>
                      <tr valign="top">
                        <td width="84%">
                          <form name="frm" method="post" action="index.php">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="2%">&nbsp;</td>
                                <td>
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr valign="top">
                                      <td height="12" colspan="3" class="text">
                                      <?php
                                                                                if (isset($_GET['msg'])) {
                                                                                    if ($_GET['msg'] != '') {
                                                                                        echo '<h4>Note:' . $_GET['msg'] . '</h4>';
                                                                                    }
                                                                                }
                                                                                ?>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td width="32%">&nbsp;</td>
                                      <td width="1%">&nbsp;</td>
                                      <td width="67%">&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">&nbsp;</td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25">&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right"><strong>Admin Login ID:<font color="#FF0000">*</font></strong></div>
                                      </td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25"><input name="txtLogin" type="text" class="txtbox1" tabindex="1" size="30"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        
                                      </td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td><a href="javascript:doSubmit();"><img src="images/b-submit.gif" tabindex="3" width="92" height="30" border="0"></a></td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>

                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </form>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#000000">&nbsp;</td>
    </tr>
  </table>
  <!-- End ImageReady Slices -->
</body>

</html>