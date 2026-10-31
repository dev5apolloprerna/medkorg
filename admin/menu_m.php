<?php
  require 'noentry.php';
  include "connection/conn.php";
	require "noentry.php";
  $ProdThumbImgDir = "images/gallery/thumb/";

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
		$sql_string = "SELECT * FROM menu_m where menu_id =".$varCode." ";
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
				$menu_name_vc = $rec['menu_name_vc'];
				$page_title_vc = $rec['page_title_vc'];
				$meta_keywords_vc = $rec['meta_keywords_vc'];
				$meta_description_vc = $rec['meta_description_vc'];
			}
		}
		$varMode="EA";
	}
	else
	{
		$menu_name_vc = $_POST['menu_name_vc'];
		$page_title_vc = $_POST['page_title_vc'];
		$meta_keywords_vc = $_POST['meta_keywords_vc'];
		$meta_description_vc = $_POST['meta_description_vc'];
	}

	//--------------MODE E-----------------------
	if ($_POST["txtMode"]=="EA")
	{
		{
			$sql_string = "UPDATE menu_m SET ";
			$sql_string.= " page_title_vc = '" .$page_title_vc ."'";
			$sql_string.= ",meta_keywords_vc = '" .$meta_keywords_vc ."'";
			$sql_string.= ",meta_description_vc = '" .$meta_description_vc ."'";
			
			$sql_string = $sql_string ." where menu_id =" . $varCode ;
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			
			$redirect="list_menu.php";
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
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
.style2 {color: #FFFFFF;
	font-weight: bold;
	font-size: 13px;
}
-->
</style>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
<!-- ImageReady Slices (01-modified.psd) -->
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" bgcolor="ffffff"><table width="971" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#FCFCFC" >
            <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
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
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td width="265" align="left" valign="top" style="background:url(images/login_btm_clr.gif) bottom left no-repeat #f6f6f6;">
				<?php include 'menu.php'?>				</td>
                <td width="15"></td>
                <td align="center" valign="top" style="border:1px solid #e4e1e1;"><table width="99%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" valign="top">  <form name="frm" method="post" action="menu_m.php" enctype="multipart/form-data">
				  <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
				  <input type="hidden" name="txtty" value="<?php echo $ty; ?>">
			<input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="5" class="text style2"></td>
                        </tr>
                        
                           <tr>
                          <td height="12"></td>
                        </tr>
                        <tr>
                          <td height="25" bgcolor="#FFFFFF" class="h1">Menu Master </td>
                        </tr> 
                        <tr>
                          <td height="12"></td>
                        </tr>
                        <tr>
                          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                              <td width="144" align="right" valign="middle" class="text"><strong>Menu Name </strong></td>
                              <td width="29" align="center" valign="middle"><strong>:</strong></td>
                              <td width="437" align="left" valign="middle" class="text"><strong><?php echo($menu_name_vc); ?></strong></td>
                            </tr>
                            <tr>
                              <td></td>
							  <td></td>
							  <td height="5"></td>
							  </tr>
                            <tr>
                              <td align="right" valign="middle" class="text">Page Title</td>
                              <td align="center" valign="middle"><strong>:</strong></td>
                              <td align="left" valign="middle">
                                <input name="page_title_vc" type="text" class="text" id="page_title_vc" value="<?php echo($page_title_vc); ?>" size="60">                              </td>
                            </tr>
                            <tr>
                              <td width="144" align="right" valign="middle" class="text"> Meta Keyword </td>
                              <td align="center" valign="middle"><strong>:</strong></td>
                              <td align="left" valign="middle"> <input name="meta_keywords_vc" type="text" class="text" id="meta_keywords_vc" value="<?php echo($meta_keywords_vc); ?>" size="60">   </td>
                            </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td height="5"></td>
                              </tr>
                              <tr>
                                <td align="right" valign="top" class="text">Meta Description</td>
                                <td align="center" valign="top"><strong>:</strong></td>
                                <td align="left" valign="middle"><textarea name="meta_description_vc" cols="50" rows="5" id="meta_description_vc"><?php echo($meta_description_vc); ?></textarea>                                </td>
                              </tr>
                            <tr>
                              <td></td>
							  <td></td>
							  <td height="5"></td>
							  </tr>
                                <tr>
                              <td height="27">&nbsp;</td>
                              <td>&nbsp; </td>
                              <td align="left" valign="top"><input type="submit" name="btnadd2" id="btnadd2" value="Submit" onClick="return doSubmit();" style="cursor:pointer;" /><input type="button" name="btncancel" id="btncancel" value="Cancel" style="cursor:pointer;" onClick="window.location='list_menu.php'" /></td>
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
    </table></td>
  </tr>
</table>
<tr>
    <td valign="top" bgcolor="#000000">&nbsp;</td>
  </tr>

</body>
</html>