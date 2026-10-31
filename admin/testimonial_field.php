<?php
include 'noentry.php';
 include "connection/conn.php";
	// require "noentry.php";
$ProdThumbImgDir = "images/gallery/testimonial/";
// Approve or disapproved Forum

if (isset($_POST['txtMode'])=='D')
{
	 
	$sql="Delete from testimonial_m WHERE testimonial_id = ".$_POST['txtDCode'];
 	$res=mysqli_query($cn,$sql) or die($sql);
	  //exit;
}
 

/****Paging*********/
$sqlextra="";
  	$sql_string="select count(*) as totrec from testimonial_m $sqlextra";
	$result=mysqli_query($cn,$sql_string);
	$tmp=mysqli_fetch_assoc($result);
	  $totrecord=$tmp['totrec'];
	$recperpage=10;
	  $maxpage=(int)($totrecord/$recperpage);
 
	$rem=$totrecord%$recperpage;
	if($rem>0)
		$maxpage++;
	
	$pageNum=1;
	 
	if(isset($_GET['pageid']))
		$pageNum=$_GET['pageid'];	
	 
	 $offset = ($pageNum - 1) * $recperpage;
	$limit="LIMIT $offset,$recperpage";
/********************************************************/	 
  
$sql_string="select n.testimonial_id,n.testimonial_name,n.testimonial_desc,n.thumb_image from testimonial_m n 
order by n.testimonial_name $limit";

$check_res=mysqli_query($cn,$sql_string);
$numtestimonial=mysqli_num_rows($check_res);

if($numtestimonial>0) 
{
	$testimonial_info=array();
	while($row=mysqli_fetch_assoc($check_res))
	{
		$f['testimonial_id']=stripslashes($row['testimonial_id']);
		$f['testimonial_name']=stripslashes($row['testimonial_name']);
		$f['testimonial_desc']=stripslashes($row['testimonial_desc']);
		$f['thumb_image']=stripslashes($row['thumb_image']);
		$testimonial_info[]=$f;
	}
 
}
 
// get Blog Information for updation
// get Blog Information

if(isset($_GET['Code']) && $_GET['Mode']=='E')
{
	$testimonial_id=$_REQUEST['Code'];
	//$sqlextra="where testimonial_id='".$testimonial_id."'";
  	$sql_string="select * from testimonial_m where testimonial_id='".$testimonial_id."' ";
	$check_res=mysqli_query($cn,$sql_string);
	$numb=mysqli_num_rows($check_res);

	if($numb>0) 
	{
		$testimonial=array();
		while($row=mysqli_fetch_assoc($check_res))
		{
			 $testimonial['testimonial_id']=$testimonial_id;
			 $testimonial['testimonial_name']=stripslashes($row['testimonial_name']);
			 $testimonial['testimonial_desc']=stripslashes($row['testimonial_desc']);
			 $testimonial['thumb_image']=stripslashes($row['thumb_image']);
		}
		 
	 
	}
	 
} 
 

?>