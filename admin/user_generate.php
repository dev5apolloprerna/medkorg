<?php

	include "connection/conn.php";
	
	//fetch the user profile where the username is not there and the profile is not a rejected or under process profile
	//1.  fetch the user, vastipatrak where status=1 i.e. approved and user name is blank
	$strsql = 'SELECT user_m.user_code, user_m.user_login, user_m.user_password, ifnull(vastipatrak_m.email,"") as email, parent_id, vastipatrak_m.vasti_id, vastipatrak_m.fname_vc, form_no FROM user_m left outer join vastipatrak_m on user_m.vasti_id = vastipatrak_m.vasti_id where status=1 and user_login="" and parent_id=0';
	
	$res_chk=mysqli_query($cn,$strsql);
	$num_chk = mysqli_num_rows($res_chk);
	
	if ($num_chk >0)
	{
		
		echo("User Code.....First Name.....User Code.....Form No");
		
		while ($rec = mysqli_fetch_array($res_chk))
		{
			$emailid = $rec['email'];
			$userid = strtolower(substr($rec['fname_vc'],0,3)) . '_' .  rand(1,500);
			$pswd = rand(1,10000);
			
			$strtmp = "update user_m set user_login='" . $userid . "', user_password = '" . $pswd . "' where user_code=" . $rec["user_code"];
			
			mysqli_query($cn,$strtmp);

			echo($rec["user_code"] . "....." . $rec["fname_vc"] . "....." . $rec["user_code"] . "....." . $rec["form_no"]);
			echo "<br>";
		}
		
		echo "Lost Username re-generated. Process Completed!!";
	}
	else
	{
		echo "No Records Found to be processed!";
	}

?>