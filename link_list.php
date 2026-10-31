<?php
include 'admin/connection/conn.php';
include_once "header.php";
if (isset($_GET['token']) && filter_var($_GET['token'], FILTER_VALIDATE_INT) !== false) {
    if ($_GET['token'] == '1')
        $linkRes = mysqli_query($cn, "select * from post_m where post_menu_vc='BHAVANS'");
    else if ($_GET['token'] == '2')
        $linkRes = mysqli_query($cn, "select * from post_m where post_menu_vc='TEMPLES'");
    else if ($_GET['token'] == '3')
        $linkRes = mysqli_query($cn, "select * from post_m where post_menu_vc='RECEIPES'");
    else if ($_GET['token'] == '4')
        $linkRes = mysqli_query($cn, "select * from post_m where post_menu_vc='DISEASES'");
    else
        header('location: index.php');
} else {
    header('location: index.php');
}
?>
<section>
    <div class="container">

        <?php
        if ($_GET['token'] == '1')
            echo ' <h2 class="pho-gall2 mt-3">BHAVANS</h2>';
        else if ($_GET['token'] == '2')
            echo ' <h2 class="pho-gall2 mt-3">TEMPLES</h2>';
        else if ($_GET['token'] == '3')
            echo ' <h2 class="pho-gall2 mt-3">RECEIPES</h2>';
        else if ($_GET['token'] == '4')
            echo ' <h2 class="pho-gall2 mt-3">DISEASES</h2>';
        
        ?>
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (mysqli_num_rows($linkRes) > 0) {
                    while ($rowLinks = mysqli_fetch_assoc($linkRes)) { ?>
                        <div class="mt-4">
                            <h4 class="arr-b"> <a href="#"><?= $rowLinks['post_title_vc'] ?></a></h4>
                            <p class="arrsub-txt"><?= $rowLinks['post_shortdesc_vc'] ?></p>
                        </div>
                <?php }
                } else {
                    echo '<div class="mt-4" style="text-align: center;"> 
                     <p class="arrsub-txt">Thank you for your intreset.</p>
                    <p class="arrsub-txt">Data will be uploaded veru soon.</p></div>';
                } ?>

            </div>
        </div>
    </div>
</section>
<?php
include_once "footer.php";
?>