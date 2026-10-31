<?php
// require 'noentry.php';
include "connection/conn.php";
require "noentry.php";

//mode management

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

$sub_id = isset($_GET['sub_id']) ? $_GET['sub_id'] : "";

$sql_string1 = "SELECT * FROM bdir_category where main_id=0 order by sub_id";
$check_res1 = mysqli_query($cn, $sql_string1) or die(mysqli_error($cn));

//---------------QueryString-------------------

if ($varMode == "E") {
  $sql_string = "SELECT * FROM bdir_category where sub_id =" . $varCode;
  $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
  if (mysqli_num_rows($check_res) < 1) {
    echo ("No rows in the database to display");
    exit;
  } else {
    while ($rec = mysqli_fetch_array($check_res)) {
      $group_name = $rec['group_name'];
      $main_id = $rec['main_id'];
      $cat_type = $rec['cat_type'];
    }
  }
} else {
  $group_name = isset($_POST["group_name"]);
  $main_id = isset($_POST['main_id']);
  $cat_type = isset($_POST['cat_type']);
}
//-------------MODE A------------------------

if ($_POST) {
  if ($_POST["txtMode"] == "A") {
    $sql_string = "SELECT * FROM bdir_category where group_name = trim('" . $group_name . "') ";

    $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

    if (mysqli_num_rows($check_res) > 0) {
      $redirect = "message.php?Msg=Duplicate Data Found, Please Try Again";
      header("Location: $redirect");
      exit;
    } else {
      //echo $sql_string="insert into province_m(province_name_vc,default) values('".$vartxtstate."','".$vardefault."')";
      $sql_string = "INSERT INTO bdir_category(group_name,main_id,cat_type) VALUES(";
      $sql_string = $sql_string . "'" . $group_name . "',";
      $sql_string = $sql_string . "'" . $main_id . "',";
      $sql_string = $sql_string . "'" . $cat_type . "')";

      $check_res = mysqli_query($cn, $sql_string);

      closeconnection($cn);

      $redirect = "bdir_category_list.php";
      header("Location: $redirect");
      exit;
    }
  }
}

//--------------MODE E-----------------------

if (isset($_POST["txtMode"]) == "EA") {
  $sql_string = "SELECT * FROM bdir_category where group_name=trim('" . $_POST['group_name'] . "') and sub_id!= " . $varCode . "";

  $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

  if (mysqli_num_rows($check_res) > 0) {
    $redirect = "message.php?Msg=Duplicate Data Found, Please Try Again";
    header("Location: $redirect");
    exit;
  } else {
    $sql_string = "UPDATE bdir_category SET group_name = '" . $_POST['group_name'] . "'";
    $sql_string .= ",main_id = '" . $_POST['main_id'] . "'";
    $sql_string .= ",cat_type = '" . $_POST['cat_type'] . "'";

    $sql_string = $sql_string . " where sub_id =" . $varCode;

    $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

    $redirect = "bdir_category_list.php";
    header("Location: $redirect");
    exit;
  }
}

?>

<html>

<head>
  <title>Samaj</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  <link href="css/adminstyle.css" rel="stylesheet" sub_id="text/css">
  <script language="JavaScript" sub_id="text/JavaScript">
    <!--
    function doSubmit() {
      if (frm.group_name.value == "") {
        alert("Please enter Category Name");
        frm.group_name.focus();
      } else {
        if (frm.txtMode.value == "E") {
          frm.txtMode.value = "EA";
          frm.submit();
        } else {
          frm.txtMode.value = "A";
          frm.submit();
        }
      }
    }
    //
    -->
  </script>

  <link href="css/adminstyle.css" rel="stylesheet" sub_id="text/css">

  <style sub_id="text/css">
    <!--
    body {
      background-color: #666666;
      margin-left: 0px;
      margin-top: 0px;
      margin-right: 0px;
      margin-bottom: 0px;
    }

    .style5 {
      color: #063968;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bolder;
    }

    .style6 {
      color: #B90200;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bolder;
    }

    .style2 {
      color: #FFFFFF;
      font-weight: bold;
      font-size: 13px;
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
                                    </tr>
                                  </table>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="h1">&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="h1">&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="h1">&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="h1" style="padding-left:25px; ">
                                <div align="left" class="h1">Category Master </div>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" valign="top">
                                <form name="frm" method="post" action="bdir_category_m.php">
                                  <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>">
                                  <input type="hidden" name="txtCode" value="<?php echo $varCode; ?>">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td height="12"></td>
                                    </tr>
                                    <tr>
                                      <td align="right" valign="middle" class="text"> Type </td>
                                      <td align="center" valign="middle"><strong>:</strong></td>
                                      <td align="left" valign="middle">
                                        <select name="cat_type" class="text" id="cat_type">
                                          <option value="B" <?php echo ($cat_type == "B") ? "selected" : ""; ?>> Business </option>
                                          <option value="P" <?php echo ($cat_type == "P") ? "selected" : ""; ?>> Profession </option>
                                          <option value="J" <?php echo ($cat_type == "J") ? "selected" : ""; ?>> Job </option>
                                        </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td></td>
                                      <td height="5"></td>
                                    </tr>

                                    <tr>

                                      <td align="right" valign="middle" class="text"> Category </td>
                                      <td align="center" valign="middle"><strong>:</strong></td>
                                      <td align="left" valign="middle">
                                        <select name="main_id" class="text" id="main_id">
                                          <?php
                                          while ($maingrp = mysqli_fetch_array($check_res1)) {
                                            if ($main_id == $maingrp['sub_id']) {
                                          ?>
                                              <option value="<?php echo $maingrp['sub_id']; ?>" selected><?php echo $maingrp['group_name']; ?> </option>
                                            <?php } else { ?>
                                              <option value="<?php echo $maingrp['sub_id']; ?>"><?php echo $maingrp['group_name']; ?> </option>
                                          <?php }
                                          } ?>
                                        </select>
                                      </td>

                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td></td>
                                      <td height="5"></td>
                                    </tr>

                                    <tr>
                                      <td align="right" valign="middle" class="text"> Value </td>
                                      <td align="center" valign="middle"><strong>:</strong></td>
                                      <td " align=" left" valign="middle">
                                        <input name="group_name" sub_id="text" class="text" id="group_name" value="<?php echo ($group_name); ?>" size="40">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td></td>
                                      <td height="5"></td>
                                    </tr>

                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td align="left" valign="top">
                                        <input type="button" name="btnadd2" id="btnadd2" value="Submit" onClick="return doSubmit();" style="cursor:pointer;" />
                                        <input type="button" name="btncancel" id="btncancel" value="Cancel" style="cursor:pointer;" onClick="window.location='bdir_category_list.php'" />
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