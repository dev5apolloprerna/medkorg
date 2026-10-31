<?php
 
   require 'noentry.php';
  include "connection/conn.php";
	//  require "noentry.php";
 // $ProdThumbImgDir = "images/gallery/posts/thumb/";

	//mode management
	if (isset($_POST["txtMode"])=="")
	{
		$varMode = $_GET['Mode'];
	}
	else
	{
		$varMode = $_POST['txtMode'];
	}
	$varCode="";
	if (isset($_POST["txtCode"])=="")
	{
		$varCode =isset($_GET['Code']) ? $_GET['Code'] : "";
	}
	else
	{
		$varCode = $_POST['txtCode'];
	}
	
	if (isset($_POST["txtty"])=="")
	{
		$ty = $_GET['ty'];
	}
	else
	{
		$ty = $_POST['txtty'];
	}

	$prodcat=array();
		
	//$sel_query=mysql_query("select * from category where parent_cat!=0");
	/*while($row=mysql_fetch_array($sel_query))
	{
		$p['cat_id']=$row['cat_id'];
		$p['cat_name']=$row['cat_name'];
		
		$prodcat[]=$p;
	}*/
	
	//---------------QueryString-------------------
	if ($varMode=="E")
	{
		$sql_string = "SELECT * FROM post_m where post_id =".$varCode." ";
		$check_res = mysqli_query($cn,$sql_string);
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
				$post_category_id = $rec['post_category_id'];
			}
		}
		$varMode="EA";
	}
	else
	{
		$post_type_vc = isset($_POST['post_type_vc']) ? $_POST['post_type_vc'] : "";
		$post_title_vc = isset($_POST['post_title_vc']) ? $_POST['post_title_vc'] : "";
		$post_shortdesc_vc = isset($_POST['post_shortdesc_vc']) ? $_POST['post_shortdesc_vc'] : "";
		$post_fulldesc_vc = isset($_POST['post_fulldesc_vc']) ? $_POST['post_fulldesc_vc'] : "";
		$post_videohtml_vc = mysqli_real_escape_string($cn,isset($_POST['post_videohtml_vc'])) ? $_POST['post_videohtml_vc'] : "";
		$post_prodcat_int = isset($_POST['post_prodcat_int']) ? $_POST['post_prodcat_int'] : "";
		$post_active = isset($_POST['post_active']) ? $_POST['post_active'] : "";
		$post_identifier = isset($_POST['post_identifier']) ? $_POST['post_identifier'] : "";
		$page_title_vc = isset($_POST['page_title_vc']) ? $_POST['page_title_vc'] : "";
		$meta_keywords_vc = isset($_POST['meta_keywords_vc']) ? $_POST['meta_keywords_vc'] : "";
		$meta_description_vc = isset($_POST['meta_description_vc']) ? $_POST['meta_description_vc'] : "";
		//$TImage = $_POST['thumb_image'];
		$alt_tag = isset($_POST['alt_tag']) ? $_POST['alt_tag'] : "";
		$title_tag = isset($_POST['title_tag']) ? $_POST['title_tag'] : "";
		$post_category_id = isset($_POST['post_category_id']) ? $_POST['post_category_id'] : "";
	}

	//-------------MODE A------------------------
	if ($_POST)
	{
		/*if($_FILES["thumb_image"]["name"]!="")
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
			  $imageuploadthumb=",thumb_image='".$TImage."'";
		}*/
		
		
		if ($_POST["txtMode"]=="A")
		{	
		
							$sql_string = "INSERT INTO post_m(post_category_id,post_menu_vc,post_title_vc,post_shortdesc_vc,post_fulldesc_vc,post_videohtml_vc) VALUES(";
				$sql_string = $sql_string . "'". $post_category_id . "',";
				$sql_string = $sql_string . "'". $ty . "',";
				$sql_string = $sql_string . "'". $post_title_vc . "',";
				$sql_string = $sql_string ."'".  $post_shortdesc_vc . "',";
				$sql_string = $sql_string ."'".  $post_fulldesc_vc .  "',";
				$sql_string = $sql_string . "'". $post_videohtml_vc .   "')";
				
				$check_res = mysqli_query($cn,$sql_string);
				closeconnection($cn);
				$redirect="list_post.php?ty=" . $ty;
				header("Location: $redirect");
				exit;
				
		}
	}
	//--------------MODE E-----------------------
	if (isset($_POST["txtMode"])=="EA")
	{
		{
      
      $sql_string = "UPDATE post_m SET post_category_id = '" .$_POST['post_category_id']."'";
			$sql_string.= ",post_menu_vc = '" .$_POST['ty'] ."'";
			$sql_string.= ",post_title_vc = '" .$_POST['post_title_vc'] ."'";
			$sql_string.= ",post_shortdesc_vc = '" .$_POST['post_shortdesc_vc'] ."'";
			$sql_string.= ",post_fulldesc_vc = '" .$_POST['post_fulldesc_vc'] ."'";
			$sql_string.= ",post_videohtml_vc = '" . stripslashes(mysqli_real_escape_string($cn,$_POST['post_videohtml_vc'])) ."'";
			
			
			//$sql_string.= ",thumb_image = '" .$TImage ."'";
			$sql_string.= " $imageuploadthumb ";
			
			$sql_string = $sql_string ." where post_id =" . $varCode ;
			
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			
			$redirect="list_post.php?ty=" . $ty;
			header("Location: $redirect");
			exit;
		}
	}
?>
<html>
<head>
<title>Administration Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<script language="JavaScript" type="text/JavaScript">
function doCancel() {
window.location="list_prodCat.php";
}

function doSubmit()
{
	
	 
	if (document.frm.cat_name.value == "")
	{
		 
		alert("Please enter Value");
		document.frm.cat_name.focus();
		return false;
	}
	else
	{
	 
		if(document.frm.txtMode.value == "E")
		{
			document.frm.txtMode.value = "EA";			
		}
		else
		{
			document.frm.txtMode.value = "A";
		}
	}
}

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
.style7 {color: #FFFFFF}
.style8 {font-weight:bolder; font-family: Arial, Helvetica, sans-serif;}
.style9 {font-size: 13px; font-weight: bold;}
.style10 {font: 12px/100% Arial, Helvetica, sans-serif}
.style11 {font: 10px/160% Verdana,Tahoma, Arial, sans-serif}
.style12 {
	color: #000000;
	font-weight: bold;
}
.style13 {color: #FF0000}
-->
</style>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
<span class="style7">
<!-- ImageReady Slices (01-modified.psd) -->
</span>
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" bgcolor="ffffff" class="style7">s
      <table width="971" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#FCFCFC" >
            <blockquote>
            <p><span class="style8"><font size="+2" class="style8"><br>
        Administration Panel<br>
        <br>
            </font></span></p>
        </blockquote>        </td>
      </tr>
      <tr>
        <td valign="top" background="images/page_bg.gif"><table width="945" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><table width="906" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr bgcolor="#063968">
                <td height="3"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td height="15"></td>
                <td></td>
                <td bgcolor="#FFFFFF"></td>
                <td></td>
              </tr>
              <tr>
                <td width="265" align="left" valign="top" style="background:url(images/login_btm_clr.gif) bottom left no-repeat #f6f6f6;">
				<?php include 'menu.php'?>				</td>
                <td width="15"></td>
                <td align="center" valign="top" style="border:1px solid #e4e1e1;"><table width="99%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" valign="top">  <form action="post_m.php" method="post" enctype="multipart/form-data" name="frm" class="style7">
				  <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
				  <input type="hidden" name="txtty" value="<?php echo $ty; ?>">
			<input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="5" class="text  style9"></td>
                        </tr>
                        
                           <tr>
                          <td height="12"></td>
                        </tr>
                        <tr>
                          <td height="25" bgcolor="#FFFFFF" class="h1">Post Articles </td>
                        </tr> 
                        <tr>
                          <td height="12"></td>
                        </tr>
                        <tr>
                          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                              <td width="144" align="right" valign="middle" class="text">Category </td>
                              <td width="29" align="center" valign="middle"><span class="style12">:</span></td>
                              <td width="437" align="left" valign="middle"> 
							   <select name="post_category_id">
							   <?php
							   
							  $sql_string="select * from post_m ";
							  $sql_res=mysqli_query($cn,$sql_string);
							 while($category=mysqli_fetch_assoc($sql_res))
							 {
								if ($category['post_id']== $post_category_id)
								{
							 ?>
							 		<option selected value="<?php echo $category['post_id'];?>">
									<?php echo $category['post_title_vc'];?>
									 </option>
							<?php 
								}
								else
								{
							 ?>
							 		<option value="<?php echo $category['post_id'];?>">
									<?php echo $category['post_title_vc'];?>
									 </option>
                                     
							<?php 
								}
							}
							 ?>
							  </select>  </td>
                            </tr>
							<tr>
                              <td width="144" align="right" valign="middle" class="text"> Post Title </td>
                              <td width="29" align="center" valign="middle"><span class="style12">:</span></td>
                              <td width="437" align="left" valign="middle"> <input name="post_title_vc" type="text" class="style10" id="post_title_vc" value="<?php echo($post_title_vc); ?>" size="60">   </td>
                            </tr>
                            <tr>
                              <td></td>
							  <td></td>
							  <td height="5"></td>
							  </tr>
                            <!--<tr>
                              <td align="right" valign="middle" class="text">Product Category </td>
                              <td align="center" valign="middle"><strong>:</strong></td>
                              <td align="left" valign="middle">
							  <select name="post_prodcat_int" id="post_prodcat_int" class="txtbox">
							  <option selected value="0"></option>
                                    <?php 
								/*foreach($prodcat as $curcat)
								{
								  	if($post_prodcat_int==$curcat['cat_id'])
								 {
								?>
                                    <option value="<?php echo $curcat['cat_id'];?>" selected><?php echo $curcat['cat_name'];?></option>
                                    <?php
								 }
								 else{
								 ?>
                                    <option value="<?php echo $curcat['cat_id'];?>"><?php echo $curcat['cat_name'];?></option>
                                    <?php
								 }}*/
								?>
                                  </select>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td height="5"></td>
                            </tr>-->
                            <tr>
                              <td align="right" valign="top" class="text">Short Description </td>
                              <td align="center" valign="top"><span class="style12">:</span></td>
                              <td align="left" valign="middle">
                                <textarea name="post_shortdesc_vc" id="post_shortdesc_vc" cols="60" rows="8"><?php echo $post_shortdesc_vc; ?></textarea>
                                <script type="text/javascript">
									CKEDITOR.replace('post_shortdesc_vc');
								   </script>                              </td>
                            </tr>
                            <tr>
                              <td align="right" valign="middle" class="style10">&nbsp;</td>
                              <td align="center" valign="middle">&nbsp;</td>
                              <td align="left" valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="right" valign="top" class="text">Full Description </td>
                              <td align="center" valign="top"><span class="style12">:</span></td>
                              <td align="left" valign="middle">
                                <textarea name="post_fulldesc_vc" id="post_fulldesc_vc" cols="60" rows="8"><?php echo $post_fulldesc_vc; ?></textarea>
                                <script type="text/javascript">
									CKEDITOR.replace('post_fulldesc_vc');
								   </script>                              </td>
                            </tr>
                            <tr>
                              <td align="right" valign="middle" class="style10">&nbsp;</td>
                              <td align="center" valign="middle">&nbsp;</td>
                              <td align="left" valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="right" valign="top" class="text">Video HTML </td>
                              <td align="center" valign="top"><span class="style12">:</span></td>
                              <td align="left" valign="middle"><textarea name="post_videohtml_vc" cols="50" rows="5" id="post_videohtml_vc"><?php echo($post_videohtml_vc); ?></textarea>                              </td>
                            </tr>
                            <tr>
                              <td align="right" valign="middle" class="style10">&nbsp;</td>
                              <td align="center" valign="middle">&nbsp;</td>
                              <td align="left" valign="middle">&nbsp;</td>
                            </tr>
                           <!-- <tr>
                              <td align="right" valign="middle" class="text"> Image</td>
                              <td align="center" valign="middle"><span class="style12">:</span></td>
                              <td align="left" valign="middle">
                                <input name="thumb_image" type="file" class="style10" id="thumb_image" size="60">                              </td>
                            </tr>
							<tr>
                              <td align="right" valign="middle" class="text"> Image Alt Tag Text</td>
                              <td align="center" valign="middle"><span class="style12">:</span></td>
                              <td align="left" valign="middle">
                                <input name="alt_tag" type="text" class="style10" id="alt_tag" size="60">                              </td>
                            </tr>
							<tr>
                              <td align="right" valign="middle" class="text"> Image Title Tag Text</td>
                              <td align="center" valign="middle"><span class="style12">:</span></td>
                              <td align="left" valign="middle">
                                <input name="title_tag" type="text" class="style10" id="title_tag" size="60">                              </td>
                            </tr>
							<tr>
                              <td align="right" valign="middle" class="text"> Image</td>
                              <td align="center" valign="middle"><strong>:</strong></td>
                              <td align="left" valign="middle">
                                <input name="thumb_image" type="text" class="text" id="thumb_image" size="60">
                              </td>
                            </tr>
							
							<tr>
                              <td align="right" valign="middle" class="text">Identifier</td>
                              <td align="center" valign="middle"><span class="style12">:</span></td>
                              <td align="left" valign="middle">
                                <input name="post_identifier" type="text" class="style10" id="post_identifier" value="<?php //echo($post_identifier); ?>" size="60">                              </td>
                            </tr>
                            <tr>
                              <td align="right" valign="middle" class="text">Page Title</td>
                              <td align="center" valign="middle"><span class="style12">:</span></td>
                              <td align="left" valign="middle">
                                <input name="page_title_vc" type="text" class="style10" id="page_title_vc" value="<?php //echo($page_title_vc); ?>" size="60">                              </td>
                            </tr>
                            <tr>
                              <td width="144" align="right" valign="middle" class="text"> Meta Keyword </td>
                              <td align="center" valign="middle"><span class="style12">:</span></td>
                              <td align="left" valign="middle"> <input name="meta_keywords_vc" type="text" class="style10" id="meta_keywords_vc" value="<?php //echo($meta_keywords_vc); ?>" size="60">   </td>
                            </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td height="5"></td>
                              </tr>
                              <tr>
                                <td align="right" valign="top" class="text">Meta Description</td>
                                <td align="center" valign="top"><span class="style12">:</span></td>
                                <td align="left" valign="middle"><textarea name="meta_description_vc" cols="50" rows="5" id="meta_description_vc"><?php //echo($meta_description_vc); ?></textarea>                                </td>
                              </tr>
                            <tr>
                              <td></td>
							  <td></td>
							  <td height="5"></td>
							</tr>
                            <tr>
							      <td align="right" valign="middle" class="style10">Active</td>
							    <td align="center" valign="top"><strong>:</strong></td>
							    <td align="left" valign="top">
                                  <select name="post_active" id="post_active" class="txtbox">
                                    <?php /*if($post_active == 'N' || $post_active == ''){?>
                                    <option value="N" selected>No</option>
                                    <?php } else {?>
                                    <option value="N">No</option>
                                    <?php }?>
                                    <?php if($post_active == 'Y'){ ?>
                                    <option value="Y" selected>Yes</option>
                                    <?php }else {?>
                                    <option value="Y">Yes</option>
                                    <?php } */?>
                                  </select>   
                                  </table>
                                  </td>                           
                             </tr>
                             -->
                                <tr>
                                  <td height="27">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td align="left" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                              <td height="27">&nbsp;</td>
                              <td>&nbsp; </td>
                              <td align="left" valign="top"><input type="submit" name="btnadd2" id="btnadd2" value="Submit" onClick="return doSubmit();" style="cursor:pointer;" /><input type="button" name="btncancel" id="btncancel" value="Cancel" style="cursor:pointer;" onClick="window.location='list_post.php?ty=<?php echo($ty); ?>'" /></td>
                            </tr>
                            
                          </table></td>
                        </tr>
                      </table>
                    </form></td>
                  </tr>
                </table></td>
                <td valign="top" width="10">&nbsp;</td>
              </tr>
              <tr>
                <td height="15"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td height="15"></td>
                <td></td>
                <td height="5"></td>
                <td></td>
              </tr>
              
              <tr>
                <td height="3"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>

            </table></td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td height="44" valign="top">&nbsp;</td>
      </tr>
    </table> <tr bgcolor="#000000">
    <td valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>