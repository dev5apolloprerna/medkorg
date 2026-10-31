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


//$cn = getConnection("localhost","career_career","!@#$%@@","career_searchjobs");
//$cn = getConnection("localhost","root","","samaj");		
$varFieldtag = "";
if (isset($_POST["selfilter"]) <> "") {
	$varFieldTag = $_POST["selfilter"];
}

$varFieldValue = "";
if (isset($_POST["txtfiltername"]) <> "") {
	$varFieldValue = $_POST["txtfiltername"];
}

if ($_POST) {
	//-------------------COMA SEPRETOR--------------------

	if ($_POST['birth_date'] != "") {
		$where = " where DATE_FORMAT(v.birth_date,'%m-%d')='" . date('m-d', strtotime($_POST['birth_date'])) . "'";
	}
} else {
	$where = " where DATE_FORMAT(v.birth_date,'%m-%d')='" . date('m-d') . "'";
}

$sql_string = "select v.*, 
					v1.fname_vc as parfname,v1.lname_vc as parlname,
					v2.lname_vc as mainlname,
					g.gotra_name, g1.gotra_name as pargotra, g2.gotra_name as mainpargotra,
					vill.village_name, vill1.village_name as parvillage, vill2.village_name as mainparvillage, v.birth_date as birthdate
					from vastipatrak_m v 
				    
					left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
				    left outer join vastipatrak_m v2 on v1.anc_id = v2.vasti_id
					
					left outer join gotra_m g on v.gotra_id = g.gotra_id
					left outer join gotra_m g1 on v1.gotra_id = g1.gotra_id
					left outer join gotra_m g2 on v2.gotra_id = g2.gotra_id
					
					left outer join village_m vill on v.village_id = vill.village_id
					left outer join village_m vill1 on v1.village_id = vill1.village_id
					left outer join village_m vill2 on v2.village_id = vill2.village_id
					
				 	$where order by DATE_FORMAT(v.birth_date,'%m-%d'),fname_vc";

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
function doFilter()
{
	frmsearch.submit();
}

function doDisApp()
{
	var chk=document.frm['chk[]'];
	
	var t=0;
	var ids="0,";
	for(i=0;i<chk.length;i++)
	{
		if(chk[i].checked)
		{
			if(chk[i].value!=0)
				ids = ids + chk[i].value + ",";
		}
	}
	
	document.getElementById("disapp_link").href = "disapprove_member.php?Mode=IA&code="+ids;
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

	<script type='text/JavaScript' src='js/scw.js'></script>

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
												<td class="h1"><span class="h1">VastiPatrak Members List (Search By Birth Date) </span></td>
											</tr>
											<tr valign="top">
												<td width="1%">&nbsp;</td>
												<td width="85%">
													<form name="frm" method="Post" action="bday_list.php">
														<input type="hidden" id="DPC_TODAY_TEXT" value="today">
														<input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
														<input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
														<input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">

														<input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>" />
														<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
															<tr valign="top">
																<td height="40" valign="middle" class="text">&nbsp;</td>
																<td style="padding-left:05px;" class="text">&nbsp;</td>
																<td style="padding-left:05px;" class="text">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td width="10%" valign="middle" class="text">
																	<div align="right">Select a date </div>
																</td>
																<td style="padding-left:05px;" width="33%" class="text">
																	<input type="text" name="birth_date" class="txtbox" tabindex="20" id="birth_date" value="<?php echo isset($_POST['birth_date']) != "" ? $_POST['birth_date'] : date('d-m-Y'); ?>" />&nbsp;<img src="images/calendar_icon.png" width="15" height="20" onclick='scwShow(document.getElementById("birth_date"),event);' style="cursor:pointer;">
																</td>
																<td style="padding-left:05px;" width="57%" class="text"><input name="submit" type="submit" value="GO"></td>
															</tr>
															<tr valign="top">
																<td colspan="3" height="4"></td>
															</tr>
															<tr valign="top">
																<td colspan="3">
																	<table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
																		<tr valign="middle" bgcolor="#4C6B83">
																			<td width="3%" height="22" bgcolor="#161709" class="textmenuhead"><input type="checkbox" name="chkall" onChange="checkall(this);"></td>
																			<td width="10%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><b>Native</b></font>
																				</div>
																			</td>
																			<td width="10%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><b>Gotra</b></font>
																				</div>
																			</td>
																			<td width="20%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><strong>Full Name </strong></font>
																				</div>
																			</td>
																			<td width="8%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><b>D.O.B</b></font>
																				</div>
																			</td>
																			<td width="8%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><b>Mobile</b></font>
																				</div>
																			</td>
																			<td width="8%" bgcolor="#161709" class="text">
																				<div align="left">
																					<font color="#FFFFFF"><b>Email-Id</b></font>
																				</div>
																			</td>
																		</tr>
																		<?php
																		while ($rec = mysqli_fetch_array($check_res)) {
																			if ($rec['mname_vc'] == "")
																				$mname_vc = $rec['parfname'];
																			else
																				$mname_vc = $rec['mname_vc'];

																			if ($rec['lname_vc'] == "" && $rec['parlname'] == "")
																				$lname_vc = $rec['mainlname'];
																			else if ($rec['lname_vc'] == "")
																				$lname_vc = $rec['parlname'];
																			else
																				$lname_vc = $rec['lname_vc'];

																			$full_name = $rec['fname_vc'] . " " . $mname_vc . " " . $lname_vc;


																			if ($rec['gotra_name'] == "" && $rec['pargotra'] == "")
																				$gotra = $rec['mainpargotra'];
																			else if ($rec['gotra_name'] == "" && $rec['pargotra'] != "")
																				$gotra = $rec['pargotra'];
																			else
																				$gotra = $rec['gotra_name'];


																			if ($rec['village_name'] == "" && $rec['parvillage'] == "")
																				$village = $rec['mainparvillage'];
																			else if ($rec['village_name'] == "" && $rec['parvillage'] != "")
																				$village = $rec['parvillage'];
																			else
																				$village = $rec['village_name'];
																		?>
																			<tr valign="middle">
																				<td height="22"><input type="checkbox" id="chk[]" name="chk[]" value="<?php echo ($rec['vasti_id']); ?>"></td>
																				<td class="text"><?php echo ($village); ?>&nbsp;</td>
																				<td class="text"><?php echo ($gotra); ?>&nbsp;</td>
																				<td class="text"><?php echo ($full_name); ?>&nbsp;</td>
																				<td class="text"><?php echo ($rec['birthdate']); ?>&nbsp;</td>
																				<td class="text"><?php //echo($rec['mobile_number']);
																									$mobile_number = '';
																									if ($rec['mobile_home'] != "") {
																										$mobile_number = $rec['mobile_home'];
																										$ex = " / ";
																									}
																									if ($rec['alt_mobile'] != "")
																										$mobile_number = $mobile_number . $ex . $rec['alt_mobile'];
																									if ($rec['mobile_number'] != "")
																										$mobile_number = $mobile_number . $ex . $rec['mobile_number'];
																									echo $mobile_number;
																									?>&nbsp;</td>
																				<td class="text"><?php echo ($rec['email']); ?>&nbsp;</td>
																			</tr>
																		<?php
																		}
																		?>
																	</table>
																</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
															</tr>
															<tr valign="top">
																<td colspan="3">&nbsp;</td>
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
</body>

</html>