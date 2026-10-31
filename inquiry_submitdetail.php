<?php
	
	include "admin/connection/conn.php";
	
	if($_POST['page'] == "req_username")
	{
		$sql_string = "SELECT * FROM config_m where config_name='Request Username Form'";
		$check_cat = mysqli_query($cn,$sql_string);
		$tmp_id= mysqli_fetch_array($check_cat);
		$admin_email_id = $tmp_id['config_value'];
	
		$timezone = new DateTimeZone("Asia/Kolkata" );
		$date = new DateTime();
		$date->setTimezone($timezone );
		$app_date = $date->format( 'Y-m-d H:i:s' );
	
		//first get the text for the previous xml stored
		
		$strData .=  "The member has submitted the following feedback...\n\n";
		$strData .= "Native Name :" . $_POST["native"] . "\n";
		$strData .= "Gotra  : " . $_POST["gotra"] . " \n";
		$strData .= "Name : " . $_POST["txtname"] . "\n";
		$strData .= "Father's Name : " . $_POST["txtfname"] . "\n";
		$strData .= "Phone Number : " . $_POST["txtphone"] . "\n";
		$strData .= "Mobile No : " . $_POST["txtmobile"] . "\n";
		$strData .= "Email ID : " . $_POST["txtemail"] . "\n";
		$strData .= "Address : " . $_POST["txtaddress"] . "\n";
		$strData .= "State : " . $_POST["state"] . "\n";
		$strData .= "City : " . $_POST["city"] . "\n";
		$strData .= "Remarks : " . $_POST["txtremarks"] . "\n";
		$strData .= "Request Date : " . $app_date . "\n";
		
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
	
   
   $retval = @mail($mail_to, $mail_subject, $mail_message, $headers);
	
   //$mail_to = "akeel.php@synergysoftwares.biz"; 
   $mail_to = $admin_email_id;
   $mail_to = "bharatshah@raviplastic.com";
   
   $retval = @mail($mail_to, $mail_subject, $mail_message, $headers);
   
   
   //----------
   if (!$redirect)
   $redirect="thanks.php";

   header("Location: $redirect");
?>