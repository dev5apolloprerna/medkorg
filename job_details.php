<?php
require_once 'admin/connection/conn.php';
	 $sql_select_job="select j.*,i.ind_value,f.fun_value from search_jobs j,industry_m i,functional_m f where i.ind_id=j.industry_vc and f.fun_id=j.expertise_vc and j.req_no=".$_GET['Code'];
	  $exec_select_job=mysqli_query($cn,$sql_select_job);
	$rec=mysqli_fetch_assoc($exec_select_job);
	
	$desig =  $rec['designation_vc'];
	
	// Advertisement Query
	$sql_advt = "select * from advt_tbl where page_id_int = (select page_id_int from page_m where page_name_vc='job_details') order by RAND() limit 1";
	$chk_advt = mysqli_query($cn,$sql_advt);
	$advt = mysqli_fetch_array($chk_advt);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
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
          <tr>
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
            <td width="11%" align="center" valign="middle" class="menu"><a href="feedback.php">Feedback</a></td>
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
                    <td align="center" valign="top" class="border1"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="37">&nbsp;</td>
                            <td height="37" align="left" valign="middle" class="title">Job Description </td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="2%">&nbsp;</td>
                      <td width="98%"><table width="837" border="0" align="left" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="837" height="10"></td>
                        </tr>
                        <tr>
                          <td height="10" valign="top"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td height="10"></td>
                              </tr>
                              <tr>
                                <td width="837" valign="top">
                                  <table width="70%" align="left">
                                    <tr valign="top" class="sub_heading" >
                                      <td width="26%" valign="top" align="right"><b>Designation</b></td>
                                      <td  width="2%"><b>:</b></td>
                                      <td width="72%" align="left"><?php echo $rec['designation_vc'] ?>
                                       
                                        <div align="left"></div></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                    <tr valign="top" class="text">
                                      <td align="right"><b>Company Profile</b></td>
                                      <td><b>:</b></td>
                                      <td align="left"><?php echo $rec['company_profile'] ?>
                                        
                                        <div align="left"></div></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                    <tr class="text" valign="top">
                                      <td align="right"><b>Job Profile</b></td>
                                      <td><b>:</b></td>
                                      <td align="left"><?php echo $rec['job_profile'] ?>
                                        
                                        <div align="left"></div></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                    <tr class="text" valign="top">
                                      <td align="right"><b>Experience required</b></td>
                                      <td><b>:</b></td>
                                      <td align="left"><?php echo $rec['exper_min'].'/'.$rec['exper_max'] ?> Years
                                        </div>                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                    <tr class="text" valign="top">
                                      <td align="right"><b>Industry</b></td>
                                      <td><b>:</b></td>
                                      <td align="left"><?php echo $rec['ind_value'] ?>
                                        
                                        <div align="left"></div></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                    <tr class="text" valign="top">
                                      <td align="right"><b>Funcational Area</b></td>
                                      <td><b>:</b></td>
                                      <td align="left"><?php echo $rec['fun_value'] ?>
                                        
                                        <div align="left"></div></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                    <tr class="text" valign="top">
                                      <td width="26%" align="right"><b>Location</b></td>
                                      <td width="2%"><b>:</b></td>
                                      <td align="left"?php echo $rec['location_vc'] ?>
                                       
                                        
                                        <div align="left"></div></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                    <tr class="text"  valign="top">
                                      <td width="26%" align="right"><b>Compensation</b></td>
                                      <td width="2%"><b>:</b></td>
                                      <td align="left"><?php echo $rec['compensation'] ?>
                                       
                                        <div align="left"></div></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                    <tr class="text" valign="top">
                                      <td width="26%" align="right"><b>Candidate Profile </b></td>
                                      <td width="2%"><b>:</b></td>
                                      <td align="left"><?php echo $rec['cand_profile'] ?>
                                        <div align="left"></div></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                    <tr class="text" valign="top">
                                      <td width="26%" align="right"><b>Contact Person </b></td>
                                      <td width="2%"><b>:</b></td>
                                      <td align="left"><?php echo $rec['con_person'] ?>
                                       
                                        <div align="left"></div></td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" align="center"><input name="button" type="button" onclick="javascript:window.location='cand_apply.php?Code=<?php echo $_GET['Code']?>&desig=<?php echo $desig; ?>'" value="Post Resume" /></td>
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
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
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
