<?php
include_once "noentry.php";
include_once "admin/connection/conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>::: Shree Modasa Ekda Dasha Khadayat :::</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/userjvalid.js"></script>

    <script type='text/JavaScript' src='js/scw.js'></script>

    <script language="javascript" type="text/javascript">
        function showhideDiv(val) {
            if (val == "" || val == "H" || val == "S" || val == "R") {
                document.getElementById("trbusiness").style.display = "none";
                document.getElementById("trprof").style.display = "none";
                document.getElementById("trjob").style.display = "none";
                document.getElementById("tdaddr").style.display = "none";
            }
            if (val == "B") {
                document.getElementById("trbusiness").style.display = "";
                document.getElementById("trprof").style.display = "none";
                document.getElementById("trjob").style.display = "none";
                document.getElementById("tdaddr").style.display = "";
            }
            if (val == "P") {
                document.getElementById("trbusiness").style.display = "none";
                document.getElementById("trprof").style.display = "";
                document.getElementById("trjob").style.display = "none";
                document.getElementById("tdaddr").style.display = "";
            }
            if (val == "J") {
                document.getElementById("trbusiness").style.display = "none";
                document.getElementById("trprof").style.display = "none";
                document.getElementById("trjob").style.display = "";
                document.getElementById("tdaddr").style.display = "";
            }
        }
        //$src = "family_link_search.php?mode=F&Code=".$varCode."&Mode=".$_GET['Mode']."&HCode=".$_GET['HCode']."&HId=".$_GET['HId'];

        function doSub(mode, Code, Mode, HCode, HId, FId, stype, a_id) {
            var st = document.getElementById(stype).value;
            if (st != 'f')
                document.getElementById(a_id).href = "family_link_search.php?mode=" + mode + "&Code=" + Code + "&Mode=" + Mode + "&HCode=" + HCode + "&HId=" + HId + "&FId=" + FId + "&stype=" + st;
            else
                document.getElementById(a_id).href = "family_link_result.php?mode=" + mode + "&Code=" + Code + "&Mode=" + Mode + "&HCode=" + HCode + "&HId=" + HId + "&FId=" + FId + "&stype=" + st;

        }
    </script>
    <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="mm_menu.js" type="text/javascript"></script>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
                loadingImage: 'images/loading.gif',
                closeImage: 'images/closelabel.png'
            })
        })
    </script>
    <style type="text/css">
        <!--
        .style1 {
            color: #222222
        }
        -->
        input[type=submit],
        input[type=reset]
        {
        background-color:#9C1212;
        color:
        white;
        padding:
        5px;
        }
    </style>
    <script>
        function switchMenu(tag) {

            var e1 = document.getElementById(tag);
            if (e1.style.display == "none")
                e1.style.display = "";
            else
                e1.style.display = "none";
        }

        function MM_swapImgRestore() { //v3.0
            var i, x, a = document.MM_sr;
            for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) x.src = x.oSrc;
        }

        function MM_preloadImages() { //v3.0
            var d = document;
            if (d.images) {
                if (!d.MM_p) d.MM_p = new Array();
                var i, j = d.MM_p.length,
                    a = MM_preloadImages.arguments;
                for (i = 0; i < a.length; i++)
                    if (a[i].indexOf("#") != 0) {
                        d.MM_p[j] = new Image;
                        d.MM_p[j++].src = a[i];
                    }
            }
        }

        function MM_findObj(n, d) { //v4.01
            var p, i, x;
            if (!d) d = document;
            if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
                d = parent.frames[n.substring(p + 1)].document;
                n = n.substring(0, p);
            }
            if (!(x = d[n]) && d.all) x = d.all[n];
            for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
            for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
            if (!x && d.getElementById) x = d.getElementById(n);
            return x;
        }

        function MM_swapImage() { //v3.0
            var i, j = 0,
                x, a = MM_swapImage.arguments;
            document.MM_sr = new Array;
            for (i = 0; i < (a.length - 2); i += 3)
                if ((x = MM_findObj(a[i])) != null) {
                    document.MM_sr[j++] = x;
                    if (!x.oSrc) x.oSrc = x.src;
                    x.src = a[i + 2];
                }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
</head>
<?php

// Advertisement Query
$sql_advt_incl1 = "select * from advt_tbl order by RAND()";
$chk_advt_incl1 = mysqli_query($cn, $sql_advt_incl1);

$filelist = "";
$imgdir = "";
while ($advt_incl1 = mysqli_fetch_array($chk_advt_incl1)) {
    if ($advt_incl1['file'] != "") {
        if ($filelist != "") $filelist .= ",";
        $filelist .= "'" . $imgdir . $advt_incl1['file'] . "'";
    }
}
?>

<?php
session_start();

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    die("No ID found in the URL");
}

$query_execute = "SELECT * FROM matrimony where user_id = $user_id";
$result_execute = mysqli_query($cn, $query_execute);
$row = mysqli_fetch_assoc($result_execute);
$user_fetch_data_userid = $row['user_id'];
$user_fetch_data_id = $row['id'];

if ($user_fetch_data_id != "") {
    $height = explode(".", $row['height']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Retrieve existing data from the database for full_photo, passport_size_photo, and biodata
        $sql = "SELECT full_photo, passport_size_photo, biodata FROM matrimony WHERE id='$user_fetch_data_id'";
        $result = $cn->query($sql);
        $existingData = $result->fetch_assoc();

        // Get form data
        $height = implode(".", $_POST['height']);
        //  $height[1] = substr($height[1], 0, 1);
        $weight = $_POST['weight'];
        $birth_place = $_POST['birth_place'];
        $birth_time = $_POST['birth_time'];
        $hobby = $_POST['hobby'];
        $spectacles = $_POST['spectacles'];
        $mangal = $_POST['mangal'];
        $sani = $_POST['sani'];
        $annual_income = $_POST['annual_income'];

        $full_photo = $_FILES['full_photo'];
        $passport_size_photo = $_FILES['passport_size_photo'];
        $biodata = $_FILES['biodata'];

        $baseDir = 'documents/' . $user_id;
        $full_photoDir = $baseDir . '/full_photo/';
        if (!is_dir($full_photoDir)) {
            mkdir($full_photoDir, 0777, true);
        }
        
        // Create directories if they don't exist
        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }
        
        $targetDir = $full_photoDir;
        $fileName = basename($_FILES['full_photo']['name']);
        $targetFilePath = $targetDir . $fileName;
        
        // File type
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        // Check if the file is an image
        $check = getimagesize($_FILES['full_photo']['tmp_name']);
        $full_photo_name = "";
        if ($check !== false) {
            // File is an image
            unlink($full_photoDir. $fileName);
            $full_photo_name = $fileName;
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Resize image by 40%
                $resizePercent = 0.4; // 60% of original size
                $imageResource = null;
    
                // Load image based on its type
                if ($fileType == 'jpg' || $fileType == 'jpeg') {
                    $imageResource = imagecreatefromjpeg($_FILES['full_photo']['tmp_name']);
                } elseif ($fileType == 'png') {
                    $imageResource = imagecreatefrompng($_FILES['full_photo']['tmp_name']);
                } elseif ($fileType == 'gif') {
                    $imageResource = imagecreatefromgif($_FILES['full_photo']['tmp_name']);
                }
    
                // Get original image dimensions
                $origWidth = imagesx($imageResource);
                $origHeight = imagesy($imageResource);
    
                // Calculate new dimensions
                $newWidth = $origWidth * $resizePercent;
                $newHeight = $origHeight * $resizePercent;
    
                // Create a new true color image
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
                // Resize the image
                imagecopyresampled($resizedImage, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
    
                // Save resized image
                if ($fileType == 'jpg' || $fileType == 'jpeg') {
                    $outputFile = 'resized_image_' . time() . '.jpg';
                    imagejpeg($resizedImage, $targetFilePath);
                } elseif ($fileType == 'png') {
                    imagepng($resizedImage, $targetFilePath);
                } elseif ($fileType == 'gif') {
                    imagegif($resizedImage, $targetFilePath);
                }
    
                // Free up memory
                imagedestroy($imageResource);
                imagedestroy($resizedImage);
            } 
        } else {
            $full_photo_name = $existingData['full_photo'];
        }
        
        
        $passport_size_photoDir = $baseDir . '/passport_size_photo/';
        if (!is_dir($passport_size_photoDir)) {
            mkdir($passport_size_photoDir, 0777, true);
        }
        
        $targetPassDir = $passport_size_photoDir;
        $file_Name = basename($_FILES['passport_size_photo']['name']);
        $targetPassFilePath = $targetPassDir . $file_Name;
        
        // File type
        $fileType = pathinfo($targetPassFilePath, PATHINFO_EXTENSION);
        
        // Check if the file is an image
        $check = getimagesize($_FILES['passport_size_photo']['tmp_name']);
        $passport_size_photo_name = "";
        if ($check !== false) {
            // File is an image
            unlink($full_photoDir. $file_Name);
            $passport_size_photo_name = $file_Name;
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Resize image by 40%
                $resizePercent = 0.4; // 60% of original size
                $imageResource = null;
    
                // Load image based on its type
                if ($fileType == 'jpg' || $fileType == 'jpeg') {
                    $imageResource = imagecreatefromjpeg($_FILES['passport_size_photo']['tmp_name']);
                } elseif ($fileType == 'png') {
                    $imageResource = imagecreatefrompng($_FILES['passport_size_photo']['tmp_name']);
                } elseif ($fileType == 'gif') {
                    $imageResource = imagecreatefromgif($_FILES['passport_size_photo']['tmp_name']);
                }
    
                // Get original image dimensions
                $origWidth = imagesx($imageResource);
                $origHeight = imagesy($imageResource);
    
                // Calculate new dimensions
                $newWidth = $origWidth * $resizePercent;
                $newHeight = $origHeight * $resizePercent;
    
                // Create a new true color image
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
                // Resize the image
                imagecopyresampled($resizedImage, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
    
                // Save resized image
                if ($fileType == 'jpg' || $fileType == 'jpeg') {
                    imagejpeg($resizedImage, $targetPassFilePath);
                } elseif ($fileType == 'png') {
                    imagepng($resizedImage, $targetPassFilePath);
                } elseif ($fileType == 'gif') {
                    imagegif($resizedImage, $targetPassFilePath);
                }
    
                // Free up memory
                imagedestroy($imageResource);
                imagedestroy($resizedImage);
    
                echo "Image has been resized and uploaded successfully.";
            } else {
                echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
            }
        } else {
            $passport_size_photo_name = $existingData['passport_size_photo'];
        }
        
        $biodataDir = $baseDir . '/biodata/';
        
        if (!is_dir($biodataDir)) {
            mkdir($biodataDir, 0777, true);
        }

        // Initialize variables to hold file names
        // $full_photo_name = $existingData['full_photo']; // Default to existing file
        // $passport_size_photo_name = $existingData['passport_size_photo']; // Default to existing file
        // $biodataName = $existingData['biodata']; // Default to existing file

        // // Upload full photo if exists
        // if (!empty($full_photo['name'])) {
        //     $full_photo_name = basename($full_photo['name']);
        //     move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
        // }

        // // Upload passport size photo if exists
        // if (!empty($passport_size_photo['name'])) {
        //     $passport_size_photo_name = basename($passport_size_photo['name']);
        //     move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
        // }

        // // Upload biodata if exists
        // if (!empty($biodata['name'])) {
        //     $biodataName = basename($biodata['name']);
        //     move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
        // }
        $maxFileSize = 1 * 1024 * 1024;

        // Validate full photo size
        /*if (!empty($full_photo['name'])) {
            if ($full_photo['size'] > $maxFileSize) {
                echo "<script>alert('Error: Full photo size exceeds 1MB.')</script>";
                exit;
            } else {
                $full_photo_name = basename($full_photo['name']);
                move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
            }
        }*/
        // if (!empty($full_photo['name'])) {
        //     // if ($full_photo['size'] > $maxFileSize) {
        //     //     echo "<script>alert('Error: Full photo size exceeds 1MB.')</script>";
        //     //     exit;
        //     // } else {
        //         // Example usage
                
        //         $full_photo_name = basename($full_photo['name']);
        //         $sourceImage = $full_photo_name;
        //         print_r(getimagesize($sourceImage)[0]);
        //         exit;
                
        //         $destinationImage = $full_photoDir;
        //         $newWidth = 0.6 * getimagesize($sourceImage)[0]; // Reduce width by 40%
        //         resizeImage($sourceImage, $destinationImage, $newWidth);
        //         print_r($full_photo['name']);
        //         exit;
                
        //         $sourceImage = $full_photo_name;
        //         $destinationImage = $full_photoDir;
        //         $newWidth = 0.6 * getimagesize($sourceImage)[0]; // Reduce width by 40%
        //         resizeImage($sourceImage, $destinationImage, $newWidth);
                
        //         // $full_photo_name = basename($full_photo['name']);
        //         // move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
                
        //     // }
        // }

        // Validate passport size photo size
        // if (!empty($passport_size_photo['name'])) {
        //     if ($passport_size_photo['size'] > $maxFileSize) {
        //         echo "<script>alert('Error: Passport size photo size exceeds 1MB.')</script>";
        //         exit;
        //     } else {
        //         $passport_size_photo_name = basename($passport_size_photo['name']);
        //         move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
        //     }
        // }

        // Validate biodata size (PDF)
        /*if (!empty($biodata['name'])) {
            if ($biodata['size'] > $maxFileSize) {
                echo "<script>alert('Error: Biodata (PDF) size exceeds 1MB.')</script>";
                exit;
            } else {
                $biodataName = basename($biodata['name']);
                move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
            }
        }*/

        // Prepare update query
        $updated_sql_query = "
            UPDATE `matrimony`
            SET 
                `height`='$height',
                `weight`='$weight',
                `birth_place`='$birth_place',
                `birth_time`='$birth_time',
                `hobby`='$hobby',
                `spectacles`='$spectacles',
                `mangal`='$mangal',
                `sani`='$sani',
                `annual_income`='$annual_income',
                `full_photo`='$full_photo_name',
                `passport_size_photo`='$passport_size_photo_name',
                `biodata`='$biodataName',
                `MotherFathersName`='".$_POST['MotherFathersName']."',
                `MotherFathersNative`='".$_POST['MotherFathersNative']."',
                `strInstagramLink`= '".$_POST['strInstagramLink']."',
                `strFacebookLink`='".$_POST['strFacebookLink']."',
                `isHandicap`='".$_POST['isHandicap']."',
                `strHandicapDescription`='".$_POST['strHandicapDescription']."',
                `strUpdatedDate` = '".date('Y-m-d H:i:s')."'
                WHERE id='$user_fetch_data_id'";
        //echo $updated_sql_query;
        // Execute the query
        $result = $cn->query($updated_sql_query);

        if ($result) {
            header("Location:user-familydet.php");
            exit();
        } else {
            echo "Error: " . $cn->error;
        }
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $height = implode(".", $_POST['height']);
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
        
        $targetDir = $full_photoDir;
        $fileName = basename($_FILES['full_photo']['name']);
        $targetFilePath = $targetDir . $fileName;
        
        // File type
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        // Check if the file is an image
        $check = getimagesize($_FILES['full_photo']['tmp_name']);
        $full_photo_name = "";
        if ($check !== false) {
            // File is an image
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Resize image by 40%
                $resizePercent = 0.4; // 60% of original size
                $imageResource = null;
    
                // Load image based on its type
                if ($fileType == 'jpg' || $fileType == 'jpeg') {
                    $imageResource = imagecreatefromjpeg($_FILES['full_photo']['tmp_name']);
                } elseif ($fileType == 'png') {
                    $imageResource = imagecreatefrompng($_FILES['full_photo']['tmp_name']);
                } elseif ($fileType == 'gif') {
                    $imageResource = imagecreatefromgif($_FILES['full_photo']['tmp_name']);
                }
    
                // Get original image dimensions
                $origWidth = imagesx($imageResource);
                $origHeight = imagesy($imageResource);
    
                // Calculate new dimensions
                $newWidth = $origWidth * $resizePercent;
                $newHeight = $origHeight * $resizePercent;
    
                // Create a new true color image
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
                // Resize the image
                imagecopyresampled($resizedImage, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
    
                // Save resized image
                if ($fileType == 'jpg' || $fileType == 'jpeg') {
                    imagejpeg($resizedImage, $targetFilePath);
                } elseif ($fileType == 'png') {
                    imagepng($resizedImage, $targetFilePath);
                } elseif ($fileType == 'gif') {
                    imagegif($resizedImage, $targetFilePath);
                }
    
                // Free up memory
                imagedestroy($imageResource);
                imagedestroy($resizedImage);
            } 
        } else {
            $full_photo_name = $existingData['full_photo'];
        }
        
        
        if (!is_dir($passport_size_photoDir)) {
            mkdir($passport_size_photoDir, 0777, true);
        }
        
        $targetPassDir = $passport_size_photoDir;
        $file_Name = basename($_FILES['passport_size_photo']['name']);
        $targetPassFilePath = $targetPassDir . $file_Name;
        
        // File type
        $fileType = pathinfo($targetPassFilePath, PATHINFO_EXTENSION);
        
        // Check if the file is an image
        $check = getimagesize($_FILES['passport_size_photo']['tmp_name']);
        $passport_size_photo_name = "";
        if ($check !== false) {
            // File is an image
            unlink($full_photoDir. $file_Name);
            $passport_size_photo_name = $file_Name;
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Resize image by 40%
                $resizePercent = 0.4; // 60% of original size
                $imageResource = null;
    
                // Load image based on its type
                if ($fileType == 'jpg' || $fileType == 'jpeg') {
                    $imageResource = imagecreatefromjpeg($_FILES['passport_size_photo']['tmp_name']);
                } elseif ($fileType == 'png') {
                    $imageResource = imagecreatefrompng($_FILES['passport_size_photo']['tmp_name']);
                } elseif ($fileType == 'gif') {
                    $imageResource = imagecreatefromgif($_FILES['passport_size_photo']['tmp_name']);
                }
    
                // Get original image dimensions
                $origWidth = imagesx($imageResource);
                $origHeight = imagesy($imageResource);
    
                // Calculate new dimensions
                $newWidth = $origWidth * $resizePercent;
                $newHeight = $origHeight * $resizePercent;
    
                // Create a new true color image
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
                // Resize the image
                imagecopyresampled($resizedImage, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
    
                // Save resized image
                if ($fileType == 'jpg' || $fileType == 'jpeg') {
                    imagejpeg($resizedImage, $targetPassFilePath);
                } elseif ($fileType == 'png') {
                    imagepng($resizedImage, $targetPassFilePath);
                } elseif ($fileType == 'gif') {
                    imagegif($resizedImage, $targetPassFilePath);
                }
    
                // Free up memory
                imagedestroy($imageResource);
                imagedestroy($resizedImage);
    
                echo "Image has been resized and uploaded successfully.";
            } else {
                echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
            }
        } else {
            $passport_size_photo_name = $existingData['passport_size_photo'];
        }
        
        if (!is_dir($biodataDir)) {
            mkdir($biodataDir, 0777, true);
        }

        // $full_photo_name = '';
        // $passport_size_photo_name = '';
        // $biodataName = '';

        // // Upload full photo if exists
        // if (!empty($full_photo['name'])) {
        //     $full_photo_name = basename($full_photo['name']);
        //     move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
        // }

        // // Upload passport size photo if exists
        // if (!empty($passport_size_photo['name'])) {
        //     $passport_size_photo_name = basename($passport_size_photo['name']);
        //     move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
        // }

        // // Upload biodata if exists
        // if (!empty($biodata['name'])) {
        //     $biodataName = basename($biodata['name']);
        //     move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
        // }

        $maxFileSize = 1 * 1024 * 1024;

        // Validate full photo size
        /*if (!empty($full_photo['name'])) {
            // if ($full_photo['size'] > $maxFileSize) {
            //     echo "<script>alert('Error: Full photo size exceeds 1MB.')</script>";
            //     exit;
            // } else {
                // Example usage
                //print_r($_POST);
                $full_photo_name = basename($full_photo['name']);
                $sourceImage = $full_photo_name;
                print_r(getimagesize($sourceImage)[0]);
                exit;
                
                $destinationImage = $full_photoDir;
                $newWidth = 0.6 * getimagesize($sourceImage)[0]; // Reduce width by 40%
                resizeImage($sourceImage, $destinationImage, $newWidth);
                print_r($full_photo['name']);
                exit;
                // $full_photo_name = basename($full_photo['name']);
                // move_uploaded_file($full_photo['tmp_name'], $full_photoDir . $full_photo_name);
                
            // }
        }*/

        // Validate passport size photo size
        /*if (!empty($passport_size_photo['name'])) {
            if ($passport_size_photo['size'] > $maxFileSize) {
                echo "<script>alert('Error: Passport size photo size exceeds 1MB.')</script>";
                exit;
            } else {
                $passport_size_photo_name = basename($passport_size_photo['name']);
                move_uploaded_file($passport_size_photo['tmp_name'], $passport_size_photoDir . $passport_size_photo_name);
            }
        }*/

        // Validate biodata size (PDF)
        /*if (!empty($biodata['name'])) {
            if ($biodata['size'] > $maxFileSize) {
                echo "<script>alert('Error: Biodata (PDF) size exceeds 1MB.')</script>";
                exit;
            } else {
                $biodataName = basename($biodata['name']);
                move_uploaded_file($biodata['tmp_name'], $biodataDir . $biodataName);
            }
        }*/


        $sql = "INSERT INTO `matrimony`(`user_id`,`height`, `weight`, `birth_place`,`birth_time`,`hobby`, `spectacles`, `mangal`,`sani`, `annual_income`, `full_photo`,`passport_size_photo`, `biodata`,`MotherFathersName`,`MotherFathersNative`,`strInstagramLink`,`strFacebookLink`,`isHandicap`,`strHandicapDescription`,`strEntryDate`) 
                    VALUES ($user_id,'$height','$weight','$birth_place','$birth_time','$hobby','$spectacles','$mangal','$sani','$annual_income','$full_photo_db','$passport_size_photo_db','$biodataName','".$_POST['MotherFathersName']."','".$_POST['MotherFathersNative']."','".$_POST['strInstagramLink']."','".$_POST['strFacebookLink']."','".$_POST['isHandicap']."','".$_POST['strHandicapDescription']."','".date('Y-m-d H:i:s')."')";

        $result = $cn->query($sql);

        if ($result) {
            header("Location:user-familydet.php");
            exit();
        } else {
            echo "Error: " . $cn->error;
        }
    }
}

?>


<body>

    <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" valign="top" bgcolor="#ffffff">
                <table width="1003" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right" valign="top" background="images/top_bg.jpg" style="background-position:top; background-repeat:no-repeat;">
                            <table width="500" border="0" cellspacing="0" cellpadding="0">

                                <tr>
                                    <td height="99" align="left" valign="top"><a href="index.html"><img src="images/spacer.gif" alt="" width="484" height="99" /></a></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    shyam <td height="34">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="59">
                                    <td>
                                        <table width="475" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td colspan="2"><?php include "advt_incl.php"; ?></td>
                                            </tr>
                                            <tr>
                                                <td height="7"></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="41" align="center" valign="middle" background="images/menu_bg.jpg" style="background-repeat:repeat-x">
                            <?php include_once "menu.php"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <table width="1003" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td height="22" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">
                                        <table width="97%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" valign="top" class="border1">
                                                    <table width="98%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top" class="border1">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tr bgcolor="#f2f2f2">
                                                                        <td width="2%" height="37">&nbsp;</td>
                                                                        <td height="37" align="left" valign="middle" class="title">
                                                                            Apply for MEDK matrimonial
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <div class="row">
                                                                 <?php
                                               $sql_card = "select 
          v.*, 	v1.addr1 as paraddr1, v1.addr2 as paraddr2, v1.addr3 as paraddr3,v1.pincode as parpincode,v1.fname_vc as parfname,v1.lname_vc as parlname,
					v2.lname_vc as mainparlname,v2.addr1 as mainparaddr1, v2.addr2 as mainparaddr2, v2.addr3 as mainparaddr3,v2.pincode as mainparpincode,city2.city_name as mainparcity, state2.state_name as mainparstate,
					bdir.business_id,bdir.prof_type,
          bdir.bness_cat_id,bdir.bness_subcat_id,bdir.bness_name,bdir.bness_addr,
          bdir.bness_phone,bdir.bness_mobile,bdir.bness_desc,bdir.prof_cat_id,

          bdir.prof_subcat_id,bdir.prof_addr,bdir.prof_phone,bdir.prof_mobile,
          bdir.prof_desc,bdir.comp_name,bdir.job_type,bdir.job_ind_id,
          bdir.job_desig,bdir.job_addr,bdir.job_phone,bdir.job_mobile,
          bdir.job_addr1,bdir.job_addr2,bdir.job_addr3,bdir.job_country,
          bdir.job_state,bdir.job_city,bdir.job_district,bdir.job_pincode,

					edu1.education_name as basicqual,edu2.education_name as pgqual,edu3.education_name as docqual,
					m.marital_name,
					city.city_name, state.state_name, city1.city_name as parcity,state1.state_name as parstate,
					jc.city_name as jcity, js.state_name as jstate,
					bc.group_name as b_main_group_name,ind.ind_value as ind_name,
					jobc.group_name as j_group_name, jobind.ind_value as job_ind_name,
					pc.group_name as p_main_group_name,pc1.group_name as p_sub_group_name,vill.village_name,
					(select parent.mobile_number from vastipatrak_m AS parent where parent.vasti_id = v.anc_id) as father_mobile_number,
					(select concat(parent.fname_vc,' ',parent.mname_vc,' ',parent.lname_vc) from vastipatrak_m AS parent where parent.vasti_id = v.anc_id) as father_Name,
					g.gotra_name,
					v.blood_group AS bloodGroupName,
    (select concat(m.fname_vc,' ',m.mname_vc,' ',m.lname_vc) from vastipatrak_m as m where m.anc_id=v.anc_id and m.relation_id in (10,13) and m.gender_c='female' limit 1) as motherName,
    (select maritalIn from vastipatrak_m as m where m.anc_id=v.parent_id and m.relation_id=10 and m.gender_c='female' limit 1) as m_maritalIn,
    (select m.mobile_number from vastipatrak_m as m where m.anc_id=v.anc_id and m.relation_id in (10,13) and m.gender_c='female' limit 1) as motherMobile
						from vastipatrak_m v
							left outer join vastipatrak_m v1 on v.parent_id = v1.vasti_id
							left outer join vastipatrak_m v2 on v1.parent_id = v2.vasti_id
							
							left outer join gotra_m g on v.gotra_id = g.gotra_id  
							left outer join village_m vill on v.village_id = vill.village_id
							left outer join marital_m m on v.marital_id = m.marital_id  
							
							left outer join businessdir_m bdir on v.vasti_id = bdir.vasti_id
							
							left outer join bdir_category bc on bdir.bness_cat_id = bc.sub_id
							left outer join industry_m ind on bdir.bness_subcat_id = ind.ind_id
							
							left outer join bdir_category pc on bdir.prof_cat_id = pc.sub_id
							left outer join bdir_category pc1 on bdir.prof_subcat_id = pc1.sub_id
							
							left outer join bdir_category jobc on bdir.job_type = jobc.sub_id
							left outer join industry_m jobind on bdir.job_ind_id = jobind.ind_id

							left outer join city_m city on v.city = city.city_id
							left outer join state_m state on v.state = state.state_id
							
							left outer join city_m city1 on v1.city = city1.city_id
							left outer join state_m state1 on v1.state = state1.state_id
							
							left outer join city_m city2 on v2.city = city2.city_id
							left outer join state_m state2 on v2.state = state2.state_id
							
							left outer join city_m jc on bdir.job_city = jc.city_id
							left outer join state_m js on bdir.job_state = js.state_id
							
							left outer join education_m edu1 on v.basic_qual = edu1.education_id
							left outer join education_m edu2 on v.pg_qual = edu2.education_id
							left outer join education_m edu3 on v.doc_qual = edu3.education_id

							where v.vasti_id= '$user_id'";


                                                            $result_row = $cn->query($sql_card);
                                                            $row_result = $result_row->fetch_assoc();
                                                            // echo "<pre>";
                                                            // print_r($row_result);
                                                            // die;
                                                            ?>
                                                        <div class="col-lg-7">
                                                            <?php
                                                            if ($user_fetch_data_id != "") {
                                                            ?>
                                                                <form id="update_matrimonyForm" method="POST" enctype="multipart/form-data">
                                                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                                        <!-- Height Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Height <strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <div class="row align-items-center"> <!-- Added align-items-center for vertical alignment -->
                                                                                    <div class="col-lg-2">
                                                                                        <!-- <input type="text" id="restrictedInput" name="height[]" placeholder="5 ft" minlength="1" style="width: 144%;" maxlength="1"
                                                                                            oninput="validateInput(this)" value="<?= $height[0]; ?>"> -->
                                                                                        <select name="height[]" style="width: 144%;" required>
                                                                                            <option value="4" <?php echo (isset($height[0]) && $height[0] == '4') ? 'selected' : ''; ?>>4 ft</option>
                                                                                            <option value="5" <?php echo (isset($height[0]) && $height[0] == '5') ? 'selected' : ''; ?>>5 ft</option>
                                                                                            <option value="6" <?php echo (isset($height[0]) && $height[0] == '6') ? 'selected' : ''; ?>>6 ft</option>
                                                                                            <option value="7" <?php echo (isset($height[0]) && $height[0] == '7') ? 'selected' : ''; ?>>7 ft</option>
                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="col-lg-1 text-center"> <!-- Added text-center for center alignment -->
                                                                                        <label class="form-label mb-0">.</label> <!-- Removed for attribute since it's not needed -->
                                                                                    </div>

                                                                                    <div class="col-lg-2">
                                                                                        <!-- <input type="number" id="numberInput" name="height[]" min="1" placeholder="6 inch" max="12" maxlength="2" oninput="validateInput_inch(this)" style="width: 144%;" value=""> -->
                                                                                        <select name="height[]" style="width: 144%;">
                                                                                            <option value="1" <?php echo (isset($height[1]) && $height[1] == '1') ? 'selected' : ''; ?>>1 inch</option>
                                                                                            <option value="2" <?php echo (isset($height[1]) && $height[1] == '2') ? 'selected' : ''; ?>>2 inch</option>
                                                                                            <option value="3" <?php echo (isset($height[1]) && $height[1] == '3') ? 'selected' : ''; ?>>3 inch</option>
                                                                                            <option value="4" <?php echo (isset($height[1]) && $height[1] == '4') ? 'selected' : ''; ?>>4 inch</option>
                                                                                            <option value="5" <?php echo (isset($height[1]) && $height[1] == '5') ? 'selected' : ''; ?>>5 inch</option>
                                                                                            <option value="6" <?php echo (isset($height[1]) && $height[1] == '6') ? 'selected' : ''; ?>>6 inch</option>
                                                                                            <option value="7" <?php echo (isset($height[1]) && $height[1] == '7') ? 'selected' : ''; ?>>7 inch</option>
                                                                                            <option value="8" <?php echo (isset($height[1]) && $height[1] == '8') ? 'selected' : ''; ?>>8 inch</option>
                                                                                            <option value="9" <?php echo (isset($height[1]) && $height[1] == '9') ? 'selected' : ''; ?>>9 inch</option>
                                                                                            <option value="10" <?php echo (isset($height[1]) && $height[1] == '10') ? 'selected' : ''; ?>>10 inch</option>
                                                                                            <option value="11" <?php echo (isset($height[1]) && $height[1] == '11') ? 'selected' : ''; ?>>11 inch</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Weight Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Weight <small>(in Kg's)</small> <strong>*</strong> </td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="number" name="weight" id="weight" placeholder="Weight in kg" style="width: 55%;" maxlength="25" required value="<?= $row['weight']; ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Birth Place Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Place <strong>*</strong> </td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="birth_place" id="birth_place" placeholder="Birth Place" style="width: 55%;" maxlength="50" required value="<?= $row['birth_place']; ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Birth Time Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Date & Time <strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <?php $birth_time = str_replace(' ', 'T', substr($row['birth_time'], 0, 16)); ?>
                                                                                <input type="datetime-local" name="birth_time" id="birth_time" style="width: 55%;" required value="<?= $birth_time; ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Mother Fathers Name Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Mother Father's Name <strong>*</strong> </td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="MotherFathersName" id="MotherFathersName" placeholder="Mother Father's Name" style="width: 55%;" maxlength="250" required value="<?= $row['MotherFathersName']; ?>">
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <!-- Mother Fathers Native Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Mother Father's Native <strong>*</strong> </td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                  <?php 
                                                                                if($row_result['m_maritalIn']==1 || $row_result['m_maritalIn']==0){ ?>
                                                                                <select name="MotherFathersNative" id="MotherFathersNative" style="width: 55%;" required>
                                                                                    <option value="">Select..</option>
                                                                                    <?php
                                                                                          $sql_string = "SELECT * FROM village_m order by village_name";
                        
                                                                                          $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                                                                          if (mysqli_num_rows($check_res) > 0) {
                                                                                            while ($rec = mysqli_fetch_array($check_res)) {
                                                                                              if (isset($row['MotherFathersNative']) && $row['MotherFathersNative'] == $rec['village_id']){
                                                                                                echo ("<option selected value ='" . $rec['village_id'] . "'>" . ucwords(strtolower($rec['village_name'])) . "</option>");
                                                                                              } 
                                                                                              else {
                                                                                                echo ("<option value='" . $rec['village_id'] . "'>" . ucwords(strtolower($rec['village_name'])) . "</option>");
                                                                                              }
                                                                                            
                                                                                            }
                                                                                            if (isset($row['MotherFathersNative']) && $row['MotherFathersNative'] == "-1"){
                                                                                                echo ("<option value='-1' selected>" . ucwords(strtolower("Out of MEDK")) . "</option>");
                                                                                            } else {
                                                                                                echo ("<option value='-1'>" . ucwords(strtolower("Out of MEDK")) . "</option>");
                                                                                            }
                                                                                          }
                                                                                          ?>
                                                                                </select>
                                                                                <?php } else { ?>
                                                                                <input type="text" name="MotherFathersNative" id="MotherFathersNative" placeholder="Mother Father's Native" style="width: 55%;" maxlength="250" required value="<?php echo $row['MotherFathersNative'];?>">  
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <!-- hobby Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Hobby</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="hobby" id="hobby" style="width: 55%;" maxlength="50" value="<?= $row['hobby'] ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Spectacles Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="17%" class="text_user" style="padding-left:5px; font-weight: bold;">Spectacles Contact lens/ Spec lens</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="spectacles" id="spectacles" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0" <?php echo ($row['spectacles'] == '0') ? 'selected' : ''; ?>>Yes</option>
                                                                                    <option value="1" <?php echo ($row['spectacles'] == '1') ? 'selected' : ''; ?>>No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Mangal Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Mangal</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="mangal" id="mangal" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0" <?php echo ($row['mangal'] == '0') ? 'selected' : ''; ?>>Yes</option>
                                                                                    <option value="1" <?php echo ($row['mangal'] == '1') ? 'selected' : ''; ?>>No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Shani Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Shani</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="sani" id="sani" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0" <?php echo ($row['sani'] == '0') ? 'selected' : ''; ?>>Yes</option>
                                                                                    <option value="1" <?php echo ($row['sani'] == '1') ? 'selected' : ''; ?>>No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Annual Income Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Annual Income <br /> <small><strong>(in Rs.)</strong></small> </td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="annual_income" id="annual_income" placeholder="Annual Income" value="<?= $row['annual_income'] ?>" maxlength="50" style="width: 55%;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Facebook link</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="strFacebookLink" id="strFacebookLink" style="width: 55%;" maxlength="250" value="<?= $row['strFacebookLink'] ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Instagram Link</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="strInstagramLink" id="strInstagramLink" style="width: 55%;" maxlength="250" value="<?= $row['strInstagramLink'] ?>">
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Is Handicap</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="isHandicap" id="isHandicap" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0" <?php echo ($row['isHandicap'] == '0') ? 'selected' : ''; ?>>No</option>
                                                                                    <option value="1" <?php echo ($row['isHandicap'] == '1') ? 'selected' : ''; ?>>Yes</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- isHandicap strHandicapDescription -->
                                                                        <tr bgcolor="#FFFFFF" class="text" style="display: none" id="trHandicap">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Handicap Description</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <textarea name="strHandicapDescription" id="strHandicapDescription" style="width: 55%;" maxlength="250"><?= $row['strHandicapDescription'] ?></textarea>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Full Passport Size Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Passport Size Photo <strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="passport_size_photo" name="passport_size_photo" accept="image/*">
                                                                                <div id="passport_size_error" style="color:red;"></div>
                                                                            </td>
                                                                            <?php
                                                                            $img = $row['user_id'];
                                                                            $img_path = $row['passport_size_photo'];
                                                                            ?>
                                                                            <td class="mt-1 mb-1">
                                                                                <img src="<?php echo '/documents/' . $img . '/passport_size_photo/' . $img_path; ?>" alt="Passport Size Photo" style="height: 50px;width: 50px;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Full Photo Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Full Photo </td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="full_photo" name="full_photo" accept="image/*">
                                                                                <div id="full_photo_error" style="color:red;"></div>
                                                                            </td>
                                                                            <?php
                                                                            $img = $row['user_id'];
                                                                            $img_path = $row['full_photo'];
                                                                            ?>
                                                                            <td class="mt-1 mb-1">
                                                                                <img src="<?php echo '/documents/' . $img . '/full_photo/' . $img_path; ?>" alt="Full Photo" style="height: 50px;width: 50px;">
                                                                            </td>

                                                                        </tr>
                                                                        
                                                                        <!-- Biodata Input -->
                                                                        <!--<tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Biodata (PDF) (1mb max)</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="biodata" name="biodata" accept=".pdf">
                                                                                <div id="biodata_error" style="color:red;"></div>
                                                                            </td>
                                                                            <?php
                                                                            $img = $row['user_id'];
                                                                            $img_path = $row['biodata'];
                                                                            ?>
                                                                            <?php
                                                                            if ($img_path == "") {
                                                                            ?>

                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <td><a href="<?php echo '/documents/' . $img . '/biodata/' . $img_path; ?>"
                                                                                        target="_blank" title="pdf">
                                                                                        <img src="<?php echo '/images_extension/pdf.jpg' ?>"
                                                                                            alt="" height="30" width="30">
                                                                                    </a></td>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </tr>-->
                                                                    </table>

                                                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr bgcolor="#f2f2f2">
                                                                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                                            <td width="45%" align="left" valign="middle" bgcolor="#ffffff">
                                                                                <div align="start">
                                                                                    <input name="submit1" type="submit" value="Update" width="71" height="24" border="0">
                                                                                </div>
                                                                            </td>
                                                                            <td width="53%" align="left" valign="middle" bgcolor="#ffffff">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </form>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <form id="matrimonyForm" method="POST" enctype="multipart/form-data">
                                                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                                        <!-- Height Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Height <strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <div class="row align-items-center"> <!-- Added align-items-center for vertical alignment -->
                                                                                    <div class="col-lg-2">
                                                                                        <!-- <input type="text" id="restrictedInput" name="height[]" placeholder="5 ft" minlength="1" style="width: 144%;" maxlength="1" required
                                                                                            oninput="validateInput(this)"> -->
                                                                                        <select name="height[]" required>
                                                                                            <option value="">Height</option>
                                                                                            <option value="4">4 ft</option>
                                                                                            <option value="5">5 ft</option>
                                                                                            <option value="6">6 ft</option>
                                                                                            <option value="7">7 ft</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-1 text-center"> <!-- Added text-center for center alignment -->
                                                                                        <label class="form-label mb-0">.</label> <!-- Removed for attribute since it's not needed -->
                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <!-- <input type="number" name="height[]" id="inch" placeholder="6 inch" style="width: 144%;margin-left: -50%;" max="12" min="0" maxlength="1" minlength="1" required> -->
                                                                                        <!-- <input type="number" id="numberInput" name="height[]" min="1" placeholder="6 inch" max="12" maxlength="2" oninput="validateInput_inch(this)" style="width: 144%;" required> -->
                                                                                        <select name="height[]" id="inch">
                                                                                            <option value="">Inch</option>
                                                                                            <option value="1">1 inch</option>
                                                                                            <option value="2">2 inch</option>
                                                                                            <option value="3">3 inch</option>
                                                                                            <option value="4">4 inch</option>
                                                                                            <option value="5">5 inch</option>
                                                                                            <option value="6">6 inch</option>
                                                                                            <option value="7">7 inch</option>
                                                                                            <option value="8">8 inch</option>
                                                                                            <option value="9">9 inch</option>
                                                                                            <option value="10">10 inch</option>
                                                                                            <option value="11">11 inch</option>
                                                                                        </select>

                                                                                    </div>
                                                                                </div>
                                                                                <!-- <div id="error-message" style="color: red; display: none;">Please enter a number between 0 and 7</div> -->

                                                                            </td>
                                                                        </tr>
                                                                        <!-- Weight Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Weight <strong>*</strong> <small>(in Kg's)</small> </td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="number" name="weight" id="weight" placeholder="Weight in kg" style="width: 55%;" maxlength="25" required>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Birth Place Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Place<strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="birth_place" id="birth_place" placeholder="Birth Place" style="width: 55%;" maxlength="50" required>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Birth Time Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Birth Date & Time <strong>*</strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="datetime-local" name="birth_time" id="birth_time" style="width: 55%;" maxlength="50" required>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <!-- Mother Fathers Name Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Mother Father's Name <strong>*</strong> </td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="MotherFathersName" id="MotherFathersName" placeholder="Mother Father's Name" style="width: 55%;" maxlength="250" required>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <!-- Mother Fathers Native Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Mother Father's Native <strong>*</strong> </td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <?php 
                                                                                if($row_result['m_maritalIn']==1 || $row_result['m_maritalIn']==0){ ?>
                                                                                <select name="MotherFathersNative" id="MotherFathersNative" style="width: 55%;" required>
                                                                                    <option value="">Select..</option>
                                                                                    <?php
                                                                                      $sql_string = "SELECT * FROM village_m order by village_name";
                                                                                      $check_res = mysqli_query($cn, $sql_string) or die(mysqli_error($cn));
                                                                                      if (mysqli_num_rows($check_res) > 0) {
                                                                                        while ($rec = mysqli_fetch_array($check_res)) {
                                                                                            echo ("<option value='" . $rec['village_id'] . "'>" . ucwords(strtolower($rec['village_name'])) . "</option>");
                                                                                        }
                                                                                      }
                                                                                    
                                                                                }else {
                                                                                    ?>
                                                                                    
                                                                                   <input type="text" name="MotherFathersNative" id="MotherFathersNative" placeholder="Mother Father's Native" style="width: 55%;" maxlength="250" required>  
                                                                                   <?php
                                                                                }
                                                                                      ?>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- hobby Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Hobby</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="hobby" id="hobby" style="width: 55%;" maxlength="50">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Spectacles Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="17%" class="text_user" style="padding-left:5px; font-weight: bold;">Spectacles Contact lens/ Spec lens</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="spectacles" id="spectacles" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0">Yes</option>
                                                                                    <option value="1">No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Mangal Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Mangal</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="mangal" id="mangal" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0">Yes</option>
                                                                                    <option value="1">No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Shani Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Shani</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="sani" id="sani" style="width: 55%;">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0">Yes</option>
                                                                                    <option value="1">No</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Annual Income Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Annual Income <small><strong>(in Rs.)</strong></small></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="annual_income" id="annual_income" placeholder="Annual Income" maxlength="50" style="width: 55%;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Facebook link</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="strFacebookLink" id="strFacebookLink" style="width: 55%;" maxlength="250" />
                                                                            </td>
                                                                        </tr>
                                                                        <!-- strInstagramLink strFacebookLink -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Instagram Link</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="text" name="strInstagramLink" id="strInstagramLink" style="width: 55%;" maxlength="250" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Is Handicap</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <select name="isHandicap" id="is_Handicap" style="width: 55%;" onchange="check_Handicap();">
                                                                                    <option selected disabled>Select..</option>
                                                                                    <option value="0">No</option>
                                                                                    <option value="1">Yes</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr bgcolor="#FFFFFF" class="text" style="display: none" id="tr_Handicap">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Handicap Description</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <textarea name="strHandicapDescription" id="strHandicapDescription" style="width: 55%;" maxlength="250"></textarea>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Passport Size Photo Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Passport Size Photo<strong></strong></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="passport_size_photo_add" name="passport_size_photo">
                                                                                <div id="passport_size_error" style="color:red;"></div>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Full Photo Input -->
                                                                        <tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Full Photo</td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="full_photo_add" name="full_photo">
                                                                                <div id="full_photo_error" style="color:red;"></div>
                                                                            </td>
                                                                        </tr>

                                                                        

                                                                        <!-- Biodata Input -->
                                                                        <!--<tr bgcolor="#FFFFFF" class="text">
                                                                            <td width="14%" class="text_user" style="padding-left:5px; font-weight: bold;">Biodata (PDF) <small>(1mb max)</small></td>
                                                                            <td height="35" colspan="2" class="text_user">
                                                                                <input type="file" id="biodata_add" name="biodata">
                                                                                <div id="biodata_error" style="color:red;"></div>
                                                                            </td>
                                                                        </tr>-->
                                                                    </table>

                                                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr bgcolor="#f2f2f2">
                                                                            <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
                                                                            <td width="45%" align="left" valign="middle" bgcolor="#ffffff">
                                                                                <div align="start">
                                                                                    <input name="submit1" type="submit" value="Submit" width="71" height="24" border="0">
                                                                                </div>
                                                                            </td>
                                                                            <td width="53%" align="left" valign="middle" bgcolor="#ffffff">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </form>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class="col-lg-5">
                                                   

                                                            <div class="card bg-white shadow-sm mt-3" style="margin-right: 15px;">
                                                                <div class="card-body">
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Note:</b> <b><small>Data from V.P. My Family.<br /> If any change required, go to my family & edit your profile.</small></b></span>
                                                                    </div>
                                                                    <hr />
                                                                    <table>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Father Name:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['father_Name']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Father Number:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['father_mobile_number']; ?></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Mother Name:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['motherName']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Mother Number:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['motherMobile']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Self Number:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['mobile_number']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Self Email:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['email']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Basic/ Graduate:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php echo $row_result['basicqual'];
                                                                                                    if ($row_result['bq_det'] != "") {
                                                                                                      echo " (" . $row_result['bq_det'] . ") ";
                                                                                                    } ?> </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Post Graduate:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php echo $row_result['pgqual'];
                                                                                                                if ($row_result['pg_det'] != "") {
                                                                                                                  echo " (" . $row_result['pg_det'] . ") ";
                                                                                                                } ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Doctrate: </td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php echo $row_result['docqual'];
                                                                                                    if ($row_result['doc_det'] != "") {
                                                                                                      echo " (" . $row_result['doc_det'] . ") ";
                                                                                                    } ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Native Place:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['village_name']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Gotra:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['gotra_name']; ?></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Blood Group:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['bloodGroupName']; ?></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Current City:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['city_name']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Marital Status:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?= $row_result['marital_name']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan=2 class="text_user" style="padding-left:5px; font-weight: bold;text-align: center; text-decoration: underline;">Current Activity </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text_user" style="padding-left:5px; font-weight: bold;">Type:</td>
                                                                            <td class="text_user" style="padding-left:5px;"><?php
                                                                                if($row_result['prof_type'] == 'B'){
                                                                                    echo "Business";
                                                                                } else if($row_result['prof_type'] == 'H'){
                                                                                    echo "House Maker";
                                                                                } else if($row_result['prof_type'] == 'S'){
                                                                                    echo "Student";
                                                                                } else if($row_result['prof_type'] == 'P'){
                                                                                    echo "Self Employeds";
                                                                                } else if($row_result['prof_type'] == 'J'){
                                                                                    echo "Job";
                                                                                } else if($row_result['prof_type'] == 'R'){
                                                                                    echo "Retire";
                                                                                } else {
                                                                                    echo "Not specified";
                                                                                }
                                                                                
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php 
                                                                        if($row_result['prof_type'] == 'B'){ ?>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Business Category:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['b_main_group_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Industry:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['ind_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Business Name:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['bness_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Contact Number 1:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['bness_phone']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Contact Number 2:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['bness_mobile']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Description:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['bness_desc']; ?></td>
                                                                            </tr>
                                                                        <?php } if($row_result['prof_type'] == 'J'){?>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Job Type:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['j_group_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Industry:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_ind_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Company Name:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['comp_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Desgination:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_desig']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Phone No:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_phone']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Mobile No:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_mobile']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Office Address:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_addr']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Address:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?php
                                                                                
                                                                                    echo $row_result['job_addr1'];
                                                                                    echo "<br />" . $row_result['job_addr2'];
                                                                                    echo "<br />" . $row_result['job_addr3'];
                                                                                    if ($row_result['jcity'] != "" || $row_result['jstate'] != "" || $row_result['job_pincode'] != "") {
                                                                                            echo ($row_result['jcity']); ?>, <?php echo ($row_result['jstate']); ?> - <?php echo ($row_result['job_pincode']);
                                                                                    }
                                                                                    ?></td>
                                                                            </tr>
                                                                        <?php } 
                                                                         if($row_result['prof_type'] == 'p'){
                                                                        ?>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Profession Name:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['p_main_group_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Specialization:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['p_sub_group_name']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Office Address:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['prof_addr']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Phone No:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['prof_phone']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Mobile No:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['prof_mobile']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Description:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?= $row_result['job_mobile']; ?></td>
                                                                            </tr>
                                                                            
                                                                            <tr>
                                                                                <td class="text_user" style="padding-left:5px; font-weight: bold;">Address:</td>
                                                                                <td class="text_user" style="padding-left:5px;"><?php
                                                                                
                                                                                    echo $row_result['job_addr1'];
                                                                                    echo "<br />" . $row_result['job_addr2'];
                                                                                    echo "<br />" . $row_result['job_addr3'];
                                                                                    if ($row_result['jcity'] != "" || $row_result['jstate'] != "" || $row_result['job_pincode'] != "") {
                                                                                            echo ($row_result['jcity']); ?>, <?php echo ($row_result['jstate']); ?> - <?php echo ($row_result['job_pincode']);
                                                                                    }
                                                                                    ?></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </table>
                                                                    <!--<div class="mt-2 mb-1">
                                                                        <span><b>Father Mobile Number:</b></span> <?= $row_result['father_mobile_number']; ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Mother Number:</b></span> <?= $row_result['mobile_number']; ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Mobile Number:</b></span> <?= $row_result['mobile_number']; ?>
                                                                    </div>-->
                                                                    
                                                                    <!--<div class="mt-2 mb-1">
                                                                        <span><b>Basic/ Graduate:</b></span>  <?php echo $row_result['basicqual'];
                                                                                                    if ($row_result['bq_det'] != "") {
                                                                                                      echo " (" . $row_result['bq_det'] . ") ";
                                                                                                    } ?> 
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Post Graduate:</b></span> <?php echo $row_result['pgqual'];
                                                                                                                if ($row_result['pg_det'] != "") {
                                                                                                                  echo " (" . $row_result['pg_det'] . ") ";
                                                                                                                } ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Doctrate:</b></span> <?php echo $row_result['docqual'];
                                                                                                    if ($row_result['doc_det'] != "") {
                                                                                                      echo " (" . $row_result['doc_det'] . ") ";
                                                                                                    } ?>
                                                                    </div>-->
                                                                    
                                                                    <!--<div class="mt-2 mb-1">
                                                                        <span><b>Native Place:</b></span> <?= $row_result['village_name']; ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Gotra:</b></span> <?= $row_result['gotra_name']; ?>
                                                                    </div>
                                                                    
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Email:</b></span> <?= $row_result['email']; ?>
                                                                    </div>
                                                                    <div class="mt-2 mb-1">
                                                                        <span><b>Blood Group:</b></span> <?= $row_result['bloodGroupName']; ?>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </td>
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
            <td height="38" align="center" valign="middle" bgcolor="#834153">
                <table width="96%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left" valign="middle" class="footer">All Rights Reserved By : Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti</td>
                        <td align="right" valign="middle" class="footer">Website Designed By :<a href="https://apolloinfotech.com/" target="_blank"> Apollo Infotech</a></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">&nbsp;</td>
        </tr>

    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    
    $(document).ready(function() {
        checkisHandicap();
    });
        // $(document).ready(function() {
        //     $("#matrimonyForm").validate({
        //         rules: {
        //             height: {
        //                 required: true
        //             },
        //             weight: {
        //                 required: true
        //             },
        //             hobby: {
        //                 required: true
        //             },
        //             birth_place: {
        //                 required: true
        //             },
        //             full_photo: {
        //                 required: true
        //             },
        //             passport_size_photo: {
        //                 required: true
        //             }
        //         },
        //         messages: {
        //             height: "Height is required",
        //             weight: "Weight is required",
        //             birth_place: "Birth Place is required",
        //             hobby: "hobby is required",
        //             full_photo: "Full Photo is required",
        //             passport_size_photo: "Passport Size photo is required"
        //         },
        //         submitHandler: function(form) {
        //             // AJAX submission
        //             $.ajax({
        //                 type: "POST",
        //                 url: "user-matimony-php.php",
        //                 data: new FormData(form),
        //                 processData: false,
        //                 contentType: false,
        //                 cache: false,
        //                 success: function(response) {
        //                     console.log(response);
        //                     // Handle successful response
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error(error);
        //                     // Handle error response
        //                 }
        //             });
        //         }
        //     });
        // });

        function validateInput(input) {
            const value = input.value;

            // If value is not between 0 and 7, show error and clear the input
            if (value < '0' || value > '7') {
                document.getElementById('error-message').style.display = 'block';
                input.value = '';
            } else {
                document.getElementById('error-message').style.display = 'none';
            }
        }


        function validateInput_inch(input) {
            const value = input.value;

            // Ensure value is not greater than 12
            if (value > 12) {
                input.value = 12;
            }

            // Prevent entering more than 2 digits
            if (value.length > 2) {
                input.value = value.slice(0, 2);
            }
        }

        //const maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        // Check full photo size
        /*document.getElementById('full_photo').addEventListener('change', function() {
            const fullPhoto = this.files[0];
            if (fullPhoto && fullPhoto.size > maxFileSize) {
                document.getElementById('full_photo_error').innerText = "Error: Full photo size exceeds 1MB.";
                this.value = ''; // Clear the input
            } else {
                document.getElementById('full_photo_error').innerText = ''; // Clear any previous error
            }
        });*/

        // Check passport size photo size
        /*document.getElementById('passport_size_photo').addEventListener('change', function() {
            const passportPhoto = this.files[0];
            if (passportPhoto && passportPhoto.size > maxFileSize) {
                document.getElementById('passport_size_error').innerText = "Error: Passport size photo size exceeds 1MB.";
                this.value = ''; // Clear the input
            } else {
                document.getElementById('passport_size_error').innerText = ''; // Clear any previous error
            }
        });*/

        // Check biodata PDF size
        /*document.getElementById('biodata').addEventListener('change', function() {
            const biodata = this.files[0];
            if (biodata && biodata.size > maxFileSize) {
                document.getElementById('biodata_error').innerText = "Error: Biodata size exceeds 1MB.";
                this.value = ''; // Clear the input
            } else {
                document.getElementById('biodata_error').innerText = ''; // Clear any previous error
            }
        });*/

        const weightInput = document.getElementById('weight');

        weightInput.addEventListener('input', function() {
            let value = parseFloat(this.value);
            if (value > 200) {
                alert("Weight cannot be more than 200 kg.");
                this.value = ''; // Clear the input
            }
        });
    </script>
    <script>
        $("#isHandicap").change(function (){
            var isHandicap = $(this).val();
            if(isHandicap == 1){
                $("#trHandicap").show();
            } else {
                $("#trHandicap").hide();
            }
        });
        function checkisHandicap(){
            var isHandicap = $("#isHandicap").val();
            if(isHandicap == 1){
                $("#trHandicap").show();
            } else {
                $("#trHandicap").hide();
            }
        }
        
        function check_Handicap(){
            
            var is_Handicap = $("#is_Handicap").val();
            if(is_Handicap == 1){
                $("#tr_Handicap").show();
            } else {
                $("#tr_Handicap").hide();
            }
            
        }
        document.addEventListener('DOMContentLoaded', function() {
            const maxFileSize = 1 * 1024 * 1024; // 1MB in bytes

            // Function to validate file size
            function validateFileSize(inputId, errorDivId) {
                const fileInput = document.getElementById(inputId);
                const errorDiv = document.getElementById(errorDivId);

                fileInput.addEventListener('change', function() {
                    if (fileInput.files.length > 0) {
                        const file = fileInput.files[0];
                        if (file.size > maxFileSize) {
                            errorDiv.textContent = 'Error: File size exceeds 1MB.';
                            fileInput.value = ''; // Clear the input
                        } else {
                            errorDiv.textContent = ''; // Clear any previous error
                        }
                    }
                });
            }

            // Validate each file input
            // validateFileSize('full_photo_add', 'full_photo_error');
            // validateFileSize('passport_size_photo_add', 'passport_size_error');
            validateFileSize('biodata_add', 'biodata_error');
            
        });
        
        
        
    </script>
</body>

</html>