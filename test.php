<?php
include "password_hash.php";
include_once "admin/connection/conn.php";

    if($_POST){
        $strSql = "select vasti_id,vastipatrak_m.fname_vc , vastipatrak_m.mobile_home from  vastipatrak_m where  length(vastipatrak_m.mobile_home)=10 and parent_id=0";
        $check_res = mysqli_query($cn,$strSql) or die(mysqli_error($cn));
        while($row = mysqli_fetch_array($check_res)){
            $mkpswd = substr(strtolower($row['fname_vc']),0,3)."_". substr($row['mobile_home'],6,4);

            $hash_result = create_hash($mkpswd);
            $hash_params = explode(":", $hash_result);
            $salt = $hash_params[HASH_SALT_INDEX];
            //$plaintxt_password= $txtnewpassword;
            $hash = $hash_params[HASH_PBKDF2_INDEX];

            $sql_string = "UPDATE user_m SET user_password = '" . $hash."',salt= '".$salt."' ,plaintxt_password= '".$mkpswd."'";
		 	$sql_string = $sql_string ." where vasti_id =". $row['vasti_id'];
      
			mysqli_query($cn,$sql_string) or die(mysqli_error($cn));
        }
    }
?>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <form action="test.php" method="post">
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>