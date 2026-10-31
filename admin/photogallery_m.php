<?php
 	 include "noentry.php";	
     include "connection/conn.php";
	// require "noentry.php";
	 
//mode management
$ProdThumbImgDir = "images/gallery/thumb/";
$ProdLargeImgDir = "images/gallery/large/";
$varCode="";
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
	$varCode = isset($_GET['Code']) ? $_GET['Code'] : "";
}
else
{
	$varCode = $_POST['txtCode'];
}

//---------------Photo Category-------------------
$sql_cat = "select photo_id,image_title from photo_gallary";
$chk_cat = mysqli_query($cn,$sql_cat);



//  get  News category data //
 $sqlcategory= "select * from products_cat where cat_type='photogallery'";
 $check_category=mysqli_query($cn,$sqlcategory);
 $numcategory=mysqli_num_rows($check_category);


if($numcategory>0) 
{
	$category_info=array();
	while($row=mysqli_fetch_assoc($check_category))
	{
		$f['cat_id']=stripslashes($row['cat_id']);
		$f['cat_name']=stripslashes($row['cat_name']);
		$category_info[]=$f;
	}
}
	

//---------------QueryString-------------------
$image_title = "";
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM photo_gallary where photo_id =". $varCode;
	
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
			$thumb_image = $rec['thumb_image'];
			$large_image = $rec['large_image'];
			$image_title = $rec['image_title'];	
			$vartxtcat = $rec['cat_id'];							
		}
	}
}

else
{
	$image_title = isset($_POST["image_title"]);
	$vartxtcat = isset($_POST['cat_name']);	
}

//-------------MODE A------------------------
if ($_POST)
{
  $TImage='';
	if($_FILES["thumb_image"]["name"]!=""){
		$filename = $_FILES["thumb_image"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage = $sys_name.$extension;
		  $ProdThumbImgDir.$TImage;
		 
		
		  move_uploaded_file($_FILES["thumb_image"]["tmp_name"],$ProdThumbImgDir.$TImage);
		 
		$imageuploadthumb=",thumb_image='".$TImage."'";
	}
	
	if($_FILES["large_image"]["name"]!=""){
		$filename = $_FILES["large_image"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$EImage = $sys_name.$extension;
		  $ProdLargeImgDir.$EImage;
		 
		
		  move_uploaded_file($_FILES["large_image"]["tmp_name"],$ProdLargeImgDir.$EImage);
		 
		$imageuploadlarge=",large_image='".$EImage."'";
	}
	
	if ($_POST["txtMode"]=="A")
	{	
		   //echo $sql_string="insert into province_m(province_name_vc,default) values('".$vartxtstate."','".$vardefault."')";
			 $sql_string = "INSERT INTO photo_gallary(image_title,thumb_image,large_image,cat_id) VALUES(";
			$sql_string = $sql_string . "'".$_POST['image_title'] . "',";
			$sql_string = $sql_string . "'". $TImage . "',";
			$sql_string = $sql_string . "'". $EImage . "',";
			$sql_string = $sql_string . "'". $_POST['cat_name'] . "')";
			    
			 
			$check_res = mysqli_query($cn,$sql_string);
			  
			  
			closeconnection($cn);
			
			$redirect="photogallery_list.php";
			header("Location: $redirect");
			exit;
			 
	}
}

//--------------MODE E-----------------------
 
if (isset($_POST["txtMode"])=="EA")
{ 
		 if($imageuploadthumb!="" && $imageuploadlarge!="")
		 {
				 	$sql="select thumb_image,large_image from photo_gallary WHERE photo_id = (" .$varCode . ")";
					$check_res = mysqli_query($cn,$sql) or die(mysqli_error($cn));
					$tmp=mysqli_fetch_assoc($check_res);
					if($tmp['thumb_image']!="" && file_exists($ProdThumbImgDir.$tmp['thumb_image']))
					{
						unlink($ProdThumbImgDir.$tmp['thumb_image']);
					
					}
					if($tmp['large_image']!="" && file_exists($ProdLargeImgDir.$tmp['large_image']))
					{
						unlink($ProdLargeImgDir.$tmp['large_image']);
					
					}
					
		 } 
		 
		 $sql_string = "UPDATE photo_gallary SET image_title = '" .$_POST['image_title']."',cat_id='".$_POST['cat_name']."'";
		 $sql_string.= "$imageuploadthumb $imageuploadlarge"; 
		 $sql_string = $sql_string ." where photo_id =" . $varCode ;
		 
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
		$redirect="photogallery_list.php";
			header("Location: $redirect");
		exit;
	 
}
 //echo $image_title; exit;
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
	if(frm.cat_name.value == "")
	{
		alert("Please enter Category Name");
		frm.cat_name.focus();
		return false;
	}
	else if(frm.image_title.value == "")
	{
		alert("Please enter Image Title");
		frm.image_title.focus();
		return false;
	}
	else if(frm.txtCode.value=="" && frm.large_image.value == "")
	{
		alert("Please upload Large Image");
		frm.large_image.focus();
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
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}

</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr><td height="35"></td></tr>
	  <tr bgcolor="#ffffff">
      	<td valign="top" bgcolor="#FFFFFF" class="h1" > <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
        Administration Panel<br>
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
                <td><table width="99%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" valign="top">
                      <form name="frm" method="post" action="photogallery_m.php" enctype="multipart/form-data">
                        <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                        <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="5" colspan="2" class="text style2"></td>
                          </tr>
                          <tr>
                            <td height="12" colspan="2"></td>
                          </tr>
                          <tr>
                            <td height="12" colspan="2"></td>
                          </tr>
                          <tr>
                            <td height="12" colspan="2"></td>
                          </tr>
                          <tr>
                            <td height="12" colspan="2"></td>
                          </tr>
                          <tr>
                            <td width="32%" class="h1" style="padding-left:25px; ">Photogallery Master </td>
                            <td width="68%"><div align="right"> </div></td>
                          </tr>
                          <tr>
                            <td height="20" colspan="2"></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="right" valign="middle" class="text"> Photogallery Category </td>
                                  <td align="center" valign="middle"><strong>:</strong></td>
                                  <td valign="top" class="form_field">
                                    <select name= "cat_name" id="cat_name" class="txtbox">
                                      <option value="">Please Select</option>
                                      <?php foreach($category_info as $val){ 
							if($vartxtcat==$val['cat_id']) { ?>
                                      <option value="<?php echo $val['cat_id']; ?>" selected><?php echo $val['cat_name']; ?></option>
                                      <?php } else { ?>
                                      <option value="<?php echo $val['cat_id']; ?>"><?php echo $val['cat_name']; ?></option>
                                      <?php } } ?>
                                    </select>
                                  </td>
                                </tr>
								<tr>
                                  <td></td>
                                  <td></td>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td width="145" align="right" valign="middle" class="text"><div align="right">Image Title </div></td>
                                  <td width="10" align="center" valign="middle"><strong>:</strong></td>
                                  <td width="569" align="left" valign="middle">
                                    <input type="text" name="image_title" id="image_title" value="<?php echo $image_title?>"></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td height="5"></td>
                                </tr>
                                <!-- <tr>
                                  <td width="145" align="right" valign="middle" class="text"><div align="right">Thumbnail Image </div></td>
                                  <td align="center" valign="middle"><strong>:</strong></td>
                                  <td align="left" valign="middle"><input type="file" name="thumb_image" id="thumb_image"></td>
                                </tr> -->
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td align="right" valign="middle" class="text">Large Image </td>
                                  <td align="center" valign="middle"><strong>:</strong></td>
                                  <td align="left" valign="middle"><input type="file" name="large_image" id="large_image"></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td align="left" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td align="left" valign="top"><input type="submit" name="btnadd2" id="btnadd2" value="Submit" onClick="return doSubmit();" style="cursor:pointer;" />
                                      <input type="button" name="btncancel" id="btncancel" value="Cancel" style="cursor:pointer;" onClick="window.location='photogallery_list.php'" /></td>
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