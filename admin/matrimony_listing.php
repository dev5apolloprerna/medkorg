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

// start //
// to get code of this master .. //
$sql_code_master = "select adm_mnu_id from admin_menu where mnu_name='Vasti Patrak Master'";
$chk_code_master = mysqli_query($cn, $sql_code_master);
$tmp_code_master = mysqli_fetch_array($chk_code_master);
$adm_mnu_id = $tmp_code_master['adm_mnu_id'];

$flg_edit = "";
$flg_add = "";
$flg_del = "";

$pid = explode(",", $_SESSION["UserAdminPermissionsID"]);

if (in_array("A_" . $adm_mnu_id, $pid)) {
	$flg_add = "1";
}
if (in_array("E_" . $adm_mnu_id, $pid)) {
	$flg_edit = "1";
}
if (in_array("D_" . $adm_mnu_id, $pid)) {
	$flg_del = "1";
}
//end//
$row_cnt = 0;
//$cn = getConnection("localhost","career_career","!@#$%@@","career_searchjobs");
//$cn = getConnection("localhost","root","","samaj");		
if (!empty($_POST)) {
    
    if(isset($_POST['myId']) && $_POST['myId'] != ""){
        $where .= " and matrimony.id=".$_POST['myId'];
    }
    if(isset($_POST['fromHeight']) && $_POST['fromHeight'] != ""){
        $where .= " and matrimony.height>=".$_POST['fromHeight'];
    }
    if(isset($_POST['toHeight']) && $_POST['toHeight'] != ""){
        $where .= " and matrimony.height<=".$_POST['toHeight'];
    }
    if(isset($_POST['fromWeight']) && $_POST['fromWeight'] != ""){
        $where .= " and matrimony.weight>=".$_POST['fromWeight'];
    }
    if(isset($_POST['toWeight']) && $_POST['toWeight'] != ""){
        $where .= " and matrimony.weight<=".$_POST['toWeight'];
    }
    if(isset($_POST['gotraId']) && $_POST['gotraId'] != ""){
        $where .= " and vastipatrak_m.gotra_id not in (".$_POST['gotraId'].")";
    }
    
    if(isset($_POST['cityId']) && $_POST['cityId'] != ""){
        $where .= " and vastipatrak_m.city=".$_POST['cityId'];
    }
    
    if(isset($_POST['mangalId']) && $_POST['mangalId'] != ""){
        $where .= " and matrimony.mangal=".$_POST['mangalId'];
    }
    
    if(isset($_POST['saniId']) && $_POST['saniId'] != ""){
        $where .= " and matrimony.sani=".$_POST['saniId'];
    }
    
    if(isset($_POST['fromAge']) && $_POST['fromAge'] != ""){
        $ageFrom = $_POST['fromAge']; 
        $currentDate = date('Y-12-31');
        $birthDateFrom = date('Y-m-d', strtotime("-$ageFrom years", strtotime($currentDate)));
        $where .= " and matrimony.birth_time<='".$birthDateFrom."'";
    }
    if(isset($_POST['toAge']) && $_POST['toAge'] != ""){
        $currentDate = date('Y-01-01');
        $ageTo = $_POST['toAge'];
        $birthDateTo = date('Y-m-d', strtotime("-$ageTo years", strtotime($currentDate)));
        $where .= " and matrimony.birth_time>='".$birthDateTo."'";
    }
    
    if(isset($_POST['Graduate']) && $_POST['Graduate'] != ""){
        $where .= " and edu1.education_id=".$_POST['Graduate'];
    }
    if(isset($_POST['PostGraduate']) && $_POST['PostGraduate'] != ""){
        $where .= " and edu2.education_id=".$_POST['PostGraduate'];
    }
    if(isset($_POST['Doctrate']) && $_POST['Doctrate'] != ""){
        $where .= " and edu3.education_id=".$_POST['Doctrate'];
    }
    
    if(isset($_POST['gender']) && $_POST['gender'] != ""){
        $where .= " and vastipatrak_m.gender_c = '".$_POST['gender']."'";
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
      (select concat(m.fname_vc,' ',m.mname_vc,' ',m.lname_vc) from vastipatrak_m as m where m.anc_id=vastipatrak_m.anc_id and  m.relation_id in (10,13) and m.gender_c='female' order by m.vasti_id desc limit 1) as motherName,
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
}


/*if ($_POST) {
	$check = isset($_POST['check']) ? $_POST['check'] : '';
	$sql_string = "SELECT v.*,vill.village_name,g.gotra_name,city.city_name, city.std_code_vc, country.call_code_vc FROM vastipatrak_m v 
	 				left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join village_m vill on vill.village_id = v.village_id  					
					left outer join city_m city on v.city = city.city_id  
					left outer join country_m country on v.country = country.country_id 
					where  lineage !=1 $sqlextra";
	if (isset($_POST['check'])) {
		$sql_string .= " and parent_id=0 ";
	}
} else {
	$sql_string = "SELECT v.*,vill.village_name,g.gotra_name,city.city_name FROM vastipatrak_m v 
	 				left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join village_m vill on vill.village_id = v.village_id  					
					left outer join city_m city on v.city = city.city_id  
					where 1=2";
}*/
// $opposite_gender_sql .= " ";



/*
$_POST['check'] = "";
if ($check = 1) {
	$sql = "SELECT * FROM `vastipatrak_m`WHERE parent_id=0 AND anc_id=0";
	$chk_sql = mysqli_query($cn, $sql);
} else if ($check = 0) {
	$sql1 = "SELECT * FROM `vastipatrak_m`";
	$chk_sql1 = mysqli_query($cn, $sql1);
	print_r($chk_sql1);
	exit;
}*/
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<html>

<head>
	<title>Samaj</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/JavaScript">



		<!--
/*function checkall(field)
{
	chk=document.frm['chk[]'];
	 
	if(typeof(chk.length)=="undefined")
		chk.checked=field.checked?true:false;
	
	for(i=0;i<chk.length;i++)
	 	chk[i].checked=field.checked?true:false; 
}*/
/*function IsChecked()
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
}*/
/*function doEdit()
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
}*/

function doFilter()
{
	frmsearch.submit();
}
$(document).ready(function() {
   
    $('#exportCsvButton').click(function(event) {
    event.preventDefault();

    var formData = $('#frmSearch').serialize(); 
    var url = 'csv_matrimony.php?' + formData; 
    window.open(url, '_blank');
    // $.ajax({
    //     type: 'POST',  
    //     url: url, // Corrected URL
    //     data: formData, // Send form data
    //     success: function(response) {
    //         console.log("Server Response:", response);
    //         window.open(url, '_blank'); // Open CSV download in new tab
    //     },
    //     error: function(xhr, status, error) {
    //         console.error("AJAX Error:", status, error);
    //     }
    // });

    return false;
});

});




function doAction(act,action,code)
 {
 	if(window.confirm('Are you sure to '+action+' the Selected Records?'))
	{
		document.frm.txtMode.value=act;
		document.frm.txtDCode.value=code;
		document.frm.submit(); 
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
												<td class="h1"><span class="h1">Matrimony List </span></td>
											</tr>
											<tr valign="top">
												<td width="1%">&nbsp;</td>
												<td width="85%">
													<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr valign="top">
															<td>&nbsp;</td>
															<td class="text">
																<form name="frmSearch" id="frmSearch" method="Post" action="matrimony_listing.php">
																
																	<table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
																		<tr valign="middle" bgcolor="#666666">
																			<td height="22" colspan="3" class="text" style="padding-left:08px;">
																				<div align="left">
																					<font color="#FFFFFF"><b>Search By </b></font>
																				</div>
																				<div align="left">
																					<font color="#FFFFFF"></font>
																				</div>
																			</td>
																		</tr>
																		<tr valign="middle">
																			<script language="javascript" type="text/javascript">
																				function showHideField(v) {
																					if (v == "v.verified") {
																						document.getElementById("search_text").style.display = "none";
																						document.getElementById("search_text").value = "";

																						document.getElementById("search_sel").style.display = "";
																					} else {
																						document.getElementById("search_sel").style.display = "none";
																						document.getElementById("search_sel").value = "";

																						document.getElementById("search_text").style.display = "";
																					}
																				}
																			</script>
																			<td width="100%" class="text" style="padding-left:10px; ">
																			    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
																					<tr>
																					    <td>
																			                <input type="text" style="width: 95%;" name="myId" value="<?php echo isset($_POST['myId']) ? (($_POST['myId']) ? $_POST['myId'] : '') : ""; ?>" id="myId" placeholder="My Id" tabindex="1">		        
																					    </td>
																					    <td>
																			                <input type="text" style="width: 95%;" name="fromAge" value="<?php echo isset($_POST['fromAge']) ? (($_POST['fromAge']) ? $_POST['fromAge'] : '') : ""; ?>" id="fromAge" placeholder="From Age" tabindex="2">		        
																					    </td>
																					    <td>
																			                <input type="text" style="width: 95%;" name="toAge" value="<?php echo isset($_POST['toAge']) ? (($_POST['toAge']) ? $_POST['toAge'] : '') : ""; ?>" id="toAge" placeholder="To Age" tabindex="3">		        
																					    </td>
																				    </tr>
																				    
																				    <tr>
																					    <td>
																			                <input type="text" style="width: 95%;" name="fromHeight" value="<?php echo isset($_POST['fromHeight']) ? (($_POST['fromHeight']) ? $_POST['fromHeight'] : '') : ""; ?>" id="fromHeight" placeholder="From Height" tabindex="4">
																					    </td>
																					    <td>
																			                <input type="text" style="width: 95%;" name="toHeight" value="<?php echo isset($_POST['toHeight']) ? (($_POST['toHeight']) ? $_POST['toHeight'] : '') : ""; ?>" id="toHeight" placeholder="To Height" tabindex="5">
																					    </td>
																					    <td>
																			                <select name="gotraId" style="width: 95%;" tabindex="6" id="Gotra" class="txtrequiredsel txtbox">
            																					<option value="">Select Gotra</option>
            																					<?php
            																					$sql_stringgt = "SELECT * FROM gotra_m order by gotra_name";
            																					$check_resgt = mysqli_query($cn, $sql_stringgt) or die(mysqli_error($cn));
            																					if (mysqli_num_rows($check_resgt) > 0) {
            																						while ($rec = mysqli_fetch_array($check_resgt)) {
            																							if ($_POST['gotraId'] == $rec['gotra_id'])
            																								echo ("<option selected value ='" . $rec['gotra_id'] . "'>" . $rec['gotra_name'] . "</option>");
            																							else
            																								echo ("<option value='" . $rec['gotra_id'] . "'>" . $rec['gotra_name'] . "</option>");
            																						}
            																					}
            																					?>
            																				</select>
																					    </td>
																				    </tr>
																				    <tr>
																					    <td>
																			                <input type="text" name="fromWeight" style="width: 95%;" value="<?php echo isset($_POST['fromWeight']) ? (($_POST['fromWeight']) ? $_POST['fromWeight'] : '') : ""; ?>" id="fromWeight" placeholder="From Weight" tabindex="7">
																					    </td>
																					    <td>
																			                <input type="text" name="toHeight" style="width: 95%;" value="<?php echo isset($_POST['toHeight']) ? (($_POST['toHeight']) ? $_POST['toHeight'] : '') : ""; ?>" id="toHeight" placeholder="To Height" tabindex="8">
																					    </td>
																					    <td>
																			                <select name="gender" tabindex="9" style="width: 95%;" id="gender" class="txtrequiredsel txtbox">
            																					<option value="">Select Gender</option>
            																						<option value ='Male' <?= isset($_POST['gender']) && ($_POST['gender'] == 'Male') ? "selected" : ""; ?>>Male</option>
            																						<option value='Female' <?= isset($_POST['gender']) && ($_POST['gender'] == 'Female') ? "selected" : ""; ?>>Female</option>
            																				</select>
																					    </td>
																				    </tr>
																				    <tr>
																					    <td>
																			                <select name="Graduate" tabindex="10" style="width: 95%;" id="Graduate" class="txtrequiredsel txtbox">
            																					<option value="">Select Basic / Graduate</option>
            																					<?php
            																					$sql_string = "SELECT * FROM education_m where edu_level='Basic/Grad.' order by education_id asc";
                                                                                                $chk_edu_det1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
            																					if (mysqli_num_rows($chk_edu_det1) > 0) {
            																						while ($rec = mysqli_fetch_array($chk_edu_det1)) {
            																							if ($_POST['Graduate'] == $rec['education_id'])
            																								echo ("<option selected value ='" . $rec['education_id'] . "'>" . $rec['education_name'] . "</option>");
            																							else
            																								echo ("<option value='" . $rec['education_id'] . "'>" . $rec['education_name'] . "</option>");
            																						}
            																					}
            																					?>
            																				</select>
																					    </td>
																					    <td>
																			              <select name="PostGraduate" tabindex="11" style="width: 95%;" id="PostGraduate" class="txtrequiredsel txtbox">
            																					<option value="">Select Post Graduate</option>
            																					<?php
            																					$sql_string = "SELECT * FROM education_m where edu_level='PG' order by education_id asc";
                                                                                                $chk_edu_det2 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
            																					if (mysqli_num_rows($chk_edu_det2) > 0) {
            																						while ($rec = mysqli_fetch_array($chk_edu_det2)) {
            																							if ($_POST['PostGraduate'] == $rec['education_id'])
            																								echo ("<option selected value ='" . $rec['education_id'] . "'>" . $rec['education_name'] . "</option>");
            																							else
            																								echo ("<option value='" . $rec['education_id'] . "'>" . $rec['education_name'] . "</option>");
            																						}
            																					}
            																					?>
            																				</select>
																					    </td>
																					    <td>
																			                <select name="Doctrate" tabindex="12" style="width: 95%;" id="Doctrate" class="txtrequiredsel txtbox">
            																					<option value="">Select Doctrate</option>
            																					<?php
            																					$sql_string = "SELECT * FROM education_m where edu_level='Doctrate' order by education_id asc";
                                                                                                $chk_edu_det3 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
            																					if (mysqli_num_rows($chk_edu_det3) > 0) {
            																						while ($rec = mysqli_fetch_array($chk_edu_det3)) {
            																							if ($_POST['Doctrate'] == $rec['education_id'])
            																								echo ("<option selected value ='" . $rec['education_id'] . "'>" . $rec['education_name'] . "</option>");
            																							else
            																								echo ("<option value='" . $rec['education_id'] . "'>" . $rec['education_name'] . "</option>");
            																						}
            																					}
            																					?>
            																				</select>
																					    </td>
																				    </tr>
																				    <tr>
																					    <td>
																			                <select name="cityId" tabindex="13" style="width: 95%;" id="cityId" class="txtrequiredsel txtbox">
            																					<option value="">Select City</option>
            																					<?php
            																					$sql_city = "SELECT * FROM city_m where country_id=10 order by city_name";
                                                                                                $chk_city = mysqli_query($cn, $sql_city);
            																					if (mysqli_num_rows($chk_city) > 0) {
            																						while ($rec = mysqli_fetch_array($chk_city)) {
            																							if ($_POST['cityId'] == $rec['city_id'])
            																								echo ("<option selected value ='" . $rec['city_id'] . "'>" . $rec['city_name'] . "</option>");
            																							else
            																								echo ("<option value='" . $rec['city_id'] . "'>" . $rec['city_name'] . "</option>");
            																						}
            																					}
            																					?>
            																				</select>
																					    </td>
																					    <td>
																			                <select name="mangalId" tabindex="14" style="width: 95%;" id="mangalId" class="txtrequiredsel">
            																					<option value="">Select Mangal</option>
            																					<option value="0" <?= isset($_POST['mangalId']) && $_POST['mangalId'] == "0" ? 'selected' : '' ?>>Yes</option>
                                                                                                <option value="1" <?= isset($_POST['mangalId']) && $_POST['mangalId'] == "1" ? 'selected' : '' ?>>No</option>
            																				</select>
																					    </td>
																					    <td>
																			                <select name="saniId" tabindex="12" style="width: 95%;" id="saniId" class="txtrequiredsel">
            																					<option value="">Select Shani</option>
            																					<option value="0" <?= isset($_POST['saniId']) && $_POST['saniId'] == "0" ? 'selected' : '' ?>>Yes</option>
                                                                                                <option value="1" <?= isset($_POST['saniId']) && $_POST['saniId'] == "1" ? 'selected' : '' ?>>No</option>
            																				</select>
																					    </td>
																				    </tr>
																			    </table>
																				
																			</td>

																			<td width="4%" height="30" class="text" style="padding-left:10px; "><input type="submit" value="GO">&nbsp; <input type="button" id="exportCsvButton" value="Export to CSV">&nbsp;  </td>
																		</tr>
																	</table>
																</form>
															</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td class="text">&nbsp;</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td class="text">
															    <!--<a href="#" onlick="passdataincsv();" style="padding-left:10px; "  width="4%" height="30" class="text">Export to CSV</a>-->
																<!--<div align="right"><a href="#" onClick="javascript:doAction('A','Activate');"><?php if ($flg_add == "1") { ?> </a><a href="vastipatrak_m.php?Mode=A" class="link"> Add </a> | <?php } ?><a href="home.php" class="link">Back</a></div>-->
															</td>
														</tr>
														<tr valign="top">
															<td>&nbsp;</td>
															<td class="text">
																<div align="right">Total Record : <?= $row_cnt ?> Found</div>
															</td>
														</tr>
														<tr valign="top">
															<td width="2%">&nbsp;</td>
															<td>
																<!--<form name="frm" method="Post" action="vastipatrak_list.php">-->
																<!--<input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>" />-->
																<!--<input type="hidden" name="txtDCode" value="" />-->
																	<table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
																		<tr valign="middle" bgcolor="#666666">
																			<td width="5%" height="22" bgcolor="#666666" class="text" style="padding-left:08px;">
																				<div align="left">
																					<font color="#FFFFFF"><b>Native / Gotra</b></font>
																				</div>
																			</td>

																			<td width="15%" bgcolor="#666666" class="text" style="padding-left:08px;">
																				<div align="left">
																					<font color="#FFFFFF"><strong>Full Name </strong></font>
																				</div>
																			</td>
																			<td width="15%" class="text" style="padding-left:08px;">
																				<div align="left">
																					<font color="#FFFFFF"><b>Contact Details</b></font>
																				</div>
																			</td>
																			
																			<td width="9%" bgcolor="#666666" class="text" style="padding-left:08px;">
																				<div align="center">
																					<font color="#FFFFFF"><strong>Matrimony Details </strong></font>
																				</div>
																			</td>
																			<td width="3%" bgcolor="#666666" class="text">
																			    <div align="center">
																					<font color="#FFFFFF"><strong>Education / Current Activity </strong></font>
																				</div>
																			</td>
																			<td width="3%" bgcolor="#666666" class="text">
																			    <div align="center">
																					<font color="#FFFFFF"><strong>Photo</strong></font>
																				</div>
																			</td>
																		</tr>
																		<?php
																		while ($rec = mysqli_fetch_array($check_res)) {
																			
																		?>
																			<tr valign="middle">

																				<td height="22" class="text" style="padding-left:08px;">
																					<strong>My Id:</strong><?php echo ($rec['id']); ?><br /><br />

																					<b>Native:</b><?php echo ($rec['village_name']); ?>&nbsp;<br /><br /><b>Gotra:</b><?php echo ($rec['gotra_name']); ?>&nbsp;<br /><br />
																					<b>RegDate:</b>
                                                                                    <?php
                                                                                    if (!empty($rec['reg_date']) && strtotime($rec['reg_date'])) {
                                                                                        echo date('d-m-y', strtotime($rec['reg_date']));
                                                                                    } else {
                                                                                        echo ""; 
                                                                                    }
                                                                                    ?>

																				</td>

																				<td class="text" style="padding-top:05px;">
																					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
																						<tr>
																							<td height="30"><strong>Name: </strong> <?php echo ($rec['fname_vc'] . " " . $rec['parent_first_name'] . " " . $rec['ancestor_first_name'] . " " . $rec['lname_vc']); ?><br /><br /></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>Father Name: </strong><?php echo ($rec['father_Name']); ?><br /><br /></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>Mother Name: </strong><?php echo ($rec['motherName']); ?><br /><br /></td>
																						</tr>
																						
																						<tr>
																							<td height="30"><strong>Mother Father Name: </strong><?php echo ($rec['MotherFathersName']); ?><br /><br /></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>Mother Father Native: </strong> <?php if($rec['MotherFathersNative'] == "-1"){
                                                                                                echo "Out of MEDK";
                                                                                            } else {
                                                                                                echo $rec['motherFathersNative']; 
                                                                                            } ?>
                                                                                            </td>
																						</tr>
																					</table>
																				</td>
																				<td class="text" style="padding-top:05px;">
																					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
																					    <tr>
																							<td height="30"><strong>Selft Mo. Num.:</strong> <?php
																																		/*if ($rec['call_code_vc'] != "" && $rec['mobile_home'] != "") {
																																			echo ($rec['call_code_vc'] . "&nbsp;");
																																		}*/
																																		echo ($rec['mobile_number']); ?></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>Self Email :</strong> <?php echo ($rec['email']); ?></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>Father Mo. Num.: </strong><?php echo ($rec['father_mobile_number']); ?></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>Mother Mo. Num.: </strong><?php echo ($rec['motherMobile']); ?></td>
																						</tr>
																						
																						<tr>
																							<td height="30"><strong>Gender/Age :</strong> 
																							    <?php // echo ($rec['birth_date'] != '0000-00-00')  ? date('d-m-Y', strtotime($rec['birth_date'])) : '-'; ?>
																							    <?php 
                                                                                                    $bdate = date('d-m-Y',strtotime($rec['birth_time']));
                
                                                                                                    // Create a DateTime object from the birth date (d-m-Y format)
                                                                                                    $birthDateObj = DateTime::createFromFormat('d-m-Y', $bdate);
                                                                                                    
                                                                                                    // Get the current date
                                                                                                    $currentDate = new DateTime();
                                                                                                    
                                                                                                    // Calculate the age by getting the difference between the two dates
                                                                                                    $age = $currentDate->diff($birthDateObj);
                                                                                                    
                                                                                                    // Output the age
                                                                                                    //echo "Age: " . $age->y . " years old <br />";
                                                                                                    $ageYear = "";
                                                                                                    if($rec['age'] == ""){
                                                                                                        $ageYear = $age->y;
                                                                                                    } else {
                                                                                                        $ageYear = $rec['age'];
                                                                                                    }
                                                                                                ?>
                                                                                                <?= $rec['gender_c'] . ', ' . $ageYear . ' yrs'; ?>
																						    </td>
																						</tr>
																						<tr>
																							<td height="30"><strong>DOB :</strong> <?php echo ($rec['birth_time'] != '0000-00-00')  ? date('d-m-Y H:i:s', strtotime($rec['birth_time'])) : '-'; ?></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>Birth Place :</strong> <?php echo ($rec['birth_place']); ?></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>Add. :</strong> <?php echo $rec['addr1'] . '<br>' . $rec['addr2'] . '<br>' . $rec['addr3'] . "&nbsp;&nbsp;," . $rec['city_name'] . "<br>" . $rec['pincode']; ?></td>
																						</tr>
																						
																					</table>
																				</td>
																				
																				<td class="text">
																					<div align="center">
																						<table width="100%" border="0" cellspacing="0" cellpadding="0">

																							<tr>
																								<td height="30" class="text"><strong>H. : </strong><?php $height = explode(".", $rec['height']);
                                                                                                        echo $height[0]. ' ft '. $height[1].' inch'; ?></td>
																							</tr>
																							<tr>
																								<td height="30" class="text"><strong>W. : </strong><?php echo ($rec['weight']); 
																																							?></td>
																							</tr>
																							<tr>
																								<td height="30" class="text"><strong>Blood Group : </strong><?php echo ($rec['blood_group']); 
																																							?></td>
																							</tr>
																							
																							<tr>
																								<td height="30" class="text"><strong>Spectacles : </strong><?php if ($rec['spectacles'] == 1) {
                                                                                                                $spectacles = "NO";
                                                                                                            } else if ($rec['spectacles'] == 0) {
                                                                                                                $spectacles = "Yes";
                                                                                                            }else{
                                                                                                                $spectacles = " ";
                                                                                                            }
																											echo $spectacles;					?></td> 
																							</tr>
																							<tr>
																								<td height="30" class="text"><strong>Mangal : </strong><?php if ($rec['mangal'] == 1) {
                                                                                                            $mangal = "NO";
                                                                                                        } else if ($rec['mangal'] == 0) {
                                                                                                            $mangal = "Yes";
                                                                                                        }else{
                                                                                                            $mangal = " ";
                                                                                                        }
																										echo $mangal;												?></td>
																							</tr>
																							<tr>
																								<td height="30" class="text"><strong>Mangal : </strong><?php if ($rec['sani'] == 1) {
                                                                                                            $sani = "NO";
                                                                                                        } else if ($rec['sani'] == 0) {
                                                                                                            $sani = "Yes";
                                                                                                        }else{
                                                                                                            $sani = "";
                                                                                                        }
                                                                                                        echo $sani;
																																							?></td>
																								
																							</tr>
																							<tr>
																								<td height="30" class="text"><strong>Current City : </strong><?php echo ($rec['city_name']); 
																																							?></td>
																							</tr>
																							<tr>
																								<td height="30" class="text"><strong>Marital : </strong><?php
    																								$marital_status = '';
    
                                                                                                    switch ($rec['marital_id']) {
                                                                                                        case 4:
                                                                                                            $marital_status = 'Married';
                                                                                                            break;
                                                                                                        case 5:
                                                                                                            $marital_status = 'Unmarried';
                                                                                                            break;
                                                                                                        case 7:
                                                                                                            $marital_status = 'Widower';
                                                                                                            break;
                                                                                                        case 8:
                                                                                                            $marital_status = 'Engaged';
                                                                                                            break;
                                                                                                        case 9:
                                                                                                            $marital_status = 'Divorce';
                                                                                                            break;
                                                                                                        case 11:
                                                                                                            $marital_status = 'Widow';
                                                                                                            break;
                                                                                                        default:
                                                                                                            $marital_status = 'Unknown';
                                                                                                            break;
                                                                                                    }
																								    echo $marital_status;														?>
																						        </td>
																							    
																							</tr>
																						</table>
																					</div>
																				</td>
																				<td class="text">
																					<div align="center">
																						<table width="100%" border="0" cellspacing="0" cellpadding="0">
																						    <tr>
																								<td height="30" class="text">
																									<div style="text-align: center;text-decoration: underline;"><strong>Education :</strong></div>
																									<strong> Basic/ Graduate: </strong><?php echo $rec['basicqual'];
                                                                                                    if ($rec['bq_det'] != "") {
                                                                                                      echo " (" . $rec['bq_det'] . ") ";
                                                                                                    } ?> 
                                                                                                <br /><br />
                                                                                                <strong>Post Graduate:</strong> <?php echo $rec['pgqual'];
                                                                                                    if ($rec['pg_det'] != "") {
                                                                                                      echo " (" . $rec['pg_det'] . ") ";
                                                                                                    } ?>
                                                                                                <br /><br />
                                                                                                <strong>Doctrate: </strong>
                                                                                                <?php echo $rec['docqual'];
                                                                                                    if ($rec['doc_det'] != "") {
                                                                                                      echo " (" . $rec['doc_det'] . ") ";
                                                                                                    } ?>
																								</td>
																							</tr>
																							<tr>
																								<td height="30" class="text">
																									<?php
																									echo "<strong>Type : </strong>";
                                                                                                        if($rec['prof_type'] == 'B'){
                                                                                                            echo "Business";
                                                                                                        } else if($rec['prof_type'] == 'H'){
                                                                                                            echo "House Maker";
                                                                                                        } else if($rec['prof_type'] == 'S'){
                                                                                                            echo "Student";https://medkorg.in/
                                                                                                        } else if($rec['prof_type'] == 'P'){
                                                                                                            echo "Self Employeds";
                                                                                                        } else if($rec['prof_type'] == 'J'){
                                                                                                            echo "Job";
                                                                                                        } else if($rec['prof_type'] == 'R'){
                                                                                                            echo "Retire";
                                                                                                        } else {
                                                                                                            echo "Not specified";
                                                                                                        }
                                                                                                        ?>
                                                                                                        <br /><br />
                                                                                                        
                                                                                                        <strong> Annual Income :</strong> <?= $rec['annual_income']; ?>
                                                                                                        <br /><br />
																								</td>
																							</tr>
																							<?php if($rec['prof_type'] == 'B'){ ?>
																							<tr>
																							    <td height="30" class="text">
																							        <div style="text-align: center;text-decoration: underline;"><strong>Current Activity:</strong></div>
																						            <strong>Bus. Cat:</strong> <?= $rec['b_main_group_name']; ?><br /><br />
																						            <strong>Industry:</strong> <?= $rec['ind_name']; ?><br /><br />
																						            <strong>Bus. Name:</strong> <?= $rec['bness_name']; ?><br /><br />
																						            <strong>Con. Num. 1:</strong> <?= $rec['bness_phone']; ?><br /><br />
																						            <strong>Con. Num. 2:</strong> <?= $rec['bness_mobile']; ?><br /><br />
																						            <strong>Description :</strong> <?= $rec['bness_desc']; ?><br /><br />
																							    </td>
																						    </tr>
																						    <?php } ?>
																						    <?php if($rec['prof_type'] == 'J'){ ?>
																						    <tr>
																						    <td height="30" class="text">
																						        <div style="text-align: center;text-decoration: underline;"><strong>Current Activity:</strong></div>
																					            <strong>Job Type:</strong> <?= $rec['j_group_name']; ?><br /><br />
																					            <strong>Industry:</strong> <?= $rec['job_ind_name']; ?><br /><br />
																					            <strong>Comp. Name:</strong> <?= $rec['comp_name']; ?><br /><br />
																					            <strong>Desgination:</strong> <?= $rec['job_desig']; ?><br /><br />
																					            <strong>Ph. No:</strong> <?= $rec['job_phone']; ?><br /><br />
																					            <strong>Mo. No :</strong> <?= $rec['job_mobile']; ?><br /><br />
																					            <strong>Office Add. :</strong> <?= $rec['job_addr']; ?><br /><br />
																					            <strong>Add. :</strong> <?php
                                                                                                
                                                                                                    echo $rec['job_addr1'];
                                                                                                    echo "<br />" . $rec['job_addr2'];
                                                                                                    echo "<br />" . $rec['job_addr3'];
                                                                                                    if ($rec['jcity'] != "" || $rec['jstate'] != "" || $rec['job_pincode'] != "") {
                                                                                                            echo ($rec['jcity']); ?>, <?php echo ($rec['jstate']); ?> - <?php echo ($rec['job_pincode']);
                                                                                                    }
                                                                                                    ?>
																						    </td>
																						    </tr>
																						    <?php } ?>
																						    <?php if($rec['prof_type'] == 'P'){ ?>
																						    <tr>
																						    <td height="30" class="text">
																						        <div style="text-align: center;text-decoration: underline;"><strong>Current Activity:</strong></div>
																					            <strong>Prof. Name:</strong> <?= $rec['p_main_group_name']; ?><br /><br />
																					            <strong>Spec:</strong> <?= $rec['p_sub_group_name']; ?><br /><br />
																					            <strong>Office Add.:</strong> <?= $rec['prof_addr']; ?><br /><br />
																					            <strong>Ph. No:</strong> <?= $rec['prof_phone']; ?><br /><br />
																					            <strong>Mo No:</strong> <?= $rec['prof_mobile']; ?><br /><br />
																					            <strong>Description:</strong> <?= $rec['job_mobile']; ?><br /><br />
																					            <strong>Add. :</strong> <?php
                                                                                                    echo $rec['job_addr1'];
                                                                                                    echo "<br />" . $rec['job_addr2'];
                                                                                                    echo "<br />" . $rec['job_addr3'];
                                                                                                    if ($rec['jcity'] != "" || $rec['jstate'] != "" || $rec['job_pincode'] != "") {
                                                                                                            echo ($rec['jcity']); ?>, <?php echo ($rec['jstate']); ?> - <?php echo ($rec['job_pincode']);
                                                                                                    }
                                                                                                    ?>
																						    </td>
																						    </tr>
																						    <?php } ?>
																						</table>
																					</div>
																				</td>
																				<td class="text" style="padding-top:05px;">
																					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
																					    <?php if(isset($rec['passport_size_photo']) && $rec['passport_size_photo'] != ""){ ?>
																						<tr>
																							<td height="30">
																							    <?php
                                                                                                $img = $rec['user_id'];
                                                                                                $img_path = $rec['passport_size_photo'];
                                                                                                ?>
                                                                                                <div class="mt-1 mb-1">
                                                                                                <img src="<?php echo '/documents/' . $img . '/passport_size_photo/' . $img_path; ?>" alt="Passport Size Photo" style="height: 100px;width: 100px;">
                                                                                                </div>
																							</td>
																						</tr>
																						<?php } 
                                                                                        if(isset($rec['full_photo']) && $rec['full_photo'] != ""){
                                                                                        ?>
																						<tr>
																							<td height="30">
																							    <div class="mt-1 mb-1">
																							        <img src="<?php echo '/documents/' . $img . '/full_photo/' . $rec['full_photo']; ?>" alt="User Document" style="height: 100px;width: 100px;">
                                                                                                </div>
																							</td>
																						</tr>
																						<?php } ?>
																					</table>
																				</td>
																			</tr>
																		<?php
																		}
																		?>
																	</table>
																<!--</form>-->
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

</body>

</html>