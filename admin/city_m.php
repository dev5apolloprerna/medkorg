<?php

	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	include "connection/conn.php";
	// require "noentry.php";
	//   include "noentry.php";	
	
	if (isset($_POST["txtMode"])=="")
	{
		$varMode = $_GET['Mode'];
	}
	else
	{
		$varMode = $_POST['txtMode'];
	}
	$varCode="";
	if (isset($_POST["txtCode"])=="")
	{
		$varCode = isset($_GET['Code']) ? $_GET['Code'] : "";
	}
	else
	{
		$varCode = $_POST['txtCode'];
	}

	
 //  get  News category data //
 $sqlstate= "select * from state_m";
 $check_state=mysqli_query($cn,$sqlstate);
 $numstate=mysqli_num_rows($check_state);


if($numstate>0) 
{
	$state_info=array();
	while($row=mysqli_fetch_assoc($check_state))
	{
		$f['state_id']=stripslashes($row['state_id']);
		$f['state_name']=stripslashes($row['state_name']);
		$state_info[]=$f;
	}
}
	
	
	
//---------------QueryString-------------------
if ($varMode=="E")
{
  
	$sql_string = "SELECT * FROM city_m where city_id=". $varCode;
	
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
			$vartxtState = $rec['state_id'];
			$vartxtCity = $rec['city_name'];
			$vartxtSTDCode = $rec['std_code_vc'];
			
		}
	}
}
else
{
	$vartxtState = isset($_POST['state_name']) ? $_POST['state_name'] : "";
	$vartxtCity = isset($_POST["txtCity"]) ? $_POST['txtCity'] : "";
	$vartxtSTDCode = isset($_POST["txtStdCode"]) ? $_POST['txtStdCode'] : "";
}
//-------------MODE A------------------------
if ($_POST)
{
	
	
			
	if ($_POST["txtMode"]=="A")
	{	
		$varCode = GetMaxNumber("city_m","city_id",$cn);
		
		$sql_string = "INSERT INTO city_m(state_id,city_name,std_code_vc) VALUES (";
		$sql_string = $sql_string . $vartxtState. ",";
		$sql_string = $sql_string . "'". $vartxtCity . "',";
		$sql_string = $sql_string . "'". $vartxtSTDCode . "')";

		$check_res = mysqli_query($cn,$sql_string);
		
		closeconnection($cn);
		
		$redirect="city_list.php";
		header("Location: $redirect");
		exit;
	}
}

//--------------MODE E-----------------------

if (isset($_POST["txtMode"])=="EA")
{
  
	$sql_string = "UPDATE city_m SET city_name='".$vartxtCity."',state_id ='".$vartxtState."',std_code_vc ='".$vartxtSTDCode."' where city_id =".$varCode ;
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$redirect="city_list.php";
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
	
		if(frm.state_name.value == "")
		{
			alert("Please Select State Name");
			frm.state_name.focus();
		}
		
		else if(frm.txtCity.value == "")
		{
			alert("Please enter city Name");
			frm.txtCity.focus();
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
<style type="text/css">
<!--
body {
	background-color: #cbcaca;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style3 {color: #FFFFFF}
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}

-->
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
	  <tr bgcolor="#ffffff">
        <td valign="top" bgcolor="#FFFFFF" >
          <blockquote>
            <p><font size="+2" class="style6"><br>
        Administration Panel<br>
        <br>
            </font></p>
        </blockquote></td>
	    </tr>
    </table></td>
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
                            <td width="25%" class="h3">City Master </td>
                            <td><div align="right"> </div></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><div align="left"></div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><form name="frm" method="post" action="city_m.php">
                      <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                      <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr valign="top">
                          <td width="2%">&nbsp;</td>
                          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="15%" align="right" valign="middle" class="text"> State Name </td>
                                <td width="2%" align="center" valign="middle"><strong>:</strong></td>
                                <td width="83%" valign="top" class="form_field">
                                  <select name= "state_name" id="state_name" class="txtbox">
                                    <option value="">Please Select</option>
                                    <?php foreach($state_info as $val){ 
							if($vartxtState==$val['state_id']) { ?>
                                    <option value="<?php echo $val['state_id']; ?>" selected><?php echo $val['state_name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $val['state_id']; ?>"><?php echo $val['state_name']; ?></option>
                                    <?php } } ?>
                                  </select>
                                </td>
                              </tr>
							  <tr>
                              <td></td>
                              <td></td>
                              <td height="10"></td>
                            </tr>
                              <tr valign="top">
                                <td height="25" class="text"><div align="right">City/Village/Town</div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="txtCity" type="text" class="txtbox" tabindex="1" value="<?php echo($vartxtCity); ?>" size="66"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td height="10"></td>
                              </tr>
                              <tr valign="top">
                                <td height="25" class="text"><div align="right">STD Code</div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="txtStdCode" type="text" class="txtbox" tabindex="1" value="<?php echo($vartxtSTDCode); ?>" size="66"></td>
                              </tr>
							  <tr>
                              <td></td>
                              <td></td>
                              <td height="10"></td>
                            </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="javascript:doSubmit();"><img src="images/b-submit.gif" tabindex="2" width="100" height="33" border="0"></a></td>
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
                <td width="0%">&nbsp;</td>
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