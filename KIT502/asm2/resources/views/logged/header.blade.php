<nav class="bg-light">
    <!-- <img src="images/taget-logo-small.jpg" style="width: 100%; height: 3.5rem;" alt="TaGET Logo" /> -->
    <h1 class="text-center py-4 bg-info">TaGET</h1>
    <div class="nav-header">
		<span><b>Ahmed All Razi</b></span>
        <br />
		<span>Service Manager</span>
    </div>
    <hr />
	<ul>
		<li><a href='#'><i style="min-width: 20px;" class="fa fa-tachometer"></i> Dashboard</a></li>
		<li><a href='#'><i style="min-width: 20px;" class="fa fa-pencil-square"></i> Market Update</a></li>
        <li><a href='#'><i style="min-width: 20px;" class="fa fa-usd"></i> Service Fee</a></li>
        <li><a href='#'><i style="min-width: 20px;" class="fa fa-suitcase"></i> Trading</a></li>
        <li><a href='#'><i style="min-width: 20px;" class="fa fa-users"></i> User Management</a></li>
        <li><a href='#'><i style="min-width: 20px;" class="fa fa-user"></i> Profile</a></li>
		<!-- <li class='sub-menu'><a href='#settings'>Settings<div class='fa fa-caret-down right'></div></a>
			<ul>
				<li><a href='#settings'>Account</a></li>
				<li><a href='#settings'>Profile</a></li>
				<li><a href='#settings'>Secruity & Privacy</a></li>
				<li><a href='#settings'>Password</a></li>
				<li><a href='#settings'>Notification</a></li>
			</ul>
		</li> -->
        <hr />
		<li><a href='#'><i style="min-width: 20px;" class="fa fa-sign-out"></i> Logout</a></li>
	</ul>
</nav>

<style>
    nav {
        position: fixed;
        margin: 0px;
        height: 100%;
        overflow: auto;
    }
    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    nav ul li {
    /* Sub Menu */
    }
    nav ul li a {
        display: block;
        padding: 10px 15px;
        color: #333333;
        text-decoration: none;
        -webkit-transition: 0.2s linear;
        -moz-transition: 0.2s linear;
        -ms-transition: 0.2s linear;
        -o-transition: 0.2s linear;
        transition: 0.2s linear;
    }
    .nav-header{
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
        font-family: Helvetica;
        font-size: 16px;
    }
    .nav-header li a {
        padding: 2px;
        color: #281d02;
    }
    nav ul li a:hover {
        background: #1d4f71;
        color: #ffffff;
    }
    nav ul li a .fa {
        width: 16px;
        text-align: center;
        margin-right: 5px;
        float:right;
    }
    nav ul ul {
        background: rgba(0, 0, 0, 0.2);
    }
    nav ul li ul li a {        
        border-left: 4px solid transparent;
        padding: 10px 20px;
    }
    nav ul li ul li a:hover {
        border-left: 4px solid #3498db;
    }
    nav hr {
        color: #666666;
    }
</style>

<script>
    $('.sub-menu ul').hide();
    $(".sub-menu a").click(function () {
    $(this).parent(".sub-menu").children("ul").slideToggle("100");
    $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
    });
 </script>