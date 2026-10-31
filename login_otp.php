<?php

session_start();

include_once "admin/connection/conn.php";
include_once "password_hash.php";

// -------------------------------------------------------
// Already logged in
// -------------------------------------------------------
if (isset($_SESSION['VastiId']) && !empty($_SESSION['VastiId'])) {
    header("Location: user-homepage.php");
    exit;
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnsubmit'])) {

    // -------------------------------------------------------
    // Get mobile number
    // -------------------------------------------------------
    $mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';

    // Keep only digits
    $mobile = preg_replace('/[^0-9]/', '', $mobile);

    if (empty($mobile)) {

        $msg = "Please enter your registered mobile number.";

    } elseif (strlen($mobile) < 10) {

        $msg = "Please enter a valid mobile number.";

    } else {

        // -------------------------------------------------------
        // Find member
        // Change mobile_home if your login column is different
        // -------------------------------------------------------
        $sql = "
            SELECT 
                vasti_id,
                fname_vc,
                mname_vc,
                lname_vc,
                mobile_home,
                email,
                status
            FROM vastipatrak_m
            WHERE mobile_home = ?
            AND status != 3
            LIMIT 1
        ";

        $stmt = mysqli_prepare($cn, $sql);

        if (!$stmt) {

            $msg = "Something went wrong. Please try again.";

        } else {

            mysqli_stmt_bind_param($stmt, "s", $mobile);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                $vastiId = (int)$row['vasti_id'];

                // -------------------------------------------------------
                // Generate OTP
                // -------------------------------------------------------
                $otp = random_int(100000, 999999);

                // OTP valid for 5 minutes
                $otpExpireOn = date('Y-m-d H:i:s', strtotime('+5 minutes'));
                
                $mobileno = $_POST['mobile'];
                $msgText = $otp . " is the OTP to login to medkorg.in. It's valid for 10 minutes. Please do not share your username and password to others. Team MEDK.";
                echo $url = "https://web.shreesms.net/API/SendSMS.aspx?APIkey=hUqDEJgs8INPj8WQaJT8WKwNYk&SenderID=MEDKIN&SMSType=2&Mobile=" . $mobileno . "&MsgText=" . urlencode($msgText) . "&EntityID=1301167187763538760&TemplateID=1307167421233200101";
                
                $ret = file_get_contents($url);
                // -------------------------------------------------------
                // Save OTP
                // -------------------------------------------------------
                $updateSql = "
                    UPDATE vastipatrak_m
                    SET otp = ?,
                        otpexpireon = ?
                    WHERE vasti_id = ?
                ";

                $updateStmt = mysqli_prepare($cn, $updateSql);

                if ($updateStmt) {

                    mysqli_stmt_bind_param(
                        $updateStmt,
                        "ssi",
                        $otp,
                        $otpExpireOn,
                        $vastiId
                    );

                    if (mysqli_stmt_execute($updateStmt)) {

                        /*
                        |--------------------------------------------------------------------------
                        | SEND OTP HERE
                        |--------------------------------------------------------------------------
                        |
                        | Add your existing SMS API here.
                        |
                        | Example:
                        |
                        | $message = "Your MEDKORG login OTP is: " . $otp;
                        | sendSMS($mobile, $message);
                        |
                        */

                        // IMPORTANT:
                        // Remove this in production.
                        // This is only useful while testing locally.
                        // $_SESSION['debug_otp'] = $otp;

                        // ---------------------------------------------------
                        // Create same token expected by login_otp_validate.php
                        // ---------------------------------------------------
                        $token = $vastiId . '_' . md5($vastiId);

                        header(
                            "Location: login_otp_validate.php?token=" .
                            urlencode($token)
                        );

                        exit;

                    } else {

                        $msg = "Unable to generate OTP. Please try again.";
                    }

                    mysqli_stmt_close($updateStmt);

                } else {

                    $msg = "Something went wrong. Please try again.";
                }

            } else {

                $msg = "Mobile number is not registered.";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

include_once "header.php";

?>

<section class="bg-li2 hw-100">

    <div class="container">

        <div class="row justify-content-center pt-5">

            <div class="col-lg-6">

                <form
                    action="login_otp.php"
                    name="frmLogin"
                    method="post"
                    class="bg-white1"
                >

                    <h2 class="event-head">
                        Member Login
                    </h2>

                    <?php if (!empty($msg)) { ?>

                        <div
                            style="
                                margin-bottom:15px;
                                padding:12px;
                                background:#fff3f3;
                                color:#b30000;
                                border-radius:5px;
                            "
                        >
                            <?php echo htmlspecialchars($msg); ?>
                        </div>

                    <?php } ?>

                    <?php
                    if (isset($_GET['msg']) && !empty($_GET['msg'])) {
                    ?>

                        <div
                            style="
                                margin-bottom:15px;
                                padding:12px;
                                background:#fff8e5;
                                color:#765000;
                                border-radius:5px;
                            "
                        >
                            <?php echo htmlspecialchars($_GET['msg']); ?>
                        </div>

                    <?php } ?>

                    <div>

                        <div class="in-wid">

                            <input
                                type="text"
                                name="mobile"
                                id="mobile"
                                class="txtreqd border1"
                                placeholder="Enter Registered Mobile Number"
                                maxlength="10"
                                inputmode="numeric"
                                autocomplete="tel"
                                required
                            >

                        </div>

                        <div class="in-wid">

                            <input
                                type="submit"
                                name="btnsubmit"
                                border="0"
                                value="Send OTP"
                            >

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