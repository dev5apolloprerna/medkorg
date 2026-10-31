<?php
	
	//include_once "noentry.php";
	include_once "admin/connection/conn.php";
	include_once "header.php";
	function getHOF($cn,$varvastiid)
	{
		$strsql = "select * from vastipatrak_m where vasti_id=" . $varvastiid;
		$chk_rs = mysqli_query($cn,$strsql);
		
		while($res = mysqli_fetch_array($chk_rs))
		{
			if($res['parent_id']==0)
			{
				return $res['vasti_id'];
			}
			else
			{
				return getHOF($res['parent_id']);
			}
		}
	}
	
	// Query for Vasti Patrak Data //
	$cond = "";
	
	// Query for Village data //
	$sql_vill = "select * from village_m order by village_name";
	$chk_vill = mysqli_query($cn,$sql_vill);
	
	// Query for Village gotra //
	$sql_gotra = "select * from gotra_m order by gotra_name";
	$chk_gotra = mysqli_query($cn,$sql_gotra);

	if(isset($_GET['mode']) == "RS")
	{
		$UserEmail = $_SESSION["UserEmail"];
		$UserCode = $_SESSION["UserCode"];
		$VastiId = $_SESSION["VastiId"]; 
		$status = $_SESSION["status"]; 
		$Fname = $_SESSION["Fname"]; 
		$Mname = $_SESSION["Mname"];
		$Lname = $_SESSION["Lname"]; 
		$UserNm = $_SESSION["UserNm"]; 
		$UserCounrry = $_SESSION["UserCounrry"];
		$UserState = $_SESSION["UserState"];
		$UserCity = $_SESSION["UserCity"];
		$Fullname = $_SESSION["Fullname"];
		
		session_destroy();
		session_start();

		$_SESSION["UserEmail"] = $UserEmail;
		$_SESSION["UserCode"] = $UserCode;
		$_SESSION["VastiId"] = $VastiId; 
		$_SESSION["status"] = $status; 
		$_SESSION["Fname"] = $Fname; 
		$_SESSION["Mname"] = $Mname;
		$_SESSION["Lname"] = $Lname; 
		$_SESSION["UserNm"] = $UserNm; 
		$_SESSION["UserCounrry"] = $UserCounrry;
		$_SESSION["UserState"] = $UserState;
		$_SESSION["UserCity"] = $UserCity;
		$_SESSION["Fullname"] = $Fullname;

		header("Location:user-vastipatrak-search.php");
		exit;
	}

	if($_POST)
	{
		// echo "<pre>";
		// print_r($_POST);
		foreach($_POST as $key=>$val)
		{
			if($val != "")
			{
				if($key == "village_id")
				{
					$_SESSION['village_id'] = "";
					
					foreach($_POST['village_id'] as $key_vill=>$val_vill)
					{
						if($val_vill != "")
						 $_SESSION['village_id'] .= $val_vill . ",";
					}
					
					$_SESSION['village_id'] = substr($_SESSION['village_id'],0,strlen($_SESSION['village_id'])-1);
				}	
				
				if($key == "gotra_id")
				{
					$_SESSION['gotra_id'] = "";
					
					foreach($_POST['gotra_id'] as $key_got=>$val_got)
					{
						if($val_got != "")
						 $_SESSION['gotra_id'] .= $val_got . ",";
					}
					$_SESSION['gotra_id'] = substr($_SESSION['gotra_id'],0,strlen($_SESSION['gotra_id'])-1);
				}	

				if($key != "village_id" && 	$key != "gotra_id")			
				{
					$_SESSION[$key] = $val;
				}
			}
			
		}
		
		  
		if(isset($_POST['pagenum']))
		{
			$where_cnd = stripslashes($_POST['cond']);
		}
		else{
		
		$where = " and ";
		
		// Search By Professional Details //
		if(isset($_POST['country']) && $_POST['country']!="" && $_POST['country']!="0")
		{
			$cond .= $where . "(vasti.country = '".$_POST['country']."' or v1.country = '".$_POST['country']."')";
		}
		if(isset($_POST['state']) && $_POST['state']!="" && $_POST['state']!="0")
		{
			$cond .= $where . "(vasti.state = '".$_POST['state']."' or v1.state = '".$_POST['state']."')";
		}
		if(isset($_POST['city']) && $_POST['city']!="" && $_POST['city']!="0")
		{
			$cond .= $where . "(vasti.city = '".$_POST['city']."' or v1.city = '".$_POST['city']."')";
		}
		
		if(isset($_POST['village_id']))
		{
			$vid = implode(",",$_POST['village_id']);
			if($vid != "")
				$cond .= $where . "(vasti.village_id in (". implode(",",$_POST['village_id']) . ") or v1.village_id in (". implode(",",$_POST['village_id']) . "))";
		}	
		if(isset($_POST['gotra_id']))
		{
			$pid = implode(",",$_POST['gotra_id']);
			if ($pid != "")
				$cond .= $where . "(vasti.gotra_id in (".implode(",",$_POST['gotra_id']) . ") or v1.gotra_id in (".implode(",",$_POST['gotra_id']) . "))";
		}	
		if($_POST['fname_vc']!="")
		{
			$cond .= $where . "vasti.fname_vc like '%".$_POST['fname_vc']."%'";
		}	
		if($_POST['lname_vc']!="")
		{
			$cond .= $where . "vasti.lname_vc like '%".$_POST['lname_vc']."%'";
		}	
		if($_POST['email']!="")
		{
			$cond .= $where . "vasti.email like '%".$_POST['email']."%'";
		}	
		if($_POST['blood_group']!="")
		{
			$cond .= $where . "vasti.blood_group='".$_POST['blood_group']."'";
		}	
		if($_POST['gender_c']!="")
		{
			$cond .= $where . "vasti.gender_c='".$_POST['gender_c']."'";
		}
		if($_POST['marital_id']!="")
		{
			$cond .= $where . "vasti.marital_id='".$_POST['marital_id']."'";
		}
		// if($_POST['pincode']!="")
		// {
		// 	$cond .= $where . "vasti.pincode='".$_POST['pincode']."'";
		// }
		if($_POST['age_from']!="0" || $_POST['age_to']!="100")
		{
			if($_POST['age_from']!="")
				$age_from = $_POST['age_from'];
			else
				$age_from = "1";
			
			if($_POST['age_to']!="")
				$age_to = $_POST['age_to'];
			else
				$age_to = "200";
				
			$cond .= $where . "(DATEDIFF(NOW(),vasti.birth_date)/365) between ".$age_from." and ".$age_to;
		}
		
		if($_POST['basic_qual']!="")
		{
			$cond .= $where . "vasti.basic_qual ='".$_POST['basic_qual']."'";
		}
		if($_POST['pg_qual']!="")
		{
			$cond .= $where . "vasti.pg_qual ='".$_POST['pg_qual']."'";
		}
		if($_POST['doc_qual']!="")
		{
			$cond .= $where . "vasti.doc_qual ='".$_POST['doc_qual']."'";
		}
		
		
		// Search By Professional Details //
		
		if($_POST['prof_type']!="")
		{
			$cond .= $where . "bdir.prof_type like '%".$_POST['prof_type']."%'";
		}
		// Business //
		if($_POST['bness_cat_id']!="")
		{
			$cond .= $where . "bdir.bness_cat_id = '".$_POST['bness_cat_id']."'";
		}
		if($_POST['bness_subcat_id']!="")
		{
			$cond .= $where . "bdir.bness_subcat_id = '".$_POST['bness_subcat_id']."'";
		}
		if($_POST['bness_name']!="")
		{
			$cond .= $where . "bdir.bness_name = '".$_POST['bness_name']."'";
		}
		// Profession //
		if($_POST['prof_cat_id']!="")
		{
			$cond .= $where . "bdir.prof_cat_id = '".$_POST['prof_cat_id']."'";
		}
		if($_POST['prof_subcat_id']!="0")
		{
			$cond .= $where . "bdir.prof_subcat_id = '".$_POST['prof_subcat_id']."'";
		}
		// Business //
		if($_POST['job_type']!="")
		{
			$cond .= $where . "bdir.job_type = '".$_POST['job_type']."'";
		}
		if($_POST['job_ind_id']!="")
		{
			$cond .= $where . "bdir.job_ind_id = '".$_POST['job_ind_id']."'";
		}
		if($_POST['comp_name']!="")
		{
			$cond .= $where . "bdir.comp_name = '".$_POST['comp_name']."'";
		}
		
		if($_POST['selSearchType']!='IS')
			$where_cnd = "where vasti.lineage=0 and vasti.status in (0,1) and vasti.parent_id=0 ". $cond;
		else
		{
			$where_cnd = "where vasti.lineage=0 and vasti.status in (0,1) ". $cond;	
		}	 
		}
		//$where_cnd = $where_cnd . " and lineage=0 ";
		
		
		if(isset($_POST['selPagesNum']))
			$numpages = $_POST['selPagesNum'];
		else
			$numpages = "100";	
		
		if(isset($_POST['selPagesNum']))
		{
			//  PAGING	//
			
			 $sql_string="select count(*) as totrec
								 from vastipatrak_m vasti
									left outer join vastipatrak_m v1 on vasti.parent_id = v1.vasti_id
									left outer join village_m v on vasti.village_id = v.village_id
									left outer join gotra_m g on vasti.gotra_id = g.gotra_id
									left outer join marital_m m on vasti.marital_id = m.marital_id 
									left outer join businessdir_m bdir on vasti.vasti_id = bdir.vasti_id
									left outer join country_m country on vasti.country = country.country_id
									left outer join state_m state on vasti.state = state.state_id
									left outer join city_m city on vasti.city = city.city_id
										
										$where_cnd ";

			$result=mysqli_query($cn,$sql_string);
			$tmp=mysqli_fetch_assoc($result);
			$totrecord=$tmp['totrec'];
			$num_vastipatrak = $totrecord;
			$recperpage=$numpages;
			
			$maxpage=(int)($totrecord/$recperpage);
		 
			$rem=$totrecord%$recperpage;
			if($rem>0)
				$maxpage++;
			
			$pageNum=1;
			 
			if(isset($_POST['pagenum']))
				$pageNum=$_POST['pagenum'];	
			
			if($pageNum == "" || $pageNum=="undefined")
			{
				$pageNum = 1;
			}
				
			$offset = ($pageNum - 1) * $recperpage;
			$limit="LIMIT $offset,$recperpage";
		}
		else
		{
			$limit = "";
		}	
		
		$sql_vastipatrak = "select distinct vasti.*,
								v.village_name,g.gotra_name,m.marital_name,
								v1.gotra_id as pargotra,v1.village_id as parvillage, 
								bdir.prof_type,bness_cat_id,bness_subcat_id,bness_name,prof_cat_id,prof_subcat_id,comp_name, 
								country.country_name,state.state_name,city.city_name,
								country1.country_name as parcountry,state1.state_name as parstate,city1.city_name as parcity
								 
								from vastipatrak_m vasti
									left outer join vastipatrak_m v1 on vasti.parent_id = v1.vasti_id
									left outer join village_m v on vasti.village_id = v.village_id
									left outer join gotra_m g on vasti.gotra_id = g.gotra_id
									left outer join marital_m m on vasti.marital_id = m.marital_id 
									left outer join businessdir_m bdir on vasti.vasti_id = bdir.vasti_id
									
									left outer join country_m country on vasti.country = country.country_id
									left outer join country_m country1 on v1.country = country1.country_id
									
									left outer join state_m state on vasti.state = state.state_id
									left outer join state_m state1 on v1.state = state1.state_id
									
									left outer join city_m city on vasti.city = city.city_id
									left outer join city_m city1 on v1.city = city1.city_id
										
										$where_cnd order by vasti.fname_vc $limit";
		// echo  $sql_vastipatrak;exit;
		$chk_vastipatrak = mysqli_query($cn,$sql_vastipatrak);
		$num_vastipatrak = mysqli_num_rows($chk_vastipatrak);
	}	
	
?>
 <tr>
            <td align="center" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" class="border1"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="10"></td>
                  </tr>
                  <tr>
                    <td align="left" class="border1">
					<form action="user-vastipatrak-result.php" method="post" name="frmSearchBox" id="frmSearchBox">
                     <input type="hidden" name="txtMode">
					 <input type="hidden" name="dirid" value="<?php echo $_GET['dirid']; ?>"> 
					 <input type="hidden" name="dirnm" value="<?php echo $_GET['dirnm']; ?>">
					 <input type="hidden" name="pagenum" id="pagenum" value="<?php echo $pageNum; ?>">
					 <input type="hidden" name="cond" id="cond" value="<?php echo $where_cnd; ?>">
					 
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#FFFFFF">
                            <td colspan="3">&nbsp;</td>
                            </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="67%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;">VASTIPATRAK RESULT </td>
                          <td width="23%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;"><?php echo $num_vastipatrak; ?> RECORDS </td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#ffffff">
							 <?php 
								$ctr=1;
								while($dt_vastipatrak = mysqli_fetch_array($chk_vastipatrak))
								{
									// Get details of HOF/Husband to display incase of inner members //
									if($dt_vastipatrak['parent_id']!="0" && $dt_vastipatrak['anc_id']!="0")
									{

										$sql_hofdet = "select v.*,v1.lname_vc as parlname,
														g.gotra_name,g1.gotra_name as mainpargotra,
														city.city_name,city1.city_name as mainparcity, 
														state.state_name,state1.state_name as mainparstate, 			vill.village_name 
															from vastipatrak_m v 
													   left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
													   
													   left outer join state_m state on v.state = state.state_id
													   left outer join city_m city on v.city = city.city_id
													   left outer join state_m state1 on v1.state = state1.state_id
													   left outer join city_m city1 on v1.city = city1.city_id
													   
													   left outer join village_m vill on v.village_id = vill.village_id
													   left outer join gotra_m g on v.gotra_id = g.gotra_id
													    left outer join gotra_m g1 on v1.gotra_id = g1.gotra_id
													   where v.vasti_id=". $dt_vastipatrak['anc_id'];

										$chk_hofdet = mysqli_query($cn,$sql_hofdet);
										$det_hofdet = mysqli_fetch_array($chk_hofdet);
										
										$mname = $det_hofdet['fname_vc'];
										if($det_hofdet['lname_vc']!="")
											$lname = $det_hofdet['lname_vc'];
										else
											$lname = $det_hofdet['parlname'];

										$sql_hofdet = "select v.*,v1.lname_vc as parlname,
														g.gotra_name,g1.gotra_name as mainpargotra,
														city.city_name,city1.city_name as mainparcity, 
														state.state_name,state1.state_name as mainparstate, vill.village_name 
															from vastipatrak_m v 
													   left outer join vastipatrak_m v1 on v.anc_id = v1.vasti_id
													   
													   left outer join state_m state on v.state = state.state_id
													   left outer join city_m city on v.city = city.city_id
													   left outer join state_m state1 on v1.state = state1.state_id
													   left outer join city_m city1 on v1.city = city1.city_id
													   
													   left outer join village_m vill on v.village_id = vill.village_id
													   left outer join gotra_m g on v.gotra_id = g.gotra_id
													    left outer join gotra_m g1 on v1.gotra_id = g1.gotra_id
													   where v.vasti_id=". getHOF($cn,$dt_vastipatrak['parent_id']);
									
									
									$chk_hofdet = mysqli_query($cn,$sql_hofdet);
									$det_hofdet = mysqli_fetch_array($chk_hofdet);
									
									if($dt_vastipatrak['parent_id']!="0")
									{
										
										$id = $det_hofdet['vasti_id'];
										
										$addr1 = $det_hofdet['addr1'];
										$addr2 = $det_hofdet['addr2'];
										$addr3 = $det_hofdet['addr3'];
										$pincode = $det_hofdet['pincode'];
										
										$city = $det_hofdet['city_name'];
										if($city == "")
											$city = $det_hofdet['mainparcity'];
										
										$state = $det_hofdet['state_name'];
										if($state == "")
											$state = $det_hofdet['mainparstate'];
											
										$village = $det_hofdet['village_name'];
										
										$gotra = $det_hofdet['gotra_name'];
										if($gotra == "")
											$gotra = $det_hofdet['mainpargotra'];
											
									}
									}
									else
									{
										
										$sql_hofdet1 = "select v.*,v1.lname_vc as parlname,v1.fname_vc as parfname,v1.addr1 as paraddr1,v1.addr2 as paraddr2,v1.addr3 as paraddr3,v1.pincode as parpincode,
															g.gotra_name,g1.gotra_name as mainpargotra,
															city.city_name,city1.city_name as mainparcity, 
															state.state_name,state1.state_name as mainparstate,
															vill.village_name,vill1.village_name as mainparvill
															
																from vastipatrak_m v 
																
														   left outer join vastipatrak_m v1 on v.parent_id = v1.vasti_id
														   
														   left outer join state_m state on v.state = state.state_id
														   left outer join city_m city on v.city = city.city_id
														   left outer join state_m state1 on v1.state = state1.state_id
														   left outer join city_m city1 on v1.city = city1.city_id
														   
														   left outer join village_m vill on v.village_id = vill.village_id
														   left outer join village_m vill1 on v1.village_id = vill1.village_id
														   left outer join gotra_m g on v.gotra_id = g.gotra_id
														   left outer join gotra_m g1 on v1.gotra_id = g1.gotra_id
														   
														   where v1.vasti_id=". ($dt_vastipatrak['parent_id']);
										
										$chk_hofdet1 = mysqli_query($cn,$sql_hofdet1);
										$det_hofdet1 = mysqli_fetch_array($chk_hofdet1);
										
										if($dt_vastipatrak['mname_vc']=="")
											$mname = $det_hofdet1['parfname'];
										else
											$mname = $dt_vastipatrak['mname_vc'];
										
										if($dt_vastipatrak['lname_vc']=="")
											$lname = $det_hofdet1['parlname'];
										else
											$lname = $dt_vastipatrak['lname_vc'];
										
										if($dt_vastipatrak['parent_id']!=0)
											$id = $dt_vastipatrak['parent_id'];
										else
											$id = $dt_vastipatrak['vasti_id'];
										
										if($dt_vastipatrak['addr1']=="")
											$addr1 = $det_hofdet1['paraddr1'];
										else
											$addr1 = $dt_vastipatrak['addr1'];
										
										if($dt_vastipatrak['addr2']=="")
											$addr2 = $det_hofdet1['paraddr2'];
										else
											$addr2 = $dt_vastipatrak['addr2'];
										
										if($dt_vastipatrak['addr3']=="")
											$addr3 = $det_hofdet1['paraddr3'];
										else
											$addr3 = $dt_vastipatrak['addr3'];
										
										if($dt_vastipatrak['pincode']=="")
											$pincode = $det_hofdet1['parpincode'];
										else	
											$pincode = $dt_vastipatrak['pincode'];
										
										if($dt_vastipatrak['city_name']=="")
											$city = $det_hofdet1['mainparcity'];
										else
											$city = $dt_vastipatrak['city_name'];
										
										if($dt_vastipatrak['state_name']=="")
											$state = $det_hofdet1['mainparstate'];
										else
											$state = $dt_vastipatrak['state_name'];
										
										if($dt_vastipatrak['village_name']=="")
											$village = $det_hofdet1['mainparvill'];
										else
											$village = $dt_vastipatrak['village_name'];
										
										if($dt_vastipatrak['gotra_name']=="")
											$gotra = $det_hofdet1['mainpargotra'];
										else
											$gotra = $dt_vastipatrak['gotra_name'];
										
									}					
									
 							 ?>
							  <table width="98%"  border="0" cellspacing="0" bgcolor="#fbfbfb">
                                <tr>
                                  <td width="33%" class="text4_user"><?php echo $dt_vastipatrak['fname_vc'] . " " . $mname . " " . $lname; ?></td>
                                  <td width="33%" rowspan="4" class="text_user"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                      <?php if($addr1!=""){ ?>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td class="text_user"><?php echo $addr1; ?> </td>
                                      </tr>
                                      <?php } ?>
                                      <?php if($addr2!=""){ ?>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td class="text_user"><?php echo $addr2; ?></td>
                                      </tr>
                                      <?php } ?>
                                      <?php if($addr3!=""){ ?>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td class="text_user"><?php echo $addr3; ?></td>
                                      </tr>
                                      <?php } ?>
                                      <?php if($city!="" || $state!="" || $pincode!=""){ ?>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td class="text_user"><?php echo $city; ?>, <?php echo $state; ?> - <?php echo $pincode; ?>.</td>
                                      </tr>
                                      <?php } ?>
                                  </table></td>
                                  <td width="33%" rowspan="8" valign="top"><table width="60%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="user-full-profile.php?VId=<?php echo $dt_vastipatrak['vasti_id']; ?>" target="_blank">View Profile </a> <?php if($dt_vastipatrak['thumb_image']!=""){ ?> <img src="images/user.png" width="15" height="15"> <?php } ?></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="user-familydet.php?vid=<?php echo $id; ?>" target="_blank">View Family Details</a></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="user-familytree.php?id=<?php echo $id; ?>" target="_blank">View Family Tree </a></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><b>Last Updated On: <?php echo date('d-m-Y',strtotime($dt_vastipatrak['reg_date'])); ?> </b></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user"><?php echo $dt_vastipatrak['gender_c']; ?>, <?php echo (date('Y') - date('Y', strtotime($dt_vastipatrak['birth_date'])) ." yrs"); ?> </td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user"><?php echo $city; ?>.</td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user"><?php echo $dt_vastipatrak['marital_name']; ?></td>
                                </tr>
                                <tr class="text">
                                  <td height="10" rowspan="2" class="text_user">&nbsp;</td>
                                  <td class="text_user">&nbsp;</td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user"><span class="text4_user"><strong>M</strong>.</span> <?php 
										$extr = "";
										$mobno = "";
										
										if($dt_vastipatrak['mobile_home']!="" || $dt_vastipatrak['alt_mobile']!="")
										{
											if($dt_vastipatrak['mobile_home']!="")
											{
												$mobno = $dt_vastipatrak['mobile_home'];
												$extr = " / ";
											}
											if($dt_vastipatrak['alt_mobile']!="") 
												$mobno .= $extr . $dt_vastipatrak['alt_mobile'];	
										}
										else
											$mobno = "-";
										
										echo $mobno; 
									?></td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user"><span class="text4_user">Native</span>: <?php echo $village; ?></td>
                                  <td class="text_user"><span class="text4_user">Ph.</span>
                                      <?php 
										$extr = "";
										
										if($dt_vastipatrak['phone_number']!="" || $dt_vastipatrak['alt_number']!="")
										{
											if($dt_vastipatrak['phone_number']!="")
											{
												if($dt_vastipatrak['code_phone_number'] != "")
													$mobno1 = $dt_vastipatrak['code_phone_number'] . "-" . $dt_vastipatrak['phone_number'];
												else
													$mobno1 = $dt_vastipatrak['phone_number'];
												
												$extr = " / ";
											}
											if($dt_vastipatrak['alt_number']!="")
											{ 
												if($dt_vastipatrak['code_alt_number']!="")
													$mobno1 .= $extr . $dt_vastipatrak['code_alt_number'] . "-" . $dt_vastipatrak['alt_number'];	
												else
													$mobno1 .= $extr . $dt_vastipatrak['alt_number'];	
											}
										}
										else
											$mobno1 = "-";
										
										echo $mobno1; 
									?></td>
                                </tr>
								<tr class="text">
                                  <td class="text_user"><span class="text4_user">Gotra</span>: <?php echo $gotra; ?></td>
                                  <td class="text_user"><span class="text4_user"><strong>Email</strong></span>: 	
								  	<?php if($dt_vastipatrak['email']!=""){ ?>
										<a href="mailto:<?php echo $dt_vastipatrak['email']; ?>"><?php echo $dt_vastipatrak['email']; ?></a>
									<?php }else{ echo "-"; } ?>
								  </td>
                                </tr>
                                <tr class="text">
                                  <td height="8" colspan="3" class="text_user"></td>
                                </tr>
                                <tr class="text" >
                                  <td colspan="3" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                </tr>
								<tr bgcolor="#f2f2f2">
								  <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
								  <td align="left" colspan="2" valign="middle" bgcolor="#ffffff">&nbsp;</td>
								</tr>
                              </table>
							  <?php $ctr++; } ?>
							</td>
                          </tr>
						  
                        </table></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top">
                          <?php if(isset($maxpage)>1) { ?>
                          <div class="next">
                            <?php if($pageNum!=1) { ?>
                            <a href="#" class="text4_user" onclick="javascript:doSubmit(<?php echo $pageNum-1; ?>,'');">
                            <?php } ?>
                            <font color="#000000"><b>&lt;&lt;</b></font> Prev...
                            <?php if($pageNum!=1) { ?>
                            </a>
                            <?php } ?>
                            <?php for($i=1;$i<=$maxpage;$i++) { 
								if($i == $pageNum)
								{
							?>
                            <b><font color="#000000">
							<a href="#" onclick="javascript:doSubmit(<?php echo $i; ?>,'');" class="text4_user" style="text-decoration:none;"><?php echo $i;?></a> 
                            </font></b>|
							<?php }else{ ?>
							<b> <a href="#" onclick="javascript:doSubmit(<?php echo $i; ?>,'');" class="text1" style="text-decoration:none;"><?php echo $i;?></a> </b>|
                            <?php } } ?>
							<?php if($pageNum!=$maxpage) { ?>
                            <a href="#" onclick="javascript:doSubmit(<?php echo $pageNum+1; ?>,'');" class="text4_user">
                            <?php }?>
							  ....Next <font color="#000000" class="text4_user"><b>&gt;&gt;</b></font>
							  <?php if($pageNum!=$maxpage) { ?>
                            </a>
                            <?php } ?>
                          </div>
                          <?php } ?></td>
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
      <?php 
      include_once "footer.php";
      ?>
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
//disableSelection(somediv) //disable text selection within DIV with id="mydiv"
</script><script type="text/javascript">
var alltables=document.getElementsByTagName("table")
for (var i=0; i<alltables.length; i++)
 disableSelection(alltables[i]) //disable text selection within all tables on the page
</script>