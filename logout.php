<?php
session_start();

if (isset($_SESSION["UserAdminCode"])) {
    // $_SESSION["UserLogin"] = "";
     $_SESSION["UserCode"] = "";
    // $_SESSION["UserCal"] = "";
    // $_SESSION["UserMsg"] = "";
    // $_SESSION["isMember"] = "";
     $_SESSION["parentId"] = "";
     $_SESSION["VastiId"] = "";
    // $_SESSION["status"] = "";
  //  session_unset();
    //session_destroy();
    $redirect = "admin/home.php";
    header("Location: $redirect");
} else {
        $_SESSION["UserLogin"] = "";
    $_SESSION["UserCode"] = "";
    $_SESSION["UserCal"] = "";
    $_SESSION["UserMsg"] = "";
    $_SESSION["isMember"] = "";
    $_SESSION["parentId"] = "";
    $_SESSION["VastiId"] = "";
    $_SESSION["status"] = "";
    session_unset();
    //session_destroy();
    $redirect = "index.php";
    header("Location: $redirect");
}
