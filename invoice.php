<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
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
	$sqlGetUserId = "SELECT userId from login where username='$sessionUser'";
	$result = mysqli_query($connection, $sqlGetUserId);
	$value = mysqli_fetch_object($result);
	$userId = $value->userId;
	//Fetching data from View
	$sqlGetCommuteDetailsFromView = "select ticketId, commuteId, origin, destination, startDate, endDate, tripStatus, amount, busNo from tripRallyView where userId='$userId' and commuteId='$commuteId'";
	$resultSet = mysqli_query($connection, $sqlGetCommuteDetailsFromView);
	$resultCheck = mysqli_num_rows($resultSet);
	if ($resultCheck < 1) {
		echo '<h2 align=center>
					Sorry! No details available!
				</h2>';
		exit();
	}else{
		$value = mysqli_fetch_assoc($resultSet);
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
<?php require 'header.php' ?>

	<div class="container">
		<br><br>
		<div class="card mt-5">
			<div class="card-header">
				<h2>Invoice</h2>
			</div>
			<div class="card-body">
				<form action="manageTrips.php?" method="POST">
					<div class="form-group">
						<label for="commuteId"><h5>Ticket ID:	</h5></label>
						<label for="commuteIdVal"><h5><?= $value['ticketId'] ?></h5></label><br>
					</div>
					<div class="form-group">
						<label for="commuteId"><h5>Commute ID:	</h5></label>
						<label for="commuteIdVal"><h5><?= $value['commuteId'] ?></h5></label><br>
					</div>
					<div class="form-group">
						<label for="commuteId"><h5>Trip Amount:	</h5></label>
						<label for="commuteIdVal"><h5><?= $value['amount'] ?>$</h5></label><br>
					</div>
					<div class="form-group">
						<label for="commuteId"><h5>Bus:	</h5></label>
						<label for="commuteIdVal"><h5><?= $value['busNo'] ?></h5></label><br>
					</div>
					<div class="form-group">
						<label for="commuteId"><h5>Start Date:	</h5></label>
						<label for="commuteIdVal"><h5><?= $value['startDate'] ?></h5></label><br>
					</div>
					<div class="form-group">
						<label for="commuteId"><h5>End Date:	</h5></label>
						<label for="commuteIdVal"><h5><?= $value['endDate'] ?></h5></label><br>
					</div>
					<div class="form-group">
						<label for="commuteId"><h5>Origin:	</h5></label>
						<label for="commuteIdVal"><h5><?= $value['origin'] ?></h5></label><br>
					</div>
					<div class="form-group">
						<label for="commuteId"><h5>Destination:	</h5></label>
						<label for="commuteIdVal"><h5><?= $value['destination'] ?></h5></label><br>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-danger" name="return">RETURN</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php require 'footer.php' ?>