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
	$origin = $_GET['origin'];
	$destination = $_GET['destination'];

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
					<li><a href="admin.php">Home</a></li>
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
				<h2>Update amount and Bus number to the commute</h2>
			</div>
			<div class="card-body">
				<form action="includes/updateAmount.inc.php?commuteId=<?= $commuteId ?>" method="POST">
					<div class="form-group">
						<label for="commuteId"><h5>Commute ID: </h5></label>
						<label for="commuteIdVal"><h5><?= $commuteId ?></h5></label><br>
					</div>
					<div class="form-group">
						<label for="origin"><h5>Origin: </h5></label>
						<label for="originVal"><h5><?= $origin ?></h5></label><br>
					</div>
					<div class="form-group">
						<label for="destination"><h5>Destination: </h5></label>
						<label for="destinationVal"><h5><?= $destination ?></h5></label><br>
					</div>
					<div class="form-group">
						<label for="amount"><h5>Amount: </h5></label>
						<input type="text" name="tripAmount" id="tripAmount" class="form-control" placeholder="Enter amount">
					</div>
					<div class="form-group">
						<label for="busNo"><h5>Bus Number: </h5></label>
						<input type="text" name="tripBusNo" id="tripBusNo" class="form-control" placeholder="Enter Bus number">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-danger" name="amountSubmit">SUBMIT</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php require 'footer.php' ?>