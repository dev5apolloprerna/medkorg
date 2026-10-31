<?php
	include "connection/conn.php";
	// require "noentry.php";
	// include "noentry.php"; 
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	if ($_SESSION["UserAdminCode"] == "")
	{
		$redirect="index.php";
		header("Location: $redirect");
	}
	
	
	
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
		//-------------------COMA SEPRETOR--------------------
		
		/*$arr = $_POST["chk"];
			foreach($arr as $val)
			{
				if (isset($val))
				{
					if ($chkstr != "")
					 	$chkstr .= ",";
					$chkstr .= $val;
				}
			}*/
		//---------------DELETE MODE-----------------------------
		
		if ($_POST["txtMode"]=="D")
		{
			$sql_string = "DELETE FROM search_jobs WHERE req_no = (" . $_POST["txtDCode"] . ")";
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			$_POST["txtMode"] = "";
		}
	}	
	
	$sql_string = "SELECT *,ind_value FROM search_jobs, industry_m where login_id=" . $txtDCode ." and search_jobs.industry_vc = industry_m.ind_id";
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	$row_cnt = mysqli_num_rows($check_res);
?>
<html>
<head>
<title>Administration Panel</title>
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
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
       <td valign="top" bgcolor="#FFFFFF" > <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
        Administration Panel<br>
        <br>
            </font></span></p>
        </blockquote> </td>
      </tr>
      <tr>
        <td valign="top" background="images/link-bg.gif"><img src="images/link-bg.gif" width="5" height="2"></td>
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
                <td width="25%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
                <td>&nbsp;</td>
                <td width="85%" rowspan="3"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="h3" style="padding-left:25px;">Job List</td>
                  </tr>
                  <tr>
                    <td>
                      <form name="frm" method="Post" action="job_list.php">
                        <input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>"/>
                        <input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>"/>
                        <input type="hidden" name="txtDCode" value=""/>
                        <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr valign="top">
                            <td>&nbsp;</td>
                            <td class="text"><div align="right"><a href="post_job.php?Mode=A" class="link">Add</a> | <a href="home.php" class="link">Back</a></div></td>
                            </tr>
                          <tr valign="top">
                            <td width="2%">&nbsp;</td>
                            <td><table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0"  cellspacing="0">
                              <tr valign="middle" bgcolor="#4C6B83">
                                <td width="3%" height="22" bgcolor="#161709" class="textmenuhead">&nbsp;</td>
                                <td width="18%" bgcolor="#161709" class="text"><font color="#FFFFFF"><b>Company Name</b></font></td>
                                <td width="24%" bgcolor="#161709" class="text"><font color="#FFFFFF"><b>Industry</b></font></td>
                                <td width="17%" bgcolor="#161709" class="text"><font color="#FFFFFF"><b>Designation</b></font></td>
                                <td width="14%" bgcolor="#161709" class="text"><font color="#FFFFFF"><b>Experience</b></font></td>
                                <td width="19%" bgcolor="#161709" class="text"><font color="#FFFFFF"><b>Location</b></font></td>
                                <td width="5%" bgcolor="#161709" class="text">&nbsp;</td>
                                </tr>
                              <?php
										while ($rec = mysqli_fetch_array($check_res))
										{
									?>
                              <tr valign="middle">
                                <td height="22"><input type="checkbox" name="chk" value="<?php echo($rec['req_no']); ?>"></td>
                                <td class="text" style="wordWrap:break-word; width=150px;left:0"><?php echo($rec['company_name']); ?>&nbsp;</td>
                                <td class="text"><?php echo($rec['ind_value']); ?>&nbsp;</td>
                                <td class="text"><?php echo($rec['designation_vc']); ?>&nbsp;</td>
                                <td class="text"><?php echo($rec['exper_min']); ?>-<?php echo($rec['exper_max']); ?>&nbsp;</td>
                                <td class="text"><?php echo($rec['location_vc']); ?>&nbsp;</td>
                                <td class="text"><a href="post_job.php?Code=<?php echo($rec['req_no']); ?>&Mode=E" class="sublink">E</a> | <a href="javascript:doDelete(<?php echo($rec['req_no']); ?>);" class="sublink">D</a></td>
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
                        </form>
                      </td>
                  </tr>
                </table></td>
              </tr>
              <tr valign="top">
                <td>&nbsp;</td>
                </tr>
              <tr valign="top">
                <td width="1%">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="36" valign="top" background="images/footer_bg.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="8" valign="top">
</td>
      </tr>
      <tr>
        <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr valign="top">
            <td class="footertext">&nbsp;</td>
            <td class="footertext"><div align="right"></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="5" valign="top"></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>