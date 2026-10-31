<?php
	
	include_once "noentry.php";
	include_once "admin/connection/conn.php";

	// Query for Village data //
	$sql_vill = "select * from village_m order by village_name";
	$chk_vill = mysqli_query($cn,$sql_vill);
	
	// Query for Village gotra //
	$sql_gotra = "select * from gotra_m order by gotra_name";
	$chk_gotra = mysqli_query($cn,$sql_gotra);
	
	// Advertisement Query
	$sql_advt = "select * from advt_tbl where page_id_int = (select page_id_int from page_m where page_name_vc='feedback') order by RAND() limit 1";
	$chk_advt = mysqli_query($cn,$sql_advt);
	$advt = mysqli_fetch_array($chk_advt);
	
	$sql_string = "SELECT * FROM bdir_category where cat_type='B' and main_id=0 and group_name!='Root' order by sub_id";
	$check_cat = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));

	$sql_string = "SELECT * FROM bdir_category where cat_type='P' and main_id=0 and group_name!='Root' order by sub_id";
	$check_cat1 = mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/ajax.js"></script>
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
                        <td width="22%" rowspan="4" valign="top" bgcolor="#f2f2f2" style="padding:8px 8px 8px 8px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                        <td height="25" align="left" bgcolor="#f8f8f8" class="text4" style="padding-left:8px; font-size: 14px;">Vasti Patrak Search Page </td>
                      </tr>
                      <tr>
                        <td valign="top" style="padding:0px 0px 10px 10px">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top" style="padding:0px 0px 10px 10px">
						 <form name="frmSearch" method="post" action="user-vastipatrak-result.php">
						 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
						  <tr bgcolor="#f8f8f8">
							<td colspan="3" align="left" class="menu"><font style="text-decoration:blink;"><strong>Search By</strong></font></td>
						  </tr>
						  <tr>
						    <td height="20" colspan="3" align="left" class="menu">&nbsp;</td>
						    </tr>
						  <tr bgcolor="#f8f8f8">
						    <td height="20" colspan="3" align="left" class="text4">Personal Details </td>
						    </tr>
						  <tr valign="top">
                            <td height="8" colspan="3" class="text_bold_head"></td>
						    </tr>
						  <tr>
						    <td width="24%" align="left" class="text3"><div align="right">Village (Native Place)</div></td>
						    <td width="2%" align="left" class="text3"><div align="center">:</div></td>
						    <td width="74%" height="30" align="left" class="text2" style="padding-left:05px;">
								<select name="village_id"> 
									<option value=""> Select Village </option>
									<?php
									while($vill = mysqli_fetch_array($chk_vill))
									{
									?>
										<option value="<?php echo $vill['village_id']; ?>"> <?php echo $vill['village_name']; ?> </option>
									<?php } ?>
								</select>
							</td>
						  </tr>
						  <tr>
                            <td align="left" class="text3"><div align="right">Gotra</div></td>
                            <td align="left" class="text3"><div align="center">:</div></td>
                            <td height="30" align="left" class="text2" style="padding-left:05px;">
                              <select name="gotra_id"> 
									<option value=""> Select Gotra </option>
									<?php
									while($gotra = mysqli_fetch_array($chk_gotra))
									{
									?>
										<option value="<?php echo $gotra['gotra_id']; ?>"> <?php echo $gotra['gotra_name']; ?> </option>
									<?php } ?>
								</select>
                            </td>
						    </tr>
						  <tr>
                            <td height="30" align="left" class="text3"><div align="right">First Name </div></td>
                            <td align="left" class="text3"><div align="center">:</div></td>
                            <td align="left" class="text2" style="padding-left:05px;">
                              <input type="text" name="fname_vc">
                            </td>
						    </tr>
						  <tr>
                            <td height="30" align="left" class="text3"><div align="right">Last Name </div></td>
                            <td align="left" class="text3"><div align="center">:</div></td>
                            <td align="left" class="text2" style="padding-left:05px;">
                              <input type="text" name="lname_vc" />
                            </td>
						    </tr>
						  <tr>
                            <td height="30" align="left" class="text3"><div align="right">Email ID </div></td>
                            <td align="left" class="text3"><div align="center">:</div></td>
                            <td align="left" class="text2" style="padding-left:05px;">
                              <input type="text" name="email" />
                            </td>
						    </tr>
						  <tr>
                            <td align="left" class="text3"><div align="right">Blood Group </div></td>
                            <td align="left" class="text3"><div align="center">:</div></td>
                            <td height="30" align="left" class="text2" style="padding-left:05px;">
                              <select name="blood_group">
                                <option value=""> Select Blood Group </option>
                                <option value="A +ve"> A +ve </option>
                                <option value="A -ve"> A -ve </option>
                                <option value="B +ve"> B +ve </option>
                                <option value="B -ve"> B -ve </option>
                                <option value="O +ve"> O +ve </option>
                                <option value="O -ve"> O -ve </option>
                                <option value="AB +ve"> AB +ve </option>
                                <option value="AB -ve"> AB -ve </option>
                              </select>
                            </td>
						    </tr>
						  <tr>
                            <td height="30" align="left" class="text3"><div align="right">Current Location</div></td>
                            <td align="left" class="text3"><div align="center">:</div></td>
                            <td align="left" class="text2" style="padding-left:05px;">
                              <input type="text" name="location" /> 
                              <span class="text">(Eg : City / State / Country)</span></td>
						    </tr>
						  <tr>
						    <td colspan="3" align="left" class="text3">&nbsp;</td>
						    </tr>
						  <tr bgcolor="#f8f8f8">
                            <td height="20" colspan="3" align="left" class="text4">Professional Details </td>
						    </tr>
						  <tr>
						    <td height="20" colspan="3" align="left" class="menu"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr valign="top">
                                  <td height="8" colspan="3" class="text_bold_head"></td>
                                </tr>
                                <tr valign="top">
                                  <td height="10" colspan="3"><span class="sublink"> </span>
                                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="24%" height="10" valign="top" class="text3"><div align="right">Type</div></td>
                                          <td width="2%" height="25" valign="top"><div align="center" class="text3">:</div></td>
                                          <td width="74%" height="25"> <span class="sublink">
                                            <select name="prof_type" onchange="showhideDiv(this.value)">
                                              <option value=""> Please Select </option>
                                              <option value="U" <?php echo ($prof_type == "U")?"selected":""; ?>> Unemployed </option>
                                              <option value="B" <?php echo ($prof_type == "B")?"selected":""; ?>> Business </option>
                                              <option value="P" <?php echo ($prof_type == "P")?"selected":""; ?>> Profession </option>
                                              <option value="J" <?php echo ($prof_type == "J")?"selected":""; ?>> Job </option>
                                            </select>
                                          </span> </td>
                                        </tr>
                                        <tr id="trbusiness" style="display:none;">
                                          <td height="25" colspan="3" valign="top" class="text"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="24%" height="10" valign="top" class="text3"><div align="right">Business Category</div></td>
                                                <td width="2%" height="25" valign="top" class="text3"><div align="center">:</div></td>
                                                <td width="74%" height="25"><span class="sublink">
                                                  <select name="bness_cat_id" onchange="getSubCat(this.value,'','bness_subcat_id','tdsubcat');">
                                                    <option value=""> Please Select </option>
                                                    <?php
											while($cat = mysqli_fetch_array($check_cat))
											{
												if($bness_cat_id == $cat['sub_id'])
												{
										 ?>
                                                    <option value="<?php echo $cat['sub_id']; ?>" selected="selected"> <?php echo $cat['group_name']; ?> </option>
                                                    <?php 	} else { ?>
                                                    <option value="<?php echo $cat['sub_id']; ?>"> <?php echo $cat['group_name']; ?> </option>
                                                    <?php
										 	} }
										 ?>
                                                  </select>
                                                </span></td>
                                              </tr>
                                              <tr>
                                                <td height="10" valign="top" class="text3"><div align="right">Business SubCategory</div></td>
                                                <td height="25" valign="top" class="text3"><div align="center">:</div></td>
                                                <td height="25" id="tdsubcat"><span class="sublink">
                                                  <select name="bness_subcat_id">
                                                    <option value=""> Please Select </option>
                                                  </select>
                                                </span></td>
                                              </tr>
                                              <tr>
                                                <td height="10" valign="top" class="text3"><div align="right">Business Name </div></td>
                                                <td height="25" valign="top" class="text3"><div align="center">:</div></td>
                                                <td height="25"><span class="sublink">
                                                  <input name="bness_name" type="text" class="txtbox1" tabindex="1" value="<?php echo($bness_name); ?>" size="50" />
                                                </span></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                    </table></td>
                                </tr>
                                <tr valign="top" id="trprof" style="display:none;">
                                  <td height="10" colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="24%" height="10" valign="top" class="text3"><div align="right">Profession Name</div></td>
                                        <td width="2%" height="25" valign="top" class="text3"><div align="center">:</div></td>
                                        <td width="74%" height="25"><span class="sublink">
                                          <select name="prof_cat_id" onchange="getSubCat(this.value,'','prof_subcat_id','tdprofcat');">
                                            <option value=""> Please Select </option>
                                            <?php
											while($prof = mysqli_fetch_array($check_cat1))
											{
												if($prof_cat_id == $prof['sub_id'])
												{
										 ?>
                                            <option value="<?php echo $prof['sub_id']; ?>" selected="selected"> <?php echo $prof['group_name']; ?> </option>
                                            <?php 	} else { ?>
                                            <option value="<?php echo $prof['sub_id']; ?>"> <?php echo $prof['group_name']; ?> </option>
                                            <?php
										 	} }
										 ?>
                                          </select>
                                        </span></td>
                                      </tr>
                                      <tr>
                                        <td height="10" valign="top" class="text3"><div align="right">Specialization</div></td>
                                        <td height="25" valign="top" class="text3"><div align="center">:</div></td>
                                        <td height="25" id="tdprofcat"><span class="sublink">
                                          <select name="prof_subcat_id">
                                            <option value=""> Please Select </option>
                                          </select>
                                        </span></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr valign="top" id="trjob" style="display:none;">
                                  <td height="10" colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="24%" height="10" valign="top" class="text"><div align="right" class="text3">Company Name</div></td>
                                        <td width="2%" height="25" valign="top" class="text3"><div align="center">:</div></td>
                                        <td width="74%" height="25"><span class="sublink"> <span class="text">
                                          <input name="comp_name" type="text" class="txtbox1" tabindex="1" value="<?php echo($comp_name); ?>" size="50" />
                                        </span> </span></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr valign="top">
                                  <td width="24%" height="10">&nbsp;</td>
                                  <td width="2%">&nbsp;</td>
                                  <td width="74%">&nbsp;</td>
                                </tr>
                                <tr valign="top">
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td><input name="submit" type="submit" tabindex="15" value="Click here to Search" width="71" height="24" border="0" /></td>
                                </tr>
                                                        </table></td>
						    </tr>
						 </table>
						 </form>
						</td>
                      </tr>
                      <tr>
                        <td width="78%" valign="top" style="padding:0px 0px 10px 10px">&nbsp;</td>
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
