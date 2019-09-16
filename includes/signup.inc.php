<?php

session_start();

if (isset($_POST['registerSubmit'])) {
	
	include_once 'dbh.inc.php';

	$_SESSION['username'] = mysqli_real_escape_string($connection, $_POST['username']);

	$firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$phone = mysqli_real_escape_string($connection, $_POST['phone']);
	$address = mysqli_real_escape_string($connection, $_POST['address']);
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$confirmPassword = mysqli_real_escape_string($connection, $_POST['confirmPassword']);
	$radioType = mysqli_real_escape_string($connection, $_POST['radioType']);
	$id = mysqli_real_escape_string($connection, $_POST['id']);
	$uniCompName = mysqli_real_escape_string($connection, $_POST['uniCompName']);

	//Error handlers
	//Check for empty fields
	if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($confirmPassword) || empty($username) || empty($radioType) || empty($id) || empty($uniCompName)) {
		header("Location: ../signup.php?signup=empty");
		exit();
	}else{
		//Check if input parameters are valid
		if (!preg_match("/^[a-zA-Z]*$/", $firstName) || !preg_match("/^[a-zA-Z]*$/", $lastName)) {
			header("Location: ../signup.php?signup=invalid");
			exit();
		}else{
			//Check if email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../signup.php?signup=emailError");
				exit();
			}else{
				$sql = "SELECT * FROM login WHERE username='$username'";
				$result = mysqli_query($connection, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					header("Location: ../signup.php?signup=usernameTaken");
					exit();
				}else{
					//Insert new user data into person, login, student/corporate tables through stored procedures
					$sqlInsertNewUserData = "CALL insertNewUserData('".$firstName."', '".$lastName."', '".$phone."', '".$email."', '".$address."', '".$username."', '".$password."')";
					if (mysqli_query($connection, $sqlInsertNewUserData)) {
						$sessionUser = $_SESSION['username'];
						$sqlGetUserId = "SELECT userId from login where username='$sessionUser'";
						$result = mysqli_query($connection, $sqlGetUserId);
						$value = mysqli_fetch_object($result);
						$userId = $value->userId;

						if ($radioType == "Student") {
							$sqlInsertStudentData = "CALL insertStudentData('".$userId."', '".$id."', '".$uniCompName."')";
							mysqli_query($connection, $sqlInsertStudentData);
						}else{
							$sqlInsertCorporateData = "CALL insertCorporateData('".$userId."', '".$id."', '".$uniCompName."')";
							mysqli_query($connection, $sqlInsertCorporateData);
						}

						//Redirect to admin page if the user is admin
						if ($username!='admin' && $loginPassword!='admin@2018') {
							header("Location: ../trip.php?signup=success");
						}else{
							header("Location: ../admin.php?signup=success");
						}
					}else{
						header("Location: ../index.php?signUp=error");
						exit();
					}
				}
			}
		}

	}

}else{
	header("Location: ../signup.php");
	exit();
}