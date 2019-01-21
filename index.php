<?php
include('process.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
header("location: home.php"); // Redirecting To Profile Page
}
?> 


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Kusina_Online</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="bootstrap/js/jquery-slim.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6 momo">
					<h1 align="center" class="display-3">Kusina Online</h1>
					<p ="lead">Please fill up the form provided.</p>
					<span style="color:red"><?php echo $error; ?></span>
					<div class="form-group">
						<form action="" method="post" class="example">
						<label>Username</label>
						<input type="username" class="form-control" id="username" name="username" required>
						<label>Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
						<input class="btn btn-primary btn-block button2" type="submit" value="Log in" name="submit" id="submit">
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>