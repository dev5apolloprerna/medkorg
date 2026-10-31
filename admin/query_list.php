<?php
ob_start();
include "connection/conn.php";
// require "noentry.php";
 include "noentry.php";


session_start();

if ($_POST) {

    $redirect = "query_list.php";
    header("Location: $redirect");
    exit;
}

if($_GET['mode'] == 'D'){

    $sqlInsert = "delete from userUpdates  where quesId=" . $_GET['id'];
    $resQuery = mysqli_query($cn, $sqlInsert);

    $redirect = "query_list.php?type=".$_GET['type'];
    header("Location: $redirect");
    exit;
}

if ($_GET['type'] == 'pending') {
    $sql_string = 'SELECT *,(select CONCAT(fname_vc," ",mname_vc," ",lname_vc) as name FROM `vastipatrak_m` WHERE vastipatrak_m.vasti_id=userUpdates.vasti_id) as  member FROM userUpdates where answer = "" or answer IS NULL order by quesId desc';
} else if ($_GET['type'] == '1') {
    $sql_string = 'SELECT *,(select CONCAT(fname_vc," ",mname_vc," ",lname_vc) as name FROM `vastipatrak_m` WHERE vastipatrak_m.vasti_id=userUpdates.vasti_id) as  member FROM userUpdates where quesType=1 order by quesId desc';
} else if ($_GET['type'] == '2') {
    $sql_string = 'SELECT *,(select CONCAT(fname_vc," ",mname_vc," ",lname_vc) as name FROM `vastipatrak_m` WHERE vastipatrak_m.vasti_id=userUpdates.vasti_id) as  member FROM userUpdates where quesType=2 order by quesId desc';
} else if ($_GET['type'] == '3') {
    $sql_string = 'SELECT *,(select CONCAT(fname_vc," ",mname_vc," ",lname_vc) as name FROM `vastipatrak_m` WHERE vastipatrak_m.vasti_id=userUpdates.vasti_id) as  member FROM userUpdates where quesType=3 order by quesId desc';
} else {
    $sql_string = 'SELECT *,(select CONCAT(fname_vc," ",mname_vc," ",lname_vc) as name FROM `vastipatrak_m` WHERE vastipatrak_m.vasti_id=userUpdates.vasti_id) as  member FROM userUpdates order by quesId desc';
}


$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
$row_cnt = mysqli_num_rows($check_res);
?>
<html>

<head>
    <title>Samaj</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="css/adminstyle.css" rel="stylesheet" type="text/css">


    <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
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
                                                <td width="25%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr valign="top">
                                                <td>&nbsp;</td>
                                                <td class="h1"><span class="h1">VastiPatrak Members Query List </span></td>
                                            </tr>
                                            <tr valign="top">
                                                <td width="1%">&nbsp;</td>
                                                <td width="85%">
                                                    <form name="frm" method="Post" action="approval_list.php">
                                                        <input type="hidden" name="txtMode" value="<?php echo $vartxtMode; ?>" />
                                                        <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3"><a href="query_list.php">All</a> |<a href="query_list.php?type=pending">Pending Query </a> | <a href="query_list.php?type=1"> VP Query</a> | <a href="query_list.php?type=2"> Feedback/Suggestion </a> | <a href="query_list.php?type=3"> Need Support </a></td>
                                                            </tr>
                                                            <tr valign="top">

                                                                <td width="2%">&nbsp;</td>
                                                                <td colspan="3">
                                                                    <table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
                                                                        <tr valign="middle" bgcolor="#4C6B83">
                                                                            <td width="3%" height="22" bgcolor="#161709" class="textmenuhead"></td>
                                                                            <td width="10%" bgcolor="#161709" class="text">
                                                                                <div align="left">
                                                                                    <font color="#FFFFFF"><b>Type</b></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="10%" bgcolor="#161709" class="text">
                                                                                <div align="left">
                                                                                    <font color="#FFFFFF"><b>Query/Fedback</b></font>
                                                                                </div>
                                                                            </td>

                                                                            <td width="8%" bgcolor="#161709" class="text">
                                                                                <div align="left">
                                                                                    <font color="#FFFFFF"><b>Member</b></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="8%" bgcolor="#161709" class="text">
                                                                                <div align="left">
                                                                                    <font color="#FFFFFF"><b>Entry Date</b></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="8%" bgcolor="#161709" class="text">
                                                                                <div align="left">
                                                                                    <font color="#FFFFFF"><b>Reply Detail</b></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="8%" bgcolor="#161709" class="text">Action</td>
                                                                        </tr>
                                                                        <?php
                                                                        $i = 1;
                                                                        while ($rec = mysqli_fetch_array($check_res)) {

                                                                        ?>
                                                                            <tr valign="middle">
                                                                                <td height="30"><?php echo $i; ?></td>
                                                                                <td height="30" class="text"><?php if ($rec['quesType'] == 1)
                                                                                                                    echo  'VP query';
                                                                                                                else if ($rec['quesType'] == 2)
                                                                                                                    echo 'Feedback/suggestion';
                                                                                                                else
                                                                                                                    echo 'Support Query'; ?>&nbsp;</td>
                                                                                <td height="30" class="text"><?php echo ($rec['question']); ?>&nbsp;</td>
                                                                                <td height="30" class="text"><?php echo $rec['vasti_id'] != 0 ? ($rec['member']) : $rec['name']; ?>&nbsp;
                                                                                    <?php
                                                                                    if ($rec['vasti_id'] != 0) {
                                                                                        $userDetail = mysqli_fetch_array(mysqli_query($cn, 'select *,(select village_name from village_m where village_m.village_id=vastipatrak_m.village_id) as village,(select city_name from city_m where city_m.city_id=vastipatrak_m.city) as cityname from vastipatrak_m where vasti_id=' . $rec['vasti_id']));
                                                                                        echo '<br />Mobile: ' . $userDetail['mobile_home'] . '<br />Native: ' . $userDetail['village'] . '<br>Current City: ' . $userDetail['cityname'];
                                                                                    } else {
                                                                                        echo '<br />Mobile: '.$rec['phonenumber'];
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td height="30" class="text"><?php echo date('d-m-Y', strtotime($rec['strEnterDatetime'])); ?>&nbsp;</td>
                                                                                <td height="30" class="text">
                                                                                    <?php
                                                                                    if ($rec['answer'] != '') {
                                                                                        $userDetail = mysqli_fetch_array(mysqli_query($cn, 'select * from user_m where user_code=' . $_SESSION["UserAdminCode"]));
                                                                                        echo '<br />LoginID: ' . $userDetail['user_login'] . '<br />Reply Date: <br />' . date('d-m-Y', strtotime($rec['replyEntry']));
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td height="30" class="text">
                                                                                    <a href="query_reply.php?id=<?php echo ($rec['quesId']); ?>" class="sublink"> Reply </a> &nbsp;
                                                                                    <?php if ($rec['answer'] != '') { ?>
                                                                                        | &nbsp; <a href="view_query.php?id=<?php echo ($rec['quesId']); ?>" class="sublink"> View </a>
                                                                                    <?php } ?>
                                                                                    <a href="query_list.php?type=<?php echo $_GET['type'];?>&id=<?php echo ($rec['quesId']); ?>&mode=D" class="sublink"> | Delete </a> &nbsp;
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                            $i++;
                                                                        }
                                                                        ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td>&nbsp;</td>
                                                                <td colspan="3">&nbsp;</td>
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
</body>

</html>