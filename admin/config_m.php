<?php

	require 'connection/conn.php';
	require 'noentry.php';	
	
if (isset($_POST["txtMode"])=="")
{
	$varMode = $_GET['Mode'];
}
else
{
	$varMode = $_POST['txtMode'];
}

if (isset($_POST["txtCode"])=="")
{
	$varCode = $_GET['Code'];
}
else
{
	$varCode = $_POST['txtCode'];
}

//---------------QueryString-------------------
if($_GET['Mode']=="E")
{	
	$sql_string = "SELECT * FROM config_m where config_id=". $varCode;
	
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
			$config_id = $rec['config_id'];
			$config_name = $rec['config_name'];
			$config_value = $rec['config_value'];
		}
	}
}
else
{
	$config_value = mysqli_real_escape_string($cn,$_POST['config_value']);
}

//-------------MODE A------------------------
if ($_POST)
{
	
	if ($_POST['txtMode']=="A")
	{	
		 
		$sql_string = "INSERT INTO config_m  (config_value) VALUES (";
		
		 
		$sql_string = $sql_string ."'". $config_value . "')";
		 
		$check_res = mysqli_query($cn,$sql_string);
		
		closeconnection($cn);
		
		$redirect="config_list.php";
		header("Location: $redirect");
		exit;
	}


	if($_POST['txtMode']=="EA")
	{
		$config_value = mysqli_real_escape_string($cn,$_POST['config_value']);
		
		$sql_string = "UPDATE config_m  SET config_value='".$config_value."'";
		 
		$sql_string = $sql_string ." where config_id =" . $varCode ; 
		
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
		$redirect="config_list.php";
		header("Location: $redirect");
	}


}

//--------------MODE E-----------------------


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
	/*if(frm.selpage.value =="0")
	{
		alert("Please select Page");
		frm.selpage.focus();
		return false;
	}
	else
	*/{
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
<script language="javascript" src="ckeditor/ckeditor.js"></script>
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
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="text_bold_head">
                            <div align="left">
                              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td class="h1">&nbsp;</td>
                                  <td width="68%">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="h1">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="h1">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="32%" class="h1" style="padding-left:25px; ">Admin Email Ids Config </td>
                                  <td><div align="right"> </div></td>
                                </tr>
                              </table>
                          </div></td>
                        </tr>
                        <tr>
                          <td class="text_bold_head"><div align="left"></div></td>
                        </tr>
                        <tr>
                          <td class="text_bold_head">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="text_bold_head"><form name="frm" method="post" action="config_m.php" enctype="multipart/form-data">
                            
							<input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                            <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="2%">&nbsp;</td>
                                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr valign="middle" class="text">
                                    <td align="right" valign="middle" class="text">Config Name </td>
                                    <td align="center" valign="middle"><strong>:</strong></td>
                                    <td height="30" align="left"><?php echo $config_name; ?></td>
                                  </tr>
                                  <tr valign="middle">
                                    <td width="22%" align="right" valign="top" class="text">Config Value </td>
                                    <td align="center" valign="top"><strong>:</strong></td>
                                    <td align="left"><input name="config_value" tabindex="1" type="text" class="text" id="config_value" value="<?php echo $config_value; ?>" size="40"></td>
                                  </tr>

								  <!--<tr>
                                      <td height="25" align="right" valign="top" class="text">File</td>
                                      <td align="center" valign="top" class="text"><b>:</b></td>
                                      <td valign="middle">
									  	<textarea name="txtimage" cols="40" rows="8" class="txtrequired txtbox" id="HTML Code"><?php echo $txtimage; ?></textarea>
									  </td>
                                    </tr>
								  -->
								    <!--<tr valign="top">
                                      <td height="25" valign="top" class="text"><div align="right"> Link </div></td>
                                      <td height="25" align="center">:</td>
                                      <td height="25" valign="top" class="text"><input name="txtadvtlink" type="text" class="txtbox"  value="<?php echo($vartxtadvtlink); ?>" size="30"></td>
                                    </tr> -->
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td width="1%"><div align="center">
                                      </div></td>
                                      <td width="77%"><input name="button" type="button" tabindex= "2" onClick="javascript:return doSubmit();" value="Submit" width="100" height="33" border="0"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td colspan="2">&nbsp;</td>
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
                          <td width="32%" class="text_bold_head">&nbsp;</td>
                          <td width="68%"><div align="right"> </div></td>
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
