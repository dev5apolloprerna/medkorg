<?php
ob_start();
error_reporting(E_ALL);
//require 'noentry.php';
require 'connection/conn.php';
session_start();

function sqltocsv($cn, $strhead, $opposite_gender_sql, $dir_nm, $fields)
{
    $chkres = mysqli_query($cn, $opposite_gender_sql);
    $numres = mysqli_num_rows($chkres);
    $strcsv = $strhead . "\n";

    $rs = array();
    while ($rec = mysqli_fetch_assoc($chkres)) {
        //echo '<pre>'; print_r($rec);
        $r['id'] = $rec['id'];
        $r['village_name'] = $rec['village_name'];

        //$r['user_id'] = $rec['user_id'];
        $r['gotra_name'] = $rec['gotra_name'];
        $r['reg_date'] = date('d-m-Y', strtotime($rec['reg_date']));

        // Full Name
        $r['full_name'] = trim($rec['fname_vc'] . " " . $rec['parent_first_name'] . " " . $rec['ancestor_first_name'] . " " . $rec['lname_vc']);
        
        $r['father_Name'] = $rec['father_Name'];
        $r['motherName'] = $rec['motherName'];
        $r['MotherFathersName'] = $rec['MotherFathersName'];
        $r['motherFathersNative'] = ($rec['MotherFathersNative'] == -1) ? "Out of MEDK" : $rec['motherFathersNative'];
        
        $r['mobile_number'] = $rec['mobile_number'];
        $r['email'] = $rec['email'];
        $r['father_mobile_number'] = $rec['father_mobile_number'];
        
        $r['motherMobile'] = $rec['motherMobile'];
        
         // Age Calculation
        $ageYear = "";
        if (!empty($rec['birth_time']) && $rec['birth_time'] != '0000-00-00') {
            $birthDate = new DateTime($rec['birth_time']);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthDate);
            $ageYear = $age->y;
        } else {
            $ageYear = !empty($rec['age']) ? $rec['age'] : "N/A";
        }
        $r['gender_age'] = $rec['gender_c'] . ', ' . $ageYear . ' yrs';

        // DOB & Birthplace
        $r['dob'] = ($rec['birth_time'] != '0000-00-00') ? date('d-m-Y H:i:s', strtotime($rec['birth_time'])) : '-';
        $r['birth_place'] = $rec['birth_place'];

        

        // Address
        //$r['address'] = trim($rec['addr1'] . ', ' . $rec['addr2'] . ', ' . $rec['addr3'] . ', ' . $rec['city_name'] . ', ' . $rec['pincode']);
        $address_parts = array_filter([$rec['addr1'], $rec['addr2'], $rec['addr3'], $rec['city_name'], $rec['pincode']]);
        $r['address'] = trim(implode(', ', $address_parts));

       

        // Height & Weight
        $height = explode(".", $rec['height']);
        $r['height'] = isset($height[1]) ? $height[0] . ' ft ' . $height[1] . ' inch' : $height[0] . ' ft';
        $r['weight'] = $rec['weight'];

        // Blood Group
        $r['blood_group'] = $rec['blood_group'];

        // Spectacles, Mangal, and Sani
        $r['spectacles'] = ($rec['spectacles'] == 1) ? "NO" : (($rec['spectacles'] == 0) ? "Yes" : "");
        $r['mangal'] = ($rec['mangal'] == 1) ? "NO" : (($rec['mangal'] == 0) ? "Yes" : "");
        $r['sani'] = ($rec['sani'] == 1) ? "NO" : (($rec['sani'] == 0) ? "Yes" : "");
        $r['current_city'] = $rec['city_name'];
        // Marital Status
        $marital_status = [
            4 => 'Married',
            5 => 'Unmarried',
            7 => 'Widower',
            8 => 'Engaged',
            9 => 'Divorce',
            11 => 'Widow'
        ];
        $r['marital_status'] = $marital_status[$rec['marital_id']] ?? 'Unknown';

        // **Education**
        $r['basic_qualification'] = $rec['basicqual'] . (!empty($rec['bq_det']) ? " (" . $rec['bq_det'] . ")" : "");
        $r['post_graduate'] = $rec['pgqual'] . (!empty($rec['pg_det']) ? " (" . $rec['pg_det'] . ")" : "");
        $r['doctorate'] = $rec['docqual'] . (!empty($rec['doc_det']) ? " (" . $rec['doc_det'] . ")" : "");

        // **Professional Type**
        $prof_types = [
            'B' => 'Business',
            'H' => 'House Maker',
            'S' => 'Student',
            'P' => 'Self Employed',
            'J' => 'Job',
            'R' => 'Retired'
        ];
        $r['profession_type'] = $prof_types[$rec['prof_type']] ?? 'Not specified';
        $r['annual_income'] = $rec['annual_income'];

 $r['business_category'] = ($rec['prof_type'] == 'B') ? $rec['b_main_group_name'] ?? "" : "";
$r['industry'] = ($rec['prof_type'] == 'B') ? $rec['ind_name'] ?? "" : "";
$r['business_name'] = ($rec['prof_type'] == 'B') ? $rec['bness_name'] ?? "" : "";
$r['business_phone'] = ($rec['prof_type'] == 'B') ? $rec['bness_phone'] ?? "" : "";
$r['business_mobile'] = ($rec['prof_type'] == 'B') ? $rec['bness_mobile'] ?? "" : "";
$r['business_description'] = ($rec['prof_type'] == 'B') ? $rec['bness_desc'] ?? "" : "";

// **Job Details**
$r['job_type'] = ($rec['prof_type'] == 'J') ? $rec['j_group_name'] ?? "" : "";
$r['job_ind_name'] = ($rec['prof_type'] == 'J') ? $rec['job_ind_name'] ?? "" : "";
$r['company_name'] = ($rec['prof_type'] == 'J') ? $rec['comp_name'] ?? "" : "";
$r['designation'] = ($rec['prof_type'] == 'J') ? $rec['job_desig'] ?? "" : "";
$r['job_phone'] = ($rec['prof_type'] == 'J') ? $rec['job_phone'] ?? "" : "";
$r['job_mobile'] = ($rec['prof_type'] == 'J') ? $rec['job_mobile'] ?? "" : "";

// Combine job address fields
$job_address_parts = array_filter([$rec['job_addr1'] ?? "", $rec['job_addr2'] ?? "", $rec['job_addr3'] ?? ""]);

$r['job_addr'] = ($rec['prof_type'] == 'J') ? $rec['job_addr'] ?? "" : "";
$r['job_addr1'] = ($rec['prof_type'] == 'J') ? implode(', ', $job_address_parts) : "";
//$r['job_city'] = ($rec['prof_type'] == 'J') ? $rec['jcity'] ?? "" : "";
//['job_state'] = ($rec['prof_type'] == 'J') ? $rec['jstate'] ?? "" : "";
//$r['job_pincode'] = ($rec['prof_type'] == 'J') ? $rec['job_pincode'] ?? "" : "";


// **Self-Employed Details**
$r['p_main_group_name'] = ($rec['prof_type'] == 'P') ? $rec['p_main_group_name'] ?? "" : "";
$r['p_sub_group_name'] = ($rec['prof_type'] == 'P') ? $rec['p_sub_group_name'] ?? "" : "";
$r['prof_addr'] = ($rec['prof_type'] == 'P') ? $rec['prof_addr'] ?? "" : "";
$r['prof_phone'] = ($rec['prof_type'] == 'P') ? $rec['prof_phone'] ?? "" : "";
$r['prof_mobile'] = ($rec['prof_type'] == 'P') ? $rec['prof_mobile'] ?? "" : "";
 $r['prof_desc'] = ($rec['prof_type'] == 'P') ? $rec['prof_desc'] ?? "" : "";

// Combine professional address fields
$prof_address_parts = array_filter([$rec['job_addr1'] ?? "", $rec['job_addr2'] ?? "", $rec['job_addr3'] ?? ""]);
$r['professional_address'] = ($rec['prof_type'] == 'P') ? implode(', ', $prof_address_parts) : "";


 

        $rs[] = $r;
    }

    // Convert data to CSV format
    foreach ($rs as $row) {
        $row_data = [];
        foreach ($row as $col) {
            $row_data[] = '"' . str_replace('"', '""', $col) . '"';
        }
        $strcsv .= implode(",", $row_data) . "\n";
    }

    // Set headers for file download
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=matrimony.csv");
    
    return $strcsv;
}






 if(isset($_REQUEST['myId']) && $_REQUEST['myId'] != ""){
        $where .= " and matrimony.id=".$_REQUEST['myId'];
    }
    if(isset($_REQUEST['fromHeight']) && $_REQUEST['fromHeight'] != ""){
        $where .= " and matrimony.height>=".$_REQUEST['fromHeight'];
    }
    if(isset($_REQUEST['toHeight']) && $_REQUEST['toHeight'] != ""){
        $where .= " and matrimony.height<=".$_REQUEST['toHeight'];
    }
    if(isset($_REQUEST['fromWeight']) && $_REQUEST['fromWeight'] != ""){
        $where .= " and matrimony.weight>=".$_REQUEST['fromWeight'];
    }
    if(isset($_REQUEST['toWeight']) && $_REQUEST['toWeight'] != ""){
        $where .= " and matrimony.weight<=".$_REQUEST['toWeight'];
    }
    if(isset($_REQUEST['gotraId']) && $_REQUEST['gotraId'] != ""){
        $where .= " and vastipatrak_m.gotra_id not in (".$_REQUEST['gotraId'].")";
    }
    
    if(isset($_REQUEST['cityId']) && $_REQUEST['cityId'] != ""){
        $where .= " and vastipatrak_m.city=".$_REQUEST['cityId'];
    }
    
    if(isset($_REQUEST['mangalId']) && $_REQUEST['mangalId'] != ""){
        $where .= " and matrimony.mangal=".$_REQUEST['mangalId'];
    }
    
    if(isset($_REQUEST['saniId']) && $_REQUEST['saniId'] != ""){
        $where .= " and matrimony.sani=".$_REQUEST['saniId'];
    }
    
    if(isset($_REQUEST['fromAge']) && $_REQUEST['fromAge'] != ""){
        $ageFrom = $_REQUEST['fromAge']; 
        $currentDate = date('Y-12-31');
        $birthDateFrom = date('Y-m-d', strtotime("-$ageFrom years", strtotime($currentDate)));
        $where .= " and matrimony.birth_time<='".$birthDateFrom."'";
    }
    if(isset($_REQUEST['toAge']) && $_REQUEST['toAge'] != ""){
        $currentDate = date('Y-01-01');
        $ageTo = $_REQUEST['toAge'];
        $birthDateTo = date('Y-m-d', strtotime("-$ageTo years", strtotime($currentDate)));
        $where .= " and matrimony.birth_time>='".$birthDateTo."'";
    }
    
    if(isset($_REQUEST['Graduate']) && $_REQUEST['Graduate'] != ""){
        $where .= " and edu1.education_id=".$_REQUEST['Graduate'];
    }
    if(isset($_REQUEST['PostGraduate']) && $_REQUEST['PostGraduate'] != ""){
        $where .= " and edu2.education_id=".$_REQUEST['PostGraduate'];
    }
    if(isset($_REQUEST['Doctrate']) && $_REQUEST['Doctrate'] != ""){
        $where .= " and edu3.education_id=".$_REQUEST['Doctrate'];
    }
    
    if(isset($_REQUEST['gender']) && $_REQUEST['gender'] != ""){
        $where .= " and vastipatrak_m.gender_c = '".$_REQUEST['gender']."'";
    }
 $opposite_gender_sql = "SELECT 
        matrimony.*, 
        vastipatrak_m.*, 
        gotra_m.*, 
        village_m.*,
        
        parent.vasti_id AS parent_id,
    
        CASE 
            WHEN parent.vasti_id = ancestor.vasti_id THEN parent.fname_vc
            ELSE parent.fname_vc
        END AS parent_first_name,
        
        CASE 
            WHEN parent.vasti_id = ancestor.vasti_id THEN parent.mname_vc
            ELSE parent.mname_vc
        END AS parent_middle_name,
        
        CASE 
            WHEN parent.vasti_id = ancestor.vasti_id THEN parent.lname_vc
            ELSE parent.lname_vc
        END AS parent_last_name,
        
        parent.mobile_number AS parent_mobile_number,
    
        CASE 
            WHEN parent.vasti_id != ancestor.vasti_id THEN ancestor.fname_vc
            ELSE NULL
        END AS ancestor_first_name,
        
        CASE 
            WHEN parent.vasti_id != ancestor.vasti_id THEN ancestor.mname_vc
            ELSE NULL
        END AS ancestor_middle_name,
        
        CASE 
            WHEN parent.vasti_id != ancestor.vasti_id THEN ancestor.lname_vc
            ELSE NULL
        END AS ancestor_last_name,
        edu1.education_name as basicqual,edu2.education_name as pgqual,edu3.education_name as docqual,
        bc.group_name as b_main_group_name,
        ind.ind_value as ind_name,
        bdir.bness_name,bdir.prof_type,MFN.village_name as motherFathersNative,
        jobc.group_name as j_group_name, jobind.ind_value as job_ind_name,
        bdir.prof_desc,bdir.comp_name,bdir.job_type,bdir.job_ind_id,
      bdir.job_desig,bdir.job_addr,bdir.job_phone,bdir.job_mobile,
      bdir.job_addr1,bdir.job_addr2,bdir.job_addr3,bdir.job_country,
      bdir.job_state,bdir.job_city,bdir.job_district,bdir.job_pincode,
      pc.group_name as p_main_group_name,pc1.group_name as p_sub_group_name,
      (select concat(parent.mobile_number,',',parent.mobile_home, ',', parent.alt_mobile) from vastipatrak_m AS parent where parent.vasti_id = vastipatrak_m.parent_id) as fathermobilenumber,
      (select m.mobile_number from vastipatrak_m as m where m.anc_id=vastipatrak_m.anc_id and m.relation_id in (10,13) and m.gender_c='female' order by m.vasti_id desc limit 1) as motherMobile,
      city.city_name,
      (select concat(m.fname_vc,' ',m.mname_vc,' ',m.lname_vc) from vastipatrak_m as m where m.anc_id=vastipatrak_m.anc_id and m.relation_id in (10,13) and m.gender_c='female' order by m.vasti_id desc limit 1) as motherName,
      (select parent.mobile_number from vastipatrak_m AS parent where parent.vasti_id = vastipatrak_m.anc_id) as father_mobile_number,
    					(select concat(parent.fname_vc,' ',parent.mname_vc,' ',parent.lname_vc) from vastipatrak_m AS parent where parent.vasti_id = vastipatrak_m.anc_id) as father_Name
    FROM matrimony 
    INNER JOIN vastipatrak_m 
        ON vastipatrak_m.vasti_id = matrimony.user_id
    
    INNER JOIN gotra_m 
        ON gotra_m.gotra_id = vastipatrak_m.gotra_id
    INNER JOIN village_m 
        ON village_m.village_id = vastipatrak_m.village_id
        
    LEFT JOIN vastipatrak_m AS parent 
        ON vastipatrak_m.parent_id = parent.vasti_id
    LEFT JOIN vastipatrak_m AS ancestor 
        ON vastipatrak_m.anc_id = ancestor.vasti_id
    left outer join city_m city on vastipatrak_m.city = city.city_id
    
    left outer join education_m edu1 on vastipatrak_m.basic_qual = edu1.education_id
    left outer join education_m edu2 on vastipatrak_m.pg_qual = edu2.education_id
    left outer join education_m edu3 on vastipatrak_m.doc_qual = edu3.education_id
    left outer join businessdir_m bdir on vastipatrak_m.vasti_id = bdir.vasti_id
    left outer join bdir_category bc on bdir.bness_cat_id = bc.sub_id
    left outer join industry_m ind on bdir.bness_subcat_id = ind.ind_id
    left outer join bdir_category pc on bdir.prof_cat_id = pc.sub_id
    left outer join bdir_category pc1 on bdir.prof_subcat_id = pc1.sub_id
    left outer join bdir_category jobc on bdir.job_type = jobc.sub_id
    left outer join industry_m jobind on bdir.job_ind_id = jobind.ind_id
    LEFT JOIN village_m as MFN
        ON MFN.village_id = matrimony.MotherFathersNative
    WHERE vastipatrak_m.marital_id not  in (4,8)  ".$where."
    order by vastipatrak_m.reg_date DESC";
    
    
    
    $check_res = mysqli_query($cn, $opposite_gender_sql) or die(mysqli_error($cn));
    $row_cnt = mysqli_num_rows($check_res);
    
   
   
    
	$header_row = "";	
	$header_row .= '"My Id",';
	$header_row .= '"Native",';
	$header_row .= '"Gotra",';
	$header_row .= '"RegDate",';
	$header_row .= '"Name",';
	$header_row .= '"Father Name",';
	$header_row .= '"Mother Name",';
	$header_row .= '"Mother Father Name",';
	$header_row .= '"Mother Father Native",';
	$header_row .= '"Selft Mo. Num",';
	$header_row .= '"Self Email",';
	$header_row .= '"Father Mo. Num",';
	$header_row .= '"Mother Mo. Num",';
	$header_row .= '"Gender/Age",';
	$header_row .= '"DOB",';
	$header_row .= '"Birth Place",';
	$header_row .= '"Add",';
	$header_row .= '"H",';
	$header_row .= '"W",';
	$header_row .= '"Blood Group",';
	$header_row .= '"Spectacles",';
	$header_row .= '"Mangal",';
	$header_row .= '"Mangal",';
	$header_row .= '"Current City",';
	$header_row .= '"Marital",';
	$header_row .= '"Basic/ Graduate",';
	$header_row .= '"Post Graduate",';
	$header_row .= '"Doctrate",';
	$header_row .= '"Type",';
	$header_row .= '"Annual Income",';
    $header_row .= '"Bus. Cat:",';
    $header_row .= '"Industry:",';
    $header_row .= '"Bus. Name:",';
    $header_row .= '"Con. Num. 1",';
    $header_row .= '"Con. Num. 2:",';
    $header_row .= '"Description",';
    $header_row .= '"Job Type",';
	$header_row .= '"Industry",';
	$header_row .= '"Comp. Name",';
	$header_row .= '"Desgination",';
	$header_row .= '"Ph. No",';
	$header_row .= '"Mo. No",';
	$header_row .= '"Office Add",';
	$header_row .= '"Add",';
    $header_row .= '"Prof. Name",';
	$header_row .= '"Spec",';
	$header_row .= '"Office Add",';
	$header_row .= '"Ph. No",';
	$header_row .= '"Mo No",';
	$header_row .= '"Description",';
	$header_row .= '"Add",';
    
    

	
	

	$strhead = $header_row;
	$fields = $header_row;

	$strhead = substr($strhead, 0, strlen($strhead) - 1);
	$dir_nm = "Data CSV";
	echo (sqltocsv($cn, $strhead, $opposite_gender_sql, $dir_nm, $fields));
	exit;

?>

