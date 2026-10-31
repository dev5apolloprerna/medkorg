<?php
include_once "noentry.php";
include_once "admin/connection/conn.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['action'] == "Add"){
        $check = "select * from matrimonyPreferred where vasti_id='".$_POST['vasti_id']."' and matrimony_user_Id='".$_POST['matrimony_user_Id']."'";
        $checkResult = $cn->query($check);
        if ($checkResult->num_rows == 0) {
            $sql = "INSERT INTO `matrimonyPreferred`(`vasti_id`,`matrimony_user_Id`, `iEnterBy`) VALUES ('".$_POST['vasti_id']."','".$_POST['matrimony_user_Id']."','".$_SESSION['VastiId']."')";
            $result = $cn->query($sql);
            if ($result) {
                echo 0;
            } else {
                echo 1;
            }
        } else {
            echo 2;
        }
    }
    
    if($_POST['action'] == "Remove"){
        $sql = "delete from `matrimonyPreferred` where id='".$_POST['iPreferredId']."'";
        $result = $cn->query($sql);
        if ($result) {
            echo 0;
        } else {
            echo 1;
        }
    }
}
?>
