<?php
	ob_start();
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	if ($_SESSION["UserAdminCode"] == "")
	{
		$redirect="index.php";
		header("Location: $redirect");
	}
	
	include "connection/conn.php";
	// require "noentry.php";
//$cn = getConnection("localhost","root","","samaj");
//$cn = getConnection("localhost","career_career","!@#$%@@","career_searchjobs");
		
	$varFieldtag = "";
	if (isset($_POST["selfilter"]) <> "")
	{
		$varFieldTag = $_POST["selfilter"];
	}
	
	$varFieldValue = "";
	if (isset($_POST["txtfiltername"]) <> "")
	{
		$varFieldValue = $_POST["txtfiltername"];
	}
	
	if ($_POST)
	{
		//---------------DELETE MODE-----------------------------
		
		if ($_POST["txtMode"]=="D")
		{
			$sql_string = "DELETE FROM user_m WHERE user_code = (" . $_POST["txtDCode"] . ")";
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			$_POST["txtMode"] = "";
		}
	}	
	
	$sql_string = "SELECT * FROM user_m where adminuser=1 and user_login!='admin'";
	
	if (isset($varFieldTag) <> "" )
		{
		if ($varFieldTag = "industry")
		{
			$sql_string = $sql_string ." and full_name LIKE '" . $varFieldValue . "%'";
		}
	}
	$check_res = mysqli_query($cn,$sql_string);
	$row_cnt = mysqli_num_rows($check_res);
	$userlist = array();
	while ($re = mysqli_fetch_array($check_res))
	{
		$u['user_code'] = $re['user_code'];
		$u['full_name'] = $re['full_name'];
		$u['user_login'] = $re['user_login'];
		$u['user_email'] = $re['user_email'];
		
		$userlist[] = $u;
	}
	
?>
<html>
<head>
<title>Samaj</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function doDelete(DCode)
{
	var blnConfirm = confirm("Do you want to delete?");
	if (blnConfirm)
	{
		frm.txtMode.value="D";
		frm.txtDCode.value=DCode;
		frm.submit();
	}
	else
	{
		frm.txtMode.value="X";
	}
}
function doFilter()
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
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
-->
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr><tr>
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
                <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
                  <tr valign="top">
                    <td class="h3" style="padding-left:25px;">User List </td>
                  </tr>
                  <tr valign="top">
                    <td><div align="right" class="text"><strong><a href="user_m.php?Mode=A" class="link">Add</a> | <a href="home.php" class="link">Back</a></strong></div></td>
                  </tr>
                  <tr valign="top">
                    <td width="85%"><form name="frm" method="Post" action="user_list.php">
                  <input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>"/>
                  <input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>"/>
                  <input type="hidden" name="txtDCode" value=""/>
                        <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr valign="top">
                            <td>&nbsp;</td>
                            <td class="text"><div align="right"></div></td>
                          </tr>
                          <tr valign="top">
                            <td width="2%">&nbsp;</td>
                            <td><table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0"  cellspacing="0">
                                <tr valign="middle" bgcolor="#4C6B83">
                                  <td height="25" bgcolor="#666666" class="text" style="padding-left:5px;"><font color="#FFFFFF"><b>User Full Name </b></font></td>
                                  <td bgcolor="#666666" class="text" style="padding-left:5px;"><font color="#FFFFFF"><b>Username </b></font></td>
                                  <td bgcolor="#666666" class="text" style="padding-left:5px;"><font color="#FFFFFF"><b>Email</b></font></td>
                                  <td width="75" bgcolor="#666666" class="text">&nbsp;</td>
                                </tr>
                                <?php
									foreach($userlist as $rec1)
									{
										
								?>
                                <tr valign="middle">
                                  <td height="25" class="text" style="wordWrap:break-word; width=150px;left:0;padding-left:5px;"><?php echo isset($rec1['full_name']) ? $rec1['full_name'] :""; ?>&nbsp;</td>
                                  <td class="text" style="wordWrap:break-word; width=150px;left:0;padding-left:5px;"><?php echo isset($rec1['user_login']) ? $rec1['user_login'] :""; ?>&nbsp;</td>
                                  <td class="text" style="wordWrap:break-word; width=150px;left:0;padding-left:5px;"><a href="mailto:<?php echo isset($rec1['user_email'])? $rec1['user_email'] :""; ?>" class="more"><?php echo($rec1['user_email']); ?></a>&nbsp;</td>
                                  <td align="center" class="text"><a href="user_m.php?Code=<?php echo($rec1['user_code']); ?>&Mode=E" class="sublink">E</a> | <a href="javascript:doDelete(<?php echo($rec1['user_code']); ?>);" class="sublink">D</a></td>
                                </tr>
                                <?php
									}
								?>
                            </table></td>
                          </tr>
                          <tr valign="top">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
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