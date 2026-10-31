<?php

/*
a.	Send a Mailer

*/

function SendMail($to_email, $to_name, $from_email, $from_name, $reply_to, $cc, $bcc, $subject, $text_body, $html_body)
{
	$mail_message = "";
	$mail_boundary="RR-TTXXMultipart_Message_Boundary_1";

	//headers that will contain the mime version and the type of message
	$headers = "From:". $from_name ."<" . $from_email . ">\n";

	if ($reply_to=="") $reply_to = $from_email;
	$headers .= "Reply-To:". $reply_to . "\n";

	if ($cc != "")
	{
		$headers .= "Cc: " . $cc . "\n";
	}

	if ($bcc != "")
	{
		$headers .= "Bcc: " . $bcc . "\n";
	}
	
	$headers .= "X-Mailer:	Mailer Application\n";
	$headers .= "Date: ". time() ."\n";
	$headers .= "MIME-Version: 1.0\n" .
	   "Content-Type: multipart/alternative;\n".
	   " boundary=\"{$mail_boundary}\"";
	
   $mail_message = "This is a multipart message in MIME format.\n\n";
   $mail_message .= "--{$mail_boundary}\n";
   $mail_message .= "Content-Type:text/plain; charset=us-ascii\n";
   $mail_message .= "Content-Transfer-Encoding: 7bit\n\n";

   // this is the message content for the mail
   $mail_message .= $text_body;
   $mail_message .= "\n";

	if ($html_body<>"")
	{
		   $mail_message .= "--{$mail_boundary}\n";
		   $mail_message .= "Content-Type:text/html; charset=iso-8859-1\n";
		   $mail_message .= "Content-Transfer-Encoding: 7bit\n\n";

		   // this is the message content for the mail
		   $mail_message .= $html_body;
	}

	$retval = mail($to_email, $subject, $mail_message, $headers);

	echo($retval);
}

?>