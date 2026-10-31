<?php
include_once "noentry.php";
include_once "connection/conn.php";
include_once 'include/appmain.php';
include_once 'password_hash.php';



if ($_POST) {
  

        $strsqlNew = "select * from vastipatrak_m where vasti_id=" . $_REQUEST['id'];
        $rwData = mysqli_query($cn, $strsqlNew);
        if(mysqli_num_rows($rwData)>0){
                $rowData=mysqli_fetch_array($rwData);
                echo $rowData['mobile_home'];
        }else{
                echo 0;
        }
        
       
}

