<?php
ob_start();
$hostname = "localhost";
$username = "medkorg_medk_db";
$password = ")=J[R2WIzNnk";
$dbname = "medkorg_medk_ndb";

$persistent = 0;
// $con = mysqli_connect("$hostname","$username","$password","$dbname");	

/*$hostname="localhost";
	$username = "phpdev_samaj";
	$password = "!@#$%@@";
	$dbname = "phpdev_khadayat";
	$persistent = 0;
	 $cn = null; 
	*/

// $hostname="localhost";
// $username = "medk_samaj";
// $password = "!@#$%@@";
// $dbname = "medk_khadayat";
// $persistent = 0;
//  $cn = null; 


//master assignments
$mstarr['country'] = "select country_code, country_name from country_m order by country_name";
$mstarr['state'] = "select state_code, state_name from state_m order by state_name";
$mstarr['city'] = "select city_code, city_name from city_m order by city_name";
$mstarr['Project_city'] = "select city_name, city_name from city_m order by city_name";
$mstarr['area'] = "select area_code, area_name from area_m order by area_name";
$mstarr['property_type'] = "select property_type_code, property_type_name from property_type order by property_type_name";
$mstarr['property_project_type'] = "select property_type_name, property_type_name from property_type order by property_type_name";

//function to start the application and initialize the application settings
function appstart($hostname, $username, $password, $dbname, $persistent)
{
	//register the shutdown function to be fired
	register_shutdown_function('appstop');
	$GLOBALS['_DBMAIN'] = mysqli_connect($hostname, $username, $password, $dbname);

	$con = $GLOBALS['_DBMAIN'];

	//if the session is not set the start the session
	if (!isset($_SESSION)) {
		session_start();
	}

	//clean up all the server variables
	unset($GLOBALS['HTTP_COOKIE_VARS']);
	unset($GLOBALS['HTTP_ENV_VARS']);
	unset($GLOBALS['HTTP_GET_VARS']);
	unset($GLOBALS['HTTP_POST_FILES']);
	unset($GLOBALS['HTTP_POST_VARS']);
	unset($GLOBALS['HTTP_SERVER_VARS']);
	unset($GLOBALS['HTTP_SESSION_VARS']);
}




//execute the sql function
function db_execute($con = null, $strsql)
{
	if (!$con) $con = $GLOBALS['_DBMAIN'];
	$res = mysqli_query($con, $strsql) or die(mysqli_error($con));
	$insert_id = mysqli_insert_id($con);
	if (is_resource($res)) mysqli_free_result($res);
	return $insert_id;
}

//checkout pass by reference how it is done so that we can get the rowcount
function db_query($strsql, $rowcnt)
{
	if (!$con) $con = $GLOBALS['_DBMAIN'];
	$res = mysqli_query($con, $strsql) or die(mysqli_error($con));

	$rowcnt = mysqli_num_rows($res);
	return $res;
}

//returns an array of recordsets which can be accessed through the keys
function db_get_all($strsql)
{
	if (!$con) $con = $GLOBALS['_DBMAIN'];
	$res = mysqli_query($con, $strsql) or die(mysqli_error($con));

	$rs = array();
	while ($rec = mysqli_fetch_assoc($res)) {
		$rs[] = $rec;
	}

	mysqli_free_result($res);
	return $rs;
}

//returns a single value
function db_get_one($strsql)
{
	if (!$con) $con = $GLOBALS['_DBMAIN'];
	$res = mysqli_query($con, $strsql) or die(mysqli_error($con));
	$rs = mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	return $rs;
}

//returns the table structure
/*
	blob:         $meta->blob
	max_length:   $meta->max_length
	multiple_key: $meta->multiple_key
	name:         $meta->name
	not_null:     $meta->not_null
	numeric:      $meta->numeric
	primary_key:  $meta->primary_key
	table:        $meta->table
	type:         $meta->type
	default:      $meta->def
	unique_key:   $meta->unique_key
	unsigned:     $meta->unsigned
	zerofill:     $meta->zerofill
	*/
function db_get_table_structure($tablename)
{
	$strsql = "select * from " . $tablename . " where 1=2";

	$rsMeta = array();

	//if (!isset($con))
	$con = $GLOBALS['_DBMAIN'];

	$res = mysqli_query($con, $strsql) or die(mysqli_error($con));

	//get the columns metadata
	$i = 0;

	while ($i < mysqli_num_fields($res)) {
		$rsMeta[] = mysqli_fetch_field($res, $i);
		$i++;
	}

	mysqli_free_result($res);

	return $rsMeta;
}

function getMaxNumber($TableName, $FieldName)
{
	$strSQL = "SELECT Max(" . $FieldName . ") 'col' FROM " . $TableName;
	$rs = db_get_one($strSQL);

	if (count($rs) > 0)
		return $rs['col'] + 1;
	else
		return 1;
}

//this function will create options and provide for dropdown
function db_get_option($strsql, $selcode, $startOptions = "")
{

	if (!$con) $con = $GLOBALS['_DBMAIN'];
	$res = mysqli_query($con, $strsql) or die(mysqli_error($con));

	$stroptions = "";

	$stroptions = $startOptions;

	while ($rec = mysqli_fetch_array($res)) {
		if ($rec[0] == $selcode)
			$stroptions .= "<option selected value='" .  $rec[0] .  "'> " . $rec[1] . " </option>\n";
		else
			$stroptions .= "<option value='" .  $rec[0] .  "'> " . $rec[1] . " </option>\n";
	}

	return $stroptions;
}

//this function will help to create options
function db_get_selbox($strsql, $selname, $selcode, $width = 0, $startOptions = "")
{
	$strsel = "<select class='txtbox' tabindex='' id='" . $selname . "' name='" . $selname . "' ";
	if ($width > 0) {
		$strsel .= " style='width:" . $width . "px'";
	}
	$strsel .= ">";

	//fetch the options as well
	$strsel .= db_get_option($strsql, $selcode, $startOptions);
	$strsel .= "</select>";

	return $strsel;
}

//function to check login session
function isuserloggedin()
{
	if (!isset($_SESSION['usercode'])) {
		redirect("login.php");
		exit;
	}
}

//function to stop the application
function appstop()
{
	//close the session
	if (isset($_SESSION)) unset($_SESSION);

	//close the connection
	$connection = $GLOBALS['_DBMAIN'];
	mysqli_close($connection);
}
function redirect($url)
{
	header("Location: $url");
}
function getCurrency($n)
{
	ob_start();
	$len = strlen($n); //lenght of the no
	$num = substr($n, $len - 3, 3); //get the last 3 digits
	$n = substr($n, 0, $len - 3);

	while ($n > 0) //loop the process - further get digits 2 by 2
	{
		$len = strlen($n);
		$num = substr($n, $len - 2, 2) . "," . $num;
		$n = substr($n, 0, $len - 2);
	}
	return  $num;
}


appstart($hostname, $username, $password, $dbname, $persistent);
$cn = $GLOBALS['_DBMAIN'];
