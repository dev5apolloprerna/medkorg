<?php

  //connection information goes here
	function getConnection($servername, $username, $password, $database)
	{
		$cn = mysqli_connect($servername, $username, $password, $database);

		return $cn;
	}
	
	function closeconnection($cn)
	{
		mysqli_close($cn) or die("connection could not be closed");
	}
?>