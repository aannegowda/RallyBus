<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rally Bus</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<header>
		<nav>
			<div class="main-wrapper">
				<ul>
					<li><label>RALLY BUS</label></li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="login-box">
		<img src="images/login_avatar4.jpg" class="avatar">
		<h1>Log In</h1>
		<form action="includes/login.inc.php" method="POST">
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter username">
			<p>Password</p>
			<input type="password" name="loginPassword" placeholder="Enter password">
			<button type="submit" name="loginSubmit">Log In</button>
			<br><br>
			<a href="#">Forgot Password</a>
			<br><br>
			<a href="signup.php"><h1>New User? Sign Up</h1></a>
		</form>
	</div>
</body>
</html>