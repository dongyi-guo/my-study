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

    <?php 
        $id = $_GET['p'];   
        $stmt = $db->prepare("SELECT * FROM $dbName.SubmissionListView WHERE Id = ?");
        $stmt->execute([$id]);
        $paper = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="home-jumborton bg-light text-dark rounded text-center">
            <h1>Update Paper Details</h1>
        </div>

        <form method="post">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <input id="paperId" type="text" class="form-control" name="paperID" value = "<?php echo $paper['Id']; ?>" hidden>
                        <input id="authorId" type="text" class="form-control" name="authorID" value = "<?php echo $paper['AuthorId']; ?>" hidden>
                    </div>
                    <div class="mb-3">
                        <label for="txtAuthor" class="form-label">Author</label>
                        <input type="text" class="form-control" id="txtAuthor" placeholder="" value="<?php echo $paper['Author']; ?>" readonly/>
                    </div>
                    <div class="mb-3">
                        <label for="cmbpaperType" class="form-label">Paper type</label>
                        <select class="form-control" id="cmbpaperType">
                          <option value="1" <?php if($paper["Type"] == "Paper") echo "selected"; ?>>Paper</option>
                          <option value="2" <?php if($paper["Type"] == "Other") echo "selected"; ?>>Research</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="txtTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="txtTitle" placeholder="" value="<?php echo $paper['Title']; ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="txtAbstract" class="form-label">Abstract</label>
                        <input type="text" class="form-control" id="txtAbstract" placeholder="" value="<?php echo $paper['Abstract']; ?>"></textarea>
                    </div>
                    <div class="mb-3">
                        <span id="lblMessage" class="message-text"></span>
                    </div>
                    <div class="my-4">
                        <input id="btnCancel" type="button" name="btnCancel" class="btn btn-sm btn-info" onclick="CancelSubmission()" value="Cancel"></input>
                        <input id="btnUpdate" type="button" name="btnUpdate" class="btn btn-sm btn-primary" value="Update" onclick="UpdatePaperInfo()"></input>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function () {
        $('#txtAuthor').css('background-color' , '#DEDEDE');
    });

    function CancelSubmission() {
        window.location.href = "submissions.php";
    }
    function UpdatePaperInfo() {
        if (jQuery.trim($("#txtTitle").val()).length <= 0) {
            $("#lblMessage").text("Please enter paper title.");
            return;
        }

        if (jQuery.trim($("#txtAbstract").val()).length <= 0) {
            $("#lblMessage").text("Please enter paper abstract.");
            return;
        }

        $.ajax({
            url: 'api_paper_update.php',
            type: 'POST',
            data: {
                paperId: document.getElementById("paperId").value, 
                authorId: document.getElementById("authorId").value, 
                paperType: document.getElementById("cmbpaperType").value,
                title: document.getElementById("txtTitle").value,
                abstract: document.getElementById("txtAbstract").value
            },
            success: function(msg) {
                if(msg.length == 0) {
                    alert("Paper has been updated.");
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