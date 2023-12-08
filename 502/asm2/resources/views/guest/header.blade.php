<header class="container d-none d-sm-block">
    <div class="row align-items-center">
        <div class="col-12 col-md-8">
        <img src="images/taget-logo.jpg" class="img img-fluid rounded-1" alt="TaGET Logo" style="height: 40px;" />
        </div>
        <div class="col-12 col-md-4 text-end">
            <a href="#" class="social-box facebook" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social-box twitter" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-box pinterest" target="_blank"><i class="fab fa-pinterest"></i></a>
            <a href="#" class="social-box linkedin" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="social-box envelope" target="_blank"><i class="fas fa-envelope"></i></a>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <img src="images/taget-logo-small.jpg" class="img img-fluid d-lg-none rounded-0" alt="TaGET Logo" style="width: 150px; height: 40px;" />
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Pricing</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Privacy</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Our Terms</a>
            </li>
        </ul>
        <form class="d-flex py-2" role="search" action="@Url.Action("search", "article")">
            <div class="input-group">
                <input class="form-control rounded-0" type="search" placeholder="Search" aria-label="Search" id="txtSerch" name="query">
                <button class="btn btn-outline-info input-group-text rounded-0" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
  </div>
</nav>

<style>
    .navbar{
        border-width: 0;
        background-color: #fffffd;
        border-color: #dedede;
        border-style: solid;
        padding-top: 0px;
        padding-bottom: 0px;
        border-top-width: 1px;
        border-bottom-width: 1px;
        height: 58px;
    }

    .nav-item{
        margin-right: 30px;
    }

    .nav-link{
        position: relative;
        font-size: 13px;
        font-weight: bold;
        text-transform: uppercase;
        color: #313131;
        line-height: 42px;
    }

    header {
        border-width: 0;
        background-color: #fffffd;
        border-style: solid;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    header .input-group {
        width: 100%;
        max-width: 500px;
    }

    header .input-group input {
        color: #313131;
        font-size: 13px;
    }

    header .input-group .input-group-text {
        padding: 11px;
        background-color: #303f9f;
        color: #ffffff;
    }

    .social-box {
        display: inline-block;
        margin-right: 5px;
        color: #ffffff;
        height: 28px;
        width: 28px;
        text-align: center;
    }

    .facebook {
        line-height: 28px;
        color: #fff !important;
        background-color: #0d47a1 !important;
    }

    .twitter {
        line-height: 28px;
        color: #fff !important;
        background-color: #40c4ff !important;
    }

    .pinterest {
        line-height: 28px;
        color: #fff !important;
        background-color: #e71b22 !important;
    }

    .linkedin {
        line-height: 28px;
        color: #fff !important;
        background-color: #0077b7 !important;
    }

    .envelope {
        line-height: 28px;
        color: #fff !important;
        background-color: #0084ff !important;
    }
</style>