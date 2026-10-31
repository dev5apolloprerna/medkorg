<?php
    error_reporting(E_ALL);
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	$imgdir = "images/advertise/";
	
	include "connection/conn.php";
	// require "noentry.php";
	// include "noentry.php"; 
	
	if ($_SESSION["UserAdminCode"] == "")
	{
		$redirect="index.php";
		header("Location: $redirect");
	}
	
	if (!isset($_POST["txtMode"]) && $_POST["txtMode"] =="")
	{
		$varMode = $_GET['Mode'];
	}
	else
	{
		$varMode = $_POST['txtMode'];
	}
	
	$varCode = "";
	if (!isset($_POST["txtCode"]) && $_POST["txtCode"] =="")
	{
		 
		$varCode = isset($_GET['Code']) ? $_GET['Code'] : "";
		
	}
	else
	{
		$varCode = $_POST['txtCode'];
	}
//---------------QueryString-------------------

if ($varMode=="E")
{
	//echo "Hello";exit;
	
	$sql_advertise = "SELECT * FROM  advt_tbl where advt_id=". $varCode;
	
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
			$varselclient= $rec['client_id_int'];
			$varselpage = $rec['page_id_int'];
			$varselsection= $rec['section_id_int'];
			$vartxtadvtlink= $rec['advt_link'];
			$txtimage = $rec['file'];
		}
	
	}
}
	
//-------------MODE A------------------------
if ($_POST)
{
			if((isset($_POST['selclient']) && $_POST['selclient'] !="") || (isset($_POST['selclient']) && $_POST['selclient']!="0"))
			{
				$selclient=mysqli_real_escape_string($cn,$_POST['selclient']);
			}
			
			if((isset($_POST['selpage']) && $_POST['selpage'] !="") || (isset($_POST['selpage']) && $_POST['selpage']!="0"))
			{
				$selpage=mysqli_real_escape_string($cn,$_POST['selpage']);
			}
			
			if(isset($_POST['selsection'])!="" || isset($_POST['selsection'])!="0")
			{
				$selsection=mysqli_real_escape_string($cn,$_POST['selsection']);
			}
			
			if (isset($_POST['txtadvtlink'])!="")
			{
				$txtadvtlink=mysqli_real_escape_string($cn,$_POST['txtadvtlink']);
			}
			
			$txtimage =isset($_POST['txtimage']);
		
			if($_FILES["txtimage"]["name"]!=""){
				$filename = $_FILES["txtimage"]["name"];
				$tofind = ".";
				$filename_len = strlen($filename);
				$position_num = strpos($filename,$tofind);
				$extension = substr("$filename",$position_num,$filename_len-$position_num);
				$sys_name = rand();
				$TImage = $sys_name.$extension;
				$imgdir.$TImage;
				move_uploaded_file($_FILES["txtimage"]["tmp_name"],$imgdir.$TImage);
				$imageuploadthumb="file='".$TImage."'";
			}
	        
	if ($_POST["txtMode"]=="A")
	{	
		 $varCode = GetMaxNumber("advt_tbl","advt_id ",$cn);
		
		$sql_string = "INSERT INTO advt_tbl(advt_link,client_id_int,page_id_int,section_id_int,file) VALUES('".$txtadvtlink."','".$selclient."','".$selpage."','".$selsection."','".$TImage."')";
		$check_res = mysqli_query($cn,$sql_string);
		$currid = mysqli_insert_id($cn);
		
		
		closeconnection($cn);
		
		$redirect="advertise_list.php";
		header("Location: $redirect");
		exit;
	}
}

//--------------MODE E-----------------------

if (isset($_POST["txtMode"])=="EA")
{
	$sql_string = "UPDATE  advt_tbl SET ";
	$sql_string  = 	$sql_string . "advt_link='".$txtadvtlink."',";
	$sql_string  = 	$sql_string . "client_id_int='".$selclient."',";
	$sql_string  = 	$sql_string . "page_id_int='".$selpage."',";
	$sql_string  = 	$sql_string . "section_id_int='".$selsection."',";
	$sql_string  = 	$sql_string . $imageuploadthumb;
	$sql_string  = $sql_string . " where advt_id =" . $varCode ;

	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$redirect="advertise_list.php";
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
                                  <td width="25%" class="h1" style="padding-left:25px; ">Advertisement</td>
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
                          <td class="text_bold_head"><form name="frm" method="post" action="advertise_m.php" enctype="multipart/form-data">
                            
							<input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                            <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="2%">&nbsp;</td>
                                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  
								  <!--<tr valign="top">
                                    <td width="32%" height="25" align="right" class="text">Client </td>
                                    <td width="1%" height="25">&nbsp;</td>
                                    <td width="72%" height="25" class="text">
                                      <select name="selclient" class="txtbox" tabindex="13">
                                        <option value="0">--Select--</option>
                                        <?php
											$sql_string = "SELECT * FROM client_m";
			
											$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
											if (mysqli_num_rows($check_res)>0)
											{
												while ($rec = mysqli_fetch_array($check_res))
												{
													if ($varselclient == $rec['client_id_int'])
														echo ("<option selected value ='". $rec['client_id_int'] ."'>". $rec['client_name_vc'] ."</option>");
													else
														echo ("<option value ='". $rec['client_id_int'] ."'>". $rec['client_name_vc'] ."</option>");
												}												
											}										  
				  						?>
                                    </select></td>
                                  </tr>-->
                                  <!--<tr valign="top">
                                    <td height="25" class="text" align="right">Page </td>
                                    <td height="25">&nbsp;</td>
                                    <td height="25" class="text">
                                      <select name="selpage" class="txtbox" tabindex="13">
                                        <option value="0">--Select--</option>
                                        <?php
											$sql_page= "SELECT * FROM page_m";
			
											$check_res1 = mysqli_query($cn,$sql_page) or die(mysqli_error($cn));
											if (mysqli_num_rows($check_res1)>0)
											{
												while ($page = mysqli_fetch_array($check_res1))
												{
													if ($varselpage == $page['page_id_int'])
														echo ("<option selected value ='". $page['page_id_int'] ."'>". $page['page_name_vc'] ."</option>");
													else
														echo ("<option value ='". $page['page_id_int'] ."'>". $page['page_name_vc'] ."</option>");
												}												
											}										  
				  						?>
                                    </select></td>
                                  </tr> -->
                                 <!-- <tr valign="top">
                                    <td height="25" class="text" align="right">Section</td>
                                    <td height="25">&nbsp;</td>
                                    <td height="25" class="text">
                                      <select name="selsection" class="txtbox" tabindex="13">
                                        <option value="0">--Select--</option>
                                        <?php
											$sql_section = "SELECT * FROM section_m";
			
											$check_res2 = mysqli_query($cn,$sql_section) or die(mysqli_error($cn));
											if (mysqli_num_rows($check_res2)>0)
											{
												while ($section = mysqli_fetch_array($check_res2))
												{
													if ($varselsection == $section['section_id_int'])
														echo ("<option selected value ='". $section['section_id_int'] ."'>". $section['section_name_vc'] ."</option>");
													else
														echo ("<option value ='". $section['section_id_int'] ."'>". $section['section_name_vc'] ."</option>");
												}												
											}										  
				  						?>
                                    </select></td>
                                  </tr> -->
                                  <tr>
                                      <td width="6%" height="25" align="right" valign="middle" class="text">File</td>
                                      <td width="1%" align="center" valign="middle" class="text"><b>:</b></td>
                                      <td width="93%" valign="middle" class="text"><input name="txtimage" type="file" class="txtrequired txtbox" id="Image"> 
                                      (Note: Keep image size as 450 Width X 59 Height) </td>
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
                                      <td height="12" colspan="3" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                     <td><input type="button" value="Submit" tabindex= "2" width="100" height="33" border="0" onClick="javascript:return doSubmit();"></td>
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
