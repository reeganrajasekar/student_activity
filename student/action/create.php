<?php 
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

if(!isset($_SESSION)) 
{ 
  session_start(); 
}
if(!isset($_SESSION["sid"])){
    header("Location: /");
    die();
}

// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    header("Location: /student/?page=1&err=Sorry, your file is too large.");
    die();
}

// Allow certain file formats
if($imageFileType=="jpg" || $imageFileType=="png" || $imageFileType=="jpeg") {
    
}else{
    header("Location: /student/?page=1&err=Sorry, only pdf,jpg,jpeg,png files are allowed.");
    die();
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    header("Location: /student/?page=1&err=Sorry, your file was not uploaded.");
    die();
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $title = test_input($_POST['title']);
    $cat = test_input($_POST['cat']);
    $date = test_input($_POST['date']);
    $sid =$_SESSION['sid'];
    $sql = "INSERT INTO cert (title , date,file,cat , state ,sid)
    VALUES ('$title' , '$date' , '$file_name','$cat' , 'Waiting List','$sid')";

    if ($conn->query($sql) === TRUE) {
        header("Location: /student/?page=1&msg=File Uploaded Successfully !");
        die();
    } else {
      header("Location: /student/?page=1&err=Sorry, there was an error uploading your file.");
      die();
    }


  } else {
    header("Location: /student/?page=1&err=Sorry, there was an error uploading your file.");
    die();
  }
}
?>