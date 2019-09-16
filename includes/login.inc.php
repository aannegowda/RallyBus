<?php

session_start();

if (isset($_POST['loginSubmit'])) {
	
	include 'dbh.inc.php';

	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$loginPassword = mysqli_real_escape_string($connection, $_POST['loginPassword']);

	//Error handlers
	//Throw error in case inputs are empty
	if (empty($username) || empty($loginPassword)) {
		header("Location: ../index.php?login=empty");
		exit();
	}else{
		$sql = "SELECT * FROM login WHERE username='$username'";
		$result = mysqli_query($connection, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../index.php?login=error");
			exit();
		}else{
			if($row = mysqli_fetch_assoc($result)){
				//password check
				if ($loginPassword != $row['password']) {
					header("Location: ../index.php?login=error");
					exit();
				}else{
					//Login the user
					if ($username!='admin' && $loginPassword!='admin@2018') {
						$_SESSION['username'] = $row['username'];
						header("Location: ../trip.php?login=success");
						exit();
					}else{
						$_SESSION['username'] = $row['username'];
						header("Location: ../admin.php?login=success");
						exit();
					}
				}
			}
		}
	}

}else{
	header("Location: ../index.php?login=error");
	exit();
}