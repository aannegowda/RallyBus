<!DOCTYPE html>
<html>
<head>
	<title>Trip</title>
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
		<h1>Create your trip</h1>
		<form action="createTrip.php" method="POST">
			<button type="submit" name="createSubmit">CREATE</button>
		</form>
	</div>
	<div class="activity-box-manageTrips">
		<h1>View, edit or cancel trips</h1>
		<form action="manageTrips.php" method="POST">
			<button type="submit" name="manageSubmit">MANAGE TRIPS</button>
		</form>
	</div>
</body>
</html>