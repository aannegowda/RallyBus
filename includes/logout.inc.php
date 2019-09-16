<?php 

if (isset($_POST['logoutSubmit'])) {
	session_start();
	session_unset();
	session_destroy();
	header("Location: ../index.php");
	exit();
}

 ?>