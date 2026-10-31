<?php
// require 'noentry.php';
require 'connection/conn.php';
session_start();

if ($_POST) {
	foreach ($_POST as $key => $val) {
		if ($val != "") {
			if ($key == "village_id") {
				//$_SESSION['village_id'] = "";

				foreach ($_POST['village_id'] as $key_vill => $val_vill) {
					if ($val_vill != "")
						$_SESSION['village_id'] .= $val_vill . ",";
				}

				$_SESSION['village_id'] = substr($_SESSION['village_id'], 0, strlen($_SESSION['village_id']) - 1);
			}

			if ($key == "gotra_id") {
				foreach ($_POST['gotra_id'] as $key_got => $val_got) {
					if ($val_got != "")
						$_SESSION['gotra_id'] .= $val_got . ",";
				}
				$_SESSION['gotra_id'] = substr($_SESSION['gotra_id'], 0, strlen($_SESSION['gotra_id']) - 1);
			}

			if ($key != "village_id" && 	$key != "gotra_id") {
				$_SESSION[$key] = $val;
			}
		}
	}


	if (isset($_POST['pagenum'])) {
		$where_cnd = stripslashes($_POST['cond']);
	} else {
		$where = " and ";

		// Search By Professional Details //
		$cond = "";
		if (isset($_POST['country']) && $_POST['country'] != "" && $_POST['country'] != "0") {
			if ($_POST['country'] == '1000') {
				$cond .= $where . "((vasti.country != '10' or v1.country != '10') and (vasti.country != '' or v1.country != ''))";
			} else {
				$cond .= $where . "(vasti.country = '" . $_POST['country'] . "' or v1.country = '" . $_POST['country'] . "')";
			}
		}

		if (isset($_POST['state']) && $_POST['state'] != "" && $_POST['state'] != "0") {
			$cond .= $where . "(vasti.state = '" . $_POST['state'] . "' or v1.state = '" . $_POST['state'] . "')";
		}

		if (isset($_POST['city']) && $_POST['city'] != "" && $_POST['city'] != "0") {
			$cond .= $where . "(vasti.city = '" . $_POST['city'] . "' or v1.city = '" . $_POST['city'] . "')";
		}

		if (isset($_POST['village_id']) ? $_POST['village_id'] : "") {
			$vid = implode(",", $_POST['village_id']);
			if ($vid != "")
				$cond .= $where . "(vasti.village_id in (" . implode(",", $_POST['village_id']) . ") or v1.village_id in (" . implode(",", $_POST['village_id']) . "))";
		}

		if (isset($_POST['gotra_id'])) {
			$pid = implode(",", $_POST['gotra_id']);
			if ($pid != "")
				$cond .= $where . "(vasti.gotra_id in (" . implode(",", $_POST['gotra_id']) . ") or v1.gotra_id in (" . implode(",", $_POST['gotra_id']) . "))";
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

		//form no
		if ($_POST['frm_no1'] != "" && $_POST['frm_no2'] != "") {
			$cond .= $where . " (vasti.form_no between " . $_POST['frm_no1'] . " and " . $_POST['frm_no2'] . ")";
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
	}
	$limit = "";
	$sql_vastipatrak = "select distinct vasti.*, bness_name, bness_phone, bness_mobile, job_addr1, job_addr2, job_addr3, job_pincode, 
								v.village_name,g.gotra_name,u.user_login,u.user_password,m.marital_name,
								v1.gotra_id as pargotra,v1.village_id as parvillage, 
										bdir.prof_type,bness_cat_id,bness_subcat_id,bness_name,prof_cat_id,prof_subcat_id,comp_name, 
								country.country_name,state.state_name,city.city_name,
								country1.country_name as parcountry,state1.state_name as parstate,city1.city_name as parcity
								, edu1.education_name as basicqual,edu2.education_name as pgqual,edu3.education_name as docqual, 					
								jc.city_name as jcity, js.state_name as jstate,
								bc.group_name as b_main_group_name,ind.ind_value as ind_name,
					jobc.group_name as j_group_name, jobind.ind_value as job_ind_name,
					pc.group_name as p_main_group_name,pc1.group_name as p_sub_group_name 
								from vastipatrak_m vasti
									left outer join vastipatrak_m v1 on vasti.parent_id = v1.vasti_id
									left outer join village_m v on vasti.village_id = v.village_id
									left outer join gotra_m g on vasti.gotra_id = g.gotra_id
									left outer join marital_m m on vasti.marital_id = m.marital_id 
									left outer join user_m u on vasti.vasti_id = u.vasti_id  
									left outer join businessdir_m bdir 
										left outer join bdir_category bc on bdir.bness_cat_id = bc.sub_id
										left outer join industry_m ind on bdir.bness_subcat_id = ind.ind_id
										left outer join bdir_category pc on bdir.prof_cat_id = pc.sub_id
										left outer join bdir_category pc1 on bdir.prof_subcat_id = pc1.sub_id
										
										left outer join bdir_category jobc on bdir.job_type = jobc.sub_id
										left outer join industry_m jobind on bdir.job_ind_id = jobind.ind_id
										left outer join city_m jc on bdir.job_city = jc.city_id
										left outer join state_m js on bdir.job_state = js.state_id
									on vasti.vasti_id = bdir.vasti_id
									
									left outer join country_m country on vasti.country = country.country_id
									left outer join country_m country1 on v1.country = country1.country_id
									
									left outer join state_m state on vasti.state = state.state_id
									left outer join state_m state1 on v1.state = state1.state_id
									
									left outer join city_m city on vasti.city = city.city_id
									left outer join city_m city1 on v1.city = city1.city_id

									 left outer join education_m edu1 on vasti.basic_qual = edu1.education_id
									 left outer join education_m edu2 on vasti.pg_qual = edu2.education_id
									 left outer join education_m edu3 on vasti.doc_qual = edu3.education_id	
																			
									 $where_cnd order by vasti.fname_vc $limit";

	$chk_vastipatrak = mysqli_query($cn, $sql_vastipatrak);
	$num_vastipatrak = mysqli_num_rows($chk_vastipatrak);
}

function getMiddleName($cn, $vastiid)
{
	$strsql = "select * from vastipatrak_m where vasti_id=" . $vastiid;
	$chk_middlename = mysqli_query($cn, $strsql);

	$dt_middlename = mysqli_fetch_array($chk_middlename);
	$middlename = $dt_middlename['fname_vc'];
	return $middlename;
}
?>

<html>

<head>
	<link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr bgcolor="#ffffff">
			<td width="2" colspan="2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr class="text">
						<td width="2%" valign="middle"><b>Sr. No.</b></td>
						<td valign="middle"><b>Name and Surname</b></td>
						<td valign="middle"><b>Relation</b></td>
						<td valign="middle"><b>DOB</b></td>
						<td valign="middle"><b>Marital <br>
								Status</b></td>
						<td valign="middle"><b>Current <br>
								Address</b></td>
						<td valign="middle"><b>Business<br>
								Profession</b></td>
					</tr>
					<tr>
						<td colspan="7" height="1" bgcolor="#CCCCCC"></td>
					</tr>
					<tr>
						<td colspan="7">&nbsp;</td>
					</tr>

					<?php
					$ctr = 0;
					while ($dt_vastipatrak = mysqli_fetch_array($chk_vastipatrak)) {
						$ctr++;
						// Get details of HOF/Husband to display incase of inner members //
						if ($dt_vastipatrak['parent_id'] != "0" && $dt_vastipatrak['anc_id'] != "0") {

							$sql_hofdet = "select v.*,v1.lname_vc as parlname, 
														g.gotra_name,g1.gotra_name as mainpargotra, 
														city.city_name,city1.city_name as mainparcity, 
														state.state_name,state1.state_name as mainparstate, vill.village_name, ed.education_name 
															from vastipatrak_m v 
													   left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id 
													   left outer join state_m state on v.state = state.state_id 
													   left outer join city_m city on v.city = city.city_id 
													   left outer join state_m state1 on v1.state = state1.state_id 
													   left outer join city_m city1 on v1.city = city1.city_id 
													   left outer join village_m vill on v.village_id = vill.village_id 
													   left outer join gotra_m g on v.gotra_id = g.gotra_id 
													    left outer join gotra_m g1 on v1.gotra_id = g1.gotra_id 
														left outer join education_m ed on v.basic_qual = ed.education_id 
													   where v.vasti_id=" . $dt_vastipatrak['anc_id'];

							$chk_hofdet = mysqli_query($cn, $sql_hofdet);
							$det_hofdet = mysqli_fetch_array($chk_hofdet);

							$mname = $det_hofdet['fname_vc'];
							if ($det_hofdet['lname_vc'] != "")
								$lname = $det_hofdet['lname_vc'];
							else
								$lname = $det_hofdet['parlname'];

							$sql_hofdet = "select v.*,v1.lname_vc as parlname,
														g.gotra_name,g1.gotra_name as mainpargotra,
														city.city_name,city1.city_name as mainparcity, 
														state.state_name,state1.state_name as mainparstate, vill.village_name 
															from vastipatrak_m v 
													   left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
													   
													   left outer join state_m state on v.state = state.state_id
													   left outer join city_m city on v.city = city.city_id
													   left outer join state_m state1 on v1.state = state1.state_id
													   left outer join city_m city1 on v1.city = city1.city_id
													   
													   left outer join village_m vill on v.village_id = vill.village_id
													   left outer join gotra_m g on v.gotra_id = g.gotra_id
													    left outer join gotra_m g1 on v1.gotra_id = g1.gotra_id
													   where v.vasti_id=" . getHOF($dt_vastipatrak['anc_id']);


							$chk_hofdet = mysqli_query($cn, $sql_hofdet);
							$det_hofdet = mysqli_fetch_array($chk_hofdet);

							if ($dt_vastipatrak['parent_id'] != "0") {

								$id = $det_hofdet['vasti_id'];

								$addr1 = $det_hofdet['addr1'];
								$addr2 = $det_hofdet['addr2'];
								$addr3 = $det_hofdet['addr3'];
								$pincode = $det_hofdet['pincode'];

								$city = $det_hofdet['city_name'];
								if ($city == "")
									$city = $det_hofdet['mainparcity'];

								$state = $det_hofdet['state_name'];
								if ($state == "")
									$state = $det_hofdet['mainparstate'];

								$village = $det_hofdet['village_name'];

								$gotra = $det_hofdet['gotra_name'];
								if ($gotra == "")
									$gotra = $det_hofdet['mainpargotra'];
							}
						} else {

							$sql_hofdet1 = "select v.*,v1.lname_vc as parlname,v1.fname_vc as parfname,v1.addr1 as paraddr1,v1.addr2 as paraddr2,v1.addr3 as paraddr3,v1.pincode as parpincode,
															g.gotra_name,g1.gotra_name as mainpargotra,
															city.city_name,city1.city_name as mainparcity, 
															state.state_name,state1.state_name as mainparstate,
															vill.village_name,vill1.village_name as mainparvill
															
																from vastipatrak_m v 
																
														   left outer join vastipatrak_m v1 on v.parent_id = v1.vasti_id
														   
														   left outer join state_m state on v.state = state.state_id
														   left outer join city_m city on v.city = city.city_id
														   left outer join state_m state1 on v1.state = state1.state_id
														   left outer join city_m city1 on v1.city = city1.city_id
														   
														   left outer join village_m vill on v.village_id = vill.village_id
														   left outer join village_m vill1 on v1.village_id = vill1.village_id
														   left outer join gotra_m g on v.gotra_id = g.gotra_id
														   left outer join gotra_m g1 on v1.gotra_id = g1.gotra_id
														   
														   where v1.vasti_id=" . ($dt_vastipatrak['parent_id']);

							$chk_hofdet1 = mysqli_query($cn, $sql_hofdet1);
							$det_hofdet1 = mysqli_fetch_array($chk_hofdet1);

							if ($dt_vastipatrak['mname_vc'] == "")
								$mname = $det_hofdet1['parfname'];
							else
								$mname = $dt_vastipatrak['mname_vc'];

							if ($dt_vastipatrak['lname_vc'] == "")
								$lname = $det_hofdet1['parlname'];
							else
								$lname = $dt_vastipatrak['lname_vc'];

							if ($dt_vastipatrak['parent_id'] != 0)
								$id = $dt_vastipatrak['parent_id'];
							else
								$id = $dt_vastipatrak['vasti_id'];

							if ($dt_vastipatrak['addr1'] == "")
								$addr1 = $det_hofdet1['paraddr1'];
							else
								$addr1 = $dt_vastipatrak['addr1'];

							if ($dt_vastipatrak['addr2'] == "")
								$addr2 = $det_hofdet1['paraddr2'];
							else
								$addr2 = $dt_vastipatrak['addr2'];

							if ($dt_vastipatrak['addr3'] == "")
								$addr3 = $det_hofdet1['paraddr3'];
							else
								$addr3 = $dt_vastipatrak['addr3'];

							if ($dt_vastipatrak['pincode'] == "")
								$pincode = $det_hofdet1['parpincode'];
							else
								$pincode = $dt_vastipatrak['pincode'];

							if ($dt_vastipatrak['city_name'] == "")
								$city = $det_hofdet1['mainparcity'];
							else
								$city = $dt_vastipatrak['city_name'];

							if ($dt_vastipatrak['state_name'] == "")
								$state = $det_hofdet1['mainparstate'];
							else
								$state = $dt_vastipatrak['state_name'];

							if ($dt_vastipatrak['village_name'] == "")
								$village = $det_hofdet1['mainparvill'];
							else
								$village = $dt_vastipatrak['village_name'];

							if ($dt_vastipatrak['gotra_name'] == "")
								$gotra = $det_hofdet1['mainpargotra'];
							else
								$gotra = $dt_vastipatrak['gotra_name'];
						}
					?>
						<tr>
							<td width="4%" class="text" valign="top" style="padding-left:15px;"><b><?php echo $ctr; ?></b></td>
							<td class="text" valign="top" width="20%"><span class="text4_user"><?php echo $dt_vastipatrak['fname_vc'] . " " . $mname . " " . $lname; ?></span><br>
								<b><span class="text_user"><?php echo $village; ?></span> - <span class="text_user"><?php echo $gotra; ?></span><br>
									(
									<?php
									switch ($dt_vastipatrak['prof_type']) {
										case "B":
											$var_disp = "Business";
											break;
										case "P":
											$var_disp = "Profession";
											break;
										case "J":
											$var_disp = "Job";
											break;
										case "H":
											$var_disp = "Housewife";
											break;
										case "S":
											$var_disp = "Student";
											break;
										case "R":
											$var_disp = "Retired";
											break;
										default:
											$var_disp = "";
											break;
									}

									echo ($var_disp);

									//check the condition that the person is not having ancestor id and if not then mark it
									?>)
									<br>
									<?php
									$varancid = $dt_vastipatrak['anc_id'];
									if ($varancid == 0)
										echo "Not Linked";
									else
										echo "Linked";
									?>

									<br>
									<?php
									// echo("username: " . $dt_vastipatrak['user_login']);
									// echo("<br>");
									// echo("password: " . $dt_vastipatrak['user_password']);
									?>


								</b>
							</td>
							<td valign="top" width="6%"><span class="text_user"><?php echo "Self" ?></span></td>
							<td valign="top" width="7%" class="text"><?php echo $dt_vastipatrak['birth_date']; ?></td>
							<td valign="top" width="10%"><span class="text_user"><?php echo $dt_vastipatrak['marital_name']; ?><br><b><?php echo $dt_vastipatrak['basicqual']; ?><br><?php echo $dt_vastipatrak['pgqual']; ?><br><?php echo $dt_vastipatrak['docqual']; ?></b></span></td>
							<td valign="top" width="20%">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<?php if ($addr1 != "") { ?>
													<tr bgcolor="#fbfbfb" class="text">
														<td class="text_user"><?php echo $addr1; ?></td>
													</tr>
												<?php } ?>
												<?php if ($addr2 != "") { ?>
													<tr bgcolor="#fbfbfb" class="text">
														<td class="text_user"><?php echo $addr2; ?></td>
													</tr>
												<?php } ?>
												<?php if ($addr3 != "") { ?>
													<tr bgcolor="#fbfbfb" class="text">
														<td class="text_user"><?php echo $addr3; ?></td>
													</tr>
												<?php } ?>
												<?php if ($city != "" || $state != "" || $pincode != "") { ?>
													<tr bgcolor="#fbfbfb" class="text">
														<td class="text_user"><?php echo $city; ?>, <?php echo $state; ?> - <?php echo $pincode; ?>.</td>
													</tr>
												<?php } ?>
											</table>
										</td>
									</tr>
									<tr>
										<td class="text"><strong>M.</strong> <span class="text_user">
												<?php
												$extr = "";
												$mobno = "";

												if ($dt_vastipatrak['mobile_home'] != "" || $dt_vastipatrak['alt_mobile'] != "" || $dt_vastipatrak['mobile_number'] != "") {
													$extr = " / ";
													if ($dt_vastipatrak['mobile_home'] != "") {
														$mobno = $dt_vastipatrak['mobile_home'];
													}
													if ($dt_vastipatrak['alt_mobile'] != "")
														$mobno .= $extr . $dt_vastipatrak['alt_mobile'];
													if ($dt_vastipatrak['mobile_number'] != "")
														$mobno .= $extr . $dt_vastipatrak['mobile_number'];
												} else
													$mobno = "-";

												echo $mobno;
												?>
											</span></td>
									</tr>
									<tr>
										<td class="text">
											<span class="text_user"></span> <b>Ph.</b> <span class="text_user">
												<?php
												$extr = "";

												if ($dt_vastipatrak['phone_number'] != "" || $dt_vastipatrak['alt_number'] != "") {
													if ($dt_vastipatrak['phone_number'] != "") {
														if ($dt_vastipatrak['code_phone_number'] != "")
															$mobno1 = $dt_vastipatrak['code_phone_number'] . "-" . $dt_vastipatrak['phone_number'];
														else
															$mobno1 = $dt_vastipatrak['phone_number'];

														$extr = " / ";
													}
													if ($dt_vastipatrak['alt_number'] != "") {
														if ($dt_vastipatrak['code_alt_number'] != "")
															$mobno1 .= $extr . $dt_vastipatrak['code_alt_number'] . "-" . $dt_vastipatrak['alt_number'];
														else
															$mobno1 .= $extr . $dt_vastipatrak['alt_number'];
													}
												} else
													$mobno1 = "-";

												echo $mobno1;
												?>
											</span>
										</td>
									</tr>
									<tr>
										<td class="text"><span class="text_user"><span class="text4_user"><strong>Email</strong></span>:
												<?php if ($dt_vastipatrak['email'] != "") { ?>
													<a href="mailto:<?php echo $dt_vastipatrak['email']; ?>"><?php echo $dt_vastipatrak['email']; ?></a>
												<?php } else {
													echo "-";
												} ?>
											</span></td>
									</tr>
								</table>
							</td>
							<td valign="top" class="text">
								<?php
								if ($dt_vastipatrak['prof_type'] == "B") {
								?>
									<?php
									if ($dt_vastipatrak['b_main_group_name'] != "Root")
										echo ($dt_vastipatrak['b_main_group_name']);
									?>
									<?php
									if ($dt_vastipatrak['ind_name'] != "") {
										echo ("<br>");
										echo ("<b>Industry:</b>");
										echo ($dt_vastipatrak['ind_name']);
									}
									?>
									<?php
									if ($dt_vastipatrak['bness_name'] != "") {
										echo ("<br>");
										echo ("<b>Name:</b>");
										echo ($dt_vastipatrak['bness_name']);
									}
									?>
									<?php
									if ($dt_vastipatrak['bness_phone'] != "") {
										echo ("<br>");
										echo ("<b>Phone:</b>");
										echo ($dt_vastipatrak['bness_phone']);
									}
									?>
									<?php
									if ($dt_vastipatrak['bness_mobile'] != "") {
										echo ("<br>");
										echo ("<b>Mobile:</b>");
										echo ($dt_vastipatrak['bness_mobile']);
									}
									?>
								<?php
								} //end of business section
								?>


								<?php
								if ($dt_vastipatrak['prof_type'] == "P") {
								?>
									<?php
									if ($dt_vastipatrak['p_main_group_name'] != "Root") {
										echo ("<b>Industry:</b>");
										echo ($dt_vastipatrak['p_main_group_name']);
									}
									?>
									<?php
									if ($dt_vastipatrak['p_sub_group_name'] != "") {
										echo ("<br>");
										echo ("<b>Specialization:</b>");
										echo ($dt_vastipatrak['p_sub_group_name']);
									}
									?>
									<?php
									if ($dt_vastipatrak['prof_addr'] != "") {
										echo ("<br>");
										echo ("<b>Office Address:</b>");
										echo ($dt_vastipatrak['prof_addr']);
									}
									?>
									<?php
									if ($dt_vastipatrak['prof_phone'] != "") {
										echo ("<br>");
										echo ("<b>Phone:</b>");
										echo ($dt_vastipatrak['prof_phone']);
									}
									?>
									<?php
									if ($dt_vastipatrak['prof_mobile'] != "") {
										echo ("<br>");
										echo ("<b>Mobile:</b>");
										echo ($dt_vastipatrak['prof_mobile']);
									}
									?>
								<?php
								} //end of profession section
								?>


								<?php
								if ($dt_vastipatrak['prof_type'] == "J") {
								?>
									<?php
									if ($dt_vastipatrak['j_group_name'] != "Root") {
										echo ("<b>Job Type:</b>");
										echo ($dt_vastipatrak['j_group_name']);
									}
									?>
									<?php
									if ($dt_vastipatrak['job_ind_name'] != "") {
										echo ("<br>");
										echo ("<b>Industry:</b>");
										echo ($dt_vastipatrak['job_ind_name']);
									}
									?>
									<?php
									if ($dt_vastipatrak['comp_name'] != "") {
										echo ("<br>");
										echo ("<b>Company:</b>");
										echo ($dt_vastipatrak['comp_name']);
									}
									?>
									<?php
									if ($dt_vastipatrak['job_desig'] != "") {
										echo ("<br>");
										echo ("<b>Designation:</b>");
										echo ($dt_vastipatrak['job_desig']);
									}
									?>
									<?php
									if ($dt_vastipatrak['job_addr'] != "") {
										echo ("<br>");
										echo ("<b>Address:</b>");
										echo ($dt_vastipatrak['job_addr']);
									}
									?>
									<?php
									if ($dt_vastipatrak['job_phone'] != "") {
										echo ("<br>");
										echo ("<b>Phone:</b>");
										echo ($dt_vastipatrak['job_phone']);
									}
									?>
									<?php
									if ($dt_vastipatrak['job_mobile'] != "") {
										echo ("<br>");
										echo ("<b>Mobile:</b>");
										echo ($dt_vastipatrak['job_mobile']);
									}
									?>
								<?php
								} //end of service section
								?>


								<?php
								if ($dt_vastipatrak['job_addr1'] != "") {
									echo ("<br>");
									echo ("<b>Address:</b><br>");
									echo ($dt_vastipatrak['job_addr1']);
								}
								?>
								<?php
								if ($dt_vastipatrak['job_addr2'] != "") {
									echo ("<br>");
									echo ($dt_vastipatrak['job_addr2']);
								}
								?>
								<?php
								if ($dt_vastipatrak['job_addr3'] != "") {
									echo ("<br>");
									echo ($dt_vastipatrak['job_addr3']);
								}
								?>
								<?php
								if ($dt_vastipatrak['jcity'] != "" || $dt_vastipatrak['jstate'] != "" || $dt_vastipatrak['job_pincode'] != "") {
									echo ("<br>");
									echo ($dt_vastipatrak['jcity']); ?>, <?php echo ($dt_vastipatrak['jstate']); ?> - <?php echo ($dt_vastipatrak['job_pincode']);
																													}
																														?>

							</td>
						</tr>
						<?php
						$vasti_id = $dt_vastipatrak['vasti_id'];

						$sql_submem = "select v.*,bdir.prof_type,r.relation_name,m.marital_name,country.country_name,state.state_name,city.city_name, edu1.education_name as basicqual,edu2.education_name as pgqual,edu3.education_name as docqual, bness_name, bness_phone, bness_mobile, job_addr1, job_addr2, job_addr3, job_pincode, 								jc.city_name as jcity, js.state_name as jstate,
								bc.group_name as b_main_group_name,ind.ind_value as ind_name,
					jobc.group_name as j_group_name, jobind.ind_value as job_ind_name,
					pc.group_name as p_main_group_name,pc1.group_name as p_sub_group_name 
								from vastipatrak_m v
											   left outer join relation_m r on v.relation_id = r.relation_id
											   left outer join marital_m m on v.marital_id = m.marital_id
											   left outer join country_m country on v.country = country.country_id
											   left outer join state_m state on v.state = state.state_id
											   left outer join city_m city on v.city = city.city_id
											   left outer join education_m edu1 on v.basic_qual = edu1.education_id
											   left outer join education_m edu2 on v.pg_qual = edu2.education_id
											   left outer join education_m edu3 on v.doc_qual = edu3.education_id												
												left outer join businessdir_m bdir 
													left outer join bdir_category bc on bdir.bness_cat_id = bc.sub_id
													left outer join industry_m ind on bdir.bness_subcat_id = ind.ind_id
													left outer join bdir_category pc on bdir.prof_cat_id = pc.sub_id
													left outer join bdir_category pc1 on bdir.prof_subcat_id = pc1.sub_id
													
													left outer join bdir_category jobc on bdir.job_type = jobc.sub_id
													left outer join industry_m jobind on bdir.job_ind_id = jobind.ind_id
													left outer join city_m jc on bdir.job_city = jc.city_id
													left outer join state_m js on bdir.job_state = js.state_id
												on v.vasti_id = bdir.vasti_id

											   where v.parent_id=" . $vasti_id . " order by v.birth_date ASC,v.vasti_id ";
						$chk_submem = mysqli_query($cn, $sql_submem);

						while ($dt_submem = mysqli_fetch_array($chk_submem)) {
							//get the array from the function by passing the vasti id and then display
							$middlename = getMiddleName($cn, $dt_submem['anc_id']);
						?>
							<tr>
								<td colspan="7" height="1" bgcolor="#CCCCCC"></td>
							</tr>
							<tr>
								<td class="text" valign="top" style="padding-left:15px;">&nbsp;</td>
								<td class="text" valign="top"><b><?php echo $dt_submem['vasti_id'] . $dt_submem['fname_vc'] . " " . $middlename . " " . $lname; ?></b><br>
									<b>
										<?php if ($dt_submem['prof_type'] != "") { ?>
											(
											<?php
											switch ($dt_submem['prof_type']) {
												case "B":
													$var_disp = "Business";
													break;
												case "P":
													$var_disp = "Profession";
													break;
												case "J":
													$var_disp = "Job";
													break;
												case "H":
													$var_disp = "Housewife";
													break;
												case "S":
													$var_disp = "Student";
													break;
												case "R":
													$var_disp = "Retired";
													break;
												default:
													$var_disp = "";
													break;
											}

											echo ($var_disp);
											?>)
									</b>
								<?php } ?>
								<br>
								<?php
								$varsubancid = $dt_submem['anc_id'];
								if ($varsubancid == 0)
									echo "Not Linked";
								else
									echo "Linked";
								?>

								</td>
								<td valign="top" class="text"><b><?php echo $dt_submem['relation_name'] ?></b></td>
								<td valign="top" class="text"><b><?php echo $dt_submem['birth_date']; ?></b></td>
								<td valign="top"><span class="text"><b><?php echo $dt_submem['marital_name']; ?></b><br><b><?php echo $dt_submem['basicqual']; ?><br><?php echo $dt_submem['pgqual']; ?><br><?php echo $dt_submem['docqual']; ?></b></span></td>
								<td valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td class="text"><strong>M.</strong> <span class="text_user">
													<?php
													$extr = "";
													$mobno = "";

													if ($dt_submem['mobile_home'] != "" || $dt_submem['alt_mobile'] != "" || $dt_vastipatrak['mobile_number'] != "") {
														$extr = " / ";
														if ($dt_submem['mobile_home'] != "") {
															$mobno = $dt_submem['mobile_home'];
														}
														if ($dt_submem['alt_mobile'] != "")
															$mobno .= $extr . $dt_submem['alt_mobile'];
														if ($dt_vastipatrak['mobile_number'] != "")
															$mobno .= $extr . $dt_vastipatrak['mobile_number'];
													} else
														$mobno = "-";

													echo $mobno;
													?>
												</span></td>
										</tr>
										<tr>
											<td class="text"><span class="text_user"><span class="text4_user"><strong>Email</strong></span>:
													<?php if ($dt_submem['email'] != "") { ?>
														<a href="mailto:<?php echo $dt_submem['email']; ?>"><?php echo $dt_submem['email']; ?></a>
													<?php } else {
														echo "-";
													} ?>
												</span></td>
										</tr>
									</table>
								</td>
								<td valign="top" class="text">
									<?php
									if ($dt_submem['prof_type'] == "B") {
									?>
										<?php
										if ($dt_submem['b_main_group_name'] != "Root")
											echo ($dt_submem['b_main_group_name']);
										?>
										<?php
										if ($dt_submem['ind_name'] != "") {
											echo ("<br>");
											echo ("<b>Industry:</b>");
											echo ($dt_submem['ind_name']);
										}
										?>
										<?php
										if ($dt_submem['bness_name'] != "") {
											echo ("<br>");
											echo ("<b>Name:</b>");
											echo ($dt_submem['bness_name']);
										}
										?>
										<?php
										if ($dt_submem['bness_phone'] != "") {
											echo ("<br>");
											echo ("<b>Phone:</b>");
											echo ($dt_submem['bness_phone']);
										}
										?>
										<?php
										if ($dt_submem['bness_mobile'] != "") {
											echo ("<br>");
											echo ("<b>Mobile:</b>");
											echo ($dt_submem['bness_mobile']);
										}
										?>
									<?php
									} //end of business section
									?>


									<?php
									if ($dt_submem['prof_type'] == "P") {
									?>
										<?php
										if ($dt_submem['p_main_group_name'] != "Root") {
											echo ("<b>Industry:</b>");
											echo ($dt_submem['p_main_group_name']);
										}
										?>
										<?php
										if ($dt_submem['p_sub_group_name'] != "") {
											echo ("<br>");
											echo ("<b>Specialization:</b>");
											echo ($dt_submem['p_sub_group_name']);
										}
										?>
										<?php
										if ($dt_submem['prof_addr'] != "") {
											echo ("<br>");
											echo ("<b>Office Address:</b>");
											echo ($dt_submem['prof_addr']);
										}
										?>
										<?php
										if ($dt_submem['prof_phone'] != "") {
											echo ("<br>");
											echo ("<b>Phone:</b>");
											echo ($dt_submem['prof_phone']);
										}
										?>
										<?php
										if ($dt_submem['prof_mobile'] != "") {
											echo ("<br>");
											echo ("<b>Mobile:</b>");
											echo ($dt_submem['prof_mobile']);
										}
										?>
									<?php
									} //end of profession section
									?>


									<?php
									if ($dt_submem['prof_type'] == "J") {
									?>
										<?php
										if ($dt_submem['j_group_name'] != "Root") {
											echo ("<b>Job Type:</b>");
											echo ($dt_submem['j_group_name']);
										}
										?>
										<?php
										if ($dt_submem['job_ind_name'] != "") {
											echo ("<br>");
											echo ("<b>Industry:</b>");
											echo ($dt_submem['job_ind_name']);
										}
										?>
										<?php
										if ($dt_submem['comp_name'] != "") {
											echo ("<br>");
											echo ("<b>Company:</b>");
											echo ($dt_submem['comp_name']);
										}
										?>
										<?php
										if ($dt_submem['job_desig'] != "") {
											echo ("<br>");
											echo ("<b>Designation:</b>");
											echo ($dt_submem['job_desig']);
										}
										?>
										<?php
										if ($dt_submem['job_addr'] != "") {
											echo ("<br>");
											echo ("<b>Address:</b>");
											echo ($dt_submem['job_addr']);
										}
										?>
										<?php
										if ($dt_submem['job_phone'] != "") {
											echo ("<br>");
											echo ("<b>Phone:</b>");
											echo ($dt_submem['job_phone']);
										}
										?>
										<?php
										if ($dt_submem['job_mobile'] != "") {
											echo ("<br>");
											echo ("<b>Mobile:</b>");
											echo ($dt_submem['job_mobile']);
										}
										?>
									<?php
									} //end of service section
									?>


									<?php
									if ($dt_submem['job_addr1'] != "") {
										echo ("<br>");
										echo ("<b>Address:</b><br>");
										echo ($dt_submem['job_addr1']);
									}
									?>
									<?php
									if ($dt_submem['job_addr2'] != "") {
										echo ("<br>");
										echo ($dt_submem['job_addr2']);
									}
									?>
									<?php
									if ($dt_submem['job_addr3'] != "") {
										echo ("<br>");
										echo ($dt_submem['job_addr3']);
									}
									?>
									<?php
									if ($dt_submem['jcity'] != "" || $dt_submem['jstate'] != "" || $dt_submem['job_pincode'] != "") {
										echo ("<br>");
										echo ($dt_submem['jcity']); ?>, <?php echo ($dt_submem['jstate']); ?> - <?php echo ($dt_submem['job_pincode']);
																											}
																												?>


								</td>
							</tr>
						<?php
						}
						?>
						<tr>
							<td colspan="7">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="7" height="1" bgcolor="#CCCCCC"></td>
						</tr>
						<tr>
							<td colspan="7">&nbsp;</td>
						</tr>

					<?php
					} ?>

				</table>
			</td>
		</tr>
	</table>
</body>

</html>