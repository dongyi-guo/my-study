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
            <h1>Submission List</h1>
        </div>
        <a href="newSubmission.php" class="btn btn-outline-primary">Submit a New Paper</a>

        <div class="p-2">
            <h4 class="my-4">Paper</h4>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <td style="width: 5%;">ID</td>
                        <td style="width: 9%;">Author</td>
                        <td style="width: 6%;">Type</td>
                        <td style="width: 15%;">Title</td>
                        <td style="width: 25%;">Abstract</td>
                        <td style="width: 8%;">Location</td>
                        <td style="width: 7%;">Scores</td>
                        <td style="width: 25%;">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM $dbName.SubmissionListView;";
                    $stmt = $db->query($query);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php $id = $row['Id'] ?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $row['Author']; ?></td>
                            <td><?php echo $row['Type']; ?></td>
                            <td><?php echo $row['Title']; ?></td>
                            <td><?php echo $row['Abstract']; ?></td>
                            <td><?php echo $row['Location']; ?></td>
                            <td><?php echo $row['Scores']; ?></td>
                            <td>
                                <input id="btnShowReviewInfo" type="button" class="btn btn-sm btn-primary" onclick="ShowReviewerInfo(<?php echo $id ?>)" value="Reviewer"></input>
                                <a href="editSubmission.php?p=<?php echo $id ?>" class="btn btn-sm btn-warning ml-2">Edit</a>
                                <input id="btnDeletePaper" type="button" class="btn btn-sm btn-danger ml-2" onclick="DeletePaper(<?php echo $id ?>)" value="Delete"></input>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <br />

        <div>
            <span id="lblReviewerInfo"></span>
        </div>

        <div class="col-sm-12 col-md-8 col-lg-6">
            <h4>Contact Address</h4>
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td><b>Conference Chair</b></td>
                        <td><a href="mailto:conferecechair@conference.com">conferecechair@conference.com</a></td>
                    </tr>
                    <tr>
                        <td><b>Organisation</b></td>
                        <td><a href="mailto:Organisation@conference.com">Organisation@conference.com</a></td>
                    </tr>
                    <tr>
                        <td><b>Supporter Liaison</b></td>
                        <td><a href="mailto:support@conference.com">support@conference.com</a></td>
                    </tr>
                </tbody>
            </table>
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

<script type="text/javascript">
    $(document).ready(function () {
        
    });

    function ShowReviewerInfo(paperId) {
        var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
            if(objXMLHttpRequest.readyState === 4) {
                if(objXMLHttpRequest.status === 200) {
                    $("#lblReviewerInfo").html(objXMLHttpRequest.responseText);
                }
            }
        }

        objXMLHttpRequest.open('GET', 'api_reviewer_info.php?paperId=' + paperId);
        objXMLHttpRequest.send();
    }

    function DeletePaper(paperId) {
        $.ajax({
            url: 'api_paper_engine.php',
            type: 'POST',
            data: {
                paperId: paperId 
            },
            success: function(msg) {
                if(msg.length == 0) {
                    alert("Paper deleted succecssfully.");
                    window.location.href = "submissions.php";
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