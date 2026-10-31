<?php

require 'connection/conn.php';
require 'noentry.php';
$ProdThumbImgDir = "images/vastipatrak/member_images/";

if ($_POST["txtMode"] == "") {
  $varMode = $_GET['Mode'];
} else {
  $varMode = $_POST['txtMode'];
}
$varCode = "";

//---------------QueryString-------------------
$varCode = $_REQUEST['Code'];
$EditId = $_REQUEST['id'];
// print_r($varCode);exit;
if (isset($_GET['Mode']) && $_GET['Mode'] == "E") {

  $sql_string = "SELECT * FROM organization_members where id=" . $EditId;

  $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
  if (mysqli_num_rows($check_res) < 1) {
    echo ("No rows in the database to display");
    exit;
  } else {

    while ($rec = mysqli_fetch_array($check_res)) {

      $org_id = $rec['org_id'];
      $org_member_name = $rec['org_member_name'];
      $org_member_photo = $rec['org_member_photo'];
      $designation = $rec['designation'];
      $phone_no = $rec['phone_no'];
      $city = $rec['city'];
      $display_seq = $rec['display_seq'];
      $sub_seq = $rec['sub_seq'];
      // print_r($rec);exit;
    }
  }
}


//-------------MODE A------------------------
// print_r($_POST['txtMode']);exit;

if ($_POST) {

  if ($_POST['txtMode'] == "A") {

    $TImage = "";
    if ($_FILES["org_member_photo"]["name"] != "") {
      $filename = $_FILES["org_member_photo"]["name"];
      $tofind = ".";
      $filename_len = strlen($filename);
      $position_num = strpos($filename, $tofind);
      $extension = substr("$filename", $position_num, $filename_len - $position_num);
      $sys_name = rand();
      $TImage = $sys_name . $extension;
      $ProdThumbImgDir . $TImage;

      move_uploaded_file($_FILES["org_member_photo"]["tmp_name"], $ProdThumbImgDir . $TImage);
      
    }




    $sql_string = "INSERT INTO organization_members (org_id,org_member_name,org_member_photo,designation,phone_no,city,display_seq,sub_seq) VALUES (";

    $sql_string = $sql_string . "'" . $_POST['org_id'] . "',";
    $sql_string = $sql_string . "'" . $_POST['org_member_name'] . "',";
    $sql_string = $sql_string . "'" . $TImage . "',";
    $sql_string = $sql_string . "'" . $_POST['designation'] . "',";
    $sql_string = $sql_string . "'" . $_POST['phone_no'] . "',";
    $sql_string = $sql_string . "'" . $_POST['city'] . "',";
    $sql_string = $sql_string . "'" . $_POST['display_seq'] . "',";
    $sql_string = $sql_string . "'" . $_POST['sub_seq'] . "')";
    $check_res = mysqli_query($cn, $sql_string);
    closeconnection($cn);
    $redirect = "org_member_list.php?Code=" . $_POST['org_id'];
    header("Location: $redirect");
  }
}
// print_r($_POST);exit;
if ($_POST) {
  if ($_POST['txtMode'] == "EA") {
    $imageuploadthumb = "";
    if ($_FILES["org_member_photo"]["name"] != "") {
      $filename = $_FILES["org_member_photo"]["name"];
      $tofind = ".";
      $filename_len = strlen($filename);
      $position_num = strpos($filename, $tofind);
      $extension = substr("$filename", $position_num, $filename_len - $position_num);
      $sys_name = rand();
      $TImage = $sys_name . $extension;


      move_uploaded_file($_FILES["org_member_photo"]["tmp_name"], $ProdThumbImgDir . $TImage);
      $imageuploadthumb = ",org_member_photo='" . $TImage . "'";
    }
    // print_r($file_name);exit;
    $org_member_name = $_POST['org_member_name'];  
    $designation =  $_POST['designation'];
    $phone_no =  $_POST['phone_no'];
    $city =  $_POST['city'];
    $display_seq = $_POST['display_seq'];
    $sub_seq = $_POST['sub_seq'];
    $org_member_photo = $filename;
    $sql_string = "UPDATE `organization_members` SET `org_member_name`='" . $org_member_name . "',`designation`='" . $designation . "',`phone_no`='" . $phone_no . "',`city`='" . $city . "',`display_seq`='" . $display_seq . "',`sub_seq`='" . $sub_seq . "' " . $imageuploadthumb . " WHERE id = " . $EditId;
    $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

    $redirect = "org_member_list.php?Code=" . $_POST['org_id'];
    header("Location: $redirect");
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
  if(frm.org_member_name.value != "" && frm.designation.value != "" && frm.city.value != ""  && frm.display_seq.value != "" )
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
                                        <p>Committe Member
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
                              <td class="text_bold_head">&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="text_bold_head">
                                <form name="frm" method="post" action="org_m_member.php" enctype="multipart/form-data">

                                  <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                                  <input type="hidden" name="org_id" value="<?php echo $varCode; ?>">
                                  <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ? $EditId : ''; ?>">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr valign="top">
                                      <td width="2%">&nbsp;</td>
                                      <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">Organization Member Name<font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input name="org_member_name" type="text" class="text" id="org_member_name" value="<?php echo isset($org_member_name) ? $org_member_name : ""; ?>" size="100"></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">Organization Member Photo</td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input type="file" name="org_member_photo" class="text" id="org_member_photo" value="<?php echo $org_member_photo;   ?>" size="40"></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr>
                                            <td align="right" valign="middle" class="text"> Designation<font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="middle"><strong>:</strong></td>
                                            <td align="left"><input type="text" name="designation" class="text" id="designation" value="<?php echo isset($designation) ? $designation : "";   ?>" size="40"></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">Phone No<font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input type="text" name="phone_no" maxlength="10" minlength="10" class="text" class="Number-only" id="phone_no" value="<?php echo isset($phone_no) ? $phone_no : "";   ?>" size="40" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">City<font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input type="text" name="city" class="text" id="city" value="<?php echo isset($city) ? $city : "";   ?>" size="40"></td>
                                          </tr>
                                          <td width="1%">&nbsp;</td>
                                          <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">Display Sequence<font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input type="text" name="display_seq" class="text" id="display_seq" value="<?php echo isset($display_seq) ? $display_seq : "";   ?>" size="40"></td>
                                      </td>
                                    </tr>
                                    <tr valign="middle">
                                            <td width="22%" align="right" valign="top" class="text">Display sub Sequence<font color="#FF0000">*</font>
                                            </td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td align="left"><input type="text" name="sub_seq" class="text" id="sub_seq" value="<?php echo isset($sub_seq) ? $sub_seq : "";   ?>" size="40"></td>
                                      </td>
                                    </tr>
                                    <td width="1%">&nbsp;</td>
                                    <tr valign="top">
                                      <td>&nbsp;</td>
                                      <td width="1%">
                                        <div align="center">
                                        </div>
                                      </td>
                                      <td width="77%"><input name="button" type="Submit" tabindex="2" onClick="javascript:return doSubmit();" value="Submit" width="100" height="33" border="0">
                                        <input name="button" type="button" tabindex="2" onClick="window.location.href='org_member_list.php?Code=<?= $_GET['Code'] ?>';" value="Cancel" width="100" height="33" border="0">
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