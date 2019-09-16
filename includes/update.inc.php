<?php

session_start();

if (isset($_POST['updateSubmit'])) {

	include 'dbh.inc.php';

	$commuteId = $_GET['commuteId'];

	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	  header("location: ../index.php");
	  exit;
	}else{
		$sessionUser = $_SESSION['username'];
	}

	$origin = mysqli_real_escape_string($connection, $_POST['origin']);
	$destination = mysqli_real_escape_string($connection, $_POST['destination']);
	$rawStartdate = htmlentities($_POST['startDate']);
	$startDate = date('Y-m-d', strtotime($rawStartdate));
	$rawEnddate = htmlentities($_POST['endDate']);
	$endDate = date('Y-m-d', strtotime($rawEnddate));

	//Error handlers
	//Check for empty fields
	if (empty($origin) || empty($destination) || empty($startDate) || empty($endDate)) {
		header("Location: ../updateTrip.php?updateTrip=empty");
		exit();
	}else{
		//Updating trip data using stored procedure
		$sqlUpdateTripData = "CALL updateTripData('".$origin."', '".$destination."', '".$startDate."', '".$endDate."', '".$commuteId."')";
		if (mysqli_query($connection, $sqlUpdateTripData)) {
			header("Location: ../manageTrips.php?updateTrip=success");
			//echo '';
		}else{
			header("Location: ../createTrip.php?updateTrip=error");
			exit();
		}
	}
}