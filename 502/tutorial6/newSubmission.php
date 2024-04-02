<!DOCTYPE html>
<html>
<head>
    <title>Conference Details Page</title>

    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
          crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>

    <?php include('db_conn.php'); ?>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="home-jumborton bg-light text-dark rounded text-center">
            <h1>Submit a New Paper</h1>
        </div>

        <form method="post">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="txtAuthor" class="form-label">Author</label>
                        <input type="text" class="form-control" id="txtAuthor" placeholder="" />
                    </div>
                    <div class="mb-3">
                        <label for="txtEmailAddress" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="txtEmailAddress" placeholder="" />
                    </div>
                    <div class="mb-3">
                        <label for="txtAffiliate" class="form-label">Affiliate</label>
                        <input type="text" class="form-control" id="txtAffiliate" placeholder="" />
                    </div>
                    <div class="mb-3">
                        <span id="lblMessage" class="message-text"></span>
                    </div>
                    <div class="my-4">
                        <input id="btnCancel" type="button" name="btnCancel" class="btn btn-sm btn-info" onclick="CancelSubmission()" value="Cancel"></input>
                        <input id="btnNext" type="button" name="btnNext" class="btn btn-sm btn-primary" value="Next" onclick="CheckUserInfo()"></input>
                        <input id="btnAddPaper" type="button" name="btnAddPaper" class="btn btn-sm btn-primary" value="Add Paper" onclick="AddNewPaper()"></input>
                        <input id="btnShowPaper" type="button" name="btnShowPaper" class="btn btn-sm btn-outline-danger" value="Show Paper" onclick="CheckPaperInfo()"></input>
                    </div>
                </div>
                <div id="divNewPaperDetails" class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="cmbpaperType" class="form-label">Paper type</label>
                        <select class="form-control" id="cmbpaperType">
                          <option value="1">Paper</option>
                          <option value="2">Research</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="txtTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="txtTitle" placeholder="" />
                    </div>
                    <div class="mb-3">
                        <label for="txtAbstract" class="form-label">Abstract</label>
                        <textarea type="text" class="form-control" id="txtAbstract" placeholder="" rows="3"></textarea>
                    </div>
                    <div class="my-4">
                        <input id="btnCancel2" type="button" name="btnCancel" class="btn btn-sm btn-info" onclick="CancelSubmission()" value="Cancel"></input>
                        <input id="btnAddPaper2" type="button" name="btnAddPaper" class="btn btn-sm btn-primary" value="Add Paper" onclick="SubmitNewPaper()"></input>
                    </div>
                </div>
                <div id="divOldPaperDetails" class="col-sm-12 col-md-6">
                    <div class="my-4">    
                        <span id="lblOldMessage" class=""></span>
                    </div>

                    <div class="col-12 float-right">
                        <input type="button" class="btn btn-sm btn-info" onclick="CancelSubmission()" value="Back to Submission"></input>
                    </div>
                </div>
            </div>
            <div class="col">
                
            </div>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function () {
        $("#lblMessage").text("");
        $("#btnAddPaper").hide();
        $("#btnShowPaper").hide();
        $("#btnCancel2").hide();
        $("#btnAddPaper2").hide();
        $("#divNewPaperDetails").hide();
        $("#divOldPaperDetails").hide();
    });

    function CancelSubmission() {
        window.location.href = "submissions.php";
        //SetUserInfoStatus(1);
    }

    function AddNewPaper() {
        $("#btnCancel").hide();
        $("#btnAddPaper").hide();
        $("#btnCancel2").show();
        $("#btnAddPaper2").show();
        $("#divNewPaperDetails").show();
        SetUserInfoStatus(0);
    }

    function SetUserInfoStatus(isEnable) {
        if(isEnable === 0) {
            $('#txtAuthor').attr('readonly', true);
            $('#txtEmailAddress').attr('readonly', true);
            $('#txtAffiliate').attr('readonly', true);

            $('#txtAuthor').css('background-color' , '#DEDEDE');
            $('#txtEmailAddress').css('background-color' , '#DEDEDE');
            $('#txtAffiliate').css('background-color' , '#DEDEDE');
        } else {
            $('#txtAuthor').attr('readonly', false);
            $('#txtEmailAddress').attr('readonly', false);
            $('#txtAffiliate').attr('readonly', false);

            $('#txtAuthor').css('background-color' , '#ffffff');
            $('#txtEmailAddress').css('background-color' , '#ffffff');
            $('#txtAffiliate').css('background-color' , '#ffffff');
        }
    }

    function CheckUserInfo() {
        var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
            if(objXMLHttpRequest.readyState === 4) {
                if(objXMLHttpRequest.status === 200) {
                    var result = objXMLHttpRequest.responseText.split(",");
                    var userCount = result[0];
                    var paperCount = result[1];

                    if(paperCount > 0) {
                        $("#btnCancel").show();
                        $("#btnNext").hide();
                        $("#btnAddPaper").hide();
                        $("#btnShowPaper").show();
                        $("#lblMessage").text("You have already submitted the paper.");
                    } else if(userCount > 0 && paperCount <= 0) {
                        $("#btnCancel").show();
                        $("#btnNext").hide();
                        $("#btnAddPaper").show();
                        $("#btnShowPaper").hide();
                        $("#lblMessage").text("You have already provided the author information. Do you want to continue to submit the paper?");
                    } else {
                        $("#btnCancel").show();
                        $("#btnNext").hide();
                        $("#btnAddPaper").show();
                        $("#btnShowPaper").hide();
                        $("#lblMessage").text("");
                    }
                } else {
                    alert('Error Code: ' +  objXMLHttpRequest.status);
                    alert('Error Message: ' + objXMLHttpRequest.statusText);
                }
            }
        }

        var emailAddress = document.getElementById("txtEmailAddress").value;
        objXMLHttpRequest.open('GET', 'api_submission_engine.php?e=' + emailAddress);
        objXMLHttpRequest.send();
    }

    function CheckPaperInfo() {
        var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
            if(objXMLHttpRequest.readyState === 4) {
                if(objXMLHttpRequest.status === 200) {
                    $("#btnCancel").hide();
                    $("#btnAddPaper").hide();
                    $("#btnNext").hide();
                    $("#btnAddPaper").hide();
                    $("#btnShowPaper").hide();

                    SetUserInfoStatus(0);
                    $("#divOldPaperDetails").show();
                    $("#lblMessage").text("");
                    $("#lblOldMessage").html(objXMLHttpRequest.responseText);
                } else {
                    alert('Error Code: ' +  objXMLHttpRequest.status);
                    alert('Error Message: ' + objXMLHttpRequest.statusText);
                }
            }
        }

        var emailAddress = document.getElementById("txtEmailAddress").value;
        objXMLHttpRequest.open('GET', 'api_paper_engine.php?e=' + emailAddress);
        objXMLHttpRequest.send();
    }

    function SubmitNewPaper() {
        if (jQuery.trim($("#txtTitle").val()).length <= 0) {
            $("#lblMessage").text("Please enter paper title.");
            return;
        }

        if (jQuery.trim($("#txtAbstract").val()).length <= 0) {
            $("#lblMessage").text("Please enter paper abstract.");
            return;
        }

        $.ajax({
            url: 'api_submission_engine.php',
            type: 'POST',
            data: {
                name: document.getElementById("txtAuthor").value, 
                emailAddress: document.getElementById("txtEmailAddress").value,
                affiliation: document.getElementById("txtAffiliate").value,
                paperType: document.getElementById("cmbpaperType").value,
                title: document.getElementById("txtTitle").value,
                abstract: document.getElementById("txtAbstract").value
            },
            success: function(msg) {
                console.log("length: " + msg.length);
                if(msg.length == 0) {
                    alert("Paper has been added.");
                    CancelSubmission();
                } else {
                    alert(msg);
                }
            },
            error: function(msg) {
                alert("An error occurred.");
            }
        });
    }
</script>