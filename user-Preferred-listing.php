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
        .text4_user
        {
        font-family:
        Arial,
        Helvetica,
        sans-serif;
        font-size:
        12px;
        color:
        #9e0d14;
        text-decoration:
        none;
        font-weight:
        bold;
        width:
        105px;
        display:
        inline-block;
        }
        .space
        {
        width:
        69%;
        display:
        inline-block
        !important;
        font-size: 14px;
        }
        
        .myPreferredCnt {
          background: #AF4153;
          border-radius: 50px;
          padding: 2px 6px;
          font-size: 12px;
          color: white;
          font-weight: bold;
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
    <style>
        #medk_users {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 98%;
            margin-bottom: 1%;
        }

        #medk_users td,
        #medk_users th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #medk_users tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #medk_users tr:hover {
            background-color: #ddd;
        }

        #medk_users th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #834153;
            color: white;
        }

        .table-margin {
            margin-bottom: 10px;
        }

        .cell-padding {
            padding: 10px;
        }
    </style>
    
    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }
        .modalheader {
          /*display: flex;*/
          /*flex-shrink: 0;*/
          /*align-items: center;*/
          /*padding: var(--bs-modal-header-padding);*/
          border-bottom: var(--bs-modal-header-border-width) solid var(--bs-modal-header-border-color);
          border-top-left-radius: var(--bs-modal-inner-border-radius);
          border-top-right-radius: var(--bs-modal-inner-border-radius);
        }
        .modaltitle {
          margin-bottom: 0;
          line-height: var(--bs-modal-title-line-height);
          float: left;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 100%; /* Could be more or less, depending on screen size */
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        .modalfooter {
          display: flex;
          /*flex-shrink: 0;*/
          /*flex-wrap: wrap;*/
          /*align-items: center;*/
          justify-content: flex-end;
          padding: calc(var(--bs-modal-padding) - var(--bs-modal-footer-gap) * .5);
          background-color: var(--bs-modal-footer-bg);
          border-top: var(--bs-modal-footer-border-width) solid var(--bs-modal-footer-border-color);
          border-bottom-right-radius: var(--bs-modal-inner-border-radius);
          border-bottom-left-radius: var(--bs-modal-inner-border-radius);
        }
    </style>
    <style>
        .tab {
            overflow: hidden;
            background-color: #f1f1f1;
        }
        
        .tab button {
            background-color: inherit;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            float: left;
            color: #AF4153;
        }
        
        .tab button:hover {
            background-color: #ddd;
        }
        
        .tab button.active {
            background-color: #ccc;
        }
        
        .tabcontent {
            display: none;
            padding: 20px;
            border: 1px solid #ccc;
            border-top: none;
        }
        
        .tabcontent h3 {
            margin-top: 0;
        }

    </style>
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $birth_place = $_POST['birth_place'];
    $birth_time = $_POST['birth_time'];
    $spectacles = $_POST['spectacles'];
    $mangal_sani = $_POST['mangal_sani'];
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

    // Upload full photo if exists
    if (!empty($full_photo['name'])) {
        $full_photo_name = basename($full_photo['name']);
        move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
    }

    // Upload passport size photo if exists
    if (!empty($passport_size_photo['name'])) {
        $passport_size_photo_name = basename($passport_size_photo['name']);
        move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
    }

    // Upload biodata if exists
    if (!empty($biodata['name'])) {
        $biodataName = basename($biodata['name']);
        move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
    }


    $sql = "INSERT INTO `matrimony`(`user_id`,`height`, `weight`, `birth_place`,`birth_time`, `spectacles`, `mangal_sani`, `annual_income`, `full_photo`,`passport_size_photo`, `biodata`) VALUES ($user_id,'$height','$weight','$birth_place','$birth_time','$spectacles','$mangal_sani','$annual_income','$full_photo_db','$passport_size_photo_db','$biodataName')";

    $result = $cn->query($sql);

    if ($result) {
        header("Location:user-familydet.php");
        exit();
    } else {
        echo "Error: " . $cn->error;
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
                                        <span>
                                            <?php
                                            // Get the user ID from the URL parameter
                                            $user_id = $_GET['id'];

                                            // Step 1: Check if the user exists in the matrimony table
                                            $matrimony_check_sql = "SELECT * FROM matrimony WHERE user_id = '$user_id'";
                                            $matrimony_check_result = $cn->query($matrimony_check_sql);

                                            if ($matrimony_check_result->num_rows > 0) {
                                                // Step 2: If the user exists in the matrimony table, get the user's gender from vastipatrak_m
                                                $sql = "SELECT * FROM vastipatrak_m WHERE vasti_id = '$user_id'";
                                                $result = $cn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    // Step 3: Fetch the user's details
                                                    $row = $result->fetch_assoc();
                                                    $user_gender = $row['gender_c'];
                                                    $user_name = $row['fname_vc'] . ' ' . $row['lname_vc'];
                                                    $user_address = $row['addr2'] . ', ' . $row['addr3'];
                                                    $user_dob = $row['birth_date'];
                                                    $user_mobile = $row['mobile_home'];
                                                    $user_email = $row['email'];
                                                    $user_age = $row['age'];
                                                    $last_updated = date("d-m-Y", strtotime($row['last_updated'])); // assuming you have a last_updated column

                                                    // Step 4: Determine the opposite gender
                                                    $opposite_gender = "";
                                                    if($user_gender == 'Male') {
                                                        $opposite_gender = 'Female';
                                                    } else {
                                                        $opposite_gender =  'Male';
                                                    }

        
                                                    $opposite_gender_sql = "SELECT 
                                                            matrimony.*, 
                                                            vastipatrak_m.*, 
                                                            gotra_m.*, 
                                                            village_m.*,
                                                            
                                                            parent.vasti_id AS parent_id,
                                                        
                                                            CASE 
                                                                WHEN parent.vasti_id = ancestor.vasti_id THEN parent.fname_vc
                                                                ELSE parent.fname_vc
                                                            END AS parent_first_name,
                                                            
                                                            CASE 
                                                                WHEN parent.vasti_id = ancestor.vasti_id THEN parent.mname_vc
                                                                ELSE parent.mname_vc
                                                            END AS parent_middle_name,
                                                            
                                                            CASE 
                                                                WHEN parent.vasti_id = ancestor.vasti_id THEN parent.lname_vc
                                                                ELSE parent.lname_vc
                                                            END AS parent_last_name,
                                                            
                                                            parent.mobile_number AS parent_mobile_number,
                                                        
                                                            CASE 
                                                                WHEN parent.vasti_id != ancestor.vasti_id THEN ancestor.fname_vc
                                                                ELSE NULL
                                                            END AS ancestor_first_name,
                                                            
                                                            CASE 
                                                                WHEN parent.vasti_id != ancestor.vasti_id THEN ancestor.mname_vc
                                                                ELSE NULL
                                                            END AS ancestor_middle_name,
                                                            
                                                            CASE 
                                                                WHEN parent.vasti_id != ancestor.vasti_id THEN ancestor.lname_vc
                                                                ELSE NULL
                                                            END AS ancestor_last_name,
                                                            edu1.education_name as basicqual,edu2.education_name as pgqual,edu3.education_name as docqual,
                                                            bc.group_name as b_main_group_name,
                                                            ind.ind_value as ind_name,
                                                            bdir.bness_name,bdir.prof_type,MFN.village_name as motherFathersNative,
                                                            jobc.group_name as j_group_name, jobind.ind_value as job_ind_name,
                                                            bdir.prof_desc,bdir.comp_name,bdir.job_type,bdir.job_ind_id,
                                                          bdir.job_desig,bdir.job_addr,bdir.job_phone,bdir.job_mobile,
                                                          bdir.job_addr1,bdir.job_addr2,bdir.job_addr3,bdir.job_country,
                                                          bdir.job_state,bdir.job_city,bdir.job_district,bdir.job_pincode,
                                                          pc.group_name as p_main_group_name,pc1.group_name as p_sub_group_name,
                                                          (select concat(parent.mobile_number,',',parent.mobile_home, ',', parent.alt_mobile) from vastipatrak_m AS parent where parent.vasti_id = vastipatrak_m.parent_id) as fathermobilenumber,
                                                          (select m.mobile_number from vastipatrak_m as m where m.anc_id=vastipatrak_m.anc_id and m.relation_id in (10,13) and m.gender_c='female' order by m.vasti_id desc limit 1) as motherMobile,
                                                          city.city_name,
                                                          (select concat(m.fname_vc,' ',m.mname_vc,' ',m.lname_vc) from vastipatrak_m as m where m.anc_id=vastipatrak_m.anc_id and m.relation_id in (10,13) and m.gender_c='female' order by m.vasti_id desc limit 1) as motherName,
                                                          (select parent.mobile_number from vastipatrak_m AS parent where parent.vasti_id = vastipatrak_m.anc_id) as father_mobile_number,
                                                        					(select concat(parent.fname_vc,' ',parent.mname_vc,' ',parent.lname_vc) from vastipatrak_m AS parent where parent.vasti_id = vastipatrak_m.anc_id) as father_Name
                                                        FROM matrimony 
                                                        INNER JOIN vastipatrak_m 
                                                            ON vastipatrak_m.vasti_id = matrimony.user_id
                                                        
                                                        INNER JOIN gotra_m 
                                                            ON gotra_m.gotra_id = vastipatrak_m.gotra_id
                                                        INNER JOIN village_m 
                                                            ON village_m.village_id = vastipatrak_m.village_id
                                                            
                                                        LEFT JOIN vastipatrak_m AS parent 
                                                            ON vastipatrak_m.parent_id = parent.vasti_id
                                                        LEFT JOIN vastipatrak_m AS ancestor 
                                                            ON vastipatrak_m.anc_id = ancestor.vasti_id
                                                        left outer join city_m city on vastipatrak_m.city = city.city_id
                                                        
                                                        left outer join education_m edu1 on vastipatrak_m.basic_qual = edu1.education_id
                                                        left outer join education_m edu2 on vastipatrak_m.pg_qual = edu2.education_id
                                                        left outer join education_m edu3 on vastipatrak_m.doc_qual = edu3.education_id
                                                        left outer join businessdir_m bdir on vastipatrak_m.vasti_id = bdir.vasti_id
                                                        left outer join bdir_category bc on bdir.bness_cat_id = bc.sub_id
                                                        left outer join industry_m ind on bdir.bness_subcat_id = ind.ind_id
                                                        left outer join bdir_category pc on bdir.prof_cat_id = pc.sub_id
                                                        left outer join bdir_category pc1 on bdir.prof_subcat_id = pc1.sub_id
                                                        left outer join bdir_category jobc on bdir.job_type = jobc.sub_id
                                                        left outer join industry_m jobind on bdir.job_ind_id = jobind.ind_id
                                                        LEFT JOIN village_m as MFN
                                                            ON MFN.village_id = matrimony.MotherFathersNative
                                                        WHERE vastipatrak_m.marital_id not  in (4,8) and vastipatrak_m.gender_c = '$opposite_gender' 
                                                        ";
                                                    $opposite_gender_result = $cn->query($opposite_gender_sql);
                                                }
                                            }
                                            ?>
                                            <div class="tab">
                                                <a href="user-matrimony-listing.php?id=<?= $_GET['id']; ?>"><button class="tablinks">Matrimonial List <sup class="myPreferredCnt"><?= $opposite_gender_result->num_rows; ?></sup> </button></a>
                                                <?php 
                                                    $myPreferredSql = "SELECT Count(*) as cnt FROM matrimonyPreferred WHERE vasti_id = '".$_GET['id']."'";
                                                    $resultRow = $cn->query($myPreferredSql);
                                                    $rowResult = $resultRow->fetch_assoc();
                                                ?>
                                                <a href="user-Preferred-listing.php?id=<?= $_GET['id']; ?>"><button class="tablinks active">My Preferred List <sup class="myPreferredCnt"><?= $rowResult['cnt']; ?></sup> </button></a>
                                            </div>
                                            <table border="0" cellspacing="0" cellpadding="0" width="94%" class="table-margin">
                                                <tbody>
                                                    <tr>
                                                        <td height="10"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="top" class="border1 cell-padding">
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr bgcolor="#f2f2f2">
                                                                        <td width="2%" height="37" class="cell-padding">&nbsp;</td>
                                                                        <td height="37" align="left" valign="middle" class="title cell-padding text-uppercase">
                                                                            List of MEDK Matrimonial
                                                                        </td>
                                                                        <?php $matrimony_check_sql = "SELECT * FROM matrimony WHERE user_id = '$user_id'";
                                                                        $matrimony_check_result = $cn->query($matrimony_check_sql);
                            
                                                                        if ($matrimony_check_result->num_rows > 0) { ?>
                                                                        <td height="37" align="right" valign="middle" class="title cell-padding text-uppercase">
                                                                            <button type="button" class="btn btn-primary" id="openModalBtn">
                                                                                View My Profile
                                                                            </button>
                                                                        </td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- Modal -->
                                                <div id="myModal" class="modal">
                                                    
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                              <div class="modalheader">
                                                                <h5 class="modaltitle" id="exampleModalLabel">My Profile</h5>
                                                                <span class="close"  id="closeModalBtn">&times;</span>
                                                              </div>
                                                              <div class="modal-body">
                                                                <?php
                                                                $user_id = $_GET['id'];
                                                                $sql_card = "select v.*, m1.*,(SELECT village_name FROM village_m where village_m.village_id=m1.MotherFathersNative) as strMotherFathersNative,
                                                        					v1.addr1 as paraddr1, v1.addr2 as paraddr2, v1.addr3 as paraddr3,v1.pincode as parpincode,v1.fname_vc as parfname,v1.lname_vc as parlname,
                                                        					v2.lname_vc as mainparlname,v2.addr1 as mainparaddr1, v2.addr2 as mainparaddr2, v2.addr3 as mainparaddr3,v2.pincode as mainparpincode,city2.city_name as mainparcity, state2.state_name as mainparstate,
                                                        					bdir.business_id,bdir.prof_type,
                                                                  bdir.bness_cat_id,bdir.bness_subcat_id,bdir.bness_name,bdir.bness_addr,
                                                                  bdir.bness_phone,bdir.bness_mobile,bdir.bness_desc,bdir.prof_cat_id,
                                                        
                                                                  bdir.prof_subcat_id,bdir.prof_addr,bdir.prof_phone,bdir.prof_mobile,
                                                                  bdir.prof_desc,bdir.comp_name,bdir.job_type,bdir.job_ind_id,
                                                                  bdir.job_desig,bdir.job_addr,bdir.job_phone,bdir.job_mobile,
                                                                  bdir.job_addr1,bdir.job_addr2,bdir.job_addr3,bdir.job_country,
                                                                  bdir.job_state,bdir.job_city,bdir.job_district,bdir.job_pincode,
                                                        
                                                        					edu1.education_name as basicqual,edu2.education_name as pgqual,edu3.education_name as docqual,
                                                        					m.marital_name,
                                                        					city.city_name, state.state_name, city1.city_name as parcity,state1.state_name as parstate,
                                                        					jc.city_name as jcity, js.state_name as jstate,
                                                        					bc.group_name as b_main_group_name,ind.ind_value as ind_name,
                                                        					jobc.group_name as j_group_name, jobind.ind_value as job_ind_name,
                                                        					pc.group_name as p_main_group_name,pc1.group_name as p_sub_group_name,vill.village_name,
                                                        					(select parent.mobile_number from vastipatrak_m AS parent where parent.vasti_id = v.anc_id) as father_mobile_number,
                                                        					(select concat(parent.fname_vc,' ',parent.mname_vc,' ',parent.lname_vc) from vastipatrak_m AS parent where parent.vasti_id = v.anc_id) as father_Name,
                                                        					g.gotra_name,
                                                        					v.blood_group AS bloodGroupName,
                                                            (select concat(m.fname_vc,' ',m.mname_vc,' ',m.lname_vc) from vastipatrak_m as m where m.anc_id=v.anc_id and m.relation_id in (10,13) and m.gender_c='female' order by m.vasti_id desc limit 1) as motherName,
                                                            (select m.mobile_number from vastipatrak_m as m where m.anc_id=v.anc_id and m.relation_id in (10,13) and m.gender_c='female' order by m.vasti_id desc limit 1) as motherMobile
                                                        						from vastipatrak_m v
                                                        						    left outer join matrimony m1 on v.vasti_id=m1.user_id
                                                        							left outer join vastipatrak_m v1 on v.parent_id = v1.vasti_id
                                                        							left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
                                                        							
                                                        							left outer join gotra_m g on v.gotra_id = g.gotra_id  
                                                        							left outer join village_m vill on v.village_id = vill.village_id
                                                        							left outer join marital_m m on v.marital_id = m.marital_id  
                                                        							
                                                        							left outer join businessdir_m bdir on v.vasti_id = bdir.vasti_id
                                                        							
                                                        							left outer join bdir_category bc on bdir.bness_cat_id = bc.sub_id
                                                        							left outer join industry_m ind on bdir.bness_subcat_id = ind.ind_id
                                                        							
                                                        							left outer join bdir_category pc on bdir.prof_cat_id = pc.sub_id
                                                        							left outer join bdir_category pc1 on bdir.prof_subcat_id = pc1.sub_id
                                                        							
                                                        							left outer join bdir_category jobc on bdir.job_type = jobc.sub_id
                                                        							left outer join industry_m jobind on bdir.job_ind_id = jobind.ind_id
                                                        
                                                        							left outer join city_m city on v.city = city.city_id
                                                        							left outer join state_m state on v.state = state.state_id
                                                        							
                                                        							left outer join city_m city1 on v1.city = city1.city_id
                                                        							left outer join state_m state1 on v1.state = state1.state_id
                                                        							
                                                        							left outer join city_m city2 on v2.city = city2.city_id
                                                        							left outer join state_m state2 on v2.state = state2.state_id
                                                        							
                                                        							left outer join city_m jc on bdir.job_city = jc.city_id
                                                        							left outer join state_m js on bdir.job_state = js.state_id
                                                        							
                                                        							left outer join education_m edu1 on v.basic_qual = edu1.education_id
                                                        							left outer join education_m edu2 on v.pg_qual = edu2.education_id
                                                        							left outer join education_m edu3 on v.doc_qual = edu3.education_id
                                                        
                                                        							where v.vasti_id= '$user_id'";


                                                                        $result_row = $cn->query($sql_card);
                                                                        $row_result = $result_row->fetch_assoc();
                                                                ?>
                                                                <div class="card bg-white shadow-sm mt-3" style="margin-right: 15px;">
                                                                <div class="card-body">
                                                                    <table>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">My ID:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['id']; ?></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">My Name:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['fname_vc'] . " " .$row_result['mname_vc'] . " " .$row_result['lname_vc']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Self Number:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['mobile_number']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Self Email:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['email']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Father Name:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['father_Name']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Father Mobile Number:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['father_mobile_number']; ?></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Mother Name:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['motherName']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Mother Mobile Number:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['motherMobile']; ?></td>
                                                                        </tr>
                                                                        <!-- Mother Fathers Name Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Mother Father's Name: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['MotherFathersName']; ?></td>
                                                                        </tr>
                                                                        
                                                                        <!-- Mother Fathers Native Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Mother Father's Native: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php
                                                                                if($row_result['MotherFathersNative'] == "-1"){
                                                                                    echo "Out of MEDK";
                                                                                } else {
                                                                                    echo $row_result['strMotherFathersNative']; 
                                                                                } ?></td>
                                                                        </tr>
                                                                        
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Native Place:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['village_name']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Gotra:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['gotra_name']; ?></td>
                                                                        </tr>
                                                                        <!-- Birth Place Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Birth Place: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['birth_place']; ?></td>
                                                                        </tr>
                                                                        <!-- Birth Time Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Birth Date & Time: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= date('d-m-Y H:i:s',strtotime($row_result['birth_time'])); ?></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Height:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php
                                                                                $height = explode(".", $row_result['height']);
                                                                            echo $height[0]. ' ft ' . $height[1]. ' inch'; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Weight <small>(in Kg's)</small>: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['weight']; ?> <small>(Kg's)</small> </td>
                                                                        </tr>
                                                                        <!-- Spectacles Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Spectacles Contact lens/ Spec lens: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['spectacles'] == 0 ? "Yes" : "No"; ?></td>
                                                                        </tr>
                                                                        <!-- Mangal Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Mangal: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['mangal'] == 0 ? "Yes" : "No"; ?></td>
                                                                        </tr>
                                                                        <!-- Shani Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Shani: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['sani'] == 0 ? "Yes" : "No"; ?></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Current City:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['city_name']; ?></td>
                                                                        </tr>
                                                                        
                                                                        
                                                                        <!--<tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Basic/ Graduate:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php echo $row_result['basicqual'];
                                                                                                    if ($row_result['bq_det'] != "") {
                                                                                                      echo " (" . $row_result['bq_det'] . ") ";
                                                                                                    } ?> </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Post Graduate:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php echo $row_result['pgqual'];
                                                                                                                if ($row_result['pg_det'] != "") {
                                                                                                                  echo " (" . $row_result['pg_det'] . ") ";
                                                                                                                } ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Doctrate: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php echo $row_result['docqual'];
                                                                                                    if ($row_result['doc_det'] != "") {
                                                                                                      echo " (" . $row_result['doc_det'] . ") ";
                                                                                                    } ?></td>
                                                                        </tr>-->
                                                                        
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Blood Group:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['bloodGroupName']; ?></td>
                                                                        </tr>
                                                                        
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Marital Status:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['marital_name']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Education :</td>
                                                                            <td class="text_user" style="padding-left:5px;">
                                                                                                <strong> Basic/ Graduate: </strong><?php echo $row_result['basicqual'];
                                                                                                    if ($row_result['bq_det'] != "") {
                                                                                                      echo " (" . $row_result['bq_det'] . ") ";
                                                                                                    } ?> 
                                                                                                <br />
                                                                                                <strong>Post Graduate:</strong> <?php echo $row_result['pgqual'];
                                                                                                    if ($row_result['pg_det'] != "") {
                                                                                                      echo " (" . $row_result['pg_det'] . ") ";
                                                                                                    } ?>
                                                                                                <br />
                                                                                                <strong>Doctrate: </strong>
                                                                                                <?php echo $row_result['docqual'];
                                                                                                    if ($row_result['doc_det'] != "") {
                                                                                                      echo " (" . $row_result['doc_det'] . ") ";
                                                                                                    } ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan=2 class="text_user" style="padding-left:5px; font-weight: bold;text-align: center; text-decoration: underline;">Current Activity </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Type:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php
                                                                                if($row_result['prof_type'] == 'B'){
                                                                                    echo "Business";
                                                                                } else if($row_result['prof_type'] == 'H'){
                                                                                    echo "House Maker";
                                                                                } else if($row_result['prof_type'] == 'S'){
                                                                                    echo "Student";
                                                                                } else if($row_result['prof_type'] == 'P'){
                                                                                    echo "Self Employeds";
                                                                                } else if($row_result['prof_type'] == 'J'){
                                                                                    echo "Job";
                                                                                } else if($row_result['prof_type'] == 'R'){
                                                                                    echo "Retire";
                                                                                } else {
                                                                                    echo "Not specified";
                                                                                }
                                                                                
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php 
                                                                        if($row_result['prof_type'] == 'B'){ ?>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Business Category:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['b_main_group_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Industry:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['ind_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Business Name:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['bness_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Contact Number 1:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['bness_phone']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Contact Number 2:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['bness_mobile']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Description:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['bness_desc']; ?></td>
                                                                            </tr>
                                                                        <?php } if($row_result['prof_type'] == 'J'){?>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Job Type:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['j_group_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Industry:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_ind_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Company Name:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['comp_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Desgination:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_desig']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Phone No:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_phone']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Mobile No:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_mobile']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Office Address:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_addr']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Address:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?php
                                                                                
                                                                                    echo $row_result['job_addr1'];
                                                                                    echo "<br />" . $row_result['job_addr2'];
                                                                                    echo "<br />" . $row_result['job_addr3'];
                                                                                    if ($row_result['jcity'] != "" || $row_result['jstate'] != "" || $row_result['job_pincode'] != "") {
                                                                                            echo ($row_result['jcity']); ?>, <?php echo ($row_result['jstate']); ?> - <?php echo ($row_result['job_pincode']);
                                                                                    }
                                                                                    ?></td>
                                                                            </tr>
                                                                        <?php } 
                                                                         if($row_result['prof_type'] == 'p'){
                                                                        ?>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Profession Name:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['p_main_group_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Specialization:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['p_sub_group_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Office Address:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['prof_addr']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Phone No:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['prof_phone']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Mobile No:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['prof_mobile']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Description:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_mobile']; ?></td>
                                                                            </tr>
                                                                            
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Address:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?php
                                                                                
                                                                                    echo $row_result['job_addr1'];
                                                                                    echo "<br />" . $row_result['job_addr2'];
                                                                                    echo "<br />" . $row_result['job_addr3'];
                                                                                    if ($row_result['jcity'] != "" || $row_result['jstate'] != "" || $row_result['job_pincode'] != "") {
                                                                                            echo ($row_result['jcity']); ?>, <?php echo ($row_result['jstate']); ?> - <?php echo ($row_result['job_pincode']);
                                                                                    }
                                                                                    ?></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                        
                                                                        
                                                                        
                                                                        <!-- Annual Income Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Annual Income <small><strong>(in Rs.)</strong></small>: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['annual_income']; ?></td>
                                                                        </tr>
                                                                        <!-- hobby Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Hobby: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['hobby']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Facebook link: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['strFacebookLink']; ?></td>
                                                                        </tr>
                                                                        <!-- strInstagramLink strFacebookLink -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Instagram Link: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['strInstagramLink']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Is Handicap: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['isHandicap'] == 0 ? 'No' : 'Yes'; ?></td>
                                                                        </tr>
                                                                        <?php if($row_result['isHandicap'] == 1){ ?>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Handicap Description: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['strHandicapDescription']; ?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                        <!-- Passport Size Photo Input -->
                                                                        <?php if(isset($row_result['passport_size_photo']) && $row_result['passport_size_photo'] != ""){ ?>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Passport Size Photo: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php
                                                                            $img = $_GET['id'];
                                                                            $img_path = $row_result['passport_size_photo'];
                                                                            ?>
                                                                            <img src="<?php echo '/documents/' . $img . '/passport_size_photo/' . $img_path; ?>" alt="Passport Size Photo" style="height: 50px;width: 50px;">
                                                                            </td>
                                                                        </tr>
                                                                        <?php } 
                                                                        if(isset($row_result['full_photo']) && $row_result['full_photo'] != ""){
                                                                        ?>
                                                                        <!-- Full Photo Input -->
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Full Photo: </td>
                                                                            <td class="text_user" style="padding-left:5px;">
                                                                            <img src="<?php echo '/documents/' . $img . '/full_photo/' . $row_result['full_photo']; ?>" alt="Passport Size Photo" style="height: 50px;width: 50px;">
                                                                            </td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                        
                                                                    </table>
                                                                </div>
                                                            </div>
                                                              </div>
                                                              <div class="modalfooter">
                                                                <button type="button" class="btn btn-secondary" id="closeModal_Btn">Close</button>
                                                              </div>
                                                            </div>
                                                        </div>
                                                          
                                                </div>
                                        </span>
                                        <table width="97%" border="0" cellspacing="0" cellpadding="0">
                                            <!-- <tr>
                                                <td align="center" valign="top" class="border1"> -->


                                            <?php
                                            // Get the user ID from the URL parameter
                                            $user_id = $_GET['id'];

                                            // Step 1: Check if the user exists in the matrimony table
                                            $matrimony_check_sql = "SELECT * FROM matrimony WHERE user_id = '$user_id'";
                                            $matrimony_check_result = $cn->query($matrimony_check_sql);

                                            if ($matrimony_check_result->num_rows > 0) {
                                                // Step 2: If the user exists in the matrimony table, get the user's gender from vastipatrak_m
                                                $sql = "SELECT * FROM vastipatrak_m WHERE vasti_id = '$user_id'";
                                                $result = $cn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    // Step 3: Fetch the user's details
                                                    $row = $result->fetch_assoc();
                                                    $user_gender = $row['gender_c'];
                                                    $user_name = $row['fname_vc'] . ' ' . $row['lname_vc'];
                                                    $user_address = $row['addr2'] . ', ' . $row['addr3'];
                                                    $user_dob = $row['birth_date'];
                                                    $user_mobile = $row['mobile_home'];
                                                    $user_email = $row['email'];
                                                    $user_age = $row['age'];
                                                    $last_updated = date("d-m-Y", strtotime($row['last_updated'])); // assuming you have a last_updated column

                                                    // Step 4: Determine the opposite gender
                                                    $opposite_gender = ($user_gender == 'Male') ? 'Female' : 'Male';

                                                    // Step 5: Query the matrimony table to find users of the opposite gender
                                                    // $opposite_gender_sql = "SELECT * FROM matrimony INNER JOIN vastipatrak_m ON vastipatrak_m.vasti_id=matrimony.user_id WHERE vastipatrak_m.gender_c = '$opposite_gender'";

                                                    //     $sql_card = "SELECT 
                                                    //     vastipatrak_v.*, 
                                                    //     gotra_m.gotra_name, 
                                                    //     village_m.village_name,
                                                    //     parent.fname_vc AS father_fname,
                                                    //     parent.mname_vc AS father_mname,
                                                    //     parent.lname_vc AS father_lname,
                                                    //     parent.mobile_number AS father_mobile_number
                                                    // FROM 
                                                    //     vastipatrak_m AS vastipatrak_v
                                                    // INNER JOIN 
                                                    //     gotra_m ON gotra_m.gotra_id = vastipatrak_v.gotra_id 
                                                    // LEFT JOIN 
                                                    //     vastipatrak_m AS parent ON parent.vasti_id = vastipatrak_v.parent_id
                                                    // INNER JOIN 
                                                    //     village_m ON village_m.village_id = vastipatrak_v.village_id 
                                                    // WHERE 
                                                    //     vastipatrak_v.vasti_id = '$user_id'";

                                                    $opposite_gender_sql = "SELECT 
                                                            matrimony.*, 
                                                            vastipatrak_m.*, 
                                                            gotra_m.*, 
                                                            village_m.*,
                                                            matrimonyPreferred.id as iPreferredId,
                                                            parent.vasti_id AS parent_id,
                                                        
                                                            CASE 
                                                                WHEN parent.vasti_id = ancestor.vasti_id THEN parent.fname_vc
                                                                ELSE parent.fname_vc
                                                            END AS parent_first_name,
                                                            
                                                            CASE 
                                                                WHEN parent.vasti_id = ancestor.vasti_id THEN parent.mname_vc
                                                                ELSE parent.mname_vc
                                                            END AS parent_middle_name,
                                                            
                                                            CASE 
                                                                WHEN parent.vasti_id = ancestor.vasti_id THEN parent.lname_vc
                                                                ELSE parent.lname_vc
                                                            END AS parent_last_name,
                                                            
                                                            parent.mobile_number AS parent_mobile_number,
                                                        
                                                            CASE 
                                                                WHEN parent.vasti_id != ancestor.vasti_id THEN ancestor.fname_vc
                                                                ELSE NULL
                                                            END AS ancestor_first_name,
                                                            
                                                            CASE 
                                                                WHEN parent.vasti_id != ancestor.vasti_id THEN ancestor.mname_vc
                                                                ELSE NULL
                                                            END AS ancestor_middle_name,
                                                            
                                                            CASE 
                                                                WHEN parent.vasti_id != ancestor.vasti_id THEN ancestor.lname_vc
                                                                ELSE NULL
                                                            END AS ancestor_last_name,
                                                            edu1.education_name as basicqual,edu2.education_name as pgqual,edu3.education_name as docqual,
                                                            bc.group_name as b_main_group_name,
                                                            ind.ind_value as ind_name,
                                                            bdir.bness_name,bdir.prof_type,MFN.village_name as motherFathersNative,
                                                            jobc.group_name as j_group_name, jobind.ind_value as job_ind_name,
                                                            bdir.prof_desc,bdir.comp_name,bdir.job_type,bdir.job_ind_id,
                                                          bdir.job_desig,bdir.job_addr,bdir.job_phone,bdir.job_mobile,
                                                          bdir.job_addr1,bdir.job_addr2,bdir.job_addr3,bdir.job_country,
                                                          bdir.job_state,bdir.job_city,bdir.job_district,bdir.job_pincode,
                                                          pc.group_name as p_main_group_name,pc1.group_name as p_sub_group_name,
                                                          (select concat(parent.mobile_number,',',parent.mobile_home, ',', parent.alt_mobile) from vastipatrak_m AS parent where parent.vasti_id = vastipatrak_m.parent_id) as fathermobilenumber,
                                                          (select m.mobile_number from vastipatrak_m as m where m.anc_id=vastipatrak_m.anc_id and m.relation_id in (10,13) and m.gender_c='female' order by m.vasti_id desc limit 1) as motherMobile,
                                                          city.city_name,
                                                          (select concat(m.fname_vc,' ',m.mname_vc,' ',m.lname_vc) from vastipatrak_m as m where m.anc_id=vastipatrak_m.anc_id and m.relation_id in (10,13) and m.gender_c='female' order by m.vasti_id desc limit 1) as motherName,
                                                          (select parent.mobile_number from vastipatrak_m AS parent where parent.vasti_id = vastipatrak_m.anc_id) as father_mobile_number,
                                                        					(select concat(parent.fname_vc,' ',parent.mname_vc,' ',parent.lname_vc) from vastipatrak_m AS parent where parent.vasti_id = vastipatrak_m.anc_id) as father_Name
                                                        FROM matrimony 
                                                        INNER JOIN vastipatrak_m 
                                                            ON vastipatrak_m.vasti_id = matrimony.user_id
                                                        
                                                        INNER JOIN gotra_m 
                                                            ON gotra_m.gotra_id = vastipatrak_m.gotra_id
                                                        INNER JOIN village_m 
                                                            ON village_m.village_id = vastipatrak_m.village_id
                                                            
                                                        LEFT JOIN vastipatrak_m AS parent 
                                                            ON vastipatrak_m.parent_id = parent.vasti_id
                                                        LEFT JOIN vastipatrak_m AS ancestor 
                                                            ON vastipatrak_m.anc_id = ancestor.vasti_id
                                                        left outer join city_m city on vastipatrak_m.city = city.city_id
                                                        
                                                        left outer join education_m edu1 on vastipatrak_m.basic_qual = edu1.education_id
                                                        left outer join education_m edu2 on vastipatrak_m.pg_qual = edu2.education_id
                                                        left outer join education_m edu3 on vastipatrak_m.doc_qual = edu3.education_id
                                                        left outer join businessdir_m bdir on vastipatrak_m.vasti_id = bdir.vasti_id
                                                        left outer join bdir_category bc on bdir.bness_cat_id = bc.sub_id
                                                        left outer join industry_m ind on bdir.bness_subcat_id = ind.ind_id
                                                        left outer join bdir_category pc on bdir.prof_cat_id = pc.sub_id
                                                        left outer join bdir_category pc1 on bdir.prof_subcat_id = pc1.sub_id
                                                        left outer join bdir_category jobc on bdir.job_type = jobc.sub_id
                                                        left outer join industry_m jobind on bdir.job_ind_id = jobind.ind_id
                                                        LEFT JOIN village_m as MFN
                                                            ON MFN.village_id = matrimony.MotherFathersNative
                                                        inner join matrimonyPreferred on matrimony.user_id=matrimonyPreferred.matrimony_user_Id
                                                        WHERE vastipatrak_m.marital_id not  in (4,8) and vastipatrak_m.gender_c = '$opposite_gender' and matrimonyPreferred.vasti_id='".$_GET['id']."';
                                                        ";

                                                    // $opposite_gender_sql = "
                                                    //         SELECT * 
                                                    //         FROM matrimony 
                                                    //         INNER JOIN vastipatrak_m ON vastipatrak_m.vasti_id = matrimony.user_id 
                                                    //         INNER JOIN gotra_m ON gotra_m.gotra_id = vastipatrak_m.gotra_id 
                                                    //         INNER JOIN village_m ON village_m.village_id = vastipatrak_m.village_id 
                                                    //         WHERE vastipatrak_m.gender_c = '$opposite_gender'
                                                    //     ";

                                                    $opposite_gender_result = $cn->query($opposite_gender_sql);

                                                    // Step 6: Display the user's information
                                            ?>
                                                    <?php

                                                    // Display opposite gender users if any
                                                    if ($opposite_gender_result->num_rows > 0) {
                                                        while ($opposite_gender_row = $opposite_gender_result->fetch_assoc()) {
                                                            // echo "<pre>";
                                                            // print_r($opposite_gender_row);
                                                            // die;
                                                    ?>
                                                            <div class="row" style="width: 94%;">
                                                                <div class="card text-start text-uppercase">
                                                                    <div class="card-body">
                                                                        <!-- <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <span class="text4_user">Father Name:</span> <?= $opposite_gender_row['parent_first_name'] . ' ' . $opposite_gender_row['parent_middle_name'] . ' ' . $opposite_gender_row['parent_last_name']; ?>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <span class="text4_user">Father's Father Name:</span> <?= $opposite_gender_row['ancestor_first_name'] . ' ' . $opposite_gender_row['ancestor_middle_name'] . ' ' . $opposite_gender_row['ancestor_last_name']; ?>
                                                                            </div>
                                                                        </div> -->
                                                                        <div class="row">
                                                                            <div class="col-lg-5">
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">My Id:</span> <span class="space">
                                                                                        <?= $opposite_gender_row['id']; ?></span>
                                                                                </div>
                                                                                <p class="card-title"><span class="text4_user">Name:</span> <span class="space"><?php echo $opposite_gender_row['fname_vc'] . " " . $opposite_gender_row['parent_first_name'] . $opposite_gender_row['ancestor_first_name'] . " " . $opposite_gender_row['lname_vc']; ?></span></p>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Father Name:</span> <span class="space">
                                                                                        <?= $opposite_gender_row['father_Name']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Father Mobile Number:</span> <span class="space">
                                                                                        <?= $opposite_gender_row['father_mobile_number']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Mother Name:</span> <span class="space">
                                                                                        <?= $opposite_gender_row['motherName']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Mother Mobile Number:</span> <span class="space">
                                                                                        <?= $opposite_gender_row['motherMobile']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Mother Father's Name:</span> <span class="space"><?php echo $opposite_gender_row['MotherFathersName']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Mother Father's Native:</span> <span class="space"><?php 
                                                                                    if($opposite_gender_row['MotherFathersNative'] == "-1"){
                                                                                        echo "Out of MEDK";
                                                                                    } else {
                                                                                        echo $opposite_gender_row['motherFathersNative']; 
                                                                                    }
                                                                                    ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Gender/Age:</span> <span class="space">
                                                                                        <?php 
                                                                                            $bdate = date('d-m-Y',strtotime($opposite_gender_row['birth_time']));
                                                                                            // echo $birthDate = $opposite_gender_row['birth_time']."<br />";
        
                                                                                            // Create a DateTime object from the birth date (d-m-Y format)
                                                                                            $birthDateObj = DateTime::createFromFormat('d-m-Y', $bdate);
                                                                                            
                                                                                            // Get the current date
                                                                                            $currentDate = new DateTime();
                                                                                            
                                                                                            // Calculate the age by getting the difference between the two dates
                                                                                            $age = $currentDate->diff($birthDateObj);
                                                                                            
                                                                                            // Output the age
                                                                                            //echo "Age: " . $age->y . " years old <br />";
                                                                                            $ageYear = "";
                                                                                            if($opposite_gender_row['age'] == ""){
                                                                                                $ageYear = $age->y;
                                                                                            } else {
                                                                                                $ageYear = $opposite_gender_row['age'];
                                                                                            }
                                                                                        ?>
                                                                                        <?= $opposite_gender_row['gender_c'] . ', ' . $ageYear . ' yrs'; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Address:</span> <span class="space"><?= $opposite_gender_row['addr1']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user"></span>
                                                                                    <span class="space"><?= $opposite_gender_row['addr2']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user"></span>
                                                                                    <span class="space"><?= $opposite_gender_row['addr3']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Selft Mobile Number:</span> <span class="space"><?= $opposite_gender_row['mobile_number']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Self Email :</span> <span class="space"><?= $opposite_gender_row['email']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <?php
                                                                                    $birth_time = $opposite_gender_row['birth_time'];
                                                                                    $date = new DateTime($birth_time);
                                                                                    // echo $date->format('d-m-Y H:i:s');
                                                                                    ?>
                                                                                    <span class="text4_user">Birth Date & Time:</span>
                                                                                    <span class="space"><?= $date->format('d-m-Y H:i:s'); ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Birth Place:</span> <span class="space"><?= $opposite_gender_row['birth_place']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Gotra</span> <span class="space"><?= $opposite_gender_row['gotra_name']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Native:</span> <span class="space"><?= $opposite_gender_row['village_name']; ?></span>
                                                                                </div>
                                                                                
                                                                                <!--<div class="mt-1">
                                                                                    <span class="text4_user">Parent Mobile Number:</span> <span class="space"><?php
                                                                                        $mobile = $opposite_gender_row['father_mobile_number'] . ", ". $opposite_gender_row['motherMobile']; 
                                                                                     echo rtrim($mobile,","); ?></span>
                                                                                </div>-->
                                                                                
                                                                                <!--<div class="mt-1">
                                                                                    <span class="text4_user">Basic/ Graduate:</span> <span class="space"><?php echo $opposite_gender_row['basicqual'];
                                                                                        if ($opposite_gender_row['bq_det'] != "") {
                                                                                          echo " (" . $opposite_gender_row['bq_det'] . ") ";
                                                                                        }
                                                                                    ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Post Graduate:</span> <span class="space"><?php echo $opposite_gender_row['pgqual']; 
                                                                                        if ($opposite_gender_row['pg_det'] != "") {
                                                                                          echo " (" . $opposite_gender_row['pg_det'] . ") ";
                                                                                        }
                                                                                    ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Doctrate:</span> <span class="space"><?php echo $opposite_gender_row['docqual']; 
                                                                                        if ($opposite_gender_row['doc_det'] != "") {
                                                                                          echo " (" . $opposite_gender_row['doc_det'] . ") ";
                                                                                        }
                                                                                    ?></span>
                                                                                </div>-->
                                                                                
                                                                                
                                                                                
                                                                                

                                                                            </div>
                                                                            <div class="col-lg-5">
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Height:</span> <span class="space"><?php 
                                                                                    $height = explode(".", $opposite_gender_row['height']);
                                                                                    echo $height[0]. ' ft '. $height[1].' inch'; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Weight:</span> <span class="space"><?= $opposite_gender_row['weight']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Blood Group:</span> <span class="space"><?= $opposite_gender_row['blood_group']; ?></span>
                                                                                </div>
                                                                                
                                                                                <div class="mt-1">
                                                                                    <?php
                                                                                    if ($opposite_gender_row['spectacles'] == 1) {
                                                                                        $spectacles = "NO";
                                                                                    } else if ($opposite_gender_row['spectacles'] == 0) {
                                                                                        $spectacles = "Yes";
                                                                                    }else{
                                                                                        $spectacles = " ";
                                                                                    }
                                                                                    ?>
                                                                                    <span class="text4_user">Spectacles:</span> <span class="space"><?= $spectacles; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <?php
                                                                                    if ($opposite_gender_row['mangal'] == 1) {
                                                                                        $mangal = "NO";
                                                                                    } else if ($opposite_gender_row['mangal'] == 0) {
                                                                                        $mangal = "Yes";
                                                                                    }else{
                                                                                        $mangal = " ";
                                                                                    }
                                                                                    ?>
                                                                                    <span class="text4_user">Mangal:</span> <span class="space"><?= $mangal; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <?php
                                                                                    if ($opposite_gender_row['sani'] == 1) {
                                                                                        $sani = "NO";
                                                                                    } else if ($opposite_gender_row['sani'] == 0) {
                                                                                        $sani = "Yes";
                                                                                    }else{
                                                                                        $sani = "";
                                                                                    }
                                                                                    ?>
                                                                                    <span class="text4_user">Shani:</span> <span class="space"><?= $sani; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Current City:</span> <span class="space"><?= $opposite_gender_row['city_name']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">

                                                                                    <?php
                                                                                    $marital_status = '';

                                                                                    switch ($opposite_gender_row['marital_id']) {
                                                                                        case 4:
                                                                                            $marital_status = 'Married';
                                                                                            break;
                                                                                        case 5:
                                                                                            $marital_status = 'Unmarried';
                                                                                            break;
                                                                                        case 7:
                                                                                            $marital_status = 'Widower';
                                                                                            break;
                                                                                        case 8:
                                                                                            $marital_status = 'Engaged';
                                                                                            break;
                                                                                        case 9:
                                                                                            $marital_status = 'Divorce';
                                                                                            break;
                                                                                        case 11:
                                                                                            $marital_status = 'Widow';
                                                                                            break;
                                                                                        default:
                                                                                            $marital_status = 'Unknown';
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                    <span class="text4_user">Marital:</span> <span class="space"><?= $marital_status; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Education :</span> <span class="space"> Basic/ Graduate: <?php echo $opposite_gender_row['basicqual'];
                                                                                        if ($opposite_gender_row['bq_det'] != "") {
                                                                                          echo " (" . $opposite_gender_row['bq_det'] . ") ";
                                                                                        }
                                                                                    ?> </span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user"></span>
                                                                                    <span class="space"> Post Graduate: <?php echo $opposite_gender_row['pgqual']; 
                                                                                        if ($opposite_gender_row['pg_det'] != "") {
                                                                                          echo " (" . $opposite_gender_row['pg_det'] . ") ";
                                                                                        }
                                                                                    ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user"></span>
                                                                                    <span class="space">Doctrate: <?php echo $opposite_gender_row['docqual']; 
                                                                                        if ($opposite_gender_row['doc_det'] != "") {
                                                                                          echo " (" . $opposite_gender_row['doc_det'] . ") ";
                                                                                        }
                                                                                    ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Type:</span> <span class="space">
                                                                                        <?php
                                                                                            if($opposite_gender_row['prof_type'] == 'B'){
                                                                                                echo "Business";
                                                                                            } else if($opposite_gender_row['prof_type'] == 'H'){
                                                                                                echo "House Maker";
                                                                                            } else if($opposite_gender_row['prof_type'] == 'S'){
                                                                                                echo "Student";
                                                                                            } else if($opposite_gender_row['prof_type'] == 'P'){
                                                                                                echo "Self Employeds";
                                                                                            } else if($opposite_gender_row['prof_type'] == 'J'){
                                                                                                echo "Job";
                                                                                            } else if($opposite_gender_row['prof_type'] == 'R'){
                                                                                                echo "Retire";
                                                                                            } else {
                                                                                                echo "Not specified";
                                                                                            }
                                                                                            
                                                                                            ?>
                                                                                    </span>
                                                                                </div>
                                                                                <?php if($opposite_gender_row['prof_type'] == 'B'){ ?>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Business Category:</span> <span class="space"><?= $opposite_gender_row['b_main_group_name']; ?></span>
                                                                                    </div>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Business Industry:</span> <span class="space"><?= $opposite_gender_row['ind_name']; ?></span>
                                                                                    </div>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Business Name:</span> <span class="space"><?= $opposite_gender_row['bness_name']; ?></span>
                                                                                    </div>
                                                                                    
                                                                                <?php } 
                                                                                if($opposite_gender_row['prof_type'] == 'J'){
                                                                                ?>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Job Type:</span> <span class="space"><?= $opposite_gender_row['j_group_name']; ?></span>
                                                                                    </div>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Industry:</span> <span class="space"><?= $opposite_gender_row['job_ind_name']; ?></span>
                                                                                    </div>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Company Name:</span> <span class="space"><?= $opposite_gender_row['comp_name']; ?></span>
                                                                                    </div>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Desgination:</span> <span class="space"><?= $opposite_gender_row['job_desig']; ?></span>
                                                                                    </div>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Office Address:</span> <span class="space"><?= $opposite_gender_row['job_addr']; ?></span>
                                                                                    </div>
                                                                                    
                                                                                <?php } 
                                                                                if($opposite_gender_row['prof_type'] == 'P'){
                                                                                ?>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Profession Name:</span> <span class="space"><?= $opposite_gender_row['p_main_group_name']; ?></span>
                                                                                    </div>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Specialization:</span> <span class="space"><?= $opposite_gender_row['p_sub_group_name']; ?></span>
                                                                                    </div>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Office Address:</span> <span class="space"><?= $opposite_gender_row['prof_addr']; ?></span>
                                                                                    </div>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Description:</span> <span class="space"><?= $opposite_gender_row['prof_desc']; ?></span>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                    <div class="mt-1">
                                                                                        <span class="text4_user">Income:</span> <span class="space"><?= $opposite_gender_row['annual_income']; ?></span>
                                                                                    </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Hobby:</span> <span class="space"><?= $opposite_gender_row['hobby']; ?></span>
                                                                                </div>
                                                                                
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Facebook Link:</span> <span class="space"><?= $opposite_gender_row['strFacebookLink']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Instagram Link:</span> <span class="space"><?= $opposite_gender_row['strInstagramLink']; ?></span>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Is Handicap:</span> <span class="space"><?= $opposite_gender_row['isHandicap'] == 0 ? "No" : "Yes"; ?></span>
                                                                                </div>
                                                                                <?php if($opposite_gender_row['isHandicap'] == 1) { ?>
                                                                                <div class="mt-1">
                                                                                    <span class="text4_user">Handicap Description:</span> <span class="space"><?= $opposite_gender_row['strHandicapDescription']; ?></span>
                                                                                </div>
                                                                                <?php } ?>
                                                                                
                                                                                
                                                                                <!-- <p class="card-text"></p>
                                                                            <p class="card-text"></p> -->
                                                                            </div>
                                                                            <div class="col-lg-2">
                                                                                <button type="button" class="btn btn-danger" onclick="submitToMyPrefer(<?= $opposite_gender_row['iPreferredId'] ?>);">
                                                                                    <!--<img src="/images/signal-thumbs-up.png" style="width: 20px;" />-->
                                                                                    <strong>-</strong> My Prefer</button>
                                                                                
                                                                                <?php
                                                                                $img = $opposite_gender_row['user_id'];
                                                                                $img_path = $opposite_gender_row['full_photo'];
                                                                                if(isset($opposite_gender_row['full_photo']) && $opposite_gender_row['full_photo'] != ""){
                                                                                ?>
                                                                                <div class="mt-1 mb-1">
                                                                                    <img src="<?php echo '/documents/' . $img . '/full_photo/' . $img_path; ?>" alt="User Document" style="height: 150px;width: 125px;">
                                                                                </div>
                                                                                <?php }
                                                                                if(isset($opposite_gender_row['passport_size_photo']) && $opposite_gender_row['passport_size_photo'] != ""){
                                                                                ?>
                                                                                <div class="mt-1 mb-1">
                                                                                    <img src="<?php echo '/documents/' . $img . '/passport_size_photo/' . $opposite_gender_row['passport_size_photo']; ?>" alt="User Document" style="height: 150px;width: 125px;">
                                                                                </div>
                                                                                <?php } ?>
                                                                                <!-- <img src="<?php echo 'assets/documents/' . $img . "/full_photo/" . $img_path; ?>" alt="User Document"> -->

                                                                                <!-- <a href="signup.php?Code=<?php echo $user_id; ?>&amp;Mode=E" target="_self">Edit Profile</a> -->
                                                                                <!--<a style="text-decoration: none;color:black;" href="user-familytree.php?id=<?php echo $opposite_gender_row['parent_id']; ?>" target="_blank">View Family Tree </a>-->
                                                                                <a style="text-decoration: none;color:black;" href="user-familydet.php?vid=<?php echo $opposite_gender_row['parent_id']; ?>" target="_blank">View Family Details </a>
                                                                            </div>

                                                                        </div>
                                                                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr>

                                            <?php
                                                        }
                                                    } else {
                                                        echo "No opposite gender users found in the matrimony table.";
                                                    }
                                                } else {
                                                    echo "User not found in vastipatrak_m.";
                                                }
                                            } else {
                                                echo "User not found in matrimony table.";
                                            }

                                            $cn->close();
                                            ?>

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
        function submitToMyPrefer(iPreferredId){
            var errMsg = 'Are you sure you want to Remove from Preferred List?';
            if (confirm(errMsg)) {
                $.ajax({
                    type: "POST",
                    url: "AjaxaddPerfered.php",
                    data: {action: "Remove",iPreferredId: iPreferredId},
                    success: function (msg) {
                        if(msg == 0){
                            alert('Removed successfully');
                            window.location.href = '';
                        } else if(msg == 1){
                            alert('Invalid request.');
                            window.location.href = '';
                        } else {
                            alert('Something went wrong.');
                            window.location.href = '';
                        }
                        return false;
                    },
                });
            }
            return false;
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('myModal');
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const closeModal_Btn = document.getElementById('closeModal_Btn');
            // Open the modal
            openModalBtn.onclick = function() {
                modal.style.display = 'block';
            }
        
            // Close the modal
            closeModalBtn.onclick = function() {
                modal.style.display = 'none';
            }
            
            closeModal_Btn.onclick = function() {
                modal.style.display = 'none';
            }
        
            // Close the modal when clicking outside of it
            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }
        });
        
        
    </script>
</body>

</html>