<?php
ob_start();
include "connection/conn.php";
// require "noentry.php";
// include "noentry.php";
require 'include/appmain.php';



session_start();

if ($_POST) {

    $sqlInsert = "update userUpdates set answer='" . $_POST['answer'] . "',replyBy='" . $_SESSION["UserAdminCode"] . "',replyEntry='" . date('d-m-Y h:i:s') . "' where quesId=" . $_POST['id'];
    $resQuery = mysqli_query($cn, $sqlInsert);
    redirect("query_list.php");
}

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
                                                                <form name="frm" method="post" action="" id="frmS" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ? $_GET['id'] : '1'; ?>">
                                                                    <table width="100%" border="1" bordercolor="C1C1C1" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">

                                                                        <?php
                                                                        $i = 1;
                                                                        while ($rec = mysqli_fetch_array($check_res)) {
                                                                        ?>
                                                                            <tr valign="middle">
                                                                                <td height="30" class="text"><b>Query/Suggestion</b></td>
                                                                                <td height="30" class="text"><?php echo ($rec['question']); ?></td>

                                                                            </tr>
                                                                            <?php if ($rec['vasti_id'] != 0) { ?>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>Member name</b></td>
                                                                                    <td height="30" class="text"><?php echo ($rec['member']); ?>&nbsp;</td>
                                                                                </tr>
                                                                            <?php } else { 
                                                                                $nativeDetail=mysqli_fetch_array(mysqli_query($cn,"select * from "))
                                                                                ?>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>name</b></td>
                                                                                    <td height="30" class="text"><?php echo ($rec['name']); ?>&nbsp;</td>
                                                                                </tr>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>Father name</b></td>
                                                                                    <td height="30" class="text"><?php echo ($rec['fatherName']); ?>&nbsp;</td>
                                                                                </tr>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>Grand Father name</b></td>
                                                                                    <td height="30" class="text"><?php echo ($rec['grandfatherName']); ?>&nbsp;</td>
                                                                                </tr>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>Address</b></td>
                                                                                    <td height="30" class="text"><?php echo ($rec['address']); ?>&nbsp;</td>
                                                                                </tr>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>Email</b></td>
                                                                                    <td height="30" class="text"><?php echo ($rec['emailaddress']); ?>&nbsp;</td>
                                                                                </tr>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>Number</b></td>
                                                                                    <td height="30" class="text"><?php echo ($rec['phonenumber']); ?>&nbsp;</td>
                                                                                </tr>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>Native</b></td>
                                                                                    <td height="30" class="text"><?php 
                                                                                    if($rec['native']!= ''){
                                                                                        $native_detail=mysqli_fetch_array(mysqli_query($cn,"select * from  village_m where village_id=".$rec['native']));
                                                                                        echo $native_detail['village_name'];

                                                                                    }else{
                                                                                        echo '-';
                                                                                    }
                                                                                     ?>&nbsp;</td>
                                                                                </tr>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>Gotra</b></td>
                                                                                    <td height="30" class="text"><?php 
                                                                                      if($rec['gotra']!= ''){
                                                                                        $native_detail=mysqli_fetch_array(mysqli_query($cn,"select * from  gotra_m where gotra_id=".$rec['gotra']));
                                                                                        echo $native_detail['gotra_name'];

                                                                                    }else{
                                                                                        echo '-';
                                                                                    }
                                                                                    ?>&nbsp;</td>
                                                                                </tr>
                                                                                <tr valign="middle">
                                                                                    <td height="30" class="text"><b>Country</b></td>
                                                                                    <td height="30" class="text"><?php 
                                                                                      if($rec['country']!= ''){
                                                                                        $native_detail=mysqli_fetch_array(mysqli_query($cn,"select * from  country_m where country_id=".$rec['country']));
                                                                                        echo $native_detail['country_name'];

                                                                                    }else{
                                                                                        echo '-';
                                                                                    }
                                                                                    ?>&nbsp;</td>
                                                                                </tr>

                                                                            <?php } ?>
                                                                            <tr valign="middle">
                                                                                <td height="30" class="text"><b>Admin Reply</b> </td>
                                                                                <td>
                                                                                    <textarea name="answer" id="answer" cols="60" rows="10"><?php echo $rec['answer']; ?></textarea>
                                                                                    <script type="text/javascript">
                                                                                        CKEDITOR.replace('answer');
                                                                                    </script>
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                            $i++;
                                                                        }
                                                                        ?>
                                                                        <tr valign="middle">
                                                                            <td height="30" class="text" colspan="2">
                                                                                <input name="submit" type="submit" value="Submit" width="71" height="24" border="0" />
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