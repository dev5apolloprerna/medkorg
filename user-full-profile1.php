<?php
	session_start();
	
	include_once "admin/connection/conn.php";
	$imgdir = "admin/images/vastipatrak/thumb/";
	
	// Advertisement Query
	$sql_advt = "select * from advt_tbl where page_id_int = (select page_id_int from page_m where page_name_vc='feedback') order by RAND() limit 1";
	$chk_advt = mysqli_query($cn,$sql_advt);
	$advt = mysqli_fetch_array($chk_advt);
	
	// Get details of main member
	$sql_mainmem = "select v.*,bdir.*,m.marital_name,bc.group_name as b_main_group_name,bc1.group_name as b_sub_group_name,pc.group_name as p_main_group_name,pc1.group_name as p_sub_group_name from vastipatrak_m v
					left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join marital_m m on v.marital_id = m.marital_id  
					left outer join village_m vill on v.village_id = vill.village_id
					left outer join businessdir_m bdir on v.vasti_id = bdir.vasti_id
					left outer join bdir_category bc on bdir.bness_cat_id = bc.sub_id
					left outer join bdir_category bc1 on bc.sub_id = bc1.main_id
					left outer join bdir_category pc on bdir.prof_cat_id = pc.sub_id
					left outer join bdir_category pc1 on pc.sub_id = pc1.main_id
					
					where v.vasti_id=".$_GET['VId'];
	$chk_mainmem = mysqli_query($cn,$sql_mainmem);
	$mainmem = mysqli_fetch_array($chk_mainmem);
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 14px}
.style2 {font-size: 13px}
-->
</style>
<script language="javascript" type="text/javascript">
function showhideDiv(val)
	{
		if(val == "" || val=="U")
		{
			document.getElementById("trbusiness").style.display = "none";
			document.getElementById("trprof").style.display = "none";
			document.getElementById("trjob").style.display = "none";
		}
		if(val == "B")
		{
			document.getElementById("trbusiness").style.display = "";
			document.getElementById("trprof").style.display = "none";
			document.getElementById("trjob").style.display = "none";
		}
		if(val == "P")
		{
			document.getElementById("trbusiness").style.display = "none";
			document.getElementById("trprof").style.display = "";
			document.getElementById("trjob").style.display = "none";
		}
		if(val == "J")
		{
			document.getElementById("trbusiness").style.display = "none";
			document.getElementById("trprof").style.display = "none";
			document.getElementById("trjob").style.display = "";
		}
	}
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
            <td width="10%" align="center" valign="middle" class="menu"><a href="user-homepage.php">User Home </a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="12%" align="center" valign="middle" class="menu"><a href="user-familydet.php"><strong>Family Details </strong></a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="15%" align="center" valign="middle" class="menu"><a href="user-vastipatrak-search.php">Vasti Patrak </a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="12%" align="center" valign="middle" class="menu"><a href="photo_gallery.php">My Directory </a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="14%" align="center" valign="middle" class="menu"><a href="user-changepswd.php">Change Password </a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="9%" align="center" valign="middle" class="menu"><a href="logout.php">Logout</a></td>
            <td width="1" align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle" class="menu">&nbsp;</td>
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
                    <td align="left" class="border1"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#FFFFFF">
                            <td colspan="3">&nbsp;</td>
                            </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="94%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;">FULL PROFILE OF <?php echo($mainmem['fname_vc']." ".$mainmem['mname_vc']." ".$mainmem['lname_vc']); ?></td>
                          <td width="4%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#FFFFFF"><table width="98%"  border="0" cellspacing="0" bgcolor="#fbfbfb">
                              <tr class="text">
                                <td height="30" colspan="3" class="text_user" style="padding-left:5px;"><span class="text4_user">Personal Details </span></td>
                                </tr>
                              <tr class="text" >
                                <td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Name</strong></td>
                                <td width="59%" class="text_user"><?php echo($mainmem['fname_vc']." ".$mainmem['mname_vc']." ".$mainmem['lname_vc']); ?></td>
                              <td width="26%" rowspan="5" align="center" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-top:10px;">
							  	<?php if($mainmem['thumb_image']!=""){ ?>
								<img src="<?php echo $imgdir.$mainmem['thumb_image']; ?>" width="100" height="101" />
							  	<?php }else{ ?>
								<img src="images/no-user-image.jpg" width="100" height="101" />
								<?php } ?>
							  </td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Address</strong></td>
                                <td class="text_user"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text_user">
                                  <tr>
                                    <td width="83%"><?php echo($mainmem['addr1']); ?></td>
                                  </tr>
                                  <tr>
                                    <td><?php echo($mainmem['addr2']); ?></td>
                                  </tr>
                                  <tr>
                                    <td><?php echo($mainmem['addr3']); ?></td>
                                  </tr>
                                  <tr>
                                    <td><?php echo($mainmem['city']); ?>, <?php echo($mainmem['state']); ?> - <?php echo($mainmem['pincode']); ?></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Marital Status</strong></td>
                                <td class="text_user"><?php echo $mainmem['marital_name']; ?></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Mobile</strong></td>
                                <td class="text_user"><?php echo($mainmem['mobile_number']); ?></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Email-ID</strong></td>
                                <td class="text_user"><?php echo($mainmem['email']); ?></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Date </td>
                                <td class="text_user"><?php echo date('d-m-Y',strtotime($mainmem['birth_date'])); ?></td>
                                <td align="center" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-top:10px;">&nbsp;</td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px; font-weight: bold;">Blood Group</td>
                                <td class="text_user"><?php echo($mainmem['blood_group']); ?></td>
                                <td align="center" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-top:10px;">&nbsp;</td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px; font-weight: bold;">Education</td>
                                <td class="text_user"><?php echo($mainmem['edu_cat']); ?>, <?php echo($mainmem['edu_basic']); ?>. (<?php echo($mainmem['edu_sub']); ?>) </td>
                                <td align="center" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-top:10px;">&nbsp;</td>
                              </tr>
                            </table></td>
                            </tr>
                          <tr bgcolor="#f2f2f2">
                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#ffffff">&nbsp;</td>
                          </tr>
                          <tr bgcolor="#f2f2f2">
                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#ffffff"><table width="98%"  border="0" cellspacing="0" bgcolor="#fbfbfb">
                              <tr class="text">
                                <td height="30" colspan="2" class="text_user" style="padding-left:5px;"><span class="text4_user">Professional Details</span></td>
                              </tr>
                              <tr class="text" >
                                <td colspan="2" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Type</strong></td>
                                <td width="85%" class="text_user"><span class="sublink">
                                  <?php echo ($mainmem['prof_type']); ?>                                </span></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text" id="trbusiness" style="display:none;">
                                <td height="30" colspan="2" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td width="15%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Business Category </strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo $mainmem['b_main_group_name']; ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Sub-Category</strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo $mainmem['b_sub_group_name']; ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Business Name </strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo($mainmem['bness_name']); ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Address</strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo($mainmem['bness_addr']); ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Phone No. </strong></td>
                                      <td width="29%" class="text_user"><?php echo($mainmem['bness_phone']); ?></td>
                                      <td width="56%" class="text">&nbsp;</td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Mobile No. </strong></td>
                                      <td class="text_user"><span class="sublink">
                                        <?php echo($mainmem['bness_mobile']); ?>                                      </span></td>
                                      <td class="text">&nbsp;</td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Description</strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo($mainmem['bness_desc']); ?>                                      </span></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text" id="trprof" style="display:none;">
                                <td height="30" colspan="2" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td width="14%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Profession Name </strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo $mainmem['p_main_group_name']; ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Specialization</strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo $mainmem['p_sub_group_name']; ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Office Address </strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo($mainmem['prof_addr']); ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Phone No </strong></td>
                                      <td width="30%" class="text_user"><?php echo($mainmem['prof_phone']); ?></td>
                                      <td width="56%" class="text">&nbsp;</td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Mobile No </strong></td>
                                      <td class="text_user"><span class="sublink">
                                        <?php echo($mainmem['prof_mobile']); ?>                                      </span></td>
                                      <td class="text">&nbsp;</td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Description</strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo($mainmem['prof_desc']); ?>                                      </span></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text" id="trjob" style="display:none;">
                                <td height="30" colspan="2" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td width="14%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Company Name </strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo($mainmem['comp_name']); ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Designation</strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo($mainmem['job_desig']); ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Office Address </strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo($mainmem['job_addr']); ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Phone No. </strong></td>
                                      <td width="29%" class="text_user"><?php echo($mainmem['job_phone']); ?></td>
                                      <td width="57%" class="text_user">&nbsp;</td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Mobile No. </strong></td>
                                      <td class="text_user"><span class="sublink">
                                        <?php echo($mainmem['job_mobile']); ?>                                      </span></td>
                                      <td class="text_user">&nbsp;</td>
                                    </tr>
                                </table></td>
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
              <td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://apolloinfotech.com/" target="_blank">Apollo Infotech</a></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<script language="javascript">
var v = "<?php echo $mainmem['prof_type']; ?>";
showhideDiv(v);
</script>
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
