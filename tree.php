<?php

	include_once "admin/connection/conn.php";
include_once "mnu_main.php";

	function getSubFamily($cn,$pid)
	{
		$strsql = "select * from vastipatrak_m where f_id=" . $pid ." or h_id=" . $pid;
		$chkres = mysqli_query($cn,$strsql);
		$numres = mysqli_num_rows($chkres);		
		
		if ($numres==0)
		{
			return "";
		}
        $strHTML ="";
		$strHTML .= "<ul>";
			while($row = mysqli_fetch_array($chkres))
			{
				$strHTML .= "<li>" . $row['fname_vc']  . " " . $row['mname_vc']  . " " . $row['lname_vc'] . " " . "</li>";
				$strHTML .= getSubFamily($cn,$row['vasti_id']);
			}
		$strHTML .= "</ul>";

		return $strHTML;
	}
	
	function getTree($cn,$pid)
	{
		$strsql = "select * from vastipatrak_m where (parent_id=".$pid.") and ((f_id=".$pid." or h_id=".$pid.") or (f_id='' and h_id='')) ";
		$chkres = mysqli_query($cn,$strsql);
		$numres = mysqli_num_rows($chkres);		
		
		if ($numres==0)
		{
			return "";
		}
         $strHTML ="";
		$strHTML .= "<ul>";
			while($row = mysqli_fetch_array($chkres))
			{
				$strHTML .= "<li>" . $row['fname_vc']  . " " . $row['mname_vc']  . " " . $row['lname_vc'] . " " . "</li>";
				$strHTML .= getTree($cn,$row['vasti_id']);
				$strHTML .= getSubFamily($cn,$row['vasti_id']);
			}
		$strHTML .= "</ul>";

		return $strHTML;
	}

	function getTreeView($cn,$mid)
	{
		$strsql = "select * from vastipatrak_m where vasti_id=" . $mid;
		$chkres = mysqli_query($cn,$strsql);
		$numres = mysqli_num_rows($chkres);
		$strHTML="";
		$strHTML .= "<ul>";
			while($row = mysqli_fetch_array($chkres))
			{
				$strHTML .= "<li>" . $row['fname_vc']  . " " . $row['mname_vc']  . " " . $row['lname_vc'] . " " . "</li>";
				$strHTML .= getTree($cn,$row['vasti_id']);
			}
		$strHTML .= "</ul>";

		return $strHTML;
	}

	echo (getTreeView(50));
?>