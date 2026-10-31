<?php
include_once "admin/connection/conn.php";
include  "mnu_main.php";
include "password_hash.php";
session_start();

if ($_POST) {
	//Orginal code
	if (isset($_POST['btnsubmit']) && isset($_POST['txtLogin']) && !empty($_POST['txtLogin'])) {

		$sql_string = "SELECT v.*,
	  v1.country as parcountry,v1.state as parstate,v1.city as parcity,
	  v2.country as mainparcountry,v2.state as mainparstate,v2.city as mainparcity 	  
	  FROM  vastipatrak_m v 
	 left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
	 left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
	 WHERE (v.mobile_home='" . $_POST["txtLogin"]  . "' or v.email='" . $_POST["txtLogin"]  . "')  and v.status!=3";

		$result = mysqli_query($cn, $sql_string);
		if (mysqli_num_rows($result) == 1) {

			$row = mysqli_fetch_array($result);
			if ($row['password'] == '' && $row['salt'] == '') {
				$chars = "0123456789";
				$otp = "";
				for ($i = 0; $i < 4; $i++) {
					$otp .= $chars[mt_rand(0, strlen($chars) - 1)];
				}
				$curDatetime = date("Y-m-d h:i:s", strtotime("+10 minutes"));
				$sql_string1 = "UPDATE  vastipatrak_m  SET ";
				$sql_string1  = 	$sql_string1 . "otp='" . $otp . "',";
				$sql_string1  = 	$sql_string1 . "otpexpireon='" . $curDatetime . "'";
				$sql_string1  = $sql_string1 . " where vasti_id  =" . $row['vasti_id'];
				mysqli_query($cn, $sql_string1);
				$token = $row['vasti_id'] . '_' . md5($row['vasti_id']);
				$redirect = "otp_validate.php?token=" . $token."&msg=otp send on your number or email";
				if ($row['mobile_home'] == $_POST["txtLogin"]) {
					$mobileno = $row['mobile_home']; //"9825024510";
					$msgText = $otp . " is the OTP to login to medkorg.in. It's valid for 10 minutes. Please do not share your username and password to others. Team MEDK.";
					$url = "https://web.shreesms.net/API/SendSMS.aspx?APIkey=hUqDEJgs8INPj8WQaJT8WKwNYk&SenderID=MEDKIN&SMSType=2&Mobile=" . $mobileno . "&MsgText=" . urlencode($msgText) . "&EntityID=1301167187763538760&TemplateID=1307167421233200101";
					$ret = file_get_contents($url);

					header("Location: $redirect");
				} else if ($row['email'] == $_POST["txtLogin"]) {
					$mail_to = $row['email'];

					$mail_message .=  "Enter this OTP to reset password in MEDKORG website.\n OTP : " . $otp;

					$retval = sendmail($mail_message,$mail_to);
					
					header("Location: $redirect");
				} else {
					$msg = "(Mobile Number/EMail Address) or Password is incorrect.";

					if ($_POST['page'] == "index")
						$redirect = "index.php?msg=" . $msg;
					else
						$redirect = "login.php?msg=" . $msg;

					header("Location: $redirect");
				}

				exit;
			}
			$varlogin = $_POST["txtLogin"];
			$varpassword = $_POST["txtPassword"];


			$good_hash = PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" . $row['salt'] . ":" . $row['password'];
			if (validate_password($varpassword, $good_hash)) {


				$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
				if (mysqli_num_rows($check_res) > 0) {
					$rec = mysqli_fetch_array($check_res);

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
				}
			}
		} else {
			$msg = "Username or Password is incorrect.";

			if ($_POST['page'] == "index")
				$redirect = "index.php?msg=" . $msg;
			else
				$redirect = "login.php?msg=" . $msg;

			header("Location: $redirect");
			exit;
		}
	}

	//Temporary Code

	// $redirect = "login.php?msg=User Data is in under process.Login detail provide soon.";

	// header("Location: $redirect");
}
?>
<?php
include_once "header.php";
?>

<section class="bg-li2 hw-100">
	<div class="container">
		<div class="row justify-content-center pt-5">
			<div class="col-lg-6">

				<form action="login.php" name="frmLogin" method="post" class="bg-white1">
					<h2 class="event-head">Login</h2>
					<?php
					if (isset($_GET['msg'])) {
						if ($_GET['msg'] != '') {
							echo '<h4>Note:' . $_GET['msg'] . '</h4>';
						}
					}
					?>
					<div>
						<div class="in-wid"><input type="text" placeholder="Please Enter Mobile/Email Address" name="txtLogin" class="txtreqd border1" id="Username"></div>
						<div class="in-wid"><input type="password" name="txtPassword" id="Password" placeholder="Please Enter Password or 1111 (User Without Password)" class="txtreqd border1"></div>
						<div style="margin: 10px 0px 0px 350px; width: 160px;
    margin: 0 auto;" class="in-wid">
							<input type="submit" name="btnsubmit" border="0" onclick="javascript:return checkFormElements(this.form);" value="Login" />
						</div>
						<div style="margin: 10px 0px 0px 400px; width: 160px;" class="in-wid">
							<a href='forgot_pswd.php' style="color: white;">Forgot Password</a>
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