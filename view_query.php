<?php
ob_start();
error_reporting(E_ALL);
include_once "admin/connection/conn.php";
require 'admin/include/appmain.php';
require 'admin/utility/querygen.inc';

$oQGen = new CQueryGen();
$oQGen1 = new CQueryGen();

$sql_mainmem = "select * from userUpdates where quesId=" . $_GET['id'];
$chk_mainmem = mysqli_query($cn, $sql_mainmem);


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
                           
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                           
                            <?php
                            if (mysqli_num_rows($chk_mainmem) > 0) { ?>
                                <table width="97%" border="0" cellspacing="0" cellpadding="0">

                                  
                                    <?php while ($rowQuery = mysqli_fetch_array($chk_mainmem)) {
                                    ?>
                                        <tr>
                                            <td ><strong>Type:</strong><?php echo ($rowQuery['quesType'] == 1) ? 'query' : 'Feedback/suggestion'; ?>&nbsp;</td>
                                        </tr><tr>
                                            <td ><strong>Query/Suggestion:</strong><?php echo ($rowQuery['question']); ?>&nbsp;</td>
                                            </tr><tr>
                                            <td ><strong>Reply:</strong><?php echo ($rowQuery['answer']); ?>
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