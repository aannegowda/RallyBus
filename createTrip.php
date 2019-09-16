<!DOCTYPE html>
<html>
<head>
	<title>Create Trip</title>
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
		<div class="main-wrapper">
			<div class="activity-box-createTrip">
				<h1>Please enter your trip details</h1>
				<form action="includes/createTrip.inc.php" method="POST">
					<p>Origin</p>
					<input type="text" name="origin" placeholder="Enter from address">
					<p>Destination</p>
					<input type="text" name="destination" placeholder="Enter to address">
					<p>Start date</p>
					<input type="date" name="startDate" id="startDate">
					<p>End date</p>
					<input type="date" name="endDate" id="endDate"><br>
					<button type="submit" name="tripSubmit">CREATE TRIP</button>
				</form>
			</div>
		</div>
</body>
</html>