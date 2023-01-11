<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
if(!isset($_SESSION["staff"])){
  header("Location: /staff.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Staff - PMU</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="icon" href="/static/img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/static/js/moment.js"></script>
    <style>
        .nav-link{
            font-size: 18px;
            font-weight:600;
            text-align: center;
            padding:10px
        }
        .nav-item > .active{
            color:rgba(106, 17, 203, 1) !important;
        }
    </style>
</head>
<body>
    <div id="loader" style="position:fixed;width:100%;height:100%;background-color:rgba(106, 17, 203, 7);z-index: 10000;top:0px;display: none;">
        <div class="spinner-border" style="color:#fff;position:fixed;top:48%;left:49%;" role="status">
          <span class="sr-only"></span>
        </div>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top" style="background:white;box-shadow:1px 1px 2px #aaa;">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="/static/img/logo.png" alt="College Logo" class="col-logo">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/staff?page=1">Home</a>
                    </li>
                    <li class="nav-item dropdown text-center">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu text-center">
                            <li><a class="dropdown-item" href="/">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <button type="button" style="color:#fff;background-color:rgba(106, 17, 203, 1);position:fixed;right:2rem;bottom:2rem;font-size:22px;font-weight:800"  class="btn" data-bs-toggle="modal" data-bs-target="#myModal">
        +
    </button>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:rgba(106, 17, 203, 1)">Upload New Certificate</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form onsubmit="document.getElementById('loader').style.display='block'" action="/staff/action/create.php" method="post" enctype="multipart/form-data">
                    <div class="form-floating mb-3 ">
                        <select required name="cat" class="form-control">
                            <option value="" disabled selected>Select Category</option>
                            <option value="Conference">Conference</option>
                            <option value="Seminar">Seminar</option>
                            <option value="FDP">FDP</option>
                            <option value="Event organised">Event organised</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Funded event">Funded event</option>
                            <option value="Webinar">Webinar</option>
                            <option value="Paper Publication">Paper Publication</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3 ">
                        <input required type="text" class="form-control"  name="title" placeholder="n">
                        <label >Title</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="date" class="form-control"  name="date" placeholder="n">
                        <label>Date</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="file" class="form-control"  name="file" placeholder="n">
                        <label>File (JPG/PNG/PDF)</label>
                    </div>
                    <div style="display:flex;justify-content:flex-end">
                        <button class="btn  w-25" style="background-color:rgba(106, 17, 203, 1);color:#fff">Upload</button>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>
    <main class="container mt-3 mb-3">
        <?php
        require("../static/db.php");
        $sid =$_SESSION['staff'];
        $sql = "SELECT * FROM staff WHERE id='$sid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
        <p style="background-color:rgba(106, 17, 203, 0.18);padding:10px;border-radius:8px;color:#444;border:1px solid #ccc;font-size:18px">Welcome <span style="font-size:20px;color:rgba(106, 17, 203, 1)"><?php echo($row["name"])?></span> ,</p>
        <?php
            }
        }
        ?>
        <?php
        $sql = "SELECT * FROM scert where sid='$sid' AND state='Waiting List'  order by id DESC";
        $result = $conn->query($sql);
        $i = 0;
        if ($result->num_rows > 0) {
            ?>
        <h5 style="color:rgba(106, 17, 203, 1);">Waiting For Approval :</h5>
        <div class="table-responsive">
            <table class="table table-striped table-bordered ">
                <thead style="text-align:center">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        ?>
                    <tr>
                        <td style="text-align:center"><?php echo ($i) ?></td>
                        <td ><?php echo ($row["title"]) ?></td>
                        <td ><?php echo ($row["cat"]) ?></td>
                        <td ><?php echo ($row["date"]) ?></td>
                        <td ><a href="/static/uploads/<?php echo ($row["file"]) ?>" target="blank">Open</a></td>
                        <td style="text-align:center;">
                            <form onsubmit="document.getElementById('loader').style.display='block'" action="/staff/action/delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo ($row["id"]) ?>">
                                <input type="hidden" name="file" value="<?php echo ($row["file"]) ?>">
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
                    ?>
                    
                </tbody>
            </table>
        </div>
        <?php
        }
        $results_per_page = 10; 
        $sid =$_SESSION['staff'];
        if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }
        $query = "SELECT * FROM scert where sid='$sid' AND state='Approved'"; 
        $result = mysqli_query($conn, $query);  
        $number_of_result = mysqli_num_rows($result);  
        $number_of_page = ceil ($number_of_result / $results_per_page);  
        $page_first_result = ($page-1) * $results_per_page;
        ?>
        <h5 style="color:rgba(106, 17, 203, 1);">Approved Certificates (<?php echo($number_of_result)?>) :</h5>
        <div class="table-responsive">
            <table class="table table-striped table-bordered ">
                <thead style="text-align:center">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>file</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM scert where sid='$sid' AND state='Approved'  order by id DESC LIMIT " . $page_first_result . ',' . $results_per_page;
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
                        <td ><?php echo($row["title"]) ?></td>
                        <td ><?php echo($row["cat"]) ?></td>
                        <td ><?php echo($row["date"]) ?></td>
                        <td ><a href="/static/uploads/<?php echo($row["file"]) ?>" target="blank">Open</a></td>

                    </tr>
                    <?php
                        }
                    } else {
                    ?>

                    <tr>
                        <td colspan=5 style="text-align:center">Nothing found !</td>
                    </tr>

                    <?php
                    }
                    ?>
                    
                </tbody>
            </table>
            <p style="text-align:center;line-height:3.5;font-size:16px">
                <?php 
                for($page = 1; $page<= $number_of_page; $page++) { 
                    if($page==$_GET['page']){
                        echo '<a style="margin:5px;padding:10px;border-radius:5px;border:2px solid rgba(106, 17, 203, 1);background-color:rgba(106, 17, 203, 1);font-weight:600;color:#fff;text-decoration:none" href = "?page=' . $page . '">' . $page . ' </a>';  
                    }else{
                        echo '<a style="margin:5px;padding:8px;border-radius:5px;border:1px solid #aaa;color:#444;text-decoration:none" href = "?page=' . $page . '">' . $page . ' </a>';  
                    }
                }  
                ?>
            </p>
        </div>
    </main>
    <script src="/static/js/bootstrap.bundle.js"></script>
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        if(urlParams.get('err')){
            document.write("<div id='err' style='position:fixed;bottom:100px; left:30px;background-color:tomato;padding:10px;border-radius:10px;box-shadow:2px 2px 4px #aaa;color:white;font-weight:600'>"+urlParams.get('err')+"</div>")
        }
        setTimeout(()=>{
            document.getElementById("err").style.display="none"
        }, 3000)
        if(urlParams.get('msg')){
            document.write("<div id='msg' style='position:fixed;bottom:100px; left:30px;background-color:rgba(106, 17, 203, 1);padding:10px;border-radius:10px;box-shadow:2px 2px 4px #aaa;color:white;font-weight:600'>"+urlParams.get('msg')+"</div>")
        }
        setTimeout(()=>{
            document.getElementById("msg").style.display="none"
        }, 3000)
    </script>
</body>
</html>