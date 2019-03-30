<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style1.css">
		<script type="text/javascript" src="bootstrap/js/jquery-slim.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>  
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="home.php">
				<img src="logo.jpg" width="40" height="40" class="d-inline-block align-top" alt="">
			</a>
			<a class="navbar-brand" href="#">Kusina Online</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="home.php">Home </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="customer.php">Customer</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="menu.php">Menu</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="order_reports.php">Reports<span class="sr-only">(current)</span></a>
					</li>
				</ul>
			</div>
			<form class="form-inline my-2 my-lg-0">
				<div id="profile">
					<b><i><?php if(isset($_SESSION['id'])){
									echo ($_SESSION['username']);
								}
								else{
								header("Location: index.php");
							}?></i></b>
				</div>
				<div class="dropdown">
					<img src="prof.jpg" alt="Profile Picture" width="40" height="40" class="mr-sm-2">
					<div class="dropdown-content" style="right: 0; left: auto;">
						<img src="prof.jpg" alt="" width="200" height="200">
						<div class="desc"><b><a href="pwdupdate.php">Update Password</a></b></div>
						<div class="desc"><b id="logout"><a href="logout.php">Log Out</a></b></div>
					</div>
				</div>
			</form>
		</nav>
		<div class="container" style="width: 450px">
			<form action = "includes/addsale.inc.php" method="POST">
				<br/><center><h1><b>Customer Orders</b></h1></center><br/><br>
				<label><b>Order ID</b></label>
				<input type="text" style="width: 500px;" class="form-control" name="order_id" value="" placeholder="order id" required>
				<label for="inputName" ><b>Customer</b></label>
				  <div class="row">
					<div class="col-6">					
						<select class="form-control" style="width: 500px;" name ="customer_id" required>
							<option value="" readonly>Select Customer Name</option>
						<?php
							include_once 'db.php';
							$id = $_SESSION['id'];
							$sql = "SELECT * 
									FROM customer AS p 
									JOIN admin AS r 
									WHERE p.id = $id  
									AND r.id = $id;";
							$result = mysqli_query($con, $sql);
							$resultCheck = mysqli_num_rows($result);
							
							if ($resultCheck > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
						?>
							
							<option value="<?php echo $row["customer_id"];?>"><?php echo $row["first_name"];?></option>
						<?php		}
			
						}
						?>
						</select>
						
				
				  <br/>				
				  
				  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
				  <button class="btn btn-light"><a href="order_reports.php">Cancel</a></button>
		</form>
	</div>
</body>
</html>
	
	
	
	
	
	
	
	