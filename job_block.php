<?php
	require_once 'admin/connection/conn.php';
  $sql_select_job="select j.req_no,j.designation_vc,j.exper_min,j.exper_max,f.fun_value from search_jobs j,functional_m f  where f.fun_id=j.expertise_vc order by j.req_no desc limit 5";
	  $exec_select_job=mysqli_query($cn,$sql_select_job);
		 
		

?>
<marquee direction="up" width="220" height="150" scrollamount="2" onMouseOver="stop();" onMouseOut="start();">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
	<td height="8"></td>
  </tr> 
 
  <?php
  while($rec=mysqli_fetch_assoc($exec_select_job))
  {
  ?>
 
  <tr>
	<td class="text"> <a class="text4" style="text-decoration:none " href="job_details.php?Code=<?php echo $rec['req_no'] ?>"> <span class="text4">Designation :-</span> <?php echo $rec['designation_vc']?></a><br>
	<a style="text-decoration:none " href="job_details.php?Code=<?php echo $rec['req_no'] ?>" class="text">  <span class="txtbox">  Experience :-</span><?php echo $rec['exper_min'].'-'. $rec['exper_max']?> years  <br>
	  <span class="txtbox"> Functional Area :-</span>  <?php echo $rec['fun_value']?></a></td>
  </tr> 
  <tr>
	<td height="6"></td>
  </tr>
  <tr>
	<td height="1" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
	<td height="6"></td>
  </tr>
   
  <?php } ?> 
  <tr>
	<td height="6"></td>
  </tr> 
</table>
</marquee>