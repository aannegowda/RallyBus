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

//Fetching data from View
$sqlGetUserDetailsFromView = "select * FROM userDetailsView";
$resultSet = mysqli_query($connection, $sqlGetUserDetailsFromView);
while($row = $resultSet->fetch_assoc())
{
    $rows[] = $row;
}

 ?>

<?php require 'header.php'; ?>
<div class="container">
	<br><br>
	<div class="card mt-5">
		<div class="card-header">
			<h2>All Users</h2>
		</div>
		<div class="card-body">
			<table class="table table-bordered">
				<tr>
					<th>User ID</th>
					<th>Username</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Phone</th>
					<th>Email ID</th>
					<th>Address</th>
				</tr>
				<?php foreach ($rows as $tripRow): ?>
					<tr>
						<td><?= $tripRow['userId']; ?></td>
						<td><?= $tripRow['username']; ?></td>
						<td><?= $tripRow['firstName']; ?></td>
						<td><?= $tripRow['lastName']; ?></td>
						<td><?= $tripRow['phoneNo']; ?></td>
						<td><?= $tripRow['emailId']; ?></td>
						<td><?= $tripRow['address']; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
	
</div>

<?php require 'footer.php'; ?>