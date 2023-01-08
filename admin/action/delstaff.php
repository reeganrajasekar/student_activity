<?php 

require("../layout/db.php");

$id = $_POST['id'];
$sql = "DELETE FROM staff WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: /admin/staff.php?page=1&err=Staff detail deleted Successfully !");
    die();
} else {
    header("Location: /admin/staff.php?page=1&err=Something Went Wrong!");
    die();
}


?>