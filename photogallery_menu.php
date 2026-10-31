<?php 

include_once "admin/connection/conn.php";
include_once "mnu_main.php";

$thumbimgdir1 = "admin/images/gallery/thumb/";

$sql_associate = "select * from photo_gallary order by photo_id desc limit 10";
$chk_associate  = mysqli_query($cn,$sql_associate);
$assoc = array();
while($asso = mysqli_fetch_array($chk_associate))
{
	$a['photo_id'] = $asso['photo_id'];
	$a['thumb_image'] = $asso['thumb_image'];
	$assoc[] = $a;
}

?>

<!--  initialize the slideshow when the DOM is ready -->
<script type="text/javascript"> 
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'fade',
	 	before: onBefore
	});
});
 
function onBefore(currSlideElement, nextSlideElement, options, forwardFlag)
{
	
	obj = document.getElementById("cyclehead");
	
	//php //
	<?php
	  	foreach($assoc as $value)
	  	{
 	//php //
	
	// Javascript //
		echo 
		"if (nextSlideElement.id == " . $value['photo_id'] . ")
		{
			obj.innerHTML = '".$value['image_title']."'
		}";
	// Javascript //

	//php //
 	 } ?>
	//php //
	<!-- Loop ends here -->

}
</script>
 
<style type="text/css"> 
	.slideshow { height: 103px; width: 120px; margin: 0;}
	.slideshow img { padding: 0px; border: 0px solid #ccc; background-color: #eee; }
</style>



 <tr>
		<td width="229" height="110" valign="top" background="images/process.jpg" style="background-repeat:no-repeat"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td height="100" align="center" bgcolor="#FFFFFF">
			  <div class="slideshow"> 
			  
			  <?php
					
					  foreach($assoc as $val)
					  {
					  	
  			     ?>
					
					<img src="<?php echo $thumbimgdir1.$val['thumb_image']; ?>" alt="" width="120" height="103" id="<?php echo $val['photo_id'];  ?>"> 
					
			   <?php } ?>
			  </div></td>
			</tr>
			<tr>
			  <td height="29" align="center" bgcolor="#FFFFFF" class="download process" id="cyclehead"><b></b></td>
			</tr>
			
		</table></td>
	</tr>

