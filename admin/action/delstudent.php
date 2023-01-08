<?php 

require("../layout/db.php");

$id = $_POST['id'];
$sql = "DELETE FROM student WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: /admin/student.php?page=1&msg=Student detail deleted Successfully !");
    die();
} else {
    header("Location: /admin/student.php?page=1&err=Something went Wrong!");
    die();
}

?>