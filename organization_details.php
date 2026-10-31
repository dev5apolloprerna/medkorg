<?php
//	include_once "noentry.php";
include_once "admin/connection/conn.php";
include_once "mnu_main.php";
include_once "header.php";
$imgdir1 = "admin/images/vastipatrak/member_images/";
$imgdir2 = "logo/";
$varCode = "";
if (isset($_GET['orgid'])) {
    $varCode = $_GET['orgid'];
}
$president = '';

$sql = "SELECT `org_name`,`est_year`,`about_organization`,`org_logo` FROM `organization_m`WHERE `org_id`=$varCode";
$chk_org = mysqli_query($cn, $sql);


$sql1 = "SELECT `org_est_year`,`org_name`,`year`,`city`,`org_history_pdf` FROM `organization_history` WHERE `org_id`=$varCode";
$check_org = mysqli_query($cn, $sql1);


$query = "SELECT `org_form_name`,`org_form_pdf` FROM `organization_forms` WHERE`org_id`=$varCode";
$chk_forms = mysqli_query($cn, $query);




$data = "SELECT`other_info_name`,`other_info_pdf` FROM `other_information` WHERE org_id=$varCode";
$chk_info = mysqli_query($cn, $data);

?>
<style>
    table {
        background-color: #D1ACA5;
    }


    table tr th {
        border-collapse: collapse;
        border: 1px solid rgb(255, 255, 255);
        padding: 5px 20px;
        color: rgb(255, 255, 255);
        /* background-color: #540f00; */
        background-color: #1D3557;
    }

    table tr td {
        border-collapse: collapse;
        border: 1px solid rgb(255, 255, 255);
        padding: 5px 20px;
        color: white;
        background-color: #457B9D;
    }
</style>
<!-- Orgenazation start  -->
<section>
    <div class="container">
        <div class="row">
            <h2 class="event-head mb-4"></h2>

            <div class="col-lg-3">
                <?php
                $organization = mysqli_fetch_array($chk_org);
                ?>
                <div class="mem-img">
                    <img src="<?php echo ($organization['org_logo'] != '') ? $imgdir2 . $organization['org_logo'] : 'admin/images/no-user-image.jpg'; ?>">
                </div>
            </div>
            <div class="col-lg-9">
                <p class="org-name mb-0">
                    <a class="org-name"> <?php echo $organization['org_name']; ?></a>
                </p>
                <p class="org-txt fw-bold">Established in
                    <a class="est_year"> <?php echo $organization['est_year']; ?></a>
                </p>
                <?php
              
                if (isset($organization['about_organization'])) { ?>
                    <a href="organizations_information_pdf/<?php echo $organization['about_organization']; ?>" target="_blank" class="pdf-icon"><button> <i class="fas fa-file-pdf"></i> View History </button></a>
                <?php }
                   if(isset($_SESSION["UserCode"])){ 
                if (mysqli_num_rows($chk_forms) > 0) { ?>
                    <br>
                    <hr>
                    <p class="org-txt fw-bold">Organization FORM</p>
                    <div class="org-form">
                        <p>
                            <?php
                            while ($org_f = mysqli_fetch_array($chk_forms)) {
                            ?>
                                <a href="organizations_form_information_pdf/<?php echo $org_f['org_form_pdf']; ?>" target="_blank" class="pdf-icon"><i class="fas fa-file-pdf"></i><?php echo $org_f['org_form_pdf']; ?></a>
                        </p>
                    <?php
                            }
                    ?>

                <?php }
                
                if (mysqli_num_rows($chk_info) > 0) { ?>
                    <br>
                    <hr>
                    <p class="org-txt fw-bold">Other Detail</p>
                    <div class="org-form">
                        <p>
                            <?php
                            while ($org_other = mysqli_fetch_array($chk_info)) {
                            ?>
                                <a href="other_information_pdf/<?php echo $org_other['other_info_pdf']; ?>" target="_blank" class="pdf-icon"><i class="fas fa-file-pdf"></i><?php echo $org_other['other_info_name']; ?></a>
                        </p>
                    <?php
                            }
                    ?>

                <?php }} ?>
                    </div>
            </div>
        </div>
</section>
<!-- Orgenazation End  -->

<section>

    <div class="container">
        <div class="row">
            <h2 class="event-head mb-4">Committee Member</h2>
            <?php
            $query1 = "SELECT`org_member_name`,`org_member_photo`,`designation`,`phone_no`,`city`,`display_seq` FROM `organization_members` WHERE org_id=$varCode and display_seq IN (0) order by display_seq  asc";
            $chk_member = mysqli_query($cn, $query1);
            $head1 = mysqli_num_rows($chk_member);
            if (mysqli_num_rows($chk_member) > 0) {
                while ($org_m = mysqli_fetch_array($chk_member)) {
                    $imgUrl = ($org_m['org_member_photo'] != '') ? $imgdir1 . $org_m['org_member_photo'] : 'admin/images/no-user-image.jpg';
                    $president .= '<div class="col-lg-3">
                        <div class="memeber-details">
                            <div class="mem-img"><img src="' . $imgUrl . '" style="width: 150px;height: 220px;margin: 0px 50px;"></div>
                            <div class="text-center">
                                <h5 class="m-name"><a class="org_member_name">' . $org_m['org_member_name'] . '</a> </h5>
                                <p class="mb-0 m-des"><a class="designation">' . $org_m['designation'] . '</a> </p>
                                <p><i class="fas fa-phone-alt"><a class="m-des" href="tel:' . $org_m['phone_no'] . '">' . $org_m['phone_no'] . '</i></a></p>
                                <p><a class="m-des">' . $org_m['city'] . '</a></p>
                            </div>
                        </div>
                    </div>';
                }
            }
            echo $president;
            ?>
        </div>
        <div class="row">
            <?php
            $query1 = "SELECT`org_member_name`,`org_member_photo`,`designation`,`phone_no`,`city`,`display_seq` FROM `organization_members` WHERE org_id=$varCode and display_seq IN (1) order by sub_seq asc";
            $chk_member = mysqli_query($cn, $query1);
            if (mysqli_num_rows($chk_member) > 0) {
                $i = 1;
                while ($org_m = mysqli_fetch_array($chk_member)) {

            ?>
                    <div class="col-lg-3" style="padding-top: 50px;">
                        <div class="memeber-details">
                            <div class="mem-img"><img src="<?php echo ($org_m['org_member_photo'] != '') ? $imgdir1 . $org_m['org_member_photo'] : 'admin/images/no-user-image.jpg'; ?>" style="width: 150px;height: 220px;margin: 0px 50px;"></div>
                            <div class="text-center">
                                <h5 class="m-name"><a class="org_member_name"> <?php echo $org_m['org_member_name']; ?></a> </h5>
                                <p class="mb-0 m-des"><a class="designation"> <?php echo $org_m['designation']; ?></a> </p>
                                <p><i class="fas fa-phone-alt"><a class="m-des" href="tel:<?php echo $org_m['phone_no']; ?>"><?php echo $org_m['phone_no']; ?></i></a></p>
                                <p><a class="m-des"><?php echo $org_m['city']; ?></a></p>
                            </div>
                        </div>
                    </div>
            <?php

                }
            }
            ?>
        </div>
        <div class="row">
            <?php
            $query1 = "SELECT`org_member_name`,`org_member_photo`,`designation`,`phone_no`,`city`,`display_seq` FROM `organization_members` WHERE org_id=$varCode and display_seq IN (2) order by sub_seq asc";
            $chk_member = mysqli_query($cn, $query1);
            if (mysqli_num_rows($chk_member) > 0) {
                $i = 1;
                while ($org_m = mysqli_fetch_array($chk_member)) {

            ?>
                    <div class="col-lg-3" style="padding-top: 50px;">
                        <div class="memeber-details">
                            <div class="mem-img"><img src="<?php echo ($org_m['org_member_photo'] != '') ? $imgdir1 . $org_m['org_member_photo'] : 'admin/images/no-user-image.jpg'; ?>" style="width: 150px;height: 220px;margin: 0px 50px;"></div>
                            <div class="text-center">
                                <h5 class="m-name"><a class="org_member_name"> <?php echo $org_m['org_member_name']; ?></a> </h5>
                                <p class="mb-0 m-des"><a class="designation"> <?php echo $org_m['designation']; ?></a> </p>
                                <p><i class="fas fa-phone-alt"><a class="m-des" href="tel:<?php echo $org_m['phone_no']; ?>"><?php echo $org_m['phone_no']; ?></i></a></p>
                                <p><a class="m-des"><?php echo $org_m['city']; ?></a></p>
                            </div>
                        </div>
                    </div>
            <?php

                }
            }
            ?>
        </div>
        <div class="row">
            <?php
            $query1 = "SELECT`org_member_name`,`org_member_photo`,`designation`,`phone_no`,`city`,`display_seq` FROM `organization_members` WHERE org_id=$varCode and display_seq IN (3) order by sub_seq asc";
            $chk_member = mysqli_query($cn, $query1);
            if (mysqli_num_rows($chk_member) > 0) {
                while ($org_m = mysqli_fetch_array($chk_member)) {
            ?>
                    <div class="col-lg-3">
                        <div class="memeber-details">
                            <div class="mem-img"><img src="<?php echo ($org_m['org_member_photo'] != '') ? $imgdir1 . $org_m['org_member_photo'] : 'admin/images/no-user-image.jpg'; ?>" style="width: 150px;height: 220px;margin: 0px 50px;"></div>
                            <div class="text-center">
                                <h5 class="m-name"><a class="org_member_name"> <?php echo $org_m['org_member_name']; ?></a> </h5>
                                <p class="mb-0 m-des"><a class="designation"> <?php echo $org_m['designation']; ?></a> </p>
                                <p><i class="fas fa-phone-alt"><a class="m-des" href="tel:<?php echo $org_m['phone_no']; ?>"><?php echo $org_m['phone_no']; ?></i></a></p>
                                <p><a class="m-des"><?php echo $org_m['city']; ?></a></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="row">
            <?php
            $query1 = "SELECT`org_member_name`,`org_member_photo`,`designation`,`phone_no`,`city`,`display_seq`,`sub_seq` FROM `organization_members` WHERE org_id=$varCode and display_seq IN (4) order by sub_seq asc";
            $chk_member = mysqli_query($cn, $query1);
            if (mysqli_num_rows($chk_member) > 0) {
                while ($org_m = mysqli_fetch_array($chk_member)) {
            ?>
                    <div class="col-lg-3">
                        <div class="memeber-details">
                            <div class="mem-img"><img src="<?php echo ($org_m['org_member_photo'] != '') ? $imgdir1 . $org_m['org_member_photo'] : 'admin/images/no-user-image.jpg'; ?>" style="width: 150px;height: 220px;margin: 0px 50px;"></div>
                            <div class="text-center">
                                <h5 class="m-name"><a class="org_member_name"> <?php echo $org_m['org_member_name']; ?></a> </h5>
                                <p class="mb-0 m-des"><a class="designation"> <?php echo $org_m['designation']; ?></a> </p>
                                <p><i class="fas fa-phone-alt"><a class="m-des" href="tel:<?php echo $org_m['phone_no']; ?>"><?php echo $org_m['phone_no']; ?></i></a></p>
                                <p><a class="m-des"><?php echo $org_m['city']; ?></a></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

</section>
<?php
if (mysqli_num_rows($check_org) > 0) { ?>
    <section>
        <div class="container">
            <div class="row">
                <h2 class="event-head mb-4">PAST PRESIDENT HISTORY</h2>
                <table border="1" class="table-responsive">
                    <tr>
                        <th>Sr. No</th>
                        <th>Name</th>
                        <th>Serve from-to</th>
                        <th>Tenure</th>
                        <th>City</th>
                    </tr>
                    <?php
                    $i = 1;
                    while ($org_h = mysqli_fetch_array($check_org)) {
                        $org_name = $org_h['org_name'];
                        $org_est_year = $org_h['org_est_year'];
                        $year = $org_h['year'];
                        $city = $org_h['city'];
                        $org_history_pdf = $org_h['org_history_pdf'];
                        echo '<tr>
                    <td> ' . $i . '</td>
                    <td> ' . $org_name . '</td>
                    <td> ' . $org_est_year . '</td>
                    <td> ' . $year . '</td>
                    <td> ' . $city . '</td>
                   
                    </tr>';
                        $i++;
                    }

                    ?>

                </table>
            </div>
        </div>
    </section>
<?php }
if (mysqli_num_rows($chk_forms) > 0) { ?>
    <!-- <section>
        <div class="container">
            <div class="row">
                <h2 class="event-head mb-4">Organization FORM</h2>
                <div class="org-form">
                    <p>
                        <?php
                        while ($org_f = mysqli_fetch_array($chk_forms)) {
                        ?>
                            <a href="organizations_form_information_pdf/<?php echo $org_f['org_form_pdf']; ?>" target="_blank" class="pdf-icon"><i class="fas fa-file-pdf"></i><?php echo $org_f['org_form_pdf']; ?></a>
                    </p>
                <?php
                        }
                ?>
                </div>
            </div>

    </section> -->
<?php } ?>
<?php
include_once "footer.php"
?>