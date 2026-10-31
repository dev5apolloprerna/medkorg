<?php
include "connection/conn.php";
require "noentry.php";
// include "noentry.php";

require 'include/appmain.php';
require 'utility/querygen.inc';

$oQGen = new CQueryGen();
$oQGen1 = new CQueryGen();



//-------------MODE A------------------------
if (isset($_GET['Code'])) {

    $strsql = "update vastipatrak_m set death_date='',lineage=0  where vasti_id=" . $_GET['Code'];
    mysqli_query($cn, $strsql);


	redirect("lineage_list.php?HCode=0&level=0");
	exit;
}
?>
