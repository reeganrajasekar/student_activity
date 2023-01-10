<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
if($_SESSION["lock"]!="qwertyuio76529t9b8ny7KH*&TVOU^V%^JKUV%T#"){
  header("Location: /admin");
  die();
}
$servername = "localhost";
$username = "root";
$password = "trysomething";
$db_name = "pmu";
$conn = new mysqli($servername, $username, $password,$db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>