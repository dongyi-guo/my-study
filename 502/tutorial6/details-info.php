<!DOCTYPE html>
<html>
<head>
    <title>Conference Details Page</title>

    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
          crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="home-jumborton bg-light text-dark rounded text-center">
            <h1>Details about the Conference</h1>
        </div>

        <h2>Conference date: 22-24 September 2023</h2>

        <div>
            <h4>Submission deadline and page limits</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Pages</th>
                        <th scope="col">Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Paper</td>
                        <td>6 pages plus 1 page for references if required</td>
                        <td>1 April</td>
                    </tr>
                    <tr>
                        <td>Working group</td>
                        <td>2 pages</td>
                        <td>1 April</td>
                    </tr>
                    <tr>
                        <td>Poster</td>
                        <td>1 page</td>
                        <td>15 June</td>
                    </tr>
                    <tr>
                        <td>Doctoral consortium</td>
                        <td>2 pages</td>
                        <td>15 June</td>
                    </tr>
                    <tr>
                        <td>Tips, techniques and courseware</td>
                        <td>2 pages</td>
                        <td>15 June</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br />

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