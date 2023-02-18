<?php require("./layout/Header.php") ?>
<script src="/static/js/jquery.min.js"></script>
<?php require("./layout/db.php") ?>

<main class="container mx-auto">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3  style="color:rgba(106, 17, 203, 1);">Reports :</h3>
                        <div class="col-md-6 ">
                            <select onchange="changed()" class="form-select" id="type"
                                aria-label="Default select example">
                                <option value="" disabled selected>Select Category</option>
                                <option value="3">General Report</option>
                                <option value="0">Student</option>
                                <option value="1">Staff</option>
                            </select>
                        </div>

                        <div id="btn" class="mt-3 container">
                        
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
    <script>
        function changed() {
            let type = $("#type").val()
            if (type == 0) {
                $("#btn").html(`
                <form class="container row mt-3" action="/admin/reports/index.php" method="GET">
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">Start Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="start">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">End Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="end">
                    </div>
                    <div class="mb-3 col-md-6">
                        <select required name="year" class="form-select">
                            <option value="" disabled selected>Select Year</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <select required name="cat" class="form-select">
                            <option value="" disabled selected>Select Category</option>
                            <option value="All">All</option>
                            <option value="Conference">Conference</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Online Course">Online Course</option>
                            <option value="Webinar">Webinar</option>
                            <option value="Sports">Sports</option>
                            <option value="Cultural Events">Cultural Events</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Paper Publication">Paper Publication</option>
                        </select>
                    </div>
                    <br>
                    <center>
                        <button class="mt-4 btn w-30" style="background-color:rgba(106, 17, 203, 1);color:#fff;">Download</button>
                    </center>
                </form>
                `)
            } else if (type == 1) {
                $("#btn").html(`
                <form class="container row mt-3" action="/admin/reports/report.php" method="GET">
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">Start Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="start">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">End Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="end">
                    </div>
                    <div class="mb-3 col-md-6">
                        <select required name="cat" class="form-select">
                            <option value="" disabled selected>Select Category</option>
                            <option value="All">All</option>
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
                    <br>
                    <center>
                        <button class="mt-4 btn w-30" style="background-color:rgba(106, 17, 203, 1);color:#fff;">Download</button>
                    </center>
                </form>
                `)
            }else if (type == 3) {
                $("#btn").html(`
                <form class="container row mt-3" action="/admin/reports/report.php" method="GET">
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">Start Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="start">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">End Date :</label>
                        <input type="date" class="form-control" id="floatingInput" required name="end">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label for="floatingInput" class="form-label">Select User Category :</label>
                        <select class="form-select" name="user" aria-label="Default select example">
                            <option value="" selected disabled>Select User Category</option>
                            <option value="student">Student</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                    <br>
                    <center>
                        <button class="mt-4 btn w-30" style="background-color:rgba(106, 17, 203, 1);color:#fff;">Download</button>
                    </center>
                </form>
                `)
            }
        }
    </script>
<?php require("./layout/Footer.php") ?>
