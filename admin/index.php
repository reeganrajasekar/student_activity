<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMU - Admin Login</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/static/img/logo.png">
    <style>
        body, html {
            height:100%
        }
    </style>
</head>
<body>

    <div id="loader" style="position:fixed;width:100%;height:100%;background-color:rgb(108, 99, 255);z-index: 10000;top:0px;display: none;">
        <div class="spinner-border" style="color:#fff;position:fixed;top:48%;left:49%;" role="status">
          <span class="sr-only"></span>
        </div>
    </div>
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        if(urlParams.get('err')){
            document.write("<div style='position:fixed;bottom:30px; right:30px;background-color:tomato;padding:10px;border-radius:10px;box-shadow:2px 2px 4px #aaa;color:white;font-weight:600'>"+urlParams.get('err')+"</div>")
        }
        setTimeout(()=>{
            document.getElementById("err").style.display="none"
        }, 5000)
    </script>

    <section class="gradient-custom h-100">
        <div class="container py-1 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card" style="border-radius: 1rem;background-color:#f5f5f5;">
                        <form on action="/admin/login.php" method="POST" class="card-body p-4 text-center">
                            <h2 class="fw-bold mb-4 text-uppercase text-primary" style="font-weight:800">Admin Login</h2>
                            <div class="form-floating mb-3">
                                <input required type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input required type="password" name="passwd" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button class="btn btn-primary btn-lg px-5 mb-4" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <style>
        .gradient-custom {
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }
    </style>
    
    <script src="/static/js/bootstrap.bundle.js"></script>
</body>
</html>