<?php

	include_once "admin/connection/conn.php";
include_once "mnu_main.php";

	function sqltocsv($strhead,$strsql)
	{
		$chkres = mysqli_query($cn,$strsql);
		$numres = mysqli_num_rows($chkres);		

		$strcsv="";
		$strcsv = $strhead . "\n";

		$rs = array();
		while ($rec = mysqli_fetch_assoc($chkres))
		{
			$rs[] = $rec;
		}
		
		foreach($rs as $row)
		{
			$row_data = "";
			foreach($row as $col)
			{
				$row_data .= '"'. $col . '"';

				if ($row_data<>"")
					$row_data .= ",";
			}
			$strcsv .= $row_data . "\n";
		}

		return $strcsv;
	}
	
	$strsql = "select fname_vc, mname_vc, lname_vc, addr1, addr2, addr3, country, state, city, district, pincode, mobile_number, email, birth_date from vastipatrak_m order by fname_vc, mname_vc, lname_vc";
	
	$strhead = '"First Name","Middle Name","Last Name","Address1","Address2","Address3","Country","State","City","District","Pincode","Mobile Number","Email ID","Birth Date"';
	echo(sqltocsv($strhead,$strsql));
?>