<?php 

require("../layout/db.php");

$id = $_POST['id'];
$sql = "DELETE FROM staff WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: /admin/staff.php?page=1&msg=Staff detail deleted Successfully !");
    die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>