<?php
include_once "admin/connection/conn.php";
include  "mnu_main.php";
include "password_hash.php";
session_start();

if ($_POST) {
	if (isset($_POST['btnsubmit']) && isset($_POST['otp_validate']) && !empty($_POST['otp_validate'])) {
        

		$sql_string = "SELECT v.*,
	  v1.country as parcountry,v1.state as parstate,v1.city as parcity,
	  v2.country as mainparcountry,v2.state as mainparstate,v2.city as mainparcity 
	  FROM  vastipatrak_m v 
	 left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
	 left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
	 WHERE v.vasti_id='" . $_POST["vasti_id"]  . "' and v.otp='" . $_POST['otp_validate'] . "'  and v.status!=3";

		$result = mysqli_query($cn, $sql_string);
		if (mysqli_num_rows($result) == 1) {

			$row = mysqli_fetch_array($result);
           
			$currenttimestamp = strtotime(date('d-m-Y h:i:s'));
			// echo strtotime(date('d-m-Y h:i:s')).'------'.strtotime($row['otpexpireon']);
			// exit;
			if ($currenttimestamp <= strtotime($row['otpexpireon'])) {
                $rec =$row;
                
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
						$parDetail = mysqli_fetch_array(mysqli_query($cn, "select * from vastipatrak_m where vasti_id=" . $rec['parent_id']));
						$_SESSION['village_id'] = $parDetail['village_id'];
						$_SESSION['gotra_id'] = $parDetail['gotra_id'];
					} else {
						$_SESSION['isMember'] = 0;
						$_SESSION['parentId'] = $rec['vasti_id'];
						$_SESSION['village_id'] = $rec['village_id'];
						$_SESSION['gotra_id'] = $rec['gotra_id'];
					}
                    

					$redirect = "user-homepage.php";

				header("Location: $redirect");
				exit;
			} else {
				$redirect = "login_otp.php";
				header("Location: $redirect");
				exit;
			}
		} else {
			$msg = "OTP is incorrect.";

			$token = $row['vasti_id'] . '_' . md5($row['vasti_id']);
			$redirect = "login_otp_validate.php?token=" . $token;

			header("Location: $redirect");
			exit;
		}
	}

	//Temporary Code

	// $redirect = "login.php?msg=User Data is in under process.Login detail provide soon.";

	// header("Location: $redirect");
} else {
	 $token = explode('_', $_GET['token']);

	if (md5($token[0]) != $token[1]) {
		$redirect = "login.php?msg= Invalid User.";

		header("Location: $redirect");
	}
}
?>
<?php
include_once "header.php";
?>

<section class="bg-li2 hw-100">
	<div class="container">
		<div class="row justify-content-center pt-5">
			<div class="col-lg-6">
				<form action="login_otp_validate.php" name="frmLoginotp" method="post" class="bg-white1">
					<h2 class="event-head">Validate Account using OTP</h2>
					<?php
					if (isset($_GET['msg'])) {
						if ($_GET['msg'] != '') {
							echo '<h4>Note:' . $_GET['msg'] . '</h4>';
						}
					}
					?>
					<div>
						<div class="in-wid">
							<input type="text" placeholder="Enter OTP" name="otp_validate" class="txtreqd border1" id="otp_validate">
							<input type="hidden" name="vasti_id" id="vasti_id" value="<?= $token[0] ?>">
						</div>
						<div  class="in-wid">
							<input type="submit" name="btnsubmit" border="0" onclick="javascript:return checkFormElements(this.form);" value="Validate OTP" />
						</div>

					</div>

				</form>
			</div>

		</div>
	</div>
</section>
<?php
include_once "footer.php";
?>