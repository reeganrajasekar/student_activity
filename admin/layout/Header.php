<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PMU</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/style.css">
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
            color:red !important;
        }
    </style>
</head>
<body>
    <div id="loader" style="position:fixed;width:100%;height:100%;background-color:rgb(108, 99, 255);z-index: 10000;top:0px;display: none;">
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
                        <a class="nav-link <?php if($_SERVER['PHP_SELF'] == '/admin/home.php'){ echo 'active'; } ?>" aria-current="page" href="/admin/home.php?page=1">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($_SERVER['PHP_SELF'] == '/admin/student.php'){ echo 'active'; } ?>" href="/admin/student.php?page=1">Student</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($_SERVER['PHP_SELF'] == '/admin/staff.php'){ echo 'active'; } ?>" href="/admin/staff.php?page=1">Staff</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>