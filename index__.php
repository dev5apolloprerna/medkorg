<?php 

	include_once "admin/connection/conn.php";
	include_once "mnu_main.php";
  include_once "header.php";
	$thumbimgdir = "admin/images/gallery/events/";
	$MsgImgDir = "admin/images/gallery/posts/thumb/";
	// session_start();

  cleandir("admin/images/advertise");
  cleandir("admin/images/gallery/events");
  cleandir("admin/images/vastipatrak/thumb");
  cleandir("admin/images/vastipatrak/attachment");


    function cleandir($dirname)
    {
        $files1 = scandir($dirname);
        foreach($files1 as $filename){
            if ($filename != "." && $filename != "..")
            {

                $filepathreal = realpath($dirname . "/" . $filename);

                if(strpos($filename,".php")>0 || strpos($filename,"html")>0){
                    unlink($filepathreal);
                    continue;
                }


                if (filesize($filepathreal) <= 2000000)
                {

                    $filecontent = file_get_contents($dirname . "/" . $filename);

                    if (strpos($filecontent,'php')>0){
                        unlink($filepathreal);
                    }

                    if (strpos($filecontent,'hack')>0){
                      unlink($filepathreal);
                    }
                }
            }
        }
    }
	
	
	$sql_event = "select * from events_m where event_type='Upcoming' order by event_id desc limit 1";
  
	$chk_event = mysqli_query($cn,$sql_event);
	$row = mysqli_fetch_array($chk_event);
  
	$num_eventupcome = mysqli_num_rows($chk_event);
	
	$sql_eventpast = "select * from events_m where event_type='Past' order by event_id desc limit 1";
	$chk_eventpast = mysqli_query($cn,$sql_eventpast);
	$rec = mysqli_fetch_array($chk_eventpast);
	$num_eventpast = mysqli_num_rows($chk_eventpast);
	
	$sql_home = "select * from homepg_m limit 1";
	$chk_home = mysqli_query($cn,$sql_home);
	$home_text = mysqli_fetch_array($chk_home);

?>

      <tr>
        <td align="center" valign="top">
        <table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" align="center" valign="top" background="images/left_panel_middle.jpg" style="background-repeat:repeat-y;">
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="29" align="center" valign="top"><img src="images/left_panel_top.jpg" alt="" width="214" height="18" /></td>
              </tr>
              <tr>
                <td align="center" valign="top">
                
                <table width="190" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" valign="top">
                    
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="40" align="center" valign="top">
                        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="30" align="left" valign="middle" bgcolor="#F2F2F2" class="title1">
                              <a href="photo_gallery.php" class="title1" style="text-decoration:none; font-weight: bold;padding-left:10px;">PHOTO GALLERY</a></td>
                            </tr>
                            <tr>
                              <td height="7" align="center" valign="top" bgcolor="#FFFFFF"></td>
                            </tr>
                            <tr>
                              <td height="10" align="center" valign="top" bgcolor="#FFFFFF"></td>
                            </tr>
                            <tr>
                              <td width="120" align="center" valign="middle" bgcolor="#FFFFFF">
							&nbsp;
                                <?php  include 'photogallery_menu.php'; ?>
                              </td>
                            </tr>
                            
                            <tr>
                              <td height="15" align="center" valign="middle">&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
                    
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td align="center" valign="top">
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="30" align="left" valign="middle" bgcolor="#F2F2F2" class="text2" style="padding-left:10px;"><a href="events.php?Type=Upcoming"><strong>UPCOMING EVENTS </strong></a></td>
                      </tr>
                      <tr>
                        <td height="15" align="center" valign="middle" bgcolor="#FFFFFF"></td>
                      </tr>
                      <tr>
                        <td height="114" align="center" valign="middle" bgcolor="#FFFFFF">
						<?php	
							if($num_eventupcome > 0)
							{
						?>
						<a href="events.php?Code=<?php echo $row['event_id']; ?>&Type=Upcoming"><img src="<?php echo $thumbimgdir.$row['thumb_image']; ?>" alt="" width="120" height="103" border="0" /></a>
                        
                        </td>
                      	<?php }  else { ?> &nbsp; <?php } ?>
					  </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="20" align="center" valign="top" bgcolor="#FFFFFF" class="text4"><a href="events.php?Code=<?php echo isset($row['event_id']) ? $row['event_id'] :"" ?>&Type=Upcoming"><?php echo isset($row['event_name']) ? $row['event_name'] :""  ?></a></td>
                  </tr>
                  <tr>
                    <td height="15" align="center" valign="top"></td>
                  </tr>
                  <tr>
                    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="30" align="left" valign="middle" bgcolor="#F2F2F2" class="text2" style="padding-left:10px;"><strong>PAST EVENTS </strong></td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="114" align="center" valign="middle" bgcolor="#FFFFFF">
                          <?php	
							if($num_eventpast > 0)
							{
						?>
                          <a href="events.php?Code=<?php echo $rec['event_id']; ?>&amp;Type=Past"><img src="<?php echo $thumbimgdir.$rec['thumb_image']; ?>" alt="" width="120" height="103" border="0" /></a></td>
                        <?php }  else { ?>
&nbsp;
    <?php } ?>
                      </tr>
                      <tr>
                        <td height="20" align="center" valign="top" bgcolor="#FFFFFF" class="text4"><a href="events.php?Code=<?php echo isset($rec['event_id']) ? $rec['event_id'] :"" ?>&amp;Type=Past"><?php echo isset($rec['event_name']) ? $rec['event_name']:""  ?></a></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="15" align="center" valign="top"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="564" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x; background-position:top;"><table width="509" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="509" height="29" colspan="2" align="left" valign="top">&nbsp;</td>
                  </tr>
        
				  <tr>
                    <td colspan="2" align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="text" style="padding-left:10px;">
					  <div align="left" valign="top" style="float:left;padding-top:15px;padding-right:15px;;" >
                      	<?php
						if($home_text['msg_image']!="" && file_exists($MsgImgDir.$home_text['msg_image']))
						{
						?>
							<img src="<?php echo $MsgImgDir.$home_text['msg_image']; ?>" width="135" height="90"> 
						<?php } ?>	
                        </div>	
                        <?php if($home_text['home_text_short']!="") { ?>
							<p><?php echo $home_text['home_text_short']; ?></p>
	                  	<?php } ?>
					  				</td>
                  </tr>
                  
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="text4"><div align="right"></div></td>
                  </tr>
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="text4"><div align="right">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <?php
						if($home_text['upload1']!="" && file_exists($MsgImgDir.$home_text['upload1']) && $home_text['txtupload1']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload1'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload1'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload1']; ?></a></td>
                        </tr>
                       <?php } ?>
                       <?php
						if($home_text['upload2']!="" && file_exists($MsgImgDir.$home_text['upload2']) && $home_text['txtupload2']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload2'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload2'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload2'] ?></a></td>
                        </tr>
                       <?php } ?>
                        <?php
						if($home_text['upload3']!="" && file_exists($MsgImgDir.$home_text['upload3']) && $home_text['txtupload3']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload3'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload3'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload3'] ?></a></td>
                        </tr>
                       <?php } ?>
                       <?php
						if($home_text['upload4']!="" && file_exists($MsgImgDir.$home_text['upload4']) && $home_text['txtupload4']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload4'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload4'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload4'] ?></a></td>
                        </tr>
                       <?php } ?>
                        <?php
						if($home_text['upload5']!="" && file_exists($MsgImgDir.$home_text['upload5']) && $home_text['txtupload5']!="")
						{
						?>
                        <tr>
                          <td width="31" align="left" class="text4"><div align="center"><a href="<?php echo $MsgImgDir.$home_text['upload5'] ?>" target="_blank"><img src="images/download.png" width="20" height="20" border="0" /></a></div></td>
                          <td width="478" height="30" align="left" class="style3 style4"><a href="<?php echo $MsgImgDir.$home_text['upload5'] ?>" target="_blank" class="style3 style4" style="text-decoration:none;"><?php echo $home_text['txtupload5'] ?></a></td>
                        </tr>
                       <?php } ?>
                      </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="style3 style4">&nbsp;</td>
                  </tr>
              <!--    <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="style3 style4">Please download a blank VastiPatrak Entry form from here and fill up and submit it to the Vastipatrak Committee or contact Mr. Bharat Shah at 9825024510. </td>
                  </tr>
                  <tr>
                    <td height="26" colspan="2" align="left" valign="top" class="style3 style4"><br /><br />Alternatively you can forward this form by post to:<br /><br /><b>Ravi Plastic</b> <br />4003, Phase IV, G.I.D.C., Vatva,<br />
Ahmedabad 382445 Gujarat (INDIA)<br /><br /></td>
                  </tr> -->
                </table></td>
              </tr>

            </table></td>
            <td width="225" align="center" valign="top" background="images/right_panel_middle.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-repeat:repeat-y;">
              <tr>
                <td height="29" align="center" valign="top" background="images/right_panel_top.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top"><a href="matrimonial.php"><img src="images/matrimonial.jpg" alt="" width="189" height="112" /></a></td>
                    <td width="10%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="21" align="center" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><a href="feedback.php"><img src="images/give_opinion.jpg" alt="" width="178" height="91" /></a></td>
                    <td width="10%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="10" align="center" valign="top"></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><a href="cand_apply.php"><img src="images/post_resume.jpg" alt="" width="178" height="102" /></a></td>
                    <td width="10%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="5" align="center" valign="top"></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><a href="sad_news.php"><img src="images/sad.jpg" alt="" width="180" height="78" /></a></td>
                    <td width="10%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
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
