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
		<div class="row">
			<div class="col-9">
			<h1><b>View Orders</b></h1><br>
			<?php
				$order_id = $_GET['order'];
				$customer_id = $_GET['no'];
			?>
				
				Order ID : <b><?php echo $order_id; ?></b><br>
				<?php
								include_once 'db.php';
								$id = $_SESSION['id'];
								
								$no = $_GET['no'];
								$sql = "SELECT * 
										FROM customer AS p 
										JOIN admin AS r 
										WHERE p.id = $id  
										AND r.id = $id AND customer_id=$no;";
								$result = mysqli_query($con, $sql);
								$resultCheck = mysqli_num_rows($result);
								
								if ($resultCheck > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
											
							?>
				
				Customer Name : <b><?php echo $row["first_name"]; ?></b>
							
							
							
							
							<?php		}
				
							}
							?>
							<button style="float:right" class="btn btn-light"><a href="order_reports.php"> Back </a></button>
							<br><br>
			<div class="table-responsive">
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col">Menu Name</th>
					  <th scope="col">Description</th>
					  <th scope="col">Unit</th>
					  <th scope="col">Price</th>
					  <th scope="col">Quantity</th>
					  <th scope="col">Subtotal</th>
					  
					</tr>
				  </thead>
				  <tbody>
							<?php
							include_once 'db.php';
							$id = $_SESSION['id'];
							$order_id = $_GET["order"];
							$sql = "SELECT * FROM order_items, menu, customer_order 
									WHERE order_items.menu_id = menu.menu_id 
									AND customer_order.order_id = order_items.order_id 
									AND customer_order.order_id = '$order_id';";
							$result = mysqli_query($con, $sql);
							$resultCheck = mysqli_num_rows($result);
							$total=0;
							if ($resultCheck > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
								$savequantity = $row["quantity"];
								$saveprice = $row["price"];	
								$quantityprice = $savequantity*$saveprice;
								$order_id = $row["order_id"];
								$total += $quantityprice;


								
							?>



				<tr>
					  <td><?php echo $row["menu_name"];?></td>
					  <td><?php echo $row["menu_description"];?></td>
					  <td><?php echo $row["unit"];?></td>
					  <td>&#8369; <?php echo $row["price"];?></td>
				  <td><center><?php echo $row["quantity"];?></center></td>
				  <td>&#8369; <?php echo $quantityprice;?>.00</td>
				  
				</tr>
				<?php		}
							
							}
							?>
			  </tbody>
			</table>
			</div>
			</div>
			<div class="col-3"></br></br></br></br></br></br>
				<div class="container">
					<div align="right">
						<b><h1>TOTAL  </h1><h1>&#8369; <?php echo $total;?>.00</h1></b><center>
					</div>
				</div>
			</div>
		</div>
		


	
</body>
</html>