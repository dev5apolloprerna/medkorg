<?php require_once 'events_field.php'; ?>
<html>
<head>
<title>Samaj</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function doSubmit()
{
	if(frm.event_name.value == "")
	{
		alert("Please enter Event Name");
		frm.event_name.focus();
	}
	
	else if(frm.event_type.selectedIndex == "")
	{
		alert("Please select Type");
		frm.event_type.focus();
	}
	
	else if(frm.event_date.value == "")
	{
		alert("Please enter Event Date");
		frm.event_date.focus();
	}
	
	
	
	else
	{
		if(frm.txtMode.value == "E")
		{
			frm.txtMode.value = "EA";
			frm.submit();
		}
		else
		{
			frm.txtMode.value = "A";
			frm.submit();
		}
	}
}
//-->
</script>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<style type="text/css">
	
<!--
body {
	background-color: #666666;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style5 {color: #063968; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
.style6 {color: #B90200; font-family:Arial, Helvetica, sans-serif; font-weight:bolder;}
.style2 {color: #FFFFFF;
	font-weight: bold;
	font-size: 13px;
}
-->
</style>

<script type='text/JavaScript' src='js/scw.js'></script> 
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"> 
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff"><tr>
       <td valign="top" bgcolor="#FFFFFF" > <blockquote>
            <p><span class="style6"><font size="+2" class="style6"><br>
        Administration Panel<br>
        <br>
            </font></span></p>
        </blockquote> </td>
      </tr>
      
        
 
  <tr> 
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
        <tr> 
          <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0"> 
              <tr> 
                <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
                    <tr valign="top"> 
                      <td width="25%" rowspan="3" background="images/grey_bg.gif"><?php require 'menu.php' ?></td> 
                      <td>&nbsp;</td> 
                      <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="center" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="center" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="center" valign="top">
                            <form name="frm" method="post" action="events_add.php" enctype="multipart/form-data">
                              <input type="hidden" name="event_id" id="event_id" value="<?php echo isset($event['event_id']) ? $event['event_id'] : ""; ?>">
							  <input type="hidden" id="DPC_TODAY_TEXT" value="today">
					          <input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
					          <input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
					          <input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
                              <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="5" colspan="2" class="text style2"></td>
                                </tr>
                                <tr>
                                  <td width="19%" class="h1">Event Master </td>
                                  <td width="81%"><div align="right"> </div></td>
                                </tr>
                                <tr>
                                  <td height="12"></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="middle">                       
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="5"></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="5"></td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="middle" class="text"> Event Name </td>
                                        <td align="center" valign="middle"><strong>:</strong></td>
                                        <td align="left" valign="middle"><input type="text" name="event_name" id="event_name" size="30" class="text" value="<?php echo isset($event['event_name']) ? $event['event_name'] :"" ?>"/></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="5"></td>
                                      </tr>
                                      <tr>
							 <td align="right" valign="middle" class="text"> Event Type </td>
							  <td align="center" valign="middle" class="text">:</td>
							  <td valign="middle">
								
								<select name="event_type" class="text" id="Event Type">
								  <option value="" > Please Select </option>
								  
								  <option value="Upcoming" <?php echo isset($event['event_type']) =='Upcoming'?"selected":""; ?> >Upcoming </option>
								  <option value="Past" <?php echo isset($event['event_type']) =='Past'?"selected":""; ?> >Past </option> 
								  </select>
							   </td>
							</tr>
							<tr>
                                        <td></td>
                                        <td></td>
                                        <td height="8"></td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="middle" class="text"> Thumb Photo </td>
                                        <td align="center" valign="middle"><strong>:</strong></td>
                                        <td align="left" valign="middle"><input type="file" name="thumb_image" id="thumb_image" size="30" class="text"  ></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td height="8"></td>
                                      </tr>
									  <tr>
                                      <td height="25" align="right" valign="top" class="form_field"><span class="text">Event Date</span></td>
                                      <td valign="top" class="form_field">:</td>
                                      <td valign="top">
                                        <table width="188" border="0" align="left" cellpadding="0" cellspacing="0" background="images/txtbox_bg.gif" style="background-repeat:no-repeat">
                                          <tr>
                                            <td width="188" height="25" valign="top"><input type="text" name="event_date" class="txtbox" id="date"  value="<?php echo isset($event['event_date']) ? $event['event_date'] :""; ?>" /><img src="images/calendar_icon.png" width="15" height="20" onclick='scwShow(document.getElementById("date"),event);' style="cursor:pointer;"></td>
                                          </tr>
                                      </table></td>
                           </tr>				
					
						<tr> 
					 	 <td height="5"> </td>
					    </tr>
						<tr>
                          <td align="right" valign="middle" class="text">Link to Album </td>
                          <td align="center" valign="middle"><strong>:</strong></td>
                          <td align="left" valign="middle"><span class="form_field">
                            <select name= "cat_name" id="cat_name" class="txtbox">
                              <option value=""> No Link </option>
                              <?php foreach($category_info as $val){ 
							if($event['cat_name']==$val['cat_id']) { ?>
                              <option value="<?php echo $val['cat_id']; ?>" selected><?php echo $val['cat_name']; ?></option>
                              <?php } else { ?>
                              <option value="<?php echo $val['cat_id']; ?>"><?php echo $val['cat_name']; ?></option>
                              <?php } } ?>
                            </select>
                          </span></td>
						  </tr>
						<tr>
                          <td></td>
                          <td></td>
                          <td height="8"></td>
						  </tr>
                                      <tr>
                                        <td height="5"> </td>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="top"><input type="submit" name="btnadd" id="btnadd" value="Submit" style="cursor:pointer;" onClick="return checkToursField()" />
                                            <input type="button" name="btnadd2" id="btnadd2" value="Cancel" style="cursor:pointer;" onClick="window.location='list_events.php'" /></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                          </form></td>
                        </tr>
                      </table></td> 
                    </tr> 
                    <tr valign="top"> 
                      <td>&nbsp;</td> 
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="25%" class="text_bold_head">&nbsp;</td>
                          <td><div align="right"> </div></td>
                        </tr>
                      </table></td> 
                    </tr> 
                    <tr valign="top"> 
                      <td width="1%">&nbsp;</td> 
                      <td width="74%">&nbsp;</td> 
                    </tr> 
                  </table></td> 
              </tr> 
            </table></td> 
        </tr> 
      </table></td> 
  </tr> 
  <tr>
    <td valign="top" bgcolor="#000000">&nbsp;</td>
  </tr> 
</table> 
<!-- End ImageReady Slices --> 
</body>
</html>
