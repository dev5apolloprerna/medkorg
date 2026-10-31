<?php

	include_once "connection/conn.php";
	$imgdir = "admin/images/advertise/";
	
	// Advertisement Query
	$sql_advt_incl = "select * from advt_tbl order by RAND()";
	$chk_advt_incl = mysqli_query($cn,$sql_advt_incl);
	
?>

<!-- include jQuery library -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
 
<!-- include Cycle plugin -->
<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.2.74.js"></script>

<!--  initialize the slideshow when the DOM is ready -->
<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow1').cycle({
		fx: 'fade',
	 	before: ''
	});
});

</script>

<style type="text/css">
	.slideshow1 { height: 59px; width: 450px; margin: 0; display:none;}
	.slideshow1 img { padding: 0px; border: 0px solid #ccc; background-color: #eee; }
</style>

<table width="475" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="25" height="59">&nbsp;</td>
	<td height="59">
		<div class="slideshow1" id="advtid" style="width:450px;"top:0px;left:0px; margin:0 0;">
		<?php
			while($advt_incl = mysqli_fetch_array($chk_advt_incl))
			{
				if($advt_incl['file']!="")
				{
		 ?>
					<img src="<?php echo $imgdir.$advt_incl['file']; ?>" width="450" height="59">
  		<?php 	}
			}
		 ?>
		</div>
	</td>	
  </tr>
  <tr>
	<td height="7"></td>
	<td></td>
  </tr>
</table>

