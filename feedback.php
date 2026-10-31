<?php
	include  "mnu_main.php";
	
	$str_native="select * from village_m order by village_name";
	$sql_native=mysqli_query($cn,$str_native);
	
	$str_gotra="select * from gotra_m order by gotra_name";
	$sql_gotra=mysqli_query($cn,$str_gotra);
	
	$str_state="select * from state_m order by state_name";
	$sql_state=mysqli_query($cn,$str_state);
	
	$str_city="select * from city_m order by city_name";
	$sql_city=mysqli_query($cn,$str_city);
?>
	
  <?php
include_once "header.php";
?>
    <tr>
        <td align="center" valign="top"><table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="22" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x;">&nbsp;</td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" class="border1"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="10"></td>
                  </tr>
                  <tr>
                    <td align="center" valign="top" class="border1"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#F8F8F8">&nbsp;</td>
                            <td height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="title">Feedback</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="2%">&nbsp;</td>
                      <td width="98%"><table width="834" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="15">&nbsp;</td>
                          <td width="613"><table width="804" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="780" valign="top"><form action="inquiry_submitdetail.php" method="post" name="frm" id="frm">
								    <script language="JavaScript" type="text/javascript">
<!--
					function emailcheck(emailStr) 
							{
							// checks if the e-mail address is valid
							var emailPat=/^(.+)@(.+)$/;
							var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]";
							var validChars="\[^\\s" + specialChars + "\]";
							var firstChars=validChars;
							var quotedUser="(\"[^\"]*\")";
							var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
							var atom="(" + firstChars + validChars + "*" + ")";
							var word="(" + atom + "|" + quotedUser + ")";
							var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
							var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
							
							if (emailStr=="") {
								alert("Email address can't be null");
								return (0);
									}
							var matchArray=emailStr.match(emailPat);
							if (matchArray==null) {  
								alert("Email address seems incorrect (check @ and .'s)");
								return (0);
								}
							var user=matchArray[1];
							var domain=matchArray[2];
							// See if "user" is valid 
							if (user.match(userPat)==null) {
								// user is not valid
								alert("The username doesn't seem to be valid.");
								return (0);
							}
							var IPArray=domain.match(ipDomainPat);
							if (IPArray!=null) {
								// this is an IP address
								  for (var i=1;i<=4;i++) {
									if (IPArray[i]>255) {
										alert("Destination IP address is invalid!");
									return (0);
									}
								}
								return true;
							}
							
							// Domain is symbolic name
							var domainArray=domain.match(domainPat);
							if (domainArray==null) {
								alert("The domain name doesn't seem to be valid.");
								return (0);
							}
							
							var atomPat=new RegExp(atom,"g");
							var domArr=domain.match(atomPat);
							var len=domArr.length;
							if (domArr[domArr.length-1].length<2 || 
								domArr[domArr.length-1].length>3) {
							   // the address must end in a two letter or three letter word.
							   alert("The address must end in a three-letter domain, or two letter country.");
							   return (0);
							}
							
							if (domArr[domArr.length-1].length==3 && len<2) {
							   var errStr="This address is missing a hostname!";
							   alert(errStr);
							   return (0);
							}
							return (1);
							}
							//---------------------Validate Function
							function NameCheck(a,validchar)
							{
								for (var i=0; i < a.length; i++)
								{
									var letter = a.charAt(i).toLowerCase();
									if(validchar.indexOf(letter) != -1)
									continue;
									return false;
								}
								return true;
							}
							//-------------------------TRIM FUNCTION
							function leftTrim(sString)
							{
								while (sString.substring(0,1) == ' ')
								{
									sString = sString.substring(1, sString.length);
								}
								return sString;
							}
							
					function doSubmit()
					{
						if (document.frm.native.value == "")
						{
							alert("Please enter Native Name");
							document.frm.native.focus();
							return false;
						}
						if (document.frm.gotra.value == "")
						{
							alert("Please enter Gotra");
							document.frm.gotra.focus();
							return false;
						}
						if (document.frm.txtname.value == "")
						{
							alert("Please enter Name");
							document.frm.txtname.focus();
							return false;
						}
						if (document.frm.txtmobile.value == "")
						{
							alert("Please enter Mobile No");
							document.frm.txtmobile.focus();
							return false;
						}
						if(leftTrim(document.frm.txtmobile.value)!=document.frm.txtmobile.value)
						{
							alert("Please enter valid Mobile No");
							document.frm.txtmobile.value = "";
							document.frm.txtmobile.focus();
							return false;
						}
						if(NameCheck(document.frm.txtmobile.value,'0123456789 ')==false)
						{
							alert("Please enter valid Mobile No");
							document.frm.txtmobile.focus();
							return false;
						}
						if (document.frm.txtemail.value == "")
						{
							alert("Please enter Email");
							document.frm.txtemail.focus();
							return false;
						}
						if(leftTrim(document.frm.txtemail.value)!=document.frm.txtemail.value)
						{
							alert("Please enter valid Email");
							document.frm.txtemail.value = "";
							document.frm.txtemail.focus();
							return false;
						}
						if(emailcheck(document.frm.txtemail.value)==0)
						{							
							document.frm.txtemail.focus(); 
							return false;    
						}
						if (document.frm.txtremarks.value == "")
						{
							alert("Please enter Remarks");
							document.frm.txtremarks.focus();
							return false;
						}
						else
						{
							return true;
						}
						
					}
					-->
                          </script>
                                    <table width="80%" border="0" align="left" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td colspan="3" valign="top" class="text"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/dots.gif">
                                            <tr>
                                              <td valign="top"><img src="images/dots.gif" width="2" height="1" /></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr valign="top">
                                        <td width="27%" height="24" align="right" valign="top" class="text"><div align="right"><strong>Native Name<font color="#FF0000">*</font></strong></div></td>
                                        <td width="3%" height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td width="70%" height="20" align="left" class="text">
										<select name="native" tabindex="1">
										<option value="">Please Select</option>
										<?php
										while($native_rec=mysqli_fetch_assoc($sql_native))
										{
										?>
											<option value="<?php echo $native_rec['village_name'];?>"><?php echo $native_rec['village_name'];?></option>
										<?php
										}
										?>
										</select>
										</td>
                                      </tr>
                                      <tr valign="top">
                                        <td height="24" align="right" valign="top" class="text"><div align="right"><strong>Gotra<font color="#FF0000">*</font></strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td height="20" align="left" class="text">
										<select name="gotra" tabindex="2">
										<option value="">Please Select</option>
										<?php
										while($gotra_rec=mysqli_fetch_assoc($sql_gotra))
										{
										?>
											<option value="<?php echo $gotra_rec['gotra_name'];?>"><?php echo $gotra_rec['gotra_name'];?></option>
										<?php
										}
										?>
										
										</select>
										</td>
                                      </tr>
                                      <tr valign="top">
                                        <td height="24" align="right" valign="top" class="text"><div align="right"><strong>Name<font color="#FF0000">*</font></strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td height="20" align="left" class="text"><input name="txtname" type="text" class="txtbox"  maxlength="50" tabindex="3" /></td>
                                      </tr>
                                      <tr valign="top">
                                        <td height="24" align="right" valign="top" class="text"><div align="right"><strong>Phone No</strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td height="20" align="left" class="text"><input name="txtphone" type="text" class="txtbox"  maxlength="50"  tabindex="4"/></td>
                                      </tr>
                                      <tr valign="top">
                                        <td height="24" align="right" valign="top" class="text"><div align="right"><strong>Mobile No<font color="#FF0000">*</font> </strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td height="20" align="left" class="text"><input name="txtmobile" type="text" class="txtbox"  maxlength="100"  tabindex="5"/></td>
                                      </tr>
                                      <tr valign="top">
                                        <td height="24" align="right" valign="top" class="text"><div align="right"><strong>E-Mail<font color="#FF0000">*</font></strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td height="20" align="left" class="text"><input name="txtemail" type="text" class="txtbox" tabindex = "6" maxlength="100" /></td>
                                      </tr>
                                      <tr valign="top">
                                        <td align="right" valign="top" class="text"><div align="right"><strong>Address</strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td align="left" class="text"><textarea name="txtaddress" cols="21" tabindex="7"></textarea></td>
                                      </tr>
                                      <tr align="left" valign="top">
                                        <td height="4" colspan="3" valign="top" class="text"></td>
                                        </tr>
                                      <tr valign="top">
                                        <td width="27%" height="24" align="right" valign="top" class="text"><div align="right"><strong>Current State </strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td width="70%" height="20" align="left" class="text">
										<select name="state" tabindex="8">
										<option>Please Select</option>
										<?php
										while($state_rec=mysqli_fetch_assoc($sql_state))
										{
										?>
											<option value="<?php echo $state_rec['state_name'];?>"><?php echo $state_rec['state_name'];?></option>
										<?php
										}
										?>
										</select>
										</td>
                                      </tr>
                                      <tr valign="top">
                                        <td height="24" align="right" valign="top" class="text"><div align="right"><strong>Current City </strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td height="20" align="left" class="text">
										<select name="city" tabindex="9">
										<option>Please Select</option>
										<?php
										while($city_rec=mysqli_fetch_assoc($sql_city))
										{
										?>
											<option value="<?php echo $city_rec['city_name'];?>"><?php echo $city_rec['city_name'];?></option>
										<?php
										}
										?>
										</select>
										</td>
                                      </tr>
                                     
                                      <tr valign="top">
                                        <td height="24" align="right" valign="top" class="text"><div align="right"><strong>Remarks<font color="#FF0000">*</font></strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td height="20" align="left" class="text"><textarea name="txtremarks" cols="40" rows="6" class="txtbox" tabindex="10"></textarea></td>
                                      </tr>
                                      <!--<tr valign="top">
                                        <td height="24" align="right" valign="top" class="text"><div align="right"><strong>Feedback Date <font color="#FF0000">*</font></strong></div></td>
                                        <td height="20" align="center" valign="top" class="text"><div align="center"><strong>:</strong></div></td>
                                        <td height="20" align="left" class="text"><input name="txtdate" type="text" class="txtbox" id="txtdate"  maxlength="50" tabindex="3"  /> &nbsp; <img src="images/calendar_icon.png" width="15" height="20" onclick='scwShow(document.getElementById("txtdate"),event);'> </td>
                                      </tr>-->
                                      <tr valign="middle">
                                        <td height="40" valign="top" class="text">&nbsp;</td>
                                        <td valign="top" class="text">&nbsp;</td>
                                        <td align="left" class="text"><input type="submit" onclick="return doSubmit();" tabindex = "12" name="Submit" value="Submit" style="cursor:pointer;" />
                                            <input type="reset" name="reset" tabindex="13" value="Reset" style="cursor:pointer;" /></td>
                                      </tr>
                                      <tr valign="top">
                                        <td colspan="3" class="text"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/dots.gif">
                                            <tr>
                                              <td valign="top"><img src="images/dots.gif" width="2" height="1" /></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                    </table>
                                </form></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                              </tr>
                          </table></td>
                          <td width="206">&nbsp;</td>
                        </tr>
                      </table></td>
                      </tr>
                    </table></td>
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
      </table></td>
      </tr>
    </table></td>
  </tr>
</table>
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
    <?php
    include_once "footer.php";
    ?>