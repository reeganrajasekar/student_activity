<?php 

require("../../static/db.php");
$id = $_POST['id'];
$sql = "DELETE FROM cert WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    unlink("../../static/uploads/".$_POST['file']);
    header("Location: /student?page=1&err=Waiting List Certificate deleted Successfully !");
    die();
} else {
    echo "Error: " . $sql . "<br>" ;
}

$conn->close();

?>