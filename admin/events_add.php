<?php

include 'noentry.php';
 include "connection/conn.php";
	// require "noentry.php";
$err=""; 
$ProdThumbImgDir = "images/gallery/events/";
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
			$event_name = "";
			if(trim($_POST['event_name'])!="")
			{
				$event_name=mysqli_real_escape_string($cn,$_POST['event_name']);
			}
			if(trim($_POST['event_date'])!="")
			{
				$event_date=mysqli_real_escape_string($cn,$_POST['event_date']);
			}
			if(trim($_POST['event_type'])!="")
			{
				$event_type=mysqli_real_escape_string($cn,$_POST['event_type']);
			}  
			$cat_name = $_POST['cat_name'];
			
			if ($_POST["event_id"]=="" || $_POST["event_id"]==NULL)
			{	
				$sql_insert="Insert into events_m(event_name,event_date,event_type,thumb_image,cat_name)
				  values('".$event_name."','".$event_date."','".$event_type."','".$TImage."','".$cat_name."')"; 
					 
				$res=mysqli_query($cn,$sql_insert) or die(mysqli_error($cn));
				$insert_id=mysqli_insert_id($cn);
				
			}
			else
			{
				if($row['thumb_image']!="" && file_exists($ProdThumbImgDir.$row['thumb_image']))
				{
					unlink($ProdThumbImgDir.$row['thumb_image']);
				}
				
				$sql="update events_m set cat_name='".$cat_name."',event_name='".$event_name."',event_date='".$event_date."',event_type='".$event_type."' $imageuploadthumb where event_id='".$_POST['event_id']."'";
				
				 $res=mysqli_query($cn,$sql) or die(mysqli_error($cn));
				 
			
			}		 
					if($res>0)
					{
						  
						header("Location: list_events.php");
						exit;
					} 
}
?>
 