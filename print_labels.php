<?php

	include_once "admin/connection/conn.php";
	include_once "mnu_main.php";
    require("fpdf.php");   

   set_time_limit(0);

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
				return getHOF($cn,$res['parent_id']);
			}
		}
	}
	
	function getVastiIDToName($cn,$varid)
	{
		$strsql = "select fname_vc from vastipatrak_m where vasti_id=" . $varid;
		
		$chk_rs = mysqli_query($cn,$strsql);
		
		$varName = "";
		
		while($res = mysqli_fetch_array($chk_rs))
		{
			$varName = $res['fname_vc'];
		}
		
		return $varName;
	}

	function getQualName($cn,$varid)
	{
		if(trim($varid) == "")
			return "";
		
		echo $strsql = "select * from education_m where education_id =" . $varid;
		
		$chk_rs = mysqli_query($cn,$strsql);
		
		$varName = "";
		
		while($res = mysqli_fetch_array($chk_rs))
		{
			$varName = $res['education_name'];
		}
		
		echo $varName;
		
		return $varName;
	}
	
	//pass fathers vasti id
	function getMotherName($cn,$varid)
	{
		$strsql = "select fname_vc from vastipatrak_m where anc_id="  . $varid  . " and gender_c='Female' order by birth_date limit 1";
		
		$chk_rs = mysqli_query($cn,$strsql);
		
		$varName = "";
		
		while($res = mysqli_fetch_array($chk_rs))
		{
			$varName = $res['fname_vc'];
		}
		
		return $varName;
	}
	
	function getProfessionType($vartype)
	{
		switch($vartype)
		{
			case "B":
				return "Business";
				break;
			case "P":
				return "Profession";
				break;
			case "J":
				return "Job";
				break;
			case "H":
				return "Housewife";
				break;
			case "S":
				return "Student";
				break;
			case "R":
				return "Retired";
				break;
			default:
				return "Not Available";
				break;	
		}
	}
	
	
	function getCityName($cn,$varid,$varcode)
	{
		$strsql = "select city_name from city_m where city_id=" . $varid;

		$chk_rs = mysqli_query($cn,$strsql);

		$varName = "";
		
		while($res = mysqli_fetch_array($chk_rs))
		{
			$varName = $res['city_name'];
		}
		
		return $varName;
	}

	function getStateName($cn,$varid)
	{
		$strsql = "select state_name from state_m where state_id=" . $varid;
		
		$chk_rs = mysqli_query($cn,$strsql);
		$rowcnt = mysqli_num_rows($chk_rs);
		
		if ($rowcnt==0)
			return "";

		
		$varName = "";
		
		while($res = mysqli_fetch_array($chk_rs))
		{
			$varName = $res['state_name'];
		}
		
		return $varName;
	}

	function getCountryName($cn,$varid)
	{
		$strsql = "select country_name from country_m where country_id=" . $varid;
		
		$chk_rs = mysqli_query($cn,$strsql);
		$rowcnt = mysqli_num_rows($chk_rs);
		
		if ($rowcnt==0)
			return "";
		
		$varName = "";
		
		while($res = mysqli_fetch_array($chk_rs))
		{
			$varName = $res['country_name'];
		}
		
		return $varName;
	}


	$dir_code = $_GET['dirid'];
	$dir_nm = $_GET['dirnm'];
	
	$strsql = "select vasti_id from user_directory_records where dir_id=" . $dir_code;
	$arr_rs = mysqli_query($cn,$strsql);
	$rowcnt = mysqli_num_rows($arr_rs);
	
	
   $arrleft = Array();
   
	if ($rowcnt>0)
	{
		while ($rec = mysqli_fetch_assoc($arr_rs))
		{
			//get the first name of the person
			$strsql1 = "select * from vastipatrak_m where vasti_id = " . $rec['vasti_id'];
			
			$strsql1 = "select vasti_id, fname_vc, mname_vc, lname_vc, parent_id, anc_id, addr1, addr2, addr3, district, ifnull(state,0) as state, ifnull(city,0) as city, ifnull(country,0) as country, pincode, code_phone_number, phone_number, mobile_number,mobile_home from vastipatrak_m where vasti_id = " . $rec['vasti_id'];
			$arr_rec = mysqli_query($cn,$strsql1);
			$rowcnt1 = mysqli_num_rows($arr_rec);
			$rec_v = mysqli_fetch_array($arr_rec);
			
			if ($rowcnt1>0)
			{
				$arrrec = Array();

				$firstname = "";
				$middlename = "";
				$lastname = "";
				$address1 = "";
				$address2 = "";
				$district = "";
				$state = "";
				$city = "";
				$country = "";
				$pincode = "";
				$landline = "";
				$mobilenumber = "";				
				$isHOF = 0;

				//get the data for the current record
				$firstname = $rec_v['fname_vc'];

				//get the middle name
				if ($rec_v['anc_id'] != 0)
					$middlename = getVastiIDToName($cn,$rec_v['anc_id']);
				else
					$middlename = "";
					
				//get the last name. get the HOF
				if ($rec_v['parent_id'] != 0)
				{
					$isHOF = 0;
					$varHOF = getHOF($cn,$rec_v['parent_id']);
					
					$strsqlHOF = "select * from vastipatrak_m where vasti_id = " . $rec['vasti_id'];
					$arr_recHOF = mysqli_query($cn,$strsqlHOF);
					$rowcntHOF = mysqli_num_rows($arr_recHOF);
					
					if ($rowcntHOF>0)
					{
						$arrHOF = mysqli_fetch_array($arr_recHOF);
						
						//get the address information from HOF 
						$lastname = ucwords($arrHOF['lname_vc']);
						$address1 = ucwords($arrHOF['addr1']);
						$address2 = ucwords($arrHOF['addr2']);
						$address3 = ucwords(trim($arrHOF['addr3']));
						$district = ucwords(trim($arrHOF['district']));
						
						if ($arrHOF['state'] > 0)
							$state = ucwords(trim(getStateName($cn,$arrHOF['state'])));
							
						if ($arrHOF['city']>0 && $arrHOF['city']!="")
							$city = ucwords(trim(getCityName($cn,$arrHOF['city'],$rec['vasti_id'])));
							
						if ($arrHOF['country']>0)
							$country = ucwords(trim(getCountryName($cn,$arrHOF['country'])));
						
						$pincode = $arrHOF['pincode'];


						if ($arrHOF['code_phone_number'] !="")
							$landline =  $arrHOF['code_phone_number'] . "-" . $arrHOF['phone_number'];
						else
							$landline = $arrHOF['phone_number'];
					}
				}
				else
				{
					//since the person is head of family get the address details from this row itself
					$lastname = ucwords($rec_v['lname_vc']);
					$middlename = ucwords($rec_v['mname_vc']);
					$address1 = ucwords($rec_v['addr1']);
					$address2 = ucwords($rec_v['addr2']);
					$address3 = ucwords($rec_v['addr3']);
					$district = ucwords($rec_v['district']);
					
					if ($rec_v['state']>0)
						$state = ucwords(getStateName($cn,$rec_v['state']));
									
					if ($rec_v['city']>0 && $rec_v['city']!="")
						$city = ucwords(getCityName($cn,$rec_v['city'],$rec['vasti_id']));
					
					if ($rec_v['country']>0)
						$country = ucwords(getCountryName($cn,$rec_v['country']));
					
					$pincode = $rec_v['pincode'];

					if ($rec_v['code_phone_number'] !="")
						$landline =  $rec_v['code_phone_number'] . "-" . $rec_v['phone_number'];
					else
						$landline = $rec_v['phone_number'];
					
					$isHOF = 1;
				}
				
				$mobilenumber = $rec_v['mobile_number'].'|'.$rec_v['mobile_home'];
				
				//echo ($rec_v['vasti_id']. "<br>");
				

			   $arrrec["line1"] = $firstname . " " . $middlename . " " . $lastname;
			   $arrrec["line2"] = $address1;
			   $arrrec["line3"] = $address2;
			   if ($district == $city)
				$arrrec["line4"] = $address3;
			   else
				$arrrec["line4"] = $address3 . "," . $district;
			   if ($pincode !="")
				   $arrrec["line5"] = ucwords(strtolower($city . ", " . $state . "-" . $pincode . ","));
				else
					$arrrec["line5"] = ucwords(strtolower($city . ", " . $state . ","));
			   
				if ($landline != "" && $mobilenumber!="")
					$arrrec["line6"] = $country . "(" . $landline . "/ " . $mobilenumber . ")";
				else if ($mobilenumber!="")
					$arrrec["line6"] = $country . "(" . $mobilenumber . ")";
				else if ($landline!="")
					$arrrec["line6"] = $country . "(" . $landline . ")";
				else
					$arrrec["line6"] = $country . ".";
				
		   
			   $arrleft[] = $arrrec;
			}
		}
	
   $pdf = new FPDF('P','mm','A4');
   $pdf->AddPage();
   $pdf->SetMargins(0.25,0.25,0.5);
   $pdf->SetFont('Arial','B',10);

 $i=1;
 $reccnt = 0;
   foreach($arrleft as $row)
   {
	   if ($i==1)
		   $arr1 = $row;

	   if ($i==2)
		   $arr2 = $row;
		
		if ($i==2)
		{
			//now print the content in the pdf file
		   $pdf->ln(0);
		   $pdf->Cell(5);
		   $pdf->Cell(40,10,$arr1['line1'],0,0,'L');
		   $pdf->Cell(80);
		   $pdf->Cell(40,10,$arr2['line1']);
		   $pdf->ln(4);

		   $pdf->Cell(5);
		   $pdf->Cell(40,10,$arr1['line2']);
		   $pdf->Cell(80);
		   $pdf->Cell(40,10,$arr2['line2']);
		   $pdf->ln(4);

		   $pdf->Cell(5);
		   $pdf->Cell(40,10,$arr1['line3']);
		   $pdf->Cell(80);
		   $pdf->Cell(40,10,$arr2['line3']);
		   $pdf->ln(4);

		   $pdf->Cell(5);
		   $pdf->Cell(40,10,$arr1['line4']);
		   $pdf->Cell(80);
		   $pdf->Cell(40,10,$arr2['line4']);
		   $pdf->ln(4);

		   $pdf->Cell(5);
		   $pdf->Cell(40,10,$arr1['line5']);
		   $pdf->Cell(80);
		   $pdf->Cell(40,10,$arr2['line5']);
		   $pdf->ln(4);
			
		   $pdf->Cell(5);
		   $pdf->Cell(40,10,$arr1['line6']);
		   $pdf->Cell(80);
		   $pdf->Cell(40,10,$arr2['line6']);
		   $pdf->ln(4);

			$pdf->ln(9);
			
			unset($arr1);
			unset($arr2);
			
			$i = 0;
		}
		
		$i++;
		$reccnt ++;
		if ($reccnt % 16 ==0)
			$pdf->AddPage();
   }
	
   $pdf->Output();	
	}
	else
	{
			echo "No Data Found in directory";
			exit;
	}
?>