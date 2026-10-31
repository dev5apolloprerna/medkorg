<?php
include_once "noentry.php";
include_once "admin/connection/conn.php";
include_once 'password_hash.php';

$vasti_id =  $_REQUEST['vastiid'];
$sql_mainmem = "select v.*,vill.village_name,g.gotra_name, country.call_code_vc as vcallcode, city.std_code_vc, city.city_name, state.state_name,m.marital_name from vastipatrak_m v
					left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join village_m vill on vill.village_id = v.village_id
					left outer join marital_m m on v.marital_id = m.marital_id
					left outer join country_m country on v.country = country.country_id
					left outer join state_m state on v.state = state.state_id
					left outer join city_m city on v.city = city.city_id
					where vasti_id=" . $vasti_id;
$resUserDetail = mysqli_fetch_assoc(mysqli_query($cn, $sql_mainmem));

$vasti_id = $vasti_id;
$fname = $resUserDetail['fname_vc'];
$mname = $resUserDetail['mname_vc'];
$lname = $resUserDetail['lname_vc'];
if ($resUserDetail['parent_id'] == 0 && $resUserDetail['anc_id'] == 0)
	$isHOF = 1;
else
	$isHOF = 0;
$gender = $resUserDetail['gender_c'];
$maritalstatus = isset($resUserDetail['fname_vc']) ? $resUserDetail['fname_vc'] : "";

// Query for the membername //
$Member_Name = "SELECT `vasti_id`, CONCAT(fname_vc , ' ', mname_vc ,' ', lname_vc) AS MemberName,`relation_id` FROM `vastipatrak_m`WHERE parent_id=" . $resUserDetail['parent_id'] . " and vasti_id !=$vasti_id";
$chk_Member = mysqli_query($cn, $Member_Name);
$familyMember = [];
while ($Member = mysqli_fetch_array($chk_Member)) {
	$familyMember[] = array(
		'vasti_id' => $Member['vasti_id'],
		'MemberName' => $Member['MemberName']
	);
}

// Query for the Relationname //
$Relation_Name = "SELECT * FROM `relation_m`";
$chk_relation = mysqli_query($cn, $Relation_Name);
$familyRelation = [];
while ($Relation = mysqli_fetch_array($chk_relation)) {
	$familyRelation[] = array(
		'relation_id' => $Relation['relation_id'],
		'relation_name' => $Relation['relation_name']
	);
}
$vartxtcountry = "SELECT * FROM `country_m`";
$chk_country = mysqli_query($cn, $vartxtcountry);


$state = "SELECT * FROM `state_m`";
$chk_State = mysqli_query($cn, $state);

$vartxtcity = "SELECT * FROM `city_m`";
$chk_city = mysqli_query($cn, $vartxtcity);
//print_r($_POST);
if ($_POST) {
	// if ($isHOF == 0){
	// 	echo $isHOF;exit;
	// 	// $death_date = $_POST['birth_date'];

	// 	// update the date of death of the person and also update that the person has died and is a part of lineage
	// 	// 	$strsql = "update vastipatrak_m set parent_id = anc_id, death_date='" . $death_date . "' , lineage=1 where vasti_id=" . $vasti_id;
	// 	//   mysqli_query($cn,$strsql);

	// 	//now give the message fname moved
	// 	redirect("user-familydet.php?msg=" .  $fname . " moved to ancestor!");
	// 	exit;
	// } else{
	//print_r("hello");exit;		
	// $strsqlNew = "select * from vastipatrak_m where vasti_id=" . $_POST['vastiid'];
	// $rwData = mysqli_fetch_array(mysqli_query($cn,$strsqlNew));

	// $death_date = $_POST['birth_date'];
	// $strsql = "update vastipatrak_m set parent_id = '".$rwData['anc_id']."', death_date='" . $death_date . "' , lineage=1 where vasti_id=" . $vasti_id;
	// mysqli_query($cn,$strsql);

	$strsqlNewDatat = "select * from vastipatrak_m where vasti_id=" . $_POST['vastiid'];
	$rowData = mysqli_fetch_array(mysqli_query($cn, $strsqlNewDatat));

	$strsql = "update vastipatrak_m set parent_id = 0,mobile_home='" . $_POST['Mobile'] . "',addr1='" . $_POST['addr1'] . "',addr2='" . $_POST['addr2'] . "',addr3='" . $_POST['addr3'] . "',country='" . $_POST['country'] . "',state='" . $_POST['state'] . "',city='" . $_POST['City'] . "',district='" . $_POST['addr4'] . "',pincode='" . $_POST['addr5'] . "' where vasti_id=" . $_POST['vastiid'];
	mysqli_query($cn, $strsql);

	$userid = $_POST['Mobile'];

	$sql_string1 = "INSERT into user_m (vasti_id,user_login,user_password,salt,plaintxt_password,user_email) values";
	$pswd = strtolower(substr($rowData['fname_vc'], 0, 3)) . '_' . strtolower(substr($rowData['mobile_home'], 6, 10));
	$hash_result = create_hash($pswd);
	$hash_params = explode(":", $hash_result);
	$salt = $hash_params[HASH_SALT_INDEX];
	$plaintxt_password = $pswd;

	$hash = $hash_params[HASH_PBKDF2_INDEX];
	$sql_string1 = $sql_string1 . " ('" . $_POST['vastiid'] . "','" . $userid . "','" . $hash . "','" . $salt . "','" . $pswd . "','" . $userid . "')";
	mysqli_query($cn, $sql_string1);




	$MemberName = " SELECT `vasti_id` FROM `vastipatrak_m`WHERE parent_id=" . $rowData['parent_id'];
	$res = mysqli_query($cn, $MemberName);
	while ($row = mysqli_fetch_array($res)) {

		if (isset($_POST['vasti_id2_' . $row['vasti_id']]) && $_POST['vasti_id2_' . $row['vasti_id']] != "") {
			$strsql = "update vastipatrak_m set parent_id='" . $_POST['vastiid'] . "',anc_id='" . $_POST['vastiid'] . "',relation_id='" . $_POST['vasti_id2_' . $row['vasti_id']] . "' where vasti_id=" . $row['vasti_id'];
			mysqli_query($cn, $strsql);
		}
	}

	header('location: user-familydet.php');
	die();
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>::: Shree Modasa Akeda Dasha Khadayat :::</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		<!--
		.style1 {
			font-size: 14px
		}

		.style2 {
			font-size: 13px
		}
		-->
	</style>
	<script language="javascript" type="text/javascript">
		function checkPswd(f) {
			var ret = checkFormElements(f);

			if (ret) {
				if (document.getElementById("New Password ").value == document.getElementById("Confirm Password ").value) {
					return true;
				} else {
					alert("New Password and Confirm Password does not match");
					document.getElementById("Confirm Password ").focus();
					return false;
				}
			} else {
				return false;
			}
		}
	</script>
	<script language="javascript" src="js/userjvalid.js"></script>
	<script>
		function switchMenu(tag) {

			var e1 = document.getElementById(tag);
			if (e1.style.display == "none")
				e1.style.display = "";
			else
				e1.style.display = "none";
		}

		function MM_swapImgRestore() { //v3.0
			var i, x, a = document.MM_sr;
			for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) x.src = x.oSrc;
		}

		function MM_preloadImages() { //v3.0
			var d = document;
			if (d.images) {
				if (!d.MM_p) d.MM_p = new Array();
				var i, j = d.MM_p.length,
					a = MM_preloadImages.arguments;
				for (i = 0; i < a.length; i++)
					if (a[i].indexOf("#") != 0) {
						d.MM_p[j] = new Image;
						d.MM_p[j++].src = a[i];
					}
			}
		}

		function MM_findObj(n, d) { //v4.01
			var p, i, x;
			if (!d) d = document;
			if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
				d = parent.frames[n.substring(p + 1)].document;
				n = n.substring(0, p);
			}
			if (!(x = d[n]) && d.all) x = d.all[n];
			for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
			for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
			if (!x && d.getElementById) x = d.getElementById(n);
			return x;
		}

		function MM_swapImage() { //v3.0
			var i, j = 0,
				x, a = MM_swapImage.arguments;
			document.MM_sr = new Array;
			for (i = 0; i < (a.length - 2); i += 3)
				if ((x = MM_findObj(a[i])) != null) {
					document.MM_sr[j++] = x;
					if (!x.oSrc) x.oSrc = x.src;
					x.src = a[i + 2];
				}
		}
	</script>
	<script type="text/javascript">
		/***********************************************
		 * Disable Text Selection script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
		 * This notice MUST stay intact for legal use
		 * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
		 ***********************************************/

		function disableSelection(target) {
			if (typeof target.onselectstart != "undefined") //IE route
				target.onselectstart = function() {
					return false
				}
			else if (typeof target.style.MozUserSelect != "undefined") //Firefox route
				target.style.MozUserSelect = "none"
			else //All other route (ie: Opera)
				target.onmousedown = function() {
					return false
				}
			target.style.cursor = "default"
		}

		//Sample usages
		//disableSelection(document.body) //Disable text selection on entire body
		//disableSelection(document.getElementById("mydiv")) //Disable text selection on element with id="mydiv"
	</script>

</head>

<body>
	<script language=JavaScript>
		<!--
		//Disable right click script III- By Renigade (renigade@mediaone.net)
		//For full source code, visit http://www.dynamicdrive.com

		var message = "";
		///////////////////////////////////
		function clickIE() {
			if (document.all) {
				(message);
				return false;
			}
		}

		function clickNS(e) {
			if (document.layers || (document.getElementById && !document.all)) {
				if (e.which == 2 || e.which == 3) {
					(message);
					return false;
				}
			}
		}
		if (document.layers) {
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = clickNS;
		} else {
			document.onmouseup = clickNS;
			document.oncontextmenu = clickIE;
		}

		document.oncontextmenu = new Function("return false")
		// 
		-->
	</script>
	<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" valign="top" bgcolor="#ffffff">
				<table width="1003" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="right" valign="top" background="images/top_bg.jpg" style="background-position:top; background-repeat:no-repeat;">
							<table width="500" border="0" cellspacing="0" cellpadding="0">

								<tr>
									<td height="99" align="left" valign="top"><a href="index.html"><img src="images/spacer.gif" alt="" width="484" height="99" /></a></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td height="34">&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr height="59">
									<td>
										<table width="475" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td colspan="2"><?php include "advt_incl.php"; ?></td>
											</tr>
											<tr>
												<td height="7"></td>
												<td></td>
											</tr>
										</table>
									</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="41" align="center" valign="middle" background="images/menu_bg.jpg" style="background-repeat:repeat-x">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="9%" align="center" valign="middle" class="menu"><a href="index.php">Home</a></td>
									<td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
									<td width="10%" align="center" valign="middle" class="menu"><a href="user-homepage.php">User Home </a></td>
									<td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
									<td width="12%" align="center" valign="middle" class="menu"><a href="user-familydet.php">My Family </a></td>
									<td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
									<td width="15%" align="center" valign="middle" class="menu"><a href="user-vastipatrak-search.php">Vasti Patrak </a></td>
									<td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
									<td width="12%" align="center" valign="middle" class="menu"><a href="user-directory-list.php">My Directory </a></td>
									<td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
									<td width="14%" align="center" valign="middle" class="menu"><a href="user-changepswd.php"><strong>Change Password </strong></a></td>
									<td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
									<td width="9%" align="center" valign="middle" class="menu"><a href="faq.php">Help</a></td>
									<td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
									<td width="9%" align="center" valign="middle" class="menu"><a href="logout.php">Logout</a></td>
									<td width="1" align="center" valign="middle">&nbsp;</td>
									<td align="center" valign="middle" class="menu">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center" valign="top">
							<table width="1003" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="22" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x;">&nbsp;</td>
								</tr>
								<tr>
									<td align="center" valign="top">
										<table width="97%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="center" valign="top" class="border1">
													<table width="98%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td height="10"></td>
														</tr>
														<tr>
															<td align="left" class="border1">
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td>
																			<table width="98%" border="0" cellspacing="0" cellpadding="0">
																				<tr bgcolor="#FFFFFF">
																					<td colspan="3">&nbsp;</td>
																				</tr>
																				<tr bgcolor="#f2f2f2">
																					<td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
																					<td width="67%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;"><?php echo "Move " . $fname . " " . $mname . " " . $lname . " To..."; ?></td>
																					<td width="31%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;"></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>
																			<table width="100%" border="0" cellspacing="0" cellpadding="0">
																				<tr bgcolor="#f2f2f2">
																					<td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
																					<td align="left" valign="middle" bgcolor="#ffffff">
																						<form action="user-family-move-requestHOF.php" method="post" name="frm" id="frm">
																							<input type="hidden" name="vastiid" value="<?php echo $vasti_id; ?>" />
																							<input type="hidden" name="fname" value="<?php echo $fname; ?>" />
																							<input type="hidden" name="mname" value="<?php echo $mname; ?>" />
																							<input type="hidden" name="lname" value="<?php echo $lname; ?>" />
																							<input type="hidden" name="HOF" value="<?php echo $isHOF; ?>" />
																							<input type="hidden" name="gender" value="<?php echo $gender; ?>" />
																							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																								<tr>
																									<td height="30" colspan="3" align="left" bgcolor="#F8F8F8" class="text4_user">New Location Address</td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right"><strong>Line1</strong></td>
																									<td class="text" align="right">&nbsp;</td>
																									<td class="text"><input name="addr1" type="text" class="txtbox1" id="addr1" tabindex="9" value="" size="30" /></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right"><strong>Line2</strong></td>
																									<td class="text" align="right">&nbsp;</td>
																									<td class="text"><input name="addr2" type="text" class="txtbox1" id="addr2" tabindex="9" value="" size="30" /></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right"><strong>Line3</strong></td>
																									<td class="text" align="right">&nbsp;</td>
																									<td class="text"><input name="addr3" type="text" class="txtbox1" id="addr3" tabindex="9" value="" size="30" /></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right"><strong>Country</strong></td>
																									<td class="text" align="right">&nbsp;</td>
																									<td class="text"><select name="country" class="txtbox1" id="country" tabindex="12" <?php echo isset($vartxtcountry) ? $vartxtcountry : ""; ?> onchange="getState(this.value);">
																											<option value=""> Select Country </option>
																											<?php
																											while ($vartxtcountry = mysqli_fetch_array($chk_country)) {
																												if ($vartxtcountry['country_id'] == $vartxtcountry) {
																											?>
																													<option value="<?php echo $vartxtcountry['country_id']; ?>" selected="selected"> <?php echo ucwords(strtolower($vartxtcountry['country_name'])); ?></option>
																												<?php } else { ?>
																													<option value="<?php echo $vartxtcountry['country_id']; ?>"> <?php echo ucwords(strtolower($vartxtcountry['country_name'])); ?></option>
																											<?php }
																											} ?>
																										</select></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right"><strong>State</strong></td>
																									<td class="text" align="right">&nbsp;</td>

																									<td class="text"><select name="state" class="txtbox1" id="state" tabindex="13" <?php echo isset($vartxtstate) ? $vartxtstate : ""; ?> onchange="getState(this.value);">
																											<option value=""> Select State </option>
																											<?php
																											while ($vartxtstate = mysqli_fetch_array($chk_State)) {
																												if ($vartxtstate['state_id'] == $vartxtstate) {
																											?>
																													<option value="<?php echo $vartxtstate['state_id']; ?>" selected="selected"> <?php echo ucwords(strtolower($vartxtstate['state_name'])); ?></option>
																												<?php } else { ?>
																													<option value="<?php echo $vartxtstate['state_id']; ?>"> <?php echo ucwords(strtolower($vartxtstate['state_name'])); ?></option>
																											<?php }
																											} ?>
																										</select></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right"><strong>Location</strong></td>
																									<td class="text" align="right">&nbsp;</td>

																									<td class="text"><select name="City" class="txtbox1" id="City" tabindex="14" <?php echo isset($vartxtstate) ? $vartxtstate : ""; ?> onchange="getState(this.value);">
																											<option value=""> Select Location </option>
																											<?php
																											while ($vartxtcity = mysqli_fetch_array($chk_city)) {
																												if ($vartxtcity['city_id'] == $vartxtcity) {
																											?>
																													<option value="<?php echo $vartxtcity['city_id']; ?>" selected="selected"> <?php echo ucwords(strtolower($vartxtcity['city_name'])); ?></option>
																												<?php } else { ?>
																													<option value="<?php echo $vartxtcity['city_id']; ?>"> <?php echo ucwords(strtolower($vartxtcity['city_name'])); ?></option>
																											<?php }
																											} ?>
																										</select></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right"><strong>District</strong></td>
																									<td class="text" align="right">&nbsp;</td>
																									<td class="text"><input name="addr4" type="text" class="txtbox1" id="addr4" tabindex="9" value="" size="30" /></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right"><strong>Pincode</strong></td>
																									<td class="text" align="right">&nbsp;</td>
																									<td class="text"><input name="addr5" type="text" class="txtbox1" id="addr5" tabindex="9" value="" size="30" /></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right"><strong>Phone</strong></td>
																									<td class="text" align="right">&nbsp;</td>
																									<td class="text"><input name="addr6" type="text" class="txtbox1" id="addr6" tabindex="9" value="" size="30" /></td>
																								</tr>

																								<tr>
																									<td class="text" height="30" align="right"><strong>Mobile<font color="#FF0000">*</font></strong></td>
																									<td class="text" align="right">&nbsp;</td>
																									<td align="left" class="text"><input name="Mobile" type="text" minlength="10" maxlength="10" class="txtreqd txtbox1" class="Number-only" id="addr7" tabindex="9" value="" size="30" onkeyup="if(/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required=""></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right" valign="top"><strong>Remark</strong></td>
																									<td class="text" align="right">&nbsp;</td>
																									<td align="left" class="text"><span class="sublink">
																											<textarea name="prof_desc2" cols="25" rows="3" class="txtbox1" tabindex="48"><?php echo isset($prof_desc) ? $prof_desc : ""; ?></textarea>
																										</span></td>
																								</tr>
																								<tr>
																									<td class="text" height="30" align="right">&nbsp;</td>
																									<td class="text" align="right">&nbsp;</td>
																									<td align="left" class="text">&nbsp;</td>
																								</tr>
																								<tr>
																									<td height="30" colspan="3" align="left" bgcolor="#F8F8F8" class="text4_user">Members Moving With You</td>
																								</tr>
																								<tr>
																									<td height="30" colspan="3" align="left" class="text">
																										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																											<tr>

																												<td height="30" colspan="2" align="left" class="text">
																													<table width="50%" border="0" cellspacing="0" cellpadding="0">

																														<?php

																														//while($Member_Name = mysqli_fetch_array($chk_Member))
																														foreach ($familyMember as $Member_Name) { ?>
																															<tr>
																																<td width="9%" align="center" valign="middle"><input name="chk" type="checkbox" id="chk" value="1">
																																	<label for="chk"></label>
																																</td>
																																<td width="50%"><?= $Member_Name['MemberName'] ?></td>
																																<td>
																																	<span class="text_user">
																																		<select name="vasti_id2_<?= $Member_Name['vasti_id'] ?>" id="vasti_id" tabindex="3" class="text">
																																			<option value="" selected="selected">Relation Name</option>
																																			<?php
																																			foreach ($familyRelation as $Relation_Name) {
																																			?>
																																				<option value="<?php echo $Relation_Name['relation_id']; ?>"> <?php echo $Relation_Name['relation_name']; ?> </option>
																																			<?php
																																			}
																																			?>
																																		</select>
																																	</span>
																																</td>
																															</tr>
																														<?php } ?>

																														<!--    <tr>
							            <td align="center" valign="middle"><input name="chk2" type="checkbox" id="chk2" value="1" />
                                        <label for="chk2"></label></td>
							            <td height="40"><strong>Family Member2</strong></td>
							            <td><span class="text_user">
							              <select name="vasti_id3" id="vasti_id2" tabindex="3" class="text">
							                <option>Relation Name</option>
											<?php
											foreach ($familyRelation as $Relation_Name) {
											?>
                                        <option value="<?php echo $Relation_Name['relation_id']; ?>"> <?php echo $Relation_Name['relation_name']; ?> </option>
                                        <?php
											}
										?>
							                </select>
                                        </span></td>
							            </tr>    
							          </table></td>
							        </tr>  -->
																														<tr>
																															<td width="13%" class="text" height="30" align="left">&nbsp;</td>
																															<td width="1%" class="text" align="left">&nbsp;</td>
																															<td width="86%" align="left" class="text">&nbsp;</td>
																														</tr>
																														<tr>
																															<td height="10" colspan="3" align="center" class="text"></td>
																														</tr>
																														<tr>
																															<td height="30" align="center" class="text">&nbsp;</td>
																															<td align="center" class="text">&nbsp;</td>
																															<td class="text"><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" /> <input type="submit" name="btncancel" id="btncancel" value="Cancel" /></td>
																														</tr>
																													</table>
																						</form>
																					</td>
																				</tr>

																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td height="10"></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="38" align="center" valign="middle" bgcolor="#834153">
							<table width="96%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="20" align="center" valign="middle" class="footer">All Rights Reserved. Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti<span class="style2"></span></td>
								</tr>
								<tr>
									<td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://apolloinfotech.com" target="_blank"> Apollo Infotech</a></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<script>
		function showadvert() {
			var obj = document.getElementById("advtid");
			obj.style.display = "block";
		}
		var statecode = "<?php echo $vartxtstate; ?>";
		getState(countrycode, statecode);

		var citycode = "<?php echo $vartxtcity; ?>";
		getCity(statecode, citycode);
		window.onload = showadvert;
	</script>
	<script type="text/javascript">
		disableSelection(document.body) //disable text selection on entire body of page
	</script>
	<script type="text/javascript">
		var somediv = document.getElementById("mydiv")
		disableSelection(somediv) //disable text selection within DIV with id="mydiv"
	</script>
	<script type="text/javascript">
		var alltables = document.getElementsByTagName("table")
		for (var i = 0; i < alltables.length; i++)
			disableSelection(alltables[i]) //disable text selection within all tables on the page
	</script>

</body>


</html>