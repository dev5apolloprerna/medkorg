<?php
ob_start();
require 'connection/conn.php';
if ($_GET['act'] == 'getsubcat') {
	$data = "";
	$catcode = $_REQUEST['catcode'];
	$subCat = $_REQUEST['subcode'];
	$cmbnm = $_REQUEST['cmbnm'];
	$oldcode = $_REQUEST['oldcode'];

	$strsql = "select * from bdir_category where main_id='" . $catcode . "' order by group_name";
	$check_res = mysqli_query($cn, $strsql);

	$data .= "<select name=$cmbnm id=$cmbnm class='txtbox'  >";
	$data .= "<option value=\"0\">Please Select</option>";
	while ($rec = mysqli_fetch_assoc($check_res)) {
		if ($oldcode == $rec['sub_id'])
			$data .= "<option selected value=\"{$rec['sub_id']}\">" . $rec['group_name'] . "</option>";
		else
			$data .= "<option value=\"{$rec['sub_id']}\">" . $rec['group_name'] . "</option>";
	}
	$data .= "</select>";

	echo $data;
	exit;
}

if ($_GET['act'] == "getstate") {
	$data = "";
	$countrycode = $_REQUEST['countrycode'];
	$statecode = $_REQUEST['statecode'];

	$strsql = "select * from state_m where country_id='" . $countrycode . "'  order by state_name";
	$check_res = mysqli_query($cn, $strsql);


	$data .= "<option value=\"0\">Select State</option>";
	while ($rec = mysqli_fetch_assoc($check_res)) {
		if ($statecode == $rec['state_id']) {
			$data .= "<option value=\"{$rec['state_id']}\" selected>" . $rec['state_name'] . "</option>";
		} else {
			$data .= "<option value=\"{$rec['state_id']}\">" . $rec['state_name'] . "</option>";
		}
	}

	echo $data;
}

if ($_GET['act'] == "getcity") {
	$data = "";
	$statecode = $_REQUEST['statecode'];
	$citycode = $_REQUEST['citycode'];

	$strsql = "select * from city_m where state_id='" . $statecode . "'  order by city_name";
	$check_res = mysqli_query($cn, $strsql);

	$data .= "<select name=\"city\" id=\"City\" class='required_sel txtbox' style='width:185px;'>";
	$data .= "<option value=\"0\">Select City</option>";
	while ($rec = mysqli_fetch_assoc($check_res)) {
		if ($citycode == $rec['city_id']) {
			$data .= "<option value=\"{$rec['city_id']}\" selected>" . $rec['city_name'] . "</option>";
		} else {
			$data .= "<option value=\"{$rec['city_id']}\">" . $rec['city_name'] . "</option>";
		}
	}
	$data .= "</select>";
	echo $data;
}

if ($_GET['act'] == "getjstate") {
	$data = "";
	$countrycode = $_REQUEST['countrycode'];
	$statecode = $_REQUEST['statecode'];

	$strsql = "select * from state_m where country_id='" . $countrycode . "' order by state_name";
	$check_res = mysqli_query($cn, $strsql);

	$data .= "<select name=\"job_state\" id=\"State\" class='required_sel txtbox' style='width:185px;' onchange='getJobCity(this.value);'>";
	$data .= "<option value=\"0\">Select State</option>";
	while ($rec = mysqli_fetch_assoc($check_res)) {
		if ($statecode == $rec['state_id']) {
			$data .= "<option value=\"{$rec['state_id']}\" selected>" . $rec['state_name'] . "</option>";
		} else {
			$data .= "<option value=\"{$rec['state_id']}\">" . $rec['state_name'] . "</option>";
		}
	}
	$data .= "</select>";
	echo $data;
}

if ($_GET['act'] == "getjcity") {
	$data = "";
	$statecode = $_REQUEST['statecode'];
	$citycode = $_REQUEST['citycode'];

	$strsql = "select * from city_m where state_id='" . $statecode . "'  order by city_name";
	$check_res = mysqli_query($cn, $strsql);

	$data .= "<select name=\"job_city\" id=\"City\" class='required_sel txtbox' style='width:185px;'>";
	$data .= "<option value=\"0\">Select City</option>";
	while ($rec = mysqli_fetch_assoc($check_res)) {
		if ($citycode == $rec['city_id']) {
			$data .= "<option value=\"{$rec['city_id']}\" selected>" . $rec['city_name'] . "</option>";
		} else {
			$data .= "<option value=\"{$rec['city_id']}\">" . $rec['city_name'] . "</option>";
		}
	}
	$data .= "</select>";
	echo $data;
}

if ($_GET['act'] == "getedudet") {
	$data = "";
	$val = $_REQUEST['val'];

	$strsql = "select * from education_m where education_id ='" . $val . "'";
	$check_res = mysqli_query($cn, $strsql);
	$dt = mysqli_fetch_array($check_res);
	$data = $dt['show_det_field'];
	echo $data;
}

if ($_GET['act'] == "chkuserexistence") {
	$data = "";

	$fname = $_REQUEST['fname'];
	$mname = $_REQUEST['mname'];
	$lname = $_REQUEST['lname'];
	$native = $_REQUEST['native'];
	$gotra = $_REQUEST['gotra'];
	$dob = $_REQUEST['dob'];

	$strsql = "select * from vastipatrak_m where ";
	$strsql .=	"fname_vc = '" . $fname . "'";
	$strsql .=	" and mname_vc = '" . $mname . "'";
	$strsql .=	" and lname_vc = '" . $lname . "'";
	$strsql .=	" and village_id = '" . $native . "'";
	$strsql .=	" and gotra_id = '" . $gotra . "'";
	$strsql .=	" and birth_date = '" . $dob . "'";

	$check_res = mysqli_query($cn, $strsql);
	$num_rows = mysqli_num_rows($check_res);
	echo $num_rows;
}
