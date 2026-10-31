<?php
  require 'noentry.php';
  include "connection/conn.php";
	// require "noentry.php";
	
//mode management
$varMode = "";
if (isset($_POST["txtMode"])=="")
{
	
	$varMode = isset($_GET['Mode']) ? $_GET['Mode'] : "";
	
}
else
{
	$varMode = $_POST['txtMode'];
}

$varCode="";
if (isset($_POST["txtCode"])=="")
{
	$varCode = isset($_GET['Code']) ? $_GET['Code'] : "";
}
else
{
	$varCode = $_POST['txtCode'];
	
}

$type = isset($_GET['type']) ? $_GET['type'] : ""; 

//---------------QueryString-------------------
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM products_cat where cat_id =". $varCode;
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
			$cat_name = $rec['cat_name'];
			$txtdefault = $rec['txtdefault'];
			$cat_type = $type;
			$status = $rec['status'];					
		}
	}
}

else
{
	 $cat_name = isset($_POST["cat_name"]) ? $_POST["cat_name"] : "";
	  $txtdefault = isset($_POST["txtdefault"]) ? $_POST["txtdefault"] : "";
	 $cat_type = $type;
	 $status = "1";	 
}
//-------------MODE A------------------------

if ($_POST)
{
	
	if ($_POST["txtMode"]=="A")
	{	
		
		$sql_string = "SELECT * FROM products_cat where cat_name = trim('". $_POST['cat_name'] . "') ";
		
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		
		
		if (mysqli_num_rows($check_res)>0)
		{
			$redirect="message.php?Msg=Duplicate Data Found, Please Try Again";
			header("Location: $redirect");
			exit;
		}
		else
		{	

			if($txtdefault=="Yes")
			{
				 $sql_string = "UPDATE products_cat SET ";
				 $sql_string.= "txtdefault = 'No'";
				 $sql_string = $sql_string ."where cat_type ='".$cat_type."'" ;
				 $sqlupdate = mysqli_query($cn,$sql_string);
				
			}	
			//echo $sql_string="insert into province_m(province_name_vc,default) values('".$vartxtstate."','".$vardefault."')";
			$sql_string = "INSERT INTO products_cat(cat_name,txtdefault,cat_type,status) VALUES(";
			$sql_string = $sql_string . "'". $_POST['cat_name'] . "',";
			$sql_string = $sql_string . "'". $_POST['txtdefault'] . "',";
			$sql_string = $sql_string . "'". $cat_type . "',";
			$sql_string = $sql_string ."'".  $status . "')";
			
			
			$check_res = mysqli_query($cn,$sql_string);
			  
			  
			closeconnection($cn);
			
			$redirect="category_list.php?type=".$type;
			header("Location: $redirect");
			exit;
		}	
	}
}
//--------------MODE E-----------------------
if ($_POST)
{
	if ($_POST["txtMode"] =="EA")
	{
		$sql_string = "SELECT * FROM products_cat where cat_name=trim('".$_POST['$cat_name'] . "') and cat_id!= ". $varCode ."";
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			
		if (mysqli_num_rows($check_res)>0)
		{
			$redirect="message.php?Msg=Duplicate Data Found, Please Try Again";
			header("Location: $redirect");
			exit;
		}
		else
		{  
				if($txtdefault=="Yes")
				{
					$sql_string = "UPDATE products_cat SET ";
					$sql_string.= "txtdefault = 'No'";
					$sql_string = $sql_string ."where cat_type ='".$cat_type."'" ;
					$sqlupdate = mysqli_query($cn,$sql_string);
					
				}	
		
			$sql_string = "UPDATE products_cat SET cat_name = '" .$cat_name."'";
			$sql_string.= ",txtdefault = '" .$txtdefault ."'";
			$sql_string.= ",cat_type = '" .$cat_type ."'";
			$sql_string.= ",status = '" .$status ."'";
			$sql_string = $sql_string ."where cat_id =".$varCode ;
			
			$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			
			$redirect="category_list.php?type=".$type;
				header("Location: $redirect");
			exit;
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
		alert("Please enter Category Name");
		frm.cat_name.focus();
	}
	if(frm.txtdefault.value == "")
	{
		alert("Please Select Default");
		frm.txtdefault.focus();
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
.style5 {color: #063968; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
.style2 {color: #FFFFFF;
	font-weight: bold;
	font-size: 13px;
}
-->
</style>


</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"> 
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff"><tr>
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
                              <table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr>
                                </tr>
                              </table>
                          </div></td>
                        </tr>
                        <tr>
                          <td class="h1">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="h1">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="h1">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="h1" style="padding-left:25px; "><div align="left" class="h1">Category Master </div></td>
                        </tr>
                        <tr>
                          <td align="center" valign="top">
                            <form name="frm" method="post" action="category_m.php?type=<?php echo $type; ?>">
                              <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                              <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="12"></td>
                                </tr>
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="115" align="right" valign="middle" class="text"> Value </td>
                                        <td width="10" align="center" valign="middle"><strong>:</strong></td>
                                        <td width="603" align="left" valign="middle">
                                          <input name="cat_name" type="text" class="text" id="cat_name" value="<?php echo($cat_name); ?>" size="40">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="5"></td>
                                      </tr>
                                      <?php
									  	if(isset($_GET['type'])=='photogallery')
										{
									  ?>
                                       <tr>
                                        <td width="115" align="right" valign="middle" class="text"> Default Category </td>
                                        <td width="10" align="center" valign="middle"><strong>:</strong></td>
                                        <td width="603" align="left" valign="middle">
                                         <select name="txtdefault" tabindex="7">
                                         <option value="">Please Select</option>
									<option value="Yes" <?php echo($txtdefault == "Yes")?"selected":""; ?>> Yes </option>
									<option value="No" <?php echo($txtdefault == "No")?"selected":""; ?>> No </option>
								</select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="5"></td>
                                      </tr>
                                      <?php } ?>


						    <tr>
                              <td height="10"> </td>
						   </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top"><input type="button" name="btnadd2" id="btnadd2" value="Submit" onClick="return doSubmit();" style="cursor:pointer;" />                                            <input type="button" name="btncancel" id="btncancel" value="Cancel" style="cursor:pointer;" onClick="window.location='category_list.php?type=<?php echo $type; ?>'" /></td>
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
