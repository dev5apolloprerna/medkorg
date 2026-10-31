<?php
 $ProdThumbImgDir = "images/gallery/courses/";
  
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	include "connection/conn.php";
	// require "noentry.php";
	// include "noentry.php"; 
	
	if ($_SESSION["UserAdminCode"] == "")
	{
		$redirect="index.php";
		header("Location: $redirect");
	}
	
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
if ($varMode=="E")
{
	 $sql_advertise = "SELECT * FROM  aboutus_m where about_code=". $varCode;
	
	$check_advt = mysqli_query($cn,$sql_advertise) or die(mysqli_error($cn));
	if (mysqli_num_rows($check_advt)<1)
	{
		echo("No rows in the database to display");
		exit;
	}
	else
	{
		
		while ($rec = mysqli_fetch_array($check_advt))
		{
			$about_text= $rec['about_text'] ? $rec['about_text'] :"";
			$about_title = $rec['about_title'] ? $rec['about_title'] : "";
		}
	
	}
}
	
//-------------MODE A------------------------
if ($_POST)
{

 // Image Uploading 
	 if($_FILES["thumb_image"]["name"]!="")
	 {
		$filename = $_FILES["thumb_image"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage = $sys_name.$extension;
		$ProdThumbImgDir.$TImage;
		  
		move_uploaded_file($_FILES["thumb_image"]["tmp_name"],$ProdThumbImgDir.$TImage);
		$imageuploadthumb=",about_text='".$TImage."'";
	 }


			if(trim($_POST['thumb_image'])!="")
			{
				$about_text=mysqli_real_escape_string($cn,$_POST['about_text']);
			}
			if(trim($_POST['about_title'])!="")
			{
				$about_title=mysqli_real_escape_string($cn,$_POST['about_title']);
			}
			
	if ($_POST["txtMode"]=="A")
	{	
		
		$varCode = GetMaxNumber("aboutus_m","about_code ",$cn);
		
		 $sql_string = "INSERT INTO aboutus_m(about_text,about_title) VALUES('".$TImage."','".$about_title."')";
		
		$check_res = mysqli_query($cn,$sql_string);
		$currid = mysqli_insert_id($cn);
		
		
		
		closeconnection($cn);
		
		$redirect="aboutus_list.php";
		header("Location: $redirect");
		exit;
	}
}

//--------------MODE E-----------------------

if (isset($_POST["txtMode"])=="EA")
{
	if(trim($_POST['about_title'])!="")
	{
		$about_title=mysqli_real_escape_string($cn,$_POST['about_title']);
	}
			
	$sql_string = "UPDATE  aboutus_m SET ";
	$sql_string  = 	$sql_string . "about_title='".$about_title."'";
	$sql_string  = 	$sql_string . $imageuploadthumb;
	$sql_string  = $sql_string . " where about_code =" . $varCode ;

	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$redirect="aboutus_list.php";
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
                                  <td width="25%" class="h1" style="padding-left:25px; ">About US</td>
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
                          <td class="text_bold_head"><form name="frm" method="post" action="aboutus_m.php" enctype="multipart/form-data">
                            
							<input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                            <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="2%">&nbsp;</td>
                                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr valign="middle">
                                    <td align="right" class="text" style="padding-left:30px;"><div align="right">Title</div></td>
                                    <td align="center" ><strong>:</strong></td>
                                    <td height="30" colspan="2" align="left"><input name="about_title" type="text" value="<?php echo isset($about_title) ? $about_title :""; ?>" size="50">  </td>
                                  </tr>
                                  <tr valign="middle">
                                    <td width="18%" align="right" class="text" style="padding-left:30px;"><div align="right">About Us Text </div></td>
                                    <td width="4%" align="center" ><strong>:</strong></td>
                                    <td height="30" colspan="2" align="left"><input type="file" name="thumb_image"></td>
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
