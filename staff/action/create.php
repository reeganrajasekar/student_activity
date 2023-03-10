<?php 
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
if(!isset($_SESSION["staff"])){
  header("Location: /staff.php");
  die();
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}
require("../../static/db.php");
$file_name = strtotime("now").$_FILES["file"]["name"];
$target_dir = "../../static/uploads/";
$target_file = $target_dir . basename($file_name);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    header("Location: /staff/?page=1&err=Sorry, your file is too large.");
    die();
}

// Allow certain file formats
if($imageFileType=="jpg" || $imageFileType=="png" || $imageFileType=="jpeg") {
    
}else{
    header("Location: /staff/?page=1&err=Sorry, only pdf,jpg,jpeg,png files are allowed.");
    die();
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    header("Location: /staff/?page=1&err=Sorry, your file was not uploaded.");
    die();
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $title = test_input($_POST['title']);
    $date = test_input($_POST['date']);
    $cat = test_input($_POST['cat']);
    $sid =$_SESSION['staff'];
    $sql = "INSERT INTO scert (title , date , cat,file , state ,sid)
    VALUES ('$title' , '$date' ,'$cat' ,'$file_name' , 'Waiting List','$sid')";

    if ($conn->query($sql) === TRUE) {
        header("Location: /staff/?page=1&msg=File Uploaded Successfully !");
        die();
    } else {
      header("Location: /staff/?page=1&err=Something went Wrong!");
      die();
    }

  } else {
    header("Location: /staff/?page=1&err=Sorry, there was an error uploading your file.");
    die();
  }
}
?>