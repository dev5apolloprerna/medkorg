<?php

include_once "admin/connection/conn.php";
include_once "mnu_main.php";

function sqltocsv($cn, $strhead, $strsql, $dir_nm, $fields)
{
	$chkres = mysqli_query($cn, $strsql);
	$numres = mysqli_num_rows($chkres);

	$strcsv = "";
	$strcsv = $strhead . "\n";

	$rs = array();
	while ($rec = mysqli_fetch_assoc($chkres)) {
		if (in_array("v.fname_vc", $_POST['chk_fields']))
			$r['fname_vc'] = ucwords(strtolower($rec['fname_vc']));


		if (in_array("v.mname_vc", $_POST['chk_fields'])) {
			//  Middle Name //
			if ($rec['mname_vc'] == "")
				$r['mname_vc'] = ucwords(strtolower($rec['parfname']));
			else
				$r['mname_vc'] = ucwords(strtolower($rec['mname_vc']));
		}

		if (in_array("v.lname_vc", $_POST['chk_fields'])) {
			//  Last Name //
			if ($rec['lname_vc'] == "" && $rec['parlname'] == "")
				$r['lname_vc'] = ucwords(strtolower($rec['mainparlname']));
			else if ($rec['lname_vc'] == "" && $rec['parlname'] != "")
				$r['lname_vc'] = ucwords(strtolower($rec['parlname']));
			else
				$r['lname_vc'] = ucwords(strtolower($rec['lname_vc']));
		}

		if (in_array("v.addr1", $_POST['chk_fields'])) {
			//  Address 1 //
			if ($rec['addr1'] == "" && $rec['paraddr1'] == "")
				$r['addr1'] = ucwords(strtolower($rec['mainparaddr1']));
			else if ($rec['addr1'] == "" && $rec['paraddr1'] != "")
				$r['addr1'] = ucwords(strtolower($rec['paraddr1']));
			else
				$r['addr1'] = ucwords(strtolower($rec['addr1']));
		}

		if (in_array("v.addr2", $_POST['chk_fields'])) {
			//  Address 2 //
			if ($rec['addr2'] == "" && $rec['paraddr2'] == "")
				$r['addr2'] = ucwords(strtolower($rec['mainparaddr2']));
			else if ($rec['addr2'] == "" && $rec['paraddr2'] != "")
				$r['addr2'] = ucwords(strtolower($rec['paraddr2']));
			else
				$r['addr2'] = ucwords(strtolower($rec['addr2']));
		}

		if (in_array("v.addr3", $_POST['chk_fields'])) {
			//  Address 3 //
			if ($rec['addr3'] == "" && $rec['paraddr3'] == "")
				$r['addr3'] = ucwords(strtolower($rec['mainparaddr3']));
			else if ($rec['addr3'] == "" && $rec['paraddr3'] != "")
				$r['addr3'] = ucwords(strtolower($rec['paraddr3']));
			else
				$r['addr3'] = ucwords(strtolower($rec['addr3']));
		}

		if (in_array("country.country_name", $_POST['chk_fields'])) {
			//  Country //
			if ($rec['country_name'] == "" && $rec['parcountry'] == "")
				$r['country_name'] = ucwords(strtolower($rec['mainparcountry']));
			else if ($rec['country_name'] == "" && $rec['parcountry'] != "")
				$r['country_name'] = ucwords(strtolower($rec['parcountry']));
			else
				$r['country_name'] = ucwords(strtolower($rec['country_name']));
		}


		if (in_array("s.state_name", $_POST['chk_fields'])) {
			//  State //
			if ($rec['state_name'] == "" && $rec['parstate'] == "")
				$r['state_name'] = ucwords(strtolower($rec['mainparstate']));
			else if ($rec['state_name'] == "" && $rec['parstate'] != "")
				$r['state_name'] = ucwords(strtolower($rec['parstate']));
			else
				$r['state_name'] = ucwords(strtolower($rec['state_name']));
		}

		if (in_array("city.city_name", $_POST['chk_fields'])) {
			// City //
			if ($rec['city_name'] == "" && $rec['parcity'] == "")
				$r['city_name'] = ucwords(strtolower($rec['mainparcity']));
			else if ($rec['city_name'] == "" && $rec['parcity'] != "")
				$r['city_name'] = ucwords(strtolower($rec['parcity']));
			else
				$r['city_name'] = ucwords(strtolower($rec['city_name']));
		}

		if (in_array("v.district", $_POST['chk_fields'])) {
			// DISTRICT //
			if ($rec['district'] == "" && $rec['pardistrict'] == "")
				$r['district'] = ucwords(strtolower($rec['mainpardistrict']));
			else if ($rec['district'] == "" && $rec['pardistrict'] != "")
				$r['district'] = ucwords(strtolower($rec['pardistrict']));
			else
				$r['district'] = ucwords(strtolower($rec['district']));
		}

		if (in_array("v.pincode", $_POST['chk_fields'])) {
			// PINCODE //
			if ($rec['pincode'] == "" && $rec['parpincode'] == "")
				$r['pincode'] = ucwords(strtolower($rec['mainparpincode']));
			else if ($rec['pincode'] == "" && $rec['parpincode'] != "")
				$r['pincode'] = ucwords(strtolower($rec['parpincode']));
			else
				$r['pincode'] = $rec['pincode'];
		}

		if (in_array("v.mobile_number", $_POST['chk_fields'])){
			
				$r['mobile_number'] = $rec['mobile_home']."|".$rec['mobile_number'];
			
		}
			

		if (in_array("village_m.village_name", $_POST['chk_fields']))
			$r['village_name'] = $rec['village_name'];

		if (in_array("v.email", $_POST['chk_fields']))
			$r['email'] = strtolower($rec['email']);

		if (in_array("v.birth_date", $_POST['chk_fields']))
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

	$dir_nm = str_replace(" ", "_", $dir_nm);

	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition:  attachment; filename=" . $dir_nm . ".csv");
	echo $strcsv;

	exit;

	//return $strcsv;
}

//$dir_code = "9";
if ($_POST) {
	$dir_code = $_GET['dirid'];
	$dir_nm = $_GET['dirnm'];

	$fields = implode(",", $_POST['chk_fields']);


	if (in_array("v.fname_vc", $_POST['chk_fields']))
		$header_row .= '"First Name",';
	if (in_array("v.mname_vc", $_POST['chk_fields']))
		$header_row .= '"Middle Name",';
	if (in_array("v.lname_vc", $_POST['chk_fields']))
		$header_row .= '"Last Name",';
	if (in_array("v.addr1", $_POST['chk_fields']))
		$header_row .= '"Address 1",';
	if (in_array("v.addr2", $_POST['chk_fields']))
		$header_row .= '"Address 2",';
	if (in_array("v.addr3", $_POST['chk_fields']))
		$header_row .= '"Address 3",';
	if (in_array("country.country_name", $_POST['chk_fields']))
		$header_row .= '"Country",';
	if (in_array("s.state_name", $_POST['chk_fields']))
		$header_row .= '"State",';
	if (in_array("city.city_name", $_POST['chk_fields']))
		$header_row .= '"City",';
	if (in_array("v.district", $_POST['chk_fields']))
		$header_row .= '"District",';
	if (in_array("v.pincode", $_POST['chk_fields']))
		$header_row .= '"Pincode",';
	if (in_array("v.mobile_number", $_POST['chk_fields']))
		$header_row .= '"Mobile Number",';
	if (in_array("village_m.village_name", $_POST['chk_fields']))
		$header_row .= '"Native",';
	if (in_array("v.email", $_POST['chk_fields']))
		$header_row .= '"Email ID",';
	if (in_array("v.birth_date", $_POST['chk_fields']))
		$header_row .= '"Birth Date",';
}


 $strsql = "select " . $fields . ",v.mobile_home,
					v1.fname_vc as parfname, v1.lname_vc as parlname,v1.addr1 as paraddr1,v1.addr2 as paraddr2,v1.addr3 as paraddr3,v1country.country_name as parcountry,s1.state_name as parstate,city1.city_name as parcity,v1.district as pardistrict,v1.pincode as parpincode,
					v2.lname_vc as mainparlname,v2.addr1 as mainparaddr1,v2.addr2 as mainparaddr2,v2.addr3 as mainparaddr3,v2country.country_name as mainparcountry,s2.state_name as mainparstate,city2.city_name as mainparcity,v2.district as mainpardistrict,v2.pincode as mainparpincode
				from 
					vastipatrak_m v
					left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
					left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
					
					left outer join country_m country on v.country = country.country_id
					left outer join country_m v1country on v1.country = v1country.country_id
					left outer join country_m v2country on v2.country = v2country.country_id
					
					left outer join state_m s on v.state = s.state_id
					left outer join state_m s1 on v1.state = s1.state_id
					left outer join state_m s2 on v2.state = s2.state_id
					
					left outer join city_m city on v.city = city.city_id
					left outer join city_m city1 on v1.city = city1.city_id
					left outer join city_m city2 on v2.city = city2.city_id

					left outer join village_m  on v.village_id = village_m.village_id
					left outer join village_m native1 on v1.village_id = native1.village_id
					left outer join village_m native2 on v2.village_id = native2.village_id
					
					
				where v.vasti_id in (select vasti_id from user_directory_records where dir_id=" . $dir_code . ")
					
				order by v.fname_vc, v.mname_vc, v.lname_vc";

//$strhead = '"First Name","Middle Name","Last Name","Address1","Address2","Address3","Country","State","City","District","Pincode","Mobile Number","Email ID","Birth Date"';
$strhead = $header_row;
$strhead = substr($strhead, 0, strlen($strhead) - 1);
echo (sqltocsv($cn, $strhead, $strsql, $dir_nm, $fields));
