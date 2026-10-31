<?php
	include_once "admin/connection/conn.php";
	session_start();

	// Query for Village data //
	$sql_vill = "select * from village_m order by village_name";
	$chk_vill = mysqli_query($cn,$sql_vill);
	
	// Query for Village gotra //
	$sql_gotra = "select * from gotra_m order by gotra_name";
	$chk_gotra = mysqli_query($cn,$sql_gotra);
	
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
			$cond .= $where . "vasti.fname_vc like '%".$_POST['fname_vc']."%'";
		}	
		if($_POST['lname_vc']!="")
		{
			$cond .= $where . "vasti.lname_vc like '%".$_POST['lname_vc']."%'";
		}	
		if($_POST['location']!="")
		{
			$cond .= $where . "(vasti.city like '%".$_POST['location']."%' or vasti.state like '%".$_POST['location']."%' or vasti.country like '%".$_POST['location']."%')";
		}
		
	      	$sql_vastipatrak = "select vasti.*,v.village_name,g.gotra_name,gender_c from vastipatrak_m vasti left outer join village_m v on vasti.village_id = v.village_id left outer join gotra_m g on vasti.gotra_id = g.gotra_id where gender_c='male' and lineage=1 order by vasti.vasti_id";
		
        $chk_vastipatrak = mysqli_query($cn,$sql_vastipatrak);
	      $num_vastipatrak = mysqli_num_rows($chk_vastipatrak);
		
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
.style3 {color: #222222}
-->
</style>
<script language="javascript" type="text/javascript">
function checkall(field)
{
	chk=document.frmSearchBox['chk[]'];
	//alert(chk);
	
	if(typeof(chk.length)=="undefined")
		chk.checked=field.checked?true:false;
	
	for(i=0;i<chk.length;i++)
	 	chk[i].checked=field.checked?true:false; 
}

function doAction(act,action)
 {
 	if(window.confirm('Are you sure to '+action+' the Selected Records?'))
	{
		document.frmSearchBox.txtMode.value=act;
		document.frmSearchBox.txtCode.value=code;
		document.frmSearchBox.submit(); 
		return;
	}	
 }

//-->
</script>

<link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/facebox.js" type="text/javascript"></script>


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
        <td align="center" valign="top"><table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" align="center" valign="middle" bgcolor="#834153">&nbsp;</td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" class="border1"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="10"></td>
                  </tr>
                  <tr>
                    <td align="left" class="border1">
					<form action="signup.php" method="post" name="frmSearchBox" id="frmSearchBox">
                     <input type="hidden" name="txtMode">
					 <input type="hidden" name="txtCode">
					 <input type="hidden" name="pgnum" value="">
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="4"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#FFFFFF">
                            <td colspan="3">&nbsp;</td>
                            </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="67%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;"> ANCESTORS(LINEAGE) SEARCH RESULT </td>
                          <td width="23%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;"><?php echo $num_vastipatrak; ?> RECORDS </td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                        <td width="12" colspan="3" align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr bgcolor="#f2f2f2">
                             <td bgcolor="#FFFFFF"></td>
                             <td height="15" colspan="5" align="left" valign="middle" bgcolor="#ffffff"></td>
                           </tr>
                           <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="98%" colspan="5" align="left" valign="middle" bgcolor="#ffffff">
							 <?php
								$ex = "&";
								if(isset($_GET['Code'])!="")
								{
									$extra = $ex . "Code=".$_GET['Code'];
									$ex = "&";
								}
								if(isset($_GET['Mode'])!="")
									$extra = $extra . $ex . "Mode=".$_GET['Mode'];
									
								if(isset($_GET['Mode'])=="" && isset($_GET['Code'])=="")
									$extra = "";
							  ?>	
							 <?php 
								$ctr=1;
								while($dt_vastipatrak = mysqli_fetch_array($chk_vastipatrak))
								{
									$src = "signup.php?AncId=".$dt_vastipatrak['vasti_id'].$extra;
 							 ?>
							  <table width="98%"  border="0" cellspacing="0" bgcolor="#fbfbfb">
                                <tr>
                                  <td width="2%" class="text4_user"><div align="center"></div></td>
                                  <td width="47%" class="text4_user"><?php echo $dt_vastipatrak['fname_vc'] . " " . $dt_vastipatrak['mname_vc'] . " " . $dt_vastipatrak['lname_vc']; ?></td>
                                  <td width="17%" rowspan="3" class="text_user"><div align="center"><img src="" width="120" height="130" /></div></td>
                                  <td width="34%" rowspan="3" valign="top" style="padding-top:20px;"><table width="50%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="<?php echo $src; ?>" class="title1">Add  Record to Ancestor </a></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="#">View Family Tree </a></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user"><span class="text4_user">Native</span>: <?php echo $dt_vastipatrak['village_name']; ?></td>
                                  </tr>
                                <tr class="text">
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user"><span class="text4_user">Gotra</span>: <?php echo $dt_vastipatrak['gotra_name']; ?></td>
                                  </tr>
                                <tr class="text">
                                  <td height="8" colspan="4" class="text_user"></td>
                                </tr>
                                <tr class="text" >
                                  <td colspan="4" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                </tr>
								<tr bgcolor="#f2f2f2">
								  <td bgcolor="#FFFFFF">&nbsp;</td>
								  <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
								  <td align="left" colspan="2" valign="middle" bgcolor="#ffffff">&nbsp;</td>
								</tr>
                              </table>
							  <?php } ?>
							</td>
                          </tr>
						  
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="4"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="right" valign="top" class="text4_user">
                              <?php if(isset($maxpage)>1) { ?>
                              <div class="next">
                                <?php if($pageNum!=1) { ?>
                                <a href="#" onclick="doSubmit(<?php echo $pageNum-1; ?>);">
                                <?php } ?>
                                <font color="#000000" class="text4_user"><b>&lt;&lt;</b></font> Prev...                                <?php if($pageNum!=1) { ?>
                                </a>
                                <?php } ?>
                                <?php for($i=1;$i<=$maxpage;$i++) { ?>
                                <a href="#" onclick="doSubmit(<?php echo $i; ?>);" class="text1" style="text-decoration:none;"><?php echo $i;?></a> |
                                <?php } ?>
                                <?php if($pageNum!=$maxpage) { ?>
                                <a href="#" onclick="doSubmit(<?php echo $pageNum+1; ?>);">
                                <?php }?>
                                      ....Next <font color="#000000" class="text4_user"><b>&gt;&gt;</b></font>
                                <?php if($pageNum!=$maxpage) { ?>
                                </a>
                                <?php } ?>
                              </div>
                              <?php } ?></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
					</form>
					</td>
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
        <td height="20" align="center" valign="middle" bgcolor="#834153">&nbsp;</td>
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
