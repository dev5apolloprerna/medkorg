<?php

include 'noentry.php';
 include "connection/conn.php";
	// require "noentry.php";
$err=""; 
$ProdThumbImgDir = "images/gallery/committee/";
// Query for Insert and Update
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

			//$sql_string="select count(*) from" 
			 
			if(trim($_POST['comm_name'])!="")
			{
				$comm_name=mysqli_real_escape_string($cn,$_POST['comm_name']);
			}
			if(trim($_POST['comm_desc'])!="")
			{
				$comm_desc=mysqli_real_escape_string($cn,$_POST['comm_desc']);
			} 
			if(trim($_POST['comm_desig'])!="")
			{
				$comm_desig=mysqli_real_escape_string($cn,$_POST['comm_desig']);
			}
			if(trim($_POST['sort_order'])!="")
			{
				$sort_order=mysqli_real_escape_string($cn,$_POST['sort_order']);
			}  
			$cat_name = $_POST['cat_name'];
			
			if ($_POST["comm_id"]=="" || $_POST["comm_id"]==NULL)
			{	
				 $sql_insert="Insert into committee_m(cat_id,comm_name,comm_desc,comm_desig,thumb_image,sort_order)
				  values('".$cat_name."','".$comm_name."','".$comm_desc."','".$comm_desig."','".$TImage."','".$sort_order."')"; 
					 
				$res=mysqli_query($cn,$sql_insert) or die(mysqli_error($cn));
				$insert_id=mysqli_insert_id($cn);
				 
			}
			else
			{
				if($row['thumb_image']!="" && file_exists($ProdThumbImgDir.$row['thumb_image']))
				{
					unlink($ProdThumbImgDir.$row['thumb_image']);
				}
				
				$sql="update committee_m set cat_id='".$cat_name."',comm_name='".$comm_name."',comm_desc='".$comm_desc."',comm_desig='".$comm_desig."',sort_order='".$sort_order."' $imageuploadthumb where comm_id='".$_POST['comm_id']."'";
				
				 $res=mysqli_query($cn,$sql) or die(mysqli_error($cn));
				 
			
			}		 
					if($res>0)
					{
						  
						header("Location: list_committee.php");
						exit;
					} 
}
?>
 