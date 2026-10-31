<?php
	
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	if ($_SESSION["UserAdminCode"] == "")
	{
		$redirect="index.php";
		header("Location: $redirect");
	}
	
	
	include "connection/cn.php";
//$cn = getConnection("localhost","career_career","!@#$%@@","career_searchjobs");
	//$cn = getConnection("localhost","root","","samaj");	
	$varFieldtag = "";
	if ($_POST["selfilter"] <> "")
	{
		$varFieldTag = $_POST["selfilter"];
	}
	
	$varFieldValue = "";
	if ($_POST["txtfiltername"] <> "")
	{
		$varFieldValue = $_POST["txtfiltername"];
	}
	
	if ($_POST)
	{
		//---------------DELETE MODE-----------------------------
		
		if ($_POST["txtMode"]=="D")
		{
			$sql_string = "DELETE FROM page_m WHERE page_id_int = (" . $_POST["txtDCode"] . ")";
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			$_POST["txtMode"] = "";
		}
	}	
	
	$sql_string = "SELECT * FROM page_m";
	
	if ($varFieldTag <> "" )
		{
		if ($varFieldTag = "page")
		{
			$sql_string = $sql_string ." where page_name_vc LIKE '" . $varFieldValue . "%'";
		}
	}
	
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
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF" >
      <blockquote>
        <p><span class="style6"><font size="+2" class="style6"><br>
          Administration Panel<br>
          <br>
        </font></span></p>
    </blockquote></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                      <td width="23%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
                      <td align="center"><table width="99%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center" valign="top">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="100%" height="25" class="text style2">
                                    <form method="get" name="frmsearch">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="20" class="h1">&nbsp;</td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td height="20" class="h1">&nbsp;</td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td height="20" class="h1">&nbsp;</td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td width="110" height="20" class="h1"><div align="center"><span class="h1">Page List </span></div></td>
                                          <td width="158"></td>
                                          <td width="150"></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td align="left" valign="middle" class="text">&nbsp;</td>
                                          <td align="left" valign="middle">&nbsp;</td>
                                          <td align="right" valign="middle" class="text"><a href="page_m.php?Mode=A">Add</a> | <a href="javascript:history.back();">Back</a>&nbsp;</td>
                                        </tr>
                                      </table>
                                  </form></td>
                                </tr>
                                <tr>
                                  <td><form name="frm" method="Post" action="page_list.php">
                                      <input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>"/>
                                      <input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>"/>
                                      <input type="hidden" name="txtDCode" value=""/>
                                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><table align="left" border="1" bordercolor="#c0c0c0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;"  width="100%">
                                              <tr valign="middle" bgcolor="#FBFBFB">
                                                <td width="84%" height="25" bgcolor="#161709" class="pagetitle"><font color="#FFFFFF" class="style2"><b>Page Name</b></font></td>
                                                <td width="16%" class="head" bgcolor="#161709">&nbsp;</td>
                                                <?php
													while ($rec = mysqli_fetch_array($check_res))
													{
												?>
                                              <tr valign="middle">
                                                <td class="data" ><div align="left"><span class="text"><?php echo($rec['page_name_vc']); ?></span></div></td>
                                                <td width="16%" height="40" class="text" style="wordWrap:break-word;width=125px;left:0"><table width="58%" height="23"  border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                      <td width="50%"><div align="center"><a href="page_m.php?Code=<?php echo($rec['page_id_int']); ?>&Mode=E"><img src="images/icon-edit.gif" width="20" height="22" border="0" /></a></div></td>
                                                      <td bgcolor="#868686" class="text"><div align="center"></div></td>
                                                      <td width="50%"><div align="center"><a href="javascript:doDelete(<?php echo($rec['page_id_int']); ?>);" class="link_delete"><img src="images/icon-delete.gif" width="20" height="22" border="0" /></a></div></td>
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
                                  <td align="right" valign="top" class="text">
                                    <?php if($maxpage>1) { ?>
                                    <div class="next">
                                      <?php if($pageNum!=1) { ?>
                                      <a href="page_list.php?<?php if($search_value!="") echo 'search_value='.$search_value.'&'?>pageid=<?php echo ($pageNum-1)?>">
                                      <?php } ?>
                                      <font color="#000000"><b>&lt;&lt;</b></font> Prev...
                                      <?php if($pageNum!=1) { ?>
                                      </a>
                                      <?php } ?>
                                      <?php for($i=1;$i<=$maxpage;$i++) { ?>
                                      <a href="page_list.php?<?php if($search_value!="") echo 'search_value='.$search_value.'&'?>pageid=<?php echo $i?>"><?php echo $i;?></a> |
                                      <?php } ?>
                                      <?php if($pageNum!=$maxpage) { ?>
                                      <a href="page_list.php?<?php if($search_value!="") echo 'search_value='.$search_value.'&'?>pageid=<?php echo ($pageNum+1)?>">
                                      <?php }?>
                                      ....Next <font color="#000000"><b>&gt;&gt;</b></font>
                                      <?php if($pageNum!=$maxpage) { ?>
                                      </a>
                                      <?php } ?>
                                    </div>
                                    <?php } ?></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td height="12"></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td width="77%">&nbsp;</td>
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