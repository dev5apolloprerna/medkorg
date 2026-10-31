<?php
	require 'noentry.php' ;
	include "connection/conn.php";
	// require "noentry.php";
	if ($_GET["ty"]!="")
	{
		$ty = $_GET["ty"];
	}

	if ($_POST)
	{
		if ($_POST["txtMode"]=="D")
		{
			if($err=="")
			{	
				$sql_string = "DELETE FROM post_m WHERE post_id = (" . $_POST["txtDCode"] . ")";
				$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
				$_POST["txtMode"] = "";
				
				$msg="Record Deleted SuccessFully";
			}
		}
	}

	 $sql_string = "select post_id,post_category_id, post_title_vc, post_shortdesc_vc from post_m where post_menu_vc='" . $ty ."'";
				
	$check_res = mysqli_query($cn,$sql_string);
	$row_cnt = mysqli_num_rows($check_res);
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
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="javascript" src="js/jvalid.js"></script>
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
.style8 {color: #FFFFFF}
-->
</style>
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
                    <td align="center" valign="top"> 
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="5" class="text style2"></td>
                        </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td align="left" valign="middle" class="text">&nbsp;</td>
                              <td align="left" valign="middle">&nbsp;</td>
                              <td align="right" valign="middle" class="pagehead"><span class="text"><a href="post_m.php?Mode=A&ty=<?php echo($ty); ?>">Add</a> | <a href="list_menu.php">Back</a></span>&nbsp;</td>
                            </tr>
                          </table>						  </td>
                        </tr>
                        <tr>
                          <td height="25" bgcolor="#FFFFFF" class="h1">Posts</td>
                        </tr>
                        <tr>
                          <td height="5"></td>
                        </tr>
                        <tr>
                          <td><form name="frm" method="Post" action="list_post.php?ty=<?php echo($ty); ?>">
							<input type="hidden" name="txtMode" id="txtMode" value="<?php echo isset($vartxtMode) ? $vartxtMode :""; ?>"/>
							<input type="hidden" name="txtCode" value="<?php echo isset($vartxtCode) ?$vartxtCode :""; ?>"/>
							<input type="hidden" name="txtDCode" value=""/>
                              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table align="left" border="1" bordercolor="#c0c0c0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;"  width="100%">
                                      <tr valign="middle" bgcolor="#FBFBFB">
                                        <td width="50%" height="25" bgcolor="#666666" class="pagetitle style8" style="padding-left:10px;">Post Title </td>
                                        <td width="40%" bgcolor="#666666" class="pagetitle style8" style="padding-left:10px;">Category</td>
                                        <td width="10%" bgcolor="#FBFBFB" class="head">&nbsp;</td>
                                      <?php
							while ($rec = mysqli_fetch_array($check_res))
							{
								$post_category_id=$rec['post_category_id'];
								
								$query="select post_title_vc from post_m where post_id='$post_category_id'";
								$category=mysqli_query($cn,$query);
								$category_data=mysqli_fetch_assoc($category);
								if($rec['post_title_vc']=='Root')
								{					
									 echo($rec['post_title_vc']="");		
									 echo($category_data['post_title_vc']="");	
						
								}
								else
								{
								?>
                                      <tr valign="middle">
                                        <td height="40" class="data" ><div align="left" style="padding-left:10px;"><?php echo($rec['post_title_vc']); ?></div></td>
                                        <td class="data" ><div align="left" style="padding-left:10px;"><?php echo isset($category_data['post_title_vc']) ? $category_data['post_title_vc'] : ""; ?></div></td>
                                        <td width="12%" height="40" class="text" style="wordWrap:break-word;width=125px;left:0">
										<table width="58%" height="23"  border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td width="50%"><div align="center"><a href="post_m.php?Code=<?php echo($rec['post_id']); ?>&Mode=E&ty=<?php  echo($ty); ?>"><img src="images/icon-edit.gif" width="20" height="22" border="0" /></a></div></td>
                                              <td bgcolor="#868686" class="text"><div align="center"></div></td>
                                              <td width="50%"><div align="center"><a href="javascript:doDelete(<?php echo($rec['post_id']); ?>);" class="link_delete"><img src="images/icon-delete.gif" width="20" height="22" border="0" /></a></div></td>
                                            </tr>
                                        </table>										</td>
                                      </tr>
                                      <?php
							}}
				?>
                                  </table></td>
                                </tr>
                            </table>
							 </form></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                         
                        <tr>
                          <td height="12"></td>
                        </tr>
                        
                      </table>                   </td>
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
                <td height="5"></td>
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
    </table>
</td>
</table>



<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#000000">
    <td valign="top">&nbsp;</td>
  </tr>
</table>


</body>
</html>