<?php
include_once "admin/connection/conn.php";
// $sql=mysqli_query($cn,"SELECt m1.*,(select vastipatrak_m.fname_vc from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as MiddleName
// ,(select vastipatrak_m.lname_vc from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as LastName
// ,(select vastipatrak_m.addr1 from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as paddr1
// ,(select vastipatrak_m.addr2 from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as paddr2
// ,(select vastipatrak_m.addr3 from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as paddr3
// ,(select vastipatrak_m.country from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as pcountry
// ,(select vastipatrak_m.state from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as pstate
// ,(select vastipatrak_m.city from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as pcity
// ,(select vastipatrak_m.village_id from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as pvillage_id
// ,(select vastipatrak_m.gotra_id from vastipatrak_m where  vastipatrak_m.vasti_id = m1.parent_id) as pgotra_id
// FROM `vastipatrak_m` m1
// where village_id='' and gotra_id=''");

// while($row=mysqli_fetch_array($sql)){

//      $updsql=mysqli_query($cn,"update vastipatrak_m set village_id='".$row['pvillage_id']."',gotra_id='".$row['pgotra_id']."' where vasti_id=".$row['vasti_id']);
//     // if($row['addr1']=='' or $row['addr1']==NULL){
//     //     mysqli_query($cn,"update vastipatrak_m set addr1='".$row['paddr1']."' where vasti_id=".$row['vasti_id']);
//     // }
//     // if($row['addr2']=='' or $row['addr2']==NULL){
//     //     mysqli_query($cn,"update vastipatrak_m set addr2='".$row['paddr2']."' where vasti_id=".$row['vasti_id']);
        
//     // }
//     // if($row['addr3']=='' or $row['addr3']==NULL){
//     //     mysqli_query($cn,"update vastipatrak_m set addr3='".$row['paddr3']."' where vasti_id=".$row['vasti_id']);
//     // }
//     // if($row['country']=='' or $row['country']==NULL){
//     //     mysqli_query($cn,"update vastipatrak_m set country='".$row['pcountry']."' where vasti_id=".$row['vasti_id']);
//     // }
//     // if($row['state']=='' or $row['state']==NULL){
//     //     mysqli_query($cn,"update vastipatrak_m set state='".$row['pstate']."' where vasti_id=".$row['vasti_id']);
        
//     // }
//     // if($row['city']=='' or $row['city']==NULL){
//     //     mysqli_query($cn,"update vastipatrak_m set city='".$row['pcity']."' where vasti_id=".$row['vasti_id']);
        
//     // }

    
// }
//5-3-24

$sql=mysqli_query($cn,"SELECT parent_id,fname_vc,mname_vc,lname_vc,mobile_number,mobile_home,vasti_id FROM `vastipatrak_m` WHERE mobile_home='' and mobile_number !=''");
while($row=mysqli_fetch_array($sql)){
    if(preg_match('/^[0-9]{10}+$/', $row['mobile_number'])) {
       // echo "Valid Phone Number";
        mysqli_query($cn,"update vastipatrak_m set mobile_home=mobile_number where mobile_home='' and mobile_number !='' and vasti_id=".$row['vasti_id']);
        echo mysqli_affected_rows($cn);
        } else {
        echo "Invalid Phone Number";
        }
}
