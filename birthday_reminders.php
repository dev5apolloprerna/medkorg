<?php
include_once "admin/connection/conn.php";
session_start();

$nextWeek = time() + (0 * 24 * 60 * 60);
// 7 days; 24 hours; 60 mins; 60secs

$curr_date = date('m-d');
$next_seven_days = date('m-d', $nextWeek);

// Get list of people having Bdays in next 7 days //
/*$sql_list = "select v.vasti_id,v.fname_vc,v.mname_vc,v.lname_vc,v.birth_date, 
					v1.fname_vc as parfname,v1.lname_vc as parlname,
					v2.fname_vc as mainparfname,v2.lname_vc as mainparlname
					
					from vastipatrak_m v 
				    left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
				    left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
					
				 	where DATE_FORMAT(v.birth_date,'%m-%d') between '".$curr_date."' and '".$next_seven_days."' order by DATE_FORMAT(v.birth_date,'%m-%d'),fname_vc";
	*/
$where = "where 1=1 ";
if ($_POST) {
	//-------------------COMA SEPRETOR--------------------

	if ($_POST['birth_date'] != "") {
		$where .= " and DATE_FORMAT(v.birth_date,'%m-%d')='" . date('m-d', strtotime($_POST['birth_date'])) . "'";
	}
	if ($_POST['city'] != "") {
		$where .= " and v.city='" . $_POST['city'] . "'";
	}
	if ($_POST['village_id'] != "") {
		$where .= " and v.village_id='" . $_POST['village_id'] . "'";
	}
} else {
	$where .= " and DATE_FORMAT(v.birth_date,'%m-%d')='" . date('m-d') . "'";
}
$where .= " and v.lineage=0";
$sql_list = "select v.*, 
					v1.fname_vc as parfname,v1.lname_vc as parlname,
					v2.lname_vc as mainlname,
					g.gotra_name, g1.gotra_name as pargotra, g2.gotra_name as mainpargotra,
					vill.village_name, vill1.village_name as parvillage, vill2.village_name as mainparvillage,
					state.state_name, state1.state_name as parstate, state2.state_name as mainparstate,
					city.city_name, city1.city_name as parcity, city2.city_name as mainparcity
					
					from vastipatrak_m v 
				    
					left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
				    left outer join vastipatrak_m v2 on v1.anc_id = v2.vasti_id
					
					left outer join gotra_m g on v.gotra_id = g.gotra_id
					left outer join gotra_m g1 on v1.gotra_id = g1.gotra_id
					left outer join gotra_m g2 on v2.gotra_id = g2.gotra_id
					
					left outer join village_m vill on v.village_id = vill.village_id
					left outer join village_m vill1 on v1.village_id = vill1.village_id
					left outer join village_m vill2 on v2.village_id = vill2.village_id
					
					left outer join state_m state on v.state = state.state_id
					left outer join state_m state1 on v1.state = state1.state_id
					left outer join state_m state2 on v2.state = state2.state_id
					
					left outer join city_m city on v.city = city.city_id
					left outer join city_m city1 on v1.city = city1.city_id
					left outer join city_m city2 on v2.city = city2.city_id
					
				 	$where order by DATE_FORMAT(v.birth_date,'%m-%d'),fname_vc";

$chk_list = mysqli_query($cn, $sql_list);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" />
	<!-- <script type="text/javascript" src="js/datepickercontrol.js"></script>
<link type="text/css" rel="stylesheet" href="css/datepickercontrol.css"> -->
	<script type="text/javascript" src="js/ajax.js"></script>
	<script language="javascript" type="text/javascript">
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

		function getDet(val) {
			switch (val) {
				case "S.S.C.":
					disp = "none";
					break;
				case "H.S.C.":
					disp = "none";
					break;
				case "Under Graduate(Bachelor Degree)":
					disp = "";
					break;
				case "Post Graduation(Masters Degree)":
					disp = "";
					break;
				case "Ph.D.":
					disp = "";
					break;
			}
			document.getElementById("tdedudetails").style.display = disp;
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

function doShowDiv(mode,url)
{
	document.getElementById("tdform").style.display = "";

	if(mode == 'E' || mode == 'A')
	{
		window.location = url;
	}
}
//-->
	</script>
	<style type="text/css">
		<!--
		.style2 {
			font-size: 16px;
			font-weight: bold;
		}
		-->
	</style>
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
							<?php include_once "menu.php"; ?></td>
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
												<td align="left" valign="top" class="border1">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td>
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr bgcolor="#f2f2f2">
																		<td width="2%" height="30" bgcolor="#F8F8F8">&nbsp;</td>
																		<td height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="title">Welcome <?php echo $_SESSION['Fname'] . " " . $_SESSION['Mname'] . " " . $_SESSION['Lname']; ?></td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td>&nbsp;</td>
														</tr>
														<tr>
															<td valign="top">
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="35%" valign="top">
																			<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
																				<tr>
																					<td height="1" align="left" bgcolor="#e2e2e2"></td>
																				</tr>
																				<tr>
																					<td height="30" align="left" bgcolor="#F8F8F8" style="padding-left:5px;"><strong class="text4">Birthday Reminders</strong></td>
																				</tr>
																				<tr>
																					<td align="left">
																						<table width="100%" border="0" cellspacing="0" cellpadding="0">
																							<tr class="text1">
																								<td height="1" colspan="6" class="text" bgcolor="#e2e2e2"></td>
																							</tr>
																							<tr class="text1">
																								<td colspan="6">&nbsp;</td>
																							</tr>
																							<tr class="text1">
																								<td colspan="3" valign="middle" class="text">
																									<form name="frm" method="Post" action="birthday_reminders.php">
																										<input type="hidden" id="DPC_TODAY_TEXT" value="today">
																										<input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
																										<input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
																										<input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">

																										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																											<tr class="text1">
																												<td valign="middle" class="text" style="padding-left:05px;">
																													<div align="right">City</div>
																												</td>
																												<td valign="middle" class="text" style="padding-left:05px;">
																												    <?php 
    																												    // Query for State//
                                                                                                                        $sql_city = "SELECT * FROM city_m where country_id=10 order by city_name";
                                                                                                                        $chk_city = mysqli_query($cn, $sql_city);
                                                                                                                        $tmp_city = mysqli_fetch_array($chk_city); 
                                                                                                                    ?>
																													<select name="city" id="city" style="padding-left:05px;">
                                                                                                                        <option value="" selected="selected">Select City</option>
                                                                                                                        <?php
                                                                                                                        while ($city = mysqli_fetch_array($chk_city)) { ?>
                                                                                                                          <option value="<?php echo $city['city_id']; ?>" <?php echo (isset($_POST['city']) && $_POST['city'] == $city['city_id']) ? "selected" : ""; ?>> <?php echo $city['city_name']; ?> </option>
                                                                                                                        <?php  } ?>
                                                                                                                      </select>
																												</td>
																												<td valign="middle" class="text" style="padding-left:05px;">
																													<div align="right">Native</div>
																												</td>
																												<td valign="middle" class="text" style="padding-left:05px;">
																													<select name="village_id" id="Native" tabindex="2">
                                                                                                                      <option value="" selected="selected">Select Native</option>
                                                                                                                      <?php
                                                                                                                      $sql_string = "SELECT * FROM village_m order by village_name";
                                                                                                                      $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                                                                                                      if (mysqli_num_rows($check_res) > 0) {
                                                                                                                        while ($rec = mysqli_fetch_array($check_res)) {
                                                                                                                          if (isset($_POST['village_id']) && $_POST['village_id'] == $rec['village_id'])
                                                                                                                            echo ("<option selected value ='" . $rec['village_id'] . "'>" . ucwords(strtolower($rec['village_name'])) . "</option>");
                                                                                                                          else
                                                                                                                            echo ("<option value='" . $rec['village_id'] . "'>" . ucwords(strtolower($rec['village_name'])) . "</option>");
                                                                                                                        }
                                                                                                                      }
                                                                                                                      ?>
                                                                                                                    </select>
																												</td>
																												<td valign="middle" class="text" style="padding-left:05px;">
																													<div align="right">Select a date </div>
																												</td>
																												<td valign="middle" class="text" style="padding-left:05px;">
																													<input type="date" name="birth_date" class="txtbox" tabindex="20" id="birth_date" datepicker_format="DD-MM-YYYY" datepicker="true" value="<?php echo ($_POST['birth_date'] != "") ? $_POST['birth_date'] : date('d-m-Y'); ?>" />
																												</td>
																												<td valign="middle" class="text" style="padding-left:05px;"><input name="submit" type="submit" value="GO" /></td>
																											</tr>
																										</table>
																									</form>
																								</td>
																								<!--<td class="text4">&nbsp;</td>-->
																								<!--<td class="text4">&nbsp;</td>-->
																								<!--<td height="30" class="text4">&nbsp;</td>-->
																							</tr>
																							<tr class="text1">
																								<td colspan="6">&nbsp;</td>
																							</tr>
																							<tr class="text1">
																								<td width="25%" height="30">&nbsp;</td>
																								<td width="15%" class="text4">
																									<div align="center"><strong>Birth Date </strong></div>
																								</td>
																								<td width="15%" class="text4">
																									<div align="center"><strong>Native</strong></div>
																								</td>
																								<td width="15%" class="text4">
																									<div align="center"><strong>Current Location </strong></div>
																								</td>
																								<td width="13%" class="text4">
																									<div align="center"><strong>Email ID </strong></div>
																								</td>
																								<td width="13%" height="30" class="text4">
																									<div align="center"><strong>Mobile Number </strong></div>
																								</td>
																							</tr>
																							<tr class="text1">
																								<td height="1" colspan="6" class="text" bgcolor="#e2e2e2"></td>
																							</tr>
																							<?php
																							while ($bday_list = mysqli_fetch_array($chk_list)) {
																								if ($bday_list['mname_vc'] == "")
																									$mname_vc = $bday_list['parfname'];
																								else
																									$mname_vc = $bday_list['mname_vc'];

																								if ($bday_list['lname_vc'] == "" && $bday_list['parlname'] == "")
																									$lname_vc = $bday_list['mainlname'];
																								else if ($bday_list['lname_vc'] == "" && $bday_list['parlname'] != "")
																									$lname_vc = $bday_list['parlname'];
																								else
																									$lname_vc = $bday_list['lname_vc'];

																								if ($bday_list['city_name'] == "" && $bday_list['parcity'] == "")
																									$city_name = $bday_list['mainparcity'];
																								else if ($bday_list['city_name'] == "" && $bday_list['parcity'] != "")
																									$city_name = $bday_list['parcity'];
																								else
																									$city_name = $bday_list['city_name'];

																								if ($bday_list['state_name'] == "" && $bday_list['parstate'] == "")
																									$state_name = $bday_list['mainparstate'];
																								else if ($bday_list['state_name'] == "" && $bday_list['parstate'] != "")
																									$state_name = $bday_list['parstate'];
																								else
																									$state_name = $bday_list['state_name'];

																								if ($bday_list['village_name'] == "" && $bday_list['parvillage'] == "")
																									$village_name = $bday_list['mainparvillage'];
																								else if ($bday_list['village_name'] == "" && $bday_list['parvillage'] != "")
																									$village_name =  $bday_list['parvillage'];
																								else
																									$village_name = $bday_list['village_name'];

																								$mobile_number = '';
																								if ($bday_list['mobile_home'] != "") {
																									$mobile_number = '<a href="tel:'.$bday_list['mobile_home'].'">' .$bday_list['mobile_home'] . ' <img src="images/Call.png" style="width: 12px;"></a>';
																									$ex = " / ";
																								}
																								if ($bday_list['alt_mobile'] != "")
																									$mobile_number = $mobile_number . $ex . '<a href="tel:'.$bday_list['alt_mobile'].'">' .$bday_list['alt_mobile']. ' <img src="images/Call.png" style="width: 12px;"></a>';
																								if ($bday_list['mobile_number'] != "")
																									$mobile_number = $mobile_number . $ex . '<a href="tel:'.$bday_list['mobile_home'].'">' .$bday_list['mobile_number']. ' <img src="images/Call.png" style="width: 12px;"></a>';

																								$curr_location = "";

																								if ($city_name != "") {
																									$curr_location = $city_name;
																									$ex1 =  ",";
																								}
																								if ($state_name != "") {
																									$curr_location = $curr_location . $ex1 . $state_name;
																								}

																								$full_name = trim($bday_list['fname_vc']) . " " . trim($mname_vc) . " " . trim($lname_vc);

																								//if the village name is blank go to the hof and take the village name for the same
																								if ($village_name == "") {
																									//first get the hod of the family
																									$strsql = "select parent_id from vastipatrak_m where vasti_id=" . $bday_list['vasti_id'];
																									$rstmp = mysqli_query($cn, $strsql);
																									$rs = mysqli_fetch_array($rstmp);

																									//get the village information
																									if ($rs['parent_id'] > 0) {
																										$strsql = "select village_name from vastipatrak_m left outer join village_m on vastipatrak_m.village_id = village_m.village_id where vasti_id=" . $rs['parent_id'];
																										$rstmp = mysqli_query($cn, $strsql);
																										$rs = mysqli_fetch_array($rstmp);

																										$village_name = isset($rs['village_name']) ? $rs['village_name'] : "";
																									}
																								}

																								//if the city name or the state name is not present then display it from HOF
																								if ($city_name == "" || $state_name == "") {
																									//first get the hod of the family
																									$strsql = "select parent_id from vastipatrak_m where vasti_id=" . $bday_list['vasti_id'];
																									$rstmp = mysqli_query($cn, $strsql);
																									$rs = mysqli_fetch_array($rstmp);

																									if ($rs['parent_id'] > 0) {
																										//get the village information
																										$strsql = "select city_name, state_name from vastipatrak_m left outer join city_m on vastipatrak_m.city = city_m.city_id left outer join state_m on vastipatrak_m.state = state_m.state_id  where vasti_id=" . $rs['parent_id'];
																										$rstmp = mysqli_query($cn, $strsql);
																										$rs = mysqli_fetch_array($rstmp);

																										$city_name = isset($rs['city_name']) ? $rs['city_name'] : "";
																										$state_name = isset($rs['state_name']) ? $rs['state_name'] : "";
																									}
																								}
																							?>
																								<tr class="text1">
																									<td height="30">
																										<div align="justify"><a href="user-full-profile.php?viewmode=bd&VId=<?php echo $bday_list['vasti_id']; ?>" target="_blank" class="text1" style="padding-left:3px;"><strong><?php echo $full_name; ?></strong> </a></div>
																									</td>
																									<td>
																										<div align="center"><strong><?php echo date('d-m-Y', strtotime($bday_list['birth_date'])); ?></strong></div>
																									</td>
																									<td>
																										<div align="center"><strong><?php echo $village_name; ?></strong></div>
																									</td>
																									<td>
																										<div align="center"><strong><?php if ($city_name != "") {
																																		echo $city_name . ", ";
																																	}
																																	echo $state_name; ?></strong></div>
																									</td>
																									<td>
																										<div align="center"><strong><?php if(isset($bday_list['email']) && $bday_list['email'] != "") {
																										    echo '<a href="mailto:'.$mainmem['email'].'">'.$bday_list['email'].'</a>';
																									    } 
																									    ?></strong></div>
																									</td>
																									<td height="30">
																										<div align="center"><strong><?php echo $mobile_number; ?></strong></div>
																									</td>
																								</tr>
																								<tr class="text1">
																									<td height="1" colspan="6" class="text" bgcolor="#e2e2e2"></td>
																								</tr>
																							<?php } ?>
																						</table>
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td valign="top">&nbsp;</td>
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
									<td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://apolloinfotech.com/" target="_blank"> Apollo Infotech</a></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<script language="javascript" type="text/javascript">
		var mode = '<?php echo $_GET['Mode']; ?>';
		if (mode == "") {
			document.getElementById("tdform").style.display = "none";
		} else {
			document.getElementById("tdform").style.display = "";
		}
	</script>
	<script>
		function showadvert() {
			var obj = document.getElementById("advtid");
			obj.style.display = "block";
		}

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