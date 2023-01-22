<?php
$start = $_GET["start"];
$end = $_GET["end"];
$cat = $_GET["cat"];
require("../layout/db.php");
if($cat=='All'){
    $sql = "SELECT DISTINCT sid FROM scert where state='Approved' AND date >= '$start' AND date<='$end'";
}else{
    $sql = "SELECT DISTINCT sid FROM scert where state='Approved' AND cat='$cat' AND date >= '$start' AND date<='$end'";
}
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sid = $row['sid'];
        $sql1 = "SELECT * FROM staff WHERE id='$sid'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                if($cat=='All'){
                    $sql2 = "SELECT * FROM scert WHERE sid = '$sid' AND state='Approved'";
                }else{
                    $sql2 = "SELECT * FROM scert WHERE sid = '$sid' AND state='Approved' AND cat='$cat'";
                }
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


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Staff '.$cat.' report ('.$start.' to '.$end.').csv"');

echo implode(',', $columns) . PHP_EOL;
foreach ($products as $product){
    echo implode(',', $product) . PHP_EOL;
}
?>