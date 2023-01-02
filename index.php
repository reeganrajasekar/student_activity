<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMU - Student/Staff Login</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/static/img/logo.png">
    <style>
        body, html {
            background-color:#f5f5f5;
        }
    </style>
</head>
<body>

    <div id="loader" style="position:fixed;width:100%;height:100%;background-color:#4AB80A99;z-index: 10000;top:0px;display: none;">
        <div class="spinner-border" style="color:#fff;position:fixed;top:48%;left:49%;" role="status">
          <span class="sr-only"></span>
        </div>
    </div>

    <div  data-aos="zoom-in" class="container" style="margin-top:120px;margin-bottom:100px;width:500px;max-width:100vw;background-color: white;padding:30px 0px;border-radius: 30px;box-shadow: 2px 2px 8px #ccc;">
        <ul class="nav nav-pills nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="pill" href="#student">Student Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#staff">Staff Login</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="student" class="tab-pane active"><br>
                <form onsubmit="document.getElementById('loader').style.display='block'" style="margin: 0 15%" method="POST" action="/login.php">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Student ID</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">D.O.B</label>
                    </div>
                    <br>
                    <center>
                        <button type="submit" class="btn btn-block mb-4" style="width:100%"><b>Login</b></button>
                    </center>
                </form>    
            </div>
            <div id="staff" class="tab-pane fade"><br>
                <form onsubmit="document.getElementById('loader').style.display='block'" style="margin: 0 15%" method="POST" action="/login.php">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <br>
                    <center>
                        <button type="submit" class="btn btn-block mb-4" style="width:100%"><b>Login</b></button>
                    </center>
                </form>    
            </div>
        </div>
    </div>
    <style>
        button{
        background-color: tomato !important;
        color:white !important;
        height:45px !important;
        font-size:22px !important;
        }
        .form-control:focus , .form-control:active{
        box-shadow: none !important;

        }
        .nav-item{
            background:white;
        }
        .nav-link{
            background:white;
            color:gray;
            font-weight:700;
            font-size:20px;
            border-bottom:2px solid gray !important;
            border-radius:0px !important;
        }
        .nav-link.active{
            background:white !important;
            color:tomato !important;
            font-weight:800;
            font-size:20px;
            border-bottom:2px solid red !important;
            border-radius:0px !important;
        }
    </style>
    <script src="/static/js/bootstrap.bundle.js"></script>
</body>
</html>