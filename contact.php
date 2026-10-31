<?php
include_once "header.php";
?>
 <style>

body{
  background-color: #457B9D;
}
 
.contact-info {
display: inline-block;
width: 100%;
text-align: center;
margin-bottom: 10px;
}
.contact-info-icon {
margin-bottom: 15px;
}
.contact-info-item {
/* background: #3c1616; */
background-color: #1D3557;
padding: 30px 0px;
}
.contact-page-sec .contact-page-form h2 {
color: #ffffff;
text-transform: uppercase;
font-size: 26px;
font-weight: 700;
}
.contact-page-form .col-md-6.col-sm-6.col-xs-12 {
padding-left: 0;
}  
.contact-page-form.contact-form input {
margin-bottom: 5px;
}  
.contact-page-form.contact-form textarea {
height: 110px;
}
.contact-page-form.contact-form input[type="submit"] {
background: #071c34;
width: 150px;
border-color: #071c34;
}
.contact-info-icon i {
font-size: 48px;
color: #ffffff;
}
.contact-info-text p{margin-bottom:0px;}
.contact-info-text h2 {
color: #fff;
font-size: 22px;
text-transform: capitalize;
font-weight: 600;
margin-bottom: 10px;
}
.contact-info-text span {
color: #ffffff;
font-size: 16px;
display: inline-block;
width: 100%;
}

.contact-page-form input {
background: #f9f9f9 none repeat scroll 0 0;
/* border: 1px solid #1D3557; */
margin-bottom: 20px;
padding: 12px 16px;
width: 97%;
border-radius: 4px;
/* /* border: 1px solid #1D3557; */
}

.contact-page-form .message-input {
display: inline-block;
width: 98.5%;
padding-left: 0;
border-radius: 4px;
border: 1px solid #D1ACA5;
}
.single-input-field textarea {
background: #f9f9f9 none repeat scroll 0 0;
border: 1px solid #f9f9f9;
width: 100%;
height: 120px;
padding: 12px 16px;
border-radius: 4px;
}
.single-input-fieldsbtn input[type="submit"] {
background: #D1ACA5 none repeat scroll 0 0;
color: #fff;
display: inline-block;
font-weight: 600;
padding: 10px 0;
text-transform: capitalize;
width: 150px;
margin-top: 20px;
font-size: 16px;
}
.single-input-fieldsbtn input[type="submit"]:hover{background:#3c1616;transition: all 0.4s ease-in-out 0s;border-color:#071c34}
.single-input-field  h4 {
color: #464646;
text-transform: capitalize;
font-size: 14px;
}
.contact-page-form {
display: inline-block;
width: 100%;
margin-top: 30px;
}

.contact-page-map {
margin-top: 36px;
}
.contact-page-form form {
padding: 20px 15px 0;
}
</style>

<section class="contact-page-sec mt-4">
        <div class="container">
         
          <div class="row">
            <div class="col-md-12">
              <div class="contact-page-form" method="post">
                <h2>Get in Touch</h2> 
                <form action="contact-mail.php" method="post">
                  <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="single-input-field">
                      <input type="text" placeholder="Your Name" name="name"/>
                    </div>
                  </div>  
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="single-input-field">
                      <input type="email" placeholder="E-mail" name="email" required/>
                    </div>
                  </div>                              
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="single-input-field">
                      <input type="text" placeholder="Phone Number" name="phone"/>
                    </div>
                  </div>  
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="single-input-field">
                      <input type="text" placeholder="Subject" name="subject"/>
                    </div>
                  </div>                
                  <div class="col-md-12 message-input" style="border: 1px #1D3557 ;">
                    <div class="single-input-field">
                      <textarea style="border: 1px #1D3557 ;"  placeholder="Write Your Message/Give your Feedback" name="message"></textarea>
                    </div>
                  </div>                                                
                  <div class="mt-2">
                    <a href="#" class="submit-btn"><button>SUBMIT</button></a>
                  </div>                          
                </div>
                </form>   
              </div>      
            </div>
              
          </div>
        </div>
      </section>
     <?php
     include_once "footer.php";
     ?>