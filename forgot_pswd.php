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

      $chars = "0123456789";
      $otp = "";
      for ($i = 0; $i < 4; $i++) {
        $otp .= $chars[mt_rand(0, strlen($chars) - 1)];
      }
      $curDatetime = date("Y-m-d h:i:s", strtotime("+30 minutes"));
      $sql_string = "UPDATE  vastipatrak_m  SET ";
      $sql_string  =   $sql_string . "otp='" . $otp . "',";
      $sql_string  =   $sql_string . "otpexpireon='" . $curDatetime . "'";
      $sql_string  = $sql_string . " where vasti_id  =" . $row['vasti_id'];
      mysqli_query($cn, $sql_string);
      $token = $row['vasti_id'] . '_' . md5($row['vasti_id']);
      //$redirect = "otp_validate.php?token=" . $token;
      // $mobileno = "9427534693";
      // $msgText = $otp . " is the OTP to login to medkorg.in. It's valid for 30 minutes. Please do not share your username and password to others. Team MEDK.";
      // $url = "https://web.shreesms.net/API/SendSMS.aspx?APIkey=hUqDEJgs8INPj8WQaJT8WKwNYk&SenderID=MEDKIN&SMSType=2&Mobile=" . $mobileno . "&MsgText=" . urlencode($msgText) . "&EntityID=1301167187763538760&TemplateID=1307167421233200101";
      // $ret = file_get_contents($url);
      $redirect = "otp_validate.php?token=" . $token . "&msg=otp send on your number or email";
      if ($row['mobile_home'] == $_POST["txtLogin"]) {
        $mobileno = $row['mobile_home']; //"9825024510";
        $msgText = $otp . " is the OTP to login to medkorg.in. It's valid for 30 minutes. Please do not share your username and password to others. Team MEDK.";
        $url = "https://web.shreesms.net/API/SendSMS.aspx?APIkey=hUqDEJgs8INPj8WQaJT8WKwNYk&SenderID=MEDKIN&SMSType=2&Mobile=" . $mobileno . "&MsgText=" . urlencode($msgText) . "&EntityID=1301167187763538760&TemplateID=1307167421233200101";
        $ret = file_get_contents($url);

        header("Location: $redirect");
      } else if ($row['email'] == $_POST["txtLogin"]) {
        $mail_to = $row['email'];

        $mail_message .=  "Enter this OTP to reset password in MEDKORG website.\n OTP : " . $otp . "\n\n Note: It's valid for 30 minutes. Please do not share your Login detail or OTP to others";

        $retval = sendmail($mail_message, $mail_to);

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

        <form action="forgot_pswd.php" name="frmLogin" method="post" class="bg-white1">
          <h2 class="event-head">Forgot Password</h2>
          <?php
          if (isset($_GET['msg'])) {
            if ($_GET['msg'] != '') {
              echo '<h4>Note:' . $_GET['msg'] . '</h4>';
            }
          }
          ?>
          <div>
            <div class="in-wid"><input type="text" placeholder="Enter Mobile Number/Email Address" name="txtLogin" class="txtreqd border1" id="Username"></div>
            <div style="margin: 10px 0px 0px 350px;" class="in-wid">
              <input type="submit" name="btnsubmit" border="0" onclick="javascript:return checkFormElements(this.form);" value="Send OTP" />

            </div>
            <div style="margin: 10px 0px 0px 400px; width: 160px;" class="in-wid">
              <a href='login.php' style="color: white;">Login</a>
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