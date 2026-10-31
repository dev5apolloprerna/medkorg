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
<table width="520" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"><table width="510" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" align="center" valign="middle" bgcolor="#834153">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" class="border1"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="10"></td>
                  </tr>
                  <?php if(!$_POST){ ?>
				  <tr>
                    <td align="left" class="border1"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#FFFFFF">
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;">Ancestors (Lineage) Search Form </td>
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
							<?php
							$ex = "?";
							if(isset($_GET['Code'])!="")
							{
								$extra = $ex . "Code=".$_GET['Code'];
								$ex = "&";
							}
							if(isset($_GET['Mode'])!="")
								$extra = $extra . $ex . "Mode=".$_GET['Mode'];
								
							if(isset($_GET['Mode'])=="" && isset($_GET['Code'])=="")
								$extra = "";
							
							$src = "lineage_result.php".$extra;
								
							?>	
							<form name="frmSearch" method="post" action="<?php echo $src; ?>">
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
                                <td width="18%" height="30" class="text4_user">&nbsp;</td>
                              <td width="1%" height="30" class="text4_user">&nbsp;</td>
                                <td width="81%" height="30" class="text4_user"><input type="submit" value="Click here to Search"></td>
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
                 <?php } ?>
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
 							 ?>
							  <table width="98%"  border="0" cellspacing="0" bgcolor="#fbfbfb">
                                <tr>
                                  <td width="2%" class="text4_user"><div align="center"></div></td>
                                  <td width="47%" class="text4_user"><?php echo $dt_vastipatrak['fname_vc'] . " " . $dt_vastipatrak['mname_vc'] . " " . $dt_vastipatrak['lname_vc']; ?></td>
                                  <td width="17%" rowspan="3" class="text_user"><div align="center"><img src="" width="120" height="130" /></div></td>
                                  <td width="34%" rowspan="3" valign="top" style="padding-top:20px;"><table width="50%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="#" class="title1" onClick="javascript:doAction('A','Add');">Add  Record to Ancestor </a></td>
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
            <td height="20" align="center" valign="middle" bgcolor="#834153">&nbsp;</td>
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