<?php 

require("../layout/db.php");
$id = $_POST['id'];
$sql = "UPDATE cert SET state='Approved' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: /admin/home.php?page=1&msg=Certificate Approved !");
    die();
} else {
    header("Location: /admin/home.php?page=1&err=Something went Wrong!");
    die();
}


?>