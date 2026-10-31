<?php

	include_once "noentry.php";
	include_once "connection/conn.php";
	$imgdir = "admin/images/vastipatrak/thumb/";
	
	// Get details of main member
  
	if (isset($_GET['vid'])== "")
	{
		$vasti_id = isset($_SESSION['vastiId']) ? $_SESSION['vastiId'] : "";
	}
	else
	{
		$vasti_id=isset($_GET['vid']) ? $_GET['vid'] : "";
	}
	
 $sql_mainmem = "select v.*,vill.village_name,g.gotra_name, country.call_code_vc as vcallcode, city.std_code_vc, city.city_name, state.state_name from vastipatrak_m v
					left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join village_m vill on vill.village_id = v.village_id
					left outer join marital_m m on v.marital_id = m.marital_id
					left outer join country_m country on v.country = country.country_id
					left outer join state_m state on v.state = state.state_id
					left outer join city_m city on v.city = city.city_id
					where vasti_id=".$vasti_id;

	$chk_mainmem = mysqli_query($cn,$sql_mainmem);
	$mainmem = mysqli_fetch_array($chk_mainmem);
	
	$age = $mainmem['birth_date']!="0000-00-00"?(date('Y') - date('Y', strtotime($mainmem['birth_date'])))." yrs":$mainmem['age']." yrs";
									
	// Get details of all submembers for current main member //
	$sql_submem = "select v.*,r.relation_name,m.marital_name,country.country_name,state.state_name,city.city_name from vastipatrak_m v
				   left outer join relation_m r on v.relation_id = r.relation_id
				   left outer join marital_m m on v.marital_id = m.marital_id
				   left outer join country_m country on v.country = country.country_id
				   left outer join state_m state on v.state = state.state_id
				   left outer join city_m city on v.city = city.city_id
					
				   where v.parent_id=".$vasti_id." order by v.birth_date ASC,v.vasti_id";
	$chk_submem = mysqli_query($cn,$sql_submem);
	
	if(isset($_GET['mode'])=='D')
	{
		$sql_del_rec = "delete from vastipatrak_m where vasti_id=".$_GET['id'];
		$chk_del_rec = mysqli_query($cn,$sql_del_rec);
		
		header("Location: user-familydet.php");
		exit;
	}
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
<script language="javascript">
function doDeleteRec(code)
{
	if(confirm("Are you sure you want to Delete this record?"))
	{
		window.location = 'user-familydet.php?id='+code+'&mode=D';
	}
	else
	{
		return false;
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

/*function disableSelection(target){
if (typeof target.onselectstart!="undefined") //IE route
	target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
	target.style.MozUserSelect="none"
else //All other route (ie: Opera)
	target.onmousedown=function(){return false}
target.style.cursor = "default"
}*/

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
            <td width="9%" align="center" valign="middle" class="menu"><a href="index.php">Home</a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="10%" align="center" valign="middle" class="menu"><a href="user-homepage.php">User Home </a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="12%" align="center" valign="middle" class="menu"><a href="user-familydet.php"><strong>My Family</strong></a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="15%" align="center" valign="middle" class="menu"><a href="user-vastipatrak-search.php">Vasti Patrak </a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="12%" align="center" valign="middle" class="menu"><a href="user-directory-list.php">My Directory </a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="14%" align="center" valign="middle" class="menu"><a href="user-changepswd.php">Change Password </a></td>
            <td width="1" align="center" valign="middle"><img src="images/menu_line.jpg" alt="" width="1" height="12" /></td>
            <td width="9%" align="center" valign="middle" class="menu"><a href="faq.php">Help</a></td>
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
                            <td width="67%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;">FAMILY DETAILS OF <?php echo $mainmem['fname_vc'] ." ".$mainmem['mname_vc'] ." ". $mainmem['lname_vc']; ?> </td>
                          <td width="31%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;"></td>
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
                                <td width="3%" class="text_user"><div align="center"><?php if($mainmem['thumb_image']!=""){ ?> <img src="images/user.png" width="15" height="15"> <?php } ?></div></td>
                                <td width="33%" class="text_user"><span class="text4_user"> <?php echo $mainmem['fname_vc'] ." ".$mainmem['mname_vc'] ." ". $mainmem['lname_vc']; ?> </span></td>
                                <td width="33%" rowspan="4" valign="top" class="text_user"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <?php if($mainmem['addr1']!=""){ ?>
								  <tr bgcolor="#fbfbfb" class="text">
                                    <td class="text_user"><?php echo $mainmem['addr1']; ?> </td>
                                  </tr>
								  <?php } ?>
                                  <?php if($mainmem['addr2']!=""){ ?>
								  <tr bgcolor="#fbfbfb" class="text">
                                    <td class="text_user"><?php echo $mainmem['addr2']; ?></td>
                                  </tr>
                                  <?php } ?>
                                  <?php if($mainmem['addr3']!=""){ ?>
								  <tr bgcolor="#fbfbfb" class="text">
                                    <td class="text_user"><?php echo $mainmem['addr3']; ?></td>
                                  </tr>
                                  <?php } ?>
                                  <?php if($mainmem['city']!="" || $mainmem['state']!="" || $mainmem['pincode']!=""){ ?>
								  <tr bgcolor="#fbfbfb" class="text">
                                    <td class="text_user"><?php echo $mainmem['city_name']; ?>, <?php echo $mainmem['state_name']; ?> <?php if($mainmem['pincode']!=""){ ?>- <?php echo $mainmem['pincode']; ?>. <?php } ?></td>
                                  </tr>
								  <?php } ?>
                                </table></td>
                                <td width="33%" rowspan="8" valign="top" style="padding-top:20px;"><table width="60%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                    <?php
										if(isset($_GET['vid'])==false)
										{
									 ?>
									<tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="signup.php?Code=<?php echo($mainmem['vasti_id']); ?>&Mode=E" target="_self">Modify Record </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <?php } ?> 
									<tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="user-full-profile.php?VId=<?php echo $mainmem['vasti_id']; ?>" target="_blank">View Profile </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>

                                    <?php
										if(isset($_GET['vid'])==false)
										{
									 ?>
									<tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="user-family-move.php?vastiid=<?php echo($mainmem['vasti_id']); ?>&fname=<?php echo $mainmem['fname_vc']; ?>&mname=<?php echo $mainmem['mname_vc']; ?>&lname=<?php echo $mainmem['lname_vc']; ?>&gender=<?php echo $mainmem['gender_c']; ?>&maritalstatus=<?php echo $mainmem['marital_name']; ?>&HOF=1" target="_self">Move</a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <?php } ?> 
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="user-familytree.php?id=<?php echo $mainmem['vasti_id']; ?>" target="_blank">View Family Tree </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <?php
										if(isset($_GET['vid'])==false)
										{
									 ?>
									<tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="signup.php?Mode=A&HCode=<?php echo $mainmem['vasti_id']; ?>">Add Family Members </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><b>Last Updated On: <?php echo date('d-m-Y',strtotime($mainmem['reg_date'])); ?> </b></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
									<?php } ?>
                                </table></td>
                              </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><?php echo $mainmem['gender_c']; ?>, <?php echo $age; ?> </td>
                                </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><?php echo $mainmem['city_name']; ?>.</td>
                                </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><?php echo isset($mainmem['marital_name']) ?></td>
                                </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user">&nbsp;</td>
                              </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><span class="text4_user">Native</span>: <?php echo $mainmem['village_name']; ?></td>
                                <td class="text_user"><span class="text4_user"><strong>M</strong>.</span> 
									<?php 
										$extr = "";
										
										if($mainmem['mobile_home']!="" || $mainmem['alt_mobile']!="")
										{
											if($mainmem['mobile_home']!="")
											{
												if ($mainmem['vcallcode']!="")
													$mobno = $mainmem['vcallcode'] . " " . $mainmem['mobile_home'];
												else
													$mobno = $mainmem['mobile_home'];
												
												$extr = " / ";
											}
											if($mainmem['alt_mobile']!="") 
											{
												if ($mainmem['vcallcode'] !="")
													$mobno .= $extr . $mainmem['vcallcode'] . " " . $mainmem['alt_mobile'];	
												else
													$mobno .= $extr . $mainmem['alt_mobile'];	
											}
										}
										else
											$mobno = "-";
										
										echo $mobno; 
									?></td>
                              </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><span class="text4_user">Gotra</span>: <?php echo $mainmem['gotra_name']; ?></td>
                                <td class="text_user"><span class="text4_user">Ph.</span> 
								<?php 
										$extr = "";
										
										if($mainmem['phone_number']!="" || $mainmem['alt_number']!="")
										{
											if($mainmem['phone_number']!="")
											{
												if($mainmem['vcallcode'] != "" && $mainmem['std_code_vc'] != "")
													$mobno1 = $mainmem['vcallcode'] . " " . $mainmem['std_code_vc'] . " " . $mainmem['phone_number'];
												else if ($mainmem['std_code_vc'] != "")
													$mobno1 = "0" . $mainmem['std_code_vc'] . " " . $mainmem['phone_number'];						
												else
													$mobno1 = $mainmem['phone_number'];
												
												$extr = " / ";
											}
											if($mainmem['alt_number']!="")
											{ 
												if($mainmem['code_alt_number']!="")
													$mobno1 .= $extr . $mainmem['code_alt_number'] . "-" . $mainmem['alt_number'];	
												else
													$mobno1 .= $extr . $mainmem['alt_number'];	
											}
										}
										else
											$mobno1 = "-";
										
										echo $mobno1; 
									?>			
								</td>
                              </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><span class="text4_user">Form No </span>: <?php echo $mainmem['form_no']; ?></td>
                                <td class="text_user"><span class="text4_user"><strong>Email</strong></span>: 
									<?php if($mainmem['email']!=""){ ?>
										<a href="mailto:<?php echo $mainmem['email']; ?>"><?php echo $mainmem['email']; ?></a>
									<?php }else{ echo "-"; } ?>
								</td>
                              </tr>
                              <tr class="text">
                                <td height="8" colspan="4" class="text_user"></td>
                              </tr>
                              <tr class="text" >
                                <td colspan="4" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                              </tr>
                            </table></td>
                            </tr>
                          <tr bgcolor="#f2f2f2">
                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#ffffff">&nbsp;</td>
                          </tr>
                          <?php
								while ($rec = mysqli_fetch_array($chk_submem))
								{
									$age = $rec['birth_date']!="0000-00-00"?(date('Y') - date('Y', strtotime($rec['birth_date'])))." yrs":$rec['age']." yrs";
									
									// Get details of HOF/Husband to display incase of inner members //
									if($rec['parent_id']!="0" && $rec['anc_id']!="0")
									{
										$sql_hofdet = "select v.*,v1.lname_vc as parlname from vastipatrak_m v 
													   left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
													   left outer join state_m state on v.state = state.state_id
													   left outer join city_m city on v.city = city.city_id
													   left outer join village_m vill on v.village_id = vill.village_id
													   left outer join gotra_m g on v.gotra_id = g.gotra_id
													   where v.vasti_id=".$rec['anc_id'];
									}
									else
									{
										$sql_hofdet = "select v.*,v1.lname_vc as parlname from vastipatrak_m v 
													   left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
													   left outer join state_m state on v.state = state.state_id
													   left outer join city_m city on v.city = city.city_id
													   left outer join village_m vill on v.village_id = vill.village_id
													   left outer join gotra_m g on v.gotra_id = g.gotra_id
													   where v.vasti_id=".$rec['parent_id'];
									}
									
									$chk_hofdet = mysqli_query($cn,$sql_hofdet);
									$det_hofdet = mysqli_fetch_array($chk_hofdet);
									
									if(isset($dt_vastipatrak['parent_id'])!="0")
									{
										$mname = $det_hofdet['fname_vc'];
										if($det_hofdet['lname_vc']!="")
											$lname = $det_hofdet['lname_vc'];
										else
											$lname = $det_hofdet['parlname'];
									}
									else
									{
										$mname = $rec['mname_vc'];
										$lname = $rec['lname_vc'];
									}
							?>
						  <tr bgcolor="#f2f2f2">
                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#ffffff"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="3%" class="text4_user"><div align="center"><?php if($rec['thumb_image']!=""){ ?> <img src="images/user.png" width="15" height="15"> <?php } ?></div></td>
                                <td width="33%" class="text4_user"><?php echo($rec['fname_vc'] . " " .$mname . " " .$lname); ?></td>
                                <td width="33%" class="text_user"><strong>M</strong>. 
									<?php 
										$extr = "";
										
										if($rec['mobile_home']!="" || $rec['alt_mobile']!="")
										{
											if($rec['mobile_home']!="")
											{
												if ($mainmem['vcallcode']!="")
													$mobno = $mainmem['vcallcode'] . " " .$rec['mobile_home'];
												else
													$mobno = $rec['mobile_home'];
												$extr = " / ";
											}
											if($rec['alt_mobile']!="") 
												if ($mainmem['vcallcode']!="")
													$mobno .= $extr . $mainmem['vcallcode'] . " " . $rec['alt_mobile'];	
												else
													$mobno .= $extr . $rec['alt_mobile'];	
										}
										else
											$mobno = "-";
										
										echo $mobno; 
									?>			
								</td>
                                <td width="33%" rowspan="5" valign="top" style="padding-top:10px;"><table width="60%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                    <?php
										if(isset($_GET['vid'])=="")
										{
									 ?>
									<tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="signup.php?Code=<?php echo($rec['vasti_id']); ?>&Mode=E&HCode=<?php echo $mainmem['vasti_id']; ?>" target="_self">Modify Record </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
									<?php } ?>
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="user-full-profile.php?VId=<?php echo $rec['vasti_id']; ?>" target="_blank" class="style1">View Profile </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <?php
										if(isset($_GET['vid'])=="")
										{
									 ?>
									<tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="user-family-move.php?Code=<?php echo($rec['vasti_id']); ?>&fname=<?php echo($rec['fname_vc']); ?>&mname=<?php echo($mname); ?>&lname=<?php echo($lname); ?>&gender=<?php echo($rec['gender_c']); ?>&maritalstatus=<?php echo $rec['marital_name']; ?>&HOF=0" target="_self">Move</a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><b>Last Updated On: <?php echo date('d-m-Y',strtotime($rec['reg_date'])); ?> </b></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
									<?php } ?>
                                </table></td>
                              </tr>
                              <tr>
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><?php echo $rec['gender_c']; ?>, <?php echo $age; ?></td>
                                <td class="text_user"><span class="text4_user"><strong>Email</strong></span>: 
									<?php if($rec['email']!=""){ ?>
										<a href="mailto:<?php echo $rec['email']; ?>"><?php echo $rec['email']; ?></a>
									<?php }else{ echo "-"; } ?>
								</td>
                              </tr>
                              <?php if($rec['marital_name']!=""){ ?>
							  <tr class="text">
							    <td class="text_user">&nbsp;</td>
                                <td class="text_user"><?php echo $rec['marital_name']; ?></td>
                                <td class="text_user">&nbsp; </td>
                              </tr>
							  <?php } ?>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><span class="text4_user">Relation</span>: <?php echo($rec['relation_name']); ?></td>
                                <td class="text_user">&nbsp;</td>
                              </tr>
                              <tr class="text">
                                <td height="8" colspan="3" class="text_user"></td>
                              </tr>
                              <tr class="text" >
                                <td colspan="4" class="text_user" background="images/line_user_list.jpg"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                              </tr>
                              <tr class="text">
                                <td colspan="4" class="text_user">&nbsp;</td>
                              </tr>
                            </table></td>
                          </tr>
						  <?php } ?>
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
              <td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://apolloinfotech.com" target="_blank"> Apollo Infotech</a></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!--<script>
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
 -->
</body>


</html>
