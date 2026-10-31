<?php
ob_start();
include_once "noentry.php";
include_once "password_hash.php";
$txtDCode = $_SESSION["UserCode"];
$txtUserEmail = $_SESSION["UserEmail"];

include_once "admin/connection/conn.php";


if (isset($_POST["txtMode"]) == "") {
  $varMode = 'E';
} else {
  $varMode = $_POST['txtMode'];
}
//---------------QueryString-------------------

$sql_string = "SELECT * FROM vastipatrak_m WHERE vasti_id=" . $txtDCode;

$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
if (mysqli_num_rows($check_res) > 0) {
  while ($rec = mysqli_fetch_array($check_res)) {
    $vartxtusername = $rec['mobile_home'];
    $vartxtpassword = '';
  }
}
//--------------MODE E-----------------------
if (isset($_POST["txtMode"]) == "E") {

  $hash_result = create_hash($_REQUEST['txtoldpassword']);
  $hash_params = explode(":", $hash_result);
  $salt = $hash_params[HASH_SALT_INDEX];
  $hash = $hash_params[HASH_PBKDF2_INDEX];
  $existsmail = "SELECT * FROM vastipatrak_m WHERE vasti_id=" . $txtDCode;
  $result = mysqli_query($cn, $existsmail);
  $num_rows = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result);
  if ($num_rows >= 1) {
    $good_hash = PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" . $row['salt'] . ":" . $row['password'];
    if (!validate_password($_REQUEST['txtoldpassword'], $good_hash)) {
      $redirect = "user-changepswd.php?msg=Old Password does not match...!!!";
      header("Location: $redirect");
    } else {
      $hash_result = create_hash($_REQUEST['txtnewpassword']);
      $hash_params = explode(":", $hash_result);
      $salt = $hash_params[HASH_SALT_INDEX];
      $hash = $hash_params[HASH_PBKDF2_INDEX];
      $sql_string = "UPDATE vastipatrak_m SET password = '" . $hash . "',salt= '" . $salt . "' ";
      $sql_string = $sql_string . " where vasti_id =" . $txtDCode;

      $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

      $redirect = "user-changepswd.php?msg=Password Changed Successfully...!!!";
      header("Location: $redirect");
    }
  } else {
    $redirect = "user-changepswd.php?msg=Invalid Request...!!!";
    header("Location: $redirect");
  }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
  <link href="css/styles.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
    <!--
    .style1 {
      font-size: 14px
    }

    .style2 {
      font-size: 13px
    }
    -->
  </style>
  <script language="javascript" type="text/javascript">
    function checkPswd(f) {
      var ret = checkFormElements(f);

      if (ret) {
        if (document.getElementById("New Password ").value == document.getElementById("Confirm Password ").value) {
          return true;
        } else {
          alert("New Password and Confirm Password does not match");
          document.getElementById("Confirm Password ").focus();
          return false;
        }
      } else {
        return false;
      }
    }
  </script>
  <script language="javascript" src="js/userjvalid.js"></script>
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
  <script type="text/javascript">
    /***********************************************
     * Disable Text Selection script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
     * This notice MUST stay intact for legal use
     * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
     ***********************************************/

    function disableSelection(target) {
      if (typeof target.onselectstart != "undefined") //IE route
        target.onselectstart = function() {
          return false
        }
      else if (typeof target.style.MozUserSelect != "undefined") //Firefox route
        target.style.MozUserSelect = "none"
      else //All other route (ie: Opera)
        target.onmousedown = function() {
          return false
        }
      target.style.cursor = "default"
    }

    //Sample usages
    //disableSelection(document.body) //Disable text selection on entire body
    //disableSelection(document.getElementById("mydiv")) //Disable text selection on element with id="mydiv"
  </script>

</head>

<body>
  <script language=JavaScript>
    <!--
    //Disable right click script III- By Renigade (renigade@mediaone.net)
    //For full source code, visit http://www.dynamicdrive.com

    var message = "";
    ///////////////////////////////////
    function clickIE() {
      if (document.all) {
        (message);
        return false;
      }
    }

    function clickNS(e) {
      if (document.layers || (document.getElementById && !document.all)) {
        if (e.which == 2 || e.which == 3) {
          (message);
          return false;
        }
      }
    }
    if (document.layers) {
      document.captureEvents(Event.MOUSEDOWN);
      document.onmousedown = clickNS;
    } else {
      document.onmouseup = clickNS;
      document.oncontextmenu = clickIE;
    }

    document.oncontextmenu = new Function("return false")
    // 
    -->
  </script>
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
                                        <tr bgcolor="#f2f2f2">
                                          <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                          <td width="67%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;">USER CHANGE PASSWORD </td>
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
                                            <form action="user-changepswd.php" method="post" name="frm" id="frm">
                                              <input type="hidden" name="txtMode" value="<?php echo $varMode; ?>" />
                                              <input type="hidden" name="txtUCode" value="<?php echo $varUCode; ?>" />
                                              <table width="100%" border="0" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
                                                <tr valign="middle">
                                                  <td height="25" colspan="3" valign="top" class="text">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <?php
                                                      if (isset($_GET['msg']) != "") {
                                                      ?>
                                                        <tr>
                                                          <td width="38%">
                                                            <div align="center" class="text4_user"><?php echo $_GET['msg']; ?></div>
                                                          </td>
                                                          <td width="62%">&nbsp;</td>
                                                        </tr>
                                                      <?php } ?>
                                                    </table>
                                                  </td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td width="14%" height="25" valign="top" class="text">
                                                    <div align="right">User Login&nbsp;</div>
                                                  </td>
                                                  <td width="1%" height="25" valign="top" class="text">&nbsp;</td>
                                                  <td width="85%" height="30" valign="top" class="text"><b><?php echo isset($vartxtusername) ? $vartxtusername : ""; ?></b></td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="25" valign="top" class="text">
                                                    <div align="right">Old Password<font color="#FF0000">*</font>
                                                    </div>
                                                  </td>
                                                  <td height="25" valign="top" class="text">&nbsp;</td>
                                                  <td height="30" valign="top" class="text">
                                                    <input name="txtoldpassword" type="password" id="Old Password " class="txtreqd txtbox" size="30" />
                                                  </td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="25" valign="top" class="text">
                                                    <div align="right">New Password<font color="#FF0000">*</font>
                                                    </div>
                                                  </td>
                                                  <td height="25" valign="top" class="text">&nbsp;</td>
                                                  <td height="30" valign="top" class="text">
                                                    <input name="txtnewpassword" id="New Password " type="password" class="txtreqd txtbox" size="30" />
                                                  </td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="25" valign="top" class="text">
                                                    <div align="right"> Confirm Password<font color="#FF0000">*</font>
                                                    </div>
                                                  </td>
                                                  <td height="25" valign="top" class="text">&nbsp;</td>
                                                  <td height="30" valign="top" class="text">
                                                    <input name="txtconpassword" id="Confirm Password " type="password" class="txtreqd txtbox" size="30" />
                                                  </td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="22" valign="top" class="text">
                                                    <div align="right"></div>
                                                  </td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td valign="top"><input name="submit" type="submit" value="Submit" onclick="javascript: return checkPswd(this.form);" /></td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="22" valign="top" class="text">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="22" valign="top" class="text">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="22" valign="top" class="text">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="22" valign="top" class="text">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="22" valign="top" class="text">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="22" valign="top" class="text">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="22" valign="top" class="text">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                </tr>
                                                <tr valign="middle">
                                                  <td height="22" valign="top" class="text">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td valign="top">&nbsp;</td>
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
                  <td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://apolloinfotech.com/" target="_blank">Apollo Infotech</a></td>
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
  </script>
  <script type="text/javascript">
    disableSelection(document.body) //disable text selection on entire body of page
  </script>
  <script type="text/javascript">
    var somediv = document.getElementById("mydiv")
    disableSelection(somediv) //disable text selection within DIV with id="mydiv"
  </script>
  <script type="text/javascript">
    var alltables = document.getElementsByTagName("table")
    for (var i = 0; i < alltables.length; i++)
      disableSelection(alltables[i]) //disable text selection within all tables on the page
  </script>

</body>


</html>