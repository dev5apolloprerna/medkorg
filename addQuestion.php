<?php
ob_start();
error_reporting(E_ALL);
include_once "admin/connection/conn.php";
require 'admin/include/appmain.php';
require 'admin/utility/querygen.inc';

$oQGen = new CQueryGen();
$oQGen1 = new CQueryGen();

$sql_mainmem = "select * from userUpdates where vasti_id=" . $_SESSION['VastiId'];
$chk_mainmem = mysqli_query($cn, $sql_mainmem);
if ($_POST) {

    $sqlInsert = "insert into userUpdates (quesType,question,answer,vasti_id,strEnterDatetime) values ('" . $_POST['quesTYpe'] . "','" . $_POST['question'] . "','','" . $_POST['vasti_id'] . "','" . date('d-m-Y h:i:s') . "')";
    $resQuery = mysqli_query($cn, $sqlInsert);
    $insertId = mysqli_insert_id($cn);
    redirect("user-homepage.php");
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


    <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="mm_menu.js" type="text/javascript"></script>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/facebox.js" type="text/javascript"></script>


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
                            <?php include_once "menu.php"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <table width="1003" border="0" cellspacing="0" cellpadding="0" style="margin-top: 25px;">
                                <tr>
                                    <td height="22" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x;">&nbsp;</td>
                                </tr>
                                <tr>

                                    <td align="center" valign="top">
                                        <form name="frm" method="post" action="" id="frmS" enctype="multipart/form-data">
                                            <input type="hidden" name="quesTYpe" value="<?php echo $_GET['type'] ? $_GET['type'] : '1'; ?>">
                                            <input type="hidden" name="vasti_id" value="<?php echo $_SESSION['VastiId']; ?>">

                                            <table width="97%" border="0" cellspacing="3" cellpadding="3">
                                                <tr><th align="center">Add Your Question/Query/Suggestion/Feedback</th></tr>
                                                <tr>
                                                    <td align="center"  class="border1">
                                                        <table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" class="text">
                                                            <tr>
                                                                <td id="tdfname_label" width="21%">
                                                                    <div align="right">Your Question</div>
                                                                </td>
                                                                <td height="35" style="padding-left:08px;margin-top: 10px;">
                                                                    <textarea name="question" class="txtreqd txtbox1" id="question" cols="50" rows="5"></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr bgcolor="#f2f2f2">
                                                                <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                                <td width="45%" align="left" valign="middle" bgcolor="#ffffff">
                                                                    <div align="center">
                                                                        <input name="submit" type="submit" value="Submit" width="71" height="24" border="0" />
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
                            <?php
                            if (mysqli_num_rows($chk_mainmem) > 0) { ?>
                                <table width="90%" border="1" cellspacing="5" cellpadding="5" style="margin-top: 25px;" >
                                    <tr>
                                        <th colspan="3"> Query & suggestion List</th>
                                    </tr>
                                    <tr>
                                        <td>Type</td>
                                        <td>Query/Suggestion</td>
                                        <td>View</td>
                                    </tr>
                                    <?php while ($rowQuery = mysqli_fetch_array($chk_mainmem)) {
                                    ?>
                                        <tr>
                                            <td height="30" class="text"><?php echo ($rowQuery['quesType'] == '1') ? 'query' : 'Feedback/suggestion'; ?>&nbsp;</td>
                                            <td height="30" class="text"><?php echo ($rowQuery['question']); ?>&nbsp;</td>
                                            <td height="30" class="text">
                                                <?php

                                                if ($rowQuery['answer'] != '') { ?>
                                                    <a href="view_query.php?id=<?php echo ($rowQuery['quesId']); ?>" class="sublink" target="_blank"> View </a>
                                                <?php } ?>
                                            </td>

                                        </tr>

                                    <?php } ?>
                                </table><?php
                                    } ?>

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
        <tr>
            <td height="38" align="center" valign="middle" bgcolor="#834153">
                <table width="96%" border="0" align="center" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left" valign="middle" class="footer">All Rights Reserved By : Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti</td>
                        <td align="right" valign="middle" class="footer">Website Designed By :<a href="https://apolloinfotech.com/" target="_blank"> Apollo Infotech</a></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>