<?php
	require_once 'admin/connection/conn.php';
  $sql_select_job="select * from committee_m";
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
	<td class="text"> <a class="text4" style="text-decoration:none " href="comm_details.php?Code=<?php echo $rec['comm_id'] ?>"> <b><?php echo $rec['comm_name']?></b></a><br>
	<a style="text-decoration:none " href="comm_details.php?Code=<?php echo $rec['comm_id'] ?>" class="text">  <span class="txtbox">  </span>    <?php echo $rec['comm_desig']?></a></td>
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