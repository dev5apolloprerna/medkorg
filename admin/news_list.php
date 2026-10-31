<?php
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	$err=""; 
   $ProdThumbImgDir = "images/gallery/news/";
	
	include "connection/conn.php";
	// require "noentry.php";
	//   include "noentry.php";	
	
		
	$varFieldtag = "";
	if (isset($_POST["selfilter"]) <> "")
	{
		$varFieldTag = $_POST["selfilter"];
	}
	
	$varFieldValue = "";
	if (isset($_POST["txtfiltername"]) <> "")
	{
		$varFieldValue = $_POST["txtfiltername"];
	}
	
	
	
	if ($_POST)
	{
		//---------------DELETE MODE-----------------------------
		
		if ($_POST["txtMode"]=="D")
		{
			$sql_string = "DELETE FROM news_offer WHERE Id = (" . $_POST["txtDCode"] . ")";
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			$_POST["txtMode"] = "";
		}
	}	
	
	// start //
	// to get code of this master .. //
	$sql_code_master = "select adm_mnu_id from admin_menu where mnu_name='News Master'";
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
	
	
	/****Paging*********/

	

   $sql_string="select count(*) as totrec from news_offer";
    
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
/********************************************************/	 
  
	
	$sql_string = "SELECT * FROM news_offer $limit";
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
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="text_bold_head">
                      <div align="left">
                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="25%" class="text_bold_head" style="padding-left:25px;"><span class="h3">News Master </span></td>
                            <td><div align="right"> </div></td>
                            </tr>
                          </table>
                        </div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><form name="frm" method="Post" action="news_list.php" enctype="multipart/form-data">
                      <input type="hidden" name="txtType" value="<?php echo $vartxtType; ?>"/>
                      <input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>"/>
                      <input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>"/>
                      <input type="hidden" name="txtDCode" value=""/>
                      <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr valign="top">
                          <td>&nbsp;</td>
                          <td class="text"><div align="right"><?php if($flg_add == "1"){ ?><a href="news_m.php?Type=<?php echo isset($vartxtType); ?>&Mode=A" class="link"><strong>Add</strong></a> |<?php } ?> <a href="home.php" class="link"><strong>Back</strong></a></div></td>
                          </tr>
                        <tr valign="top">
                          <td width="2%">&nbsp;</td>
                          <td>
                            <table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0"  cellspacing="0">
                              <tr valign="middle" bgcolor="#4C6B83">
                                <td width="209" height="25" bgcolor="#666666" class="text"><strong><font color="#FFFFFF">&nbsp;Description</font></strong></td>
                                <td width="95" bgcolor="#666666" class="text"><strong><font color="#FFFFFF">  Date</font></strong></td>
                                <td width="147" align="center" bgcolor="#666666" class="news_text"> <strong><span class="text"><font color="#FFFFFF"> Image</font></span></strong></td>
                                <td bgcolor="#666666" class="text">&nbsp;</td>
                                </tr>
                              <?php
					while ($rec = mysqli_fetch_array($check_res))
					{
				?>
                              <tr valign="middle">
                                <td height="110" valign="top" class="text" style="wordWrap:break-word; width=300px;left:0;padding-top:3px;padding-left:3px;">&nbsp;<?php echo($rec['Desc_vc']); ?>&nbsp;</td>
                                <td valign="top" class="text" style="wordWrap:break-word; width=300px;left:0;padding-top:3px;padding-left:3px;">&nbsp;<?php echo($rec['news_date']); ?>&nbsp;</td>
                                <td align="center" bordercolor="#c0c0c0" class="text" style="wordWrap:break-word;width=125px;left:0"><?php if($rec['thumb_image']!=""){  ?>
                                  <img src="<?php echo $ProdThumbImgDir.$rec['thumb_image']?>" width="100" height="100">
                                  <?php } ?>
                                  </td>
                                <td width="75" align="center" valign="top" class="text" style="padding-top:3px;"><p>&nbsp;</p>
                                  <table width="58%" height="23"  border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="50%"><div align="center"><?php if($flg_edit == "1"){ ?><a href="news_m.php?Type=<?php echo isset($vartxtType); ?>&Code=<?php echo($rec['Id']); ?>&Mode=E"><img src="images/icon-edit.gif" width="22" height="20" border="0" /></a><?php } ?></div></td>
                                      <!-- <td bgcolor="#868686" class="text"><div align="center"></div></td> -->
                                      <td width="50%"><div align="center"><?php if($flg_del == "1"){ ?><a href="javascript:doDelete(<?php echo($rec['Id']); ?>);" class="link_delete"><img src="images/icon-delete.gif" width="22" height="20" border="0" /></a><?php } ?></div></td>
                                    </tr>
                                  </table>
                                  <p>&nbsp;</p></td>
                                </tr>
                              <?php
						}
				?>
                              </table></td>
                          </tr>
                        <tr valign="top">
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          </tr>
                        </table>
                      </form></td>
                  </tr>
                </table></td>
              </tr>
              <tr valign="top">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              		 <tr>
                        <td valign="top">&nbsp;</td>
						<td colspan="2" align="right" valign="top" class="text">
						    <?php if($maxpage>1) { ?>
						<div class="next">
						<?php if($pageNum!=1) { ?>
						<a href="news_list.php?Type=<?php echo $vartxtType; ?>&pageid=<?php echo ($pageNum-1)?>">
						<?php } ?>
						<font color="#000000"><b>&lt;&lt;</b></font> Prev...<?php if($pageNum!=1) { ?></a><?php } ?> 
						<?php for($i=1;$i<=$maxpage;$i++) { ?>
						<a href="news_list.php?Type=<?php echo $vartxtType; ?>&pageid=<?php echo $i?>"><?php echo $i;?></a> |
						<?php } ?> 
						<?php if($pageNum!=$maxpage) { ?>
						<a href="news_list.php?Type=<?php echo $vartxtType; ?>&pageid=<?php echo ($pageNum+1)?>"><?php }?>
						....Next <font color="#000000"><b>&gt;&gt;</b></font>
						<?php if($pageNum!=$maxpage) { ?></a><?php } ?></div>
						<?php } ?></td>
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