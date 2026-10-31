<?php
	
	include "admin/connection/conn.php";
	//include "/home/apisyner/www/mailsend.php";
	
	if($_POST['page'] == "req_username")
	{
		$sql_string = "SELECT * FROM config_m where config_name='Request Username Form'";
		$check_cat = mysqli_query($cn,$sql_string);
		$tmp_id= mysqli_fetch_array($check_cat);
		$admin_email_id = $tmp_id['config_value'];
	
	
		//first get the text for the previous xml stored
		
		$strData .=  "The member has requsted for username and password...<br><br>";
		$strData .= "Native Name :" . $_POST["native"] . "<br>";
		$strData .= "Gotra  : " . $_POST["gotra"] . " <br>";
		$strData .= "Name : " . $_POST["txtname"] . "<br>";
		$strData .= "Father's Name : " . $_POST["txtfname"] . "<br>";
		$strData .= "Phone Number : " . $_POST["txtphone"] . "<br>";
		$strData .= "Mobile No : " . $_POST["txtmobile"] . "<br>";
		$strData .= "Email ID : " . $_POST["txtemail"] . "<br>";
		$strData .= "Address : " . $_POST["txtaddress"] . "<br>";
		$strData .= "State : " . $_POST["state"] . "<br>";
		$strData .= "City : " . $_POST["city"] . "<br>";
		$strData .= "Remarks : " . $_POST["txtremarks"] . "<br>";
		$strData .= "Request Date : " . $_POST["txtdate"] . "<br>";
		
		$txtName = $_POST["txtname"];
		$txtEMail = $_POST["txtemail"];
	}	
	else
	{
		$sql_string = "SELECT * FROM config_m where config_name='Feedback Email'";
		$check_cat = mysqli_query($cn,$sql_string);
		$tmp_id= mysqli_fetch_array($check_cat);
		$admin_email_id = $tmp_id['config_value'];
	
	
		//first get the text for the previous xml stored
		
		$strData .=  "The organization has provided the following information...\n\n";
		$strData .= "Native Name :" . $_POST["native"] . "\n";
		$strData .= "Gotra  : " . $_POST["gotra"] . " \n";
		$strData .= "Name : " . $_POST["txtname"] . "\n";
		$strData .= "Phone Number : " . $_POST["txtphone"] . "\n";
		$strData .= "Mobile No : " . $_POST["txtmobile"] . "\n";
		$strData .= "Email ID : " . $_POST["txtemail"] . "\n";
		$strData .= "Address : " . $_POST["txtaddress"] . "\n";
		$strData .= "State : " . $_POST["state"] . "\n";
		$strData .= "City : " . $_POST["city"] . "\n";
		$strData .= "Remarks : " . $_POST["txtremarks"] . "\n";
		$strData .= "Feedback Date : " . $_POST["txtdate"] . "\n";
		
		$txtName = $_POST["txtname"];
		$txtEMail = $_POST["txtemail"];
	}
	//echo $strData;exit;
	//preparing for the mail
    
	$mail_to = $admin_email_id;
	$mail_subject = "Online Inquiry From - $txtName";
	
   //$mail_message = $strData;

   $mail_boundary="RR-TTXXMultipart_Message_Boundary_1";

   //the headers will contain the mime version and the type of message
   $headers = "From:$txtEMail";
   
   $headers .= "\nMIME-Version: 1.0\n" .
	       "Content-Type: multipart/mixed;\n".
	       " boundary=\"{$mail_boundary}\"";

   $mail_message = "This is a multipart message in MIME format.\n\n";
   $mail_message .= "--{$mail_boundary}\n";
   $mail_message .= "Content-Type:text/plain; charset=us-ascii\n";
   $mail_message .= "Content-Transfer-Encoding: 7bit\n\n";

   // this is the message content for the mail
   $mail_message .= $strData . "\n";

    //close the header part
   $mail_message .= "--{$mail_boundary}--\n";
	
	$mail_from = "mail@medk.org";
	$mail_from_name = "MEDK";
	$mail_password = "VDz!#NeP?f92";

	//mail($to, $subject, $message, $headers_to);
	$to = "bharat.shah@medk.org";
	//SendMail($mail_from, $mail_from_name, $mail_password, $to, $to, $mail_subject, $strData);

	$retval = @mail($mail_to, $mail_subject, $mail_message, $headers);
	
   $mail_to = $admin_email_id;
   $mail_to = "bharatshah@raviplastic.com";
   
   $retval = @mail($mail_to, $mail_subject, $mail_message, $headers);
   
   //----------
   if (!$redirect)
   $redirect="thanks.php";

   header("Location: $redirect");
?>