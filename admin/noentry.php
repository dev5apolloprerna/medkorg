<?php
	session_start();
	
	if ($_SESSION["UserAdminCode"] == "")
	{
		$redirect="index.php";
		header("Location: $redirect");
		exit;
	 }
	
 ?>