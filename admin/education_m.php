<?php
  require 'noentry.php';
  include "connection/conn.php";
	// require "noentry.php";
	
//mode management

if(isset($_POST["txtMode"])=="")
{
	$varMode = $_GET['Mode'];
}
else
{
	$varMode = $_POST['txtMode'];
}

if (isset($_POST["txtCode"])=="")
{
	$varCode =isset($_GET['Code']) ? $_GET['Code'] : "";
}
else
{
	$varCode = $_POST['txtCode'];
}

//---------------QueryString-------------------
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM  education_m where education_id =". $varCode;
	
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
			$education_name = $rec['education_name'];
			$show_det_field = $rec['show_det_field'];
			$edu_level = $rec['edu_level'];				
		}
	}
}

else
{
	 $education_name = isset($_POST['education_name']) ? $_POST['education_name'] :"";
	 $show_det_field = isset($_POST['show_det_field']) ? $_POST['show_det_field'] :"";
	 $edu_level = isset($_POST['edu_level']) ? $_POST['edu_level'] :"";	
}
//-------------MODE A------------------------

if ($_POST)
{
	
	
	if ($_POST["txtMode"]=="A")
	{	
		$sql_string = "SELECT * FROM education_m where education_name = '". $education_name . "' and edu_level= '".$_POST['edu_level']."'";
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
		if (mysqli_num_rows($check_res)>0)
		{
			$redirect="message.php?Msg=Duplicate Data Found, Please Try Again";
			header("Location: $redirect");
			exit;
		}
		else
		{	 
			$sql_string = "INSERT INTO education_m(education_name,show_det_field,edu_level) VALUES(";
			$sql_string = $sql_string ."'".  $education_name . "','".$show_det_field."','".$edu_level."')";
			
			$check_res1 = mysqli_query($cn,$sql_string);
			
			header("Location: education_list.php");
			exit;
		}	
	}
}

//--------------MODE E-----------------------

if (isset($_POST["txtMode"])=="EA")
{
	 
	$sql_string = "SELECT * FROM education_m where education_name=trim('". $_POST['education_name'] . "') and education_id!= ". $varCode ." and edu_level='".$_POST['edu_level']."'";
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
	if (mysqli_num_rows($check_res)>0)
	{
		$redirect="message.php?Msg=Duplicate Data Found, Please Try Again";
		header("Location: $redirect");
		exit;
	}
	else
	{  
		 $sql_string = "UPDATE education_m SET education_name = '" .$_POST['education_name']."'";
		 $sql_string = $sql_string .",show_det_field='".$_POST['show_det_field']."'";
		 $sql_string = $sql_string .",edu_level='".$_POST['edu_level']."'";
		 $sql_string = $sql_string ." where education_id =".$varCode ;
		
		 $check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
		
		header("Location: education_list.php");
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
	if(frm.education_name.value == "")
	{
		alert("Please enter Education Name");
		frm.education_name.focus();
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
                          <td class="text_bold_head"><div align="left"><span class="h1">Education Master</span></div></td>
                        </tr>
                        <tr>
                          <td align="center" valign="top">
                            <form name="frm" method="post" action="education_m.php">
                              <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                              <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="12"></td>
                                </tr>
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="133" align="right" valign="middle" class="text">Education Level</td>
                                        <td align="center" valign="middle"><strong>:</strong></td>
                                        <td align="left" valign="middle">
                                          <select name="edu_level" id="edu_level" class="text">
                                            <option value="Basic/Grad." <?php echo($edu_level=="Basic/Grad.")?"selected":""; ?>> Basic/Grad. </option>
                                            <option value="PG" <?php echo($edu_level=="PG")?"selected":""; ?>> PG </option>
                                            <option value="Doctrate" <?php echo($edu_level=="Doctrate")?"selected":""; ?>> Doctrate </option>
										  </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="133" align="right" valign="middle" class="text">Education Name </td>
                                        <td width="19" align="center" valign="middle"><strong>:</strong></td>
                                        <td width="456" align="left" valign="middle">
                                          <input name="education_name" id="education_name" type="text" class="text" value="<?php echo($education_name); ?>">
                                        </td>
                                      </tr>
									  <tr>
										 <td height="10"> </td>
									  </tr>
									  <tr>
										 <td width="133" align="right" valign="middle" class="text">Show Detail Field? </td>
										 <td align="center" valign="middle"><strong>:</strong></td>
										 <td align="left" valign="middle">
											<select name="show_det_field" id="show_det_field" class="text">
												<option value="1" <?php echo($show_det_field=="1")?"selected":""; ?>> Yes </option>
												<option value="0" <?php echo($show_det_field=="0")?"selected":""; ?>> No </option>
											</select>
										 </td>
									  </tr>
                                      <tr>
                                        <td height="10"></td>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td height="10"> </td>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top"><input type="button" name="btnadd2" id="btnadd2" value="Submit" onClick="return doSubmit();" style="cursor:pointer;" />  <input type="button" name="btncancel" id="btncancel" value="Cancel" style="cursor:pointer;" onClick="window.location='education_list.php'" /></td>
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
