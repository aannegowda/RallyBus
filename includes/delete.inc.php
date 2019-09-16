<?php

session_start();

	include 'dbh.inc.php';

	$commuteId = $_GET['commuteId'];

	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	  header("location: ../index.php");
	  exit;
	}else{
		$sessionUser = $_SESSION['username'];
	}

	//Error handlers
	//Check for empty fields
	if (empty($commuteId)) {
		header("Location: ../manageTrips.php?deleteTrip=empty");
		exit();
	}else{
		//Soft delete of trip using procedure
		$sqlSoftDeleteTripData = "CALL softDeleteTripData('".$commuteId."')";
		if (mysqli_query($connection, $sqlSoftDeleteTripData)) {
			header("Location: ../manageTrips.php?deleteTrip=success");
		}else{
			header("Location: ../manageTrips.php?deleteTrip=error");
			exit();
		}
	}
