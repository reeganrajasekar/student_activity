<?php require("./layout/Header.php") ?>
<?php require("./layout/db.php") ?>
    <main class="container mt-3 mb-3">
        <h5 style="color:rgba(106, 17, 203, 1);">Students Waiting List :</h5>
        <div class="table-responsive">
            <table class="table table-striped table-bordered ">
                <thead style="text-align:center">
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Year</th>
                        <th>Event Title</th>
                        <th>Date</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM cert where state='Waiting List'  order by id DESC";
                    $result = $conn->query($sql);
                    $i = 0;
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo($i) ?></td>
                        <?php 
                        $sid = $row["sid"];
                        $sql1 = "SELECT * FROM student WHERE id = '$sid'";
                        $result1 = $conn->query($sql1);
                        if ($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {
                        ?>
                        <td ><?php echo($row1["sid"]) ?></td>
                        <td ><?php echo($row1["name"]) ?></td>
                        <td ><?php echo($row1["year"]) ?></td>
                        <?php 
                            }
                        }
                        ?>
                        <td ><?php echo($row["title"]) ?></td>
                        <td ><script>document.write(moment('<?php echo ($row["date"]) ?>').format('ll'))</script></td>
                        <td ><a href="/static/uploads/<?php echo($row["file"]) ?>" target="blank">Open</a></td>
                        <td style="text-align:center;display:flex;flex-direction:row;justify-content:space-around">
                            <form onsubmit="document.getElementById('loader').style.display='block'" action="/admin/action/approve.php" method="post">
                                <input type="hidden" name="id" value="<?php echo($row["id"])?>">
                                <button onclick="return confirm('Do you want to Approve?')" style="border:none;background:none;color:green">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16"> <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/> </svg>
                                </button>
                            </form>
                            <form onsubmit="document.getElementById('loader').style.display='block'" action="/admin/action/deny.php" method="post">
                                <input type="hidden" name="id" value="<?php echo($row["id"])?>">
                                <input type="hidden" name="file" value="<?php echo($row["file"])?>">
                                <button onclick="return confirm('Do you want to delete?')" style="border:none;background:none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash3 text-danger" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>

                    <tr>
                        <td colspan=8 style="text-align:center">Nothing found !</td>
                    </tr>

                    <?php
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
        <h5 style="color:rgba(106, 17, 203, 1);">Staff Waiting List :</h5>
        <div class="table-responsive">
            <table class="table table-striped table-bordered ">
                <thead style="text-align:center">
                    <tr>
                        <th>#</th>
                        <th>Staff ID</th>
                        <th>Staff Name</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM scert where state='Waiting List'  order by id DESC";
                    $result = $conn->query($sql);
                    $i = 0;
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo($i) ?></td>
                        <?php 
                        $sid = $row["sid"];
                        $sql1 = "SELECT * FROM staff WHERE id = '$sid'";
                        $result1 = $conn->query($sql1);
                        if ($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {
                        ?>
                        <td ><?php echo($row1["sid"]) ?></td>
                        <td ><?php echo($row1["name"]) ?></td>
                        <?php 
                            }
                        }
                        ?>
                        <td ><?php echo($row["title"]) ?></td>
                        <td ><?php echo($row["cat"]) ?></td>
                        <td ><script>document.write(moment('<?php echo ($row["date"]) ?>').format('ll'))</script></td>
                        <td ><a href="/static/uploads/<?php echo($row["file"]) ?>" target="blank">Open</a></td>
                        <td style="text-align:center;display:flex;flex-direction:row;justify-content:space-around;height:100%">
                            <form onsubmit="document.getElementById('loader').style.display='block'" action="/admin/action/sapprove.php" method="post">
                                <input type="hidden" name="id" value="<?php echo($row["id"])?>">
                                <button onclick="return confirm('Do you want to Approve?')" style="border:none;background:none;color:green">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16"> <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/> </svg>
                                </button>
                            </form>
                            <form onsubmit="document.getElementById('loader').style.display='block'" action="/admin/action/sdeny.php" method="post">
                                <input type="hidden" name="id" value="<?php echo($row["id"])?>">
                                <input type="hidden" name="file" value="<?php echo($row["file"])?>">
                                <button onclick="return confirm('Do you want to delete?')" style="border:none;background:none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash3 text-danger" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>

                    <tr>
                        <td colspan=8 style="text-align:center">Nothing found !</td>
                    </tr>

                    <?php
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </main>
<?php require("./layout/Footer.php") ?>