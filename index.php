<?php
  include_once "header.php";
  include_once "admin/connection/conn.php";
  ?>
  <style>
    @media only screen and (max-width: 800px) {

        .msg p {
            line-height: 20.08px !important;
        }
    }
    .msg p {
        line-height: 20.08px !important;
    }
  </style>
  <!-- nav end -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/Image 01.jpg" alt=""></div>
          <div class="nam-txt">
            <p class="mb-0">1st VP Granth Publisher</p>
            <p class="mb-0">Mumbai-1974 (1974-1979)</p>
            <p class="mb-0">Late. Shree Chandulal Dungardas Shah</p>

          </div>
        </div>
      </div>
      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/image 1.jpg" alt=""></div>
          <div class="nam-txt">
            <p class="mb-0">2nd VP Granth Publisher</p>
            <p class="mb-0">Bolundra-1981 (1979-1984)</p>
            <p class="mb-0">Late. Shree Manukantbhai C Shah</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/image 2.jpg" alt=""></div>
          <div class="nam-txt">
            <p class="mb-0">3rd VP Granth Publisher</p>
            <p class="mb-0">Talod-1987 (1984-1988)</p>
            <p class="mb-0">Late. Shree Damodardas V Shah</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/image 3.jpg" alt=""></div>
          <div class="nam-txt">
            <p class="mb-0">4th VP Granth Publisher</p>
            <p class="mb-0">Modasa-1994 (1988-1994)</p>
            <p class="mb-0">Dr.Mukundlal V Shah</p>

          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/image 4.jpg" alt=""></div>
          <div class="nam-txt">
            <p class="mb-0">5th VP Granth Publisher</p>
            <p class="mb-0">Kotiyark-2000 (1997-2000)</p>
            <p class="mb-0">Shree Vrundavan J Shah</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/image 5.jpg" alt=""></div>
          <p class="mb-0"></p>
          <p class="mb-0"></p>
          <div class="nam-txt">
            <p class="mb-0">6th VP Granth Publisher</p>
            <p class="mb-0">Ahmedabad-2006 (2004-2006)</p>
            <p class="mb-0">Shree Vinodkumar M Shah</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/image 6.jpg" alt=""></div>
          <div class="nam-txt">
            <p class="mb-0">7th VP Granth Publisher</p>
            <p class="mb-0">Gandhinagar-2012 (2010-2012)</p>
            <p class="mb-0">Shree Bharatkumar C Shah</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/image7.jpg" alt="No-img"></div>
          <div class="nam-txt">
            <p class="mb-0">8th VP Granth Publisher</p>
            <p class="mb-0">Ahmedabad-2022 (2020-2023)</p>
            <p class="mb-0">Shree Dipakkumar D Shah</p>
          </div>
        </div>
      </div>

    </div>
    <!-- <div class="swiper-pagination"></div> -->
  </div>

  <!-- Slider Section start  -->
  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <?php
      $resSlider = mysqli_query($cn, "SELECT * FROM  advt_tbl order by advt_id DESC");
      while ($rowslider = mysqli_fetch_assoc($resSlider)) { ?>
        <div class="carousel-item active">
          <img src="admin/images/advertise/<?= $rowslider['file'] ?>" class="d-block w-100" alt="...">
          <!-- <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div> -->
        </div>
      <?php } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- Slider Section start  -->

  <!-- Slogan start  -->
  <section class="pt-1 pb-5 bg-li">
    <div class="container">
      <!--<h2 class="pho-gall">President Message</h2>-->
      <h2 class="pho-gall">Editor Desk Message</h2>
      
      <div class="row justify-content-center">

        <div class="col-lg-8">
          <div class="msg">
            <?php
            $msgDetail = mysqli_fetch_assoc(mysqli_query($cn, "select * from homepg_m order by home_code desc  limit 0,1 "));
            echo $msgDetail['home_text_short'];

            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Slogan End  -->

  <section>
    <div class="container">
      <div class="row">

      </div>
    </div>
  </section>

  <div class="swiper mySwiper">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/A4.png" alt=""></div>
          <div class="nam-txt2">
            <p class="mb-0 mt-2">Late. Shree Dr C K Shah</p>
            <p class="mb-0">(1994-1997)</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/A6.jpg" alt=""></div>
          <div class="nam-txt2">

            <p class="mb-0 mt-2">Shree Amrutlal N Shah</p>
            <p class="mb-0">(2000-2002)</p>
          </div>
        </div>
      </div>



      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/A7.jpg" alt=""></div>
          <div class="nam-txt2">
            <!-- <p class="mb-0">Seven Publisher</p> -->

            <p class="mb-0 mt-2">Late. Shree Vallabhdas S Shah</p>
            <p class="mb-0">(2002-2004)</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/A9.jpg" alt=""></div>
          <div class="nam-txt2">

            <p class="mb-0 mt-2">Shree Jashvant K Shah</p>
            <p class="mb-0">(2006-2008)</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/A10.jpg" alt=""></div>
          <div class="nam-txt2">

            <p class="mb-0 mt-2">Shree Ratilal K Shah</p>
            <p class="mb-0">(2008-2010)</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/A12.jpg" alt=""></div>
          <div class="nam-txt2">

            <p class="mb-0 mt-2">Shree Sureshchandra R Shah</p>
            <p class="mb-0">(2012-2014)</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/A13.jpg" alt=""></div>
          <div class="nam-txt2">

            <p class="mb-0 mt-2">Late. Shree Jashvant R Shah</p>
            <p class="mb-0">(2014-2016)</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/A14.jpg" alt=""></div>
          <div class="nam-txt2">

            <p class="mb-0 mt-2">Shree Harshadkumar J Shah</p>
            <p class="mb-0">(2016-2018)</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div>
          <div class="mm-img"><img src="images/members/A15.jpg" alt=""></div>
          <div class="nam-txt2">

            <p class="mb-0 mt-2">Shree Mahendrakumar V Shah</p>
            <p class="mb-0">(2018-2020)</p>
          </div>
        </div>
      </div>

    </div>
    <!-- <div class="swiper-pagination"></div> -->
  </div>

  <!-- Photo Gallary start  -->
  <section class="bg-prime">
    <div class="d-flex justify-content-beetween">
      <!-- <h2 class="pho-gall">Photos Gallary</h2> -->
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-6 col-sm-12">
          <h4 class="pho-gall text-center pb-2">Photos Gallary</h4>
          <div class="d-flex justify-content-around les">
            <?php

            $resPG = mysqli_query($cn, "SELECT c.cat_id,p.large_image FROM `products_cat` as c  inner join photo_gallary as p on p.cat_id=c.cat_id WHERE cat_type='photogallery' GROUP by p.cat_id order by c.cat_id  desc limit 0,2");
            while ($rowPG = mysqli_fetch_assoc($resPG)) { ?>
              <div class="img-abs border-img">
                <a href="photogallery.php?token=<?= $rowPG['cat_id'] ?>"><img class="img-fluid" src="admin/images/gallery/large/<?= $rowPG['large_image'] ?>" alt=""></a>
              </div>

            <?php } ?>
          </div>

        </div>



        <div class="col-lg-4 col-lg-4 col-sm-12">
          <h4 class="pho-gall text-start pb-2">News & Events</h4>

          <div class="img-abs border-w">
            <marquee upamount="10" class="text-center text-white h6" height="200" direction="up" onmouseover="this.stop();" onmouseout="this.start();">
              <?php
              $resNews = mysqli_query($cn, "select * from news_offer order by news_date  desc limit 0,3");
              if (mysqli_num_rows($resNews) > 0) {
                echo "<h6 class='f-txt'>News</h6>";
                while ($rowNews = mysqli_fetch_assoc($resNews)) { ?>
                
                  <p class="text-start"><a href="<?php echo  ($rowNews['thumb_image'])?'admin/images/gallery/news/'.$rowNews['thumb_image']:'';?>" class="fs-v" target="_blank"  ><!--<img src="images/new.gif" alt="">-->&nbsp;&nbsp;&nbsp; <?=$rowNews['Heading'].'('.date('d-m-Y',strtotime($rowNews['news_date'])).')'?></a></p>
              <?php }
              } ?>

              <?php
              $resNews = mysqli_query($cn, "select * from events_m order by event_date  desc limit 0,3");
              if (mysqli_num_rows($resNews) > 0) {
                echo "<h6 class='f-txt'>Upcoming Event</h6>";
                while ($rowNews = mysqli_fetch_assoc($resNews)) { ?>
                
                  <p class="text-start"><a href="<?php echo ($rowNews['thumb_image']) ? 'admin/images/gallery/events/'.$rowNews['thumb_image']:'';?>" class="fs-v" target="_blank" ><!--<img src="images/new.gif" alt="">-->&nbsp;&nbsp;&nbsp; <?=$rowNews['event_name'].'('.date('d-m-Y',strtotime($rowNews['event_date'])).')'?></a></p>
              <?php }
              } ?>

            </marquee>


          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer Start  -->



  <?php
  include_once "footer.php";
  ?>
  <!-- Load Facebook SDK for JavaScript -->

<a href="http://www.tumblr.com/share/link?url=https://www.apolloinfotech.com/social-media-marketing&name=social media marekting">    
   Fb
</a>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      spaceBetween: 30,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,

      },
      breakpoints: {
        // when window width is <= 499px
        320: {
          slidesPerView: 1,
          spaceBetweenSlides: 30
        },
        768: {
          slidesPerView: 2,
          spaceBetweenSlides: 30
        },
        // when window width is <= 999px
        999: {
          slidesPerView: 5,
          spaceBetweenSlides: 40
        }
      }
    });
  </script>