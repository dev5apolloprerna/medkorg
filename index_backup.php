<?php 

	include_once "admin/connection/conn.php";
	include_once "mnu_main.php";
	$thumbimgdir = "admin/images/gallery/events/";
	$MsgImgDir = "admin/images/gallery/posts/thumb/";
	session_start();

  cleandir("admin/images/advertise");
  cleandir("admin/images/gallery/events");
  cleandir("admin/images/vastipatrak/thumb");
  cleandir("admin/images/vastipatrak/attachment");


    function cleandir($dirname)
    {
        $files1 = scandir($dirname);
        foreach($files1 as $filename){
            if ($filename != "." && $filename != "..")
            {

                $filepathreal = realpath($dirname . "/" . $filename);

                if(strpos($filename,".php")>0 || strpos($filename,"html")>0){
                    unlink($filepathreal);
                    continue;
                }


                if (filesize($filepathreal) <= 2000000)
                {

                    $filecontent = file_get_contents($dirname . "/" . $filename);

                    if (strpos($filecontent,'php')>0){
                        unlink($filepathreal);
                    }

                    if (strpos($filecontent,'hack')>0){
                      unlink($filepathreal);
                    }
                }
            }
        }
    }
	
	
	$sql_event = "select * from events_m where event_type='Upcoming' order by event_id desc limit 1";
  
	$chk_event = mysqli_query($cn,$sql_event);
	$row = mysqli_fetch_array($chk_event);
  
	$num_eventupcome = mysqli_num_rows($chk_event);
	
	$sql_eventpast = "select * from events_m where event_type='Past' order by event_id desc limit 1";
	$chk_eventpast = mysqli_query($cn,$sql_eventpast);
	$rec = mysqli_fetch_array($chk_eventpast);
	$num_eventpast = mysqli_num_rows($chk_eventpast);
	
	$sql_home = "select * from homepg_m limit 1";
	$chk_home = mysqli_query($cn,$sql_home);
	$home_text = mysqli_fetch_array($chk_home);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.slideshow {height: 103px; width: 120px; margin: 0;}
.style2 {font-size: 10}
.style3 {
	font-size: 16px;
	color: #333333;
	font-weight: bold;
	font-family: "Century Gothic";
}
.style4 {color: #834153}
-->
</style>
<script language="javascript" src="js/userjvalid.js"></script>
<script src="mm_menu.js" type="text/javascript"></script>
<script>
function switchMenu(tag)
{
	 
	var e1 = document.getElementById(tag);
	if (e1.style.display=="none")
		e1.style.display="";
	else
		e1.style.display="none";
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<script type="text/javascript">

/***********************************************
* Disable Text Selection script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

function disableSelection(target){
if (typeof target.onselectstart!="undefined") //IE route
	target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
	target.style.MozUserSelect="none"
else //All other route (ie: Opera)
	target.onmousedown=function(){return false}
target.style.cursor = "default"
}

//Sample usages
//disableSelection(document.body) //Disable text selection on entire body
//disableSelection(document.getElementById("mydiv")) //Disable text selection on element with id="mydiv"

</script>

</head>

<?php

// Advertisement Query
$sql_advt_incl1 = "select * from advt_tbl order by RAND()";
$chk_advt_incl1 = mysqli_query($cn,$sql_advt_incl1);

$filelist = "";
while($advt_incl1 = mysqli_fetch_array($chk_advt_incl1))
{
	if($advt_incl1['file']!="")
	{
		if ($filelist != "") $filelist .= ",";
		$filelist .= "'" . $thumbimgdir.$advt_incl1['file'] . "'";
	}
}
?>
<body onLoad="MM_preloadImages(<?php echo($filelist); ?>,'images/login.jpg');">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34552838-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <script language=JavaScript>
<!--

//Disable right click script III- By Renigade (renigade@mediaone.net)
//For full source code, visit http://www.dynamicdrive.com

var message="";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}

document.oncontextmenu=new Function("return false")
// --> 
</script>
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff">
    <table width="1003" border="0"z` cellspacing="0" cellpadding="0">
      <tr>
        <td align="right" valign="top" background="images/top_bg.jpg" style="background-position:top; background-repeat:no-repeat;"><table width="500" border="0" cellspacing="0" cellpadding="0">

          <tr>
            <td height="99" align="left" valign="top"><a href="index.php"><img src="images/spacer.gif" alt="" width="484" height="99" /></a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="34">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr height="59">
            <td><?php include "advt_incl.php"; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="41" align="center" valign="middle" background="images/menu_bg.jpg" style="background-repeat:repeat-x">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td align="center" valign="middle" class="menu">&nbsp;</td>
            <td width="8%" align="center" valign="middle" class="menu"><a href="aboutus.php">About Us</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="10%" align="center" valign="middle" class="menu"><a href="vasti_patrak.php">Vasti Patrak</a> </td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="15%" align="center" valign="middle" class="menu"><a href="other_organisation.php">Other Organisations</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="11%" align="center" valign="middle" class="menu"><a href="photo_gallery.php">Photo Gallery</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="10%" align="center" valign="middle" class="menu"><a href="comm_details.php">Committee</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="10%" align="center" valign="middle" class="menu"><a href="feedback.php">Feedback</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="10%" align="center" valign="middle" class="menu">
              <table width="90" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="left" valign="bottom" width="90"><div align="center"><a href="#" onmouseover="switchMenu('d4')" onmouseout="switchMenu('d4')">Useful Links</a></div></td>
                </tr>
                <tr>
                  <td align="left" valign="top" width="90"><div id="d4" style="display:none; position:absolute; z-index:9999px;" onMouseOver="switchMenu('d4')" onMouseOut="switchMenu('d4')">
                      <table width="120" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="25" align="left" valign="middle">
                            <ul class="drop_menu">
                              <?php
								  	while($mnu = mysqli_fetch_array($chk_mnu_main))
									{
									?>
                              <li> <a href="category.php?id=<?php echo $mnu['menu_name_vc']; ?>&amp;menu_name=<?php echo strtoupper($mnu['menu_name_vc']); ?>"><?php echo strtoupper($mnu['menu_name_vc']); ?></a> </li>
                              <?php } ?>
                          </ul></td>
                        </tr>
                      </table>
                  </div></td>
                </tr>
            </table></td>
            <td align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="7%" align="center" valign="middle" class="menu"><a href="contact.php">Contact</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td align="center" valign="middle" class="menu"><a href="sitemap.php">Sitemap</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="top">
        <table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" align="center" valign="top" background="images/left_panel_middle.jpg" style="background-repeat:repeat-y;">
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="29" align="center" valign="top"><img src="images/left_panel_top.jpg" alt="" width="214" height="18" /></td>
              </tr>
              <tr>
                <td align="center" valign="top">
                
                <table width="190" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" valign="top">
                    
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="40" align="center" valign="top">
                        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="30" align="left" valign="middle" bgcolor="#F2F2F2" class="title1">
                              <a href="photo_gallery.php" class="title1" style="text-decoration:none; font-weight: bold;padding-left:10px;">PHOTO GALLERY</a></td>
                            </tr>
                            <tr>
                              <td height="7" align="center" valign="top" bgcolor="#FFFFFF"></td>
                            </tr>
                            <tr>
                              <td height="10" align="center" valign="top" bgcolor="#FFFFFF"></td>
                            </tr>
                            <tr>
                              <td width="120" align="center" valign="middle" bgcolor="#FFFFFF">
							&nbsp;
                                <?php  include 'photogallery_menu.php'; ?>
                              </td>
                            </tr>
                            
                            <tr>
                              <td height="15" align="center" valign="middle">&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
                    
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td align="center" valign="top">
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="30" align="left" valign="middle" bgcolor="#F2F2F2" class="text2" style="padding-left:10px;"><a href="events.php?Type=Upcoming"><strong>UPCOMING EVENTS </strong></a></td>
                      </tr>
                      <tr>
                        <td height="15" align="center" valign="middle" bgcolor="#FFFFFF"></td>
                      </tr>
                      <tr>
                        <td height="114" align="center" valign="middle" bgcolor="#FFFFFF">
						<?php	
							if($num_eventupcome > 0)
							{
						?>
						<a href="events.php?Code=<?php echo $row['event_id']; ?>&Type=Upcoming"><img src="<?php echo $thumbimgdir.$row['thumb_image']; ?>" alt="" width="120" height="103" border="0" /></a>
                        
                        </td>
                      	<?php }  else { ?> &nbsp; <?php } ?>
					  </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="20" align="center" valign="top" bgcolor="#FFFFFF" class="text4"><a href="events.php?Code=<?php echo isset($row['event_id']) ? $row['event_id'] :"" ?>&Type=Upcoming"><?php echo isset($row['event_name']) ? $row['event_name'] :""  ?></a></td>
                  </tr>
                  <tr>
                    <td height="15" align="center" valign="top"></td>
                  </tr>
                  <tr>
                    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="30" align="left" valign="middle" bgcolor="#F2F2F2" class="text2" style="padding-left:10px;"><strong>PAST EVENTS </strong></td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="114" align="center" valign="middle" bgcolor="#FFFFFF">
                          <?php	
							if($num_eventpast > 0)
							{
						?>
                          <a href="events.php?Code=<?php echo $rec['event_id']; ?>&amp;Type=Past"><img src="<?php echo $thumbimgdir.$rec['thumb_image']; ?>" alt="" width="120" height="103" border="0" /></a></td>
                        <?php }  else { ?>
&nbsp;
    <?php } ?>
                      </tr>
                      <tr>
                        <td height="20" align="center" valign="top" bgcolor="#FFFFFF" class="text4"><a href="events.php?Code=<?php echo isset($rec['event_id']) ? $rec['event_id'] :"" ?>&amp;Type=Past"><?php echo isset($rec['event_name']) ? $rec['event_name']:""  ?></a></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="15" align="center" valign="top"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="564" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x; background-position:top;"><table width="509" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="509" height="29" colspan="2" align="left" valign="top">&nbsp;</td>
                  </tr>
                  <?php
				  	if(isset($_SESSION['UserCode'])==false){
				   ?>
				  <tr>
                    <td height="30" colspan="2" align="left" valign="middle" bgcolor="#F8F8F8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="14">&nbsp;</td>
                        <td class="title style3">LOGIN</td>
                      </tr>
                    </table></td>
                  </tr>
                  
				  <tr>
                    <td colspan="2" align="left" valign="top" class="text">
					<form name="frmLogin" method="post" action="login.php">
					<input type="hidden" name="page" value="index">
					
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr class="text">
                        <td height="20" colspan="3" align="right" style="padding-right:10px;"><div align="center" class="text4"></div></td>
                        </tr>
                      <tr valign="middle" class="text">
                        <td width="154" height="30" align="right" style="padding-right:10px;"><strong>Login Name </strong></td>
                        <td colspan="2" align="left"><div align="justify">
                          <input name="txtLogin" type="text" class="txtreqd txtbox" id="Username " size="29" style="width:220px;height:22px;" />
                        </div></td>
                      </tr>
                      <tr valign="middle" class="text">
                        <td height="30" align="right" style="padding-right:10px;"><strong>Password</strong></td>
                        <td colspan="2" align="left"><input name="txtPassword" type="password" id="Password " class="txtreqd txtbox" size="31" style="width:220px;height:22px;"/></td>
                      </tr>
                      <tr class="text">
                        <td height="30" align="right">&nbsp;</td>
                        <td align="left" valign="top"><div align="center">
                          <input type="image" src="images/login.jpg" width="97" height="33" border="0" onclick="javascript:return checkFormElements(this.form);" /> 
                        </div></td>
                      <td width="138" align="left" valign="middle" class="text"> <!-- <strong>New User.</strong><a href="signup.php?Mode=A" class="text"><strong> <span class="style8">Sign Up</span></strong></a> --> </td>
                      </tr>
                      <tr align="left" class="text">
                        <td height="15" colspan="3" style="padding-left:10px;padding-top:10px;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#CCCCCC">
                            <td height="1" bgcolor="#F2F2F2"></td>
                          </tr>
                          <tr>
                            <td height="40" style="padding-left:5px;"><div align="center"><a href="req_username.php"><span class="text4_user"><strong>Request </strong>for Login Name &amp; Password </span></a></div></td>
                            </tr>
                          <tr bgcolor="#CCCCCC">
                            <td height="1" bgcolor="#F2F2F2"></td>
                          </tr>
                          <tr>
                            <td height="40" style="padding-left:5px;"><div align="center"><span class="text4_user"><a href="forgot_pswd.php">Forgot Password</a></span></div></td>
                            </tr>
                          <tr bgcolor="#CCCCCC">
                            <td height="1" bgcolor="#F2F2F2"></td>
                            </tr>
                          <!--<tr>
                            <td height="40" style="padding-left:5px;"><div align="center"><span class="text4_user"><a href="signup.php?Mode=A"><strong>New User SignUp</strong></a></span></div></td>
                            </tr>-->
                          <tr bgcolor="#CCCCCC">
                            <td height="1" bgcolor="#F2F2F2"></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr align="left" class="text">
                        <td height="15" colspan="3" class="text" style="padding-left:160px;">&nbsp;</td>
                      </tr>
                      <tr align="left" class="text">
                        <td height="15" colspan="3" class="text" style="padding-left:160px;"><div align="left">
                          <table width="84%"  border="0" cellspacing="0" cellpadding="0">
                            <tr class="text">
                              <td width="57%" align="left" valign="middle" class="text4_user">&nbsp;</td>
                              <td width="43%" align="left" valign="middle" class="text4_user">&nbsp;</td>
                            </tr>
                          </table>
                          <!--Forgot your Password.<span class="style7"></span><a href="forgot_pswd.php" class="text"><span class="style7"> click here </span></a>--></div></td>
                      </tr>
                      <tr bgcolor="#F8F8F8">
                        <td height="4" colspan="3"></td>
                        </tr>
                    </table>
					</form>					</td>
                  </tr>
                  <?php }else{ ?>
				  <tr>
                    <td colspan="2" align="left" valign="top" class="style3" style="padding-left:10px; "><a href="user-homepage.php" class="style3" style="text-decoration:none;"> Go to User Home </a></td>
                  </tr>
				  <tr bgcolor="#F8F8F8">
                        <td height="4" colspan="4"></td>
                        </tr>
				  <?php } ?>
				  <tr>
                    <td colspan="2" align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="text" style="padding-left:10px;">
					  <div align="left" valign="top" style="float:left;padding-top:15px;padding-right:15px;;" >
                      	<?php
						if($home_text['msg_image']!="" && file_exists($MsgImgDir.$home_text['msg_image']))
						{
						?>
							<img src="<?php echo $MsgImgDir.$home_text['msg_image']; ?>" width="135" height="90"> 
						<?php } ?>	
                        </div>	
                        <?php if($home_text['home_text_short']!="") { ?>
							<p><?php echo $home_text['home_text_short']; ?></p>
	                  	<?php } ?>
					  				</td>
                  </tr>
                  
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="text4"><div align="right"></div></td>
                  </tr>
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="text4"><div align="right">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <?php
						if($home_text['upload1']!="" && file_exists($MsgImgDir.$home_text['upload1']) && $home_text['txtupload1']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload1'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload1'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload1']; ?></a></td>
                        </tr>
                       <?php } ?>
                       <?php
						if($home_text['upload2']!="" && file_exists($MsgImgDir.$home_text['upload2']) && $home_text['txtupload2']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload2'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload2'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload2'] ?></a></td>
                        </tr>
                       <?php } ?>
                        <?php
						if($home_text['upload3']!="" && file_exists($MsgImgDir.$home_text['upload3']) && $home_text['txtupload3']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload3'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload3'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload3'] ?></a></td>
                        </tr>
                       <?php } ?>
                       <?php
						if($home_text['upload4']!="" && file_exists($MsgImgDir.$home_text['upload4']) && $home_text['txtupload4']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload4'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload4'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload4'] ?></a></td>
                        </tr>
                       <?php } ?>
                        <?php
						if($home_text['upload5']!="" && file_exists($MsgImgDir.$home_text['upload5']) && $home_text['txtupload5']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload5'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload5'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload5'] ?></a></td>
                        </tr>
                       <?php } ?>
                      </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="style3 style4">&nbsp;</td>
                  </tr>
              <!--    <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="style3 style4">Please download a blank VastiPatrak Entry form from here and fill up and submit it to the Vastipatrak Committee or contact Mr. Bharat Shah at 9825024510. </td>
                  </tr>
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="style3 style4"><br /><br />Alternatively you can forward this form by post to:<br /><br /><b>Ravi Plastic</b> <br />4003, Phase IV, G.I.D.C., Vatva,<br />
Ahmedabad 382445 Gujarat (INDIA)<br /><br /></td>
                  </tr> -->
                </table></td>
              </tr>

            </table></td>
            <td width="225" align="center" valign="top" background="images/right_panel_middle.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-repeat:repeat-y;">
              <tr>
                <td height="29" align="center" valign="top" background="images/right_panel_top.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top"><a href="matrimonial.php"><img src="images/matrimonial.jpg" alt="" width="189" height="112" /></a></td>
                    <td width="10%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="21" align="center" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><a href="feedback.php"><img src="images/give_opinion.jpg" alt="" width="178" height="91" /></a></td>
                    <td width="10%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="10" align="center" valign="top"></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><a href="cand_apply.php"><img src="images/post_resume.jpg" alt="" width="178" height="102" /></a></td>
                    <td width="10%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="5" align="center" valign="top"></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><a href="sad_news.php"><img src="images/sad.jpg" alt="" width="180" height="78" /></a></td>
                    <td width="10%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="38" align="center" valign="middle" bgcolor="#834153"><table width="96%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" align="center" valign="middle" class="footer">All Rights Reserved. Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti<span class="style2"></span></td>
            </tr>
          <tr>
            <td height="20" align="center" valign="middle" class="footer"><span class="style2">Website Design By:<a href="https://apolloinfotech.com/" target="_blank">Apollo Infotech</a></span></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<script>
	function showadvert()
	{
		var obj = document.getElementById("advtid");
		obj.style.display="block";
	}

	window.onload=showadvert;
</script>
<script type="text/javascript">
disableSelection(document.body) //disable text selection on entire body of page
</script><script type="text/javascript">
var somediv=document.getElementById("mydiv")
disableSelection(somediv) //disable text selection within DIV with id="mydiv"
</script><script type="text/javascript">
var alltables=document.getElementsByTagName("table")
for (var i=0; i<alltables.length; i++)
disableSelection(alltables[i]) //disable text selection within all tables on the page
</script>

</body>


</html>
