<?php
include "connection/conn.php";
// require "noentry.php";
// include "noentry.php";

$ProdThumbImgDir = "images/vastipatrak/thumb/";
$ProdLargeImgDir = "images/vastipatrak/attachment/";

session_start();
$txtDCode = $_SESSION["UserAdminCode"];
$txtUserEmail = $_SESSION["UserAdminEmail"];

if ($_SESSION["UserAdminCode"] == "") {
	$redirect = "index.php";
	header("Location: $redirect");
}

if (isset($_POST["vasti_id"]) == "") {
	$varCode = isset($_GET['Code']) ? $_GET['Code'] : '';
} else {

	$varCode = $_POST['vasti_id'];
}

if ($_GET['level'] != "") {
	$level = $_GET['level'];
} else {
	$level = "";
}

if ($_GET['HCode'] != "") {
	$hcode = $_GET['HCode'];
} else {
	$hcode = "";
}

if (isset($_GET['Mode'])) {
	$mode = $_GET['Mode'];
} else {
	$mode = "A";
}

//$cn = getConnection("localhost","career_career","!@#$%@@","career_searchjobs");
//$cn = getConnection("localhost","root","","samaj");		
$varFieldtag = "";
if (isset($_POST["selfilter"]) <> "") {
	$varFieldTag = $_POST["selfilter"];
}

$varFieldValue = "";
if (isset($_POST["txtfiltername"]) <> "") {
	$varFieldValue = $_POST["txtfiltername"];
}

$sql_string = "SELECT * FROM bdir_category where cat_type='B' and main_id=0 and group_name!='Root' order by sub_id";
$check_cat = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM industry_m order by ind_id";
$check_ind = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM bdir_category where cat_type='P' and main_id=0 and group_name!='Root' order by sub_id";
$check_cat1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM bdir_category where cat_type='J' and main_id=0 and group_name!='Root' order by sub_id";
$check_jobtype = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM industry_m order by ind_id";
$check_ind_job = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM country_m order by country_name";
$chk_job_country = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Basic/Grad.' order by education_id asc";
$chk_edu_det1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='PG' order by education_id asc";
$chk_edu_det2 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Doctrate' order by education_id asc";
$chk_edu_det3 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

if ($mode == "E") {

	$sql_string = "SELECT * FROM vastipatrak_m v left outer join marital_m m on v.marital_id = m.marital_id where v.vasti_id=" . $varCode;

	$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
	if (mysqli_num_rows($check_res) != 1) {
		echo ("No rows in the database to display");
		exit;
	} else {
		while ($rec = mysqli_fetch_array($check_res)) {

			$parent_id = $rec['parent_id'];

			$vartxtVillage = $rec['village_id'];
			$vartxtGotra = $rec['gotra_id'];

			$vartxtaddr1 = $rec['addr1'];
			$vartxtaddr2 = $rec['addr2'];
			$vartxtaddr3 = $rec['addr3'];
			$vartxtcountry = $rec['country'];
			$vartxtstate = $rec['state'];
			$vartxtcity = $rec['city'];
			$vartxtpincode = $rec['pincode'];

			$vartxtFName = $rec['fname_vc'];
			$vartxtMName = $rec['mname_vc'];
			$vartxtLName = $rec['lname_vc'];

			$varGender = $rec['gender_c'];

			$sel_relation = $rec['sel_relation'];

			$vartxtMarital = $rec['marital_id'];
			$vartxtMaritalName = $rec['marital_name'];

			$vartxtMobile = $rec['mobile_number'];
			$vartxtEmail = $rec['email'];

			$vartxtRelation = $rec['relation_id'];

			$vartxtDate = $rec['birth_date'];
			$vartxtAge = $rec['age'];

			$vartxtBloodgroup = $rec['blood_group'];

			$vartxtedu_cat = $rec['edu_cat'];
			$vartxtEduBasic = $rec['edu_basic'];
			$vartxtEduSub = $rec['edu_sub'];

			$anc_id = $rec['anc_id'];

			$vartxtbasic_qual = $rec['basic_qual'];
			$vartxtpg_qual = $rec['pg_qual'];
			$vartxtdoc_qual = $rec['doc_qual'];
			$vartxtbq_det = $rec['bq_det'];
			$vartxtpg_det = $rec['pg_det'];
			$vartxtdoc_det = $rec['doc_det'];

			$vartxtmobile_home = $rec['mobile_home'];
			$vartxtmobile_bness = $rec['alt_mobile'];
		}
	}

	$sql_string1 = "SELECT * FROM businessdir_m where vasti_id=" . $varCode;
	$check_res1 = mysqli_query($cn, $sql_string1);
	if (mysqli_num_rows($check_res1) >= 1) {
		while ($rec1 = mysqli_fetch_array($check_res1)) {
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


if ($_POST) {
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

	if ($_POST["txtMode"] == "D") {
		//$sql_string = "DELETE FROM vastipatrak_m WHERE vasti_id = (" . $_POST["txtDCode"] . ")";
		//$check_res = mysql_query($sql_string,$cn) or die(mysql_error($cn));

		$page = "family_details.php";
		$redirect = "vastipatrak_changes_notification.php?code=" . $_POST["txtDCode"] . "&page=" . $page . "&HCode=" . $hcode . "&level=" . $level . "&mode=D";

		header("Location: " . $redirect);
		exit;
	}
}

if ($_GET['level'] == "2") {
	$sqlextra = " where v.lineage=0 and v.parent_id=" . $hcode;
} else {
	$sqlextra = " where v.lineage=0 ";
}

$sql_string = "SELECT v.*,v1.fname_vc as fname_par,v1.mname_vc as mname_par,v1.lname_vc as lname_par,r.relation_name, country.call_code_vc as vcall_code_vc 
FROM vastipatrak_m v 
left outer join vastipatrak_m v1 on v.parent_id = v1.vasti_id
left outer join country_m country on v1.country = country.country_id 
left outer join relation_m r on v.relation_id = r.relation_id 
$sqlextra order by v.vasti_id";
$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
$row_cnt = mysqli_num_rows($check_res);
?>
<html>

<head>
	<title>Samaj</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
	<script type='text/JavaScript' src='js/scw.js'></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/userjvalid.js"></script>
	<script language="javascript" type="text/javascript">
		function showhideDiv(val) {
			if (val == "" || val == "H" || val == "S" || val == "R") {
				document.getElementById("trbusiness").style.display = "none";
				document.getElementById("trprof").style.display = "none";
				document.getElementById("trjob").style.display = "none";
				document.getElementById("tdaddr").style.display = "none";
			}
			if (val == "B") {
				document.getElementById("trbusiness").style.display = "";
				document.getElementById("trprof").style.display = "none";
				document.getElementById("trjob").style.display = "none";
				document.getElementById("tdaddr").style.display = "";
			}
			if (val == "P") {
				document.getElementById("trbusiness").style.display = "none";
				document.getElementById("trprof").style.display = "";
				document.getElementById("trjob").style.display = "none";
				document.getElementById("tdaddr").style.display = "";
			}
			if (val == "J") {
				document.getElementById("trbusiness").style.display = "none";
				document.getElementById("trprof").style.display = "none";
				document.getElementById("trjob").style.display = "";
				document.getElementById("tdaddr").style.display = "";
			}
		}
	</script>

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
	<style type="text/css">
		<!--
		body {
			background-color: #666666;
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
		}

		.style6 {
			color: #B90200;
			font-family: Arial, Helvetica, sans-serif;
			font-weight: bolder;
		}
		-->
	</style>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top" bgcolor="#FFFFFF">
							<blockquote>
								<p><span class="style6">
										<font size="+2" class="style6"><br>
											Administration Panel<br>
											<br>
										</font>
									</span></p>
							</blockquote>
						</td>
					</tr>
					<tr>
						<td valign="top" background="images/link-bg.gif"><img src="images/link-bg.gif" width="5" height="2"></td>
					</tr>
					<tr>
						<td height="8" valign="top"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top">
							<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr valign="top">
												<td width="25%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr valign="top">
												<td>&nbsp;</td>
												<td class="h1"><span class="h1">VastiPatrak List </span></td>
											</tr>

											<tr valign="top">
												<td width="1%">&nbsp;</td>
												<td width="85%">
													<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr valign="top">
															<td>
																&nbsp;
															</td>
															<td class="text">
																<div align="left"><b>
																		<?php
																		$mainUserDetail = mysqli_fetch_assoc(mysqli_query($cn, "select * from vastipatrak_m where vasti_id=" . $_REQUEST['HCode']));
																		echo "Head of the family :-  " . ($mainUserDetail['fname_vc'] . " " . $mainUserDetail['mname_vc'] . " " . $mainUserDetail['lname_vc']);
																		?>
																	</b>
																</div>
																<div align="right">
																	<!--<a href="familydet_m.php?Mode=A&HCode=<?php echo $hcode; ?>&level=<?php echo $level; ?>" class="link">Add</a> | --> <a href="vastipatrak_list.php" class="link">Back</a>

																</div>
															</td>
														</tr>

														<tr valign="top">
															<td width="2%">&nbsp;</td>
															<td>
																<form name="frm" method="Post" action="family_details.php?HCode=<?php echo $hcode; ?>&level=<?php echo $level; ?>">
																	<input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>" />
																	<input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>" />
																	<input type="hidden" name="txtDCode" value="" />
																	<table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
																		<tr valign="middle" bgcolor="#4C6B83">

																			<td width="20%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><strong>Full Name </strong></font>
																				</div>
																			</td>
																			<td width="8%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><b>Relation with HOF </b></font>
																				</div>
																			</td>
																			<td width="8%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><b>D.O.B</b></font>
																				</div>
																			</td>
																			<td width="8%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><b>Mobile</b></font>
																				</div>
																			</td>
																			<td width="8%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><b>Login-Id</b></font>
																				</div>
																			</td>
																			<td width="8%" bgcolor="#161709" class="text">&nbsp;</td>
																		</tr>
																		<?php
																		while ($rec = mysqli_fetch_array($check_res)) {
																		?>
																			<tr valign="middle">


																				<td class="text"><?php echo ($rec['fname_vc'] . " " . $rec['mname_vc'] . " " . $rec['lname_vc']); ?>&nbsp;</td>
																				<td class="text"><?php echo ($rec['relation_name']); ?>&nbsp;</td>
																				<td class="text"><?php echo (date('d-m-Y', strtotime($rec['birth_date']))); ?>&nbsp;<br>
																					<?php
																					if ($rec['lineage'] == 1 && $rec['death_date'] != '') {
																						echo 'Death Date:' . $rec['death_date'];
																					}
																					?>
																				</td>
																				<td class="text"><?php
																									if ($rec['vcall_code_vc'] != "" && $rec['mobile_number'] != "") {
																										echo ($rec['vcall_code_vc'] . "&nbsp;" . $rec['mobile_number']);
																									} else {
																										echo ($rec['mobile_number']);
																									}
																									?>&nbsp;</td>
																				<td class="text"><?php echo ($rec['mobile_home']); ?>&nbsp;</td>
																				<td class="text">
																					<a href="family_details.php?Code=<?php echo ($rec['vasti_id']); ?>&Mode=E&HCode=<?php echo $hcode; ?>&level=<?php echo $level; ?>" class="sublink"> Edit </a>
																					|
																					<a href="javascript:doDelete(<?php echo ($rec['vasti_id']); ?>);" class="sublink">Delete</a>
																					|
																					<?php if($rec['lineage'] == 0) { ?>
																					<a href="move_to_ancestor.php?HCode=<?php echo ($rec['vasti_id']); ?>" class="sublink">set Ancestor</a>
																					<?php } ?>
																				</td>
																			</tr>
																		<?php
																		}
																		?>
																	</table>
																</form>
															</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td align="right"><a href="family_member_list.php?vid=<?=$_GET['HCode']?>">Add From Existing Family</a></td>
														</tr>
														<?php

														?>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td>
																			<form name="frmFDetails" method="post" action="familydet_m.php?HCode=<?php echo $hcode; ?>&level=<?php echo $level; ?>&Mode=<?php echo $mode; ?>" enctype="multipart/form-data">
																				<input type="hidden" name="txtMode" value="<?php echo $mode; ?>">
																				<input type="hidden" name="vasti_id" value="<?php echo $varCode; ?>">
																				<input type="hidden" name="form_no" value="<?php echo isset($form_no) ? $form_no : ""; ?>">
																				<input type="hidden" id="DPC_TODAY_TEXT" value="today">
																				<input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
																				<input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
																				<input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
																				<input type="hidden" name="parent_id" value="<?php echo $hcode; ?>">
																				<input type="hidden" name="anc_id" value="<?php echo $hcode; ?>">
																				<input type="hidden" name="mstatus" id="mstatus" value="">
																				<input type="hidden" name="reg_date" id="reg_date" value="<?php echo (date('Y-m-d h:i:s')); ?>">

																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
																					<tr valign="top">
																						<td width="2%">&nbsp;</td>
																						<td>
																							<table width="100%" border="0" cellspacing="0" cellpadding="0">
																								<tr valign="top">
																									<td width="16%" height="25" class="text">
																										<div align="right">First Name<font color="#FF0000">*</font>
																										</div>
																									</td>
																									<td width="2%" height="25">
																										<div align="center">:</div>
																									</td>
																									<td width="82%" height="25" class="text_bold"><input name="fname_vc" type="text" class="txtreqd txtbox1" id="First Name " tabindex="1" value="<?php echo isset($vartxtFName) ? $vartxtFName : ''; ?>" size="30"> </td>
																								</tr>

																								<tr valign="top">
																									<td width="16%" height="25" class="text">
																										<div align="right">Middle Name<font color="#FF0000">*</font>
																										</div>
																									</td>
																									<td width="2%" height="25">
																										<div align="center">:</div>
																									</td>
																									<td width="82%" height="25" class="text_bold"><input name="mname_vc" type="text" class="txtreqd txtbox2" id="Middle Name " tabindex="1" value="<?php echo isset($vartxtMName) ? $vartxtMName : ''; ?>" size="30"> </td>
																								</tr>

																								<tr valign="top">
																									<td width="16%" height="25" class="text">
																										<div align="right">Last Name<font color="#FF0000">*</font>
																										</div>
																									</td>
																									<td width="2%" height="25">
																										<div align="center">:</div>
																									</td>
																									<td width="82%" height="25" class="text_bold"><input name="lname_vc" type="text" class="txtreqd txtbox1" id="Last Name " tabindex="1" value="<?php echo isset($vartxtLName) ? $vartxtLName : ''; ?>" size="30"> </td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<!--
<tr valign="top">
<td height="10" class="text"><div align="right">Address</div></td>
<td height="25"><div align="center">:</div></td>
<td height="25" class="sublink"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text">
<tr>
<td width="15%"><div align="right">Line1</div></td>
<td width="2%">&nbsp;</td>
<td width="83%"><input name="addr1" type="text" class="txtbox1" id="addr1" tabindex="1" value="<?php echo ($vartxtaddr1); ?>" size="30"></td>
</tr>
<tr>
<td><div align="right">Line2</div></td>
<td>&nbsp;</td>
<td><input name="addr2" type="text" class="txtbox1" id="addr2" tabindex="1" value="<?php echo ($vartxtaddr2); ?>" size="30"></td>
</tr>
<tr>
<td><div align="right">Line3</div></td>
<td>&nbsp;</td>
<td><input name="addr3" type="text" class="txtbox1" id="addr3" tabindex="1" value="<?php echo ($vartxtaddr3); ?>" size="30"></td>
</tr>
<tr>
<td><div align="right">Country</div></td>
<td>&nbsp;</td>
<td><input name="country" type="text" class="txtbox1" id="country" tabindex="1" value="<?php echo ($vartxtcountry); ?>" size="30"></td>
</tr>
<tr>
<td><div align="right">State</div></td>
<td>&nbsp;</td>
<td><input name="state" type="text" class="txtbox1" id="state" tabindex="1" value="<?php echo ($vartxtstate); ?>" size="30"></td>
</tr>
<tr>
<td><div align="right">City/District</div></td>
<td>&nbsp;</td>
<td><input name="city" type="text" class="txtbox1" id="city" tabindex="1" value="<?php echo ($vartxtcity); ?>" size="30"></td>
</tr>
<tr>
<td><div align="right">Pincode</div></td>
<td>&nbsp;</td>
<td><input name="pincode" type="text" class="txtbox1" id="pincode" tabindex="1" value="<?php echo ($vartxtpincode); ?>" size="20"></td>
</tr>
</table></td>
</tr>
<tr valign="top">
<td height="8" class="text"></td>
<td height="8"></td>
<td height="8" class="sublink"></td>
</tr>
-->
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Relation with HOF<font color="#FF0000">*</font>
																										</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink">
																										<select name="relation_id" tabindex="2" id="Relation with HOF" class="txtrequiredsel txtbox">
																											<option value="0" selected>Please Select</option>
																											<?php
																											$sql_string = "SELECT * FROM relation_m";

																											$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
																											if (mysqli_num_rows($check_res) > 0) {
																												while ($rec = mysqli_fetch_array($check_res)) {
																													if ($vartxtRelation == $rec['relation_id'])
																														echo ("<option selected value ='" . $rec['relation_id'] . "'>" . $rec['relation_name'] . "</option>");
																													else
																														echo ("<option value='" . $rec['relation_id'] . "'>" . $rec['relation_name'] . "</option>");
																												}
																											}
																											?>
																										</select>
																									</td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Marital Status<font color="#FF0000">*</font>
																										</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink">
																										<script language="javascript" type="text/javascript">
																											function getCmbName1(m) {
																												if (m != "")
																													document.getElementById("mstatus").value = m;

																												m = document.getElementById("mstatus").value;

																												function getRadioValue(RadioName) {
																													var colRadio = document.getElementsByName(RadioName);
																													for (var i = 0; i < colRadio.length; i++) {
																														if (colRadio[i].checked) {
																															return colRadio[i].value;
																														}
																													}
																													return null;
																												}
																												vValue = getRadioValue("gender_c");

																												if (vValue == 'Female' && m == 'Married') {
																													document.getElementById("tr_husband_link").innerHTML = "Link to Husband";
																													document.getElementById("tr_fam_link").style.display = "";
																												} else if (m == 'Widow') {
																													document.getElementById("tr_fam_link").style.display = "none";
																												} else {
																													document.getElementById("tr_husband_link").innerHTML = "Link to Father";
																													document.getElementById("tr_fam_link").style.display = "";
																												}

																											}
																										</script>
																										<select name="marital_id" tabindex="3" id="Marital Status" class="txtrequiredsel txtbox" onChange="getCmbName1(this.options[this.selectedIndex].innerHTML);">
																											<option value="0" selected>Please Select</option>
																											<?php
																											$sql_string = "SELECT * FROM marital_m";

																											$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
																											if (mysqli_num_rows($check_res) > 0) {
																												while ($rec = mysqli_fetch_array($check_res)) {
																													if ($vartxtMarital == $rec['marital_id']) {
																											?>
																														<option selected value="<?php echo $rec['marital_id']; ?>"> <?php echo $rec['marital_name']; ?> </option>
																													<?php 	} else { ?>
																														<option value="<?php echo $rec['marital_id']; ?>"> <?php echo $rec['marital_name']; ?> </option>
																												<?php }
																												} ?>
																											<?php
																											}
																											?>
																										</select>
																									</td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Gender<font color="#FF0000">*</font>
																										</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="text">
																										<input type="radio" name="gender_c" tabindex="4" value="Male" id="gender_c" class="txtreqd" <?php echo ($mode == "E" && $varGender == "Male" ) ? "checked" : ""; ?> onClick="getCmbName1('');" />
																										Male
																										<input type="radio" name="gender_c" tabindex="4" value="Female" id="gender_c" class="txtreqd" <?php echo ($mode == "E" && $varGender == "Female" )  ? "checked" : ""; ?> onClick="getCmbName1('');" />
																										Female
																									</td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Mobile</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink"><input name="mobile_number" type="text" class="txtbox1" tabindex="6" value="<?php echo isset($vartxtMobile) ? $vartxtMobile : ''; ?>" size="50"></td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Email-Id</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink"><input name="email" type="text" class="txtbox1" tabindex="7" value="<?php echo isset($vartxtEmail) ? $vartxtEmail : ''; ?>" size="50"></td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Birth Date </div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink"><input type="text" name="birth_date" class="txtbox" id="birth_date" tabindex="8" value="<?php echo isset($vartxtDate) ? $vartxtDate : ''; ?>" />&nbsp;<img src="images/calendar_icon.png" width="15" height="20" onclick='scwShow(document.getElementById("birth_date"),event);' style="cursor:pointer;"></td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Age</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td class="text"><input name="age" type="text" class="txtbox" id="Age " tabindex="9" value="<?php echo isset($vartxtAge) ? $vartxtAge : ''; ?>" size="10" />
																										(Enter Age of the person in case birthdate is not available)</td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Blood Group</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink"><select name="blood_group" tabindex="10" class="txtbox1">
																											<option value="0" selected>Please Select</option>
																											<option value="A +ve" <?php echo isset($vartxtBloodgroup) == "A +ve" ? "selected" : ""; ?>> A +ve </option>
																											<option value="A -ve" <?php echo isset($vartxtBloodgroup) == "A -ve" ? "selected" : ""; ?>> A -ve </option>
																											<option value="B +ve" <?php echo isset($vartxtBloodgroup) == "B +ve" ? "selected" : ""; ?>> B +ve </option>
																											<option value="B -ve" <?php echo isset($vartxtBloodgroup) == "B -ve" ? "selected" : ""; ?>> B -ve </option>
																											<option value="O +ve" <?php echo isset($vartxtBloodgroup) == "O +ve" ? "selected" : ""; ?>> O +ve </option>
																											<option value="O -ve" <?php echo isset($vartxtBloodgroup) == "O -ve" ? "selected" : ""; ?>> O -ve </option>
																											<option value="AB +ve" <?php echo isset($vartxtBloodgroup) == "AB +ve" ? "selected" : ""; ?>> AB +ve </option>
																											<option value="AB -ve" <?php echo isset($vartxtBloodgroup) == "AB -ve" ? "selected" : ""; ?>> AB -ve </option>
																										</select></td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Education</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink">
																										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																											<tr>
																												<td width="40%">
																													<table width="99%" border="0" cellspacing="0" cellpadding="0">
																														<tr>
																															<td width="47%">
																																<div align="right" class="text">Basic/Graduation</div>
																															</td>
																															<td width="1%">&nbsp;</td>
																															<td width="49%"><span class="text">
																																	<select name="basic_qual" id="basic_qual" tabindex="11" class="txtbox1" onChange="getDet(this.value,'bq_det','bq_det');">
																																		<option value="0"> Not Specified </option>
																																		<?php
																																		while ($edu_det1 = mysqli_fetch_array($chk_edu_det1)) {
																																			if ($vartxtbasic_qual == $edu_det1['education_id']) {
																																		?>
																																				<option value="<?php echo $edu_det1['education_id']; ?>" selected> <?php echo $edu_det1['education_name']; ?></option>
																																			<?php } else { ?>
																																				<option value="<?php echo $edu_det1['education_id']; ?>"> <?php echo $edu_det1['education_name']; ?></option>
																																		<?php }
																																		} ?>
																																	</select>
																																</span></td>
																														</tr>
																														<tr>
																															<td>
																																<div align="right" class="text">Post Graduation </div>
																															</td>
																															<td>&nbsp;</td>
																															<td><span class="text">
																																	<select name="pg_qual" id="pg_qual" tabindex="11" class="txtbox1" onChange="getDet(this.value,'pg_det','pg_det');">
																																		<option value="0"> Not Specified </option>
																																		<?php
																																		while ($edu_det2 = mysqli_fetch_array($chk_edu_det2)) {
																																			if ($vartxtpg_qual == $edu_det2['education_id']) {
																																		?>
																																				<option value="<?php echo $edu_det2['education_id']; ?>" selected> <?php echo $edu_det2['education_name']; ?></option>
																																			<?php } else { ?>
																																				<option value="<?php echo $edu_det2['education_id']; ?>"> <?php echo $edu_det2['education_name']; ?></option>
																																		<?php }
																																		} ?>
																																	</select>
																																</span></td>
																														</tr>
																														<tr>
																															<td>
																																<div align="right" class="text">Doctrate</div>
																															</td>
																															<td>&nbsp;</td>
																															<td><span class="text">
																																	<select name="doc_qual" id="doc_qual" tabindex="11" class="txtbox1" onChange="getDet(this.value,'doc_det','doc_det');">
																																		<option value="0"> Not Specified </option>
																																		<?php
																																		while ($edu_det3 = mysqli_fetch_array($chk_edu_det3)) {
																																			if ($vartxtdoc_qual == $edu_det3['education_id']) {
																																		?>
																																				<option value="<?php echo $edu_det3['education_id']; ?>" selected> <?php echo $edu_det3['education_name']; ?></option>
																																			<?php } else { ?>
																																				<option value="<?php echo $edu_det3['education_id']; ?>"> <?php echo $edu_det3['education_name']; ?></option>
																																		<?php }
																																		} ?>
																																	</select>
																																</span></td>
																														</tr>
																													</table>
																												</td>
																												<td width="60%">
																													<table width="100%" border="0" cellspacing="0" cellpadding="0">
																														<tr>
																															<td><input name="bq_det" type="text" class="txtbox1" id="bq_det" tabindex="12" style="display:none;" value="<?php echo isset($vartxtbq_det) ? $vartxtbq_det : ''; ?>" size="30">
																																&nbsp;</td>
																														</tr>
																														<tr>
																															<td><input name="pg_det" type="text" class="txtbox1" id="pg_det" tabindex="12" style="display:none;" value="<?php echo isset($vartxtpg_det) ? $vartxtpg_det : ''; ?>" size="30">
																																&nbsp;</td>
																														</tr>
																														<tr>
																															<td><input name="doc_det" type="text" class="txtbox1" id="doc_det" tabindex="12" style="display:none;" value="<?php echo isset($vartxtdoc_det) ? $vartxtdoc_det : ''; ?>" size="30">
																																&nbsp;</td>
																														</tr>
																													</table>
																												</td>
																											</tr>
																										</table>
																									</td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr>
																									<td height="10" align="right" valign="middle" class="text"> Photo </td>
																									<td align="center" valign="middle">
																										<div align="center"><strong>:&nbsp;</strong></div>
																									</td>
																									<td align="left" valign="middle"><input type="file" name="thumb_image" id="thumb_image" size="30" class="text" tabindex="13"></td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr>
																									<td height="10" align="right" valign="middle" class="text"> Attachment</td>
																									<td align="center" valign="middle">
																										<div align="center"><strong>:&nbsp;</strong></div>
																									</td>
																									<td align="left" valign="middle"><input type="file" name="attachment" id="attachment" size="30" class="text" tabindex="14"></td>
																								</tr>
																								<tr valign="top">
																									<td height="8" colspan="3" class="text_bold_head"></td>
																								</tr>
																								<tr valign="top" bgcolor="#eaeaea">
																									<td height="10" colspan="3" class="text_bold_head">Communication Details</td>
																								</tr>
																								<tr valign="top">
																									<td height="8" colspan="3" class="text"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Mobile/Login Id</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink"><input name="mobile_home" type="text" class="txtbox1" tabindex="15" value="<?php echo isset($vartxtmobile_home) ? $vartxtmobile_home : ''; ?>" size="50"></td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Mobile(Business)</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink"><input name="alt_mobile" type="text" class="txtbox1" tabindex="16" value="<?php echo isset($vartxtmobile_bness) ? $vartxtmobile_bness : ''; ?>" size="50"></td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top">
																									<td height="25" class="text">
																										<div align="right">Email-Id</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink"><input name="email" type="text" class="txtbox1" tabindex="17" value="<?php echo isset($vartxtEmail) ? $vartxtEmail : ''; ?>" size="50"></td>
																								</tr>
																								<tr valign="top">
																									<td height="8" colspan="3" class="text_bold_head"></td>
																								</tr>
																								<tr valign="top" bgcolor="#eaeaea">
																									<td height="10" colspan="3" class="text_bold_head">Family Link </td>
																								</tr>
																								<tr valign="top">
																									<td height="8" colspan="3" class="text"></td>
																								</tr>
																								<tr valign="top" id="tr_fam_link">
																									<td height="25" class="text" id="tr_husband_link">
																										<div align="right">Link to Father </div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink">
																										<select name="anc_id" tabindex="18" id="anc_id" class="txtbox">
																											<option value="0" selected>Please Select</option>
																											<?php
																											$sql_string = "SELECT * FROM vastipatrak_m where vasti_id=" . $_GET['HCode'] . " or parent_id=" . $_GET['HCode'] . " and vasti_id!='" . $varCode . "' and gender_c = 'Male'";
																											$check_link = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
																											if (mysqli_num_rows($check_res) > 0) {
																												while ($rec = mysqli_fetch_array($check_link)) {
																													if ($anc_id == $rec['vasti_id'])
																														echo ("<option selected value ='" . $rec['vasti_id'] . "'>" . $rec['fname_vc'] . " " . $rec['lname_vc'] . "</option>");
																													else
																														echo ("<option value='" . $rec['vasti_id'] . "'>" . $rec['fname_vc'] . " " . $rec['lname_vc'] . "</option>");
																												}
																											}
																											?>
																										</select>
																									</td>
																								</tr>
																								<tr valign="top">
																									<td height="8" class="text"></td>
																									<td height="8"></td>
																									<td height="8" class="sublink"></td>
																								</tr>
																								<tr valign="top" bgcolor="#eaeaea">
																									<td height="10" colspan="3" class="text_bold_head">Professional Details</td>
																								</tr>
																								<tr valign="top">
																									<td height="8" colspan="3" class="text"></td>
																								</tr>
																								<tr valign="top">
																									<td height="10" colspan="3"><span class="sublink"> </span>
																										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																											<tr>
																												<td width="16%" height="10" valign="top" class="text">
																													<div align="right">Type</div>
																												</td>
																												<td width="2%" height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td width="82%" height="25"> <span class="sublink">
																														<select name="prof_type" onChange="showhideDiv(this.value)" tabindex="20">
																															<option value="" <?php echo  isset($prof_type) && $prof_type == "" ? "selected" : ""; ?>> Not specified </option>
																															<option value="H" <?php echo isset($prof_type) && $prof_type == "H" ? "selected" : ""; ?>> House Wife </option>
																															<option value="S" <?php echo isset($prof_type) && $prof_type == "S" ? "selected" : ""; ?>> Student </option>
																															<option value="B" <?php echo isset($prof_type) && $prof_type == "B" ? "selected" : ""; ?>> Business </option>
																															<option value="P" <?php echo isset($prof_type) && $prof_type == "P" ? "selected" : ""; ?>> Professional </option>
																															<option value="J" <?php echo isset($prof_type) && $prof_type == "J" ? "selected" : ""; ?>> Job </option>
																															<option value="R" <?php echo isset($prof_type) && $prof_type == "R" ? "selected" : ""; ?>> Retire </option>
																														</select>
																													</span> </td>
																											</tr>
																											<tr id="trbusiness" style="display:none;">
																												<td height="25" colspan="3" valign="top" class="text">
																													<table width="100%" border="0" cellspacing="0" cellpadding="0">
																														<tr>
																															<td width="16%" height="10" valign="top" class="text">
																																<div align="right">Business Category</div>
																															</td>
																															<td width="2%" height="25" valign="top">
																																<div align="center">:</div>
																															</td>
																															<td width="82%" height="25"><span class="sublink">
																																	<select name="bness_cat_id" tabindex="21">
																																		<option value=""> Please Select </option>
																																		<?php
																																		while ($cat = mysqli_fetch_array($check_cat)) {
																																			if ($bness_cat_id == $cat['sub_id']) {
																																		?>
																																				<option value="<?php echo $cat['sub_id']; ?>" selected> <?php echo $cat['group_name']; ?> </option>
																																			<?php 	} else { ?>
																																				<option value="<?php echo $cat['sub_id']; ?>"> <?php echo $cat['group_name']; ?> </option>
																																		<?php
																																			}
																																		}
																																		?>
																																	</select>
																																</span></td>
																														</tr>
																														<tr>
																															<td height="10" valign="top" class="text">
																																<div align="right">Industry </div>
																															</td>
																															<td height="25" valign="top">
																																<div align="center">:</div>
																															</td>
																															<td height="25" id="tdsubcat"><span class="sublink">
																																	<select name="bness_subcat_id" tabindex="29">
																																		<option value=""> Please Select </option>
																																		<?php
																																		while ($ind = mysqli_fetch_array($check_ind)) {
																																			if ($bness_subcat_id == $ind['ind_id']) {
																																		?>
																																				<option value="<?php echo $ind['ind_id']; ?>" selected> <?php echo $ind['ind_value']; ?> </option>
																																			<?php 	} else { ?>
																																				<option value="<?php echo $ind['ind_id']; ?>"> <?php echo $ind['ind_value']; ?> </option>
																																		<?php
																																			}
																																		}
																																		?>
																																	</select>
																																</span></td>
																														</tr>
																														<tr>
																															<td height="10" valign="top" class="text">
																																<div align="right">Business Name </div>
																															</td>
																															<td height="25" valign="top">
																																<div align="center">:</div>
																															</td>
																															<td height="25"><span class="sublink">
																																	<input name="bness_name" type="text" class="txtbox1" tabindex="23" value="<?php echo ($bness_name); ?>" size="50">
																																</span></td>
																														</tr>
																														<!--<tr>
<td height="22" valign="top" class="text"><div align="right">Business Address</div></td>
<td height="22" valign="top"><div align="center">:</div></td>
<td height="22"><span class="sublink">
<textarea name="bness_addr" cols="30" rows="5" class="txtbox1" tabindex="24"><?php echo ($bness_addr); ?></textarea>
</span></td>
</tr>-->
																														<tr>
																															<td height="10" valign="top" class="text">
																																<div align="right">Phone No</div>
																															</td>
																															<td height="25" valign="top">
																																<div align="center">:</div>
																															</td>
																															<td height="25" class="text">
																																<input name="bness_phone" type="text" class="txtbox1" tabindex="25" value="<?php echo ($bness_phone); ?>" size="40">
																																(Multiple nos seperated by comma[,])
																															</td>
																														</tr>
																														<tr>
																															<td height="10" valign="top" class="text">
																																<div align="right">Mobile No. </div>
																															</td>
																															<td height="25" valign="top">
																																<div align="center">:</div>
																															</td>
																															<td height="25" class="text"><span class="sublink">
																																	<input name="bness_mobile" type="text" class="txtbox1" tabindex="26" value="<?php echo ($bness_mobile); ?>" size="40">
																																	(Multiple nos seperated by comma[,]) </span></td>
																														</tr>
																														<tr>
																															<td height="10" valign="top" class="text">
																																<div align="right">Description</div>
																															</td>
																															<td height="25" valign="top">
																																<div align="center">:</div>
																															</td>
																															<td height="25" class="text"><span class="sublink">
																																	<textarea name="bness_desc" cols="40" rows="7" class="txtbox1" tabindex="27"><?php echo ($bness_desc); ?></textarea>
																																</span></td>
																														</tr>
																													</table>
																												</td>
																											</tr>
																										</table>
																									</td>
																								</tr>
																								<tr valign="top" id="trprof" style="display:none;">
																									<td height="10" colspan="3">
																										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																											<tr>
																												<td width="16%" height="10" valign="top" class="text">
																													<div align="right">Profession Name</div>
																												</td>
																												<td width="2%" height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td width="82%" height="25"><span class="sublink">
																														<select name="prof_cat_id" onChange="getSubCat(this.value,'','prof_subcat_id','tdprofcat');" tabindex="28">
																															<option value=""> Please Select </option>
																															<?php
																															while ($prof = mysqli_fetch_array($check_cat1)) {
																																if ($prof_cat_id == $prof['sub_id']) {
																															?>
																																	<option value="<?php echo $prof['sub_id']; ?>" selected> <?php echo $prof['group_name']; ?> </option>
																																<?php 	} else { ?>
																																	<option value="<?php echo $prof['sub_id']; ?>"> <?php echo $prof['group_name']; ?> </option>
																															<?php
																																}
																															}
																															?>
																														</select>
																													</span></td>
																											</tr>
																											<tr>
																												<td height="10" valign="top" class="text">
																													<div align="right">Specialization</div>
																												</td>
																												<td height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td height="25" id="tdprofcat"><span class="sublink">
																														<select name="prof_subcat_id" tabindex="29">
																															<option value=""> Please Select </option>
																														</select>
																													</span></td>
																											</tr>
																											<!--<tr>
<td height="10" valign="top" class="text"><div align="right">Office Address</div></td>
<td height="25" valign="top"><div align="center">:</div></td>
<td height="25"><span class="sublink">
<textarea name="prof_addr" cols="30" rows="5" class="txtbox1" tabindex="30"><?php echo ($prof_addr); ?></textarea>
</span></td>
</tr> -->
																											<tr>
																												<td height="10" valign="top" class="text">
																													<div align="right">Phone No</div>
																												</td>
																												<td height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td height="25" class="text">
																													<input name="prof_phone" type="text" class="txtbox1" tabindex="31" value="<?php echo ($prof_phone); ?>" size="40">
																													(Multiple nos seperated by comma[,])
																												</td>
																											</tr>
																											<tr>
																												<td height="10" valign="top" class="text">
																													<div align="right">Mobile No. </div>
																												</td>
																												<td height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td height="25" class="text"><span class="sublink">
																														<input name="prof_mobile" type="text" class="txtbox1" tabindex="32" value="<?php echo ($prof_mobile); ?>" size="40">
																														(Multiple nos seperated by comma[,]) </span></td>
																											</tr>
																											<tr>
																												<td height="10" valign="top" class="text">
																													<div align="right">Description</div>
																												</td>
																												<td height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td height="25" class="text"><span class="sublink">
																														<textarea name="prof_desc" cols="40" rows="7" class="txtbox1" tabindex="33"><?php echo ($prof_desc); ?></textarea>
																													</span></td>
																											</tr>
																										</table>
																									</td>
																								</tr>
																								<tr valign="top" id="trjob" style="display:none;">
																									<td height="10" colspan="3">
																										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																											<tr>
																												<td height="10" valign="top" class="text">
																													<div align="right">Job Type </div>
																												</td>
																												<td height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td height="25"><span class="sublink">
																														<select name="job_type" tabindex="28">
																															<option value=""> Please Select </option>
																															<?php
																															while ($jobtype = mysqli_fetch_array($check_jobtype)) {
																																if ($job_type == $jobtype['sub_id']) {
																															?>
																																	<option value="<?php echo $jobtype['sub_id']; ?>" selected> <?php echo $jobtype['group_name']; ?> </option>
																																<?php 	} else { ?>
																																	<option value="<?php echo $jobtype['sub_id']; ?>"> <?php echo $jobtype['group_name']; ?> </option>
																															<?php
																																}
																															}
																															?>
																														</select>
																													</span></td>
																											</tr>
																											<tr>
																												<td height="10" valign="top" class="text">
																													<div align="right">Industry</div>
																												</td>
																												<td height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td height="25" id="tdsubcat"><span class="sublink">
																														<select name="job_ind_id" tabindex="29">
																															<option value=""> Please Select </option>
																															<?php
																															while ($j_ind = mysqli_fetch_array($check_ind_job)) {
																																if ($job_ind_id == $j_ind['ind_id']) {
																															?>
																																	<option value="<?php echo $j_ind['ind_id']; ?>" selected> <?php echo $j_ind['ind_value']; ?> </option>
																																<?php 	} else { ?>
																																	<option value="<?php echo $j_ind['ind_id']; ?>"> <?php echo $j_ind['ind_value']; ?> </option>
																															<?php
																																}
																															}
																															?>
																														</select>
																													</span></td>
																											</tr>
																											<tr>
																												<td width="16%" height="10" valign="top" class="text">
																													<div align="right">Company Name</div>
																												</td>
																												<td width="2%" height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td width="82%" height="25"><span class="sublink"> <span class="text">
																															<input name="comp_name" type="text" class="txtbox1" tabindex="34" value="<?php echo isset($comp_name) ? $comp_name : ""; ?>" size="50">
																														</span> </span></td>
																											</tr>
																											<tr>
																												<td height="10" valign="top" class="text">
																													<div align="right">Designation</div>
																												</td>
																												<td height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td height="25"><span class="sublink"> <span class="text">
																															<input name="job_desig" type="text" class="txtbox1" tabindex="35" value="<?php echo isset($job_desig) ? $job_desig : ""; ?>" size="50">
																														</span> </span></td>
																											</tr>
																											<!-- <tr>
<td height="10" valign="top" class="text"><div align="right">Office Address</div></td>
<td height="25" valign="top"><div align="center">:</div></td>
<td height="25"><span class="sublink">
<textarea name="job_addr" cols="30" rows="5" class="txtbox1" tabindex="36"><?php echo isset($job_addr) ? $job_addr : ""; ?></textarea>
</span></td>
</tr> -->
																											<tr>
																												<td height="10" valign="top" class="text">
																													<div align="right">Phone No</div>
																												</td>
																												<td height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td height="25" class="text">
																													<input name="job_phone" type="text" class="txtbox1" tabindex="37" value="<?php echo isset($job_phone) ? $job_phone : ""; ?>" size="40">
																													(Multiple nos seperated by comma[,])
																												</td>
																											</tr>
																											<tr>
																												<td height="10" valign="top" class="text">
																													<div align="right">Mobile No. </div>
																												</td>
																												<td height="25" valign="top">
																													<div align="center">:</div>
																												</td>
																												<td height="25" class="text"><span class="sublink">
																														<input name="job_mobile" type="text" class="txtbox1" tabindex="38" value="<?php echo isset($job_mobile) ? $job_mobile : ""; ?>" size="40">
																														(Multiple nos seperated by comma[,]) </span></td>
																											</tr>
																										</table>
																									</td>
																								</tr>
																								<tr valign="top" id="tdaddr">
																									<td height="25" class="text">
																										<div align="right">Address</div>
																									</td>
																									<td height="25">
																										<div align="center">:</div>
																									</td>
																									<td height="25" class="sublink">
																										<table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
																											<tr>
																												<td width="15%">
																													<div align="right">Line1</div>
																												</td>
																												<td width="2%">&nbsp;</td>
																												<td width="83%"><input name="job_addr1" type="text" class="txtbox1" id="job_addr1" tabindex="9" value="<?php echo isset($vartxtjobaddr1); ?>" size="30"></td>
																											</tr>
																											<tr>
																												<td>
																													<div align="right">Line2</div>
																												</td>
																												<td>&nbsp;</td>
																												<td><input name="job_addr2" type="text" class="txtbox1" id="job_addr2" tabindex="10" value="<?php echo isset($vartxtjobaddr2); ?>" size="30"></td>
																											</tr>
																											<tr>
																												<td>
																													<div align="right">Line3</div>
																												</td>
																												<td>&nbsp;</td>
																												<td><input name="job_addr3" type="text" class="txtbox1" id="job_addr3" tabindex="11" value="<?php echo isset($vartxtjobaddr3); ?>" size="30"></td>
																											</tr>
																											<tr>
																												<td>
																													<div align="right">Country</div>
																												</td>
																												<td>&nbsp;</td>
																												<td>
																													<select name="job_country" class="txtbox1" id="job_country" tabindex="12" onChange="javascript:getJobState(this.value);">
																														<option value=""> Select Country </option>
																														<?php
																														while ($country = mysqli_fetch_array($chk_job_country)) {
																															if ($country['country_id'] == $vartxtjobcountry) {
																														?>
																																<option value="<?php echo $country['country_id']; ?>" selected> <?php echo $country['country_name']; ?> </option>
																															<?php } else { ?>
																																<option value="<?php echo $country['country_id']; ?>"> <?php echo $country['country_name']; ?> </option>
																														<?php }
																														} ?>
																													</select>
																												</td>
																											</tr>
																											<tr>
																												<td>
																													<div align="right">State</div>
																												</td>
																												<td>&nbsp;</td>
																												<td id="tdjstate">
																													<select name="job_state" class="txtbox1" id="State " tabindex="13" />

																													<option value=""> Select State </option>
																												</td>
																											</tr>
																											<tr>
																												<td>
																													<div align="right">City/District</div>
																												</td>
																												<td>&nbsp;</td>
																												<td id="tdjcity">
																													<select name="job_city" class="txtbox1" id="City " tabindex="14" />

																													<option value=""> Select City </option>
																												</td>
																											</tr>
																											<tr>
																												<td>
																													<div align="right">District</div>
																												</td>
																												<td>&nbsp;</td>
																												<td><input name="job_district" type="text" class="txtbox1" id="job_district" tabindex="15" value="<?php echo isset($vartxtjobdistrict); ?>" size="30" /></td>
																											</tr>
																											<tr>
																												<td>
																													<div align="right">Pincode</div>
																												</td>
																												<td>&nbsp;</td>
																												<td><input name="job_pincode" type="text" class="txtbox1" id="job_pincode" tabindex="16" value="<?php echo isset($vartxtjobpincode); ?>" size="20"></td>
																											</tr>
																										</table>
																									</td>
																								</tr>
																								<tr valign="top">
																									<td height="10">&nbsp;</td>
																									<td>&nbsp;</td>
																									<td>&nbsp;</td>
																								</tr>
																								<tr valign="top">
																									<td height="10">&nbsp;</td>
																									<td>&nbsp;</td>
																									<td>&nbsp;</td>
																								</tr>
																								<tr valign="top">
																									<td height="10">&nbsp;</td>
																									<td>&nbsp;</td>
																									<td><input type="submit" value="Submit" tabindex="39" width="71" height="24" border="0" onClick="javascript:return checkFormElements(this.form);"></td>
																								</tr>
																								<tr valign="top">
																									<td height="10" colspan="3" class="text"></td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</form>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>

														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
													</table>
													</form>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="36" valign="top" background="images/footer_bg.gif">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="8" valign="top">
						</td>
					</tr>
					<tr>
						<td valign="top">
							<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr valign="top">
									<td class="footertext">&nbsp;</td>
									<td class="footertext">
										<div align="right"></div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="5" valign="top"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<!-- End ImageReady Slices -->
	<script language="javascript">
		showhideDiv("<?php echo $prof_type; ?>");

		var bness_cat_id = "<?php echo $bness_cat_id; ?>";

		//var bness_subcat_id = "<?php echo $bness_subcat_id; ?>";
		//getSubCat(bness_cat_id,'','bness_subcat_id','tdsubcat',bness_subcat_id);

		var prof_cat_id = "<?php echo $prof_cat_id; ?>";

		var prof_subcat_id = "<?php echo $prof_subcat_id; ?>";
		getSubCat(prof_cat_id, '', 'prof_subcat_id', 'tdprofcat', prof_subcat_id);

		//getDet("<?php echo $vartxtedu_cat; ?>");

		getCmbName1("<?php echo $vartxtMaritalName; ?>");

		var jobcountrycode = "<?php echo $vartxtjobcountry; ?>";

		var jobstatecode = "<?php echo $vartxtjobstate; ?>";
		getJobState(jobcountrycode, jobstatecode);

		var jobcitycode = "<?php echo $vartxtjobcity; ?>";
		getJobCity(jobstatecode, jobcitycode);

		getDet("<?php echo $vartxtbasic_qual; ?>", 'bq_det', 'bq_det');

		getDet("<?php echo $vartxtpg_qual; ?>", 'pg_det', 'pg_det');

		getDet("<?php echo $vartxtdoc_qual; ?>", 'doc_det', 'doc_det');
	</script>
</body>

</html>