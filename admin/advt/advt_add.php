<?php
session_start();
 	include "connection/config.php";
	require 'include/appmain.php';
	require 'utility/querygen.inc';
	$oQGen = new CQueryGen();
 	$ProdThumbImgDir = "images/advt/";
	
//$profile_id=($_POST['profile_id']!="")?$_POST['profile_id']:$_GET['Code'];

$err="";

// Query for Insert and Update
if ($_POST)
{ 
		 if($_FILES["advt_img"]["name"]!=""){
		$filename = $_FILES["advt_img"]["name"];
		$tofind = ".";
		$filename_len = strlen($filename);
		$position_num = strpos($filename,$tofind);
		$extension = substr("$filename",$position_num,$filename_len-$position_num);
		$sys_name = rand();
		$TImage = $sys_name.$extension;
		  $ProdThumbImgDir.$TImage;
		 
		
		  move_uploaded_file($_FILES["advt_img"]["tmp_name"],$ProdThumbImgDir.$TImage);
		 
		$imageuploadthumb=",advt_img='".$TImage."'";
		}
		 
		   // Begin get Fields of Tables
			  $sql="select * from advt_tbl where 1=2";
			  $res=mysql_query($sql);
			  $num = mysql_num_rows($res);
			  
			  $fieldarray=array();
			  while($fd=mysql_fetch_field($res)):
			   $fieldarray[]=$fd->name;
			  endwhile;
			  
			  array_shift($fieldarray);// remove first element orderID
			 
			 
		 // End get Fields of Tables
		 
		$oQGen->setTableName("advt_tbl"); // set the table name
		foreach($_POST as $key=>$val)
		{ 
			if(in_array($key,$fieldarray) && trim($val)!="")
			{	
				 
				 $oQGen->addFieldValue($key,$val,"C");
		 	}
		 }
		 if($_FILES['advt_img'])
		 {
			$oQGen->addFieldValue("advt_img",$TImage,"C");
		 }
			
			
		 // Email Verification Code
			
			if($_POST['advt_id']=="" || $_POST['advt_id']==NULL): 
				$sql_string = $oQGen->getInsert();
			else :
				$sql_edit = "select advt_img from advt_tbl where advt_id = '".$_POST['advt_id']."'";
				$chk_edit = mysql_query($sql_edit);
				$tmp = mysql_fetch_array($chk_edit);
				if($imageuploadthumb!="")
				{
					unlink($ProdThumbImgDir.$tmp['advt_img']); 
					$oQGen->addFieldValue("advt_img",$TImage,"C");
				}
				else
				{
					$oQGen->addFieldValue("advt_img",$tmp['advt_img'],"C");
				}
				
				$oQGen->addConditionFieldValue("advt_id",$_POST['advt_id'], "C");
				$sql_string = $oQGen->getUpdate();
			endif;  
			 
			 $code= db_execute($sql_string); 
				 
		 header("location: list_advt.php");
		 exit;
} 

 
?>