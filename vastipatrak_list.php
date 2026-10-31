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

//$cn = getConnection("localhost","career_career","!@#$%@@","career_searchjobs");
//$cn = getConnection("localhost","root","","samaj");		
if ($_POST) {
	if ($_POST["selField"] <> "") {
		$varField = $_POST["selField"];
		if ($varField == "v.verified")
			$search_text = $_POST["search_sel"];
		else
			$search_text = $_POST["search_text"];

		if ($varField == "v.form_no")
			$sqlextra = " and " . $varField . " ='" . $search_text . "'";
		else
			$sqlextra = " and " . $varField . " like '%" . $search_text . "%'";
	}
}

//---------------DELETE MODE-----------------------------

if (isset($_POST["txtMode"]) == "D") {
	//$sql_string = "DELETE FROM vastipatrak_m WHERE vasti_id = (" . $_POST["txtDCode"] . ")";
	//$check_res = mysql_query($sql_string,$cn) or die(mysql_error($cn));
	$page = "vastipatrak_list.php";
	$redirect = "vastipatrak_changes_notification.php?code=" . $_POST["txtDCode"] . "&page=" . $page . "&mode=D";

	header("Location: " . $redirect);
	exit;
	$_POST["txtMode"] = "";
}

if (isset($_POST["txtMode"]) == "V") {
	$sql_string = "Update vastipatrak_m set verified='1' WHERE vasti_id = (" . $_POST["txtDCode"] . ")";
	$check_verify = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
	$_POST["txtMode"] = "";
}

if (isset($_POST["txtMode"]) == "UV") {
	$sql_string = "Update vastipatrak_m set verified='0' WHERE vasti_id = (" . $_POST["txtDCode"] . ")";
	$check_unverify = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
	$_POST["txtMode"] = "";
}

if ($_POST) {
	$check = isset($_POST['check']) ? $_POST['check'] : '';
	$sql_string = "SELECT v.*,vill.village_name,g.gotra_name,u.user_login,u.plaintxt_password,city.city_name, city.std_code_vc, country.call_code_vc FROM vastipatrak_m v 
	 				left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join village_m vill on vill.village_id = v.village_id  
					left outer join user_m u on v.vasti_id = u.vasti_id  
					left outer join city_m city on v.city = city.city_id  
					left outer join country_m country on v.country = country.country_id 
					where  lineage!=1 $sqlextra";
	if (isset($_POST['check'])) {
		$sql_string .= " and parent_id=0";
	}
} else {
	$sql_string = "SELECT v.*,vill.village_name,g.gotra_name,u.user_login,u.plaintxt_password,city.city_name FROM vastipatrak_m v 
	 				left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join village_m vill on vill.village_id = v.village_id  
					left outer join user_m u on v.vasti_id = u.vasti_id  
					left outer join city_m city on v.city = city.city_id  
					where 1=2
					order by v.fname_vc,v.mname_vc,v.lname_vc,v.vasti_id DESC";
}

$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
$row_cnt = mysqli_num_rows($check_res);


$_POST['check'] = "0";
if ($check = 1) {
	$sql = "SELECT * FROM `vastipatrak_m`WHERE parent_id=0 AND anc_id=0";
	$chk_sql = mysqli_query($cn, $sql);
} else if ($check = 0) {
	$sql1 = "SELECT * FROM `vastipatrak_m`";
	$chk_sql1 = mysqli_query($cn, $sql1);
	print_r($chk_sql1);
	exit;
}
?>
<html>

<head>
	<title>Samaj</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/JavaScript">
		<!--
function checkall(field)
{
	chk=document.frm['chk[]'];
	 
	if(typeof(chk.length)=="undefined")
		chk.checked=field.checked?true:false;
	
	for(i=0;i<chk.length;i++)
	 	chk[i].checked=field.checked?true:false; 
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
												<td class="h1"><span class="h1">VastiPatrak List </span></td>
											</tr>
											<tr valign="top">
												<td width="1%">&nbsp;</td>
												<td width="85%">
													<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr valign="top">
															<td>&nbsp;</td>
															<td class="text">
																<form name="frmSearch" method="Post" action="vastipatrak_list.php">
																	<table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
																		<tr valign="middle" bgcolor="#666666">
																			<td height="22" colspan="4" class="text" style="padding-left:08px;">
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
																			<td width="14%" height="22" class="text">
																				<div align="right">
																					<select name="selField" onChange="showHideField(this.value);">
																						<option value="vill.village_name" <?php echo ($_POST['selField'] == "vill.village_name") ? "selected" : ""; ?>> Native </option>
																						<option value="g.gotra_name" <?php echo ($_POST['selField'] == "g.gotra_name") ? "selected" : ""; ?>> Gotra </option>
																						<option value="v.fname_vc" <?php echo ($_POST['selField'] == "v.fname_vc") ? "selected" : ""; ?>> Name </option>
																						<option value="v.email" <?php echo ($_POST['selField'] == "v.email") ? "selected" : ""; ?>> Email ID </option>
																						<option value="v.verified" <?php echo ($_POST['selField'] == "v.verified") ? "selected" : ""; ?>> Verification Status </option>
																						<option value="v.form_no" <?php echo ($_POST['selField'] == "v.form_no") ? "selected" : ""; ?>> Form No. </option>
																						<option value="city.city_name" <?php echo ($_POST['selField'] == "city.city_name") ? "selected" : ""; ?>> Current Location </option>
																					</select>
																				</div>
																			</td>
																			<td width="21%" class="text" style="padding-left:10px; ">
																				<select name="search_sel" id="search_sel" style="display:none;">
																					<option value="1" <?php echo (isset($_POST['search_sel']) == "1") ? "selected" : ""; ?>> Verified </option>
																					<option value="0" <?php echo (isset($_POST['search_sel']) == "0") ? "selected" : ""; ?>> Unverified </option>
																				</select>
																				<input type="text" name="search_text" value="<?php echo ($_POST['search_text']) ? $_POST['search_text'] : ''; ?>" id="search_text">
																			</td>

																			<td width="30%" class="check" style="padding-left:20px;">
																				<span class="click">
																				
																					<input type="checkbox" id="check" name="check" value="1" <?php echo ($check == "1") ? "checked" : ""; ?> >
																				</span>Head Of Family
																			</td>
																			<td width="65%" height="30" class="text" style="padding-left:10px; "><input type="submit" value="GO">&nbsp; </td>
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
																<div align="right"><a href="#" onClick="javascript:doAction('A','Activate');"><?php if ($flg_add == "1") { ?> </a><a href="vastipatrak_m.php?Mode=A" class="link"> Add </a> | <?php } ?><a href="home.php" class="link">Back</a></div>
															</td>
														</tr>
														<tr valign="top">
															<td width="2%">&nbsp;</td>
															<td>
																<form name="frm" method="Post" action="vastipatrak_list.php">
																	<input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>" />
																	<input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>" />
																	<input type="hidden" name="txtDCode" value="" />
																	<table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
																		<tr valign="middle" bgcolor="#666666">
																			<td width="5%" height="22" bgcolor="#666666" class="text" style="padding-left:08px;">
																				<div align="left">
																					<font color="#FFFFFF"><b>Native</b></font>
																				</div>
																			</td>
																			<td width="5%" class="text" style="padding-left:08px;">
																				<div align="left">
																					<font color="#FFFFFF"><b>Gotra</b></font>
																				</div>
																			</td>
																			<td width="15%" bgcolor="#666666" class="text" style="padding-left:08px;">
																				<div align="left">
																					<font color="#FFFFFF"><strong>Full Name </strong></font>
																				</div>
																			</td>
																			<td width="9%" bgcolor="#666666" class="text" style="padding-left:08px;">
																				<div align="center">
																					<font color="#FFFFFF"><strong>Login Details </strong></font>
																				</div>
																			</td>
																			<td width="3%" bgcolor="#666666" class="text">&nbsp;</td>
																		</tr>
																		<?php
																		while ($rec = mysqli_fetch_array($check_res)) {
																		?>
																			<tr valign="middle">
																				<td height="22" class="text" style="padding-left:08px;"><?php echo ($rec['village_name']); ?>&nbsp;</td>
																				<td class="text"><?php echo ($rec['gotra_name']); ?>&nbsp;</td>
																				<td class="text" style="padding-top:05px;">
																					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
																						<tr>
																							<td height="30"><strong><?php echo ($rec['fname_vc'] . " " . $rec['mname_vc'] . " " . $rec['lname_vc']); ?></strong></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>DOB :</strong> <?php echo (date('d-m-Y', strtotime($rec['birth_date']))); ?></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>MOBILE :</strong> <?php
																																		if ($rec['call_code_vc'] != "" && $rec['mobile_home'] != "") {
																																			echo ($rec['call_code_vc'] . "&nbsp;");
																																		}
																																		echo ($rec['mobile_home']); ?></td>
																						</tr>
																						<tr>
																							<td height="30"><strong>EMAIL :</strong> <?php echo ($rec['email']); ?></td>
																						</tr>
																					</table> �
																				</td>
																				<td class="text">
																					<div align="center">
																						<table width="100%" border="0" cellspacing="0" cellpadding="0">
																							<tr>
																								<td height="30" class="text"><strong>UserName : </strong><?php echo ($rec['user_login']); ?></td>
																							</tr>
																							<tr>
																								<td height="30" class="text"><strong>Password : </strong><?php echo ($rec['plaintxt_password']); ?></td>
																							</tr>
																						</table>
																					</div>
																				</td>
																				<td class="text">
																					<div align="center"><a href="family_details.php?HCode=<?php echo ($rec['vasti_id']); ?>&level=2" class="sublink"> </a>
																						<table width="100%" border="0" cellspacing="0" cellpadding="0">
																							<tr>
																								<td height="30">
																									<div align="center"><a href="family_details.php?HCode=<?php echo ($rec['vasti_id']); ?>&level=2" class="sublink">Family</a></div>
																								</td>
																							</tr>
																							<tr>
																								<td height="20">&nbsp;</td>
																							</tr>
																							<tr>
																								<td>
																									<div align="center"><?php if ($flg_edit == "1") { ?><a href="vastipatrak_m.php?Code=<?php echo ($rec['vasti_id']); ?>&Mode=E&HCode=<?php echo isset($hcode) ? $hcode : ""; ?>&level=<?php echo isset($level) ? $level : ""; ?>" class="sublink">Edit</a><?php } ?></div>
																								</td>
																							</tr>
																							<tr>
																								<td>
																									<div align="center"><?php if ($flg_del == "1") { ?><a href="javascript:doDelete(<?php echo ($rec['vasti_id']); ?>);" class="sublink">Delete</a><?php } ?></div>
																								</td>
																							</tr>
																						</table>
																					</div>
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
	<script language="javascript" type="text/javascript">
		var searchtype = '<?php echo $_POST["selField"]; ?>';
		showHideField(searchtype);
	</script>
</body>

</html>