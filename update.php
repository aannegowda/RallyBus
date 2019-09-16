<!DOCTYPE html>
<html>
<head>
	<title>Update Trip</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<?php 

	session_start();

	include 'includes/dbh.inc.php';

	$commuteId = $_GET['commuteId'];

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
		<?php
			$sqlGetCommuteData = "SELECT origin, destination, startDate, endDate FROM rally where commuteId='$commuteId'";
			$result = mysqli_query($connection, $sqlGetCommuteData);
			$value = mysqli_fetch_assoc($result);
			//$userId = $value->userId;
		?>
		<div class="main-wrapper">
			<div class="activity-box-createTrip">
				<h1>Update your trip details</h1>
				<form action="includes/update.inc.php?commuteId=<?= $commuteId ?>" method="POST">
					<p>Origin</p>
					<input type="text" name="origin" placeholder="Enter from address" value="<?= $value['origin'] ?>">
					<p>Destination</p>
					<input type="text" name="destination" placeholder="Enter to address" value="<?= $value['destination'] ?>">
					<p>Start date</p>
					<input type="date" name="startDate" id="startDate" value="<?php echo date('Y-m-d', strtotime($value['startDate'])); ?>">
					<p>End date</p>
					<input type="date" name="endDate" id="endDate" value="<?php echo date('Y-m-d', strtotime($value['endDate'])); ?>"><br>
					<button type="submit" name="updateSubmit">UPDATE TRIP</button><br><br>
				</form>
			</div>
		</div>
</body>
</html>