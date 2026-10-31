<?php
require_once 'admin/connection/conn.php';
	
/****Paging*********/ 
	    $sql_string="select j.*,f.fun_value,l.location_value from search_jobs j left outer join location_m l on j.location_vc= l.location_id left outer join functional_m f on j.expertise_vc = f.fun_id=j.expertise_vc $sqlextra";
		 
		$result=mysqli_query($cn,$sql_string); 
		 $totrecord=mysqli_num_rows($result);
 
		$recperpage=10;
		  $maxpage=(int)($totrecord/$recperpage);
	 
		$rem=$totrecord%$recperpage;
		if($rem>0)
			$maxpage++;
		
		$pageNum=1;
		 
		if(isset($_REQUEST['pageNum']) && $_REQUEST['pageNum']!="")
			$pageNum=$_REQUEST['pageNum'];	
			
		 
		 $offset = ($pageNum - 1) * $recperpage;
		$limit="LIMIT $offset,$recperpage";
/********************************************************/	 
	/*if($sqlextra=="")
		$sqlextra="where ";
	else
		$sqlextra.="and ";	
      $sql_select_job="select j.*,f.fun_value from search_jobs j,functional_m f  $sqlextra f.fun_id=j.expertise_vc order by j.req_no desc $limit";
	  
	  $exec_select_job=mysql_query($sql_select_job,$cn);
	  $numrows = mysql_num_rows($exec_select_job);*/
	 
	 $sql_select_job="select j.*,f.fun_value,l.location_value  from search_jobs j left outer join location_m l on j.location_vc= l.location_id left outer join functional_m f on j.expertise_vc = f.fun_id $sqlextra order by j.req_no desc $limit";
	
	 $exec_select_job=mysqli_query($cn,$sql_select_job);
	 $numrows = mysqli_num_rows($exec_select_job);
		
	// Advertisement Query
	$sql_advt = "select * from advt_tbl where page_id_int = (select page_id_int from page_m where page_name_vc='job_posting') order by RAND() limit 1";
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
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-size: 11px}
-->
</style>
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
                            <td width="2%" height="30" bgcolor="#F8F8F8">&nbsp;</td>
                            <td height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="title">Job Postings </td>
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
                          <td height="10" valign="top"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td height="8"></td>
                            </tr>
                            <tr>
                              <td height="8"></td>
                            </tr>
                            <?php
  
  while($rec=mysqli_fetch_assoc($exec_select_job))
  {
  ?>
                            <tr>
                              <td class="text">
                                <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr class="sub_heading">
                                    <td width="12%" align="right" class="text"><strong class="sub_heading">Designation</strong></td>
                                    <td width="3%" align="left" class="sub_heading"> <div align="center">:</div></td>
                                    <td width="85%" align="left"><?php echo $rec['designation_vc']?> </td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="text"><strong>Experience</strong></td>
                                    <td align="left" class="list"><div align="center">:</div></td>
                                    <td align="left" class="text"><?php echo $rec['exper_min'].'-'.$rec['exper_max']?> Years</td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="text"><strong>Location</strong></td>
                                    <td align="left" class="list"><div align="center">: </div></td>
                                    <td align="left" class="text"><?php echo $rec['location_value']?></td>
                                  </tr>
                                  <tr>
                                    <td valign="top" align="right" class="text">&nbsp;</td>
                                    <td valign="top" class="text"><div align="center"></div></td>
                                    <td align="right" valign="top" class="text"><table width="18%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="22%" align="center" valign="middle" ><img src="images/arrow.gif" width="13" height="7" /></td>
                                          <td width="78%" valign="top" nowrap="nowrap"><a href="job_details.php?Code=<?php echo $rec['req_no']?>"   class="footer">View Job Details</a></td>
                                        </tr>
                                      </table>
                                      <a href="#"></a></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="20"></td>
                            </tr>
                            <tr>
                              <td height="1" bgcolor="#CCCCCC"></td>
                            </tr>
                            <tr>
                              <td height="6"></td>
                            </tr>
                            <?php } ?>
                            <tr>
                              <td height="6" align="right">
                                <?php if($maxpage>1) 
		{ 
		?>
                                <?php for($i=1;$i<=$maxpage;$i++) 
			  { ?>
                                <a class="text" href="javascript:doPage(<?php echo $i;?>)"><?php echo $i;?></a> |
                                <?php } ?>
                                <?php 
		} ?>
                              </td>
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
              <td height="20" align="center" valign="middle" class="footer style1">All Rights Reserved. Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti</td>
            </tr>
            <tr>
              <td height="20" align="center" valign="middle" class="text"><div align="center" class="style1 style2">Website Design By:<a href="https://apolloinfotech.com/" target="_blank" style="text-align:justify; color: #FFFFFF;" #invalid_attr_id="12px/120% Arial, Helvetica, sans-serif"> Apollo Infotech</a></div></td>
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
