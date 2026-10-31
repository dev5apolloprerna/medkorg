<?php
include "connection/conn.php";
	require "noentry.php";
include "noentry.php";
	
require 'include/appmain.php';
require 'utility/querygen.inc';

$oQGen = new CQueryGen();
$oQGen1 = new CQueryGen();
	
session_start();
$memberimgpath = "images/vastipatrak/thumb/";
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

$sql_string = "SELECT * FROM education_m where edu_level='Basic/Grad.' order by education_id";
$chk_edu_det1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='PG' order by education_id";
$chk_edu_det2 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Doctrate' order by education_id";
$chk_edu_det3 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
//---------------QueryString-------------------
$sql_string = "SELECT v.*, 
				country.country_name,state.state_name,city.city_name,
				vill.village_name,gotra.gotra_name,
				marital.marital_name,
				edu_basic.education_name as basic_qual_name,edu_pg.education_name as pg_qual_name,edu_phd.education_name as doc_qual_name
				
				 FROM vastipatrak_m v 
				 
				 left outer join country_m country on v.country = country.country_id
				 left outer join state_m state on v.state = state.state_id
				 left outer join city_m city on v.city = city.city_id
				 left outer join village_m vill on v.village_id = vill.village_id
				 left outer join gotra_m gotra on v.gotra_id = gotra.gotra_id
				 left outer join marital_m marital on v.marital_id = marital.marital_id
				 
				 left outer join education_m edu_basic on v.basic_qual = edu_basic.education_id
				 left outer join education_m edu_pg on v.pg_qual = edu_pg.education_id
				 left outer join education_m edu_phd on v.doc_qual = edu_phd.education_id
				 
				  where v.vasti_id=". $_GET['id'];
				  
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
		
		$vartxtVillage = $rec['village_name'];
		$vartxtGotra = $rec['gotra_name'];
		
		$vartxtaddr1 = $rec['addr1'];
		$vartxtaddr2 = $rec['addr2'];
		$vartxtaddr3 = $rec['addr3'];
		
		$vartxtcountry = $rec['country'];
		$vartxtcountryname = $rec['country_name'];
		
		$vartxtstate = $rec['state'];
		$vartxtstatename = $rec['state_name'];
		
		$vartxtcity = $rec['city'];
		$vartxtcityname = $rec['city_name'];
		
		$vartxtdistrict = $rec['district'];
		$vartxtpincode = $rec['pincode'];
		
		$vartxtFName = $rec['fname_vc'];
		$vartxtMName = $rec['mname_vc'];
		$vartxtLName = $rec['lname_vc'];
		
		$varGender = $rec['gender_c'];
		
		$sel_relation = $rec['sel_relation'];
		
		$vartxtMarital = $rec['marital_name'];
		
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
		
		$vartxtbasic_qual = $rec['basic_qual_name'];
		$vartxtpg_qual = $rec['pg_qual_name'];
		$vartxtdoc_qual = $rec['doc_qual_name'];
		$vartxtbq_det = $rec['bq_det'];
		$vartxtpg_det = $rec['pg_det'];
		$vartxtdoc_det = $rec['doc_det'];
		
		$member_image = $rec['thumb_image'];
	}
}
	
$sql_string1 = "SELECT bdir.*,
				jcountry.country_name,jstate.state_name,jcity.city_name
				
				 FROM businessdir_m bdir 
				 
				 left outer join country_m jcountry on bdir.job_country = jcountry.country_id
				 left outer join state_m jstate on bdir.job_state = jstate.state_id
				 left outer join city_m jcity on bdir.job_city = jcity.city_id
				 
				 where bdir.vasti_id=". $_GET['id'];
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
		$vartxtjobcountry = $rec1['country_name'];
		$vartxtjobstate = $rec1['state_name'];
		$vartxtjobcity = $rec1['city_name'];
		$vartxtjobdistrict = $rec1['job_district'];
		$vartxtjobpincode = $rec1['job_pincode'];
	}
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
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td class="h1"><span class="h1">Members Profile Preview</span></td>
              </tr>
              <tr valign="top">
                <td width="69%">
				 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                      <td width="2%">&nbsp;</td>
                      <td width="77%"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="text">
                        <tr valign="top" bgcolor="#eaeaea">
                          <td height="10" colspan="7" class="text_bold_head">Personal Details</td>
                        </tr>
                        <tr valign="top">
                          <td height="8" colspan="7" class="text"></td>
                        </tr>
                        <tr valign="top">
                          <td width="29%" height="25" class="text"><div align="right"><strong>Form No. <font color="#FF0000">*</font></strong></div></td>
                          <td height="25"><div align="center">:</div></td>
                          <td width="69%" height="25" class="text">
	                          <?php echo $vartxtformno; ?>
						  </td>
                        </tr>
                        <tr valign="top">
                          <td height="8" class="text"></td>
                          <td height="8"></td>
                          <td height="8" class="text"></td>
                        </tr>
						<tr valign="top">
                          <td height="25" class="text"><div align="right"><strong>Native Place<font color="#FF0000">*</font></strong></div></td>
                          <td width="2%" height="25"><div align="center">:</div></td>
                          <td height="25" colspan="5" class="text">
    			              <?php
									echo $vartxtVillage;
							   ?>
                          </td>
                        </tr>
                        <tr valign="top">
                          <td height="8" class="text"></td>
                          <td height="8"></td>
                          <td height="8" colspan="5" class="text"></td>
                        </tr>
                        <tr valign="top">
                          <td height="25" class="text"><div align="right"><strong>Gotra<font color="#FF0000">*</font></strong></div></td>
                          <td height="25"><div align="center">:</div></td>
                          <td height="25" colspan="5" class="text">
                          	<?php
									echo $vartxtGotra;
							   ?>
						  </td>
                        </tr>
                        <tr valign="top">
                          <td height="8" class="text"></td>
                          <td height="8"></td>
                          <td height="8" colspan="5" class="text"></td>
                        </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Name<font color="#FF0000">*</font></strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="text"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                              <tr>
                                <td width="75%" class="text"><?php echo($vartxtFName); ?> <?php echo($vartxtMName); ?> <?php echo($vartxtLName); ?></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Gender<font color="#FF0000">*</font></strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="text">
                              <?php echo $varGender; ?> 
                            </td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Address</strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="text"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                              <tr>
                                <td width="75%"><?php echo($vartxtaddr1); ?></td>
                              </tr>
                              <tr>
                                <td><?php echo($vartxtaddr2); ?></td>
                              </tr>
                              <tr>
                                <td><?php echo($vartxtaddr3); ?></td>
                              </tr>
                              <tr>
                                <td>
									<?php
										echo $vartxtcountryname;
							   		 ?>							    
								</td>
                              </tr>
                              <tr>
                                <td>
                                	<?php
										echo $vartxtstatename;
							   		 ?>	
								</td>
                              </tr>
                              <tr>
                                <td>
                                	<?php
										echo $vartxtcityname;
							   		 ?>	
								</td>
                              </tr>
                              <tr>
                                <td><?php echo($vartxtdistrict); ?></td>
                              </tr>
                              <tr>
                                <td><?php echo($vartxtpincode); ?></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="12" colspan="5" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Marital Status<font color="#FF0000">*</font></strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="text">
                            	<?php
									echo $vartxtMarital;
							   	 ?>	
							</td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Birth Date </strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="text"><?php echo(date('d-m-Y',strtotime($vartxtDate))); ?></td>
                            </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Age</strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td colspan="5" class="text"><?php echo($vartxtAge); ?></td>
                            </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Blood Group</strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="text">
								<?php echo($vartxtBloodgroup); ?>
							</td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Education</strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="4" class="text"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="44%"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="62%"><div align="right" class="text"><strong>Basic/Graduation</strong></div></td>
                                    <td width="12%">&nbsp;</td>
                                    <td width="26%" height="30" class="text">
										<?php echo ($vartxtbasic_qual); ?>                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="30"><div align="right" class="text"><strong>Post Graduation </strong></div></td>
                                    <td>&nbsp;</td>
                                    <td class="text">
										<?php echo $vartxtpg_qual; ?>                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="30"><div align="right" class="text"><strong>Doctrate</strong></div></td>
                                    <td>&nbsp;</td>
                                    <td class="text">
									    <?php echo $vartxtdoc_qual; ?>
									</td>
                                  </tr>
                                </table></td>
                                <td width="36%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="30" class="text"><?php echo($vartxtbq_det); ?>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="30" class="text"><?php echo($vartxtpg_det); ?>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="30" class="text"><?php echo($vartxtdoc_det); ?>&nbsp;</td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="text"></td>
                          </tr>
                          <tr valign="top" bgcolor="#eaeaea">
                            <td height="10" colspan="7" class="text_bold_head">Communication Details</td>
                          </tr>
                          <tr valign="top">
                            <td height="8" colspan="7" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Phone Number(L.L.)</strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><?php echo($vartxtcode_phone_number); ?> -&nbsp; <?php echo($vartxtphone_number); ?> </td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Alternate Number</strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"> <?php echo($vartxtcode_alt_number); ?> -&nbsp; <?php echo($vartxtalt_number); ?> </td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Mobile(Home)</strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><?php echo($vartxtmobile_home); ?></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Alternate Mobile</strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><?php echo($vartxtalt_mobile); ?></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" class="text"><div align="right"><strong>Email ID </strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><?php echo $vartxtEmail; ?></td>
                          </tr>
                          <tr valign="top">
                            <td height="8" class="text"></td>
                            <td height="8"></td>
                            <td height="8" colspan="5" class="sublink"></td>
                          </tr>
                          <tr valign="top" bgcolor="#eaeaea">
                            <td height="10" colspan="7" class="text_bold_head">Member of </td>
                          </tr>
                          <tr valign="top">
                            <td height="8" colspan="7" class="text"></td>
                          </tr>
                          <tr valign="top">
                            <td height="25" colspan="7" valign="top" class="text"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="8%" valign="top" class="sublink">&nbsp;</td>
                                <td valign="top" class="text"><div align="left"><strong>Committee Name </strong></div></td>
                                <td width="25%" valign="top" class="sublink"><div align="center" class="text"><strong>Code</strong></div></td>
                                <td width="8%">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3" valign="top" class="sublink">
                                  <?php
								$sql_comm = "select * from mem_committee order by comm_id_int";
								$chk_comm = mysqli_query($cn,$sql_comm);
								$comm_cnt=1;
								while($committee = mysqli_fetch_array($chk_comm))
								{
							 ?>
                                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr align="center">
                                      <td width="8%" height="30" class="text"><?php echo $comm_cnt; ?>.</td>
                                      <td width="65%" align="left" class="text"> <?php echo $committee['comm_name_vc']; ?>
                                          <div align="justify"></div></td>
                                      <td width="27%">
                                        <input name="txtCommCode[]" type="text" size="10">
                                      </td>
                                    </tr>
                                  </table>
                                  <?php $comm_cnt++; } ?>
                                </td>
                                <td>&nbsp;</td>
                                </tr>
                            </table></td>
                            </tr>
                          <tr valign="top">
                            <td height="8" colspan="2" valign="middle" class="text"></td>
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
                                <td width="19%" height="10" valign="top" class="text"><div align="right"><strong>Type</strong></div></td>
                                <td width="2%" height="25" valign="top"><div align="center">:</div></td>
                                <td width="79%" height="25" valign="top" class="text">
									  <span class="sublink">
											<?php echo ($prof_type); ?>
                                	  </span>								  
								</td>
                              </tr>
							  <tr id="trbusiness" style="display:none;">
                                <td height="25" colspan="3" valign="top" class="text"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="text">
                                  <tr>
                                    <td width="19%" height="10" valign="top" class="text"><div align="right"><strong>Business Category</strong></div></td>
                                    <td width="2%" height="25" valign="top"><div align="center">:</div></td>
                                    <td width="79%" height="25" valign="top"><span class="sublink">
                                        <?php echo ($bness_cat_id); ?>
                                    </span></td>
                                  </tr>
                                  <tr>
                                    <td height="10" valign="top" class="text"><div align="right"><strong>Industry</strong></div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25" valign="top" id="tdsubcat"><span class="sublink">
                                      <?php echo $bness_subcat_id; ?>
                                    </span></td>
                                  </tr>
                                  <tr>
                                    <td height="10" valign="top" class="text"><div align="right"><strong>Business Name </strong></div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25" valign="top"><span class="sublink">
                                      <?php echo($bness_name); ?>
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
                                    <td height="10" valign="top" class="text"><div align="right"><strong>Phone No</strong></div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25" valign="top" class="text">
                                      <?php echo($bness_phone); ?>									</td>
                                  </tr>
                                  <tr>
                                    <td height="10" valign="top" class="text"><div align="right"><strong>Mobile No. </strong></div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25" valign="top" class="text"><span class="sublink">
                                     <?php echo($bness_mobile); ?> </span></td>
                                  </tr>
                                  <tr>
                                    <td height="10" valign="top" class="text"><div align="right"><strong>Description</strong></div></td>
                                    <td height="25" valign="top"><div align="center">:</div></td>
                                    <td height="25" valign="top" class="text"><span class="sublink">
                                      <?php echo($bness_desc); ?> </span></td>
                                  </tr>
                                </table></td>
                                </tr>
                            </table></td></tr>
                          <tr valign="top" id="trprof" style="display:none;">
                            <td height="10" colspan="7"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="text">
                              <tr>
                                <td width="19%" height="10" valign="top" class="text"><div align="right"><strong>Profession Name</strong></div></td>
                                <td width="2%" height="25" valign="top"><div align="center">:</div></td>
                                <td width="79%" height="25" valign="top"><span class="sublink">
                                    <?php echo $prof_cat_id; ?>
                                </span></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right"><strong>Specialization</strong></div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" valign="top" id="tdprofcat"><span class="sublink">
                                    <?php echo $prof_subcat_id; ?>
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
                                <td height="10" valign="top" class="text"><div align="right"><strong>Phone No</strong></div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" valign="top" class="text">
                                  <?php echo($prof_phone); ?> </td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right"><strong>Mobile No. </strong></div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" valign="top" class="text"><span class="sublink">
                                  <?php echo($prof_mobile); ?> </span></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right"><strong>Description</strong></div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" valign="top" class="text"><span class="sublink">
                                  <?php echo($prof_desc); ?>
                                </span></td>
                              </tr>
                            </table></td>
                            </tr>
                          <tr valign="top" id="trjob" style="display:none;">
                            <td height="10" colspan="7"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="text">
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right"><strong>Job Type </strong></div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" valign="top"><span class="sublink">
                                    <?php echo $job_type; ?>
                                </span></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right"><strong>Industry</strong></div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" valign="top" id="tdsubcat"><span class="sublink">
                                    <?php echo $job_ind_id; ?>
                                </span></td>
                              </tr>
                              <tr>
                                <td width="19%" height="10" valign="top" class="text"><div align="right"><strong>Company Name</strong></div></td>
                                <td width="2%" height="25" valign="top"><div align="center">:</div></td>
                                <td width="79%" height="25" valign="top"><span class="sublink">
                                  <?php echo($comp_name); ?></span></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right"><strong>Designation</strong></div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" valign="top"><span class="sublink">
                                  <?php echo($job_desig); ?>
                                </span></td>
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
                                <td height="10" valign="top" class="text"><div align="right"><strong>Phone No</strong></div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" valign="top" class="text">
                                  <?php echo($job_phone); ?>								</td>
                              </tr>
                              <tr>
                                <td height="10" valign="top" class="text"><div align="right"><strong>Mobile No. </strong></div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25" valign="top" class="text"><span class="sublink">
                                  <?php echo($job_mobile); ?>
      							</span></td>
                              </tr>
                            </table></td>
                            </tr>
                          <tr valign="top" id="tdaddr">
                            <td height="25" class="text"><div align="right"><strong>Address</strong></div></td>
                            <td height="25"><div align="center">:</div></td>
                            <td height="25" colspan="5" class="sublink"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                <tr>
                                  <td width="83%" height="20" class="text"><?php echo($vartxtjobaddr1); ?></td>
                                </tr>
                                <tr>
                                  <td height="20" class="text"><?php echo($vartxtjobaddr2); ?></td>
                                </tr>
                                <tr>
                                  <td height="20" class="text"><?php echo($vartxtjobaddr3); ?></td>
                                </tr>
                                <tr>
                                  <td height="20" class="text">
                                      <?php echo $vartxtjobcountry; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td height="20" class="text">
                                    <?php echo $vartxtjobstate; ?>
								  </td>
                                </tr>
                                <tr>
                                  <td height="20" class="text">
                                    <?php echo $vartxtjobcity; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td height="20" class="text"><?php echo($vartxtjobdistrict); ?></td>
                                </tr>
                                <tr>
                                  <td height="20" class="text"><?php echo($vartxtjobpincode); ?></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <?php
					  	if(file_exists($memberimgpath.$member_image) && $member_image!="")
							$src = $memberimgpath.$member_image;
						else
							$src = "images/no-user-image.jpg";	 
					  ?>
					  <td width="21%"> <div align="center"><img src="<?php echo $src; ?>" width="100" height="101"> </div></td>
                    </tr>
                  </table>                </td>
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
	
	getDet("<?php echo $vartxtbasic_qual; ?>",'bq_det','bq_det');
	
	getDet("<?php echo $vartxtpg_qual; ?>",'pg_det','pg_det');
	
	getDet("<?php echo $vartxtdoc_qual; ?>",'doc_det','doc_det');
	
	
</script>

</body>
</html>