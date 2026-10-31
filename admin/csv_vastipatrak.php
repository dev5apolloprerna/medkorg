<?php
ob_start();
error_reporting(0);
//require 'noentry.php';
require 'connection/conn.php';
session_start();

// Query for Country//
$sql_country = "SELECT * FROM country_m order by country_name";
$chk_country = mysqli_query($cn, $sql_country);

// Query for State//
$sql_state = "SELECT * FROM state_m order by state_name";
$chk_state = mysqli_query($cn, $sql_state);


// Query for State//
$sql_city = "SELECT * FROM city_m order by city_name";
$chk_city = mysqli_query($cn, $sql_city);
$tmp_city = mysqli_fetch_array($chk_city);

// Query for Blood Group//
$sql_bloodgroup = "select distinct blood_group from vastipatrak_m where blood_group not in ('0',' ') order by blood_group";
$chk_bg = mysqli_query($cn, $sql_bloodgroup);

// Query for Village data //
$sql_vill = "select * from village_m order by village_name";
$chk_vill = mysqli_query($cn, $sql_vill);

// Query for Village gotra //
$sql_gotra = "select * from gotra_m order by gotra_name";
$chk_gotra = mysqli_query($cn, $sql_gotra);

$sql_string = "SELECT * FROM bdir_category where cat_type='B' and main_id=0 and group_name!='Root' order by group_name";
$check_cat = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM industry_m order by ind_value";
$check_ind = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM bdir_category where cat_type='J' and main_id=0 and group_name!='Root' order by group_name";
$check_jobtype = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM industry_m order by ind_value";
$check_ind_job = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM bdir_category where cat_type='P' and main_id=0 and group_name!='Root' order by group_name";
$check_cat1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Basic/Grad.' order by education_name";
$chk_edu_det1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='PG' order by education_name";
$chk_edu_det2 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Doctrate' order by education_name";
$chk_edu_det3 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
// print_r($_GET);exit;
if (isset($_GET['mode']) == "Dir")
	$action = "user-dirsearch-result.php?dirid=" . $_GET['dirid'] . "&dirnm=" . $_GET['dirnm'];
else
	$action = "user-vastipatrak-result.php";

// Query for Marital Status //
$sql_maritalst = "select * from marital_m order by marital_id";
$chk_maritalst = mysqli_query($cn, $sql_maritalst);




// After search generate result //
// GENERATE CSV CODE //
function sqltocsv($cn, $strhead, $strsql, $dir_nm, $fields)
{
	$chkres = mysqli_query($cn, $strsql);
	$numres = mysqli_num_rows($chkres);
	$strcsv = "";
	$strcsv = $strhead . "\n";

	$rs = array();
	while ($rec = mysqli_fetch_assoc($chkres)) {
		//add the vasti patrak id
	
		$r['vasti_id'] = $rec['vasti_id'];
		$r['parent_id'] = $rec['parent_id'];
		$r['anc_id'] = $rec['anc_id'];

		//  Form Number //
		if ($rec['form_no'] == "" && $rec['parform_no'] == "")
			$r['form_no'] = $rec['mainparform_no'];
		else if ($rec['form_no'] == "" && $rec['parform_no'] != "")
			$r['form_no'] = $rec['parform_no'];
		else
			$r['form_no'] = $rec['form_no'];


		$r['fname_vc'] = $rec['fname_vc'];

		//  Middle Name //
		if ($rec['mname_vc'] == "")
			$r['mname_vc'] = $rec['parfname'];
		else
			$r['mname_vc'] = $rec['mname_vc'];


		//  Last Name //
		if ($rec['lname_vc'] == "" && $rec['parlname'] == "")
			$r['lname_vc'] = $rec['mainparlname'];
		else if ($rec['lname_vc'] == "" && $rec['parlname'] != "")
			$r['lname_vc'] = $rec['parlname'];
		else
			$r['lname_vc'] = $rec['lname_vc'];

		if ($_POST['selSearchType'] == "IS") {
			//  Relation with HOF //
			if ($rec['parent_id'] == "0")
				$r['relation_name'] = "HOF";
			else {
				if ($rec['relation_name'] == "" && $rec['parrelname'] == "")
					$r['relation_name'] = $rec['mainparrelname'];
				else if ($rec['relation_name'] == "" && $rec['parrelname'] != "")
					$r['relation_name'] = $rec['parrelname'];
				else
					$r['relation_name'] = $rec['relation_name'];
			}
		}

		//  Native //
		if ($rec['village_name'] == "" && $rec['parvill'] == "")
			$r['village_name'] = $rec['mainparvill'];
		else if ($rec['village_name'] == "" && $rec['parvill'] != "")
			$r['village_name'] = $rec['parvill'];
		else
			$r['village_name'] = $rec['village_name'];

		//  Address 1 //
		if ($rec['addr1'] == "" && $rec['paraddr1'] == "")
			$r['addr1'] = $rec['mainparaddr1'];
		else if ($rec['addr1'] == "" && $rec['paraddr1'] != "")
			$r['addr1'] = $rec['paraddr1'];
		else
			$r['addr1'] = $rec['addr1'];


		//  Address 2 //
		if ($rec['addr2'] == "" && $rec['paraddr2'] == "")
			$r['addr2'] = $rec['mainparaddr2'];
		else if ($rec['addr2'] == "" && $rec['paraddr2'] != "")
			$r['addr2'] = $rec['paraddr2'];
		else
			$r['addr2'] = $rec['addr2'];


		//  Address 3 //
		if ($rec['addr3'] == "" && $rec['paraddr3'] == "")
			$r['addr3'] = $rec['mainparaddr3'];
		else if ($rec['addr3'] == "" && $rec['paraddr3'] != "")
			$r['addr3'] = $rec['paraddr3'];
		else
			$r['addr3'] = $rec['addr3'];


		//  Country //
		if ($rec['country_name'] == "" && $rec['parcountry'] == "")
			$r['country_name'] = $rec['mainparcountry'];
		else if ($rec['country_name'] == "" && $rec['parcountry'] != "")
			$r['country_name'] = $rec['parcountry'];
		else
			$r['country_name'] = $rec['country_name'];


		//  State //
		if ($rec['state_name'] == "" && $rec['parstate'] == "")
			$r['state_name'] = $rec['mainparstate'];
		else if ($rec['state_name'] == "" && $rec['parstate'] != "")
			$r['state_name'] = $rec['parstate'];
		else
			$r['state_name'] = $rec['state_name'];


		// City //
		if ($rec['city_name'] == "" && $rec['parcity'] == "")
			$r['city_name'] = $rec['mainparcity'];
		else if ($rec['city_name'] == "" && $rec['parcity'] != "")
			$r['city_name'] = $rec['parcity'];
		else
			$r['city_name'] = $rec['city_name'];


		// DISTRICT //
		if ($rec['district'] == "" && $rec['pardistrict'] == "")
			$r['district'] = $rec['mainpardistrict'];
		else if ($rec['district'] == "" && $rec['pardistrict'] != "")
			$r['district'] = $rec['pardistrict'];
		else
			$r['district'] = $rec['district'];


		// PINCODE //
		if ($rec['pincode'] == "" && $rec['parpincode'] == "")
			$r['pincode'] = $rec['mainparpincode'];
		else if ($rec['pincode'] == "" && $rec['parpincode'] != "")
			$r['pincode'] = $rec['parpincode'];
		else
			$r['pincode'] = $rec['pincode'];


		$r['mobile_number'] = $rec['mobile_number'];

		$r['email'] = $rec['email'];

		$r['birth_date'] = date('d-m-Y', strtotime($rec['birth_date']));

		$rs[] = $r;
	}

	foreach ($rs as $row) {
		$row_data = "";
		foreach ($row as $col) {
			$row_data .= '"' . $col . '"';

			if ($row_data <> "")
				$row_data .= ",";
		}
		$strcsv .= $row_data . "\n";
	}

	$dir_nm = "Data CSV";

	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition:  attachment; filename=vp_member.csv");


	return $strcsv;
}


if ($_POST) {

	$where = " and ";
	$cond = "";
	// Search By Professional Details //
	if (isset($_POST['country']) && $_POST['country'] != "" && $_POST['country'] != "0") {
		//$cond .= $where . "(vasti.country = '".$_POST['country']."' or v1.country = '".$_POST['country']."')";
		$cond .= $where . "(vasti.country = '" . $_POST['country'] . "')";
	}
	if (isset($_POST['state']) && $_POST['state'] != "" && $_POST['state'] != "0") {
		//$cond .= $where . "(vasti.state = '".$_POST['state']."' or v1.state = '".$_POST['state']."')";
		$cond .= $where . "(vasti.state = '" . $_POST['state'] . "')";
	}
	if (isset($_POST['city']) && $_POST['city'] != "" && $_POST['city'] != "0") {
		//$cond .= $where . "(vasti.city = '".$_POST['city']."' or v1.city = '".$_POST['city']."')";
		$cond .= $where . "(vasti.city = '" . $_POST['city'] . "')";
	}

	if (isset($_POST['village_id'])) {
		$vid = implode(",", $_POST['village_id']);
		if ($vid != "")
			$cond .= $where . "(vasti.village_id in (" . implode(",", $_POST['village_id']) . ") or v1.village_id in (" . implode(",", $_POST['village_id']) . "))";
	}
	if (isset($_POST['gotra_id'])) {
		$pid = implode(",", $_POST['gotra_id']);
		if ($pid != "")
			$cond .= $where . "(vasti.gotra_id in (" . implode(",", $_POST['gotra_id']) . ") or v1.gotra_id in (" . implode(",", $_POST['gotra_id']) . "))";
	}
	if ($_POST['frm_no1'] != "" || $_POST['frm_no2'] != "") {
		//$cond .= $where . "((vasti.form_no >= ".$_POST['frm_no1']." and vasti.form_no <= ".$_POST['frm_no2'].") or (v1.form_no >= ".$_POST['frm_no1']." and v1.form_no <= ".$_POST['frm_no2']."))";
		$cond .= $where . "((vasti.form_no >= " . $_POST['frm_no1'] . " and vasti.form_no <= " . $_POST['frm_no2'] . "))";
	}
	if ($_POST['fname_vc'] != "") {
		$cond .= $where . "vasti.fname_vc like '%" . $_POST['fname_vc'] . "%'";
	}
	if ($_POST['lname_vc'] != "") {
		$cond .= $where . "vasti.lname_vc like '%" . $_POST['lname_vc'] . "%'";
	}
	if ($_POST['email'] != "") {
		$cond .= $where . "vasti.email like '%" . $_POST['email'] . "%'";
	}
	if ($_POST['blood_group'] != "") {
		$cond .= $where . "vasti.blood_group='" . $_POST['blood_group'] . "'";
	}
	if ($_POST['gender_c'] != "") {
		$cond .= $where . "vasti.gender_c='" . $_POST['gender_c'] . "'";
	}
	if ($_POST['marital_id'] != "") {
		$cond .= $where . "vasti.marital_id='" . $_POST['marital_id'] . "'";
	}
	if (isset($_POST['pincode']) != "") {
		$cond .= $where . "vasti.pincode='" . $_POST['pincode'] . "'";
	}
	if ($_POST['age_from'] != "0" || $_POST['age_to'] != "100") {
		if ($_POST['age_from'] != "")
			$age_from = $_POST['age_from'];
		else
			$age_from = "1";

		if ($_POST['age_to'] != "")
			$age_to = $_POST['age_to'];
		else
			$age_to = "200";

		$cond .= $where . "(DATEDIFF(NOW(),vasti.birth_date)/365) between " . $age_from . " and " . $age_to;
	}

	if ($_POST['basic_qual'] != "") {
		$cond .= $where . "vasti.basic_qual ='" . $_POST['basic_qual'] . "'";
	}
	if ($_POST['pg_qual'] != "") {
		$cond .= $where . "vasti.pg_qual ='" . $_POST['pg_qual'] . "'";
	}
	if ($_POST['doc_qual'] != "") {
		$cond .= $where . "vasti.doc_qual ='" . $_POST['doc_qual'] . "'";
	}

	// Search By Professional Details //

	if ($_POST['prof_type'] != "") {
		$cond .= $where . "bdir.prof_type like '%" . $_POST['prof_type'] . "%'";
	}
	// Business //
	if ($_POST['bness_cat_id'] != "") {
		$cond .= $where . "bdir.bness_cat_id = '" . $_POST['bness_cat_id'] . "'";
	}
	if ($_POST['bness_subcat_id'] != "") {
		$cond .= $where . "bdir.bness_subcat_id = '" . $_POST['bness_subcat_id'] . "'";
	}
	if ($_POST['bness_name'] != "") {
		$cond .= $where . "bdir.bness_name = '" . $_POST['bness_name'] . "'";
	}
	// Profession //
	if ($_POST['prof_cat_id'] != "") {
		$cond .= $where . "bdir.prof_cat_id = '" . $_POST['prof_cat_id'] . "'";
	}
	if ($_POST['prof_subcat_id'] != "0") {
		$cond .= $where . "bdir.prof_subcat_id = '" . $_POST['prof_subcat_id'] . "'";
	}
	// Business //
	if ($_POST['job_type'] != "") {
		$cond .= $where . "bdir.job_type = '" . $_POST['job_type'] . "'";
	}
	if ($_POST['job_ind_id'] != "") {
		$cond .= $where . "bdir.job_ind_id = '" . $_POST['job_ind_id'] . "'";
	}
	if ($_POST['comp_name'] != "") {
		$cond .= $where . "bdir.comp_name = '" . $_POST['comp_name'] . "'";
	}

	if ($_POST['selSearchType'] != 'IS')
		$where_cnd = "where vasti.lineage=0 and vasti.status in (0,1) and vasti.parent_id=0 " . $cond;
	else {
		$where_cnd = "where vasti.lineage=0 and vasti.status in (0,1) " . $cond;
	}

	//$where_cnd = $where_cnd . " and lineage=0 ";
	$sql_vastipatrak = "select distinct vasti.*,
v1.gotra_id as pargotra,v1.village_id as parvillage,v1.fname_vc as parfname,v1.lname_vc as parlname,v1.addr1 as paraddr1,v1.addr2 as paraddr2,v1.addr3 as paraddr3,v1.form_no as parform_no,v1.pincode as parpincode,v1.district as pardistrict,
v2.gotra_id as mainpargotra,v2.village_id as mainparvillage,v2.fname_vc as mainparmname,v2.lname_vc as mainparlname,v2.addr1 as mainparaddr1,v2.addr2 as mainparaddr2,v2.addr3 as mainparaddr3,v2.form_no as mainparform_no,v2.pincode as mainparpincode,v2.district as mainpardistrict,
v.village_name,g.gotra_name,m.marital_name,r.relation_name,
vill1.village_name as parvill, vill2.village_name as mainparvill,r1.relation_name as parrelname,r2.relation_name as mainparrelname,
bdir.prof_type,bness_cat_id,bness_subcat_id,bness_name,prof_cat_id,prof_subcat_id,comp_name, 
country.country_name,state.state_name,city.city_name,
country1.country_name as parcountry,state1.state_name as parstate,city1.city_name as parcity

from vastipatrak_m vasti
left outer join vastipatrak_m v1 on vasti.anc_id = v1.vasti_id
left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id

left outer join village_m v on vasti.village_id = v.village_id
left outer join village_m vill1 on v1.village_id = vill1.village_id
left outer join village_m vill2 on v2.village_id = vill2.village_id

left outer join relation_m r on vasti.relation_id = r.relation_id
left outer join relation_m r1 on v1.relation_id = r1.relation_id
left outer join relation_m r2 on v2.relation_id = r2.relation_id

left outer join gotra_m g on vasti.gotra_id = g.gotra_id
left outer join marital_m m on vasti.marital_id = m.marital_id 
left outer join businessdir_m bdir on vasti.vasti_id = bdir.vasti_id

left outer join country_m country on vasti.country = country.country_id
left outer join country_m country1 on v1.country = country1.country_id

left outer join state_m state on vasti.state = state.state_id
left outer join state_m state1 on v1.state = state1.state_id

left outer join city_m city on vasti.city = city.city_id
left outer join city_m city1 on v1.city = city1.city_id

$where_cnd order by vasti.fname_vc";

	//$chk_vastipatrak = mysql_query($sql_vastipatrak);
	//$num_vastipatrak = mysql_num_rows($chk_vastipatrak);
	$header_row = "";	
	$header_row .= '"Internal ID",';
	$header_row .= '"Parent ID",';
	$header_row .= '"Anc ID",';
	$header_row .= '"Form No.",';
	$header_row .= '"First Name",';
	$header_row .= '"Middle Name",';
	$header_row .= '"Last Name",';
	if ($_POST['selSearchType'] == "IS")
		$header_row .= '"Relation with HOF",';
	$header_row .= '"Native",';
	$header_row .= '"Address 1",';
	$header_row .= '"Address 2",';
	$header_row .= '"Address 3",';
	$header_row .= '"Country",';
	$header_row .= '"State",';
	$header_row .= '"City",';
	$header_row .= '"District",';
	$header_row .= '"Pincode",';
	$header_row .= '"Mobile Number",';
	$header_row .= '"Email ID",';
	$header_row .= '"Birth Date",';

	$strhead = $header_row;
	$fields = $header_row;

	$strhead = substr($strhead, 0, strlen($strhead) - 1);
	$dir_nm = "Data CSV";
	echo (sqltocsv($cn, $strhead, $sql_vastipatrak, $dir_nm, $fields));
	exit;
}
?>

<html>

<head>
	<title>Samaj</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
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

		.style6 {
			color: #B90200;
			font-family: Arial, Helvetica, sans-serif;
			font-weight: bolder;
		}
		-->
	</style>

	<script language="javascript" type="text/javascript">
		function showhideFields(val) {
			if (val == 'IS') {
				document.getElementById("prof_det").style.display = "";
				document.getElementById("extra_det").style.display = "";
			} else {
				document.getElementById("prof_det").style.display = "none";
				document.getElementById("extra_det").style.display = "none";
			}
		}

		function showhideDiv(val) {
			if (val == "" || val == "U") {
				document.getElementById("trbusiness").style.display = "none";
				document.getElementById("trprof").style.display = "none";
				document.getElementById("trjob").style.display = "none";
			}
			if (val == "B") {
				document.getElementById("trbusiness").style.display = "";
				document.getElementById("trprof").style.display = "none";
				document.getElementById("trjob").style.display = "none";
			}
			if (val == "P") {
				document.getElementById("trbusiness").style.display = "none";
				document.getElementById("trprof").style.display = "";
				document.getElementById("trjob").style.display = "none";
			}
			if (val == "J") {
				document.getElementById("trbusiness").style.display = "none";
				document.getElementById("trprof").style.display = "none";
				document.getElementById("trjob").style.display = "";
			}
		}
	</script>
	<script type="text/javascript" src="js/ajax.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
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
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="text_bold_head">
																<div align="left">
																	<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
																			<td>
																				<div align="right"> </div>
																			</td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
														<tr>
															<td class="text_bold_head">
																<div align="left"></div>
															</td>
														</tr>
														<tr>
															<td class="text_bold_head">

																<form name="frmSearch" method="post" action="csv_vastipatrak.php">
																	<table width="98%" border="0" cellspacing="0" cellpadding="0">
																		<tr class="text">
																			<td height="20" colspan="3" class="text_bold_head" style="padding-left:5px; font-weight: bold;">&nbsp;</td>
																		</tr>
																		<tr bgcolor="#fbfbfb" class="text">
																			<td height="20" colspan="3" class="text_bold_head" style="padding-left:5px; font-weight: bold;">Personal Details</td>
																		</tr>
																		<tr bgcolor="#fbfbfb" class="text">
																			<td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
																		</tr>
																		<tr class="text4_user">
																			<td height="30" colspan="3" class="text4_user">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
																					<tr>
																						<td width="70%" valign="top" style="padding-top:10px;">
																							<table width="100%" border="0" cellspacing="0" cellpadding="0">
																								<tr class="text4_user">
																									<td height="30" class="text">
																										<div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Search By</div>
																									</td>
																									<td class="text4_user">&nbsp;</td>
																									<td width="81%" class="text4_user">
																										<select name="selSearchType" onChange="showhideFields(this.value)">
																											<option value="HOF" <?php echo isset($_SESSION['selSearchType']) == "HOF" ? "selected" : ""; ?>> Head of Family </option>
																											<option value="IS" <?php echo isset($_SESSION['selSearchType']) == "IS" ? "selected" : ""; ?>> Search All </option>
																										</select>
																									</td>
																								</tr>
																								<tr class="text4_user">
																									<td height="30" class="text">
																										<div align="right" class="style3">Current Country </div>
																									</td>
																									<td class="text4_user">&nbsp;</td>
																									<td class="text4_user"> <span class="text2">
																											<select name="country" id="country" style="width:150px;" onChange="getState(this.value,<?php echo $_SESSION['UserState']; ?>);">
																												<option value="">Any Country</option>
																												<?php
																												while ($country = mysqli_fetch_array($chk_country)) {
																													if ($_SESSION['country'] == $country['country_id'] || $_SESSION["UserCounrry"] == $country['country_id']) {
																												?>
																														<option value="<?php echo $country['country_id']; ?>" selected="selected"> <?php echo $country['country_name']; ?> </option>
																													<?php
																													} else {
																													?>
																														<option value="<?php echo $country['country_id']; ?>"> <?php echo $country['country_name']; ?> </option>
																												<?php }
																												} ?>
																											</select>
																										</span></td>
																								</tr>
																								<tr class="text4_user">
																									<td height="30" class="text">
																										<div align="right" class="style3">Current State </div>
																									</td>
																									<td class="text4_user">&nbsp;</td>
																									<td class="text4_user" id=""> <span class="text2">
																											<select name="state" id="tdstate" style="width:150px;" onChange="javascript:getCity(this.value,'');">
																												<option value="">select state</option>
																											</select>
																										</span></td>
																								</tr>
																								<tr class="text4_user">
																									<td height="30" class="text">
																										<div align="right" class="style3">Current City </div>
																									</td>
																									<td class="text4_user">&nbsp;</td>
																									<td class="text4_user" id="tdcity"> <span class="text2">
																											<select name="city" id="city" style="width:150px;">
																												<option value="" selected="selected">Any City</option>
																												<?php
																												while ($city = mysqli_fetch_array($chk_city)) {
																													if ($_SESSION['city'] == $city['city_id'] || $_SESSION["UserCity"] == $city['city_id']) {
																												?>
																														<option value="<?php echo $city['city_id']; ?>" selected="selected"> <?php echo $city['city_name']; ?> </option>
																													<?php
																													} else {
																													?>
																														<option value="<?php echo $city['city_id']; ?>"> <?php echo $city['city_name']; ?> </option>
																												<?php }
																												} ?>
																											</select>
																										</span></td>
																								</tr>
																								<tr valign="top" class="text4_user">
																									<td width="18%" height="30" class="text">
																										<div align="right" class="style3">Village (Native Place) </div>
																									</td>
																									<td width="1%" class="text4_user">&nbsp;</td>
																									<td class="text4_user"> <span class="text2">
																											<?php
																											$vill_arr = array();
																											if (isset($_SESSION['village_id']) != "") {
																												$vill_arr = explode(",", $_SESSION['village_id']);
																											}

																											?>
																											<select name="village_id[]" size="5" multiple="multiple" style="width:200px;">
																												<option value=""> Any Village </option>
																												<?php
																												while ($vill = mysqli_fetch_array($chk_vill)) {
																												?>
																													<option value="<?php echo $vill['village_id']; ?>" <?php if (in_array($vill['village_id'], $vill_arr)) { ?> selected="selected" <?php } else {
																																																													echo "";
																																																												} ?>> <?php echo $vill['village_name']; ?> </option>
																												<?php } ?>
																											</select>
																										</span> </td>
																								</tr>
																								<tr valign="top" class="text4_user">
																									<td height="3" colspan="3" class="text"></td>
																								</tr>
																								<tr valign="top" class="text4_user">
																									<td height="30" class="text">
																										<div align="right" class="style3">Gotra</div>
																									</td>
																									<td class="text4_user">&nbsp;</td>
																									<td class="text4_user"> <span class="text2">
																											<?php
																											$gotra_arr = array();
																											if (isset($_SESSION['gotra_id']) != "") {
																												$gotra_arr = explode(",", $_SESSION['gotra_id']);
																											}

																											?>
																											<select name="gotra_id[]" size="5" multiple="multiple" style="width:200px;">
																												<option value=""> Any Gotra </option>
																												<?php
																												while ($gotra = mysqli_fetch_array($chk_gotra)) {
																												?>
																													<option value="<?php echo $gotra['gotra_id']; ?>" <?php if (in_array($gotra['gotra_id'], $gotra_arr)) { ?> selected="selected" <?php } else {
																																																													echo "";
																																																												} ?>> <?php echo $gotra['gotra_name']; ?> </option>
																												<?php } ?>
																											</select>
																										</span> </td>
																								</tr>
																								<tr class="text4_user">
																									<td height="30" class="text">
																										<div align="right" class="style3">Search By Form No.</div>
																									</td>
																									<td class="text4_user">&nbsp;</td>
																									<td class="text4_user">
																										<span class="text2">
																											<input type="text" name="frm_no1" value="<?php echo isset($_SESSION['frm_no1']); ?>" /> to&nbsp; <input type="text" name="frm_no2" value="<?php echo isset($_SESSION['frm_no2']); ?>" />
																										</span>
																									</td>
																								</tr>
																								<tr class="text4_user">
																									<td height="30" class="text">
																										<div align="right" class="style3">First Name </div>
																									</td>
																									<td class="text4_user">&nbsp;</td>
																									<td class="text4_user"> <span class="text2">
																											<input type="text" name="fname_vc" value="<?php echo isset($_SESSION['fname_vc']); ?>" />
																										</span> </td>
																								</tr>
																								<tr class="text4_user">
																									<td height="30" class="text">
																										<div align="right" class="style3">Last Name </div>
																									</td>
																									<td class="text4_user">&nbsp;</td>
																									<td class="text4_user"> <span class="text2">
																											<input type="text" name="lname_vc" value="<?php echo isset($_SESSION['lname_vc']); ?>" />
																										</span> </td>
																								</tr>
																								<tr class="text4_user">
																									<td height="30" class="text">
																										<div align="right"><span class="style3">Blood Group </span></div>
																									</td>
																									<td class="text4_user">&nbsp;</td>
																									<td class="text4_user"><span class="text2">
																											<select name="blood_group">
																												<option value="" selected="selected">Any Blood Group</option>
																												<?php
																												while ($blood_group = mysqli_fetch_array($chk_bg)) {
																													if ($_SESSION['blood_group'] == $blood_group['blood_group']) {
																												?>
																														<option value="<?php echo $blood_group['blood_group']; ?>" selected="selected"> <?php echo $blood_group['blood_group']; ?> </option>
																													<?php
																													} else {
																													?>
																														<option value="<?php echo $blood_group['blood_group']; ?>"> <?php echo $blood_group['blood_group']; ?> </option>
																												<?php
																													}
																												}
																												?>
																											</select>
																										</span></td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																		<tr class="text4_user" id="extra_det" style="display:none;">
																			<td width="100%" height="15" colspan="3" valign="top" class="text4_user">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
																					<tr class="text4_user">
																						<td height="30" class="text">
																							<div align="right" class="style3">Email Id</div>
																						</td>
																						<td class="text4_user">&nbsp;</td>
																						<td class="text4_user"> <span class="text2">
																								<input name="email" type="text" id="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ""; ?>" />
																							</span> </td>
																					</tr>
																					<tr class="text4_user">
																						<td width="18%" height="30" class="text">
																							<div align="right" class="text style3">Age</div>
																						</td>
																						<td width="1%" class="text4_user">&nbsp;</td>
																						<td width="81%" class="text4_user">
																							<span class="text2">
																								<select name="age_from" id="age_from">
																									<option value="0" selected="selected">From Age</option>
																									<?php
																									$i = 0;
																									for ($i = 1; $i <= 100; $i++) {
																									?>
																										<option value="<?php echo ($i); ?>" <?php echo isset($_SESSION['age_from'])  == $i ? "selected" : ""; ?>><?php echo ($i); ?></option>
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
																									for ($i = 1; $i <= 100; $i++) {
																									?>
																										<option value="<?php echo ($i); ?>" <?php echo isset($_SESSION['age_to']) == $i ? "selected" : ""; ?>><?php echo ($i); ?></option>
																									<?php
																									}
																									?>
																								</select>
																							</span>
																						</td>
																					</tr>
																					<tr class="text4_user">
																						<td height="30" class="text">
																							<div align="right" class="style3">Gender</div>
																						</td>
																						<td class="text4_user">&nbsp;</td>
																						<td class="text4_user"> <span class="text2">
																								<select name="gender_c">
																									<option value="" selected="selected">Any Gender</option>
																									<option value="Male" <?php echo isset($_SESSION['gender_c']) == "Male" ? "selected" : ""; ?>>Male</option>
																									<option value="Female" <?php echo isset($_SESSION['gender_c']) == "Female" ? "selected" : ""; ?>>Female</option>
																								</select>
																							</span> </td>
																					</tr>
																					<tr class="text4_user">
																						<td height="30" class="text">
																							<div align="right" class="style3">Marital Status</div>
																						</td>
																						<td class="text4_user">&nbsp;</td>
																						<td class="text4_user"> <span class="text2">
																								<select name="marital_id">
																									<option value="" selected="selected">Any Marital Status </option>
																									<?php
																									while ($ms = mysqli_fetch_array($chk_maritalst)) {
																										if ($_SESSION['marital_id'] == $ms['marital_id']) {
																									?>
																											<option value="<?php echo $ms['marital_id']; ?>" selected><?php echo $ms['marital_name']; ?></option>
																										<?php } else { ?>
																											<option value="<?php echo $ms['marital_id']; ?>"><?php echo $ms['marital_name']; ?></option>
																									<?php }
																									} ?>
																								</select>
																							</span> </td>
																					</tr>
																					<tr class="text">
																						<td height="20" colspan="3" class="text" style="padding-left:5px;">&nbsp;</td>
																					</tr>
																					<tr bgcolor="#fbfbfb" class="text">
																						<td height="20" colspan="3" class="text_bold_head" style="padding-left:5px;; color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Qualification Details</td>
																					</tr>
																					<tr bgcolor="#fbfbfb" class="text">
																						<td colspan="3" class="text" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
																					</tr>
																					<tr class="text4_user">
																						<td height="30" class="text">
																							<div align="right" class="style3">Basic/Graduation</div>
																						</td>
																						<td class="text4_user">&nbsp;</td>
																						<td class="text4_user"> <span class="text">
																								<select name="basic_qual" id="basic_qual" tabindex="11" class="txtbox1">
																									<option value=""> Not Specified </option>
																									<?php
																									while ($edu_det1 = mysqli_fetch_array($chk_edu_det1)) {
																										if ($_SESSION['basic_qual'] == $edu_det1['education_id']) {
																									?>
																											<option value="<?php echo $edu_det1['education_id']; ?>" selected="selected"> <?php echo $edu_det1['education_name']; ?></option>
																										<?php } else { ?>
																											<option value="<?php echo $edu_det1['education_id']; ?>"> <?php echo $edu_det1['education_name']; ?></option>
																									<?php }
																									} ?>
																								</select>
																							</span><span class="text2"> </span> </td>
																					</tr>
																					<tr class="text4_user">
																						<td height="30" class="text">
																							<div align="right" class="style3">Post Graduation</div>
																						</td>
																						<td class="text4_user">&nbsp;</td>
																						<td class="text4_user"> <span class="text2">
																								<span class="text">
																									<select name="pg_qual" id="pg_qual" tabindex="11" class="txtbox1">
																										<option value=""> Not Specified </option>
																										<?php
																										while ($edu_det2 = mysqli_fetch_array($chk_edu_det2)) {
																											if ($_SESSION['pg_qual'] == $edu_det2['education_id']) {
																										?>
																												<option value="<?php echo $edu_det2['education_id']; ?>" selected="selected"> <?php echo $edu_det2['education_name']; ?></option>
																											<?php } else { ?>
																												<option value="<?php echo $edu_det2['education_id']; ?>"> <?php echo $edu_det2['education_name']; ?></option>
																										<?php }
																										} ?>
																									</select>
																								</span> </span> </td>
																					</tr>
																					<tr class="text4_user">
																						<td height="30" class="text">
																							<div align="right"><span class="style3">Doctrate</span></div>
																						</td>
																						<td class="text4_user">&nbsp;</td>
																						<td class="text4_user"><span class="text">
																								<select name="doc_qual" id="doc_qual" tabindex="11" class="txtbox1">
																									<option value=""> Not Specified </option>
																									<?php
																									while ($edu_det3 = mysqli_fetch_array($chk_edu_det3)) {
																										if ($_SESSION['doc_qual'] == $edu_det3['education_id']) {
																									?>
																											<option value="<?php echo $edu_det3['education_id']; ?>" selected="selected"> <?php echo $edu_det3['education_name']; ?></option>
																										<?php } else { ?>
																											<option value="<?php echo $edu_det3['education_id']; ?>"> <?php echo $edu_det3['education_name']; ?></option>
																									<?php }
																									} ?>
																								</select>
																							</span></td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																		<tr id="prof_det" class="text4_user" style="display:none;">
																			<td height="30" colspan="3" class="text4_user">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
																					<tr>
																						<td>
																							<table width="98%" border="0" cellspacing="0">
																								<tr class="text">
																									<td height="20" colspan="3" class="text_user" style="padding-left:5px;">&nbsp;</td>
																								</tr>
																								<tr bgcolor="#fbfbfb" class="text">
																									<td height="20" colspan="3" class="text_bold_head" style="padding-left:5px;">Professional Details</td>
																								</tr>
																								<tr class="text">
																									<td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
																								</tr>
																								<tr bgcolor="#FFFFFF" class="text">
																									<td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
																										<div align="right">Type</div>
																									</td>
																									<td width="1%" class="text_user">&nbsp;</td>
																									<td width="81%" class="text_user"><span class="sublink">
																											<select name="prof_type" onChange="showhideDiv(this.value)">
																												<option value="" selected="selected"> Please Select </option>
																												<option value="U" <?php echo isset($_SESSION['prof_type']) == "U" ? "selected" : ""; ?>> Unemployed </option>
																												<option value="B" <?php echo isset($_SESSION['prof_type']) == "B" ? "selected" : ""; ?>> Business </option>
																												<option value="P" <?php echo isset($_SESSION['prof_type']) == "P" ? "selected" : ""; ?>> Profession </option>
																												<option value="J" <?php echo isset($_SESSION['prof_type']) == "J" ? "selected" : ""; ?>> Job </option>
																											</select>
																										</span></td>
																								</tr>
																								<tr bgcolor="#FFFFFF" class="text" id="trbusiness" style="display:none;">
																									<td height="30" colspan="3" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
																										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																											<tr>
																												<td height="25" valign="top" class="text">
																													<div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Business Category</div>
																												</td>
																												<td>&nbsp;</td>
																												<td height="25"><span class="sublink">
																														<select name="bness_cat_id" tabindex="28">
																															<option value=""> Please Select </option>
																															<?php
																															while ($cat = mysqli_fetch_array($check_cat)) {
																																if ($_SESSION['bness_cat_id'] == $cat['sub_id']) {
																															?>
																																	<option value="<?php echo $cat['sub_id']; ?>" selected="selected"> <?php echo $cat['group_name']; ?> </option>
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
																												<td height="25" valign="top" class="text">
																													<div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Industry</div>
																												</td>
																												<td id="tdsubcat">&nbsp;</td>
																												<td height="25" id="tdsubcat"><span class="sublink">
																														<select name="bness_subcat_id" tabindex="29">
																															<option value=""> Please Select </option>
																															<?php
																															while ($ind = mysqli_fetch_array($check_ind)) {
																																if ($_SESSION['bness_subcat_id'] == $ind['ind_id']) {
																															?>
																																	<option value="<?php echo $ind['ind_id']; ?>" selected="selected"> <?php echo $ind['ind_value']; ?> </option>
																																<?php 	} else { ?>
																																	<option value="<?php echo $ind['ind_id']; ?>"> <?php echo $ind['ind_value']; ?> </option>
																															<?php
																																}
																															}
																															?>
																														</select>
																													</span></td>
																											</tr>
																											<tr bgcolor="#FFFFFF" class="text">
																												<td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
																													<div align="right">Business Name </div>
																												</td>
																												<td width="1%" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
																												<td width="83%" class="text_user"><span class="sublink">
																														<input name="bness_name" type="text" class="txtbox1" tabindex="1" value="<?php echo isset($_SESSION['bness_name']) ? $_SESSION['bness_name'] : ""; ?>" size="50" />
																													</span></td>
																											</tr>
																										</table>
																									</td>
																								</tr>
																								<tr bgcolor="#FFFFFF" class="text" id="trprof" style="display:none;">
																									<td height="30" colspan="3" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
																										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																											<tr bgcolor="#FFFFFF" class="text">
																												<td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
																													<div align="right">Profession Name </div>
																												</td>
																												<td width="1%" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
																												<td width="83%" class="text_user"><span class="sublink">
																														<select name="prof_cat_id" onChange="getSubCat(this.value,'','prof_subcat_id','tdprofcat');">
																															<option value=""> Please Select </option>
																															<?php
																															while ($prof = mysqli_fetch_array($check_cat1)) {
																																if ($_SESSION['prof_cat_id'] == $prof['sub_id']) {
																															?>
																																	<option value="<?php echo $prof['sub_id']; ?>" selected="selected"> <?php echo $prof['group_name']; ?> </option>
																																<?php 	} else { ?>
																																	<option value="<?php echo $prof['sub_id']; ?>"> <?php echo $prof['group_name']; ?> </option>
																															<?php
																																}
																															}
																															?>
																														</select>
																													</span></td>
																											</tr>
																											<tr bgcolor="#FFFFFF" class="text">
																												<td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
																													<div align="right">Specialization</div>
																												</td>
																												<td bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
																												<td class="text_user" id="tdprofcat"><span class="sublink">
																														<select name="prof_subcat_id">
																															<option value=""> Please Select </option>
																														</select>
																													</span></td>
																											</tr>
																										</table>
																									</td>
																								</tr>
																								<tr bgcolor="#FFFFFF" class="text" id="trjob" style="display:none;">
																									<td height="30" colspan="3" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
																										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																											<tr>
																												<td height="25" valign="top" class="text">
																													<div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Job Type </div>
																												</td>
																												<td>&nbsp;</td>
																												<td height="25"><span class="sublink">
																														<select name="job_type" tabindex="28">
																															<option value=""> Please Select </option>
																															<?php
																															while ($jobtype = mysqli_fetch_array($check_jobtype)) {
																																if ($_SESSION['job_type'] == $jobtype['sub_id']) {
																															?>
																																	<option value="<?php echo $jobtype['sub_id']; ?>" selected="selected"> <?php echo $jobtype['group_name']; ?> </option>
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
																												<td height="25" valign="top" class="text">
																													<div align="right" class="style3" style="color: #000000;" #invalid_attr_id="12px/100% Arial, Helvetica, sans-serif">Industry</div>
																												</td>
																												<td id="tdsubcat">&nbsp;</td>
																												<td height="25" id="tdsubcat"><span class="sublink">
																														<select name="job_ind_id" tabindex="29">
																															<option value=""> Please Select </option>
																															<?php
																															while ($j_ind = mysqli_fetch_array($check_ind_job)) {
																																if ($_SESSION['job_ind_id'] == $j_ind['ind_id']) {
																															?>
																																	<option value="<?php echo $j_ind['ind_id']; ?>" selected="selected"> <?php echo $j_ind['ind_value']; ?> </option>
																																<?php 	} else { ?>
																																	<option value="<?php echo $j_ind['ind_id']; ?>"> <?php echo $j_ind['ind_value']; ?> </option>
																															<?php
																																}
																															}
																															?>
																														</select>
																													</span></td>
																											</tr>
																											<tr bgcolor="#FFFFFF" class="text">
																												<td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
																													<div align="right">Company Name </div>
																												</td>
																												<td width="1%" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
																												<td width="84%" class="text_user"><span class="sublink">
																														<input name="comp_name" type="text" class="txtbox1" tabindex="1" value="<?php echo isset($_SESSION['comp_name']) ? $_SESSION['comp_name'] : ""; ?>" size="50" />
																													</span></td>
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
																		<tr class="text4_user">
																			<td height="30" class="text4_user">&nbsp;</td>
																			<td width="1%" height="30" class="text4_user">&nbsp;</td>
																			<td width="81%" height="30" class="text4_user"><input type="submit" value="Click here to Search"></td>
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
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="25%" class="text_bold_head">&nbsp;</td>
															<td>
																<div align="right"> </div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr valign="top">
												<td width="1%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
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
			<td valign="top" bgcolor="#000000">&nbsp;</td>
		</tr>
	</table>
	<script>
		showhideFields('<?php echo $_SESSION["selSearchType"]; ?>');

		var bness_cat_id = "<?php echo $_SESSION['bness_cat_id']; ?>";

		var prof_cat_id = "<?php echo $_SESSION['prof_cat_id']; ?>";

		var prof_subcat_id = "<?php echo $_SESSION['prof_subcat_id']; ?>";
		getSubCat(prof_cat_id, '', 'prof_subcat_id', 'tdprofcat', prof_subcat_id);

		showhideDiv("<?php echo $_SESSION['prof_type']; ?>");
	</script>
	<!-- End ImageReady Slices -->
</body>

</html>