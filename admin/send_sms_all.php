<?php
	include "connection/conn.php";
	require "noentry.php";
	
	set_time_limit(0);
		
	session_start();
	$txtDCode = $_SESSION["UserAdminCode"];
	$txtUserEmail = $_SESSION["UserAdminEmail"];
	
	if ($_SESSION["UserAdminCode"] == "")
	{
		$redirect="index.php";
		header("Location: $redirect");
	}
	
	
			 function sendSMS($sendto,$msg)
				{
					$msg = urlencode($msg);
					
					$fp = fsockopen("46.137.252.74", 80, $errno, $errstr, 30);
					if (!$fp) {
						   echo "$errstr ($errno)<br />\n";
					} else {
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
				
				
				//$strsql = "select mobnumber from (SELECT mobile_number as mobnumber FROM vastipatrak_m union all SELECT alt_mobile as mobnumber FROM vastipatrak_m) fp";
				
				$strsql = 'select mobnumber from (select v1.mobile_number as mobnumber from vastipatrak_m v1 left outer join vastipatrak_m v2 on v1.anc_id = v2.vasti_id where v2.city=5 and v1.mobile_number<>""
union 
SELECT distinct mobile_number as mobnumber FROM vastipatrak_m where city=5 and mobile_number!="") fp';
				
				$check_dt = mysqli_query($cn,$strsql);

				//$message = "All MEDK members are invited for the function of VASTIPATRAK on 10-06-2012 at 9:00 am at Preksha Vishwa Bharti, Nr. Koba Circle, Gandhinagar.";
				$message = "Vastipatrak members are requested to collect their granth from R C Shah & Co. Nr.  Iswarnagar Bus Stop, Isanpur Road, Maninagar Between 10am to 6 pm.";
				
				$cnt=1;
				while ($rec = mysqli_fetch_array($check_dt))
				{
					if ($rec['mobnumber'] !="")
					{
						$mobile_number = "91" . $rec['mobnumber'];
						sendSMS($mobile_number,$message);
						$cnt++;
						echo $cnt . "..." . $mobile_number . "<br>";
						ob_flush();
					}
				}
				echo($cnt);
				echo "Process completed";
				exit;

?>