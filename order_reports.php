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
		<div class="row" style="background-color:#2F4F4F">
			<div class="col-8" style="borderl-style: solid;color: #00FF00;text-align: center">
				<h1 style=" font-family: AR DELANEY, serif;" class="display-1 font-weight-bold">REPORTS</h1>
				<button data-toggle="modal" data-target="#example_addorders" type="submit" name="cancel" style="margin-bottom:10px" class="btn btn-primary">Add Menu Orders</button>
			</div>
			<div class="col-4" style="background-image: url('kusina.jpg');background-size: contain; height: 210px;background-repeat: no-repeat;">
			
			</div>
		</div></br>
		<div class="row">
			<div class="col-8">
			<form action = "search.php" method="GET" >
				<div class="row">
					<div class="col-1">
						<p>FROM: </p>
					</div>
					<div class="col-3">
						<input type="datetime-local" class="form-control form-control-sm" name="startdate" style="width: 195px;" required>
					</div>
					<div class="col-1">
						<p>TO: </p>
					</div>
					<div class="col-3">
						<input type="datetime-local" class="form-control form-control-sm" name="enddate" style="width: 192px;" required>
					</div>
					<button type="submit" style="width: 200px" class="btn btn-primary btn-sm"> Search</button>
					<button class="btn btn-light btn-sm"><a href="order_reports.php"> Reset</a></button>
				</div>
			</form>
			<form><br>
				
					
		
			<div class="table-responsive">
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col">Order ID</th>
					  <th scope="col">Customer ID</th>
					  <th scope="col">Date</th>
					  <th scope="col">Amount</th>
					  <th scope="col">Action</th>
					</tr>
				  </thead>
				  <tbody>
								<?php
								include_once 'db.php';
								$id = $_SESSION['id'];
									$from = "2019-03-19";
									$to = "2019-03-19";

									

									$sql = "SELECT order_id, customer_id, timestamp_dt, SUM(price*quantity) FROM customer_order full inner join order_items USING(order_id)  GROUP by order_id desc ;";
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
					  <td> <button class="btn btn-light btn-sm"><a href="view_orders.php?order=<?php echo $order_id; ?>&no=<?php echo $customer_id; ?>">View</a></button></td>
					  
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
			<div class="col-4">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
							<th>STATUS<th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'kusina1') or die(mysqli($mysqli));
										$sql = "SELECT SUM(price * quantity) AS `total` FROM order_items";
										$query_sum = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_sum)):?>	
										<?php echo "&#8369; " .$row['total']. " Total Sales";?>
										
									<?php endwhile;?>
								</td>
							</tr>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'kusina1') or die(mysqli($mysqli));
										$sql = "SELECT COUNT(*) AS `count` FROM menu";
										$query_menu = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_menu)):?>
									<div class="dropdown">
										<?php echo $row['count']. " Menus";?>
										<div class="dropdown-content">	
											<a href="menu.php">View Menu</a>
										</div>
									</div>
										
									<?php endwhile;?>
								</td>
							</tr>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'kusina1') or die(mysqli($mysqli));
										$sql = "SELECT COUNT(*) AS `count` FROM customer";
										$query_cus = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_cus)):?>
									<div class="dropdown">
										<?php echo $row['count']. " Customers";?>
										<div class="dropdown-content">	
											<a href="customer.php">View Customers</a>
										</div>
									</div>
										
									<?php endwhile;?>
								</td>
							</tr>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'kusina1') or die(mysqli($mysqli));
										$sql = "SELECT COUNT(*) AS `count` FROM order_items";
										$query_items = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_items)):?>
								
										<?php echo $row['count']. " Orders";?>
										
									<?php endwhile;?>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<br/><br/>
	<br/><br/><br/><br/><br/><br/>
	<div class="modal fade" id="example_addorders" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="form-control" style="width: 1200px">
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h5 class="modal-title" >Add New Order</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<form action = "includes/addsale.inc.php" method="POST">
									<label><b>Order ID</b></label>
									<input type="text" class="form-control" name="order_id" value="" placeholder="order id" required>
									<label for="inputName" ><b>Customer</b></label>
								
											<select class="form-control" name ="customer_id" required>
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
											</select></br>	
										<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
</body>  
</html>	