<?php
 require 'noentry.php';
 require 'connection/config.php';
 $imgdir = "images/advt/";

// Approve or disapproved Forum
 
if($_POST['txtMode']=='A' || $_POST['txtMode']=='IA')
{
	 	$code=implode(',',$_POST['chk']);  
	 	if($_POST['txtMode']=="A")
			$status=1; 
		else
			$status=0;		 
		 $res=changeStatus("advt_tbl","status","advt_id",$status,$code);
}

if($_POST['txtMode']=='D' || $_POST['txtMode']=='MD')
{
	  		$code=($_POST['txtMode']=="D")?$_POST['txtCode']:implode(',',$_POST['chk']);  
	 		
			// get All Questions of this test Details
			/*$sql="select que_id from question_tbl where sec_id in ($code)";
			$check_que=mysql_query($sql,$cn);
			while($tmp=mysql_fetch_assoc($check_que))
			{
				$que[]=$tmp['que_id'];
			}
			 
			if(is_array($que))
			{
				$question_ids=implode(',',$que);  
				 
				// Delete All Options of This Test
				//$res=executeDelete("option_tbl","que_id",$question_ids);	 
			}	 
				
				// Delete All Questions of This Test
				//$res=executeDelete("question_tbl","sec_id",$code);	 
			*/ 
			
			// Delete Image
			$res=deleteFile("advt_tbl",$imgdir,"advt_img","advt_id",$code);
			
			// Delete All Records
			$res=executeDelete("advt_tbl","advt_id",$code);	  
			
			 
} 
// get forum Information
 
if(isset($_GET['search_field']))
{
	$search_field=$_GET['search_field'];
	$search_value=$_GET['search_value']; 
	 
		$sqlextra.=" and s.$search_field like '".$search_value."%'";  
}


/* Paging*/
	$pageNum=1; 
	if(isset($_GET['pageid']))
		$pageNum=$_GET['pageid'];	
		
	$recperpage=$config['record_per_page'];
	  $condition=$sqlextra;
	  $totrecord=countRecord('advt_tbl',$condition);
	  $maxpage=getMaxPages($totrecord,$recperpage);
 	 $limit=getLimit($pageNum,$recperpage);
	 /* Paging*/

   
 
  $sql_string="select * from advt_tbl 
  				$sqlextra order by advt_id $limit";
 
$check_res=mysql_query($sql_string);
$numdetail=mysql_num_rows($check_res);

if($numdetail>0) 
{
	$detail_info=array();
	while($row=mysql_fetch_assoc($check_res))
	{
		$f['advt_id']=stripslashes($row['advt_id']);
		$f['advt_title']=stripslashes($row['advt_title']);
		$f['advt_img']=stripslashes($row['advt_img']);
		$f['advt_height']=stripslashes($row['advt_height']);
		$f['advt_link']=stripslashes($row['advt_link']);
		$f['status']=stripslashes($row['status']); 
		$detail_info[]=$f;
	}
 
}
 // get Blog Information for updation
// get Blog Information
if(isset($_GET['Code']) && $_GET['Mode']=='E')
{
	$advt_id=$_REQUEST['Code'];
	$sqlextra="where advt_id='".$advt_id."'";


  $sql_string="select * from advt_tbl $sqlextra";
$check_res=mysql_query($sql_string);
  
 $detail=mysql_fetch_assoc($check_res);
	 
} 
 

?>