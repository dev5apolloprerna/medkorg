<?php
	include "connection/conn.php";
	require "noentry.php";
	  // include "noentry.php";	
	  
	  // start //
	// to get code of this master .. //
	$sql_code_master = "select adm_mnu_id from admin_menu where mnu_name='Other Information'";
	$chk_code_master = mysqli_query($cn,$sql_code_master);
	$tmp_code_master = mysqli_fetch_array($chk_code_master);
  
	$adm_mnu_id = isset($tmp_code_master['adm_mnu_id']) ? $tmp_code_master['adm_mnu_id'] : "";
	
	$flg_edit = "";
	$flg_add = "";
	$flg_del = "";
	
	$pid = explode(",",$_SESSION["UserAdminPermissionsID"]);
	
	if(in_array("A_".$adm_mnu_id,$pid))
	{
		$flg_add = "1";
	}
	if(in_array("E_".$adm_mnu_id,$pid))
	{
		$flg_edit = "1";
	}
	if(in_array("D_".$adm_mnu_id,$pid))
	{
		$flg_del = "1";
	}
	//end//
	
	

	$sql_string = "select menu_id, menu_name_vc, menu_type_vc from menu_m order by menu_id";
				
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
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
.style7 {color: #FF0000}
-->
</style>
</head>
<body>
<!-- ImageReady Slices (01-modified.psd) -->
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><table width="971" border="0" align="center" cellpadding="0" cellspacing="0">
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
                <td bgcolor="#FFFFFF"></td>
                <td></td>
              </tr>
              <tr>
                <td width="265" align="left" valign="top" style="background:url(images/login_btm_clr.gif) bottom left no-repeat #f6f6f6;">
				<?php include 'menu.php'?>				</td>
                <td width="15"></td>
                <td align="center" valign="top" bgcolor="#FFFFFF" style="border:1px solid #e4e1e1;"><table width="99%" border="0" cellspacing="0" cellpadding="0">
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
                              <td align="right" valign="middle" class="pagehead"><a href="prodCat_m.php?Mode=A"><!--Add</a> | --><a href="home.php">Back</a>&nbsp;</td>
                            </tr>
                          </table>						  </td>
                        </tr>
                        <tr>
                          <td height="25" bgcolor="#FFFFFF" class="style6">Menu List </td>
                        </tr>
                        <tr>
                          <td height="5"></td>
                        </tr>
                        <tr>
                          <td><form name="frm" method="Post" action="list_menu.php">
                    <input type="hidden" name="txtMode" id="txtMode" value="<?php echo $vartxtMode; ?>"/>
                    <input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>"/>
                    <input type="hidden" name="txtDCode" value=""/>
                              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table align="left" border="1" bordercolor="#c0c0c0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;"  width="100%">
                                      <tr valign="middle" bgcolor="#FBFBFB">
                                        <td width="41%" height="25" class="pagetitle" style="padding-left:10px;">Menu Name </td>
                                        <td width="40%" height="25" class="pagetitle" style="padding-left:10px;">Type</td>
                                        <td width="12%" class="head">&nbsp;</td>
                                        <td width="12%" class="head">&nbsp;</td>
                                      <?php
							while ($rec = mysqli_fetch_array($check_res))
							{
               
						?>
                                      <tr valign="middle">
                                        <td height="40" class="data" ><div align="left" style="padding-left:10px;"><?php echo($rec['menu_name_vc']); ?></div></td>
                                        <td height="40" class="data" ><div align="left" style="padding-left:10px;"><?php echo($rec['menu_type_vc']); ?></div></td>
                                        <td width="12%" class="text" style="wordWrap:break-word;width=125px;left:0">
										                    <table width="58%" height="23"  border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td width="50%"><div align="center"><?php if($flg_edit == "1"){ ?><a href="menu_m.php?Code=<?php echo($rec['menu_id']); ?>&Mode=E"><img src="images/icon-edit.gif" width="20" height="22" border="0" /></a><?php } ?></div></td>
                                            </tr>
                                        </table>										</td>
                                        <td width="12%" height="40" class="text" style="wordWrap:break-word;width=125px;left:0">
										<?php 
											if ($rec['menu_type_vc']!="SITEHOME") 
											{
										?>
											<a href="list_post.php?ty=<?php echo($rec['menu_name_vc']); ?>" class="morelink">Posts</a>
										<?php 
											}
										?>										</td>
                                      </tr>
                                      <?php
				}
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
    </table>
 <tr>
    <td valign="top" bgcolor="#000000">&nbsp;</td>
  </tr>
</table>
</body>
</html>