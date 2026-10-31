<?php
	include "connection/conn.php";
	// require "noentry.php";
	// include "noentry.php";
	
	$ProdThumbImgDir = "images/vastipatrak/thumb/";
    $ProdLargeImgDir = "images/vastipatrak/attachment/";
	 
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	if ($_SESSION["UserAdminCode"] == "")
	{
		$redirect="index.php";
		header("Location: $redirect");
	}

$_GET['Mode']	= "";
if (isset($_POST["txtMode"])=="")
{
	$varMode = $_GET['Mode'];
}
else
{
	$varMode = $_POST['txtMode'];
}
	
	$_SESSION['status'] = "";
	
//$cn = getConnection("localhost","career_career","!@#$%@@","career_searchjobs");
//$cn = getConnection("localhost","root","","samaj");		

$varFieldtag = "";
	if (isset($_POST["selfilter"]) <> "")
	{
		$varFieldTag = $_POST["selfilter"];
	}
	
	$varFieldValue = "";
	if (isset($_POST["txtfiltername"]) <> "")
	{
		$varFieldValue = $_POST["txtfiltername"];
	}
	
	// print_r($_POST);exit;
	if ($_POST)
	{
		//-------------------COMA SEPRETOR--------------------
		// if(isset($_POST["chk"])){
		// 	$arr = $_POST["chk"];
		// 	foreach($arr as $val)
		// 	{
		// 		if (isset($val))
		// 		{
		// 			if ($chkstr != "")
		// 				$chkstr .= ",";
		// 			$chkstr .= $val;
		// 		}
		// 	}
		// }
		//---------------DELETE MODE-----------------------------
		// print_r($_POST);exit;
			if ($_POST["txtMode"]=="A")
		{
			$flg = 0;
			if(isset($_POST['chk'])){
				$code=implode(',',$_POST['chk']);
				$sql_string = "UPDATE vastipatrak_m set status=1,reason='' where vasti_id in (" . $code . ") or parent_id in (" . $code . ")";
				$check_res1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			}
			/*// Insert the userid and password in the user_m table //
			$sql_string = "INSERT into user_m (vasti_id,user_login,user_password,user_email) values";
			
			foreach($_POST['chk'] as $val)
			{
				$sql_string1 = "select * from vastipatrak_m where vasti_id=".$val;
				$check_dt = mysql_query($sql_string1);
				$dt = mysql_fetch_array($check_dt);
				
				// First check if the record already exists or not//
				$sql_check = "select vasti_id from user_m where vasti_id = '".$val."'";
				$chk_check = mysql_query($sql_check);
				$num_check = mysql_num_rows($chk_check);
				
				$pswd = rand(1,10000);
				
				if($num_check <= 0)
				{	
					$flg++;
					$sql_string = $sql_string . " ('".$val."','".$dt['email']."','".$pswd."','".$dt['email']."'),";
				}

				// Now Mail the username and passsword to the member on the provided email id //
				$subject = "Username and Password for VastiPatrak Login - Khadayata Samaj Website.";
				$mail_to = $dt['email'];
				
				$message = "Dear ".$dt['fname_vc']. " " .$dt['lname_vc'].",";
				$message .= "<br> Your Username and Password for Vastipatrak Login is";
				$message .= "<br> UserName : ".$dt['email'];
				$message .= "<br> Password : ".$pswd;
				
				$from_name = "Khadayata Samaj VastiPatrak Samiti";
				
				 $mail_boundary="RR-TTXXMultipart_Message_Boundary_1";
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
				
				/*echo $mail_to . "<br>"; 
				echo $subject . "<br>";
				echo $mail_message . "<br>";
				echo $headers . "<br>";
				//
				$retval = @mail($mail_to,$subject,$mail_message,$headers);
			}
			
			//exit;
			$sql_string = substr($sql_string,0,strlen($sql_string)-1);
			if($flg!=0)
				$check_res1 = mysql_query($sql_string,$cn) or die(mysql_error($cn));
			
			
			$_POST["txtMode"] = "";
			
			$redirect="approval_list.php";
			header("Location: $redirect");
			*/
			
				function sendSMS($sendto,$msg)
				{
					$msg = urlencode($msg);
					
					$fp = fsockopen("46.137.252.74", 80, $errno, $errstr, 30);
					if (!$fp) {
						   echo "$errstr ($errno)<br />\n";
					} 
					else 
					{
					   $out = "GET /desk2web/SendSMS.aspx?UserName=shrimodasa&password=devkutir28&MobileNo=$sendto&SenderID=MEDK&CDMAHeader=919427908459&Message=$msg&isFlash=false HTTP/1.1\r\n";
					   $out .= "Host: 46.137.252.74\r\n";
					   $out .= "Connection: Close\r\n\r\n";
					
					   fwrite($fp, $out);
					   while (!feof($fp)) 
					   {
						   $varreq .= fgets($fp, 128);
					   }
					   fclose($fp);
					   //exit;
					   return (substr($varreq,strpos($varreq,"XXXXXXXXXXXX")+12,strpos($varreq,"YYYYYYYYYYYY")-(strpos($varreq,"XXXXXXXXXXXX")+12)));
					}
				} 
			
				foreach($_POST['chk'] as $val)
				{
					$num_check=0;
					
				 	$sql_string1 = "select v.* from vastipatrak_m v where v.vasti_id=".$val;
					$check_dt = mysqli_query($cn,$sql_string1);
					$dt = mysqli_fetch_array($check_dt);
					
					// First check if the record already exists or not//
					$sql_check = "select vasti_id from user_m where vasti_id = '".$val."'";
					$chk_check = mysqli_query($cn,$sql_check);
					$num_check = mysqli_num_rows($chk_check);
					if($num_check <= 0)
					{	
						if($dt['email'] == "")
							$userid = strtolower(substr($dt['fname_vc'],0,3)) . '_' .  rand(1,500);
						else
							$userid = $dt['email'];	

						$flg++;
						$pswd = rand(1,10000);
						$sql_string = "INSERT into user_m (vasti_id,user_login,user_password,user_email) values ('".$val."','".$userid."','".$pswd."','".$userid."')";
						$check_res2 = mysqli_query($cn,$sql_string);
					}
					
					// Now Mail the username and passsword to the member on the provided email id //
					$subject = "Username and Password for VastiPatrak Login - Khadayata Samaj Website.";
					$mail_to = $dt['email'];
					
					$message = "Dear ".$dt['fname_vc']. " " .$dt['lname_vc'].",";
					$message .= "<br> Your Username and Password for Vastipatrak Login is";
					$message .= "<br> UserName : ".$userid;
					$message .= "<br> Password : ".$pswd;
					
					$message .= "<br><br>  To Login please visit http://www.medk.org and enter your username and password. <br> Regards. <br>Khadayata Vastipatrak Samiti.";
					//$from_name = "";
					
					$mail_boundary="RR-TTXXMultipart_Message_Boundary_1";
						 $headers .= "From: akeel.php@synergysoftwares.biz";
						//$headers = "From:$txtEMail";
					   $headers .= "\nMIME-Version: 1.0\n" .
							   "Content-Type: multipart/mixed;\n".
							   " boundary=\"{$mail_boundary}\"";
						
						 $mail_message = "This is a multipart message in MIME format.\n\n";
						   $mail_message .= "--{$mail_boundary}\n";
						   $mail_message .= "Content-Type:text/html; charset=us-ascii\n";
						   $mail_message .= "Content-Transfer-Encoding: 7bit\n\n"; 
						 $mail_message .= $message . "\n";
					
					/*echo $mail_to . "<br>"; 
					echo $subject . "<br>";
					echo $mail_message . "<br>";
					echo $headers . "<br>";
					
					echo "<br><br>";
					
					exit; */
					//$mail_to = "akeel.php@synergysoftwares.biz";
					
					$retval = @mail($mail_to,$subject,$mail_message,$headers);
					
					
					// Send SMS to mobile of the member //
					$message = "Dear ". $dt['fname_vc']. " " .$dt['lname_vc']."," ." Your username and password for Vastipatrak Login is -  Username : ".$userid."  " . ", Password : " .$pswd."  . To Login please visit http://www.medk.org and enter your username and password. Regards. Khadayata Vastipatrak Samiti.";
					sendSMS($dt['mobile_home'],$message);
					
					$sql_string1 = "INSERT into new_user_email_list (vasti_id,mail_sent,sms_sent) values";
					$sql_string1 = $sql_string1 . " ('".$val."','1','1')";
					$check_res_ins1 = mysqli_query($cn,$sql_string1);
					
				}

				header("Location: sms_email_message.php");
				exit;
				 
				$_POST["txtMode"] = "";
		}

		if ($_POST["txtMode"]=="IA" || $_POST["txtMode"]=="DA")
		{
			if($_POST["txtMode"]=="IA")
				$code = substr($_POST['txtCode'],2,strlen($_POST['txtCode'])-3);
			else
				$code=implode(',',$_POST['chk']);
			
			$st_code = $_POST["txtMode"]=="IA"?"2":"3";
			
			if($_POST["txtMode"]=="IA")
				$sql_string = "UPDATE vastipatrak_m set status=".$st_code.",reason='".$_POST['reason']."' where vasti_id in (" . $code . ") or parent_id in (" . $code . ")";
			else
				$sql_string = "UPDATE vastipatrak_m set status=".$st_code.",reason='' where vasti_id in (" . $code . ")";
			
			$check_res2 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
			
			// If member is dis=approved, a mail is sent to the member mentioning the reason //
			// Now Mail the username and passsword to the member on the provided email id //
			if($_POST['txtMode'] == "IA")
			{
				$sql_string1 = "select * from vastipatrak_m where vasti_id in (".$code.")";
				$check_dt1 = mysqli_query($cn,$sql_string1);
				
				while($dt = mysqli_fetch_array($check_dt1))
				{
					$subject = "Account Dis=Approval Notification - Khadayata Samaj Website.";
					$mail_to = $dt['email'];
					
					$message = "Dear ".$dt['fname_vc']. " " .$dt['lname_vc'].",";
					$message .= "<br> Your account in Khadayata Samaj Website has been dis-approved by the admin for the following reasons:";
					
					$message .= "<br> UserName : ".$dt['email'];
					$message .= "<br> Reason : ".$_POST['reason'];
					
					$message .= "<br> Contact the admin to get your account re-approved.";
					$message .= "<br> Regards.";
					$message .= "<br> Khadayata Samaj Vastipatrak Samiti.";
					
					$from_name = "Khadayata Samaj VastiPatrak Samiti";
					
					 $mail_boundary="RR-TTXXMultipart_Message_Boundary_1";
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
					
					$retval = @mail($mail_to,$subject,$mail_message,$headers);
				}
			}	
			
			$redirect="approval_list.php";
			header("Location: $redirect");
			exit;
		}
		
		if ($_POST["txtMode"]=="DEL")
		{
			$code=implode(',',$_POST['chk']);
			
			$sql_string = "delete from vastipatrak_m where vasti_id in (" . $code . ")";
			$chk_del = mysqli_query($cn,$sql_string);
			
		}
			
			
		if($_POST['status']!="")
		{
			$_SESSION['status'] = $_POST['status'];  
		}
		else
		{
			$_SESSION['status'] = "";
		}
		
	}	
	
	if(!isset($_SESSION['status']) || $_SESSION['status']=="")
	{
		$where = " and status='0'"; 
	}
	else if($_SESSION['status']== "-1")
	{
		$where = "";
	}
	else
	{
		$where = " and status=".$_POST['status'];
	}
	

	
	 
	//  $sql_string = "SELECT * FROM vastipatrak_m v 
	//  				left outer join gotra_m g on v.gotra_id = g.gotra_id  
	// 				left outer join village_m vill on vill.village_id = v.village_id  
	// 				where parent_id=0 and from_userside=1 $where
	// 				order by vill.village_name,g.gotra_name,v.fname_vc,v.mname_vc,v.lname_vc,v.vasti_id";
	
	$sql_string = "SELECT * FROM vastipatrak_m v 
	left outer join gotra_m g on v.gotra_id = g.gotra_id  
   left outer join village_m vill on vill.village_id = v.village_id  
   where parent_id=0  $where
   order by vill.village_name,g.gotra_name,v.fname_vc,v.mname_vc,v.lname_vc,v.vasti_id";


	 $check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
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
	if(chk.length == "undefined")
	{
		chk.length = "1";
	}

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


 
  <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'images/loading.gif',
        closeImage   : 'images/closelabel.png'
      })
    })
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
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
-->
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
       <td valign="top" bgcolor="#FFFFFF" > <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
        Administration Panel<br>
        <br>
            </font></span></p>
        </blockquote> </td>
      </tr>
      <tr>
        <td valign="top" background="images/link-bg.gif"><img src="images/link-bg.gif" width="5" height="2"></td>
      </tr>
      <tr>
        <td height="8" valign="top"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td width="25%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr valign="top">
                <td>&nbsp;</td>
                <td class="h1"><span class="h1">VastiPatrak Approved/Pending Approval Members List </span></td>
              </tr>
              <tr valign="top">
                <td width="1%">&nbsp;</td>
                <td width="85%"><form name="frm" method="Post" action="approval_list.php">
                  <input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>"/>
				<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td width="7%" class="text"><div align="right"><a href="#" onClick="javascript:doAction('A','Activate');"> </a>Sort By  </div></td>
                      <td style="padding-left:05px;" width="26%" class="text">
					  	<select name="status" class="text">
							<option value="-1" <?php echo isset($_POST['status'])=="-1"?"selected":""; ?>> All Records </option>
							<option value="0" <?php echo isset($_POST['status'])=="0" || $_POST['status']==""?"selected":""; ?>> Pending </option>
							<option value="1" <?php echo isset($_POST['status'])=="1"?"selected":""; ?>> Approved </option>
							<option value="2" <?php echo isset($_POST['status'])=="2"?"selected":""; ?>> DisApproved </option>
							<option value="3" <?php echo isset($_POST['status'])=="3"?"selected":""; ?>> De-activated </option>
						</select> &nbsp; <input type="submit" value="GO">
					  </td>
					  <td width="65%" align="right" valign="bottom" class="text"><a href="#" onClick="javascript:doAction('A','Approve');">Approve Members </a> | <a href="disapprove_member.php?Mode=IA" id="disapp_link" onClick="doDisApp();" rel="facebox[.bolder];"> Disapprove Members</a> | <a href="#" onClick="javascript:doAction('DEL','Delete');"> Delete Members </a> | <a href="#" onClick="javascript:doAction('DA','Deactivate');"> Deactivate Account </a></td>
                    </tr>
                    <tr valign="top">
                      <td colspan="4" height="4"></td>
                    </tr>
                    <tr valign="top">
                      <td width="2%">&nbsp;</td>
                      <td colspan="3"><table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0"  cellspacing="0">
                          <tr valign="middle" bgcolor="#4C6B83">
                            <td width="3%" height="22" bgcolor="#161709" class="textmenuhead"><input type="checkbox" name="chkall" onChange="checkall(this);"></td>
                            <td width="10%" bgcolor="#161709" class="text"><div align="left"><font color="#FFFFFF"><b>Native</b></font></div></td>
                            <td width="10%" bgcolor="#161709" class="text"><div align="left"><font color="#FFFFFF"><b>Gotra</b></font></div></td>
                            <td width="20%" bgcolor="#161709" class="text"><div align="left"><font color="#FFFFFF"><strong>Full Name </strong></font></div></td>
                            <td width="8%" bgcolor="#161709" class="text"><div align="left"><font color="#FFFFFF"><b>Date of Reg,</b></font></div></td>
                            <td width="8%" bgcolor="#161709" class="text"><div align="left"><font color="#FFFFFF"><b>Mobile</b></font></div></td>
                            <td width="8%" bgcolor="#161709" class="text"><div align="left"><font color="#FFFFFF"><b>Email-Id</b></font></div></td>
                            <td width="8%" bgcolor="#161709" class="text"><div align="left"><font color="#FFFFFF"><b>Status</b></font></div></td>
							<td width="8%" bgcolor="#161709" class="text"><div align="left"><font color="#FFFFFF"><b>Action</b></font></div></td>
							<td width="8%" bgcolor="#161709" class="text"><div align="left"><font color="#FFFFFF"><b>      </b></font></div></td>
                            <td width="8%" bgcolor="#161709" class="text">&nbsp;</td>
                          </tr>
                          <?php
								while ($rec = mysqli_fetch_array($check_res))
								{
									switch($rec['status'])
									{
										case "0":
											$status = "Pending";
											break;
										case "1":
											$status = "Approved";
											break;
										case "2":
											$status = "Disapproved";
											break;		
										case "3":
											$status = "De-activated";
											break;	
									}
									
						   ?>
                          <tr valign="middle">
                            <td height="30"><input type="checkbox" id="chk[]" name="chk[]" value="<?php echo($rec['vasti_id']); ?>"></td>
                            <td height="30" class="text"><?php echo($rec['village_name']); ?>&nbsp;</td>
                            <td height="30" class="text"><?php echo($rec['gotra_name']); ?>&nbsp;</td>
                            <td height="30" class="text"><a href="members_profile_preview.php?id=<?php echo $rec['vasti_id']; ?>" rel="facebox[.bolder];"><b><?php echo($rec['fname_vc'] . " " .$rec['mname_vc'] . " " .$rec['lname_vc']); ?></b></a>&nbsp;</td>
                            <td height="30" class="text"><?php echo(date('d-m-Y',strtotime($rec['reg_date']))); ?>&nbsp;</td>
                            <td height="30" class="text"><?php echo($rec['mobile_home']); ?>&nbsp;</td>
                            <td height="30" class="text"><?php echo($rec['email']); ?>&nbsp;</td>
                            <td height="30" class="text"><?php echo($status); ?>&nbsp;</td>
							<td height="30" class="text"><div align="center"><a href="family_details.php?HCode=<?php echo($rec['vasti_id']); ?>&level=2&Mode=RO" class="sublink"> Family </a> </div></td>
                          </tr>
                          <tr valign="middle">
                            <td colspan="9" height="8"></td>
                            </tr>
                          <?php
								}
						   ?>
                      </table></td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                  </table>
                </form></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="36" valign="top" background="images/footer_bg.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="8" valign="top">
</td>
      </tr>
      <tr>
        <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr valign="top">
            <td class="footertext">&nbsp;</td>
            <td class="footertext"><div align="right"></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="5" valign="top"></td>
      </tr>
    </table></td>
  </tr>
</table>


<!-- End ImageReady Slices -->
</body>
</html>