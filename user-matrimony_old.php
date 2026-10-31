<?php
include_once "noentry.php";
include_once "admin/connection/conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/userjvalid.js"></script>

    <script type='text/JavaScript' src='js/scw.js'></script>

    <script language="javascript" type="text/javascript">
        function showhideDiv(val) {
            if (val == "" || val == "H" || val == "S" || val == "R") {
                document.getElementById("trbusiness").style.display = "none";
                document.getElementById("trprof").style.display = "none";
                document.getElementById("trjob").style.display = "none";
                document.getElementById("tdaddr").style.display = "none";
            }
            if (val == "B") {
                document.getElementById("trbusiness").style.display = "";
                document.getElementById("trprof").style.display = "none";
                document.getElementById("trjob").style.display = "none";
                document.getElementById("tdaddr").style.display = "";
            }
            if (val == "P") {
                document.getElementById("trbusiness").style.display = "none";
                document.getElementById("trprof").style.display = "";
                document.getElementById("trjob").style.display = "none";
                document.getElementById("tdaddr").style.display = "";
            }
            if (val == "J") {
                document.getElementById("trbusiness").style.display = "none";
                document.getElementById("trprof").style.display = "none";
                document.getElementById("trjob").style.display = "";
                document.getElementById("tdaddr").style.display = "";
            }
        }
        //$src = "family_link_search.php?mode=F&Code=".$varCode."&Mode=".$_GET['Mode']."&HCode=".$_GET['HCode']."&HId=".$_GET['HId'];

        function doSub(mode, Code, Mode, HCode, HId, FId, stype, a_id) {
            var st = document.getElementById(stype).value;
            if (st != 'f')
                document.getElementById(a_id).href = "family_link_search.php?mode=" + mode + "&Code=" + Code + "&Mode=" + Mode + "&HCode=" + HCode + "&HId=" + HId + "&FId=" + FId + "&stype=" + st;
            else
                document.getElementById(a_id).href = "family_link_result.php?mode=" + mode + "&Code=" + Code + "&Mode=" + Mode + "&HCode=" + HCode + "&HId=" + HId + "&FId=" + FId + "&stype=" + st;

        }
    </script>
    <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="mm_menu.js" type="text/javascript"></script>
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
        .style1 {
            color: #222222
        }
        -->
        input[type=submit],
        input[type=reset]
        {
        background-color:#9C1212;
        color:
        white;
        padding:
        5px;
        }
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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

<?php
session_start();

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    die("No ID found in the URL");
}

$query_execute = "SELECT * FROM matrimony where user_id = $user_id";
$result_execute = mysqli_query($cn, $query_execute);
$row = mysqli_fetch_assoc($result_execute);
$user_fetch_data_userid = $row['user_id'];
$user_fetch_data_id = $row['id'];

if ($user_fetch_data_id != "") {
    $height = explode(".", $row['height']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Retrieve existing data from the database for full_photo, passport_size_photo, and biodata
        $sql = "SELECT full_photo, passport_size_photo, biodata FROM matrimony WHERE id='$user_fetch_data_id'";
        $result = $cn->query($sql);
        $existingData = $result->fetch_assoc();

        // Get form data
        $height = implode(".", $_POST['height']);
        //  $height[1] = substr($height[1], 0, 1);
        $weight = $_POST['weight'];
        $birth_place = $_POST['birth_place'];
        $birth_time = $_POST['birth_time'];
        $hobby = $_POST['hobby'];
        $spectacles = $_POST['spectacles'];
        $mangal = $_POST['mangal'];
        $sani = $_POST['sani'];
        $annual_income = $_POST['annual_income'];

        $full_photo = $_FILES['full_photo'];
        $passport_size_photo = $_FILES['passport_size_photo'];
        $biodata = $_FILES['biodata'];

        $baseDir = 'documents/' . $user_id;
        $full_photoDir = $baseDir . '/full_photo/';
        $passport_size_photoDir = $baseDir . '/passport_size_photo/';
        $biodataDir = $baseDir . '/biodata/';

        // Create directories if they don't exist
        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }
        if (!is_dir($full_photoDir)) {
            mkdir($full_photoDir, 0777, true);
        }
        if (!is_dir($passport_size_photoDir)) {
            mkdir($passport_size_photoDir, 0777, true);
        }
        if (!is_dir($biodataDir)) {
            mkdir($biodataDir, 0777, true);
        }

        // Initialize variables to hold file names
        $full_photo_name = $existingData['full_photo']; // Default to existing file
        $passport_size_photo_name = $existingData['passport_size_photo']; // Default to existing file
        $biodataName = $existingData['biodata']; // Default to existing file

        // // Upload full photo if exists
        // if (!empty($full_photo['name'])) {
        //     $full_photo_name = basename($full_photo['name']);
        //     move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
        // }

        // // Upload passport size photo if exists
        // if (!empty($passport_size_photo['name'])) {
        //     $passport_size_photo_name = basename($passport_size_photo['name']);
        //     move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
        // }

        // // Upload biodata if exists
        // if (!empty($biodata['name'])) {
        //     $biodataName = basename($biodata['name']);
        //     move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
        // }
        $maxFileSize = 1 * 1024 * 1024;

        // Validate full photo size
        if (!empty($full_photo['name'])) {
            if ($full_photo['size'] > $maxFileSize) {
                echo "<script>alert('Error: Full photo size exceeds 1MB.')</script>";
                exit;
            } else {
                $full_photo_name = basename($full_photo['name']);
                move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
            }
        }

        // Validate passport size photo size
        if (!empty($passport_size_photo['name'])) {
            if ($passport_size_photo['size'] > $maxFileSize) {
                echo "<script>alert('Error: Passport size photo size exceeds 1MB.')</script>";
                exit;
            } else {
                $passport_size_photo_name = basename($passport_size_photo['name']);
                move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
            }
        }

        // Validate biodata size (PDF)
        if (!empty($biodata['name'])) {
            if ($biodata['size'] > $maxFileSize) {
                echo "<script>alert('Error: Biodata (PDF) size exceeds 1MB.')</script>";
                exit;
            } else {
                $biodataName = basename($biodata['name']);
                move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
            }
        }

        // Prepare update query
        $updated_sql_query = "
            UPDATE `matrimony`
            SET 
                `height`='$height',
                `weight`='$weight',
                `birth_place`='$birth_place',
                `birth_time`='$birth_time',
                `hobby`='$hobby',
                `spectacles`='$spectacles',
                `mangal`='$mangal',
                `sani`='$sani',
                `annual_income`='$annual_income',
                `full_photo`='$full_photo_name',
                `passport_size_photo`='$passport_size_photo_name',
                `biodata`='$biodataName'
            WHERE id='$user_fetch_data_id'";

        // Execute the query
        $result = $cn->query($updated_sql_query);

        if ($result) {
            header("Location:user-familydet.php");
            exit();
        } else {
            echo "Error: " . $cn->error;
        }
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $height = implode(".", $_POST['height']);
        $weight = $_POST['weight'];
        $birth_place = $_POST['birth_place'];
        $birth_time = $_POST['birth_time'];
        $hobby = $_POST['hobby'];
        $spectacles = $_POST['spectacles'];
        $mangal = $_POST['mangal'];
        $sani = $_POST['sani'];
        $annual_income = $_POST['annual_income'];

        $full_photo = $_FILES['full_photo'];
        $full_photo_db = $full_photo['name'];

        $passport_size_photo = $_FILES['passport_size_photo'];

        $passport_size_photo_db = $passport_size_photo['name'];
        $biodata = $_FILES['biodata'];

        $baseDir = 'documents/' . $user_id;
        $full_photoDir = $baseDir . '/full_photo/';
        // $full_photo = $baseDir . '/full_photo/';
        $passport_size_photoDir = $baseDir . '/passport_size_photo/';
        $biodataDir = $baseDir . '/biodata/';

        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }
        // if (!is_dir($photoDir)) {
        //     mkdir($photoDir, 0777, true);
        // }
        if (!is_dir($full_photoDir)) {
            mkdir($full_photoDir, 0777, true);
        }
        if (!is_dir($passport_size_photoDir)) {
            mkdir($passport_size_photoDir, 0777, true);
        }
        if (!is_dir($biodataDir)) {
            mkdir($biodataDir, 0777, true);
        }

        $full_photo_name = '';
        $passport_size_photo_name = '';
        $biodataName = '';

        // // Upload full photo if exists
        // if (!empty($full_photo['name'])) {
        //     $full_photo_name = basename($full_photo['name']);
        //     move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
        // }

        // // Upload passport size photo if exists
        // if (!empty($passport_size_photo['name'])) {
        //     $passport_size_photo_name = basename($passport_size_photo['name']);
        //     move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
        // }

        // // Upload biodata if exists
        // if (!empty($biodata['name'])) {
        //     $biodataName = basename($biodata['name']);
        //     move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
        // }

        $maxFileSize = 1 * 1024 * 1024;

        // Validate full photo size
        if (!empty($full_photo['name'])) {
            if ($full_photo['size'] > $maxFileSize) {
                echo "<script>alert('Error: Full photo size exceeds 1MB.')</script>";
                exit;
            } else {
                $full_photo_name = basename($full_photo['name']);
                move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
            }
        }

        // Validate passport size photo size
        if (!empty($passport_size_photo['name'])) {
            if ($passport_size_photo['size'] > $maxFileSize) {
                echo "<script>alert('Error: Passport size photo size exceeds 1MB.')</script>";
                exit;
            } else {
                $passport_size_photo_name = basename($passport_size_photo['name']);
                move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
            }
        }

        // Validate biodata size (PDF)
        if (!empty($biodata['name'])) {
            if ($biodata['size'] > $maxFileSize) {
                echo "<script>alert('Error: Biodata (PDF) size exceeds 1MB.')</script>";
                exit;
            } else {
                $biodataName = basename($biodata['name']);
                move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
            }
        }


        $sql = "INSERT INTO `matrimony`(`user_id`,`height`, `weight`, `birth_place`,`birth_time`,`hobby`, `spectacles`, `mangal`,`sani`, `annual_income`, `full_photo`,`passport_size_photo`, `biodata`) VALUES ($user_id,'$height','$weight','$birth_place','$birth_time','$hobby','$spectacles','$mangal','$divorce','$annual_income','$full_photo_db','$passport_size_photo_db','$biodataName')";

        $result = $cn->query($sql);

        if ($result) {
            header("Location:user-familydet.php");
            exit();
        } else {
            echo "Error: " . $cn->error;
        }
    }
}


?>


<body>

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
                                    shyam <td height="34">&nbsp;</td>
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
                                                            <td align="center" valign="top" class="border1">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tr bgcolor="#f2f2f2">
                                                                        <td width="2%" height="37">&nbsp;</td>
                                                                        <td height="37" align="left" valign="middle" class="title">
                                                                            Apply for MEDK matrimonial
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <?php
                                                            if ($user_fetch_data_id != "") {
                                                            ?>
                                                                <form id="update_matrimonyForm" method="POST" enctype="multipart/form-data">
                                                                    <table width="98%" border="0" cellspacing="0" cellpadding="0">
                                                                        <!-- Height Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Height</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <div class="row align-items-center"> <!-- Added align-items-center for vertical alignment -->
                                                                                    <div class="col-lg-2">
                                                                                        <!-- <input type="text" id="restrictedInput" name="height[]" placeholder="5 ft" minlength="1" style="width: 144%;" maxlength="1"
                                                                                            oninput="validateInput(this)" value="<?= $height[0]; ?>"> -->
                                                                                        <select name="height[]" style="width: 144%;" required>
                                                                                            <option value="4" <?php echo (isset($height[0]) && $height[0] == '4') ? 'selected' : ''; ?>>4 ft</option>
                                                                                            <option value="5" <?php echo (isset($height[0]) && $height[0] == '5') ? 'selected' : ''; ?>>5 ft</option>
                                                                                            <option value="6" <?php echo (isset($height[0]) && $height[0] == '6') ? 'selected' : ''; ?>>6 ft</option>
                                                                                            <option value="7" <?php echo (isset($height[0]) && $height[0] == '7') ? 'selected' : ''; ?>>7 ft</option>
                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="col-lg-1 text-center"> <!-- Added text-center for center alignment -->
                                                                                        <label class="form-label mb-0">.</label> <!-- Removed for attribute since it's not needed -->
                                                                                    </div>

                                                                                    <div class="col-lg-2">
                                                                                        <!-- <input type="number" id="numberInput" name="height[]" min="1" placeholder="6 inch" max="12" maxlength="2" oninput="validateInput_inch(this)" style="width: 144%;" value=""> -->
                                                                                        <select name="height[]" style="width: 144%;">
                                                                                            <option value="1" <?php echo (isset($height[1]) && $height[1] == '1') ? 'selected' : ''; ?>>1 inch</option>
                                                                                            <option value="2" <?php echo (isset($height[1]) && $height[1] == '2') ? 'selected' : ''; ?>>2 inch</option>
                                                                                            <option value="3" <?php echo (isset($height[1]) && $height[1] == '3') ? 'selected' : ''; ?>>3 inch</option>
                                                                                            <option value="4" <?php echo (isset($height[1]) && $height[1] == '4') ? 'selected' : ''; ?>>4 inch</option>
                                                                                            <option value="5" <?php echo (isset($height[1]) && $height[1] == '5') ? 'selected' : ''; ?>>5 inch</option>
                                                                                            <option value="6" <?php echo (isset($height[1]) && $height[1] == '6') ? 'selected' : ''; ?>>6 inch</option>
                                                                                            <option value="7" <?php echo (isset($height[1]) && $height[1] == '7') ? 'selected' : ''; ?>>7 inch</option>
                                                                                            <option value="8" <?php echo (isset($height[1]) && $height[1] == '8') ? 'selected' : ''; ?>>8 inch</option>
                                                                                            <option value="9" <?php echo (isset($height[1]) && $height[1] == '9') ? 'selected' : ''; ?>>9 inch</option>
                                                                                            <option value="10" <?php echo (isset($height[1]) && $height[1] == '10') ? 'selected' : ''; ?>>10 inch</option>
                                                                                            <option value="11" <?php echo (isset($height[1]) && $height[1] == '11') ? 'selected' : ''; ?>>11 inch</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Weight Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Weight (in Kg's)</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="number" name="weight" id="weight" placeholder="Weight in kg" style="width: 55%;" maxlength="25" value="<?= $row['weight']; ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Birth Place Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Place</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="birth_place" id="birth_place" placeholder="Birth Place" style="width: 55%;" maxlength="50" value="<?= $row['birth_place']; ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Birth Time Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Time</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="datetime-local" name="birth_time" id="birth_time" style="width: 55%;" maxlength="50" value="<?= $row['birth_time']; ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- hobby Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Hobby</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="hobby" id="hobby" style="width: 55%;" maxlength="50" value="<?= $row['hobby'] ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Spectacles Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="17%" class="text_user" style="padding-left:5px; font-weight: bold;">Spectacles Contact lens/ Spec lens</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="spectacles" id="spectacles" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0" <?php echo ($row['spectacles'] == '0') ? 'selected' : ''; ?>>Yes</option>
                                                                                    <option value="1" <?php echo ($row['spectacles'] == '1') ? 'selected' : ''; ?>>No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Mangal Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Mangal</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="mangal" id="mangal" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0" <?php echo ($row['mangal'] == '0') ? 'selected' : ''; ?>>Yes</option>
                                                                                    <option value="1" <?php echo ($row['mangal'] == '1') ? 'selected' : ''; ?>>No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Sani Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Sani</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="sani" id="sani" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0" <?php echo ($row['sani'] == '0') ? 'selected' : ''; ?>>Yes</option>
                                                                                    <option value="1" <?php echo ($row['sani'] == '1') ? 'selected' : ''; ?>>No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Annual Income Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Annual Income</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="annual_income" id="annual_income" placeholder="Annual Income" value="<?= $row['annual_income'] ?>" maxlength="50" style="width: 55%;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Full Photo Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Full Photo (1mb max)</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="full_photo" name="full_photo" accept="image/*">
                                                                                <div id="full_photo_error" style="color:red;"></div>
                                                                            </td>
                                                                            <?php
                                                                            $img = $row['user_id'];
                                                                            $img_path = $row['full_photo'];
                                                                            ?>
                                                                            <td class="mt-1 mb-1">
                                                                                <img src="<?php echo '/documents/' . $img . '/full_photo/' . $img_path; ?>" alt="Full Photo" style="height: 50px;width: 50px;">
                                                                            </td>

                                                                        </tr>
                                                                        <!-- Full Passport Size Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Passport Size Photo (1mb max)</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="passport_size_photo" name="passport_size_photo" accept="image/*">
                                                                                <div id="passport_size_error" style="color:red;"></div>
                                                                            </td>
                                                                            <?php
                                                                            $img = $row['user_id'];
                                                                            $img_path = $row['passport_size_photo'];
                                                                            ?>
                                                                            <td class="mt-1 mb-1">
                                                                                <img src="<?php echo '/documents/' . $img . '/passport_size_photo/' . $img_path; ?>" alt="Passport Size Photo" style="height: 50px;width: 50px;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Biodata Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Biodata (PDF) (1mb max)</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="biodata" name="biodata" accept=".pdf">
                                                                                <div id="biodata_error" style="color:red;"></div>
                                                                            </td>
                                                                            <?php
                                                                            $img = $row['user_id'];
                                                                            $img_path = $row['biodata'];
                                                                            ?>
                                                                            <?php
                                                                            if ($img_path == "") {
                                                                            ?>

                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <td><a href="<?php echo '/documents/' . $img . '/biodata/' . $img_path; ?>"
                                                                                        target="_blank" title="pdf">
                                                                                        <img src="<?php echo '/images_extension/pdf.jpg' ?>"
                                                                                            alt="" height="30" width="30">
                                                                                    </a></td>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </tr>
                                                                    </table>

                                                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr bgcolor="#f2f2f2">
                                                                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                                            <td width="45%" align="left" valign="middle" bgcolor="#ffffff">
                                                                                <div align="start">
                                                                                    <input name="submit1" type="submit" value="Update" width="71" height="24" border="0">
                                                                                </div>
                                                                            </td>
                                                                            <td width="53%" align="left" valign="middle" bgcolor="#ffffff">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </form>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <form id="matrimonyForm" method="POST" enctype="multipart/form-data">
                                                                    <table width="98%" border="0" cellspacing="0" cellpadding="0">
                                                                        <!-- Height Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Height <strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <div class="row align-items-center"> <!-- Added align-items-center for vertical alignment -->
                                                                                    <div class="col-lg-2">
                                                                                        <!-- <input type="text" id="restrictedInput" name="height[]" placeholder="5 ft" minlength="1" style="width: 144%;" maxlength="1" required
                                                                                            oninput="validateInput(this)"> -->
                                                                                        <select name="height[]" style="width: 179%;" required>
                                                                                            <option value="">Select Height</option>
                                                                                            <option value="4">4 ft</option>
                                                                                            <option value="5">5 ft</option>
                                                                                            <option value="6">6 ft</option>
                                                                                            <option value="7">7 ft</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-1 text-center"> <!-- Added text-center for center alignment -->
                                                                                        <label class="form-label mb-0">.</label> <!-- Removed for attribute since it's not needed -->
                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <!-- <input type="number" name="height[]" id="inch" placeholder="6 inch" style="width: 144%;margin-left: -50%;" max="12" min="0" maxlength="1" minlength="1" required> -->
                                                                                        <!-- <input type="number" id="numberInput" name="height[]" min="1" placeholder="6 inch" max="12" maxlength="2" oninput="validateInput_inch(this)" style="width: 144%;" required> -->
                                                                                        <select name="height[]" id="inch" style="width: 179%;">
                                                                                            <option value="">Select Inch</option>
                                                                                            <option value="1">1 inch</option>
                                                                                            <option value="2">2 inch</option>
                                                                                            <option value="3">3 inch</option>
                                                                                            <option value="4">4 inch</option>
                                                                                            <option value="5">5 inch</option>
                                                                                            <option value="6">6 inch</option>
                                                                                            <option value="7">7 inch</option>
                                                                                            <option value="8">8 inch</option>
                                                                                            <option value="9">9 inch</option>
                                                                                            <option value="10">10 inch</option>
                                                                                            <option value="11">11 inch</option>
                                                                                        </select>

                                                                                    </div>
                                                                                </div>
                                                                                <!-- <div id="error-message" style="color: red; display: none;">Please enter a number between 0 and 7</div> -->

                                                                            </td>
                                                                        </tr>
                                                                        <!-- Weight Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Weight <strong>*</strong> (in Kg's)</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="number" name="weight" id="weight" placeholder="Weight in kg" style="width: 55%;" maxlength="25" required>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Birth Place Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Place<strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="birth_place" id="birth_place" placeholder="Birth Place" style="width: 55%;" maxlength="50" required>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Birth Time Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Time <strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="datetime-local" name="birth_time" id="birth_time" style="width: 55%;" maxlength="50" required>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- hobby Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Hobby<strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="hobby" id="hobby" style="width: 55%;" maxlength="50" required>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Spectacles Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="17%" class="text_user" style="padding-left:5px; font-weight: bold;">Spectacles Contact lens/ Spec lens</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="spectacles" id="spectacles" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0">Yes</option>
                                                                                    <option value="1">No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Mangal Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Mangal</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="mangal" id="mangal" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0">Yes</option>
                                                                                    <option value="1">No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Sani Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Sani</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="sani" id="sani" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0">Yes</option>
                                                                                    <option value="1">No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Annual Income Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Annual Income</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="annual_income" id="annual_income" placeholder="Annual Income" maxlength="50" style="width: 55%;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Full Photo Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Full Photo<strong>*</strong> (1mb max)</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="full_photo_add" name="full_photo" required>
                                                                                <div id="full_photo_error" style="color:red;"></div>
                                                                            </td>
                                                                        </tr>

                                                                        <!-- Passport Size Photo Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Passport Size Photo<strong>*</strong> (1mb max)</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="passport_size_photo_add" name="passport_size_photo" required>
                                                                                <div id="passport_size_error" style="color:red;"></div>
                                                                            </td>
                                                                        </tr>

                                                                        <!-- Biodata Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Biodata (PDF) (1mb max)</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="biodata_add" name="biodata">
                                                                                <div id="biodata_error" style="color:red;"></div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>

                                                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr bgcolor="#f2f2f2">
                                                                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                                            <td width="45%" align="left" valign="middle" bgcolor="#ffffff">
                                                                                <div align="start">
                                                                                    <input name="submit1" type="submit" value="Submit" width="71" height="24" border="0">
                                                                                </div>
                                                                            </td>
                                                                            <td width="53%" align="left" valign="middle" bgcolor="#ffffff">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </form>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class="col-lg-4">
                                                            <?php
                                                            $sql_card = "SELECT 
                                                            vastipatrak_v.*, 
                                                            gotra_m.gotra_name, 
                                                            village_m.village_name,
                                                            parent.fname_vc AS father_fname,
                                                            parent.mname_vc AS father_mname,
                                                            parent.lname_vc AS father_lname,
                                                            parent.mobile_number AS father_mobile_number
                                                        FROM 
                                                            vastipatrak_m AS vastipatrak_v
                                                        INNER JOIN 
                                                            gotra_m ON gotra_m.gotra_id = vastipatrak_v.gotra_id 
                                                        LEFT JOIN 
                                                            vastipatrak_m AS parent ON parent.vasti_id = vastipatrak_v.parent_id
                                                        INNER JOIN 
                                                            village_m ON village_m.village_id = vastipatrak_v.village_id 
                                                        WHERE 
                                                            vastipatrak_v.vasti_id = '$user_id'";


                                                            $result_row = $cn->query($sql_card);
                                                            $row_result = $result_row->fetch_assoc();
                                                            // echo "<pre>";
                                                            // print_r($row_result);
                                                            // die;
                                                            ?>

                                                            <div class="card bg-white shadow-sm mt-3">
                                                                <div class="card-body">
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Father Mobile Number:</b></span> <?= $row_result['father_mobile_number']; ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Education:</b></span> <?= $row_result['edu_basic']; ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Native Place:</b></span> <?= $row_result['native_place']; ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Gotra:</b></span> <?= $row_result['gotra_name']; ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Mobile Number:</b></span> <?= $row_result['mobile_number']; ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Email:</b></span> <?= $row_result['email']; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

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
            <td height="38" align="center" valign="middle" bgcolor="#834153">
                <table width="96%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left" valign="middle" class="footer">All Rights Reserved By : Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti</td>
                        <td align="right" valign="middle" class="footer">Website Designed By :<a href="https://apolloinfotech.com/" target="_blank"> Apollo Infotech</a></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">&nbsp;</td>
        </tr>

    </table>
    <script>
        // $(document).ready(function() {
        //     $("#matrimonyForm").validate({
        //         rules: {
        //             height: {
        //                 required: true
        //             },
        //             weight: {
        //                 required: true
        //             },
        //             hobby: {
        //                 required: true
        //             },
        //             birth_place: {
        //                 required: true
        //             },
        //             full_photo: {
        //                 required: true
        //             },
        //             passport_size_photo: {
        //                 required: true
        //             }
        //         },
        //         messages: {
        //             height: "Height is required",
        //             weight: "Weight is required",
        //             birth_place: "Birth Place is required",
        //             hobby: "hobby is required",
        //             full_photo: "Full Photo is required",
        //             passport_size_photo: "Passport Size photo is required"
        //         },
        //         submitHandler: function(form) {
        //             // AJAX submission
        //             $.ajax({
        //                 type: "POST",
        //                 url: "user-matimony-php.php",
        //                 data: new FormData(form),
        //                 processData: false,
        //                 contentType: false,
        //                 cache: false,
        //                 success: function(response) {
        //                     console.log(response);
        //                     // Handle successful response
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error(error);
        //                     // Handle error response
        //                 }
        //             });
        //         }
        //     });
        // });

        function validateInput(input) {
            const value = input.value;

            // If value is not between 0 and 7, show error and clear the input
            if (value < '0' || value > '7') {
                document.getElementById('error-message').style.display = 'block';
                input.value = '';
            } else {
                document.getElementById('error-message').style.display = 'none';
            }
        }


        function validateInput_inch(input) {
            const value = input.value;

            // Ensure value is not greater than 12
            if (value > 12) {
                input.value = 12;
            }

            // Prevent entering more than 2 digits
            if (value.length > 2) {
                input.value = value.slice(0, 2);
            }
        }

        const maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        // Check full photo size
        document.getElementById('full_photo').addEventListener('change', function() {
            const fullPhoto = this.files[0];
            if (fullPhoto && fullPhoto.size > maxFileSize) {
                document.getElementById('full_photo_error').innerText = "Error: Full photo size exceeds 1MB.";
                this.value = ''; // Clear the input
            } else {
                document.getElementById('full_photo_error').innerText = ''; // Clear any previous error
            }
        });

        // Check passport size photo size
        document.getElementById('passport_size_photo').addEventListener('change', function() {
            const passportPhoto = this.files[0];
            if (passportPhoto && passportPhoto.size > maxFileSize) {
                document.getElementById('passport_size_error').innerText = "Error: Passport size photo size exceeds 1MB.";
                this.value = ''; // Clear the input
            } else {
                document.getElementById('passport_size_error').innerText = ''; // Clear any previous error
            }
        });

        // Check biodata PDF size
        document.getElementById('biodata').addEventListener('change', function() {
            const biodata = this.files[0];
            if (biodata && biodata.size > maxFileSize) {
                document.getElementById('biodata_error').innerText = "Error: Biodata size exceeds 1MB.";
                this.value = ''; // Clear the input
            } else {
                document.getElementById('biodata_error').innerText = ''; // Clear any previous error
            }
        });

        const weightInput = document.getElementById('weight');

        weightInput.addEventListener('input', function() {
            let value = parseFloat(this.value);
            if (value > 200) {
                alert("Weight cannot be more than 200 kg.");
                this.value = ''; // Clear the input
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const maxFileSize = 1 * 1024 * 1024; // 1MB in bytes

            // Function to validate file size
            function validateFileSize(inputId, errorDivId) {
                const fileInput = document.getElementById(inputId);
                const errorDiv = document.getElementById(errorDivId);

                fileInput.addEventListener('change', function() {
                    if (fileInput.files.length > 0) {
                        const file = fileInput.files[0];
                        if (file.size > maxFileSize) {
                            errorDiv.textContent = 'Error: File size exceeds 1MB.';
                            fileInput.value = ''; // Clear the input
                        } else {
                            errorDiv.textContent = ''; // Clear any previous error
                        }
                    }
                });
            }

            // Validate each file input
            validateFileSize('full_photo_add', 'full_photo_error');
            validateFileSize('passport_size_photo_add', 'passport_size_error');
            validateFileSize('biodata_add', 'biodata_error');
        });
    </script>
</body>

</html>