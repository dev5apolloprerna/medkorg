<?php

	session_start(); 
	require 'admin/connection/conn.php';
	if($_GET['act']=='getsubcat')
	{
		$data="";
		$catcode=$_REQUEST['catcode'];
		$subCat=$_REQUEST['subcode'];
	 	$cmbnm = $_REQUEST['cmbnm'];
		$oldcode = $_REQUEST['oldcode'];
		
		$strsql="select * from bdir_category where main_id='".$catcode."' order by group_name"; 
		$check_res=mysqli_query($cn,$strsql);
		
		$data.= "<select name=$cmbnm id=$cmbnm class='txtbox'>";
		$data.="<option value=\"0\">Please Select</option>";
		while($rec = mysqli_fetch_assoc($check_res))
		{
			if($oldcode==$rec['sub_id']) 
			$data.="<option selected value=\"{$rec['sub_id']}\">" . $rec['group_name'] . "</option>";
			else
			$data.="<option value=\"{$rec['sub_id']}\">" . $rec['group_name'] . "</option>";
		}
		 $data.="</select>";
		
		echo $data;
		exit;
		 
	}
	
if($_GET['act']=="getstate")
	{
		$data="";
		$countrycode=$_REQUEST['countrycode'];
		$statecode=$_REQUEST['statecode'];
		
		 
		$strsql="select * from state_m where country_id='".$countrycode."'  order by state_name"; 
		$check_res=mysqli_query($cn,$strsql);
		
// 		$data.= "<select name=\"state\" id=\"State\" class='txtbox1' tabindex='13' style='width:185px;' onchange='getCity(this.value);'>";
		$data.= "<select name=\"state\" id=\"State\" class='required_sel txtbox txtbox1 form-control select2' tabindex='13' style='width:185px;' onchange='getCity(this.value);'>";
		

		$data.="<option value=\"\">Select State</option>";
		while($rec = mysqli_fetch_assoc($check_res))
		{
			if($statecode == $rec['state_id'] || $statecode == $rec['state_id'])
			{
				$data.="<option value=\"{$rec['state_id']}\" selected>" . $rec['state_name'] .  "</option>";
			}
			else
			{
				$data.="<option value=\"{$rec['state_id']}\">" . $rec['state_name'] .  "</option>";
			}
		}
		$data.="</select>";
		echo $data;
	} 
	
	if($_GET['act']=="getcity")
	{
		$data="";
		$statecode=$_REQUEST['statecode'];
		$citycode=$_REQUEST['citycode'];
		 
		$strsql="select * from city_m where state_id='".$statecode."'  order by city_name"; 
		$check_res=mysqli_query($cn,$strsql);
		
		$data.= "<select name=\"city\" id=\"City\" class='required_sel txtbox txtbox1 form-control select2' tabindex='14' style='width:185px;'>";
		$data.="<option value=\"\">Select City</option>";
		while($rec = mysqli_fetch_assoc($check_res))
		{
			if($citycode == $rec['city_id'])
			{
				$data.="<option value=\"{$rec['city_id']}\" selected>" .  ucwords(strtolower($rec['city_name'])) . "</option>";
			}
			else
			{
				$data.="<option value=\"{$rec['city_id']}\">" . ucwords(strtolower($rec['city_name'])) . "</option>";
			}
		}
		$data.="</select>";
		echo $data;
	} 
	
	if($_GET['act']=="getjstate")
	{
		$data="";
		$countrycode=$_REQUEST['countrycode'];
		$statecode=$_REQUEST['statecode'];
		 
		$strsql="select * from state_m where country_id='".$countrycode."' order by state_name"; 
		$check_res=mysqli_query($cn,$strsql);
		
		$data.= "<select name=\"job_state\" id=\"State\" class='required_sel txtbox' style='width:185px;' onchange='getJobCity(this.value);'>";
		$data.="<option value=\"\">Select State</option>";
		while($rec = mysqli_fetch_assoc($check_res))
		{
			if($statecode == $rec['state_id'])
			{
				$data.="<option value=\"{$rec['state_id']}\" selected>" . ucwords(strtolower($rec['state_name'])) . "</option>";
			}
			else
			{
				$data.="<option value=\"{$rec['state_id']}\">" . ucwords(strtolower($rec['state_name'])) . "</option>";
			}
		}
		$data.="</select>";
		echo $data;
	} 
	
	if($_GET['act']=="getjcity")
	{
		$data="";
		$statecode=$_REQUEST['statecode'];
		$citycode=$_REQUEST['citycode'];
		 
		$strsql="select * from city_m where state_id='".$statecode."'  order by city_name"; 
		$check_res=mysqli_query($cn,$strsql);
		
		$data.= "<select name=\"job_city\" id=\"City\" class='required_sel txtbox' style='width:185px;'>";
		$data.="<option value=\"\">Select City</option>";
		while($rec = mysqli_fetch_assoc($check_res))
		{
			if($citycode == $rec['city_id'])
			{
				$data.="<option value=\"{$rec['city_id']}\" selected>" . ucwords(strtolower($rec['city_name'])) . "</option>";
			}
			else
			{
				$data.="<option value=\"{$rec['city_id']}\">" . ucwords(strtolower($rec['city_name'])) . "</option>";
			}
		}
		$data.="</select>";
		echo $data;
	} 

	if($_GET['act']=="getedudet")
	{
		$data="";
		$val=$_REQUEST['val'];
		 
		$strsql="select * from education_m where education_id ='".$val."'"; 
		$check_res=mysqli_query($cn,$strsql);
		$dt = mysqli_fetch_array($check_res);
		$data = $dt['show_det_field'];
		echo $data;
	} 
	
	if($_GET['act']=="chkuserexistence")
	{
		$data="";
		
		$fname=$_REQUEST['fname'];
		$mname=$_REQUEST['mname'];
		$lname=$_REQUEST['lname'];
		$native=$_REQUEST['native'];
		$gotra=$_REQUEST['gotra'];
		$dob=$_REQUEST['dob'];
		$email=$_REQUEST['email'];
		$mobile_home=$_REQUEST['mobile_home'];
		
		$strsql="select vasti.*,v1.*,v2.* from vastipatrak_m vasti 
					left outer join vastipatrak_m v1 on vasti.anc_id = v1.vasti_id
					left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
					
					left outer join village_m vill on vasti.village_id = vill.village_id
					left outer join village_m vill1 on v1.village_id = vill1.village_id
					left outer join village_m vill2 on v2.village_id = vill2.village_id
					
					left outer join gotra_m g on vasti.gotra_id = g.gotra_id
					left outer join gotra_m g1 on v1.gotra_id = g1.gotra_id
					left outer join gotra_m g2 on v2.gotra_id = g2.gotra_id
					
					where "; 
		$strsql .=	"LOWER(SUBSTRING(vasti.fname_vc,1,5)) = '".strtolower(substr($fname,0,5))."'"; 
		$strsql .=	" and (LOWER(SUBSTRING(vasti.mname_vc,1,5)) = '".strtolower(substr($mname,0,5))."' or LOWER(SUBSTRING(v1.fname_vc,1,5)) = '".strtolower(substr($mname,0,5))."')"; 
		$strsql .=	" and (LOWER(SUBSTRING(vasti.lname_vc,1,5)) = '".strtolower(substr($lname,0,5))."' or LOWER(SUBSTRING(v1.lname_vc,1,5)) = '".strtolower(substr($lname,0,5))."' or LOWER(SUBSTRING(v2.lname_vc,1,5)) = '".strtolower(substr($lname,0,5))."')"; 
		$strsql .=	" and (vasti.village_id = '".$native."' or v1.village_id = '".$native."' or v2.village_id = '".$native."')"; 
		$strsql .=	" and (vasti.gotra_id = '".$gotra."' or v1.gotra_id = '".$gotra."' or v2.gotra_id = '".$gotra."')"; 
		$strsql .=	" and vasti.birth_date = '".$dob."'"; 
		
		$ret = "true";
		
		$check_mobile=mysqli_query($cn,$strsql);
		$num_rows_mobile = mysqli_num_rows($check_mobile);
		if($num_rows_mobile > 0)
		{
			$ret = "false";
			echo $ret;
			exit;
		}		
		else
		{
			$ret = "true";
			echo $ret;
			exit;
		}

	} 
?>