<?php
ob_start();
include_once "admin/connection/conn.php";
require 'admin/include/appmain.php';
require 'admin/utility/querygen.inc';

$oQGen = new CQueryGen();
$oQGen1 = new CQueryGen();


$ProdThumbImgDir = "admin/images/vastipatrak/thumb/";
$ProdLargeImgDir = "admin/images/vastipatrak/attachment/";

$ip_addr = $_SERVER['REMOTE_ADDR'];
$sql_ipaddr = "select ip_addr from ipaddr_m";
$chk_ipaddr = mysqli_query($cn, $sql_ipaddr);
$tmp_ipaddr = mysqli_fetch_array($chk_ipaddr);


if (isset($_POST["txtMode"]) == "") {
  $varMode = isset($_GET['Mode']) ? $_GET['Mode'] : "";
} else {
  $varMode = $_POST['txtMode'];
}

if (isset($_POST["vasti_id"]) == "") {
  $varCode = isset($_GET['Code']) ? $_GET['Code'] : "";
} else {
  $varCode = $_POST['vasti_id'];
}
if (isset($_POST["HCode"]) == "") {
  $hcode = isset($_GET['HCode']) ? $_GET['HCode'] : "";
} else {
  $hcode = $_POST['HCode'];
}
if ($varCode == "")
  $varCode = 0;

$sql_string = "SELECT * FROM bdir_category where cat_type='B' and main_id=0 and group_name!='Root' order by group_name";
$check_cat = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM industry_m order by ind_value";
$check_ind = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM bdir_category where cat_type='J' and main_id=0 and group_name!='Root' order by group_name";
$check_jobtype = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM industry_m order by ind_value";
$check_ind_job = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM bdir_category where cat_type='P' and main_id=0 and group_name!='Root' order by group_name";
$check_cat1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM country_m order by country_name";
$chk_country = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM country_m order by country_name";
$chk_job_country = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Basic/Grad.' order by education_name";
$chk_edu_det1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='PG' order by education_name";
$chk_edu_det2 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Doctrate' order by education_name";
$chk_edu_det3 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));


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


// Get Ancestor Name if available //
if ($varMode != "A") {
  if (isset($_GET['AncId']) != "") {
    $sql_anc_name = "SELECT vasti_id,fname_vc,mname_vc,lname_vc FROM vastipatrak_m where vasti_id=" . $_GET['AncId'] . " order by vasti_id";
  } else {
    $sql_anc_name = "SELECT v.anc_id,v1.vasti_id,v1.fname_vc,v1.mname_vc,v1.lname_vc FROM vastipatrak_m v
						 left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
						 where v.vasti_id=" . $varCode . " and v.anc_id>0 order by v.vasti_id";
  }

  $chk_anc_name = mysqli_query($cn, $sql_anc_name);
  $anc_name = mysqli_fetch_array($chk_anc_name);
  $anc_num = mysqli_num_rows($chk_anc_name);
  $anc_id = isset($anc_name['vasti_id']) ? $anc_name['vasti_id'] : "";
}

//---------------QueryString-------------------
if ($varMode == "E") {
  $sql_string = "SELECT v.*,v1.form_no as parfrmno,m.marital_name FROM vastipatrak_m v 
					left outer join marital_m m on v.marital_id = m.marital_id 
				    left outer join vastipatrak_m v1 on v.parent_id = v1.vasti_id 
				    
				   where v.vasti_id=" . $varCode;
  $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
  if (mysqli_num_rows($check_res) <= 0) {
    echo ("No rows in the database to display");
    exit;
  } else {
    while ($rec = mysqli_fetch_array($check_res)) {

      if (isset($_GET['HCode']) == "")
        $vartxtformno = $rec['form_no'];
      else
        $vartxtformno = $rec['parfrmno'];

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
      $vartxtMaritalName = $rec['marital_name'];

      //$vartxtMobile = $rec['mobile_number'];
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

      $from_userside = $rec['from_userside'];
    }
  }

  $sql_string1 = "SELECT * FROM businessdir_m where vasti_id=" . $varCode;
  $check_res1 = mysqli_query($cn, $sql_string1);
  $rec1 = mysqli_fetch_array($check_res1);
  $prof_type = isset($rec1['prof_type']) ? $rec1['prof_type'] : '';
  $vasti_id = isset($rec1['vasti_id']) ? $rec1['vasti_id'] : '';
  $bness_cat_id = isset($rec1['bness_cat_id']) ? $rec1['bness_cat_id'] :'' ;
  $bness_subcat_id = isset($rec1['bness_subcat_id']) ? $rec1['bness_subcat_id'] :'';
  $bness_name = isset($rec1['bness_name']) ? $rec1['bness_name'] :'';
  $bness_addr = isset($rec1['bness_addr']) ? $rec1['bness_addr'] :'';
  $bness_phone = isset($rec1['bness_phone']) ? $rec1['bness_phone'] :'';
  $bness_mobile = isset($rec1['bness_mobile']) ? $rec1['bness_mobile'] :'';
  $bness_desc = isset($rec1['bness_desc']) ? $rec1['bness_desc'] :'';
  $prof_cat_id = isset($rec1['prof_cat_id']) ? $rec1['prof_cat_id'] :'';
  $prof_subcat_id = isset($rec1['prof_subcat_id']) ? $rec1['prof_subcat_id'] :'';
  $prof_addr = isset($rec1['prof_addr']) ? $rec1['prof_addr'] :'';
  $prof_phone = isset($rec1['prof_phone']) ? $rec1['prof_phone'] :'';
  $prof_mobile = isset($rec1['prof_mobile']) ? $rec1['prof_mobile'] :'';
  $prof_desc = isset($rec1['prof_desc']) ? $rec1['prof_desc'] :'';
  $comp_name = isset($rec1['comp_name']) ? $rec1['comp_name'] :'';
  $job_type = isset($rec1['job_type']) ? $rec1['job_type'] :'';
  $job_ind_id = isset($rec1['job_ind_id']) ? $rec1['job_ind_id'] :'';
  $job_desig = isset($rec1['job_desig']) ? $rec1['job_desig'] :'';
  $job_addr = isset($rec1['job_addr']) ? $rec1['job_addr'] :'';
  $job_phone = isset($rec1['job_phone']) ? $rec1['job_phone'] :'';
  $job_mobile = isset($rec1['job_mobile']) ? $rec1['job_mobile'] :'';

  $vartxtjobaddr1 = isset($rec1['job_addr1']) ? $rec1['job_addr1'] :'';
  $vartxtjobaddr2 = isset($rec1['job_addr2']) ? $rec1['job_addr2'] :'';
  $vartxtjobaddr3 = isset($rec1['job_addr3']) ? $rec1['job_addr3'] :'';
  $vartxtjobcountry = isset($rec1['job_country']) ? $rec1['job_country'] :'';
  $vartxtjobstate = isset($rec1['job_state']) ? $rec1['job_state'] :'';
  $vartxtjobcity = isset($rec1['job_city']) ? $rec1['job_city'] :'';
  $vartxtjobdistrict = isset($rec1['job_district']) ? $rec1['job_district'] :'';
  $vartxtjobpincode = isset($rec1['job_pincode']) ? $rec1['job_pincode'] :'';
}

// Get Ancestor Name if available //
if ($varMode != "A") {
  if (isset($_GET['FId']) == "") {
    if ((isset($vartxtMaritalName) == "Married" or isset($vartxtMaritalName) == "Widow")  && $varGender == "Female") {
      $sql_father_name = "SELECT v.f_id,v1.vasti_id,v1.fname_vc,v1.mname_vc,v1.lname_vc FROM vastipatrak_m v
								left outer join vastipatrak_m v1 on v.f_id = v1.vasti_id
								where v.vasti_id=" . $varCode . " order by v.vasti_id";
    } else {
      $sql_father_name = "SELECT v.anc_id,v1.vasti_id,v1.fname_vc,v1.mname_vc,v1.lname_vc FROM vastipatrak_m v
								left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
								where v.vasti_id=" . $varCode . " order by v.vasti_id";
    }
  } else {
    $sql_father_name = "SELECT v1.vasti_id,v1.fname_vc,v1.mname_vc,v1.lname_vc FROM vastipatrak_m v1
						where v1.vasti_id=" . $_GET['FId'] . " order by v1.vasti_id";
  }
  $chk_father_name = mysqli_query($cn, $sql_father_name);
  $father_name_rec = mysqli_fetch_array($chk_father_name);
  $father_name = isset($father_name_rec['fname_vc'])  . " " . $father_name_rec['mname_vc'] . " " . $father_name_rec['lname_vc'];
  $father_id = $father_name_rec['vasti_id'];
}
// Get Ancestor Name if available //
if (isset($_GET['HId']) == "") {
  $sql_husband_name = "SELECT v.anc_id,v1.vasti_id,v1.fname_vc,v1.mname_vc,v1.lname_vc FROM vastipatrak_m v
						left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
						where v.vasti_id=" . $varCode . " order by v.vasti_id";
} else {
  $sql_husband_name = "SELECT v1.vasti_id,v1.fname_vc,v1.mname_vc,v1.lname_vc FROM vastipatrak_m v1
						where v1.vasti_id=" . $_GET['HId'] . " order by v1.vasti_id";
}
$chk_husband_name = mysqli_query($cn, $sql_husband_name);
$husband_name_rec = mysqli_fetch_array($chk_husband_name);
$husband_name = isset($husband_name_rec['fname_vc']) . " " . isset($husband_name_rec['mname_vc']) . " " . isset($husband_name_rec['lname_vc']);
$husband_id = isset($husband_name_rec['vasti_id']) ? $husband_name_rec['vasti_id'] : "";

if (isset($_GET['FId']) != "") {
  $father_id = $_GET['FId'];
}
if (isset($_GET['HId']) != "") {
  $husband_id = $_GET['HId'];
}

/*	if((($vartxtMaritalName != "Unmarried" or $vartxtMaritalName != "") && $varGender == "Female") && ($_GET['HId']!="" || $_GET['FId']!=""))
		$anccode = $husband_id;
	else if($hcode == "")
		$anccode = $anc_id;
	else if($husband_id!="")
		$anccode = $husband_id;
	else if($father_id!="")
		$anccode = $father_id;
	else
		$anccode = $hcode;
}*/

if (isset($varGender) == "Male") {
  $anccode = $father_id;
} else {
  if (isset($vartxtMaritalName) == "Unmarried" || (isset($vartxtMaritalName) == ""))
    $anccode = isset($father_id) ? $father_id : "";
  else
    $anccode = $husband_id;
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

  if (isset($_FILES["attachment"]["name"]) != "") {
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

  //Get Current image value from db
  $sql_img = "select thumb_image,attachment from vastipatrak_m where vasti_id=" . $varCode;
  $chk_img = mysqli_query($cn, $sql_img);
  $tmp = mysqli_fetch_array($chk_img);

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

    if (in_array($key, $fieldarray)) {
      $oQGen->addFieldValue($key, $val, "C");
    }
  }

  if ($_FILES['thumb_image']['name'] != "") {
    $oQGen->addFieldValue("thumb_image", $TImage, "C");
  } else {
    $oQGen->addFieldValue("thumb_image", $tmp['thumb_image'], "C");
  }


  if (isset($_FILES['attachment']['name']) != "") {
    $oQGen->addFieldValue("attachment", $EImage, "C");
  } else {
    $oQGen->addFieldValue("attachment", $tmp['attachment'], "C");
  }

  // Get Execution Statement

  if ($_POST["txtMode"] == "A") :

    $sql_string = $oQGen->getInsert();

  else :

    $oQGen->addConditionFieldValue("vasti_id", $_POST['vasti_id'], "C");
    $sql_string = $oQGen->getUpdate();
  endif;
  echo $sql_string;
  $code = db_execute($cn, $sql_string);

  if ($code == 0 || $code == "")
    $code = $_POST['vasti_id'];

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
        $oQGen1->addFieldValue($key, $val, "C");
      }
    }

    // first delete entry of current vasti_id and then insert updtaed record //
    $sql_del = "delete from businessdir_m where vasti_id=" . $code;
    $chk_del = mysqli_query($cn, $sql_del);

    // Get Execution Statement
    echo $sql_string = $oQGen1->getInsert();
exit;
    $code1 = db_execute($cn, $sql_string);
  }


  if ($_GET['HCode'] == "") {
    $_SESSION["UserEmail"] = $vartxtEmail;
    $_SESSION["VastiId"] = $code;
    $_SESSION["UserCode"] = $code;
  }

  $msg = "Thank you for registering in Khadayat VastiPatrak Samiti. Your username and password will be mailed to you after your account approval by Admin. For any furthur queries please contact Khadayata VastiPatrak Samiti";
  $HCode = $_GET['HCode'];

  /*if($_GET['Mode'] == "E")
			redirect("vastipatrak_changes_notification.php?code=".$code."&hcode=".$HCode."&msg=".urlencode($msg)."&mode=E");
		else
			redirect("vastipatrak_changes_notification.php?code=".$code."&hcode=".$HCode."&msg=".urlencode($msg));
		*/
  if (isset($_SESSION['UserCode']) ? $_SESSION['UserCode'] : "") {
    redirect("user-familydet.php");
  } else {
    if ($_GET['HCode'] == "") {
      // redirect("vastipatrak_changes_notification.php?code=" . $code . "&hcode=" . $HCode . "&msg=" . urlencode($msg));
    } else {
      //  redirect("user-familydet.php");
    }
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
  <link href="css/styles.css" rel="stylesheet" type="text/css" />

  <script type="text/javascript" src="js/ajax.js"></script>
  <script type="text/javascript" src="js/userjvalid.js"></script>

  <script type='text/JavaScript' src='js/scw.js'></script>

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
    //$src = "family_link_search.php?mode=F&Code=".$varCode."&Mode=".$_GET['Mode']."&HCode=".$_GET['HCode']."&HId=".$_GET['HId'];

    function doSub(mode, Code, Mode, HCode, HId, FId, stype, a_id) {
      var st = document.getElementById(stype).value;
      if (st != 'f')
        document.getElementById(a_id).href = "family_link_search.php?mode=" + mode + "&Code=" + Code + "&Mode=" + Mode + "&HCode=" + HCode + "&HId=" + HId + "&FId=" + FId + "&stype=" + st;
      else
        document.getElementById(a_id).href = "family_link_result.php?mode=" + mode + "&Code=" + Code + "&Mode=" + Mode + "&HCode=" + HCode + "&HId=" + HId + "&FId=" + FId + "&stype=" + st;

    }
  </script>
  <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="mm_menu.js" type="text/javascript"></script>
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage: 'images/loading.gif',
        closeImage: 'images/closelabel.png'
      })
    })
  </script>
  <style type="text/css">
    <!--
    .style1 {
      color: #222222
    }
    -->
  </style>
  <script>
    function switchMenu(tag) {

      var e1 = document.getElementById(tag);
      if (e1.style.display == "none")
        e1.style.display = "";
      else
        e1.style.display = "none";
    }

    function MM_swapImgRestore() { //v3.0
      var i, x, a = document.MM_sr;
      for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) x.src = x.oSrc;
    }

    function MM_preloadImages() { //v3.0
      var d = document;
      if (d.images) {
        if (!d.MM_p) d.MM_p = new Array();
        var i, j = d.MM_p.length,
          a = MM_preloadImages.arguments;
        for (i = 0; i < a.length; i++)
          if (a[i].indexOf("#") != 0) {
            d.MM_p[j] = new Image;
            d.MM_p[j++].src = a[i];
          }
      }
    }

    function MM_findObj(n, d) { //v4.01
      var p, i, x;
      if (!d) d = document;
      if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
        d = parent.frames[n.substring(p + 1)].document;
        n = n.substring(0, p);
      }
      if (!(x = d[n]) && d.all) x = d.all[n];
      for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
      for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
      if (!x && d.getElementById) x = d.getElementById(n);
      return x;
    }

    function MM_swapImage() { //v3.0
      var i, j = 0,
        x, a = MM_swapImage.arguments;
      document.MM_sr = new Array;
      for (i = 0; i < (a.length - 2); i += 3)
        if ((x = MM_findObj(a[i])) != null) {
          document.MM_sr[j++] = x;
          if (!x.oSrc) x.oSrc = x.src;
          x.src = a[i + 2];
        }
    }
  </script>

</head>
<?php

// Advertisement Query
$sql_advt_incl1 = "select * from advt_tbl order by RAND()";
$chk_advt_incl1 = mysqli_query($cn, $sql_advt_incl1);

$filelist = "";
$imgdir = "";
while ($advt_incl1 = mysqli_fetch_array($chk_advt_incl1)) {
  if ($advt_incl1['file'] != "") {
    if ($filelist != "") $filelist .= ",";
    $filelist .= "'" . $imgdir . $advt_incl1['file'] . "'";
  }
}
?>

<body onLoad="MM_preloadImages(<?php echo ($filelist); ?>);">
  <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" valign="top" bgcolor="#ffffff">
        <table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" valign="top" background="images/top_bg.jpg" style="background-position:top; background-repeat:no-repeat;">
              <table width="500" border="0" cellspacing="0" cellpadding="0">

                <tr>
                  <td height="99" align="left" valign="top"><a href="index.html"><img src="images/spacer.gif" alt="" width="484" height="99" /></a></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td height="34">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr height="59">
                  <td>
                    <table width="475" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="2"><?php include "advt_incl.php"; ?></td>
                      </tr>
                      <tr>
                        <td height="7"></td>
                        <td></td>
                      </tr>
                    </table>
                  </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td height="41" align="center" valign="middle" background="images/menu_bg.jpg" style="background-repeat:repeat-x">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="9%" align="center" valign="middle" class="menu"><a href="index.php">Home</a></td>
                  <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
                  <td width="10%" align="center" valign="middle" class="menu"><a href="aboutus.php">About Us</a></td>
                  <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
                  <td width="12%" align="center" valign="middle" class="menu"><a href="vasti_patrak.php">Vasti Patrak</a> </td>
                  <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
                  <td width="15%" align="center" valign="middle" class="menu"><a href="other_organisation.php">Other Organisations</a></td>
                  <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
                  <td width="12%" align="center" valign="middle" class="menu"><a href="photo_gallery.php">Photo Gallery</a></td>
                  <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
                  <td width="12%" align="center" valign="middle" class="menu"><a href="comm_details.php">Committee</a></td>
                  <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
                  <td width="11%" align="center" valign="middle" class="menu"><a href="feedback.php">Feedback</a></td>
                  <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
                  <td width="9%" align="center" valign="middle" class="menu"><a href="contact.php">Contact</a></td>
                  <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
                  <td align="center" valign="middle" class="menu"><a href="sitemap.php">Sitemap</a></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td align="center" valign="top">
              <table width="1003" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="22" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x;">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" valign="top">
                    <table width="97%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" valign="top" class="border1">
                          <table width="98%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td align="center" valign="top" class="border1">
                                <table width="96%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td colspan="4">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="4">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr bgcolor="#f2f2f2">
                                          <td width="2%" height="37">&nbsp;</td>
                                          <td height="37" align="left" valign="middle" class="title">
                                            <?php
                                            if (($varCode == "" || $varCode == 0) && $hcode == "") { ?>
                                              New User Sign Up
                                            <?php } else if ($hcode != "" && ($varCode == "" || $varCode == 0)) { ?>
                                              New Family Member Details
                                            <?php } else { ?>
                                              Edit Details of <?php echo $vartxtFName . " " . $vartxtMName . " " . $vartxtLName; ?>
                                            <?php } ?>
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="100%" height="274" colspan="4">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td>
                                            <form name="frm" method="post" action="signup.php?Code=<?php echo $varCode; ?>&Mode=<?php echo $_GET['Mode']; ?>&HCode=<?php echo isset($_GET['HCode']) ? $_GET['HCode'] : ""; ?>" id="frmS" enctype="multipart/form-data">
                                              <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                                              <input type="hidden" name="vasti_id" value="<?php echo $varCode; ?>">
                                              <input type="hidden" name="business_id" value="">
                                              <input type="hidden" name="form_no" value="<?php echo isset($vartxtformno) ? $vartxtformno : ""; ?>">
                                              <input type="hidden" id="DPC_TODAY_TEXT" value="today">
                                              <input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
                                              <input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
                                              <input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
                                              <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $hcode; ?>">
                                              <input type="hidden" name="anc_id" id="anc_id" value="<?php
                                                                                                    if (isset($anc_id)) {
                                                                                                      echo $anc_id;
                                                                                                    } else {
                                                                                                      echo $hcode;
                                                                                                    } ?>">
                                              <?php
                                              if ((isset($vartxtMaritalName) != "Unmarried" && isset($vartxtMaritalName) != "") && $varGender == "Female") {
                                              ?>
                                                <input type="hidden" name="f_id" id="f_id" value="<?php echo $father_id; ?>">
                                              <?php } else { ?>
                                                <input type="hidden" name="f_id" id="f_id" value="0">
                                              <?php } ?>
                                              <input type="hidden" name="is_parent" id="is_parent" value="<?php echo ($hcode != "") ? "0" : "1"; ?>">
                                              <input type="hidden" name="from_userside" id="from_userside" value="<?php echo ($_GET['Mode'] == "E" && $from_userside == "0") ? "0" : "1"; ?>">
                                              <input type="hidden" name="reg_date" id="reg_date" tabindex="27" datepicker_format="YYYY-MM-DD" datepicker="true" value="<?php echo date('Y-m-d'); ?>" />

                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr valign="top">
                                                  <td width="2%">&nbsp;</td>
                                                  <td>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr bgcolor="#f2f2f2">
                                                        <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                        <td colspan="2" align="left" valign="middle" bgcolor="#FFFFFF">
                                                          <table width="98%" border="0" cellspacing="0" bgcolor="#fbfbfb">
                                                            <tr class="text">
                                                              <td height="30" colspan="4" class="text_user" style="padding-left:5px;"><span class="text4_user">Personal Details </span></td>
                                                            </tr>
                                                            <tr class="text">
                                                              <td colspan="4" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                                            </tr>

                                                            <?php
                                                            if (isset($_GET['Mode']) != 'A' &&  isset($_GET['Mode']) != 'E') {
                                                            ?>
                                                              <tr id="tr_formno" bgcolor="#FFFFFF" class="text">
                                                                <td class="text_user" style="padding-left:5px;"><strong>Form No. </strong></td>
                                                                <td width="26%" height="35" class="text_user">
                                                                  <span class="sublink">
                                                                    <input type="text" name="form_no"  id="Form No." tabindex="1" value="<?php echo isset($vartxtformno) ? $vartxtformno : ""; ?>" />
                                                                  </span>
                                                                </td>
                                                              </tr>
                                                            <?php } ?>
                                                            <tr id="tr_native" bgcolor="#FFFFFF" class="text">
                                                              <td width="14%" class="text_user" style="padding-left:5px;"><strong>Native Place<span class="click">*</span> </strong></td>
                                                              <td height="35" colspan="3" class="text_user"><select name="village_id" id="Native " tabindex="2" class="<br />
												  <?php
                          if ($_GET['Mode'] != 'A') {
                          ?>
													txtrequiredsel 
                                                  <?php } ?> txtbox">
                                                                  <option value="0" selected="selected">Please Select</option>
                                                                  <?php
                                                                  $sql_string = "SELECT * FROM village_m order by village_name";

                                                                  $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                                                  if (mysqli_num_rows($check_res) > 0) {
                                                                    while ($rec = mysqli_fetch_array($check_res)) {
                                                                      if ($vartxtVillage == $rec['village_id'])
                                                                        echo ("<option selected value ='" . $rec['village_id'] . "'>" . ucwords(strtolower($rec['village_name'])) . "</option>");
                                                                      else
                                                                        echo ("<option value='" . $rec['village_id'] . "'>" . ucwords(strtolower($rec['village_name'])) . "</option>");
                                                                    }
                                                                  }
                                                                  ?>
                                                                </select></td>
                                                            </tr>
                                                            <tr id="tr_gotra" bgcolor="#FFFFFF" class="text">
                                                              <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Gotra<strong><span class="click">*</span> </strong></td>
                                                              <td height="35" colspan="3" class="text_user">
                                                                <select name="gotra_id" id="Gotra" tabindex="3" class="
												  <?php
                          if ($_GET['Mode'] != 'A') {
                          ?>
													txtrequiredsel 
                                                  <?php } ?>  txtbox">
                                                                  <option value="0" selected="selected">Please Select</option>
                                                                  <?php
                                                                  $sql_string = "SELECT * FROM gotra_m order by gotra_name";

                                                                  $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                                                  if (mysqli_num_rows($check_res) > 0) {
                                                                    while ($rec = mysqli_fetch_array($check_res)) {
                                                                      if ($vartxtGotra == $rec['gotra_id'])
                                                                        echo ("<option selected value ='" . $rec['gotra_id'] . "'>" . ucwords(strtolower($rec['gotra_name'])) . "</option>");
                                                                      else
                                                                        echo ("<option value='" . $rec['gotra_id'] . "'>" . ucwords(strtolower($rec['gotra_name'])) . "</option>");
                                                                    }
                                                                  }
                                                                  ?>
                                                                </select>
                                                              </td>
                                                            </tr>
                                                            <?php
                                                            if ((isset($_GET['Mode']) == 'A' ||  isset($_GET['Mode']) == 'E') && isset($_GET['HCode']) != "") {
                                                            ?>
                                                              <tr bgcolor="#FFFFFF" class="text">
                                                                <td width="14%" height="35" valign="middle" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Relation with HOF<strong><span class="click">*</span> </strong></strong></td>
                                                                <td height="35" colspan="2" valign="middle" bgcolor="#FFFFFF" class="text_user"><select name="relation_id" tabindex="4" id="Relation with HOF" class="txtrequiredsel txtbox">
                                                                    <option value="0" selected>Please Select</option>
                                                                    <?php
                                                                    $sql_string = "SELECT * FROM relation_m";

                                                                    $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                                                    if (mysqli_num_rows($check_res) > 0) {
                                                                      while ($rec = mysqli_fetch_array($check_res)) {
                                                                        if ($vartxtReltion == $rec['relation_id'])
                                                                          echo ("<option selected value ='" . $rec['relation_id'] . "'>" . $rec['relation_name'] . "</option>");
                                                                        else
                                                                          echo ("<option value='" . $rec['relation_id'] . "'>" . $rec['relation_name'] . "</option>");
                                                                      }
                                                                    }
                                                                    ?>
                                                                  </select></td>
                                                              </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                            <tr bgcolor="#FFFFFF" class="text">
                                                              <td width="14%" height="35" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Name<strong><span class="click">*</span> </strong></strong></td>
                                                              <td height="35" colspan="2" valign="top" bgcolor="#FFFFFF" class="text_user">
                                                                <table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                                                  <tr>
                                                                    <td id="tdfname_label" width="21%">
                                                                      <div align="right">Your Name</div>
                                                                    </td>
                                                                    <td height="35" style="padding-left:08px;"><input name="fname_vc" type="text" class="txtreqd txtbox1" id="First Name " tabindex="5" value="<?php echo isset($vartxtFName) ? $vartxtFName : ""; ?>" size="30" /></td>
                                                                  </tr>
                                                                  <tr id="tr_mname">
                                                                    <td>
                                                                      <div align="right">Father's Name </div>
                                                                    </td>
                                                                    <td height="30" style="padding-left:08px;"><input name="mname_vc" type="text" class="
												                          <?php
                                                  if ($_GET['Mode'] != 'A') {
                                                  ?>
													                        txtreqd 
                                                  <?php } ?> txtbox1" id="Middle Name " tabindex="6" value="<?php echo isset($vartxtMName) ? $vartxtMName : ""; ?>" size="30" /></td>
                                                                  </tr>
                                                                  <tr id="tr_lname">
                                                                    <td>
                                                                      <div align="right">Surname</div>
                                                                    </td>
                                                                    <td height="30" style="padding-left:08px;"><input name="lname_vc" type="text" class="
												  <?php
                          if ($_GET['Mode'] != 'A') {
                          ?>
													txtreqd 
                                                  <?php } ?> txtbox1" id="Last Name " tabindex="7" value="<?php echo isset($vartxtLName) ? $vartxtLName : ""; ?>" size="30" /></td>
                                                                  </tr>
                                                                </table>
                                                              </td>
                                                              <?php
                                                              $src = "family_link_search.php?mode=F&Code=" . $varCode . "&Mode=" . isset($_GET['Mode']) . "&HCode=" . (isset($_GET['HCode']) ? $_GET['HCode'] : "" . "&HId=" . (isset($_GET['HId']) . "&stype=a"));
                                                              $ex = "&";
                                                              if (isset($_GET['Code']) != "") {
                                                                $src .= $ex . "Code=" . $_GET['Code'];
                                                              }
                                                              if (isset($_GET['Mode']) != "") {
                                                                $src .= $ex . "Mode=" . $_GET['Mode'];
                                                              }
                                                              if (isset($_GET['HCode']) != "") {
                                                                $src .= $ex . "HCode=" . $_GET['HCode'];
                                                              }
                                                              if (isset($_GET['HId']) != "") {
                                                                $src .= $ex . "HId=" . $_GET['HId'];
                                                              }
                                                              if (isset($_GET['FId']) != "") {
                                                                $src .= $ex . "FId=" . $_GET['FId'];
                                                              }

                                                              $url = "signup.php?actmode=D" . $src;


                                                              ?>
                                                              <td style="border:1px solid #eaeaea;" height="35" valign="top" bgcolor="#FFFFFF" class="text_user">
                                                                <?php
                                                                if (isset($_GET['Mode']) == "E") {
                                                                ?>
                                                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
                                                                    <tr>
                                                                      <td style="border-bottom:1px solid #eaeaea;" height="30" colspan="3" bgcolor="#FFFFFF"><strong>Link to:</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td width="16%" height="30" bgcolor="#FFFFFF">
                                                                        <div align="right"><strong>Father: </strong></div>
                                                                      </td>
                                                                      <td colspan="2" align="left" valign="middle" bgcolor="#FFFFFF" style="padding-left:10px; "> <?php echo isset($father_name) ? $father_name : ""; ?> &nbsp; </td>
                                                                    </tr>

                                                                    <tr id="td_link_husband">
                                                                      <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                                      <td width="66%" align="left" bgcolor="#FFFFFF" style="padding-left:10px; ">
                                                                        <select name="selSearchType1" id="selSearchType1">
                                                                          <option value="f"> Search in Family </option>
                                                                          <option value="a"> Search in Ancestor </option>
                                                                          <option value="vp"> Search in Vasti Patrak </option>
                                                                        </select>
                                                                      </td>
                                                                      <td width="9%" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> <a href="#" onclick="javascript:return doSub('F','<?php echo $varCode; ?>','<?php echo $_GET['Mode']; ?>','<?php echo isset($_GET['HCode']) ? $_GET['HCode'] : ""; ?>','<?php echo isset($_GET['HId']) ? $_GET['HId'] : ""; ?>','<?php echo isset($_GET['FId']) ? $_GET['FId'] : ""; ?>','selSearchType1','father_link');" rel="facebox" id="father_link">GO</a> </td>
                                                                    </tr>
                                                                    <?php
                                                                    if (isset($varGender) && $varGender != "Male" && ($vartxtMaritalName != 'Unmarried' && $vartxtMaritalName != '')) {
                                                                    ?>
                                                                      <tr>
                                                                        <td style="border-top:1px solid #eaeaea;" height="30" bgcolor="#FFFFFF">
                                                                          <div align="right"><strong> Husband: </strong></div>
                                                                        </td>
                                                                        <td colspan="2" align="left" bgcolor="#FFFFFF" style="padding-left:10px;border-top:1px solid #eaeaea; "> <?php echo $husband_name; ?> &nbsp;</td>
                                                                      </tr>
                                                                      <tr>
                                                                        <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                                        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px; ">
                                                                          <select name="selSearchType2" id="selSearchType2">
                                                                            <option value="f"> Search in Family </option>
                                                                            <option value="a"> Search in Ancestor </option>
                                                                            <option value="vp"> Search in Vasti Patrak </option>
                                                                          </select>
                                                                        </td>
                                                                        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px; "> <a href="#" onclick="javascript:return doSub('H','<?php echo $varCode; ?>','<?php echo $_GET['Mode']; ?>','<?php echo $_GET['HCode']; ?>','<?php echo isset($_GET['HId']) ? $_GET['HId'] : ""; ?>','<?php echo isset($_GET['FId']) ? $_GET['FId'] : ""; ?>','selSearchType2','husband_link');" rel="facebox" id="husband_link">GO</a> </td>
                                                                      </tr>
                                                                    <?php } ?>
                                                                  </table>
                                                                <?php } ?>
                                                              </td>

                                                            </tr>
                                                            <tr id="tr_gender" bgcolor="#FFFFFF" class="text">
                                                              <td class="text_user" style="padding-left:5px; font-weight: bold;">Gender<strong><span class="click">*</span> </strong></td>
                                                              <td height="35" colspan="3" class="text_user"><span class="text2">
                                                                  <input type="radio" id="Gender " name="gender_c" <?php echo isset($varGender) && $varGender == "Male" ? "checked" : ""; ?> tabindex="8" value="Male" />
                                                                </span>Male<span class="text2">
                                                                  <input type="radio" id="Gender " name="gender_c" <?php echo isset($varGender) && $varGender == "Female" ? "checked" : ""; ?> tabindex="9" value="Female" />
                                                                </span>Female </td>
                                                            </tr>
                                                            <tr id="tr_addr" bgcolor="#FFFFFF" class="text">
                                                              <td width="14%" height="35" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Address<strong><span class="click">*</span> </strong></strong></td>
                                                              <td height="35" colspan="3" class="text_user">
                                                                <table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                                                  <tr>
                                                                    <td width="21%">
                                                                      <div align="right">Line1</div>
                                                                    </td>
                                                                    <td width="2%">&nbsp;</td>
                                                                    <td width="77%" height="30"><input name="addr1" type="text" class="txtbox1" id="addr1" tabindex="10" value="<?php echo isset($vartxtaddr1) ? $vartxtaddr1 : ""; ?>" size="30" /></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>
                                                                      <div align="right">Line2</div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="30"><input name="addr2" type="text" class="txtbox1" id="addr2" tabindex="11" value="<?php echo isset($vartxtaddr2) ? $vartxtaddr2 : ""; ?>" size="30" /></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>
                                                                      <div align="right">Line3</div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="30"><input name="addr3" type="text" class="txtbox1" id="addr3" tabindex="12" value="<?php echo isset($vartxtaddr3) ? $vartxtaddr3 : ""; ?>" size="30" /></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>
                                                                      <div align="right">Country</div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="30">
                                                                      <select name="country" class="txtbox1" id="country" tabindex="13" onchange="getState(this.value,'<?= $vartxtstate ?>');">
                                                                        <option value="" selected="selected"> Select Country </option>
                                                                        <?php
                                                                        // while($country= mysqli_fetch_array($chk_country))
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
                                                                    <td class="text" height="30" align="right"><strong>State</strong></td>
                                                                    <td class="text" align="right">&nbsp;</td>
                                                                    <td class="text"><select name="state" class="txtbox1" id="state" tabindex="13" <?php echo isset($vartxtstate) ? $vartxtstate : ""; ?> onchange="getState(this.value);">
                                                                        <option value="" selected="selected"> Select State </option>
                                                                        <?php
                                                                        // while($vartxtstate= mysqli_fetch_array($chk_State))
                                                                        foreach ($state as $vartxtstate1) {
                                                                        ?>
                                                                          <option value="<?php echo $vartxtstate1['state_id']; ?>" <?= ($vartxtstate1['state_id'] == $vartxtstate) ? "selected" : "" ?>> <?php echo ucwords(strtolower($vartxtstate1['state_name'])); ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                      </select></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td class="text" height="30" align="right"><strong>Location</strong></td>
                                                                    <td class="text" align="right">&nbsp;</td>

                                                                    <td class="text"><select name="city" class="txtbox1" id="City" tabindex="14" <?php echo isset($vartxtcity) ? $vartxtcity : ""; ?> onchange="getState(this.value);">
                                                                        <option value="" selected="selected"> Select Location </option>
                                                                        <?php
                                                                        // while($vartxtcity= mysqli_fetch_array($chk_city))
                                                                        foreach ($city as $vartxtcity1) {
                                                                        ?>
                                                                          <option value="<?php echo $vartxtcity1['city_id']; ?>" <?= ($vartxtcity1['city_id'] == $vartxtcity) ? "selected" : "" ?>> <?php echo ucwords(strtolower($vartxtcity1['city_name'])); ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                      </select></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>
                                                                      <div align="right">Pincode</div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="30">
                                                                      <input name="pincode" type="text" class="txtbox1" id="pincode" tabindex="17" value="<?php echo isset($vartxtpincode) ? $vartxtpincode : ""; ?>" size="20" />
                                                                      (Eg. 380001, 400036, 42223)
                                                                    </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>&nbsp;</td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="30">&nbsp;</td>
                                                                  </tr>
                                                                </table>



                                                              </td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text">
                                                              <td width="14%" height="35" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Marital Status<strong><span class="click">*</span> </strong></strong></td>
                                                              <td height="35" colspan="3" class="text_user"><select name="marital_id" tabindex="18" id="Marital Status" class="txtrequiredsel txtbox">
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
                                                                </select></td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text">
                                                              <td width="14%" height="35" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Date<strong><span class="click">*</span> </strong> </td>
                                                              <td height="35" colspan="3" class="text"><input type="text" name="birth_date" id="Birth Date " tabindex="19" value="<?php echo isset($vartxtDate) ? $vartxtDate : ""; ?>" class="txtreqd" />
                                                                &nbsp; <img src="images/calendar_icon.png" width="15" height="20" onclick='scwShow(document.getElementById("Birth Date "),event);' style="cursor:pointer;"> (Enter in YYYY-MM-DD format, eg. 1986-12-30)</td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text">
                                                              <td width="14%" height="35" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px; font-weight: bold;">Blood Group<strong></strong></td>
                                                              <td height="35" colspan="3" class="text_user"><select name="blood_group" tabindex="20" class="txtbox1">
                                                                  <option value="0" selected="selected">Please Select</option>
                                                                  <option value="A +ve" <?php echo isset($vartxtBloodgroup) == "A +ve" ? "selected" : ""; ?>> A +ve </option>
                                                                  <option value="A -ve" <?php echo isset($vartxtBloodgroup) == "A -ve" ? "selected" : ""; ?>> A -ve </option>
                                                                  <option value="B +ve" <?php echo isset($vartxtBloodgroup) == "B +ve" ? "selected" : ""; ?>> B +ve </option>
                                                                  <option value="B -ve" <?php echo isset($vartxtBloodgroup) == "B -ve" ? "selected" : ""; ?>> B -ve </option>
                                                                  <option value="O +ve" <?php echo isset($vartxtBloodgroup) == "O +ve" ? "selected" : ""; ?>> O +ve </option>
                                                                  <option value="O -ve" <?php echo isset($vartxtBloodgroup) == "O -ve" ? "selected" : ""; ?>> O -ve </option>
                                                                  <option value="AB +ve" <?php echo isset($vartxtBloodgroup) == "AB +ve" ? "selected" : ""; ?>> AB +ve </option>
                                                                  <option value="AB -ve" <?php echo isset($vartxtBloodgroup) == "AB -ve" ? "selected" : ""; ?>> AB -ve </option>
                                                                </select></td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text">
                                                              <td width="14%" height="35" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px; font-weight: bold;">Education</td>
                                                              <td height="35" colspan="3" valign="top" class="sublink">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr valign="top">
                                                                    <td width="37%">
                                                                      <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                          <td width="47%">
                                                                            <div align="right" class="text">Basic/Graduation</div>
                                                                          </td>
                                                                          <td width="1%">&nbsp;</td>
                                                                          <td width="49%"><span class="text">
                                                                              <select name="basic_qual" id="basic_qual" tabindex="21" class="txtbox1" onchange="getDet(this.value,'bq_det','bq_det');">
                                                                                <option value="0"> Not Specified </option>
                                                                                <?php
                                                                                while ($edu_det1 = mysqli_fetch_array($chk_edu_det1)) {
                                                                                  if ($vartxtbasic_qual == $edu_det1['education_id']) {
                                                                                ?>
                                                                                    <option value="<?php echo $edu_det1['education_id']; ?>" selected="selected"> <?php echo $edu_det1['education_name']; ?></option>
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
                                                                              <select name="pg_qual" id="pg_qual" tabindex="22" class="txtbox1" onchange="getDet(this.value,'pg_det','pg_det');">
                                                                                <option value="0"> Not Specified </option>
                                                                                <?php
                                                                                while ($edu_det2 = mysqli_fetch_array($chk_edu_det2)) {
                                                                                  if ($vartxtpg_qual == $edu_det2['education_id']) {
                                                                                ?>
                                                                                    <option value="<?php echo $edu_det2['education_id']; ?>" selected="selected"> <?php echo $edu_det2['education_name']; ?></option>
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
                                                                              <select name="doc_qual" id="doc_qual" tabindex="23" class="txtbox1" onchange="getDet(this.value,'doc_det','doc_det');">
                                                                                <option value="0"> Not Specified </option>
                                                                                <?php
                                                                                while ($edu_det3 = mysqli_fetch_array($chk_edu_det3)) {
                                                                                  if ($vartxtdoc_qual == $edu_det3['education_id']) {
                                                                                ?>
                                                                                    <option value="<?php echo $edu_det3['education_id']; ?>" selected="selected"> <?php echo $edu_det3['education_name']; ?></option>
                                                                                  <?php } else { ?>
                                                                                    <option value="<?php echo $edu_det3['education_id']; ?>"> <?php echo $edu_det3['education_name']; ?></option>
                                                                                <?php }
                                                                                } ?>
                                                                              </select>
                                                                            </span></td>
                                                                        </tr>
                                                                      </table>
                                                                    </td>
                                                                    <td width="63%">
                                                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                          <td><input name="bq_det" type="text" class="txtbox1" id="bq_det" tabindex="21" style="display:none;" value="<?php echo isset($vartxtbq_det) ? $vartxtbq_det : ""; ?>" size="30" />
                                                                            &nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td><input name="pg_det" type="text" class="txtbox1" id="pg_det" tabindex="24" style="display:none;" value="<?php echo isset($vartxtpg_det) ? $vartxtpg_det : ""; ?>" size="30" />
                                                                            &nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td><input name="doc_det" type="text" class="txtbox1" id="doc_det" tabindex="25" style="display:none;" value="<?php echo isset($vartxtdoc_det) ? $vartxtdoc_det : ""; ?>" size="30" />
                                                                            &nbsp;</td>
                                                                        </tr>
                                                                      </table>
                                                                    </td>
                                                                  </tr>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text">
                                                              <td height="35" valign="top" class="text_user" style="padding-left:5px; font-weight: bold;">Image<strong></strong></td>
                                                              <td height="35" valign="top" class="sublink"> <span class="text">
                                                                  <input type="file" name="thumb_image" id="thumb_image" size="30" class="text" tabindex="24" />
                                                                </span></td>
                                                            </tr>
                                                            <!--<tr bgcolor="#FFFFFF" class="text">
                                                    <td height="35" class="text_user" style="padding-left:5px; font-weight: bold;">Attachment</td>
                                                    <td height="35" valign="top" class="sublink"> <span class="text">
                                                      <input type="file" name="attachment" id="attachment" size="30" class="text" tabindex="24" />
                                                    </span></td>
                                                    <td height="35" colspan="2" valign="top" class="sublink">&nbsp;
														
												,                         	</td>
                                                    </tr>
                                                  -->
                                                          </table>
                                                        </td>
                                                      </tr>
                                                      <tr bgcolor="#f2f2f2">
                                                        <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                        <td colspan="2" align="left" valign="middle" bgcolor="#ffffff">&nbsp;</td>
                                                      </tr>
                                                      <tr bgcolor="#f2f2f2">
                                                        <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                        <td colspan="2" align="left" valign="middle" bgcolor="#ffffff">
                                                          <table width="98%" border="0" cellspacing="0" bgcolor="#fbfbfb">
                                                            <tr class="text">
                                                              <td height="30" colspan="6" class="text_user" style="padding-left:5px;"><span class="text4_user">Communication Details</span></td>
                                                            </tr>
                                                            <tr valign="top">
                                                              <td height="8" colspan="6" class="text"></td>
                                                            </tr>
                                                            <?php
                                                            if (empty($_GET['HCode'])) {
                                                            ?>
                                                              <tr valign="top">
                                                                <td height="25" class="text">
                                                                  <div align="right" class="style1"><strong>Phone Number(L.L.)</strong></div>
                                                                </td>
                                                                <td height="25" colspan="5" class="sublink"><input name="code_phone_number" type="text" class="txtbox1" tabindex="25" value="<?php echo isset($vartxtcode_phone_number) ? $vartxtcode_phone_number : ""; ?>" size="08">&nbsp;
                                                                  <input name="phone_number" type="text" class="txtbox1" tabindex="26" value="<?php echo isset($vartxtphone_number) ? $vartxtphone_number : ""; ?>" size="50" />
                                                                </td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="8" class="style1 text"></td>
                                                                <td height="8" colspan="5" class="sublink"></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="25" class="text">
                                                                  <div align="right" class="style1"><strong>Alternate Number</strong></div>
                                                                </td>
                                                                <td height="25" colspan="5" class="sublink">
                                                                  <input name="code_alt_number" type="text" class="txtbox1" tabindex="27" value="<?php echo isset($vartxtcode_alt_number) ? $vartxtcode_alt_number : ""; ?>" size="08" />&nbsp;
                                                                  <input name="alt_number" type="text" class="txtbox1" tabindex="28" value="<?php echo isset($vartxtalt_number) ? $vartxtalt_number : ""; ?>" size="50" />
                                                                </td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="8" class="style1 text"></td>
                                                                <td height="8" colspan="5" class="sublink"></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="25" class="text">
                                                                  <div align="right" class="style1"><strong>Mobile(Home)</strong></div>
                                                                </td>
                                                                <td height="25" colspan="5" class="sublink">
                                                                  <input name="mobile_home" type="text" class="txtbox1" class="Number-only" tabindex="29" value="<?php echo isset($vartxtmobile_home) ? $vartxtmobile_home : ""; ?>" size="50">
                                                                </td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="25" class="text">
                                                                  <div align="right" class="style1"><strong>Alternate Mobile</strong></div>
                                                                </td>
                                                                <td height="25" colspan="5" class="sublink"><input name="alt_mobile" type="text" class="txtbox1" tabindex="30" value="<?php echo isset($vartxtalt_mobile) ? $vartxtalt_mobile : ""; ?>" size="50" /></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="8" class="style1 text"></td>
                                                                <td height="8" colspan="5" class="sublink"></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="25" class="text">
                                                                  <div align="right" class="style1"><strong>Email-Id</strong></div>
                                                                </td>
                                                                <td height="25" colspan="5" class="sublink"><input name="email" type="text" class="txtbox1" tabindex="31" value="<?php echo isset($vartxtEmail) ? $vartxtEmail : ""; ?>" size="50" /></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="8" class="style1 text"></td>
                                                                <td height="8" colspan="5" class="sublink"></td>
                                                              </tr>
                                                            <?php } else { ?>
                                                              <tr valign="top">
                                                                <td height="25" class="text">
                                                                  <div align="right" class="style1"><strong>Mobile(Home)</strong></div>
                                                                </td>
                                                                <td height="25" colspan="5" class="sublink">
                                                                  <input name="mobile_home" type="text" class="txtbox1" class="Number-only" tabindex="29" value="<?php echo isset($vartxtmobile_home) ? $vartxtmobile_home : ""; ?>" size="50">
                                                                </td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="8" class="style1 text"></td>
                                                                <td height="8" colspan="5" class="sublink"></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="25" class="text">
                                                                  <div align="right" class="style1"><strong>Alternate Mobile </strong></div>
                                                                </td>
                                                                <td height="25" colspan="5" class="sublink">
                                                                  <input name="alt_mobile" type="text" class="txtbox1" tabindex="33" value="<?php echo isset($vartxtalt_mobile) ? $vartxtalt_mobile : ""; ?>" size="50" />
                                                                </td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="8" class="style1 text"></td>
                                                                <td height="8" colspan="5" class="sublink"></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="25" class="text">
                                                                  <div align="right" class="style1"><strong>Email-Id</strong></div>
                                                                </td>
                                                                <td height="25" colspan="5" class="sublink"><input name="email" type="text" class="txtbox1" tabindex="34" value="<?php echo isset($vartxtEmail) ? $vartxtEmail : ""; ?>" size="50" /></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td height="8" class="text"></td>
                                                                <td height="8" colspan="5" class="sublink"></td>
                                                              </tr>
                                                            <?php } ?>
                                                            <tr class="text">
                                                              <td height="30" colspan="6" class="text_user" style="padding-left:5px;">&nbsp;</td>
                                                            </tr>
                                                            <tr class="text">
                                                              <td height="30" colspan="6" class="text_user" style="padding-left:5px;"><span class="text4_user">Professional Details</span></td>
                                                            </tr>
                                                            <tr class="text">
                                                              <td colspan="6" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text">
                                                              <td width="15%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                <div align="right"><strong>Type</strong></div>
                                                              </td>
                                                              <td width="84%" colspan="5" class="text_user"><span class="sublink">
                                                                  <select name="prof_type" onchange="showhideDiv(this.value)" tabindex="35">
                                                                    <option value="" <?php echo (isset($prof_type) == "") ? "selected" : ""; ?>> Not specified </option>
                                                                    <option value="H" <?php echo (isset($prof_type) == "H") ? "selected" : ""; ?>> House Wife </option>
                                                                    <option value="S" <?php echo (isset($prof_type) == "S") ? "selected" : ""; ?>> Student </option>
                                                                    <option value="B" <?php echo (isset($prof_type) == "B") ? "selected" : ""; ?>> Business </option>
                                                                    <option value="P" <?php echo (isset($prof_type) == "P") ? "selected" : ""; ?>> Professional </option>
                                                                    <option value="J" <?php echo (isset($prof_type) == "J") ? "selected" : ""; ?>> Job </option>
                                                                    <option value="R" <?php echo (isset($prof_type) == "R") ? "selected" : ""; ?>> Retire </option>
                                                                  </select>
                                                                </span></td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text" id="trbusiness" style="display:none;">
                                                              <td height="30" colspan="6" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td width="14%" height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Business Category</strong></div>
                                                                    </td>
                                                                    <td width="1%">&nbsp;</td>
                                                                    <td width="85%" height="25"><span class="sublink">
                                                                        <select name="bness_cat_id" tabindex="36">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($cat = mysqli_fetch_array($check_cat)) {
                                                                            if ($bness_cat_id == $cat['sub_id']) {
                                                                          ?>
                                                                              <option value="<?php echo $cat['sub_id']; ?>" selected="selected"> <?php echo $cat['group_name']; ?> </option>
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
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Industry</strong></div>
                                                                    </td>
                                                                    <td id="tdsubcat">&nbsp;</td>
                                                                    <td height="25" id="tdsubcat"><span class="sublink">
                                                                        <select name="bness_subcat_id" tabindex="37">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($ind = mysqli_fetch_array($check_ind)) {
                                                                            if ($bness_subcat_id == $ind['ind_id']) {
                                                                          ?>
                                                                              <option value="<?php echo $ind['ind_id']; ?>" selected="selected"> <?php echo $ind['ind_value']; ?> </option>
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
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Business Name </strong></div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="25"><span class="sublink">
                                                                        <input name="bness_name" type="text" class="txtbox1" tabindex="38" value="<?php echo isset($bness_name) ? $bness_name : ""; ?>" size="50" />
                                                                      </span></td>
                                                                  </tr>
                                                                  <!--<tr>
                                    <td height="22" valign="top" class="text"><div align="right">Business Address</div></td>
                                    <td height="22" valign="top"><div align="center">:</div></td>
                                    <td height="22"><span class="sublink">
                                      <textarea name="bness_addr" cols="30" rows="5" class="txtbox1" tabindex="31"><?php echo isset($bness_addr) ? $bness_addr : ""; ?></textarea>
                                    </span></td>
                                  </tr>-->
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Phone No</strong></div>
                                                                    </td>
                                                                    <td class="text">&nbsp;</td>
                                                                    <td height="25" class="text">
                                                                      <input name="bness_phone" type="text" class="txtbox1" tabindex="39" value="<?php echo isset($bness_phone) ? $bness_phone : ""; ?>" size="40" />
                                                                      (Multiple nos seperated by comma[,])
                                                                    </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Mobile No. </strong></div>
                                                                    </td>
                                                                    <td class="text">&nbsp;</td>
                                                                    <td height="25" class="text"><span class="sublink">
                                                                        <input name="bness_mobile" type="text" class="txtbox1" tabindex="40" value="<?php echo isset($bness_mobile) ? $bness_mobile : ""; ?>" size="40" />
                                                                        (Multiple nos seperated by comma[,]) </span></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Description</strong></div>
                                                                    </td>
                                                                    <td class="text">&nbsp;</td>
                                                                    <td height="25" class="text"><span class="sublink">
                                                                        <textarea name="bness_desc" cols="40" rows="7" class="txtbox1" tabindex="41"><?php echo isset($bness_desc) ? $bness_desc : ""; ?></textarea>
                                                                      </span></td>
                                                                  </tr>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text" id="trprof" style="display:none;">
                                                              <td height="30" colspan="6" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td width="14%" height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Profession Name</strong></div>
                                                                    </td>
                                                                    <td width="1%">&nbsp;</td>
                                                                    <td width="85%" height="25">
                                                                      <span class="sublink">
                                                                        <select name="prof_cat_id" tabindex="42" onchange="getSubCat(this.value,'','prof_subcat_id','tdprofcat');">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($prof = mysqli_fetch_array($check_cat1)) {
                                                                            if ($prof_cat_id == $prof['sub_id']) {
                                                                          ?>
                                                                              <option value="<?php echo $prof['sub_id']; ?>" selected="selected"> <?php echo $prof['group_name']; ?> </option>
                                                                            <?php   } else { ?>
                                                                              <option value="<?php echo $prof['sub_id']; ?>"> <?php echo $prof['group_name']; ?> </option>
                                                                          <?php
                                                                            }
                                                                          }
                                                                          ?>
                                                                        </select>
                                                                      </span>
                                                                    </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Specialization</strong></div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="25" id="tdprofcat"></td>
                                                                  </tr>
                                                                  <!--<tr>
                                <td height="10" valign="top" class="text"><div align="right">Office Address</div></td>
                                <td height="25" valign="top"><div align="center">:</div></td>
                                <td height="25"><span class="sublink">
                                  <textarea name="prof_addr" cols="30" rows="5" class="txtbox1" tabindex="37"><?php echo ($prof_addr); ?></textarea>
                                </span></td>
                              </tr> -->
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Phone No</strong></div>
                                                                    </td>
                                                                    <td class="text">&nbsp;</td>
                                                                    <td height="25" class="text">
                                                                      <input name="prof_phone" type="text" class="txtbox1" tabindex="43" value="<?php echo isset($prof_phone) ? $prof_phone : ""; ?>" size="40" />
                                                                      (Multiple nos seperated by comma[,])
                                                                    </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Mobile No. </strong></div>
                                                                    </td>
                                                                    <td class="text">&nbsp;</td>
                                                                    <td height="25" class="text"><span class="sublink">
                                                                        <input name="prof_mobile" type="text" class="txtbox1" tabindex="44" value="<?php echo isset($prof_mobile) ? $prof_mobile : ""; ?>" size="40" />
                                                                        (Multiple nos seperated by comma[,]) </span></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Description</strong></div>
                                                                    </td>
                                                                    <td class="text">&nbsp;</td>
                                                                    <td height="25" class="text"><span class="sublink">
                                                                        <textarea name="prof_desc" cols="40" rows="7" class="txtbox1" tabindex="45"><?php echo isset($prof_desc) ? $prof_desc : ""; ?></textarea>
                                                                      </span></td>
                                                                  </tr>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text" id="trjob" style="display:none;">
                                                              <td height="30" colspan="6" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Job Type </strong></div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="25"><span class="sublink">
                                                                        <select name="job_type" tabindex="46">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($jobtype = mysqli_fetch_array($check_jobtype)) {
                                                                            if ($job_type == $jobtype['sub_id']) {
                                                                          ?>
                                                                              <option value="<?php echo $jobtype['sub_id']; ?>" selected="selected"> <?php echo $jobtype['group_name']; ?> </option>
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
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Industry</strong></div>
                                                                    </td>
                                                                    <td id="tdsubcat">&nbsp;</td>
                                                                    <td height="25" id="tdsubcat"><span class="sublink">
                                                                        <select name="job_ind_id" tabindex="47">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($j_ind = mysqli_fetch_array($check_ind_job)) {
                                                                            if ($job_ind_id == $j_ind['ind_id']) {
                                                                          ?>
                                                                              <option value="<?php echo $j_ind['ind_id']; ?>" selected="selected"> <?php echo $j_ind['ind_value']; ?> </option>
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
                                                                    <td width="14%" height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Company Name</strong></div>
                                                                    </td>
                                                                    <td width="1%">&nbsp;</td>
                                                                    <td width="85%" height="25"><span class="sublink">
                                                                        <input name="comp_name" type="text" class="txtbox1" tabindex="48" value="<?php echo isset($comp_name) ? $comp_name : ""; ?>" size="50" />
                                                                      </span></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Designation</strong></div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="25"><span class="sublink">
                                                                        <input name="job_desig" type="text" class="txtbox1" tabindex="49" value="<?php echo isset($job_desig) ? $job_desig : ""; ?>" size="50" />
                                                                      </span></td>
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
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Phone No</strong></div>
                                                                    </td>
                                                                    <td class="text">&nbsp;</td>
                                                                    <td height="25" class="text">
                                                                      <input name="job_phone" type="text" class="txtbox1" tabindex="50" value="<?php echo isset($job_phone) ? $job_phone : ""; ?>" size="40" />
                                                                      (Multiple nos seperated by comma[,])
                                                                    </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="style1"><strong>Mobile No. </strong></div>
                                                                    </td>
                                                                    <td class="text">&nbsp;</td>
                                                                    <td height="25" class="text"><span class="sublink">
                                                                        <input name="job_mobile" type="text" class="txtbox1" tabindex="51" value="<?php echo isset($job_mobile) ? $job_mobile : ""; ?>" size="40" />
                                                                        (Multiple nos seperated by comma[,]) </span></td>
                                                                  </tr>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                            <tr valign="top" id="tdaddr">
                                                              <td height="25" class="text">
                                                                <div align="right" class="style1"><strong>Address</strong></div>
                                                              </td>
                                                              <td height="25" colspan="5" class="sublink">
                                                                <table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                                                  <tr>
                                                                    <td width="9%">
                                                                      <div align="right">Line1</div>
                                                                    </td>
                                                                    <td width="2%">&nbsp;</td>
                                                                    <td width="89%"><input name="job_addr1" type="text" class="txtbox1" id="job_addr1" tabindex="52" value="<?php echo isset($vartxtjobaddr1) ? $vartxtjobaddr1 : ""; ?>" size="30" /></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>
                                                                      <div align="right">Line2</div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="job_addr2" type="text" class="txtbox1" id="job_addr2" tabindex="53" value="<?php echo isset($vartxtjobaddr2) ? $vartxtjobaddr2 : "" ?>" size="30" /></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>
                                                                      <div align="right">Line3</div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="job_addr3" type="text" class="txtbox1" id="job_addr3" tabindex="54" value="<?php echo isset($vartxtjobaddr3) ? $vartxtjobaddr3 : ""; ?>" size="30" /></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>
                                                                      <div align="right">Country</div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="30">
                                                                      <select name="job_country" class="txtbox1" id="country" tabindex="55" <?php echo ($vartxtcountry); ?> onchange="getState(this.value);">
                                                                        <option value="" selected="selected"> Select Country </option>
                                                                        <?php
                                                                        // while($country= mysqli_fetch_array($chk_country))
                                                                        foreach ($country as $vartxtcountry1) {
                                                                        ?>
                                                                          <option value="<?php echo $vartxtcountry1['country_id']; ?>" <?= ($vartxtcountry1['country_id'] == $vartxtjobcountry) ? "selected" : "" ?>><?php echo $vartxtcountry1['country_name']; ?> </option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                      </select>
                                                                    </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td class="text" height="30" align="right"><strong>State</strong></td>
                                                                    <td class="text" align="right">&nbsp;</td>

                                                                    <td class="text"><select name="job_state" class="txtbox1" id="state" tabindex="56" onchange="getCity(this.value);">
                                                                        <option value="" selected="selected"> Select State </option>
                                                                        <?php
                                                                        // while($vartxtstate= mysqli_fetch_array($chk_State))
                                                                        foreach ($state as $vartxtstate1) {
                                                                        ?>
                                                                          <option value="<?php echo $vartxtstate1['state_id']; ?>" <?= ($vartxtstate1['state_id'] == $vartxtjobstate) ? "selected" : "" ?>> <?php echo ucwords(strtolower($vartxtstate1['state_name'])); ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                      </select></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td class="text" height="30" align="right"><strong>Location</strong></td>
                                                                    <td class="text" align="right">&nbsp;</td>

                                                                    <td class="text"><select name="job_city" class="txtbox1" id="City" tabindex="57">
                                                                        <option value="" selected="selected"> Select Location </option>
                                                                        <?php
                                                                        // while($vartxtcity= mysqli_fetch_array($chk_city))
                                                                        foreach ($city as $vartxtcity1) {
                                                                        ?>
                                                                          <option value="<?php echo $vartxtcity1['city_id']; ?>" <?= ($vartxtcity1['city_id'] == $vartxtjobcity) ? "selected" : "" ?>> <?php echo ucwords(strtolower($vartxtcity1['city_name'])); ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                      </select></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>
                                                                      <div align="right">District</div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="job_district" type="text" class="txtbox1" id="job_district" tabindex="58" value="<?php echo isset($vartxtjobdistrict) ? $vartxtjobdistrict : ""; ?>" size="30" /></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>
                                                                      <div align="right">Pincode</div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="job_pincode" type="text" class="txtbox1" id="job_pincode" tabindex="59" value="<?php echo isset($vartxtjobpincode) ? $vartxtjobpincode : ""; ?>" size="20" /></td>
                                                                  </tr>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                      <tr bgcolor="#f2f2f2">
                                                        <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                        <td width="45%" align="left" valign="middle" bgcolor="#ffffff">
                                                          <div align="center">
                                                            <input name="submit1" type="submit" tabindex="60" value="Submit" onClick="javascript:return checkFormElements1(this.form);" width="71" height="24" border="0" />
                                                          </div>
                                                        </td>
                                                        <td width="53%" align="left" valign="middle" bgcolor="#ffffff">&nbsp;</td>
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
                                  <tr>
                                    <td colspan="4">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="4">&nbsp;</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td height="10"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td height="38" align="center" valign="middle" bgcolor="#834153">
              <table width="96%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left" valign="middle" class="footer">All Rights Reserved By : Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti</td>
                  <td align="right" valign="middle" class="footer">Website Designed By :<a href="https://apolloinfotech.com" target="_blank"> Apollo Infotech</a></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td align="center" valign="top">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <script language="javascript">
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

    var jobcountrycode = "<?php echo $vartxtjobcountry; ?>";

    var jobstatecode = "<?php echo $vartxtjobstate; ?>";
    getJobState(jobcountrycode, jobstatecode);

    var jobcitycode = "<?php echo $vartxtjobcity; ?>";
    getJobCity(jobstatecode, jobcitycode);

    getDet("<?php echo $vartxtbasic_qual; ?>", 'bq_det', 'bq_det');

    getDet("<?php echo $vartxtpg_qual; ?>", 'pg_det', 'pg_det');

    getDet("<?php echo $vartxtdoc_qual; ?>", 'doc_det', 'doc_det');


    var d = "<?php echo $_GET['HCode']; ?>";
    if (d != "") {
      document.getElementById("tr_native").style.display = "";
      document.getElementById("tr_gotra").style.display = "";
      document.getElementById("tr_mname").style.display = "";
      document.getElementById("tr_lname").style.display = "";
      document.getElementById("tr_addr").style.display = "";
      document.getElementById("tr_formno").style.display = "";
      document.getElementById("tdfname_label").style.display = "";

      document.getElementById("parent_id").value = d;

    }

    //getDet("<?php echo $vartxtedu_cat; ?>");
  </script>
  <script>
    function showadvert() {
      var obj = document.getElementById("advtid");
      obj.style.display = "block";
    }

    window.onload = showadvert;
  </script>

</body>


</html>