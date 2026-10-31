<?php
	include_once "admin/connection/conn.php";
	
	$sqlextra_mnu = "select menu_id,menu_name_vc from menu_m order by menu_id";
	$chk_mnu_main = mysqli_query($cn,$sqlextra_mnu);
	$numcat_mnu = mysqli_num_rows($chk_mnu_main);
	//
?>