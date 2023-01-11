<?php
require("./static/db.php");

$sid = $_POST["sid"];
$dob = $_POST["dob"];

$sql = "SELECT * FROM student where sid='$sid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["dob"]==$dob) {
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            }
            $_SESSION("sid") = $row["id"];
            header("Location: /student/");
            die();
        } else {
            header("Location: /?err=Student ID or DOB is Wrong !");
            die();
        }
    }
}else{
    header("Location: /?err=Student ID or DOB is Wrong !");
    die();
}

?>