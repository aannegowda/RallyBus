<head>
	<title>Create Trip</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
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

session_start();

include 'includes/dbh.inc.php';
	
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
$sqlGetUserTripsFromView = "select ticketId, commuteId, origin, destination, startDate, endDate, tripStatus from tripRallyView where userId='$userId'";
$resultSet = mysqli_query($connection, $sqlGetUserTripsFromView);
$resultCheck = mysqli_num_rows($resultSet);
if ($resultCheck < 1) {
	echo '<h2 align=center>
				No trips scheduled! Go to Home page to create new trips.
			</h2>';
	exit();
}else{
	while($row = $resultSet->fetch_assoc()) {
    	$rows[] = $row;
	}	
}

 ?>

<?php require 'header.php'; ?>
<div class="container">
	<br><br>
	<div class="card mt-5">
		<div class="card-header">
			<h2>Your Trips</h2>
		</div>
		<div class="card-body">
			<table class="table table-bordered">
				<tr>
					<!-- <th>User ID</th> -->
					<th>Ticket ID</th>
					<th>Commute ID</th>
					<th>Origin</th>
					<th>Destination</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Trip Status</th>
					<th>Action</th>
				</tr>
				<?php foreach ($rows as $tripRow): ?>
					<tr>
						<!-- <td><?= $tripRow['userId']; ?></td> -->
						<td><?= $tripRow['ticketId']; ?></td>
						<td><?= $tripRow['commuteId']; ?></td>
						<td><?= $tripRow['origin']; ?></td>
						<td><?= $tripRow['destination']; ?></td>
						<td><?= $tripRow['startDate']; ?></td>
						<td><?= $tripRow['endDate']; ?></td>
						<td><?= $tripRow['tripStatus']; ?></td>
						<td>
							<a href="update.php?commuteId=<?= $tripRow['commuteId'] ?>" class="btn btn-info">Edit</a>
							<a href="includes/delete.inc.php?commuteId=<?= $tripRow['commuteId'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this trip?')">Cancel Trip</a>
							<a href="invoice.php?commuteId=<?= $tripRow['commuteId'] ?>" class="btn btn-success">Invoice</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
	
</div>

<?php require 'footer.php'; ?>