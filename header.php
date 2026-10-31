<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Calcutta");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Google Fonts  -->
    <!-- Bootstrap 5  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap 5  -->
    <!-- icons --------- -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- icons --------- -->
    <!-- Css  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Css  -->
    <!-- swiper demons  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- swiper demons  -->

<!-- Google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
     <!-- Google fonts  -->

    <!-- Demo styles -->
   <style>
   html,
   body {
     position: relative;
     height: 100%;
   }
   
   body {
     background: white;
     font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
     font-size: 14px;
     color: #000;
     margin: 0;
     padding: 0;
   }
   
   .swiper {
     width: 100%;
     height: 50%;
   }
   
   .swiper-slide {
     text-align: center;
     font-size: 18px;
     background: white;
     /* Center slide text vertically */
     display: -webkit-box;
     display: -ms-flexbox;
     display: -webkit-flex;
     display: flex;
     -webkit-box-pack: center;
     -ms-flex-pack: center;
     -webkit-justify-content: center;
     justify-content: center;
     -webkit-box-align: center;
     -ms-flex-align: center;
     -webkit-align-items: center;
     align-items: center;
   }
   
   .swiper-slide img {
     display: block;
     width: 250px;
     height: 200px;
     object-fit: contain;
   }

   
     
     

   </style>
  </head>
  <body>
    <!-- Middle bar -------------------------------->
    <section class="topbar-clr">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="middle-bar d-flex justify-content-between">
              <div class="img-bx">
                <img class="img-fluid head-img" src="images/kotyark.jpg" alt="">
              </div>
              <div>
                <div class="main-head">
                  <p class="mb-0">SHREE MODASA EKDA DASHA KHADAYATA</p>
                  <p class="text-center">52 GAM SAMAJ</p>
                </div>
              </div>

              <div class="logo d-flex">
                <img class="img-fluid" src="images/Logo 5.jpg" alt="">
              </div>
              
              <!-- <div class="main-date">
                <div class="spo-logo"><img src="assets/images/Uncle Image.png" alt="">
                </div>

              </div> -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Middle bar End -------------------------------->
    <section class="bo">
      <div class="main-menu-bar">
        <nav class="navbar navbar-expand-lg">
          <div class="container">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-stream navbar-toggler-icon"></i>
              <!-- <i class="fa-solid fa-bars"></i> -->
            </button>
            <div class="collapse navbar-collapse  justify-content-center" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'index.php') {
                        echo 'active';
                    } ?>">
                  <div class="dropdown">
                    <a href="index.php">
                      <button class="dropbtn <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'index.php') {
                        echo 'active';
                    } ?>">HOME</button>
                    </a>
                  </div>
                </li>
                <li class="nav-item <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'aboutus.php') {
                        echo 'active';
                    } ?>">
                  <div class="dropdown">
                    <a href="aboutus.php">
                      <button class="dropbtn  <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'aboutus.php') {
                        echo 'active';
                    } ?>">ABOUT US</button>
                    </a>
                  </div>
                </li>
                <!-- <li class="nav-item ">
                  <div class="dropdown">
                    <a href="vastipatrak.php">
                      <button class="dropbtn <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'vastipatrak.php') {
                        echo 'active';
                    } ?>">VASTIPATRAK</button>
                    </a>
                  </div>
                </li> -->
                <!-- <li class="nav-item">
                  <div class="dropdown">
                    <a href="matrimonial.php">
                      <button class="dropbtn <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'matrimonial.php') {
                        echo 'active';
                    } ?>">MATRIMONIAL</button>
                    </a>
                  </div>
                </li> -->
                <li class="nav-item">
                  <div class="dropdown">
                    <a href="organization.php">
                      <button class="dropbtn <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'organization.php' 
                      || basename($_SERVER['SCRIPT_NAME']) == 'organization_details.php') {
                        echo 'active';
                    } ?>">ORGANAZATIONS</button>
                    </a>
                  </div>
                </li>
                <li class="nav-item">
                  <div class="dropdown">
                    <a href="photos.php">
                      <button class="dropbtn <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'photos.php' 
                      || basename($_SERVER['SCRIPT_NAME']) == 'photogallery.php') {
                        echo 'active';
                    } ?>">PHOTO GALLERY</button>
                    </a>
                  </div>
                </li>
                <li class="nav-item">
                  <div class="dropdown"><button class="dropbtn <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'link_list.php') {
                        echo 'active';
                    } ?>">USEFUL LINKS</button>
                  <div class="dropdown-content">
                    <a href="link_list.php?token=1">BHAVANS</a>
                    <a href="link_list.php?token=2">TEMPLES</a>
                    <a href="link_list.php?token=3">RECEPIES</a>
                    <a href="link_list.php?token=4">DISEASES</a>
                  </div>
                  </div>
                </li>
                <!-- <li class="nav-item">
                  <div class="dropdown">
                    <a href="feedback.php">
                      <button class="dropbtn">FEEDBACK</button>
                    </a>
                  </div>
                </li> -->
                <!-- <li class="nav-item"><div class="dropdown"><button class="dropbtn">PARTICIPENT</button><div class="dropdown-content"><a href="foor-p.php">FLOOR PLAN</a><a href="exh-profile.php">EXHIBITOR PROFILE</a><a href="why-exh.php">WHY EXHIBIT ?</a><a href="prom-program.php">SHOW PROMOTION PROGRAM</a></div></div></li> -->
                <!-- <li class="nav-item"><div class="dropdown"><button class="dropbtn">VISITORS</button><div class="dropdown-content"><a href="ww-vis.php">WHO WILL VISIT ?</a><a href="whyvisit.php">WHY VISIT ?</a></div></div></li> -->
                <li class="nav-item">
                  <div class="dropdown">
                    <a href="user_guide.php">
                      <button class="dropbtn <?php 
                      if ( basename($_SERVER['SCRIPT_NAME']) == 'user_guide.php') {
                        echo 'active';
                    } ?>">USER GUIDE</button>
                    </a>
                  </div>
                </li>
                <li class="nav-item">
                  <div class="dropdown">
                    <a href="contact.php">
                      <button class="dropbtn <?php 
                      if (basename($_SERVER['SCRIPT_NAME']) == 'contact.php') {
                        echo 'active';
                    } ?>">CONTACT US</button>
                    </a>
                  </div>
                </li>
              </ul>
              <?php              
              if(!isset($_SESSION["UserCode"])){ 
              ?>
              <li  class="nav-item m-auto" style="list-style-type: none;">
                <div class="dropdown">
                  <a href="login_otp.php">
                    <button class="dropbtn"><i class="fas fa-lock"></i> LOGIN</button>
                    </a>
                   
                 
                </div>
              </li>
              <?php } else  { ?>

                <li  class="nav-item m-auto" style="list-style-type: none;">
                <div class="dropdown">
                  <a href="user-homepage.php">
                    <button class="dropbtn">User Home</button>
                    </a>
                   
                 
                </div>
              </li>
              <?php } ?>
            </div>
          
            
          </div>
          
            <!-- <div class="dropdown">
              <a href="photos.php">
                <button class="dropbtn"><i class="fas fa-lock"></i> LOGIN</button>
              </a>
            </div> -->
          
        </nav>
      </div>
      </div>
    </section>