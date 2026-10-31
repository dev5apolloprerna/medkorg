<?php
ob_start();
error_reporting(E_ALL);
include_once "admin/connection/conn.php";
require 'admin/include/appmain.php';
require 'admin/utility/querygen.inc';

if ($_GET['Mode'] == 'linkF') {

  // $sourceDatail = "select v.* from vastipatrak_m v	where vasti_id=" . $_REQUEST['vastiid'];
  // $resUserDetail = mysqli_fetch_assoc(mysqli_query($cn, $sourceDatail));
  // $destDetail = "select v.* from vastipatrak_m v	where vasti_id=" . $_REQUEST['dVastiId'];
  // $resdestDetail = mysqli_fetch_assoc(mysqli_query($cn, $destDetail));

  $query = "UPDATE vastipatrak_m set f_id =" . $_GET['dVastiid'] . ",maritalIn=1  WHERE vasti_id=" . $_GET['vastiid'];
  $chk_qurey = mysqli_query($cn, $query);

  header('location: user-familydet.php');
  
}
