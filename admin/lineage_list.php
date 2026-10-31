<?php
ob_start();
include "connection/conn.php";
// require "noentry.php";
// include "noentry.php";

$ProdThumbImgDir = "images/vastipatrak/thumb/";

session_start();

$txtDCode = $_SESSION["UserAdminCode"];
$txtUserEmail = $_SESSION["UserAdminEmail"];

// start //
// to get code of this master .. //
$sql_code_master = "select adm_mnu_id from admin_menu where mnu_name='Lineage (Ancestors) Master'";
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

if (isset($_GET['level']) != "") {
	$level = $_GET['level'];
} else {
	$level = 0;
}

if (isset($_GET['HCode']) != "") {
	$hcode = $_GET['HCode'];
} else {
	$hcode = 0;
}

if ($_SESSION["UserAdminCode"] == "") {
	$redirect = "index.php";
	header("Location: $redirect");
}


//$cn = getConnection("localhost","career_career","!@#$%@@","career_searchjobs");
//$cn = getConnection("localhost","root","","samaj");		
// $varFieldtag = "";
// if (isset($_POST["selfilter"]) <> "")
// {
// 	$varFieldTag = $_POST["selfilter"];
// }

// $varFieldValue = "";
// if (isset($_POST["txtfiltername"]) <> "")
// {
// 	$varFieldValue = $_POST["txtfiltername"];
// }

if ($_POST) {
	//-------------------COMA SEPRETOR--------------------

	/*$arr = $_POST["chk"];
			foreach($arr as $val)
			{
				if (isset($val))
				{
					if ($chkstr != "")
					 	$chkstr .= ",";
					$chkstr .= $val;
				}
			}*/
	//---------------DELETE MODE-----------------------------
	// if ($_POST["selField"] <> "") {
	// 	$varField = $_POST["selField"];
	// 	if ($varField == "v.verified")
	// 		$search_text = $_POST["search_sel"];
	// 	else
	// 		$search_text = $_POST["search_text"];

	// 	if ($varField == "v.form_no")
	// 		$sqlextra = " and " . $varField . " ='" . $search_text . "'";
	// 	else
	// 		$sqlextra = " and " . $varField . " like '%" . $search_text . "%'";
	// }
	$sqlextra = '';
	if ($_POST['v_fname_vc'] != '') {
		$sqlextra .= " and v.fname_vc like '%" . $_POST['v_fname_vc'] . "%'";
	}
	if ($_POST['v_mname_vc'] != '') {
		$sqlextra .= " and v.mname_vc  like '%" . $_POST['v_mname_vc'] . "%'";
	}
	if ($_POST['g_gotra_name'] != '') {
		$sqlextra .= " and g.gotra_name like '%" . $_POST['g_gotra_name'] . "%'";
	}
	if ($_POST['city_city_name'] != '') {
		$sqlextra .= " and city.city_name like '%" . $_POST['city_city_name'] . "%'";
	}
	if ($_POST['vill_village_name'] != '') {
		$sqlextra .= " and vill.village_name like '%" . $_POST['vill_village_name'] . "%'";
	}

	if ($_POST["txtMode"] == "D") {
		$sql_string = "DELETE FROM vastipatrak_m WHERE vasti_id = (" . $_POST["txtDCode"] . ")";
		$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
		$_POST["txtMode"] = "";
	}
}
if ($_POST) {
	$sql_string = "SELECT *,city.city_name FROM vastipatrak_m v 
	 				left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join village_m vill on vill.village_id = v.village_id  
					left outer join city_m city on v.city = city.city_id  
					where 1=1 $sqlextra
					order by vill.village_name,g.gotra_name,v.fname_vc,v.mname_vc,v.lname_vc,v.vasti_id";
} else {
	$sql_string = "SELECT *,city.city_name FROM vastipatrak_m v 
	 				left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join village_m vill on vill.village_id = v.village_id 
					left outer join city_m city on v.city = city.city_id  
					where parent_id=" . $hcode . " and lineage=1 and level=" . $level . " 
					order by vill.village_name,g.gotra_name,v.fname_vc,v.mname_vc,v.lname_vc,v.vasti_id";
	// $sql_string = "SELECT * FROM vastipatrak_m v 
	//  				left outer join gotra_m g on v.gotra_id = g.gotra_id  
	// 				left outer join village_m vill on vill.village_id = v.village_id  
	// 				where parent_id=" . $hcode . " 
	// 				order by vill.village_name,g.gotra_name,v.fname_vc,v.mname_vc,v.lname_vc,v.vasti_id";
}

$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
$row_cnt = mysqli_num_rows($check_res);


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
function doAction(act,action)
 {
 	var chk=document.frm['chk[]'];
	
	var t=0;
	if(typeof(chk.length)=="undefined")
	{	 
		if(window.confirm('Are you sure to '+action+' the Selected Records?'))
		{
			document.frm.txtMode.value=act;
			document.frm.submit(); 
			return;
		}	
	}
	for(i=0;i<chk.length;i++)
	{
		chk[i].checked?t++:null;
	}
	if(t==0)
	{
		alert('No Records are Selected');
		return;
	}
	 if(window.confirm('Are you sure to '+action+' the Selected Records?'))
	{
		 document.frm.txtMode.value=act;
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
												<td class="h1"><span class="h1">Lineage (Ancestors) List </span></td>
											</tr>

											<tr valign="top">
												<td width="1%">&nbsp;</td>
												<td width="85%">
													<form name="frm" method="Post" action="lineage_list.php?level=<?php echo $level; ?>&HCode=<?php echo $hcode; ?>">
														<input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>" />
														<input type="hidden" name="txtCode" value="<?php echo $vartxtCode; ?>" />
														<input type="hidden" name="parent_id" value="<?php echo $vartxtCode; ?>" />
														<input type="hidden" name="txtDCode" value="" />
														<input type="hidden" name="level" value="<?php echo $level; ?>" />
														<input type="hidden" name="lineage" value="1" />
														<table>

															<tr valign="middle" bgcolor="#666666">
																<form name="frmSearch" method="Post" action="lineage_list.php?level=<?php echo $level; ?>&HCode=<?php echo $hcode; ?>">
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
																<!-- <td width="14%" height="22" class="text">
																		<div align="right">
																		<select name="selField" onChange="showHideField(this.value);">
																			<option value="vill.village_name" <?php echo isset($_POST['selField']) == "vill.village_name" ? "selected" : ""; ?>> Native </option>
																			<option value="g.gotra_name" <?php echo isset($_POST['selField']) == "g.gotra_name" ? "selected" : ""; ?>> Gotra </option>
																			<option value="v.fname_vc" <?php echo isset($_POST['selField']) == "v.fname_vc" ? "selected" : ""; ?>> Name </option>
																			<option value="v.email" <?php echo isset($_POST['selField']) == "v.email" ? "selected" : ""; ?>> Email ID </option>
																			<option value="v.verified" <?php echo isset($_POST['selField']) == "v.verified" ? "selected" : ""; ?>> Verification Status </option>
																			<option value="v.form_no" <?php echo isset($_POST['selField']) == "v.form_no" ? "selected" : ""; ?>> Form No. </option>
																			<option value="city.city_name" <?php echo isset($_POST['selField']) == "city.city_name" ? "selected" : ""; ?>> Current Location </option>
																		</select>
																	</div>
																</td>-->
																<td width="85%" class="text" style="padding-left:10px; ">
																	<select name="search_sel" id="search_sel" style="display:none;">
																		<option value="1" <?php echo (isset($_POST['search_sel']) == "1") ? "selected" : ""; ?>> Verified </option>
																		<option value="0" <?php echo (isset($_POST['search_sel']) == "0") ? "selected" : ""; ?>> Unverified </option>
																	</select>
																	<!-- <input type="text" name="search_text" value="<?php echo isset($_POST['search_text']); ?>" id="search_text">-->
																	<input type="text" name="v.fname_vc" value="<?php echo isset($_POST['v_fname_vc']) ? (($_POST['v_fname_vc']) ? $_POST['v_fname_vc'] : '') : ""; ?>" id="search_text" placeholder="First name">
																	<input type="text" name="v.mname_vc" value="<?php echo isset($_POST['v_mname_vc']) ? (($_POST['v_mname_vc']) ? $_POST['v_mname_vc'] : '') : ""; ?>" id="search_text" placeholder="Middle name">
																	<input type="text" name="g.gotra_name" value="<?php echo isset($_POST['g_gotra_name']) ? (($_POST['g_gotra_name']) ? $_POST['g_gotra_name'] : '') : ""; ?>" id="search_text" placeholder="Gotra">
																	<input type="text" name="city.city_name" value="<?php echo isset($_POST['city_city_name']) ? (($_POST['city_city_name']) ? $_POST['city_city_name'] : '') : ""; ?>" id="search_text" placeholder="current city">
																	<input type="text" name="vill.village_name" value="<?php echo isset($_POST['vill_village_name']) ? (($_POST['vill_village_name']) ? $_POST['vill_village_name'] : '') : ""; ?>" id="search_text" placeholder="native">
																</td>


																<td width="15%" height="30" class="text" style="padding-left:10px; "><input type="submit" value="GO">&nbsp;</td>
															</tr>
														</table>
													</form>
													<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr valign="top">
															<td>&nbsp;</td>
															<td class="text">
																<div align="right"><a href="#" onClick="javascript:doAction('A','Activate');"> </a><?php if ($flg_add == "1") { ?><a href="lineage_m.php?Mode=A&level=<?php echo $level; ?>&HCode=<?php echo $hcode; ?>" class="link"> Add </a> |<?php } ?> <a href="javascript:history.back();" class="link">Back</a></div>
															</td>
														</tr>

														<tr valign="top">
															<td width="2%">&nbsp;</td>
															<td>
																<table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
																	<tr valign="middle" bgcolor="#4C6B83">
																		<td width="4%" height="22" bgcolor="#161709" class="textmenuhead"><input type="checkbox" name="chkall" onChange="checkall(this);"></td>
																		<td width="15%" bgcolor="#161709" class="text">
																			<div align="left">
																				<font color="#FFFFFF"><b>Native</b></font>
																			</div>
																		</td>
																		<td width="15%" bgcolor="#161709" class="text">
																			<div align="left">
																				<font color="#FFFFFF"><b>Gotra</b></font>
																			</div>
																		</td>
																		<td width="30%" bgcolor="#161709" class="text">
																			<div align="left">
																				<font color="#FFFFFF"><strong>Full Name </strong></font>
																			</div>
																		</td>
																		<td width="19%" bgcolor="#161709" class="text">
																			<div align="left">
																				<font color="#FFFFFF"><strong>Image</strong></font>
																			</div>
																		</td>
																		<td width="17%" bgcolor="#161709" class="text">Tree Detail</td>
																		<td width="17%" bgcolor="#161709" class="text">Action</td>
																	</tr>
																	<?php
																	while ($rec = mysqli_fetch_array($check_res)) {
																		$strsql = "select * from vastipatrak_m where (anc_id=" . $rec['vasti_id'] . ") ORDER BY vasti_id";
																		$chkres = mysqli_query($cn, $strsql);
																		$numrecored = mysqli_num_rows($chkres);
																	?>
																		<tr valign="middle">
																			<td height="22"><input type="checkbox" name="chk[]" value="<?php echo ($rec['vasti_id']); ?>"></td>
																			<td class="text"><?php echo ($rec['village_name']); ?>&nbsp;</td>
																			<td class="text"><?php echo ($rec['gotra_name']); ?>&nbsp;</td>
																			<td class="text"><?php echo ($rec['fname_vc'] . " " . $rec['mname_vc'] . " " . $rec['lname_vc']); ?>&nbsp;</td>
																			<td class="text"><img src="<?php echo ($ProdThumbImgDir . $rec['thumb_image']); ?>" width="90" height="90">&nbsp;</td>
																			<td align="center" class="text"><a target="_blank" href="user-familytree.php?id=<?php echo ($rec['vasti_id']); ?>" class="sublink">Tree</a></td>
																			<td class="text"><!-- <a href="lineage_list.php?HCode=<?php echo ($rec['vasti_id']); ?>&level=<?php echo $level + 1; ?>" class="sublink"> Successor </a>-->
																				<?php if ($flg_edit == "1" && $rec['lineage'] == 1) { ?> | <a href="lineage_m.php?Code=<?php echo ($rec['vasti_id']); ?>&Mode=E&HCode=<?php echo $hcode; ?>&level=<?php echo $level; ?>" class="sublink"> E</a>

																					<?php if ($numrecored <= 0) { ?>
																						<?php if ($flg_del == "1") { ?> <a href="javascript:doDelete(<?php echo ($rec['vasti_id']); ?>);" class="sublink">| D</a><?php }
																																																			}
																																																			?>
																			| <a href="still_alive.php?Code=<?php echo ($rec['vasti_id']); ?>&Mode=alive" class="sublink"> Still Alive</a>
																																																			<?php
																																																		} ?></td>
																		</tr>
																	<?php
																	}
																	?>
																</table>
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
		var searchtype = '<?php echo $_POST["selField"]; ?>';
		showHideField(searchtype);
	</script>
</body>

</html>