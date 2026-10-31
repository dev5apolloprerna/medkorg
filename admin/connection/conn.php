<?php
ob_start();
date_default_timezone_set("Asia/Calcutta");
include "cn.php";
include_once "PHPMailer-master/PHPMailerAutoload.php";
$host = "localhost";
$db = "medkorg_medk_ndb";
$username = "medkorg_medk_db";
$password = ")=J[R2WIzNnk";


/*$host="localhost";
	$db= "phpdev_khadayat";
	$username="phpdev_samaj";
	$password="!@#$%@@"; 
	*/

// $host="localhost";
// $db= "medk_ndb";
// $username="medk_nusr";
// $password="NNR8a3TWJqYK"; 


$cn = getConnection("$host", "$username", "$password", "$db");


function sendmail($detail, $giveorder)
{


	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host = "mail.medkorg.in";
	$mail->SMTPAuth = true;
	$mail->Username = "support@medkorg.in";
	$mail->Password = "NDPWagh}Ny)m";
	// // $mail->SMTPSecure = $mailSMTPSecure;                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;

	$mail->From = "support@medkorg.in";
	$mail->FromName = "MEDK";
	$mail->AddReplyTo("support@medkorg.in");


	$mail->AddAddress($giveorder);

	$mail->IsHTML(true);
	$mail->Subject = "Reset Password for MEDK";

	$mail->Body = $detail;

	// //echo $detail;
	// //exit;


	$mail->Send();

	
}
//SMS={#var#} is the OTP to login to medkorg.in. It's valid for 10 minutes. Please do not share your username and password to others. Team MEDK.

//vasti id: 8887,10978,10973