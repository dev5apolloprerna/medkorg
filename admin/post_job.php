<?php

	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	
	
	include "connection/conn.php";
	// require "noentry.php";
	// include "noentry.php";
//$cn = getConnection("localhost","career_career","!@#$%@@","career_searchjobs");
	//$cn = getConnection("localhost","root","","samaj");
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

//---------------QueryString-------------------
if ($varMode=="E")
{
	$sql_string = "SELECT * FROM search_jobs where req_no=". $varCode;
	
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
			$vartxtLogin = $rec['login_id'];
			$vartxtEmail = $rec['user_email'];
			$vartxtCompName = $rec['company_name'];
			$vartxtCompProfile = $rec['company_profile'];
			$vartxtIndustry = $rec['industry_vc'];
			$vartxtQualification = $rec['qualification_vc'];
			$vartxtDesignation = $rec['designation_vc'];
			$vartxtExpertise = $rec['expertise_vc'];
			$varselExMin = $rec['exper_min'];
			$varselExMax = $rec['exper_max'];
			$vartxtLocation = $rec['location_vc'];
			$vartxtCandProfile = $rec['cand_profile'];
			$vartxtJobProfile = $rec['job_profile'];
			$vartxtCompensation = $rec['compensation'];
			$vartxtContactPerson = $rec['con_person'];
			$vartxtContactNo = $rec['con_no'];
			$vartxtKeywords = $rec['keywords'];
		}
	}
}
else
{
	$vartxtCompName = $_POST["txtCompName"];
	$vartxtCompProfile = $_POST["txtCompProfile"];
	$vartxtIndustry = $_POST["txtIndustry"];
	$vartxtQualification = $_POST["txtQualification"];
	$vartxtDesignation = $_POST["txtDesignation"];
	$vartxtExpertise = $_POST["txtExpertise"];
	$varselExMin = $_POST["selExMin"];
	$varselExMax = $_POST["selExMax"];
	$vartxtLocation = $_POST["txtLocation"];
	$vartxtCandProfile = $_POST["txtCandProfile"];
	$vartxtJobProfile = $_POST["txtJobProfile"];
	$vartxtCompensation = $_POST["txtCompensation"];
	$vartxtContactPerson = $_POST["txtContactPerson"];
	$vartxtContactNo = $_POST["txtContactNo"];
	$vartxtKeywords = $_POST["txtKeywords"];
}
//-------------MODE A------------------------
if ($_POST)
{
	if ($_POST["txtMode"]=="A")
	{	
		
		$varCode = GetMaxNumber("search_jobs","req_no",$cn);
		$sql_string = "INSERT INTO search_jobs (req_no, company_name, company_profile, industry_vc, qualification_vc, designation_vc, expertise_vc, exper_min, exper_max, login_id, location_vc, cand_profile, job_profile, compensation, con_person, con_no, keywords, user_email) VALUES (";
		
		$sql_string = $sql_string . $varCode . ",";
		$sql_string = $sql_string . "'". $vartxtCompName . "',";
		$sql_string = $sql_string . "'". $vartxtCompProfile . "',";
		$sql_string = $sql_string . $vartxtIndustry . ",";
		$sql_string = $sql_string . $vartxtQualification . ",";
		$sql_string = $sql_string . "'". $vartxtDesignation . "',";
		$sql_string = $sql_string . "'". $vartxtExpertise . "',";
		$sql_string = $sql_string . $varselExMin . ",";
		$sql_string = $sql_string . $varselExMax . ",";
		$sql_string = $sql_string . $txtDCode . ",";
		$sql_string = $sql_string . "'". $vartxtLocation . "',";
		$sql_string = $sql_string . "'". $vartxtCandProfile . "',";
		$sql_string = $sql_string . "'". $vartxtJobProfile . "',";
		$sql_string = $sql_string . "'". $vartxtCompensation . "',";
		$sql_string = $sql_string . "'". $vartxtContactPerson . "',";
		$sql_string = $sql_string . "'". $vartxtContactNo . "',";
		$sql_string = $sql_string . "'". $vartxtKeywords . "',";
		$sql_string = $sql_string . "'". $txtUserEmail . "')";
		
		$check_res = mysqli_query($cn,$sql_string);
		
		closeconnection($cn);
		
		$redirect="job_list.php";
		header("Location: $redirect");
		exit;
	}
}

//--------------MODE E-----------------------

if ($_POST["txtMode"]=="EA")
{
	$sql_string = "UPDATE search_jobs SET company_name = '" .$vartxtCompName ."',";
	$sql_string = $sql_string ." company_profile = '" .$vartxtCompProfile ."',";
	$sql_string = $sql_string ." industry_vc = " .$vartxtIndustry .",";
	$sql_string = $sql_string ." qualification_vc = " .$vartxtQualification .",";
	$sql_string = $sql_string ." designation_vc = '" .$vartxtDesignation ."',";
	$sql_string = $sql_string ." expertise_vc = '" .$vartxtExpertise ."',";
	$sql_string = $sql_string ." exper_min = " .$varselExMin .",";
	$sql_string = $sql_string ." exper_max = " .$varselExMax .",";
	$sql_string = $sql_string ." location_vc = '" .$vartxtLocation ."',";
	$sql_string = $sql_string ." cand_profile = '" .$vartxtCandProfile ."',";
	$sql_string = $sql_string ." job_profile = '" .$vartxtJobProfile ."',";
	$sql_string = $sql_string ." compensation = '" .$vartxtCompensation ."',";
	$sql_string = $sql_string ." con_person = '" .$vartxtContactPerson ."',";
	$sql_string = $sql_string ." keywords = '" .$vartxtKeywords ."',";
	$sql_string = $sql_string ." con_no = '" .$vartxtContactNo ."'";

	$sql_string = $sql_string ." where req_no =" . $varCode ;
	
	$check_res = mysql_query($sql_string,$cn) or die(mysql_error($cn));
	
	$redirect="job_list.php";
	header("Location: $redirect");

}

//------------FUNCTION-----------------------
function GetMaxNumber($TableName,$FieldName,$cn)
{
	$sql_string = "SELECT Max(" . $FieldName . ") 'col' FROM " . $TableName;
	$check_res = mysql_query($sql_string,$cn) or die(mysql_error($cn));

	if (mysql_num_rows($check_res)>=1)
	{
		$rec = mysql_fetch_array($check_res);
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
	if(frm.txtCompProfile.value == "")
	{
		alert("Please enter profile");
		frm.txtCompProfile.focus();
	}
	else if(frm.txtIndustry.value == "0")
	{
		alert("Please enter Industry");
		frm.txtIndustry.focus();
	}
	else if(frm.txtDesignation.value == "")
	{
		alert("Please enter designation");
		frm.txtDesignation.focus();
	}
	else if(frm.txtExpertise.value == "0")
	{
		alert("Please enter Expertise");
		frm.txtExpertise.focus();
	}
	else if(frm.selExMin.value == "0")
	{
		alert("Please enter Experience");
		frm.selExMin.focus();
	}
	else if(frm.selExMax.value == "0")
	{
		alert("Please enter Experience");
		frm.selExMax.focus();
	}
	else if(frm.txtLocation.value == "")
	{
		alert("Please enter Location");
		frm.txtLocation.focus();
	}
	else if(frm.txtCandProfile.value == "")
	{
		alert("Please enter Candidate Profile");
		frm.txtCandProfile.focus();
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
                <td width="30%" rowspan="4" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
                <td background="images/grey_bg.gif">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr valign="top">
                <td background="images/grey_bg.gif">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="h1">&nbsp;</td>
              </tr>
              <tr valign="top">
                <td background="images/grey_bg.gif">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="h1" style="padding-left:25px;">Job Master </td>
              </tr>
              <tr valign="top">
                <td width="1%" background="images/grey_bg.gif">&nbsp;</td>
                <td width="0%">&nbsp;</td>
                <td width="69%"><form name="frm" method="post" action="post_job.php">
                  <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                  <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                      <td width="2%">&nbsp;</td>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr valign="top">
                            <td width="16%" height="25" class="text"><div align="right">Company Name</div></td>
                            <td width="1%" height="25">&nbsp;</td>
                            <td width="83%" height="25" class="sublink"><input name="txtCompName" tabindex="1" type="text" class="txtbox1" value="<?php echo($vartxtCompName); ?>"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Company Profile<font color="#FF0000">*</font></div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink"><textarea name="txtCompProfile" cols="30" rows="4" class="txtbox1" tabindex="2"><?php echo($vartxtCompProfile); ?></textarea></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Industry<font color="#FF0000">*</font></div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink">
                              <select name="txtIndustry" tabindex="3" class="txtbox">
                                <option value="0" selected>Industry Type</option>
                                <?php
															$sql_string = "SELECT * FROM industry_m";
	
															$check_res = mysql_query($sql_string,$cn) or die(mysql_error($cn));
															if (mysql_num_rows($check_res)>0)
															{
																while ($rec = mysql_fetch_array($check_res))
																{
																	if ($vartxtIndustry == $rec['ind_id'])
																		echo ("<option selected value ='". $rec['ind_id'] ."'>". $rec['ind_value'] ."</option>");
																	else
																		echo ("<option value='". $rec['ind_id'] ."'>". $rec['ind_value'] ."</option>");
																}	
															}
														?>
                            </select></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Qualification<font color="#FF0000">*</font></div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink">
                              <select name="txtQualification" tabindex="3" class="txtbox">
                                <option value="0" selected>Qualification</option>
                                <?php
															$sql_string = "SELECT * FROM qualification_m";
	
															$check_res = mysql_query($sql_string,$cn) or die(mysql_error($cn));
															if (mysql_num_rows($check_res)>0)
															{
																while ($rec = mysql_fetch_array($check_res))
																{
																	if ($vartxtQualification == $rec['qual_id'])
																		echo ("<option selected value ='". $rec['qual_id'] ."'>". $rec['qual_value'] ."</option>");
																	else
																		echo ("<option value='". $rec['qual_id'] ."'>". $rec['qual_value'] ."</option>");
																}	
															}
														?>
                            </select></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Designation<font color="#FF0000">*</font></div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink"><input name="txtDesignation" tabindex="4" type="text" class="txtbox1" value="<?php echo($vartxtDesignation); ?>"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Expertise<font color="#FF0000">*</font></div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink">
                              <select name="txtExpertise" tabindex="5" class="txtbox">
                                <option value="0" selected>Functional Value</option>
                                <?php
															$sql_string = "SELECT * FROM functional_m";
	
															$check_res = mysql_query($sql_string,$cn) or die(mysql_error($cn));
															if (mysql_num_rows($check_res)>0)
															{
																while ($rec = mysql_fetch_array($check_res))
																{
																	if ($vartxtExpertise == $rec['fun_id'])
																		echo ("<option selected value='". $rec['fun_id'] ."'>". $rec['fun_value'] ."</option>");
																	else
																		echo ("<option value='". $rec['fun_id'] ."'>". $rec['fun_value'] ."</option>");
																	
																}	
															}
														?>
                            </select></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Experience<font color="#FF0000">*</font></div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink">
                              <SELECT name="selExMin" class="txtbox" tabindex="6">
                                <option value="0" selected>Min</option>
                                <?php
										for ($varDay = 1;$varDay <= 30;$varDay++)
										{
											if ($varDay == $varselExMin)
												echo ("<option selected>$varDay</option>");
											else
												echo ("<option>$varDay</option>");
										}
					 
								  ?>
                              </SELECT>
              -
              <SELECT name="selExMax" class="txtbox" tabindex="7">
                <option value="0" selected>Max</option>
                <?php
										for ($varDay = 1;$varDay <= 50;$varDay++)
										{
											if ($varDay == $varselExMax)
												echo ("<option selected>$varDay</option>");
											else
												echo ("<option>$varDay</option>");
										}
					 
								  ?>
            </SELECT></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Location<font color="#FF0000">*</font></div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink"><textarea name="txtLocation" cols="30" rows="4" class="txtbox1" tabindex="8"><?php echo($vartxtLocation); ?></textarea></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Candidata Profile<font color="#FF0000">*</font> </div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink"><textarea name="txtCandProfile" cols="30" rows="4" class="txtbox1" tabindex="9"><?php echo($vartxtCandProfile); ?></textarea></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Job Profile </div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink"><textarea name="txtJobProfile" cols="30" rows="4" class="txtbox1" tabindex="10"><?php echo($vartxtJobProfile); ?></textarea></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Key Words </div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink"><textarea name="txtKeywords" cols="30" rows="4" class="txtbox1" tabindex="11"><?php echo($vartxtKeywords); ?></textarea></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Compensation</div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink"><input name="txtCompensation" tabindex="12" type="text" class="txtbox1" value="<?php echo($vartxtCompensation); ?>"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Contact Person </div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink"><input name="txtContactPerson" tabindex="13" type="text" class="txtbox1" value="<?php echo($vartxtContactPerson); ?>"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right">Contact No </div></td>
                            <td height="25">&nbsp;</td>
                            <td height="25" class="sublink"><input name="txtContactNo" tabindex="14" type="text" class="txtbox1" value="<?php echo($vartxtContactNo); ?>"></td>
                          </tr>
                          <tr valign="top">
                            <td height="12" colspan="3" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input type="button" value="Submit" tabindex="15" width="71" height="24" border="0" onClick="javascript:return doSubmit();"></td>
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