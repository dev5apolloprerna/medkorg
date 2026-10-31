<?php
include 'admin/connection/conn.php';
include  "mnu_main.php";
if($_GET['Code']!="")
{
	 $sql_select_job="select j.*,i.ind_value,f.fun_value from search_jobs j,industry_m i,functional_m f where i.ind_id=j.industry_vc and f.fun_id=j.expertise_vc and j.req_no=".$_GET['Code'];
	  $exec_select_job=mysqli_query($cn,$sql_select_job,$cn);
	$rec=mysqli_fetch_assoc($exec_select_job);
}

// Advertisement Query
$sql_advt = "select * from advt_tbl where page_id_int = (select page_id_int from page_m where page_name_vc='cand_apply') order by RAND() limit 1";
$chk_advt = mysqli_query($cn,$sql_advt);
$advt = mysqli_fetch_array($chk_advt);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_0304131211_0) return;
          window.mm_menu_0304131211_0 = new Menu("root",125,30,"Verdana, Arial, Helvetica, sans-serif",12,"#000000","#000000","#E3E9EC","#B3C4CE","left","middle",5,0,100,-5,7,true,true,true,0,false,false);
  mm_menu_0304131211_0.addMenuItem("Overview","location='overview.html#overview'");
  mm_menu_0304131211_0.addMenuItem("Requirement&nbsp;Form","location='requirement.html#requirement'");
   mm_menu_0304131211_0.hideOnMouseOut=true;
   mm_menu_0304131211_0.bgColor='#FFFFFF';
   mm_menu_0304131211_0.menuBorder=0;
   mm_menu_0304131211_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0304131211_0.menuBorderBgColor='#D3D3D3';
  window.mm_menu_0304131508_0 = new Menu("root",120,30,"Verdana, Arial, Helvetica, sans-serif",12,"#000000","#000000","#E3E9EC","#B3C4CE","left","middle",5,0,100,-5,7,true,true,true,0,false,false);
  mm_menu_0304131508_0.addMenuItem("Search&nbsp;Jobs","location='jobs.php'");
  mm_menu_0304131508_0.addMenuItem("Submit&nbsp;Resume","location='cand_apply.php'");
   mm_menu_0304131508_0.hideOnMouseOut=true;
   mm_menu_0304131508_0.bgColor='#FFFFFF';
   mm_menu_0304131508_0.menuBorder=0;
   mm_menu_0304131508_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0304131508_0.menuBorderBgColor='#D3D3D3';

mm_menu_0304131508_0.writeMenus();
} // mmLoadMenus()

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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
//-->
</script>
<script language="JavaScript" src="mm_menu.js"></script>
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
<body bgcolor="#FFFFFF" onLoad="MM_preloadImages('images/link-about-o.gif','images/link-services-o.gif','images/link-ourapproach-o.gif','images/employer-o.gif','images/candidates-o.gif','images/link-home-o.gif')">
<script language="JavaScript1.2">mmLoadMenus();</script>
<script language="JavaScript" type="text/JavaScript"> 
 
/*function doSubmit()
{
	
	if(frm.txtFName.value == "")
	{
		alert("Please enter Name");
		frm.txtFName.focus();
		return false;
	}
	else if(frm.seldd.value == "0")
	{
		alert("Please select Date of Birth");
		frm.seldd.focus();
		return false;
	}
	else if(frm.selmm.value == "0")
	{
		alert("Please select Date of Birth");
		frm.selmm.focus();
		return false;
	}
	else if(frm.selyy.value == "0")
	{
		alert("Please select Date of Birth");
		frm.selyy.focus();
		return false;
	}
	else if(frm.txtQual.value == "")
	{
		alert("Please enter Qualification");
		frm.txtQual.focus();
		return false;
	}
	else if(frm.txtYear.value == "")
	{
		alert("Please enter Experience");
		frm.txtYear.focus();
		return false;
	}
	else if(frm.txtLoc.value == "")
	{
		alert("Please enter Location");
		frm.txtLoc.focus();
		return false;
	}
	else if(frm.txtPhone1.value=="" && frm.txtPhone2.value=="")
	{
		alert("Please enter your contact no");
		frm.txtPhone1.focus();
		return false;
	}
	else if(frm.txtEmail.value == "")
	{
		alert("Please enter Email");
		frm.txtEmail.focus();
		return false;
	}
	else if(frm.txtDesc.value == "")
	{
		alert("Please enter Designation");
		frm.txtDesc.focus();
		return false;
	}
	else if(frm.txtEmp.value == "")
	{
		alert("Please enter Company");
		frm.txtEmp.focus();
		return false;
	}
	else if(frm.txtSal.value == "")
	{
		alert("Please enter salary");
		frm.txtSal.focus();
		return false;
	}
	else
	{
		frm.txtMode.value = "S";
		frm.submit();
	}	
}*/
//-->
</script>

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
            <td><table width="475" border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td colspan="2"><?php include "advt_incl.php"; ?></td>
                </tr>
                <tr>
                  <td height="7"></td>
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
        <td align="center" valign="top"><table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" align="center" valign="top" background="images/left_panel_middle.jpg" style="background-repeat:repeat-y; background-position:right"><table width="24" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="30" height="18" align="center" valign="top" background="images/left_panel_top.jpg" style="background-repeat:repeat-x; background-position:top">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td height="28" align="center" valign="top">&nbsp;</td>
              </tr>
            </table></td>
            <td width="949" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x; background-position:top;"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="29" align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr bgcolor="#f2f2f2">
                        <td width="2%" height="30" bgcolor="#F8F8F8">&nbsp;</td>
                        <td height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="title">Vacancy Apply </td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="text"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="2%">&nbsp;</td>
                        <td width="98%" valign="top"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            
                            
                            <tr>
                              <td width="837" height="10"></td>
                            </tr>
                            <tr>
                              <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="10"></td>
                                  </tr>
                                  <tr>
                                    <td width="837" align="right" valign="top"><form action="inquiry_submit.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
                                        <input type="hidden" name="page" value="career" />
                                        <input type="hidden" name="designation" value="<?php echo $_GET['desig']; ?>" />
                                        <script language="JavaScript" type="text/javascript">
<!--
					function emailcheck(emailStr) 
							{
							// checks if the e-mail address is valid
							var emailPat=/^(.+)@(.+)$/;
							var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]";
							var validChars="\[^\\s" + specialChars + "\]";
							var firstChars=validChars;
							var quotedUser="(\"[^\"]*\")";
							var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
							var atom="(" + firstChars + validChars + "*" + ")";
							var word="(" + atom + "|" + quotedUser + ")";
							var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
							var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
							
							if (emailStr=="") {
								alert("Email address can't be null");
								return (0);
									}
							var matchArray=emailStr.match(emailPat);
							if (matchArray==null) {  
								alert("Email address seems incorrect (check @ and .'s)");
								return (0);
								}
							var user=matchArray[1];
							var domain=matchArray[2];
							// See if "user" is valid 
							if (user.match(userPat)==null) {
								// user is not valid
								alert("The username doesn't seem to be valid.");
								return (0);
							}
							var IPArray=domain.match(ipDomainPat);
							if (IPArray!=null) {
								// this is an IP address
								  for (var i=1;i<=4;i++) {
									if (IPArray[i]>255) {
										alert("Destination IP address is invalid!");
									return (0);
									}
								}
								return true;
							}
							
							// Domain is symbolic name
							var domainArray=domain.match(domainPat);
							if (domainArray==null) {
								alert("The domain name doesn't seem to be valid.");
								return (0);
							}
							
							var atomPat=new RegExp(atom,"g");
							var domArr=domain.match(atomPat);
							var len=domArr.length;
							if (domArr[domArr.length-1].length<2 || 
								domArr[domArr.length-1].length>3) {
							   // the address must end in a two letter or three letter word.
							   alert("The address must end in a three-letter domain, or two letter country.");
							   return (0);
							}
							
							if (domArr[domArr.length-1].length==3 && len<2) {
							   var errStr="This address is missing a hostname!";
							   alert(errStr);
							   return (0);
							}
							return (1);
							}
							//---------------------Validate Function
							function NameCheck(a,validchar)
							{
								for (var i=0; i < a.length; i++)
								{
									var letter = a.charAt(i).toLowerCase();
									if(validchar.indexOf(letter) != -1)
									continue;
									return false;
								}
								return true;
							}
							//-------------------------TRIM FUNCTION
							function leftTrim(sString)
							{
								while (sString.substring(0,1) == ' ')
								{
									sString = sString.substring(1, sString.length);
								}
								return sString;
							}
							
					function doSubmit()
					{
						if (frm.txtname.value == "")
						{
							alert("Please enter Name");
							frm.txtname.focus();
							return false;
						}
						if(NameCheck(frm.txtname.value,'abcdefghijklmnopqrstuvwxyz ')==false)
						{
							alert("Please enter valid Name");
							frm.txtname.focus();
							return false;
						}
						
						if(leftTrim(frm.txtname.value)!=frm.txtname.value)
						{
							alert("Please enter valid Name");
							frm.txtname.value = "";
							frm.txtname.focus();
							return false;
						}
						if (frm.txtbdate.value == "")
						{
							alert("Please enter Birth Date");
							frm.txtbdate.focus();
							return false;
						}
						
						if (frm.txtploc.value == "")
						{
							alert("Please enter Present Location");
							frm.txtploc.focus();
							return false;
						}
						if(NameCheck(frm.txtploc.value,'abcdefghijklmnopqrstuvwxyz ')==false)
						{
							alert("Please enter valid Location");
							frm.txtploc.focus();
							return false;
						}
						
						if(leftTrim(frm.txtploc.value)!=frm.txtploc.value)
						{
							alert("Please enter valid Location");
							frm.txtploc.value = "";
							frm.txtploc.focus();
							return false;
						}
						if(frm.txtmobno.value=="")
						{
							alert("Please enter your mobile no");
							frm.txtmobno.focus();
							return false;
						}
						if (frm.txtemail.value == "")
						{
							alert("Please enter email");
							frm.txtemail.focus();
							return false;
						}
						if(leftTrim(frm.txtemail.value)!=frm.txtemail.value)
						{
							alert("Please enter valid Email");
							frm.txtemail.value = "";
							frm.txtemail.focus();
							return false;
						}
						if(emailcheck(frm.txtemail.value)==0)
						{							
							frm.txtemail.focus(); 
							return false;    
						}
						if (frm.txthqual.value == "")
						{
							alert("Please enter qualification");
							frm.txthqual.focus();
							return false;
						}
						if(leftTrim(frm.txthqual.value)!=frm.txthqual.value)
						{
							alert("Please enter valid qualification");
							frm.txthqual.value = "";
							frm.txthqual.focus();
							return false;
						}
						if(frm.txtexp.value=="")
						{
							alert("Please enter your total experience");
							frm.txtexp.focus();
							return false;
						}
						if (frm.txtpresentemp.value == "")
						{
							alert("Please enter present employer");
							frm.txtpresentemp.focus();
							return false;
						}
						if(leftTrim(frm.txtpresentemp.value)!=frm.txtpresentemp.value)
						{
							alert("Please enter valid Name");
							frm.txtpresentemp.value = "";
							frm.txtpresentemp.focus();
							return false;
						}
						if (frm.txtpresentdesig.value == "")
						{
							alert("Please enter present designation");
							frm.txtpresentdesig.focus();
							return false;
						}
						if(leftTrim(frm.txtpresentdesig.value)!=frm.txtpresentdesig.value)
						{
							alert("Please enter valid designation");
							frm.txtpresentdesig.value = "";
							frm.txtpresentdesig.focus();
							return false;
						}
						if(frm.txtpresentsal.value=="")
						{
							alert("Please enter your present salary");
							frm.txtpresentsal.focus();
							return false;
						}
						if (frm.txtlocpref.value == "")
						{
							alert("Please enter location preference");
							frm.txtlocpref.focus();
							return false;
						}
						if(leftTrim(frm.txtlocpref.value)!=frm.txtlocpref.value)
						{
							alert("Please enter valid preference");
							frm.txtlocpref.value = "";
							frm.txtlocpref.focus();
							return false;
						}
						
						
						else
						{
							return true;
						}
					}
					-->
                              </script>
                                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td colspan="3" valign="top" class="text"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/dots.gif">
                                                <tr>
                                                  <td valign="top"><img src="images/dots.gif" width="2" height="1" /></td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr valign="top">
                                            <td width="20%" height="30" align="right" class="text"><strong>Name<font color="#FF0000">*</font></strong></td>
                                            <td width="3%" height="20" align="center" class="text"><strong>:</strong></td>
                                            <td width="77%" height="20" align="left" class="text"><input name="txtname" type="text" class="txtbox" maxlength="100" tabindex="1"/></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Gender<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input type="radio" name="chkgender" id="chkgender" value="male" tabindex="2" checked="checked" />
                                              Male
                                              <input type="radio" name="chkgender" id="chkgender" value="female" />
                                              Female </td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Date of Birth<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtbdate" type="text" class="txtbox" tabindex="3" maxlength="50" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Present Location<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtploc" type="text" class="txtbox" tabindex="4" maxlength="50" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Residence Number</strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtresino" type="text" class="txtbox" tabindex = "5" maxlength="100" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Mobile Number<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtmobno" type="text" class="txtbox" tabindex = "6" maxlength="100" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Office Number</strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtoffno" type="text" class="txtbox" tabindex="7" maxlength="100"/></td>
                                          </tr>
                                          <tr valign="top">
                                            <td width="20%" height="30" align="right" class="text"><strong>Email Id<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td width="77%" height="20" align="left" class="text"><input name="txtemail" type="text" class="txtbox" tabindex="8" maxlength="50" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Highest Qualification<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txthqual" type="text" class="txtbox" tabindex = "9" maxlength="50" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Total years of experience<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtexp" type="text" class="txtbox" tabindex = "10" maxlength="50" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Present Employer<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtpresentemp" type="text" class="txtbox" tabindex = "11" maxlength="50" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Present Designation<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtpresentdesig" type="text" class="txtbox" tabindex = "12" maxlength="100" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Past Employer</strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtpastemp" type="text" class="txtbox" tabindex = "13" maxlength="100" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Past Designation</strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtpastdesig" type="text" class="txtbox" tabindex = "14" maxlength="100"/></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Present Salary<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtpresentsal" type="text" class="txtbox" tabindex = "15" maxlength="100" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Expected Salary</strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtexpsal" type="text" class="txtbox" tabindex = "16" maxlength="100" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="30" align="right" class="text"><strong>Location Preferences<font color="#FF0000">*</font></strong></td>
                                            <td height="20" align="center" class="text"><strong>:</strong></td>
                                            <td height="20" align="left" class="text"><input name="txtlocpref" type="text" class="txtbox" tabindex = "17" maxlength="100" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="25" align="right" class="text"><strong>Upload your CV </strong></td>
                                            <td height="25" class="text"><div align="center"><strong>:</strong></div></td>
                                            <td colspan="2" align="left"><input name="fileResume" tabindex="18" type="file" class="txtbox" /></td>
                                          </tr>
                                          <tr valign="top">
                                            <td height="20" colspan="3" class="text"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                <tr valign="top">
                                                  <td width="48%">&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <td width="48%">&nbsp;</td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr valign="top">
                                            <td class="text">&nbsp;</td>
                                            <td class="text">&nbsp;</td>
                                            <td align="left" class="text"><input type="submit" onclick="return doSubmit();" tabindex = "19" name="Submit2" value="Submit" style="cursor:pointer;" />
                                                <input type="reset" name="reset2" tabindex="20" value="Reset" style="cursor:pointer;" /></td>
                                          </tr>
                                        </table>
                                      <strong><br />
                                        </strong>
                                    </form></td>
                                  </tr>
                                  <tr>
                                    <td height="10"></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      
                      
                    </table></td>
                  </tr>
                  
                  
                </table></td>
              </tr>

            </table></td>
            <td width="24" align="right" valign="top" background="images/right_panel_middle.jpg"><table width="24" border="0" cellspacing="0" cellpadding="0" style="background-repeat:repeat-y;">
              <tr><td width="24" align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-repeat:repeat-y;">
              <tr>
                <td height="27" align="center" valign="top" background="images/right_panel_top.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" valign="top">&nbsp;</td>
              </tr>
            </table>              
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr></tr>
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
