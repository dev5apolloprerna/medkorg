<?php
 
// Array of Files 

 
$fileName=array( 
				'career'=>'file_career.html',
				'req'=>'file_req.html'
				 )   ;
				
// Array of Emails
$emailids=array( 
				'career'=>'bharat.shah@medk.org',
				 'req'=>'bharat.shah@medk.org',
				 )   ;	
				
// Array of Subjects
$subjects=array( 
				'career'=>'Apply for the post of ',
				 'req'=>'Requirement For',
				 )   ;				
				 
  
							
if($_POST)
{
	    		
				//$myFile='apply_online2.html'; 
				//echo  $fileName[$_POST['page']];exit;
				$fh = fopen("file/".$fileName[$_POST['page']], 'r');
				
				$theData = fread($fh, filesize("file/".$fileName[$_POST['page']]));
				fclose($fh); 				 
				
					$message = $theData;
					
					// replace surveyurl with basepath
					foreach($_POST as $key=>$val)
					{ 
						if(is_array($val))
							$val=implode(',',$val);
						if(trim($val)!="")
							$message=str_replace("&lt;&lt;$key&gt;&gt;",$val,$message);
					 	else
							$message=str_replace("&lt;&lt;$key&gt;&gt;"," ",$message);
					 
					 }
					 
					// $message=str_replace("&lt;&lt;Surveyurl&gt;&gt;",$link,$message);
					 //$message=str_replace("&lt;&lt;EMP_NAME&gt;&gt;",$curemp['emp_name'],$message);
 					 
					  $mail_boundary="RR-TTXXMultipart_Message_Boundary_1";
						$from_name = $_POST['txtemail'];
					 $headers .= "From: ". $from_name ;
					//$headers = "From:$txtEMail";
				   $headers .= "\nMIME-Version: 1.0\n" .
						   "Content-Type: multipart/mixed;\n".
						   " boundary=\"{$mail_boundary}\"";
					
					 $mail_message = "This is a multipart message in MIME format.\n\n";
					   $mail_message .= "--{$mail_boundary}\n";
					   $mail_message .= "Content-Type:text/html; charset=us-ascii\n";
					   $mail_message .= "Content-Transfer-Encoding: 7bit\n\n"; 
					 $mail_message .= $message . "\n";
					
					// start file attachment
					if($_POST['page']=='career')
					{
					   $fileRes = $_FILES["fileResume"]["tmp_name"];
					   $fileRes_Type = $_FILES["fileResume"]["type"]; 
					   $fileRes_Name = $_FILES["fileResume"]["name"]; 
						 //open the file in binary mode
					   $fp = fopen($fileRes,"rb");
					
					   //get the file data
					   $filedata = fread($fp,filesize($fileRes));  
					   
					   //close the file
					   fclose($fp);
					   
					   $filedata = chunk_split(base64_encode($filedata));  
						 $mail_message .= "--{$mail_boundary}\n";
					   $mail_message .= "Content-Type:{$fileRes_Type}; name=\"{$fileRes_Name}\"\n";
					   $mail_message .= "Content-Transfer-Encoding: base64\n";
					   $mail_message .= "Content-Disposition: attachment; filename=\"{$fileRes_Name}\"\n\n";
					   $mail_message .= $filedata . "\n\n";				
						 $mail_message .= "--{$mail_boundary}--\n";
						
					
					}
					// end file attachment
					
					  //$mail_to = "mohit.web@synergysoftwares.biz";;
					//if($_POST['chkcopy']==1)
						//$mail_to.=",$from_name";
						$mail_to = $emailids[$_POST['page']];
					//  $mail_to= "Ravi Patodi <ravi.patodi@fullertonindia.com>";
					if($_POST['designation'] == "")
						{
							$desig = $_POST['txtpresentdesig'];
						}
						else
						{
							$desig = $_POST['designation'];
						}
						if($_POST['page'] == "req")
						{
							$desig = $_POST['txtname'];
						} 
				  		
						$subject = $subjects[$_POST['page']].' '.$desig; 
						$retval = mail($mail_to, $subject, $mail_message, $headers);
					
				header('location: message.html');
				exit;		
					 
						
			  	
}

?>
 