<?php
include_once "connection/conn.php";

//session_start();

// $mnu_permissions = explode(',',$_SESSION["UserAdminPermissions"]);
$_SESSION["UserAdminPermissions"] = ($_SESSION["UserAdminPermissions"] != "") ? $_SESSION["UserAdminPermissions"] : "0";


$where = "where adm.mnu_cat=0 and adm1.adm_mnu_id in (" . $_SESSION["UserAdminPermissions"] . ",0) and adm.adm_mnu_id>0 and adm.status=1";

$sql_string = "SELECT distinct adm.* FROM admin_menu adm
				   		inner join admin_menu adm1 on adm1.mnu_cat = adm.adm_mnu_id  
				   		$where
						order by adm.mnu_cat,adm.adm_mnu_id";
$check_res_main = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
$num_mnu_rows = mysqli_num_rows($check_res_main);

?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<table width="90%" border="0" align="left" cellpadding="0" cellspacing="0" style="border-right-width:1px;border-right-style:solid; border-right-color:#FFFFFF" background="images/grey_bg.gif" bgcolor="#F9F9F9">
  <tr valign="middle">
    <td width="25" height="25" align="center"><img src="images/bullet.gif" width="5" height="5"></td>
    <td width="90%" height="25" class="text"><a href="home.php">Home</a></td>
  </tr>
  <tr valign="middle">
    <td height="0" colspan="2" align="center">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td background="images/product_line.gif"><img src="images/product_line.gif" width="9" height="1"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr valign="middle">
    <td colspan="2" align="center">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td background="images/product_line.gif"><img src="images/product_line.gif" width="9" height="1"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr valign="middle">
    <td height="10" background="images/dot-line.gif" style="background-repeat:repeat-x;" colspan="2" align="center"></td>
  </tr>
  <?php
  if ($num_mnu_rows > 0) {
    while ($mnu_main_titles = mysqli_fetch_array($check_res_main)) {
      
        $where = "where adm.mnu_cat=" . $mnu_main_titles['adm_mnu_id'] . " and (adm.adm_mnu_id in (" . $_SESSION["UserAdminPermissions"] . ",0) or adm.adm_mnu_id in (" . $_SESSION["UserAdminPermissions"] . "0)) and adm.adm_mnu_id>0 and adm.status=1";
      

      // Get Sub Masters //
      $sql_string = "SELECT adm.* FROM admin_menu adm $where";
      $check_res_submnu = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
      $num_submnu_rows = mysqli_num_rows($check_res_submnu);
  ?>
      <tr valign="middle">
        <td height="25" align="center">&nbsp;</td>
        <td height="25" class="h3"><?php echo $mnu_main_titles['mnu_disp_value']; ?></td>
      </tr>
      <?php
      if ($num_submnu_rows > 0) {
        while ($mnu_sub_titles = mysqli_fetch_array($check_res_submnu)) {
      ?>
          <tr valign="middle">
            <td height="25" align="center"><img src="images/bullet.gif" width="5" height="5"></td>
            <td height="25" class="text"><a href="<?php echo $mnu_sub_titles['mnu_link']; ?>" <?php
                                                                                              if (trim($mnu_sub_titles['target_vc']) != "")
                                                                                                echo ("target='_blank'\"");
                                                                                              ?>> <?php echo $mnu_sub_titles['mnu_disp_value']; ?></a></td>
          </tr>
          <tr valign="middle">
            <td colspan="2" align="center">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td background="images/product_line.gif"><img src="images/product_line.gif" width="9" height="1"></td>
                </tr>
              </table>
            </td>
          </tr>
      <?php  }
      } ?>
      <tr valign="middle">
        <td height="10" background="images/dot-line.gif" style="background-repeat:repeat-x;" colspan="2" align="center"></td>
      </tr>
  <?php }
  } ?>
  <tr valign="middle">
    <td height="25" align="center"><img src="images/bullet.gif" width="5" height="5"></td>
    <td height="25" class="text"><a href="logout.php" class="link">Logout</a></td>
  </tr>
  <tr valign="middle">
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr valign="middle">
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr valign="middle">
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>