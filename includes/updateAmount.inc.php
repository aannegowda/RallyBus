<?php

session_start();

if (isset($_POST['amountSubmit'])) {

	include 'dbh.inc.php';

	$commuteId = $_GET['commuteId'];

	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	  header("location: ../index.php");
	  exit;
	}else{
		$sessionUser = $_SESSION['username'];
	}

	$amountString = mysqli_real_escape_string($connection, $_POST['tripAmount']);
	$amount = (int)$amountString;
	$tripBusNo = mysqli_real_escape_string($connection, $_POST['tripBusNo']);

	//Error handlers
	//Check for empty fields
	if (empty($commuteId) || empty($amount)) {
		header("Location: ../adminTripUpdate.php?updateTrip=empty");
		exit();
	}else{
		//Updating amount for the commute using stored procedure
		$sqlupdateBusAndTripAmount = "CALL updateBusAndTripAmount('".$amount."', '".$tripBusNo."', '".$commuteId."')";
		if (mysqli_query($connection, $sqlupdateBusAndTripAmount)) {
			header("Location: ../adminManageTrips.php?updateAmount=success");
		}else{
			header("Location: ../adminTripUpdate.php?updateAmount=error");
			exit();
		}
	}
}