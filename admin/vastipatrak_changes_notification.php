<?php
include "connection/conn.php";
$sql_string = "SELECT * FROM config_m where config_name='VP Changes Email'";
$check_cat = mysqli_query($cn, $sql_string);
$tmp_id = mysqli_fetch_array($check_cat);
$admin_email_id = $tmp_id['config_value'];
//$admin_email_id = "akeel.php@synergysoftwares.biz";

// Get Admin Email to send the email to //
session_start();

$userid = $_SESSION["UserAdminCode"];

$username = $_SESSION["UserAdminFullName"];
if ($username == "")
	$username = $_SESSION["UserAdminUName"];

$curr_date_time = date('Y-m-d h:i:s');
$updated_rec = $_GET['code'];

$sql_name = "select distinct vasti.fname_vc,vasti.mname_vc,vasti.lname_vc,
				 v1.fname_vc as parfname,v1.lname_vc as parlname,
				 v2.lname_vc as mainparlname,
				 vill.village_name, vill1.village_name as parvill, vill2.village_name as mainparvill
			     from vastipatrak_m vasti
				left outer join vastipatrak_m v1 on vasti.anc_id = v1.vasti_id
				left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
				
				left outer join village_m vill on vasti.village_id = vill.village_id
				left outer join village_m vill1 on v1.village_id = vill1.village_id
				left outer join village_m vill2 on v2.village_id = vill2.village_id
			    where vasti.vasti_id=" . $updated_rec;

$chk_name = mysqli_query($cn, $sql_name);
$num_name = mysqli_num_rows($chk_name);
if ($num_name > 0) {
	$tmp_name = mysqli_fetch_array($chk_name);
	if ($tmp_name['mname_vc'] == "")
		$mname = $tmp_name['parfname'];
	else
		$mname = $tmp_name['mname_vc'];

	if ($tmp_name['lname_vc'] == "" && $tmp_name['parlname'] == "")
		$lname = $tmp_name['mainparlname'];
	else if ($tmp_name['lname_vc'] == "" && $tmp_name['parlname'] != "")
		$lname = $tmp_name['parlname'];
	else
		$lname = $tmp_name['lname_vc'];

	if ($tmp_name['village_name'] == "" && $tmp_name['parvill'] == "")
		$vill_name = $tmp_name['mainparvill'];
	else if ($tmp_name['village_name'] == "" && $tmp_name['parvill'] != "")
		$vill_name = $tmp_name['parvill'];
	else
		$vill_name = $tmp_name['village_name'];

	$full_name = $tmp_name['fname_vc'] . " " . $mname . " " . $lname;
	if ($full_name == "")
		$full_name  = "Name not Available";
}
switch ($_GET['mode']) {
	case "A":
		$disp = "Inserted";
		$disp1 = "Insertion";
		break;

	case "E":
		$disp = "Updated";
		$disp1 = "Updation";
		break;

	case "D":
		$disp = "Deleted";
		$disp1 = "Deletion";
		break;
}

// $message=str_replace("&lt;&lt;Surveyurl&gt;&gt;",$link,$message);
//$message=str_replace("&lt;&lt;EMP_NAME&gt;&gt;",$curemp['emp_name'],$message);
$message = "The following are the details of VastiPatrak Data Updation" . "\n\n";
$message .= "=====================================================================" . "<br>";
$message .= " Data " . $disp . " for : " . $full_name . " (UserID : " . $updated_rec . " , Native : " . $vill_name . ")"  . "<br>";
$message .=   $disp1 . " Date/Time : " . date('d-m-Y h:i:s', strtotime($curr_date_time)) . "<br>";
$message .=   $disp1 . " done by : " . $username . "<br>";
$message .= "=====================================================================" . "\n\n";

$mail_boundary = "RR-TTXXMultipart_Message_Boundary_1";
$from_name = $_POST['txtemail'];
$headers .= "From: Shree Modasa Ekda Dasha Khadayata Vastipatrak Samiti";
//$headers = "From:$txtEMail";
$headers .= "\nMIME-Version: 1.0\n" .
	"Content-Type: multipart/mixed;\n" .
	" boundary=\"{$mail_boundary}\"";

$mail_message = "This is a multipart message in MIME format.\n\n";
$mail_message .= "--{$mail_boundary}\n";
$mail_message .= "Content-Type:text/html; charset=us-ascii\n";
$mail_message .= "Content-Transfer-Encoding: 7bit\n\n";
$mail_message .= $message . "\n";

$mail_to = $admin_email_id;
$subject = "VP Data Modification for " . $full_name;

//$retval = mail($mail_to, $subject, $mail_message, $headers);

// Insert this details into the vp_updation_log //
$sql_string = "insert into vp_updation_log (updated_rec,upd_timestamp,upd_by) values ('" . $updated_rec . "','" . $curr_date_time . "','" . $userid . "')";
$check_ins = mysqli_query($cn, $sql_string);

if ($_GET['mode'] == "D") {
	$sql_string = "DELETE FROM vastipatrak_m WHERE vasti_id = (" . $updated_rec . ")";
	$check_res = mysqli_query($cn, $sql_string);
}

if ($_GET['page'] == "") {
	header('Location: vastipatrak_list.php');
	exit;
} else {
	$redir = $_GET['page'] . "?HCode=" . $_GET['HCode'] . "&level=" . $_GET['level'];
	header('Location: ' . $redir);
}

exit;
