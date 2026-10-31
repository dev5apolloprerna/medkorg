<?php
include_once "admin/connection/conn.php";
	
require 'admin/include/appmain.php';
require 'admin/utility/querygen.inc';
$oQGen = new CQueryGen();
	
session_start();
$ProdThumbImgDir = "admin/images/vastipatrak/thumb/";
$ProdLargeImgDir = "admin/images/vastipatrak/attachment/";
	

if ($_POST["vasti_id"]=="")
{
	$varCode = $_GET['Code'];
}
else
{
	$varCode = $_POST['vasti_id'];
}
if($_GET['level']!="")
{
	$level = $_GET['level'];
}
else
{
	$level = "";
}
	
if($_GET['HCode']!="")
{
	$hcode = $_GET['HCode'];
}
else
{
	$hcode = "";
}
if($_POST['txtMode']!="")
{
	$varMode = $_POST['txtMode'];
}
else
{
	$varMode = $_GET['Mode'];
}

//-------------MODE A------------------------
if ($_POST)
{
	if($_FILES["thumb_image"]["name"]!="")
	{
		$filename = $_FILES["thumb_image"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage = $sys_name.$extension;
		$ProdThumbImgDir.$TImage;
		  
		  move_uploaded_file($_FILES["thumb_image"]["tmp_name"],$ProdThumbImgDir.$TImage);
		  $imageuploadthumb=",thumb_image='".$TImage."'";
	}
	
	if($_FILES["attachment"]["name"]!="")
	{
		$filename = $_FILES["attachment"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$EImage = $sys_name.$extension;
		move_uploaded_file($_FILES["attachment"]["tmp_name"],$ProdLargeImgDir.$EImage);
		$imageuploadlarge=",attachment='".$EImage."'";
	}
	
		
		// Add data in user_master table
		// Begin get Fields of Tables
		$sql="select * from vastipatrak_m where 1=2";
		$res=mysqli_query($cn,$sql);

		$fieldarray=array();
		
		while($fd=mysqli_fetch_field($res)):
			$fieldarray[]=$fd->name;
		endwhile;
		
		array_shift($fieldarray);// remove first element orderID
							 
		 // End get Fields of Tables
		
		$oQGen->setTableName("vastipatrak_m"); // set the table name
		
		foreach($_POST as $key=>$val)
		{ 
			if($key == "vasti_id")
			{
				$val = $_POST['vasti_id'];
			} 
			if(in_array($key,$fieldarray) && trim($val)!="")
			{	 
				$oQGen->addFieldValue($key,$val,"C");
			}
		}
		
		if($_FILES['thumb_image']!="")
		{
			$oQGen->addFieldValue("thumb_image",$TImage,"C");
		}
							
		// Get Execution Statement
		if ($_POST["txtMode2"]=="A"):
			$sql_string = $oQGen->getInsert();
		else :
			$oQGen->addConditionFieldValue("vasti_id",$_POST['vasti_id'],"C");
			$sql_string = $oQGen->getUpdate();
		endif;  
		
		$code= db_execute($cn,$sql_string);
		
		redirect("user-familydet.php?HCode=".$hcode."&level=".$level);
		exit;
		
}
?>