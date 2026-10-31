<?php
ob_start();
include "connection/conn.php";
// require "noentry.php";
// include "noentry.php";
require 'include/appmain.php';



session_start();



$sql_string = 'SELECT *,(select CONCAT(fname_vc," ",mname_vc," ",lname_vc) as name FROM `vastipatrak_m` WHERE vastipatrak_m.vasti_id=userUpdates.vasti_id) as  member FROM userUpdates where quesId=' . $_GET['id'];

$check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));

?>
<html>

<head>
    <title>Samaj</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="css/adminstyle.css" rel="stylesheet" type="text/css">


    <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/facebox.js" type="text/javascript"></script>
    <script language="javascript" src="ckeditor/ckeditor.js"></script>
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
                                                <td class="h1"><span class="h1">VastiPatrak Members Query/Suggestion Reply </span></td>
                                            </tr>
                                            <tr valign="top">
                                                <td width="1%">&nbsp;</td>
                                                <td width="85%">

                                                    <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">

                                                        <tr valign="top">
                                                            <td width="2%">&nbsp;</td>
                                                            <td colspan="3">
                                                               
                                                                    <table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">

                                                                        <?php
                                                                        $i = 1;
                                                                        while ($rec = mysqli_fetch_array($check_res)) {
                                                                        ?>
                                                                            <tr valign="middle">
                                                                                <td height="30" class="text"><b>Query/Suggestion</b></td>
                                                                                <td height="30" class="text"><?php echo ($rec['question']); ?></td>

                                                                            </tr>

                                                                            <tr valign="middle">
                                                                                <td height="30" class="text"><b>Member name</b></td>
                                                                                <td height="30" class="text"><?php echo ($rec['member']); ?>&nbsp;</td>
                                                                            </tr>

                                                                            <tr valign="middle">
                                                                                <td height="30" class="text"><b>Admin Reply</b> </td>
                                                                                <td>
                                                                                   <?php echo $rec['answer']; ?>
                                                                                   
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                            $i++;
                                                                        }
                                                                        ?>
                                                                      
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