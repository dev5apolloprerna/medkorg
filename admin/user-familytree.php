<?php

	include_once "noentry.php";
	include_once "connection/conn.php";
	
	// Get Details of current member //
	// ini_set('memory_limit', '16394b');

	  $sql_vastipatrak = "select vasti.*,(select village_m.village_name from village_m where village_m.village_id=vasti.village_id) as native,(select  gotra_m.gotra_name from gotra_m where gotra_m.gotra_id=vasti.gotra_id) as gotra from vastipatrak_m vasti where vasti_id=". $_GET['id'];
										
	$chk_vastipatrak = mysqli_query($cn,$sql_vastipatrak);
	$vp = mysqli_fetch_array($chk_vastipatrak);
	function getTree($cn,$pid)
	{

		 $strsql = "select * from vastipatrak_m where (anc_id=".$pid.") ORDER BY birth_date";
		$chkres = mysqli_query($cn,$strsql);
		$numres = mysqli_num_rows($chkres);		
		
		if ($numres==0)
		{
			return "";
		}

	    $strHTML="";
		$strHTML .= "<ul style='line-height:25px;'>";
		
		$ctr=1;
		while($row = mysqli_fetch_array($chkres))
		{
			// check if member has sub-family members //
			$sql_subfm = "select vasti_id from vastipatrak_m v
						  where v.anc_id=".$row['vasti_id'];
			$chk_subfm = mysqli_query($cn,$sql_subfm);
			$num_subfm = mysqli_num_rows($chk_subfm);
		
			
			// Get details of HOF/Husband to display incase of inner members //
			if($row['parent_id']!="0" && $row['anc_id']!="0")
			{
				$sql_hofdet = "select v.fname_vc,v.lname_vc,v1.lname_vc as parlname 
									from vastipatrak_m v
									left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
									 
							   where v.vasti_id=".$row['anc_id'];
			}
			else if($row['f_id']!="0" && $row['f_id']!="")
			{
				$sql_hofdet = "select v.fname_vc,v.lname_vc,v1.lname_vc as parlname 
									from vastipatrak_m v
									left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id 
							   where v.vasti_id=".$row['f_id'];
			}
			else
			{
				$sql_hofdet = "select v.fname_vc,v.lname_vc,v1.lname_vc as parlname from vastipatrak_m v
							   	left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id 
							   where v.vasti_id=".$row['parent_id'];
				// $flg == 1;
			}
			
			$chk_hofdet = mysqli_query($cn,$sql_hofdet);
			$det_hofdet = mysqli_fetch_array($chk_hofdet);
			if($row['mname_vc']!="")
				$mname = $row['mname_vc'];
			else
				$mname = $det_hofdet['fname_vc'];
			
			if($row['lname_vc']=="" && $det_hofdet['lname_vc']=="")
				$lname = $det_hofdet['parlname'];
			else if($row['lname_vc'] == "")
				$lname = $det_hofdet['lname_vc'];
			else
				$lname = $row['lname_vc'];
				
			if($row['lineage'] == 0)
			{
				$color = "#222222";
				$age = $row['birth_date']!="0000-00-00"?(date('Y') - date('Y', strtotime($row['birth_date'])))." yrs":$row['age']." yrs";
				$as_det = $row['gender_c'] . " / " . $age;
			}
			else
			{
				$color = "#ff0000";
				$as_det = $row['gender_c'];
			}		
			
			$id = $row["vasti_id"];
			$f_id = $row["f_id"];
			if($num_subfm >0)
			{
				//$strHTML .= "<li><span class='folder'><a href='user-full-profile.php?VId=$id' target='_blank'><font color='".$color."'>" . $row['fname_vc']  . "  " . $mname . " " . $lname . " " . " (" . $as_det . ") </font></a></span>";
				$strHTML .= "<li> <font color='".$color."'>" . $row['fname_vc']  . "  " . $mname . " " . $lname . " " . " (" . $as_det . ") </font>";
			}
			else
			{
				//$strHTML .= "<li><span class='file'><a href='user-full-profile.php?VId=$id' target='_blank'><font color='".$color."'>" . $row['fname_vc']  . "  " . $mname . " " . $lname . " " . " (" . $as_det . ") </font></a></span>";
				$strHTML .= "<li> <font color='".$color."'>" . $row['fname_vc']  . "  " . $mname . " " . $lname . " " . " (" . $as_det . ") </font></a></span>";
			}

			//if ($f_id!=0 && f_id!="")
					//$strHTML .= "&nbsp;&nbsp;&nbsp; <a href='user-familydet.php?vid=$f_id' target='_blank'><font color='".$color."'></font></a>";
			
			//<b> (View Father's Family) </b>
			
			$strHTML .=	"</li>";
			$strHTML .= getTree($cn,$row['vasti_id']);
	
			$ctr++;
		}
		$strHTML .= "</ul>";

		return $strHTML;
		
	}

	//$mid = vastipatrak id
	function getTreeView($cn,$mid)
	{
		$strsql = "select * from vastipatrak_m where vasti_id=" . $mid;
		$chkres = mysqli_query($cn,$strsql);
		$numres = mysqli_num_rows($chkres);
		$strHTML="";
		$strHTML .= "<ul style='line-height:25px;'>";
			while($row = mysqli_fetch_array($chkres))
			{
				$id = $row["vasti_id"];
				$anc_id = $row["anc_id"];
				$lineage = $row['lineage'];
				if($lineage == 0)
				{
					$color = "#3094bf";
					$age = $row['birth_date']!="0000-00-00"?(date('Y') - date('Y', strtotime($row['birth_date'])))." yrs":$row['age']." yrs";
					$as_det = $row['gender_c'] . " / " . $age;
				}
				else
				{
					$color = "#ff0000";
					$as_det = $row['gender_c'];
				}
				$strHTML .= "<li><a class='text' href='user-full-profile.php?VId=$id' target='_blank'><font color='".$color."'><b>" . $row['fname_vc']  . " " . $row['mname_vc']  . " " . $row['lname_vc'] . " " . "(".$as_det.")</b></font></a>";
				
				if ($anc_id>0)
					$strHTML .= "&nbsp;&nbsp;&nbsp; <a href='user-familytree.php?id=$anc_id' class='text'><font size='3' color='#000000'><b> /\ </b></font></a>";
				
				$strHTML .= "</li>";
				$strHTML .= getTree($cn,$row['vasti_id']);
			}
		$strHTML .= "</ul>";
		
		return $strHTML;
	}
											
											
											
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>::: Shree Modasa Akeda Dasha Khadayat :::</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color: #666666;">
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"><table width="1003" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top"><table width="1003" border="0" cellspacing="0" cellpadding="0">
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
                            <td width="67%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="texthead" style="padding-left:3px;">FAMILY TREE OF <?php echo $vp['fname_vc'] ." ".$vp['mname_vc'] ." ". $vp['lname_vc']; ?>

							<br/>
							Native: <?php echo $vp['native']?> , Gotra: <?php echo $vp['gotra']?>
						</td>
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
                            <td align="left" valign="middle" bgcolor="#ffffff"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="text">
                              <tr>
                                <td>
                                  <?php
										echo getTreeView($cn,$_GET['id']);
									 ?>
                                  </td>
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


</body>


</html>
