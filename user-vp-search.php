<?php
include_once "noentry.php";
include_once "admin/connection/conn.php";

// Query for Country//
$sql_country = "SELECT * FROM country_m where country_id != 10 order by country_name";
$chk_country = mysqli_query($cn, $sql_country);

// Query for State//
$sql_state = "SELECT * FROM state_m where country_id=10 order by state_name";
$chk_state = mysqli_query($cn, $sql_state);


// Query for State//
$sql_city = "SELECT * FROM city_m where country_id=10 order by city_name";
$chk_city = mysqli_query($cn, $sql_city);
$tmp_city = mysqli_fetch_array($chk_city);

// Query for Blood Group//
$sql_bloodgroup = "select * FROM bloodgroup_m ";
$chk_bg = mysqli_query($cn, $sql_bloodgroup);

// Query for Village data //
$sql_vill = "select * from village_m order by village_name";
$chk_vill = mysqli_query($cn, $sql_vill);

// Query for Village gotra //
$sql_gotra = "select * from gotra_m order by gotra_name";
$chk_gotra = mysqli_query($cn, $sql_gotra);

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

$sql_string = "SELECT * FROM education_m where edu_level='Basic/Grad.' order by education_name";
$chk_edu_det1 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='PG' order by education_name";
$chk_edu_det2 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

$sql_string = "SELECT * FROM education_m where edu_level='Doctrate' order by education_name";
$chk_edu_det3 = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

if (isset($_GET['mode']) == "Dir")
  $action = "user-dirsearch-result.php?dirid=" . $_GET['dirid'] . "&dirnm=" . $_GET['dirnm'];
else
  $action = "user-vastipatrak-result.php";

// Query for Marital Status //
$sql_maritalst = "select * from marital_m order by marital_id";
$chk_maritalst = mysqli_query($cn, $sql_maritalst);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
  <link href="css/styles.css" rel="stylesheet" type="text/css" />
  <style type="text/css">    

    input[type=submit], input[type=reset] {
    background-color:#9C1212;    
    color: white;
    padding: 5px;
    
  }
  </style>
  <script language="javascript" type="text/javascript">
    function showhideFields(val) {
      if (val == 'IS') {
        document.getElementById("prof_det").style.display = "";
        document.getElementById("extra_det").style.display = "";
      } else {
        document.getElementById("prof_det").style.display = "none";
        document.getElementById("extra_det").style.display = "none";
      }
    }

    function showhideDiv(val) {
      if (val == "" || val == "U") {
        document.getElementById("trbusiness").style.display = "none";
        document.getElementById("trprof").style.display = "none";
        document.getElementById("trjob").style.display = "none";
      }
      if (val == "B") {
        document.getElementById("trbusiness").style.display = "";
        document.getElementById("trprof").style.display = "none";
        document.getElementById("trjob").style.display = "none";
      }
      if (val == "P") {
        document.getElementById("trbusiness").style.display = "none";
        document.getElementById("trprof").style.display = "";
        document.getElementById("trjob").style.display = "none";
      }
      if (val == "J") {
        document.getElementById("trbusiness").style.display = "none";
        document.getElementById("trprof").style.display = "none";
        document.getElementById("trjob").style.display = "";
      }
    }
  </script>
  <script type="text/javascript" src="js/ajax.js"></script>
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

<body>
  <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" valign="top" bgcolor="#ffffff">
        <table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" valign="top" background="images/top_bg.jpg" style="background-position:top; background-repeat:no-repeat;">
              <table width="500" border="0" cellspacing="0" cellpadding="0">

                <tr>
                  <td height="99" align="left" valign="top"><a href="index.php"><img src="images/spacer.gif" alt="" width="484" height="99" /></a></td>
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
            <?php include_once "menu.php"; ?>
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
                              <td align="left" class="border1">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td>
                                      <table width="98%" border="0" cellspacing="0" cellpadding="0">
                                        <tr bgcolor="#FFFFFF">
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <?php
                                        if (isset($_GET['dirid']) != "")
                                          $title_disp = "Member Search for Directory '" . $_GET['dirnm'] . "'";
                                        else
                                          $title_disp = "VASTIPATRAK SEARCH";
                                        ?>
                                        <tr bgcolor="#f2f2f2">
                                          <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                          <td width="67%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;"><?php echo $title_disp; ?></td>
                                          <td width="31%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;"></td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr bgcolor="#f2f2f2">
                                          <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                          <td align="left" valign="middle" bgcolor="#ffffff">
                                            <form name="frmSearch" method="post" action="<?php echo $action; ?>">
                                              <table width="98%" border="0" cellspacing="0" cellpadding="0">
                                                <tr bgcolor="#fbfbfb" class="text">
                                                  <td height="20" colspan="3" class="text_user" style="padding-left:5px; font-weight: bold;">Personal Details</td>
                                                </tr>
                                                <tr bgcolor="#fbfbfb" class="text">
                                                  <td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                                </tr>
                                                <tr class="text4_user">
                                                  <td height="30" colspan="3" class="text4_user">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr>
                                                        <td width="70%" valign="top" style="padding-top:10px;">
                                                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr class="text4_user">
                                                              <td height="30" class="text4_user">
                                                                <div align="right" class="text style3">Search By</div>
                                                              </td>
                                                              <td class="text4_user">&nbsp;</td>
                                                              <td width="62%" class="text4_user">
                                                                <select name="selSearchType" onchange="showhideFields(this.value)">
                                                                  <option value="HOF" <?php echo (isset($_SESSION['selSearchType']) == "HOF") ? "selected" : ""; ?>> Head of Family </option>
                                                                  <option value="IS" <?php echo (isset($_SESSION['selSearchType']) == "IS") ? "selected" : ""; ?>> Search All </option>
                                                                </select>
                                                              </td>
                                                            </tr>
                                                            <tr class="text4_user">
                                                              <td height="30" class="text4_user">
                                                                <div align="right" class="text style3">Search IN</div>
                                                              </td>
                                                              <td class="text4_user">&nbsp;</td>
                                                              <td width="62%" class="text4_user">
                                                                <input type="radio" name="countryType" value="in" onclick="chkCountry(this.value);" checked>India
                                                                <input type="radio" name="countryType" value="outin" onclick="chkCountry(this.value);">Out side India
                                                                <input type="radio" name="countryType" value="All" onclick="chkCountry(this.value);">All
                                                              </td>
                                                            </tr>
                                                            <tr class="text4_user">
                                                              <td height="30" class="text4_user">
                                                                <div align="right" class="style3">Current Country </div>
                                                              </td>
                                                              <td class="text4_user">&nbsp;</td>
                                                              <td class="text4_user"> <span class="text2">
                                                                  <select name="country" id="country" style="width:150px;" onchange="getState(this.value,0);getCity(0);" disabled>
                                                                    <option value="">Any Country</option>
                                                                    <?php
                                                                    while ($country = mysqli_fetch_array($chk_country)) {
                                                                      if ($_SESSION['country'] == $country['country_id'] || $_SESSION["UserCounrry"] == $country['country_id']) {
                                                                    ?>
                                                                        <option value="<?php echo $country['country_id']; ?>" selected="selected"> <?php echo $country['country_name']; ?> </option>
                                                                      <?php
                                                                      } else {
                                                                      ?>
                                                                        <option value="<?php echo $country['country_id']; ?>"> <?php echo $country['country_name']; ?> </option>
                                                                    <?php }
                                                                    } ?>
                                                                  </select>
                                                                </span></td>
                                                            </tr>
                                                            <tr class="text4_user">
                                                              <td height="30" class="text4_user">
                                                                <div align="right" class="style3">Current State </div>
                                                              </td>
                                                              <td class="text4_user">&nbsp;</td>
                                                              <td class="text4_user"> <span class="text2">
                                                                  <select name="state" style="width:150px;" id="tdstate" onChange="javascript:getCity(this.value,'<?= $_SESSION["UserState"] ?>');">
                                                                    <option value="">Any State</option>
                                                                    <?php
                                                                    while ($state = mysqli_fetch_array($chk_state)) {
                                                                    ?>
                                                                      <option value="<?php echo $state['state_id']; ?>"> <?php echo $state['state_name']; ?> </option>
                                                                    <?php  } ?>
                                                                  </select>
                                                                </span></td>
                                                            </tr>
                                                            <tr class="text4_user">
                                                              <td height="30" class="text4_user">
                                                                <div align="right" class="style3">Current City </div>
                                                              </td>
                                                              <td class="text4_user">&nbsp;</td>
                                                              <td class="text4_user" id="tdcity"> <span class="text2">
                                                                  <select name="city" id="city" style="width:150px;">
                                                                    <option value="" selected="selected">Any City</option>
                                                                    <?php
                                                                    while ($city = mysqli_fetch_array($chk_city)) { ?>

                                                                      <option value="<?php echo $city['city_id']; ?>"> <?php echo $city['city_name']; ?> </option>
                                                                    <?php  } ?>
                                                                  </select>
                                                                </span></td>
                                                            </tr>
                                                            <tr valign="top" class="text4_user">
                                                              <td width="36%" height="30" class="text4_user">
                                                                <div align="right" class="style3">Village (Native Place) </div>
                                                              </td>
                                                              <td width="2%" class="text4_user">&nbsp;</td>
                                                              <td class="text4_user"> <span class="text2">

                                                                  <select name="village_id[]" size="5" multiple="multiple" style="width:200px;">
                                                                    <option value=""> Any Village </option>
                                                                    <?php
                                                                    while ($vill = mysqli_fetch_array($chk_vill)) {
                                                                    ?>
                                                                      <option value="<?php echo $vill['village_id']; ?>"> <?php echo $vill['village_name']; ?> </option>
                                                                    <?php } ?>
                                                                  </select>
                                                                </span> </td>
                                                            </tr>
                                                            <tr valign="top" class="text4_user">
                                                              <td height="3" colspan="3" class="text4_user"></td>
                                                            </tr>
                                                            <tr valign="top" class="text4_user">
                                                              <td height="30" class="text4_user">
                                                                <div align="right" class="style3">Gotra</div>
                                                              </td>
                                                              <td class="text4_user">&nbsp;</td>
                                                              <td class="text4_user"> <span class="text2">

                                                                  <select name="gotra_id[]" size="5" multiple="multiple" style="width:200px;">
                                                                    <option value=""> Any Gotra </option>
                                                                    <?php
                                                                    while ($gotra = mysqli_fetch_array($chk_gotra)) {
                                                                    ?>
                                                                      <option value="<?php echo $gotra['gotra_id']; ?>"> <?php echo $gotra['gotra_name']; ?> </option>
                                                                    <?php } ?>
                                                                  </select>
                                                                </span> </td>
                                                            </tr>
                                                            <tr class="text4_user">
                                                              <td height="30" class="text4_user">
                                                                <div align="right" class="style3">First Name </div>
                                                              </td>
                                                              <td class="text4_user">&nbsp;</td>
                                                              <td class="text4_user"> <span class="text2">
                                                                  <input type="text" name="fname_vc" value="<?php echo isset($_SESSION['fname_vc']) ? $_SESSION['fname_vc'] : ""; ?>" />
                                                                </span> </td>
                                                            </tr>
                                                            <tr class="text4_user">
                                                              <td height="30" class="text4_user">
                                                                <div align="right" class="style3">Last Name </div>
                                                              </td>
                                                              <td class="text4_user">&nbsp;</td>
                                                              <td class="text4_user"> <span class="text2">
                                                                  <input type="text" name="lname_vc" value="<?php echo isset($_SESSION['lname_vc']) ? $_SESSION['lname_vc'] : ""; ?>" />
                                                                </span> </td>
                                                            </tr>
                                                            <tr class="text4_user">
                                                              <td height="30" class="text4_user">
                                                                <div align="right"><span class="style3">Blood Group </span></div>
                                                              </td>
                                                              <td class="text4_user">&nbsp;</td>
                                                              <td class="text4_user"><span class="text2">
                                                                  <select name="blood_group">
                                                                    <option value="" selected="selected">Any Blood Group</option>
                                                                    <?php
                                                                    while ($blood_group = mysqli_fetch_array($chk_bg)) {
                                                                      if (isset($_SESSION['blood_group']) == $blood_group['name']) {
                                                                    ?>
                                                                        <option value="<?php echo $blood_group['name']; ?>" selected="selected"> <?php echo $blood_group['name']; ?> </option>
                                                                      <?php
                                                                      } else {
                                                                      ?>
                                                                        <option value="<?php echo $blood_group['name']; ?>"> <?php echo $blood_group['name']; ?> </option>
                                                                    <?php
                                                                      }
                                                                    }
                                                                    ?>
                                                                  </select>
                                                                </span></td>
                                                            </tr>
                                                          </table>
                                                        </td>
                                                        <td align="left" valign="top" style="padding-top:10px;">
                                                          <div align="center"><img src="images/mom-dad.jpg" width="453" height="394"> </div>
                                                        </td>
                                                      </tr>
                                                    </table>
                                                  </td>
                                                </tr>
                                                <tr class="text4_user" id="extra_det" style="display:none;">
                                                  <td width="100%" height="15" colspan="3" valign="top" class="text4_user">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr class="text4_user">
                                                        <td height="30" class="text4_user">
                                                          <div align="right" class="style3">Email Id</div>
                                                        </td>
                                                        <td class="text4_user">&nbsp;</td>
                                                        <td class="text4_user"> <span class="text2">
                                                            <input name="email" type="text" id="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ""; ?>" />
                                                          </span> </td>
                                                      </tr>
                                                      <tr class="text4_user">
                                                        <td width="18%" height="30" class="text4_user">
                                                          <div align="right" class="text style3">Age</div>
                                                        </td>
                                                        <td width="1%" class="text4_user">&nbsp;</td>
                                                        <td width="81%" class="text4_user">
                                                          <span class="text2">
                                                            <select name="age_from" id="age_from">
                                                              <option value="0" selected="selected">From Age</option>
                                                              <?php
                                                              $i = 0;
                                                              for ($i = 1; $i <= 100; $i++) {
                                                              ?>
                                                                <option value="<?php echo ($i); ?>" <?php echo isset($_SESSION['age_from']) == $i ? "selected" : ""; ?>><?php echo ($i); ?></option>
                                                              <?php
                                                              }
                                                              ?>
                                                            </select>
                                                            &nbsp; </span>
                                                          <span class="text">to&nbsp;</span>
                                                          <span class="text2">

                                                            <select name="age_to" id="age_to">
                                                              <option value="100" selected="selected">To Age</option>
                                                              <?php
                                                              $i = 0;
                                                              for ($i = 1; $i <= 100; $i++) {
                                                              ?>
                                                                <option value="<?php echo ($i); ?>" <?php echo isset($_SESSION['age_to']) == $i ? "selected" : ""; ?>><?php echo ($i); ?></option>
                                                              <?php
                                                              }
                                                              ?>
                                                            </select>
                                                          </span>
                                                        </td>
                                                      </tr>
                                                      <tr class="text4_user">
                                                        <td height="30" class="text4_user">
                                                          <div align="right" class="style3">Gender</div>
                                                        </td>
                                                        <td class="text4_user">&nbsp;</td>
                                                        <td class="text4_user"> <span class="text2">
                                                            <select name="gender_c">
                                                              <option value="" selected="selected">Any Gender</option>
                                                              <option value="Male" <?php echo isset($_SESSION['gender_c']) == "Male" ? "selected" : ""; ?>>Male</option>
                                                              <option value="Female" <?php echo isset($_SESSION['gender_c']) == "Female" ? "selected" : ""; ?>>Female</option>
                                                            </select>
                                                          </span> </td>
                                                      </tr>
                                                      <tr class="text4_user">
                                                        <td height="30" class="text4_user">
                                                          <div align="right" class="style3">Marital Status</div>
                                                        </td>
                                                        <td class="text4_user">&nbsp;</td>
                                                        <td class="text4_user"> <span class="text2">
                                                            <select name="marital_id">
                                                              <option value="" selected="selected">Any Marital Status </option>
                                                              <?php
                                                              while ($ms = mysqli_fetch_array($chk_maritalst)) {
                                                                if ($_SESSION['marital_id'] == $ms['marital_id']) {
                                                              ?>
                                                                  <option value="<?php echo $ms['marital_id']; ?>" selected><?php echo $ms['marital_name']; ?></option>
                                                                <?php } else { ?>
                                                                  <option value="<?php echo $ms['marital_id']; ?>"><?php echo $ms['marital_name']; ?></option>
                                                              <?php }
                                                              } ?>
                                                            </select>
                                                          </span> </td>
                                                      </tr>
                                                      <tr class="text">
                                                        <td height="20" colspan="3" class="text_user" style="padding-left:5px;">&nbsp;</td>
                                                      </tr>
                                                      <tr bgcolor="#fbfbfb" class="text">
                                                        <td height="20" colspan="3" class="text_user" style="padding-left:5px;">Qualification Details</td>
                                                      </tr>
                                                      <tr bgcolor="#fbfbfb" class="text">
                                                        <td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                                      </tr>
                                                      <tr class="text4_user">
                                                        <td height="30" class="text4_user">
                                                          <div align="right" class="style3">Basic/Graduation</div>
                                                        </td>
                                                        <td class="text4_user">&nbsp;</td>
                                                        <td class="text4_user"> <span class="text">
                                                            <select name="basic_qual" id="basic_qual" tabindex="11" class="txtbox1">
                                                              <option value=""> Not Specified </option>
                                                              <?php
                                                              while ($edu_det1 = mysqli_fetch_array($chk_edu_det1)) {
                                                                if ($_SESSION['basic_qual'] == $edu_det1['education_id']) {
                                                              ?>
                                                                  <option value="<?php echo $edu_det1['education_id']; ?>" selected="selected"> <?php echo $edu_det1['education_name']; ?></option>
                                                                <?php } else { ?>
                                                                  <option value="<?php echo $edu_det1['education_id']; ?>"> <?php echo $edu_det1['education_name']; ?></option>
                                                              <?php }
                                                              } ?>
                                                            </select>
                                                          </span><span class="text2"> </span> </td>
                                                      </tr>
                                                      <tr class="text4_user">
                                                        <td height="30" class="text4_user">
                                                          <div align="right" class="style3">Post Graduation</div>
                                                        </td>
                                                        <td class="text4_user">&nbsp;</td>
                                                        <td class="text4_user"> <span class="text2">
                                                            <span class="text">
                                                              <select name="pg_qual" id="pg_qual" tabindex="11" class="txtbox1">
                                                                <option value=""> Not Specified </option>
                                                                <?php
                                                                while ($edu_det2 = mysqli_fetch_array($chk_edu_det2)) {
                                                                  if ($_SESSION['pg_qual'] == $edu_det2['education_id']) {
                                                                ?>
                                                                    <option value="<?php echo $edu_det2['education_id']; ?>" selected="selected"> <?php echo $edu_det2['education_name']; ?></option>
                                                                  <?php } else { ?>
                                                                    <option value="<?php echo $edu_det2['education_id']; ?>"> <?php echo $edu_det2['education_name']; ?></option>
                                                                <?php }
                                                                } ?>
                                                              </select>
                                                            </span> </span> </td>
                                                      </tr>
                                                      <tr class="text4_user">
                                                        <td height="30" class="text4_user">
                                                          <div align="right"><span class="style3">Doctrate</span></div>
                                                        </td>
                                                        <td class="text4_user">&nbsp;</td>
                                                        <td class="text4_user"><span class="text">
                                                            <select name="doc_qual" id="doc_qual" tabindex="11" class="txtbox1">
                                                              <option value=""> Not Specified </option>
                                                              <?php
                                                              while ($edu_det3 = mysqli_fetch_array($chk_edu_det3)) {
                                                                if ($_SESSION['doc_qual'] == $edu_det3['education_id']) {
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
                                                </tr>
                                                <tr id="prof_det" class="text4_user" style="display:none;">
                                                  <td height="30" colspan="3" class="text4_user">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr>
                                                        <td>
                                                          <table width="98%" border="0" cellspacing="0">
                                                            <tr class="text">
                                                              <td height="20" colspan="3" class="text_user" style="padding-left:5px;">&nbsp;</td>
                                                            </tr>
                                                            <tr bgcolor="#fbfbfb" class="text">
                                                              <td height="20" colspan="3" class="text_user" style="padding-left:5px;">Professional Details</td>
                                                            </tr>
                                                            <tr class="text">
                                                              <td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text">
                                                              <td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                <div align="right"><strong>Type</strong></div>
                                                              </td>
                                                              <td width="1%" class="text_user">&nbsp;</td>
                                                              <td width="81%" class="text_user"><span class="sublink">
                                                                  <select name="prof_type" onchange="showhideDiv(this.value)">
                                                                    <option value="" selected="selected"> Please Select </option>
                                                                    <option value="U" <?php echo isset($_SESSION['prof_type']) == "U" ? "selected" : ""; ?>> Unemployed </option>
                                                                    <option value="B" <?php echo isset($_SESSION['prof_type']) == "B" ? "selected" : ""; ?>> Business </option>
                                                                    <option value="P" <?php echo isset($_SESSION['prof_type']) == "P" ? "selected" : ""; ?>> Profession </option>
                                                                    <option value="J" <?php echo isset($_SESSION['prof_type']) == "J" ? "selected" : ""; ?>> Job </option>
                                                                  </select>
                                                                </span></td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text" id="trbusiness" style="display:none;">
                                                              <td height="30" colspan="3" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="text style3"><strong>Business Category</strong></div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="25"><span class="sublink">
                                                                        <select name="bness_cat_id" tabindex="28">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($cat = mysqli_fetch_array($check_cat)) {
                                                                            if ($_SESSION['bness_cat_id'] == $cat['sub_id']) {
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
                                                                      <div align="right" class="text style3"><strong>Industry</strong></div>
                                                                    </td>
                                                                    <td id="tdsubcat">&nbsp;</td>
                                                                    <td height="25" id="tdsubcat"><span class="sublink">
                                                                        <select name="bness_subcat_id" tabindex="29">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($ind = mysqli_fetch_array($check_ind)) {
                                                                            if ($_SESSION['bness_subcat_id'] == $ind['ind_id']) {
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
                                                                  <tr bgcolor="#FFFFFF" class="text">
                                                                    <td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                      <div align="right"><strong>Business Name </strong></div>
                                                                    </td>
                                                                    <td width="1%" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
                                                                    <td width="83%" class="text_user"><span class="sublink">
                                                                        <input name="bness_name" type="text" class="txtbox1" tabindex="1" value="<?php echo isset($_SESSION['bness_name']) ? $_SESSION['bness_name'] : ""; ?>" size="50" />
                                                                      </span></td>
                                                                  </tr>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text" id="trprof" style="display:none;">
                                                              <td height="30" colspan="3" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr bgcolor="#FFFFFF" class="text">
                                                                    <td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                      <div align="right"><strong>Profession Name </strong></div>
                                                                    </td>
                                                                    <td width="1%" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
                                                                    <td width="83%" class="text_user"><span class="sublink">
                                                                        <select name="prof_cat_id" onchange="getSubCat(this.value,'','prof_subcat_id','tdprofcat');">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($prof = mysqli_fetch_array($check_cat1)) {
                                                                            if ($_SESSION['prof_cat_id'] == $prof['sub_id']) {
                                                                          ?>
                                                                              <option value="<?php echo $prof['sub_id']; ?>" selected="selected"> <?php echo $prof['group_name']; ?> </option>
                                                                            <?php   } else { ?>
                                                                              <option value="<?php echo $prof['sub_id']; ?>"> <?php echo $prof['group_name']; ?> </option>
                                                                          <?php
                                                                            }
                                                                          }
                                                                          ?>
                                                                        </select>
                                                                      </span></td>
                                                                  </tr>
                                                                  <tr bgcolor="#FFFFFF" class="text">
                                                                    <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                      <div align="right"><strong>Specialization</strong></div>
                                                                    </td>
                                                                    <td bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
                                                                    <td class="text_user" id="tdprofcat"><span class="sublink">
                                                                        <select name="prof_subcat_id">
                                                                          <option value=""> Please Select </option>
                                                                        </select>
                                                                      </span></td>
                                                                  </tr>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                            <tr bgcolor="#FFFFFF" class="text" id="trjob" style="display:none;">
                                                              <td height="30" colspan="3" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td height="25" valign="top" class="text">
                                                                      <div align="right" class="text style3"><strong>Job Type </strong></div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td height="25"><span class="sublink">
                                                                        <select name="job_type" tabindex="28">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($jobtype = mysqli_fetch_array($check_jobtype)) {
                                                                            if ($_SESSION['job_type'] == $jobtype['sub_id']) {
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
                                                                      <div align="right" class="text style3"><strong>Industry</strong></div>
                                                                    </td>
                                                                    <td id="tdsubcat">&nbsp;</td>
                                                                    <td height="25" id="tdsubcat"><span class="sublink">
                                                                        <select name="job_ind_id" tabindex="29">
                                                                          <option value=""> Please Select </option>
                                                                          <?php
                                                                          while ($j_ind = mysqli_fetch_array($check_ind_job)) {
                                                                            if ($_SESSION['job_ind_id'] == $j_ind['ind_id']) {
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
                                                                  <tr bgcolor="#FFFFFF" class="text">
                                                                    <td width="18%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">
                                                                      <div align="right"><strong>Company Name </strong></div>
                                                                    </td>
                                                                    <td width="1%" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
                                                                    <td width="84%" class="text_user"><span class="sublink">
                                                                        <input name="comp_name" type="text" class="txtbox1" tabindex="1" value="<?php echo isset($_SESSION['comp_name']) ? $_SESSION['comp_name'] : ""; ?>" size="50" />
                                                                      </span></td>
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
                                                <tr class="text4_user">
                                                  <td height="30" class="text4_user">&nbsp;</td>
                                                  <td width="1%" height="30" class="text4_user">&nbsp;</td>
                                                  <td width="81%" height="30" class="text4_user"><input type="submit" value="Click here to Search">
                                                    &nbsp; <a href="user-vastipatrak-result.php?mode=RS"> Reset Search Criteria </a>
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
                                    <td>&nbsp;</td>
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
                  <td height="20" align="center" valign="middle" class="footer">All Rights Reserved. Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti<span class="style2"></span></td>
                </tr>
                <tr>
                  <td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://www.apolloinfotech.com/" target="_blank"> Apollo Infotech </a></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <script>
    function showadvert() {
      var obj = document.getElementById("advtid");
      obj.style.display = "block";
    }

    window.onload = showadvert;

    showhideFields('<?php echo $_SESSION["selSearchType"]; ?>');

    var bness_cat_id = "<?php echo $_SESSION['bness_cat_id']; ?>";

    var prof_cat_id = "<?php echo $_SESSION['prof_cat_id']; ?>";

    var prof_subcat_id = "<?php echo $_SESSION['prof_subcat_id']; ?>";
    getSubCat(prof_cat_id, '', 'prof_subcat_id', 'tdprofcat', prof_subcat_id);

    showhideDiv("<?php echo $_SESSION['prof_type']; ?>");

    function chkCountry(type) {
      if (type == 'in' || type == 'All') {
        document.getElementById("country").disabled=true;        
        getState(10,0);
        $("#country").val('');
      } else {
        document.getElementById("country").disabled=false;
      }
    }
  </script>


</body>


</html>