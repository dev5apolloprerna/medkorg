<?php
require 'noentry.php';
require 'connection/conn.php';
 
//mode management
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
	$varCode = isset($_GET['Code']);
}
else
{
	$varCode = $_POST['txtCode'];
}

$sql_string = "SELECT cont_code FROM contactus_m";
$check_res = mysqli_query($cn,$sql_string);
$numst = mysqli_num_rows($check_res);
$code = mysqli_fetch_array($check_res);

if($numst > 0)
{
	$varMode = 'E';
	$varCode = $code['cont_code'];
}
else
{
	$varMode = 'A';
	$varCode = '';
}		

//---------------QueryString-------------------
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM contactus_m where cont_code = '".$varCode."'";
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
			 $cont_text = $rec['cont_text'];
		}
	}
	
	$varMode = "EA";
	
}

else
{
	 $cont_text = mysqli_real_escape_string($cn,$_POST['cont_text']);
}
//-------------MODE A------------------------
if ($_POST)
{
	if ($_POST["txtMode"]=="A")
	{	
		$sql_string = "INSERT INTO contactus_m (cont_text) VALUES('".$cont_text."')";
		$check_res = mysqli_query($cn,$sql_string);

		closeconnection($cn);
					
		$redirect="home.php";
		header("Location: $redirect");
		exit;
			
	}
}

//--------------MODE E-----------------------
 //print_r($_POST);
if (isset($_POST["txtMode"])=="EA")
{
	$cont_text = $_POST['cont_text'];
	
	$sql_string = "UPDATE contactus_m SET cont_text='".$cont_text."' where cont_code='".$varCode."'";
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
	$redirect="home.php";
	header("Location: $redirect");
	exit;
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
	/*if(frm.selpage.value =="0")
	{
		alert("Please select Page");
		frm.selpage.focus();
		return false;
	}
	else
	*/{
		if(frm.txtMode.value == "E" || frm.txtMode.value == "EA")
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
                                  <td>&nbsp;</td>
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
                                  <td width="25%" class="h1" style="padding-left:25px; ">Contact  US</td>
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
                          <td class="text_bold_head"><form name="frm" method="post" action="contactus_m.php" enctype="multipart/form-data">
                            
							<input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                            <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="2%">&nbsp;</td>
                                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr valign="middle">
                                    <td width="18%" align="right" class="text" style="padding-left:30px;"><div align="right">Contact Us Text </div></td>
                                    <td width="4%" align="center" ><strong>:</strong></td>
                                    <td height="30" colspan="2" align="left"> </td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" style="padding-left:30px; ">
                                      <div align="left">
                                        <textarea name="cont_text" id="cont_text" cols="60" rows="10"><?php echo $cont_text; ?></textarea>
                                        <script type="text/javascript">
							CKEDITOR.replace('cont_text');
						          </script>
                                    </div></td>
                                  </tr>
								  <!--<tr>
                                      <td height="25" align="right" valign="top" class="text">File</td>
                                      <td align="center" valign="top" class="text"><b>:</b></td>
                                      <td valign="middle">
									  	<textarea name="txtimage" cols="40" rows="8" class="txtrequired txtbox" id="HTML Code"><?php echo isset($txtimage) ? $txtimage :""; ?></textarea>
									  </td>
                                    </tr>
								  -->
								    <!--<tr valign="top">
                                      <td height="25" valign="top" class="text"><div align="right"> Link </div></td>
                                      <td height="25" align="center">:</td>
                                      <td height="25" valign="top" class="text"><input name="txtadvtlink" type="text" class="txtbox"  value="<?php echo isset($vartxtadvtlink); ?>" size="30"></td>
                                    </tr> -->
                                    <tr valign="top">
                                      <td colspan="2">&nbsp;</td>
                                      <td width="37%"><div align="center">
                                        <input type="button" value="Submit" tabindex= "2" width="100" height="33" border="0" onClick="javascript:return doSubmit();">
                                      </div></td>
                                      <td width="41%">&nbsp;</td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
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
