<?php
	
include_once "noentry.php";
include_once "admin/connection/conn.php";

//get the code and name and if the person is a HOF or not and gender of the person
if (!$_POST)
{
	$vasti_id = $_GET['vastiid'];
	$fname = $_GET['fname'];
	$mname = $_GET['mname'];
	$lname = $_GET['lname'];
	$isHOF = $_GET['HOF'];
	$gender = $_GET['gender'];
}
else
{
	$vasti_id = $_POST['vastiid'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$isHOF = $_POST['HOF'];
	$gender = $_POST['gender'];


	exit;
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Shree Modasa Akeda Dasha Khadayat :::</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 14px}
.style2 {font-size: 13px}
-->
</style>
<script language="javascript" type="text/javascript">
function checkPswd(f)
{
	var ret = checkFormElements(f);
	
	if(ret)
	{
		if(document.getElementById("New Password ").value == document.getElementById("Confirm Password ").value)
		{
			return true;
		}
		else
		{
			alert("New Password and Confirm Password does not match");
			document.getElementById("Confirm Password ").focus();
			return false;
		}	
	}
	else
	{
		return false;
	}	 	
}
</script>
<script language="javascript" src="js/userjvalid.js"></script>
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
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="67%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;"><?php echo "Move " . $fname . " " . $mname . " " . $lname . " To..."; ?></td>
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
                            <td align="left" valign="middle" bgcolor="#ffffff">
							  <form action="user-family-move-requestHOF.php" method="post" name="frm" id="frm">
                                <input type="hidden" name="vastiid" value="<?php echo $vasti_id; ?>" />
                                <input type="hidden" name="fname" value="<?php echo $fname; ?>" />
                                <input type="hidden" name="mname" value="<?php echo $mname; ?>" />
                                <input type="hidden" name="lname" value="<?php echo $lname; ?>" />
                                <input type="hidden" name="HOF" value="<?php echo $isHOF; ?>" />
                                <input type="hidden" name="gender" value="<?php echo $gender; ?>" />
							    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							      <tr>
							        <td height="30" colspan="3" align="left" bgcolor="#F8F8F8" class="text4_user">New Location Address</td>
							        </tr>
							      <tr>
							        <td class="text" height="30" align="right"><strong>Line1</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td class="text"><input name="addr1" type="text" class="txtbox1" id="addr1" tabindex="9" value="" size="30" /></td>
							        </tr>
							      <tr>
							        <td class="text" height="30" align="right"><strong>Line2</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td class="text"><input name="addr2" type="text" class="txtbox1" id="addr2" tabindex="9" value="" size="30" /></td>
							        </tr>
							      <tr>
							        <td class="text" height="30" align="right"><strong>Line3</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td class="text"><input name="addr3" type="text" class="txtbox1" id="addr3" tabindex="9" value="" size="30" /></td>
							        </tr>
							      <tr>
							        <td class="text" height="30" align="right"><strong>Country</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td class="text"><select name="country" class="txtbox1" id="country" tabindex="12" <?php echo($vartxtcountry); ?> onchange="getState(this.value);">
							          <option value=""> Select Country </option>
							          <?php
																	while($country= mysql_fetch_array($chk_country))
																	{
																		if($country['country_id'] == $vartxtcountry)
																		{
																 ?>
							          <option value="<?php echo $country['country_id']; ?>" selected="selected"> <?php echo ucwords(strtolower($country['country_name'])); ?></option>
							          <?php }else{ ?>
							          <option value="<?php echo $country['country_id']; ?>"> <?php echo ucwords(strtolower($country['country_name'])); ?></option>
							          <?php } } ?>
							          </select></td>
							        </tr>
							      <tr>
							        <td class="text" height="30" align="right"><strong>State</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td class="text"><select name="state" class="txtbox1" id="State " tabindex="13"/>
							          </select></td>
							        </tr>
							      <tr>
							        <td class="text" height="30" align="right"><strong>Location</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td class="text"><select name="city" class="txtbox1" id="City " tabindex="14"/>
							          </select></td>
							        </tr>
							      <tr>
							        <td class="text" height="30" align="right"><strong>District</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td class="text"><input name="addr4" type="text" class="txtbox1" id="addr4" tabindex="9" value="" size="30" /></td>
							        </tr>
							      <tr>
							        <td class="text" height="30" align="right"><strong>Pincode</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td class="text"><input name="addr5" type="text" class="txtbox1" id="addr5" tabindex="9" value="" size="30" /></td>
							        </tr>
							      <tr>
							        <td class="text" height="30" align="right"><strong>Phone</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td class="text"><input name="addr6" type="text" class="txtbox1" id="addr6" tabindex="9" value="" size="30" /></td>
							        </tr>
							      
                                  <tr>
							        <td class="text" height="30" align="right"><strong>Mobile</strong></td>
							        <td class="text" align="right">&nbsp;</td>
							        <td align="left" class="text"><input name="addr7" type="text" class="txtbox1" id="addr7" tabindex="9" value="" size="30" /></td>
							        </tr>
                                  <tr>
                                    <td class="text" height="30" align="right" valign="top"><strong>Remark</strong></td>
                                    <td class="text" align="right">&nbsp;</td>
                                    <td align="left" class="text"><span class="sublink">
                                      <textarea name="prof_desc2" cols="25" rows="3" class="txtbox1" tabindex="48"><?php echo($prof_desc); ?></textarea>
                                    </span></td>
                                  </tr>
							      <tr>
							        <td class="text" height="30" align="right">&nbsp;</td>
							        <td class="text" align="right">&nbsp;</td>
							        <td align="left" class="text">&nbsp;</td>
							        </tr>
							      <tr>
							        <td height="30" colspan="3" align="left" bgcolor="#F8F8F8" class="text4_user">Members Moving With You</td>
							        </tr>
							      <tr>
							        <td height="30" colspan="3" align="left" class="text"><table width="50%" border="0" cellspacing="0" cellpadding="0">
							          <tr>
							            <td width="9%" align="center" valign="middle"><input name="chk" type="checkbox" id="chk" value="1" />
                                          <label for="chk"></label></td>
							            <td width="51%" height="40"><strong>Ramesh Pratik Shah</strong></td>
							            <td width="40%"><span class="text_user">
							              <select name="vasti_id2" id="vasti_id" tabindex="3" class="text">
							                <option>Relation Name</option>
							                </select>
							            </span></td>
							            </tr>
							          <tr>
							            <td align="center" valign="middle"><input name="chk2" type="checkbox" id="chk2" value="1" />
                                          <label for="chk2"></label></td>
							            <td height="40"><strong>Family Member2</strong></td>
							            <td><span class="text_user">
							              <select name="vasti_id3" id="vasti_id2" tabindex="3" class="text">
							                <option>Relation Name</option>
							                </select>
                                        </span></td>
							            </tr>
							          </table></td>
							        </tr>
							      <tr>
							        <td width="13%" class="text" height="30" align="left">&nbsp;</td>
							        <td width="1%" class="text" align="left">&nbsp;</td>
							        <td width="86%" align="left" class="text">&nbsp;</td>
							        </tr>
							      <tr>
							        <td height="10" colspan="3" align="center" class="text"></td>
							        </tr>
							      <tr>
							        <td height="30" align="center" class="text">&nbsp;</td>
							        <td align="center" class="text">&nbsp;</td>
							        <td class="text"><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" /> <input type="submit" name="btncancel" id="btncancel" value="Cancel" /></td>
							        </tr>
							      </table>
							  </form></td>
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
