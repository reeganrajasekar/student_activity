<?php
require("../layout/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = test_input($_POST['name']);
$mail = test_input($_POST['mail']);
$mob = test_input($_POST['mob']);
$sid = test_input($_POST['sid']);
$dob = test_input($_POST['dob']);
$year = test_input($_POST['year']);
$dept = test_input(strtoupper($_POST['dept']));

$sql = "INSERT INTO student (name , mail ,mob,sid,dob,dept,year)
VALUES ('$name' ,'$mail' ,'$mob' ,'$sid' ,'$dob' ,'$dept','$year')";

if ($conn->query($sql) === TRUE) {
    header("Location: /admin/student.php?page=1&msg=Student Details Added Successfully !");
    die();
} else {
    header("Location: /admin/student.php?page=1&err=Something went Wrong!");
    die();
}

?>