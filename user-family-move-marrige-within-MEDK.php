<?php
	include_once "admin/connection/conn.php";
	session_start();

	// Query for Village data //
	$sql_vill = "select * from village_m order by village_name";
	$chk_vill = mysqli_query($cn,$sql_vill);
	
	// Query for Village gotra //
	$sql_gotra = "select * from gotra_m order by gotra_name";
	$chk_gotra = mysqli_query($cn,$sql_gotra);
	$_GET['mode']="";
	if($_GET['mode'] == "Dir")
		$action = "user-dirsearch-result.php?dirid=".$_GET['dirid']."&dirnm=".$_GET['dirnm'];
	else
		$action = "user-vastipatrak-result.php";
		
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
		
		$sql_vastipatrak = "select vasti.*,v.village_name,g.gotra_name from vastipatrak_m vasti
							left outer join village_m v on vasti.village_id = v.village_id
							left outer join gotra_m g on vasti.gotra_id = g.gotra_id
							where (vasti.parent_id=0 or vasti.parent_id>0) $cond and lineage=1 order by vasti.vasti_id";
	 	$chk_vastipatrak = mysqli_query($cn,$sql_vastipatrak);
		$num_vastipatrak = mysqli_num_rows($chk_vastipatrak);
		
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
        <?php include_once "menu.php"; ?>
        </td>
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
                      

					  
							<tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#ffffff">
							<?php
							$ex = "?";
							$extra = "";
							// if(isset($_GET['vastiid'])!="")
							// {
							// 	$extra .= $ex . "Code=".$_GET['vastiid'];
							// 	$ex = "&";
							// }
							// if(isset($_GET['Mode'])!="")
							// 	$extra = $extra . $ex . "Mode=".$_GET['Mode'];
								
							// if($_GET['mode']!="")
							// 	$extra .= $ex . "mode=".$_GET['mode'];
							
							// if(isset($_GET['HCode'])!="")
							// 	$extra .= $ex . "HCode=".$_GET['HCode'];
									
							// if(isset($_GET['FId'])!="")
							// 	$extra .= $ex . "FId=".$_GET['FId'];

							// if(isset($_GET['HId'])!="")
							// 	$extra .= $ex . "HId=".$_GET['HId'];
                $extra .= $ex . "vastiid=".$_GET['vastiid'];
							// echo $extra . "1";
							// if(isset($_GET['Mode'])=="" && isset($_GET['Code'])=="")
							// 	$extra = "";
							// echo $extra. " 2";
							$src = "user-family-move-married-within-medk-result.php".$extra;
							// print_r($src);exit;
							?>	
							<form name="frmSearch" method="post" action="<?php echo $src; ?>">
							<input type="hidden" name="stype" value="<?php echo isset($_GET['stype']) ? $_GET['stype'] : ""; ?>">
							<input type="hidden" name="HId" value="<?php echo isset($_GET['HId']) ? $_GET['HId'] : 0; ?>">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							  <tr bgcolor="#fbfbfb" class="text">
                                <td height="20" colspan="3" class="text_user" style="padding-left:5px; font-weight: bold;">Personal Details</td>
							    </tr>
							  <tr bgcolor="#fbfbfb" class="text" >
                                <td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
							    </tr>
                              <tr class="text4_user">
                                <td height="30" colspan="3" class="text4_user"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr class="text4_user">
                                    <td width="25%" height="30" class="text4_user"><div align="right" class="style3">Village (Native Place) </div></td>
                                    <td width="2%" class="text4_user">&nbsp;</td>
                                    <td width="73%" class="text4_user">
                                      <span class="text2">
                                      <select name="village_id">
                                        <option value=""> Any Village </option>
                                        <?php
										while($vill = mysqli_fetch_array($chk_vill))
										{
										?>
                                        	<option value="<?php echo $vill['village_id']; ?>"> <?php echo $vill['village_name']; ?> </option>
                                        <?php 
										} ?>
                                      </select>
                                      </span>                                    </td>
                                  </tr>
                                  <tr class="text4_user">
                                    <td height="30" class="text4_user"><div align="right" class="style3">Gotra</div></td>
                                    <td class="text4_user">&nbsp;</td>
                                    <td class="text4_user">
                                      <span class="text2">
                                      <select name="gotra_id">
                                        <option value=""> Any Gotra </option>
                                        <?php
										while($gotra = mysqli_fetch_array($chk_gotra))
										{
										?>
                                        	<option value="<?php echo $gotra['gotra_id']; ?>"> <?php echo $gotra['gotra_name']; ?> </option>
                                        <?php 
										} 
										?>
                                      </select>
                                      </span>                                    
									</td>
                                  </tr>
                                  <tr class="text4_user">
                                    <td height="30" class="text4_user"><div align="right" class="style3">First Name </div></td>
                                    <td class="text4_user">&nbsp;</td>
                                    <td class="text4_user">
                                      <span class="text2">
                                      <input type="text" name="fname_vc" />
                                      </span>                                    </td>
                                  </tr>
                                  <tr class="text4_user">
                                    <td height="30" class="text4_user"><div align="right" class="style3">Last Name </div></td>
                                    <td class="text4_user">&nbsp;</td>
                                    <td class="text4_user">
                                      <span class="text2">
                                      <input type="text" name="lname_vc" />
                                      </span>                                    </td>
                                  </tr>
                                  <tr class="text4_user">
                                    <td height="30" class="text4_user"><div align="right" class="style3">Current Location </div></td>
                                    <td class="text4_user">&nbsp;</td>
                                    <td class="text4_user">
                                      <span class="text2">
                                      <input type="text" name="location" />
                                      </span><span class="text2"><span class="text">(Eg : City / State / Country)</span></span> </td>
                                  </tr>
                                </table></td>
                                </tr>
                              <tr class="text4_user">
                                <td width="25%" height="30" class="text4_user">&nbsp;</td>
                              <td width="2%" height="30" class="text4_user">&nbsp;</td>
                                <td width="73%" height="30" class="text4_user"><input type="submit" value="Click here to Search"></td>
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
                 
				 <?php
				 	if($_POST)
					{
				  ?> 
				  <tr>
                    <td height="10">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
                           <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="98%" colspan="5" align="left" valign="middle" bgcolor="#ffffff">
							 <?php 
								$ctr=1;
								while($dt_vastipatrak = mysqli_fetch_array($chk_vastipatrak))
								{
									if($_GET['mode']=="F" && $_GET['HId']!="")
										$fid = "&FId=".$dt_vastipatrak['vasti_id']."&HId=".$_GET['HId'];
									if($_GET['mode']=="F" && $_GET['HId']=="")
										$fid = "&FId=".$dt_vastipatrak['vasti_id'];
											
									if($_GET['mode']=="H" && $_GET['FId']!="") 	
										$hid = "&HId=".$dt_vastipatrak['vasti_id']."&FId=".$_GET['FId'];
									if($_GET['mode']=="H" && $_GET['FId']=="") 	
										$hid = "&HId=".$dt_vastipatrak['vasti_id'];
									
										
									$src = "signup.php?mode=".$_GET['mode']."&Code=".$_GET['Code']."&Mode=".$_GET['Mode']."&HCode=".$_GET['HCode'] . $fid . $hid;
 							 
 							 ?>
							  <table width="98%"  border="0" cellspacing="0" bgcolor="#fbfbfb">
                                <tr>
                                  <td width="2%" class="text4_user"><div align="center"></div></td>
                                  <td width="47%" class="text4_user"><?php echo $dt_vastipatrak['fname_vc'] . " " . $dt_vastipatrak['mname_vc'] . " " . $dt_vastipatrak['lname_vc']; ?></td>
                                  <td width="17%" rowspan="3" class="text_user"><div align="center"><img src="" width="120" height="130" /></div></td>
                                  <td width="34%" rowspan="3" valign="top" style="padding-top:20px;"><table width="50%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="<?php echo $src; ?>" class="title1">Link to Father</a></td>
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
						  
                        </table>
					</td>
                  </tr>
				  <?php
				 	}
				  ?> 
				  
                </table></td>
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