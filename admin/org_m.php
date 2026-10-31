<?php

require 'connection/conn.php';
require 'noentry.php';
$ProdThumbImgDir = "../logo/";
if (isset($_POST["txtMode"]) == "") {
  $varMode = $_GET['Mode'];
} else {
  $varMode = $_POST['txtMode'];
}
$varCode = "";
if (isset($_POST["txtCode"]) == "") {
  $varCode = isset($_GET['Code']) ? $_GET['Code'] : "";
} else {
  $varCode = $_POST['txtCode'];
}

//---------------QueryString-------------------
if (isset($_GET['Mode']) && $_GET['Mode'] == "E") {

  $sql_string = "SELECT * FROM organization_m where org_id=" . $varCode;

  $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
  if (mysqli_num_rows($check_res) < 1) {
    echo ("No rows in the database to display");
    exit;
  } else {
    while ($rec = mysqli_fetch_array($check_res)) {
      $org_id = $rec['org_id'];
      $org_name = $rec['org_name'];
      $Est_year = $rec['est_year'];
      $about_organization = $rec['about_organization'];
      $org_type = $rec['org_type'];
      $org_logo = $rec['org_logo'];
      // print_r($_GET['Code']);exit;
      // print_r($rec);exit;
    }
  }
} else {
  $org_name = mysqli_real_escape_string($cn, isset($_POST['org_name']));
}

//-------------MODE A------------------------
if ($_POST) {


  if ($_POST['txtMode'] == "A") {

    $file_name = "";
    if (isset($_FILES['about_organization']['name'])) {
      $file_name = $_FILES['about_organization']['name'];
      $file_tmp = $_FILES['about_organization']['tmp_name'];

      move_uploaded_file($file_tmp, "../organizations_information_pdf/" . $file_name);
    }
    $TImage = "";
    if ($_FILES["org_logo"]["name"] != "") {
      $filename = $_FILES["org_logo"]["name"];
      $tofind = ".";
      $filename_len = strlen($filename);
      $position_num = strpos($filename, $tofind);
      $extension = substr("$filename", $position_num, $filename_len - $position_num);
      $sys_name = rand();
      $TImage = $sys_name . $extension;
      $ProdThumbImgDir . $TImage;

      move_uploaded_file($_FILES["org_logo"]["tmp_name"], $ProdThumbImgDir . $TImage);
      $imageuploadthumb = ",org_logo='" . $TImage . "'";
    }

    $sql_string = "INSERT INTO organization_m (org_name,Est_year,about_organization,org_type,org_logo) VALUES (";


    $sql_string = $sql_string . "'" . $_POST['org_name'] . "',";
    $sql_string = $sql_string . "'" . $_POST['Est_year'] . "',";
    $sql_string = $sql_string . "'" . $file_name . "',";
    $sql_string = $sql_string . "'" . $_POST['org_type'] . "',";
    $sql_string = $sql_string . "'" . $TImage . "')";
    $check_res = mysqli_query($cn, $sql_string);

    closeconnection($cn);

    $redirect = "org_list.php";
    header("Location: $redirect");
    exit;
  }


  if ($_POST['txtMode'] == "EA") {
    $file_name = "";
    if (isset($_FILES['about_organization']['name'])) {
      $file_name = $_FILES['about_organization']['name'];
      $file_tmp = $_FILES['about_organization']['tmp_name'];

      move_uploaded_file($file_tmp, "../organizations_information_pdf/" . $file_name);
    }
    $imageuploadthumb = "";
    if ($_FILES["org_logo"]["name"] != "") {
      $filename = $_FILES["org_logo"]["name"];
      $tofind = ".";
      $filename_len = strlen($filename);
      $position_num = strpos($filename, $tofind);
      $extension = substr("$filename", $position_num, $filename_len - $position_num);
      $sys_name = rand();
      $TImage = $sys_name . $extension;
      $ProdThumbImgDir . $TImage;

      move_uploaded_file($_FILES["org_logo"]["tmp_name"], $ProdThumbImgDir . $TImage);
      $imageuploadthumb = ",org_logo='" . $TImage . "'";
    }
    // print_r($file_name);exit;
    $org_name = mysqli_real_escape_string($cn, $_POST['org_name']);
    $Est_year = mysqli_real_escape_string($cn, $_POST['Est_year']);
    $file_name = mysqli_real_escape_string($cn, $file_name);
    $org_type = mysqli_real_escape_string($cn, $_POST['org_type']);
    $filename = mysqli_real_escape_string($cn, $filename);
    $about_organization = $file_name;
    $org_logo = $filename;
    if ($_FILES['about_organization']['name'] != "") {
      $sql_string = "UPDATE `organization_m` SET `org_name`='" . $org_name . "',`Est_year`='" . $Est_year . "',`about_organization`='" . $file_name . "',`org_type`='" . $org_type . "' " . $imageuploadthumb . "  where org_id =" . $varCode;

      $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
      $redirect = "org_list.php";
      header("Location: $redirect");
    } else {
      $sql_string = "UPDATE `organization_m` SET `org_name`='" . $org_name . "',`Est_year`='" . $Est_year . "',`org_type`='" . $org_type . "' " . $imageuploadthumb . "  where org_id =" . $varCode;

      $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
      $redirect = "org_list.php";
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
  if(frm.org_name.value != "" && frm.Est_year.value != "" &&  frm.org_type.value != "")
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
                                      <td width="25%" class="h1" style="padding-left:25px; ">
                                        <p>Organization Master
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
                              <td class="text_bold_head">
                                <form name="frm" method="post" action="org_m.php" enctype="multipart/form-data">

                                  <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                                  <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr valign="top">
                                      <td width="2%">&nbsp;</td>
                                      <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">Organization Name <font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input name="org_name" type="text" class="text" id="org_name" value="<?php echo $org_name; ?>" size="40" required=""></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr>
                                            <td align="right" valign="middle" class="text"> Establishment-Year<font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="middle"><strong>:</strong></td>
                                            <td align="left"><input type="text" name="Est_year" maxlength="4" minlength="4" class="txtreqd  txt1" class="Number-only" id="Est_year" value="<?php echo isset($Est_year) ? $Est_year : "";   ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required /></td>
                                      </td>
                                    </tr>
                                    <td width="1%">&nbsp;</td>
                                    <tr valign="middle">
                                      <td width="22%" align="right" valign="top" class="text">About-Organization</td>
                                      <td align="center" valign="top"><strong>:</strong></td>
                                      <td align="left"><input type="file" name="about_organization" class="text" id="about_organization" accept=".pdf" title="Upload PDF" value="<?php echo $about_organization;   ?>" size="40"></td>
                                    </tr>
                                    <td width="1%">&nbsp;</td>
                                    <tr valign="middle">
                                      <td width="22%" align="right" valign="top" class="text">Organization Type<font color="#FF0000">*</font>
                                      </td>
                                      <td align="center" valign="top"><strong>:</strong></td>
                                      <td valign="top" class="form_field">
                                        <select name="org_type" id="org_type" class="txtbox">
                                          <option value="">Please Select</option>
                                          <option value="Primary" <?php if (isset($org_type) && $org_type == "Primary") echo "selected" ?>>Primary</option>
                                          <option value="Regional" <?php if (isset($org_type) && $org_type == "Regional") echo "selected" ?>>Regional</option>
                                        </select>
                                    </tr>
                                    <td width="1%">&nbsp;</td>
                                    <tr valign="middle">
                                      <td width="22%" align="right" valign="top" class="text">Organization Logo</td>
                                      <td align="center" valign="top"><strong>:</strong></td>
                                      <td align="left"><input type="file" name="org_logo" class="text" id="org_logo" value="<?php echo $org_logo;   ?>" size="40"></td>
                                    </tr>
                                    <td width="1%">&nbsp;</td>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td width="1%">
                                        <div align="center">
                                        </div>
                                      </td>
                                      <td width="77%"><input name="button" type="Submit" tabindex="2" onClick="javascript:return doSubmit();" value="Submit" width="100" height="33" border="0">
                                        <input name="button" type="button" tabindex="2" onClick="window.location.href='org_list.php?Code=<?= $_GET['Code'] ?>';" value="Cancel" width="100" height="33" border="0">
                                      </td>
                                    </tr>
                                    <td width="1%">&nbsp;</td>
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