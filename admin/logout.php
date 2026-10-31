<?php
	session_start();
	$_SESSION["UserLogin"] = "";
	$_SESSION["UserAdminCode"] = "";
	$_SESSION["UserCal"] = "";
	$_SESSION["UserMsg"] = "";
	session_destroy();
	$redirect="index.php";
	header("Location: $redirect");
?>
 