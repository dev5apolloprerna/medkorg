<?php

	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	include "connection/conn.php";
	// require "noentry.php";
	  // include "noentry.php";	
	
	if(isset($_POST["txtMode"])=="")
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
 $sqlcountry= "select * from country_m";
 $check_country=mysqli_query($cn,$sqlcountry);
 $numcountry=mysqli_num_rows($check_country);


if($numcountry>0) 
{
	$country_info=array();
	while($row=mysqli_fetch_assoc($check_country))
	{
		$f['country_id']=stripslashes($row['country_id']);
		$f['country_name']=stripslashes($row['country_name']);
		$country_info[]=$f;
	}
}
	
	
	
//---------------QueryString-------------------
if ($varMode=="E")
{
   $sql_string = "SELECT * FROM state_m where state_id=". $varCode;
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
			$vartxtcountry = $rec['country_id'] ? $rec['country_id'] : "";
			$vartxtState = $rec['state_name'] ? $rec['state_name'] : "";
			
		}
	}
}
else
{
	$vartxtcountry = isset($_POST['country_name']) ? $_POST['country_name'] : "";
	$vartxtState = isset($_POST["txtState"]) ? $_POST['txtState'] : "";
	
}
//-------------MODE A------------------------
if ($_POST)
{
	
	
			
	if ($_POST["txtMode"]=="A")
	{	
		$varCode = GetMaxNumber("state_m","state_id",$cn);
    $sql_string = "";
		$sql_string .= "INSERT INTO state_m(country_id,state_name) VALUES (";
		$sql_string = $sql_string . $_POST['country_name'] . ",";
		$sql_string = $sql_string . "'". $_POST['txtState'] . "')";
    
		$check_res = mysqli_query($cn,$sql_string);
		
		closeconnection($cn);
		
		$redirect="state_list.php";
		header("Location: $redirect");
		exit;
	}
}

//--------------MODE E-----------------------

if (isset($_POST["txtMode"])=="EA")
{
  
	$sql_string = "UPDATE state_m SET state_name='".$vartxtState."',country_id ='".$vartxtcountry."' where state_id =".$varCode ;
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$redirect="state_list.php";
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
	
		if(frm.country_name.value == "")
		{
			alert("Please Select Country Name");
			frm.country_name.focus();
		}
		
		else if(frm.txtState.value == "")
		{
			alert("Please enter State Name");
			frm.txtState.focus();
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
-->
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr><td height="35"></td></tr>
	  <tr>
        <!-- <td>
        <img src="images/logo.jpg">
        </td> -->
        <td valign="top" bgcolor="#FFFFFF"> <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
        <span style="color: #B90200"><strong>Administration Panel</strong></span><br>
        <br>
            </font></span></p>
        </blockquote> </td>
      </tr>
      <tr>
        <td height="50" valign="top"></td>
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
                            <td width="25%" class="text_bold_head" style="color: #B90200">State Master </td>
                            <td><div align="right"> </div></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><div align="left"></div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><form name="frm" method="post" action="state_m.php">
                      <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                      <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr valign="top">
                          <td width="2%">&nbsp;</td>
                          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="15%" align="right" valign="middle" class="text"> Country Name </td>
                                <td width="2%" align="center" valign="middle"><strong>:</strong></td>
                                <td width="83%" valign="top" class="form_field">
                                  <select name= "country_name" id="country_name" class="txtbox">
                                    <option value="">Please Select</option>
                                    <?php foreach($country_info as $val){ 
							if($vartxtcountry==$val['country_id']) { ?>
                                    <option value="<?php echo $val['country_id']; ?>" selected><?php echo $val['country_name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $val['country_id']; ?>"><?php echo $val['country_name']; ?></option>
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
                                <td height="25" class="text"><div align="right">State Name</div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="txtState" type="text" class="txtbox" tabindex="1" value="<?php echo($vartxtState); ?>" size="66"></td>
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