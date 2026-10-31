<?php

include 'noentry.php';
 include "connection/conn.php";
	// require "noentry.php";
$err=""; 
$ProdThumbImgDir = "images/gallery/testimonial/";
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
			 
			if(trim($_POST['testimonial_name'])!="")
			{
				$testimonial_name=mysqli_real_escape_string($cn,$_POST['testimonial_name']);
			}
			if(trim($_POST['testimonial_desc'])!="")
			{
				$testimonial_desc=mysqli_real_escape_string($cn,$_POST['testimonial_desc']);
			}  
			
			
			if ($_POST["testimonial_id"]=="" || $_POST["testimonial_id"]==NULL)
			{	
				 $sql_insert="Insert into testimonial_m(testimonial_name,testimonial_desc,thumb_image)
				  values('".$testimonial_name."','".$testimonial_desc."','".$TImage."')"; 
					 
				$res=mysqli_query($cn,$sql_insert) or die(mysqli_error($cn));
				$insert_id=mysqli_insert_id($cn);
				 
			}
			else
			{
				if($row['thumb_image']!="" && file_exists($ProdThumbImgDir.$row['thumb_image']))
				{
					unlink($ProdThumbImgDir.$row['thumb_image']);
				}
				
				$sql="update testimonial_m set testimonial_name='".$testimonial_name."',testimonial_desc='".$testimonial_desc."' $imageuploadthumb where testimonial_id='".$_POST['testimonial_id']."'";
				
				 $res=mysqli_query($cn,$sql) or die(mysqli_error($cn));
				 
			
			}		 
					if($res>0)
					{
						  
						header("Location: list_testimonial.php");
						exit;
					} 
}
?>
 