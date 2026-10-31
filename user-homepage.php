<?php
include_once "noentry.php";
include_once "admin/connection/conn.php";

$nextWeek = time() + (0 * 24 * 60 * 60);
// 7 days; 24 hours; 60 mins; 60secs

$curr_date = date('m-d');
$next_seven_days = date('m-d', $nextWeek);

// Get list of people having Bdays in next 7 days //
$sql_list = "select v.vasti_id,v.fname_vc,v.mname_vc,v.lname_vc,v.birth_date, 
					v1.fname_vc as parfname,v1.lname_vc as parlname,
					v2.lname_vc as mainlname
					
					from vastipatrak_m v 
				    left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
				    left outer join vastipatrak_m v2 on v1.anc_id = v2.vasti_id
					
				 	where v.age='' and v.lineage=0 and DATE_FORMAT(v.birth_date,'%m-%d') between '" . $curr_date . "' and '" . $next_seven_days . "'  order by DATE_FORMAT(v.birth_date,'%m-%d'),fname_vc limit 10";

$chk_list = mysqli_query($cn, $sql_list);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
  <link href="css/styles.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/datepickercontrol.js"></script>
  <link type="text/css" rel="stylesheet" href="css/datepickercontrol.css">
  <script type="text/javascript" src="js/ajax.js"></script>
  <script language="javascript" type="text/javascript">
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

    function getDet(val) {
      switch (val) {
        case "S.S.C.":
          disp = "none";
          break;
        case "H.S.C.":
          disp = "none";
          break;
        case "Under Graduate(Bachelor Degree)":
          disp = "";
          break;
        case "Post Graduation(Masters Degree)":
          disp = "";
          break;
        case "Ph.D.":
          disp = "";
          break;
      }
      document.getElementById("tdedudetails").style.display = disp;
    }
  </script>

  <script language="JavaScript" type="text/JavaScript">
    <!--
function checkall()
{
	var iCnt= frm.elements.length;
	
	for (var i=0;i<iCnt;i++)
	{
		frm.elements[i].checked=frm.chkselectall.checked;
	}
}
function IsChecked()
{
	iCnt= frm.elements.length;
	var cnt;
	cnt=0;
	for (var i=0;i<iCnt;i++)
	{
		if (frm.elements[i].checked)
		{
			cnt++;
			if (cnt>=2)
			  break;
		}
	}
	if (i<iCnt)
		return cnt;
	else
	{
		if (cnt>0)
			return cnt;
		else
			return -1;
	}
}
function doEdit()
{
	var i = IsChecked();
	if (i == -1)
	{
		alert("Please select the record to be modified");
	}
	else if(i >1) 
	{
		alert("you cannot select more than one record to modify.");
		frm.chkselectall.checked = false;
		checkall();
	}
	else
	{
		frm.txtMode.value="E";
		frm.submit();
	}
}
function doDelete(DCode)
{
	var blnConfirm = confirm("Do you want to delete?");
	if (blnConfirm)
	{
		frm.txtMode.value="D";
		frm.txtDCode.value=DCode;
		frm.submit();
	}
	else
	{
		frm.txtMode.value="X";
	}
}
function doFilter()
{
	frmsearch.submit();
}

function doShowDiv(mode,url)
{
	document.getElementById("tdform").style.display = "";

	if(mode == 'E' || mode == 'A')
	{
		window.location = url;
	}
}
//-->
  </script>
  <style type="text/css">
    <!--
    .style2 {
      font-size: 16px;
      font-weight: bold;
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
                  <td valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top" width="60%">
                          <?php
                          $sql = "SELECT `org_id`,`org_type`,`org_name`,`est_year` FROM `organization_m` WHERE `org_type`='Primary' order by est_year asc ";
                          $chk_org = mysqli_query($cn, $sql);
                          while ($organization = mysqli_fetch_array($chk_org)) {
                            $organizationmaster[] = array(
                              'org_id' => $organization['org_id'],
                              'org_type' => $organization['org_type'],
                              'org_name' => $organization['org_name'],
                              'est_year' => $organization['est_year']
                            );
                          }

                          $sql1 = "SELECT `org_id`,`org_type`,`org_name`,`est_year` FROM `organization_m` WHERE `org_type`='regional' order by est_year asc";
                          $check_org = mysqli_query($cn, $sql1);
                          while ($org_m = mysqli_fetch_array($check_org)) {
                            $org[] = array(
                              'org_id' => $org_m['org_id'],
                              'org_type' => $org_m['org_type'],
                              'org_name' => $org_m['org_name'],
                              'est_year' => $org_m['est_year']
                            );
                          }
                          ?>

                          <h4 class="event-head text-start"><i class="fas fa-arrow-alt-circle-right"></i> Primary Organization</h4>
                          <ul>
                            <?php
                            foreach ($organizationmaster as $sql) {
                            ?>
                              <li> <a class="text4" href="organization_details.php?orgid=<?php echo $sql['org_id']; ?>"> <?php echo $sql['org_name'] . " (since-" . $sql['est_year'] . ")"; ?></a>
                              <?php
                            }
                              ?>
                              </li>
                          </ul>

                          <h4 class="event-head text-start"><i class="fas fa-arrow-alt-circle-right"></i> Regional Organization</h4>
                          <ul>
                            <?php
                            foreach ($org as $sql1) {
                            ?>
                              <li><a class="text4" href="organization_details.php?orgid=<?php echo $sql1['org_id']; ?>"> <?php echo $sql1['org_name'] . " (since-" . $sql1['est_year'] . ")"; ?></a>
                              <?php
                            }
                              ?>
                              </li>
                          </ul>


                        </td>
                        <td>
                          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td height="1" align="left" bgcolor="#e2e2e2"></td>
                            </tr>
                            <tr>
                              <td height="30" align="left" bgcolor="#F8F8F8" style="padding-left:5px;"><strong class="text4">Birthday Reminders</strong></td>
                            </tr>
                            <tr>
                              <td align="left">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="text1">
                                    <td height="1" colspan="2" class="text" bgcolor="#e2e2e2"></td>
                                  </tr>
                                  <?php
                                  while ($bday_list = mysqli_fetch_array($chk_list)) {
                                    if ($bday_list['mname_vc'] == "")
                                      $mname_vc = $bday_list['parfname'];
                                    else
                                      $mname_vc = $bday_list['mname_vc'];

                                    if ($bday_list['lname_vc'] == "" && $bday_list['parlname'] == "")
                                      $lname_vc = $bday_list['mainlname'];
                                    else if ($bday_list['lname_vc'] == "")
                                      $lname_vc = $bday_list['parlname'];
                                    else
                                      $lname_vc = $bday_list['lname_vc'];

                                    $full_name = $bday_list['fname_vc'] . " " . $mname_vc . " " . $lname_vc;
                                  ?>
                                    <tr class="text1">
                                      <td height="30"><a href="user-full-profile.php?viewmode=bd&VId=<?php echo $bday_list['vasti_id']; ?>" target="_blank" class="text1" style="padding-left:5px;"> <strong> <?php echo $full_name; ?> </strong> </a></td>
                                      <td height="30"><strong><?php echo date('d-m-Y', strtotime($bday_list['birth_date'])); ?></strong></td>
                                    </tr>
                                    <tr class="text1">
                                      <td height="1" colspan="2" class="text" bgcolor="#e2e2e2"></td>
                                    </tr>
                                  <?php } ?>
                                </table>
                              </td>
                            </tr>
                            <tr>
                           
                              <td align="right" valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                             
                              <td align="left" valign="top">
                                <div align="left" class="menu"><strong><a href="birthday_reminders.php">See More Birthdays </a></strong></div>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
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
                  <td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://apolloinfotech.com/" target="_blank"> Apollo Infotech</a></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <script language="javascript" type="text/javascript">
    var mode = '<?php echo $_GET['Mode']; ?>';
    if (mode == "") {
      document.getElementById("tdform").style.display = "none";
    } else {
      document.getElementById("tdform").style.display = "";
    }
  </script>
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