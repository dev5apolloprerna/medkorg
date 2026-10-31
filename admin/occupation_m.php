<?php
  // require 'noentry.php';
  include "connection/conn.php";
	// require "noentry.php";
	
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
	$sql_string = "SELECT * FROM  occupation_m where occu_id =". $varCode;
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
			$occu_name = $rec['occu_name'];
			$show_cat = $rec['show_cat'];					
		}
	}
}

else
{
	 $occu_name = $_POST["occu_name"];
	 $show_cat = $_POST['show_cat'];
}
//-------------MODE A------------------------
if ($_POST)
{
	 
	
	if ($_POST["txtMode"]=="A")
	{	
		$sql_string = "SELECT * FROM occupation_m where occu_name = '". $occu_name . "'";
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
		if (mysqli_num_rows($check_res)>0)
		{
			$redirect="message.php?Msg=Duplicate Data Found, Please Try Again";
			header("Location: $redirect");
			exit;
		}
		else
		{	 
			$sql_string = "INSERT INTO occupation_m(occu_name,show_cat) VALUES(";
			$sql_string = $sql_string ."'".  $occu_name . "','".$show_cat."')";
			
			$check_res1 = mysqli_query($cn,$sql_string);
			
			header("Location: occupation_list.php");
			exit;
		}	
	}
}

//--------------MODE E-----------------------
 
if ($_POST["txtMode"]=="EA")
{
	$sql_string = "SELECT * FROM occupation_m where occu_name=trim('". $occu_name . "') and occu_id!= ". $varCode ."";
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
	if (mysqli_num_rows($check_res)>0)
	{
		$redirect="message.php?Msg=Duplicate Data Found, Please Try Again";
		header("Location: $redirect");
		exit;
	}
	else
	{  
		 $sql_string = "UPDATE occupation_m SET occu_name = '" .$occu_name."'";
		 $sql_string = $sql_string .",show_cat='".$show_cat."'";
		 $sql_string = $sql_string ." where occu_id =".$varCode ;
		
		 $check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
		
		header("Location: occupation_list.php");
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
	if(frm.occu_name.value == "")
	{
		alert("Please enter Occupation Name");
		frm.occu_name.focus();
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
                          <td class="h1">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="h1">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="h1"><div align="left">Occupation Master </div></td>
                        </tr>
                        <tr>
                          <td align="center" valign="top">
                            <form name="frm" method="post" action="occupation_m.php">
                              <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                              <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="12"></td>
                                </tr>
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="159" align="right" valign="middle" class="text"> Occupation Name </td>
                                        <td width="10" align="center" valign="middle"><strong>:</strong></td>
                                        <td width="559" align="left" valign="middle">
                                          <input name="occu_name" type="text" class="text" id="occu_name" value="<?php echo($occu_name); ?>" size="40">
                                        </td>
                                      </tr>
						  
						    <tr>
                              <td height="10"> </td>
						   </tr>
						    <tr>
                              <td align="right" valign="middle" class="text">Show Category? </td>
                              <td align="center" valign="middle"><strong>:</strong></td>
                              <td align="left" valign="middle">
                                <select name="show_cat" id="show_cat" class="text">
                                  <option value="1" <?php echo($show_cat=="1")?"selected":""; ?>> Yes </option>
                                  <option value="0" <?php echo($show_cat=="0")?"selected":""; ?>> No </option>
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
                                        <td align="left" valign="top"><input type="button" name="btnadd2" id="btnadd2" value="Submit" onClick="return doSubmit();" style="cursor:pointer;" />  <input type="button" name="btncancel" id="btncancel" value="Cancel" style="cursor:pointer;" onClick="window.location='occupation_list.php'" /></td>
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
