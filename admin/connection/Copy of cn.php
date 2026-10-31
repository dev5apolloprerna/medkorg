<?php
	function getConnection($servername, $username, $password, $database)
	{
		$cn = mysqli_connect($servername, $username, $password);
		mysqli_select_db($database,$cn);
		return $cn;
	}
	
	function closeconnection($cn)
	{
		mysqli_close($cn) or die("connection could not be closed");
	}
?>