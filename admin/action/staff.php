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
$password = test_input($_POST['passwd']);
$dept = test_input(strtoupper($_POST['dept']));

$sql = "INSERT INTO staff (name , mail ,mob,sid,password,dept)
VALUES ('$name' ,'$mail' ,'$mob' ,'$sid' ,'$password' ,'$dept')";

if ($conn->query($sql) === TRUE) {
    header("Location: /admin/staff.php?page=1&msg=Staff Details Added Successfully !");
    die();
} else {
    echo "Error: " . $sql . "<br>";
}

?>