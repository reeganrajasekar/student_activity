<?php 

require("../layout/db.php");
$id = $_POST['id'];
$sql = "DELETE FROM scert WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    unlink("../../static/uploads/".$_POST['file']);
    header("Location: /admin/home.php?page=1&msg=Certificate Denied !");
    die();
} else {
    echo "Error: " . $sql . "<br>" ;
}

$conn->close();

?>