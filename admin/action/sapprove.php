<?php 

require("../layout/db.php");
$id = $_POST['id'];
$sql = "UPDATE scert SET state='Approved' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: /admin/home.php?page=1&msg=Certificate Approved !");
    die();
} else {
    echo "Error: " . $sql . "<br>" ;
}

$conn->close();

?>