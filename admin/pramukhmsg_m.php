<?php
require 'noentry.php';
require 'connection/conn.php';
 
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
	$varCode = isset($_GET['Code']);
}
else
{
	$varCode = $_POST['txtCode'];
}

$ProdThumbImgDir = "images/gallery/posts/thumb/";

$sql_string = "SELECT home_code FROM homepg_m";
$check_res = mysqli_query($cn,$sql_string);
$numst = mysqli_num_rows($check_res);
$code = mysqli_fetch_array($check_res);

if($numst > 0)
{
	$varMode = 'E';
	$varCode = $code['home_code'];
}
else
{
	$varMode = 'A';
	$varCode = '';
}		

//---------------QueryString-------------------
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM homepg_m where home_code = '".$varCode."'";
	
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
			 
			 $home_text_short = $rec['home_text_short'];
			 $home_text_full = $rec['home_text_full'];
			 $msg_img = $rec['msg_image'];
			 $txtupload1 = $rec['txtupload1'];
			 $upload1 = $rec['upload1'];
			 $txtupload2 = $rec['txtupload2'];
			 $upload2 = $rec['upload2'];
			 $txtupload3 = $rec['txtupload3'];
			 $upload3 = $rec['upload3'];
			 $txtupload4 = $rec['txtupload4'];
			 $upload4 = $rec['upload4'];
			 $txtupload5 = $rec['txtupload5'];
			 $upload5 = $rec['upload5'];
		}
	}
	
	$varMode = "EA";
	
}

else
{
	 $home_text_short = $_POST['home_text_short'];
	 $home_text_full = $_POST['home_text_full'];
	 $txtupload1 = $_POST['txtupload1'];
	 $txtupload2 = $_POST['txtupload2'];
	 $txtupload3 = $_POST['txtupload3'];
	 $txtupload4 = $_POST['txtupload4'];
	 $txtupload5 = $_POST['txtupload5'];

}
//-------------MODE A------------------------
if ($_POST)
{
	if($_FILES["msg_image"]["name"]!="")
	{
		$filename = $_FILES["msg_image"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage = $sys_name.$extension;
		$ProdThumbImgDir.$TImage;
		  
		  move_uploaded_file($_FILES["msg_image"]["tmp_name"],$ProdThumbImgDir.$TImage);
		  $imageuploadthumb=",msg_image='".$TImage."'";
	}
	if($_FILES["upload1"]["name"]!="")
	{
		$filename = $_FILES["upload1"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage1 = $sys_name.$extension;
		$ProdThumbImgDir.$TImage1;
		  
		  move_uploaded_file($_FILES["upload1"]["tmp_name"],$ProdThumbImgDir.$TImage1);
		  $imageuploadthumb1=",upload1='".$TImage1."'";
	}
	if($_FILES["upload2"]["name"]!="")
	{
		$filename = $_FILES["upload2"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage2 = $sys_name.$extension;
		$ProdThumbImgDir.$TImage2;
		  
		  move_uploaded_file($_FILES["upload2"]["tmp_name"],$ProdThumbImgDir.$TImage2);
		  $imageuploadthumb2=",upload2='".$TImage2."'";
	}
	if($_FILES["upload3"]["name"]!="")
	{
		$filename = $_FILES["upload3"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage3 = $sys_name.$extension;
		$ProdThumbImgDir.$TImage3;
		  
		  move_uploaded_file($_FILES["upload3"]["tmp_name"],$ProdThumbImgDir.$TImage3);
		  $imageuploadthumb3=",upload3='".$TImage3."'";
	}
	if($_FILES["upload4"]["name"]!="")
	{
		$filename = $_FILES["upload4"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage4 = $sys_name.$extension;
		$ProdThumbImgDir.$TImage4;
		  
		  move_uploaded_file($_FILES["upload4"]["tmp_name"],$ProdThumbImgDir.$TImage4);
		  $imageuploadthumb4=",upload4='".$TImage4."'";
	}
	if($_FILES["upload5"]["name"]!="")
	{
		$filename = $_FILES["upload5"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage5 = $sys_name.$extension;
		$ProdThumbImgDir.$TImage5;
		  
		  move_uploaded_file($_FILES["upload5"]["tmp_name"],$ProdThumbImgDir.$TImage5);
		  $imageuploadthumb5 =",upload5='".$TImage5."'";
	}
	
	if ($varMode =="A")
	{	
		$sql_string = "INSERT INTO homepg_m (home_text_short,home_text_full,msg_image,txtupload1,upload1,txtupload2,upload2,txtupload3,upload3,txtupload4,upload4,txtupload5,upload5) VALUES('".$home_text_short."','".$home_text_full."','".$TImage."','".$txtupload1."','".$TImage1."','".$txtupload2."','".$TImage2."','".$txtupload3."','".$TImage3."','".$txtupload4."','".$TImage4."','".$txtupload5."','".$TImage5."')";
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
	$sql_string = "UPDATE homepg_m SET home_text_short='".$_POST['home_text_short']."',home_text_full='".$_POST['home_text_full']."',txtupload1='".$_POST['txtupload1']."',txtupload2='".$_POST['txtupload2']."',txtupload3='".$_POST['txtupload3']."',txtupload4='".$_POST['txtupload4']."',txtupload5='".$_POST['txtupload5']."' $imageuploadthumb $imageuploadthumb1 $imageuploadthumb2 $imageuploadthumb3 $imageuploadthumb4 $imageuploadthumb5 where home_code='".$varCode."'";
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$redirect="home.php";
		header("Location: $redirect");
	exit;
}
 
if(isset($_GET['m']) == "D")
{
	if($_GET['img']	== 1)
	{
		if(file_exists($ProdThumbImgDir.$msg_img))
		{
			unlink($ProdThumbImgDir.$msg_img);
		}
		$sql_string = "UPDATE homepg_m SET msg_image='' where home_code='".$varCode."'";
		$check_res1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	}
	
	if($_GET['up1']	== 1)
	{
		if(file_exists($ProdThumbImgDir.$upload1))
		{
			unlink($ProdThumbImgDir.$upload1);
		}
			
		$sql_string = "UPDATE homepg_m SET upload1='' where home_code='".$varCode."'";
		$check_res1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	}
	if($_GET['up2']	== 2)
	{
		if(file_exists($ProdThumbImgDir.$upload2))
		{
			unlink($ProdThumbImgDir.$upload2);
		}
		$sql_string = "UPDATE homepg_m SET upload2='' where home_code='".$varCode."'";
		$check_res1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	}
	if($_GET['up3']	== 3)
	{
		if(file_exists($ProdThumbImgDir.$upload3))
		{
			unlink($ProdThumbImgDir.$upload3);
		}
		$sql_string = "UPDATE homepg_m SET upload3='' where home_code='".$varCode."'";
		$check_res1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	}
	if($_GET['up4']	== 4)
	{
		if(file_exists($ProdThumbImgDir.$upload4))
		{
			unlink($ProdThumbImgDir.$upload4);
		}
		$sql_string = "UPDATE homepg_m SET upload4='' where home_code='".$varCode."'";
		$check_res1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	}
	if($_GET['up5']	== 5)
	{
		if(file_exists($ProdThumbImgDir.$upload5))
		{
			unlink($ProdThumbImgDir.$upload5);
		}
		$sql_string = "UPDATE homepg_m SET upload5='' where home_code='".$varCode."'";
		$check_res1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	}
	

	$redirect="pramukhmsg_m.php?Code=".$_GET['Code']."&Mode=E";
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
                                  <td width="25%" class="h1" style="padding-left:25px; ">Editor Desk's Message</td>
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
                          <td class="text_bold_head"><form name="frm" method="post" action="pramukhmsg_m.php" enctype="multipart/form-data">
                            
							<input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                            <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="2%">&nbsp;</td>
                                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr valign="middle">
                                    <td align="right" class="text" style="padding-left:30px;"><div align="right">Message Text (Short)</div></td>
                                    <td align="center" ><strong>:</strong></td>
                                    <td height="30" colspan="2" align="left"> </td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" style="padding-left:30px; ">
                                      <div align="left">
                                        <textarea name="home_text_short" id="home_text_short" cols="60" rows="10"><?php echo $home_text_short; ?></textarea>
                                        <script type="text/javascript">
							CKEDITOR.replace('home_text_short');
						          </script>
                                    </div></td>
                                  </tr>
                                  <tr valign="middle">
                                    <td align="right" class="text" style="padding-left:30px;">&nbsp;</td>
                                    <td align="center" >&nbsp;</td>
                                    <td height="30" colspan="2" align="left"></td>
                                  </tr>
                                 <!-- <tr valign="middle">
                                    <td width="24%" align="right" class="text" style="padding-left:30px;"><div align="right">Message Text (Full) </div></td>
                                    <td width="3%" align="center" ><strong>:</strong></td>
                                    <td height="30" colspan="2" align="left"> </td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" style="padding-left:30px; ">
                                      <div align="left">
                                        <textarea name="home_text_full" id="home_text_full" cols="60" rows="10"><?php echo $home_text_full; ?></textarea>
                                        <script type="text/javascript">
											CKEDITOR.replace('home_text_full');
						         		</script>
                                    </div></td>
                                  </tr>-->
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
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Image</div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="file" name="msg_image" id="msg_image"> 
									  	<?php
										if($msg_img!="")
										{
										?>
										&nbsp; <img src="<?php echo $ProdThumbImgDir.$msg_img; ?>" width="100" height="100" border="0"> <a href="pramukhmsg_m.php?Mode=E&m=D&Code=<?php echo $varCode; ?>&img=1"> Remove Image </a> 
										<?php } ?>  
									  </td>
                                    </tr>
                                     <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File Name</div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="text" name="txtupload1" id="txtupload1" value="<?php echo $txtupload1;?>"> 
									  </td>
                                    </tr>
                                    <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File1</div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="file" name="upload1" id="upload1"> 
									  	<?php
										if($upload1!="")
										{
										?>
										<a href="pramukhmsg_m.php?Mode=E&m=D&Code=<?php echo $varCode; ?>&up1=1"> Remove </a> 
										<?php } ?>  
									  </td>
                                    </tr>
                                     <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File Name </div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="text" name="txtupload2" id="txtupload2" value="<?php echo $txtupload2;?>"> 
									  </td>
                                    </tr>
                                    <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File2</div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="file" name="upload2" id="upload2"> 
									  	<?php
										if($upload2!="")
										{
										?>
										<a href="pramukhmsg_m.php?Mode=E&m=D&Code=<?php echo $varCode; ?>&up2=2"> Remove </a> 
										<?php } ?>  
									  </td>
                                    </tr>
                                     <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File Name </div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="text" name="txtupload3" id="txtupload3" value="<?php echo $txtupload3;?>"> 
									  </td>
                                    </tr>
                                    <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File3</div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="file" name="upload3" id="upload3"> 
									  	<?php
										if($upload3!="")
										{
										?>
										<a href="pramukhmsg_m.php?Mode=E&m=D&Code=<?php echo $varCode; ?>&up3=3"> Remove </a> 
										<?php } ?>  
									  </td>
                                    </tr>
                                     <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File Name </div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="text" name="txtupload4" id="txtupload4" value="<?php echo $txtupload4;?>"> 
									  </td>
                                    </tr>
                                    <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File4</div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="file" name="upload4" id="upload4"> 
									  	<?php
										if($upload4!="")
										{
										?>
										<a href="pramukhmsg_m.php?Mode=E&m=D&Code=<?php echo $varCode; ?>&up4=4"> Remove </a> 
										<?php } ?>  
									  </td>
                                    </tr>
                                    <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File Name </div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="text" name="txtupload5" id="txtupload5" value="<?php echo $txtupload5;?>"> 
									  </td>
                                    </tr>
                                    <tr valign="middle">
                                      <td align="right" class="text" style="padding-left:30px;"><div align="right">Upload File5</div></td>
                                      <td align="center" ><strong>:</strong></td>
                                      <td height="30" colspan="2" align="left" class="text"><input type="file" name="upload5" id="upload5"> 
									  	<?php
										if($upload5!="")
										{
										?>
										<a href="pramukhmsg_m.php?Mode=E&m=D&Code=<?php echo $varCode; ?>&up5=5"> Remove </a> 
										<?php } ?>  
									  </td>
                                    </tr>
                                    <tr>
                                      <td colspan="4" style="padding-left:30px; ">
                                        <div align="left">                                        </div>
									  </td>
                                    </tr>
                                    <tr valign="top">
                                      <td colspan="2">&nbsp;</td>
                                      <td width="32%"><div align="center">
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
