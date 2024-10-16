<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Admin </title>

	<link href="css/app.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>


<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="admin">
          <span class="align-middle">Admin</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="admin.php">
              <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>
                    <li class="dropdown"> 
						<a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Slider </span> <i class="align-middle" data-feather="chevron-down"></i>
            </a>
			<ul class="sub-item">
			    <a href="viewslider.php"> View Banner Slider </a> 
			  <a href="addslider.php"> Add Banner Slider </a> 
		    </ul> 	</li> 
    
			<li class="sidebar-item">
						<a class="sidebar-link" href="pages-user.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-in.php">
              <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
            </a>
		</li>
        
	
		              <li class="dropdown">
						<a class="sidebar-link">
              <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Pages</span><i class="align-middle" data-feather="chevron-down"></i>
            </a>
			<ul class="sub-item">
			   <a href="viewpages.php"> View Pages </a> 
		    	<a href="pages.php"> Add Pages  </a> 
		    </ul>	</li>

			        <li class="dropdown">
						<a class="sidebar-link">
              <i class="align-middle" data-feather="menu"></i> <span class="align-middle">Menu</span><i class="align-middle" data-feather="chevron-down"></i>
            </a>
			<ul class="sub-item">
			   <a href="viewmenu.php"> View Menu </a> 
		    	<a href="menu.php"> Add Menu  </a> 
		    </ul>	</li>

					<li class="dropdown">
						<a class="sidebar-link">
              <i class="align-middle" data-feather="gift"></i> <span class="align-middle">Products</span><i class="align-middle" data-feather="chevron-down"></i>
            </a>
			<ul class="sub-item">
			   <a href="viewproducts.php"> View Products </a> 
		    	<a href="addproducts.php"> Add Products </a> 
		    </ul>	</li>

			
			<li class="sidebar-item ">
						<a class="sidebar-link" href="orders.php">
              <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Orders</span>
            </a>
					</li>
	
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="img/avatars/icon.jpg" class="avatar img-fluid rounded me-1" alt="" /> <span class="text-dark"><?php echo $_SESSION['aname']; ?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
							<?php
                                 $Name = $_SESSION['aname'];
                                 require('conn.php');
                                 $sql = " SELECT * FROM admin WHERE username ='$Name'";
                                 $result = $conn->query($sql);
                                 $row = mysqli_fetch_array($result); ?>
								<a class="dropdown-item" href="profile.php?id=<?php echo $row["ID"] ?>" ><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			
            <script src="js/app.js"></script>

