<?php
	session_start();
	if ($_SESSION["UserCode"] == "")
	{
		$redirect="login.php";
		header("Location: $redirect");
		exit;
	 }
 ?>