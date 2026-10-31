<?php
include "connection/conn.php";
include "password_hash.php";
// require "noentry.php";
// include "noentry.php";

require 'include/appmain.php';
require 'utility/querygen.inc';

$oQGen = new CQueryGen();
$oQGen1 = new CQueryGen();

// session_start();
$ProdThumbImgDir = "images/vastipatrak/thumb/";
$ProdLargeImgDir = "images/vastipatrak/attachment/";

//$_GET['Mode']="";
if (isset($_POST["txtMode"]) == "") {
  $varMode = $_GET['Mode'];
} else {
  $varMode = $_POST['txtMode'];
}
$varCode = "";

if (isset($_POST["vasti_id"]) == "") {
  $varCode = isset($_GET['Code']) ? $_GET['Code'] : "";
} else {
  $varCode = $_POST['vasti_id'];
}

$sql_string = "SELECT * FROM bdir_category where cat_type='B' and main_id=0 and group_name!='Root' order by sub_id";
$check_cat = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM industry_m order by ind_id";
$check_ind = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM bdir_category where cat_type='J' and main_id=0 and group_name!='Root' order by sub_id";
$check_jobtype = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM industry_m order by ind_id";
$check_ind_job = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM bdir_category where cat_type='P' and main_id=0 and group_name!='Root' order by sub_id";
$check_cat1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$vartxtcountry = "SELECT * FROM `country_m`";
$chk_country = mysqli_query($cn, $vartxtcountry);
$country = [];
while ($vartxtcountry = mysqli_fetch_array($chk_country)) {
  $country[] = array(
    'country_id' => $vartxtcountry['country_id'],
    'country_name' => $vartxtcountry['country_name']
  );
}

$vartxtstate = "SELECT * FROM `state_m`";
$chk_State = mysqli_query($cn, $vartxtstate);
$state = [];
while ($vartxtstate = mysqli_fetch_array($chk_State)) {
  $state[] = array(
    'state_id' => $vartxtstate['state_id'],
    'state_name' => $vartxtstate['state_name']
  );
}


$vartxtcity = "SELECT * FROM `city_m`";
$chk_city = mysqli_query($cn, $vartxtcity);
$city = [];
while ($vartxtcity = mysqli_fetch_array($chk_city)) {
  $city[] = array(
    'city_id' => $vartxtcity['city_id'],
    'city_name' => $vartxtcity['city_name']
  );
}

$sql_string = "SELECT * FROM country_m order by country_name";
$chk_job_country = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Basic/Grad.' order by education_id asc";
$chk_edu_det1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='PG' order by education_id asc ";
$chk_edu_det2 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Doctrate' order by education_id asc";
$chk_edu_det3 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

//---------------QueryString-------------------

if ($varMode == "E") {
  $sql_string = "SELECT * FROM vastipatrak_m where vasti_id=" . $varCode;
  $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
  // print_r($_GET);exit;

  if (mysqli_num_rows($check_res) < 1) {
    echo ("No rows in the database to display");
    exit;
  } else {
    while ($rec = mysqli_fetch_array($check_res)) {

      $vartxtformno = $rec['form_no'];

      $parent_id = $rec['parent_id'];

      $vartxtVillage = $rec['village_id'];
      $vartxtGotra = $rec['gotra_id'];

      $vartxtaddr1 = $rec['addr1'];
      $vartxtaddr2 = $rec['addr2'];
      $vartxtaddr3 = $rec['addr3'];

      $vartxtcountry = $rec['country'];
      $vartxtstate = $rec['state'];
      $vartxtcity = $rec['city'];
      $vartxtdistrict = $rec['district'];
      $vartxtpincode = $rec['pincode'];

      $vartxtFName = $rec['fname_vc'];
      $vartxtMName = $rec['mname_vc'];
      $vartxtLName = $rec['lname_vc'];

      $varGender = $rec['gender_c'];

      $sel_relation = $rec['sel_relation'];

      $vartxtMarital = $rec['marital_id'];
      $vartxtmobile_home = $rec['mobile_home'];
      $vartxtalt_mobile = $rec['alt_mobile'];
      $vartxtphone_number = $rec['phone_number'];
      $vartxtcode_phone_number = $rec['code_phone_number'];
      $vartxtalt_number = $rec['alt_number'];
      $vartxtcode_alt_number = $rec['code_alt_number'];
      $vartxtEmail = $rec['email'];

      $vartxtReltion = $rec['relation_id'];

      $vartxtDate = $rec['birth_date'];
      $vartxtAge = $rec['age'];

      $vartxtBloodgroup = $rec['blood_group'];

      $vartxtedu_cat = $rec['edu_cat'];
      $vartxtEduBasic = $rec['edu_basic'];
      $vartxtEduSub = $rec['edu_sub'];

      $vartxtbasic_qual = $rec['basic_qual'];
      $vartxtpg_qual = $rec['pg_qual'];
      $vartxtdoc_qual = $rec['doc_qual'];
      $vartxtbq_det = $rec['bq_det'];
      $vartxtpg_det = $rec['pg_det'];
      $vartxtdoc_det = $rec['doc_det'];
      $sql_husband_name = "SELECT v1.vasti_id,v1.fname_vc,v1.mname_vc,v1.lname_vc FROM vastipatrak_m v1
	where v1.vasti_id=" . $rec['anc_id'] . " order by v1.vasti_id";
      $chk_husband_name = mysqli_query($cn, $sql_husband_name);
      $husband_name_rec = mysqli_fetch_array($chk_husband_name);
      $lienagename = $husband_name_rec['fname_vc'] . " " . $husband_name_rec['mname_vc'] . " " . $husband_name_rec['lname_vc'];
    }
  }

  $sql_string1 = "SELECT * FROM businessdir_m where vasti_id=" . $varCode;
  $check_res1 = mysqli_query($cn, $sql_string1);

  $rec1 = mysqli_fetch_array($check_res1);
  $prof_type = isset($rec1['prof_type']) ? $rec1['prof_type'] : '';
  $vasti_id = isset($rec1['vasti_id']) ? $rec1['vasti_id'] : '';
  $bness_cat_id = isset($rec1['bness_cat_id']) ? $rec1['bness_cat_id'] : '';
  $bness_subcat_id = isset($rec1['bness_subcat_id']) ? $rec1['bness_subcat_id'] : '';
  $bness_name = isset($rec1['bness_name']) ? $rec1['bness_name'] : '';
  $bness_addr = isset($rec1['bness_addr']) ? $rec1['bness_addr'] : '';
  $bness_phone = isset($rec1['bness_phone']) ? $rec1['bness_phone'] : '';
  $bness_mobile = isset($rec1['bness_mobile']) ? $rec1['bness_mobile'] : '';
  $bness_desc = isset($rec1['bness_desc']) ? $rec1['bness_desc'] : '';
  $prof_cat_id = isset($rec1['prof_cat_id']) ? $rec1['prof_cat_id'] : '';
  $prof_subcat_id = isset($rec1['prof_subcat_id']) ? $rec1['prof_subcat_id'] : '';
  $prof_addr = isset($rec1['prof_addr']) ? $rec1['prof_addr'] : '';
  $prof_phone = isset($rec1['prof_phone']) ? $rec1['prof_phone'] : '';
  $prof_mobile = isset($rec1['prof_mobile']) ? $rec1['prof_mobile'] : '';
  $prof_desc = isset($rec1['prof_desc']) ? $rec1['prof_desc'] : '';
  $comp_name = isset($rec1['comp_name']) ? $rec1['comp_name'] : '';
  $job_type = isset($rec1['job_type']) ? $rec1['job_type'] : '';
  $job_ind_id = isset($rec1['job_ind_id']) ? $rec1['job_ind_id'] : '';
  $job_desig = isset($rec1['job_desig']) ? $rec1['job_desig'] : '';
  $job_addr = isset($rec1['job_addr']) ? $rec1['job_addr'] : '';
  $job_phone = isset($rec1['job_phone']) ? $rec1['job_phone'] : '';
  $job_mobile = isset($rec1['job_mobile']) ? $rec1['job_mobile'] : '';

  $vartxtjobaddr1 = isset($rec1['job_addr1']) ? $rec1['job_addr1'] : '';
  $vartxtjobaddr2 = isset($rec1['job_addr2']) ? $rec1['job_addr2'] : '';
  $vartxtjobaddr3 = isset($rec1['job_addr3']) ? $rec1['job_addr3'] : '';
  $vartxtjobcountry = isset($rec1['job_country']) ? $rec1['job_country'] : '';
  $vartxtjobstate = isset($rec1['job_state']) ? $rec1['job_state'] : '';
  $vartxtjobcity = isset($rec1['job_city']) ? $rec1['job_city'] : '';
  $vartxtjobdistrict = isset($rec1['job_district']) ? $rec1['job_district'] : '';
  $vartxtjobpincode = isset($rec1['job_pincode']) ? $rec1['job_pincode'] : '';
}

//-------------MODE A------------------------

if ($_POST) {
  if ($_FILES["thumb_image"]["name"] != "") {
    $filename = $_FILES["thumb_image"]["name"];
    $tofind = ".";
    $filename_len = strlen($filename);
    $position_num = strpos($filename, $tofind);
    $extension = substr("$filename", $position_num, $filename_len - $position_num);
    $sys_name = rand();
    $TImage = $sys_name . $extension;
    $ProdThumbImgDir . $TImage;

    move_uploaded_file($_FILES["thumb_image"]["tmp_name"], $ProdThumbImgDir . $TImage);
    $imageuploadthumb = ",thumb_image='" . $TImage . "'";
  }

  if ($_FILES["attachment"]["name"] != "") {
    $filename = $_FILES["attachment"]["name"];
    $tofind = ".";
    $filename_len = strlen($filename);
    $position_num = strpos($filename, $tofind);
    $extension = substr("$filename", $position_num, $filename_len - $position_num);
    $sys_name = rand();
    $EImage = $sys_name . $extension;
    move_uploaded_file($_FILES["attachment"]["tmp_name"], $ProdLargeImgDir . $EImage);
    $imageuploadlarge = ",attachment='" . $EImage . "'";
  }

  if ($varMode == "E") {
    //Get Current image value from db
    $sql_img = "select thumb_image,attachment from vastipatrak_m where vasti_id=" . $_POST['vasti_id'];
    $chk_img = mysqli_query($cn, $sql_img);
    $tmp = mysqli_fetch_array($chk_img);
  }

  // Add data in user_master table
  // Begin get Fields of Tables
  $sql = "select * from vastipatrak_m where 1=2";
  $res = mysqli_query($cn, $sql);

  $fieldarray = array();

  while ($fd = mysqli_fetch_field($res)) :
    $fieldarray[] = $fd->name;
  endwhile;

  array_shift($fieldarray); // remove first element orderID

  // End get Fields of Tables

  $oQGen->setTableName("vastipatrak_m"); // set the table name

  foreach ($_POST as $key => $val) {
    if ($key == "vasti_id") {
      $oQGen->addFieldValue("vasti_id", $_POST['vasti_id'], "C");
    }
    if ($key == "email") {
      $emailid = $val;
    }
    if (in_array($key, $fieldarray)) {
      $oQGen->addFieldValue($key, str_replace("'", "''", $val), "C");
    }
  }
  // print_r($_FILES['thumb_image']['name']);exit;
  if ($_FILES['thumb_image']['name'] != "") {
    $oQGen->addFieldValue("thumb_image", $TImage, "C");
  } else {
    $oQGen->addFieldValue("thumb_image", isset($tmp['thumb_image']) ? $tmp['thumb_image'] : "", "C");
  }

  if ($_FILES['attachment']['name'] != "") {
    $oQGen->addFieldValue("attachment", $EImage, "C");
  } else {
    $oQGen->addFieldValue("attachment", isset($tmp['attachment']) ? $tmp['attachment'] : "", "C");
  }

  // Get Execution Statement
  if ($_POST["txtMode"] == "A") {

    $sql_string = $oQGen->getInsert();
    $mode = "A";
  } else {
    if($_POST['marital_id'] == 4){
        $sql = "select * from matrimony where user_id='".$_POST['vasti_id']."'";
        $res = mysqli_query($cn, $sql);
        if($res->num_rows > 0){
            $sql = "delete from matrimony where user_id='".$_POST['vasti_id']."'";
            $res = mysqli_query($cn, $sql);
        }
    }
    $oQGen->addConditionFieldValue("vasti_id", $_POST['vasti_id'], "C");
    $sql_string = $oQGen->getUpdate();
    $mode = "E";
  }


  $code = db_execute($cn, $sql_string);
  // print_r($_POST['vasti_id']);
  if ($code == $_POST['vasti_id']) {
  } else {
    $code = $_POST['vasti_id'];
  }

  // start - save committee related data in vp_comm_m table  //
  if (isset($_POST['chkCommName'])) {
    foreach ($_POST['chkCommName'] as $key => $val) {
      if ($val != "") {
        $str_ins = "insert into vp_comm_m (vasti_id,comm_id_int) values";
        $str_ins .= "('" . $code . "','" . $val . "')";
        $chk_ins = mysqli_query($cn, $str_ins);
        $last_id .= mysqli_insert_id() . ",";
      }
    }
  }
  $last_id = "";
  $last_id = substr($last_id, 0, strlen($last_id) - 1);
  $last_id = explode(",", $last_id);
  $tmp_cnt = 0;

  foreach ($_POST['txtCommCode'] as $key1 => $val1) {
    if ($val1 != "") {
      $str_ins = "update vp_comm_m set mem_comm_code='" . $val1 . "' where vp_comm_id='" . $last_id[$tmp_cnt] . "'";
      $chk_ins1 = mysqli_query($cn, $str_ins);
    }
    $tmp_cnt++;
  }


  // End //

  // End of Insert or Update Query //

  // query to insert data in new_records_vp table//


  // 



  if ($code == 0 || $code == "")
    $code = $_POST['vasti_id'];


  if ($_POST["txtMode"] == "A") {
    // Insert the userid and password in the user_m table //
    $sql_string1 = "INSERT into new_user_email_list (vasti_id,mail_sent,sms_sent) values";
    $sql_string1 = $sql_string1 . " ('" . $code . "','0','0')";
    $check_res_ins1 = mysqli_query($cn, $sql_string1) or die(mysqli_error($cn));

    if ($code == 0 || $code == "")
      $code = $_POST['vasti_id'];
  }

  // Insert professional details in businessdir_m table //
  // Add data in user_master table
  // Begin get Fields of Tables
  if ($_POST['prof_type'] != "") {

    $sql = "select * from businessdir_m where 1=2";
    $res = mysqli_query($cn, $sql);

    $fieldarray = array();

    while ($fd = mysqli_fetch_field($res)) :
      $fieldarray[] = $fd->name;
    endwhile;

    array_shift($fieldarray); // remove first element orderID

    // End get Fields of Tables

    $oQGen1->setTableName("businessdir_m"); // set the table name

    foreach ($_POST as $key => $val) {
      if ($key == "vasti_id") {
        $val = $code;
      }
      if (in_array($key, $fieldarray) && trim($val) != "") {
        $oQGen1->addFieldValue($key, str_replace("'", "''", $val), "C");
      }
    }

    // first delete entry of current vasti_id and then insert updtaed record //
    $sql_del = "delete from businessdir_m where vasti_id=" . $code;
    $chk_del = mysqli_query($cn, $sql_del);

    // Get Execution Statement
    $sql_string = $oQGen1->getInsert();

    $code1 = db_execute($cn, $sql_string);
  }

  // Send notification to admin about changes in the vastipatrak data //
  redirect("vastipatrak_changes_notification.php?code=" . $code . "&mode=" . $mode);
  exit;
}

?>

<html>

<head>
  <title>Samaj</title>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="css/adminstyle.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    <!--
    body {
      background-color: #666666;
      margin-left: 0px;
      margin-top: 0px;
      margin-right: 0px;
      margin-bottom: 0px;
    }

    .style6 {
      color: #B90200;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bolder;
    }
    -->
  </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script type="text/javascript" src="js/ajax.js"></script>
  <script type="text/javascript" src="js/userjvalid.js"></script>
  <script type='text/JavaScript' src='js/scw.js'></script>
  <link type="text/css" rel="stylesheet" href="css/datepickercontrol.css">
  <script language="javascript" type="text/javascript">
    function showhideDiv(val) {
      if (val == "" || val == "H" || val == "S" || val == "R") {
        document.getElementById("trbusiness").style.display = "none";
        document.getElementById("trprof").style.display = "none";
        document.getElementById("trjob").style.display = "none";
        document.getElementById("tdaddr").style.display = "none";
      }
      if (val == "B") {
        document.getElementById("trbusiness").style.display = "";
        document.getElementById("trprof").style.display = "none";
        document.getElementById("trjob").style.display = "none";
        document.getElementById("tdaddr").style.display = "";
      }
      if (val == "P") {
        document.getElementById("trbusiness").style.display = "none";
        document.getElementById("trprof").style.display = "";
        document.getElementById("trjob").style.display = "none";
        document.getElementById("tdaddr").style.display = "";
      }
      if (val == "J") {
        document.getElementById("trbusiness").style.display = "none";
        document.getElementById("trprof").style.display = "none";
        document.getElementById("trjob").style.display = "";
        document.getElementById("tdaddr").style.display = "";
      }
    }
    function chkMobile(number){
      $.ajax({
                    type: "POST",
                    url: "chk-mobile.php",
                    data: {number:number},
                    success: function (msg) {
                        
                        console.log(number);
                        return false;
                    },
                });
    }
  </script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" bgcolor="#FFFFFF">
              <blockquote>
                <p><span class="style6">
                    <font size="+2" class="style6"><br>
                      Administration Panel<br>
                      <br>
                    </font>
                  </span></p>
              </blockquote>
            </td>
          </tr>
          <tr>
            <td valign="top" background="images/link-bg.gif"><img src="images/link-bg.gif" width="5" height="2"></td>
          </tr>
          <tr>
            <td height="8" valign="top"></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
              <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr valign="top">
                        <td width="30%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
                        <td background="images/grey_bg.gif">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr valign="top">
                        <td background="images/grey_bg.gif">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="h1"><span class="h1">VastiPatrak Master </span></td>
                      </tr>
                      <tr valign="top">
                        <td width="1%" background="images/grey_bg.gif">&nbsp;</td>
                        <td width="0%">&nbsp;</td>
                        <td width="69%">
                          <form name="frm" method="post" action="vastipatrak_m.php" enctype="multipart/form-data">
                            <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                            <input type="hidden" name="vasti_id" value="<?php echo $varCode; ?>">
                            <input type="hidden" name="business_id" value="">
                            <input type="hidden" name="form_no" value="<?php echo $form_no; ?>">
                            <input type="hidden" id="DPC_TODAY_TEXT" value="today">
                            <input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
                            <input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
                            <input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
                            <!-- <input type="hidden" name="parent_id" value="<?php $parent_id ?  $parent_id : 0; //echo isset($hcode) ? $hcode : ""; 
                                                                          ?>"> -->
                            <input type="hidden" name="reg_date" id="reg_date" value="<?php echo (date('Y-m-d h:i:s')); ?>">

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr valign="top">
                                <td width="2%">&nbsp;</td>
                                <td>
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr valign="top">
                                      <td height="8" colspan="7" class="text_bold_head"></td>
                                    </tr>
                                    <tr valign="top" bgcolor="#eaeaea">
                                      <td height="10" colspan="7" class="text_bold_head">Personal Details</td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" colspan="7" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td width="19%" height="25" class="text">
                                        <div align="right">Form No. 
                                        </div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td width="79%" height="25" class="sublink">
                                        <input type="text" name="form_no" id="Form No." class="txtbox" tabindex="1" value="<?php echo isset($vartxtformno) ? $vartxtformno : ""; ?>">
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Native Place<font color="#FF0000">*</font>
                                        </div>
                                      </td>
                                      <td width="2%" height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink">
                                        <select name="village_id" tabindex="2" id="Native Place " class="txtrequiredsel txtbox">
                                          <option value="0" selected>Please Select</option>
                                          <?php
                                          $sql_string = "SELECT * FROM village_m order by village_name";

                                          $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                          if (mysqli_num_rows($check_res) > 0) {
                                            while ($rec = mysqli_fetch_array($check_res)) {
                                              if ($vartxtVillage == $rec['village_id'])
                                                echo ("<option selected value ='" . $rec['village_id'] . "'>" . $rec['village_name'] . "</option>");
                                              else
                                                echo ("<option value='" . $rec['village_id'] . "'>" . $rec['village_name'] . "</option>");
                                            }
                                          }
                                          ?>
                                        </select>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Gotra<font color="#FF0000">*</font>
                                        </div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink">
                                        <select name="gotra_id" tabindex="3" id="Gotra " class="txtrequiredsel txtbox">
                                          <option value="0" selected>Please Select</option>
                                          <?php
                                          $sql_string = "SELECT * FROM gotra_m order by gotra_name";

                                          $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                          if (mysqli_num_rows($check_res) > 0) {
                                            while ($rec = mysqli_fetch_array($check_res)) {
                                              if ($vartxtGotra == $rec['gotra_id'])
                                                echo ("<option selected value ='" . $rec['gotra_id'] . "'>" . $rec['gotra_name'] . "</option>");
                                              else
                                                echo ("<option value='" . $rec['gotra_id'] . "'>" . $rec['gotra_name'] . "</option>");
                                            }
                                          }
                                          ?>
                                        </select>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Name<font color="#FF0000">*</font>
                                        </div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink">
                                        <table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                          <tr>
                                            <td width="15%">
                                              <div align="right">Your Name</div>
                                            </td>
                                            <td width="2%">&nbsp;</td>
                                            <td width="83%"><input name="fname_vc" type="text" class="txtreqd txtbox1" id="First Name " tabindex="4" value="<?php echo isset($vartxtFName) ? $vartxtFName : ""; ?>" size="30"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div align="right">Father's Name </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td><input name="mname_vc" type="text" class="txtreqd txtbox1" id="Middle Name " tabindex="5" value="<?php echo isset($vartxtMName) ? $vartxtMName : ""; ?>" size="30"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div align="right">Surname</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td><input name="lname_vc" type="text" class="txtreqd txtbox1" id="Last Name " tabindex="6" value="<?php echo isset($vartxtLName) ? $vartxtLName : ""; ?>" size="30"></td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Gender<font color="#FF0000">*</font>
                                        </div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink">
                                        <span class="text"><span class="text2">
                                            <?php
                                            echo $varMode . $varGender;
                                            ?>
                                            <input type="radio" name="gender_c" tabindex="7" value="Male" class="txtreqd" <?php echo ($varMode == 'E' && $varGender == "Male") ? "checked" : ""; ?> />
                                          </span>Male<span class="text2">
                                            <input type="radio" name="gender_c" tabindex="8" value="Female" class="txtreqd" <?php echo ($varMode == 'E' && $varGender == "Female") ? "checked" : ""; ?> />
                                          </span>Female</span>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Address</div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink">
                                        <table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                          <tr>
                                            <td width="25%">
                                              <div align="right">House no/Flat No ,society/flat/Apprtment </div>
                                            </td>
                                            <td width="2%">&nbsp;</td>
                                            <td width="75%"><input name="addr1" type="text" class="txtbox1" id="addr1" tabindex="9" value="<?php echo isset($vartxtaddr1) ? $vartxtaddr1 : ""; ?>" size="30"></td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">Near B</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%"><input name="addr2" type="text" class="txtbox1" id="addr2" tabindex="10" value="<?php echo isset($vartxtaddr2) ? $vartxtaddr2 : ""; ?>" size="30"></td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">Area /Village</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%"><input name="addr3" type="text" class="txtbox1" id="addr3" tabindex="11" value="<?php echo isset($vartxtaddr3) ? $vartxtaddr3 : ""; ?>" size="30"></td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">Country<font color="#FF0000">*</font>
                                              </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%">
                                              <select name="country" class="txtbox1" id="country" tabindex="12" onChange="javascript:getState(this.value,'<?= $vartxtstate ?>');" required>
                                                <option value="" selected="selected"> Select Country </option>
                                                <?php
                                                // while($country = mysqli_fetch_array($chk_country))
                                                foreach ($country as $vartxtcountry1) {
                                                ?>
                                                  <option value="<?php echo $vartxtcountry1['country_id']; ?>" <?= ($vartxtcountry1['country_id'] == $vartxtcountry) ? "selected" : "" ?>><?php echo $vartxtcountry1['country_name']; ?> </option>
                                                <?php
                                                }
                                                ?>
                                              </select>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">State</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%">
                                              <select name="state" class="txtbox1" id="tdstate" tabindex="13" onChange="javascript:getCity(this.value,'<?= $vartxtcity ?>');" />

                                              </select>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">City/Town/Village</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%" id="tdcity">
                                              <select name="city" class="txtbox1" id="City " tabindex="14" />

                                              <option value=""> Select City </option>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">District</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%"><input name="district" type="text" class="txtbox1" id="district" tabindex="15" value="<?php echo isset($vartxtdistrict) ? $vartxtdistrict : ""; ?>" size="30" /></td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">Pincode</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%"><input name="pincode" type="text" class="txtbox1" id="pincode" tabindex="16" value="<?php echo isset($vartxtpincode) ? $vartxtpincode : ""; ?>" size="20"></td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Marital Status<font color="#FF0000">*</font>
                                        </div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink">
                                        <select name="marital_id" tabindex="17" id="Marital Status" class="txtrequiredsel txtbox">
                                          <option value="0" selected="selected">Please Select</option>
                                          <?php
                                          $sql_string = "SELECT * FROM marital_m";

                                          $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                          if (mysqli_num_rows($check_res) > 0) {
                                            while ($rec = mysqli_fetch_array($check_res)) {
                                              if ($vartxtMarital == $rec['marital_id'])
                                                echo ("<option selected value ='" . $rec['marital_id'] . "'>" . $rec['marital_name'] . "</option>");
                                              else
                                                echo ("<option value='" . $rec['marital_id'] . "'>" . $rec['marital_name'] . "</option>");
                                            }
                                          }
                                          ?>
                                        </select>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Birth Date </div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink"><input type="text" name="birth_date" class="txtbox" tabindex="18" id="birth_date" value="<?php echo isset($vartxtDate) ? $vartxtDate : ""; ?>" />&nbsp;<img src="images/calendar_icon.png" width="15" height="20" onclick='scwShow(document.getElementById("birth_date"),event);' style="cursor:pointer;"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Age</div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td colspan="5" class="text"><input name="age" type="text" class="txtbox" id="Age " tabindex="19" value="<?php echo isset($vartxtAge) ? $vartxtAge : ""; ?>" size="10" /> (Enter Age of the person in case birthdate is not available)</td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Blood Group</div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink">
                                        <select name="blood_group" tabindex="20" class="txtbox1">
                                          <option value=""> Please Select </option>
                                          <?php
                                          $sql_string = "SELECT * FROM bloodgroup_m";

                                          $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                          if (mysqli_num_rows($check_res) > 0) {
                                            while ($rec = mysqli_fetch_array($check_res)) {
                                              if (isset($vartxtBloodgroup) && $vartxtBloodgroup == $rec['name'])
                                                echo ("<option selected value='" . $rec['name'] . "'>" . $rec['name'] . "</option>");
                                              else
                                                echo "<option value='" . trim($rec['name']) . "'>" . $rec['name'] . "</option>";
                                            }
                                          }
                                          ?>

                                        </select>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" class="text">
                                        <div align="right">Education</div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="4" class="sublink">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="44%">
                                              <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="47%">
                                                    <div align="right" class="text">Basic/Graduation</div>
                                                  </td>
                                                  <td width="1%">&nbsp;</td>
                                                  <td width="49%"><span class="text">
                                                      <select name="basic_qual" id="basic_qual" tabindex="21" class="txtbox1" onChange="getDet(this.value,'bq_det','bq_det');">
                                                        <option value="0"> Not Specified </option>
                                                        <?php
                                                        while ($edu_det1 = mysqli_fetch_array($chk_edu_det1)) {
                                                          if ($vartxtbasic_qual == $edu_det1['education_id']) {
                                                        ?>
                                                            <option value="<?php echo $edu_det1['education_id']; ?>" selected> <?php echo $edu_det1['education_name']; ?></option>
                                                          <?php } else { ?>
                                                            <option value="<?php echo $edu_det1['education_id']; ?>"> <?php echo $edu_det1['education_name']; ?></option>
                                                        <?php }
                                                        } ?>
                                                      </select>
                                                    </span></td>
                                                </tr>
                                                <tr>
                                                  <td>
                                                    <div align="right" class="text">Post Graduation </div>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                  <td><span class="text">
                                                      <select name="pg_qual" id="pg_qual" tabindex="22" class="txtbox1" onChange="getDet(this.value,'pg_det','pg_det');">
                                                        <option value="0"> Not Specified </option>
                                                        <?php
                                                        while ($edu_det2 = mysqli_fetch_array($chk_edu_det2)) {
                                                          if ($vartxtpg_qual == $edu_det2['education_id']) {
                                                        ?>
                                                            <option value="<?php echo $edu_det2['education_id']; ?>" selected> <?php echo $edu_det2['education_name']; ?></option>
                                                          <?php } else { ?>
                                                            <option value="<?php echo $edu_det2['education_id']; ?>"> <?php echo $edu_det2['education_name']; ?></option>
                                                        <?php }
                                                        } ?>
                                                      </select>
                                                    </span></td>
                                                </tr>
                                                <tr>
                                                  <td>
                                                    <div align="right" class="text">Doctrate</div>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                  <td><span class="text">
                                                      <select name="doc_qual" id="doc_qual" tabindex="23" class="txtbox1" onChange="getDet(this.value,'doc_det','doc_det');">
                                                        <option value="0"> Not Specified </option>
                                                        <?php
                                                        while ($edu_det3 = mysqli_fetch_array($chk_edu_det3)) {
                                                          if ($vartxtdoc_qual == $edu_det3['education_id']) {
                                                        ?>
                                                            <option value="<?php echo $edu_det3['education_id']; ?>" selected> <?php echo $edu_det3['education_name']; ?></option>
                                                          <?php } else { ?>
                                                            <option value="<?php echo $edu_det3['education_id']; ?>"> <?php echo $edu_det3['education_name']; ?></option>
                                                        <?php }
                                                        } ?>
                                                      </select>
                                                    </span></td>
                                                </tr>
                                              </table>
                                            </td>
                                            <td width="36%">
                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td><input name="bq_det" type="text" class="txtbox1" id="bq_det" tabindex="24" style="display:none;" value="<?php echo isset($vartxtbq_det); ?>" size="30">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td><input name="pg_det" type="text" class="txtbox1" id="pg_det" tabindex="25" style="display:none;" value="<?php echo isset($vartxtpg_det); ?>" size="30">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td><input name="doc_det" type="text" class="txtbox1" id="doc_det" tabindex="26" style="display:none;" value="<?php echo isset($vartxtdoc_det); ?>" size="30">&nbsp;</td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr>
                                      <td height="10" align="right" valign="middle" class="text"> Photo </td>
                                      <td align="center" valign="middle">
                                        <div align="center"><strong>:&nbsp;</strong></div>
                                      </td>
                                      <td colspan="5" align="left" valign="middle"><input type="file" name="thumb_image" id="thumb_image" size="30" tabindex="27" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr>
                                      <td height="10" align="right" valign="middle" class="text"> Attachment</td>
                                      <td align="center" valign="middle">
                                        <div align="center"><strong>:&nbsp;</strong></div>
                                      </td>
                                      <td colspan="5" align="left" valign="middle"><input type="file" name="attachment" id="attachment" tabindex="28" size="30" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr>
                                      <td height="10" align="right" valign="middle" class="text"> Link to lineage </td>
                                      <td align="center" valign="middle">
                                        <div align="center"><strong>:&nbsp;</strong></div>
                                      </td>
                                      <td align="left" valign="middle">
                                        <?php echo $lienagename ? $lienagename : '' ?> <a href="vastipatrak_lineage.php?id=<?php echo $varCode; ?>" rel="facebox">GO</a>

                                      </td>
                                    </tr>
                                    <tr valign="top" bgcolor="#eaeaea">
                                      <td height="10" colspan="7" class="text_bold_head">Communication Details</td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" colspan="7" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" valign="middle" class="text">
                                        <div align="right">Phone Number(L.L.)</div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="txtreqd txtbox">

                                        <input name="code_phone_number" type="text" class="txtbox1" tabindex="29" value="<?php echo isset($vartxtcode_phone_number) ? $vartxtcode_phone_number : ""; ?>" size="08"> &nbsp;

                                        <input name="phone_number" type="text" class="txtbox1" tabindex="30" value="<?php echo isset($vartxtphone_number) ? $vartxtphone_number : ""; ?>" size="20">
                                        <strong>(Please do not enter STD Code)</strong>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" valign="middle" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" valign="middle" class="text">
                                        <div align="right">Mobile/Login Id<font color="#FF0000">*</font>
                                        </div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink">
                                        <input name="mobile_home" type="text" minlength="10" maxlength="10" class="txtreqd txtbox1" class="Number-only" tabindex="33" value="<?php echo isset($vartxtmobile_home) ? $vartxtmobile_home : ""; ?>" size="50" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="" onblur="chkMobile(this.value);">
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" valign="middle" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" valign="middle" class="text">
                                        <div align="right">Alternate Number</div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="text"> <input name="code_alt_number" type="text" class="txtbox1" tabindex="31" value="<?php echo isset($vartxtcode_alt_number) ? $vartxtcode_alt_number : ""; ?>" size="08"> &nbsp; <input name="alt_number" type="text" class="txtbox1" tabindex="32" value="<?php echo isset($vartxtalt_number) ? $vartxtalt_number : ""; ?>" size="20">
                                        <strong>(Please do not enter STD Code)</strong>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" valign="middle" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>

                                    <tr valign="top">
                                      <td height="25" valign="middle" class="text">
                                        <div align="right">Alternate Mobile</div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink"><input name="alt_mobile" type="text" class="txtbox1" tabindex="34" value="<?php echo isset($vartxtalt_mobile) ? $vartxtalt_mobile : ""; ?>" size="50"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" valign="middle" class="text">
                                        <div align="right">Email ID </div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink"><input name="email" type="text" class="txtbox1" tabindex="35" value="<?php echo isset($vartxtEmail) ? $vartxtEmail : ""; ?>" size="50"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" class="text"></td>
                                      <td height="8"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top" bgcolor="#eaeaea">
                                      <td height="10" colspan="7" class="text_bold_head">If you are a member of any below listed Committee, select the name below and enter your Code. </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" colspan="7" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="25" colspan="7" valign="top" class="text">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="8%" valign="top" class="sublink">&nbsp;</td>
                                            <td valign="top" class="text">
                                              <div align="left"><strong>Committee Name </strong></div>
                                            </td>
                                            <td width="25%" valign="top" class="sublink">
                                              <div align="center" class="text"><strong>Code</strong></div>
                                            </td>
                                            <td width="8%">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" valign="top" class="sublink">
                                              <?php
                                              $sql_comm = "select * from mem_committee order by comm_id_int";
                                              $chk_comm = mysqli_query($cn, $sql_comm);

                                              while ($committee = mysqli_fetch_array($chk_comm)) {
                                              ?>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr align="center">
                                                    <td width="8%" height="30"><input type="checkbox" tabindex="36" name="chkCommName[]" value="<?php echo $committee['comm_id_int']; ?>"></td>
                                                    <td width="65%" align="left" class="text"> <?php echo $committee['comm_name_vc']; ?> </td>
                                                    <td width="27%">
                                                      <input name="txtCommCode[]" type="text" size="10" tabindex="37">
                                                    </td>
                                                  </tr>
                                                </table>
                                              <?php } ?>
                                            </td>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" colspan="2" valign="middle" class="text"></td>
                                      <td height="8" colspan="5" class="sublink"></td>
                                    </tr>
                                    <tr valign="top" bgcolor="#eaeaea">
                                      <td height="10" colspan="7" class="text_bold_head">Professional Details</td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="8" colspan="7" class="text"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="10" colspan="7"><span class="sublink">
                                        </span>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="19%" height="10" valign="top" class="text">
                                              <div align="right">Type</div>
                                            </td>
                                            <td width="2%" height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td width="79%" height="25">
                                              <span class="sublink">
                                                <select name="prof_type" onChange="showhideDiv(this.value)" tabindex="38">
                                                  <option value="" <?php echo isset($prof_type) == "" ? "selected" : ""; ?>> Not specified </option>
                                                  <option value="H" <?php echo isset($prof_type) == "H" ? "selected" : ""; ?>> House Wife </option>
                                                  <option value="S" <?php echo isset($prof_type) == "S" ? "selected" : ""; ?>> Student </option>
                                                  <option value="B" <?php echo isset($prof_type) == "B" ? "selected" : ""; ?>> Business </option>
                                                  <option value="P" <?php echo isset($prof_type) == "P" ? "selected" : ""; ?>> Professional </option>
                                                  <option value="J" <?php echo isset($prof_type) == "J" ? "selected" : ""; ?>> Job </option>
                                                  <option value="R" <?php echo isset($prof_type) == "R" ? "selected" : ""; ?>> Retire </option>
                                                </select>
                                              </span>
                                            </td>
                                          </tr>
                                          <tr id="trbusiness" style="display:none;">
                                            <td height="25" colspan="3" valign="top" class="text">
                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="19%" height="10" valign="top" class="text">
                                                    <div align="right">Business Category</div>
                                                  </td>
                                                  <td width="2%" height="25" valign="top">
                                                    <div align="center">:</div>
                                                  </td>
                                                  <td width="79%" height="25"><span class="sublink">
                                                      <select name="bness_cat_id" tabindex="39">
                                                        <option value=""> Please Select </option>
                                                        <?php
                                                        while ($cat = mysqli_fetch_array($check_cat)) {
                                                          if ($bness_cat_id == $cat['sub_id']) {
                                                        ?>
                                                            <option value="<?php echo $cat['sub_id']; ?>" selected> <?php echo $cat['group_name']; ?> </option>
                                                          <?php   } else { ?>
                                                            <option value="<?php echo $cat['sub_id']; ?>"> <?php echo $cat['group_name']; ?> </option>
                                                        <?php
                                                          }
                                                        }
                                                        ?>
                                                      </select>
                                                    </span></td>
                                                </tr>
                                                <tr>
                                                  <td height="10" valign="top" class="text">
                                                    <div align="right">Industry</div>
                                                  </td>
                                                  <td height="25" valign="top">
                                                    <div align="center">:</div>
                                                  </td>
                                                  <td height="25" id="tdsubcat"><span class="sublink">
                                                      <select name="bness_subcat_id" tabindex="40">
                                                        <option value=""> Please Select </option>
                                                        <?php
                                                        while ($ind = mysqli_fetch_array($check_ind)) {
                                                          if ($bness_subcat_id == $ind['ind_id']) {
                                                        ?>
                                                            <option value="<?php echo $ind['ind_id']; ?>" selected> <?php echo $ind['ind_value']; ?> </option>
                                                          <?php   } else { ?>
                                                            <option value="<?php echo $ind['ind_id']; ?>"> <?php echo $ind['ind_value']; ?> </option>
                                                        <?php
                                                          }
                                                        }
                                                        ?>
                                                      </select>
                                                    </span></td>
                                                </tr>
                                                <tr>
                                                  <td height="10" valign="top" class="text">
                                                    <div align="right">Business Name </div>
                                                  </td>
                                                  <td height="25" valign="top">
                                                    <div align="center">:</div>
                                                  </td>
                                                  <td height="25"><span class="sublink">
                                                      <input name="bness_name" type="text" class="txtbox1" tabindex="41" value="<?php echo isset($bness_name) ? $bness_name :  ""; ?>" size="50">
                                                    </span></td>
                                                </tr>
                                                <!--<tr>
                                    <td height="22" valign="top" class="text"><div align="right">Business Address</div></td>
                                    <td height="22" valign="top"><div align="center">:</div></td>
                                    <td height="22"><span class="sublink">
                                      <textarea name="bness_addr" cols="30" rows="5" class="txtbox1" tabindex="31"><?php echo ($bness_addr); ?></textarea>
                                    </span></td>
                                  </tr>-->
                                                <tr>
                                                  <td height="10" valign="top" class="text">
                                                    <div align="right">Phone No</div>
                                                  </td>
                                                  <td height="25" valign="top">
                                                    <div align="center">:</div>
                                                  </td>
                                                  <td height="25" class="text">
                                                    <input name="bness_phone" type="text" class="txtbox1" tabindex="42" value="<?php echo isset($bness_phone) ? $bness_phone : ""; ?>" size="40">
                                                    (Multiple nos seperated by comma[,])
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td height="10" valign="top" class="text">
                                                    <div align="right">Mobile No. </div>
                                                  </td>
                                                  <td height="25" valign="top">
                                                    <div align="center">:</div>
                                                  </td>
                                                  <td height="25" class="text"><span class="sublink">
                                                      <input name="bness_mobile" type="text" class="txtbox1" tabindex="43" value="<?php echo isset($bness_mobile) ? $bness_mobile : ""; ?>" size="40">
                                                      (Multiple nos seperated by comma[,])</span></td>
                                                </tr>
                                                <tr>
                                                  <td height="10" valign="top" class="text">
                                                    <div align="right">Description</div>
                                                  </td>
                                                  <td height="25" valign="top">
                                                    <div align="center">:</div>
                                                  </td>
                                                  <td height="25" class="text"><span class="sublink">
                                                      <textarea name="bness_desc" cols="40" rows="7" class="txtbox1" tabindex="44"><?php echo isset($bness_desc) ? $bness_desc : ""; ?></textarea></span></td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr valign="top" id="trprof" style="display:none;">
                                      <td height="10" colspan="7">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="19%" height="10" valign="top" class="text">
                                              <div align="right">Profession Name</div>
                                            </td>
                                            <td width="2%" height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td width="79%" height="25"><span class="sublink">
                                                <select name="prof_cat_id" tabindex="45" onChange="getSubCat(this.value,'','prof_subcat_id','tdprofcat');">
                                                  <option value=""> Please Select </option>
                                                  <?php
                                                  while ($prof = mysqli_fetch_array($check_cat1)) {
                                                    if ($prof_cat_id == $prof['sub_id']) {
                                                  ?>
                                                      <option value="<?php echo $prof['sub_id']; ?>" selected> <?php echo $prof['group_name']; ?> </option>
                                                    <?php   } else { ?>
                                                      <option value="<?php echo $prof['sub_id']; ?>"> <?php echo $prof['group_name']; ?> </option>
                                                  <?php
                                                    }
                                                  }
                                                  ?>
                                                </select>
                                              </span></td>
                                          </tr>
                                          <tr>
                                            <td height="10" valign="top" class="text">
                                              <div align="right">Specialization</div>
                                            </td>
                                            <td height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td height="25" id="tdprofcat"><span class="sublink">
                                                <select name="prof_subcat_id" tabindex="46">
                                                  <option value=""> Please Select </option>
                                                </select>
                                              </span></td>
                                          </tr>
                                          <!--<tr>
                                <td height="10" valign="top" class="text"><div align="right">Office Address</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25"><span class="sublink">
                                  <textarea name="prof_addr" cols="30" rows="5" class="txtbox1" tabindex="37"><?php echo ($prof_addr); ?></textarea>
                                </span></td>
                              </tr> -->
                                          <tr>
                                            <td height="10" valign="top" class="text">
                                              <div align="right">Phone No</div>
                                            </td>
                                            <td height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td height="25" class="text">
                                              <input name="prof_phone" type="text" class="txtbox1" tabindex="47" value="<?php echo isset($prof_phone) ? $prof_phone : ""; ?>" size="40">
                                              (Multiple nos seperated by comma[,])
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="10" valign="top" class="text">
                                              <div align="right">Mobile No. </div>
                                            </td>
                                            <td height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td height="25" class="text"><span class="sublink">
                                                <input name="prof_mobile" type="text" class="txtbox1" tabindex="48" value="<?php echo isset($prof_mobile) ? $prof_mobile : ""; ?>" size="40">
                                                (Multiple nos seperated by comma[,]) </span></td>
                                          </tr>
                                          <tr>
                                            <td height="10" valign="top" class="text">
                                              <div align="right">Description</div>
                                            </td>
                                            <td height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td height="25" class="text"><span class="sublink">
                                                <textarea name="prof_desc" cols="40" rows="7" class="txtbox1" tabindex="49"><?php echo isset($prof_desc) ? $prof_desc : ""; ?></textarea>
                                              </span></td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr valign="top" id="trjob" style="display:none;">
                                      <td height="10" colspan="7">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td height="10" valign="top" class="text">
                                              <div align="right">Job Type </div>
                                            </td>
                                            <td height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td height="25"><span class="sublink">
                                                <select name="job_type" tabindex="50">
                                                  <option value=""> Please Select </option>
                                                  <?php
                                                  while ($jobtype = mysqli_fetch_array($check_jobtype)) {
                                                    if ($job_type == $jobtype['sub_id']) {
                                                  ?>
                                                      <option value="<?php echo $jobtype['sub_id']; ?>" selected> <?php echo $jobtype['group_name']; ?> </option>
                                                    <?php   } else { ?>
                                                      <option value="<?php echo $jobtype['sub_id']; ?>"> <?php echo $jobtype['group_name']; ?> </option>
                                                  <?php
                                                    }
                                                  }
                                                  ?>
                                                </select>
                                              </span></td>
                                          </tr>
                                          <tr>
                                            <td height="10" valign="top" class="text">
                                              <div align="right">Industry</div>
                                            </td>
                                            <td height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td height="25" id="tdsubcat"><span class="sublink">
                                                <select name="job_ind_id" tabindex="51">
                                                  <option value=""> Please Select </option>
                                                  <?php
                                                  while ($j_ind = mysqli_fetch_array($check_ind_job)) {
                                                    if ($job_ind_id == $j_ind['ind_id']) {
                                                  ?>
                                                      <option value="<?php echo $j_ind['ind_id']; ?>" selected> <?php echo $j_ind['ind_value']; ?> </option>
                                                    <?php   } else { ?>
                                                      <option value="<?php echo $j_ind['ind_id']; ?>"> <?php echo $j_ind['ind_value']; ?> </option>
                                                  <?php
                                                    }
                                                  }
                                                  ?>
                                                </select>
                                              </span></td>
                                          </tr>
                                          <tr>
                                            <td width="19%" height="10" valign="top" class="text">
                                              <div align="right">Company Name</div>
                                            </td>
                                            <td width="2%" height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td width="79%" height="25"><span class="sublink">
                                                <span class="text">
                                                  <input name="comp_name" type="text" class="txtbox1" tabindex="52" value="<?php echo  isset($comp_name) ? $comp_name : ""; ?>" size="50">
                                                </span> </span></td>
                                          </tr>
                                          <tr>
                                            <td height="10" valign="top" class="text">
                                              <div align="right">Designation</div>
                                            </td>
                                            <td height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td height="25"><span class="sublink">
                                                <span class="text">
                                                  <input name="job_desig" type="text" class="txtbox1" tabindex="53" value="<?php echo isset($job_desig) ? $job_desig : ""; ?>" size="50">
                                                </span> </span></td>
                                          </tr>
                                          <!--
							                  <tr>
                                <td height="10" valign="top" class="text"><div align="right">Office Address</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25"><span class="sublink">
                                  <textarea name="job_addr" cols="30" rows="5" class="txtbox1" tabindex="43"><?php echo ($job_addr); ?></textarea>
                                </span></td>
                              </tr> -->
                                          <tr>
                                            <td height="10" valign="top" class="text">
                                              <div align="right">Phone No</div>
                                            </td>
                                            <td height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td height="25" class="text">
                                              <input name="job_phone" type="text" class="txtbox1" tabindex="54" value="<?php echo isset($job_phone) ? $job_phone : ""; ?>" size="40">
                                              (Multiple nos seperated by comma[,])
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="10" valign="top" class="text">
                                              <div align="right">Mobile No. </div>
                                            </td>
                                            <td height="25" valign="top">
                                              <div align="center">:</div>
                                            </td>
                                            <td height="25" class="text"><span class="sublink">
                                                <input name="job_mobile" type="text" class="txtbox1" tabindex="55" value="<?php echo isset($job_mobile) ? $job_mobile : ""; ?>" size="40">
                                                (Multiple nos seperated by comma[,]) </span></td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr valign="top" id="tdaddr">
                                      <td height="25" class="text">
                                        <div align="right">Address</div>
                                      </td>
                                      <td height="25">
                                        <div align="center">:</div>
                                      </td>
                                      <td height="25" colspan="5" class="sublink">
                                        <table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                          <tr>
                                            <td width="25%">
                                              <div align="right">Line1</div>
                                            </td>
                                            <td width="2%">&nbsp;</td>
                                            <td width="75%"><input name="job_addr1" type="text" class="txtbox1" id="job_addr1" tabindex="56" value="<?php echo isset($vartxtjobaddr1); ?>" size="30"></td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">Line2</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%"><input name="job_addr2" type="text" class="txtbox1" id="job_addr2" tabindex="57" value="<?php echo isset($vartxtjobaddr2); ?>" size="30"></td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">Line3</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%"><input name="job_addr3" type="text" class="txtbox1" id="job_addr3" tabindex="58" value="<?php echo isset($vartxtjobaddr3); ?>" size="30"></td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">Country</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%">
                                              <select name="job_country" class="txtbox1" id="job_country" tabindex="59" onChange="javascript:getJobState(this.value);">
                                                <option value=""> Select Country </option>
                                                <?php
                                                while ($country = mysqli_fetch_array($chk_job_country)) {
                                                  if ($country['country_id'] == $vartxtjobcountry) {
                                                ?>
                                                    <option value="<?php echo $country['country_id']; ?>" selected> <?php echo $country['country_name']; ?> </option>
                                                  <?php } else { ?>
                                                    <option value="<?php echo $country['country_id']; ?>"> <?php echo $country['country_name']; ?> </option>
                                                <?php }
                                                } ?>
                                              </select>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">State</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%" id="tdjstate">
                                              <select name="job_state" class="txtbox1" id="State " tabindex="60" />

                                              <option value=""> Select State </option>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">City/Town/Village</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%" id="tdjcity">
                                              <select name="job_city" class="txtbox1" id="City " tabindex="61" />

                                              <option value=""> Select City </option>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">District</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%"><input name="job_district" type="text" class="txtbox1" id="job_district" tabindex="62" value="<?php echo isset($vartxtjobdistrict) ? $vartxtdistrict : ""; ?>" size="30" /></td>
                                          </tr>
                                          <tr>
                                            <td width="25%">
                                              <div align="right">Pincode</div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td width="75%"><input name="job_pincode" type="text" class="txtbox1" id="job_pincode" tabindex="63" value="<?php echo isset($vartxtjobpincode) ? $vartxtjobpincode : ""; ?>" size="20"></td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr valign="top">
                                      <td height="10">&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td colspan="5"><input type="submit" value="Submit" tabindex="64" width="71" height="24" border="0" onClick="javascript:return checkFormElements1(this.form);"></td>
                                    </tr>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td colspan="5">&nbsp;</td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </form>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="36" valign="top" background="images/footer_bg.gif">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="8" valign="top">
            </td>
          </tr>
          <tr>
            <td valign="top">
              <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr valign="top">
                  <td class="footertext">&nbsp;</td>
                  <td class="footertext">
                    <div align="right"></div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td height="5" valign="top"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <!-- End ImageReady Slices -->
  <script language="javascript" type="text/javascript">
    showhideDiv("<?php echo $prof_type; ?>");

    var countrycode = "<?php echo $vartxtcountry; ?>";

    var statecode = "<?php echo $vartxtstate; ?>";
    getState(countrycode, statecode);

    var citycode = "<?php echo $vartxtcity; ?>";
    getCity(statecode, citycode);

    var bness_cat_id = "<?php echo $bness_cat_id; ?>";

    var prof_cat_id = "<?php echo $prof_cat_id; ?>";

    var prof_subcat_id = "<?php echo $prof_subcat_id; ?>";
    getSubCat(prof_cat_id, '', 'prof_subcat_id', 'tdprofcat', prof_subcat_id);

    getDet("<?php echo $vartxtedu_cat; ?>");

    var jobcountrycode = "<?php echo $vartxtjobcountry; ?>";

    var jobstatecode = "<?php echo $vartxtjobstate; ?>";
    getJobState(jobcountrycode, jobstatecode);

    var jobcitycode = "<?php echo $vartxtjobcity; ?>";
    getJobCity(jobstatecode, jobcitycode);

    getDet("<?php echo $vartxtbasic_qual; ?>", 'bq_det', 'bq_det');

    getDet("<?php echo $vartxtpg_qual; ?>", 'pg_det', 'pg_det');

    getDet("<?php echo $vartxtdoc_qual; ?>", 'doc_det', 'doc_det');
  </script>

</body>

</html>