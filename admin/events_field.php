<?php
 include 'noentry.php';
 include "connection/conn.php";
	// require "noentry.php";
$ProdThumbImgDir = "images/gallery/events/";
// Approve or disapproved Forum

//  get  News category data //
 $sqlcategory= "select * from products_cat where cat_type='photogallery'";
 $check_category=mysqli_query($cn,$sqlcategory);
 $numcategory=mysqli_num_rows($check_category);


if($numcategory>0) 
{
	$category_info=array();
	while($row=mysqli_fetch_assoc($check_category))
	{
		$f['cat_id']=stripslashes($row['cat_id']);
		$f['cat_name']=stripslashes($row['cat_name']);
		$category_info[]=$f;
	}
}

if(isset($_POST['txtMode'])=='D')
{
	$sql="Delete from events_m WHERE event_id = ".$_POST['txtDCode'];
 	$res=mysqli_query($cn,$sql);
	
	header("Location:list_events.php");
	exit;
}
 

/****Paging*********/
  	$sql_string="select count(*) as totrec from events_m";
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
  
$sql_event="select n.event_id,n.event_name,n.event_type,n.event_date,n.thumb_image from events_m n order by n.event_name $limit";
$check_events=mysqli_query($cn,$sql_event);
$numevent=mysqli_num_rows($check_events);

if($numevent>0) 
{
	$event_info=array();
	while($row=mysqli_fetch_assoc($check_events))
	{
		$f['event_id']=stripslashes($row['event_id']);
		$f['event_name']=stripslashes($row['event_name']);
		$f['event_type']=stripslashes($row['event_type']);
		$f['event_date']=stripslashes($row['event_date']);
		$f['thumb_image']=stripslashes($row['thumb_image']);
		$f['cat_name']=stripslashes (isset($row['cat_name'])) ? $row['cat_name'] : "";
		$event_info[]=$f;
	}
 
}
 
// get Blog Information for updation
// get Blog Information

if(isset($_GET['Code']) && $_GET['Mode']=='E')
{
	$event_id=$_REQUEST['Code'];
	//$sqlextra="where testimonial_id='".$testimonial_id."'";
  	$sql_string="select * from events_m where event_id='".$event_id."' ";
	$check_res=mysqli_query($cn,$sql_string);
	$numb=mysqli_num_rows($check_res);

	if($numb>0) 
	{
		$event=array();
		while($row=mysqli_fetch_assoc($check_res))
		{
			 $event['event_id']=$event_id;
			 $event['event_name']=stripslashes($row['event_name']);
			 $event['event_type']=stripslashes($row['event_type']);
			 $event['event_date']=stripslashes($row['event_date']);
			 $event['thumb_image']=stripslashes($row['thumb_image']);
			 $event['cat_name']=stripslashes($row['cat_name']);
		}
		 
	 
	}
	 
} 
 

?>