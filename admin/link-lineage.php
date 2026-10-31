<?php
ob_start();
include_once "connection/conn.php";
session_start();

// Query for Village data //
$sql_vill = "select * from village_m order by village_name";
$chk_vill = mysqli_query($cn, $sql_vill);

// Query for Village gotra //
$sql_gotra = "select * from gotra_m order by gotra_name";
$chk_gotra = mysqli_query($cn, $sql_gotra);
// $_GET['mode'] = "";
// if ($_GET['mode'] == "Dir")
//     $action = "user-dirsearch-result.php?dirid=" . $_GET['dirid'] . "&dirnm=" . $_GET['dirnm'];
// else
//     $action = "user-vastipatrak-result.php";

// Query for Vasti Patrak Data //
$where = " and ";
$cond = "";

if ($_POST) {
    // Search By Professional Details //

    if ($_POST['village_id'] != "") {
        $cond = $where . "vasti.village_id=" . $_POST['village_id'];
    }
    if ($_POST['gotra_id'] != "") {
        $cond .= $where . "vasti.gotra_id=" . $_POST['gotra_id'];
    }
    if ($_POST['fname_vc'] != "") {
        $cond .= $where . "vasti.fname_vc like '%" . $_POST['fname_vc'] . "%'";
    }
    if ($_POST['lname_vc'] != "") {
        $cond .= $where . "vasti.lname_vc like '%" . $_POST['lname_vc'] . "%'";
    }
    if ($_POST['location'] != "") {
        $cond .= $where . "(vasti.city like '%" . $_POST['location'] . "%' or vasti.state like '%" . $_POST['location'] . "%' or vasti.country like '%" . $_POST['location'] . "%')";
    }

    $sql_vastipatrak = "select vasti.*,v.village_name,g.gotra_name from vastipatrak_m vasti
							left outer join village_m v on vasti.village_id = v.village_id
							left outer join gotra_m g on vasti.gotra_id = g.gotra_id
							where (vasti.parent_id=0 or vasti.parent_id>0) $cond  order by vasti.vasti_id";
    $chk_vastipatrak = mysqli_query($cn, $sql_vastipatrak);
    $num_vastipatrak = mysqli_num_rows($chk_vastipatrak);
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

    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/userjvalid.js"></script>
    <script type='text/JavaScript' src='js/scw.js'></script>

    <script src="js/jquery.js" type="text/javascript"></script>
    <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="js/facebox.js" type="text/javascript"></script>
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
                                                <td width="30%" rowspan="5" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr valign="top">
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td class="h1"> Link linage </td>
                                            </tr>

                                            <tr style="vertical-align: top !important">
                                                <td width="1%" valign="top">&nbsp;</td>
                                                <td width="0%" valign="top">&nbsp;</td>
                                                <td width="69%" valign="top">
                                                    <?php
                                                    $ex = "?";
                                                    $extra = "";

                                                    $extra .= $ex . "id=" . $_GET['id'];
                                                    // echo $extra . "1";
                                                    // if(isset($_GET['Mode'])=="" && isset($_GET['Code'])=="")
                                                    // 	$extra = "";
                                                    // echo $extra. " 2";
                                                    $src = "link-lineage.php" . $extra;
                                                    // print_r($src);exit;
                                                    ?>
                                                    <form name="frmSearch" method="post" action="<?php echo $src; ?>">

                                                        <input type="hidden" name="vastiid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr bgcolor="#fbfbfb" class="text">
                                                                <td height="20" colspan="3" class="text_user" style="padding-left:5px; font-weight: bold;">Personal Details</td>
                                                            </tr>
                                                            <tr bgcolor="#fbfbfb" class="text">
                                                                <td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                                            </tr>
                                                            <tr class="text4_user">
                                                                <td height="30" colspan="3" class="text4_user">
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr class="text4_user">
                                                                            <td width="25%" height="30" class="text4_user">
                                                                                <div align="right" class="style3">Village (Native Place) </div>
                                                                            </td>
                                                                            <td width="2%" class="text4_user">&nbsp;</td>
                                                                            <td width="73%" class="text4_user">
                                                                                <span class="text2">
                                                                                    <select name="village_id">
                                                                                        <option value=""> Any Village </option>
                                                                                        <?php
                                                                                        while ($vill = mysqli_fetch_array($chk_vill)) {
                                                                                        ?>
                                                                                            <option value="<?php echo $vill['village_id']; ?>"> <?php echo $vill['village_name']; ?> </option>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </select>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="text4_user">
                                                                            <td height="30" class="text4_user">
                                                                                <div align="right" class="style3">Gotra</div>
                                                                            </td>
                                                                            <td class="text4_user">&nbsp;</td>
                                                                            <td class="text4_user">
                                                                                <span class="text2">
                                                                                    <select name="gotra_id">
                                                                                        <option value=""> Any Gotra </option>
                                                                                        <?php
                                                                                        while ($gotra = mysqli_fetch_array($chk_gotra)) {
                                                                                        ?>
                                                                                            <option value="<?php echo $gotra['gotra_id']; ?>"> <?php echo $gotra['gotra_name']; ?> </option>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="text4_user">
                                                                            <td height="30" class="text4_user">
                                                                                <div align="right" class="style3">First Name </div>
                                                                            </td>
                                                                            <td class="text4_user">&nbsp;</td>
                                                                            <td class="text4_user">
                                                                                <span class="text2">
                                                                                    <input type="text" name="fname_vc" />
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="text4_user">
                                                                            <td height="30" class="text4_user">
                                                                                <div align="right" class="style3">Last Name </div>
                                                                            </td>
                                                                            <td class="text4_user">&nbsp;</td>
                                                                            <td class="text4_user">
                                                                                <span class="text2">
                                                                                    <input type="text" name="lname_vc" />
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="text4_user">
                                                                            <td height="30" class="text4_user">
                                                                                <div align="right" class="style3">Current Location </div>
                                                                            </td>
                                                                            <td class="text4_user">&nbsp;</td>
                                                                            <td class="text4_user">
                                                                                <span class="text2">
                                                                                    <input type="text" name="location" />
                                                                                </span><span class="text2"><span class="text">(Eg : City / State / Country)</span></span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr class="text4_user">
                                                                <td width="25%" height="30" class="text4_user">&nbsp;</td>
                                                                <td width="2%" height="30" class="text4_user">&nbsp;</td>
                                                                <td width="73%" height="30" class="text4_user"><input type="submit" value="Click here to Search"></td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </td>
                                            </tr>




                                            <?php
                                            if ($_POST) {
                                            ?>
                                                <tr style="vertical-align: top !important">
                                                    <td width="1%" valign="top">&nbsp;</td>
                                                    <td width="0%" valign="top">&nbsp;</td>
                                                    <td width="69%" style="vertical-align: top !important">
                                                        <table width="100%" border="0"  cellpadding="0" cellspacing="0" style="vertical-align: top !important">
                                                            <tbody style="vertical-align: top !important">
                                                            <tr bgcolor="#f2f2f2" >
                                                               
                                                                <td width="98%" colspan="5" align="left"  bgcolor="#ffffff">
                                                                    <?php
                                                                    $ctr = 1;
                                                                    while ($dt_vastipatrak = mysqli_fetch_array($chk_vastipatrak)) {

                                                                        $fid = "&FId=" . $dt_vastipatrak['vasti_id'];

                                                                        // if($_GET['mode']=="H" && $_GET['FId']!="") 	
                                                                        // 	$hid = "&HId=".$dt_vastipatrak['vasti_id']."&FId=".$_GET['FId'];
                                                                        // if($_GET['mode']=="H" && $_GET['FId']=="") 	
                                                                        // 	$hid = "&HId=".$dt_vastipatrak['vasti_id'];


                                                                        //$src = "signup.php?mode=".$_GET['mode']."&Code=".$_GET['Code']."&Mode=".$_GET['Mode']."&HCode=".$_GET['HCode'] . $fid . $hid;
                                                                        if ($_GET['id'] == '')
                                                                            $src = "lineage_m.php?Code=" . $_GET['id'] . "&Mode=A&HCode=" . $dt_vastipatrak['vasti_id'] . "&level=0";
                                                                        else
                                                                            $src = "lineage_m.php?Code=" . $_GET['id'] . "&Mode=E&HCode=" . $dt_vastipatrak['vasti_id'] . "&level=0";
                                                                    ?>
                                                                        <table width="98%" border="0" cellspacing="0" valign="top" bgcolor="#fbfbfb">
                                                                            <tr>
                                                                                <td width="2%" class="text4_user"></td>
                                                                                <td width="47%" class="text4_user"><?php echo $dt_vastipatrak['fname_vc'] . " " . $dt_vastipatrak['mname_vc'] . " " . $dt_vastipatrak['lname_vc']; ?></td>
                                                                                <td width="17%" rowspan="3" class="text_user">
                                                                                    <div align="center"><img src="" width="120" height="130" /></div>
                                                                                </td>
                                                                                <td width="34%" rowspan="3" valign="top" style="padding-top:20px;">
                                                                                    <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                                        <tr>
                                                                                            <td height="25" class="text_user" style="padding-left:3px;"><a href="<?php echo $src; ?>" class="title1">Link as Father</a></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="1" bgcolor="#ac2615"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="25" class="text_user" style="padding-left:3px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="1" bgcolor="#ac2615"></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="text">
                                                                                <td class="text_user">&nbsp;</td>
                                                                                <td class="text_user"><span class="text4_user">Native</span>: <?php echo $dt_vastipatrak['village_name']; ?></td>
                                                                            </tr>
                                                                            <tr class="text">
                                                                                <td class="text_user">&nbsp;</td>
                                                                                <td class="text_user"><span class="text4_user">Gotra</span>: <?php echo $dt_vastipatrak['gotra_name']; ?></td>
                                                                            </tr>
                                                                            <tr class="text">
                                                                                <td height="8" colspan="4" class="text_user"></td>
                                                                            </tr>
                                                                            <tr class="text">
                                                                                <td colspan="4" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                                                            </tr>
                                                                            <tr bgcolor="#f2f2f2">
                                                                                <td bgcolor="#FFFFFF">&nbsp;</td>
                                                                                <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                                                <td align="left" colspan="2" valign="middle" bgcolor="#ffffff">&nbsp;</td>
                                                                            </tr>
                                                                        </table>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
</tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>