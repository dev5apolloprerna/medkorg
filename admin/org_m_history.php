<?php

require 'connection/conn.php';
require 'noentry.php';

if (isset($_POST["txtMode"]) == "") {
  $varMode = $_GET['Mode'];
} else {
  $varMode = $_POST['txtMode'];
}
$varCode = "";

//---------------QueryString-------------------
$varCode = $_REQUEST['Code'];
$EditId = $_REQUEST['id'];
if (isset($_GET['Mode']) && $_GET['Mode'] == "E") {

  $sql_string = "SELECT * FROM organization_history where id=" . $EditId;

  $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
  if (mysqli_num_rows($check_res) < 1) {
    echo ("No rows in the database to display");
    exit;
  } else {
    while ($rec = mysqli_fetch_array($check_res)) {
      $org_id = $rec['org_id'];
      $org_est_year = $rec['org_est_year'];
      $org_name = $rec['org_name'];
      $year = $rec['year'];
      $city = $rec['city'];
      $org_history_pdf = $rec['org_history_pdf'];
      //  print_r($rec);exit;
    }
  }
} else {
  $org_name = mysqli_real_escape_string($cn, isset($_POST['org_name']));
}

//-------------MODE A------------------------
if ($_POST) {


  if ($_POST['txtMode'] == "A") {
    $file_name = "";
    if (isset($_FILES['org_history_pdf']['name'])) {
      $file_name = $_FILES['org_history_pdf']['name'];
      $file_tmp = $_FILES['org_history_pdf']['tmp_name'];

      move_uploaded_file($file_tmp, "../past_president_history/" . $file_name);
    }

    // print_r($varCode);exit;
    $sql_string = "INSERT INTO organization_history (org_id,org_est_year,org_name,year,city,org_history_pdf) VALUES (";

    $sql_string = $sql_string . "'" . $_POST['org_id'] . "',";
    $sql_string = $sql_string . "'" . $_POST['org_est_year'] . "',";
    $sql_string = $sql_string . "'" . $_POST['org_name'] . "',";
    $sql_string = $sql_string . "'" . $_POST['year'] . "',";
    $sql_string = $sql_string . "'" . $_POST['city'] . "',";
    $sql_string = $sql_string . "'" . $file_name . "')";
    $check_res = mysqli_query($cn, $sql_string);

    closeconnection($cn);

    $redirect = "org_history_list.php?Code=" . $_POST['org_id'];
    header("Location: $redirect");
    exit;
    //}
  }



  if ($_POST['txtMode'] == "EA") {
    $file_name = "";
    if (isset($_FILES['org_history_pdf']['name'])) {
      $file_name = $_FILES['org_history_pdf']['name'];
      $file_tmp = $_FILES['org_history_pdf']['tmp_name'];

      move_uploaded_file($file_tmp, "../past_president_history/" . $file_name);
    }

    // print_r($varCode);exit;
    $org_est_year =  $_POST['org_est_year'];
    $org_name =  $_POST['org_name'];
    $year = $_POST['year'];
    $city =  $_POST['city'];
    $org_history_pdf = $file_name;
    if ($_FILES['org_history_pdf']['name'] != "") {
      $sql_string = "UPDATE `organization_history` SET `org_est_year`='" . $org_est_year . "',`org_name`='" . $org_name . "',`year`='" . $year . "',`city`='" . $city . "',`org_history_pdf`='" . $file_name . "' where id=" . $EditId;
      $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

      $redirect = "org_history_list.php?Code=" . $_POST['org_id'];
      header("Location: $redirect");
    } else {
      $sql_string = "UPDATE `organization_history` SET `org_est_year`='" . $org_est_year . "',`org_name`='" . $org_name . "',`year`='" . $year . "',`city`='" . $city . "' where id=" . $EditId;
      $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
    $redirect = "org_history_list.php?Code=" . $_POST['org_id'];
    header("Location: $redirect");
    }
  }
}

?>


<html>

<head>
  <title>Samaj</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  <link href="css/adminstyle.css" rel="stylesheet" type="text/css">
  <script language="JavaScript" type="text/JavaScript">
    <!--
function doSubmit()
{
	/*if(frm.selpage.value =="0")
	{
		alert("Please select Page");
		frm.selpage.focus();
		return false;
	}
	else
	*/
  if(frm.org_est_year.value != "" && frm.org_name.value != "" && frm.year.value != "" && frm.city.value != "" )
  {
		if(frm.txtMode.value == "E")
		{
			frm.txtMode.value = "EA";
			frm.submit();
		}
		else
		{
			frm.txtMode.value = "A";
			frm.submit();
		}
	}
  return false;
}
//-->
  </script>
  <script language="javascript" src="ckeditor/ckeditor.js"></script>
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


</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
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
      <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
              <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr valign="top">
                        <td width="25%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
                        <td>&nbsp;</td>
                        <td>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="text_bold_head">
                                <div align="left">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td class="h1">&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td class="h1">&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td class="h1">&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td width="60%" class="h1" style="padding-left:25px; ">
                                        <p>Past President Detail
                                        <p>
                                      </td>
                                      <td>
                                        <div align="right"> </div>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="text_bold_head">
                                <div align="left"></div>
                              </td>
                            </tr>
                            <tr>
                              <td class="text_bold_head">&nbsp;</td>
                            </tr>
                            <tr>
                              <?php
                              $sql = "SELECT * FROM `organization_m` WHERE org_id=$varCode";
                              $organization = mysqli_query($cn, $sql);
                              $org = mysqli_fetch_array($organization);
                              ?>
                              <td style="padding-left:25px;">
                                <?php if ($org['org_logo'] != "") { ?>
                                  <img src="<?php echo '../logo/' . $org['org_logo']; ?>" width="100" height="101" />
                                <?php }  ?>
                                <?= '<br>' . $org['org_name'] . '<hr>'; ?>
                              </td>

                            </tr>
                            <tr>
                              <td class="text_bold_head">
                                <form name="frm" method="post" action="org_m_history.php" enctype="multipart/form-data">

                                  <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                                  <input type="hidden" name="org_id" value="<?php echo $varCode; ?>">
                                  <input type="hidden" name="id" value="<?php echo $EditId; ?>">

                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr valign="top">
                                      <td width="2%">&nbsp;</td>
                                      <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">Year<font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input name="org_est_year" type="text" maxlength="10" minlength="8" class="text" id="org_est_year" value="<?php echo isset($org_est_year) ? $org_est_year : ""; ?>" size="15"></td>
                                            </select>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">President Name<font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input type="text" name="org_name" class="text" id="org_name" value="<?php echo $org_name;   ?>" size="65"></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">Duration</td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input name="year" type="text" maxlength="2" minlength="2" class="text" id="year" value="<?php echo isset($year) ? $year : ""; ?>" size="15"></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">City</td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input type="text" name="city" class="text" id="city" value="<?php echo isset($city) ? $city : "";   ?>" size="15"></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">Organization History Pdf</td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input type="file" name="org_history_pdf" class="text" id="org_history_pdf" accept=".pdf" title="Upload PDF" value="<?php echo $org_history_pdf;   ?>" size="40"></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr valign="top">
                                            <td>&nbsp;</td>
                                            <td width="1%">
                                              <div align="center">
                                              </div>
                                            </td>
                                            <td width="77%"><input name="button" type="Submit" tabindex="2" onClick="javascript:return doSubmit();" value="Submit" width="100" height="33" border="0">
                                              <input name="button" type="button" tabindex="2" onClick="window.location.href='org_history_list.php?Code=<?= $_GET['Code'] ?>';" value="Cancel" width="100" height="33" border="0">
                                            </td>
                                          </tr>
                                          <tr valign="top">
                                            <td>&nbsp;</td>
                                            <td colspan="2">&nbsp;</td>
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
                      <tr valign="top">
                        <td>&nbsp;</td>
                        <td>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="25%" class="text_bold_head">&nbsp;</td>
                              <td>
                                <div align="right"> </div>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr valign="top">
                        <td width="1%">&nbsp;</td>
                        <td width="74%">&nbsp;</td>
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
      <td valign="top" bgcolor="#000000">&nbsp;</td>
    </tr>
  </table>
  <!-- End ImageReady Slices -->
</body>

</html>