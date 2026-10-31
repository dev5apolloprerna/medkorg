<?php
  	require 'noentry.php';
  	include 'connection/conn.php';
 	$ProdThumbImgDir = "/images/gallery/posts/thumb/";

	//mode management
	$varMode="";
	if (isset($_POST["txtMode"])=="")
	{
		$varMode = isset($_GET['Mode']) ? $_GET['Mode'] :"";
	}
	else
	{
		$varMode = $_POST['txtMode'];
	}
	$varCode="";
	if (isset($_POST["txtCode"]) =="")
	{
		$varCode = isset($_GET['Code']) ? $_GET['Code'] : "";
	}
	else
	{
		$varCode = $_POST['txtCode'];
	}
	
	if (isset($_POST["txtty"])=="")
	{
		$ty = isset($_GET['ty']) ? $_GET['ty'] : "";
	}
	else
	{
		$ty = $_POST['txtty'];
	}

	//---------------QueryString-------------------
	if ($varMode=="E")
	{
		
		$sql_string = "SELECT * FROM post_m where post_id =".$varCode." ";
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		$category=array();
		
		if (mysqli_num_rows($check_res)<1)
		{
			echo("No rows in the database to display");
			exit;
		}
		else
		{
			while ($rec = mysqli_fetch_array($check_res))
			{
				$post_menu_vc = $rec['post_menu_vc'];
				$post_type_vc = $rec['post_type_vc'];
				$post_title_vc = $rec['post_title_vc'];
				$post_shortdesc_vc = $rec['post_shortdesc_vc'];
				$post_fulldesc_vc = $rec['post_fulldesc_vc'];
				$post_videohtml_vc = $rec['post_videohtml_vc'];
				$post_prodcat_int = $rec['post_prodcat_int'];
				$post_active = $rec['post_active'];
				$post_identifier = $rec['post_identifier'];
				$page_title_vc = $rec['page_title_vc'];
				$meta_keywords_vc = $rec['meta_keywords_vc'];
				$meta_description_vc = $rec['meta_description_vc'];
				//$TImage = $rec['thumb_image'];
				$alt_tag = $rec['alt_tag'];
				$title_tag = $rec['title_tag'];
				$nos_prod_rightside = isset($rec['nos_prod_rightside']) ? $rec['nos_prod_rightside'] : "";
				
			}
		}
		//$varMode="EA";
	}
	else
	{
		$post_type_vc = isset($_POST['post_type_vc']) ? $_POST['post_type_vc'] : "";
		$post_title_vc = isset($_POST['post_title_vc']) ? $_POST['post_title_vc'] : "";
		$post_shortdesc_vc = isset($_POST['post_shortdesc_vc']) ? $_POST['post_shortdesc_vc'] : "";
		$post_fulldesc_vc = isset($_POST['post_fulldesc_vc']) ? $_POST['post_fulldesc_vc'] : "";
		$post_active = isset($_POST['post_active']) ? $_POST['post_active'] : "";
	}

	//-------------MODE A------------------------
	if ($_POST)
	{
		if($_FILES["thumb_image"]["name"]!="")
		{
			$filename = $_FILES["thumb_image"]["name"];
			$tofind = ".";
			$filename_len = strlen($filename);
			$position_num = strpos($filename,$tofind);
			$extension = substr("$filename",$position_num,$filename_len-$position_num);
			$sys_name = rand();
			$TImage = $sys_name.$extension;
			//echo $ProdThumbImgDir.$TImage;
			$fileDestination = $ProdThumbImgDir.$TImage;
			
			//move_uploaded_file($_FILES["thumb_image"]["tmp_name"],$ProdThumbImgDir.$TImage);
			if (!file_exists($ProdThumbImgDir)) {
				mkdir($ProdThumbImgDir, 0777, true);
			}
			move_uploaded_file($_FILES['thumb_image']['tmp_name'],$fileDestination);
			$imageuploadthumb=",thumb_image='".$TImage."'";
			
		}
		
		
		if ($_POST["txtMode"]=="A")
		{	
			{
				$sql_string = "INSERT INTO post_m(post_menu_vc,post_title_vc,post_shortdesc_vc,post_fulldesc_vc,post_active,thumb_image) VALUES(";
				$sql_string = $sql_string . "'". $ty . "',";
				$sql_string = $sql_string . "'". $post_title_vc . "',";
				$sql_string = $sql_string ."'".  $post_shortdesc_vc . "',";
				$sql_string = $sql_string ."'".  $post_fulldesc_vc .  "',";
				$sql_string = $sql_string . "'". $post_active .  "',";
				$sql_string = $sql_string . "'". $TImage .  "')";
				$check_res = mysqli_query($cn,$sql_string);
				 
				closeconnection($cn);
							
				$redirect="posts_list.php?ty=" . $ty;
				header("Location: $redirect");
				exit;
			}	
		}
	

	//--------------MODE E-----------------------
	if ($_POST["txtMode"]=="EA")
	{
		{
			
			$sql_string = "UPDATE post_m SET post_menu_vc = '" .$_POST['txtty']."'";
			$sql_string.= ",post_title_vc = '" .$_POST['post_title_vc'] ."'";
			$sql_string.= ",post_shortdesc_vc = '" .$_POST['post_shortdesc_vc'] ."'";
			$sql_string.= ",post_fulldesc_vc = '" .$_POST['post_fulldesc_vc'] ."'";
			$sql_string.= ",post_active = '" .$_POST['post_active'] ."'";
			
			//$sql_string.= ",thumb_image = '" .$TImage ."'";
			$sql_string.= " $imageuploadthumb ";
			
			
			$sql_string = $sql_string ." where post_id =" . $varCode ;
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			
			$redirect="posts_list.php?ty=" . $ty;
			header("Location: $redirect");
			exit;
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
                                  <td width="69%">&nbsp;</td>
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
                                  <td width="31%" class="h1" style="padding-left:25px; "><p>Useful Info Posts Master </p>                                    </td>
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
                          <td class="text_bold_head">
						  	<form name="frm" method="post" action="posts_m.php" enctype="multipart/form-data">
							  <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
							  <input type="hidden" name="txtty" value="<?php echo $ty; ?>">
							  <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
								  <table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
									  <td height="5" class="text style2"></td>
									</tr>
									<tr>
									  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
										  <td width="148" align="right" valign="middle" class="text"> Post Title </td>
										  <td width="11" align="center" valign="middle"><strong>:</strong></td>
										  <td width="569" align="left" valign="middle" class="txtbox"> <input name="post_title_vc" type="text" class="text" id="post_title_vc" value="<?php echo($post_title_vc); ?>" size="60">   </td>
										</tr>
										<tr>
										  <td></td>
										  <td></td>
										  <td height="5" class="txtbox"></td>
										  </tr>
										<tr>
										  <td align="right" valign="top" class="text">Short Description </td>
										  <td align="center" valign="top"><strong>:</strong></td>
										  <td align="left" valign="middle" class="txtbox">
											<textarea name="post_shortdesc_vc" id="post_shortdesc_vc" cols="60" rows="8"><?php echo $post_shortdesc_vc; ?></textarea>
											<script type="text/javascript">
												CKEDITOR.replace('post_shortdesc_vc');
											   </script>
										  </td>
										</tr>
										<tr>
										  <td align="right" valign="middle" class="text">&nbsp;</td>
										  <td align="center" valign="middle">&nbsp;</td>
										  <td align="left" valign="middle" class="txtbox">&nbsp;</td>
										</tr>
										<tr>
										  <td align="right" valign="top" class="text">Full Description </td>
										  <td align="center" valign="top"><strong>:</strong></td>
										  <td align="left" valign="middle" class="txtbox">
											<textarea name="post_fulldesc_vc" id="post_fulldesc_vc" cols="60" rows="8"><?php echo $post_fulldesc_vc; ?></textarea>
											<script type="text/javascript">
												CKEDITOR.replace('post_fulldesc_vc');
											   </script>
										  </td>
										</tr>
										<tr>
										  <td align="right" valign="middle" class="text">&nbsp;</td>
										  <td align="center" valign="middle">&nbsp;</td>
										  <td align="left" valign="middle" class="txtbox">&nbsp;</td>
										</tr>
										<tr>
										  <td align="right" valign="middle" class="text"> Image</td>
										  <td align="center" valign="middle"><strong>:</strong></td>
										  <td align="left" valign="middle" class="txtbox">
											<input name="thumb_image" type="file" class="text" id="thumb_image" size="60">
										  </td>
										</tr>
										<!--<tr>
										  <td align="right" valign="middle" class="text"> Image</td>
										  <td align="center" valign="middle"><strong>:</strong></td>
										  <td align="left" valign="middle">
											<input name="thumb_image" type="text" class="text" id="thumb_image" size="60">
										  </td>
										</tr>
										-->
										<tr>
										  <td></td>
										  <td></td>
										  <td height="5" class="txtbox"></td>
										  </tr>
											  <td align="right" valign="middle" class="text">Active</td>
											<td align="center" valign="top"><strong>:</strong></td>
											<td align="left" valign="top" class="txtbox">
											  <select name="post_active" id="post_active" class="txtbox">
												<?php if($post_active == 'N' || $post_active == ''){?>
												<option value="N" selected>No</option>
												<?php } else {?>
												<option value="N">No</option>
												<?php }?>
												<?php if($post_active == 'Y'){ ?>
												<option value="Y" selected>Yes</option>
												<?php }else {?>
												<option value="Y">Yes</option>
												<?php }?>
											  </select>
										  </tr>
											<tr>
											  <td height="27">&nbsp;</td>
											  <td>&nbsp;</td>
											  <td align="left" valign="top">&nbsp;</td>
											</tr>
											<tr>
										  <td height="27">&nbsp;</td>
										  <td>&nbsp; </td>
										  <td align="left" valign="top"><input type="submit" name="btnadd2" id="btnadd2" value="Submit" onClick="javascript: return doSubmit();" style="cursor:pointer;" /><input type="button" name="btncancel" id="btncancel" value="Cancel" style="cursor:pointer;" onClick="window.location='posts_list.php?ty=<?php echo($ty); ?>'" /></td>
										</tr>
										
									  </table></td>
										</tr>
									  </table>
							  </form>
						  </td>
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
