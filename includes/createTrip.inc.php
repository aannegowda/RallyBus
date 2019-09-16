<?php

session_start();

if (isset($_POST['tripSubmit'])) {

	include 'dbh.inc.php';

	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	  header("location: createTrip.php?createTrip=emptyusername");
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
		header("Location: ../createTrip.php?createTrip=empty");
		exit();
	}else{
		$sqlGetUserId = "SELECT userId from login where username='$sessionUser'";
		$result = mysqli_query($connection, $sqlGetUserId);
		$value = mysqli_fetch_object($result);
		$userId = $value->userId;
		$sqlInsertTripData = "CALL insertTripData('".$origin."', '".$destination."', '".$startDate."', '".$endDate."', '".$userId."')";
		if (mysqli_query($connection, $sqlInsertTripData)) {
			header("Location: ../createTrip.php?createTrip=success");
		}else{
			header("Location: ../createTrip.php?createTrip=error");
			exit();
		}
	}
}