<?php

include_once "admin/connection/conn.php";
include_once "mnu_main.php";
include_once "header.php";

if (isset($_POST["txtCode"])=="")
{
	$varCode = isset($_GET['Code']) ? $_GET['Code'] :"";
}
else
{
	$varCode = $_POST['txtCode'];
}


$sql="SELECT `org_id`,`org_type`,`org_name`,`est_year` FROM `organization_m` WHERE `org_type`='Primary' order by est_year asc ";
$chk_org = mysqli_query($cn, $sql);
while ($organization = mysqli_fetch_array($chk_org)){
    $organizationmaster[] = array(
        'org_id' => $organization['org_id'],
        'org_type' => $organization['org_type'],
        'org_name' => $organization['org_name'],
        'est_year'=>$organization['est_year']
    );
}

$sql1="SELECT `org_id`,`org_type`,`org_name`,`est_year` FROM `organization_m` WHERE `org_type`='regional' order by est_year asc";
$check_org = mysqli_query($cn,$sql1);
while ($org_m = mysqli_fetch_array($check_org)) {
    $org[] = array(
        'org_id' => $org_m['org_id'],
        'org_type' => $org_m['org_type'],
        'org_name' => $org_m['org_name'],
        'est_year' => $org_m['est_year']
    );
}

// print_r($organizationmaster);exit;

?>

<!-- Orgenazation start  -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="event-head text-start"><i class="fas fa-arrow-alt-circle-right"></i> Primary Organization</h2>
                <ul>
                <?php 
                foreach($organizationmaster as $sql) {
                ?>
                <li> <a class="org-name-list" href="organization_details.php?orgid=<?php echo $sql['org_id']; ?>"> <?php echo $sql['org_name']." (since-".$sql['est_year'].")"; ?></a>
                <?php
                }
                ?>
                </li>
                </ul>
           
                <h2 class="event-head text-start"><i class="fas fa-arrow-alt-circle-right"></i> Regional Organization</h2>
                <ul>
                <?php
                foreach($org as $sql1) {
                ?>
                <li><a class="org-name-list" href="organization_details.php?orgid=<?php echo $sql1['org_id'];?>"> <?php echo $sql1['org_name']." (since-".$sql1['est_year'].")"; ?></a>
                <?php
                }
                ?>
                </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Orgenazation End  -->

<?php 

include_once 'footer.php';

?>