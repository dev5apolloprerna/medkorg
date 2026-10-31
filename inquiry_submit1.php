<?php
	
	//first get the text for the previous xml stored
	
	$strData .=  "The organization has provided the following information...\n\n";
	$strData .= "Contact Person : " . $_POST["name"] . " \n";
	$strData .= "Gender : " . $_POST["gender"] . "\n";
	$strData .= "Service : " . $_POST["ques"] . "\n";
	$strData .= "Question : " . $_POST["question"] . "\n";
	$strData .= "Birth Date : " . $_POST["dob"] . "\n";
	$strData .= "Birth Place : " . $_POST["pob"] . "\n";
	$strData .= "Email ID : " . $_POST["email"] . "\n";
	
	$txtName = $_POST["name"];
	$txtEMail = $_POST["email"];
	
	//preparing for the mail
	$mail_to = "biren_672@yahoo.co.in";
	//$mail_to = "akeel.php@synergysoftwares.biz";
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
   
   
   //----------
   if (!$redirect)
   $redirect="thanks.php";

   header("Location: $redirect");
?>