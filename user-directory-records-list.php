<?php

	include_once "noentry.php";
	include_once "admin/connection/conn.php";
	$imgdir = "admin/images/vastipatrak/thumb/";
	
	// Advertisement Query
	$sql_advt = "select * from advt_tbl where page_id_int = (select page_id_int from page_m where page_name_vc='feedback') order by RAND() limit 1";
	$chk_advt = mysqli_query($cn,$sql_advt);
	$advt = mysqli_fetch_array($chk_advt);
	
	//  PAGING	//
		$sql_string="SELECT count(*) as totrec FROM vastipatrak_m v 
					 left outer join user_directory_records udir_rec on v.vasti_id = udir_rec.vasti_id
					 left outer join gotra_m g on v.gotra_id = g.gotra_id  
					 left outer join village_m vill on vill.village_id = v.village_id
					 left outer join marital_m m on v.marital_id = m.marital_id
					 left outer join country_m country on v.country = country.country_id
					 left outer join state_m state on v.state = state.state_id
					 left outer join city_m city on v.city = city.city_id 					 
					 where udir_rec.dir_id=".$_GET['dirid'];
					 
		$result=mysqli_query($cn,$sql_string);
		$tmp=mysqli_fetch_assoc($result);
		  $totrecord=$tmp['totrec'];
		  
		$recperpage=50;
		//$recperpage=2;
		
		$maxpage=(int)($totrecord/$recperpage);
	 
		$rem=$totrecord%$recperpage;
		if($rem>0)
			$maxpage++;
		
		$pageNum=1;
		 
		if(isset($_GET['pageid']))
			$pageNum=$_GET['pageid'];	
		
		if($pageNum == "" || $pageNum=="undefined")
		{
			$pageNum = 1;
		}
			
		$offset = ($pageNum - 1) * $recperpage;
		$limit="LIMIT $offset,$recperpage";


	// Get details of main member
	$sql_dir_rec = "select * from vastipatrak_m v
					left outer join user_directory_records udir_rec on v.vasti_id = udir_rec.vasti_id
					left outer join gotra_m g on v.gotra_id = g.gotra_id  
					left outer join village_m vill on vill.village_id = v.village_id
					left outer join marital_m m on v.marital_id = m.marital_id
					left outer join country_m country on v.country = country.country_id
					 left outer join state_m state on v.state = state.state_id
					 left outer join city_m city on v.city = city.city_id 				
					where udir_rec.dir_id=".$_GET['dirid']." $limit";

	$chk_dir_rec = mysqli_query($cn,$sql_dir_rec);
	$num_dir_rec = mysqli_num_rows($chk_dir_rec);
	
	if(isset($_POST['txtMode']) == "D")
	{
		foreach($_POST['chk'] as $v)
		{
			$sql_del_rec = "delete from user_directory_records where rec_id=".$v;
			$chk_del_rec = mysqli_query($cn,$sql_del_rec);
		}

		header("Location: user-directory-records-list.php?dirid=".$_GET['dirid']."&dirnm=".$_GET['dirnm']);
		exit;
	}
	
	if(isset($_GET['Mode']) == "D")
	{
		$sql_del_rec = "delete from user_directory_records where rec_id=".$_GET['Code'];
		$chk_del_rec = mysqli_query($cn,$sql_del_rec);
		
		header("Location: user-directory-records-list.php?dirid=".$_GET['dirid']."&dirnm=".$_GET['dirnm']);
		exit;
	}	
	/*// Get details of all submembers for current main member //
	$sql_submem = "select v.*,r.relation_name,m.marital_name from vastipatrak_m v
				   left outer join relation_m r on v.relation_id = r.relation_id
				   left outer join marital_m m on v.marital_id = m.marital_id
				   where v.parent_id=".$_SESSION['VastiId']." order by v.birth_date ASC";
	$chk_submem = mysql_query($sql_submem);
	*/
	
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
function checkall(field)
{
	chk=document.frmSearchBox['chk[]'];
	alert(chk);
	
	if(typeof(chk.length)=="undefined")
		chk.checked=field.checked?true:false;
	
	for(i=0;i<chk.length;i++)
	 	chk[i].checked=field.checked?true:false; 
}

function doAction(act,action)
 {
 	var chk=document.frmSearchBox['chk[]'];
	
	var t=0;
	if(typeof(chk.length)=="undefined")
	{	 
		if(window.confirm('Are you sure to '+action+' the Selected Records?'))
		{
			document.frmSearchBox.txtMode.value=act;
			document.frmSearchBox.submit(); 
			return;
		}	
	}
	
	for(i=0;i<chk.length;i++)
	{
		chk[i].checked?t++:null;
	}
	
	if(t==0)
	{
		alert('No Records are Selected');
		return;
	}
	
	if(window.confirm('Are you sure to '+action+' the Selected Records?'))
	{
		document.frmSearchBox.txtMode.value=act;
		document.frmSearchBox.submit(); 
	}	
		
 }
 
 function doSubmit(pgnum)
 {
 	if(pgnum != "")
		document.getElementById("pgnum").value = pgnum;
	
	document.frmSearchBox.submit();
 }
 
 function deleteRec(code)
 {
 	if(window.confirm('Are you sure to Remove the Selected Record?'))
	{
		window.location = "user-directory-records-list.php?Code="+code+"&dirid=<?php echo $_GET['dirid']; ?>&dirnm=<?php echo $_GET['dirnm']; ?>&Mode=D";
	}	
 }
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
        <td height="41" align="center" valign="middle" background="images/menu_bg.jpg" style="background-repeat:repeat-x">
        <?php include_once "menu.php"; ?></td>
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
                        <td colspan="3"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#FFFFFF">
                            <td colspan="5">&nbsp;</td>
                            </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="58%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;">DIRECTORY LISTING - <?php echo $_GET['dirnm']; ?> </td>
                          <td width="17%" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;"><span class="text3"><a href="#" class="title1" onClick="javascript:doAction('D','Delete');">Remove selected records</a></span></td>
                            <td width="11%" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;"><span class="text3"><a href="user-vp-search.php?mode=Dir&amp;dirid=<?php echo $_GET['dirid']; ?>&amp;dirnm=<?php echo urlencode($_GET['dirnm']); ?>" class="title1">Add to Directory</a></span></td>
                            <td width="12%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;"><?php echo $totrecord; ?> RECORDS </td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td width="4%">&nbsp;</td>
                      <td width="69%" class="title1">&nbsp;</td>
                        <td width="27%">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#f2f2f2">
                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#FFFFFF"><table width="20%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="17%" align="left" valign="middle" bgcolor="#ffffff" class="text1"><div align="center"><strong>
                                    <input type="checkbox" name="chkall" onchange="checkall(this);" />
                                </strong></div></td>
                                <td width="83%" align="left" valign="middle" bgcolor="#ffffff" class="text1"><strong>Select All</strong></td>
                              </tr>
                            </table></td>
                          <td align="left" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td colspan="2" align="left" valign="middle" bgcolor="#FFFFFF">
							<form action="user-directory-records-list.php?dirid=<?php echo $_GET['dirid']; ?>&dirnm=<?php echo $_GET['dirnm']; ?>" method="post" name="frmSearchBox" id="frmSearchBox">
							 <input type="hidden" name="txtMode">
							 <input type="hidden" name="dirid" value="<?php echo $_GET['dirid']; ?>"> 
							 <input type="hidden" name="dirnm" value="<?php echo $_GET['dirnm']; ?>">
							 <input type="hidden" name="pgnum" value="">
					
							<?php
								if($num_dir_rec > 0)
								{
								while($mainmem = mysqli_fetch_array($chk_dir_rec))
								{
									
							 ?>
							<table width="98%"  border="0" cellspacing="0">
                              <tr class="text">
                                <td width="3%" bgcolor="#fbfbfb" class="text4_user"><div align="center">
                                    <input type="checkbox" name="chk[]" value="<?php echo $mainmem['rec_id']; ?>" />
                                </div></td>
                                <td width="33%" class="text_user"><span class="text4_user"> <?php echo $mainmem['fname_vc'] ." ".$mainmem['mname_vc'] ." ". $mainmem['lname_vc']; ?> </span></td>
                                <td width="33%" rowspan="4" class="text_user"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                  <?php $address=""; if($mainmem['addr1']!=""){ ?>
								  <tr bgcolor="#fbfbfb" class="text">
                                    <td bgcolor="#FFFFFF" class="text_user"><?php echo $mainmem['addr1']; $address .=$mainmem['addr1']; ?> </td>
                                  </tr>
								  <?php } ?>
                                  <?php if($mainmem['addr2']!=""){ ?>
								  <tr bgcolor="#fbfbfb" class="text">
                                    <td bgcolor="#FFFFFF" class="text_user"><?php echo $mainmem['addr2']; $address .=$mainmem['addr2']; ?></td>
                                  </tr>
                                  <?php } ?>
                                  <?php if($mainmem['addr3']!=""){ ?>
								  <tr bgcolor="#fbfbfb" class="text">
                                    <td bgcolor="#FFFFFF" class="text_user"><?php echo $mainmem['addr3']; $address .=$mainmem['addr3']; ?></td>
                                  </tr>
                                  <?php } ?>
                                  <?php if($mainmem['city']!="" || $mainmem['state']!="" || $mainmem['pincode']!=""){ ?>
								  <tr bgcolor="#fbfbfb" class="text">
                                    <td bgcolor="#FFFFFF" class="text_user"><?php echo $mainmem['city_name']; $address .=$mainmem['city_name'].","; ?>, <?php echo $mainmem['state_name']; $address .=$mainmem['state_name']; ?> - <?php echo $mainmem['pincode']; $address .="-".$mainmem['pincode']; ?>.
                                        <a href="https://www.google.com/maps?q=<?= $address?>" target="_blank">
                                            <img src="images/map-marker.png" style="width: 25px;" alt="">
                                        </a>
                                    </td>
                                  </tr>
								  <?php } ?>
                                </table></td>
                                <td width="33%" rowspan="8" valign="top" style="padding-top:20px;"><table width="60%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="#" onclick="deleteRec(<?php echo $mainmem['rec_id']; ?>)" class="title1"> Remove from  Directory </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="user-full-profile.php?VId=<?php echo $mainmem['vasti_id']; ?>" target="_blank">View Profile </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="user-familytree.php?id=<?php echo $mainmem['vasti_id']; ?>" target="_blank">View Family Tree </a></td>
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
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><?php echo $mainmem['gender_c']; ?>, <?php echo(date('Y') - date('Y', strtotime($mainmem['birth_date'])) ." yrs"); ?> </td>
                                </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><?php echo $mainmem['city_name']; ?>.</td>
                                </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><?php echo $mainmem['marital_name']; ?></td>
                                </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user">&nbsp;</td>
                              </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><span class="text4_user"><strong>M</strong>.</span> <?php 
										$extr = "";
										
										if($mainmem['mobile_home']!="" || $mainmem['alt_mobile']!="")
										{
											if($mainmem['mobile_home']!="")
											{
												$mobno = 'Login: <a href="tel:'.$mainmem['mobile_home'].'">' .$mainmem['mobile_home'].' <img src="images/Call.png" style="width: 12px;"></a>';
												$extr = " / ";
											}
											if($mainmem['alt_mobile']!="") 
												$mobno .= $extr . 'Alt.: <a href="tel:'.$mainmem['alt_mobile'].'">' .$mainmem['alt_mobile'].' <img src="images/Call.png" style="width: 12px;"></a>';	
										}
										else
											$mobno = "-";
										
										echo $mobno; 
									?></td>
                              </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><span class="text4_user">Native</span>: <?php echo $mainmem['village_name']; ?></td>
                                <td class="text_user"><span class="text4_user">Ph.</span>
                                    <?php 
										$extr = "";
										
										if($mainmem['phone_number']!="" || $mainmem['alt_number']!="")
										{
											if($mainmem['phone_number']!="")
											{
												if($mainmem['code_phone_number'] != "")
													$mobno1 = $mainmem['code_phone_number'] . "-" . $mainmem['phone_number'];
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
									?></td>
                              </tr>
                              <tr class="text">
                                <td class="text_user">&nbsp;</td>
                                <td class="text_user"><span class="text4_user">Gotra</span>: <?php echo $mainmem['gotra_name']; ?></td>
                                <td class="text_user"><span class="text4_user"><strong>Email</strong></span>: <?= isset($mainmem['email']) && $mainmem['email'] != "" ? "Login: " .$mainmem['email'] : ""; ?></td>
                              </tr>
                              <tr class="text">
                                <td height="8" colspan="4" class="text_user"></td>
                              </tr>
                              <tr class="text" >
                                <td colspan="4" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                              </tr>
                              <tr class="text">
                                <td height="20" colspan="4" class="text_user"></td>
                              </tr>
                            </table>
							<?php } }else{  ?>
							<table width="98%"  border="0" cellspacing="0">
								<tr>
									<td class="text4"> <div align="center">No Records Found...!!! </div></td>
								</tr>
							</table>
							<?php } ?>
							</form>
							</td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="right" valign="top" class="text4_user">
                              <?php if($maxpage>1) { ?>
                              <div class="next">
                                <?php if($pageNum!=1) { ?>
                                <a href="user-directory-records-list.php?dirid=<?php echo $_GET['dirid']; ?>&dirnm=<?php echo urlencode($_GET['dirnm']); ?>&pageid=<?php echo $pageNum-1; ?>">
                                <?php } ?>
                                <font color="#000000" class="text4_user"><b>&lt;&lt;</b></font> Prev...
                                <?php if($pageNum!=1) { ?>
                                </a>
                                <?php } ?>
                                <?php for($i=1;$i<=$maxpage;$i++) { ?>
                                <a href="user-directory-records-list.php?dirid=<?php echo $_GET['dirid']; ?>&dirnm=<?php echo urlencode($_GET['dirnm']); ?>&pageid=<?php echo $i; ?>" class="text1" style="text-decoration:none;"><?php echo $i;?></a> |
                                <?php } ?>
                                <?php if($pageNum!=$maxpage) { ?>
                                <a href="user-directory-records-list.php?dirid=<?php echo $_GET['dirid']; ?>&dirnm=<?php echo urlencode($_GET['dirnm']); ?>&pageid=<?php echo $pageNum+1; ?>">
                                <?php }?>
      ....Next <font color="#000000" class="text4_user"><b>&gt;&gt;</b></font>
      <?php if($pageNum!=$maxpage) { ?>
                                </a>
                                <?php } ?>
                              </div>
                              <?php } ?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
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
