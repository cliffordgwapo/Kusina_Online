<?php
	session_start();
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
				<div class="col-sm-6">
					<h1 align="center" class="display-3">Kusina Online</h1>
					<p ="lead">Please fill up the form provided.</p>
					<div class="form-group">
						<form action="process.php" method="post" class="example">
						<label>Old Password</label>
						<input type="password" class="form-control" name="old_pwd" required>
						<label>New Password</label>
						<input type="password" class="form-control" name="new_pwd" pattern=".{8,}"   required title="8 characters minimum" required>
						<label>Confirm Password</label>
						<input type="password" class="form-control" name="con_pwd" pattern=".{8,}"   required title="8 characters minimum" required>
						<div class="row">
							<div class="col">
								<input class="btn btn-primary btn-block button2" type="submit" value="Update Password" name="submit">
							</div>
							<div class="col">
								<a  href="home.php"><input class="btn btn-primary btn-block button2" type="button" value="Cancel"></a>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>