<?php
include_once "noentry.php";
include_once "connection/conn.php";
include_once 'include/appmain.php';
include_once 'password_hash.php';

$sql_string = "SELECT v.*,
	  v1.country as parcountry,v1.state as parstate,v1.city as parcity,
	  v2.country as mainparcountry,v2.state as mainparstate,v2.city as mainparcity 	  
	  FROM  vastipatrak_m v 
	 left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
	 left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
	 WHERE v.vasti_id='" . $_GET["HCode"]  . "'  and v.status!=3";

		$result = mysqli_query($cn, $sql_string);
		if (mysqli_num_rows($result) == 1) {

			$rec = mysqli_fetch_array($result);

            $_SESSION["UserEmail"] = $rec['email'];
					$_SESSION["UserCode"] = $rec['vasti_id'];
					$_SESSION["VastiId"] = $rec['vasti_id'];
					$_SESSION["status"] = $rec['status'];
					$_SESSION["Fname"] = $rec['fname_vc'];
					$_SESSION["Mname"] = $rec['mname_vc'];
					$_SESSION["Lname"] = $rec['lname_vc'];
					$_SESSION["UserNm"] = $rec['mobile_home'];

					if ($rec['country'] == "" && $rec['parcountry'] == "")
						$_SESSION["UserCounrry"] = $rec['mainparcountry'];
					else if ($rec['country'] == "" && $rec['parcountry'] != "")
						$_SESSION["UserCounrry"] = $rec['parcountry'];
					else
						$_SESSION["UserCounrry"] = $rec['country'];


					if ($rec['state'] == "" && $rec['parstate'] == "")
						$_SESSION["UserState"] = $rec['mainparstate'];
					else if ($rec['state'] == "" && $rec['parstate'] != "")
						$_SESSION["UserState"] = $rec['parstate'];
					else
						$_SESSION["UserState"] = $rec['state'];

					if ($rec['city'] == "" && $rec['parcity'] == "")
						$_SESSION["UserCity"] = $rec['mainparcity'];
					else if ($rec['city'] == "" && $rec['parcity'] != "")
						$_SESSION["UserCity"] = $rec['parcity'];
					else
						$_SESSION["UserCity"] = $rec['city'];

					$_SESSION["Fullname"] = $rec['fname_vc'] . " " . $rec['mname_vc'] . " " . $rec['lname_vc'];
					if ($rec['parent_id'] != '0') {
						$_SESSION['isMember'] = 1;
						$_SESSION['parentId'] = $rec['parent_id'];
						$parDetail=mysqli_fetch_array(mysqli_query($cn,"select * from vastipatrak_m where vasti_id=".$rec['parent_id']));
						$_SESSION['village_id']=$parDetail['village_id'];
						$_SESSION['gotra_id']=$parDetail['gotra_id'];
					} else {
						$_SESSION['isMember'] = 0;
						$_SESSION['parentId'] = $rec['vasti_id'];
						$_SESSION['village_id']=$rec['village_id'];
						$_SESSION['gotra_id']=$rec['gotra_id'];
					}
					
					$redirect = "../user-homepage.php";

					header("Location: $redirect");
        }

?>
