<?php

	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	$err=""; 
	$ProdThumbImgDir = "images/gallery/news/";
	
	include "connection/conn.php";
	// require "noentry.php";
	//   include "noentry.php";	
	
	if (isset($_POST["txtMode"])=="")
	{
		$varMode = $_GET['Mode'];
	}
	else
	{
		$varMode = $_POST['txtMode'];
	}
	
	if (isset($_POST["txtCode"])=="")
	{
		$varCode = isset($_GET['Code']) ? $_GET['Code'] :"";
	}
	else
	{
		$varCode = $_POST['txtCode'];
	}

	if (isset($_POST["txtType"])=="")
	{
		$vartxtType = $_GET['Type'];
	}
	else
	{
		$vartxtType = $_POST['txtType'];
	}

 //  get  News category data //
 $sqlcategory= "select * from products_cat where cat_type='FAQ'";
 $check_category=mysqli_query($cn,$sqlcategory);
 $numcategory=mysqli_num_rows($check_category);


if($numcategory>0) 
{
	$category_info=array();
	while($row=mysqli_fetch_assoc($check_category))
	{
 		$f['cat_id']=stripslashes($row['cat_id']);
		$f['cat_name']=stripslashes($row['cat_name']);
		$category_info[]=$f;
	}
 
}
	
	
	
//---------------QueryString-------------------
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM faq_m where Id=". $varCode;
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	if (mysqli_num_rows($check_res)<1)
	{
		echo("No rows in the database to display");
		exit;
	}
	else
	{
		while ($rec = mysqli_fetch_array($check_res))
		{
			$vartxtcat = $rec['cat_id'];
			$vartxtHead = $rec['Heading'];
			$vartxtDesc = $rec['Desc_vc'];
		}
	}
}
else
{
	$vartxtcat = isset($_POST['cat_name']) ? $_POST['cat_name']:"";
	$vartxtHead = isset($_POST["txtHead"]) ? $_POST['txtHead']:"";
	$vartxtDesc = isset($_POST["txtDesc"]) ? $_POST['txtDesc']:"";
}
//-------------MODE A------------------------
if ($_POST)
{
	if ($_POST["txtMode"]=="A")
	{	
		$varCode = GetMaxNumber("faq_m","Id",$cn);
		
		 $sql_string = "INSERT INTO faq_m(Id,cat_id,Heading,Desc_vc) VALUES (";
		
		$sql_string = $sql_string . $varCode . ",";
		$sql_string = $sql_string . $vartxtcat . ",";
		$sql_string = $sql_string . "'". $vartxtHead . "',";
		$sql_string = $sql_string . "'". $vartxtDesc . "')";

		$check_res = mysqli_query($cn,$sql_string);
		
		closeconnection($cn);
		
		$redirect="faq_list.php?Type=$vartxtType";
		header("Location: $redirect");
		exit;
	}
}

//--------------MODE E-----------------------

if (isset($_POST["txtMode"])=="EA")
{
	$sql_string = "UPDATE faq_m SET Heading='".$vartxtHead."',cat_id ='".$vartxtcat."',Desc_vc ='".$vartxtDesc."' where Id =".$varCode ;
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$redirect="faq_list.php?Type=$vartxtType";
	header("Location: $redirect");

}

//------------FUNCTION-----------------------
function GetMaxNumber($TableName,$FieldName,$cn)
{
	$sql_string = "SELECT Max(" . $FieldName . ") 'col' FROM " . $TableName;
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

	if (mysqli_num_rows($check_res)>=1)
	{
		$rec = mysqli_fetch_array($check_res);
		if ($rec['col']==null)
		{
			return 1;
		}
		else
		{
			return $rec['col'] + 1;
		}
	}
}
?>
<html>
<head>
<title>Samaj</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function doSubmit()
{
	if(frm.txtType.value == "News")
	{
		if(frm.txtHead.value == "")
		{
			alert("Please enter Heading");
			frm.txtHead.focus();
		}		
		else if(frm.txtDesc.value == "")
		{
			alert("Please enter Description");
			frm.txtDesc.focus();
		}
		
		else
		{
			if(frm.txtMode.value == "E")
			{
				frm.txtMode.value = "EA";
				frm.submit();
			}
			else
			{
				frm.txtMode.value = "A";
				frm.submit();
			}
		}
	
	}
	else if(frm.txtType.value == "Offer")
	{
		if(frm.txtDesc.value == "")
		{
			alert("Please enter Description");
			frm.txtDesc.focus();
		}
		else
		{
			if(frm.txtMode.value == "E")
			{
				frm.txtMode.value = "EA";
				frm.submit();
			}
			else
			{
				frm.txtMode.value = "A";
				frm.submit();
			}
		}
	}
	else
	{
		if(frm.txtMode.value == "E")
		{
			frm.txtMode.value = "EA";
			frm.submit();
		}
		else
		{
			frm.txtMode.value = "A";
			frm.submit();
		}
	}	
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
<script type="text/javascript" src="js/datepickercontrol.js"></script>
<link type="text/css" rel="stylesheet" href="css/datepickercontrol.css"> 

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
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
                <td width="25%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php'; ?></td>
                <td>&nbsp;</td>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="text_bold_head">
                      <div align="left">
                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="h1" style="padding-left:25px; ">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="h1" style="padding-left:25px; ">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="h1" style="padding-left:25px; ">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="25%" class="h1" style="padding-left:25px; ">FAQ Master </td>
                            <td><div align="right"> </div></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><div align="left"></div></td>
                  </tr>
                  <tr>
                    <td class="text_bold_head">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="text_bold_head"><form name="frm" method="post" action="faq_m.php" enctype="multipart/form-data">
                      <input type="hidden" name="txtType" value="<?php echo $vartxtType; ?>"/>
                      <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                      <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
					  <input type="hidden" id="DPC_TODAY_TEXT" value="today">
					  <input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
					  <input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
					  <input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr valign="top">
                          <td width="2%">&nbsp;</td>
                          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td align="right" valign="middle" class="text"> FAQ Category </td>
                                <td align="center" valign="middle"><strong>:</strong></td>
                                <td valign="top" class="form_field">
                                  <select name= "cat_name" id="cat_name" class="txtbox">
                                    <option value="">Please Select</option>
                                    <?php foreach($category_info as $val){ 
							if($vartxtcat==$val['cat_id']) { ?>
                                    <option value="<?php echo $val['cat_id']; ?>" selected><?php echo $val['cat_name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $val['cat_id']; ?>"><?php echo $val['cat_name']; ?></option>
                                    <?php } } ?>
                                  </select>
                                </td>
                              </tr>
							  <tr>
                              <td></td>
                              <td></td>
                              <td height="10"></td>
                            </tr>
                              <tr valign="top">
                                <td height="25" class="text"><div align="right">Question</div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="txtHead" type="text" class="txtbox" tabindex="1" value="<?php echo($vartxtHead); ?>" size="66"></td>
                              </tr>
							  <tr>
                              <td></td>
                              <td></td>
                              <td height="10"></td>
                            </tr>
                              <tr valign="top"> </tr>
                              <tr valign="top">
                                <td width="15%" height="25" class="text"><div align="right">Answer</div></td>
                                <td width="2%" height="25">&nbsp;</td>
                                <td width="83%" height="25" class="text"><textarea name="txtDesc" cols="50" rows="10" class="txtbox" tabindex="1"><?php echo($vartxtDesc); ?></textarea></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td height="8"></td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="button" tabindex="2" width="100" value="Submit" height="33" border="0" onClick="javascript:return doSubmit();"></td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                          </table></td>
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
                <td width="0%">&nbsp;</td>
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