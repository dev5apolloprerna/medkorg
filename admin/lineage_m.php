<?php
include "connection/conn.php";
require "noentry.php";
// include "noentry.php";

require 'include/appmain.php';
require 'utility/querygen.inc';

$oQGen = new CQueryGen();
$oQGen1 = new CQueryGen();

// session_start();
$ProdThumbImgDir = "images/vastipatrak/thumb/";


if (isset($_POST["txtMode"]) == "") {
	$varMode = $_GET['Mode'];
} else {
	$varMode = $_POST['txtMode'];
}
$varCode = "";
if (isset($_POST["vasti_id"]) == "") {
	$varCode = isset($_GET['Code']) ? $_GET['Code'] : "";
} else {
	$varCode = $_POST['vasti_id'];
}

if ($_GET['level'] != "") {
	$level = $_GET['level'];
} else {
	$level = 0;
}

if ($_GET['HCode'] != "" && $_GET['HCode'] != "0") {

	$hcode = $_GET['HCode'];
	 $sql_husband_name = "SELECT v1.vasti_id,v1.fname_vc,v1.mname_vc,v1.lname_vc FROM vastipatrak_m v1
	where v1.vasti_id=" . $hcode . " order by v1.vasti_id";
	$chk_husband_name = mysqli_query($cn, $sql_husband_name);
	$husband_name_rec = mysqli_fetch_array($chk_husband_name);
	$lienagename = $husband_name_rec['fname_vc'] . " " . $husband_name_rec['mname_vc'] . " " . $husband_name_rec['lname_vc'];
} else {
	$hcode = 0;
	$lienagename = '';
}


//---------------QueryString-------------------
if ($varMode == "E") {

 	$sql_string = "SELECT * FROM vastipatrak_m where vasti_id=" . $varCode;
	$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

	if (mysqli_num_rows($check_res) < 1) {
		echo ("No rows in the database to display");
		exit;
	} else {
		$vartxtGotra=$vartxtFName=$vartxtMName=$vartxtLName='';
		while ($rec = mysqli_fetch_array($check_res)) {
			$vartxtformno = $rec['form_no'];

			$parent_id = $rec['parent_id'];

			$vartxtVillage = $rec['village_id'];
			$vartxtGotra = $rec['gotra_id'];

			$vartxtFName = $rec['fname_vc'];
			$vartxtMName = $rec['mname_vc'];
			$vartxtLName = $rec['lname_vc'];
			$vartxtMobilehome = $rec['mobile_home'];

			$vartxtGender = $rec['gender_c'];

			$birth_date = $rec['birth_date'];
			$death_date = $rec['death_date'];
			 $sql_husband_name = "SELECT v1.vasti_id,v1.fname_vc,v1.mname_vc,v1.lname_vc FROM vastipatrak_m v1
	where v1.vasti_id=" . $rec['anc_id'] . " order by v1.vasti_id";
			$chk_husband_name = mysqli_query($cn, $sql_husband_name);
			$husband_name_rec = mysqli_fetch_array($chk_husband_name);
			$lienagename = $husband_name_rec['fname_vc'] . " " . $husband_name_rec['mname_vc'] . " " . $husband_name_rec['lname_vc'];
		}
	}
}

//-------------MODE A------------------------
if ($_POST) {
	if ($_FILES["thumb_image"]["name"] != "") {
		$filename = $_FILES["thumb_image"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename, $tofind);
		$extension = substr("$filename", $position_num, $filename_len - $position_num);
		$sys_name = rand();
		$TImage = $sys_name . $extension;
		$ProdThumbImgDir . $TImage;

		move_uploaded_file($_FILES["thumb_image"]["tmp_name"], $ProdThumbImgDir . $TImage);
		$imageuploadthumb = ",thumb_image='" . $TImage . "'";
	}

	// Add data in user_master table
	// Begin get Fields of Tables
	$sql = "select * from vastipatrak_m where 1=2";
	$res = mysqli_query($cn, $sql);

	$fieldarray = array();

	while ($fd = mysqli_fetch_field($res)) :
		$fieldarray[] = $fd->name;
	endwhile;

	array_shift($fieldarray); // remove first element orderID

	// End get Fields of Tables

	$oQGen->setTableName("vastipatrak_m"); // set the table name

	foreach ($_POST as $key => $val) {
		if ($key == "vasti_id") {
			$oQGen->addFieldValue("vasti_id", $_POST['vasti_id'], "C");
		}
		if (in_array($key, $fieldarray) ) {
			$oQGen->addFieldValue($key, $val, "C");
		}
	}


	if ($_FILES['thumb_image'] != "") {
		$oQGen->addFieldValue("thumb_image", $TImage, "C");
	}

	// Get Execution Statement
	if ($_POST["txtMode"] == "A") :
		$sql_string = $oQGen->getInsert();
	else :
		$oQGen->addConditionFieldValue("vasti_id", $_POST['vasti_id'], "C");
		$sql_string = $oQGen->getUpdate();
	endif;
	$code = db_execute($cn, $sql_string);

	if ($code == 0 || $code == "")
		$code = $_POST['vasti_id'];

	redirect("lineage_list.php?HCode=" . $hcode . "&level=" . $level);
	exit;
}
?>

<html>

<head>
	<title>Samaj</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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

		.style5 {
			color: #063968;
			font-family: Arial, Helvetica, sans-serif;
			font-weight: bolder;
		}

		.style6 {
			color: #B90200;
			font-family: Arial, Helvetica, sans-serif;
			font-weight: bolder;
		}

		.style2 {
			color: #FFFFFF;
			font-weight: bold;
			font-size: 13px;
		}
		-->
	</style>

	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/userjvalid.js"></script>
	<script type='text/JavaScript' src='js/scw.js'></script>
	<script language="javascript" type="text/javascript">

	</script>
	<script src="js/jquery.js" type="text/javascript"></script>
	<link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="js/facebox.js" type="text/javascript"></script>
</head>

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
												<td width="30%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr valign="top">
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td class="h1"> Lineage (Ancestors) Master </td>
											</tr>
											<tr valign="top">
												<td width="1%" valign="top">&nbsp;</td>
												<td width="0%" valign="top">&nbsp;</td>
												<td width="69%" valign="top">
													<form name="frm" method="post" action="lineage_m.php?level=<?php echo $level; ?>&HCode=<?php echo $hcode; ?>" enctype="multipart/form-data">
														<input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
														<input type="hidden" name="vasti_id" value="<?php echo $varCode; ?>">
														<input type="hidden" name="business_id" value="">
														<input type="hidden" name="form_no" value="<?php echo isset($form_no) ? $form_no : ""; ?>">
														<input type="hidden" id="DPC_TODAY_TEXT" value="today">
														<input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
														<input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
														<input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
														<input type="hidden" name="parent_id" value="<?php echo $hcode; ?>">
														<input type="hidden" name="anc_id" value="<?php echo $hcode; ?>">
														<input type="hidden" name="level" value="<?php echo $level; ?>" />
														<input type="hidden" name="lineage" value="1" />

														<input type="hidden" id="DPC_TODAY_TEXT" value="today">
														<input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
														<input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
														<input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr valign="top">
																<td width="2%">&nbsp;</td>
																<td>
																	<table width="100%" border="0" cellspacing="0" cellpadding="0">
																		<!--
						<tr valign="top">
                          <td height="10" class="text"><div align="right">Form No. <font color="#FF0000">*</font></div></td>
                          <td height="25"><div align="center">:</div></td>
                          <td height="25" class="sublink">
                          <input type="text" name="form_no" id="Form No." value="<?php echo $vartxtformno; ?>">
						  </td>
                        </tr>
                        <tr valign="top">
                          <td height="8" class="text"></td>
                          <td height="8"></td>
                          <td height="8" class="sublink"></td>
                        </tr>
						-->
																		<tr valign="top">
																			<td width="19%" height="10" class="text">
																				<div align="right">Native Place<font color="#FF0000">*</font>
																				</div>
																			</td>
																			<td width="2%" height="25">
																				<div align="center">:</div>
																			</td>
																			<td width="79%" height="25" class="sublink">
																				<select name="village_id" tabindex="1" id="Native" class="txtrequiredsel txtbox">
																					<option value="0" selected>Please Select</option>
																					<?php
																					$sql_string = "SELECT * FROM village_m order by village_name";

																					$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
																					if (mysqli_num_rows($check_res) > 0) {
																						while ($rec = mysqli_fetch_array($check_res)) {
																							if ($vartxtVillage == $rec['village_id'])
																								echo ("<option selected value ='" . $rec['village_id'] . "'>" . $rec['village_name'] . "</option>");
																							else
																								echo ("<option value='" . $rec['village_id'] . "'>" . $rec['village_name'] . "</option>");
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
																			<td height="10" class="text">
																				<div align="right">Gotra<font color="#FF0000">*</font>
																				</div>
																			</td>
																			<td height="25">
																				<div align="center">:</div>
																			</td>
																			<td height="25" class="sublink">
																				<select name="gotra_id" tabindex="2" id="Gotra" class="txtrequiredsel txtbox">
																					<option value="0" selected>Please Select</option>
																					<?php
																					$sql_string = "SELECT * FROM gotra_m order by gotra_name";

																					$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
																					if (mysqli_num_rows($check_res) > 0) {
																						while ($rec = mysqli_fetch_array($check_res)) {
																							if ($vartxtGotra == $rec['gotra_id'])
																								echo ("<option selected value ='" . $rec['gotra_id'] . "'>" . $rec['gotra_name'] . "</option>");
																							else
																								echo ("<option value='" . $rec['gotra_id'] . "'>" . $rec['gotra_name'] . "</option>");
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
																			<td height="10" class="text">
																				<div align="right">Name</div>
																			</td>
																			<td height="25">
																				<div align="center">:</div>
																			</td>
																			<td height="25" class="sublink">
																				<table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
																					<tr>
																						<td width="15%">
																							<div align="right">First Name</div>
																						</td>
																						<td width="2%">&nbsp;</td>
																						<td width="83%"><input name="fname_vc" type="text" class="txtreqd txtbox1" id="First Name " tabindex="3" value="<?php echo isset($vartxtFName) ? $vartxtFName : ""; ?>" size="30"></td>
																					</tr>
																					<tr>
																						<td>
																							<div align="right">Middle Name </div>
																						</td>
																						<td>&nbsp;</td>
																						<td><input name="mname_vc" type="text" class="txtbox1" id="mname_vc" tabindex="4" value="<?php echo isset($vartxtMName) ? $vartxtMName : ""; ?>" size="30"></td>
																					</tr>
																					<tr>
																						<td>
																							<div align="right">Last Name </div>
																						</td>
																						<td>&nbsp;</td>
																						<td><input name="lname_vc" type="text" class="txtbox1" id="lname_vc" tabindex="5" value="<?php echo isset($vartxtLName) ? $vartxtLName : ""; ?>" size="30"></td>
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
																			<td align="left" valign="middle"><input type="file" name="thumb_image" id="thumb_image" size="30" class="text" tabindex="6"></td>
																		</tr>
																		<tr valign="top">
																			<td height="8" class="text"></td>
																			<td height="8"></td>
																			<td height="8" class="sublink"></td>
																		</tr>
																		<tr>
																			<td height="10" align="right" valign="middle" class="text"> Gender </td>
																			<td align="center" valign="middle">
																				<div align="center"><strong>:&nbsp;</strong></div>
																			</td>
																			<td align="left" valign="middle">
																				<select name="gender_c" tabindex="7">
																					<option value="Male" <?php echo (isset($vartxtGender) && $vartxtGender == "Male") ? "selected" : ""; ?>> Male </option>
																					<option value="Female" <?php echo (isset($vartxtGender) && $vartxtGender == "Female") ? "selected" : ""; ?>> Female </option>
																				</select>
																			</td>
																		</tr>
																		<tr valign="top">
																			<td height="8" class="text"></td>
																			<td height="8"></td>
																			<td height="8" class="sublink"></td>
																		</tr>
																		<tr>
																			<td height="10" align="right" valign="middle" class="text"> Mobile (Login ID) </td>
																			<td align="center" valign="middle">
																				<div align="center"><strong>:&nbsp;</strong></div>
																			</td>
																			<td align="left" valign="middle">
																			<input name="mobile_home" type="text" class="txtbox1" id="mobile_home" tabindex="8" value="<?php echo isset($vartxtMobilehome) ? $vartxtMobilehome : ""; ?>" size="30">
																			</td>
																		</tr>
																		<tr valign="top">
																			<td height="8" class="text"></td>
																			<td height="8"></td>
																			<td height="8" class="sublink"></td>
																		</tr>
																		<tr>
																			<td height="10" align="right" valign="middle" class="text"> Date of Birth </td>
																			<td align="center" valign="middle">
																				<div align="center"><strong>:&nbsp;</strong></div>
																			</td>
																			<td align="left" valign="middle">
																				<input type="text" name="birth_date" class="txtbox" id="birth_date" value="<?php echo isset($birth_date) ? $birth_date : ""; ?>" tabindex="8" /><img src="images/calendar_icon.png" width="15" height="20" onclick='scwShow(document.getElementById("birth_date"),event);' style="cursor:pointer;">
																			</td>
																		</tr>
																		<tr valign="top">
																			<td height="8" class="text"></td>
																			<td height="8"></td>
																			<td height="8" class="sublink"></td>
																		</tr>
																		<tr>
																			<td height="10" align="right" valign="middle" class="text"> Date of Expire </td>
																			<td align="center" valign="middle">
																				<div align="center"><strong>:&nbsp;</strong></div>
																			</td>
																			<td align="left" valign="middle">
																				<input type="text" name="death_date" class="txtbox" id="death_date" value="<?php echo isset($death_date) ? $death_date : ""; ?>" tabindex="9" /><img src="images/calendar_icon.png" width="15" height="20" onclick='scwShow(document.getElementById("death_date"),event);' style="cursor:pointer;">

																			</td>
																		</tr>

																		<tr>
																			<td height="10" align="right" valign="middle" class="text"> Link to lineage </td>
																			<td align="center" valign="middle">
																				<div align="center"><strong>:&nbsp;</strong></div>
																			</td>
																			<td align="left" valign="middle">
																				<?php echo $lienagename ? $lienagename : '' ?> <a href="link-lineage.php?id=<?php echo $varCode; ?>" rel="facebox">GO</a>

																			</td>
																		</tr>
																		<tr valign="top">
																			<td height="8" class="text"></td>
																			<td height="8"></td>
																			<td height="8" class="sublink"></td>
																		</tr>
																		<tr valign="top">
																			<td height="10">&nbsp;</td>
																			<td>&nbsp;</td>
																			<td><input type="submit" value="Submit" tabindex="10" width="71" height="24" border="0" onClick="javascript:return checkFormElements1(this.form);"></td>
																		</tr>
																		<tr valign="top">
																			<td>&nbsp;</td>
																			<td>&nbsp;</td>
																			<td>&nbsp;</td>
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
	<script language="javascript" type="text/javascript">
		showhideDiv("<?php echo $prof_type; ?>");
	</script>
</body>

</html>