<?php

	include_once "noentry.php";
	include_once "admin/connection/conn.php";

	// Query for Vasti Patrak Data //
	$where = " and ";
	$cond = "";
	if($_POST)
	{
		// Search By Professional Details //
		
		if($_POST['village_id']!="")
		{
			$cond = $where . "vasti.village_id=".$_POST['village_id'];
		}	
		if($_POST['gotra_id']!="")
		{
			$cond .= $where . "vasti.gotra_id=".$_POST['gotra_id'];
		}	
		if($_POST['fname_vc']!="")
		{
			$cond .= $where . "vasti.fname_vc='".$_POST['fname_vc']."'";
		}	
		if($_POST['lname_vc']!="")
		{
			$cond .= $where . "vasti.lname_vc='".$_POST['lname_vc']."'";
		}	
		if($_POST['email']!="")
		{
			$cond .= $where . "vasti.email='".$_POST['email']."'";
		}	
		if($_POST['blood_group']!="")
		{
			$cond .= $where . "vasti.blood_group='".$_POST['blood_group']."'";
		}	
		if($_POST['location']!="")
		{
			$cond .= $where . "(vasti.city like '%".$_POST['location']."%' or vasti.state like '%".$_POST['location']."%' or vasti.country like '%".$_POST['location']."%')";
		}
		
		// Search By Professional Details //
		
		if($_POST['location']!="")
		{
			$cond .= $where . "businessdir_m.prof_type like '%".$_POST['prof_type']."%'";
		}
		// Business //
		if($_POST['bness_cat_id']!="")
		{
			$cond .= $where . "businessdir_m.bness_cat_id = '".$_POST['bness_cat_id']."'";
		}
		if($_POST['bness_subcat_id']!="")
		{
			$cond .= $where . "businessdir_m.bness_subcat_id = '".$_POST['bness_subcat_id']."'";
		}
		if($_POST['bness_name']!="")
		{
			$cond .= $where . "businessdir_m.bness_name = '".$_POST['bness_name']."'";
		}
		// Profession //
		if($_POST['prof_cat_id']!="")
		{
			$cond .= $where . "businessdir_m.prof_cat_id = '".$_POST['prof_cat_id']."'";
		}
		if($_POST['prof_subcat_id']!="")
		{
			$cond .= $where . "businessdir_m.prof_subcat_id = '".$_POST['prof_subcat_id']."'";
		}
		// Business //
		if($_POST['comp_name']!="")
		{
			$cond .= $where . "businessdir_m.comp_name = '".$_POST['comp_name']."'";
		}


		$sql_vastipatrak = "select vasti.*,v.village_name,m.marital_name from vastipatrak_m vasti
							left outer join village_m v on vasti.village_id = v.village_id
							left outer join marital_m m on vasti.marital_id = m.marital_id 
							left outer join businessdir_m bdir on vasti.vasti_id = bdir.vasti_id
							where vasti.parent_id=0 $cond";
		$chk_vastipatrak = mysqli_query($cn,$sql_vastipatrak);
	}
	
	
	
	// Advertisement Query
	$sql_advt = "select * from advt_tbl where page_id_int = (select page_id_int from page_m where page_name_vc='feedback') order by RAND() limit 1";
	$chk_advt = mysqli_query($cn,$sql_advt);
	$advt = mysqli_fetch_array($chk_advt);
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
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
            <td width="10%" align="center" valign="middle" class="menu"><a href="aboutus.php">About Us</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="12%" align="center" valign="middle" class="menu"><a href="vasti_patrak.php">Vasti Patrak</a> </td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="15%" align="center" valign="middle" class="menu"><a href="other_organisation.php">Other Organisations</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="12%" align="center" valign="middle" class="menu"><a href="photo_gallery.php">Photo Gallery</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="12%" align="center" valign="middle" class="menu"><a href="comm_details.php">Committee</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="11%" align="center" valign="middle" class="menu"><a href="feedback.php"><strong>Feedback</strong></a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="9%" align="center" valign="middle" class="menu"><a href="contact.php">Contact</a></td>
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
                    <td height="20" align="right" class="text3" style="padding:0px 5px 5px 0px">Welcome <?php echo $_SESSION['Fname'] . " " .$_SESSION['Lname']; ?></td>
                  </tr>
                  <tr>
                    <td align="center" class="border1" style="padding:10px 10px 10px 10px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="22%" rowspan="3" valign="top" bgcolor="#f2f2f2" style="padding:8px 8px 8px 8px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="15%" align="center" bgcolor="#f8f8f8"><img src="images/bullet.gif" width="5" height="5" /></td>
                            <td width="85%" height="25" align="left" bgcolor="#f8f8f8"><a href="user-homepage.php" class="text3">User Page </a></td>
                          </tr>
                          <tr>
                            <td height="5" colspan="2" align="center" background="images/dotline.jpg" style="background-repeat:repeat-x; background-position:center"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#f8f8f8"><img src="images/bullet.gif" width="5" height="5" /></td>
                            <td width="85%" height="25" align="left" bgcolor="#f8f8f8"><a href="user-familydet.php?HCode=<?php echo $_SESSION['VastiId']; ?>&amp;level=2" class="text3">Family Details </a></td>
                          </tr>
                          <?php
						  if($_SESSION['status'] != "2")
						  {
						  ?>
                          <tr>
                            <td height="5" colspan="2" align="center" background="images/dotline.jpg" style="background-repeat:repeat-x; background-position:center"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#f8f8f8"><img src="images/bullet.gif" width="5" height="5" /></td>
                            <td height="25" align="left" bgcolor="#f8f8f8"><a href="user-vastipatrak-search.php" class="text4">Vasti Patrak </a></td>
                          </tr>
                          <?php } ?>
                          <tr>
                            <td height="5" colspan="2" align="center" background="images/dotline.jpg" style="background-repeat:repeat-x; background-position:center"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#f8f8f8"><img src="images/bullet.gif" width="5" height="5" /></td>
                            <td width="85%" height="25" align="left" bgcolor="#f8f8f8"><a href="user-changepswd.php?Mode=E" class="text3">Change Password</a></td>
                          </tr>
                          <tr>
                            <td height="5" colspan="2" align="center" background="images/dotline.jpg" style="background-repeat:repeat-x; background-position:center"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#f8f8f8"><img src="images/bullet.gif" width="5" height="5" /></td>
                            <td width="85%" height="25" align="left" bgcolor="#f8f8f8"><a href="logout.php" class="text3">Logout</a></td>
                          </tr>
                          <tr>
                            <td height="5" colspan="2" align="center" background="images/dotline.jpg" style="background-repeat:repeat-x; background-position:center"></td>
                          </tr>
                        </table></td>
                        <td height="25" align="left" bgcolor="#f8f8f8" class="text4" style="padding-left:8px; font-size: 14px;">Vasti Patrak  Result Page </td>
                      </tr>
                      <tr>
                        <td valign="top" style="padding:0px 0px 10px 10px">
						 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left">&nbsp;</td>
						  </tr>
						 </table>
						</td>
                      </tr>
                      <tr>
                        <td width="78%" valign="top" style="padding:0px 0px 10px 10px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="4%" height="25" bgcolor="#3094BF" class="footer" style="padding-left:8px"><strong>No.</strong></td>
                            <td width="19%" bgcolor="#3094BF" class="footer" style="padding-left:8px; border-left:1px #FFFFFF solid"><strong>Full Name </strong></td>
                            <td width="11%" bgcolor="#3094BF" class="footer" style="padding-left:8px; border-left:1px #FFFFFF solid"><strong>Native Place </strong></td>
                            <td width="12%" bgcolor="#3094BF" class="footer" style="padding-left:8px; border-left:1px #FFFFFF solid"><strong>Relation with HOF </strong></td>
                            <td width="9%" bgcolor="#3094BF" class="footer" style="padding-left:8px; border-left:1px #FFFFFF solid"><strong>DOB / Age </strong></td>
                            <td width="9%" bgcolor="#3094BF" class="footer" style="padding-left:8px; border-left:1px #FFFFFF solid; font-weight: bold;">Marital Status </td>
                            <td width="9%" bgcolor="#3094BF" class="footer" style="padding-left:8px; border-left:1px #FFFFFF solid"><strong>Education</strong></td>
                            <td width="7%" bgcolor="#3094BF" class="footer" style="padding-left:8px; border-left:1px #FFFFFF solid"><strong>Mangal</strong></td>
                            <td width="10%" bgcolor="#3094BF" class="footer" style="padding-left:8px; border-left:1px #FFFFFF solid"><strong>Resi. Address</strong></td>
                            <td width="10%" bgcolor="#3094BF" class="footer" style="padding-left:8px; border-left:1px #FFFFFF solid"><strong>Business Details </strong></td>
                          </tr>
                          <?php 
								$ctr=1;
								while($dt_vastipatrak = mysqli_fetch_array($chk_vastipatrak))
								{
 									// Query to get sub-members //
									$sql_mem = "select v.*,m.marital_name,r.relation_name from vastipatrak_m v
													 left outer join marital_m m on v.marital_id = m.marital_id
													 left outer join relation_m r on v.relation_id = r.relation_id  
													 where v.parent_id=".$dt_vastipatrak['vasti_id']." order by v.vasti_id";
									$chk_mem = mysqli_query($cn,$sql_mem);
									
						   ?>
						  <tr>
                            <td height="25" colspan="10" align="left" class="footer" style="padding-left:8px; border-left:1px #f2f2f2 solid;">
							<table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
                              <?php
							  	if($ctr==1 || $ctr%2!=0)
								{
							   ?>
							  <tr>
                                <td width="3%" height="30" align="center" valign="top" class="text"><?php echo $ctr; ?>.</td>
                                <td width="19%" valign="top" class="text3" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo $dt_vastipatrak['fname_vc'] . " " . $dt_vastipatrak['mname_vc'] . " " . $dt_vastipatrak['lname_vc']; ?></td>
                                <td width="11%" valign="top" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo $dt_vastipatrak['village_name']; ?>&nbsp;</td>
                                <td width="12%" valign="top" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo "Own Self"; ?>&nbsp;</td>
                                <td width="9%" valign="top" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo date('d-m-Y',strtotime($dt_vastipatrak['birth_date'])); ?>&nbsp;</td>
                                <td width="9%" valign="top" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo $dt_vastipatrak['marital_name']; ?>&nbsp;</td>
                                <td width="9%" valign="top" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo $dt_vastipatrak['edu_basic'] . " " . $dt_vastipatrak['edu_sub']; ?>&nbsp; </td>
                                <td width="8%" valign="top" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo "No"; ?>&nbsp;</td>
                                <td width="10%" valign="top" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo $dt_vastipatrak['addr1']."<br>".$dt_vastipatrak['addr2']."<br>".$dt_vastipatrak['addr3']."<br>".$dt_vastipatrak['city'].", ".$dt_vastipatrak['state']."<br>".$dt_vastipatrak['country']; ?>&nbsp;</td>
                                <td width="10%" valign="top" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px">&nbsp;</td>
                              </tr>
							  <?php
							  	while($submem1 = mysqli_fetch_array($chk_mem))
								{
							   ?>
                              <tr>
                                <td width="3%" height="30" align="center" valign="top" class="text">*</td>
                                <td width="19%" valign="top" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><strong><?php echo $submem1['fname_vc'] . " " . $submem1['mname_vc'] . " " . $submem1['lname_vc']; ?></strong></td>
                                <td width="11%" valign="top" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;">&nbsp;</td>
                                <td width="12%" valign="top" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;"><?php echo $submem1['relation_name']; ?>&nbsp;</td>
                                <td width="9%" valign="top" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;"><?php echo date('d-m-Y',strtotime($submem1['birth_date'])); ?>&nbsp;</td>
                                <td width="9%" valign="top" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;"><?php echo $submem1['marital_name']; ?>&nbsp;</td>
                                <td width="9%" valign="top" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;"><?php echo $submem1['edu_basic'] . " " . $submem1['edu_sub']; ?>&nbsp; </td>
                                <td width="8%" valign="top" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;"><?php echo "No"; ?>&nbsp;</td>
                                <td width="10%" valign="top" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;">&nbsp;</td>
                                <td width="10%" valign="top" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;">&nbsp;</td>
                              </tr>
							  <?php } } ?>
                             <?php
							  	if($ctr%2==0)
								{
							   ?>
							  <tr>
                                <td width="3%" bgcolor="#f8f8f8" height="30" align="center" valign="top" class="text"><?php echo $ctr; ?>.</td>
                                <td width="19%" bgcolor="#f8f8f8" valign="top" class="text3" style=" border-left:1px #ffffff solid; padding-left:8px"><?php echo $dt_vastipatrak['fname_vc'] . " " . $dt_vastipatrak['mname_vc'] . " " . $dt_vastipatrak['lname_vc']; ?></td>
                                <td width="11%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo $dt_vastipatrak['village_name']; ?></td>
                                <td width="12%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo "Own Self"; ?></td>
                                <td width="9%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo date('d-m-Y',strtotime($dt_vastipatrak['birth_date'])); ?></td>
                                <td width="9%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo $dt_vastipatrak['marital_name']; ?></td>
                                <td width="9%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo $dt_vastipatrak['edu_basic'] . " " . $dt_vastipatrak['edu_sub']; ?> </td>
                                <td width="8%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo "No"; ?></td>
                                <td width="10%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><?php echo $dt_vastipatrak['addr1']."<br>".$dt_vastipatrak['addr2']."<br>".$dt_vastipatrak['addr3']."<br>".$dt_vastipatrak['city'].", ".$dt_vastipatrak['state']."<br>".$dt_vastipatrak['country']; ?></td>
                                <td width="10%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px">&nbsp;</td>
                              </tr>
							  <?php
							  	while($submem2 = mysqli_fetch_array($chk_mem))
								{
							   ?>
                              <tr>
                                <td width="3%" bgcolor="#f8f8f8" height="30" align="center" valign="top" class="text">*</td>
                                <td width="19%" bgcolor="#f8f8f8" valign="top" class="text" style=" border-left:1px #ffffff solid; padding-left:8px"><strong><?php echo $submem2['fname_vc'] . " " . $submem2['mname_vc'] . " " . $submem2['lname_vc']; ?></strong></td>
                                <td width="11%" valign="top" bgcolor="#f8f8f8" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;">&nbsp;</td>
                                <td width="12%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><strong><?php echo $submem2['relation_name']; ?></strong></td>
                                <td width="9%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><strong><?php echo date('d-m-Y',strtotime($submem2['birth_date'])); ?></strong></td>
                                <td width="9%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><strong><?php echo $submem2['marital_name']; ?></strong></td>
                                <td width="9%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><strong><?php echo $submem2['edu_basic'] . " " . $submem2['edu_sub']; ?></strong> </td>
                                <td width="8%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px"><strong><?php echo "No"; ?></strong></td>
                                <td width="10%" valign="top" bgcolor="#f8f8f8" class="text" style=" border-left:1px #f2f2f2 solid; padding-left:8px">&nbsp;</td>
                                <td width="10%" valign="top" bgcolor="#f8f8f8" class="text" style="border-left:1px #f2f2f2 solid; padding-left:8px; font-weight: bold;">&nbsp;</td>
                              </tr>
							  <?php } } ?>
							  <tr>
                                <td colspan="10" align="center" valign="top" class="text">&nbsp;</td>
                              </tr>
                            </table>
										</td>
                            </tr><?php $ctr++; } ?>	
                        </table></td>
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
            <td align="left" valign="middle" class="footer">All Rights Reserved By : Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti</td>
            <td align="right" valign="middle" class="footer">Website Designed By :<a href="https://apolloinfotech.com/" target="_blank"> Apollo Infotech</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="top">&nbsp;</td>
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
