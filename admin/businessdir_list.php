<?php
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	include "connection/conn.php";
	require "noentry.php";
	  include "noentry.php";	
	
		
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
	
	if ($_POST["txtType"]=="")
	{
		$vartxtType = $_GET['Type'];
	}
	else
	{
		$vartxtType = $_POST['txtType'];
	}
	
	if ($_POST)
	{
		//---------------DELETE MODE-----------------------------
		
		if ($_POST["txtMode"]=="D")
		{
			$sql_string = "DELETE FROM businessdir_m WHERE business_id = (" . $_POST["txtDCode"] . ")";
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			$_POST["txtMode"] = "";
		}
	}	
	
	
	
	/****Paging*********/

	

   $sql_string="select count(*) as totrec from businessdir_m";
    
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
  
	
	$sql_string = "SELECT * FROM businessdir_m b left outer join products_cat p on b.cat_id=p.cat_id $limit";
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
.style5 {color: #063968; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
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
                            <td class="h1">&nbsp;</td>
                            <td width="66%">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="h1">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="34%" class="h1" style="padding-left:25px;">Business Directory  List </td>
                            <td><div align="right"> </div></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><div align="left"></div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><form name="frm" method="Post" action="businessdir_list.php">
                        <input type="hidden" name="txtType" value="<?php echo $vartxtType; ?>"/>
                        <input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>"/>
                        <input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>"/>
                        <input type="hidden" name="txtDCode" value=""/>
                        <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr valign="top">
                            <td>&nbsp;</td>
                            <td class="text"><div align="right"><a href="businessdir_m.php?Mode=A" class="link">Add</a> | <a href="home.php" class="link">Back</a></div></td>
                          </tr>
                          <tr valign="top">
                            <td width="2%">&nbsp;</td>
                            <td>
                              <table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0"  cellspacing="0">
                                <tr valign="middle" bgcolor="#4C6B83">
                                  <td width="3%" height="22" bgcolor="#161709" class="textmenuhead">&nbsp;</td>
                                  <td width="14%" bgcolor="#161709" class="text"><font color="#FFFFFF"><b>&nbsp;Business Name</b></font></td>
                                  <td width="23%" bgcolor="#161709" class="text"><font color="#FFFFFF"><b>&nbsp;Contact Name</b></font></td>
								  <td width="25%" bgcolor="#161709" class="text"><font color="#FFFFFF"><b>&nbsp;Group Name</b></font></td>
								   <td width="24%" bgcolor="#161709" class="text"><font color="#FFFFFF"><b>&nbsp;Mobile Number</b></font></td>
                                  <td width="11%" bgcolor="#161709" class="text">&nbsp;</td>
                                </tr>
                                <?php
					while ($rec = mysqli_fetch_array($check_res))
					{
				?>
                                <tr valign="middle">
                                  <td height="22" valign="top" style="padding-top:3px;"><input type="checkbox" name="chk" value="<?php echo($rec['business_id']); ?>"></td>
                                  <td valign="top" class="text" style="wordWrap:break-word; width=300px;left:0">&nbsp;<?php echo($rec['business_name']); ?>&nbsp;</td>
                                  <td valign="top" class="text" style="wordWrap:break-word; width=300px;left:0">&nbsp;<?php echo($rec['contact_name']); ?>&nbsp;</td>
								   <td valign="top" class="text" style="wordWrap:break-word; width=300px;left:0">&nbsp;<?php echo($rec['cat_name']); ?>&nbsp;</td>
								    <td valign="top" class="text" style="wordWrap:break-word; width=300px;left:0">&nbsp;<?php echo($rec['mobile_1']); ?>&nbsp;</td>
                                  <td align="center" class="text" valign="top" style="padding-top:3px;"><a href="businessdir_m.php?Type=<?php echo($vartxtType); ?>&Code=<?php echo($rec['business_id']); ?>&Mode=E" class="sublink">E</a> | <a href="javascript:doDelete(<?php echo($rec['business_id']); ?>);" class="sublink">D</a></td>
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
						<a href="businessdir_list.php?Type=<?php echo $vartxtType; ?>&pageid=<?php echo ($pageNum-1)?>">
						<?php } ?>
						<font color="#000000"><b>&lt;&lt;</b></font> Prev...<?php if($pageNum!=1) { ?></a><?php } ?> 
						<?php for($i=1;$i<=$maxpage;$i++) { ?>
						<a href="businessdir_list.php?Type=<?php echo $vartxtType; ?>&pageid=<?php echo $i?>"><?php echo $i;?></a> |
						<?php } ?> 
						<?php if($pageNum!=$maxpage) { ?>
						<a href="businessdir_list.php?Type=<?php echo $vartxtType; ?>&pageid=<?php echo ($pageNum+1)?>"><?php }?>
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