<?php
$start = $_GET["start"];
$end = $_GET["end"];
$cat = $_GET["cat"];
require("../layout/db.php");

if ($cat == "All") {
    $sql = "SELECT DISTINCT sid FROM scert where state='Approved' AND date >= '$start' AND date<='$end'";
}else{
    $sql = "SELECT DISTINCT sid FROM scert where state='Approved' AND cat='$cat' AND date >= '$start' AND date<='$end'";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo('Staff '.$cat.' report ('.$start.' to '.$end.')')?></title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="icon" href="/static/img/logo.png">
    <script src="/static/js/moment.js"></script>
</head>
<body class="container mt-3 mb-3">

    <?php
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $i++;
        $sid = $row['sid'];
        $sql1 = "SELECT * FROM staff WHERE id='$sid'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                ?>
                <section class="row border rounded p-3 mb-3">
                    <div class="col-1">
                        <?php echo($i) ;?>
                    </div>
                    <div class="col-11 row">
                        <span class="col-7" style="color:#000;font-weight:600"><span style="color:gray">Name :</span> <?php echo($row1["name"]) ?></span>
                        <span class="col-5" style="color:#000;font-weight:600"><span style="color:gray">Reg No :</span> <?php echo($row1["sid"]) ?></span>
                        <span class="col-7" style="color:#000;font-weight:600"><span style="color:gray">Mail :</span> <?php echo($row1["mail"]) ?></span>
                        <span class="col-5" style="color:#000;font-weight:600"><span style="color:gray">Mobile No :</span> +91 <?php echo($row1["mob"]) ?></span>
                        <span class="col-7" style="color:#000;font-weight:600"><span style="color:gray">Department :</span> <?php echo($row1["dept"]) ?></span>
                        <?php
                if($cat=="All"){
                    $sql2 = "SELECT * FROM scert WHERE sid = '$sid' AND state='Approved'";
                }else{
                    $sql2 = "SELECT * FROM scert WHERE sid = '$sid' AND state='Approved' AND cat='$cat'";
                }
                $result2 = $conn->query($sql2);
                ?>
                <span class="col-5 mb-3" style="color:#000;font-weight:600"><span style="color:gray">Total Certificates :</span> <?php echo($result2->num_rows) ?></span>
                <?php
                while($r = $result2->fetch_assoc()){
                    ?>
                    <div class="col-6 mb-3 p-2">
                        <img src="/static/uploads/<?php echo($r["file"]) ?>" style="height:300px;width:100%;overflow:hidden" class="rounded border">
                        <p style="color:#000;font-weight:600;text-align:center;padding:10px">
                            <?php echo($r["title"]) ?>
                            <br>
                            <span style="color:#555">
                                <?php echo($r["cat"]) ?>
                                <br>
                                <script>document.write(moment('<?php echo ($r["date"]) ?>').format('ll'))</script>
                            </span>
                        </p>
                    </div>
                <?php
                }
                ?>
                    </div>
                </section>
                <?php
            }
        }            
    }
    ?>
<script>print()</script>
</body>
</html>

    <?php
}
?>