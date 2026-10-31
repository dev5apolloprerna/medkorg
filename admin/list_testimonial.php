<?php require_once 'testimonial_field.php'; 

	  // start //
	// to get code of this master .. //
	$sql_code_master = "select adm_mnu_id from admin_menu where mnu_name='Testimonial Master'";
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
	frm.submit();
}
//-->
</script>
<style type="text/css"><link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #666666;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
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
  <tr><tr>
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
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5" colspan="2" class="text style2"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="2" class="text style2">
                      <form method="get" name="frmsearch">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="8"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td align="right" valign="middle" class="pagehead"><?php if($flg_add == "1"){ ?><a href="testimonial_m.php?Mode=A">Add</a> |<?php } ?> <a href="javascript:history.back();">Back</a>&nbsp;</td>
                          </tr>
                        </table>
                    </form></td>
                  </tr>
                  <tr>
                    <td width="16%" class="text_bold_head">Testimonial List </td>
                    <td width="84%"><div align="right"> </div></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <form name="frm" method="post" >
                        <input type="hidden" name="txtMode" id="txtMode" value="">
                        <input type="hidden" name="txtDCode" id="txtDCode" value="">
                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table align="left" border="1" bordercolor="#c0c0c0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;"  width="100%">
                                <tr valign="middle" bgcolor="#FBFBFB">
                                  <td width="200" height="25" class="pagetitle" bgcolor="#161709">&nbsp;<font color="#FFFFFF">Testimonial Name</font></td>
                                  <td width="107" class="pagetitle" bgcolor="#161709"> <font color="#FFFFFF">Description</font> </td>
                                  <td width="107" class="pagetitle" bgcolor="#161709"> <font color="#FFFFFF">Thumb Image </font></td>
                                  <td width="107" class="pagetitle" bgcolor="#161709">&nbsp;</td>
                                </tr>
                                <?php
				   if($numtestimonial>0) {
							foreach($testimonial_info as $rec)
							{
						?>
                                <tr valign="middle">
                                  <td height="40" class="data" ><div align="left"><b><?php echo($rec['testimonial_name']); ?></b><br>
                                  </div></td>
                                  <td class="text" style="wordWrap:break-word;width=125px;left:0"><?php echo($rec['testimonial_desc']); ?></td>
                                  <td height="40" class="text" style="wordWrap:break-word;width=125px;left:0"><?php if($rec['thumb_image']!=""){  ?>
                                      <img src="<?php echo $ProdThumbImgDir.$rec['thumb_image']?>" width="100" height="100">
                                      <?php } ?>
                                  </td>
                                  <td height="40" class="text" style="wordWrap:break-word;width=125px;left:0"><table width="58%" height="23"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="50%"><div align="center"><?php if($flg_edit == "1"){ ?><a href="testimonial_m.php?Code=<?php echo($rec['testimonial_id']); ?>&Mode=E"><img src="images/icon-edit.gif" width="22" height="20" border="0" style="margin-left:3px;"></a><?php } ?></div></td>
                                        <!-- <td bgcolor="#868686" class="text"><div align="center"></div></td> -->
                                        <td width="50%"><div align="center"><?php if($flg_del == "1"){ ?><a href="javascript:doDelete(<?php echo($rec['testimonial_id']); ?>);"><img src="images/icon-delete.gif" width="22" height="20" border="0" style="margin-left:3px;"></a><?php } ?></div></td>
                                        <td width="50%" class="text"><div align="center"></div></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <?php
				} }
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
                        <a href="list_testimonial.php?<?php if($search_value!="") echo 'search_field='.$search_field.'&search_value='.$search_value.'&'?>pageid=<?php echo ($pageNum-1)?>">
                        <?php } ?>
                        <font color="#000000"><b>&lt;&lt;</b></font> Prev...
                        <?php if($pageNum!=1) { ?>
                        </a>
                        <?php } ?>
                        <?php for($i=1;$i<=$maxpage;$i++) { ?>
                        <a href="list_testimonial.php?<?php if($search_value!="") echo 'search_field='.$search_field.'&search_value='.$search_value.'&'?>pageid=<?php echo $i?>"><?php echo $i;?></a> |
                        <?php } ?>
                        <?php if($pageNum!=$maxpage) { ?>
                        <a href="list_testimonial.php?<?php if($search_value!="") echo 'search_field='.$search_field.'&search_value='.$search_value.'&'?>pageid=<?php echo ($pageNum+1)?>">
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