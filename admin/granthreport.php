<?php
// require 'noentry.php';
require 'connection/conn.php';
session_start();

// Query for Country//
	$sql_country = "SELECT * FROM country_m order by country_name";
	$chk_country = mysqli_query($cn,$sql_country);

	// Query for State//
	$sql_state = "SELECT * FROM state_m order by state_name";
	$chk_state = mysqli_query($cn,$sql_state);
	
	
	// Query for State//
	$sql_city = "SELECT * FROM city_m order by city_name";
	$chk_city = mysqli_query($cn,$sql_city);
	$tmp_city = mysqli_fetch_array($chk_city);

	// Query for Blood Group//
	$sql_bloodgroup = "select distinct blood_group from vastipatrak_m where blood_group not in ('0',' ') order by blood_group";
	$chk_bg = mysqli_query($cn,$sql_bloodgroup);

	// Query for Village data //
	$sql_vill = "select * from village_m order by village_name";
	$chk_vill = mysqli_query($cn,$sql_vill);
	
	// Query for Village gotra //
	$sql_gotra = "select * from gotra_m order by gotra_name";
	$chk_gotra = mysqli_query($cn,$sql_gotra);
	
	$sql_string = "SELECT * FROM bdir_category where cat_type='B' and main_id=0 and group_name!='Root' order by group_name";
	$check_cat = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

	$sql_string = "SELECT * FROM industry_m order by ind_value";
	$check_ind = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM bdir_category where cat_type='J' and main_id=0 and group_name!='Root' order by group_name";
	$check_jobtype = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM industry_m order by ind_value";
	$check_ind_job = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM bdir_category where cat_type='P' and main_id=0 and group_name!='Root' order by group_name";
	$check_cat1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
	$sql_string = "SELECT * FROM education_m where edu_level='Basic/Grad.' order by education_name";
	$chk_edu_det1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

	$sql_string = "SELECT * FROM education_m where edu_level='PG' order by education_name";
	$chk_edu_det2 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

	$sql_string = "SELECT * FROM education_m where edu_level='Doctrate' order by education_name";
	$chk_edu_det3 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

	// Query for Marital Status //
	$sql_maritalst = "select * from marital_m order by marital_id";
	$chk_maritalst = mysqli_query($cn,$sql_maritalst);	
	
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
	/*if(frm.selpage.value =="0")
	{
		alert("Please select Page");
		frm.selpage.focus();
		return false;
	}
	else
	*/{
		if(frm.txtMode.value == "E" || frm.txtMode.value == "EA")
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
<script language="javascript" src="ckeditor/ckeditor.js"></script>
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
-->
</style>

<script language="javascript" type="text/javascript">
	function showhideFields(val)
	{
		if(val == 'IS')
		{
			document.getElementById("prof_det").style.display = "";
			document.getElementById("extra_det").style.display = "";
		}
		else
		{
			document.getElementById("prof_det").style.display = "none";
			document.getElementById("extra_det").style.display = "none";
		}
	}
	
	function showhideDiv(val)
	{
		if(val == "" || val=="U")
		{
			document.getElementById("trbusiness").style.display = "none";
			document.getElementById("trprof").style.display = "none";
			document.getElementById("trjob").style.display = "none";
		}
		if(val == "B")
		{
			document.getElementById("trbusiness").style.display = "";
			document.getElementById("trprof").style.display = "none";
			document.getElementById("trjob").style.display = "none";
		}
		if(val == "P")
		{
			document.getElementById("trbusiness").style.display = "none";
			document.getElementById("trprof").style.display = "";
			document.getElementById("trjob").style.display = "none";
		}
		if(val == "J")
		{
			document.getElementById("trbusiness").style.display = "none";
			document.getElementById("trprof").style.display = "none";
			document.getElementById("trjob").style.display = "";
		}
	}

</script>
<script type="text/javascript" src="js/ajax.js"></script> 
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
                              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td class="h1">&nbsp;</td>
                                  <td width="69%">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="h1">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="h1">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="31%" class="h1" style="padding-left:25px; ">Search Records for CSV </td>
                                  <td><div align="right"> </div></td>
                                </tr>
                              </table>
                          </div></td>
                        </tr>
                        <tr>
                          <td class="text_bold_head"><div align="left"></div></td>
                        </tr>
                        <tr>
                          <td class="text_bold_head">
						  		
								<form name="frmSearch" method="post" action="granthreport_result.php" target="_blank">
							<table width="98%"  border="0" cellspacing="0" cellpadding="0">
							  <tr class="text">
							    <td height="20" colspan="3" class="text_bold_head" style="padding-left:5px; font-weight: bold;">&nbsp;</td>
							    </tr>
							  <tr bgcolor="#fbfbfb" class="text">
                                <td height="20" colspan="3" class="text_bold_head" style="padding-left:5px; font-weight: bold;">Personal Details</td>
							    </tr>
							  <tr bgcolor="#fbfbfb" class="text" >
                                <td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
							    </tr>
                              <tr class="text4_user">
                                <td height="30" colspan="3" class="text4_user"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="70%" valign="top" style="padding-top:10px;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Search By</div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td width="81%" class="text4_user">
                                          <select name="selSearchType" onChange="showhideFields(this.value)">
                                            <option value="HOF" <?php echo isset($_SESSION['selSearchType']) == "HOF"?"selected":""; ?>> Head of Family </option>
                                            <!--<option value="IS" <?php echo isset($_SESSION['selSearchType']) == "IS"?"selected":""; ?>> Search All </option>-->
                                          </select>
                                        </td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Current Country </div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text2">
                                          <select name="country" id="country" style="width:150px;" onChange="getState(this.value,<?php echo $_SESSION['UserState']; ?>);">
                                            <option value="">Any Country</option>
                                            <?php
											while($country = mysqli_fetch_array($chk_country))
											{
												if($_SESSION['country'] == $country['country_id'] || $_SESSION["UserCounrry"] == $country['country_id'])
												{
										 ?>
                                            <option value="<?php echo $country['country_id']; ?>" > <?php echo $country['country_name']; ?> </option>
                                            <?php 
											} else { 
										  ?>
                                            <option value="<?php echo $country['country_id']; ?>"> <?php echo $country['country_name']; ?> </option>
                                            <?php } } ?>
                                            <option value="1000">Outside India</option>
                                          </select>
                                        </span></td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Current State </div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user" > <span class="text2">
                                          <select name="state" id="tdstate" style="width:150px;" onChange="javascript:getCity(this.value,'<?=$_SESSION["UserState"]?>');">
                                            <option value="">Any State</option>
                                            <?php
											while($state = mysqli_fetch_array($chk_state))
											{
												if($_SESSION['state'] == $state['state_id'] || $_SESSION["UserState"] == $state['state_id'])
												{
										 ?>
                                            <option value="<?php echo $state['state_id']; ?>" > <?php echo $state['state_name']; ?> </option>
                                            <?php 
											} else { 
										  ?>
                                            <option value="<?php echo $state['state_id']; ?>"> <?php echo $state['state_name']; ?> </option>
                                            <?php } } ?>
                                          </select>
                                        </span></td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Current City </div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user" id="tdcity"> <span class="text2">
                                          <select name="city" id="city" style="width:150px;">
                                            <option value="" selected="selected">Any City</option>
                                            <?php
											while($city = mysqli_fetch_array($chk_city))
											{
												if($_SESSION['city'] == $city['city_id'] || $_SESSION["UserCity"] == $city['city_id'])
												{
										 ?>
                                            <option value="<?php echo $city['city_id']; ?>" > <?php echo $city['city_name']; ?> </option>
                                            <?php 
											} else { 
										  ?>
                                            <option value="<?php echo $city['city_id']; ?>"> <?php echo $city['city_name']; ?> </option>
                                            <?php } } ?>
                                          </select>
                                        </span></td>
                                      </tr>
                                      <tr valign="top" class="text4_user">
                                        <td width="18%" height="30" class="text"><div align="right" class="style3">Village (Native Place) </div></td>
                                        <td width="1%" class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text2">
                                          <?php 
									  	$vill_arr = array();
									  	if(isset($_SESSION['village_id'])!=""){ 
											$vill_arr = explode(",",$_SESSION['village_id']);
										}
										
									   ?>
                                          <select name="village_id[]" size="5" multiple="multiple" style="width:200px;">
                                            <option value=""> Any Village </option>
                                            <?php
											while($vill = mysqli_fetch_array($chk_vill))
											{
										  ?>
                                            <option value="<?php echo $vill['village_id']; ?>" <?php if(in_array($vill['village_id'],$vill_arr)){ ?> selected="selected" <?php }else{ echo ""; } ?>> <?php echo $vill['village_name']; ?> </option>
                                            <?php } ?>
                                          </select>
                                        </span> </td>
                                      </tr>
                                      <tr valign="top" class="text4_user">
                                        <td height="3" colspan="3" class="text"></td>
                                      </tr>
                                      <tr valign="top" class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Gotra</div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text2">
                                          <?php 
									  	$gotra_arr = array();
									  	if(isset($_SESSION['gotra_id'])!=""){ 
											$gotra_arr = explode(",",$_SESSION['gotra_id']);
										}
										
									   ?>
                                          <select name="gotra_id[]" size="5" multiple="multiple" style="width:200px;">
                                            <option value=""> Any Gotra </option>
                                            <?php
											while($gotra = mysqli_fetch_array($chk_gotra))
											{
										 ?>
                                            <option value="<?php echo $gotra['gotra_id']; ?>" <?php if(in_array($gotra['gotra_id'],$gotra_arr)){ ?> selected="selected" <?php }else{ echo ""; } ?>> <?php echo $gotra['gotra_name']; ?> </option>
                                            <?php } ?>
                                          </select>
                                        </span> </td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Search By Form No.</div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> 
										  <span class="text2">
                                          	<input type="text" name="frm_no1" value="<?php echo isset($_SESSION['frm_no1']) ?$_SESSION['frm_no1'] :""; ?>" /> to&nbsp; <input type="text" name="frm_no2" value="<?php echo isset($_SESSION['frm_no2']) ? $_SESSION['frm_no2'] :""; ?>" />
                                          </span> 
										</td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">First Name </div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text2">
                                          <input type="text" name="fname_vc" value="<?php echo isset($_SESSION['fname_vc']) ? $_SESSION['fname_vc'] :""; ?>" />
                                        </span> </td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Last Name </div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text2">
                                          <input type="text" name="lname_vc" value="<?php echo isset($_SESSION['lname_vc']) ?$_SESSION['lname_vc'] :""; ?>" />
                                        </span> </td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right"><span class="style3">Blood Group </span></div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"><span class="text2">
                                          <select name="blood_group">
                                            <option value="" selected="selected">Any Blood Group</option>
                                            <?php
										while($blood_group = mysqli_fetch_array($chk_bg))
										{
											if($_SESSION['blood_group'] == $blood_group['blood_group'])
											{
										?>
                                            <option value="<?php echo $blood_group['blood_group']; ?>" selected="selected"> <?php echo $blood_group['blood_group']; ?> </option>
                                            <?php 
											} else{ 
										  ?>
                                            <option value="<?php echo $blood_group['blood_group']; ?>"> <?php echo $blood_group['blood_group']; ?> </option>
                                            <?php 
											} } 
										  ?>
                                          </select>
                                        </span></td>
                                      </tr>
                                    </table></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr class="text4_user" id="extra_det" style="display:none;">
                                    <td width="100%" height="15" colspan="3" valign="top" class="text4_user"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Email Id</div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text2">
                                          <input name="email" type="text" id="email" value="<?php echo $_SESSION['email']; ?>" />
                                        </span> </td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td width="18%" height="30" class="text"><div align="right" class="text style3">Age</div></td>
                                        <td width="1%" class="text4_user">&nbsp;</td>
                                        <td width="81%" class="text4_user">
                                          <span class="text2">
											  <select name="age_from" id="age_from">
                                                <option value="0" selected="selected">From Age</option>
												<?php 
													$i = 0;
													for($i=1; $i <= 100; $i++){
												 ?>
                                                	<option value="<?php echo($i); ?>" <?php echo ($_SESSION['age_from'] == $i)?"selected":""; ?>><?php echo($i); ?></option>
												<?php 
													}
												 ?>
											</select>
&nbsp; </span>
										  <span class="text">to&nbsp;</span>
										  <span class="text2">											        
											  
                                              <select name="age_to" id="age_to">
                                                <option value="100" selected="selected">To Age</option>
												<?php 
													$i = 0;
													for($i=1; $i <= 100; $i++){
												 ?>
                                                	<option value="<?php echo($i); ?>" <?php echo ($_SESSION['age_to'] == $i)?"selected":""; ?> ><?php echo($i); ?></option>
												<?php 
													}
												 ?>
											</select>
</span>										</td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Gender</div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text2">
                                          <select name="gender_c">
										  	<option value="" selected="selected">Any Gender</option>
										  	<option value="Male" <?php echo ($_SESSION['gender_c'] == "Male")?"selected":""; ?> >Male</option>
										  	<option value="Female" <?php echo ($_SESSION['gender_c'] == "Female")?"selected":""; ?> >Female</option>
										  </select>
                                        </span> </td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Marital Status</div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text2">
                                          <select name="marital_id">
                                            <option value="" selected="selected">Any Marital Status </option>
											<?php
												while($ms = mysqli_fetch_array($chk_maritalst))
												{
													if($_SESSION['marital_id'] == $ms['marital_id'])
													{
											 ?>
                                            	<option value="<?php echo $ms['marital_id']; ?>" selected><?php echo $ms['marital_name']; ?></option>
											<?php } else { ?>
                                            	<option value="<?php echo $ms['marital_id']; ?>"><?php echo $ms['marital_name']; ?></option>
											<?php } } ?>
                                          </select>
                                        </span> </td>
                                      </tr>
                                      <tr class="text">
                                        <td height="20" colspan="3" class="text" style="padding-left:5px;">&nbsp;</td>
                                      </tr>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td height="20" colspan="3" class="text_bold_head" style="padding-left:5px;; color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Qualification  Details</td>
                                      </tr>
                                      <tr bgcolor="#fbfbfb" class="text" >
                                        <td colspan="3" class="text" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Basic/Graduation</div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text">
                                          <select name="basic_qual" id="basic_qual" tabindex="11" class="txtbox1">
                                            <option value=""> Not Specified </option>
                                            <?php
																	while($edu_det1 = mysqli_fetch_array($chk_edu_det1))
																	{
																		if($_SESSION['basic_qual'] == $edu_det1['education_id'])
																		{
																	?>
                                            <option value="<?php echo $edu_det1['education_id']; ?>" selected="selected"> <?php echo $edu_det1['education_name']; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $edu_det1['education_id']; ?>"> <?php echo $edu_det1['education_name']; ?></option>
                                            <?php } } ?>
                                          </select>
                                        </span><span class="text2">                                        </span> </td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right" class="style3">Post Graduation</div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"> <span class="text2">
                                          <span class="text">
                                          <select name="pg_qual" id="pg_qual" tabindex="11" class="txtbox1">
                                            <option value=""> Not Specified </option>
                                            <?php
																	while($edu_det2 = mysqli_fetch_array($chk_edu_det2))
																	{
																		if($_SESSION['pg_qual'] == $edu_det2['education_id'])
																		{
																	?>
                                            <option value="<?php echo $edu_det2['education_id']; ?>" selected="selected"> <?php echo $edu_det2['education_name']; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $edu_det2['education_id']; ?>"> <?php echo $edu_det2['education_name']; ?></option>
                                            <?php } } ?>
                                          </select>
                                          </span>                                        </span> </td>
                                      </tr>
                                      <tr class="text4_user">
                                        <td height="30" class="text"><div align="right"><span class="style3">Doctrate</span></div></td>
                                        <td class="text4_user">&nbsp;</td>
                                        <td class="text4_user"><span class="text">
                                          <select name="doc_qual" id="doc_qual" tabindex="11" class="txtbox1">
                                            <option value=""> Not Specified </option>
                                            <?php
																	while($edu_det3 = mysqli_fetch_array($chk_edu_det3))
																	{
																		if($_SESSION['doc_qual'] == $edu_det3['education_id'])
																		{
																	?>
                                            <option value="<?php echo $edu_det3['education_id']; ?>" selected="selected"> <?php echo $edu_det3['education_name']; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $edu_det3['education_id']; ?>"> <?php echo $edu_det3['education_name']; ?></option>
                                            <?php } } ?>
                                          </select>
                                        </span></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                               <tr id="prof_det" class="text4_user" style="display:none;">
                                <td height="30" colspan="3" class="text4_user"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><table width="98%"  border="0" cellspacing="0">
                                      <tr class="text">
                                        <td height="20" colspan="3" class="text_user" style="padding-left:5px;">&nbsp;</td>
                                      </tr>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td height="20" colspan="3" class="text_bold_head" style="padding-left:5px;">Professional Details</td>
                                      </tr>
                                      <tr class="text" >
                                        <td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                      </tr>
                                      <tr bgcolor="#FFFFFF" class="text">
                                        <td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><div align="right">Type</div></td>
                                        <td width="1%" class="text_user">&nbsp;</td>
                                        <td width="81%" class="text_user"><span class="sublink">
                                          <select name="prof_type" onChange="showhideDiv(this.value)">
                                            <option value="" selected="selected"> Please Select </option>
                                            <option value="U" <?php echo ($_SESSION['prof_type'] == "U")?"selected":""; ?>> Unemployed </option>
                                            <option value="B" <?php echo ($_SESSION['prof_type'] == "B")?"selected":""; ?>> Business </option>
                                            <option value="P" <?php echo ($_SESSION['prof_type'] == "P")?"selected":""; ?>> Profession </option>
                                            <option value="J" <?php echo ($_SESSION['prof_type'] == "J")?"selected":""; ?>> Job </option>
                                          </select>
                                        </span></td>
                                      </tr>
                                      <tr bgcolor="#FFFFFF" class="text" id="trbusiness" style="display:none;">
                                        <td height="30" colspan="3" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="25" valign="top" class="text"><div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Business Category</div></td>
                                              <td>&nbsp;</td>
                                              <td height="25"><span class="sublink">
                                                <select name="bness_cat_id" tabindex="28">
                                                  <option value=""> Please Select </option>
                                                  <?php
														while($cat = mysqli_fetch_array($check_cat))
														{
															if($_SESSION['bness_cat_id'] == $cat['sub_id'])
															{
													 ?>
															  <option value="<?php echo $cat['sub_id']; ?>" selected="selected"> <?php echo $cat['group_name']; ?> </option>
															  <?php 	} else { ?>
															  <option value="<?php echo $cat['sub_id']; ?>"> <?php echo $cat['group_name']; ?> </option>
															  <?php
														} }
													 ?>
                                                </select>
                                              </span></td>
                                            </tr>
                                            <tr>
                                              <td height="25" valign="top" class="text"><div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Industry</div></td>
                                              <td id="tdsubcat">&nbsp;</td>
                                              <td height="25" id="tdsubcat"><span class="sublink">
                                                <select name="bness_subcat_id" tabindex="29">
                                                  <option value=""> Please Select </option>
                                                  <?php
														while($ind = mysqli_fetch_array($check_ind))
														{
															if($_SESSION['bness_subcat_id'] == $ind['ind_id'])
															{
													 ?>
															  <option value="<?php echo $ind['ind_id']; ?>" selected="selected"> <?php echo $ind['ind_value']; ?> </option>
															  <?php 	} else { ?>
															  <option value="<?php echo $ind['ind_id']; ?>"> <?php echo $ind['ind_value']; ?> </option>
															  <?php
														} }
													 ?>
                                                </select>
                                              </span></td>
                                            </tr>
                                            <tr bgcolor="#FFFFFF" class="text">
                                              <td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><div align="right">Business Name </div></td>
                                              <td width="1%" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
                                              <td width="83%" class="text_user"><span class="sublink">
                                                <input name="bness_name" type="text" class="txtbox1" tabindex="1" value="<?php echo $_SESSION['bness_name']; ?>" size="50" />
                                              </span></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr bgcolor="#FFFFFF" class="text" id="trprof" style="display:none;">
                                        <td height="30" colspan="3" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <tr bgcolor="#FFFFFF" class="text">
                                              <td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><div align="right">Profession Name </div></td>
                                              <td width="1%" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
                                              <td width="83%" class="text_user"><span class="sublink">
                                                <select name="prof_cat_id" onChange="getSubCat(this.value,'','prof_subcat_id','tdprofcat');">
                                                  <option value=""> Please Select </option>
                                                  <?php
																while($prof = mysqli_fetch_array($check_cat1))
																{
																	if($_SESSION['prof_cat_id'] == $prof['sub_id'])
																	{
															 ?>
                                                  <option value="<?php echo $prof['sub_id']; ?>" selected="selected"> <?php echo $prof['group_name']; ?> </option>
                                                  <?php 	} else { ?>
                                                  <option value="<?php echo $prof['sub_id']; ?>"> <?php echo $prof['group_name']; ?> </option>
                                                  <?php
																} }
															 ?>
                                                </select>
                                              </span></td>
                                            </tr>
                                            <tr bgcolor="#FFFFFF" class="text">
                                              <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><div align="right">Specialization</div></td>
                                              <td bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
                                              <td class="text_user" id="tdprofcat"><span class="sublink">
                                                <select name="prof_subcat_id">
                                                  <option value=""> Please Select </option>
                                                </select>
                                              </span></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr bgcolor="#FFFFFF" class="text" id="trjob" style="display:none;">
                                        <td height="30" colspan="3" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="25" valign="top" class="text"><div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Job Type </div></td>
                                              <td>&nbsp;</td>
                                              <td height="25"><span class="sublink">
                                                <select name="job_type" tabindex="28">
                                                  <option value=""> Please Select </option>
                                                  <?php
														while($jobtype = mysqli_fetch_array($check_jobtype))
														{
															if($_SESSION['job_type'] == $jobtype['sub_id'])
															{
													 ?>
															  <option value="<?php echo $jobtype['sub_id']; ?>" selected="selected"> <?php echo $jobtype['group_name']; ?> </option>
															  <?php 	} else { ?>
															  <option value="<?php echo $jobtype['sub_id']; ?>"> <?php echo $jobtype['group_name']; ?> </option>
															  <?php
														} }
													 ?>
                                                </select>
                                              </span></td>
                                            </tr>
                                            <tr>
                                              <td height="25" valign="top" class="text"><div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Industry</div></td>
                                              <td id="tdsubcat">&nbsp;</td>
                                              <td height="25" id="tdsubcat"><span class="sublink">
                                                <select name="job_ind_id" tabindex="29">
                                                  <option value=""> Please Select </option>
                                                  <?php
														while($j_ind = mysqli_fetch_array($check_ind_job))
														{
															if($_SESSION['job_ind_id'] == $j_ind['ind_id'])
															{
													 ?>
															  <option value="<?php echo $j_ind['ind_id']; ?>" selected="selected"> <?php echo $j_ind['ind_value']; ?> </option>
															  <?php 	} else { ?>
															  <option value="<?php echo $j_ind['ind_id']; ?>"> <?php echo $j_ind['ind_value']; ?> </option>
															  <?php
														} }
													 ?>
                                                </select>
                                              </span></td>
                                            </tr>
                                            <tr bgcolor="#FFFFFF" class="text">
                                              <td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><div align="right">Company Name </div></td>
                                              <td width="1%" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
                                              <td width="84%" class="text_user"><span class="sublink">
                                                <input name="comp_name" type="text" class="txtbox1" tabindex="1" value="<?php echo($_SESSION['comp_name']); ?>" size="50" />
                                              </span></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                                </tr>
                              <tr class="text4_user">
                                <td height="30" class="text4_user">&nbsp;</td>
                              <td width="1%" height="30" class="text4_user">&nbsp;</td>
                                <td width="81%" height="30" class="text4_user"><input type="submit" value="Click here to Search"></td>
                              </tr>
                            </table>
							</form>	
						  
						  
						  </td>
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
<script>
	showhideFields('<?php echo $_SESSION["selSearchType"]; ?>');
	
	var bness_cat_id = "<?php echo $_SESSION['bness_cat_id']; ?>";
	
	var prof_cat_id = "<?php echo $_SESSION['prof_cat_id']; ?>";
	
	var prof_subcat_id = "<?php echo $_SESSION['prof_subcat_id']; ?>";
	getSubCat(prof_cat_id,'','prof_subcat_id','tdprofcat',prof_subcat_id);
		
	showhideDiv("<?php echo $_SESSION['prof_type']; ?>");
	
</script>
<!-- End ImageReady Slices --> 
</body>
</html>
