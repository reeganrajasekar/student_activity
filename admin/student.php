<?php require("./layout/Header.php") ?>
<?php require("./layout/db.php") ?>

<main class="container">
    <h3 class="mt-4" style="color:red;display:flex;flex-direction:row;justify-content:space-between">
        <span>Students :</span>
        <span>
            <button type="button" style="color:#fff;background-color:red"  class="btn" data-bs-toggle="modal" data-bs-target="#myModal">
                Add
            </button>
        </span>
    </h3>
    <hr>
    <form action="/admin/student.php" method="GET"><p style="text-align:right">Search : <input name="sid" style="height:35px;border:1px solid #ddd;border-radius:5px;padding-left:5px" type="text" name="sid" placeholder="Student ID"> <button class="btn btn-secondary">Search</button></p></form>
    <hr>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Student</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="/admin/action/student.php" method="post">
                    <div class="form-floating mb-3 ">
                        <input required type="text" class="form-control"  name="name" placeholder="n">
                        <label >Name</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="email" class="form-control"  name="mail" placeholder="n">
                        <label >Email</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="number" class="form-control"  name="mob" placeholder="n">
                        <label >Mobile</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="text" class="form-control"  name="sid" placeholder="n">
                        <label >Student ID</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="text" class="form-control"  name="dob" placeholder="n">
                        <label >DOB (DD/MM/YYYY)</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="text" class="form-control"  name="dept" placeholder="n">
                        <label >Department</label>
                    </div>
                    <div style="display:flex;justify-content:flex-end">
                        <button class="btn  w-25" style="background-color:red;color:#fff">Add</button>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-bordered ">
        <thead style="text-align:center">
            <tr>
                <th>#</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            require("./layout/db.php");
            $results_per_page = 10;  
            if(isset($_GET["sid"])){
                $sid = $_GET["sid"];
                $query = "select *from student where sid='$sid'";  
            }else{
                $query = "select *from student";  
            }
            $result = mysqli_query($conn, $query);  
            $number_of_result = mysqli_num_rows($result);  
            $number_of_page = ceil ($number_of_result / $results_per_page);  

            if (!isset ($_GET['page']) ) {  
                $page = 1;  
            } else {  
                $page = $_GET['page'];  
            } 

            $page_first_result = ($page-1) * $results_per_page;
            if (isset($_GET["sid"])) {
                $sql = "SELECT * FROM student where sid = '$sid' order by id DESC LIMIT " . $page_first_result . ',' . $results_per_page;
            }else{
                $sql = "SELECT * FROM student order by id DESC LIMIT " . $page_first_result . ',' . $results_per_page;
            }
                $result = $conn->query($sql);
            if($_GET['page'] && $_GET['page']>1){
                $i = $_GET['page']*10;
            }else{
                $i=0;
            }
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $i++;
            ?>
            
            <tr>
                <td style="text-align:center"><?php echo($i) ?></td>
                <td ><?php echo($row["sid"]) ?></td>
                <td ><?php echo($row["name"]) ?></td>
                <td ><?php echo($row["mail"]) ?></td>
                <td ><?php echo($row["mob"]) ?></td>
                <td ><?php echo($row["dept"]) ?></td>
                <td style="text-align:center;display:flex;flex-direction:row;justify-content:space-around">
                    <button  data-bs-toggle="modal" data-bs-target="#myModal<?php echo($row["id"]) ?>" style="border:none;color:gray;background:none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"> <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/> </svg>
                    </button>

                    <form onsubmit="document.getElementById('loader').style.display='block'" action="/admin/action/delstudent.php" method="post">
                        <input type="hidden" name="id" value="<?php echo($row["id"]) ?>">
                        <button onclick="return confirm('Do you want to delete?')" style="border:none;background:none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash3 text-danger" viewBox="0 0 16 16">
                              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>

            <div class="modal modal-xl fade" id="myModal<?php echo($row["id"]) ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="color:red">Student Details</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p style="color:#444;font-size:16px">
                            <span style="color:#888">Student ID : </span><?php echo($row["sid"]) ?><br>
                            <span style="color:#888">Name : </span><?php echo($row["name"]) ?><br>
                            <span style="color:#888">Email : </span><?php echo($row["mail"]) ?><br>
                            <span style="color:#888">Mobile : </span><?php echo($row["mob"]) ?><br>
                            <span style="color:#888">Department : </span><?php echo($row["dept"]) ?><br>
                        </p>
                        <hr>
                        <?php
                        $id = $row["id"];
                        $sql1 = "SELECT * FROM cert WHERE sid = '$id' AND state='Approved'";
                        $result1 = $conn->query($sql1);
                        if ($result1->num_rows > 0) {?>
                            <h4 style="font-size:20px;color:red;text-decoration:underline">Certificates (<?php echo($result1->num_rows) ?>):</h4>
                            <div class="row gx-3 text-center">
                                <div class="col-6 border bg-secondary text-white">Title</div>
                                <div class="col-2 border bg-secondary text-white">Date</div>
                                <div class="col-2 border bg-secondary text-white">File</div>
                                <div class="col-2 border bg-secondary text-white">Action</div>
                        <?php  
                            while($row1 = $result1->fetch_assoc()) {
                        ?>
                                <div class="col-6 border"><?php echo($row1["title"])?></div>
                                <div class="col-2 border"><?php echo($row1["date"])?></div>
                                <div class="col-2 border"><a href="/static/uploads/<?php echo($row1["file"])?>" target="blank">Open File</a></div>
                                <div class="col-2 border">
                                    <form action="/admin/action/delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo($row1["id"])?>">
                                        <button onclick="return confirm('Do you want to delete?')" style="border:none;background:none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash3 text-danger" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <hr>
                        <?php }  ?>
                            </div>
                        <?php }else{?>
                            <h4 style="font-size:20px;color:red;text-decoration:underline">Certificates (0):</h4>
                        <?php }?>
                    </div>

                    </div>
                </div>
            </div>

            <?php
                }
            } else {
            ?>

            <tr>
                <td colspan=7 style="text-align:center">No Student Details found !</td>
            </tr>

            <?php
            }
            ?>
            
        </tbody>
    </table>
    </div>

    <p style="text-align:center;line-height:3.5;font-size:16px">
        <?php 
        for($page = 1; $page<= $number_of_page; $page++) { 
            if($page==$_GET['page']){
                echo '<a style="margin:5px;padding:10px;border-radius:5px;border:2px solid red;background-color:red;font-weight:600;color:#fff;text-decoration:none" href = "?page=' . $page . '">' . $page . ' </a>';  
            }else{
                echo '<a style="margin:5px;padding:8px;border-radius:5px;border:1px solid #aaa;color:#444;text-decoration:none" href = "?page=' . $page . '">' . $page . ' </a>';  
            }
        }  
        ?>
    </p>

</main>

<?php require("./layout/Footer.php") ?>