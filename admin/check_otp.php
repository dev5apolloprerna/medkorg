<?php
ob_start();
include "password_hash.php";
include "connection/conn.php";
//require "noentry.php"; 

session_start();

if ($_POST) {
    $strlogin = "select * from user_m where  user_code='" . trim($_POST['user_code']) . "' and  otp='" . $_POST['txtLogin'] . "' ";

    $result = mysqli_query($cn, $strlogin);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $currenttimestamp = strtotime(date('d-m-Y h:i:s'));
        // echo strtotime(date('d-m-Y h:i:s')).'------'.strtotime($row['otpexpireon']);
        // exit;
        if ($currenttimestamp <= strtotime($row['otpexpireon'])) {

            //$_SESSION['AdminId'] = $row['id'];     
            //$_SESSION['AdminName'] = $row['username'];
            $_SESSION["UserAdminEmail"] = $row['user_email'];
            $_SESSION["UserAdminUName"] = $row['user_login'];
            $_SESSION["UserAdminCode"] = $row['user_code'];
            $_SESSION["UserAdminFullName"] = $row['full_name'];
            $_SESSION["UserAdminPermissionsID"] = $row['mnu_permissions'];

            $per_id = explode(",", $row['mnu_permissions']);
            $mnu_per = "";
            $mnu_per1 = "";
            foreach ($per_id as $v) {
                $mnu_per .= substr($v, 2, strlen($v)) . ",";
            }
            $mnu_per = substr($mnu_per, 0, strlen($mnu_per) - 1);
            unset($_SESSION["UserAdminPermissions"]);
            $_SESSION["UserAdminPermissions"] = $mnu_per;

            if ($row['admintype'] == "1") {

                // Get all menu ids and assign to permissions in casr of admin login //
                $sql_string = "SELECT adm_mnu_id FROM admin_menu WHERE status=1";
                $check_res1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                while ($adm_perm = mysqli_fetch_array($check_res1)) {
                    $mnu_per .= "A_" . $adm_perm['adm_mnu_id'] . ",";
                    $mnu_per .= "E_" . $adm_perm['adm_mnu_id'] . ",";
                    $mnu_per .= "D_" . $adm_perm['adm_mnu_id'] . ",";

                    $mnu_per1 .= $adm_perm['adm_mnu_id'] . ",";
                }

                $mnu_per = substr($mnu_per, 0, strlen($mnu_per) - 1);
                unset($_SESSION["UserAdminPermissionsID"]);
                $_SESSION["UserAdminPermissionsID"] = $mnu_per;

                $mnu_per1 = substr($mnu_per1, 0, strlen($mnu_per1) - 1);
                unset($_SESSION["UserAdminPermissions"]);
                $_SESSION["UserAdminPermissions"] = $mnu_per1;
            }
           
                  $redirect = "home.php";
              header("Location: $redirect");
        } else {
                    $redirect = "index.php?msg=OTP expires or Invalid OTP";
                header("Location: $redirect");
            exit;
        }
    } else {
            $redirect = "index.php?msg=OTP expires or Invalid OTP";
          header("Location: $redirect");
        exit;
    }
    exit;
} else {
    $token = explode('_', $_GET['token']);

    if (md5($token[0]) != $token[1]) {
            $redirect = "index.php?msg= Invalid User.";

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
                                                    <form name="frm" method="post" action="check_otp.php">
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
                                                                                <div align="right"><strong>OTP :<font color="#FF0000">*</font></strong></div>
                                                                            </td>
                                                                            <td height="25">&nbsp;</td>
                                                                            <td height="25"><input name="txtLogin" type="text" class="txtbox1" tabindex="1" size="30">
                                                                                <input type="hidden" name="user_code" id="user_code" value="<?= $token[0] ?>">
                                                                            </td>

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