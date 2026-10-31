<?php
	include_once "admin/connection/conn.php";
	include  "mnu_main.php";
  include_once "header.php";
	$thumbimgdir = "admin/images/gallery/thumb/";
	$largeimgdir = "admin/images/gallery/large/";
	
	//  get  News category data //

		$sqlcategory= "select * from products_cat where cat_type='photogallery' order by txtdefault desc ";
		$check_category=mysqli_query($cn,$sqlcategory);
	$numcategory=mysqli_num_rows($check_category);
	$thumbimagedir = "admin/images/gallery/committee/";
	$largeimagedir = "admin/images/gallery/committee/";
	$extra = "";
	
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
	else
	{
		$category_info[0]['cat_id'] = "0";
	}
	
	if($_POST)
	{
		$cond = $_POST['cat_name'];
	}
	else if(isset($_GET['id']) && $_GET['id']!="")
	{
		$cond = $_GET['id'];
	}
	else
	{
		$cond = $category_info[0]['cat_id'];
	}
	
	$sql_string="SELECT count(*) as totrec FROM photo_gallary where cat_id=".$cond;
	$result=mysqli_query($cn,$sql_string);
	$tmp=mysqli_fetch_assoc($result);
	  $totrecord=$tmp['totrec'];
	$recperpage=51;
	  $maxpage=(int)($totrecord/$recperpage);
 
	$rem=$totrecord%$recperpage;
	if($rem>0)
		$maxpage++;
	
	$pageNum=1;
	 
	if(isset($_GET['pageid']))
		$pageNum=$_GET['pageid'];	
	 
	 $offset = ($pageNum - 1) * $recperpage;
	$limit="LIMIT $offset,$recperpage";
	
	// Paging ends // 
	
	$sql_imgs = "select * from photo_gallary where cat_id=".$cond." order by photo_id $limit";
	$chk_imgs = mysqli_query($cn,$sql_imgs);
?>


                  <tr>
                    <td align="center" valign="top" class="border1">
					<form name="frm" method="post" action="photo_gallery.php">
					<table width="96%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#F8F8F8">&nbsp;</td>
                            <td height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="title">Photo Gallery </td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="13%" class="text2">Select an Album </td>
                            <td width="87%" align="left" class="text2"><span class="form_field">
                            
                              <select name= "cat_name" id="cat_name" class="txtbox" onchange="getList();">
                                <?php if($numcategory <=0){  ?>
                                <option value="0"> Please Select a Year </option>
                                <?php }else{ ?>
                                <?php foreach($category_info as $val){ 
											if($cond==$val['cat_id']) { ?>
                                <option value="<?php echo $val['cat_id']; ?>" selected="selected"><?php echo $val['cat_name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $val['cat_id']; ?>"><?php echo $val['cat_name']; ?></option>
                                <?php } } } ?>
                              </select>
                            </span> </td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="2%">&nbsp;</td>
                      <td width="98%">
					  <table width="95%" border="0" align="right" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="text1"></td>
                        </tr>
                        <tr>
                          <td height="30" align="left">
						  <div id="gallery">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <?php 
							$ctr=0;
							while($row=mysqli_fetch_array($chk_imgs))
							{
								if($ctr!=0 && $ctr%3==0)
								{
									echo '</tr><tr>
									 <tr>
                                		<td height="35" colspan="5" background="images/dotline.jpg" style="background-repeat:repeat-x;">&nbsp;</td>
                             		 </tr>';	
									
								}
						   ?>
                                <td><table width="191" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <div class="highslide-gallery">
                                      <td height="156" align="left" valign="top" background="images/photo-bg.jpg" style="padding:9px 0px 0px 9px; background-repeat:repeat-x;"><a href="<?php echo $largeimgdir.$row['large_image']; ?>" class="highslide" onClick="return hs.expand(this)" title="<?php echo isset($row['prod_name']) ? $row['prod_name'] : ""; ?>"> <img src="<?php echo $thumbimgdir.$row['thumb_image']; ?>" width="156" height="120" border="0" /></a></td>
                                      </div>
                                    </tr>
                                </table>
								</td>
                                <?php $ctr++; } ?>
                              </tr>
                             
                          </table>
						  </div>
						  </td>
                        </tr>
                        <tr>
                          <td height="30" align="right" class="text"><?php if($maxpage>1) { ?>
                              <div class="next">
                                <?php if($pageNum!=1) { ?>
                                <a href="photo_gallery.php?<?php if($_GET['pid']!="") echo 'pid='.$_GET['pid'].'&amp;'?>pageid=<?php echo ($pageNum-1)?>&id=<?php echo $cond;?>">
                                <?php } ?>
                                <font color="#000000"><b>&lt;&lt;</b></font> Prev...
                                <?php if($pageNum!=1) { ?>
                                </a>
                                <?php } ?>
                                <?php for($i=1;$i<=$maxpage;$i++) { ?>
                                <a href="photo_gallery.php?<?php if($_GET['pid']!="") echo 'pid='.$_GET['pid'].'&amp;'?>pageid=<?php echo $i?>&id=<?php echo $cond;?>"><?php echo $i;?></a> |
                                <?php } ?>
                                <?php if($pageNum!=$maxpage) { ?>
                                <a href="photo_gallery.php?<?php if($_GET['pid']!="") echo 'pid='.$_GET['pid'].'&amp;'?>pageid=<?php echo ($pageNum+1)?>&id=<?php echo $cond;?>">
                                <?php }?>
        ....Next <font color="#000000"><b>&gt;&gt;</b></font>
        <?php if($pageNum!=$maxpage) { ?>
                                </a>
                                <?php } ?>
                              <?php } ?></td>
                        </tr>
                      </table></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table></form></td>
                  </tr>
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
     <?php 
     include_once "footer.php";
     ?>
<script>
	function showadvert()
	{
		var obj = document.getElementById("advtid");
		obj.style.display="block";
	}

	window.onload=showadvert;
</script>
<script type="text/javascript">
disableSelection(document.body) //disable text selection on entire body of page
</script><script type="text/javascript">
var somediv=document.getElementById("mydiv")
disableSelection(somediv) //disable text selection within DIV with id="mydiv"
</script><script type="text/javascript">
var alltables=document.getElementsByTagName("table")
for (var i=0; i<alltables.length; i++)
disableSelection(alltables[i]) //disable text selection within all tables on the page
</script>

</body>


</html>
