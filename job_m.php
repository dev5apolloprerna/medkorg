<?php

	session_start(); 
	include "noentry.php";
$txtDCode=$_SESSION['UserCode'];
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
			
		}
	}
}
else
{
	$vartxtCompName = $_POST["txtCompName"];
	$vartxtCompProfile = $_POST["txtCompProfile"];
	$vartxtIndustry = $_POST["txtIndustry"];
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
}
//-------------MODE A------------------------
if ($_POST)
{
	if ($_POST["txtMode"]=="A")
	{	
		
		$varCode = GetMaxNumber("search_jobs","req_no",$cn);
		$sql_string = "INSERT INTO search_jobs (req_no, company_name, company_profile, industry_vc, designation_vc, expertise_vc, exper_min, exper_max, login_id, location_vc, cand_profile, job_profile, compensation, con_person, con_no, user_email) VALUES (";
		
		$sql_string = $sql_string . $varCode . ",";
		$sql_string = $sql_string . "'". $vartxtCompName . "',";
		$sql_string = $sql_string . "'". $vartxtCompProfile . "',";
		$sql_string = $sql_string . "'". $vartxtIndustry . "',";
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
		$sql_string = $sql_string . "'". $txtUserEmail . "')";
		
		$check_res = mysqli_query($cn,$sql_string);
		
		closeconnection($cn);
		
		$redirect="list_job.php";
		header("Location: $redirect");
		exit;
	}
}

//--------------MODE E-----------------------

if ($_POST["txtMode"]=="EA")
{
	$sql_string = "UPDATE search_jobs SET company_name = '" .$vartxtCompName ."',";
	$sql_string = $sql_string ." company_profile = '" .$vartxtCompProfile ."',";
	$sql_string = $sql_string ." industry_vc = '" .$vartxtIndustry ."',";
	$sql_string = $sql_string ." designation_vc = '" .$vartxtDesignation ."',";
	$sql_string = $sql_string ." expertise_vc = '" .$vartxtExpertise ."',";
	$sql_string = $sql_string ." exper_min = " .$varselExMin .",";
	$sql_string = $sql_string ." exper_max = " .$varselExMax .",";
	$sql_string = $sql_string ." location_vc = '" .$vartxtLocation ."',";
	$sql_string = $sql_string ." cand_profile = '" .$vartxtCandProfile ."',";
	$sql_string = $sql_string ." job_profile = '" .$vartxtJobProfile ."',";
	$sql_string = $sql_string ." compensation = '" .$vartxtCompensation ."',";
	$sql_string = $sql_string ." con_person = '" .$vartxtContactPerson ."',";
	$sql_string = $sql_string ." con_no = '" .$vartxtContactNo ."'";

	$sql_string = $sql_string ." where req_no =" . $varCode ;
	
	$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$redirect="list_job.php";
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
<title>Shree Siddhi Group</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="js/datepickercontrol.js"></script>
<link type="text/css" rel="stylesheet" href="css/datepickercontrol.css"> 
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<script language="javascript" src="js/userjvalid.js"></script>
<script language="javascript" src="js/jvalid.js"></script>
<link href="css/rte.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="css/richtext.js"></script>
<script language="JavaScript" type="text/JavaScript">

function doSubmit()
{
	if(frm.txtCompProfile.value == "")
	{
		alert("Please enter profile");
		frm.txtCompProfile.focus();
		return false;
	}
	else if(frm.txtIndustry.value == "0")
	{
		alert("Please enter Industry");
		frm.txtIndustry.focus();
		return false;
	}
	else if(frm.txtDesignation.value == "")
	{
		alert("Please enter designation");
		frm.txtDesignation.focus();
		return false;
	}
	else if(frm.txtExpertise.value == "0")
	{
		alert("Please enter Expertise");
		frm.txtExpertise.focus();
		return false;
	}
	else if(frm.selExMin.value == "0")
	{
		alert("Please enter Experience");
		frm.selExMin.focus();
		return false;
	}
	else if(frm.selExMax.value == "0")
	{
		alert("Please enter Experience");
		frm.selExMax.focus();
		return false;
	}
	else if(frm.txtLocation.value == "")
	{
		alert("Please enter Location");
		frm.txtLocation.focus();
		return false;
	}
	else if(frm.txtCandProfile.value == "")
	{
		alert("Please enter Candidate Profile");
		frm.txtCandProfile.focus();
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
<body>
<!-- ImageReady Slices (01-modified.psd) -->
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" bgcolor="#4C4C4C"><table width="971" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#FFFFFF" ><a href="#"><img src="images/logo.gif" alt="" width="188" height="110" border="0" ></a></td>
      </tr>
      <tr>
        <td valign="top" background="images/page_bg.gif"><table width="945" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><table width="906" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr bgcolor="#063968">
                <td height="3"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td height="15"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td width="265" align="left" valign="top" style="background:url(images/login_btm_clr.gif) bottom left no-repeat #f6f6f6;">
				<?php include 'left.php';?>
				
				</td>
                <td width="15"></td>
                <td align="center" valign="top" style="border:1px solid #e4e1e1;">
				<table width="99%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                          <td height="25" bgcolor="#002F57" class="text style2">&nbsp;Job Master </td>
                        </tr>
						 <tr>
                          <td height="12"></td>
                        </tr>	
				  <tr>
                    <td align="center" valign="top">
					 <form name="frm" method="post"  >
							<input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
							<input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="2%">&nbsp;</td>
                                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr valign="top">
                                      <td width="32%" height="25" class="text"><div align="right">Company Name</div></td>
                                      <td width="1%" height="25">&nbsp;</td>
                                      <td width="67%" height="25" class="sublink"><input name="txtCompName" tabindex="1" type="text" class="txtbox1" value="<?php echo($vartxtCompName); ?>"></td>
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
	
															$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
															if (mysqli_num_rows($check_res)>0)
															{
																while ($rec = mysqli_fetch_array($check_res))
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
	
															$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
															if (mysqli_num_rows($check_res)>0)
															{
																while ($rec = mysqli_fetch_array($check_res))
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
                                      <td height="25" class="text"><div align="right">Compensation</div></td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25" class="sublink"><input name="txtCompensation" tabindex="11" type="text" class="txtbox1" value="<?php echo($vartxtCompensation); ?>"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text"><div align="right">Contact Person </div></td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25" class="sublink"><input name="txtContactPerson" tabindex="12" type="text" class="txtbox1" value="<?php echo($vartxtContactPerson); ?>"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text"><div align="right">Contact No </div></td>
                                      <td height="25">&nbsp;</td>
                                      <td height="25" class="sublink"><input name="txtContactNo" tabindex="13" type="text" class="txtbox1" value="<?php echo($vartxtContactNo); ?>"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="12" colspan="3" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td><input type="submit" name="btnadd" id="btnadd" value="Submit" style="cursor:pointer;" onClick="return doSubmit()" /><input type="button" name="btnadd2" id="btnadd2" value="Cancel" style="cursor:pointer;" onClick="window.location='list_job.php'" /></td>
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
                          </form>
					</td>
                  </tr>
                </table></td>
                <td valign="top" width="10">&nbsp;</td>
              </tr>
              <tr>
                <td height="15"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              
              
              <tr bgcolor="#063968">
                <td height="3"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td valign="top"><img src="images/page_bottom.gif" width="971" height="18" alt=""></td>
      </tr>
      <tr>
        <td height="44" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="22" colspan="2" valign="middle" class="footer"><div align="center"><a href="index.php" class="footerlink"> </a><a href="contactus.html" class="footerlink"></a></div></td>
          </tr>
          <tr>
            <td width="45%" height="22" valign="middle" class="footer">All Rights Reserved. Shree Siddhi Group/td>
            <td width="55%" height="22" valign="middle" class="footer"><div align="right">Website Designed By : <a href="https://apolloinfotech.com/" target="_blank" class="footerlink">Apollo Infotech</a></div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>