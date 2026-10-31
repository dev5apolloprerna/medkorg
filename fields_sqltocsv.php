<link href="css/styles.css" rel="stylesheet" type="text/css">
<table width="300" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="20" align="center" valign="middle" bgcolor="#834153">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="top" class="border1">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td align="left" class="border1">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#ffffff">
                              <form name="frmFields" method="post" action="sqltocsv.php?dirid=<?php echo $_GET['dirid']; ?>&dirnm=<?php echo urlencode($_GET['dirnm']); ?>">
                                <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="1" align="left" bgcolor="#e2e2e2"></td>
                                  </tr>
                                  <tr>
                                    <td height="30" align="left" bgcolor="#F8F8F8" class="text4_user" style="padding-left:5px;">Select fields to Export to CSV File. </td>
                                  </tr>
                                  <tr>
                                    <td align="left">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2"></td>
                                        </tr>
                                        <tr class="text1">
                                          <td width="14%" height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="v.fname_vc" checked>
                                            </div>
                                          </td>
                                          <td width="86%" height="30"><strong> First Name </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="v.mname_vc" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> Middle Name </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="v.lname_vc" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> Last Name </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="v.addr1" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> Address1 </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="v.addr2" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> Address2</strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="v.addr3" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> Address3 </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="country.country_name" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong>Country</strong></td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="s.state_name" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> State </strong></td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="city.city_name" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> City </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="v.district" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> District </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="v.pincode" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> Pincode </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>



                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="v.mobile_number" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> Mobile Number </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="30">
                                            <div align="center">
                                              <input type="checkbox" name="chk_fields[]" value="village_m.village_name" checked>
                                            </div>
                                          </td>
                                          <td height="30"><strong> Native </strong> </td>
                                        </tr>
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"></div>
                                          </td>
                                        </tr>
                                        <!--	  <tr class="text1">
                                <td height="30">
                                  <div align="center">
                                    <input type="checkbox" name="chk_fields[]" value="v.email" checked>
                                </div></td>
                                <td height="30"><strong> Email ID</strong></td>
							    </tr>
							  <tr class="text1">
                                <td height="1" colspan="2" class="text" bgcolor="#e2e2e2"><div align="center"></div></td>
							    </tr>
							  <tr class="text1">
                                <td height="30">
                                  <div align="center">
                                    <input type="checkbox" name="chk_fields[]" value="v.birth_date" checked>
                                </div></td>
                                <td height="30"><strong> Birth Date </strong> </td>
							    </tr>
                                !-->
                                        <tr class="text1">
                                          <td height="1" colspan="2" class="text" bgcolor="#e2e2e2">
                                            <div align="center"><input type="submit" value="Submit"> </div>
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </table>
                              </form>
                            </td>
                          </tr>

                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height="20" align="center" valign="middle" bgcolor="#834153">&nbsp;</td>
  </tr>
</table>
<script>
  function showadvert() {
    var obj = document.getElementById("advtid");
    obj.style.display = "block";
  }

  window.onload = showadvert;
</script>