<?php
include_once "noentry.php";
include_once "admin/connection/conn.php";

session_start();

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    die("No ID found in the URL");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $birth_place = $_POST['birth_place'];
    $birth_time = $_POST['birth_time'];
    $hobby = $_POST['hobby'];
    $spectacles = $_POST['spectacles'];
    $mangal = $_POST['mangal'];
    $sani = $_POST['sani'];
    $annual_income = $_POST['annual_income'];

    $full_photo = $_FILES['full_photo'];
    $full_photo_db = $full_photo['name'];

    $passport_size_photo = $_FILES['passport_size_photo'];

    $passport_size_photo_db = $passport_size_photo['name'];
    $biodata = $_FILES['biodata'];

    // // Initialize error array
    // $errors = [];

    // // Validation
    // if (empty($height)) {
    //     $errors[] = "Height is required.";
    // }

    // if (empty($weight)) {
    //     $errors[] = "Weight is required.";
    // }

    // if (empty($birth_place)) {
    //     $errors[] = "Birth place is required.";
    // }

    // if (empty($full_photo['name'])) {
    //     $errors[] = "Full photo is required.";
    // }

    // if (empty($passport_size_photo['name'])) {
    //     $errors[] = "Passport size photo is required.";
    // }

    // // If there are validation errors, prevent form submission
    // if (!empty($errors)) {
    //     // Display errors to the user (you can redirect back with error messages)
    //     foreach ($errors as $error) {
    //         echo "<p style='color:red;'>$error</p>";
    //     }
    //     exit(); // Prevent further execution if validation fails
    // }


    $baseDir = 'documents/' . $user_id;
    $full_photoDir = $baseDir . '/full_photo/';
    // $full_photo = $baseDir . '/full_photo/';
    $passport_size_photoDir = $baseDir . '/passport_size_photo/';
    $biodataDir = $baseDir . '/biodata/';

    if (!is_dir($baseDir)) {
        mkdir($baseDir, 0777, true);
    }
    // if (!is_dir($photoDir)) {
    //     mkdir($photoDir, 0777, true);
    // }
    if (!is_dir($full_photoDir)) {
        mkdir($full_photoDir, 0777, true);
    }
    if (!is_dir($passport_size_photoDir)) {
        mkdir($passport_size_photoDir, 0777, true);
    }
    if (!is_dir($biodataDir)) {
        mkdir($biodataDir, 0777, true);
    }

    $full_photo_name = '';
    $passport_size_photo_name = '';
    $biodataName = '';

    // Upload full photo if exists
    if (!empty($full_photo['name'])) {
        $full_photo_name = basename($full_photo['name']);
        move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
    }

    // Upload passport size photo if exists
    if (!empty($passport_size_photo['name'])) {
        $passport_size_photo_name = basename($passport_size_photo['name']);
        move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
    }

    // Upload biodata if exists
    if (!empty($biodata['name'])) {
        $biodataName = basename($biodata['name']);
        move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
    }

    $sql = "INSERT INTO `matrimony`(`user_id`,`height`, `weight`, `birth_place`,`birth_time`,`hobby`, `spectacles`, `mangal`,`sani`, `annual_income`, `full_photo`,`passport_size_photo`, `biodata`) VALUES ($user_id,'$height','$weight','$birth_place','$birth_time','$hobby','$spectacles','$mangal','$divorce','$annual_income','$full_photo_db','$passport_size_photo_db','$biodataName')";

    $result = $cn->query($sql);

    if ($result) {
        header("Location:user-familydet.php");
        exit();
    } else {
        echo "Error: " . $cn->error;
    }
}
