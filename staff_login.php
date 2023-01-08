<?php
require("./static/db.php");

$mail = $_POST["mail"];
$password = $_POST["password"];

$sql = "SELECT * FROM staff where mail='$mail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["password"]==$password) {
            setcookie("staff" ,$row["id"]);
            header("Location: /staff/");
            die();
        } else {
            header("Location: /?err=Username or Password is Wrong !");
            die();
        }
    }
}else{
    header("Location: /?err=Username or Password is Wrong !");
    die();
}

?>