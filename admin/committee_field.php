<?php
 include 'noentry.php';
 include "connection/conn.php";
	// require "noentry.php";
$ProdThumbImgDir = "images/gallery/committee/";
// Approve or disapproved Forum

if(isset($_POST['txtMode'])=='D')
{
	 
	$sql="Delete from committee_m WHERE comm_id = ".$_POST['txtDCode'];
 	$res=mysqli_query($cn,$sql) or die($sql);
	  //exit;
}
 

/****Paging*********/
    $sqlextra="";
  	$sql_string="select count(*) as totrec from committee_m $sqlextra";
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
  
$sql_comm="select n.comm_id,n.comm_name,n.comm_desc,n.thumb_image,n.comm_desig,n.sort_order,c.cat_name from 
		   committee_m n
		   left outer join products_cat c on n.cat_id = c.cat_id
		   order by n.sort_order $limit";

$check_comm=mysqli_query($cn,$sql_comm);
$numcomm=mysqli_num_rows($check_comm);

if($numcomm>0) 
{
	$comm_info=array();
	while($row=mysqli_fetch_assoc($check_comm))
	{
		$f['comm_id']=stripslashes($row['comm_id']);
		$f['cat_name']=stripslashes($row['cat_name']);
		$f['comm_name']=stripslashes($row['comm_name']);
		$f['comm_desc']=stripslashes($row['comm_desc']);
		$f['comm_desig']=stripslashes($row['comm_desig']);
		$f['thumb_image']=stripslashes($row['thumb_image']);
		$f['sort_order']=stripslashes($row['sort_order']);
		$comm_info[]=$f;
	}
 
}
 
// get Blog Information for updation
// get Blog Information

if(isset($_GET['Code']) && $_GET['Mode']=='E')
{
	$comm_id=$_REQUEST['Code'];
	//$sqlextra="where testimonial_id='".$testimonial_id."'";
  	$sql_string="select * from committee_m where comm_id='".$comm_id."' ";
	$check_res=mysqli_query($cn,$sql_string);
	$numb=mysqli_num_rows($check_res);

	if($numb>0) 
	{
		$comm=array();
		while($row=mysqli_fetch_assoc($check_res))
		{
			 $comm['comm_id']=$comm_id;
			 $comm['comm_name']=stripslashes($row['comm_name']);
			 $comm['cat_id']=stripslashes($row['cat_id']);
			 $comm['comm_desc']=stripslashes($row['comm_desc']);
			 $comm['comm_desig']=stripslashes($row['comm_desig']);
			 $comm['thumb_image']=stripslashes($row['thumb_image']);
			 $comm['sort_order']=stripslashes($row['sort_order']);
		}
		 
	 
	}
	 
} 
 

?>