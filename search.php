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
		
	<div class="container"><br/>
		<div class="container" style="center">
			<form action = "search.inc.php" method="POST" >
				<div class="row" >
						 <p align="center">FROM: </p>
					  <input type="date" class="form-control" name="startdate" placeholder="first name" style="width: 195px;" required>
					  <p align="center">TO: </p>
					  <input type="date" class="form-control" name="enddate" placeholder="last name" style="width: 192px;" required>
									
				  <br/>			
				  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
				  <button class="btn btn-light"><a href="order_reports.php">Reset</a></button>
				</div>
				
			</form>
		</div>
	
		<br/>
	<form>
		<button type="submit" name="cancel" class="btn btn-light"><a href="addorder.php">Add Menu Orders</a></button>
			<br/><br/>
			<div class="table-responsive">
			
					<table class="table">
						<thead>
							<tr>
							  <th scope="col">Sales ID</th>
							  <th scope="col">Customer Name</th>
							  <th scope="col">Date and Time</th>
							  <th scope="col">Amount</th>
							  <th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
										<?php
										include_once 'db.php';
										$id = $_SESSION['id'];
										$startdate = $_GET['startdate'];
										$enddate = $_GET['enddate'];


											$sql = "SELECT order_id, customer_id, timestamp_dt, SUM(price*quantity) FROM customer_order full inner join order_items USING(order_id) WHERE timestamp_dt between '$startdate' and '$enddate' GROUP by order_id desc ;";
											$result = mysqli_query($con, $sql);
											$resultCheck = mysqli_num_rows($result);
											if ($resultCheck > 0) {
												while ($row = mysqli_fetch_assoc($result)) {
												$order_id = $row["order_id"];
												$sum = $row["SUM(price*quantity)"];
												$timestamp_dt = $row["timestamp_dt"];
												$customer_id = $row["customer_id"];
										?>



							<tr>
								  <td><?php echo $order_id?></td>
								  <td><?php echo $customer_id;?></td>
							  <td><?php echo $timestamp_dt;?></td>


							  <td>&#8369; <?php echo $sum;?></td>
							  <td> <button class="btn btn-light"><a href="viewcheckoutsummary.php?order=<?php echo $order_id; ?>&no=<?php echo $customer_id; ?>">View</a></button></td>
							  
							</tr>
							<?php		
									}
										}
										?>
						  </tbody>
					</table>
			</div>
		
		
		
	</form>
	
	</div>
	<br/><br/><br/><br/><br/><br/>
</body>  
</html>	