<?php
include_once "header.php";
include_once "admin/connection/conn.php";

$largeimgdir = "admin/images/gallery/large/";

//  get  News category data //


$check_category =  mysqli_query($cn, "SELECT c.cat_id,p.large_image,c.cat_name FROM `products_cat` as c  inner join photo_gallary as p on p.cat_id=c.cat_id WHERE cat_type='photogallery' GROUP by p.cat_id order by c.cat_id  desc ");
$numcategory = mysqli_num_rows($check_category);

$extra = "";

// if ($numcategory > 0) {
//   $category_info = array();
//   while ($row = mysqli_fetch_assoc($check_category)) {
//     $f['cat_id'] = stripslashes($row['cat_id']);
//     $f['cat_name'] = stripslashes($row['cat_name']);
//     $category_info[] = $f;
//   }
// } else {
//   $category_info[0]['cat_id'] = "0";
// }

// if ($_POST) {
//   $cond = $_POST['cat_name'];
// } else if (isset($_GET['id']) && $_GET['id'] != "") {
//   $cond = $_GET['id'];
// } else {
//   $cond = $category_info[0]['cat_id'];
// }

// $sql_string = "SELECT count(*) as totrec FROM photo_gallary where cat_id=" . $cond;
// $result = mysqli_query($cn, $sql_string);
// $tmp = mysqli_fetch_assoc($result);
// $totrecord = $tmp['totrec'];
// $recperpage = 51;
// $maxpage = (int)($totrecord / $recperpage);

// $rem = $totrecord % $recperpage;
// if ($rem > 0)
//   $maxpage++;

// $pageNum = 1;

// if (isset($_GET['pageid']))
//   $pageNum = $_GET['pageid'];

// $offset = ($pageNum - 1) * $recperpage;
// $limit = "LIMIT $offset,$recperpage";

// // Paging ends // 

// $sql_imgs = "select * from photo_gallary where cat_id=" . $cond . " order by photo_id $limit";
// $chk_imgs = mysqli_query($cn, $sql_imgs);

?>
<style>
  .example {

    position: relative;
    padding: 0;
    width: 100%;
    margin: 10px 0px;
    display: block;
    cursor: pointer;
    overflow: hidden;
    height: 100%;

  }

  .example img {

    height: 100%;
    object-fit: cover;
  }

  .content {
    opacity: 0;
    font-size: 20px;
    position: absolute;
    top: 0;
    left: 0;
    color: rgb(255, 255, 255);
    text-transform: uppercase;
    background-color: rgba(113, 109, 109, 0.5);
    width: 263px;
    height: 200px;
    -webkit-transition: all 400ms ease-out;
    -moz-transition: all 400ms ease-out;
    -o-transition: all 400ms ease-out;
    -ms-transition: all 400ms ease-out;
    transition: all 400ms ease-out;
    text-align: center;
  }

  .example .content:hover {
    opacity: 1;
  }

  .example .content .text {
    height: 0;
    opacity: 1;
    transition-delay: 0s;
    transition-duration: 0.4s;
  }

  .example .content:hover .text {
    opacity: 1;
    transform: translateY(250px);
    /* -webkit-transform: translateY(250px); */
    -webkit-transform: translateY(80px);
    
  }

  .example .content:hover .text a:hover {
    color: white;
    
  }
</style>
<!-- Photo Gallary Start  -->
<section class="mt-3 mb-5">
  <div class="container">
    <h2 class="pho-gall2 mb-4">Photo Album Gallery</h2>
    <div class="row">
      <?php
      $i = 1;
      while ($rowAlbum = mysqli_fetch_assoc($check_category)) { ?>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="g-ss example">

            <img class="img-fluid" src="<?php echo $largeimgdir . $rowAlbum['large_image']; ?>" alt="">
            <div class="content">
              <div class="text"><a href="photogallery.php?token=<?= $rowAlbum['cat_id'] ?>"><?= $rowAlbum['cat_name'] ?></a></div>
            </div>
          </div>
        </div>

      <?php

        if (($i % 4) == 0) {
          echo '</div><div class="row mt-3">';
        }
        $i++;
      } ?>

    </div>
</section>
<?php
include_once "footer.php";
?>