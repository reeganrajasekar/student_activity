<?php
$start = $_GET["start"];
$end = $_GET["end"];
$user = $_GET["user"];
require("../layout/db.php");

if($user == "student"){
    $sql = "SELECT DISTINCT sid FROM cert where state='Approved' AND date >= '$start' AND date<='$end'";
    $result = $conn->query($sql);
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sid = $row['sid'];
            $sql1 = "SELECT * FROM student WHERE id='$sid'";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $sql2 = "SELECT * FROM cert WHERE sid = '$sid' AND state='Approved'";
                    $result2 = $conn->query($sql2);
                    array_push($products, [$row1["name"],$row1["sid"],$row1["mail"],$row1["mob"],$row1["year"],$row1["dept"],$result2->num_rows]);
                }
            }            
        }
    }
    $columns = [
        'Student Name',
        'Student ID',
        'Student Mail',
        'Student Mobile',
        'Year',
        'Department',
        'Total Certificates'
    ];
}else if($user == "staff"){
    $sql = "SELECT DISTINCT sid FROM scert where state='Approved' AND date >= '$start' AND date<='$end'";
    $result = $conn->query($sql);
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sid = $row['sid'];
            $sql1 = "SELECT * FROM staff WHERE id='$sid'";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $sql2 = "SELECT * FROM scert WHERE sid = '$sid' AND state='Approved'";
                    $result2 = $conn->query($sql2);
                    array_push($products, [$row1["name"],$row1["sid"],$row1["mail"],$row1["mob"],$row1["dept"],$result2->num_rows]);
                }
            }            
        }
    }
    $columns = [
        'Staff Name',
        'Staff ID',
        'Staff Mail',
        'Staff Mobile',
        'Department',
        'Total Certificates'
    ];
}


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.$user.' report from '.$start.' to '.$end.'.csv"');

echo implode(',', $columns) . PHP_EOL;
foreach ($products as $product){
    echo implode(',', $product) . PHP_EOL;
}
?>