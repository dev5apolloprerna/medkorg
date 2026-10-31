<?php
include 'admin/connection/conn.php';
include_once "header.php";
$largeimgdir = "admin/images/gallery/large/";
$check_category =  mysqli_query($cn, "SELECT c.cat_id,p.large_image,c.cat_name FROM `products_cat` as c  inner join photo_gallary as p on p.cat_id=c.cat_id WHERE cat_type='photogallery' and p.cat_id=" . $_REQUEST['token'] . " order by c.cat_id  desc ");
$numcategory = mysqli_num_rows($check_category);
$nameDetail=mysqli_fetch_assoc($check_category);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
<!-- on image pages only------------------------ -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
</style>
<section class="mt-50">
    <div class="container">
        <h2 class="pho-gall2 mb-4"><?=$nameDetail['cat_name']?></h2>
        <div class="row gallerys mb-4">
            <?php
            if (mysqli_num_rows($check_category) > 0) {
                $i = 1;
                while ($rowAlbum = mysqli_fetch_assoc($check_category)) { ?>
                    <div class="col-lg-4">
                        <div class="product-box"><a href="<?php echo $largeimgdir . $rowAlbum['large_image']; ?>" target="_blank">
                                <img class="img-fluid" src="<?php echo $largeimgdir . $rowAlbum['large_image']; ?>" alt="">
                            </a></div>

                       

                    </div>
            <?php
                    if (($i % 3) == 0) {
                        echo '</div><div class="row gallerys">';
                    }
                    $i++;
                }
            } ?>



        </div>

</section>

<?php
include_once "footer.php";
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
    $(document).ready(function() {
        $('.gallerys').magnificPopup({
            type: 'image',
            delegate: 'a',
            gallery: {
                enabled: true
            }
        });
    });
</script>