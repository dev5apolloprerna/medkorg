<?php

	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	include "connection/conn.php";
	require "noentry.php";
	  include "noentry.php";	
	
	if ($_POST["txtMode"]=="")
	{
		$varMode = $_GET['Mode'];
	}
	else
	{
		$varMode = $_POST['txtMode'];
	}
	
	if ($_POST["txtCode"]=="")
	{
		$varCode = $_GET['Code'];
	}
	else
	{
		$varCode = $_POST['txtCode'];
	}

	if ($_POST["txtType"]=="")
	{
		$vartxtType = $_GET['Type'];
	}
	else
	{
		$vartxtType = $_POST['txtType'];
	}

 //  get  News category data //
 $sqlcategory= "select * from products_cat where cat_type='Group'";
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
	$sql_string = "SELECT * FROM businessdir_m where business_id=". $varCode;
	
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
			$vartxtbname = $rec['business_name'];
			$vartxtcname = $rec['contact_name'];
			$vartxtphone1 = $rec['phone_1'];
			$vartxtphone2 = $rec['phone_2'];
			$vartxtmobile1 = $rec['mobile_1'];
			$vartxtmobile2 = $rec['mobile_2'];
			$vartxtemail = $rec['email_id'];
			$vartxtfax = $rec['fax_number'];
		}
	}
}
else
{
	$vartxtcat = $_POST['cat_name'];
	$vartxtbname = $_POST["business_name"];
	$vartxtcname = $_POST["contact_name"];
	$vartxtphone1 = $_POST["phone_1"];
	$vartxtphone2 =$_POST['phone_2'];
	$vartxtmobile1 = $_POST['mobile_1'];
	$vartxtmobile2 = $_POST['mobile_2'];
	$vartxtemail = $_POST['email_id'];
	$vartxtfax = $_POST['fax_number'];
}
//-------------MODE A------------------------
if ($_POST)
{
	
	
			
	if ($_POST["txtMode"]=="A")
	{	
		$varCode = GetMaxNumber("businessdir_m","business_id",$cn);
		
		 $sql_string = "INSERT INTO businessdir_m(cat_id,business_name,contact_name,phone_1,phone_2,mobile_1,mobile_2,email_id,fax_number) VALUES (";
		
		$sql_string = $sql_string . $vartxtcat . ",";
		$sql_string = $sql_string . "'". $vartxtbname . "',";
		$sql_string = $sql_string . "'". $vartxtcname . "',";
		$sql_string = $sql_string . "'". $vartxtphone1 . "',";
		$sql_string = $sql_string . "'". $vartxtphone2 . "',";
		$sql_string = $sql_string . "'". $vartxtmobile1 . "',";
		$sql_string = $sql_string . "'". $vartxtmobile2 . "',";
		$sql_string = $sql_string . "'". $vartxtemail . "',";
		$sql_string = $sql_string . "'". $vartxtfax . "')";

		$check_res = mysqli_query($cn,$sql_string);
		
		closeconnection($cn);
		
		$redirect="businessdir_list.php?Type=$vartxtType";
		header("Location: $redirect");
		exit;
	}
}

//--------------MODE E-----------------------

if ($_POST["txtMode"]=="EA")
{
	$sql_string = "UPDATE businessdir_m SET business_name='".$vartxtbname."',cat_id ='".$vartxtcat."',contact_name ='".$vartxtcname."',phone_1 ='".$vartxtphone1."',phone_2 ='".$vartxtphone2."',mobile_1 ='".$vartxtmobile1."',mobile_2 ='".$vartxtmobile2."',fax_number ='".$vartxtfax."' where business_id =".$varCode ;
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$redirect="businessdir_list.php";
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
		 if(frm.cat_name.value == "")
		{
			alert("Please Select Cateory Value.");
			frm.cat_name.focus();
			return false;
		}
			
		else if(frm.business_name.value == "")
		{
			alert("Please enter Business Name");
			frm.business_name.focus();
			return false;
		}
		else if(frm.contact_name.value == "")
		{
			alert("Please enter Contact Name");
			frm.contact_name.focus();
			return false;
		}	
		else if(frm.phone_1.value == "")
		{
			alert("Please enter Phone Number-1.");
			frm.phone_1.focus();
			return false;
		}	
		else if(frm.phone_2.value == "")
		{
			alert("Please enter Phone Number-2.");
			frm.phone_2.focus();
			return false;
		}
		else if(frm.mobile_1.value == "")
		{
			alert("Please enter Mobile Number-1.");
			frm.mobile_1.focus();
			return false;
		}
		else if(frm.mobile_2.value == "")
		{
			alert("Please enter Mobile Number-2.");
			frm.mobile_2.focus();
			return false;
		}	
		else if(frm.email_id.value == "")
		{
			alert("Please enter Email Id.");
			frm.email_id.focus();
			return false;
		}	
		else if(frm.fax_number.value == "")
		{
			alert("Please enter Fax Number.");
			frm.fax_number.focus();
			return false;
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
<style type="text/css">
<!--
body {
	background-color: #cbcaca;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style3 {color: #FFFFFF}
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
-->
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
    <td valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top" bgcolor="#FFFFFF" >
          <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
          Administration Panel<br>
          <br>
            </font></span></p>
        </blockquote></td>
      </tr>
    </table></td>
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
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="h1">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="41%" class="h1">Business Directory Master </td>
                            <td width="59%"><div align="right"> </div></td>
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
                    <td class="text_bold_head"><form name="frm" method="post" action="businessdir_m.php">
                      <input type="hidden" name="txtType" value="<?php echo $vartxtType; ?>"/>
                      <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                      <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr valign="top">
                          <td width="2%">&nbsp;</td>
                          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="15%" align="right" valign="middle" class="text"> Group Category </td>
                                <td width="2%" align="center" valign="middle"><strong>:</strong></td>
                                <td width="83%" valign="top" class="form_field">
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
                              <td height="8"></td>
                            </tr>
                              <tr valign="top">
                                <td height="25" class="text"><div align="right">Business Name </div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="business_name" type="text" class="txtbox"  value="<?php echo($vartxtbname); ?>" size="66"></td>
                              </tr>
							  <tr>
                              <td></td>
                              <td></td>
                              <td height="8"></td>
                            </tr>
							  <tr valign="top">
                                <td height="25" class="text"><div align="right">Contact Name </div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="contact_name" type="text" class="txtbox" value="<?php echo($vartxtcname); ?>" size="66"></td>
							    </tr>
							  <tr>
                                <td></td>
                                <td></td>
                                <td height="8"></td>
							    </tr>
							  <tr valign="top">
                                <td height="25" class="text"><div align="right">Phone-1</div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="phone_1" type="text" class="txtbox"  value="<?php echo($vartxtphone1); ?>" size="66"></td>
							    </tr>
							  <tr>
                                <td></td>
                                <td></td>
                                <td height="8"></td>
							    </tr>
							  <tr valign="top">
                                <td height="25" class="text"><div align="right">Phone-2</div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="phone_2" type="text" class="txtbox"  value="<?php echo($vartxtphone2); ?>" size="66"></td>
							    </tr>
							  <tr>
                                <td></td>
                                <td></td>
                                <td height="8"></td>
							    </tr>
							  <tr valign="top">
                                <td height="25" class="text"><div align="right">Mobile Number-1</div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="mobile_1" type="text" class="txtbox" value="<?php echo($vartxtmobile1); ?>" size="66"></td>
							    </tr>
							  <tr>
                                <td></td>
                                <td></td>
                                <td height="8"></td>
							    </tr>
							  <tr valign="top">
                                <td height="25" class="text"><div align="right">Mobile Number-2 </div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="mobile_2" type="text" class="txtbox" value="<?php echo($vartxtmobile2); ?>" size="66"></td>
							    </tr>
							  <tr>
                                <td></td>
                                <td></td>
                                <td height="8"></td>
							    </tr>
							  <tr valign="top">
                                <td height="25" class="text"><div align="right">E-mail Id </div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="email_id" type="text" class="txtbox"  value="<?php echo($vartxtemail); ?>" size="66"></td>
							    </tr>
							  <tr>
                                <td></td>
                                <td></td>
                                <td height="8"></td>
							    </tr>
							  <tr valign="top">
                                <td height="25" class="text"><div align="right">Fax Number </div></td>
                                <td height="25">&nbsp;</td>
                                <td height="25" class="text"><input name="fax_number" type="text" class="txtbox" value="<?php echo($vartxtfax); ?>" size="66"></td>
							    </tr>
							  <tr>
                                <td></td>
                                <td></td>
                                <td height="8"></td>
							    </tr>
                              <tr valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="button" value="Submit" width="100" height="33" border="0" onClick="javascript:return doSubmit();"></td>
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