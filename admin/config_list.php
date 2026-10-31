<?php
	
	session_start();
	require 'connection/conn.php';
	// require 'noentry.php';	
	// start //
	// to get code of this master .. //
	$sql_code_master = "select adm_mnu_id from admin_menu where mnu_name='Config Master'";
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

	
	 
	if (isset($_POST["txtMode"])=="D" || isset($_POST["txtMode"])=="PD")
	{
		 
		$chk = $_POST["txtMode"]=="PD"?implode(',',$_POST['chk']):"";
		$sql_cond = $_POST["txtMode"]=="D" ?"config_id = (" . $_POST["txtDCode"] . ")":"config_id in ($chk)";
		
		// check user for selected city
	
		$sql_string = "DELETE FROM  config_m   WHERE " .$sql_cond;
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		$_POST["txtMode"] = "";
		
		$msg="Record Deleted SuccessFully";
	}
	
	//---------------------RECORD QUERY------------------------------------
	
	/****Paging*********/
    $sql_string="select count(*) as totrec from config_m c";
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
  
 
	$sql_string = "SELECT c.* FROM config_m c order by c.config_id $limit"; 
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
	frm.submit();
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
.style7 {font-size: 14px; font-weight: bold; line-height: 150%; font-family: Helvetica, Arial, sans-serif;}
-->
</style>
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
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="text_bold_head">
                      <div align="left">
                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="h1">&nbsp;</td>
                            <td width="70%">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="h1">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="30%" class="h1" style="padding-left:25px; ">Admin Email Ids Config </td>
                            <td><div align="right" class="text"></div></td>
                          </tr>
                          <tr>
                            <td class="h1">&nbsp;</td>
                            <td><div align="right"><span class="text"><a href="home.php" class="link">Back</a> </span></div></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><form name="frm" method="Post" action="config_list.php">
                      <input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>"/>
                      <input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>"/>
                      <input type="hidden" name="txtDCode" value=""/>
                      <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr valign="top">
                          <td height="15" colspan="3">&nbsp;</td>
                        </tr>
                        <tr valign="top">
                          <td colspan="3"><table width="100%" border="1" bordercolordark="#FFFFFF" cellpadding="0"  cellspacing="0">
                              <tr valign="middle" bgcolor="#666666" class="news_text">
                                <td width="50%" class="text"><div align="center" class="news_text"><b>Config Name </b></div></td>
                                <td width="40%" class="text"><div align="center" class="news_text"><b>Config Value </b></div></td>
                                <td width="10%" height="30" class="text"><div align="center"></div></td>
                              </tr>
                              <?php
								while ($rec = mysqli_fetch_array($check_res))
								{
							   ?>
                              <tr valign="middle">
                                <td height="22" align="center" class="text"><?php echo($rec['config_name']); ?></td>
                                <td align="center" class="text"><?php echo($rec['config_value']); ?></td>
                                <td class="text" align="center"><?php if($flg_edit == "1"){ ?><a href="config_m.php?Code=<?php echo($rec['config_id']); ?>&Mode=E" class="sublink">Edit</a><?php } ?></td>
                              </tr>
                              <?php
								}
							   ?>
                          </table></td>
                        </tr>
                        <tr valign="top">
                          <td colspan="3">&nbsp;</td>
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
                    <td width="30%" class="text_bold_head">&nbsp;</td>
                    <td width="70%"><div align="right"> </div></td>
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