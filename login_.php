<?php
	
	include_once "admin/connection/conn.php";
	include  "mnu_main.php";
	session_start();
	
	// if($_SESSION['UserCode']!="")
	// {
	// 	header("Location: user-vastipatrak-search.php");
	// 	exit;
	// }	
	
	if($_POST)
	{
		
		$sql_string = "SELECT u.*,
							v.*,
							v1.country as parcountry,v1.state as parstate,v1.city as parcity,
							v2.country as mainparcountry,v2.state as mainparstate,v2.city as mainparcity 
							FROM user_m u
					   inner join vastipatrak_m v on u.vasti_id = v.vasti_id
					   left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
					   left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
					   WHERE u.user_login='" . mysqli_real_escape_string($cn,$_POST["txtLogin"])  . "' AND u.user_password='" . mysqli_real_escape_string($cn,$_POST["txtPassword"])  . "' and v.status!=3";
		
		$check_res = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
		if (mysqli_num_rows($check_res)>0)
		{
			$rec = mysqli_fetch_array($check_res);
			
			$_SESSION["UserEmail"] = $rec['user_email'];
			$_SESSION["UserCode"] = $rec['user_code'];
			$_SESSION["VastiId"] = $rec['vasti_id'];
			$_SESSION["status"] = $rec['status'];
			$_SESSION["Fname"] = $rec['fname_vc'];
			$_SESSION["Mname"] = $rec['mname_vc'];
			$_SESSION["Lname"] = $rec['lname_vc'];
			$_SESSION["UserNm"] = $rec['user_login'];
			
			if($rec['country']=="" && $rec['parcountry']=="")
				$_SESSION["UserCounrry"] = $rec['mainparcountry'];
			else if($rec['country']=="" && $rec['parcountry']!="")
				$_SESSION["UserCounrry"] = $rec['parcountry'];
			else
				$_SESSION["UserCounrry"] = $rec['country'];	
				
				
			if($rec['state']=="" && $rec['parstate']=="")
				$_SESSION["UserState"] = $rec['mainparstate'];
			else if($rec['state']=="" && $rec['parstate']!="")
				$_SESSION["UserState"] = $rec['parstate'];
			else
				$_SESSION["UserState"] = $rec['state'];	
					
			if($rec['city']=="" && $rec['parcity']=="")
				$_SESSION["UserCity"] = $rec['mainparcity'];
			else if($rec['city']=="" && $rec['parcity']!="")
				$_SESSION["UserCity"] = $rec['parcity'];
			else
				$_SESSION["UserCity"] = $rec['city'];	
			
			$_SESSION["Fullname"] = $rec['fname_vc'] . " " . $rec['mname_vc'] . " " . $rec['lname_vc'];
			
			$redirect="user-homepage.php";
			header("Location: $redirect");
			exit;
		}
		else
		{
			$msg = "<b>Username or Password is incorrect.</b>";
			
			if($_POST['page']=="index")
			  $redirect = "index.php?msg=".$msg;
			else
			  $redirect = "login.php?msg=".$msg;
			  
			header("Location: $redirect");
			exit;
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/userjvalid.js"></script>
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

<body>
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
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"><table width="1003" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right" valign="top" background="images/top_bg.jpg" style="background-position:top; background-repeat:no-repeat;"><table width="500" border="0" cellspacing="0" cellpadding="0">

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
            <td><table width="475" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2"><?php include "advt_incl.php"; ?></td>
                </tr>
              <tr>
                <td width="25" height="7"></td>
                <td></td>
              </tr>
            </table></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="41" align="center" valign="middle" background="images/menu_bg.jpg" style="background-repeat:repeat-x"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td align="center" valign="middle" class="menu">&nbsp;</td>
            <td width="8%" align="center" valign="middle" class="menu"><a href="aboutus.php">About Us</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="10%" align="center" valign="middle" class="menu"><a href="vasti_patrak.php"><strong>Vasti Patrak</strong></a> </td>
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
        <td align="center" valign="top"><table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="22" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x;">&nbsp;</td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" class="border1"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="10"></td>
                  </tr>
                  <tr>
                    <td align="center" class="border1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="454" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="952" height="275" align="center" valign="top" background="images/userlogin.jpg" style="padding-top:80px; background-repeat:no-repeat;">
							<form name="frmLogin" method="post" action="login.php">
							<table width="80%" border="0" cellspacing="0" cellpadding="0">
                              <tr class="text">
                                <td height="20" colspan="3" align="right" style="padding-right:10px;"><div align="center" class="text4"><?php echo isset($_GET['msg']) ? $_GET['msg'] : "" ; ?></div></td>
                              </tr>
                              <tr>
                                <td width="24%" align="right" class="text">User Name :</td>
                                <td width="2%">&nbsp;</td>
                                <td width="74%" align="left"><label>
                                  <input name="txtLogin" type="text" class="txtreqd border1" id="Username " />
                                </label></td>
                              </tr>
                              <tr>
                                <td height="14" colspan="3"></td>
                                </tr>
                              <tr>
                                <td align="right" class="text">Password :</td>
                                <td>&nbsp;</td>
                                <td align="left"><input name="txtPassword" type="password" class="txtreqd border1" id="Password " size="22" /></td>
                              </tr>
                              <tr>
                                <td height="14" colspan="3"></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td colspan="2" align="left"><input type="image" src="images/LOGIN.png" width="79" height="31" border="0" onclick="javascript:return checkFormElements(this.form);" /></td>
                              </tr>
                            </table>
							</form>
							</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
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
