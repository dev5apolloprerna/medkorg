<?php
  require 'noentry.php';
  include "connection/conn.php";
	require "noentry.php";
	
//mode management

if ($_POST["txtMode"]=="")
{
	$varMode = $_GET['Mode'];
}
else
{
	$varMode = $_POST['txtMode'];
}

if ($_POST["txtCode"]=="")
{
	$varCode = $_GET['Code'];
}
else
{
	$varCode = $_POST['txtCode'];
}

//---------------QueryString-------------------
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM  gotra_m where gotra_id =". $varCode;
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
			$gotra_name = $rec['gotra_name'];
							
		}
	}
}

else
{
	 $gotra_name = $_POST["gotra_name"];
	
}
//-------------MODE A------------------------
if ($_POST)
{
	 
	
	if ($_POST["txtMode"]=="A")
	{	
		$sql_string = "SELECT * FROM gotra_m where gotra_name = '". $gotra_name . "'";
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
		if (mysqli_num_rows($check_res)>0)
		{
			$redirect="message.php?Msg=Duplicate Data Found, Please Try Again";
			header("Location: $redirect");
			exit;
		}
		else
		{	 
			$sql_string = "INSERT INTO gotra_m(gotra_name) VALUES(";
			$sql_string = $sql_string ."'".  $gotra_name . "')";
			
			$check_res1 = mysqli_query($cn,$sql_string);
			
			header("Location: gotra_list.php");
			exit;
		}	
	}
}

//--------------MODE E-----------------------
 
if ($_POST["txtMode"]=="EA")
{
	$sql_string = "SELECT * FROM gotra_m where gotra_name=trim('". $gotra_name . "') and gotra_id!= ". $varCode ."";
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
	if (mysqli_num_rows($check_res)>0)
	{
		$redirect="message.php?Msg=Duplicate Data Found, Please Try Again";
		header("Location: $redirect");
		exit;
	}
	else
	{  
		 $sql_string = "UPDATE gotra_m SET gotra_name = '" .$gotra_name."'";
		 $sql_string = $sql_string ."where gotra_id =".$varCode ;
		
		 $check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
		
		header("Location: gotra_list.php");
		exit;
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
	if(frm.gotra_name.value == "")
	{
		alert("Please enter Gotra Name");
		frm.gotra_name.focus();
		return false;
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
                              <table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr>
                                </tr>
                              </table>
                          </div></td>
                        </tr>
                        <tr>
                          <td class="text_bold_head" style="padding-left:25px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="text_bold_head" style="padding-left:25px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="text_bold_head" style="padding-left:25px;"><div align="left" class="h1">Gotra Master </div></td>
                        </tr>
                        <tr>
                          <td align="center" valign="top">
                            <form name="frm" method="post" action="gotra_m.php">
                              <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                              <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="12"></td>
                                </tr>
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="133" align="right" valign="middle" class="text"> Gotra Name </td>
                                        <td width="19" align="center" valign="middle"><strong>:</strong></td>
                                        <td width="456" align="left" valign="middle">
                                          <input name="gotra_name" id="gotra_name" type="text" class="text" value="<?php echo($gotra_name); ?>">
                                        </td>
                                      </tr>
						  
						    <tr>
                              <td height="10"> </td>
						   </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top"><input type="button" name="btnadd2" id="btnadd2" value="Submit" onClick="return doSubmit();" style="cursor:pointer;" />  <input type="button" name="btncancel" id="btncancel" value="Cancel" style="cursor:pointer;" onClick="window.location='gotra_list.php'" /></td>
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
