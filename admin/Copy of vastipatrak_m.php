<?php
include "connection/conn.php";
	require "noentry.php";
include "noentry.php";
	
require 'include/appmain.php';
require 'utility/querygen.inc';

$oQGen = new CQueryGen();
$oQGen1 = new CQueryGen();
	
session_start();
$ProdThumbImgDir = "images/vastipatrak/thumb/";
$ProdLargeImgDir = "images/vastipatrak/attachment/";
	

if ($_POST["txtMode"]=="")
{
	$varMode = $_GET['Mode'];
}
else
{
	$varMode = $_POST['txtMode'];
}

if ($_POST["vasti_id"]=="")
{
	$varCode = $_GET['Code'];
}
else
{
	$varCode = $_POST['vasti_id'];
}


	$sql_string = "SELECT * FROM bdir_category where cat_type='B' and main_id=0 and group_name!='Root' order by sub_id";
	$check_cat = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

	$sql_string = "SELECT * FROM industry_m order by ind_id";
	$check_ind = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM bdir_category where cat_type='J' and main_id=0 and group_name!='Root' order by sub_id";
	$check_jobtype = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM industry_m order by ind_id";
	$check_ind_job = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM bdir_category where cat_type='P' and main_id=0 and group_name!='Root' order by sub_id";
	$check_cat1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM country_m order by country_name";
	$chk_country = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM country_m order by country_name";
	$chk_job_country = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM education_m order by education_id";
	$chk_edu_det = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
//---------------QueryString-------------------
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM vastipatrak_m where vasti_id=". $varCode;
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
			$vartxtformno = $rec['form_no'];
			
			$parent_id = $rec['parent_id'];
			
			$vartxtVillage = $rec['village_id'];
			$vartxtGotra = $rec['gotra_id'];
			
			$vartxtaddr1 = $rec['addr1'];
			$vartxtaddr2 = $rec['addr2'];
			$vartxtaddr3 = $rec['addr3'];
			
			$vartxtcountry = $rec['country'];
			$vartxtstate = $rec['state'];
			$vartxtcity = $rec['city'];
			$vartxtdistrict = $rec['district'];
			$vartxtpincode = $rec['pincode'];
			
			$vartxtFName = $rec['fname_vc'];
			$vartxtMName = $rec['mname_vc'];
			$vartxtLName = $rec['lname_vc'];
			
			$varGender = $rec['gender_c'];
			
			$sel_relation =$rec['sel_relation'];
			
			$vartxtMarital = $rec['marital_id'];
			//$vartxtMobile = $rec['mobile_number'];
			$vartxtmobile_home = $rec['mobile_home'];
			$vartxtalt_mobile = $rec['alt_mobile'];
			$vartxtphone_number = $rec['phone_number'];
			$vartxtcode_phone_number = $rec['code_phone_number'];
			$vartxtalt_number = $rec['alt_number'];
			$vartxtcode_alt_number = $rec['code_alt_number'];
			$vartxtEmail = $rec['email'];
			
			$vartxtReltion = $rec['relation_id'];
			
			$vartxtDate = $rec['birth_date'];
			$vartxtAge = $rec['age'];
			
			$vartxtBloodgroup = $rec['blood_group'];
			
			$vartxtedu_cat = $rec['edu_cat'];
			$vartxtEduBasic = $rec['edu_basic'];
			$vartxtEduSub = $rec['edu_sub'];
		}
	}
	
	$sql_string1 = "SELECT * FROM businessdir_m where vasti_id=". $varCode;
	$check_res1 = mysqli_query($cn,$sql_string1);
	if (mysqli_num_rows($check_res1)>=1)
	{
		while ($rec1 = mysqli_fetch_array($check_res1))
		{
			$prof_type = $rec1['prof_type'];
			$vasti_id = $rec1['vasti_id'];
			$bness_cat_id = $rec1['bness_cat_id'];
			$bness_subcat_id = $rec1['bness_subcat_id'];
			$bness_name = $rec1['bness_name'];
			$bness_addr = $rec1['bness_addr'];
			$bness_phone = $rec1['bness_phone'];
			$bness_mobile = $rec1['bness_mobile'];
			$bness_desc = $rec1['bness_desc'];
			$prof_cat_id = $rec1['prof_cat_id'];
			$prof_subcat_id = $rec1['prof_subcat_id'];
			$prof_addr = $rec1['prof_addr'];
			$prof_phone = $rec1['prof_phone'];
			$prof_mobile = $rec1['prof_mobile'];
			$prof_desc = $rec1['prof_desc'];
			$comp_name = $rec1['comp_name'];
			$job_type = $rec1['job_type'];
			$job_ind_id = $rec1['job_ind_id'];
			$job_desig = $rec1['job_desig'];
			$job_addr = $rec1['job_addr'];
			$job_phone = $rec1['job_phone'];
			$job_mobile = $rec1['job_mobile'];
			
			$vartxtjobaddr1 = $rec1['job_addr1'];
			$vartxtjobaddr2 = $rec1['job_addr2'];
			$vartxtjobaddr3 = $rec1['job_addr3'];
			$vartxtjobcountry = $rec1['job_country'];
			$vartxtjobstate = $rec1['job_state'];
			$vartxtjobcity = $rec1['job_city'];
			$vartxtjobdistrict = $rec1['job_district'];
			$vartxtjobpincode = $rec1['job_pincode'];
		}
	}
}

//-------------MODE A------------------------
if ($_POST)
{
	if($_FILES["thumb_image"]["name"]!="")
	{
		$filename = $_FILES["thumb_image"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage = $sys_name.$extension;
		$ProdThumbImgDir.$TImage;
		  
		  move_uploaded_file($_FILES["thumb_image"]["tmp_name"],$ProdThumbImgDir.$TImage);
		  $imageuploadthumb=",thumb_image='".$TImage."'";
	}
	
	if($_FILES["attachment"]["name"]!="")
	{
		$filename = $_FILES["attachment"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$EImage = $sys_name.$extension;
		move_uploaded_file($_FILES["attachment"]["tmp_name"],$ProdLargeImgDir.$EImage);
		$imageuploadlarge=",attachment='".$EImage."'";
	}
	
		
		// Add data in user_master table
		// Begin get Fields of Tables
		$sql="select * from vastipatrak_m where 1=2";
		$res=mysqli_query($cn,$sql);

		$fieldarray=array();
		
		while($fd=mysqli_fetch_field($res)):
			$fieldarray[]=$fd->name;
		endwhile;
		
		array_shift($fieldarray);// remove first element orderID
							 
		 // End get Fields of Tables
		
		$oQGen->setTableName("vastipatrak_m"); // set the table name
		
		foreach($_POST as $key=>$val)
		{ 
			if($key == "vasti_id")
			{
				$oQGen->addFieldValue("vasti_id",$_POST['vasti_id'],"C");
			}
			if($key == "email")
			{
				$emailid = $val;
			}
			if(in_array($key,$fieldarray) && trim($val)!="")
			{	 
				$oQGen->addFieldValue($key,$val,"C");
			}
		}
		
		if($_FILES['thumb_image']!="")
		{
			$oQGen->addFieldValue("thumb_image",$TImage,"C");
		}
		if($_FILES['attachment']!="")
		{
			$oQGen->addFieldValue("attachment",$EImage,"C");
		}
		// Get Execution Statement
		if ($_POST["txtMode"]=="A"){
			$sql_string = $oQGen->getInsert();
		}
		else{
			$oQGen->addConditionFieldValue("vasti_id",$_POST['vasti_id'],"C");
			$sql_string = $oQGen->getUpdate();
		}
		  
		$code = db_execute($cn,$sql_string);
		if($emailid == "")
			$userid = strtolower(substr($_POST['fname_vc'],0,3)) . '_' .  rand(1,500);
		else
			$userid = $emailid;	
		
		// Insert the userid and password in the user_m table //
		$sql_string1 = "INSERT into user_m (vasti_id,user_login,user_password,user_email) values";
		$pswd = rand(1,10000);
		$sql_string1 = $sql_string1 . " ('".$code."','".$userid."','".$pswd."','".$userid."')";
		$check_res_ins = mysqli_query($cn,$sql_string1) or die(mysqli_error($cn));
		
		
		if($code == 0 || $code=="")
			$code = $_POST['vasti_id'];
		
		// Insert professional details in businessdir_m table //
		// Add data in user_master table
		// Begin get Fields of Tables
		if($_POST['prof_type']!="")
		{
		
			$sql="select * from businessdir_m where 1=2";
			$res=mysqli_query($cn,$sql);
		
			$fieldarray=array();
			
			while($fd=mysqli_fetch_field($res)):
				$fieldarray[]=$fd->name;
			endwhile;
			
			array_shift($fieldarray);// remove first element orderID
								 
			 // End get Fields of Tables
			
			$oQGen1->setTableName("businessdir_m"); // set the table name
			
			foreach($_POST as $key=>$val)
			{ 
				if($key == "vasti_id")
				{
					$val = $code;
				} 
				if(in_array($key,$fieldarray) && trim($val)!="")
				{	 
					$oQGen1->addFieldValue($key,$val,"C");
				}
			}
								
			// first delete entry of current vasti_id and then insert updtaed record //
			$sql_del = "delete from businessdir_m where vasti_id=".$code;
			$chk_del = mysqli_query($cn,$sql_del);
			
			// Get Execution Statement
			$sql_string = $oQGen1->getInsert();
			
			$code1= db_execute($cn,$sql_string);
			
		}		
		
		redirect("vastipatrak_list.php");
		exit;
		
}
?>

<html>
<head>
<title>Samaj</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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

<script type="text/javascript" src="js/ajax.js"></script> 
<script type="text/javascript" src="js/userjvalid.js"></script>
<script type="text/javascript" src="js/datepickercontrol.js"></script>
<link type="text/css" rel="stylesheet" href="css/datepickercontrol.css"> 
<script language="javascript" type="text/javascript">
	function showhideDiv(val)
	{
		if(val == "" || val=="H" || val=="S" || val=="R")
		{
			document.getElementById("trbusiness").style.display = "none";
			document.getElementById("trprof").style.display = "none";
			document.getElementById("trjob").style.display = "none";
			document.getElementById("tdaddr").style.display = "none";
		}
		if(val == "B")
		{
			document.getElementById("trbusiness").style.display = "";
			document.getElementById("trprof").style.display = "none";
			document.getElementById("trjob").style.display = "none";
			document.getElementById("tdaddr").style.display = "";
		}
		if(val == "P")
		{
			document.getElementById("trbusiness").style.display = "none";
			document.getElementById("trprof").style.display = "";
			document.getElementById("trjob").style.display = "none";
			document.getElementById("tdaddr").style.display = "";
		}
		if(val == "J")
		{
			document.getElementById("trbusiness").style.display = "none";
			document.getElementById("trprof").style.display = "none";
			document.getElementById("trjob").style.display = "";
			document.getElementById("tdaddr").style.display = "";
		}
	}
	
	
</script>
</head>
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
                <td width="30%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
                <td background="images/grey_bg.gif">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr valign="top">
                <td background="images/grey_bg.gif">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="h1"><span class="h1">VastiPatrak Master </span></td>
              </tr>
              <tr valign="top">
                <td width="1%" background="images/grey_bg.gif">&nbsp;</td>
                <td width="0%">&nbsp;</td>
                <td width="69%"><form name="frm" method="post" action="vastipatrak_m.php" enctype="multipart/form-data">
                  <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
				  <input type="hidden" name="vasti_id" value="<?php echo $varCode; ?>">
				  <input type="hidden" name="business_id" value="">
                  <input type="hidden" name="form_no" value="<?php echo $form_no; ?>">	
				  <input type="hidden" id="DPC_TODAY_TEXT" value="today">
				  <input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
				  <input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
				  <input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
                  <input type="hidden" name="parent_id" value="<?php echo $hcode; ?>">                 							  
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                      <td width="2%">&nbsp;</td>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr valign="top">
                          <td height="8" colspan="7" class="text_bold_head"></td>
                        </tr>
                        <tr valign="top" bgcolor="#eaeaea">
                          <td height="10" colspan="7" class="text_bold_head">Personal Details</td>
                        </tr>
                        <tr valign="top">
                          <td height="8" colspan="7" class="text"></td>
                        </tr>
                        <tr valign="top">
                          <td height="25" class="text"><div align="right">Form No. <font color="#FF0000">*</font></div></td>
                          <td height="25"><div align="center">:</div></td>
                          <td width="79%" height="25" class="sublink">
                          <input type="text" name="form_no" id="Form No." class="txtreqd txtbox" tabindex="1" value="<?php echo $vartxtformno; ?>">
						  </td>
                        </tr>
                        <tr valign="top">
                          <td height="8" class="text"></td>
                          <td height="8"></td>
                          <td height="8" class="sublink"></td>
                        </tr>
						<tr valign="top">
                          <td width="19%" height="25" class="text"><div align="right">Native Place<font color="#FF0000">*</font></div></td>
                          <td width="2%" height="25"><div align="center">:</div></td>
                          <td height="25" colspan="5" class="sublink">
                            <select name="village_id" tabindex="2" id="Native Place " class="txtrequiredsel txtbox">
                              <option value="0" selected>Please Select</option>
                              <?php
									$sql_string = "SELECT * FROM village_m";
	
									$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
									if (mysqli_num_rows($check_res)>0)
									{
										while ($rec = mysqli_fetch_array($check_res))
										{
											if ($vartxtVillage == $rec['village_id'])
												echo ("<option selected value ='". $rec['village_id'] ."'>". $rec['village_name'] ."</option>");
											else
												echo ("<option value='". $rec['village_id'] ."'>". $rec['village_name'] ."</option>");
										}	
									}
								?>
                          </select></td>
                        </tr>
                        <tr valign="top">
                          <td height="8" class="text"></td>
                          <td height="8"></td>
                          <td height="8" colspan="5" class="sublink"></td>
                        </tr>
                        <tr valign="top">
                          <td height="25" class="text"><div align="right">Gotra<font color="#FF0000">*</font></div></td>
                          <td height="25"><div align="center">:</div></td>
                          <td height="25" colspan="5" class="sublink">
                            <select name="gotra_id" tabindex="3" id="Gotra " class="txtrequiredsel txtbox">
                              <option value="0" selected>Please Select</option>
                              <?php
															$sql_string = "SELECT * FROM gotra_m";
	
															$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
															if (mysqli_num_rows($check_res)>0)
															{
																while ($rec = mysqli_fetch_array($check_res))
																{
																	if ($vartxtGotra == $rec['gotra_id'])
																		echo ("<option selected value ='". $rec['gotra_id'] ."'>". $rec['gotra_name'] ."</option>");
																	else
																		echo ("<option value='". $rec['gotra_id'] ."'>". $rec['gotra_name'] ."</option>");
																}	
															}
														?>
                          </select></td>
                        </tr>
                        <tr valign="top">
                          <td height="8" class="text"></td>
                          <td height="8"></td>
                          <td height="8" colspan="5" class="sublink"></td>
                        </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Name<font color="#FF0000">*</font></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                              <tr>
                                <td width="15%"><div align="right">First Name</div></td>
                                <td width="2%">&nbsp;</td>
                                <td width="83%"><input name="fname_vc" type="text" class="txtreqd txtbox1" id="First Name " tabindex="4" value="<?php echo($vartxtFName); ?>" size="30"></td>
                              </tr>
                              <tr>
                                <td><div align="right">Middle Name </div></td>
                                <td>&nbsp;</td>
                                <td><input name="mname_vc" type="text" class="txtreqd txtbox1" id="Middle Name " tabindex="5" value="<?php echo($vartxtMName); ?>" size="30"></td>
                              </tr>
                              <tr>
                                <td><div align="right">Last Name </div></td>
                                <td>&nbsp;</td>
                                <td><input name="lname_vc" type="text" class="txtreqd txtbox1" id="Last Name " tabindex="6" value="<?php echo($vartxtLName); ?>" size="30"></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Gender<font color="#FF0000">*</font></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink">
                              <span class="text"><span class="text2">
                              <input type="radio" name="gender_c" tabindex="7" value="Male" class="txtreqd" <?php echo($varGender == "Male" || $varGender == "")?"checked":""; ?> />
                              </span>Male<span class="text2">
                              <input type="radio" name="gender_c" tabindex="8" value="Female" class="txtreqd" <?php echo($varGender == "Female")?"checked":""; ?> />
                              </span>Female</span></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Address</div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                              <tr>
                                <td width="15%"><div align="right">Line1</div></td>
                                <td width="2%">&nbsp;</td>
                                <td width="83%"><input name="addr1" type="text" class="txtbox1" id="addr1" tabindex="9" value="<?php echo($vartxtaddr1); ?>" size="30"></td>
                              </tr>
                              <tr>
                                <td><div align="right">Line2</div></td>
                                <td>&nbsp;</td>
                                <td><input name="addr2" type="text" class="txtbox1" id="addr2" tabindex="10" value="<?php echo($vartxtaddr2); ?>" size="30"></td>
                              </tr>
                              <tr>
                                <td><div align="right">Line3</div></td>
                                <td>&nbsp;</td>
                                <td><input name="addr3" type="text" class="txtbox1" id="addr3" tabindex="11" value="<?php echo($vartxtaddr3); ?>" size="30"></td>
                              </tr>
                              <tr>
                                <td><div align="right">Country</div></td>
                                <td>&nbsp;</td>
                                <td>
                                  <select name="country" class="txtbox1" id="country" tabindex="12" <?php echo($vartxtcountry); ?> onchange="javascript:getState(this.value);">
                                    <option value=""> Select Country </option>
                                    <?php
										while($country = mysqli_fetch_array($chk_country))
										{
											if($country['country_id'] == $vartxtcountry)
											{
									 ?>
                                    <option value="<?php echo $country['country_id']; ?>" selected> <?php echo $country['country_name']; ?> </option>
                                    <?php }else{ ?>
                                    <option value="<?php echo $country['country_id']; ?>"> <?php echo $country['country_name']; ?> </option>
                                    <?php } } ?>
                                  </select>                                
							    </td>
                              </tr>
                              <tr>
                                <td><div align="right">State</div></td>
                                <td>&nbsp;</td>
                                <td id="tdstate">
                                  <select name="state" class="txtbox1" id="State " tabindex="13"/>
                                  
                                  <option value=""> Select State </option>                                </td>
                              </tr>
                              <tr>
                                <td><div align="right">City/District</div></td>
                                <td>&nbsp;</td>
                                <td id="tdcity">
                                  <select name="city" class="txtbox1" id="City " tabindex="14"/>
                                  
                                  <option value=""> Select City </option>                                </td>
                              </tr>
                              <tr>
                                <td><div align="right">District</div></td>
                                <td>&nbsp;</td>
                                <td><input name="district" type="text" class="txtbox1" id="district" tabindex="15" value="<?php echo($vartxtdistrict); ?>" size="30" /></td>
                              </tr>
                              <tr>
                                <td><div align="right">Pincode</div></td>
                                <td>&nbsp;</td>
                                <td><input name="pincode" type="text" class="txtbox1" id="pincode" tabindex="16" value="<?php echo($vartxtpincode); ?>" size="20"></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Marital Status<font color="#FF0000">*</font></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink">
                              <select name="marital_id" tabindex="17" id="Marital Status" class="txtrequiredsel txtbox">
                                <option value="0" selected>Please Select</option>
                                <?php
									$sql_string = "SELECT * FROM marital_m";

									$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
									if (mysqli_num_rows($check_res)>0)
									{
										while ($rec = mysqli_fetch_array($check_res))
										{
											if ($vartxtMarital == $rec['marital_id'])
												echo ("<option selected value ='". $rec['marital_id'] ."'>". $rec['marital_name'] ."</option>");
											else
												echo ("<option value='". $rec['marital_id'] ."'>". $rec['marital_name'] ."</option>");
										}	
									}
								?>
                            </select></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Birth Date </div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><input type="text" name="birth_date" class="txtbox" tabindex="20" id="birth_date"  datepicker_format="YYYY-MM-DD" datepicker="true" value="<?php echo($vartxtDate); ?>" /></td>
                            </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Age</div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td colspan="5" class="text"><input name="age" type="text" class="txtbox" id="Age " tabindex="20" value="<?php echo($vartxtAge); ?>" size="10"/> (Enter Age of the person in case birthdate is not available)</td>
                            </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Blood Group</div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink">
								<select name="blood_group" tabindex="21" class="txtbox1">
									<option value=""> Please Select </option>
									<option value="A +ve" <?php echo($vartxtBloodgroup=="A +ve")?"selected":""; ?>> A +ve  </option>
									<option value="A -ve" <?php echo($vartxtBloodgroup=="A -ve")?"selected":""; ?>> A -ve  </option>
									<option value="B +ve" <?php echo($vartxtBloodgroup=="B +ve")?"selected":""; ?>> B +ve  </option>
									<option value="B -ve" <?php echo($vartxtBloodgroup=="B -ve")?"selected":""; ?>> B -ve  </option>
									<option value="O +ve" <?php echo($vartxtBloodgroup=="O +ve")?"selected":""; ?>> O +ve  </option>
									<option value="O -ve" <?php echo($vartxtBloodgroup=="O -ve")?"selected":""; ?>> O -ve  </option>
									<option value="AB +ve" <?php echo($vartxtBloodgroup=="AB +ve")?"selected":""; ?>> AB +ve </option>
									<option value="AB -ve" <?php echo($vartxtBloodgroup=="AB -ve")?"selected":""; ?>> AB -ve </option>
								</select>
							</td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Education</div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="4" class="sublink"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="25%" height="25" class="sublink"> <span class="text">
                                  <select name="edu_cat" id="edu_cat" tabindex="22" class="txtbox1" onChange="getDet(this.value);">
                                    <?php
									while($edu_det = mysqli_fetch_array($chk_edu_det))
									{
										if($vartxtedu_cat == $edu_det['education_id'])
										{
								    ?>
                                   	 <option value="<?php echo $edu_det['education_id']; ?>" selected> <?php echo $edu_det['education_name']; ?></option>
                                    <?php }else{ ?>
                                   	 <option value="<?php echo $edu_det['education_id']; ?>"> <?php echo $edu_det['education_name']; ?></option>
                                   <?php } } ?>
                                  </select>
                                </span></td>
                                <td width="75%" class="sublink"><table width="50%" id="tdedudetails" style="display:none;" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                    <tr>
                                      <td width="60%"><div align="right">Course Detail</div></td>
                                      <td width="2%">&nbsp;</td>
                                      <td width="38%"><input name="edu_basic" type="text" class="txtbox1" id="edu_basic4" tabindex="23" value="<?php echo($vartxtEduBasic); ?>" size="30"></td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                            </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr>
                            <td height="10" align="right" valign="middle" class="text">  Photo </td>
                            <td align="center" valign="middle"><div align="center"><strong>:&nbsp;</strong></div></td>
                            <td colspan="5" align="left" valign="middle"><input type="file" name="thumb_image" id="thumb_image" size="30" tabindex="25" class="text"  ></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr>
                            <td height="10" align="right" valign="middle" class="text"> Attachment</td>
                            <td align="center" valign="middle"><div align="center"><strong>:&nbsp;</strong></div></td>
                            <td colspan="5" align="left" valign="middle"><input type="file" name="attachment" id="attachment" tabindex="26" size="30" class="text"  ></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top" bgcolor="#eaeaea">
                            <td height="10" colspan="7" class="text_bold_head">Communication Details</td>
                          </tr>
                          <tr valign="top">
                            <td height="8" colspan="7" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Phone Number(L.L.)</div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><input name="code_phone_number" type="text" class="txtbox1" tabindex="19" value="<?php echo($vartxtcode_phone_number); ?>" size="08"> &nbsp; <input name="phone_number" type="text" class="txtbox1" tabindex="18" value="<?php echo($vartxtphone_number); ?>" size="50"></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Alternate Number</div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"> <input name="code_alt_number" type="text" class="txtbox1" tabindex="19" value="<?php echo($vartxtcode_alt_number); ?>" size="08"> &nbsp; <input name="alt_number" type="text" class="txtbox1" tabindex="19" value="<?php echo($vartxtalt_number); ?>" size="50"></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Mobile(Home)</div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><input name="mobile_home" type="text" class="txtbox1" tabindex="20" value="<?php echo($vartxtmobile_home); ?>" size="50"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Alternate Mobile</div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><input name="alt_mobile" type="text" class="txtbox1" tabindex="21" value="<?php echo($vartxtalt_mobile); ?>" size="50"></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top" bgcolor="#eaeaea">
                            <td height="10" colspan="7" class="text_bold_head">Professional Details</td>
                          </tr>
                          <tr valign="top">
                            <td height="8" colspan="7" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="10" colspan="7"><span class="sublink">
                              </span>                              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="19%" height="10" valign="top" class="text"><div align="right">Type</div></td>
                                <td width="2%" height="25" valign="top"><div align="center">:</div></td>
                                <td width="79%" height="25">
									  <span class="sublink">
                                  		  <select name="prof_type" onChange="showhideDiv(this.value)" tabindex="27">
											<option value="" <?php echo ($prof_type == "")?"selected":""; ?>> Not specified </option>
											<option value="H" <?php echo ($prof_type == "H")?"selected":""; ?>> House Wife </option>
											<option value="S" <?php echo ($prof_type == "S")?"selected":""; ?>> Student </option>
											<option value="B" <?php echo ($prof_type == "B")?"selected":""; ?>> Business </option>
											<option value="P" <?php echo ($prof_type == "P")?"selected":""; ?>> Professional </option>
											<option value="J" <?php echo ($prof_type == "J")?"selected":""; ?>> Job </option>
											<option value="R" <?php echo ($prof_type == "R")?"selected":""; ?>> Retire </option>
                                          </select>
                                	  </span>								  
								</td>
                              </tr>
							  <tr id="trbusiness" style="display:none;">
                                <td height="25" colspan="3" valign="top" class="text"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="19%" height="10" valign="top" class="text"><div align="right">Business Category</div></td>
                                    <td width="2%" height="25" valign="top"><div align="center">:</div></td>
                                    <td width="79%" height="25"><span class="sublink">
                                      <select name="bness_cat_id" tabindex="28">
											<option value=""> Please Select </option>
                                        <?php
											while($cat = mysqli_fetch_array($check_cat))
											{
												if($bness_cat_id == $cat['sub_id'])
												{
										 ?>
											<option value="<?php echo $cat['sub_id']; ?>" selected> <?php echo $cat['group_name']; ?> </option>
										<?php 	} else { ?> 
											<option value="<?php echo $cat['sub_id']; ?>"> <?php echo $cat['group_name']; ?> </option>
										<?php
										 	} }
										 ?>
                                      </select>
                                    </span></td>
                                  </tr>
                                  <tr>
                                    <td height="10" valign="top" class="text"><div align="right">Industry</div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25" id="tdsubcat"><span class="sublink">
                                      <select name="bness_subcat_id" tabindex="29">
									  	<option value=""> Please Select </option>
										<?php
											while($ind = mysqli_fetch_array($check_ind))
											{
												if($bness_subcat_id == $ind['ind_id'])
												{
										 ?>
											<option value="<?php echo $ind['ind_id']; ?>" selected> <?php echo $ind['ind_value']; ?> </option>
										<?php 	} else { ?> 
											<option value="<?php echo $ind['ind_id']; ?>"> <?php echo $ind['ind_value']; ?> </option>
										<?php
										 	} }
										 ?>
									  </select>
                                    </span></td>
                                  </tr>
                                  <tr>
                                    <td height="10" valign="top" class="text"><div align="right">Business Name </div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25"><span class="sublink">
                                      <input name="bness_name" type="text" class="txtbox1" tabindex="30" value="<?php echo($bness_name); ?>" size="50">
                                    </span></td>
                                  </tr>
                                  <!--<tr>
                                    <td height="22" valign="top" class="text"><div align="right">Business Address</div></td>
                                    <td height="22" valign="top"><div align="center">:</div></td>
                                    <td height="22"><span class="sublink">
                                      <textarea name="bness_addr" cols="30" rows="5" class="txtbox1" tabindex="31"><?php echo($bness_addr); ?></textarea>
                                    </span></td>
                                  </tr>-->
                                  <tr>
                                    <td height="10" valign="top" class="text"><div align="right">Phone No</div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25" class="text">
                                      <input name="bness_phone" type="text" class="txtbox1" tabindex="32" value="<?php echo($bness_phone); ?>" size="40"> 
                                      (Multiple nos seperated by comma[,])									</td>
                                  </tr>
                                  <tr>
                                    <td height="10" valign="top" class="text"><div align="right">Mobile No. </div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25" class="text"><span class="sublink">
                                      <input name="bness_mobile" type="text" class="txtbox1" tabindex="33" value="<?php echo($bness_mobile); ?>" size="40">
(Multiple nos seperated by comma[,])                                    </span></td>
                                  </tr>
                                  <tr>
                                    <td height="10" valign="top" class="text"><div align="right">Description</div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25" class="text"><span class="sublink">
                                      <textarea name="bness_desc" cols="40" rows="7" class="txtbox1" tabindex="34"><?php echo($bness_desc); ?></textarea>
    </span></td>
                                  </tr>
                                </table></td>
                                </tr>
                            </table></td></tr>
                          <tr valign="top" id="trprof" style="display:none;">
                            <td height="10" colspan="7"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="19%" height="10" valign="top" class="text"><div align="right">Profession Name</div></td>
                                <td width="2%" height="25" valign="top"><div align="center">:</div></td>
                                <td width="79%" height="25"><span class="sublink">
                                  <select name="prof_cat_id" tabindex="35" onChange="getSubCat(this.value,'','prof_subcat_id','tdprofcat');">
                                    <option value=""> Please Select </option>
                                    <?php
											while($prof = mysqli_fetch_array($check_cat1))
											{
												if($prof_cat_id == $prof['sub_id'])
												{
										 ?>
                                    <option value="<?php echo $prof['sub_id']; ?>" selected> <?php echo $prof['group_name']; ?> </option>
                                    <?php 	} else { ?>
                                    <option value="<?php echo $prof['sub_id']; ?>"> <?php echo $prof['group_name']; ?> </option>
                                    <?php
										 	} }
										 ?>
                                  </select>
                                </span></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right">Specialization</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" id="tdprofcat"><span class="sublink">
                                  <select name="prof_subcat_id" tabindex="36">
                                    <option value=""> Please Select </option>
                                  </select>
                                </span></td>
                              </tr>
                              <!--<tr>
                                <td height="10" valign="top" class="text"><div align="right">Office Address</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25"><span class="sublink">
                                  <textarea name="prof_addr" cols="30" rows="5" class="txtbox1" tabindex="37"><?php echo($prof_addr); ?></textarea>
                                </span></td>
                              </tr> -->
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right">Phone No</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" class="text">
                                  <input name="prof_phone" type="text" class="txtbox1" tabindex="38" value="<?php echo($prof_phone); ?>" size="40">
    (Multiple nos seperated by comma[,]) </td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right">Mobile No. </div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" class="text"><span class="sublink">
                                  <input name="prof_mobile" type="text" class="txtbox1" tabindex="39" value="<?php echo($prof_mobile); ?>" size="40">
    (Multiple nos seperated by comma[,]) </span></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right">Description</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" class="text"><span class="sublink">
                                  <textarea name="prof_desc" cols="40" rows="7" class="txtbox1" tabindex="40"><?php echo($prof_desc); ?></textarea>
                                </span></td>
                              </tr>
                            </table></td>
                            </tr>
                          <tr valign="top" id="trjob" style="display:none;">
                            <td height="10" colspan="7"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right">Job Type </div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25"><span class="sublink">
                                  <select name="job_type" tabindex="28">
                                    <option value=""> Please Select </option>
                                    <?php
											while($jobtype = mysqli_fetch_array($check_jobtype))
											{
												if($job_type == $jobtype['sub_id'])
												{
										 ?>
                                    <option value="<?php echo $jobtype['sub_id']; ?>" selected> <?php echo $jobtype['group_name']; ?> </option>
                                    <?php 	} else { ?>
                                    <option value="<?php echo $jobtype['sub_id']; ?>"> <?php echo $jobtype['group_name']; ?> </option>
                                    <?php
										 	} }
										 ?>
                                  </select>
                                </span></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right">Industry</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" id="tdsubcat"><span class="sublink">
                                  <select name="job_ind_id" tabindex="29">
                                    <option value=""> Please Select </option>
                                    <?php
											while($j_ind = mysqli_fetch_array($check_ind_job))
											{
												if($job_ind_id == $j_ind['ind_id'])
												{
										 ?>
                                    <option value="<?php echo $j_ind['ind_id']; ?>" selected> <?php echo $j_ind['ind_value']; ?> </option>
                                    <?php 	} else { ?>
                                    <option value="<?php echo $j_ind['ind_id']; ?>"> <?php echo $j_ind['ind_value']; ?> </option>
                                    <?php
										 	} }
										 ?>
                                  </select>
                                </span></td>
                              </tr>
                              <tr>
                                <td width="19%" height="10" valign="top" class="text"><div align="right">Company Name</div></td>
                                <td width="2%" height="25" valign="top"><div align="center">:</div></td>
                                <td width="79%" height="25"><span class="sublink">
                                  <span class="text">
                                  <input name="comp_name" type="text" class="txtbox1" tabindex="41" value="<?php echo($comp_name); ?>" size="50">
                                  </span>                                </span></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right">Designation</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25"><span class="sublink">
                                  <span class="text">
                                  <input name="job_desig" type="text" class="txtbox1" tabindex="42" value="<?php echo($job_desig); ?>" size="50">
                                  </span>                                </span></td>
                              </tr>
                              <!--
							  <tr>
                                <td height="10" valign="top" class="text"><div align="right">Office Address</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25"><span class="sublink">
                                  <textarea name="job_addr" cols="30" rows="5" class="txtbox1" tabindex="43"><?php echo($job_addr); ?></textarea>
                                </span></td>
                              </tr> -->
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right">Phone No</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" class="text">
                                  <input name="job_phone" type="text" class="txtbox1" tabindex="44" value="<?php echo($job_phone); ?>" size="40">
      (Multiple nos seperated by comma[,]) </td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right">Mobile No. </div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" class="text"><span class="sublink">
                                  <input name="job_mobile" type="text" class="txtbox1" tabindex="45" value="<?php echo($job_mobile); ?>" size="40">
      (Multiple nos seperated by comma[,]) </span></td>
                              </tr>
                            </table></td>
                            </tr>
                          <tr valign="top" id="tdaddr">
                            <td height="25" class="text"><div align="right">Address</div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                <tr>
                                  <td width="15%"><div align="right">Line1</div></td>
                                  <td width="2%">&nbsp;</td>
                                  <td width="83%"><input name="job_addr1" type="text" class="txtbox1" id="job_addr1" tabindex="9" value="<?php echo($vartxtjobaddr1); ?>" size="30"></td>
                                </tr>
                                <tr>
                                  <td><div align="right">Line2</div></td>
                                  <td>&nbsp;</td>
                                  <td><input name="job_addr2" type="text" class="txtbox1" id="job_addr2" tabindex="10" value="<?php echo($vartxtjobaddr2); ?>" size="30"></td>
                                </tr>
                                <tr>
                                  <td><div align="right">Line3</div></td>
                                  <td>&nbsp;</td>
                                  <td><input name="job_addr3" type="text" class="txtbox1" id="job_addr3" tabindex="11" value="<?php echo($vartxtjobaddr3); ?>" size="30"></td>
                                </tr>
                                <tr>
                                  <td><div align="right">Country</div></td>
                                  <td>&nbsp;</td>
                                  <td>
                                    <select name="job_country" class="txtbox1" id="job_country" tabindex="12" onchange="javascript:getJobState(this.value);">
                                      <option value=""> Select Country </option>
                                      <?php
										while($country = mysqli_fetch_array($chk_job_country))
										{
											if($country['country_id'] == $vartxtjobcountry)
											{
									 ?>
                                      <option value="<?php echo $country['country_id']; ?>" selected> <?php echo $country['country_name']; ?> </option>
                                      <?php }else{ ?>
                                      <option value="<?php echo $country['country_id']; ?>"> <?php echo $country['country_name']; ?> </option>
                                      <?php } } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td><div align="right">State</div></td>
                                  <td>&nbsp;</td>
                                  <td id="tdjstate">
                                    <select name="job_state" class="txtbox1" id="State " tabindex="13"/>
                                    
                                    <option value=""> Select State </option>
                                  </td>
                                </tr>
                                <tr>
                                  <td><div align="right">City/District</div></td>
                                  <td>&nbsp;</td>
                                  <td id="tdjcity">
                                    <select name="job_city" class="txtbox1" id="City " tabindex="14"/>
                                    
                                    <option value=""> Select City </option>
                                  </td>
                                </tr>
                                <tr>
                                  <td><div align="right">District</div></td>
                                  <td>&nbsp;</td>
                                  <td><input name="job_district" type="text" class="txtbox1" id="job_district" tabindex="15" value="<?php echo($vartxtjobdistrict); ?>" size="30" /></td>
                                </tr>
                                <tr>
                                  <td><div align="right">Pincode</div></td>
                                  <td>&nbsp;</td>
                                  <td><input name="job_pincode" type="text" class="txtbox1" id="job_pincode" tabindex="16" value="<?php echo($vartxtjobpincode); ?>" size="20"></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr valign="top">
                            <td height="10">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td colspan="5"><input type="submit" value="Submit" tabindex="46" width="71" height="24" border="0" onClick="javascript:return checkFormElements(this.form);"></td>
                          </tr>
                          <tr valign="top">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td colspan="5">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                  </table>
                </form></td>
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
<script language="javascript" type="text/javascript">
	showhideDiv("<?php echo $prof_type; ?>");

	var countrycode = "<?php echo $vartxtcountry; ?>";
	
	var statecode = "<?php echo $vartxtstate; ?>";
	getState(countrycode,statecode);

	var citycode = "<?php echo $vartxtcity; ?>";
	getCity(statecode,citycode);
	
	var bness_cat_id = "<?php echo $bness_cat_id; ?>";
	
	var prof_cat_id = "<?php echo $prof_cat_id; ?>";
	
	var prof_subcat_id = "<?php echo $prof_subcat_id; ?>";
	getSubCat(prof_cat_id,'','prof_subcat_id','tdprofcat',prof_subcat_id);
	
	getDet("<?php echo $vartxtedu_cat; ?>");
	
	var jobcountrycode = "<?php echo $vartxtjobcountry; ?>";
	
	var jobstatecode = "<?php echo $vartxtjobstate; ?>";
	getJobState(jobcountrycode,jobstatecode);

	var jobcitycode = "<?php echo $vartxtjobcity; ?>";
	getJobCity(jobstatecode,jobcitycode);
</script>

</body>
</html>