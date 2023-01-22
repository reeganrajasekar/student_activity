<?php
$start = $_GET["start"];
$end = $_GET["end"];
$cat = $_GET["cat"];
$year = $_GET["year"];
require("../layout/db.php");

if ($cat == "All") {
    $sql = "SELECT DISTINCT sid FROM cert where state='Approved' AND date >= '$start' AND date<='$end'";
}else{
    $sql = "SELECT DISTINCT sid FROM cert where state='Approved' AND cat='$cat' AND date >= '$start' AND date<='$end'";
}
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sid = $row['sid'];
        $sql1 = "SELECT * FROM student WHERE id='$sid' AND year='$year'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                if($cat=="All"){
                    $sql2 = "SELECT * FROM cert WHERE sid = '$sid' AND state='Approved'";
                }else{
                    $sql2 = "SELECT * FROM cert WHERE sid = '$sid' AND state='Approved' AND cat='$cat'";
                }
                $result2 = $conn->query($sql2);
                $link = "";
                while($r = $result2->fetch_assoc()){
                    $link .= "http://".$_SERVER['SERVER_NAME']."/static/uploads/".$r["file"] . "  ";
                }
                array_push($products, [$row1["name"],$row1["sid"],$row1["mail"],$row1["mob"],$row1["year"],$row1["dept"],$result2->num_rows,$link]);

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
    'Total Certificates',
    'Certificates'
];


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.$year.' Student '.$cat.' report ('.$start.' to '.$end.').csv"');

echo implode(',', $columns) . PHP_EOL;
foreach ($products as $product){
    echo implode(',', $product) . PHP_EOL;
}
?>