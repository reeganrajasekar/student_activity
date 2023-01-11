<?php 
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
if(!isset($_SESSION["staff"])){
  header("Location: /staff.php");
  die();
}
require("../../static/db.php");
$id = $_POST['id'];
$sql = "DELETE FROM scert WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    unlink("../../static/uploads/".$_POST['file']);
    header("Location: /staff?page=1&msg=Waiting List Certificate deleted Successfully !");
    die();
} else {
    echo "Error: " . $sql . "<br>" ;
}

$conn->close();

?>