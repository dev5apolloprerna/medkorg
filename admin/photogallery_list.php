<?php
	//session_start();
	include "connection/conn.php";
	require "noentry.php";
	//include "noentry.php";	
	$ProdThumbImgDir = "images/gallery/thumb/";
	$ProdLargeImgDir = "images/gallery/large/";
	$err="";
	$msg=""; 
	if ($_POST)
	{
		if ($_POST["txtMode"]=="D")
		{
			 
			if($err=="")
			{	
				  $sql="select thumb_image,large_image from photo_gallary WHERE photo_id = (" . $_POST["txtDCode"] . ")";
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
					
					$sql_string = "DELETE FROM photo_gallary WHERE photo_id = (" . $_POST["txtDCode"] . ")";
					$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
					$_POST["txtMode"] = "";
					
					$msg="Record Deleted SuccessFully";
				 
			}
			
		}
		 
	}
	// start //
	// to get code of this master .. //
	$sql_code_master = "select adm_mnu_id from admin_menu where mnu_name='Photogallery Master'";
	$chk_code_master = mysqli_query($cn,$sql_code_master);
	$tmp_code_master = mysqli_fetch_array($chk_code_master);
	$adm_mnu_id = $tmp_code_master['adm_mnu_id'];
	
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
	
		
	//---------------------RECORD QUERY------------------------------------
	
	 
	
	 $sql_string="SELECT count(*) as totrec FROM photo_gallary";
	$result=mysqli_query($cn,$sql_string);
	$tmp=mysqli_fetch_assoc($result);
	  $totrecord=$tmp['totrec'];
	$recperpage=10;
	  $maxpage=(int)($totrecord/$recperpage);
 
	$rem=$totrecord%$recperpage;
	if($rem>0)
		$maxpage++;
	
	$pageNum=1;
	 
	if(isset($_GET['pageid']))
		$pageNum=$_GET['pageid'];	
	 
	 $offset = ($pageNum - 1) * $recperpage;
	$limit="LIMIT $offset,$recperpage";
	
	
	
	$sql_string = "SELECT c.cat_id,c.photo_id, c.large_image,c.image_title FROM photo_gallary c";
	$sql_string = $sql_string ." order by photo_id $limit ";
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	$row_cnt = mysqli_num_rows($check_res);
?>
<html>
<head>
<title>Samaj</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function checkall()
{
	var iCnt= frm.elements.length;
	
	for (var i=0;i<iCnt;i++)
	{
		frm.elements[i].checked=frm.chkselectall.checked;
	}
}
function IsChecked()
{
	iCnt= frm.elements.length;
	var cnt;
	cnt=0;
	for (var i=0;i<iCnt;i++)
	{
		if (frm.elements[i].checked)
		{
			cnt++;
			if (cnt>=2)
			  break;
		}
	}
	if (i<iCnt)
		return cnt;
	else
	{
		if (cnt>0)
			return cnt;
		else
			return -1;
	}
}
function doEdit()
{
	var i = IsChecked();
	if (i == -1)
	{
		alert("Please select the record to be modified");
	}
	else if(i >1) 
	{
		alert("you cannot select more than one record to modify.");
		frm.chkselectall.checked = false;
		checkall();
	}
	else
	{
		frm.txtMode.value="E";
		frm.submit();
	}
}
function doDelete(DCode)
{
	var blnConfirm = confirm("Do you want to delete?");
	if (blnConfirm)
	{
		frm.txtMode.value="D";
		frm.txtDCode.value=DCode;
		frm.submit();
	}
	else
	{
		frm.txtMode.value="X";
	}
}
function doFilter()
{
	frmsearch.submit();
}
//-->
</script>
<style type="text/css"><link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style5 {color: #063968; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
.style2 {color: #FFFFFF;
	font-weight: bold;
	font-size: 13px;
}
-->
</style></style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr>
       <td valign="top" bgcolor="#FFFFFF" > <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
        Administration Panel<br>
        <br>
            </font></span></p>
        </blockquote> </td>
      </tr>
      <tr>
        <td height="6" valign="top"></td>
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
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5" colspan="2" class="text style2"></td>
                  </tr>
                  <tr>
                    <td width="25%" class="h3"> Photogallery List </td>
                    <td width="75%"><div align="right"><span class="text"><?php if($flg_add == "1"){ ?><a href="photogallery_m.php?Mode=A"><strong>Add</strong></a><strong> |<?php } ?> <a href="javascript:history.back();">Back</a>&nbsp;</strong></span> </div></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="2"><form name="frm" method="Post" action="photogallery_list.php">
                        <input type="hidden" name="txtMode" id="txtMode" value="<?php echo $vartxtMode; ?>"/>
                        <input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>"/>
                        <input type="hidden" name="txtDCode" value=""/>
                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table align="left" border="1" bordercolor="#c0c0c0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;"  width="100%">
                                <tr valign="middle" bgcolor="#FBFBFB">
                                  <td width="70%" height="25" bgcolor="#666666" class="text" style="padding-left:08px;"><font color="#FFFFFF"><b>Title</b></font></td>
                                  <td width="22%" align="center" bgcolor="#666666" class="text" style="padding-left:08px;"><font color="#FFFFFF"><b>Photo</b></font></td>
                                  <td width="75" class="head" bgcolor="#666666">&nbsp;</td>
                                  <?php
							while ($rec = mysqli_fetch_array($check_res))
							{
						 ?>
                                <tr valign="middle" class="text">
                                  <td valign="top" class="text" style="padding-left:08px;padding-top:5px;"><div align="left" class="text"><?php echo $rec['image_title']?></div></td>
                                  <td height="100" align="center" class="data" style="padding-left:08px;" ><img src="<?php echo $ProdLargeImgDir.$rec['large_image']?>" width="110" height="80"></td>
                                  <td width="75" height="40" class="text" style="wordWrap:break-word;width=125px;left:0"><table width="58%" height="23"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="50%"><div align="center"><?php if($flg_edit == "1"){ ?><a href="photogallery_m.php?Code=<?php echo($rec['photo_id']); ?>&Mode=E"><img src="images/icon-edit.gif" width="22" height="20" border="0" /></a><?php } ?></div></td>
                                       <!--  <td bgcolor="#868686" class="text"><div align="center"></div></td> -->
                                        <td width="50%"><div align="center"><?php if($flg_del == "1"){ ?><a href="javascript:doDelete(<?php echo($rec['photo_id']); ?>);" class="link_delete"><img src="images/icon-delete.gif" width="22" height="20" border="0" /></a><?php } ?></div></td>
                                      </tr>
                                  </table></td>
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
                    <td colspan="2" align="right" valign="top" class="text">
                      <?php if($maxpage>1) { ?>
                      <div class="next">
                        <?php if($pageNum!=1) { ?>
                        <a href="photogallery_list.php?pageid=<?php echo ($pageNum-1)?>">
                        <?php } ?>
                        <font color="#000000"><b>&lt;&lt;</b></font> Prev...
                        <?php if($pageNum!=1) { ?>
                        </a>
                        <?php } ?>
                        <?php for($i=1;$i<=$maxpage;$i++) { ?>
                        <a href="photogallery_list.php?pageid=<?php echo $i?>"><?php echo $i;?></a> |
                        <?php } ?>
                        <?php if($pageNum!=$maxpage) { ?>
                        <a href="photogallery_list.php?pageid=<?php echo ($pageNum+1)?>">
                        <?php }?>
        ....Next <font color="#000000"><b>&gt;&gt;</b></font>
        <?php if($pageNum!=$maxpage) { ?>
                        </a>
                        <?php } ?>
                      </div>
                      <?php } ?></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="12" colspan="2"></td>
                  </tr>
                </table></td>
                </tr>
              <tr valign="top">
                <td>&nbsp;</td>
                </tr>
              		 <tr>
                        <td valign="top">&nbsp;</td>
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