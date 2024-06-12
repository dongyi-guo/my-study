<!DOCTYPE html>
<html>
<head>
    <title>Tutorial 1 - KIT502 - UTAS</title>

    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
          crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="home-jumborton bg-light text-dark rounded text-center">
            <h1>KIT502-Web Development (Practical Exercise)</h1>
            <h3>Prepared by: <b>Ahmed All Razi</b></h3>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="img/img_home_1.jpg" class="card-img-top home-card-img" alt="Cascade Brewery">
                    <div class="card-body">
                        <h3 class="card-title text-center">Cascade Brewery</h3>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Photo credit: <a href="https://www.lonelyplanet.com/australia/tasmania/hobart/sandy-bay-south-hobart/attractions/cascade-brewery/a/poi-sig/1222878/1004929" target="_blank">lonelyplanet.com</a></small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="img/img_home_2.jpg" class="card-img-top home-card-img" alt="Cascade Brewery">
                    <div class="card-body">
                        <h3 class="card-title text-center">Hobart Harbor</h3>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Photo credit: <a href="https://tasmania.com/points-of-interest/hobart/" target="_blank">tasmania.com</a></small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="img/img_home_3.jpg" class="card-img-top home-card-img" alt="Cascade Brewery">
                    <div class="card-body">
                        <h3 class="card-title text-center">Port Arthur</h3>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Photo credit: <a href="https://en.wikipedia.org/wiki/Port_Arthur,_Tasmania" target="_blank">wikipwdia.org</a></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-4">
            <hr />
            <div class="row my-4">
                <div class="col">
                    <h2>Sponsors</h2>
                </div>
                <div class="col">
                    <h5>University of Tasmania</h5>
                    <br />
                    <h5>ABC Network Company</h5>
                    <br />
                    <h5>Hobart Cooperation</h5>
                </div>
            </div>
            <hr />
        </div>

        <div class="footer row">
            <div class="col-10">
                &copy; 2023 Web Development Conference;
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
            <div class="col-2">
                <a class="#">Back to Top</a>
            </div>
        </div>
    </div>
</body>
</html>

<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Registration</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="divMessage" class="mb-3">
                    <div class="alert alert-warning" role="alert">
                        <span id="lblMessage"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="txtFirstName" class="form-label">First name</label>
                    <input type="text" class="form-control" id="txtFirstName" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="txtLastName" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="txtLastName" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="txtEmailAddress" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="txtEmailAddress" placeholder="" />
                    <span class="small">* We will never share your email with anyone else.</span>
                </div>
                <div class="mb-3">
                    <label for="txtPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="txtPassword" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="txtConfirmPassword" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="txtConfirmPassword" placeholder="" />
                </div>
                <div class="mb-3">
                    Are you a research student?
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rdResearchOptions" id="rdResearchYes" value="Yes">
                        <label class="form-check-label" for="rdResearchYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rdResearchOptions" id="rdResearchNo" value="No">
                        <label class="form-check-label" for="rdResearchNo">No</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="chkAcknowledgement" />
                        <label class="form-check-label" for="chkAcknowledgement">
                            I acknowledge that I have read and understand the terms and conditions.
                        </label>
                    </div>
                </div>
                <!--<div class="mb-3">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="btnSubmit" type="button" class="btn btn-danger">Submit</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#divMessage").css("visibility", "hidden");

        $("#btnSubmit").click(function () {
            if (jQuery.trim($("#txtFirstName").val()).length <= 0) {
                ShowMessage("Please enter first name.");
                return;
            }

            if (jQuery.trim($("#txtLastName").val()).length <= 0) {
                ShowMessage("Please enter last name.");
                return;
            }

            if (jQuery.trim($("#txtEmailAddress").val()).length <= 0) {
                ShowMessage("Please enter your email address.");
                return;
            } else {
                var emailAddress = jQuery.trim($("#txtEmailAddress").val());
                var regex = new RegExp('^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$', 'i');

                if (regex.test(emailAddress) == false) {
                    ShowMessage("Please enter a valid email address.");
                    return;
                }
            }

            if (jQuery.trim($("#txtPassword").val()).length <= 0) {
                ShowMessage("Please enter your password.");
                return;
            } else {
                var pass = jQuery.trim($("#txtPassword").val());
                //var regex = new RegExp('[^\w\d]*(([0-9]+.*[A-Za-z]+.*)|[A-Za-z]+.*([0-9]+.*))');

                //if (regex.test(pass) == false || pass.length < 7 || pass.length > 12) {
                if (!CheckPassword(pass)) {
                    ShowMessage("Password must contain 7-12 letters including 1 number.");
                    return;
                }
            }

            if (jQuery.trim($("#txtConfirmPassword").val()).length <= 0 ||
                jQuery.trim($("#txtConfirmPassword").val()) !== jQuery.trim($("#txtPassword").val())) {
                ShowMessage("Please confirm your password.");
                return;
            }

            if ($('#rdResearchYes').is(':checked') == false && 
                $('#rdResearchNo').is(':checked') == false) {
                ShowMessage("Please select a research option.");
                return;
            }

            if ($('#chkAcknowledgement').is(':checked') == false) {
                ShowMessage("Please read and accept the terms and conditions.");
                return;
            }

            ShowMessage("");
        });

        var ShowMessage = function (message) {
            $("#lblMessage").text(message);

            if (message.length > 0) {
                $("#divMessage").css("visibility", "visible");
            } else {
                $("#divMessage").css("visibility", "hidden");
            }
        }

        var CheckPassword = function (password) {
            return /^(?=.*\d).{7,12}$/.test(password);
        }
    });
</script>