<?php
$sid = $_GET["sid"];
require("../layout/db.php");

$sql = "SELECT * from student where sid='$sid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $sql2 = "SELECT * FROM cert WHERE sid = '$id' AND state='Approved'";
        $result2 = $conn->query($sql2);
        $new = [
            'Student Name',
            'Student ID',
            'Student Mail',
            'Student Mobile',
            'Year',
            'Department',
            'Total Certificates'
        ];
        $uname = $row["name"];
        $uid = $row["sid"];
        echo implode(',', $new) . PHP_EOL;
        echo implode(',', [$row["name"],$row["sid"],$row["mail"],$row["mob"],$row["year"],$row["dept"],$result2->num_rows]) . PHP_EOL;
        echo implode(',', ["",""]) . PHP_EOL;
        $columns = [
            'Title',
            'Date',
        ];
        $events = [];
        while ($row2 = $result2->fetch_assoc()) {
            array_push($events,[$row2["title"], $row2["date"]]);
        }
    }
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$uname.'_'.$uid.' report.csv"');
    
    echo implode(',', $columns) . PHP_EOL;
    foreach ($events as $eve){
        echo implode(',', $eve) . PHP_EOL;
    }
}else{
    header("Location: /admin/report.php?err=There is no Student Details Found!");
    die();
} 

?>