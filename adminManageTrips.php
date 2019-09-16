<head>
	<title>User Details</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
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

<?php 

session_start();

include 'includes/dbh.inc.php';
	
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
 header("location: index.php");
 exit();
}else{
	$sessionUser = $_SESSION['username'];
}

//Fetching all trips pending with admin from View
$sqlGetAllUserTripsFromView = "SELECT commuteId, origin, destination, startDate, endDate FROM tripRallyAdminView";
$resultSet = mysqli_query($connection, $sqlGetAllUserTripsFromView);
$resultCheck = mysqli_num_rows($resultSet);
if ($resultCheck < 1) {
	echo '<h2 align=center>
				No trips scheduled!
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
			<h2>All Trips</h2>
		</div>
		<div class="card-body">
			<table class="table table-bordered">
				<tr>
					<th>Commute ID</th>
					<th>Origin</th>
					<th>Destination</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Action</th>
				</tr>
				<?php foreach ($rows as $tripRow): ?>
					<tr>
						<td><?= $tripRow['commuteId']; ?></td>
						<td><?= $tripRow['origin']; ?></td>
						<td><?= $tripRow['destination']; ?></td>
						<td><?= $tripRow['startDate']; ?></td>
						<td><?= $tripRow['endDate']; ?></td>
						<td>
							<a href="adminTripUpdate.php?commuteId=<?= $tripRow['commuteId'] ?>&origin=<?= $tripRow['origin'] ?>&destination=<?= $tripRow['destination'] ?>" class="btn btn-danger">Enter Amount/Bus No</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
	
</div>

<?php require 'footer.php'; ?>