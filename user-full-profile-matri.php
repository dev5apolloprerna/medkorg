<?php

	//include_once "noentry.php";
	include_once "admin/connection/conn.php";
	$imgdir1 = "admin/images/vastipatrak/thumb/";
	
	// Get details of main member
	$sql_mainmem = "select 
					v.*, 
					v1.addr1 as paraddr1, v1.addr2 as paraddr2, v1.addr3 as paraddr3,v1.pincode as parpincode,v1.fname_vc as parfname,v1.lname_vc as parlname,
					v2.lname_vc as mainparlname,v2.addr1 as mainparaddr1, v2.addr2 as mainparaddr2, v2.addr3 as mainparaddr3,v2.pincode as mainparpincode,city2.city_name as mainparcity, state2.state_name as mainparstate,
					bdir.*,
					edu1.education_name as basicqual,edu2.education_name as pgqual,edu3.education_name as docqual,
					m.marital_name,
					city.city_name, state.state_name, city1.city_name as parcity,state1.state_name as parstate,
					jc.city_name as jcity, js.state_name as jstate,
					bc.group_name as b_main_group_name,ind.ind_value as ind_name,
					jobc.group_name as j_group_name, jobind.ind_value as job_ind_name,
					pc.group_name as p_main_group_name,pc1.group_name as p_sub_group_name 
						from vastipatrak_m v
							left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
							left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
							
							left outer join gotra_m g on v.gotra_id = g.gotra_id  
							left outer join village_m vill on v.village_id = vill.village_id
							left outer join marital_m m on v.marital_id = m.marital_id  
							
							left outer join businessdir_m bdir on v.vasti_id = bdir.vasti_id
							
							left outer join bdir_category bc on bdir.bness_cat_id = bc.sub_id
							left outer join industry_m ind on bdir.bness_subcat_id = ind.ind_id
							
							left outer join bdir_category pc on bdir.prof_cat_id = pc.sub_id
							left outer join bdir_category pc1 on bdir.prof_subcat_id = pc1.sub_id
							
							left outer join bdir_category jobc on bdir.job_type = jobc.sub_id
							left outer join industry_m jobind on bdir.job_ind_id = jobind.ind_id

							left outer join city_m city on v.city = city.city_id
							left outer join state_m state on v.state = state.state_id
							
							left outer join city_m city1 on v1.city = city1.city_id
							left outer join state_m state1 on v1.state = state1.state_id
							
							left outer join city_m city2 on v2.city = city2.city_id
							left outer join state_m state2 on v2.state = state2.state_id
							
							left outer join city_m jc on bdir.job_city = jc.city_id
							left outer join state_m js on bdir.job_state = js.state_id
							
							left outer join education_m edu1 on v.basic_qual = edu1.education_id
							left outer join education_m edu2 on v.pg_qual = edu2.education_id
							left outer join education_m edu3 on v.doc_qual = edu3.education_id

							where v.vasti_id=".$_GET['VId'];

	$chk_mainmem = mysqli_query($cn,$sql_mainmem);
	$mainmem = mysqli_fetch_array($chk_mainmem);
	if($mainmem['parent_id']=="0")
	{
		$mname = $mainmem['mname_vc'];	
		$lname = $mainmem['lname_vc'];	
		
		$addr1 = $mainmem['addr1'];	
		$addr2 = $mainmem['addr2'];	
		$addr3 = $mainmem['addr3'];	
		$city = $mainmem['city_name'];
		$state = $mainmem['state_name'];
		$pincode = $mainmem['pincode'];
	}
	else
	{
		$mname = $mainmem['parfname'];
			
		$lname = $mainmem['parlname'];	
		if($lname == "")
		{
			$lname = $mainmem['mainparlname'];
		}
		
		$addr1 = $mainmem['paraddr1'];	
		if($addr1 == "")
		{
			$addr1 = $mainmem['mainparaddr1'];
		}
		
		$addr2 = $mainmem['paraddr2'];	
		if($addr2 == "")
		{
			$addr2 = $mainmem['mainparaddr2'];
		}
		
		$addr3 = $mainmem['paraddr3'];	
		if($addr3 == "")
		{
			$addr3 = $mainmem['mainparaddr3'];
		}
		
		$city = $mainmem['parcity'];
		if($city == "")
		{
			$city = $mainmem['mainparcity'];
		}
		
		$state = $mainmem['parstate'];
		if($state == "")
		{
			$state = $mainmem['mainparstate'];
		}
		
		$pincode = $mainmem['parpincode'];
		if($pincode == "")
		{
			$pincode = $mainmem['mainparpincode'];
		}
		//$edunm = $mainmem['paredunm'];
		//$addr1 = $mainmem['paraddr1']	
	}
	
	if($mainmem['parent_id']!=0)
		$family_id = $mainmem['parent_id'];
	else
		$family_id = $mainmem['vasti_id'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($mainmem['fname_vc']." ".$mname." ".$lname); ?></title>
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
                            <td width="75%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;">FULL PROFILE OF <?php echo($mainmem['fname_vc']." ".$mname." ".$lname); ?></td>
                          <td width="23%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;"><span class="text_user">
						  <?php //if ($_GET["viewmode"] == "bd") {?>
						  <a href="user-familydet.php?vid=<?php echo $family_id; ?>" target="_blank">View Family Details</a>
						  <?php //} ?>
						  </span></td>
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
                                <td width="59%" class="text_user"><?php echo($mainmem['fname_vc']." ".$mname." ".$lname); ?></td>
                              <td width="26%" rowspan="5" align="center" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-top:10px;">
							  	<?php if($mainmem['thumb_image']!=""){ ?>
								<img src="<?php echo $imgdir1.$mainmem['thumb_image']; ?>" width="100" height="101" />
							  	<?php }else{ ?>
								<img src="images/no-user-image.jpg" width="100" height="101" />
								<?php } ?>
							  </td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Address</strong></td>
                                <td class="text_user"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text_user">
                                  <tr>
                                    <td width="83%"><?php echo($addr1); ?></td>
                                  </tr>
                                  <tr>
                                    <td><?php echo($addr2); ?></td>
                                  </tr>
                                  <tr>
                                    <td><?php echo($addr3); ?></td>
                                  </tr>
                                  <tr>
                                    <td><?php echo($city); ?>, <?php echo($state); ?> - <?php echo($pincode); ?></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Marital Status</strong></td>
                                <td class="text_user"><?php echo $mainmem['marital_name']; ?></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Mobile</strong></td>
                                <td class="text_user"><?php echo($mainmem['mobile_home']); ?></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px;"><strong>Email-ID</strong></td>
                                <td class="text_user"><?php echo($mainmem['email']); ?></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Date </td>
                                <td class="text_user">
									<?php 
										if($mainmem['birth_date']!="")
											echo date("d-m-Y", strtotime($mainmem['birth_date'])) . " (". (date('Y') - date('Y', strtotime($mainmem['birth_date'])) ." yrs") . ")"; 
										else
											echo $mainmem['age'];
									 ?>
								</td>
                                <td align="center" valign="top" bgcolor="#FFFFFF" class="text_user" style="padding-top:10px;">&nbsp;</td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td width="15%" height="30" bgcolor="#FFFFFF" class="text_user" style="padding-left:5px; font-weight: bold;">Blood Group</td>
                                <td class="text_user"><?php echo($mainmem['blood_group']); ?></td>
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
                                <td width="100%" height="30" colspan="2" class="text_user" style="padding-left:5px;"><span class="text4_user">Educational Qualifications</span></td>
                              </tr>
                              <tr class="text" >
                                <td colspan="2" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text">
                                <td height="30" colspan="2" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="27" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Basic/ Graduate</strong></td>
                                      <td class="text_user"><span class="sublink"> <?php echo $mainmem['basicqual']; if($mainmem['bq_det']!=""){ echo " (" . $mainmem['bq_det'] . ") "; } ?> </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td width="15%" height="27" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Post Graduate</strong></td>
                                      <td width="85%" class="text_user"><span class="sublink"> <?php echo $mainmem['pgqual']; if($mainmem['pg_det']!=""){ echo " (" . $mainmem['pg_det'] . ") "; } ?> </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Doctrate</strong></td>
                                      <td class="text_user"><span class="sublink"> <?php echo $mainmem['docqual']; if($mainmem['doc_det']!=""){ echo " (" . $mainmem['doc_det'] . ") "; } ?> </span></td>
                                    </tr>
                                </table></td>
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
                                <td width="15%" height="30" bgcolor="#FFFFFF" style="padding-left:10px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Type</strong></td>
                                <td width="85%" class="text_user"><span class="sublink">
                                   <?php 
								  	switch($mainmem['prof_type'])
									{
										case "B":
											$var_disp = "Business";
											break;
										case "P":
											$var_disp = "Profession";
											break;
										case "J":
											$var_disp = "Job";
											break;
										case "H":
											$var_disp = "Housewife";
											break;
										case "S":
											$var_disp = "Student";
											break;
										case "R":
											$var_disp = "Retired";
											break;
										default:
											$var_disp = "Not Available";
											break;	
									}
								  		
										echo ($var_disp); ?>                               
								  </span>
							   </td>
                              </tr>
                              <tr bgcolor="#FFFFFF" class="text" id="trbusiness" style="display:none;">
                                <td height="30" colspan="2" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td width="15%" height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Business Category </strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo $mainmem['b_main_group_name']; ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Industry</strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo $mainmem['ind_name']; ?>                                      </span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" class="text">
                                      <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Business Name </strong></td>
                                      <td colspan="2" class="text_user"><span class="sublink">
                                        <?php echo($mainmem['bness_name']); ?>                                      </span></td>
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
                                    <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Job Type </strong></td>
                                    <td colspan="2" class="text_user"><span class="sublink"> <?php echo $mainmem['j_group_name']; ?> </span></td>
                                  </tr>
                                  <tr bgcolor="#FFFFFF" class="text">
                                    <td height="30" bgcolor="#FFFFFF" style="padding-left:5px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><strong>Industry</strong></td>
                                    <td colspan="2" class="text_user"><span class="sublink"> <?php echo $mainmem['job_ind_name']; ?> </span></td>
                                  </tr>
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
                                      <td class="text_user">
									  	<span class="sublink">
                                        	<?php echo($mainmem['job_mobile']); ?>                                      
										</span>
									  </td>
                                      <td class="text_user">&nbsp;</td>
                                    </tr>
                                </table></td>
                              </tr>
                              <?php
							  	if($mainmem['prof_type']!="H" && $mainmem['prof_type']!="S" && $mainmem['prof_type']!="R" && $mainmem['prof_type']!="U" && $mainmem['prof_type']!="")
								{
								?>
							  <tr bgcolor="#FFFFFF" class="text">
                              <td height="30" bgcolor="#FFFFFF" class="text" style="padding-left:10px; ; font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Address</td>
                              <td height="30" bgcolor="#FFFFFF" style="font-size: 12px; color:#222222; text-decoration: none; line-height: 18px; font-family: Arial, Helvetica, sans-serif;"><table width="90%"  border="0" align="left" cellpadding="0" cellspacing="0" class="text_user">
                                <tr>
                                  <td width="83%"><?php echo($mainmem['job_addr1']); ?></td>
                                </tr>
                                <tr>
                                  <td><?php echo($mainmem['job_addr2']); ?></td>
                                </tr>
                                <tr>
                                  <td><?php echo($mainmem['job_addr3']); ?></td>
                                </tr>
                                <tr>
                                  <td>
								  	<?php
									 if($mainmem['jcity']!="" || $mainmem['jstate']!="" || $mainmem['job_pincode']!="")
									 {
											echo($mainmem['jcity']); ?>, <?php echo($mainmem['jstate']); ?> - <?php echo($mainmem['job_pincode']); 
                                	 } 
									 ?>
									 </td>
								</tr>
								<?php } ?>
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
              <td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://apolloinfotech.com/" target="_blank"> Apollo Infotech</a></td>
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
