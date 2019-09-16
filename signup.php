<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
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
	<div class="register-box">
		<img src="images/register_avatar5.jpg" class="avatar">
		<h1>Sign Up</h1>
		<form action="includes/signup.inc.php" method="POST">
			<p>First Name</p>
			<input type="text" name="firstName" placeholder="Enter first name">
			<p>Last Name</p>
			<input type="text" name="lastName" placeholder="Enter last name">
			<p>Select User Type</p><br>
  			<input type="radio" name="radioType" value="Student" checked>
  			<p>Student</p><br>
  			<input type="radio" name="radioType" value="Corporate">
  			<p>Corporate</p><br>
  			<p>Student ID/Corporate ID</p>
			<input type="text" name="id" placeholder="Enter Student ID/Corporate ID">
			<p>University/Company Name</p>
			<input type="text" name="uniCompName" placeholder="Enter your University/Company Name">
			<p>Email</p>
			<input type="text" name="email" placeholder="Enter Email/Username">
			<p>Phone</p>
			<input type="text" name="phone" placeholder="Enter phone number">
			<p>Address</p>
			<input type="text" name="address" placeholder="Enter address">
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter username">
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password">
			<p>Confirm password</p>
			<input type="password" name="confirmPassword" placeholder="Re-enter Password">
			<button type="submit" name="registerSubmit">Submit</button>
		</form>
	</div>
</body>
</html>