<?php

	include_once "noentry.php";
	include_once "admin/connection/conn.php";
	
	$sql_dir_list  = "select * from user_directory where vasti_id=".$_SESSION['VastiId']." order by dir_name";
	$chk_dir_list = mysqli_query($cn,$sql_dir_list);
	$num_dir_list = mysqli_num_rows($chk_dir_list);

	if($_POST)
	{
		// if directory name is entered, insert that into the db with current userid //
		if($_POST['dir_name']!="")
		{
			$sql_ins = "insert into user_directory (vasti_id,dir_name,status) values ('".$_POST['vasti_id']."','".$_POST['dir_name']."',1)"; 
			$chk_ins = mysqli_query($cn,$sql_ins);
		}
		header("Location: user-directory-list.php");
		exit;	
	}	
	
	if(isset($_GET['mode'])=='D')
	{
		$sql_del_rec = "delete from user_directory_records where dir_id=".$_GET['id'];
		$chk_del_rec = mysqli_query($cn,$sql_del_rec);
		
		$sql_del_dir = "delete from user_directory where dir_id=".$_GET['id'];
		$chk_del_dir = mysqli_query($cn,$sql_del_dir);
		
		header("Location: user-directory-list.php");
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
	if(confirm("Are you sure you want to Remove this Directory"))
	{
		window.location = 'user-directory-list.php?id='+code+'&mode=D';
	}
	else
	{
		return false;
	}	  
}
</script>
<link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="mm_menu.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
  $('a[rel*=facebox]').facebox({
	loadingImage : 'images/loading.gif',
	closeImage   : 'images/closelabel.png'
  })
})
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
                        <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#FFFFFF">
                            <td colspan="3">&nbsp;</td>
                            </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="0%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="77%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;">MY DIRECTORY </td>
                          <td width="23%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;"><?php echo $num_dir_list; ?> RECORDS </td>
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
                            <td align="left" valign="middle" bgcolor="#FFFFFF"><table width="98%" cellspacing="0" cellpadding="0" style="border-style:solid;border-width:1px;border-color:#CCCCCC;">
                              <tr>
                                <td><table width="100%"  border="0" cellspacing="0" bgcolor="#fbfbfb">
                                  <tr bgcolor="#989898" class="text">
                                    <td height="30" class="text_user" style="padding-left:5px; font-weight: bold; color: #FFFFFF;">ADD A NEW DIRECTORY</td>
                                  </tr>
                                  <tr bgcolor="#FFFFFF" class="text">
                                    <td height="30" valign="top" bgcolor="#FBFBFB" class="text_user" style="padding-left:5px; font-weight: bold;"><table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td height="30">
										<form name="frmNewDir" method="post" action="user-directory-list.php">
										<input type="hidden" name="vasti_id" value="<?php echo $_SESSION['VastiId']; ?>">
										<table width="100%" height="90"  border="0" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td height="30" align="right" style="padding-right:10px;">&nbsp;</td>
                                            <td height="30">&nbsp;</td>
                                            <td height="30">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td width="33%" height="30" align="right" class="text4_user" style="padding-right:10px;">Directory Name</td>
                                            <td width="33%" height="30"><input name="dir_name" type="text" class="txtbox" size="50" /></td>
                                            <td width="33%" height="30"><input type="image" src="images/btn_save.jpg" width="74" height="26" /></td>
                                          </tr>
                                          <tr>
                                            <td height="30" align="right" style="padding-right:10px;">&nbsp;</td>
                                            <td height="30">&nbsp;</td>
                                            <td height="30">&nbsp;</td>
                                          </tr>
                                        </table>
										</form>
										</td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                            </tr>
                          <tr bgcolor="#f2f2f2">
                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#ffffff">&nbsp;</td>
                          </tr>
                          <?php
						  	if($num_dir_list > 0)
							{
								while($dir = mysqli_fetch_array($chk_dir_list))
								{
									// Get records for this directory //
									$sql_dirlist  = "select * from user_directory_records where dir_id=".$dir['dir_id']." order by vasti_id";
									$chk_dirlist = mysqli_query($cn,$sql_dirlist);
									$num_dirlist = mysqli_num_rows($chk_dirlist);
						   ?>
						  <tr bgcolor="#f2f2f2">
                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#ffffff"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                              <tr class="text">
                                <td width="33%" class="text_user"><span class="text4_user" style="padding-left:10px;"><a href="user-directory-records-list.php?dirid=<?php echo $dir['dir_id']; ?>&dirnm=<?php echo urlencode($dir['dir_name']); ?>"><?php echo $dir['dir_name']; ?></a></span></td>
                                <td width="33%" class="text_user" style="padding-left:10px;"><strong><?php echo $num_dirlist; ?> Records </strong></td>
                                <td width="33%" valign="top" style="padding-top:10px;"><table width="50%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="user-directory-records-list.php?dirid=<?php echo $dir['dir_id']; ?>&dirnm=<?php echo urlencode($dir['dir_name']); ?>">View List </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="user-vp-search.php?mode=Dir&dirid=<?php echo $dir['dir_id']; ?>&dirnm=<?php echo urlencode($dir['dir_name']); ?>" class="style1">Add to My Directory </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;">
									  	<a href="fields_sqltocsv.php?dirid=<?php echo $dir['dir_id']; ?>&dirnm=<?php echo urlencode($dir['dir_name']); ?>" class="style1" rel="facebox">Show Label</a>  
									  	<!-- <a href="#" class="style1" rel="">Show Label</a> -->
									  </td>
									  
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;">
									  	<a target="_blank" href="print_labels.php?dirid=<?php echo $dir['dir_id']; ?>&dirnm=<?php echo urlencode($dir['dir_name']); ?>" class="style1">Print Label</a>  
									  	<!-- <a href="#" class="style1" rel="">Show Label</a> -->
									  </td>
									  
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="text_user" style="padding-left:3px;"><a href="#" onclick="javascript:doDeleteRec(<?php echo $dir['dir_id']; ?>);">Remove Directory </a></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="#ac2615"></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr class="text">
                                <td height="8" colspan="3" class="text_user"></td>
                              </tr>
                              <tr class="text" >
                                <td colspan="3" class="text_user" background="images/line_user_list.jpg"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                              </tr>
                            </table></td>
                          </tr>
						  <?php } }else{ ?>
						  <tr>
						  	<td colspan="4" class="text4" style="padding-left:20px; "> <div align="center">No Directories Found...!!!</div></td>
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
              <td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://apolloinfotech.com/" target="_blank"> Apollo Infotech</a></td>
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
