<?php
ob_start();
session_start();
$txtDCode = isset($_SESSION["UserCode"]) ? $_SESSION["UserCode"] :"";
$txtUserEmail = isset($_SESSION["UserEmail"]) ?$_SESSION["UserEmail"] :"";
include "password_hash.php";
include "connection/conn.php";
	// require "noentry.php";
	

if (isset($_GET['Mode']))
{
	$varMode = $_GET['Mode'];
	
}
else
{
	$varMode = $_POST['txtMode'];
}

if (isset($_GET['Code']))
{
	$varCode = isset($_GET['Code']) ? $_GET['Code'] :"" ;
	
}
else
{
	$varCode = $_POST['txtCode'];
}

// Get Main Menu Titles from here //
$chk_main=mysqli_query($cn,"select * from admin_menu where mnu_cat=0 and adm_mnu_id>0 and status=1");

//---------------QueryString-------------------
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM user_m where user_code=". $varCode;
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	if (mysqli_num_rows($check_res)<1)
	{
		echo("No rows in the database to display");
		exit;
	}
	else
	{
		while ($rec = mysqli_fetch_array($check_res))
		{
			$vartxtLogin = $rec['user_login'];
			$vartxtPassword = $rec['plaintxt_password'];
			$vartxtEMail = $rec["user_email"];
			$vartxtFullName = $rec['full_name'];
			$mnu_permissions = explode(",",$rec['mnu_permissions']);
			$adminuser = $rec['adminuser'];
		}
	}
}
else
{
	$mnu_permissions = "";
	$vartxtLogin = isset($_POST["txtLogin"]) ? $_POST["txtLogin"] :"";
	$vartxtPassword = isset($_POST["txtPassword"]) ? $_POST["txtPassword"] :"";
	$vartxtEMail = isset($_POST["txtEMail"]) ? $_POST['txtEMail'] :"";
	$vartxtFullName = isset($_POST['txtFullName']) ? $_POST['txtFullName'] :"";
	if (isset($_POST['mnu_permissions'])!="")
	{
		foreach($_POST['mnu_permissions'] as $val)
		{
			$mnu_permissions .= $val . ",";
		}
		$mnu_permissions = substr($mnu_permissions,0,strlen($mnu_permissions)-1);
	}
	
	$adminuser = isset($_POST['adminuser']);
}
//-------------MODE A------------------------
//print_r($_POST);exit;
if ($_POST)
{
	if ($_POST["txtMode"]=="A")
	{	
		// print_r($salt);exit;
		$varCode = GetMaxNumber("user_m","user_code",$cn);
		$hash_result = create_hash($_REQUEST['txtPassword']);
		$hash_params = explode(":", $hash_result);
		$salt = $hash_params[HASH_SALT_INDEX];
        $plaintxt_password=  $_POST["txtPassword"];
		$hash = $hash_params[HASH_PBKDF2_INDEX];
	
		$sql_string = "INSERT INTO user_m (user_code, user_login, user_password,salt ,plaintxt_password, user_email, full_name, mnu_permissions, adminuser) VALUES (";
		$sql_string = $sql_string . $varCode . ",";
		$sql_string = $sql_string . "'". $vartxtLogin . "',";
		$sql_string = $sql_string . "'". $hash . "',";
		$sql_string = $sql_string . "'". $salt ."',";
		$sql_string = $sql_string . "'".$plaintxt_password . "',";
		$sql_string = $sql_string . "'". $vartxtEMail . "',";
		$sql_string = $sql_string . "'". $vartxtFullName . "',";
		$sql_string = $sql_string . "'". $mnu_permissions . "',";
		$sql_string = $sql_string . "'". $adminuser . "')";
		//$good_hash = PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" . $row['salt'] . ":" . $row['user_password'];
		// if (validate_password($vartxtPassword, $good_hash)){
		 	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		// }
		closeconnection($cn);
		
		$redirect="user_list.php";
		header("Location: $redirect");
		exit;
	}
}

//--------------MODE E-----------------------

if (isset($_POST["txtMode"])=="EA")
{
	//$varCode = GetMaxNumber("user_m","user_code",$cn);
	$hash_result = create_hash($_POST['txtPassword']);
		$hash_params = explode(":", $hash_result);
		$salt = $hash_params[HASH_SALT_INDEX];
        
		$hash = $hash_params[HASH_PBKDF2_INDEX];
	//print_r($_POST);
    $sql_string = "UPDATE user_m SET user_login = '" .$vartxtLogin ."',";
	$sql_string = $sql_string ." user_email = '" .$vartxtEMail ."',";
	$sql_string = $sql_string ." user_password = '" .$hash ."',";
	$sql_string = $sql_string ." full_name = '" .$vartxtFullName ."',";
	$sql_string = $sql_string ." mnu_permissions = '" .$mnu_permissions ."',";
	$sql_string = $sql_string ." adminuser = '" .$adminuser ."',";
	$sql_string = $sql_string ." plaintxt_password = '" .$_POST['txtPassword'] ."',";
	$sql_string = $sql_string ." salt = '" .$salt ."' ";
	$sql_string = $sql_string ." where user_code =" . $varCode ;
	
	
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$redirect="user_list.php";
	header("Location: $redirect");

}

//------------FUNCTION-----------------------
function GetMaxNumber($TableName,$FieldName,$cn)
{
	$sql_string = "SELECT Max(" . $FieldName . ") 'col' FROM " . $TableName;
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

	if (mysqli_num_rows($check_res)>=1)
	{
		$rec = mysqli_fetch_array($check_res);
		if ($rec['col']==null)
		{
			return 1;
		}
		else
		{
			return $rec['col'] + 1;
		}
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
	if(frm.txtLogin.value == "")
	{
		alert("Please enter LoginName");
		frm.txtLogin.focus();
		return false;
	}
	else if(frm.txtPassword.value == "")
	{
		alert("Please enter password");
		frm.txtPassword.focus();
		return false;
	}
	else if (frm.txtPassword.value != frm.txtConPassword.value)
	{
		alert("confirm password does not match with password");
		frm.txtConPassword.focus();
		return false;
	}
	else
	{
		if(frm.txtMode.value == "E")
		{
			frm.txtMode.value = "EA";
			//frm.submit();
		}
		else
		{
			frm.txtMode.value = "A";
			//frm.submit();
		}
			return true;
	}
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
                      <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
                        <tr valign="top">
                          <td style="padding-left:25px;">&nbsp;</td>
                        </tr>
                        <tr valign="top">
                          <td style="padding-left:25px;">&nbsp;</td>
                        </tr>
                        <tr valign="top">
                          <td style="padding-left:25px;">&nbsp;</td>
                        </tr>
                        <tr valign="top">
                          <td style="padding-left:25px;"><span class="h1">User List </span></td>
                        </tr>
                        <tr valign="top">
                          <td>&nbsp;</td>
                        </tr>
                        <tr valign="top">
                          <td width="85%"><form name="frm" method="post" action="user_m.php">
                            <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                            <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
							<input type="hidden" name="adminuser" value="1">
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="2%">&nbsp;</td>
                                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr valign="top">
                                      <td width="24%" height="25" class="text"><div align="right">Login ID /Mobile No :<font color="#FF0000">*</font></div></td>
                                      <td width="1%" height="25">&nbsp;</td>
                                      <td width="75%" height="25" class="sublink"><input name="txtLogin" type="text" class="txtbox1" tabindex="1" value="<?php echo isset($vartxtLogin) ? $vartxtLogin : ""; ?>" size="40"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text"><div align="right">Password<font color="#FF0000">*</font></div></td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25" class="sublink"><input name="txtPassword" tabindex="2" type="password" class="txtbox" size="35" value="<?php echo isset($vartxtPassword) ? $vartxtPassword :""; ?>"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text"><div align="right">Confirm Password<font color="#FF0000">*</font></div></td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25" class="sublink"><input name="txtConPassword" value="<?php echo isset($vartxtPassword) ? $vartxtPassword :""; ?>" tabindex="3" type="password" class="txtbox" size="35"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text"><div align="right">Full Name </div></td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25" class="sublink"><input name="txtFullName" type="text" class="txtbox1" tabindex="4" value="<?php echo isset($vartxtFullName) ? $vartxtFullName :""; ?>" size="40"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text"><div align="right">E-Mail</div></td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25" class="sublink"><input name="txtEMail" type="text" class="txtbox1" tabindex="4" value="<?php echo isset($vartxtEMail) ? $vartxtEMail :""; ?>" size="40"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">&nbsp;</td>
                                      <td height="25">&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text"><div align="right">User Permissions </div></td>
                                      <td height="25">&nbsp;</td>
                                      
											
											  <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
                                                <?php
													$ctr=0;
													while($maincat = mysqli_fetch_array($chk_main))
													{
			
													// Get Sub Menu Titles from here //
													$chk_sub=mysqli_query($cn,"select * from admin_menu where mnu_cat=".$maincat['adm_mnu_id']." and adm_mnu_id>0 and status=1");
												   ?>
													<tr>
                                                    		<td valign="top" class="text">
															<table width="100%"  border="0" cellspacing="0" cellpadding="0">
															  <tr>
																<td valign="top" class="text"> 
																  <b> <?php echo $maincat['mnu_disp_value']; ?> </b>																</td>
															  </tr>
															  <tr>
																  <td>
																  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
																			<tr>
																			  <td align="left" valign="top" class="text">&nbsp;</td>
																			  <td width="15%" align="left" valign="top" class="text"><div align="center"><strong>Add</strong></div></td>
																			  <td width="15%" align="left" valign="top" class="text"><div align="center"><strong>Edit</strong></div></td>
																			  <td width="15%" align="left" valign="top" class="text"><div align="center"><strong>Delete</strong></div></td>
																    </tr>
																	<?php
																		 while($subcat = mysqli_fetch_array($chk_sub))
																		 {
																	 ?>
																			<tr>
																			  <td align="left" valign="top" class="text"> 
																				<?php echo $subcat['mnu_disp_value'];?>
																			  </td>
																			  <td align="left" valign="top" class="text"><div align="center">
																			    <input name="mnu_permissions[]" id="mnu_permissions<?php echo $subcat['adm_mnu_id']; ?>" type="checkbox" size="50" class="text" value="A_<?php echo $subcat['adm_mnu_id']; ?>" <?php if($_GET['Mode'] == "E"){ echo (in_array('A_'.$subcat['adm_mnu_id'],$mnu_permissions))?"checked":""; } ?>>
																			  </div></td>
																			  <td align="left" valign="top" class="text"><div align="center">
																			    <input name="mnu_permissions[]" id="mnu_permissions[]<?php echo $subcat['adm_mnu_id']; ?>" type="checkbox" size="50" class="text" value="E_<?php echo $subcat['adm_mnu_id']; ?>" <?php if($_GET['Mode'] == "E"){ echo (in_array('E_'.$subcat['adm_mnu_id'],$mnu_permissions))?"checked":""; } ?>>
																			  </div></td>
																			  <td align="left" valign="top" class="text"><div align="center">
																			    <input name="mnu_permissions[]" id="mnu_permissions[]<?php echo $subcat['adm_mnu_id']; ?>" type="checkbox" size="50" class="text" value="D_<?php echo $subcat['adm_mnu_id']; ?>" <?php if($_GET['Mode'] == "E"){ echo (in_array('D_'.$subcat['adm_mnu_id'],$mnu_permissions))?"checked":""; } ?>>
																			  </div></td>
																			</tr>
																	 <?php } ?>
																  </table>
																  </td>
															  </tr>
															  
															  
													  </table>													
													    </td>
											    </tr>
													  <tr> <td>&nbsp;  </td></tr>
									  			  <?php $ctr++; } ?>
                                                
												
												
												
                                              </table></td>
											  
									  
                                    </tr>
                                    <tr valign="top">
                                      <td height="12" colspan="3" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="12" colspan="3" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td><input type="submit" onClick="javascript: return doSubmit();" value="Submit" tabindex="5"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
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
