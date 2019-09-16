<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<?php 
	session_start();
	 
	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	  header("location: index.php");
	  exit();
	}else{
		$sessionUser = $_SESSION['username'];
	}
 ?>

<body>
	<header>
		<nav>
			<div class="main-wrapper">
				<ul>
					<li><a href="trip.php">Home</a></li>
					<li><h1>RALLY BUS</h1></li>
				</ul>
				<div class="nav-bar">
					<?php
						if (isset($_SESSION['username'])) {
							echo '<form action="includes/logout.inc.php" method="POST">
								<button type="submit" name="logoutSubmit">Log out</button>
							</form>';
						}
					 ?>
				</div>
			</div>
		</nav>
	</header>
	<section class="main-container">
		<div class="main-wrapper">
			<h2>
				<?php 
					echo "Welcome ".$sessionUser."!";
				?>	
			</h2>	
		</div>
	</section>
	<div class="activity-box-create">
		<h1>View user details</h1>
		<form action="userDetails.php" method="POST">
			<button type="submit" name="createSubmit">VIEW USERS</button>
		</form>
	</div>
	<div class="activity-box-manageTrips">
		<h1>View and manage all trips</h1>
		<form action="adminManageTrips.php" method="POST">
			<button type="submit" name="adminManageSubmit">MANAGE TRIPS</button>
		</form>
	</div>
</body>
</html>