<?php
	
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	include "connection/conn.php";
	require "noentry.php";
	
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
			$sql_string = "DELETE FROM aboutus_m WHERE about_code  = ".$_POST["txtDCode"];
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			$_POST["txtMode"] = "";
		}
	}	
	
	$sql_string = "SELECT * FROM aboutus_m";
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
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
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="h1">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="25%" class="h1" style="padding-left:25px; ">Email Config</td>
                            <td><div align="right" class="text"></div></td>
                          </tr>
                          <tr>
                            <td class="h1">&nbsp;</td>
                            <td><div align="right"><span class="text"><a href="aboutus_m.php?Mode=A" class="text">Add</a> | <a href="home.php" class="link">Back</a> </span></div></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><form name="frm" method="Post" action="aboutus_list.php">
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
                                <td width="86%" height="30" bgcolor="#666666" class="text"><div align="center" class="news_text"><b>Title</b></div></td>
                                <td width="10%" height="30" class="text"><div align="center"></div></td>
                              </tr>
                              <?php
								while ($rec = mysqli_fetch_array($check_res))
								{
							   ?>
                              <tr valign="middle">
                                <td height="22" align="center" class="text"><?php echo($rec['about_title']); ?></td>
								<td class="text" align="center"><a href="aboutus_m.php?Code=<?php echo($rec['about_code']); ?>&Mode=E" class="sublink">E</a> | <a href="javascript:doDelete(<?php echo($rec['about_code']); ?>);" class="sublink">D</a></div></td>
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