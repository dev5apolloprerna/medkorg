<?php
include "connection/conn.php";
	// require "noentry.php";
include "noentry.php";
	
require 'include/appmain.php';
require 'utility/querygen.inc';
$oQGen = new CQueryGen();
$oQGen1 = new CQueryGen();

// session_start();
$ProdThumbImgDir = "images/vastipatrak/thumb/";
$ProdLargeImgDir = "images/vastipatrak/attachment/";
	

if ($_POST["vasti_id"]=="")
{
	$varCode = isset($_GET['Code']) ? $_GET['Code'] :"";
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
			//if(in_array($key,$fieldarray) && trim($val)!="")
			if(in_array($key,$fieldarray))
			{	 
				$oQGen->addFieldValue($key,str_replace("'", "''",$val),"C");
			}
		}
		
		if($_FILES['thumb_image']!="")
		{
			$oQGen->addFieldValue("thumb_image",$TImage,"C");
		}					
		
		// Get Execution Statement
		if ($_POST["txtMode"]=="A"):
		{
			$sql_string = $oQGen->getInsert();
			$mode = "A";
		}	
		else :
		{
		    if($_POST['marital_id'] == 4){
                $sql = "select * from matrimony where user_id='".$_POST['vasti_id']."'";
                $res = mysqli_query($cn, $sql);
                if($res->num_rows > 0){
                    $sql = "delete from matrimony where user_id='".$_POST['vasti_id']."'";
                    $res = mysqli_query($cn, $sql);
                }
            }
			$oQGen->addConditionFieldValue("vasti_id",$_POST['vasti_id'],"C");
			$sql_string = $oQGen->getUpdate();
			$mode = "E";
		}
		endif;  
	//	echo $sql_string;exit;
		$code= db_execute($cn,$sql_string);
		if($code == "")
			$code = $_POST['vasti_id'];
		
		// Insert professional details in businessdir_m table //
		// Add data in user_master table
		// Begin get Fields of Tables
		if($_POST['prof_type']!="")
		{
			$sql="select * from businessdir_m where 1=2";
			$res=mysqli_query($cn,$sql);
		
			$fieldarray=array();
			
			while($fd=mysqli_fetch_field($res)):
				$fieldarray[]=$fd->name;
			endwhile;
			
			array_shift($fieldarray);// remove first element orderID
								 
			 // End get Fields of Tables
			
			$oQGen1->setTableName("businessdir_m"); // set the table name
			
			foreach($_POST as $key=>$val)
			{ 
				if($key == "vasti_id" && $val=="")
				{
					$val = $code;
				}

				if(in_array($key,$fieldarray) && trim($val)!="")
				{	 
					$oQGen1->addFieldValue($key,str_replace("'", "''",$val),"C");
				}
			}
								
			// first delete entry of current vasti_id and then insert updtaed record //
			$sql_del = "delete from businessdir_m where vasti_id=".$code;
			$chk_del = mysqli_query($cn,$sql_del);
			
			// Get Execution Statement
			$sql_string = $oQGen1->getInsert();
			$code1= db_execute($cn,$sql_string);
			
		}
		
		// Send notification to admin about changes in the vastipatrak data //
		$page = "family_details.php";
		redirect("vastipatrak_changes_notification.php?code=".$code."&page=".$page."&HCode=".$hcode."&level=".$level."&mode=".$mode);
		exit;
		
}
?>